@extends('layouts.app')

@section('title', 'My Bookings - NEXUS')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">My Bookings</h1>
            <p class="text-slate-400 mt-2">View and manage all your car rentals</p>
        </div>
        <a href="{{ route('cars.index') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transition">
            Book New Car
        </a>
    </div>

    @if($bookings->count() > 0)
        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl overflow-hidden">
            <div class="divide-y divide-cyan-500/10">
                @foreach($bookings as $booking)
                    <div class="p-6 hover:bg-white/5 transition">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-800">
                                    @if($booking->car && $booking->car->image_path)
                                        <img src="{{ asset('storage/' . $booking->car->image_path) }}" alt="{{ $booking->car->name ?? 'Car' }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-3xl">🚗</div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">
                                        {{ $booking->car ? $booking->car->name : 'Vehicle' }}
                                    </h3>
                                    <p class="text-sm text-slate-400 mt-1">
                                        Booking #{{ $booking->id }} • 
                                        {{ $booking->car ? $booking->car->brand . ' ' . $booking->car->type : '' }}
                                    </p>
                                    <div class="flex items-center gap-4 mt-2 text-sm text-slate-500">
                                        <span>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        @if($booking->status === 'completed' || $booking->status === 'paid') bg-green-500/20 text-green-400
                                        @elseif($booking->status === 'approved') bg-blue-500/20 text-blue-400
                                        @elseif($booking->status === 'pending') bg-yellow-500/20 text-yellow-400
                                        @elseif($booking->status === 'cancelled' || $booking->status === 'rejected') bg-red-500/20 text-red-400
                                        @else bg-slate-500/20 text-slate-400
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    <p class="text-xl font-bold text-cyan-400 mt-2">${{ number_format($booking->total_price ?? 0, 0) }}</p>
                                </div>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="px-4 py-2 border border-cyan-500/30 text-cyan-400 rounded-lg hover:bg-cyan-500/10 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-bold text-white mb-2">No bookings yet</h3>
            <p class="text-slate-400 mb-6">Start exploring our premium fleet and book your first ride!</p>
            <a href="{{ route('cars.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transition">
                Explore Fleet
            </a>
        </div>
    @endif
</div>
@endsection
