<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function book(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $days = (new \DateTime($request->end_date))->diff(new \DateTime($request->start_date))->days + 1;
        $total = $car->price_per_day * $days;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        return redirect()->route('payment.mpesa.initialize', ['booking' => $booking->id]);
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('car')->get();
        return view('bookings.index', compact('bookings'));
    }
}
