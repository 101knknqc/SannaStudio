<div class="auth-page">
    <div class="auth-card auth-card-narrow">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Nouveau mot de passe</h1>
        <p class="auth-sub">Choisissez un nouveau mot de passe sécurisé.</p>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/reset-password?token=<?= urlencode($token ?? '') ?>" novalidate>
            <?= functions::csrfField() ?>
            <div class="auth-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" placeholder="8 caractères minimum" required autofocus>
            </div>
            <div class="auth-group">
                <label for="confirm_password">Confirmer</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Répétez" required>
            </div>
            <button type="submit" class="auth-btn">Enregistrer →</button>
        </form>

        <div class="auth-links"><a href="<?= SITE_URL ?>/connexion">← Retour à la connexion</a></div>
    </div>
</div>