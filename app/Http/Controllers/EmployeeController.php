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
        
        $action = $request->input('action');
        
        switch ($action) {
            case 'cancel':
                $booking->status = 'cancelled';
                $message = 'Booking cancelled successfully!';
                break;
            case 'complete':
                $booking->status = 'completed';
                $message = 'Booking marked as completed!';
                break;
            case 'approve':
                $booking->status = 'approved';
                $message = 'Booking approved successfully!';
                break;
        }
        
        $booking->save();

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

        return back()->with('success', $message);
    }

    public function reject(Request $request, Booking $booking)
    {
        $booking->status = 'rejected';
        $booking->save();

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
