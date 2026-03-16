<!-- ══ KPIs ══ -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:32px">
    <div class="admin-kpi">
        <div class="admin-kpi-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <div>
            <div class="admin-kpi-num"><?= $total_users ?></div>
            <div class="admin-kpi-label">Client<?= $total_users > 1 ? 's' : '' ?> inscrits</div>
        </div>
    </div>
    <div class="admin-kpi">
        <div class="admin-kpi-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div>
            <div class="admin-kpi-num"><?= $total_appts ?></div>
            <div class="admin-kpi-label">Demande<?= $total_appts > 1 ? 's' : '' ?> RDV total</div>
        </div>
    </div>
    <div class="admin-kpi">
        <div class="admin-kpi-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div>
            <div class="admin-kpi-num"><?= $new_appts ?></div>
            <div class="admin-kpi-label">Nouvelle<?= $new_appts > 1 ? 's' : '' ?> demande<?= $new_appts > 1 ? 's' : '' ?></div>
        </div>
    </div>
</div>

<!-- ══ GRID: derniers RDV + derniers clients ══ -->
<div class="db-grid-2">

    <!-- Dernières demandes -->
    <div class="db-card">
        <h3>📅 Dernières demandes RDV</h3>
        <?php if (empty($recent_appts)): ?>
            <div class="db-empty"><p>Aucune demande pour l'instant.</p></div>
        <?php else: ?>
            <table class="admin-table">
                <thead><tr><th>Client</th><th>Service</th><th>Date</th><th>Statut</th></tr></thead>
                <tbody>
                    <?php foreach ($recent_appts as $a):
                        $statusLabels = ['new'=>'Nouveau','in_progress'=>'En cours','completed'=>'Terminé','cancelled'=>'Annulé'];
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($a->getFullName()) ?><br><span style="color:var(--muted);font-size:.78rem"><?= htmlspecialchars($a->getEmail()) ?></span></td>
                        <td><?= htmlspecialchars($a->getService()) ?></td>
                        <td style="color:var(--muted);font-size:.82rem"><?= $a->getDate() ?: '—' ?></td>
                        <td><span class="admin-pill <?= $a->getStatus() ?>"><?= $statusLabels[$a->getStatus()] ?? $a->getStatus() ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="margin-top:16px">
                <a href="<?= SITE_URL ?>/admin/appointments" class="db-btn-secondary" style="font-size:.8rem;padding:8px 16px">Voir toutes les demandes →</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Derniers clients -->
    <div class="db-card">
        <h3>👥 Derniers clients inscrits</h3>
        <?php if (empty($recent_users)): ?>
            <div class="db-empty"><p>Aucun client pour l'instant.</p></div>
        <?php else: ?>
            <table class="admin-table">
                <thead><tr><th>Nom</th><th>Email</th><th>Statut</th><th>Inscrit le</th></tr></thead>
                <tbody>
                    <?php foreach ($recent_users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u->getFullName()) ?></td>
                        <td style="font-size:.82rem;color:var(--muted)"><?= htmlspecialchars($u->getEmail()) ?></td>
                        <td>
                            <span class="admin-pill <?= $u->isEmailVerified() ? 'verified' : 'pending' ?>">
                                <?= $u->isEmailVerified() ? 'Vérifié' : 'En attente' ?>
                            </span>
                        </td>
                        <td style="color:var(--muted);font-size:.8rem"><?= date('d/m/Y', strtotime($u->getCreatedAt())) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="margin-top:16px">
                <a href="<?= SITE_URL ?>/admin/users" class="db-btn-secondary" style="font-size:.8rem;padding:8px 16px">Voir tous les clients →</a>
            </div>
        <?php endif; ?>
    </div>
</div>