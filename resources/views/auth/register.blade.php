<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun — Rinsa Laundry</title>
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
        <div class="login-tagline">Daftar Akun Pelanggan</div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:1rem">
            <ul style="margin:0; padding-left:1.2rem">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input"
                   value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus />
        </div>
        <div class="form-group">
            <label class="form-label">Nomor Handphone</label>
            <input type="text" name="phone" class="form-input"
                   value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required />
            <small style="font-size:.7rem; color:var(--rinsa-gray)">*Harus sesuai dengan nomor yang terdaftar di laundry.</small>
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input"
                   value="{{ old('email') }}" placeholder="budi@example.com" required />
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input"
                   placeholder="Minimal 8 karakter" required />
        </div>
        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input"
                   placeholder="Ulangi password" required />
        </div>
        
        <button type="submit" class="btn-primary" style="margin-top:1rem">Daftar Sekarang</button>
    </form>

    <div style="text-align:center; margin-top:1.5rem; font-size:.85rem; color:var(--rinsa-gray)">
        Sudah punya akun? <a href="{{ route('login') }}" style="color:var(--rinsa-green); font-weight:600; text-decoration:none">Masuk di sini</a>
    </div>
</div>

</body>
</html>
