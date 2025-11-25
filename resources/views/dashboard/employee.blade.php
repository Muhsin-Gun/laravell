@extends('layouts.app')

@section('title','Employee Dashboard')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Employee Dashboard</h1>
        <div class="p-6 bg-white/5 rounded-xl">
            <div class="text-sm text-slate-400">Pending Bookings</div>
            <div class="text-2xl font-extrabold">{{ $pending ?? 0 }}</div>
        </div>

        <div class="mt-4">
            <h2 class="font-bold text-xl mb-2">Bookings to Approve</h2>
            @if($toApprove->count() > 0)
                <div class="space-y-4">
                    @foreach($toApprove as $booking)
                        <div class="p-4 bg-white/5 rounded-lg flex items-center justify-between">
                            <div>
                                <div class="font-semibold">Booking #{{ $booking->id }} — {{ $booking->user->name ?? 'Guest' }}</div>
                                <div class="text-sm text-slate-400">Car: {{ $booking->car->name ?? '—' }} | {{ $booking->start_date }} → {{ $booking->end_date }}</div>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('employee.approve', $booking->id) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-cyan-500 text-black rounded">Approve</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $toApprove->links() }}</div>
            @else
                <p class="text-slate-400">No pending bookings.</p>
            @endif
        </div>
    </div>
@endsection
