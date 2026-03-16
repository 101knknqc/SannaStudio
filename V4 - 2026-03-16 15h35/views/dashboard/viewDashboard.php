<!-- ══ WELCOME ══ -->
<div class="db-welcome">
    <div class="db-welcome-badge">▶ Espace client</div>
    <h1><?= Lang::t('dashboard.welcome') ?> <span><?= htmlspecialchars($user->getFirstName()) ?></span> 👋</h1>
    <p>Bienvenue dans votre espace SannaStudio. Retrouvez ici toutes vos demandes de rendez-vous et gérez votre compte facilement.</p>
    <div class="db-welcome-actions">
        <a href="<?= SITE_URL ?>/#rdv" class="db-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Prendre un rendez-vous
        </a>
        <a href="<?= SITE_URL ?>/#services" class="db-btn-secondary">Voir nos services →</a>
    </div>
</div>

<!-- ══ STATS ══ -->
<?php
$total     = count($appointments);
$completed = count(array_filter($appointments, fn($a) => $a->getStatus() === 'completed'));
$inprog    = count(array_filter($appointments, fn($a) => $a->getStatus() === 'in_progress'));
?>
<div class="db-stats">
    <div class="db-stat-card">
        <div class="db-stat-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= $total ?></div>
            <div class="db-stat-label">Demande<?= $total > 1 ? 's' : '' ?> de RDV</div>
        </div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= $completed ?></div>
            <div class="db-stat-label">Projet<?= $completed > 1 ? 's' : '' ?> terminé<?= $completed > 1 ? 's' : '' ?></div>
        </div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
            <div class="db-stat-num"><?= $inprog ?></div>
            <div class="db-stat-label">En cours</div>
        </div>
    </div>
</div>

<!-- ══ ACTIONS RAPIDES ══ -->
<p class="db-section-title">Actions rapides</p>
<div class="db-actions">
    <a href="<?= SITE_URL ?>/#rdv" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <div><div class="db-action-text">Nouveau RDV</div><div class="db-action-sub">Réserver une date</div></div>
    </a>
    <a href="<?= SITE_URL ?>/#services" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1"/></svg>
        <div><div class="db-action-text">Nos services</div><div class="db-action-sub">Voir l'offre complète</div></div>
    </a>
    <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
        <div><div class="db-action-text">Discord</div><div class="db-action-sub">Rejoindre la communauté</div></div>
    </a>
    <a href="mailto:contact@sannastudio.ca" class="db-action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        <div><div class="db-action-text">Nous contacter</div><div class="db-action-sub">contact@sannastudio.ca</div></div>
    </a>
</div>

<!-- ══ GRID : RDVs + Compte ══ -->
<div class="db-grid-2">

    <!-- Mes RDV -->
    <div class="db-card">
        <h3>📅 Mes rendez-vous</h3>
        <?php if (empty($appointments)): ?>
            <div class="db-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p><?= Lang::t('dashboard.rdv_none') ?></p>
                <a href="<?= SITE_URL ?>/#rdv" class="db-btn-primary" style="font-size:.8rem;padding:9px 20px"><?= Lang::t('dashboard.rdv_cta') ?> →</a>
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
                    <?php foreach ($appointments as $appt): ?>
                    <tr>
                        <td>
                            <span class="db-rdv-service"><?= htmlspecialchars($appt->getService()) ?></span>
                            <?php if ($appt->getPlatforms()): ?>
                                <span class="db-rdv-date"><?= htmlspecialchars($appt->getPlatforms()) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><span class="db-rdv-date"><?= htmlspecialchars($appt->getDate() ?: '—') ?></span></td>
                        <td>
                            <?php
                            $statusLabels = ['new'=>Lang::t('dashboard.status_pending'),'in_progress'=>Lang::t('dashboard.status_confirmed'),'completed'=>Lang::t('dashboard.status_done'),'cancelled'=>Lang::t('dashboard.status_cancelled')];
                            $s = $appt->getStatus();
                            ?>
                            <span class="db-badge <?= $s ?>"><?= $statusLabels[$s] ?? $s ?></span>
                        </td>
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
                <span class="db-info-val"><?= htmlspecialchars($user->getFullName()) ?></span>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                <span class="db-info-label">Email</span>
                <span class="db-info-val"><?= htmlspecialchars($user->getEmail()) ?></span>
            </li>
            <?php if ($user->getPhone()): ?>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.59 1.87h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17z"/></svg>
                <span class="db-info-label">Téléphone</span>
                <span class="db-info-val"><?= htmlspecialchars($user->getPhone()) ?></span>
            </li>
            <?php endif; ?>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <span class="db-info-label">Compte</span>
                <span class="db-info-val verified">✔ Vérifié</span>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="12" y1="11" x2="12" y2="17"/><line x1="9" y1="14" x2="15" y2="14"/></svg>
                <span class="db-info-label">Rôle</span>
                <?php if ($user->isAdmin()): ?>
                    <span class="db-info-val" style="color:#ff7070;font-weight:700">
                        ⚙ Administrateur
                        <a href="<?= SITE_URL ?>/admin" style="margin-left:10px;background:rgba(230,48,48,.12);color:#ff7070;border:1px solid rgba(230,48,48,.3);padding:2px 10px;border-radius:12px;font-size:.72rem;text-decoration:none;font-family:'Oswald',sans-serif;letter-spacing:.06em;text-transform:uppercase">
                            Panel Admin →
                        </a>
                    </span>
                <?php else: ?>
                    <span class="db-info-val" style="color:var(--accent-h)">★ Client</span>
                <?php endif; ?>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span class="db-info-label">Dernière connexion</span>
                <span class="db-info-val">
                    <?php
                    $ll = $user->getLastLoginAt();
                    echo $ll ? date('d/m/Y à H:i', strtotime($ll)) : 'Première connexion';
                    ?>
                </span>
            </li>
            <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span class="db-info-label">Membre depuis</span>
                <span class="db-info-val"><?= date('d/m/Y', strtotime($user->getCreatedAt())) ?></span>
            </li>
        </ul>
    </div>
</div>