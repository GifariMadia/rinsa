<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isCustomer()) {
            // Find customer record by phone
            $customer = $user->customer;
            
            $orders = $customer ? $customer->orders()->latest()->get() : collect();
            
            return view('admin.customer_dashboard', compact('orders'));
        }

        $stats = [
            'total_orders'    => Order::count(),
            'pending'         => Order::where('status', 'pending')->count(),
            'washing'         => Order::where('status', 'washing')->count(),
            'done'            => Order::whereIn('status', ['done', 'pickup'])->count(),
            'total_revenue'   => Order::sum('total_price'),
            'total_customers' => Customer::count(),
            'avg_rating'      => Order::whereNotNull('rating')->avg('rating') ?: 0,
            'total_feedback'  => Order::whereNotNull('rating')->count(),
        ];

        $recentOrders = Order::with('customer')
            ->latest()
            ->limit(8)
            ->get();

        $latestFeedbacks = Order::with('customer')
            ->whereNotNull('rating')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'latestFeedbacks'));
    }

    public function feedback()
    {
        $feedbacks = Order::with('customer')
            ->whereNotNull('rating')
            ->latest()
            ->paginate(15);

        return view('admin.feedback', compact('feedbacks'));
    }

    public function submitFeedback(Request $request, Order $order)
    {
        $user = auth()->user();
        if (!$user->isCustomer() || !$user->customer || $order->customer_id !== $user->customer->id) {
            return abort(403, 'Unauthorized action.');
        }

        if (!in_array($order->status, ['done', 'pickup'])) {
            return back()->withErrors(['rating' => 'Anda hanya bisa memberi rating pada pesanan yang sudah selesai.']);
        }

        $validated = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        $order->update([
            'rating'   => $validated['rating'],
            'feedback' => $validated['feedback'],
        ]);

        return back()->with('success', 'Terima kasih atas penilaian dan feedback Anda!');
    }
}
