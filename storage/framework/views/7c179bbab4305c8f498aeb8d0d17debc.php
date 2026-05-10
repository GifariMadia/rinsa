<div style="max-width:640px">
    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
        <a href="<?php echo e(route('orders.index')); ?>" style="color:var(--rinsa-gray);text-decoration:none;font-size:.85rem">← Kembali</a>
        <h1 class="page-title" style="margin:0"><?php echo e($isEditing ? 'Edit Order' : 'Tambah Order'); ?></h1>
    </div>

    <div class="form-card">
        <form wire:submit="save">

            <div class="form-group">
                <label class="form-label">Pelanggan</label>
                <select wire:model="customerId" class="form-select" <?php echo e($isEditing ? 'disabled' : ''); ?> required>
                    <option value="0">— Pilih Pelanggan —</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>">
                            <?php echo e($c->name); ?><?php echo e($c->phone ? " ({$c->phone})" : ''); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customerId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color:var(--rinsa-red);font-size:.78rem"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isEditing): ?>
                    <div style="margin-top:.4rem">
                        <a href="<?php echo e(route('customers.create')); ?>" style="font-size:.78rem;color:var(--rinsa-green)">
                            + Tambah pelanggan baru
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Berat (kg)</label>
                    <input
                        type="number"
                        wire:model.live="weightKg"
                        class="form-input"
                        placeholder="3.5" step="0.5" min="0.5" required
                    />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['weightKg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color:var(--rinsa-red);font-size:.78rem"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="form-label">Layanan</label>
                    <select wire:model.live="service" class="form-select" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>">
                                <?php echo e($label); ?> — Rp <?php echo e(number_format($priceMap[$val], 0, ',', '.')); ?>/kg
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEditing): ?>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select wire:model="status" class="form-select" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($val); ?>"><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Estimasi Selesai</label>
                    <input type="date" wire:model="estimatedDone" class="form-input" />
                </div>
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <input type="text" wire:model="notes" class="form-input" placeholder="Pisahkan warna, dll." />
                </div>
            </div>

            
            <div style="background:var(--rinsa-cream);border-radius:8px;padding:.9rem 1rem;margin-bottom:1.25rem;display:flex;justify-content:space-between;align-items:center">
                <div>
                    <span style="font-size:.78rem;color:var(--rinsa-gray)">Harga/kg: </span>
                    <span style="font-size:.82rem;color:var(--rinsa-dark)">Rp <?php echo e($pricePerKg); ?></span>
                </div>
                <div>
                    <span style="font-size:.78rem;color:var(--rinsa-gray)">Total: </span>
                    <strong style="color:var(--rinsa-green);font-size:1rem">
                        Rp <?php echo e(number_format($totalPrice, 0, ',', '.')); ?>

                    </strong>
                </div>
            </div>

            <div style="display:flex;gap:.75rem;justify-content:flex-end">
                <a href="<?php echo e(route('orders.index')); ?>" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-save" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                    <span wire:loading.remove><?php echo e($isEditing ? 'Simpan Perubahan' : 'Simpan Order'); ?></span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/livewire/order-form.blade.php ENDPATH**/ ?>