<div class="auth-page">
    <div class="auth-card auth-card-narrow">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Mot de passe oublié</h1>
        <p class="auth-sub">Entrez votre email et nous vous enverrons un lien de réinitialisation.</p>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success ?? false): ?>
            <div class="auth-alert success">
                <p>✔ Si cette adresse existe, un email vient d'être envoyé. Vérifiez votre boîte.</p>
            </div>
        <?php else: ?>
            <form method="POST" action="<?= SITE_URL ?>/mot-de-passe-oublie" novalidate>
                <?= functions::csrfField() ?>
                <div class="auth-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" placeholder="jean@exemple.com" required autofocus>
                </div>
                <button type="submit" class="auth-btn">Envoyer le lien →</button>
            </form>
        <?php endif; ?>

        <div class="auth-links"><a href="<?= SITE_URL ?>/connexion">← Retour à la connexion</a></div>
    </div>
</div>  