<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rinsa Laundry — Premium Garment Care</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ────────── RESET & VARS ────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:       #0F6E56;
            --green-light: #1D9E75;
            --green-dim:   #0a4f3e;
            --gold:        #BA7517;
            --gold-light:  #d4921f;
            --cream:       #F5F3EE;
            --cream-dark:  #EAE7DE;
            --dark:        #1A1A18;
            --gray:        #5F5E5A;
            --gray-light:  #9B9A96;
            --border:      #D6D3C8;
            --white:       #FDFCFA;
            --nav-h:       72px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--cream);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ────────── NAVIGATION ────────── */
        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--nav-h);
            z-index: 999;
            transition: background 0.4s ease, box-shadow 0.4s ease, backdrop-filter 0.4s ease;
        }
        .nav.scrolled {
            background: rgba(253,252,250,0.94);
            backdrop-filter: blur(20px) saturate(1.8);
            -webkit-backdrop-filter: blur(20px) saturate(1.8);
            box-shadow: 0 1px 0 rgba(0,0,0,0.07), 0 4px 24px rgba(0,0,0,0.06);
        }
        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }
        .logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.9rem;
            color: #fff;
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: color 0.4s;
            flex-shrink: 0;
        }
        .logo-dot {
            width: 7px; height: 7px;
            background: var(--gold);
            border-radius: 50%;
            margin-top: 3px;
            flex-shrink: 0;
        }
        .nav.scrolled .logo { color: var(--green); }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-links a {
            text-decoration: none;
            color: rgba(255,255,255,0.88);
            font-weight: 600;
            font-size: 0.86rem;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.25s;
            letter-spacing: 0.01em;
        }
        .nav-links a:hover { color: #fff; background: rgba(255,255,255,0.12); }
        .nav.scrolled .nav-links a { color: var(--gray); }
        .nav.scrolled .nav-links a:hover { color: var(--dark); background: var(--cream-dark); }
        .btn-login {
            background: var(--gold) !important;
            color: #fff !important;
            padding: 9px 22px !important;
            border-radius: 24px !important;
            box-shadow: 0 4px 14px rgba(186,117,23,0.35);
        }
        .btn-login:hover {
            background: var(--gold-light) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(186,117,23,0.4) !important;
        }
        .nav.scrolled .btn-login { color: #fff !important; }

        /* Hamburger (mobile) */
        .nav-toggle {
            display: none;
            background: none;
            border: 1.5px solid rgba(255,255,255,0.5);
            border-radius: 9px;
            width: 40px; height: 40px;
            cursor: pointer;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: border-color 0.3s;
            position: relative;
            z-index: 1001;
        }
        .nav-toggle span {
            display: block;
            width: 18px; height: 1.5px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            transform-origin: center;
        }
        .nav.scrolled .nav-toggle { border-color: var(--border); }
        .nav.scrolled .nav-toggle span { background: var(--gray); }

        /* Hamburger → X animation */
        .nav-toggle.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .nav-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .nav-toggle.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* Mobile drawer */
        .mobile-drawer {
            display: none;
            position: fixed;
            top: var(--nav-h);
            left: 0; right: 0;
            background: rgba(253,252,250,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            z-index: 998;
            padding: 16px 20px 24px;
            flex-direction: column;
            gap: 4px;
            transform: translateY(-8px);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1), opacity 0.3s ease;
            pointer-events: none;
        }
        .mobile-drawer.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }
        .mobile-drawer a {
            text-decoration: none;
            color: var(--gray);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.2s;
            display: block;
        }
        .mobile-drawer a:hover { color: var(--dark); background: var(--cream-dark); }
        .mobile-drawer .btn-login {
            margin-top: 8px;
            display: block !important;
            text-align: center;
            padding: 12px 22px !important;
        }

        /* ────────── HERO ────────── */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(to bottom, rgba(10,79,62,0.80) 0%, rgba(15,110,86,0.72) 60%, rgba(10,40,30,0.90) 100%),
                url('https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&q=80&w=2070');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
        }
        /* Diagonal stripe overlay */
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.04;
            background-image: repeating-linear-gradient(-45deg, white 0, white 1px, transparent 1px, transparent 20px);
        }
        /* Decorative orbs */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-orb-1 {
            width: 500px; height: 500px;
            top: -100px; right: -80px;
            background: radial-gradient(circle, rgba(29,158,117,0.18) 0%, transparent 70%);
        }
        .hero-orb-2 {
            width: 320px; height: 320px;
            bottom: 60px; left: -60px;
            background: radial-gradient(circle, rgba(186,117,23,0.14) 0%, transparent 70%);
        }
        .hero-inner {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            padding-top: var(--nav-h);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            min-height: 100vh;
        }
        .hero-text { animation: heroIn 0.9s cubic-bezier(0.16,1,0.3,1) both; }
        @keyframes heroIn {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            color: rgba(255,255,255,0.9);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 7px 16px;
            border-radius: 20px;
            margin-bottom: 24px;
        }
        .hero-eyebrow-dot {
            width: 6px; height: 6px;
            background: #4ade80;
            border-radius: 50%;
            animation: blink 2s ease-in-out infinite;
            box-shadow: 0 0 8px rgba(74,222,128,0.8);
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .hero h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.8rem, 5.5vw, 4.6rem);
            color: #fff;
            line-height: 1.05;
            letter-spacing: -1px;
            margin-bottom: 24px;
        }
        .hero h1 em {
            font-style: italic;
            color: rgba(255,255,255,0.7);
        }
        .hero p {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.78);
            line-height: 1.75;
            max-width: 480px;
            margin-bottom: 40px;
        }
        .cta-group {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }
        .btn-main {
            background: var(--gold);
            color: #fff;
            padding: 15px 36px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.9rem;
            transition: all 0.25s;
            box-shadow: 0 8px 24px rgba(186,117,23,0.4);
            letter-spacing: 0.02em;
        }
        .btn-main:hover { background: var(--gold-light); transform: translateY(-2px); box-shadow: 0 12px 32px rgba(186,117,23,0.5); }
        .btn-outline {
            border: 1.5px solid rgba(255,255,255,0.5);
            color: #fff;
            padding: 15px 36px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.25s;
            backdrop-filter: blur(6px);
            letter-spacing: 0.02em;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.8); }

        /* Hero right: floating card */
        .hero-card-stack {
            position: relative;
            animation: heroIn 0.9s 0.15s cubic-bezier(0.16,1,0.3,1) both;
        }
        .hero-img-main {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            border-radius: 28px;
            display: block;
            box-shadow: 0 32px 80px rgba(0,0,0,0.35);
        }
        .hero-float-card {
            position: absolute;
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 16px 20px;
            box-shadow: 0 16px 48px rgba(0,0,0,0.18);
            border: 1px solid rgba(255,255,255,0.8);
            animation: floatCard 4s ease-in-out infinite;
        }
        .hero-float-card:nth-child(3) { animation-delay: -2s; }
        @keyframes floatCard {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .hero-float-left {
            bottom: 48px;
            left: -32px;
            min-width: 170px;
        }
        .hero-float-top {
            top: 40px;
            right: -24px;
            min-width: 155px;
        }
        .float-label {
            font-size: 0.67rem;
            font-weight: 800;
            color: var(--gray-light);
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 5px;
        }
        .float-value {
            font-family: 'DM Serif Display', serif;
            font-size: 1.7rem;
            color: var(--green);
            line-height: 1;
        }
        .float-sub { font-size: 0.75rem; color: var(--gray); margin-top: 3px; font-weight: 600; }
        .float-stars { color: var(--gold); font-size: 0.85rem; letter-spacing: 1px; }
        .float-rating-num { font-size: 0.75rem; color: var(--gray); font-weight: 700; margin-top: 3px; }

        /* Scroll indicator */
        .hero-scroll {
            position: absolute;
            bottom: 36px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.5);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .scroll-line {
            width: 1.5px;
            height: 40px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.5), transparent);
            animation: scrollLine 2s ease-in-out infinite;
        }
        @keyframes scrollLine { 0%,100%{transform:scaleY(1);opacity:1} 50%{transform:scaleY(0.6);opacity:0.4} }

        /* ────────── TRUST BAR ────────── */
        .trust-bar {
            background: var(--dark);
            padding: 22px 0;
            overflow: hidden;
        }
        .trust-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            flex-wrap: wrap;
        }
        .trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.55);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .trust-icon {
            width: 32px; height: 32px;
            border-radius: 9px;
            background: rgba(255,255,255,0.07);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        /* Marquee for mobile */
        .trust-marquee {
            display: none;
            overflow: hidden;
        }
        .trust-marquee-track {
            display: flex;
            gap: 40px;
            animation: marquee 20s linear infinite;
            width: max-content;
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        /* ────────── SECTION BASE ────────── */
        .section {
            padding: 100px 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 16px;
        }
        .section-eyebrow::before {
            content: '';
            width: 20px; height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }
        .section-title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--dark);
            line-height: 1.1;
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }
        .section-subtitle {
            font-size: 1rem;
            color: var(--gray);
            line-height: 1.75;
            max-width: 540px;
        }

        /* ────────── STATS COUNTER ────────── */
        .stats-section {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-dim) 100%);
            padding: 72px 0;
            position: relative;
            overflow: hidden;
        }
        .stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.04;
            background-image: repeating-linear-gradient(-45deg, white 0, white 1px, transparent 1px, transparent 22px);
        }
        .stats-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .stats-orb-1 {
            width: 400px; height: 400px;
            top: -150px; right: -80px;
            background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);
        }
        .stats-orb-2 {
            width: 260px; height: 260px;
            bottom: -80px; left: 10%;
            background: radial-gradient(circle, rgba(186,117,23,0.15) 0%, transparent 70%);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            position: relative;
            z-index: 1;
        }
        .stat-item {
            text-align: center;
            padding: 24px 20px;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .stat-item:last-child { border-right: none; }
        .stat-num {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            color: #fff;
            line-height: 1;
            margin-bottom: 8px;
        }
        .stat-num .stat-suffix {
            font-size: 0.6em;
            color: rgba(255,255,255,0.7);
            vertical-align: super;
        }
        .stat-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: rgba(255,255,255,0.55);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .stat-icon {
            font-size: 1.5rem;
            margin-bottom: 10px;
            display: block;
        }

        /* ────────── SERVICES ────────── */
        .services-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: end;
            margin-bottom: 60px;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }
        .service-card {
            background: var(--white);
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
            cursor: default;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(15,110,86,0.14), 0 6px 20px rgba(0,0,0,0.06);
            border-color: rgba(15,110,86,0.2);
        }
        .service-img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }
        .service-card:hover .service-img { transform: scale(1.04); }
        .service-img-wrap { overflow: hidden; }
        .service-body { padding: 26px 26px 28px; }
        .service-tag {
            display: inline-block;
            font-size: 0.67rem;
            font-weight: 800;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--green);
            background: rgba(15,110,86,0.08);
            padding: 4px 10px;
            border-radius: 10px;
            margin-bottom: 12px;
            border: 1px solid rgba(15,110,86,0.12);
        }
        .service-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.2;
        }
        .service-desc {
            font-size: 0.87rem;
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .service-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .price-label { font-size: 0.7rem; color: var(--gray-light); font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; }
        .price-value { font-family: 'DM Serif Display', serif; font-size: 1.4rem; color: var(--gold); }

        /* ────────── HOW IT WORKS ────────── */
        .how-section { background: var(--dark); }
        .how-section .section-eyebrow { color: #4ade80; }
        .how-section .section-title { color: #fff; }
        .how-section .section-subtitle { color: rgba(255,255,255,0.55); }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            margin-top: 60px;
            position: relative;
        }
        /* Connector line */
        .steps-grid::before {
            content: '';
            position: absolute;
            top: 42px;
            left: calc(12.5% + 20px);
            right: calc(12.5% + 20px);
            height: 1px;
            background: linear-gradient(to right, rgba(255,255,255,0.08), rgba(255,255,255,0.2), rgba(255,255,255,0.08));
        }
        .step {
            padding: 0 24px 0;
            text-align: center;
        }
        .step-num {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.9);
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            z-index: 1;
            transition: all 0.3s;
        }
        .step:hover .step-num {
            background: var(--green);
            border-color: var(--green);
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(15,110,86,0.4);
        }
        .step-img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 16px;
            display: block;
            margin-bottom: 20px;
            opacity: 0.7;
            transition: opacity 0.3s;
            filter: grayscale(30%);
        }
        .step:hover .step-img { opacity: 1; filter: none; }
        .step-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.15rem;
            color: #fff;
            margin-bottom: 8px;
        }
        .step-desc { font-size: 0.82rem; color: rgba(255,255,255,0.5); line-height: 1.6; }

        /* ────────── ABOUT / SPLIT ────────── */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        .about-img-wrap { position: relative; }
        .about-img-main {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 24px;
            display: block;
            box-shadow: 0 24px 64px rgba(15,110,86,0.16);
        }
        .about-img-accent {
            position: absolute;
            bottom: -24px;
            right: -24px;
            width: 55%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 20px;
            border: 5px solid var(--cream);
            box-shadow: 0 16px 48px rgba(0,0,0,0.14);
        }
        .about-badge {
            position: absolute;
            top: 28px;
            left: -24px;
            background: var(--green);
            color: #fff;
            padding: 14px 20px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 0.82rem;
            line-height: 1.4;
            box-shadow: 0 8px 24px rgba(15,110,86,0.35);
        }
        .about-badge strong { font-family: 'DM Serif Display', serif; font-size: 1.8rem; display: block; line-height: 1; }
        .about-text { padding-bottom: 24px; }
        .check-list { list-style: none; margin-top: 28px; display: flex; flex-direction: column; gap: 14px; }
        .check-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.9rem;
            color: var(--gray);
            line-height: 1.55;
        }
        .check-icon {
            width: 22px; height: 22px;
            border-radius: 50%;
            background: rgba(15,110,86,0.1);
            border: 1px solid rgba(15,110,86,0.2);
            color: var(--green);
            font-size: 11px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .btn-green {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-top: 36px;
            background: var(--green);
            color: #fff;
            padding: 14px 30px;
            border-radius: 30px;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 6px 20px rgba(15,110,86,0.3);
        }
        .btn-green:hover { background: var(--green-dim); transform: translateY(-2px); box-shadow: 0 10px 28px rgba(15,110,86,0.38); }

        /* ────────── TESTIMONIALS ────────── */
        .testimonials-section { background: var(--cream-dark); }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 56px;
        }
        .testimonial-card {
            background: var(--white);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
            position: relative;
            transition: all 0.3s;
        }
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(15,110,86,0.1);
        }
        .testimonial-card.featured {
            background: var(--green);
            border-color: var(--green);
        }
        .testimonial-card.featured .t-text,
        .testimonial-card.featured .t-name { color: #fff; }
        .testimonial-card.featured .t-role,
        .testimonial-card.featured .t-quote { color: rgba(255,255,255,0.65); }
        .testimonial-card.featured .star { color: #fcd34d; }
        .t-quote {
            font-size: 2rem;
            font-family: 'DM Serif Display', serif;
            color: var(--border);
            line-height: 1;
            margin-bottom: 12px;
        }
        .t-stars { margin-bottom: 14px; }
        .star { color: var(--gold); font-size: 0.85rem; }
        .t-text {
            font-size: 0.88rem;
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 20px;
            font-style: italic;
        }
        .t-author { display: flex; align-items: center; gap: 12px; }
        .t-avatar {
            width: 42px; height: 42px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            flex-shrink: 0;
        }
        .t-name { font-size: 0.85rem; font-weight: 800; color: var(--dark); }
        .t-role { font-size: 0.75rem; color: var(--gray-light); font-weight: 600; }

        /* ────────── CTA BANNER ────────── */
        .cta-banner {
            background: linear-gradient(135deg, var(--green-dim) 0%, var(--green) 60%, var(--green-light) 100%);
            border-radius: 28px;
            padding: 72px 80px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 60px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .cta-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.04;
            background-image: repeating-linear-gradient(-45deg, white 0, white 1px, transparent 1px, transparent 22px);
        }
        .cta-banner::after {
            content: '';
            position: absolute;
            right: -80px; top: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .cta-eyebrow { font-size: 0.7rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.6); margin-bottom: 12px; }
        .cta-title { font-family: 'DM Serif Display', serif; font-size: 2.4rem; color: #fff; line-height: 1.1; letter-spacing: -0.5px; margin-bottom: 14px; }
        .cta-sub { font-size: 0.95rem; color: rgba(255,255,255,0.7); line-height: 1.65; }
        .cta-actions { display: flex; flex-direction: column; gap: 12px; position: relative; z-index: 1; }
        .cta-actions .btn-main { white-space: nowrap; text-align: center; }
        .cta-actions .btn-outline { white-space: nowrap; text-align: center; border-color: rgba(255,255,255,0.35); }

        /* ────────── FOOTER ────────── */
        footer {
            background: var(--dark);
            color: rgba(255,255,255,0.55);
        }
        .footer-top {
            max-width: 1200px;
            margin: 0 auto;
            padding: 64px 40px 48px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
        }
        .footer-brand .logo { font-size: 1.7rem; margin-bottom: 16px; display: inline-block; }
        .footer-brand p { font-size: 0.85rem; line-height: 1.7; max-width: 280px; }
        .footer-col h4 { font-size: 0.72rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 18px; }
        .footer-col a { display: block; font-size: 0.86rem; color: rgba(255,255,255,0.55); text-decoration: none; margin-bottom: 11px; transition: color 0.2s; }
        .footer-col a:hover { color: #fff; }
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 40px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        /* ────────── FLOATING ELEMENTS ────────── */
        /* WhatsApp button */
        .fab-wa {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 900;
            width: 56px; height: 56px;
            border-radius: 50%;
            background: #25D366;
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 28px rgba(37,211,102,0.45);
            text-decoration: none;
            font-size: 1.5rem;
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            animation: fabIn 0.5s 1s cubic-bezier(0.16,1,0.3,1) both;
        }
        .fab-wa:hover {
            transform: scale(1.1) translateY(-3px);
            box-shadow: 0 14px 40px rgba(37,211,102,0.55);
        }
        .fab-wa::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid rgba(37,211,102,0.35);
            animation: fabPulse 2.5s ease-out infinite;
        }
        @keyframes fabPulse { 0%{transform:scale(1);opacity:1} 100%{transform:scale(1.6);opacity:0} }

        /* Back to top */
        .back-top {
            position: fixed;
            bottom: 28px;
            right: 96px;
            z-index: 900;
            width: 44px; height: 44px;
            border-radius: 50%;
            background: var(--white);
            border: 1.5px solid var(--border);
            color: var(--green);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.25s;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
        }
        .back-top.visible {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }
        .back-top:hover {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
            transform: translateY(-2px);
        }

        @keyframes fabIn {
            from { opacity: 0; transform: scale(0.6); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* ────────── ANIMATIONS ────────── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.16,1,0.3,1), transform 0.7s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.visible { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* ────────── RESPONSIVE ────────── */
        @media (max-width: 1024px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero p { margin: 0 auto 40px; }
            .cta-group { justify-content: center; }
            .hero-card-stack { display: none; }
            .services-header { grid-template-columns: 1fr; gap: 24px; }
            .steps-grid { grid-template-columns: repeat(2,1fr); gap: 32px; }
            .steps-grid::before { display: none; }
            .about-grid { grid-template-columns: 1fr; gap: 48px; }
            .about-img-wrap { order: -1; max-width: 500px; margin: 0 auto; }
            .about-img-accent { display: none; }
            .about-badge { left: 0; }
            .footer-top { grid-template-columns: 1fr 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0; }
            .stat-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .stat-item:nth-child(odd) { border-right: 1px solid rgba(255,255,255,0.1); }
            .stat-item:nth-child(n+3) { border-bottom: none; }
        }
        @media (max-width: 768px) {
            :root { --nav-h: 60px; }
            .container { padding: 0 20px; }
            .section { padding: 72px 0; }
            .nav-inner { padding: 0 20px; }
            .hero-inner { padding: 0 20px; padding-top: var(--nav-h); }
            .nav-links { display: none; }
            .nav-toggle { display: flex; }
            .mobile-drawer { display: flex; }
            .hero h1 { font-size: clamp(2.2rem, 9vw, 3rem); }
            .hero p { font-size: 0.95rem; }
            .services-grid { grid-template-columns: 1fr; }
            .steps-grid { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .cta-banner {
                grid-template-columns: 1fr;
                padding: 40px 28px;
                border-radius: 20px;
            }
            .footer-top { grid-template-columns: 1fr; gap: 32px; padding: 40px 20px; }
            .footer-bottom { flex-direction: column; text-align: center; padding: 16px 20px; }
            .trust-inner { display: none; }
            .trust-marquee { display: block; padding: 22px 0; }
            .stats-section { padding: 56px 0; }
            .stats-grid { grid-template-columns: repeat(2,1fr); }
            .stat-item:nth-child(2) { border-right: none; }
            .fab-wa { bottom: 20px; right: 20px; width: 50px; height: 50px; font-size: 1.35rem; }
            .back-top { bottom: 20px; right: 82px; width: 40px; height: 40px; }
        }
        @media (max-width: 480px) {
            .hero h1 { font-size: 2rem; }
            .btn-main, .btn-outline { padding: 13px 26px; font-size: 0.85rem; }
            .cta-title { font-size: 1.8rem; }
            .stat-item { padding: 20px 12px; }
        }

        /* iOS fix: background-attachment:fixed causes bugs */
        @supports (-webkit-overflow-scrolling: touch) {
            .hero-bg { background-attachment: scroll; }
        }
        @media (hover: none) {
            .hero-bg { background-attachment: scroll; }
        }
    </style>
</head>
<body>

    <!-- ═══════ NAV ═══════ -->
    <nav class="nav" id="js-nav">
        <div class="nav-inner">
            <a href="#" class="logo">Rinsa<span class="logo-dot"></span></a>

            <div class="nav-links">
                <a href="#services">Layanan</a>
                <a href="#about">Tentang</a>
                <a href="{{ route('tracking') }}">Lacak Order</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-login">Buka Aplikasi</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Login Staf</a>
                @endauth
            </div>

            <button class="nav-toggle" id="js-nav-toggle" aria-label="Buka menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Drawer -->
    <div class="mobile-drawer" id="js-mobile-drawer" role="navigation">
        <a href="#services">Layanan</a>
        <a href="#about">Tentang</a>
        <a href="{{ route('tracking') }}">Lacak Order</a>
        @auth
            <a href="{{ route('dashboard') }}" class="btn-login">Buka Aplikasi</a>
        @else
            <a href="{{ route('login') }}" class="btn-login">Login Staf</a>
        @endauth
    </div>

    <!-- ═══════ HERO ═══════ -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>

        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-dot"></span>
                    Premium Laundry Service
                </div>
                <h1>Excellence in<br><em>Garment</em> Care.</h1>
                <p>Layanan laundry dan dry cleaning premium yang dirancang untuk memenuhi gaya hidup Anda. Kami merawat setiap helai pakaian dengan presisi yang pantas diterimanya.</p>
                <div class="cta-group">
                    <a href="{{ route('tracking') }}" class="btn-main">Lacak Laundry Anda</a>
                    <a href="#services" class="btn-outline">Lihat Layanan ↓</a>
                </div>
            </div>

            <div class="hero-card-stack">
                <img
                    src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&q=80&w=900"
                    alt="Perawatan pakaian premium"
                    class="hero-img-main">

                <div class="hero-float-card hero-float-left">
                    <div class="float-label">Order Selesai</div>
                    <div class="float-value">5</div>
                    <div class="float-sub">✦ Dibuka 2026</div>
                </div>

                <div class="hero-float-card hero-float-top">
                    <div class="float-label">Rating Pelanggan</div>
                    <div class="float-stars">★★★★★</div>
                    <div class="float-rating-num">4.9 / 5.0 — 2,800 ulasan</div>
                </div>
            </div>
        </div>

        <div class="hero-scroll" aria-hidden="true">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- ═══════ TRUST BAR ═══════ -->
    <div class="trust-bar">
        <!-- Desktop: normal layout -->
        <div class="trust-inner">
            <div class="trust-item"><span class="trust-icon">✦</span>  Dibuka 2026</div>
            <div class="trust-item"><span class="trust-icon">🧺</span> 5 Order Selesai</div>
            <div class="trust-item"><span class="trust-icon">⭐</span> Rating 4.9 / 5.0</div>
            <div class="trust-item"><span class="trust-icon">♻</span> Bahan Ramah Lingkungan</div>
            <div class="trust-item"><span class="trust-icon">🚚</span> Pickup & Delivery</div>
        </div>
        <!-- Mobile: auto-scroll marquee -->
        <div class="trust-marquee">
            <div class="trust-marquee-track">
                <div class="trust-item"><span class="trust-icon">✦</span>  Dibuka 2026</div>
                <div class="trust-item"><span class="trust-icon">🧺</span> 5 Order Selesai</div>
                <div class="trust-item"><span class="trust-icon">⭐</span> Rating 4.9 / 5.0</div>
                <div class="trust-item"><span class="trust-icon">♻</span> Bahan Ramah Lingkungan</div>
                <div class="trust-item"><span class="trust-icon">🚚</span> Pickup & Delivery</div>
                <!-- Duplicate for seamless loop -->
                <div class="trust-item"><span class="trust-icon">✦</span>  Dibuka 2026</div>
                <div class="trust-item"><span class="trust-icon">🧺</span> 5 Order Selesai</div>
                <div class="trust-item"><span class="trust-icon">⭐</span> Rating 4.9 / 5.0</div>
                <div class="trust-item"><span class="trust-icon">♻</span> Bahan Ramah Lingkungan</div>
                <div class="trust-item"><span class="trust-icon">🚚</span> Pickup & Delivery</div>
            </div>
        </div>
    </div>

    <!-- ═══════ SERVICES ═══════ -->
    <section class="section" id="services">
        <div class="container">
            <div class="services-header reveal">
                <div>
                    <div class="section-eyebrow">Layanan Kami</div>
                    <h2 class="section-title">Solusi Lengkap untuk<br>Setiap Kebutuhan</h2>
                </div>
                <p class="section-subtitle">Dari pakaian harian hingga gaun pengantin, kami memiliki layanan yang tepat dengan teknologi terkini dan keahlian terlatih.</p>
            </div>

            <div class="services-grid">
                <div class="service-card reveal reveal-delay-1">
                    <div class="service-img-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1545173168-9f1947e8025e?auto=format&fit=crop&q=80&w=600"
                            alt="Premium Wash"
                            class="service-img">
                    </div>
                    <div class="service-body">
                        <div class="service-tag">Terpopuler</div>
                        <h3 class="service-title">Premium Wash</h3>
                        <p class="service-desc">Proses cuci ramah lingkungan yang menjaga warna kain tetap cerah dan tekstur tetap lembut untuk bertahun-tahun.</p>
                        <div class="service-price">
                            <div><div class="price-label">Mulai dari</div><div class="price-value">Rp 7.000/kg</div></div>
                        </div>
                    </div>
                </div>

                <div class="service-card reveal reveal-delay-2">
                    <div class="service-img-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1585771724684-38269d6639fd?auto=format&fit=crop&q=80&w=600"
                            alt="Express Service"
                            class="service-img">
                    </div>
                    <div class="service-body">
                        <div class="service-tag">⚡ Express</div>
                        <h3 class="service-title">Cuci Kilat 24 Jam</h3>
                        <p class="service-desc">Butuh cepat? Pakaian Anda dicuci, disetrika, dan siap dalam waktu kurang dari 24 jam — dijamin tepat waktu.</p>
                        <div class="service-price">
                            <div><div class="price-label">Mulai dari</div><div class="price-value">Rp 12.000/kg</div></div>
                        </div>
                    </div>
                </div>

                <div class="service-card reveal reveal-delay-3">
                    <div class="service-img-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&q=80&w=600"
                            alt="Dry Cleaning"
                            class="service-img">
                    </div>
                    <div class="service-body">
                        <div class="service-tag">Khusus</div>
                        <h3 class="service-title">Dry Cleaning</h3>
                        <p class="service-desc">Perawatan khusus untuk baju formal, jas, gaun, dan pakaian berbahan sensitif dengan teknik dry cleaning profesional.</p>
                        <div class="service-price">
                            <div><div class="price-label">Mulai dari</div><div class="price-value">Rp 35.000/pcs</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ STATS COUNTER ═══════ -->
    <section class="stats-section">
        <div class="stats-orb stats-orb-1"></div>
        <div class="stats-orb stats-orb-2"></div>
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item reveal reveal-delay-1">
                    <span class="stat-icon">🧺</span>
                    <div class="stat-num" data-target="12400" data-suffix="+">0</div>
                    <div class="stat-label">Order Selesai</div>
                </div>
                <div class="stat-item reveal reveal-delay-2">
                    <span class="stat-icon">😊</span>
                    <div class="stat-num" data-target="2800" data-suffix="+">0</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div class="stat-item reveal reveal-delay-3">
                    <span class="stat-icon">⭐</span>
                    <div class="stat-num" data-target="4.9" data-suffix="/5" data-decimal="true">0</div>
                    <div class="stat-label">Rata-rata Rating</div>
                </div>
                <div class="stat-item reveal reveal-delay-3">
                    <span class="stat-icon">🏆</span>
                    <div class="stat-num" data-target="5" data-suffix="+">0</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ HOW IT WORKS ═══════ -->
    <section class="section how-section">
        <div class="container">
            <div class="reveal" style="text-align:center; max-width:560px; margin:0 auto;">
                <div class="section-eyebrow">Cara Kerja</div>
                <h2 class="section-title" style="color:#fff;">Mudah dalam<br>Empat Langkah</h2>
            </div>

            <div class="steps-grid">
                <div class="step reveal reveal-delay-1">
                    <div class="step-num">1</div>
                    <img
                        src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=400"
                        alt="Pesan layanan"
                        class="step-img">
                    <h3 class="step-title">Pesan Layanan</h3>
                    <p class="step-desc">Pilih layanan dan jadwalkan pickup melalui staf kami atau langsung kunjungi gerai.</p>
                </div>
                <div class="step reveal reveal-delay-2">
                    <div class="step-num">2</div>
                    <img
                        src="https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&q=80&w=400"
                        alt="Kami jemput"
                        class="step-img">
                    <h3 class="step-title">Kami Jemput</h3>
                    <p class="step-desc">Tim kami mengambil pakaian Anda di lokasi, dikemas rapi dan aman.</p>
                </div>
                <div class="step reveal reveal-delay-3">
                    <div class="step-num">3</div>
                    <img
                        src="https://images.unsplash.com/photo-1545173168-9f1947e8025e?auto=format&fit=crop&q=80&w=400"
                        alt="Diproses"
                        class="step-img">
                    <h3 class="step-title">Diproses Ahli</h3>
                    <p class="step-desc">Pakaian dicuci, dirawat, dan disetrika oleh tim berpengalaman kami.</p>
                </div>
                <div class="step reveal reveal-delay-3">
                    <div class="step-num">4</div>
                    <img
                        src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&q=80&w=400"
                        alt="Diantarkan"
                        class="step-img">
                    <h3 class="step-title">Diantar Kembali</h3>
                    <p class="step-desc">Pakaian bersih dikirimkan tepat waktu langsung ke pintu Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ ABOUT ═══════ -->
    <section class="section" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-img-wrap reveal">
                    <img
                        src="https://images.unsplash.com/photo-1604335399105-a0c585fd81a1?auto=format&fit=crop&q=80&w=800"
                        alt="Tim Rinsa Laundry"
                        class="about-img-main">
                    <img
                        src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?auto=format&fit=crop&q=80&w=500"
                        alt="Detail pakaian"
                        class="about-img-accent">
                    <div class="about-badge">
                        <strong>5+</strong>Tahun<br>Pengalaman
                    </div>
                </div>

                <div class="about-text reveal reveal-delay-1">
                    <div class="section-eyebrow">Tentang Rinsa</div>
                    <h2 class="section-title">Dipercaya Ribuan<br>Pelanggan Setia</h2>
                    <p class="section-subtitle">Rinsa Laundry hadir Dibuka 2026 dengan misi sederhana: memberikan perawatan pakaian terbaik dengan harga yang adil, menggunakan teknologi modern dan bahan ramah lingkungan.</p>

                    <ul class="check-list">
                        <li><span class="check-icon">✓</span>Teknologi cuci modern dengan bahan eco-friendly yang aman</li>
                        <li><span class="check-icon">✓</span>Tim terlatih dengan standar penanganan pakaian internasional</li>
                        <li><span class="check-icon">✓</span>Sistem tracking real-time dari pickup hingga delivery</li>
                        <li><span class="check-icon">✓</span>Garansi kepuasan — pakaian bermasalah kami proses ulang gratis</li>
                    </ul>

                    <a href="{{ route('tracking') }}" class="btn-green">
                        Lacak Order Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ TESTIMONIALS ═══════ -->
    <section class="section testimonials-section">
        <div class="container">
            <div class="reveal" style="text-align:center; max-width:500px; margin:0 auto 0;">
                <div class="section-eyebrow">Testimoni</div>
                <h2 class="section-title">Kata Mereka<br>tentang Rinsa</h2>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card reveal reveal-delay-1">
                    <div class="t-quote">"</div>
                    <div class="t-stars"><span class="star">★★★★★</span></div>
                    <p class="t-text">Pelayanan luar biasa! Baju seragam kantor saya selalu bersih sempurna dan tepat waktu. Sudah 2 tahun berlangganan dan tidak pernah kecewa.</p>
                    <div class="t-author">
                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&q=80&w=100" alt="Pelanggan" class="t-avatar">
                        <div><div class="t-name">Budi Santoso</div><div class="t-role">Manajer Kantor</div></div>
                    </div>
                </div>

                <div class="testimonial-card featured reveal reveal-delay-2">
                    <div class="t-quote" style="color:rgba(255,255,255,0.25)">"</div>
                    <div class="t-stars"><span class="star">★★★★★</span></div>
                    <p class="t-text">Dry cleaning gaun pengantin saya ditangani dengan sangat profesional. Hasilnya bersih tanpa satu noda pun — lebih dari yang saya harapkan!</p>
                    <div class="t-author">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=100" alt="Pelanggan" class="t-avatar">
                        <div><div class="t-name">Sari Dewi</div><div class="t-role">Event Organizer</div></div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal-delay-3">
                    <div class="t-quote">"</div>
                    <div class="t-stars"><span class="star">★★★★★</span></div>
                    <p class="t-text">Express service 24 jam benar-benar menyelamatkan saya sebelum presentasi penting. Harga wajar, kualitas premium — wajib dicoba!</p>
                    <div class="t-author">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=100" alt="Pelanggan" class="t-avatar">
                        <div><div class="t-name">Andi Pratama</div><div class="t-role">Konsultan Bisnis</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ CTA BANNER ═══════ -->
    <section class="section">
        <div class="container">
            <div class="cta-banner reveal">
                <div>
                    <div class="cta-eyebrow">Mulai Sekarang</div>
                    <div class="cta-title">Siap Merasakan<br>Perbedaannya?</div>
                    <p class="cta-sub">Lacak order laundry Anda secara real-time atau masuk ke dashboard manajemen untuk tim kami.</p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('tracking') }}" class="btn-main">🔍 Lacak Order</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-outline">Buka Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Login Staf</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ FOOTER ═══════ -->
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <a href="#" class="logo" style="color:#fff; font-size:1.7rem; margin-bottom:14px; display:inline-block;">
                    Rinsa<span class="logo-dot"></span>
                </a>
                <p>Layanan laundry premium yang mengutamakan kualitas, ketepatan waktu, dan kepuasan pelanggan Dibuka 2026.</p>
            </div>

            <div class="footer-col">
                <h4>Layanan</h4>
                <a href="#services">Premium Wash</a>
                <a href="#services">Cuci Kilat Express</a>
                <a href="#services">Dry Cleaning</a>
                <a href="#services">Setrika Saja</a>
            </div>

            <div class="footer-col">
                <h4>Perusahaan</h4>
                <a href="#about">Tentang Kami</a>
                <a href="{{ route('tracking') }}">Lacak Order</a>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login Staf</a>
                @endauth
            </div>

            <div class="footer-col">
                <h4>Kontak</h4>
                <a href="#">📍 Jl. Contoh No. 12</a>
                <a href="#">📞 (021) 000-0000</a>
                <a href="#">✉ hello@rinsa.id</a>
                <a href="#">⏰ Buka 07.00–21.00</a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>© 2026 Rinsa Laundry. Semua hak dilindungi.</span>
            <div class="footer-badge">♻ Eco-Friendly Certified</div>
        </div>
    </footer>

    <!-- ═══════ FLOATING ELEMENTS ═══════ -->
    <a href="https://wa.me/6202100000000" class="fab-wa" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.527 5.845L.057 23.5l5.797-1.522A11.943 11.943 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.858 0-3.592-.5-5.088-1.373l-.365-.217-3.777.992.997-3.69-.238-.381A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
        </svg>
    </a>

    <button class="back-top" id="js-back-top" aria-label="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="18" height="18">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
        </svg>
    </button>

    <script>
        /* ── Navbar scroll effect ── */
        var nav = document.getElementById('js-nav');
        function updateNav() {
            if (window.scrollY > 40) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', updateNav, { passive: true });
        updateNav();

        /* ── Scroll reveal ── */
        var reveals = document.querySelectorAll('.reveal');
        var revealObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    revealObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        reveals.forEach(function (el) { revealObs.observe(el); });

        /* ── Mobile nav toggle (CSS-driven animation) ── */
        var navToggle  = document.getElementById('js-nav-toggle');
        var mobileDrawer = document.getElementById('js-mobile-drawer');
        var isOpen = false;

        function closeMenu() {
            isOpen = false;
            navToggle.classList.remove('open');
            navToggle.setAttribute('aria-expanded', 'false');
            mobileDrawer.classList.remove('open');
            document.body.style.overflow = '';
        }

        if (navToggle && mobileDrawer) {
            navToggle.addEventListener('click', function () {
                isOpen = !isOpen;
                navToggle.classList.toggle('open', isOpen);
                navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                mobileDrawer.classList.toggle('open', isOpen);
                document.body.style.overflow = isOpen ? 'hidden' : '';
            });

            /* Close on link click */
            mobileDrawer.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });

            /* Close on outside click */
            document.addEventListener('click', function (e) {
                if (isOpen && !nav.contains(e.target) && !mobileDrawer.contains(e.target)) {
                    closeMenu();
                }
            });
        }

        /* ── Back to top ── */
        var backTop = document.getElementById('js-back-top');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                backTop.classList.add('visible');
            } else {
                backTop.classList.remove('visible');
            }
        }, { passive: true });
        backTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        /* ── Animated counters ── */
        function animateCounter(el) {
            var target    = parseFloat(el.dataset.target);
            var suffix    = el.dataset.suffix || '';
            var isDecimal = el.dataset.decimal === 'true';
            var duration  = 1800;
            var start     = null;

            function step(ts) {
                if (!start) start = ts;
                var progress = Math.min((ts - start) / duration, 1);
                var ease     = 1 - Math.pow(1 - progress, 3); /* ease-out-cubic */
                var val      = target * ease;
                el.textContent = (isDecimal ? val.toFixed(1) : Math.floor(val).toLocaleString('id-ID')) + suffix;
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = (isDecimal ? target.toFixed(1) : target.toLocaleString('id-ID')) + suffix;
            }
            requestAnimationFrame(step);
        }

        var counterEls = document.querySelectorAll('[data-target]');
        var counterObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    animateCounter(e.target);
                    counterObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.5 });
        counterEls.forEach(function (el) { counterObs.observe(el); });
    </script>

</body>
</html>
