<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function approve(Request $request, Booking $booking)
    {
        // Approve a pending booking
        $booking->status = 'approved';
        $booking->save();

        // Create notification for user
        DB::table('notifications')->insert([
            'user_id' => $booking->user_id,
            'type' => 'booking.status',
            'data' => json_encode([
                'booking_id' => $booking->id,
                'status' => $booking->status
            ]),
            'read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Booking approved successfully!');
    }

    public function reject(Request $request, Booking $booking)
    {
        // Reject a pending booking
        $booking->status = 'rejected';
        $booking->save();

        // Create notification for user
        DB::table('notifications')->insert([
            'user_id' => $booking->user_id,
            'type' => 'booking.status',
            'data' => json_encode([
                'booking_id' => $booking->id,
                'status' => $booking->status
            ]),
            'read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Booking rejected successfully!');
    }
}
