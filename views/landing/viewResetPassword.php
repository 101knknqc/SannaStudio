<div class="auth-page">
    <div class="auth-card auth-card-narrow">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title"><?= Lang::t('auth.reset_title') ?></h1>
        <p class="auth-sub"><?= Lang::t('auth.reset_sub') ?></p>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" novalidate>
            <?= functions::csrfField() ?>
            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
            <div class="auth-group">
                <label for="password"><?= Lang::t('auth.field_new_password') ?></label>
                <input type="password" id="password" name="password"
                       placeholder="<?= Lang::t('auth.field_password_hint') ?>" required autofocus>
            </div>
            <div class="auth-group">
                <label for="confirm_password"><?= Lang::t('auth.field_confirm_new') ?></label>
                <input type="password" id="confirm_password" name="confirm_password"
                       placeholder="<?= Lang::t('auth.field_confirm_hint') ?>" required>
            </div>
            <button type="submit" class="auth-btn"><?= Lang::t('auth.reset_btn') ?></button>
        </form>

        <div class="auth-links"><a href="<?= SITE_URL ?>"><?= Lang::t('auth.back_site') ?></a></div>
    </div>
</div>
