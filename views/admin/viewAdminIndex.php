<?php
$statusLabels = ['new'=>'Nouveau','in_progress'=>'En cours','completed'=>'Terminé','cancelled'=>'Annulé'];
$statusCounts = ['new'=>0,'in_progress'=>0,'completed'=>0,'cancelled'=>0];
foreach ($recent_appts as $a) {
    if (isset($statusCounts[$a->getStatus()])) $statusCounts[$a->getStatus()]++;
}
// Répartition complète
$am = new AppointmentManager();
$all = $am->getRecent(200);
$allCounts = ['new'=>0,'in_progress'=>0,'completed'=>0,'cancelled'=>0];
foreach ($all as $a) {
    if (isset($allCounts[$a->getStatus()])) $allCounts[$a->getStatus()]++;
}
?>

<!-- Stats cards -->
<div class="db-stats" style="margin-bottom:32px">
    <div class="db-stat-card">
        <div class="db-stat-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div><div class="db-stat-num"><?= $total_users ?></div><div class="db-stat-label">Clients inscrits</div></div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div><div class="db-stat-num"><?= $total_appts ?></div><div class="db-stat-label">RDV totaux</div></div>
    </div>
    <div class="db-stat-card">
        <div class="db-stat-icon" style="background:rgba(59,130,246,.12);border-color:rgba(59,130,246,.3)">
            <svg viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div><div class="db-stat-num" style="color:#3b82f6"><?= $new_appts ?></div><div class="db-stat-label">Nouveaux RDV</div></div>
    </div>
    <?php
    $nm = new NotificationManager();
    $mm = new MessageManager();
    $msgs = count($mm->getInbox(1)); // approx
    ?>
    <div class="db-stat-card">
        <div class="db-stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <div><div class="db-stat-num"><?= (new BlogManager())->countPublished() ?></div><div class="db-stat-label">Articles publiés</div></div>
    </div>
</div>

<!-- Charts -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:32px">
    <!-- Donut statuts -->
    <div class="db-card">
        <h3 style="margin-bottom:20px">Répartition des RDV</h3>
        <div style="position:relative;height:220px;display:flex;align-items:center;justify-content:center">
            <canvas id="chartStatuts" height="220"></canvas>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:16px;justify-content:center">
            <?php
            $colors=['new'=>'#3b82f6','in_progress'=>'#eab308','completed'=>'#22c55e','cancelled'=>'#6b7280'];
            foreach ($allCounts as $s=>$n):
            ?>
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:#aaa">
                <span style="width:10px;height:10px;border-radius:2px;background:<?= $colors[$s] ?>;flex-shrink:0"></span>
                <?= $statusLabels[$s] ?> <strong style="color:#fff">(<?= $n ?>)</strong>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bar chart derniers RDV par jour -->
    <div class="db-card">
        <h3 style="margin-bottom:20px">RDV — 7 derniers jours</h3>
        <div style="position:relative;height:220px">
            <canvas id="chartWeek" height="220"></canvas>
        </div>
    </div>
</div>

<!-- Derniers clients + derniers RDV -->
<div class="db-grid-2">
    <div class="db-card">
        <h3>👥 Derniers clients inscrits</h3>
        <table class="admin-table" style="margin-top:12px">
            <thead><tr><th>Nom</th><th>Email</th><th>Inscrit le</th></tr></thead>
            <tbody>
                <?php foreach ($recent_users as $u): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($u->getFullName()) ?></strong></td>
                    <td style="color:var(--muted);font-size:.82rem"><?= htmlspecialchars($u->getEmail()) ?></td>
                    <td style="color:var(--muted);font-size:.82rem"><?= date('d/m/Y', strtotime($u->getCreatedAt())) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= SITE_URL ?>/admin/users" style="display:block;margin-top:16px;font-family:'Space Mono',monospace;font-size:11px;letter-spacing:2px;color:var(--accent-h);text-transform:uppercase;text-decoration:none">Voir tous les clients →</a>
    </div>

    <div class="db-card">
        <h3>📅 Dernières demandes</h3>
        <table class="admin-table" style="margin-top:12px">
            <thead><tr><th>Client</th><th>Service</th><th>Statut</th></tr></thead>
            <tbody>
                <?php foreach ($recent_appts as $a): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($a->getFullName()) ?></strong><br>
                        <span style="font-size:.75rem;color:var(--muted)"><?= date('d/m/Y',strtotime($a->getCreatedAt())) ?></span>
                    </td>
                    <td style="font-size:.85rem"><?= htmlspecialchars(mb_substr($a->getService(),0,28)) ?></td>
                    <td><span class="admin-pill <?= $a->getStatus() ?>"><?= $statusLabels[$a->getStatus()] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= SITE_URL ?>/admin/appointments" style="display:block;margin-top:16px;font-family:'Space Mono',monospace;font-size:11px;letter-spacing:2px;color:var(--accent-h);text-transform:uppercase;text-decoration:none">Gérer les RDV →</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
Chart.defaults.color = '#888';
Chart.defaults.borderColor = 'rgba(255,255,255,.06)';

// ── Donut statuts ──
new Chart(document.getElementById('chartStatuts'), {
    type: 'doughnut',
    data: {
        labels: ['Nouveau', 'En cours', 'Terminé', 'Annulé'],
        datasets: [{
            data: [<?= $allCounts['new'] ?>, <?= $allCounts['in_progress'] ?>, <?= $allCounts['completed'] ?>, <?= $allCounts['cancelled'] ?>],
            backgroundColor: ['#3b82f6','#eab308','#22c55e','#6b7280'],
            borderColor: '#111',
            borderWidth: 3,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.parsed}` } } }
    }
});

// ── Bar derniers 7 jours ──
<?php
$days = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $label = date('d/m', strtotime("-$i days"));
    $count = 0;
    foreach ($all as $a) {
        if (substr($a->getCreatedAt(), 0, 10) === $date) $count++;
    }
    $days[] = ['label' => $label, 'count' => $count];
}
?>
new Chart(document.getElementById('chartWeek'), {
    type: 'bar',
    data: {
        labels: [<?= implode(',', array_map(fn($d) => '"'.$d['label'].'"', $days)) ?>],
        datasets: [{
            label: 'RDV',
            data: [<?= implode(',', array_column($days, 'count')) ?>],
            backgroundColor: 'rgba(123,47,190,.6)',
            borderColor: '#7B2FBE',
            borderWidth: 1,
            borderRadius: 3,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { stepSize: 1, precision: 0 }, grid: { color: 'rgba(255,255,255,.05)' } },
            x: { grid: { display: false } }
        }
    }
});
</script>
