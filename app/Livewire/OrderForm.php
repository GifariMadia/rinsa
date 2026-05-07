<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderStatusLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderForm extends Component
{
    // Form fields
    public int    $customerId   = 0;
    public float  $weightKg     = 0;
    public string $service      = 'cuci_kering';
    public string $status       = 'pending';
    public string $notes        = '';
    public string $estimatedDone = '';

    // Editing context
    public ?int $orderId = null;

    // Computed display
    public float  $totalPrice   = 0;
    public string $pricePerKg   = '0';

    protected function rules(): array
    {
        return [
            'customerId'    => ['required', 'exists:customers,id'],
            'weightKg'      => ['required', 'numeric', 'min:0.5'],
            'service'       => ['required', 'in:cuci_kering,cuci_setrika,express'],
            'status'        => ['required', 'in:pending,washing,done,pickup'],
            'notes'         => ['nullable', 'string', 'max:500'],
            'estimatedDone' => ['nullable', 'date'],
        ];
    }

    public function mount(?int $orderId = null): void
    {
        $this->orderId      = $orderId;
        $this->estimatedDone = now()->addDay()->format('Y-m-d');

        if ($orderId) {
            $order = Order::findOrFail($orderId);
            $this->customerId    = $order->customer_id;
            $this->weightKg      = (float) $order->weight_kg;
            $this->service       = $order->service;
            $this->status        = $order->status;
            $this->notes         = $order->notes ?? '';
            $this->estimatedDone = $order->estimated_done?->format('Y-m-d') ?? '';
        }

        $this->recalculate();
    }

    // Reactive: recalculate whenever weight or service changes
    public function updatedWeightKg(): void  { $this->recalculate(); }
    public function updatedService(): void   { $this->recalculate(); }

    private function recalculate(): void
    {
        $price            = Order::PRICE_MAP[$this->service] ?? 0;
        $this->pricePerKg = number_format($price, 0, ',', '.');
        $this->totalPrice = (float) $this->weightKg * $price;
    }

    public function save()
    {
        $this->validate();

        $pricePerKg = Order::PRICE_MAP[$this->service];
        $total      = $this->weightKg * $pricePerKg;

        DB::transaction(function () use ($pricePerKg, $total) {
            if ($this->orderId) {
                // UPDATE
                $order     = Order::findOrFail($this->orderId);
                $oldStatus = $order->status;

                $order->update([
                    'customer_id'    => $this->customerId,
                    'weight_kg'      => $this->weightKg,
                    'service'        => $this->service,
                    'status'         => $this->status,
                    'price_per_kg'   => $pricePerKg,
                    'total_price'    => $total,
                    'notes'          => $this->notes ?: null,
                    'estimated_done' => $this->estimatedDone ?: null,
                    'picked_up_at'   => $this->status === 'pickup' && $oldStatus !== 'pickup'
                                         ? now() : $order->picked_up_at,
                ]);

                if ($oldStatus !== $this->status) {
                    OrderStatusLog::create([
                        'order_id'   => $order->id,
                        'changed_by' => Auth::id(),
                        'old_status' => $oldStatus,
                        'new_status' => $this->status,
                    ]);
                }
            } else {
                // CREATE
                $order = Order::create([
                    'order_code'     => Order::generateCode(),
                    'customer_id'    => $this->customerId,
                    'created_by'     => Auth::id(),
                    'weight_kg'      => $this->weightKg,
                    'service'        => $this->service,
                    'status'         => 'pending',
                    'price_per_kg'   => $pricePerKg,
                    'total_price'    => $total,
                    'notes'          => $this->notes ?: null,
                    'estimated_done' => $this->estimatedDone ?: now()->addDay(),
                ]);

                OrderStatusLog::create([
                    'order_id'   => $order->id,
                    'changed_by' => Auth::id(),
                    'old_status' => null,
                    'new_status' => 'pending',
                    'note'       => 'Order dibuat',
                ]);
            }
        });

        session()->flash('success', $this->orderId
            ? 'Order berhasil diperbarui.'
            : 'Order baru berhasil ditambahkan.'
        );

        return $this->redirect(route('orders.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.order-form', [
            'customers' => Customer::orderBy('name')->get(),
            'services'  => Order::SERVICE_LABELS,
            'statuses'  => Order::STATUS_LABELS,
            'priceMap'  => Order::PRICE_MAP,
            'isEditing' => (bool) $this->orderId,
        ]);
    }
}
