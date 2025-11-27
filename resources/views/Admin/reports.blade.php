@extends('layouts.dashboard')

@section('title', 'Revenue Reports')
@section('role-badge', 'Administrator')
@section('page-title', 'Revenue Reports')

@section('sidebar-menu')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('admin.cars.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
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
        Blog Posts
    </a>

    <a href="{{ route('admin.reports') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Reports
    </a>

    <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Settings
    </a>
@endsection

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <form action="{{ route('admin.reports') }}" method="GET" class="flex items-center gap-4">
            <select name="period" onchange="this.form.submit()" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Last 30 Days</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Last Year</option>
                <option value="all" {{ $period == 'all' ? 'selected' : '' }}>All Time</option>
            </select>
        </form>
        
        <a href="{{ route('admin.reports.export', ['period' => $period]) }}" class="flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export CSV
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="stat-card bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-white">KES {{ number_format($stats['total_revenue'], 0) }}</h3>
                    <p class="text-sm text-green-400 mt-2">{{ $stats['successful_transactions'] }} transactions</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-yellow-500/10 to-orange-500/10 border border-yellow-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Pending Payments</p>
                    <h3 class="text-3xl font-bold text-white">KES {{ number_format($stats['pending_payments'], 0) }}</h3>
                    <p class="text-sm text-yellow-400 mt-2">Awaiting confirmation</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Average Transaction</p>
                    <h3 class="text-3xl font-bold text-white">KES {{ number_format($stats['average_transaction'], 0) }}</h3>
                    <p class="text-sm text-cyan-400 mt-2">Per payment</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Revenue Trend</h3>
            @if($revenueByDay->count() > 0)
                <div class="space-y-4">
                    @foreach($revenueByDay->take(10) as $day)
                        <div class="flex items-center gap-4">
                            <span class="text-gray-400 text-sm w-24">{{ \Carbon\Carbon::parse($day->date)->format('M d') }}</span>
                            <div class="flex-1 h-8 bg-gray-700 rounded-lg overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-500 to-green-500 rounded-lg" style="width: {{ min(100, ($day->total / max(1, $revenueByDay->max('total'))) * 100) }}%"></div>
                            </div>
                            <span class="text-white font-medium w-32 text-right">KES {{ number_format($day->total, 0) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No revenue data available for this period.</p>
            @endif
        </div>

        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Top Rented Cars</h3>
            @if($topCars->count() > 0)
                <div class="space-y-4">
                    @foreach($topCars as $car)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-gray-700 overflow-hidden flex-shrink-0">
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-medium truncate">{{ $car->name }}</p>
                                <p class="text-gray-400 text-sm">{{ $car->bookings_count }} bookings</p>
                            </div>
                            <span class="text-cyan-400 font-medium">KES {{ number_format($car->revenue ?? 0, 0) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No booking data available for this period.</p>
            @endif
        </div>
    </div>

    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <h3 class="text-xl font-bold text-white">Recent Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Transaction ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Car</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($payments->take(10) as $payment)
                        <tr class="hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-white font-mono text-sm">{{ $payment->transaction_id ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-white">{{ $payment->booking->user->name ?? 'Unknown' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-300">{{ $payment->booking->car->name ?? 'Unknown' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-white font-medium">KES {{ number_format($payment->amount, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($payment->status == 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-500/20 text-green-400">
                                        Completed
                                    </span>
                                @elseif($payment->status == 'pending')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-500/20 text-yellow-400">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-500/20 text-red-400">
                                        Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400">
                                {{ $payment->created_at->format('M d, Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                No transactions found for this period.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
