<?php
$counts = ['new'=>0,'in_progress'=>0,'completed'=>0,'cancelled'=>0];
foreach ($appointments as $a) {
    if (isset($counts[$a->getStatus()])) $counts[$a->getStatus()]++;
}
$statusLabels = ['new'=>'Nouveau','in_progress'=>'En cours','completed'=>'Terminé','cancelled'=>'Annulé'];
?>

<style>
.kanban-board { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:32px; }
.kanban-col { background:var(--surface2); border:1px solid var(--border); border-radius:6px; overflow:hidden; min-height:300px; }
.kanban-col-header { padding:14px 16px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }
.kanban-col-title { font-family:'Oswald',sans-serif; font-size:13px; letter-spacing:1px; text-transform:uppercase; }
.kanban-col-count { font-family:'Space Mono',monospace; font-size:11px; color:var(--muted); }
.kanban-col-body { padding:10px; min-height:200px; transition:background .2s; }
.kanban-col-body.drag-over { background:rgba(123,47,190,.08); }
.kanban-card { background:var(--surface); border:1px solid var(--border); border-radius:4px; padding:14px; margin-bottom:8px; cursor:grab; transition:.2s; }
.kanban-card:hover { border-color:rgba(123,47,190,.5); transform:translateY(-1px); box-shadow:0 4px 12px rgba(0,0,0,.3); }
.kanban-card:active { cursor:grabbing; opacity:.7; }
.kanban-card.dragging { opacity:.4; }
.kanban-card-name { font-size:13px; font-weight:600; color:#ddd; margin-bottom:4px; }
.kanban-card-service { font-size:11px; color:var(--accent-h); margin-bottom:4px; font-family:'Space Mono',monospace; }
.kanban-card-meta { font-size:11px; color:#555; }
/* Status colours */
.kcol-new .kanban-col-header { border-top:3px solid #3b82f6; }
.kcol-in_progress .kanban-col-header { border-top:3px solid #eab308; }
.kcol-completed .kanban-col-header { border-top:3px solid #22c55e; }
.kcol-cancelled .kanban-col-header { border-top:3px solid #6b7280; }
@media(max-width:900px){ .kanban-board{grid-template-columns:1fr 1fr;} }
@media(max-width:600px){ .kanban-board{grid-template-columns:1fr;} }
</style>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px">
    <div>
        <h2 style="font-family:'Oswald',sans-serif;font-size:1.3rem;color:var(--text);text-transform:uppercase;letter-spacing:.05em">Demandes de RDV</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-top:4px"><?= count($appointments) ?> demande<?= count($appointments) > 1 ? 's' : '' ?> · Glisser-déposer pour changer le statut</p>
    </div>
    <div id="save-status" style="font-size:12px;color:#22c55e;display:none">✓ Sauvegardé</div>
</div>

<!-- Kanban Board -->
<div class="kanban-board" id="kanbanBoard">
    <?php foreach (['new','in_progress','completed','cancelled'] as $status): ?>
    <div class="kanban-col kcol-<?= $status ?>" id="col-<?= $status ?>" data-status="<?= $status ?>">
        <div class="kanban-col-header">
            <span class="kanban-col-title admin-pill <?= $status ?>" style="background:none;padding:0"><?= $statusLabels[$status] ?></span>
            <span class="kanban-col-count"><?= $counts[$status] ?></span>
        </div>
        <div class="kanban-col-body" id="body-<?= $status ?>">
            <?php foreach ($appointments as $a): if ($a->getStatus() !== $status) continue; ?>
            <div class="kanban-card"
                 draggable="true"
                 data-id="<?= $a->getId() ?>"
                 data-status="<?= $status ?>"
                 title="<?= htmlspecialchars($a->getMessage()) ?>">
                <div class="kanban-card-name"><?= htmlspecialchars($a->getFullName()) ?></div>
                <div class="kanban-card-service"><?= htmlspecialchars($a->getService()) ?></div>
                <div class="kanban-card-meta">
                    <?= htmlspecialchars($a->getEmail()) ?><br>
                    <?= $a->getDate() ? '📅 '.htmlspecialchars($a->getDate()) : '' ?>
                    <?= $a->getPlatforms() ? '<br>🎥 '.htmlspecialchars(mb_substr($a->getPlatforms(),0,30)) : '' ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Tableau fallback -->
<details style="margin-top:16px">
    <summary style="cursor:pointer;font-family:'Space Mono',monospace;font-size:11px;letter-spacing:2px;color:var(--muted);text-transform:uppercase;padding:8px 0">Voir en tableau</summary>
    <div class="db-card" style="margin-top:12px">
        <input type="text" class="admin-search" placeholder="🔍 Rechercher…" id="apptSearch" oninput="filterTable('apptSearch','apptTable')">
        <table class="admin-table" id="apptTable">
            <thead><tr><th>#</th><th>Client</th><th>Service</th><th>Date</th><th>Plateformes</th><th>Statut</th><th>Reçu le</th></tr></thead>
            <tbody>
                <?php foreach ($appointments as $a): ?>
                <tr>
                    <td style="color:var(--muted);font-size:.8rem"><?= $a->getId() ?></td>
                    <td>
                        <strong><?= htmlspecialchars($a->getFullName()) ?></strong><br>
                        <span style="color:var(--muted);font-size:.78rem"><?= htmlspecialchars($a->getEmail()) ?></span>
                    </td>
                    <td><?= htmlspecialchars($a->getService()) ?></td>
                    <td style="font-size:.85rem"><?= htmlspecialchars($a->getDate() ?: '—') ?></td>
                    <td style="font-size:.78rem;color:var(--muted)"><?= htmlspecialchars($a->getPlatforms() ?: '—') ?></td>
                    <td><span class="admin-pill <?= $a->getStatus() ?>"><?= $statusLabels[$a->getStatus()] ?></span></td>
                    <td style="font-size:.82rem;color:var(--muted)"><?= date('d/m/Y H:i', strtotime($a->getCreatedAt())) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</details>

<script>
const CSRF = '<?= functions::csrfToken() ?>';
const SURL = '<?= SITE_URL ?>';

// ── Drag & Drop Kanban ──
let dragEl = null;

document.querySelectorAll('.kanban-card').forEach(card => {
    card.addEventListener('dragstart', e => {
        dragEl = card;
        card.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    });
    card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        dragEl = null;
    });
});

document.querySelectorAll('.kanban-col-body').forEach(col => {
    col.addEventListener('dragover', e => {
        e.preventDefault();
        col.classList.add('drag-over');
    });
    col.addEventListener('dragleave', () => col.classList.remove('drag-over'));
    col.addEventListener('drop', e => {
        e.preventDefault();
        col.classList.remove('drag-over');
        if (!dragEl) return;

        const newStatus = col.closest('.kanban-col').dataset.status;
        const oldStatus = dragEl.dataset.status;
        const id = dragEl.dataset.id;

        if (newStatus === oldStatus) return;

        col.appendChild(dragEl);
        dragEl.dataset.status = newStatus;

        // Update count badges
        document.querySelectorAll('.kanban-col').forEach(c => {
            const s = c.dataset.status;
            c.querySelector('.kanban-col-count').textContent = c.querySelectorAll('.kanban-card').length;
        });

        // Save to server
        const fd = new FormData();
        fd.append('id', id);
        fd.append('status', newStatus);
        fd.append('csrf_token', CSRF);

        fetch(SURL + '/admin/update-appt-status', { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const s = document.getElementById('save-status');
                    s.style.display = 'inline';
                    setTimeout(() => s.style.display = 'none', 2000);
                }
            })
            .catch(err => console.error('Erreur update statut:', err));
    });
});

// ── Table search ──
function filterTable(inputId, tableId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll('#' + tableId + ' tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
