<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function client()
    {
        $user = Auth::user();
        
        $stats = [
            'total_orders' => $user->bookings()->count(),
            'pending_orders' => $user->bookings()->where('status', 'pending')->count(),
            'completed_orders' => $user->bookings()->where('status', 'completed')->count(),
            'total_spent' => $user->bookings()->where('status', '!=', 'cancelled')->sum('total_price'),
        ];
        
        $recent_orders = $user->bookings()
            ->with(['car', 'payment'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('client.dashboard', compact('stats', 'recent_orders'));
    }

    public function admin()
    {
        $stats = [
            'users' => User::count(),
            'cars' => Car::count(),
            'bookings' => Booking::count(),
            'revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];
        
        $recentBookings = Booking::with(['car', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('Admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function employee()
    {
        $stats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'active' => Booking::where('status', 'approved')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
        ];
        
        $pendingBookings = Booking::where('status', 'pending')
            ->with(['car', 'user'])
            ->latest()
            ->paginate(10);
            
        return view('employee.dashboard', compact('stats', 'pendingBookings'));
    }
}
