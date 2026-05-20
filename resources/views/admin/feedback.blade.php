@extends('layouts.app')
@section('title', 'History & Rating')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h1 class="page-title" style="margin:0">History & Rating Pelanggan</h1>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pelanggan</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Komplain</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $order)
            <tr>
                <td>
                    <span style="font-family:monospace;font-size:.8rem;color:var(--rinsa-gray)">
                        {{ $order->order_code }}
                    </span>
                </td>
                <td>
                    <div style="font-weight:600">{{ $order->customer->name }}</div>
                    <div style="font-size:.75rem;color:var(--rinsa-gray)">{{ $order->customer->phone }}</div>
                </td>
                <td>
                    <div style="color:var(--rinsa-gold); font-size:1.1rem; letter-spacing:1px">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $order->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                </td>
                <td style="max-width: 250px;">
                    <div style="font-size:.85rem; color:var(--rinsa-dark)">
                        {{ $order->feedback ?? '—' }}
                    </div>
                </td>
                <td style="max-width: 250px;">
                    @if($order->complaint)
                        <div style="font-size:.85rem; color:var(--rinsa-red); background: #FEF2F2; padding: 6px 10px; border-radius: 6px;">
                            {{ $order->complaint }}
                        </div>
                    @else
                        <span style="color:var(--rinsa-gray-light)">—</span>
                    @endif
                </td>
                <td style="font-size:.85rem; color:var(--rinsa-gray)">
                    {{ $order->updated_at->format('d M Y') }}
                </td>
                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn-sm btn-view">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">
                    <div style="font-size:2rem;margin-bottom:10px">✨</div>
                    Belum ada feedback dari pelanggan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1.5rem">
    {{ $feedbacks->links() }}
</div>
@endsection
