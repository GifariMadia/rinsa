

<?php $__env->startSection('content'); ?>
<style>
    /* Styling Khusus Halaman Profil */
    .profile-container {
        max-width: 800px;
        margin: 0 auto 2rem;
        animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--rinsa-border);
        overflow: hidden;
    }
    
    /* Cover Background */
    .profile-header-bg {
        background: linear-gradient(135deg, var(--rinsa-green) 0%, var(--rinsa-green-light) 100%);
        height: 140px;
        position: relative;
    }
    
    .profile-content {
        padding: 0 3rem 3rem;
    }
    
    /* Bagian Avatar Overlap */
    .avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: -65px; /* Membuat foto naik menutupi cover */
        margin-bottom: 2.5rem;
    }
    
    .avatar-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 6px solid #ffffff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        background: #fff;
        overflow: hidden;
        transition: var(--transition-smooth);
    }
    
    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .avatar-initial {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--rinsa-gold) 0%, var(--rinsa-green) 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-family: var(--font-heading);
    }
    
    /* Tombol Upload Melayang di Atas Foto */
    .avatar-upload-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.6);
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
        padding: 8px 0;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s;
        backdrop-filter: blur(2px);
    }
    
    .avatar-wrapper:hover .avatar-upload-overlay {
        opacity: 1;
    }

    .user-role-badge {
        margin-top: 12px;
        background: var(--rinsa-cream);
        color: var(--rinsa-green);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: 1px solid var(--rinsa-border);
    }
    
    /* Judul Tiap Sesi */
    .profile-section-title {
        font-size: 1.15rem;
        color: var(--rinsa-dark);
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px dashed #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .profile-section-title span {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--rinsa-gray);
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }
    
    .form-group-full {
        grid-column: 1 / -1;
    }

    @media (max-width: 680px) {
        .profile-content { padding: 0 1.5rem 2rem; }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header-bg"></div>

        <div class="profile-content">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="avatar-section">
                    <div class="avatar-wrapper">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="Avatar" class="avatar-img" id="avatarPreview">
                        <?php else: ?>
                            <div class="avatar-initial" id="avatarInitial">
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            </div>
                            <img src="" alt="Avatar" class="avatar-img" id="avatarPreview" style="display: none;">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <label for="avatar" class="avatar-upload-overlay">📷 Ubah Foto</label>
                    </div>
                    
                    <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none;">
                    
                    <div class="user-role-badge">
                        <?php echo e($user->role === 'admin' ? 'Administrator' : 'Pengguna'); ?>

                    </div>
                </div>

                <div class="profile-section-title">
                    Informasi Pribadi
                    <span>Wajib</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" required class="form-input" autocomplete="name">
                    </div>
        
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" required class="form-input" autocomplete="email">
                    </div>

                    <div class="form-group form-group-full">
                        <label for="bio" class="form-label">Bio Singkat</label>
                        <textarea name="bio" id="bio" rows="3" class="form-input" placeholder="Tulis sedikit tentang diri Anda..." style="resize: vertical;"><?php echo e(old('bio', $user->bio)); ?></textarea>
                    </div>
                </div>

                <div class="profile-section-title" style="margin-top: 1.5rem;">
                    Keamanan Akun
                    <span>Opsional</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Biarkan kosong jika tidak diubah">
                    </div>
        
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="showPassword" style="width: 16px; height: 16px; cursor: pointer; accent-color: var(--rinsa-green);">
                    <label for="showPassword" style="font-size: 0.85rem; font-weight: 500; color: var(--rinsa-gray); cursor: pointer; user-select: none;">Tampilkan Password</label>
                </div>

                <div style="display: flex; justify-content: flex-end; border-top: 1px solid var(--rinsa-border); padding-top: 1.5rem; margin-top: 1rem;">
                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Live Preview Gambar Sebelum Upload
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('avatarPreview');
                const initial = document.getElementById('avatarInitial');
                
                // Menampilkan gambar preview
                preview.src = event.target.result;
                preview.style.display = 'block';
                
                // Menyembunyikan inisial huruf jika sebelumnya belum ada foto
                if(initial) {
                    initial.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Fitur Intip Password
    document.getElementById('showPassword').addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        document.getElementById('password').type = type;
        document.getElementById('password_confirmation').type = type;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/profile/index.blade.php ENDPATH**/ ?>