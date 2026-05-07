<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending'         => Order::where('status', 'pending')->count(),
            'washing'         => Order::where('status', 'washing')->count(),
            'done'            => Order::whereIn('status', ['done', 'pickup'])->count(),
            'total_revenue'   => Order::sum('total_price'),
            'total_customers' => Customer::count(),
        ];

        $recentOrders = Order::with('customer')
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
