<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mon espace — SannaStudio') ?></title>
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/ssp.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/dashboard.css">
    <style>
        /* CSS variables disponibles globalement */
        :root {
            --bg:#0a0a0a; --surface:#111; --surface2:#161616;
            --border:rgba(123,47,190,.25); --border2:rgba(255,255,255,.06);
            --accent:#7B2FBE; --accent-h:#9B4FDE; --accent-d:#5A1A8A;
            --accent-glow:rgba(123,47,190,.15);
            --text:#F5F5F5; --muted:#888; --green:#22c55e;
            --yellow:#eab308; --blue:#3b82f6; --red:#E63030;
            --sidebar-w:260px; --topbar-h:64px;
        }
    </style>
</head>
<body>

<div class="db-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
<aside class="db-sidebar" id="dbSidebar">
    <a href="<?= SITE_URL ?>" class="db-sidebar-logo">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio">
        <span>SannaStudio</span>
    </a>

    <nav class="db-nav">
        <div class="db-nav-label">Menu principal</div>
        <a href="<?= SITE_URL ?>/dashboard" class="<?= str_contains($_SERVER['REQUEST_URI'] ?? '', '/dashboard') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Tableau de bord
        </a>
        <a href="<?= SITE_URL ?>/#rdv">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Prendre un RDV
        </a>

        <div class="db-nav-label" style="margin-top:8px">SannaStudio</div>
        <a href="<?= SITE_URL ?>/#services">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/>
                <path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/>
                <circle cx="12" cy="12" r="2"/>
                <path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/>
                <path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1"/>
            </svg>
            Nos services
        </a>

        <?php if (Session::isAdmin()): ?>
        <div class="db-nav-label" style="margin-top:8px">Administration</div>
        <a href="<?= SITE_URL ?>/admin" style="color:#ff7070">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/><line x1="12" y1="16" x2="12" y2="22"/><line x1="9" y1="19" x2="15" y2="19"/></svg>
            Panel Admin
        </a>
        <?php endif; ?>
        <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/>
            </svg>
            Discord
        </a>
    </nav>

    <div class="db-sidebar-footer">
        <div class="db-user-info">
            <div class="db-avatar"><?= strtoupper(substr(Session::get('user_first_name') ?? 'U', 0, 1)) ?></div>
            <div>
                <div class="db-user-name"><?= htmlspecialchars((Session::get('user_first_name') ?? '').' '.(Session::get('user_last_name') ?? '')) ?></div>
                <div class="db-user-email"><?= htmlspecialchars(Session::get('user_email') ?? '') ?></div>
            </div>
        </div>
        <a href="<?= SITE_URL ?>/deconnexion" class="db-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Déconnexion
        </a>
    </div>
</aside>

<!-- ══ MAIN ══ -->
<main class="db-main">
    <div class="db-topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button class="db-hamburger" onclick="toggleSidebar()" aria-label="Menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <span class="db-topbar-title"><?= htmlspecialchars($title ?? 'Mon espace') ?></span>
        </div>
        <div class="db-topbar-right">
            <span class="db-topbar-badge">▶ Espace client</span>
        </div>
    </div>

    <div class="db-content">
        <?php if (!empty($flash)): ?>
            <div class="db-flash <?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['msg']) ?>
            </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</main>

<script>
function toggleSidebar() {
    document.getElementById('dbSidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
</script>
</body>
</html>