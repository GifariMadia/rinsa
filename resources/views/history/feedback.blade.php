<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Feedback — Rinsa Laundry</title>
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
            max-width: 550px;
            width: 100%;
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(15, 110, 86, 0.1);
            border: 1px solid var(--border);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            color: var(--green);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 15px;
        }
        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            margin: 0 0 10px 0;
        }
        p {
            color: #666;
            font-size: 0.95rem;
        }
        .order-summary {
            background: var(--cream);
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            font-weight: 800;
            font-size: 0.8rem;
            margin-bottom: 10px;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .rating-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 30px;
            flex-direction: row-reverse;
        }
        .rating-group input {
            display: none;
        }
        .rating-group label {
            font-size: 2.5rem;
            color: #DDD;
            cursor: pointer;
            transition: color 0.2s;
            margin: 0;
        }
        .rating-group label:hover,
        .rating-group label:hover ~ label,
        .rating-group input:checked ~ label {
            color: var(--gold);
        }
        textarea {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
            resize: vertical;
            min-height: 100px;
        }
        textarea:focus {
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
        .footer-links {
            text-align: center;
            margin-top: 25px;
        }
        .footer-links a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('home') }}" class="logo">Rinsa<span>.</span></a>
            <h1>Beri Feedback Anda</h1>
            <p>Bagaimana pengalaman Anda dengan layanan kami?</p>
        </div>

        <div class="order-summary">
            <span>{{ $order->order_code }}</span>
            <span style="color: var(--gold);">{{ $order->service_label }}</span>
        </div>

        <form action="{{ route('history.feedback.post', $order->order_code) }}" method="POST">
            @csrf
            
            <label style="text-align: center;">Rating</label>
            <div class="rating-group">
                <input type="radio" name="rating" id="star5" value="5" required {{ old('rating') == 5 ? 'checked' : '' }}><label for="star5">★</label>
                <input type="radio" name="rating" id="star4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}><label for="star4">★</label>
                <input type="radio" name="rating" id="star3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}><label for="star3">★</label>
                <input type="radio" name="rating" id="star2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}><label for="star2">★</label>
                <input type="radio" name="rating" id="star1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}><label for="star1">★</label>
            </div>
            @error('rating')
                <div class="error" style="text-align: center; margin-bottom: 20px;">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="feedback">Feedback / Kesan</label>
                <textarea name="feedback" id="feedback" placeholder="Apa yang Anda sukai dari layanan kami?">{{ old('feedback') }}</textarea>
                @error('feedback')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="complaint">Komplain / Keluhan (Opsional)</label>
                <textarea name="complaint" id="complaint" placeholder="Beritahu kami jika ada yang perlu diperbaiki.">{{ old('complaint') }}</textarea>
                @error('complaint')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Kirim Feedback</button>
        </form>

        <div class="footer-links">
            <a href="{{ route('history.search', ['phone' => $order->customer->phone]) }}">← Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</body>
</html>
