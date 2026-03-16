<style>
.db-welcome {
    background: linear-gradient(135deg, #1a0608 0%, #2a0c10 50%, #1a0608 100%);
    border: 1px solid rgba(230,57,70,.25);
    border-radius: 16px;
    padding: 32px 36px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}
.db-welcome::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(230,57,70,.15) 0%, transparent 70%);
    pointer-events: none;
}
.db-welcome-badge {
    display: inline-block;
    background: rgba(230,57,70,.15);
    border: 1px solid rgba(230,57,70,.3);
    color: #e63946;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 14px;
}
.db-welcome h1 {
    font-size: 1.8rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 8px;
    line-height: 1.2;
}
.db-welcome h1 span { color: #e63946; }
.db-welcome p { color: #888; font-size: .9rem; line-height: 1.6; max-width: 540px; }
.db-welcome-actions { display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
.db-btn-primary {
    background: #e63946; color: #fff; padding: 10px 22px;
    border-radius: 8px; font-size: .875rem; font-weight: 600;
    text-decoration: none; transition: background .2s; display: inline-flex; align-items: center; gap: 6px;
}
.db-btn-primary:hover { background: #c1121f; }
.db-btn-secondary {
    background: rgba(255,255,255,.06); color: #ccc; padding: 10px 22px;
    border-radius: 8px; font-size: .875rem; font-weight: 600; border: 1px solid #2a2a2a;
    text-decoration: none; transition: all .2s; display: inline-flex; align-items: center; gap: 6px;
}
.db-btn-secondary:hover { background: rgba(255,255,255,.1); color: #fff; }

/* ── STATS ── */
.db-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px; }
.db-stat-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 12px; padding: 20px 22px;
    display: flex; align-items: center; gap: 16px;
}
.db-stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.db-stat-icon svg { width: 20px; height: 20px; }
.db-stat-icon.red   { background: rgba(230,57,70,.15); color: #e63946; }
.db-stat-icon.green { background: rgba(34,197,94,.15); color: #22c55e; }
.db-stat-icon.blue  { background: rgba(59,130,246,.15); color: #3b82f6; }
.db-stat-num   { font-size: 1.6rem; font-weight: 800; color: #fff; line-height: 1; }
.db-stat-label { font-size: .75rem; color: var(--muted); margin-top: 4px; }

/* ── SECTIONS ── */
.db-section-title {
    font-size: .7rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--muted); margin-bottom: 16px;
}
.db-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 32px; }
.db-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 12px; padding: 24px;
}
.db-card h3 { font-size: 1rem; font-weight: 700; margin-bottom: 16px; color: #fff; }

/* ── RDV TABLE ── */
.db-rdv-table { width: 100%; border-collapse: collapse; }
.db-rdv-table th {
    font-size: .7rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
    color: var(--muted); text-align: left; padding: 0 0 10px; border-bottom: 1px solid var(--border);
}
.db-rdv-table td { padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,.04); font-size: .85rem; vertical-align: top; }
.db-rdv-table tr:last-child td { border-bottom: none; }
.db-rdv-service { font-weight: 600; color: #fff; display: block; }
.db-rdv-date    { color: var(--muted); font-size: .8rem; }
.db-badge {
    display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: .72rem; font-weight: 700;
}
.db-badge.nouveau    { background: rgba(59,130,246,.15); color: #3b82f6; }
.db-badge.en_cours   { background: rgba(234,179,8,.15);  color: #eab308; }
.db-badge.termine    { background: rgba(34,197,94,.15);  color: #22c55e; }
.db-badge.annule     { background: rgba(107,114,128,.15);color: #9ca3af; }

.db-empty {
    text-align: center; padding: 40px 20px; color: var(--muted);
}
.db-empty svg { width: 40px; height: 40px; margin: 0 auto 12px; display: block; opacity: .3; }
.db-empty p { font-size: .875rem; margin-bottom: 16px; }

/* ── INFOS COMPTE ── */
.db-info-list { list-style: none; }
.db-info-list li {
    display: flex; align-items: center; gap: 12px; padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,.04); font-size: .85rem;
}
.db-info-list li:last-child { border-bottom: none; }
.db-info-list .db-info-label { color: var(--muted); min-width: 80px; font-size: .8rem; }
.db-info-list .db-info-val   { color: #fff; font-weight: 500; }
.db-info-list svg { width: 15px; height: 15px; color: var(--muted); flex-shrink: 0; }

/* ── QUICK ACTIONS ── */
.db-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-bottom: 32px; }
.db-action-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 10px;
    padding: 18px; text-decoration: none; color: var(--text);
    display: flex; align-items: center; gap: 14px; transition: all .15s;
}
.db-action-card:hover { border-color: rgba(230,57,70,.4); background: rgba(230,57,70,.04); }
.db-action-card svg { width: 20px; height: 20px; color: #e63946; flex-shrink: 0; }
.db-action-card .db-action-text { font-size: .85rem; font-weight: 600; }
.db-action-card .db-action-sub  { font-size: .75rem; color: var(--muted); margin-top: 2px; }

@media(max-width:768px) {
    .db-grid-2 { grid-template-columns: 1fr; }
    .db-welcome { padding: 24px 20px; }
    .db-welcome h1 { font-size: 1.4rem; }
}
</style>

<!-- ══ BIENVENUE ══ -->
<div class="db-welcome">
    <div class="db-welcome-badge">▶ Espace client</div>
    <h1>Salut, <span><?= htmlspecialchars($client->getPrenom()) ?></span> 👋</h1>
    <p>Bienvenue dans votre espace SannaStudio. Retrouvez ici toutes vos demandes de rendez-vous et gérez votre compte facilement.</p>
    <div class="db-welcome-actions">
        <a href="<?= SITE_URL ?>/#rdv" class="db-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Prendre un rendez-vous
        </a>
        <a href="<?= SITE_URL ?>/#services" class="db-btn-secondary">
            Voir nos services →
        </a>
    </div>
</div>

<!-- ══ STATS ══ -->
<div class="db-stats">
    <div class="db-stat-card">
        <div class="db-stat-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= count($rdvs) ?></div>
            <div class="db-stat-label">Demande<?= count($rdvs) > 1 ? 's' : '' ?> de RDV</div>
        </div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= count(array_filter($rdvs, fn($r) => $r->getStatut() === 'termine')) ?></div>
            <div class="db-stat-label">Projet<?= count(array_filter($rdvs, fn($r) => $r->getStatut() === 'termine')) > 1 ? 's' : '' ?> terminé<?= count(array_filter($rdvs, fn($r) => $r->getStatut() === 'termine')) > 1 ? 's' : '' ?></div>
        </div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= count(array_filter($rdvs, fn($r) => $r->getStatut() === 'en_cours')) ?></div>
            <div class="db-stat-label">En cours</div>
        </div>
    </div>
</div>

<!-- ══ ACTIONS RAPIDES ══ -->
<p class="db-section-title">Actions rapides</p>
<div class="db-actions">
    <a href="<?= SITE_URL ?>/#rdv" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <div>
            <div class="db-action-text">Nouveau RDV</div>
            <div class="db-action-sub">Réserver une date</div>
        </div>
    </a>
    <a href="<?= SITE_URL ?>/#services" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1"/></svg>
        <div>
            <div class="db-action-text">Nos services</div>
            <div class="db-action-sub">Voir l'offre complète</div>
        </div>
    </a>
    <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128c.126-.094.252-.192.372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.1.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
        <div>
            <div class="db-action-text">Discord</div>
            <div class="db-action-sub">Rejoindre la communauté</div>
        </div>
    </a>
    <a href="mailto:contact@sannastudio.ca" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        <div>
            <div class="db-action-text">Nous contacter</div>
            <div class="db-action-sub">contact@sannastudio.ca</div>
        </div>
    </a>
</div>

<!-- ══ GRID : RDVs + Compte ══ -->
<div class="db-grid-2">

    <!-- Mes RDV -->
    <div class="db-card">
        <h3>📅 Mes demandes de RDV</h3>
        <?php if (empty($rdvs)): ?>
            <div class="db-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p>Aucune demande pour l'instant.</p>
                <a href="<?= SITE_URL ?>/#rdv" class="db-btn-primary" style="font-size:.8rem;padding:8px 18px">Prendre un RDV →</a>
            </div>
        <?php else: ?>
            <table class="db-rdv-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rdvs as $rdv): ?>
                    <tr>
                        <td>
                            <span class="db-rdv-service"><?= htmlspecialchars($rdv->getService()) ?></span>
                            <?php if ($rdv->getPlateformes()): ?>
                                <span class="db-rdv-date"><?= htmlspecialchars($rdv->getPlateformes()) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><span class="db-rdv-date"><?= htmlspecialchars($rdv->getDate() ?: '—') ?></span></td>
                        <td><span class="db-badge <?= htmlspecialchars($rdv->getStatut()) ?>"><?= ucfirst(str_replace('_',' ', $rdv->getStatut())) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Mon compte -->
    <div class="db-card">
        <h3>👤 Mon compte</h3>
        <ul class="db-info-list">
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span class="db-info-label">Nom</span>
                <span class="db-info-val"><?= htmlspecialchars($client->getNomComplet()) ?></span>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                <span class="db-info-label">Email</span>
                <span class="db-info-val"><?= htmlspecialchars($client->getEmail()) ?></span>
            </li>
            <?php if ($client->getTelephone()): ?>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.59 1.87h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17z"/></svg>
                <span class="db-info-label">Tél.</span>
                <span class="db-info-val"><?= htmlspecialchars($client->getTelephone()) ?></span>
            </li>
            <?php endif; ?>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <span class="db-info-label">Compte</span>
                <span class="db-info-val" style="color:#22c55e">✔ Vérifié</span>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span class="db-info-label">Membre depuis</span>
                <span class="db-info-val"><?= date('d/m/Y', strtotime($client->getCreatedAt())) ?></span>
            </li>
        </ul>
    </div>
</div>
