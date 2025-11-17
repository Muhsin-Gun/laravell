<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function client()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('car')->latest()->get();
        return view('dashboard.client', compact('bookings'));
    }

    public function admin()
    {
        $totalUsers = User::count();
        $totalCars = Car::count();
        $totalBookings = Booking::count();
        return view('dashboard.admin', compact('totalUsers', 'totalCars', 'totalBookings'));
    }

    public function employee()
    {
        $pending = Booking::where('status', 'pending')->count();
        $toApprove = Booking::where('status', 'pending')->with(['car', 'user'])->latest()->paginate(10);
        return view('dashboard.employee', compact('pending', 'toApprove'));
    }
}
