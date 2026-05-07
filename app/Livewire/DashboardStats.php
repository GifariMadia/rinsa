<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Polling;

#[Polling('30s')]
class DashboardStats extends Component
{
    public function render()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending'         => Order::where('status', 'pending')->count(),
            'washing'         => Order::where('status', 'washing')->count(),
            'done'            => Order::whereIn('status', ['done', 'pickup'])->count(),
            'total_revenue'   => Order::sum('total_price'),
            'total_customers' => Customer::count(),
        ];

        $recentOrders = Order::with('customer')->latest()->limit(8)->get();

        return view('livewire.dashboard-stats', compact('stats', 'recentOrders'));
    }
}
