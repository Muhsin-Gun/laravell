<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function approve(Request $request, Booking $booking)
    {
        $request->validate([
            'action' => 'required|in:approve,cancel,complete'
        ]);

        if ($request->action === 'approve') {
            $booking->status = 'approved';
        } elseif ($request->action === 'cancel') {
            $booking->status = 'cancelled';
        } elseif ($request->action === 'complete') {
            $booking->status = 'completed';
        }

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

        return back()->with('success', 'Booking ' . $booking->status . ' successfully!');
    }
}
