<style>
.auth-page{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:100px 20px 60px;background:#0a0a0a}
.auth-card{background:#111;border:1px solid #1e1e1e;border-radius:16px;padding:48px 40px;width:100%;max-width:440px}
.auth-logo{display:block;width:60px;margin:0 auto 24px}
.auth-title{text-align:center;font-size:1.5rem;font-weight:700;color:#fff;margin:0 0 6px}
.auth-sub{text-align:center;color:#666;font-size:.875rem;margin:0 0 32px}
.auth-errors{background:#2a0a0a;border:1px solid #5a1a1a;border-radius:8px;padding:14px 18px;margin-bottom:24px}
.auth-errors p{color:#ff6b6b;font-size:.85rem;margin:4px 0}
.auth-group{margin-bottom:20px}
.auth-group label{display:block;font-size:.8rem;font-weight:600;color:#aaa;letter-spacing:.05em;text-transform:uppercase;margin-bottom:8px}
.auth-group input{width:100%;background:#0d0d0d;border:1px solid #2a2a2a;border-radius:8px;padding:12px 16px;color:#fff;font-size:.95rem;transition:border-color .2s;box-sizing:border-box}
.auth-group input:focus{outline:none;border-color:#e63946}
.auth-btn{width:100%;background:#e63946;color:#fff;border:none;border-radius:8px;padding:14px;font-size:1rem;font-weight:700;cursor:pointer;transition:background .2s}
.auth-btn:hover{background:#c1121f}
.auth-links{text-align:center;margin-top:24px;font-size:.875rem;color:#555}
.auth-links a{color:#e63946;text-decoration:none}
@media(max-width:480px){.auth-card{padding:32px 20px}}
</style>

<div class="auth-page">
    <div class="auth-card">
        <img src="<?= SITE_URL ?>/assets/img/ssp.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Nouveau mot de passe</h1>
        <p class="auth-sub">Choisissez un nouveau mot de passe sécurisé.</p>

        <?php if (!empty($errors)): ?>
            <div class="auth-errors">
                <?php foreach ($errors as $e): ?>
                    <p>⚠ <?= htmlspecialchars($e) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/reset-password?token=<?= urlencode($token ?? '') ?>" novalidate>
            <?= functions::csrfField() ?>
            <div class="auth-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" placeholder="8 caractères minimum" required autofocus>
            </div>
            <div class="auth-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Répétez le mot de passe" required>
            </div>
            <button type="submit" class="auth-btn">Enregistrer le nouveau mot de passe →</button>
        </form>

        <div class="auth-links">
            <a href="<?= SITE_URL ?>/connexion">← Retour à la connexion</a>
        </div>
    </div>
</div>
