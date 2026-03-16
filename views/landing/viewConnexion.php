<div class="auth-page">
    <div class="auth-card auth-card-narrow">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP" class="auth-logo" style="height:50px;width:auto">
        <h1 class="auth-title"><?= Lang::t('auth.login_title') ?></h1>
        <p class="auth-sub"><?= Lang::t('auth.login_sub') ?></p>

        <?php $flash = $flash ?? Session::getFlash(); if ($flash): ?>
            <div class="auth-alert <?= htmlspecialchars($flash['type']) ?>">
                <p><?= htmlspecialchars($flash['msg']) ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/connexion" novalidate>
            <?= functions::csrfField() ?>
            <div class="auth-group">
                <label for="email"><?= Lang::t('auth.field_email') ?></label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                       placeholder="jean@exemple.com" required autofocus>
            </div>
            <div class="auth-group">
                <label for="password"><?= Lang::t('auth.field_password') ?></label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••" required>
            </div>
            <div class="auth-forgot">
                <a href="<?= SITE_URL ?>/mot-de-passe-oublie"><?= Lang::t('auth.forgot') ?></a>
            </div>
            <button type="submit" class="auth-btn"><?= Lang::t('auth.btn_login') ?></button>
        </form>

        <div class="auth-links">
            <?= Lang::t('auth.no_account') ?>
            <a href="<?= SITE_URL ?>/inscription"><?= Lang::t('auth.register_link') ?></a>
        </div>
        <div class="auth-links"><a href="<?= SITE_URL ?>"><?= Lang::t('auth.back_site') ?></a></div>
    </div>
</div>
