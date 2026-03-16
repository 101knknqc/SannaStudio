<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mon espace — SannaStudio') ?></title>
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/ssp.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
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
        /* ── Notification bell ── */
        .notif-bell { position:relative; cursor:pointer; background:none; border:1px solid rgba(123,47,190,.3); color:#ccc; width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; transition:.2s; }
        .notif-bell:hover { border-color:var(--accent); color:#fff; background:rgba(123,47,190,.12); }
        .notif-bell svg { width:18px; height:18px; }
        .notif-badge { position:absolute; top:-4px; right:-4px; background:var(--red); color:#fff; font-size:9px; font-weight:700; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid var(--bg); }
        .notif-dropdown { position:absolute; top:calc(100% + 10px); right:0; width:320px; background:#161616; border:1px solid rgba(123,47,190,.35); border-radius:8px; box-shadow:0 12px 40px rgba(0,0,0,.6); z-index:9999; display:none; overflow:hidden; }
        .notif-dropdown.open { display:block; animation:fadeIn .15s ease; }
        .notif-header { padding:12px 16px; border-bottom:1px solid rgba(255,255,255,.06); display:flex; justify-content:space-between; align-items:center; }
        .notif-header span { font-family:'Oswald',sans-serif; font-size:13px; letter-spacing:1px; text-transform:uppercase; color:#fff; }
        .notif-mark-read { font-size:11px; color:var(--accent-h); cursor:pointer; background:none; border:none; padding:0; }
        .notif-list { max-height:300px; overflow-y:auto; }
        .notif-item { padding:12px 16px; border-bottom:1px solid rgba(255,255,255,.04); display:flex; gap:12px; align-items:flex-start; text-decoration:none; transition:.15s; }
        .notif-item:hover { background:rgba(123,47,190,.08); }
        .notif-item.unread { background:rgba(123,47,190,.05); }
        .notif-dot { width:8px; height:8px; border-radius:50%; background:var(--accent); flex-shrink:0; margin-top:5px; }
        .notif-dot.read { background:#444; }
        .notif-title { font-size:13px; color:#ddd; font-weight:600; margin-bottom:2px; }
        .notif-body { font-size:11px; color:#777; }
        .notif-time { font-size:10px; color:#555; margin-top:3px; }
        .notif-empty { padding:24px; text-align:center; color:#555; font-size:13px; }
        /* ── Dark mode toggle ── */
        .dark-toggle { background:none; border:1px solid rgba(123,47,190,.3); color:#aaa; width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:.2s; }
        .dark-toggle:hover { border-color:var(--accent); color:#fff; }
        .dark-toggle svg { width:17px; height:17px; }
        /* Light mode */
        body.light-mode { --bg:#f5f5f5; --surface:#fff; --surface2:#f0f0f0; --text:#111; --muted:#666; --border:rgba(123,47,190,.2); --border2:rgba(0,0,0,.06); }
        body.light-mode .db-sidebar { background:#fff; }
        body.light-mode .db-topbar { background:rgba(245,245,245,.95); }
        body.light-mode .db-card { background:#fff; }
    </style>
</head>
<body>

<?php
$nm = new NotificationManager();
$unreadCount = Session::isLoggedIn() ? $nm->countUnreadForUser(Session::getUserId()) : 0;
$mm = new MessageManager();
$unreadMsg = Session::isLoggedIn() ? $mm->countUnread(Session::getUserId()) : 0;
?>

<div class="db-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
<aside class="db-sidebar" id="dbSidebar">
    <a href="<?= SITE_URL ?>" class="db-sidebar-logo">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP">
        <span>SannaStudio</span>
    </a>

    <nav class="db-nav">
        <div class="db-nav-label">Menu principal</div>
        <a href="<?= SITE_URL ?>/dashboard" class="<?= str_contains($_SERVER['REQUEST_URI']??'','/dashboard') && !str_contains($_SERVER['REQUEST_URI']??'','/messages') && !str_contains($_SERVER['REQUEST_URI']??'','/invoices') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Tableau de bord
        </a>
        <a href="<?= SITE_URL ?>/messages" class="<?= str_contains($_SERVER['REQUEST_URI']??'','/messages') ? 'active' : '' ?>" style="position:relative">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            Messagerie
            <?php if ($unreadMsg > 0): ?><span style="margin-left:auto;background:var(--red);color:#fff;font-size:9px;padding:2px 6px;border-radius:10px;font-weight:700"><?= $unreadMsg ?></span><?php endif; ?>
        </a>
        <a href="<?= SITE_URL ?>/invoices" class="<?= str_contains($_SERVER['REQUEST_URI']??'','/invoices') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Devis & Factures
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
        <a href="<?= SITE_URL ?>/tarifs">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Tarifs
        </a>

        <?php if (Session::isAdmin()): ?>
        <div class="db-nav-label" style="margin-top:8px">Administration</div>
        <a href="<?= SITE_URL ?>/admin" style="color:#ff7070">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
            Panel Admin
        </a>
        <?php endif; ?>

        <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
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
        <div class="db-topbar-right" style="display:flex;align-items:center;gap:10px">
            <!-- Dark mode toggle -->
            <button class="dark-toggle" id="darkToggle" title="Mode clair/sombre" onclick="toggleDark()">
                <svg id="darkIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>

            <!-- Notifications -->
            <div style="position:relative" id="notifWrapper">
                <button class="notif-bell" id="notifBell" onclick="toggleNotifs()" aria-label="Notifications">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <?php if ($unreadCount > 0): ?>
                    <span class="notif-badge" id="notifBadge"><?= $unreadCount > 9 ? '9+' : $unreadCount ?></span>
                    <?php else: ?>
                    <span class="notif-badge" id="notifBadge" style="display:none">0</span>
                    <?php endif; ?>
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-header">
                        <span>Notifications</span>
                        <button class="notif-mark-read" onclick="markAllRead()">Tout marquer lu</button>
                    </div>
                    <div class="notif-list" id="notifList">
                        <div class="notif-empty">Chargement…</div>
                    </div>
                </div>
            </div>

            <!-- Lang switcher -->
            <div class="lang-switcher" id="langSwitcherDb" style="position:relative">
                <?php $langs = Lang::available(); $cur = Lang::current(); ?>
                <button class="lang-btn" onclick="document.getElementById('langDropdownDb').classList.toggle('open')" style="padding:5px 10px;font-size:10px">
                    <span><?= $langs[$cur]['emoji'] ?? '🌐' ?></span>
                    <span><?= strtoupper($cur) ?></span>
                </button>
                <div class="lang-dropdown" id="langDropdownDb">
                    <?php foreach ($langs as $code => $info): ?>
                        <a href="?lang=<?= $code ?>" class="lang-option <?= $code === $cur ? 'active' : '' ?>">
                            <span class="lang-flag"><?= $info['emoji'] ?></span>
                            <span><?= htmlspecialchars($info['name']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <span class="db-topbar-badge">▶ Espace client</span>
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
const SITE_URL = '<?= SITE_URL ?>';
const CSRF_TOKEN = '<?= functions::csrfToken() ?>';

function toggleSidebar() {
    document.getElementById('dbSidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}

// ── Dark mode ──
function toggleDark() {
    const body = document.body;
    const isLight = body.classList.toggle('light-mode');
    localStorage.setItem('sanna_theme', isLight ? 'light' : 'dark');
    document.getElementById('darkIcon').innerHTML = isLight
        ? '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>'
        : '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>';
}
if (localStorage.getItem('sanna_theme') === 'light') {
    document.body.classList.add('light-mode');
    document.getElementById('darkIcon').innerHTML = '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>';
}

// ── Notifications ──
let notifOpen = false;
function toggleNotifs() {
    notifOpen = !notifOpen;
    document.getElementById('notifDropdown').classList.toggle('open', notifOpen);
    if (notifOpen) loadNotifs();
}

function loadNotifs() {
    fetch(SITE_URL + '/notifications')
        .then(r => r.json())
        .then(data => {
            const list = document.getElementById('notifList');
            const badge = document.getElementById('notifBadge');
            if (!data.items || data.items.length === 0) {
                list.innerHTML = '<div class="notif-empty">Aucune notification</div>';
                badge.style.display = 'none';
                return;
            }
            badge.style.display = data.unread > 0 ? 'flex' : 'none';
            badge.textContent = data.unread > 9 ? '9+' : data.unread;
            list.innerHTML = data.items.map(n => `
                <a class="notif-item ${n.read ? '' : 'unread'}" href="${n.link || '#'}">
                    <span class="notif-dot ${n.read ? 'read' : ''}"></span>
                    <div>
                        <div class="notif-title">${n.title}</div>
                        ${n.body ? `<div class="notif-body">${n.body}</div>` : ''}
                        <div class="notif-time">${n.time ? new Date(n.time).toLocaleDateString('fr-CA') : ''}</div>
                    </div>
                </a>`).join('');
        })
        .catch(() => {
            document.getElementById('notifList').innerHTML = '<div class="notif-empty">Erreur de chargement</div>';
        });
}

function markAllRead() {
    fetch(SITE_URL + '/notifications/markread', { method:'POST', body: new URLSearchParams({csrf_token: CSRF_TOKEN}) })
        .then(() => {
            document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
            document.querySelectorAll('.notif-dot').forEach(el => el.classList.add('read'));
            const badge = document.getElementById('notifBadge');
            badge.style.display = 'none';
        });
}

// Fermer dropdowns en cliquant ailleurs
document.addEventListener('click', function(e) {
    if (!document.getElementById('notifWrapper')?.contains(e.target)) {
        document.getElementById('notifDropdown')?.classList.remove('open');
        notifOpen = false;
    }
    if (!document.getElementById('langSwitcherDb')?.contains(e.target)) {
        document.getElementById('langDropdownDb')?.classList.remove('open');
    }
});

// Poll notifications toutes les 60s
setInterval(loadNotifs, 60000);
</script>
</body>
</html>
