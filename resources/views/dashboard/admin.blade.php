@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white/5 rounded-xl">
                <div class="text-sm text-slate-400">Total Users</div>
                <div class="text-2xl font-extrabold">{{ $totalUsers ?? 0 }}</div>
            </div>
            <div class="p-6 bg-white/5 rounded-xl">
                <div class="text-sm text-slate-400">Total Cars</div>
                <div class="text-2xl font-extrabold">{{ $totalCars ?? 0 }}</div>
            </div>
            <div class="p-6 bg-white/5 rounded-xl">
                <div class="text-sm text-slate-400">Total Bookings</div>
                <div class="text-2xl font-extrabold">{{ $totalBookings ?? 0 }}</div>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-slate-300">Use admin area to manage cars, users and bookings. Links to resources can be added here.</p>
        </div>
    </div>
@endsection
@extends('layout')

@section('content')
<div style="margin-bottom: 40px;">
    <h1 style="color: #00e5ff; font-size: 36px; margin: 0 0 10px 0;">Admin Dashboard</h1>
    <p style="color: #999;">Complete system overview and management</p>
</div>

<!-- Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <div style="background: linear-gradient(135deg, rgba(0,229,255,0.15), rgba(0,229,255,0.05)); padding: 30px; border-radius: 12px; border: 1px solid rgba(0,229,255,0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.1;">👥</div>
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Users</div>
        <div style="color: #00e5ff; font-size: 42px; font-weight: bold; margin-bottom: 10px;">{{ $totalUsers }}</div>
        <div style="color: #00ff9e; font-size: 12px;">+12% this month</div>
    </div>

    <div style="background: linear-gradient(135deg, rgba(0,255,158,0.15), rgba(0,255,158,0.05)); padding: 30px; border-radius: 12px; border: 1px solid rgba(0,255,158,0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.1;">🚗</div>
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Cars</div>
        <div style="color: #00ff9e; font-size: 42px; font-weight: bold; margin-bottom: 10px;">{{ $totalCars }}</div>
        <div style="color: #00e5ff; font-size: 12px;">{{ \App\Models\Car::where('available', true)->count() }} available</div>
    </div>


    <div style="background: linear-gradient(135deg, rgba(255,215,0,0.15), rgba(255,215,0,0.05)); padding: 30px; border-radius: 12px; border: 1px solid rgba(255,215,0,0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.1;">📋</div>
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Bookings</div>
        <div style="color: #ffd700; font-size: 42px; font-weight: bold; margin-bottom: 10px;">{{ $totalBookings }}</div>
        <div style="color: #00ff9e; font-size: 12px;">{{ \App\Models\Booking::where('status', 'pending')->count() }} pending</div>
    </div>

    <div style="background: linear-gradient(135deg, rgba(255,0,85,0.15), rgba(255,0,85,0.05)); padding: 30px; border-radius: 12px; border: 1px solid rgba(255,0,85,0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.1;">💰</div>
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Revenue</div>
        <div style="color: #ff0055; font-size: 42px; font-weight: bold; margin-bottom: 10px;">${{ number_format(\App\Models\Booking::where('status', 'completed')->sum('total_price'), 0) }}</div>
        <div style="color: #00ff9e; font-size: 12px;">+28% this month</div>
    </div>
</div>

<!-- Quick Management -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 40px;">
    <a href="{{ route('cars.index') }}" class="btn" style="padding: 20px; text-align: center; display: block; text-decoration: none;">
        <div style="font-size: 32px; margin-bottom: 10px;">🚗</div>
        <div>Manage Cars</div>
    </a>
    <a href="{{ route('users.index') }}" class="btn" style="padding: 20px; text-align: center; display: block; text-decoration: none; background: linear-gradient(90deg, #00ff9e, #00e5ff);">
        <div style="font-size: 32px; margin-bottom: 10px;">👥</div>
        <div>Manage Users</div>
    </a>
    <a href="#" class="btn" style="padding: 20px; text-align: center; display: block; text-decoration: none; background: linear-gradient(90deg, #ffd700, #ff0055);">
        <div style="font-size: 32px; margin-bottom: 10px;">📊</div>
        <div>View Analytics</div>
    </a>
    <a href="#" class="btn" style="padding: 20px; text-align: center; display: block; text-decoration: none; background: linear-gradient(90deg, #ff0055, #00e5ff);">
        <div style="font-size: 32px; margin-bottom: 10px;">⚙️</div>
        <div>Settings</div>
    </a>
</div>

<!-- Recent Activity -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <div style="background: #1e1e1e; padding: 30px; border-radius: 12px; border: 1px solid #333;">
        <h2 style="color: #00e5ff; margin-bottom: 25px; font-size: 20px;">Recent Bookings</h2>
        <div style="space-y: 15px;">
            @foreach(\App\Models\Booking::latest()->take(5)->get() as $booking)
            <div style="background: #0b0b0b; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 3px solid #00e5ff;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <div style="color: #fff; font-weight: 600; margin-bottom: 5px;">{{ $booking->car->name }}</div>
                        <div style="color: #999; font-size: 13px;">{{ $booking->user->name }} • {{ $booking->created_at->diffForHumans() }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #00ff9e; font-weight: 600;">${{ number_format($booking->total_price, 0) }}</div>
                        @if($booking->status == 'pending')
                        <span style="background: rgba(255,215,0,0.2); color: #ffd700; padding: 3px 8px; border-radius: 10px; font-size: 10px;">PENDING</span>
                        @elseif($booking->status == 'approved')
                        <span style="background: rgba(0,255,158,0.2); color: #00ff9e; padding: 3px 8px; border-radius: 10px; font-size: 10px;">APPROVED</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style="background: #1e1e1e; padding: 30px; border-radius: 12px; border: 1px solid #333;">
        <h2 style="color: #00e5ff; margin-bottom: 25px; font-size: 20px;">Top Cars</h2>
        @foreach(\App\Models\Car::withCount('bookings')->orderBy('bookings_count', 'desc')->take(5)->get() as $car)
        <div style="margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <span style="color: #ccc; font-size: 14px;">{{ $car->name }}</span>
                <span style="color: #00ff9e; font-weight: 600;">{{ $car->bookings_count }}</span>
            </div>
            <div style="background: #0b0b0b; height: 6px; border-radius: 3px; overflow: hidden;">
                <div style="background: linear-gradient(90deg, #00e5ff, #00ff9e); height: 100%; width: {{ min(100, ($car->bookings_count / max(1, \App\Models\Booking::count())) * 100) }}%; border-radius: 3px;"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
