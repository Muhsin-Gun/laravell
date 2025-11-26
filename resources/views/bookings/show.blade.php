@extends('layouts.app')

@section('title', 'Booking Details - NEXUS')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('bookings.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to My Bookings
        </a>
    </div>

    <div class="bg-white/5 border border-cyan-500/10 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-cyan-500/10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Booking #{{ $booking->id }}</h1>
                <p class="text-slate-400 text-sm mt-1">Created {{ $booking->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-medium 
                @if($booking->status === 'completed' || $booking->status === 'paid') bg-green-500/20 text-green-400
                @elseif($booking->status === 'approved') bg-blue-500/20 text-blue-400
                @elseif($booking->status === 'pending') bg-yellow-500/20 text-yellow-400
                @elseif($booking->status === 'cancelled' || $booking->status === 'rejected') bg-red-500/20 text-red-400
                @else bg-slate-500/20 text-slate-400
                @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="p-6">
            <div class="flex items-start gap-6 pb-6 border-b border-slate-700">
                <div class="w-32 h-32 rounded-xl overflow-hidden bg-slate-800 shrink-0">
                    @if($booking->car && $booking->car->image_path)
                        <img src="{{ asset('storage/' . $booking->car->image_path) }}" alt="{{ $booking->car->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl">🚗</div>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $booking->car->name ?? 'Vehicle' }}</h2>
                    <p class="text-slate-400">{{ $booking->car->brand ?? '' }} • {{ $booking->car->type ?? '' }}</p>
                    <p class="text-cyan-400 font-bold mt-2">${{ number_format($booking->car->price_per_day ?? 0, 2) }} / day</p>
                    @if($booking->car)
                        <a href="{{ route('cars.show', $booking->car->id) }}" class="inline-block mt-2 text-sm text-slate-400 hover:text-cyan-400">
                            View Car Details →
                        </a>
                    @endif
                </div>
            </div>

            <div class="py-6 grid grid-cols-2 gap-6 border-b border-slate-700">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Pick-up Date</p>
                    <p class="text-lg font-medium text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400 mb-1">Return Date</p>
                    <p class="text-lg font-medium text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="py-6 border-b border-slate-700">
                <h3 class="font-bold text-white mb-4">Payment Details</h3>
                @php
                    $days = \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date));
                    if ($days < 1) $days = 1;
                @endphp
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Daily Rate</span>
                        <span class="text-white">${{ number_format($booking->car->price_per_day ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Duration</span>
                        <span class="text-white">{{ $days }} day{{ $days > 1 ? 's' : '' }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-3 border-t border-slate-600">
                        <span class="text-white">Total</span>
                        <span class="text-green-400">KES {{ number_format(($booking->total_price ?? 0) * 130, 0) }}</span>
                    </div>
                </div>
            </div>

            @if($booking->payment)
                <div class="py-6">
                    <h3 class="font-bold text-white mb-4">Payment Status</h3>
                    <div class="p-4 rounded-xl 
                        @if($booking->payment->status === 'completed') bg-green-500/10 border border-green-500/30
                        @elseif($booking->payment->status === 'pending') bg-yellow-500/10 border border-yellow-500/30
                        @else bg-red-500/10 border border-red-500/30
                        @endif">
                        <div class="flex items-center gap-3">
                            @if($booking->payment->status === 'completed')
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <p class="font-medium text-green-400">Payment Successful</p>
                                    @if($booking->payment->mpesa_receipt_number)
                                        <p class="text-sm text-slate-400">Receipt: {{ $booking->payment->mpesa_receipt_number }}</p>
                                    @endif
                                </div>
                            @elseif($booking->payment->status === 'pending')
                                <svg class="w-6 h-6 text-yellow-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="font-medium text-yellow-400">Payment Pending</p>
                                    <p class="text-sm text-slate-400">Waiting for M-Pesa confirmation</p>
                                </div>
                            @else
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <div>
                                    <p class="font-medium text-red-400">Payment Failed</p>
                                    <p class="text-sm text-slate-400">{{ $booking->payment->result_description ?? 'Please try again' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                @if($booking->status === 'pending')
                    <div class="py-6">
                        <a href="{{ route('checkout', $booking->id) }}" class="block w-full py-4 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl font-bold text-center text-lg hover:scale-[1.02] transform transition shadow-lg">
                            Complete Payment
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
