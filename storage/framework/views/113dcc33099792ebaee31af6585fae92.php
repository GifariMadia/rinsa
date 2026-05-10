

<?php $__env->startSection('content'); ?>
<style>
    .edit-profile-container {
        max-width: 650px;
        margin: 0 auto 3rem;
        animation: fadeSlideUp 0.5s ease-out;
    }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .edit-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(15,110,86,0.1);
        border: 1px solid #e8e5dc;
        overflow: hidden;
    }
    .edit-header {
        background: linear-gradient(135deg, #0f6e56 0%, #1d9e75 100%);
        padding: 2rem;
        color: #fff;
        text-align: center;
    }
    .edit-header h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.8rem;
        margin: 0;
    }
    .edit-body { padding: 2.5rem; }
    
    /* Avatar Upload Styling */
    .avatar-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 2rem;
    }
    .avatar-preview-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #f5f3ee;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 1rem;
        background: #f0ede4;
    }
    .avatar-preview-img { width: 100%; height: 100%; object-fit: cover; }
    
    .btn-upload-label {
        background: #f0ede4;
        color: #1b4332;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        border: 1px solid #d6d3c8;
    }
    .btn-upload-label:hover { background: #e6e2d8; }

    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 800;
        color: #6b6a66;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 0.05em;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #d6d3c8;
        border-radius: 12px;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        transition: 0.2s;
        font-family: inherit;
    }
    .form-input:focus {
        outline: none;
        border-color: #0f6e56;
        box-shadow: 0 0 0 4px rgba(15,110,86,0.1);
    }
    
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 1rem;
    }
    .btn-save-profile {
        flex: 1;
        background: #0f6e56;
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-save-profile:hover { background: #0a5240; transform: translateY(-1px); }
    .btn-cancel {
        padding: 14px 24px;
        background: #fff;
        color: #6b6a66;
        border: 1.5px solid #d6d3c8;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        text-align: center;
    }
</style>

<div class="edit-profile-container">
    <div class="edit-card">
        <div class="edit-header">
            <h2>Edit Your Profile</h2>
        </div>
        
        <div class="edit-body">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="avatar-upload-section">
                    <div class="avatar-preview-wrapper">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="avatar-preview-img" id="previewImg">
                        <?php else: ?>
                            <div id="initialPlaceholder" style="width:100%; height:100%; background:linear-gradient(135deg, #ba7517, #0f6e56); color:white; display:flex; align-items:center; justify-content:center; font-size:3rem; font-family:'DM Serif Display', serif;">
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            </div>
                            <img src="" class="avatar-preview-img" id="previewImg" style="display:none">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <label for="avatar" class="btn-upload-label">📷 Change Photo</label>
                    <input type="file" name="avatar" id="avatar" style="display:none" accept="image/*">
                </div>

                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="<?php echo e(old('name', $user->name)); ?>" required>

                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="<?php echo e(old('email', $user->email)); ?>" required>

                <label class="form-label">Professional Bio</label>
                <textarea name="bio" class="form-input" rows="4" placeholder="Tell us about your role..."><?php echo e(old('bio', $user->bio)); ?></textarea>

                <div class="form-actions">
                    <a href="<?php echo e(route('profile.index')); ?>" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save-profile">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Live Preview Script
    document.getElementById('avatar').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('previewImg');
            const placeholder = document.getElementById('initialPlaceholder');
            
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            if(placeholder) placeholder.style.display = 'none';
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/profile/edit.blade.php ENDPATH**/ ?>