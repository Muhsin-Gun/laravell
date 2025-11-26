@extends('layouts.dashboard')

@section('title', 'Employee Dashboard')
@section('role-badge', 'Employee')
@section('page-title', 'Employee Dashboard')

@section('sidebar-menu')
    <a href="{{ route('employee.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('employee.bookings.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        Manage Bookings
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 border border-yellow-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Pending Approvals</p>
                    <h3 class="text-3xl font-bold text-white">{{ $stats['pending'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Active Bookings</p>
                    <h3 class="text-3xl font-bold text-white">{{ $stats['active'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500/10 to-cyan-500/10 border border-blue-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Completed</p>
                    <h3 class="text-3xl font-bold text-white">{{ $stats['completed'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Pending Booking Requests</h2>
        </div>
        
        @if($pendingBookings->count() > 0)
            <div class="divide-y divide-slate-700">
                @foreach($pendingBookings as $booking)
                    <div class="p-6 hover:bg-slate-700/30 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                                    <span class="text-2xl">🚗</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $booking->car->name ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-400">
                                        {{ $booking->user->name ?? 'N/A' }} - 
                                        {{ $booking->start_date ? \Carbon\Carbon::parse($booking->start_date)->format('M d') : 'N/A' }} to 
                                        {{ $booking->end_date ? \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-lg font-bold text-cyan-400">KES {{ number_format($booking->total_price ?? 0, 0) }}</span>
                                <div class="flex gap-2">
                                    <form action="{{ route('employee.bookings.approve', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-500/20 text-green-400 rounded-lg hover:bg-green-500/30 transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('employee.bookings.reject', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="px-6 py-4 border-t border-slate-700">
                {{ $pendingBookings->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="text-6xl mb-4">✅</div>
                <h3 class="text-lg font-medium text-gray-300 mb-2">All caught up!</h3>
                <p class="text-gray-500">No pending bookings to review at the moment.</p>
            </div>
        @endif
    </div>
@endsection
