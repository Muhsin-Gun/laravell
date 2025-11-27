@extends('layouts.dashboard')

@section('title', 'Manage Cars')
@section('role-badge', 'Admin')
@section('page-title', 'Manage Cars')

@section('sidebar-menu')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('admin.cars.index') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 bg-cyan-500/10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
        </svg>
        Manage Cars
    </a>

    <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        Manage Users
    </a>

    <a href="{{ route('admin.blogs.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        Manage Blogs
    </a>

    <a href="{{ route('admin.reports') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        Reports
    </a>
@endsection

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-white">All Vehicles</h2>
        <a href="{{ route('admin.cars.create') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transition">
            + Add New Car
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-xl text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-900/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Brand</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Price/Day</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($cars as $car)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4">
                            <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-700">
                                @if($car->image_path)
                                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-2xl">🚗</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-white">{{ $car->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-300">{{ $car->brand }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-cyan-500/20 text-cyan-400 rounded-full text-xs font-medium">{{ $car->type }}</span>
                        </td>
                        <td class="px-6 py-4 text-cyan-400 font-semibold">KES {{ number_format($car->price_per_day, 0) }}</td>
                        <td class="px-6 py-4">
                            @if($car->available)
                                <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">Available</span>
                            @else
                                <span class="px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-xs font-medium">Unavailable</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/30 transition text-sm">Edit</a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this car?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition text-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-6xl mb-4">🚗</div>
                            <h3 class="text-lg font-medium text-gray-300 mb-2">No cars found</h3>
                            <p class="text-gray-500 mb-4">Start by adding your first vehicle to the fleet.</p>
                            <a href="{{ route('admin.cars.create') }}" class="px-4 py-2 bg-cyan-500/20 text-cyan-400 rounded-lg hover:bg-cyan-500/30 transition">Add First Car</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
