<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo $__env->yieldContent('title', 'Rinsa'); ?> — Rinsa Laundry</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <style>
        /* ===== Global Variables ===== */
        :root {
            --rinsa-green:        #0F6E56;
            --rinsa-green-light:  #1D9E75;
            --rinsa-green-dim:    #0a4f3e;
            --rinsa-gold:         #BA7517;
            --rinsa-gold-light:   #d4921f;
            --rinsa-dark:         #1E1E1C;
            --rinsa-gray:         #6B6A66;
            --rinsa-gray-light:   #9B9A96;
            --rinsa-cream:        #F0EDE4;
            --rinsa-cream-dark:   #E6E2D8;
            --rinsa-border:       #D6D3C8;
            --rinsa-border-light: #E8E5DC;
            --rinsa-bg:           #F5F3EE;
            --rinsa-white:        #FDFCFA;
            --nav-h:              64px;
            --sidebar-w:          240px;
            --sidebar-w-collapsed: 64px;
            --transition:         0.22s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow:    0.35s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm:          0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md:          0 4px 16px rgba(15,110,86,0.10), 0 1px 4px rgba(0,0,0,0.06);
            --shadow-lg:          0 8px 32px rgba(15,110,86,0.14), 0 2px 8px rgba(0,0,0,0.08);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--rinsa-bg);
            color: var(--rinsa-dark);
            min-height: 100vh;
        }

        /* ===================================================
           NOISE TEXTURE OVERLAY (subtle premium touch)
        =================================================== */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }

        /* ===================================================
           TOP NAV
        =================================================== */
        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--nav-h);
            background: rgba(253, 252, 250, 0.92);
            backdrop-filter: blur(16px) saturate(1.6);
            -webkit-backdrop-filter: blur(16px) saturate(1.6);
            border-bottom: 1px solid var(--rinsa-border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 200;
            box-shadow: 0 1px 0 rgba(255,255,255,0.8), var(--shadow-sm);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Sidebar toggle button */
        .nav-sidebar-toggle {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--rinsa-gray);
            font-size: 18px;
            transition: all var(--transition);
            flex-shrink: 0;
            padding: 0;
            line-height: 1;
        }
        .nav-sidebar-toggle:hover {
            background: var(--rinsa-cream);
            border-color: var(--rinsa-border);
            color: var(--rinsa-green);
        }
        .nav-sidebar-toggle svg {
            width: 18px; height: 18px;
            transition: transform var(--transition);
        }

        .nav-brand {
            font-family: 'DM Serif Display', serif;
            font-size: 1.65rem;
            color: var(--rinsa-green);
            text-decoration: none;
            letter-spacing: -0.5px;
            line-height: 1;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-brand-dot {
            width: 6px; height: 6px;
            background: var(--rinsa-gold);
            border-radius: 50%;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Notification bell */
        .nav-notif {
            position: relative;
            width: 38px; height: 38px;
            border-radius: 11px;
            background: var(--rinsa-cream);
            border: 1px solid var(--rinsa-border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--rinsa-gray);
            font-size: 16px;
            transition: all var(--transition);
            text-decoration: none;
        }
        .nav-notif:hover {
            background: #e2f4ec;
            color: var(--rinsa-green);
            border-color: #a7dfc8;
            box-shadow: 0 2px 8px rgba(15,110,86,0.12);
            transform: translateY(-1px);
        }
        .nav-notif-dot {
            position: absolute;
            top: 8px; right: 9px;
            width: 7px; height: 7px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--rinsa-white);
            animation: pulseDot 2s ease-in-out infinite;
        }
        @keyframes pulseDot {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.4); }
            50% { box-shadow: 0 0 0 4px rgba(239,68,68,0); }
        }

        /* Avatar chip */
        .nav-user {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 5px 14px 5px 5px;
            border-radius: 30px;
            background: var(--rinsa-cream);
            border: 1px solid var(--rinsa-border);
            color: var(--rinsa-dark);
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 700;
            transition: all var(--transition);
            letter-spacing: -0.2px;
        }
        .nav-user:hover {
            background: #e2f4ec;
            border-color: #a7dfc8;
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }
        .nav-user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 0 2px rgba(15,110,86,0.15);
        }
        .nav-user-initial {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--rinsa-gold) 0%, var(--rinsa-green) 100%);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 800;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.6), 0 2px 6px rgba(15,110,86,0.25);
        }

        /* Logout button */
        .nav-logout {
            background: none;
            border: 1px solid var(--rinsa-border);
            color: var(--rinsa-gray);
            padding: 7px 18px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: all var(--transition);
            letter-spacing: 0.01em;
        }
        .nav-logout:hover {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fca5a5;
            box-shadow: 0 2px 8px rgba(185,28,28,0.1);
        }

        /* ===================================================
           LAYOUT
        =================================================== */
        .layout {
            display: flex;
            min-height: 100vh;
            padding-top: var(--nav-h);
        }

        /* ===================================================
           SIDEBAR
        =================================================== */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--rinsa-white);
            border-right: 1px solid var(--rinsa-border-light);
            padding: 16px 10px;
            position: fixed;
            top: var(--nav-h);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            gap: 2px;
            z-index: 90;
            transition: width var(--transition-slow);
            box-shadow: 1px 0 0 var(--rinsa-border-light), var(--shadow-sm);
        }
        .sidebar::after {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--rinsa-border), transparent);
            pointer-events: none;
        }

        /* Scrollbar styling */
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--rinsa-border); border-radius: 3px; }

        .sidebar-label {
            font-size: 0.62rem;
            font-weight: 800;
            color: var(--rinsa-gray-light);
            text-transform: uppercase;
            letter-spacing: 0.11em;
            padding: 10px 12px 6px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--transition), padding var(--transition-slow);
        }

        .sidebar-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--rinsa-border), transparent);
            margin: 8px 6px;
            transition: opacity var(--transition);
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border-radius: 11px;
            color: var(--rinsa-gray);
            font-size: 0.86rem;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition);
            white-space: nowrap;
            overflow: hidden;
            position: relative;
        }
        .sidebar-item:hover {
            background: var(--rinsa-cream);
            color: var(--rinsa-dark);
            transform: translateX(2px);
        }
        .sidebar-item.active {
            background: linear-gradient(135deg, var(--rinsa-green) 0%, var(--rinsa-green-light) 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(15,110,86,0.30), inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 25%; bottom: 25%;
            width: 3px;
            background: rgba(255,255,255,0.6);
            border-radius: 0 3px 3px 0;
        }
        .sidebar-item-text {
            transition: opacity var(--transition-slow), transform var(--transition-slow);
            transform-origin: left center;
        }

        .sidebar-icon {
            font-size: 17px;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
            transition: transform var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar-item:hover .sidebar-icon { transform: scale(1.1); }
        .sidebar-item.active .sidebar-icon { transform: scale(1.05); }

        /* Profile chip at bottom */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid var(--rinsa-border-light);
        }
        .sidebar-profile-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 11px;
            text-decoration: none;
            color: var(--rinsa-dark);
            transition: all var(--transition);
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar-profile-chip:hover {
            background: var(--rinsa-cream);
            transform: translateX(2px);
        }
        .sidebar-profile-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(15,110,86,0.12);
        }
        .sidebar-profile-initial {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--rinsa-gold), var(--rinsa-green));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.5), 0 2px 6px rgba(15,110,86,0.25);
        }
        .sidebar-profile-info {
            line-height: 1.35;
            transition: opacity var(--transition-slow);
            min-width: 0;
        }
        .sidebar-profile-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--rinsa-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile-role {
            font-size: 0.68rem;
            color: var(--rinsa-gray-light);
            font-weight: 600;
        }

        /* ===================================================
           SIDEBAR TOOLTIP (shown when collapsed)
        =================================================== */
        .sidebar-tooltip {
            position: absolute;
            left: calc(var(--sidebar-w-collapsed) + 8px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--rinsa-dark);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 7px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity var(--transition);
            z-index: 300;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }
        .sidebar-tooltip::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: var(--rinsa-dark);
        }

        /* ===================================================
           COLLAPSED STATE
        =================================================== */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-w-collapsed);
        }
        body.sidebar-collapsed .sidebar-label {
            opacity: 0;
            padding: 10px 12px 0;
            pointer-events: none;
        }
        body.sidebar-collapsed .sidebar-item-text,
        body.sidebar-collapsed .sidebar-profile-info {
            opacity: 0;
            pointer-events: none;
        }
        body.sidebar-collapsed .sidebar-item:hover .sidebar-tooltip {
            opacity: 1;
        }
        body.sidebar-collapsed .main {
            margin-left: var(--sidebar-w-collapsed);
        }
        body.sidebar-collapsed .sidebar-item.active::before {
            display: none;
        }
        body.sidebar-collapsed .sidebar-item:hover {
            transform: none;
        }
        body.sidebar-collapsed .sidebar-profile-chip:hover {
            transform: none;
        }
        body.sidebar-collapsed .sidebar-divider {
            opacity: 0;
        }

        /* ===================================================
           MAIN CONTENT
        =================================================== */
        .main {
            flex: 1;
            margin-left: var(--sidebar-w);
            padding: 32px 32px 80px;
            min-width: 0;
            transition: margin-left var(--transition-slow);
        }

        /* ===================================================
           TOAST NOTIFICATIONS (fixed top-right, premium)
        =================================================== */
        .toast-container {
            position: fixed;
            top: calc(var(--nav-h) + 16px);
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 500;
            width: 340px;
            max-width: calc(100vw - 32px);
            pointer-events: none;
        }
        .toast-modern {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid;
            animation: toastIn 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
            position: relative;
            pointer-events: all;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10), 0 2px 8px rgba(0,0,0,0.06);
        }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(24px) scale(0.96); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }
        .toast-success {
            background: rgba(240, 253, 244, 0.96);
            border-color: #86efac;
        }
        .toast-error {
            background: rgba(254, 242, 242, 0.96);
            border-color: #fca5a5;
        }
        .toast-icon    { font-size: 18px; line-height: 1; flex-shrink: 0; margin-top: 1px; }
        .toast-body    { flex: 1; }
        .toast-title   { font-size: 0.82rem; font-weight: 800; margin-bottom: 3px; letter-spacing: -0.2px; }
        .toast-success .toast-title { color: #15803d; }
        .toast-error   .toast-title { color: #b91c1c; }
        .toast-msg     { font-size: 0.79rem; color: var(--rinsa-gray); line-height: 1.55; }
        .toast-close {
            background: none; border: none; cursor: pointer; padding: 0;
            color: var(--rinsa-gray-light); font-size: 20px; line-height: 1;
            flex-shrink: 0; transition: all var(--transition);
            width: 20px; height: 20px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 5px;
        }
        .toast-close:hover {
            opacity: 1;
            background: rgba(0,0,0,0.06);
            color: var(--rinsa-dark);
        }

        /* Progress bar on toast */
        .toast-progress {
            position: absolute;
            bottom: 0; left: 0;
            height: 3px;
            border-radius: 0 0 14px 14px;
            animation: toastProgress 5s linear forwards;
        }
        .toast-success .toast-progress { background: #22c55e; }
        .toast-error   .toast-progress { background: #ef4444; }
        @keyframes toastProgress {
            from { width: 100%; }
            to   { width: 0%; }
        }

        /* ===================================================
           MOBILE BOTTOM NAV
        =================================================== */
        .mobile-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: rgba(253,252,250,0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid var(--rinsa-border-light);
            z-index: 200;
            padding-bottom: env(safe-area-inset-bottom, 0);
            box-shadow: 0 -4px 24px rgba(0,0,0,0.06);
        }
        .mobile-nav-items {
            display: flex;
            justify-content: space-around;
        }
        .mobile-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 10px 4px;
            text-decoration: none;
            font-size: 0.64rem;
            font-weight: 700;
            color: var(--rinsa-gray-light);
            transition: color var(--transition);
            letter-spacing: 0.02em;
        }
        .mobile-nav-item.active { color: var(--rinsa-green); }
        .mobile-nav-icon {
            font-size: 20px;
            display: block;
            transition: transform var(--transition);
        }
        .mobile-nav-item.active .mobile-nav-icon { transform: scale(1.12); }

        /* ===================================================
           RESPONSIVE
        =================================================== */
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar             { display: none; }
            .main                { margin-left: 0; padding: 20px 16px 80px; }
            .mobile-nav          { display: block; }
            .nav-logout          { display: none; }
            .nav-sidebar-toggle  { display: none; }
            .toast-container     { right: 10px; width: calc(100vw - 20px); }
        }

        /* ===================================================
           KEYBOARD SHORTCUT BADGE  (Ctrl+B hint)
        =================================================== */
        .nav-kbd-hint {
            font-size: 0.67rem;
            color: var(--rinsa-gray-light);
            padding: 2px 7px;
            background: var(--rinsa-cream-dark);
            border: 1px solid var(--rinsa-border);
            border-radius: 5px;
            font-weight: 700;
            letter-spacing: 0.02em;
            display: none;
        }
        @media (min-width: 1024px) {
            .nav-kbd-hint { display: inline-block; }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    
    <nav class="nav">
        <div class="nav-left">
            
            <button class="nav-sidebar-toggle" id="js-sidebar-toggle"
                    aria-label="Sembunyikan/tampilkan sidebar"
                    title="Toggle Sidebar (Ctrl+B)">
                <svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round">
                    <line x1="2" y1="5" x2="16" y2="5"/>
                    <line x1="2" y1="9" x2="16" y2="9"/>
                    <line x1="2" y1="13" x2="16" y2="13"/>
                </svg>
            </button>

            <a href="<?php echo e(route('dashboard')); ?>" class="nav-brand">
                Rinsa<span class="nav-brand-dot"></span>
            </a>

            <span class="nav-kbd-hint">Ctrl+B</span>
        </div>

        <div class="nav-right">

            
            <a href="#" class="nav-notif" title="Notifikasi" aria-label="Notifikasi">
                &#x1F514;
                
            </a>

            
            <a href="<?php echo e(route('profile.index')); ?>" class="nav-user" aria-label="Lihat profil <?php echo e(auth()->user()->name); ?>">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>"
                         class="nav-user-avatar"
                         alt="Avatar <?php echo e(auth()->user()->name); ?>">
                <?php else: ?>
                    <span class="nav-user-initial" aria-hidden="true">
                        <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php echo e(auth()->user()->name); ?>

            </a>

            
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-logout">Keluar</button>
            </form>
        </div>
    </nav>

    
    <div class="layout">

        
        <aside class="sidebar" id="js-sidebar">
            <?php
                $current = request()->routeIs('dashboard')   ? 'dashboard'
                    : (request()->routeIs('orders.*')        ? 'orders'
                    : (request()->routeIs('customers.*')     ? 'customers'
                    : (request()->routeIs('report')          ? 'report' : '')));
            ?>

            <div class="sidebar-label">Menu Utama</div>

            <a href="<?php echo e(route('dashboard')); ?>"
               class="sidebar-item <?php echo e($current === 'dashboard' ? 'active' : ''); ?>"
               style="position:relative">
                <span class="sidebar-icon">⊞</span>
                <span class="sidebar-item-text">Dashboard</span>
                <span class="sidebar-tooltip">Dashboard</span>
            </a>

            <a href="<?php echo e(route('orders.index')); ?>"
               class="sidebar-item <?php echo e($current === 'orders' ? 'active' : ''); ?>"
               style="position:relative">
                <span class="sidebar-icon">◈</span>
                <span class="sidebar-item-text">Manajemen Order</span>
                <span class="sidebar-tooltip">Manajemen Order</span>
            </a>

            <a href="<?php echo e(route('customers.index')); ?>"
               class="sidebar-item <?php echo e($current === 'customers' ? 'active' : ''); ?>"
               style="position:relative">
                <span class="sidebar-icon">◉</span>
                <span class="sidebar-item-text">Pelanggan</span>
                <span class="sidebar-tooltip">Pelanggan</span>
            </a>

            <a href="<?php echo e(route('report')); ?>"
               class="sidebar-item <?php echo e($current === 'report' ? 'active' : ''); ?>"
               style="position:relative">
                <span class="sidebar-icon">◐</span>
                <span class="sidebar-item-text">Laporan</span>
                <span class="sidebar-tooltip">Laporan</span>
            </a>

            
            <div class="sidebar-bottom">
                <a href="<?php echo e(route('profile.index')); ?>" class="sidebar-profile-chip">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>"
                             class="sidebar-profile-avatar"
                             alt="Avatar">
                    <?php else: ?>
                        <div class="sidebar-profile-initial" aria-hidden="true">
                            <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="sidebar-profile-info">
                        <div class="sidebar-profile-name"><?php echo e(auth()->user()->name); ?></div>
                        <div class="sidebar-profile-role"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                    </div>
                </a>
            </div>
        </aside>

        
        <main class="main" id="js-main">

            
            <div class="toast-container" id="js-toast-container">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                    <div class="toast-modern toast-success" role="alert">
                        <span class="toast-icon" aria-hidden="true">✅</span>
                        <div class="toast-body">
                            <div class="toast-title">Berhasil!</div>
                            <div class="toast-msg"><?php echo e(session('success')); ?></div>
                        </div>
                        <button class="toast-close" onclick="this.closest('.toast-modern').remove()" aria-label="Tutup">×</button>
                        <div class="toast-progress"></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="toast-modern toast-error" role="alert">
                        <span class="toast-icon" aria-hidden="true">⚠️</span>
                        <div class="toast-body">
                            <div class="toast-title">Ada Masalah</div>
                            <div class="toast-msg">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($error); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <button class="toast-close" onclick="this.closest('.toast-modern').remove()" aria-label="Tutup">×</button>
                        <div class="toast-progress"></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    
    <div class="mobile-nav" aria-label="Navigasi mobile">
        <div class="mobile-nav-items">
            <a href="<?php echo e(route('dashboard')); ?>"
               class="mobile-nav-item <?php echo e($current === 'dashboard' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">⊞</span><span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('orders.index')); ?>"
               class="mobile-nav-item <?php echo e($current === 'orders' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◈</span><span>Order</span>
            </a>
            <a href="<?php echo e(route('customers.index')); ?>"
               class="mobile-nav-item <?php echo e($current === 'customers' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◉</span><span>Pelanggan</span>
            </a>
            <a href="<?php echo e(route('report')); ?>"
               class="mobile-nav-item <?php echo e($current === 'report' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◐</span><span>Laporan</span>
            </a>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script>
        /* ─── Sidebar Collapsible ─── */
        (function () {
            var STORAGE_KEY = 'rinsa_sidebar_collapsed';
            var body        = document.body;
            var btn         = document.getElementById('js-sidebar-toggle');

            function isCollapsed() {
                try { return localStorage.getItem(STORAGE_KEY) === '1'; } catch(e) { return false; }
            }
            function setCollapsed(val) {
                try { localStorage.setItem(STORAGE_KEY, val ? '1' : '0'); } catch(e) {}
            }

            function apply(collapsed) {
                if (collapsed) {
                    body.classList.add('sidebar-collapsed');
                } else {
                    body.classList.remove('sidebar-collapsed');
                }
            }

            // Init state from localStorage
            apply(isCollapsed());

            if (btn) {
                btn.addEventListener('click', function () {
                    var next = !body.classList.contains('sidebar-collapsed');
                    apply(next);
                    setCollapsed(next);
                });
            }

            // Keyboard shortcut: Ctrl+B
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                    e.preventDefault();
                    var next = !body.classList.contains('sidebar-collapsed');
                    apply(next);
                    setCollapsed(next);
                }
            });
        })();

        /* ─── Auto-dismiss toast setelah 5 detik ─── */
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toast-modern').forEach(function (toast) {
                setTimeout(function () {
                    toast.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    toast.style.opacity    = '0';
                    toast.style.transform  = 'translateX(12px) scale(0.96)';
                    setTimeout(function () { toast.remove(); }, 400);
                }, 5000);
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/layouts/app.blade.php ENDPATH**/ ?>