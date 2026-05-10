<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo $__env->yieldContent('title', 'Rinsa'); ?> — Rinsa Laundry</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-cream text-dark">

    
    <nav class="nav">
        <a href="<?php echo e(route('dashboard')); ?>" class="nav-brand">Rinsa</a>
        <div class="nav-right">
            
            
            <a href="<?php echo e(route('profile.index')); ?>" 
               class="nav-user" 
               style="text-decoration: none; display: flex; align-items: center; gap: 10px; transition: opacity 0.2s;"
               onmouseover="this.style.opacity='0.8'" 
               onmouseout="this.style.opacity='1'">
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                <?php else: ?>
                    <span style="background: linear-gradient(135deg, var(--rinsa-gold) 0%, var(--rinsa-green) 100%); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                        <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php echo e(auth()->user()->name); ?>

            </a>

            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-logout">Keluar</button>
            </form>
        </div>
    </nav>

    
    <div class="layout">

        
        <aside class="sidebar">
            <?php $current = request()->routeIs('dashboard') ? 'dashboard'
                : (request()->routeIs('orders.*') ? 'orders'
                : (request()->routeIs('customers.*') ? 'customers'
                : (request()->routeIs('report') ? 'report' : ''))); ?>

            <a href="<?php echo e(route('dashboard')); ?>"
               class="sidebar-item <?php echo e($current === 'dashboard' ? 'active' : ''); ?>">
                <span class="sidebar-icon">◼</span> Dashboard
            </a>
            <a href="<?php echo e(route('orders.index')); ?>"
               class="sidebar-item <?php echo e($current === 'orders' ? 'active' : ''); ?>">
                <span class="sidebar-icon">◈</span> Manajemen Order
            </a>
            <a href="<?php echo e(route('customers.index')); ?>"
               class="sidebar-item <?php echo e($current === 'customers' ? 'active' : ''); ?>">
                <span class="sidebar-icon">◉</span> Pelanggan
            </a>
            <a href="<?php echo e(route('report')); ?>"
               class="sidebar-item <?php echo e($current === 'report' ? 'active' : ''); ?>">
                <span class="sidebar-icon">◐</span> Laporan
            </a>
        </aside>

        
        <main class="main">

            
            <div class="toast-container">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                    <div class="toast-modern toast-success">
                        <span class="toast-icon">✨</span>
                        <div>
                            <div class="toast-title">Berhasil!</div>
                            <div class="toast-msg"><?php echo e(session('success')); ?></div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="toast-modern toast-error">
                        <span class="toast-icon">⚠️</span>
                        <div>
                            <div class="toast-title">Ada Masalah</div>
                            <div class="toast-msg">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($error); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    
    <div class="mobile-nav">
        <div class="mobile-nav-items">
            <a href="<?php echo e(route('dashboard')); ?>" class="mobile-nav-item <?php echo e($current === 'dashboard' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◼</span><span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('orders.index')); ?>" class="mobile-nav-item <?php echo e($current === 'orders' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◈</span><span>Order</span>
            </a>
            <a href="<?php echo e(route('customers.index')); ?>" class="mobile-nav-item <?php echo e($current === 'customers' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◉</span><span>Pelanggan</span>
            </a>
            <a href="<?php echo e(route('report')); ?>" class="mobile-nav-item <?php echo e($current === 'report' ? 'active' : ''); ?>">
                <span class="mobile-nav-icon">◐</span><span>Laporan</span>
            </a>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/layouts/app.blade.php ENDPATH**/ ?>