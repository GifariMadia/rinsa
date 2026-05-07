@extends('layouts.app')
@section('title', 'Laporan')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem">
    <h1 class="page-title" style="margin:0">Laporan</h1>
    <form method="GET" style="display:flex;gap:.5rem">
        @foreach(['all' => 'Semua Waktu', 'today' => 'Hari Ini', 'week' => 'Minggu Ini', 'month' => 'Bulan Ini'] as $val => $label)
            <button type="submit" name="period" value="{{ $val }}"
                    style="padding:6px 14px;border-radius:6px;font-size:.78rem;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;border:1.5px solid {{ $period === $val ? 'var(--rinsa-green)' : 'var(--rinsa-border)' }};background:{{ $period === $val ? 'var(--rinsa-green)' : '#fff' }};color:{{ $period === $val ? '#fff' : 'var(--rinsa-gray)' }}">
                {{ $label }}
            </button>
        @endforeach
    </form>
</div>

{{-- Summary Metrics --}}
<div class="report-grid" style="margin-bottom:1.5rem">
    <div class="report-card">
        <div class="report-num">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
        <div class="report-label">Total Pendapatan</div>
    </div>
    <div class="report-card">
        <div class="report-num">{{ $stats['total_orders'] }}</div>
        <div class="report-label">Total Order</div>
    </div>
    <div class="report-card">
        <div class="report-num">{{ number_format($stats['total_weight'], 1, ',', '.') }} kg</div>
        <div class="report-label">Total Berat</div>
    </div>
    <div class="report-card">
        <div class="report-num">{{ $stats['total_customers'] }}</div>
        <div class="report-label">Total Pelanggan</div>
    </div>
</div>

{{-- Service Distribution --}}
<div class="section-title">Distribusi Layanan</div>
<div class="table-wrap" style="margin-bottom:1.5rem">
    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jumlah Order</th>
                <th>Pendapatan</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @forelse($byService as $row)
            <tr>
                <td>{{ \App\Models\Order::SERVICE_LABELS[$row->service] ?? $row->service }}</td>
                <td>{{ $row->total }}</td>
                <td>Rp {{ number_format($row->revenue, 0, ',', '.') }}</td>
                <td>
                    @php $pct = $stats['total_orders'] > 0 ? round($row->total / $stats['total_orders'] * 100) : 0; @endphp
                    <div style="display:flex;align-items:center;gap:8px">
                        <div style="flex:1;height:6px;background:var(--rinsa-border);border-radius:3px;max-width:100px">
                            <div style="width:{{ $pct }}%;height:100%;background:var(--rinsa-green);border-radius:3px"></div>
                        </div>
                        <span style="font-size:.78rem">{{ $pct }}%</span>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Daily Trend (last 7 days) --}}
<div class="section-title">Tren 7 Hari Terakhir</div>
<div class="table-wrap">
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Jumlah Order</th><th>Pendapatan</th></tr>
        </thead>
        <tbody>
            @forelse($dailyRevenue as $day)
            <tr>
                <td>{{ \Carbon\Carbon::parse($day->date)->translatedFormat('d M Y') }}</td>
                <td>{{ $day->orders }}</td>
                <td>Rp {{ number_format($day->revenue, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
