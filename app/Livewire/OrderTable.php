<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $sortBy = 'created_at';
    public string $sortDir = 'desc';

    // Reset pagination when filters change
    public function updatingSearch(): void    { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }

    public function sortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy  = $column;
            $this->sortDir = 'asc';
        }
    }

    public function deleteOrder(int $id): void
    {
        $order = Order::findOrFail($id);
        $order->delete();
        session()->flash('success', "Order {$order->order_code} berhasil dihapus.");
    }

    public function render()
    {
        $orders = Order::with('customer')
            ->when($this->search, function ($q) {
                $q->where('order_code', 'like', "%{$this->search}%")
                  ->orWhereHas('customer', fn($q) =>
                      $q->where('name', 'like', "%{$this->search}%")
                  );
            })
            ->when($this->statusFilter, fn($q) =>
                $q->where('status', $this->statusFilter)
            )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(15);

        return view('livewire.order-table', [
            'orders'       => $orders,
            'statusLabels' => Order::STATUS_LABELS,
        ]);
    }
}
