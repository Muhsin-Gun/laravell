<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        $this->callback_url = config('services.mpesa.callback_url');
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

        // Use the total price directly (already in KSH)
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
                // Store payment record with server-calculated amount
                Payment::create([
                    'order_id' => $booking->id,
                    'checkout_request_id' => $result['CheckoutRequestID'],
                    'merchant_request_id' => $result['MerchantRequestID'],
                    'phone_number' => $request->phone_number,
                    'amount' => $amount,
                    'status' => 'pending',
                    'result_code' => $result['ResponseCode'],
                    'result_description' => $result['ResponseDescription'] ?? ($result['responseDescription'] ?? null)
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
                'message' => $result['errorMessage'] ?? $result['ResponseDescription'] ?? 'Payment request failed'
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
            // Validate basic structure
            if (!isset($data['Body']) || !isset($data['Body']['stkCallback'])) {
                Log::error('Callback format invalid or missing stkCallback', ['payload' => $data]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid callback format']);
            }

            $callbackData = $data['Body']['stkCallback'];
            $resultCode = $callbackData['ResultCode'] ?? null;
            $checkoutRequestId = $callbackData['CheckoutRequestID'] ?? null;

            if (!$checkoutRequestId) {
                Log::error('Callback missing CheckoutRequestID', ['callbackData' => $callbackData]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Missing CheckoutRequestID']);
            }

            // Find payment record
            $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

            if (!$payment) {
                Log::error('Payment not found for CheckoutRequestID: ' . $checkoutRequestId, ['checkoutRequestId' => $checkoutRequestId]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Payment not found']);
            }

            if ((int)$resultCode === 0) {
                // Payment successful - ensure metadata exists
                if (!isset($callbackData['CallbackMetadata']) || !isset($callbackData['CallbackMetadata']['Item'])) {
                    Log::error('CallbackMetadata missing for success', ['callbackData' => $callbackData]);
                    // still update payment as completed? safer to mark missing metadata
                    return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Missing metadata']);
                }

                $callbackMetadata = $callbackData['CallbackMetadata']['Item'];

                // Extract payment details (case-insensitive)
                $mpesaReceiptNumber = null;
                $transactionDate = null;
                $phoneNumber = null;
                $amount = null;

                foreach ($callbackMetadata as $item) {
                    // support both 'Name' and 'name' casing, and Value/value
                    $name = isset($item['Name']) ? $item['Name'] : ($item['name'] ?? null);
                    $value = $item['Value'] ?? ($item['value'] ?? null);

                    if (!$name) continue;

                    switch (strtolower($name)) {
                        case 'mpesareceiptnumber':
                        case 'mpesareceiptnumber':
                        case 'mpesareceiptnumber':
                            $mpesaReceiptNumber = $value;
                            break;
                        case 'transactiondate':
                        case 'transactiondate':
                            $transactionDate = $value;
                            break;
                        case 'phonenumber':
                        case 'phonenumber':
                            $phoneNumber = $value;
                            break;
                        case 'amount':
                            $amount = $value;
                            break;
                    }
                }

                // Convert date safely. M-Pesa uses YmdHis format (e.g. 20251129163045)
                $transactionDateCarbon = null;
                if ($transactionDate) {
                    try {
                        // transactionDate might be integer — cast to string
                        $transactionDateCarbon = Carbon::createFromFormat('YmdHis', (string)$transactionDate);
                    } catch (\Exception $e) {
                        Log::warning('Failed to parse transaction date', ['transactionDate' => $transactionDate, 'error' => $e->getMessage()]);
                        $transactionDateCarbon = null;
                    }
                }

                // Update payment record
                $payment->update([
                    'status' => 'completed',
                    'mpesa_receipt_number' => $mpesaReceiptNumber,
                    'transaction_date' => $transactionDateCarbon,
                    'result_code' => $resultCode,
                    'result_description' => $callbackData['ResultDesc'] ?? null,
                    'amount' => $amount ?? $payment->amount
                ]);

                // Update booking status - only if relation exists
                try {
                    if (method_exists($payment, 'order') && $payment->order) {
                        $payment->order->update([
                            'status' => 'confirmed',
                            'payment_status' => 'completed'
                        ]);
                    } elseif (method_exists($payment, 'booking') && $payment->booking) {
                        // fallback if your relation is named booking
                        $payment->booking->update([
                            'status' => 'confirmed',
                            'payment_status' => 'completed'
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to update related booking/order', ['error' => $e->getMessage()]);
                }

                Log::info('Payment completed successfully: ' . $mpesaReceiptNumber, ['checkoutRequestId' => $checkoutRequestId]);

            } else {
                // Payment failed
                $payment->update([
                    'status' => 'failed',
                    'result_code' => $resultCode,
                    'result_description' => $callbackData['ResultDesc'] ?? null
                ]);

                Log::warning('Payment failed: ' . ($callbackData['ResultDesc'] ?? 'No description'), ['checkoutRequestId' => $checkoutRequestId]);
            }

            // Daraja expects a JSON response with ResultCode & ResultDesc
            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Success'
            ]);

        } catch (\Exception $e) {
            Log::error('M-Pesa Callback Exception: ' . $e->getMessage(), ['payload' => $data]);
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
                return $response->json()['access_token'] ?? null;
            }

            Log::error('M-Pesa Token Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('M-Pesa Token Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Test STK Push - For testing M-Pesa integration
     */
    public function testStkPush(Request $request)
    {
        $phone = $request->phone ?? '254793027220';
        $amount = $request->amount ?? 1;

        // Get access token
        $token = $this->getAccessToken();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate with M-Pesa. Check your credentials.'
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
            'PartyA' => $phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => 'Test-Payment',
            'TransactionDesc' => 'Test STK Push'
        ];

        try {
            $response = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            $result = $response->json();

            Log::info('Test STK Push Response: ' . json_encode($result));

            if ($response->successful() && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                return response()->json([
                    'success' => true,
                    'message' => 'STK Push sent to ' . $phone . '! Check your phone.',
                    'data' => $result
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $result['errorMessage'] ?? 'STK Push failed',
                'data' => $result
            ], 400);

        } catch (\Exception $e) {
            Log::error('Test STK Push Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
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

    /**
     * Show Buy Car Form - Public route for testing STK Push
     */
    public function showBuyForm(Car $car)
    {
        return view('payment.buy-car', compact('car'));
    }

    /**
     * Buy Car Direct - Public STK Push for testing
     */
    public function buyCarDirect(Request $request, Car $car)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ]);

        // Format phone number to 254XXXXXXXXX
        $phone = $this->formatPhoneNumber($request->phone_number);

        if (!$phone) {
            return back()->with('error', 'Invalid phone number format. Use 07XXXXXXXX or 254XXXXXXXXX');
        }

        // Use price_per_day as purchase amount for testing (1 KSH minimum for sandbox)
        $amount = max(1, (int) round($car->price_per_day));

        Log::info("Buy Car Direct - Car: {$car->name}, Amount: {$amount}, Phone: {$phone}");
        Log::info("Callback URL: {$this->callback_url}");

        // Get access token
        $token = $this->getAccessToken();
        if (!$token) {
            Log::error('Failed to get M-Pesa access token');
            return back()->with('error', 'Failed to connect to M-Pesa. Please try again.');
        }

        Log::info('M-Pesa token obtained successfully');

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
            'PartyA' => $phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => 'Car-' . $car->id,
            'TransactionDesc' => 'Purchase ' . $car->name
        ];

        Log::info('STK Push Payload', $payload);

        try {
            $response = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            $result = $response->json();

            Log::info('STK Push Response', ['status' => $response->status(), 'body' => $result]);

            if ($response->successful() && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                // Create a temporary user for direct purchase if needed
                $user = auth()->user();
                if (!$user) {
                    $user = User::firstOrCreate(
                        ['email' => 'guest_' . $phone . '@temp.com'],
                        [
                            'name' => 'Guest Buyer',
                            'password' => bcrypt('temp_' . time()),
                            'role' => 'client'
                        ]
                    );
                }

                // Create a booking for this purchase
                $booking = Booking::create([
                    'user_id' => $user->id,
                    'car_id' => $car->id,
                    'start_date' => now(),
                    'end_date' => now()->addDay(),
                    'total_price' => $amount,
                    'status' => 'pending',
                    'payment_status' => 'pending'
                ]);

                // Store payment record
                Payment::create([
                    'order_id' => $booking->id,
                    'checkout_request_id' => $result['CheckoutRequestID'],
                    'merchant_request_id' => $result['MerchantRequestID'],
                    'phone_number' => $phone,
                    'amount' => $amount,
                    'status' => 'pending',
                    'result_code' => $result['ResponseCode'],
                    'result_description' => $result['ResponseDescription'] ?? null
                ]);

                return back()->with('success', 'Payment request sent to ' . $phone . '! Check your phone for the M-Pesa prompt.' );
            }

            $errorMessage = $result['errorMessage'] ?? $result['ResponseDescription'] ?? 'Unknown error';
            Log::error('STK Push Failed', ['error' => $errorMessage, 'response' => $result]);

            return back()->with('error', 'Payment request failed: ' . $errorMessage);

        } catch (\Exception $e) {
            Log::error('STK Push Exception: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Format phone number to 254XXXXXXXXX format
     */
    private function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/\D/', '', $phone);

        // Handle different formats
        if (strlen($phone) == 9) {
            // Format: 7XXXXXXXX
            return '254' . $phone;
        } elseif (strlen($phone) == 10 && substr($phone, 0, 1) == '0') {
            // Format: 07XXXXXXXX
            return '254' . substr($phone, 1);
        } elseif (strlen($phone) == 12 && substr($phone, 0, 3) == '254') {
            // Format: 254XXXXXXXXX
            return $phone;
        } elseif (strlen($phone) == 13 && substr($phone, 0, 4) == '+254') {
            // Format: +254XXXXXXXXX
            return substr($phone, 1);
        }

        return null;
    }

    /**
     * API Test STK Push - Public route for testing (no CSRF)
     */
    public function apiTestStkPush(Request $request)
    {
        $phone = $request->phone ?? '254793027220';
        $amount = $request->amount ?? 1;

        // Format phone number
        $phone = $this->formatPhoneNumber($phone);
        if (!$phone) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number format'
            ], 400);
        }

        Log::info("API Test STK Push - Phone: {$phone}, Amount: {$amount}");
        Log::info("Callback URL: {$this->callback_url}");
        Log::info("Shortcode: {$this->shortcode}");

        // Get access token
        $token = $this->getAccessToken();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate with M-Pesa. Check your credentials.',
                'debug' => [
                    'consumer_key_set' => !empty($this->consumer_key),
                    'consumer_secret_set' => !empty($this->consumer_secret),
                ]
            ], 500);
        }

        Log::info('Access token obtained successfully');

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
            'Amount' => (int) $amount,
            'PartyA' => $phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => 'Test-Payment',
            'TransactionDesc' => 'Test STK Push'
        ];

        Log::info('STK Push Payload', $payload);

        try {
            $response = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            $result = $response->json();

            Log::info('STK Push Response', ['status' => $response->status(), 'body' => $result]);

            if ($response->successful() && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                return response()->json([
                    'success' => true,
                    'message' => 'STK Push sent to ' . $phone . '! Check your phone.',
                    'data' => $result,
                    'callback_url' => $this->callback_url
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $result['errorMessage'] ?? $result['ResponseDescription'] ?? 'STK Push failed',
                'data' => $result,
                'callback_url' => $this->callback_url
            ], 400);

        } catch (\Exception $e) {
            Log::error('API Test STK Push Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
