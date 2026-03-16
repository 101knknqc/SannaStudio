<div class="auth-page">
    <div class="auth-card">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title"><?= Lang::t('auth.register_title') ?></h1>
        <p class="auth-sub"><?= Lang::t('auth.register_sub') ?></p>

        <?php if (!empty($errors)): ?>
            <div class="auth-alert error">
                <?php foreach ($errors as $e): ?><p>⚠ <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $flash = Session::getFlash(); if ($flash): ?>
            <div class="auth-alert <?= $flash['type'] ?>"><p><?= htmlspecialchars($flash['msg']) ?></p></div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/inscription" novalidate>
            <?= functions::csrfField() ?>
            <div class="auth-form-row">
                <div class="auth-group">
                    <label for="first_name"><?= Lang::t('auth.field_firstname') ?></label>
                    <input type="text" id="first_name" name="first_name"
                           value="<?= htmlspecialchars($old['first'] ?? '') ?>"
                           placeholder="Jean" required autofocus>
                </div>
                <div class="auth-group">
                    <label for="last_name"><?= Lang::t('auth.field_lastname') ?></label>
                    <input type="text" id="last_name" name="last_name"
                           value="<?= htmlspecialchars($old['last'] ?? '') ?>"
                           placeholder="Dupont" required>
                </div>
            </div>
            <div class="auth-group">
                <label for="email"><?= Lang::t('auth.field_email') ?></label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                       placeholder="jean@exemple.com" required>
            </div>
            <div class="auth-group">
                <label for="phone">
                    <?= Lang::t('auth.field_phone') ?>
                    <span class="optional"><?= Lang::t('auth.field_phone_optional') ?></span>
                </label>
                <input type="tel" id="phone" name="phone"
                       value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                       placeholder="+1 (514) 000-0000">
            </div>
            <div class="auth-form-row">
                <div class="auth-group">
                    <label for="password"><?= Lang::t('auth.field_password') ?></label>
                    <input type="password" id="password" name="password"
                           placeholder="<?= Lang::t('auth.field_password_hint') ?>" required>
                </div>
                <div class="auth-group">
                    <label for="confirm_password"><?= Lang::t('auth.field_confirm') ?></label>
                    <input type="password" id="confirm_password" name="confirm_password"
                           placeholder="<?= Lang::t('auth.field_confirm_hint') ?>" required>
                </div>
            </div>

            <hr class="auth-divider">

            <!-- CGU — obligatoire -->
            <label class="auth-checkbox" id="tos-label">
                <input type="checkbox" name="accepted_tos" id="tos" required
                       <?= !empty($old) && isset($_POST['accepted_tos']) ? 'checked' : '' ?>>
                <span>
                    <?= Lang::t('auth.accept_tos') ?>
                    <a href="/cgu" target="_blank"><?= Lang::t('auth.tos_link') ?></a>
                    <span class="req-star" aria-hidden="true"> *</span>
                </span>
            </label>

            <!-- Politique — obligatoire -->
            <label class="auth-checkbox" id="privacy-label">
                <input type="checkbox" name="accepted_privacy" id="privacy" required
                       <?= !empty($old) && isset($_POST['accepted_privacy']) ? 'checked' : '' ?>>
                <span>
                    <?= Lang::t('auth.accept_privacy') ?>
                    <a href="/politique" target="_blank"><?= Lang::t('auth.privacy_link') ?></a>
                    <span class="req-star" aria-hidden="true"> *</span>
                </span>
            </label>

            <button type="submit" class="auth-btn" id="register-btn">
                <?= Lang::t('auth.btn_register') ?>
            </button>
        </form>

        <div class="auth-links">
            <?= Lang::t('auth.already_account') ?>
            <a href="<?= SITE_URL ?>/connexion"><?= Lang::t('auth.login_link') ?></a>
        </div>
        <div class="auth-links"><a href="<?= SITE_URL ?>"><?= Lang::t('auth.back_site') ?></a></div>
    </div>
</div>

<script>
// Validation visuelle des checkboxes obligatoires
(function() {
    const form   = document.querySelector('form');
    const tos    = document.getElementById('tos');
    const priv   = document.getElementById('privacy');
    const tosLbl = document.getElementById('tos-label');
    const prvLbl = document.getElementById('privacy-label');

    function markCheckbox(lbl, checked) {
        lbl.style.outline = checked ? '' : '1px solid #E63030';
        lbl.style.borderRadius = '3px';
    }

    form?.addEventListener('submit', function(e) {
        let valid = true;
        markCheckbox(tosLbl, tos.checked);
        markCheckbox(prvLbl, priv.checked);
        if (!tos.checked || !priv.checked) {
            e.preventDefault();
            valid = false;
            // Scroll vers les checkboxes
            tosLbl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    tos.addEventListener('change',  () => markCheckbox(tosLbl, tos.checked));
    priv.addEventListener('change', () => markCheckbox(prvLbl, priv.checked));
})();
</script>
