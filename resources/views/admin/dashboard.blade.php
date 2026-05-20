{{-- Dashboard now powered by Livewire DashboardStats (auto-refreshes every 30s) --}}
@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h1 class="page-title">Dashboard</h1>

{{-- Metric Cards --}}
<div class="metric-grid">
    <div class="metric-card metric-accent">
        <div class="metric-val">{{ $stats['total_orders'] }}</div>
        <div class="metric-label">Total Order</div>
    </div>
    <div class="metric-card">
        <div class="metric-val" style="color:var(--rinsa-warn)">{{ $stats['pending'] }}</div>
        <div class="metric-label">Menunggu</div>
    </div>
    <div class="metric-card">
        <div class="metric-val" style="color:var(--rinsa-blue)">{{ $stats['washing'] }}</div>
        <div class="metric-label">Dicuci</div>
    </div>
    <div class="metric-card metric-accent-gold">
        <div class="metric-val">{{ $stats['done'] }}</div>
        <div class="metric-label">Selesai</div>
    </div>
</div>

{{-- Revenue --}}
<div class="metric-card" style="margin-bottom:1.75rem">
    <div class="metric-label">Total Pendapatan</div>
    <div style="font-size:1.75rem;font-weight:600;color:var(--rinsa-green);font-family:'DM Serif Display',serif;margin-top:6px">
        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
    </div>
</div>

{{-- History & Rating Panel --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
    <div class="section-title" style="margin:0">History & Rating Terbaru</div>
    <a href="{{ route('orders.index') }}" style="font-size:.8rem;color:var(--rinsa-green);font-weight:600;text-decoration:none">
        Lihat semua →
    </a>
</div>

<div class="form-card" style="padding: 1.25rem; margin-bottom: 2rem; border-left: 4px solid var(--rinsa-gold)">
    <div style="display:flex; flex-direction:column; gap:1rem">
        @forelse($latestFeedbacks as $f)
        <div style="display:flex; justify-content:space-between; align-items:flex-start; padding-bottom: 0.75rem; border-bottom: 1px solid var(--rinsa-border-light)">
            <div>
                <div style="font-weight:700; font-size:.85rem">{{ $f->customer->name }}</div>
                <div style="color:var(--rinsa-gold); font-size:.9rem; margin: 2px 0">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $f->rating ? '★' : '☆' }}
                    @endfor
                </div>
                <div style="font-size:.8rem; color:var(--rinsa-gray); font-style:italic">
                    "{{ Str::limit($f->feedback ?? $f->complaint ?? 'Tanpa komentar', 60) }}"
                </div>
            </div>
            <div style="text-align:right; font-size:.7rem; color:var(--rinsa-gray-light)">
                {{ $f->updated_at->diffForHumans() }}
                <br>
                <a href="{{ route('orders.show', $f) }}" style="color:var(--rinsa-green); text-decoration:none; font-weight:600">Detail</a>
            </div>
        </div>
        @empty
        <div style="text-align:center; color:var(--rinsa-gray); font-size:.85rem; padding: 1rem">
            Belum ada feedback terbaru.
        </div>
        @endforelse
    </div>
</div>

{{-- Recent Orders --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
    <div class="section-title" style="margin:0">Order Terbaru</div>
    <a href="{{ route('orders.index') }}" style="font-size:.8rem;color:var(--rinsa-green);font-weight:600;text-decoration:none">
        Lihat semua →
    </a>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
            <tr>
                <td>
                    <a href="{{ route('orders.show', $order) }}"
                       style="font-family:monospace;font-size:.78rem;color:var(--rinsa-gray);text-decoration:none;hover:color:var(--rinsa-green)">
                        {{ $order->order_code }}
                    </a>
                </td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->service_label }}</td>
                <td><span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span></td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">
                    Belum ada order.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
