<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'all'); // all | today | week | month

        $query = Order::query();

        $query = match($period) {
            'today' => $query->whereDate('created_at', today()),
            'week'  => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'month' => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year),
            default => $query,
        };

        $stats = [
            'total_revenue'   => (clone $query)->sum('total_price'),
            'total_orders'    => (clone $query)->count(),
            'total_weight'    => (clone $query)->sum('weight_kg'),
            'total_customers' => Customer::count(),
            'done_orders'     => (clone $query)->whereIn('status', ['done', 'pickup'])->count(),
        ];

        // Distribution by service
        $byService = (clone $query)
            ->select('service', DB::raw('count(*) as total'), DB::raw('sum(total_price) as revenue'))
            ->groupBy('service')
            ->get();

        // Daily revenue for chart (last 7 days)
        $dailyRevenue = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.report', compact('stats', 'byService', 'dailyRevenue', 'period'));
    }
}
