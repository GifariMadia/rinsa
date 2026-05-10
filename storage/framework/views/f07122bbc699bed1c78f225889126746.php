<div>
    
    <div class="topbar">
        <h1 class="page-title" style="margin:0">Manajemen Order</h1>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;width:100%">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                class="search-input"
                placeholder="Cari order / pelanggan..."
                style="flex:1;min-width:140px"
            />
            <select wire:model.live="statusFilter" class="form-select" style="width:auto;font-size:.82rem;padding:7px 10px">
                <option value="">Semua Status</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>"><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <a href="<?php echo e(route('orders.create')); ?>" class="btn-add">+ Tambah</a>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="table-wrap desktop-only">
        <table>
            <thead>
                <tr>
                    <th><button wire:click="sortBy('order_code')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">ID <?php echo e($sortBy==='order_code' ? ($sortDir==='asc'?'↑':'↓') : ''); ?></button></th>
                    <th>Pelanggan</th>
                    <th><button wire:click="sortBy('weight_kg')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">Berat <?php echo e($sortBy==='weight_kg' ? ($sortDir==='asc'?'↑':'↓') : ''); ?></button></th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th><button wire:click="sortBy('total_price')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">Total <?php echo e($sortBy==='total_price' ? ($sortDir==='asc'?'↑':'↓') : ''); ?></button></th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr wire:key="tbl-<?php echo e($order->id); ?>">
                    <td><span style="font-family:monospace;font-size:.78rem;color:var(--rinsa-gray)"><?php echo e($order->order_code); ?></span></td>
                    <td><?php echo e($order->customer->name); ?></td>
                    <td><?php echo e($order->weight_kg); ?> kg</td>
                    <td style="font-size:.8rem"><?php echo e($order->service_label); ?></td>
                    <td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e($order->status_label); ?></span></td>
                    <td>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                    <td style="font-size:.78rem;color:var(--rinsa-gray)"><?php echo e($order->created_at->format('d M Y')); ?></td>
                    <td>
                        <div class="table-action">
                            <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn-sm btn-view">Detail</a>
                            <a href="<?php echo e(route('orders.edit', $order)); ?>" class="btn-sm btn-edit">Edit</a>
                            <button wire:click="deleteOrder(<?php echo e($order->id); ?>)" wire:confirm="Hapus order <?php echo e($order->order_code); ?>?" class="btn-sm btn-del">Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">Tidak ada order ditemukan.</td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mobile-card-list">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="order-mobile-card" wire:key="mob-<?php echo e($order->id); ?>">
            <div class="order-mobile-card-top">
                <div>
                    <div class="order-mobile-name"><?php echo e($order->customer->name); ?></div>
                    <div class="order-mobile-code"><?php echo e($order->order_code); ?></div>
                </div>
                <span class="badge badge-<?php echo e($order->status); ?>"><?php echo e($order->status_label); ?></span>
            </div>
            <div class="order-mobile-meta">
                <span class="order-mobile-detail"><?php echo e($order->weight_kg); ?> kg · <?php echo e($order->service_label); ?></span>
                <span class="order-mobile-price">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
            </div>
            <div class="order-mobile-actions">
                <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn-sm btn-view">Detail</a>
                <a href="<?php echo e(route('orders.edit', $order)); ?>" class="btn-sm btn-edit">Edit</a>
                <button wire:click="deleteOrder(<?php echo e($order->id); ?>)" wire:confirm="Hapus?" class="btn-sm btn-del">Hapus</button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align:center;padding:3rem 1rem;color:var(--rinsa-gray)">Tidak ada order ditemukan.</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orders->hasPages()): ?>
        <div style="margin-top:1rem"><?php echo e($orders->links()); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/livewire/order-table.blade.php ENDPATH**/ ?>