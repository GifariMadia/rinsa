<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function deleteCustomer(int $id): void
    {
        $customer = Customer::findOrFail($id);

        if ($customer->orders()->whereNotIn('status', ['pickup'])->exists()) {
            session()->flash('error', 'Tidak bisa hapus pelanggan yang masih punya order aktif.');
            return;
        }

        $customer->delete();
        session()->flash('success', "Pelanggan {$customer->name} berhasil dihapus.");
    }

    public function render()
    {
        $customers = Customer::withCount('orders')
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.customer-table', compact('customers'));
    }
}
