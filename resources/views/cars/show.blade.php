@extends('layouts.app')

@section('content')
<div style="display:flex; gap: 40px; flex-wrap:wrap;">
    <div style="flex:1; min-width:400px;">
        <img src="{{ $car->image_path ? asset('storage/' . $car->image_path) : 'https://source.unsplash.com/800x600/?car' }}" alt="{{ $car->name }}" style="width:100%; height:auto; border:1px solid #333; border-radius: 8px;">
    </div>
    <div style="flex:1; min-width:400px;">
        <h1 style="color: #00e5ff; margin-bottom: 10px;">{{ $car->name }}</h1>
        <p style="color: #999; font-size: 18px; margin-bottom: 20px;">{{ $car->brand }} • {{ $car->type }}</p>
        <p style="color: #00ff9e; font-size: 32px; font-weight: bold; margin-bottom: 20px;">${{ $car->price_per_day }} / day</p>
        <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px;">{{ $car->description ?? 'No description available.' }}</p>

        @auth
        <div style="background: #1e1e1e; padding: 25px; border-radius: 8px; border: 1px solid #333;">
            <h3 style="color: #00e5ff; margin-bottom: 20px;">Book This Car</h3>
            <form method="POST" action="{{ route('cars.book', $car) }}">
                @csrf
                <label style="display: block; margin-bottom: 15px;">
                    <span style="display: block; margin-bottom: 5px; color: #999;">Start Date</span>
                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}">
                </label>
                <label style="display: block; margin-bottom: 20px;">
                    <span style="display: block; margin-bottom: 5px; color: #999;">End Date</span>
                    <input type="date" name="end_date" required min="{{ date('Y-m-d') }}">
                </label>
                <button type="submit" class="btn" style="width: 100%; font-size: 18px;">Book Now</button>
            </form>
        </div>
        @else
        <div style="background: #1e1e1e; padding: 25px; border-radius: 8px; border: 1px solid #333; text-align: center;">
            <p style="color: #999; margin-bottom: 15px;">Please login to book this car</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
        @endauth
    </div>
</div>
@endsection
