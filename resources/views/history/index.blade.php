<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan — Rinsa Laundry</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 450px;
            width: 100%;
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(15, 110, 86, 0.1);
            border: 1px solid var(--border);
            text-align: center;
        }
        .logo {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            color: var(--green);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 30px;
        }
        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 700;
            font-size: 0.85rem;
            margin-bottom: 8px;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        input:focus {
            outline: none;
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(15, 110, 86, 0.1);
        }
        .btn {
            width: 100%;
            background: var(--green);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(15, 110, 86, 0.2);
        }
        .btn:hover {
            background: var(--green-dim);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(15, 110, 86, 0.3);
        }
        .error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 8px;
            font-weight: 600;
        }
        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="logo">Rinsa<span>.</span></a>
        <h1>Cek Riwayat Pesanan</h1>
        <p>Masukkan nomor telepon Anda untuk melihat semua riwayat laundry Anda.</p>

        <form action="{{ route('history.search') }}" method="GET">
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Lihat Riwayat</button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
    </div>
</body>
</html>
