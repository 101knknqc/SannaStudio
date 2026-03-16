<div style="text-align:center;padding:60px 20px">
    <div style="font-size:4rem;font-weight:900;color:#1a1a1a;font-family:'Oswald',sans-serif">Erreur</div>
    <p style="color:var(--muted);margin:16px 0 24px;font-family:'Rajdhani',sans-serif"><?= htmlspecialchars($errorMsg ?? 'Une erreur est survenue.') ?></p>
    <a href="<?= SITE_URL ?>/dashboard" class="db-btn-primary">← Tableau de bord</a>
</div>
