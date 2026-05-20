<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Rinsa Laundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-cream" style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem">

<div class="login-card">
    <div class="login-logo">
        <div class="login-logo-mark">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="28" height="28">
                <path d="M7 16.5C7 14 9 12 12 12s5 2 5 4.5" stroke-linecap="round"/>
                <path d="M12 12V6M9 8l3-2 3 2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="19" r="1.5" fill="white" stroke="none"/>
            </svg>
        </div>
        <div class="login-brand">Rinsa</div>
        <div class="login-tagline">Bersih itu tenang.</div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:1rem">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Email atau No. HP</label>
            <input type="text" name="login" class="form-input"
                   value="{{ old('login') }}" placeholder="admin@rinsa.id atau 0812..." required autofocus />
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input"
                   placeholder="••••••••" required />
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
            <label style="display:flex;align-items:center;gap:6px;font-size:.82rem;color:var(--rinsa-gray);cursor:pointer">
                <input type="checkbox" name="remember" style="accent-color:var(--rinsa-green)" />
                Ingat saya
            </label>
        </div>
        <button type="submit" class="btn-primary">Masuk</button>
    </form>

    <div class="login-track">
        Pelanggan? <a href="{{ route('tracking') }}">Lacak pesanan kamu</a>
    </div>
</div>

</body>
</html>
