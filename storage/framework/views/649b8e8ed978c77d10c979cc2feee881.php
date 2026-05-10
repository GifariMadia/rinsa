

<?php $__env->startSection('content'); ?>
<style>
    /* ===== Local Variables (extends app.blade vars) ===== */
    :root {
        --rinsa-green:        #0F6E56;
        --rinsa-green-light:  #1D9E75;
        --rinsa-green-pale:   #E8F5F0;
        --rinsa-gold:         #BA7517;
        --rinsa-gold-pale:    #FDF4E3;
        --rinsa-dark:         #1E1E1C;
        --rinsa-gray:         #6B6A66;
        --rinsa-gray-light:   #9B9A96;
        --rinsa-cream:        #F0EDE4;
        --rinsa-cream-dark:   #E6E2D8;
        --rinsa-border:       #D6D3C8;
        --rinsa-border-light: #E8E5DC;
        --rinsa-white:        #FDFCFA;
        --rinsa-bg:           #F5F3EE;
        --shadow-sm:          0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md:          0 4px 20px rgba(15,110,86,0.09), 0 1px 6px rgba(0,0,0,0.05);
        --shadow-lg:          0 12px 40px rgba(15,110,86,0.13), 0 4px 12px rgba(0,0,0,0.07);
        --radius-card:        22px;
        --transition:         0.22s cubic-bezier(0.4,0,0.2,1);
    }

    /* ===== Page Entry Animation ===== */
    .profile-container {
        max-width: 880px;
        margin: 0 auto 3rem;
        animation: fadeSlideUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ===== Master Card ===== */
    .profile-card {
        background: var(--rinsa-white);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--rinsa-border-light);
        overflow: hidden;
    }

    /* ===== Cover Header ===== */
    .profile-header-bg {
        height: 200px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(140deg,
            var(--rinsa-green-dim, #0a4f3e) 0%,
            var(--rinsa-green) 45%,
            var(--rinsa-green-light) 100%);
    }
    /* Diagonal stripe texture */
    .profile-header-bg::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.06;
        background-image: repeating-linear-gradient(
            -45deg,
            white 0px, white 1px,
            transparent 1px, transparent 18px
        );
    }
    /* Subtle radial glow center */
    .profile-header-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 70% 100% at 50% 120%, rgba(255,255,255,0.10) 0%, transparent 70%);
    }
    /* Decorative circles */
    .header-deco {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
    }
    .header-deco-1 { width: 220px; height: 220px; top: -80px; right: -50px; }
    .header-deco-2 { width: 120px; height: 120px; bottom: -40px; left: 80px; }
    .header-deco-3 { width: 60px;  height: 60px;  top: 20px;   left: 30px;  }

    .header-actions {
        position: absolute;
        top: 18px;
        right: 18px;
        display: flex;
        gap: 8px;
        align-items: center;
        z-index: 2;
    }
    .status-badge-top {
        background: rgba(255,255,255,0.16);
        color: rgba(255,255,255,0.95);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.73rem;
        font-weight: 700;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.22);
        display: flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.01em;
    }
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #4ade80;
        animation: blink 2.2s ease-in-out infinite;
        box-shadow: 0 0 6px rgba(74,222,128,0.7);
    }
    @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.4;} }

    .btn-share {
        background: rgba(255,255,255,0.16);
        color: rgba(255,255,255,0.95);
        border: 1px solid rgba(255,255,255,0.22);
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 0.73rem;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all var(--transition);
        letter-spacing: 0.01em;
    }
    .btn-share:hover {
        background: rgba(255,255,255,0.26);
        transform: translateY(-1px);
    }
    .btn-share svg { width: 13px; height: 13px; }

    /* ===== Profile Content Area ===== */
    .profile-content { padding: 0 2.5rem 2.5rem; }

    /* ===== Avatar Section ===== */
    .avatar-section {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-top: -64px;
        margin-bottom: 1.4rem;
        position: relative;
        z-index: 2;
    }
    .avatar-wrapper {
        width: 128px; height: 128px;
        border-radius: 50%;
        border: 4px solid var(--rinsa-white);
        box-shadow: 0 8px 28px rgba(15,110,86,0.22), 0 2px 8px rgba(0,0,0,0.1);
        background: var(--rinsa-white);
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        flex-shrink: 0;
    }
    .avatar-wrapper:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 14px 36px rgba(15,110,86,0.28), 0 4px 12px rgba(0,0,0,0.12);
    }
    .avatar-img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .avatar-initial {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--rinsa-gold) 0%, var(--rinsa-green) 100%);
        color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 3.8rem;
        font-family: 'DM Serif Display', serif;
        font-weight: 400;
    }
    .avatar-online {
        position: absolute;
        bottom: 8px; right: 8px;
        width: 20px; height: 20px;
        background: #22c55e;
        border: 3px solid var(--rinsa-white);
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(34,197,94,0.4);
    }

    /* Avatar-right action buttons */
    .avatar-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        padding-bottom: 6px;
    }
    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        background: var(--rinsa-green);
        color: #fff;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition);
        box-shadow: 0 3px 12px rgba(15,110,86,0.28);
        letter-spacing: 0.01em;
        border: none;
        cursor: pointer;
        font-family: inherit;
    }
    .btn-edit:hover {
        background: #0a5240;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(15,110,86,0.35);
    }
    .btn-edit svg { width: 14px; height: 14px; }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        background: var(--rinsa-white);
        color: var(--rinsa-gray);
        border: 1px solid var(--rinsa-border);
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition);
        letter-spacing: 0.01em;
        cursor: pointer;
        font-family: inherit;
    }
    .btn-secondary:hover {
        background: var(--rinsa-cream);
        color: var(--rinsa-dark);
        transform: translateY(-1px);
    }

    /* ===== Name & Role ===== */
    .profile-identity { margin-bottom: 1.4rem; }
    .profile-name {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        color: var(--rinsa-dark);
        margin: 0 0 8px;
        letter-spacing: -0.5px;
        line-height: 1.15;
    }
    .profile-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .user-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--rinsa-green-pale);
        color: var(--rinsa-green);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        border: 1px solid rgba(15,110,86,0.18);
    }
    .join-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--rinsa-gray-light);
        font-size: 0.78rem;
        font-weight: 600;
    }

    /* ===== Stats Row ===== */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--rinsa-border-light);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--rinsa-border-light);
        margin-bottom: 2.2rem;
    }
    .stat-cell {
        background: var(--rinsa-white);
        padding: 1.1rem 0.75rem;
        text-align: center;
        transition: background var(--transition);
        cursor: default;
        position: relative;
    }
    .stat-cell:hover { background: var(--rinsa-cream); }
    .stat-cell::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20%; right: 20%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--rinsa-green-light), transparent);
        opacity: 0;
        transition: opacity var(--transition);
    }
    .stat-cell:hover::after { opacity: 1; }
    .stat-icon {
        font-size: 1.1rem;
        margin-bottom: 4px;
        display: block;
    }
    .stat-number {
        font-family: 'DM Serif Display', serif;
        font-size: 1.7rem;
        color: var(--rinsa-green);
        line-height: 1.1;
        letter-spacing: -0.5px;
    }
    .stat-label {
        font-size: 0.67rem;
        color: var(--rinsa-gray-light);
        text-transform: uppercase;
        font-weight: 700;
        margin-top: 3px;
        letter-spacing: 0.07em;
    }

    /* ===== Divider ===== */
    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, var(--rinsa-border), transparent);
        margin: 2rem 0;
    }

    /* ===== Content Grid ===== */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
        text-align: left;
    }

    .section-title {
        font-size: 0.67rem;
        font-weight: 800;
        color: var(--rinsa-gray-light);
        margin-bottom: 1.2rem;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--rinsa-border-light);
        text-transform: uppercase;
        letter-spacing: 0.12em;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-title::before {
        content: '';
        width: 14px; height: 2px;
        background: var(--rinsa-gold);
        border-radius: 2px;
        flex-shrink: 0;
    }

    /* ===== Bio Box ===== */
    .bio-box {
        font-size: 0.88rem;
        color: var(--rinsa-gray);
        line-height: 1.75;
        font-style: italic;
        background: linear-gradient(135deg, var(--rinsa-gold-pale) 0%, var(--rinsa-white) 100%);
        border-left: 3px solid var(--rinsa-gold);
        padding: 1rem 1.2rem;
        border-radius: 0 12px 12px 0;
        margin-bottom: 1.6rem;
        position: relative;
    }
    .bio-box::before {
        content: '\201C';
        position: absolute;
        top: -8px; left: 10px;
        font-size: 2.5rem;
        color: var(--rinsa-gold);
        opacity: 0.4;
        font-family: 'DM Serif Display', serif;
        line-height: 1;
    }

    /* ===== Info Items ===== */
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 10px 0;
        border-bottom: 1px solid var(--rinsa-border-light);
    }
    .info-item:last-child { border-bottom: none; }
    .info-icon {
        width: 32px; height: 32px;
        border-radius: 9px;
        background: var(--rinsa-cream);
        border: 1px solid var(--rinsa-border-light);
        display: flex; align-items: center; justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .info-text { flex: 1; min-width: 0; }
    .info-label {
        font-size: 0.67rem;
        font-weight: 800;
        color: var(--rinsa-gray-light);
        text-transform: uppercase;
        letter-spacing: 0.07em;
        margin-bottom: 2px;
    }
    .info-value {
        font-size: 0.88rem;
        color: var(--rinsa-dark);
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ===== Skill / Metric Bars ===== */
    .skill-item { margin-bottom: 1.4rem; }
    .skill-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    .skill-name {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--rinsa-dark);
    }
    .skill-pct {
        font-size: 0.8rem;
        font-weight: 800;
        color: var(--rinsa-green);
        background: var(--rinsa-green-pale);
        padding: 2px 9px;
        border-radius: 10px;
        letter-spacing: 0.02em;
    }
    .skill-bar-bg {
        width: 100%;
        height: 7px;
        background: var(--rinsa-cream-dark);
        border-radius: 10px;
        overflow: hidden;
    }
    .skill-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--rinsa-green) 0%, var(--rinsa-green-light) 60%, var(--rinsa-gold) 100%);
        width: 0;
        border-radius: 10px;
        transition: width 1.6s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
    }
    /* Shimmer on skill bar */
    .skill-bar-fill::after {
        content: '';
        position: absolute;
        top: 0; left: -60%;
        width: 50%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
        animation: shimmer 2.5s ease-in-out infinite 1.6s;
    }
    @keyframes shimmer {
        0%   { left: -60%; }
        100% { left: 120%; }
    }

    /* ===== Activity Heatmap ===== */
    .activity-section {
        margin-top: 2.2rem;
        text-align: left;
    }
    .activity-inner {
        background: var(--rinsa-bg);
        border: 1px solid var(--rinsa-border-light);
        border-radius: 16px;
        padding: 1.2rem 1.5rem;
    }
    .activity-days-label {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
        margin-bottom: 6px;
    }
    .activity-day-name {
        font-size: 0.6rem;
        font-weight: 700;
        color: var(--rinsa-gray-light);
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .activity-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }
    .day-dot {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 4px;
        background: var(--rinsa-cream-dark);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        cursor: default;
    }
    .day-dot:hover {
        transform: scale(1.3);
        box-shadow: 0 2px 8px rgba(15,110,86,0.25);
        z-index: 2;
        position: relative;
    }
    .day-dot.lvl1 { background: #b8e8d8; }
    .day-dot.lvl2 { background: #6dcfae; }
    .day-dot.lvl3 { background: #1D9E75; }
    .day-dot.lvl4 { background: #0F6E56; }
    .activity-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
    .activity-legend {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.67rem;
        color: var(--rinsa-gray-light);
        font-weight: 600;
    }
    .legend-dot {
        width: 10px; height: 10px;
        border-radius: 3px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .activity-count {
        font-size: 0.72rem;
        color: var(--rinsa-gray-light);
        font-weight: 700;
    }
    .activity-count strong { color: var(--rinsa-green); }

    /* ===== Inline toast ===== */
    .rinsa-toast {
        position: fixed;
        bottom: 28px;
        left: 50%;
        transform: translateX(-50%) translateY(10px);
        background: var(--rinsa-dark);
        color: #fff;
        padding: 10px 24px;
        border-radius: 30px;
        font-size: 0.82rem;
        font-weight: 700;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease, transform 0.3s ease;
        z-index: 9999;
        white-space: nowrap;
        box-shadow: 0 6px 24px rgba(0,0,0,0.2);
        letter-spacing: 0.01em;
    }
    .rinsa-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* ===== Responsive ===== */
    @media (max-width: 640px) {
        .profile-content        { padding: 0 1.25rem 1.5rem; }
        .content-grid           { grid-template-columns: 1fr; gap: 0; }
        .profile-name           { font-size: 1.6rem; }
        .avatar-wrapper         { width: 100px; height: 100px; }
        .avatar-section         { margin-top: -50px; flex-wrap: wrap; gap: 10px; }
        .avatar-actions         { flex-wrap: wrap; }
        .stats-row              { grid-template-columns: repeat(3,1fr); }
        .section-divider        { display: none; }
    }
</style>

<div class="profile-container">
    <div class="profile-card">

        
        <div class="profile-header-bg">
            <div class="header-deco header-deco-1"></div>
            <div class="header-deco header-deco-2"></div>
            <div class="header-deco header-deco-3"></div>

            <div class="header-actions">
                <button class="btn-share" onclick="rinsaCopyLink()" aria-label="Salin link profil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    Bagikan
                </button>
                <div class="status-badge-top">
                    <span class="status-dot" aria-hidden="true"></span>
                    Verified Administrator
                </div>
            </div>
        </div>

        
        <div class="profile-content">

            
            <div class="avatar-section">
                <div class="avatar-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>"
                             class="avatar-img"
                             alt="Foto profil <?php echo e($user->name); ?>">
                    <?php else: ?>
                        <div class="avatar-initial" aria-hidden="true"><?php echo e(substr($user->name, 0, 1)); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="avatar-online" title="Online" aria-hidden="true"></div>
                </div>

                <div class="avatar-actions">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn-edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                        </svg>
                        Edit Profil
                    </a>
                    <button class="btn-secondary" onclick="rinsaCopyLink()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                        </svg>
                        Salin Link
                    </button>
                </div>
            </div>

            
            <div class="profile-identity">
                <h1 class="profile-name"><?php echo e($user->name); ?></h1>
                <div class="profile-meta">
                    <span class="user-role-badge"><?php echo e(ucfirst($user->role)); ?> Management</span>
                    <span class="join-badge">
                        📅 Bergabung <?php echo e($user->created_at->format('M Y')); ?>

                    </span>
                </div>
            </div>

            
            <div class="stats-row" aria-label="Ringkasan statistik">
                <div class="stat-cell">
                    <span class="stat-icon">📦</span>
                    <div class="stat-number js-counter" data-target="<?php echo e($totalOrders); ?>">0</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-cell">
                    <span class="stat-icon">✅</span>
                    <div class="stat-number js-counter" data-target="<?php echo e($completionRate); ?>" data-suffix="%">0%</div>
                    <div class="stat-label">Completion Rate</div>
                </div>
                <div class="stat-cell">
                    <span class="stat-icon">📈</span>
                    <div class="stat-number js-counter" data-target="<?php echo e($ordersThisMonth ?? 0); ?>">0</div>
                    <div class="stat-label">Bulan Ini</div>
                </div>
            </div>

            
            <div class="content-grid">

                
                <div>
                    <h2 class="section-title">Tentang Saya</h2>
                    <div class="bio-box">
                        <?php echo e($user->bio ?? 'Dedicated administrator focused on providing high-quality management for Rinsa Laundry services.'); ?>

                    </div>

                    <div class="info-item">
                        <div class="info-icon">✉</div>
                        <div class="info-text">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?php echo e($user->email); ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📦</div>
                        <div class="info-text">
                            <div class="info-label">Total Orders Ditangani</div>
                            <div class="info-value"><?php echo e($totalOrders); ?> Orders</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📅</div>
                        <div class="info-text">
                            <div class="info-label">Akun Dibuat</div>
                            <div class="info-value"><?php echo e($user->created_at->format('M d, Y')); ?></div>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->phone ?? false): ?>
                    <div class="info-item">
                        <div class="info-icon">📞</div>
                        <div class="info-text">
                            <div class="info-label">Telepon</div>
                            <div class="info-value"><?php echo e($user->phone); ?></div>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div>
                    <h2 class="section-title">Performance Metrics</h2>

                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Order Completion Rate</span>
                            <span class="skill-pct"><?php echo e($completionRate); ?>%</span>
                        </div>
                        <div class="skill-bar-bg">
                            <div class="skill-bar-fill" data-width="<?php echo e($completionRate); ?>%"></div>
                        </div>
                    </div>

                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Customer Satisfaction</span>
                            <span class="skill-pct"><?php echo e($satisfaction); ?>%</span>
                        </div>
                        <div class="skill-bar-bg">
                            <div class="skill-bar-fill" data-width="<?php echo e($satisfaction); ?>%"></div>
                        </div>
                    </div>

                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">System Accuracy</span>
                            <span class="skill-pct"><?php echo e($systemAccuracy); ?>%</span>
                        </div>
                        <div class="skill-bar-bg">
                            <div class="skill-bar-fill" data-width="<?php echo e($systemAccuracy); ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="activity-section">
                <h2 class="section-title">Aktivitas 7 Minggu Terakhir</h2>
                <div class="activity-inner">
                    <div class="activity-days-label" aria-hidden="true">
                        <div class="activity-day-name">Sen</div>
                        <div class="activity-day-name">Sel</div>
                        <div class="activity-day-name">Rab</div>
                        <div class="activity-day-name">Kam</div>
                        <div class="activity-day-name">Jum</div>
                        <div class="activity-day-name">Sab</div>
                        <div class="activity-day-name">Min</div>
                    </div>
                    <div class="activity-grid" id="js-activity-grid" aria-label="Heatmap aktivitas"></div>
                    <div class="activity-footer">
                        <div class="activity-legend" aria-hidden="true">
                            <span>Kurang</span>
                            <div class="legend-dot" style="background:var(--rinsa-cream-dark)"></div>
                            <div class="legend-dot" style="background:#b8e8d8"></div>
                            <div class="legend-dot" style="background:#6dcfae"></div>
                            <div class="legend-dot" style="background:#1D9E75"></div>
                            <div class="legend-dot" style="background:#0F6E56"></div>
                            <span>Lebih banyak</span>
                        </div>
                        <div class="activity-count" id="js-activity-count"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="rinsa-toast" id="js-toast" role="status" aria-live="polite"></div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ── 1. Skill bars (delayed for visual impact) ── */
    setTimeout(function () {
        document.querySelectorAll('.skill-bar-fill').forEach(function (bar) {
            bar.style.width = bar.getAttribute('data-width');
        });
    }, 350);

    /* ── 2. Animated counters with IntersectionObserver ── */
    var counters    = document.querySelectorAll('.js-counter');
    var counterObs  = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el      = entry.target;
            var target  = parseInt(el.dataset.target) || 0;
            var suffix  = el.dataset.suffix || '';
            var current = 0;
            var step    = Math.max(target / 60, 0.5);
            var timer   = setInterval(function () {
                current = Math.min(current + step, target);
                el.textContent = Math.round(current) + suffix;
                if (current >= target) clearInterval(timer);
            }, 16);
            counterObs.unobserve(el);
        });
    }, { threshold: 0.3 });
    counters.forEach(function (c) { counterObs.observe(c); });

    /* ── 3. Activity heatmap with realistic distribution ── */
    var grid    = document.getElementById('js-activity-grid');
    var levels  = ['lvl1', 'lvl2', 'lvl3', 'lvl4'];
    var weights = [0, 0, 0, 0, 0, 1, 1, 1, 2, 2, 3, 4]; // skew toward empty
    var activeDays = 0;

    for (var i = 0; i < 49; i++) {
        var dot  = document.createElement('div');
        var pick = weights[Math.floor(Math.random() * weights.length)];
        dot.className = 'day-dot' + (pick > 0 ? ' ' + levels[pick - 1] : '');
        if (pick > 0) activeDays++;
        grid.appendChild(dot);
    }

    var countEl = document.getElementById('js-activity-count');
    if (countEl) {
        countEl.innerHTML = '<strong>' + activeDays + '</strong> hari aktif';
    }

    /* ── 4. Toast helper ── */
    window.rinsaShowToast = function (msg) {
        var toast = document.getElementById('js-toast');
        toast.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toast._timer);
        toast._timer = setTimeout(function () { toast.classList.remove('show'); }, 2800);
    };

    /* ── 5. Copy link ── */
    window.rinsaCopyLink = function () {
        var url = window.location.href;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url)
                .then(function ()  { rinsaShowToast('✓  Link profil berhasil disalin!'); })
                .catch(function () { rinsaShowToast('Tidak dapat menyalin link.'); });
        } else {
            rinsaShowToast('Salin link dari address bar browser Anda.');
        }
    };
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Downloads\rinsa\resources\views/profile/index.blade.php ENDPATH**/ ?>