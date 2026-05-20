<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan — Rinsa Laundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #0F6E56;
            --green-dim: #0a4f3e;
            --gold: #BA7517;
            --cream: #F5F3EE;
            --dark: #1A1A18;
            --white: #FDFCFA;
            --border: #D6D3C8;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            color: var(--green);
            text-decoration: none;
        }
        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            margin: 0;
        }
        .customer-info {
            background: var(--white);
            padding: 24px;
            border-radius: 20px;
            border: 1px solid var(--border);
            margin-bottom: 30px;
            display: flex;
            gap: 40px;
        }
        .info-item label {
            display: block;
            font-size: 0.7rem;
            font-weight: 800;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 4px;
        }
        .info-item span {
            font-weight: 700;
            color: var(--green);
        }
        .order-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            padding: 24px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            align-items: center;
        }
        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.05);
        }
        .order-main h3 {
            margin: 0 0 8px 0;
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            color: var(--dark);
        }
        .order-meta {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-washing { background: #DBEAFE; color: #1E40AF; }
        .status-done { background: #D1FAE5; color: #065F46; }
        .status-pickup { background: #F3F4F6; color: #374151; }

        .btn-feedback {
            background: var(--gold);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 800;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-feedback:hover {
            background: #d4921f;
            transform: scale(1.05);
        }
        .feedback-preview {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--border);
            font-size: 0.85rem;
            color: #555;
        }
        .rating-stars {
            color: var(--gold);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .empty-state {
            text-align: center;
            padding: 60px;
            color: #999;
        }
        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('home') }}" class="logo">Rinsa<span>.</span></a>
            <a href="{{ route('history.index') }}" style="color: var(--gold); text-decoration: none; font-weight: 700;">← Cari Lagi</a>
        </div>

        <h1>Riwayat Pesanan</h1>
        
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="customer-info">
            <div class="info-item">
                <label>Pelanggan</label>
                <span>{{ $customer->name }}</span>
            </div>
            <div class="info-item">
                <label>Telepon</label>
                <span>{{ $customer->phone }}</span>
            </div>
            <div class="info-item">
                <label>Total Pesanan</label>
                <span>{{ $orders->count() }}</span>
            </div>
        </div>

        @forelse($orders as $order)
            <div class="order-card">
                <div class="order-main">
                    <h3>{{ $order->order_code }}</h3>
                    <div class="order-meta">
                        <span>{{ $order->created_at->format('d M Y') }}</span>
                        <span>•</span>
                        <span>{{ $order->service_label }}</span>
                        <span>•</span>
                        <span>{{ number_format($order->total_price, 0, ',', '.') }} IDR</span>
                    </div>
                    <div class="status-badge status-{{ $order->status }}">
                        {{ $order->status_label }}
                    </div>

                    @if($order->rating)
                        <div class="feedback-preview">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $order->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                            @if($order->feedback)
                                <p style="margin: 5px 0 0 0;"><strong>Feedback:</strong> {{ $order->feedback }}</p>
                            @endif
                            @if($order->complaint)
                                <p style="margin: 5px 0 0 0; color: #dc2626;"><strong>Komplain:</strong> {{ $order->complaint }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="order-actions">
                    @if(!$order->rating && ($order->status === 'done' || $order->status === 'pickup'))
                        <a href="{{ route('history.feedback', $order->order_code) }}" class="btn-feedback">
                            Beri Feedback
                        </a>
                    @elseif($order->rating)
                        <span style="font-size: 0.75rem; font-weight: 800; color: #999; text-transform: uppercase;">Sudah Dinilai</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>Belum ada riwayat pesanan.</p>
            </div>
        @endforelse
    </div>
</body>
</html>
