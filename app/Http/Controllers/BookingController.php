<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $endDate->diff($startDate)->days;
        
        if ($days < 1) {
            $days = 1;
        }
        
        $total = $car->price_per_day * $days;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        return redirect()->route('checkout', $booking)->with('success', 'Booking created! Please complete payment.');
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('car')
            ->latest()
            ->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $booking->load(['car', 'payment']);
        return view('bookings.show', compact('booking'));
    }

    public function employeeIndex()
    {
        $bookings = Booking::with(['car', 'user'])
            ->latest()
            ->paginate(15);
            
        return view('employee.bookings', compact('bookings'));
    }

    public function checkout(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $booking->load('car');
        return view('checkout', compact('booking'));
    }
}
