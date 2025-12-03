@extends('layouts.dashboard')

@section('title', 'Manage Cars')
@section('page-title', 'Manage Cars')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <h2 style="color: #00e5ff; margin: 0;">Fleet Management</h2>
    <a href="{{ route('admin.cars.create') }}" class="btn" style="padding: 12px 30px;">+ Add New Car</a>
</div>

@if(session('success'))
    <div style="background: rgba(0,255,158,0.1); border: 1px solid rgba(0,255,158,0.3); color: #00ff9e; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #0a0a0a; border-bottom: 1px solid #333;">
                <th style="padding: 15px; text-align: left; color: #999;">Car Name</th>
                <th style="padding: 15px; text-align: left; color: #999;">Brand</th>
                <th style="padding: 15px; text-align: left; color: #999;">Type</th>
                <th style="padding: 15px; text-align: left; color: #999;">Price/Day</th>
                <th style="padding: 15px; text-align: left; color: #999;">Available</th>
                <th style="padding: 15px; text-align: left; color: #999;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
            <tr style="border-bottom: 1px solid #222;">
                <td style="padding: 15px;">{{ $car->name }}</td>
                <td style="padding: 15px;">{{ $car->brand }}</td>
                <td style="padding: 15px;">
                    <span style="background: rgba(0,229,255,0.15); color: #00e5ff; padding: 4px 12px; border-radius: 4px; font-size: 12px;">
                        {{ $car->type }}
                    </span>
                </td>
                <td style="padding: 15px;">KSH {{ number_format($car->price_per_day, 0) }}</td>
                <td style="padding: 15px;">
                    @if($car->available)
                        <span style="color: #00ff9e; font-weight: bold;">✓ Available</span>
                    @else
                        <span style="color: #ff0055; font-weight: bold;">⚠ Booked</span>
                    @endif
                </td>
                <td style="padding: 15px;">
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.cars.edit', $car) }}" style="color: #00e5ff; text-decoration: none; font-size: 14px;">Edit</a>
                        <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ff0055; cursor: pointer; text-decoration: none; font-size: 14px;" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: #666;">
                    No cars found. <a href="{{ route('admin.cars.create') }}" style="color: #00e5ff;">Add one now</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
