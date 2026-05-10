<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Rinsa') — Rinsa Laundry</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    {{-- App CSS (compiled via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles')
</head>
<body class="bg-cream text-dark">

    {{-- ===== TOPNAV ===== --}}
    <nav class="nav">
        <a href="{{ route('dashboard') }}" class="nav-brand">Rinsa</a>
        <div class="nav-right">
            
            {{-- Nama User sekarang menjadi link ke Halaman Profil --}}
            <a href="{{ route('profile.index') }}" 
               class="nav-user" 
               style="text-decoration: none; display: flex; align-items: center; gap: 10px; transition: opacity 0.2s;"
               onmouseover="this.style.opacity='0.8'" 
               onmouseout="this.style.opacity='1'">
                
                {{-- Logika Avatar & Inisial --}}
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                @else
                    <span style="background: linear-gradient(135deg, var(--rinsa-gold) 0%, var(--rinsa-green) 100%); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                @endif
                
                {{ auth()->user()->name }}
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="nav-logout">Keluar</button>
            </form>
        </div>
    </nav>

    {{-- ===== LAYOUT ===== --}}
    <div class="layout">

        {{-- Sidebar --}}
        <aside class="sidebar">
            @php $current = request()->routeIs('dashboard') ? 'dashboard'
                : (request()->routeIs('orders.*') ? 'orders'
                : (request()->routeIs('customers.*') ? 'customers'
                : (request()->routeIs('report') ? 'report' : ''))); @endphp

            <a href="{{ route('dashboard') }}"
               class="sidebar-item {{ $current === 'dashboard' ? 'active' : '' }}">
                <span class="sidebar-icon">◼</span> Dashboard
            </a>
            <a href="{{ route('orders.index') }}"
               class="sidebar-item {{ $current === 'orders' ? 'active' : '' }}">
                <span class="sidebar-icon">◈</span> Manajemen Order
            </a>
            <a href="{{ route('customers.index') }}"
               class="sidebar-item {{ $current === 'customers' ? 'active' : '' }}">
                <span class="sidebar-icon">◉</span> Pelanggan
            </a>
            <a href="{{ route('report') }}"
               class="sidebar-item {{ $current === 'report' ? 'active' : '' }}">
                <span class="sidebar-icon">◐</span> Laporan
            </a>
        </aside>

        {{-- Main Content --}}
        <main class="main">

            {{-- Modern Toast Notifications --}}
            <div class="toast-container">
                @if(session('success'))
                    <div class="toast-modern toast-success">
                        <span class="toast-icon">✨</span>
                        <div>
                            <div class="toast-title">Berhasil!</div>
                            <div class="toast-msg">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="toast-modern toast-error">
                        <span class="toast-icon">⚠️</span>
                        <div>
                            <div class="toast-title">Ada Masalah</div>
                            <div class="toast-msg">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>
    </div>

    {{-- Mobile Bottom Nav --}}
    <div class="mobile-nav">
        <div class="mobile-nav-items">
            <a href="{{ route('dashboard') }}" class="mobile-nav-item {{ $current === 'dashboard' ? 'active' : '' }}">
                <span class="mobile-nav-icon">◼</span><span>Dashboard</span>
            </a>
            <a href="{{ route('orders.index') }}" class="mobile-nav-item {{ $current === 'orders' ? 'active' : '' }}">
                <span class="mobile-nav-icon">◈</span><span>Order</span>
            </a>
            <a href="{{ route('customers.index') }}" class="mobile-nav-item {{ $current === 'customers' ? 'active' : '' }}">
                <span class="mobile-nav-icon">◉</span><span>Pelanggan</span>
            </a>
            <a href="{{ route('report') }}" class="mobile-nav-item {{ $current === 'report' ? 'active' : '' }}">
                <span class="mobile-nav-icon">◐</span><span>Laporan</span>
            </a>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>