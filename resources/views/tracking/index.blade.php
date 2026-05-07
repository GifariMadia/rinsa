<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lacak Pesanan — Rinsa Laundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-cream" style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem">

<div class="track-card">
    <div class="track-header">
        <div class="track-brand">Rinsa</div>
        <div class="track-subtitle">Lacak status cucian kamu tanpa perlu login</div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:1rem">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('tracking.result') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Kode Order</label>
            <input type="text" name="order_code"
                   class="form-input" style="text-transform:uppercase;letter-spacing:1px"
                   value="{{ old('order_code') }}"
                   placeholder="Contoh: RNS-A1B2C3D4"
                   required autofocus />
        </div>
        <button type="submit" class="btn-primary">Lacak Sekarang</button>
    </form>

    <div class="login-track" style="margin-top:1.25rem">
        Staff Rinsa? <a href="{{ route('login') }}">Login di sini</a>
    </div>
</div>

</body>
</html>
