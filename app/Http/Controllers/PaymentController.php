<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function initialize(Request $request)
    {
        $booking = Booking::findOrFail($request->booking);
        return view('payment.mpesa', compact('booking'));
    }

    public function callback(Request $request)
    {
        // Handle M-PESA callback
        $data = $request->input('Body.stkCallback');

        if (isset($data['ResultCode']) && $data['ResultCode'] == 0) {
            // Payment successful - update booking
            // Extract booking ID and update status
        }

        return response()->json(['success' => true]);
    }
}
