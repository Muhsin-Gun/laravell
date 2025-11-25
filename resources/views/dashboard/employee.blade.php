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
@extends('layout')

@section('content')
<div style="margin-bottom: 40px;">
    <h1 style="color: #00e5ff; font-size: 36px; margin: 0 0 10px 0;">Employee Dashboard</h1>
    <p style="color: #999;">Manage bookings and customer requests</p>
</div>

<!-- Quick Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <div style="background: linear-gradient(135deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,215,0,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px;">Pending Approvals</div>
        <div style="color: #ffd700; font-size: 36px; font-weight: bold;">{{ $pending }}</div>
    </div>
    <div style="background: linear-gradient(135deg, rgba(0,255,158,0.1), rgba(0,255,158,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(0,255,158,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px;">Approved Today</div>
        <div style="color: #00ff9e; font-size: 36px; font-weight: bold;">{{ \App\Models\Booking::where('status', 'approved')->whereDate('updated_at', today())->count() }}</div>
    </div>
    <div style="background: linear-gradient(135deg, rgba(0,229,255,0.1), rgba(0,229,255,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(0,229,255,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px;">Active Rentals</div>
        <div style="color: #00e5ff; font-size: 36px; font-weight: bold;">{{ \App\Models\Booking::where('status', 'approved')->count() }}</div>
    </div>
</div>

<!-- Pending Bookings -->
<div style="background: #1e1e1e; padding: 30px; border-radius: 12px; border: 1px solid #333;">
    <h2 style="color: #00e5ff; margin-bottom: 25px; font-size: 24px;">Pending Approvals</h2>

    @if($toApprove->count() > 0)
    <div style="display: grid; gap: 20px;">
        @foreach($toApprove as $booking)
        <div style="background: #0b0b0b; padding: 25px; border-radius: 12px; border: 1px solid #333;">
            <div style="display: grid; grid-template-columns: 1fr auto; gap: 30px; align-items: start;">
                <div>
                    <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                        <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=150" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;">
                        <div>
                            <h3 style="color: #00e5ff; margin: 0 0 8px 0; font-size: 20px;">{{ $booking->car->name }}</h3>
                            <p style="color: #999; margin: 0 0 5px 0; font-size: 14px;">{{ $booking->car->brand }} • {{ $booking->car->type }}</p>
                            <p style="color: #00ff9e; margin: 0; font-size: 16px; font-weight: 600;">${{ number_format($booking->car->price_per_day, 0) }}/day</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; padding: 15px; background: rgba(0,229,255,0.05); border-radius: 8px;">
                        <div>
                            <div style="color: #666; font-size: 11px; margin-bottom: 3px;">CUSTOMER</div>
                            <div style="color: #fff; font-weight: 600;">{{ $booking->user->name }}</div>
                            <div style="color: #999; font-size: 12px;">{{ $booking->user->email }}</div>
                        </div>
                        <div>
                            <div style="color: #666; font-size: 11px; margin-bottom: 3px;">PICKUP DATE</div>
                            <div style="color: #fff; font-weight: 600;">{{ $booking->start_date->format('M d, Y') }}</div>
                        </div>
                        <div>
                            <div style="color: #666; font-size: 11px; margin-bottom: 3px;">RETURN DATE</div>
                            <div style="color: #fff; font-weight: 600;">{{ $booking->end_date->format('M d, Y') }}</div>
                        </div>
                        <div>
                            <div style="color: #666; font-size: 11px; margin-bottom: 3px;">DURATION</div>
                            <div style="color: #fff; font-weight: 600;">{{ $booking->start_date->diffInDays($booking->end_date) + 1 }} days</div>
                        </div>
                        <div>
                            <div style="color: #666; font-size: 11px; margin-bottom: 3px;">TOTAL PRICE</div>
                            <div style="color: #00ff9e; font-weight: 600; font-size: 18px;">${{ number_format($booking->total_price, 0) }}</div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px; min-width: 150px;">
                    <form method="POST" action="{{ route('employee.approve', $booking) }}">
                        @csrf
                        <input type="hidden" name="action" value="approve">
                        <button type="submit" class="btn" style="width: 100%; padding: 12px; background: linear-gradient(90deg, #00ff9e, #00e5ff);">
                            ✓ Approve
                        </button>
                    </form>
                    <form method="POST" action="{{ route('employee.approve', $booking) }}">
                        @csrf
                        <input type="hidden" name="action" value="cancel">
                        <button type="submit" class="btn" style="width: 100%; padding: 12px; background: linear-gradient(90deg, #ff0055, #ff4444);">
                            ✗ Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top: 20px;">
        {{ $toApprove->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 60px 20px;">
        <div style="font-size: 64px; margin-bottom: 20px;">✓</div>
        <h3 style="color: #00ff9e; margin-bottom: 10px;">All caught up!</h3>
        <p style="color: #999;">No pending bookings to review</p>
    </div>
    @endif
</div>
@endsection
