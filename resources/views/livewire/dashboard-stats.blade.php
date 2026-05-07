<div>
    <h1 class="page-title">Dashboard</h1>

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

    <div class="metric-card" style="margin-bottom:1.75rem">
        <div class="metric-label">Total Pendapatan</div>
        <div style="font-size:1.75rem;font-weight:600;color:var(--rinsa-green);font-family:'DM Serif Display',serif;margin-top:6px">
            Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
        </div>
    </div>

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
                    <th>ID</th><th>Pelanggan</th><th>Layanan</th><th>Status</th><th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr wire:key="dash-order-{{ $order->id }}">
                    <td>
                        <a href="{{ route('orders.show', $order) }}"
                           style="font-family:monospace;font-size:.78rem;color:var(--rinsa-gray);text-decoration:none">
                            {{ $order->order_code }}
                        </a>
                    </td>
                    <td>{{ $order->customer->name }}</td>
                    <td style="font-size:.8rem">{{ $order->service_label }}</td>
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
</div>
