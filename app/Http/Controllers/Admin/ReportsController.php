<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');

        $startDate = match($period) {
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear(),
            'all' => Carbon::createFromDate(2020, 1, 1),
            default => Carbon::now()->subMonth(),
        };

        $payments = Payment::with(['order.car', 'order.user'])
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total_revenue' => $payments->where('status', 'completed')->sum('amount'),
            'pending_payments' => $payments->where('status', 'pending')->sum('amount'),
            'failed_payments' => $payments->where('status', 'failed')->sum('amount'),
            'total_transactions' => $payments->count(),
            'successful_transactions' => $payments->where('status', 'completed')->count(),
            'average_transaction' => $payments->where('status', 'completed')->avg('amount') ?? 0,
        ];

        $revenueByDay = Payment::where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $topCars = Car::withCount(['bookings' => function($q) use ($startDate) {
                $q->where('created_at', '>=', $startDate);
            }])
            ->withSum(['bookings as revenue' => function($q) use ($startDate) {
                $q->where('created_at', '>=', $startDate);
            }], 'total_price')
            ->orderByDesc('revenue')
            ->take(5)
            ->get();

        return view('Admin.reports', compact('payments', 'stats', 'revenueByDay', 'topCars', 'period'));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'month');

        $startDate = match($period) {
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear(),
            'all' => Carbon::createFromDate(2020, 1, 1),
            default => Carbon::now()->subMonth(),
        };

        $payments = Payment::with(['order.car', 'order.user'])
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $csv = "Transaction ID,Date,Customer,Car,Amount (KES),Status,Payment Method\n";

        foreach ($payments as $payment) {
            $csv .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s\n",
                $payment->transaction_id ?? 'N/A',
                $payment->created_at->format('Y-m-d H:i:s'),
                $payment->order?->user?->name ?? 'Unknown',
                $payment->order?->car?->name ?? 'Unknown',
                number_format($payment->amount, 2),
                ucfirst($payment->status),
                $payment->payment_method ?? 'M-Pesa'
            );
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="revenue-report-' . now()->format('Y-m-d') . '.csv"');
    }
}
