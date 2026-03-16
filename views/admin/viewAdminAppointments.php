<?php
$counts = ['new'=>0,'in_progress'=>0,'completed'=>0,'cancelled'=>0];
foreach ($appointments as $a) {
    if (isset($counts[$a->getStatus()])) $counts[$a->getStatus()]++;
}
$statusLabels = ['new'=>'Nouveau','in_progress'=>'En cours','completed'=>'Terminé','cancelled'=>'Annulé'];
?>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
    <div>
        <h2 style="font-family:'Oswald',sans-serif;font-size:1.3rem;color:var(--text);text-transform:uppercase;letter-spacing:.05em">Demandes de RDV</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-top:4px"><?= count($appointments) ?> demande<?= count($appointments) > 1 ? 's' : '' ?> au total</p>
    </div>
</div>

<!-- Mini stats statuts -->
<div style="display:flex;gap:10px;margin-bottom:24px;flex-wrap:wrap">
    <?php foreach ($counts as $status => $count): ?>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:12px 18px;display:flex;align-items:center;gap:10px">
        <span class="admin-pill <?= $status ?>"><?= $statusLabels[$status] ?></span>
        <strong style="font-family:'Oswald',sans-serif;font-size:1.2rem;color:var(--text)"><?= $count ?></strong>
    </div>
    <?php endforeach; ?>
</div>

<div class="db-card">
    <input type="text" class="admin-search" placeholder="🔍  Rechercher par nom, email, service…" id="apptSearch" oninput="filterTable('apptSearch','apptTable')">

    <?php if (empty($appointments)): ?>
        <div class="db-empty">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <p>Aucune demande pour l'instant.</p>
        </div>
    <?php else: ?>
        <table class="admin-table" id="apptTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Date souhaitée</th>
                    <th>Durée</th>
                    <th>Plateformes</th>
                    <th>Statut</th>
                    <th>Reçu le</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $a): ?>
                <tr>
                    <td style="color:var(--muted);font-size:.8rem"><?= $a->getId() ?></td>
                    <td>
                        <strong><?= htmlspecialchars($a->getFullName()) ?></strong><br>
                        <span style="color:var(--muted);font-size:.78rem"><?= htmlspecialchars($a->getEmail()) ?></span>
                        <?php if ($a->getPhone()): ?>
                            <br><span style="color:var(--muted);font-size:.78rem"><?= htmlspecialchars($a->getPhone()) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong style="font-size:.875rem"><?= htmlspecialchars($a->getService()) ?></strong>
                        <?php if ($a->getMessage()): ?>
                            <br>
                            <span style="color:var(--muted);font-size:.75rem;display:block;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?= htmlspecialchars($a->getMessage()) ?>">
                                <?= htmlspecialchars(mb_substr($a->getMessage(), 0, 60)).(mb_strlen($a->getMessage()) > 60 ? '…' : '') ?>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:.85rem"><?= htmlspecialchars($a->getDate() ?: '—') ?></td>
                    <td style="font-size:.82rem;color:var(--muted)"><?= htmlspecialchars($a->getDuration() ?: '—') ?></td>
                    <td style="font-size:.78rem;color:var(--muted)"><?= htmlspecialchars($a->getPlatforms() ?: '—') ?></td>
                    <td>
                        <span class="admin-pill <?= $a->getStatus() ?>"><?= $statusLabels[$a->getStatus()] ?? $a->getStatus() ?></span>
                    </td>
                    <td style="font-size:.82rem;color:var(--muted)"><?= date('d/m/Y H:i', strtotime($a->getCreatedAt())) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>