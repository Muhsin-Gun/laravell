@extends('Admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #00e5ff;">Manage Cars</h1>
    <a href="{{ route('cars.create') }}" class="btn">Add New Car</a>
</div>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Price/Day</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cars as $car)
        <tr>
            <td>{{ $car->name }}</td>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->type }}</td>
            <td>${{ $car->price_per_day }}</td>
            <td>
                <span style="color: {{ $car->available ? '#00ff9e' : '#ff0055' }};">
                    {{ $car->available ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <a href="{{ route('cars.edit', $car) }}" style="color: #00e5ff; margin-right: 10px;">Edit</a>
                <form method="POST" action="{{ route('cars.destroy', $car) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ff0055; cursor: pointer;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
