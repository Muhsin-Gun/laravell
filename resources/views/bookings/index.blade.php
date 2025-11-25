@extends('layouts.app')

@section('content')
<h1 style="color: #00e5ff; margin-bottom: 30px;">Your Bookings</h1>

@if($bookings->count() > 0)
<table>
    <thead>
        <tr>
            <th>Car</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->car->name }}</td>
            <td>{{ $booking->start_date->format('M d, Y') }}</td>
            <td>{{ $booking->end_date->format('M d, Y') }}</td>
            <td>
                <span style="padding: 5px 10px; border-radius: 4px;
                    @if($booking->status == 'pending') background: rgba(255,215,0,0.2); color: #ffd700;
                    @elseif($booking->status == 'approved') background: rgba(0,255,158,0.2); color: #00ff9e;
                    @elseif($booking->status == 'completed') background: rgba(0,229,255,0.2); color: #00e5ff;
                    @else background: rgba(255,0,85,0.2); color: #ff0055;
                    @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </td>
            <td>${{ number_format($booking->total_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p style="color: #999; text-align: center; padding: 40px;">No bookings yet. <a href="{{ route('cars.index') }}" style="color: #00e5ff;">Browse cars</a> to make your first booking!</p>
@endif
@endsection
