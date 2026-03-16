<style>
.inv-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:16px; }
.inv-card { background:var(--surface); border:1px solid var(--border); border-radius:4px; padding:24px; transition:.25s; }
.inv-card:hover { border-color:var(--accent); transform:translateY(-2px); }
.inv-card-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; }
.inv-number { font-family:'Space Mono',monospace; font-size:11px; color:var(--accent-h); letter-spacing:1px; }
.inv-type { font-family:'Oswald',sans-serif; font-size:20px; font-weight:700; color:#fff; text-transform:uppercase; margin:6px 0; }
.inv-amount { font-family:'Oswald',sans-serif; font-size:28px; font-weight:700; color:var(--accent); }
.inv-meta { font-size:12px; color:#666; margin-top:8px; }
.inv-status { display:inline-block; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; }
.inv-status.paid { background:rgba(34,197,94,.12); color:#22c55e; }
.inv-status.draft { background:rgba(234,179,8,.12); color:#eab308; }
.inv-status.sent { background:rgba(59,130,246,.12); color:#3b82f6; }
.inv-status.cancelled { background:rgba(107,114,128,.12); color:#9ca3af; }
.inv-download { display:inline-flex; align-items:center; gap:8px; margin-top:16px; padding:9px 18px; background:rgba(123,47,190,.12); border:1px solid rgba(123,47,190,.3); color:var(--accent-h); text-decoration:none; font-family:'Oswald',sans-serif; font-size:12px; letter-spacing:1px; text-transform:uppercase; transition:.2s; border-radius:3px; }
.inv-download:hover { background:rgba(123,47,190,.25); color:#fff; }
.inv-download svg { width:14px; height:14px; }
</style>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
    <div>
        <h2 style="font-family:'Oswald',sans-serif;font-size:1.4rem;text-transform:uppercase;letter-spacing:.05em;color:#fff">Mes devis & factures</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-top:4px"><?= count($invoices) ?> document<?= count($invoices)>1?'s':'' ?></p>
    </div>
</div>

<?php if (empty($invoices)): ?>
<div class="db-card">
    <div class="db-empty">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <p>Aucun document pour l'instant.</p>
        <a href="<?= SITE_URL ?>/#rdv" class="db-btn-primary" style="font-size:.8rem;padding:9px 20px">Prendre un RDV pour recevoir un devis →</a>
    </div>
</div>
<?php else: ?>
<div class="inv-grid">
    <?php foreach ($invoices as $inv): ?>
    <div class="inv-card">
        <div class="inv-card-header">
            <div>
                <div class="inv-number"><?= htmlspecialchars($inv->getNumber()) ?></div>
                <div class="inv-type"><?= htmlspecialchars($inv->getType()) ?></div>
            </div>
            <span class="inv-status <?= htmlspecialchars($inv->getStatus()) ?>"><?= htmlspecialchars($inv->getStatus()) ?></span>
        </div>
        <div class="inv-amount"><?= number_format($inv->getAmount(), 2, ',', ' ') ?> $</div>
        <div class="inv-meta">
            Émis le : <?= $inv->getIssuedAt() ? date('d/m/Y', strtotime($inv->getIssuedAt())) : '—' ?>
            <?php if ($inv->getNotes()): ?>
                <br><?= htmlspecialchars(mb_substr($inv->getNotes(), 0, 60)) ?>
            <?php endif; ?>
        </div>
        <a href="<?= SITE_URL ?>/invoices/download/<?= $inv->getId() ?>" target="_blank" class="inv-download">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Télécharger PDF
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
