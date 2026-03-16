<div class="auth-page">
    <div class="auth-card">
        <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Créer un compte</h1>
        <p class="auth-sub">Rejoignez SannaStudio et gérez vos projets</p>

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
                    <label for="first_name">Prénom *</label>
                    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($old['first'] ?? '') ?>" placeholder="Jean" required autofocus>
                </div>
                <div class="auth-group">
                    <label for="last_name">Nom *</label>
                    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($old['last'] ?? '') ?>" placeholder="Dupont" required>
                </div>
            </div>
            <div class="auth-group">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="jean@exemple.com" required>
            </div>
            <div class="auth-group">
                <label for="phone">Téléphone <span class="optional">(facultatif)</span></label>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>" placeholder="+1 (514) 000-0000">
            </div>
            <div class="auth-form-row">
                <div class="auth-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" placeholder="8 caractères min." required>
                </div>
                <div class="auth-group">
                    <label for="confirm_password">Confirmer *</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Répétez" required>
                </div>
            </div>
            <hr class="auth-divider">
            <label class="auth-checkbox">
                <input type="checkbox" name="accepted_tos" required>
                <span>J'ai lu et j'accepte les <a href="#" target="_blank">Conditions Générales d'Utilisation</a></span>
            </label>
            <label class="auth-checkbox">
                <input type="checkbox" name="accepted_privacy" required>
                <span>J'accepte la <a href="#" target="_blank">Politique de confidentialité</a></span>
            </label>
            <button type="submit" class="auth-btn">Créer mon compte →</button>
        </form>

        <div class="auth-links">Déjà un compte ? <a href="<?= SITE_URL ?>/connexion">Se connecter</a></div>
        <div class="auth-links"><a href="<?= SITE_URL ?>">← Retour au site</a></div>
    </div>
</div>