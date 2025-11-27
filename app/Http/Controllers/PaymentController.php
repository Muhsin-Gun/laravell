<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * M-Pesa Configuration
     */
    private $consumer_key;
    private $consumer_secret;
    private $passkey;
    private $shortcode;
    private $callback_url;
    private $environment;

    public function __construct()
    {
        $this->consumer_key = config('services.mpesa.consumer_key');
        $this->consumer_secret = config('services.mpesa.consumer_secret');
        $this->passkey = config('services.mpesa.passkey');
        $this->shortcode = config('services.mpesa.shortcode');
        $this->callback_url = route('payment.mpesa.callback');
        $this->environment = config('services.mpesa.env', 'sandbox');
    }

    /**
     * Initialize M-Pesa payment
     */
    public function initialize(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|regex:/^254[0-9]{9}$/',
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Verify booking belongs to authenticated user
        if ($booking->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to booking'
            ], 403);
        }

        // Amount is already in KES - use directly
        $amount = (int) round($booking->total_price);
        
        if ($amount < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid booking amount'
            ], 400);
        }

        // Get access token
        $token = $this->getAccessToken();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate with M-Pesa'
            ], 500);
        }

        // Prepare STK Push request
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $url = $this->environment === 'sandbox'
            ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $payload = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $request->phone_number,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $request->phone_number,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => 'Booking-' . $booking->id,
            'TransactionDesc' => 'Payment for car booking #' . $booking->id
        ];

        try {
            $response = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            $result = $response->json();

            if ($response->successful() && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                // Store payment record
                Payment::create([
                    'order_id' => $booking->id,
                    'checkout_request_id' => $result['CheckoutRequestID'],
                    'merchant_request_id' => $result['MerchantRequestID'],
                    'phone_number' => $request->phone_number,
                    'amount' => $amount,
                    'status' => 'pending',
                    'result_code' => $result['ResponseCode'],
                    'result_description' => $result['ResponseDescription']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment request sent to your phone',
                    'checkout_request_id' => $result['CheckoutRequestID']
                ]);
            }

            Log::error('M-Pesa STK Push Failed: ' . $response->body());

            return response()->json([
                'success' => false,
                'message' => $result['errorMessage'] ?? 'Payment request failed'
            ], 400);

        } catch (\Exception $e) {
            Log::error('M-Pesa STK Push Exception: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing payment'
            ], 500);
        }
    }

    /**
     * Handle M-Pesa Callback
     */
    public function callback(Request $request)
    {
        $data = $request->all();
        Log::info('M-Pesa Callback Received: ' . json_encode($data));

        try {
            $callbackData = $data['Body']['stkCallback'];
            $resultCode = $callbackData['ResultCode'];
            $checkoutRequestId = $callbackData['CheckoutRequestID'];

            // Find payment record
            $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

            if (!$payment) {
                Log::error('Payment not found for CheckoutRequestID: ' . $checkoutRequestId);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Payment not found']);
            }

            if ($resultCode == 0) {
                // Payment successful
                $callbackMetadata = $callbackData['CallbackMetadata']['Item'];

                // Extract payment details
                $mpesaReceiptNumber = null;
                $transactionDate = null;
                $phoneNumber = null;

                foreach ($callbackMetadata as $item) {
                    switch ($item['Name']) {
                        case 'MpesaReceiptNumber':
                            $mpesaReceiptNumber = $item['Value'];
                            break;
                        case 'TransactionDate':
                            $transactionDate = $item['Value'];
                            break;
                        case 'PhoneNumber':
                            $phoneNumber = $item['Value'];
                            break;
                    }
                }

                // Update payment record
                $payment->update([
                    'status' => 'completed',
                    'mpesa_receipt_number' => $mpesaReceiptNumber,
                    'transaction_date' => $transactionDate ? now()->parse($transactionDate) : null,
                    'result_code' => $resultCode,
                    'result_description' => $callbackData['ResultDesc']
                ]);

                // Update booking status - auto-approve on successful payment
                $payment->order->update([
                    'status' => 'approved',
                    'payment_status' => 'completed'
                ]);

                Log::info('Payment completed successfully and booking auto-approved: ' . $mpesaReceiptNumber);
            } else {
                // Payment failed
                $payment->update([
                    'status' => 'failed',
                    'result_code' => $resultCode,
                    'result_description' => $callbackData['ResultDesc']
                ]);

                Log::warning('Payment failed: ' . $callbackData['ResultDesc']);
            }

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Success'
            ]);

        } catch (\Exception $e) {
            Log::error('M-Pesa Callback Exception: ' . $e->getMessage());
            return response()->json([
                'ResultCode' => 1,
                'ResultDesc' => 'Error processing callback'
            ]);
        }
    }

    /**
     * Get M-Pesa OAuth Access Token
     */
    private function getAccessToken()
    {
        $url = $this->environment === 'sandbox'
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        try {
            $response = Http::withBasicAuth($this->consumer_key, $this->consumer_secret)
                ->get($url);

            if ($response->successful()) {
                return $response->json()['access_token'];
            }

            Log::error('M-Pesa Token Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('M-Pesa Token Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check Payment Status
     */
    public function checkStatus(Booking $booking)
    {
        // Verify booking belongs to authenticated user
        if ($booking->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $payment = $booking->payment()->latest()->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'No payment found for this booking'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $payment->status,
            'amount' => $payment->amount,
            'mpesa_receipt_number' => $payment->mpesa_receipt_number
        ]);
    }
}
