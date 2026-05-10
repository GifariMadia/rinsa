
<?php $__env->startSection('title', 'Laporan'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem">
    <h1 class="page-title" style="margin:0">Laporan</h1>
    <form method="GET" style="display:flex;gap:.5rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['all' => 'Semua Waktu', 'today' => 'Hari Ini', 'week' => 'Minggu Ini', 'month' => 'Bulan Ini']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="submit" name="period" value="<?php echo e($val); ?>"
                    style="padding:6px 14px;border-radius:6px;font-size:.78rem;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;border:1.5px solid <?php echo e($period === $val ? 'var(--rinsa-green)' : 'var(--rinsa-border)'); ?>;background:<?php echo e($period === $val ? 'var(--rinsa-green)' : '#fff'); ?>;color:<?php echo e($period === $val ? '#fff' : 'var(--rinsa-gray)'); ?>">
                <?php echo e($label); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </form>
</div>


<div class="report-grid" style="margin-bottom:1.5rem">
    <div class="report-card">
        <div class="report-num">Rp <?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?></div>
        <div class="report-label">Total Pendapatan</div>
    </div>
    <div class="report-card">
        <div class="report-num"><?php echo e($stats['total_orders']); ?></div>
        <div class="report-label">Total Order</div>
    </div>
    <div class="report-card">
        <div class="report-num"><?php echo e(number_format($stats['total_weight'], 1, ',', '.')); ?> kg</div>
        <div class="report-label">Total Berat</div>
    </div>
    <div class="report-card">
        <div class="report-num"><?php echo e($stats['total_customers']); ?></div>
        <div class="report-label">Total Pelanggan</div>
    </div>
</div>


<div class="section-title">Distribusi Layanan</div>
<div class="table-wrap" style="margin-bottom:1.5rem">
    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jumlah Order</th>
                <th>Pendapatan</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $byService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e(\App\Models\Order::SERVICE_LABELS[$row->service] ?? $row->service); ?></td>
                <td><?php echo e($row->total); ?></td>
                <td>Rp <?php echo e(number_format($row->revenue, 0, ',', '.')); ?></td>
                <td>
                    <?php $pct = $stats['total_orders'] > 0 ? round($row->total / $stats['total_orders'] * 100) : 0; ?>
                    <div style="display:flex;align-items:center;gap:8px">
                        <div style="flex:1;height:6px;background:var(--rinsa-border);border-radius:3px;max-width:100px">
                            <div style="width:<?php echo e($pct); ?>%;height:100%;background:var(--rinsa-green);border-radius:3px"></div>
                        </div>
                        <span style="font-size:.78rem"><?php echo e($pct); ?>%</span>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">Tidak ada data.</td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>


<div class="section-title">Tren 7 Hari Terakhir</div>
<div class="table-wrap">
    <table>
        <thead>
            <tr><th>Tanggal</th><th>Jumlah Order</th><th>Pendapatan</th></tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $dailyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e(\Carbon\Carbon::parse($day->date)->translatedFormat('d M Y')); ?></td>
                <td><?php echo e($day->orders); ?></td>
                <td>Rp <?php echo e(number_format($day->revenue, 0, ',', '.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3" style="text-align:center;padding:2rem;color:var(--rinsa-gray)">Tidak ada data.</td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/admin/report.blade.php ENDPATH**/ ?>