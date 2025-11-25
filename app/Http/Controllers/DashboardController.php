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
        $user = Auth::user();
        
        // Get user statistics
        $stats = [
            'total_orders' => $user->bookings()->count(),
            'pending_orders' => $user->bookings()->where('status', 'pending')->count(),
            'completed_orders' => $user->bookings()->where('status', 'completed')->count(),
            'total_spent' => $user->bookings()->where('status', '!=', 'cancelled')->sum('total_price'),
        ];
        
        // Get recent orders with car and payment information
        $recent_orders = $user->bookings()
            ->with(['car', 'payment'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('client.dashboard', compact('stats', 'recent_orders'));
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
