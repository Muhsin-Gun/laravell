@extends('layouts.app')

@section('title', 'My Dashboard - NEXUS')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-slate-400 mt-2">Here's what's happening with your bookings</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6 hover:border-cyan-500/30 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Total Orders</p>
                    <h3 class="text-3xl font-bold text-white">{{ $stats['total_orders'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6 hover:border-cyan-500/30 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Pending</p>
                    <h3 class="text-3xl font-bold text-yellow-400">{{ $stats['pending_orders'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6 hover:border-cyan-500/30 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Completed</p>
                    <h3 class="text-3xl font-bold text-green-400">{{ $stats['completed_orders'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6 hover:border-cyan-500/30 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Total Spent</p>
                    <h3 class="text-2xl font-bold text-purple-400">${{ number_format($stats['total_spent'], 0) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white/5 border border-cyan-500/10 rounded-2xl overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-cyan-500/10 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-white">Recent Orders</h2>
            <a href="{{ route('bookings.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm">View All</a>
        </div>
        
        @if($recent_orders->count() > 0)
            <div class="divide-y divide-cyan-500/10">
                @foreach($recent_orders as $order)
                    <div class="p-6 hover:bg-white/5 transition">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-slate-800">
                                    @if($order->car && $order->car->image_path)
                                        <img src="{{ asset('storage/' . $order->car->image_path) }}" alt="{{ $order->car->name ?? 'Car' }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-3xl">🚗</div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-medium text-white">
                                        {{ $order->car ? $order->car->name : 'Car not available' }}
                                    </h3>
                                    <p class="text-sm text-slate-400 mt-1">
                                        Order #{{ $order->id }} • 
                                        {{ $order->start_date ? \Carbon\Carbon::parse($order->start_date)->format('M d') : 'N/A' }} - 
                                        {{ $order->end_date ? \Carbon\Carbon::parse($order->end_date)->format('M d, Y') : 'N/A' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium 
                                            @if($order->status === 'completed') bg-green-500/20 text-green-400
                                            @elseif($order->status === 'approved') bg-blue-500/20 text-blue-400
                                            @elseif($order->status === 'pending') bg-yellow-500/20 text-yellow-400
                                            @else bg-red-500/20 text-red-400
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-cyan-400">${{ number_format($order->total_price ?? 0, 0) }}</p>
                                <a href="{{ route('bookings.show', $order->id) }}" class="inline-block mt-2 text-sm text-slate-400 hover:text-cyan-400">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-lg font-medium text-slate-300 mb-2">No bookings yet</h3>
                <p class="text-slate-500 mb-6">Start exploring our premium fleet and book your first ride!</p>
                <a href="{{ route('cars.index') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transition">
                    Explore Fleet
                </a>
            </div>
        @endif
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <a href="{{ route('cars.index') }}" class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/30 transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-500/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white">Book a Car</h3>
                <p class="text-sm text-slate-400">Find and book your next ride</p>
            </div>
        </a>

        <a href="{{ route('bookings.index') }}" class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/30 transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white">My Bookings</h3>
                <p class="text-sm text-slate-400">View all your bookings</p>
            </div>
        </a>

        <a href="{{ route('profile.show') }}" class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/30 transition flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white">Profile Settings</h3>
                <p class="text-sm text-slate-400">Update your information</p>
            </div>
        </a>
    </div>

    <div class="mt-12 p-8 bg-gradient-to-br from-cyan-500/5 to-blue-500/5 border border-cyan-500/10 rounded-2xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Need Help?</h3>
                <p class="text-slate-400">Our support team is available 24/7 to assist you with any questions.</p>
            </div>
            <a href="{{ route('help') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transition whitespace-nowrap">
                Contact Support
            </a>
        </div>
    </div>
</div>
@endsection
