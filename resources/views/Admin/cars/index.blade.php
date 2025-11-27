@extends('Admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #00e5ff;">Manage Cars</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn">Add New Car</a>
</div>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Price/Day</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cars as $car)
        <tr>
            <td>
                @if($car->image_path)
                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                @else
                    <div style="width: 60px; height: 40px; background: rgba(0,229,255,0.1); border-radius: 4px; display: flex; align-items: center; justify-content: center;">🚗</div>
                @endif
            </td>
            <td>{{ $car->name }}</td>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->type }}</td>
            <td>${{ number_format($car->price_per_day, 0) }}</td>
            <td>
                <span style="color: {{ $car->available ? '#00ff9e' : '#ff0055' }};">
                    {{ $car->available ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.cars.edit', $car) }}" style="color: #00e5ff; margin-right: 10px;">Edit</a>
                <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ff0055; cursor: pointer;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center; padding: 40px; color: #666;">
                No cars found. <a href="{{ route('admin.cars.create') }}" style="color: #00e5ff;">Add your first car</a>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
