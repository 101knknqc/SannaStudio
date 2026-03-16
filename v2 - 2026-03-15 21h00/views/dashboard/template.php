<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mon espace — SannaStudio') ?></title>
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/ssp.png" type="image/x-icon">
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        :root {
            --bg:       #0a0a0a;
            --surface:  #111111;
            --surface2: #161616;
            --border:   #1e1e1e;
            --accent:   #e63946;
            --accent2:  #c1121f;
            --text:     #ffffff;
            --muted:    #666666;
            --green:    #22c55e;
            --yellow:   #eab308;
            --blue:     #3b82f6;
            --sidebar-w: 260px;
        }
        body { font-family:'Segoe UI',system-ui,sans-serif; background:var(--bg); color:var(--text); min-height:100vh; display:flex; }

        /* ── SIDEBAR ── */
        .db-sidebar {
            width:var(--sidebar-w); min-height:100vh; background:var(--surface);
            border-right:1px solid var(--border); display:flex; flex-direction:column;
            position:fixed; top:0; left:0; z-index:100;
        }
        .db-sidebar-logo {
            display:flex; align-items:center; gap:12px; padding:24px 20px;
            border-bottom:1px solid var(--border); text-decoration:none;
        }
        .db-sidebar-logo img { width:36px; height:36px; object-fit:contain; }
        .db-sidebar-logo span { font-size:1rem; font-weight:700; color:var(--text); letter-spacing:.05em; }
        .db-nav { flex:1; padding:16px 0; }
        .db-nav-label { font-size:.65rem; font-weight:700; color:var(--muted); letter-spacing:.1em; text-transform:uppercase; padding:16px 20px 8px; }
        .db-nav a {
            display:flex; align-items:center; gap:12px; padding:11px 20px;
            color:var(--muted); text-decoration:none; font-size:.875rem; font-weight:500;
            transition:all .15s; border-left:3px solid transparent;
        }
        .db-nav a:hover { color:var(--text); background:var(--surface2); }
        .db-nav a.active { color:var(--accent); background:rgba(230,57,70,.08); border-left-color:var(--accent); }
        .db-nav a svg { width:16px; height:16px; flex-shrink:0; }
        .db-sidebar-footer { padding:20px; border-top:1px solid var(--border); }
        .db-user-info { display:flex; align-items:center; gap:10px; margin-bottom:12px; }
        .db-avatar {
            width:36px; height:36px; border-radius:50%; background:var(--accent);
            display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.875rem; color:#fff; flex-shrink:0;
        }
        .db-user-name { font-size:.875rem; font-weight:600; color:var(--text); }
        .db-user-email { font-size:.75rem; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:150px; }
        .db-logout {
            display:flex; align-items:center; gap:8px; width:100%;
            background:transparent; border:1px solid var(--border); border-radius:6px;
            color:var(--muted); padding:8px 12px; font-size:.8rem; text-decoration:none;
            transition:all .15s; cursor:pointer;
        }
        .db-logout:hover { color:#ff6b6b; border-color:#5a1a1a; background:rgba(255,107,107,.05); }
        .db-logout svg { width:14px; height:14px; }

        /* ── MAIN ── */
        .db-main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .db-topbar {
            display:flex; align-items:center; justify-content:space-between;
            padding:0 32px; height:64px; border-bottom:1px solid var(--border);
            background:var(--surface); position:sticky; top:0; z-index:50;
        }
        .db-topbar-title { font-size:1rem; font-weight:600; color:var(--text); }
        .db-topbar-right { display:flex; align-items:center; gap:12px; }
        .db-topbar-badge {
            background:rgba(230,57,70,.15); color:var(--accent); border:1px solid rgba(230,57,70,.3);
            border-radius:20px; padding:4px 12px; font-size:.75rem; font-weight:600;
        }
        .db-content { padding:32px; flex:1; }

        /* ── FLASH ── */
        .db-flash {
            display:flex; align-items:center; gap:12px; padding:14px 18px;
            border-radius:8px; margin-bottom:24px; font-size:.875rem;
        }
        .db-flash.success { background:#0a2a12; border:1px solid #1a5a28; color:#4ade80; }
        .db-flash.error   { background:#2a0a0a; border:1px solid #5a1a1a; color:#ff6b6b; }
        .db-flash.warning { background:#2a200a; border:1px solid #5a3d0a; color:#fbbf24; }

        /* ── HAMBURGER mobile ── */
        .db-hamburger { display:none; }
        .db-sidebar-overlay { display:none; }

        @media(max-width:768px) {
            .db-sidebar { transform:translateX(-100%); transition:transform .25s; }
            .db-sidebar.open { transform:translateX(0); }
            .db-main { margin-left:0; }
            .db-content { padding:20px 16px; }
            .db-topbar { padding:0 16px; }
            .db-hamburger { display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:transparent; border:1px solid var(--border); border-radius:6px; cursor:pointer; color:var(--text); }
            .db-hamburger svg { width:18px; height:18px; }
            .db-sidebar-overlay { display:block; position:fixed; inset:0; background:rgba(0,0,0,.6); z-index:99; opacity:0; pointer-events:none; transition:opacity .25s; }
            .db-sidebar-overlay.open { opacity:1; pointer-events:all; }
        }
    </style>
</head>
<body>

<!-- Overlay mobile -->
<div class="db-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
<aside class="db-sidebar" id="dbSidebar">
    <a href="<?= SITE_URL ?>" class="db-sidebar-logo">
        <img src="<?= SITE_URL ?>/assets/img/ssp.png" alt="SannaStudio">
        <span>SannaStudio</span>
    </a>

    <nav class="db-nav">
        <div class="db-nav-label">Menu principal</div>
        <a href="<?= SITE_URL ?>/dashboard" class="<?= (strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard') !== false) ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Tableau de bord
        </a>
        <a href="<?= SITE_URL ?>/#rdv">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Prendre un RDV
        </a>

        <div class="db-nav-label" style="margin-top:8px">SannaStudio</div>
        <a href="<?= SITE_URL ?>/#services">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1"/></svg>
            Nos services
        </a>
        <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128c.126-.094.252-.192.372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.1.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
            Discord
        </a>
    </nav>

    <div class="db-sidebar-footer">
        <div class="db-user-info">
            <div class="db-avatar"><?= strtoupper(substr(Session::get('client_prenom') ?? 'U', 0, 1)) ?></div>
            <div>
                <div class="db-user-name"><?= htmlspecialchars(Session::get('client_prenom').' '.Session::get('client_nom')) ?></div>
                <div class="db-user-email"><?= htmlspecialchars(Session::get('client_email') ?? '') ?></div>
            </div>
        </div>
        <a href="<?= SITE_URL ?>/deconnexion" class="db-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Déconnexion
        </a>
    </div>
</aside>

<!-- ══ MAIN ══ -->
<main class="db-main">
    <div class="db-topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button class="db-hamburger" onclick="toggleSidebar()" aria-label="Menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <span class="db-topbar-title"><?= htmlspecialchars($title ?? 'Mon espace') ?></span>
        </div>
        <div class="db-topbar-right">
            <span class="db-topbar-badge">Espace client</span>
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
