@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Here's what's happening with your bookings today</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm font-medium">Total Orders</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm font-medium">Pending</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm font-medium">Completed</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['completed_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Spent -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm font-medium">Total Spent</h3>
                    <p class="text-2xl font-semibold text-gray-800">Ksh {{ number_format($stats['total_spent'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($recent_orders as $order)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                            @if($order->car && $order->car->images->first())
                                <img src="{{ asset('storage/' . $order->car->images->first()->image_path) }}" alt="{{ $order->car->make }} {{ $order->car->model }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $order->car ? $order->car->make . ' ' . $order->car->model : 'Car not available' }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 mt-1">
                                <span>Order #{{ $order->id }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $order->start_date->format('M d, Y') }} - {{ $order->end_date->format('M d, Y') }}</span>
                            </div>
                            <div class="mt-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                @if($order->payment)
                                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($order->payment->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-lg font-semibold text-gray-900">Ksh {{ number_format($order->total_price, 2) }}</p>
                        <div class="mt-2">
                            @if($order->status === 'pending' && (!$order->payment || $order->payment->status !== 'completed'))
                                <form action="{{ route('payment.mpesa.initialize') }}" method="POST" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $order->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Pay with M-Pesa
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('bookings.show', $order->id) }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-500">
                <p>No recent orders found.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('cars.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Book a Car</h3>
                <p class="mt-1 text-sm text-gray-500">Find and book your next ride</p>
            </div>
        </a>

        <a href="{{ route('bookings.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">My Bookings</h3>
                <p class="mt-1 text-sm text-gray-500">View all your bookings</p>
            </div>
        </a>

        <a href="{{ route('profile.show') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Profile Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Update your profile information</p>
            </div>
        </a>
    </div>
</div>
@endsection
