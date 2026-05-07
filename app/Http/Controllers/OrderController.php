<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Table is handled by Livewire\OrderTable component
        return view('admin.orders.index');
    }

    public function create()
    {
        // Form is handled by Livewire\OrderForm component
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'    => ['required', 'exists:customers,id'],
            'weight_kg'      => ['required', 'numeric', 'min:0.5'],
            'service'        => ['required', 'in:cuci_kering,cuci_setrika,express'],
            'notes'          => ['nullable', 'string', 'max:500'],
            'estimated_done' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        $pricePerKg = Order::PRICE_MAP[$validated['service']];
        $total      = $validated['weight_kg'] * $pricePerKg;

        DB::transaction(function () use ($validated, $pricePerKg, $total) {
            $order = Order::create([
                'order_code'     => Order::generateCode(),
                'customer_id'    => $validated['customer_id'],
                'created_by'     => Auth::id(),
                'weight_kg'      => $validated['weight_kg'],
                'service'        => $validated['service'],
                'status'         => 'pending',
                'price_per_kg'   => $pricePerKg,
                'total_price'    => $total,
                'notes'          => $validated['notes'] ?? null,
                'estimated_done' => $validated['estimated_done'] ?? now()->addDay(),
            ]);

            OrderStatusLog::create([
                'order_id'   => $order->id,
                'changed_by' => Auth::id(),
                'old_status' => null,
                'new_status' => 'pending',
                'note'       => 'Order dibuat',
            ]);
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil ditambahkan.');
    }

    public function show(Order $order)
    {
        $order->load('customer', 'creator', 'statusLogs.changedBy');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // Form handled by Livewire\OrderForm component (receives $order via view)
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'weight_kg'      => ['required', 'numeric', 'min:0.5'],
            'service'        => ['required', 'in:cuci_kering,cuci_setrika,express'],
            'status'         => ['required', 'in:pending,washing,done,pickup'],
            'notes'          => ['nullable', 'string', 'max:500'],
            'estimated_done' => ['nullable', 'date'],
        ]);

        $pricePerKg = Order::PRICE_MAP[$validated['service']];
        $total      = $validated['weight_kg'] * $pricePerKg;
        $oldStatus  = $order->status;
        $newStatus  = $validated['status'];

        DB::transaction(function () use ($order, $validated, $pricePerKg, $total, $oldStatus, $newStatus) {
            $order->update([
                'weight_kg'      => $validated['weight_kg'],
                'service'        => $validated['service'],
                'status'         => $newStatus,
                'price_per_kg'   => $pricePerKg,
                'total_price'    => $total,
                'notes'          => $validated['notes'],
                'estimated_done' => $validated['estimated_done'],
                'picked_up_at'   => $newStatus === 'pickup' && $oldStatus !== 'pickup' ? now() : $order->picked_up_at,
            ]);

            if ($oldStatus !== $newStatus) {
                OrderStatusLog::create([
                    'order_id'   => $order->id,
                    'changed_by' => Auth::id(),
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ]);
            }
        });

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil dihapus.');
    }
}
