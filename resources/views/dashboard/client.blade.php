@extends('layouts.app')

@section('title','My Dashboard')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">My Bookings</h1>
        @if($bookings->count() > 0)
            <div class="space-y-4">
                @foreach($bookings as $b)
                    <div class="p-4 bg-white/5 rounded-lg flex items-center justify-between">
                        <div>
                            <div class="font-semibold">{{ $b->car->name ?? 'Car' }} — {{ $b->start_date }} → {{ $b->end_date }}</div>
                            <div class="text-sm text-slate-400">Status: {{ ucfirst($b->status) }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold">${{ number_format($b->total_price,2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-slate-400">You have no bookings yet.</p>
        @endif
    </div>
@endsection
