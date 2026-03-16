<div style="text-align:center;padding:60px 20px">
    <div style="font-size:4rem;font-weight:900;color:#1a1a1a">Erreur</div>
    <p style="color:#888;margin:16px 0 24px"><?= htmlspecialchars($errorMsg ?? 'Une erreur est survenue.') ?></p>
    <a href="<?= SITE_URL ?>/dashboard" style="background:#e63946;color:#fff;padding:10px 22px;border-radius:8px;text-decoration:none;font-weight:600">← Retour au tableau de bord</a>
</div>
