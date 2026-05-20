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
    public $customerId   = 0;
    public $weightKg     = 0;
    public $service      = 'cuci_kering';
    public $status       = 'pending';
    public $notes        = '';
    public $estimatedDone = '';
    public $deliveryOption = 'pickup';

    // Editing context
    public ?int $orderId = null;

    // Computed display
    public $totalPrice   = 0;
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
            'deliveryOption'=> ['required', 'in:pickup,delivery'],
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
            $this->deliveryOption = $order->delivery_option ?? 'pickup';
        }

        $this->recalculate();
    }

    // Reactive: recalculate whenever weight or service changes
    public function updatedWeightKg(): void  { $this->recalculate(); }
    public function updatedService(): void   { $this->recalculate(); }

    private function recalculate(): void
    {
        $weight = is_numeric($this->weightKg) ? (float) $this->weightKg : 0;
        $price            = Order::PRICE_MAP[$this->service] ?? 0;
        $this->pricePerKg = number_format($price, 0, ',', '.');
        $this->totalPrice = $weight * $price;
    }

    public function save()
    {
        $this->validate();

        $weight = (float) $this->weightKg;
        $pricePerKg = Order::PRICE_MAP[$this->service];
        $total      = $weight * $pricePerKg;

        DB::transaction(function () use ($pricePerKg, $total, $weight) {
            if ($this->orderId) {
                // UPDATE
                $order     = Order::findOrFail($this->orderId);
                $oldStatus = $order->status;

                $order->update([
                    'customer_id'    => $this->customerId,
                    'weight_kg'      => $weight,
                    'service'        => $this->service,
                    'status'         => $this->status,
                    'price_per_kg'   => $pricePerKg,
                    'total_price'    => $total,
                    'notes'          => $this->notes ?: null,
                    'estimated_done' => $this->estimatedDone ?: null,
                    'delivery_option' => $this->deliveryOption,
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
                    'weight_kg'      => $weight,
                    'service'        => $this->service,
                    'status'         => 'pending',
                    'price_per_kg'   => $pricePerKg,
                    'total_price'    => $total,
                    'notes'          => $this->notes ?: null,
                    'estimated_done' => $this->estimatedDone ?: now()->addDay(),
                    'delivery_option' => $this->deliveryOption,
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
