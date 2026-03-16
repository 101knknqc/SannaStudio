<div class="auth-page">
    <div class="auth-card auth-card-narrow">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Connexion</h1>
        <p class="auth-sub">Accédez à votre espace client</p>

        <?php $flash = $flash ?? Session::getFlash(); if ($flash): ?>
            <div class="auth-alert <?= htmlspecialchars($flash['type']) ?>"><p><?= htmlspecialchars($flash['msg']) ?></p></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/connexion" novalidate>
            <?= functions::csrfField() ?>
            <div class="auth-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="jean@exemple.com" required autofocus>
            </div>
            <div class="auth-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="auth-forgot"><a href="<?= SITE_URL ?>/mot-de-passe-oublie">Mot de passe oublié ?</a></div>
            <button type="submit" class="auth-btn">Se connecter →</button>
        </form>

        <div class="auth-links">Pas encore de compte ? <a href="<?= SITE_URL ?>/inscription">Créer un compte</a></div>
        <div class="auth-links"><a href="<?= SITE_URL ?>">← Retour au site</a></div>
    </div>
</div>