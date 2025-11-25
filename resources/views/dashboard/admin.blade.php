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
        <div style="color: #00e5ff; font-size: 12px;">{{ \App\Models\Car::where('available', true)->count() }} available</div>
