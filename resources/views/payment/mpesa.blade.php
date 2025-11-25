@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 60px auto; background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
    <h1 style="color: #00e5ff; text-align: center; margin-bottom: 30px;">Complete Payment</h1>

    <div style="background: #0b0b0b; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <p style="color: #999; margin-bottom: 10px;">Booking ID: <span style="color: #fff;">#{{ $booking->id }}</span></p>
        <p style="color: #999; margin-bottom: 10px;">Car: <span style="color: #fff;">{{ $booking->car->name }}</span></p>
        <p style="color: #999; margin-bottom: 10px;">Period: <span style="color: #fff;">{{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}</span></p>
        <hr style="border-color: #333; margin: 20px 0;">
        <p style="color: #00ff9e; font-size: 24px; font-weight: bold;">Total: ${{ number_format($booking->total_price, 2) }}</p>
    </div>

    <div style="text-align: center;">
        <p style="color: #999; margin-bottom: 20px;">Pay via M-PESA to complete your booking</p>
        <form method="POST" action="{{ route('payment.mpesa.initialize') }}">
            @csrf
            <input type="hidden" name="booking" value="{{ $booking->id }}">
            <button type="submit" class="btn" style="width: 100%; font-size: 18px;">Pay with M-PESA</button>
        </form>
    </div>
</div>
@endsection
