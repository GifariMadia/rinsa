@extends('layouts.app')
@section('title', 'Detail Order')

@section('content')
<div style="max-width:680px">
    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
        <a href="{{ route('orders.index') }}" style="color:var(--rinsa-gray);text-decoration:none;font-size:.85rem">← Semua Order</a>
        <h1 class="page-title" style="margin:0">Detail Order</h1>
    </div>

    {{-- Header Card --}}
    <div class="form-card" style="margin-bottom:1rem">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem">
            <div>
                <div style="font-family:monospace;font-size:.8rem;color:var(--rinsa-gray);margin-bottom:.25rem">
                    {{ $order->order_code }}
                </div>
                <div style="font-size:1.1rem;font-weight:600">{{ $order->customer->name }}</div>
                <div style="font-size:.82rem;color:var(--rinsa-gray);margin-top:2px">
                    {{ $order->customer->phone }} · {{ $order->customer->address }}
                </div>
            </div>
            <span class="badge badge-{{ $order->status }}" style="font-size:.82rem;padding:5px 14px">
                {{ $order->status_label }}
            </span>
        </div>

        <div style="border-top:1px solid var(--rinsa-border);margin-top:1.25rem;padding-top:1.25rem">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:1rem">
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Layanan</div>
                    <div style="font-weight:600;font-size:.9rem">{{ $order->service_label }}</div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Berat</div>
                    <div style="font-weight:600;font-size:.9rem">{{ $order->weight_kg }} kg</div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Harga/kg</div>
                    <div style="font-weight:600;font-size:.9rem">Rp {{ number_format($order->price_per_kg, 0, ',', '.') }}</div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Total</div>
                    <div style="font-weight:600;font-size:.9rem;color:var(--rinsa-green)">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Est. Selesai</div>
                    <div style="font-weight:600;font-size:.9rem">
                        {{ $order->estimated_done?->format('d M Y') ?? '—' }}
                    </div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--rinsa-gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Masuk</div>
                    <div style="font-weight:600;font-size:.9rem">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
            @if($order->notes)
            <div style="margin-top:1rem;padding:.75rem 1rem;background:var(--rinsa-cream);border-radius:7px;font-size:.82rem;color:var(--rinsa-gray)">
                <strong style="color:var(--rinsa-dark)">Catatan:</strong> {{ $order->notes }}
            </div>
            @endif
        </div>
    </div>
    
    @if($order->rating)
    {{-- Feedback Card --}}
    <div class="form-card" style="margin-bottom:1rem; border-left: 4px solid var(--rinsa-gold)">
        <div class="section-title" style="margin-bottom:.75rem">Feedback Pelanggan</div>
        <div style="display:flex; flex-direction:column; gap:0.5rem">
            <div style="color:var(--rinsa-gold); font-size:1.1rem; letter-spacing:1px">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $order->rating ? '★' : '☆' }}
                @endfor
            </div>
            @if($order->feedback)
            <div style="font-size:.9rem; color:var(--rinsa-dark)">
                <strong style="color:var(--rinsa-gray); font-size:.7rem; text-transform:uppercase; display:block; margin-bottom:2px">Feedback:</strong>
                {{ $order->feedback }}
            </div>
            @endif
            @if($order->complaint)
            <div style="font-size:.9rem; color:var(--rinsa-red); background: #FEF2F2; padding: 10px; border-radius: 8px; margin-top: 5px">
                <strong style="color:var(--rinsa-red); font-size:.7rem; text-transform:uppercase; display:block; margin-bottom:2px">Komplain:</strong>
                {{ $order->complaint }}
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Status Timeline --}}
    <div class="form-card" style="margin-bottom:1rem">
        <div class="section-title" style="margin-bottom:1rem">Riwayat Status</div>
        @php
            $statusFlow  = \App\Models\Order::STATUS_FLOW;
            $statusLabels = \App\Models\Order::STATUS_LABELS;
            $curIdx = array_search($order->status, $statusFlow);
        @endphp
        <div class="status-timeline">
            @foreach($statusFlow as $i => $status)
                @php
                    $log = $order->statusLogs->firstWhere('new_status', $status);
                    $state = $i < $curIdx ? 'done' : ($i === $curIdx ? 'active' : 'pending');
                @endphp
                <div class="status-step" style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; position: relative;">
                    <div class="step-dot {{ $state }}" style="width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0; margin-top: 2px; border: 3px solid #fff; z-index: 2; background: {{ $state === 'done' ? 'var(--rinsa-green)' : ($state === 'active' ? 'var(--rinsa-gold)' : '#e5e7eb') }}; box-shadow: 0 0 0 2px {{ $state === 'done' ? 'var(--rinsa-green)' : ($state === 'active' ? 'var(--rinsa-gold)' : '#e5e7eb') }};"></div>
                    @if(!$loop->last)
                        <div class="step-line" style="position: absolute; left: 9px; top: 22px; bottom: -1.5rem; width: 2px; background: #e5e7eb; z-index: 1;"></div>
                    @endif
                    <div class="step-content" style="flex: 1;">
                        <div class="step-label" style="font-size: 1rem; font-weight: 700; color: {{ $state === 'pending' ? 'var(--rinsa-gray)' : 'var(--rinsa-dark)' }}">
                            {{ $statusLabels[$status] }}
                        </div>
                        @if($log)
                        <div class="step-time" style="font-size: .8rem; color: var(--rinsa-gray); margin-top: 4px;">
                            {{ $log->changed_at->format('d M Y, H:i') }}
                            · oleh {{ $log->changedBy->name }}
                        </div>
                        @else
                        <div class="step-time" style="font-size: .8rem; color: var(--rinsa-gray); margin-top: 4px;">—</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Actions --}}
    <div style="display:flex;gap:.75rem">
        <a href="{{ route('orders.edit', $order) }}" class="btn-save">Edit Order</a>
        <form method="POST" action="{{ route('orders.destroy', $order) }}"
              onsubmit="return confirm('Hapus order ini secara permanen?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-secondary" style="border-color:#FCA5A5;color:var(--rinsa-red)">
                Hapus Order
            </button>
        </form>
    </div>
</div>
@endsection
