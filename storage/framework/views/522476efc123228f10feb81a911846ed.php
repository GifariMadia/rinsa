<div>
    <div class="topbar">
        <h1 class="page-title" style="margin:0">Pelanggan</h1>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;width:100%">
            <input type="text" wire:model.live.debounce.300ms="search" class="search-input" placeholder="Cari nama / nomor HP..." style="flex:1;min-width:140px" />
            <a href="<?php echo e(route('customers.create')); ?>" class="btn-add">+ Tambah</a>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?><div class="alert alert-danger"><?php echo e(session('error')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="table-wrap desktop-only">
        <table>
            <thead><tr><th>Nama</th><th>No. HP</th><th>Alamat</th><th>Total Order</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr wire:key="tbl-c-<?php echo e($c->id); ?>">
                    <td style="font-weight:600"><?php echo e($c->name); ?></td>
                    <td><?php echo e($c->phone ?? '—'); ?></td>
                    <td style="font-size:.82rem;color:var(--rinsa-gray)"><?php echo e($c->address ?? '—'); ?></td>
                    <td><span style="background:var(--rinsa-cream);padding:2px 10px;border-radius:99px;font-size:.78rem;font-weight:600"><?php echo e($c->orders_count); ?></span></td>
                    <td>
                        <div class="table-action">
                            <a href="<?php echo e(route('customers.edit', $c)); ?>" class="btn-sm btn-edit">Edit</a>
                            <button wire:click="deleteCustomer(<?php echo e($c->id); ?>)" wire:confirm="Hapus pelanggan <?php echo e($c->name); ?>?" class="btn-sm btn-del">Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">Belum ada pelanggan.</td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mobile-card-list">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="order-mobile-card" wire:key="mob-c-<?php echo e($c->id); ?>">
            <div class="order-mobile-card-top">
                <div>
                    <div class="order-mobile-name"><?php echo e($c->name); ?></div>
                    <div class="order-mobile-code"><?php echo e($c->phone ?? 'Tanpa nomor HP'); ?></div>
                </div>
                <span style="background:var(--rinsa-cream);padding:3px 10px;border-radius:99px;font-size:.78rem;font-weight:600;color:var(--rinsa-dark)"><?php echo e($c->orders_count); ?> order</span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->address): ?>
            <div style="font-size:.8rem;color:var(--rinsa-gray);margin-bottom:8px"><?php echo e($c->address); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="order-mobile-actions">
                <a href="<?php echo e(route('customers.edit', $c)); ?>" class="btn-sm btn-edit" style="flex:1;text-align:center">Edit</a>
                <button wire:click="deleteCustomer(<?php echo e($c->id); ?>)" wire:confirm="Hapus?" class="btn-sm btn-del" style="flex:1">Hapus</button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align:center;padding:3rem 1rem;color:var(--rinsa-gray)">Belum ada pelanggan.</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customers->hasPages()): ?>
        <div style="margin-top:1rem"><?php echo e($customers->links()); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/livewire/customer-table.blade.php ENDPATH**/ ?>