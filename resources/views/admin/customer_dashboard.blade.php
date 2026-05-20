@extends('layouts.app')
@section('title', 'Dashboard Pelanggan')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h1 class="page-title" style="margin:0">Dashboard Riwayat & Rating</h1>
</div>

<div class="metric-grid">
    <div class="metric-card metric-accent">
        <div class="metric-val">{{ $orders->count() }}</div>
        <div class="metric-label">Total Pesanan Anda</div>
    </div>
    <div class="metric-card">
        <div class="metric-val" style="color:var(--rinsa-gold)">
            {{ $orders->whereNotNull('rating')->count() }}
        </div>
        <div class="metric-label">Feedback Diberikan</div>
    </div>
</div>

<div class="section-title" style="margin-top:2rem; margin-bottom:1rem">Riwayat Pesanan Terbaru</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Total</th>
                <th>Rating/Feedback</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>
                    <span style="font-family:monospace;font-size:.8rem;color:var(--rinsa-gray)">
                        {{ $order->order_code }}
                    </span>
                </td>
                <td>{{ $order->service_label }}</td>
                <td><span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span></td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>
                    @if($order->rating)
                        <div style="color:var(--rinsa-gold); font-size:1rem;">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $order->rating ? '★' : '☆' }}
                            @endfor
                        </div>
                    @else
                        <span style="color:var(--rinsa-gray-light)">Belum ada</span>
                    @endif
                </td>
                <td>
                    @if(in_array($order->status, ['done', 'pickup']) && !$order->rating)
                        <button onclick="openFeedbackModal('{{ $order->order_code }}')" style="background:var(--rinsa-gold); color:#fff; border:none; padding:5px 10px; border-radius:5px; cursor:pointer; font-size:0.8rem; font-weight:600;">Beri Penilaian</button>
                    @else
                        <span style="font-size:.8rem; color:var(--rinsa-gray)">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">
                    Belum ada riwayat pesanan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Feedback -->
<div id="feedbackModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
    <div style="background:#fff; padding:20px; border-radius:10px; width:400px; max-width:90%;">
        <h3 style="margin-top:0;">Beri Penilaian</h3>
        <form id="feedbackForm" method="POST" action="">
            @csrf
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600;">Rating (1-5)</label>
                <div class="star-rating" style="display:flex; gap:5px; font-size:24px; color:var(--rinsa-gray-light); cursor:pointer;">
                    <span data-val="1">★</span><span data-val="2">★</span><span data-val="3">★</span><span data-val="4">★</span><span data-val="5">★</span>
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="5" required>
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600;">Feedback / Komentar</label>
                <textarea name="feedback" style="width:100%; padding:10px; border:1px solid var(--rinsa-border); border-radius:5px; resize:vertical; min-height:80px; font-family:inherit;"></textarea>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" onclick="closeFeedbackModal()" style="padding:8px 15px; background:var(--rinsa-cream); border:1px solid var(--rinsa-border); border-radius:5px; cursor:pointer;">Batal</button>
                <button type="submit" style="padding:8px 15px; background:var(--rinsa-green); color:#fff; border:none; border-radius:5px; cursor:pointer;">Kirim Penilaian</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openFeedbackModal(orderId) {
        const form = document.getElementById('feedbackForm');
        form.action = `/dashboard/feedback/${orderId}`;
        document.getElementById('feedbackModal').style.display = 'flex';
        setRating(5); // default
    }

    function closeFeedbackModal() {
        document.getElementById('feedbackModal').style.display = 'none';
    }

    const stars = document.querySelectorAll('.star-rating span');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            setRating(this.dataset.val);
        });
    });

    function setRating(val) {
        document.getElementById('ratingInput').value = val;
        stars.forEach(star => {
            if (parseInt(star.dataset.val) <= parseInt(val)) {
                star.style.color = 'var(--rinsa-gold)';
            } else {
                star.style.color = 'var(--rinsa-gray-light)';
            }
        });
    }
</script>
@endsection
