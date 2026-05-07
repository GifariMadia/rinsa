<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Status Pesanan {{ $order->order_code }} — Rinsa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-cream" style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem">

<div class="track-card">
    <div class="track-header">
        <div class="track-brand">Rinsa</div>
        <div class="track-subtitle">Status pesanan kamu</div>
    </div>

    <div style="border-top:1px solid var(--rinsa-border);padding-top:1.25rem">
        <div style="font-size:.72rem;color:var(--rinsa-gray);margin-bottom:3px">
            Order #{{ $order->order_code }}
        </div>
        <div style="font-size:1.05rem;font-weight:600;margin-bottom:.75rem">
            {{ $order->customer->name }}
        </div>
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;flex-wrap:wrap">
            <span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span>
            <span style="font-size:.78rem;color:var(--rinsa-gray)">
                {{ $order->service_label }} · {{ $order->weight_kg }} kg
            </span>
        </div>

        {{-- Timeline --}}
        <div class="status-timeline">
            @foreach($timeline as $step)
            <div class="status-step">
                <div class="step-dot {{ $step['state'] }}"></div>
                <div class="step-line">
                    <div class="step-label"
                         style="color:{{ $step['state'] === 'pending' ? 'var(--rinsa-gray)' : 'var(--rinsa-dark)' }}">
                        {{ $step['label'] }}
                    </div>
                    <div class="step-time">{{ $step['time'] ?? '—' }}</div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Estimated Done --}}
        @if($order->estimated_done)
        <div style="background:var(--rinsa-cream);border-radius:8px;padding:.75rem 1rem;margin-top:1.25rem;font-size:.82rem;color:var(--rinsa-gray)">
            <strong style="color:var(--rinsa-dark)">Estimasi selesai:</strong>
            {{ $order->estimated_done->format('d M Y') }}
        </div>
        @endif
    </div>

    <div style="margin-top:1.5rem;text-align:center">
        <a href="{{ route('tracking') }}" style="font-size:.82rem;color:var(--rinsa-green);font-weight:600;text-decoration:none">
            ← Lacak pesanan lain
        </a>
    </div>
</div>

</body>
</html>
