<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin — SannaStudio') ?></title>
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/ssp.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/dashboard.css">
    <style>
        :root {
            --bg:#0a0a0a; --surface:#111; --surface2:#161616;
            --border:rgba(123,47,190,.25); --border2:rgba(255,255,255,.06);
            --accent:#7B2FBE; --accent-h:#9B4FDE; --accent-d:#5A1A8A;
            --accent-glow:rgba(123,47,190,.15);
            --text:#F5F5F5; --muted:#888; --green:#22c55e;
            --yellow:#eab308; --blue:#3b82f6; --red:#E63030;
            --sidebar-w:260px; --topbar-h:64px;
        }
        /* Admin badge dans la sidebar */
        .db-admin-badge {
            display:inline-block; background:rgba(230,48,48,.15);
            border:1px solid rgba(230,48,48,.3); color:#ff7070;
            font-size:.6rem; font-weight:700; letter-spacing:.1em;
            text-transform:uppercase; padding:2px 8px; border-radius:10px;
            font-family:'Oswald',sans-serif; margin-left:auto;
        }
        /* Table admin */
        .admin-table { width:100%; border-collapse:collapse; font-family:'Rajdhani',sans-serif; }
        .admin-table th {
            font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
            color:var(--muted); text-align:left; padding:0 12px 10px 0;
            border-bottom:1px solid var(--border);
        }
        .admin-table td {
            padding:12px 12px 12px 0; border-bottom:1px solid rgba(255,255,255,.04);
            font-size:.875rem; vertical-align:middle; color:var(--text);
        }
        .admin-table tr:last-child td { border-bottom:none; }
        .admin-table tr:hover td { background:rgba(123,47,190,.04); }
        .admin-pill {
            display:inline-block; padding:3px 10px; border-radius:20px;
            font-size:.68rem; font-weight:700; font-family:'Oswald',sans-serif;
            letter-spacing:.06em; text-transform:uppercase;
        }
        .admin-pill.admin   { background:rgba(230,48,48,.12);  color:#ff7070; }
        .admin-pill.client  { background:var(--accent-glow);    color:var(--accent-h); }
        .admin-pill.verified{ background:rgba(34,197,94,.12);  color:#22c55e; }
        .admin-pill.pending { background:rgba(234,179,8,.12);  color:#eab308; }
        .admin-pill.new        { background:rgba(59,130,246,.12); color:#3b82f6; }
        .admin-pill.in_progress{ background:rgba(234,179,8,.12); color:#eab308; }
        .admin-pill.completed  { background:rgba(34,197,94,.12); color:#22c55e; }
        .admin-pill.cancelled  { background:rgba(107,114,128,.12);color:#9ca3af; }
        .admin-nav-tabs { display:flex; gap:4px; margin-bottom:24px; }
        .admin-nav-tab {
            padding:8px 18px; border-radius:6px; text-decoration:none;
            font-size:.82rem; font-weight:700; font-family:'Oswald',sans-serif;
            letter-spacing:.06em; text-transform:uppercase; color:var(--muted);
            background:transparent; border:1px solid transparent; transition:all .15s;
        }
        .admin-nav-tab:hover { color:var(--text); background:var(--surface2); }
        .admin-nav-tab.active { color:var(--accent-h); background:var(--accent-glow); border-color:rgba(123,47,190,.35); }
        .admin-kpi {
            background:var(--surface); border:1px solid var(--border); border-radius:12px;
            padding:22px 24px; display:flex; align-items:center; gap:16px;
            transition:border-color .2s;
        }
        .admin-kpi:hover { border-color:rgba(123,47,190,.5); }
        .admin-kpi-icon {
            width:44px; height:44px; border-radius:10px; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
        }
        .admin-kpi-icon svg { width:20px; height:20px; }
        .admin-kpi-icon.purple { background:var(--accent-glow); color:var(--accent-h); }
        .admin-kpi-icon.green  { background:rgba(34,197,94,.12); color:#22c55e; }
        .admin-kpi-icon.blue   { background:rgba(59,130,246,.12); color:#3b82f6; }
        .admin-kpi-icon.red    { background:rgba(230,48,48,.12); color:#ff7070; }
        .admin-kpi-num   { font-size:1.8rem; font-weight:800; color:var(--text); line-height:1; font-family:'Oswald',sans-serif; }
        .admin-kpi-label { font-size:.75rem; color:var(--muted); margin-top:4px; font-family:'Rajdhani',sans-serif; }
        .admin-search {
            width:100%; background:#0d0d0d; border:1px solid #2a2a2a; border-radius:8px;
            padding:10px 16px; color:var(--text); font-size:.9rem; font-family:'Rajdhani',sans-serif;
            margin-bottom:20px; transition:border-color .2s;
        }
        .admin-search:focus { outline:none; border-color:var(--accent); }
        .admin-search::placeholder { color:#333; }
    </style>
</head>
<body>

<div class="db-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<aside class="db-sidebar" id="dbSidebar">
    <a href="<?= SITE_URL ?>" class="db-sidebar-logo">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP">
        <span>SannaStudio</span>
    </a>

    <nav class="db-nav">
        <div class="db-nav-label">Administration <span class="db-admin-badge">Admin</span></div>
        <a href="<?= SITE_URL ?>/admin" class="<?= ($url[1] ?? 'index') === 'index' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Vue d'ensemble
        </a>
        <a href="<?= SITE_URL ?>/admin/users" class="<?= ($url[1] ?? '') === 'users' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            Clients
        </a>
        <a href="<?= SITE_URL ?>/admin/appointments" class="<?= ($url[1] ?? '') === 'appointments' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Demandes RDV
        </a>

        <div class="db-nav-label" style="margin-top:8px">Navigation</div>

        <a href="<?= SITE_URL ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            Site public
        </a>
    </nav>

    <div class="db-sidebar-footer">
        <div class="db-user-info">
            <div class="db-avatar" style="background:#E63030"><?= strtoupper(substr(Session::get('user_first_name') ?? 'A', 0, 1)) ?></div>
            <div>
                <div class="db-user-name"><?= htmlspecialchars((Session::get('user_first_name') ?? '').' '.(Session::get('user_last_name') ?? '')) ?></div>
                <div class="db-user-email" style="color:#ff7070">Administrateur</div>
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
            <span class="db-topbar-title"><?= htmlspecialchars($title ?? 'Administration') ?></span>
        </div>
        <div class="db-topbar-right">
            <span class="db-topbar-badge" style="background:rgba(230,48,48,.15);color:#ff7070;border-color:rgba(230,48,48,.3)">⚙ Administration</span>
        </div>
    </div>

    <div class="db-content">
        <?php if (!empty($flash)): ?>
            <div class="db-flash <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['msg']) ?></div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</main>

<script>
function toggleSidebar() {
    document.getElementById('dbSidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
// Recherche live dans les tables
function filterTable(inputId, tableId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll('#'+tableId+' tbody tr').forEach(tr => {
        tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
</body>
</html>