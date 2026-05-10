

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="page-title">Dashboard</h1>


<div class="metric-grid">
    <div class="metric-card metric-accent">
        <div class="metric-val"><?php echo e($stats['total_orders']); ?></div>
        <div class="metric-label">Total Order</div>
    </div>
    <div class="metric-card">
        <div class="metric-val" style="color:var(--rinsa-warn)"><?php echo e($stats['pending']); ?></div>
        <div class="metric-label">Menunggu</div>
    </div>
    <div class="metric-card">
        <div class="metric-val" style="color:var(--rinsa-blue)"><?php echo e($stats['washing']); ?></div>
        <div class="metric-label">Dicuci</div>
    </div>
    <div class="metric-card metric-accent-gold">
        <div class="metric-val"><?php echo e($stats['done']); ?></div>
        <div class="metric-label">Selesai</div>
    </div>
</div>


<div class="metric-card" style="margin-bottom:1.75rem">
    <div class="metric-label">Total Pendapatan</div>
    <div style="font-size:1.75rem;font-weight:600;color:var(--rinsa-green);font-family:'DM Serif Display',serif;margin-top:6px">
        Rp <?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?>

    </div>
</div>


<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
    <div class="section-title" style="margin:0">Order Terbaru</div>
    <a href="<?php echo e(route('orders.index')); ?>" style="font-size:.8rem;color:var(--rinsa-green);font-weight:600;text-decoration:none">
        Lihat semua →
    </a>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <a href="<?php echo e(route('orders.show', $order)); ?>"
                       style="font-family:monospace;font-size:.78rem;color:var(--rinsa-gray);text-decoration:none;hover:color:var(--rinsa-green)">
                        <?php echo e($order->order_code); ?>

                    </a>
                </td>
                <td><?php echo e($order->customer->name); ?></td>
                <td><?php echo e($order->service_label); ?></td>
                <td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e($order->status_label); ?></span></td>
                <td>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">
                    Belum ada order.
                </td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>