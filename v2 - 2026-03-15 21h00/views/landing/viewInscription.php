<style>
.auth-page { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:100px 20px 60px; background:#0a0a0a; }
.auth-card { background:#111; border:1px solid #1e1e1e; border-radius:16px; padding:48px 40px; width:100%; max-width:520px; }
.auth-logo { display:block; width:60px; margin:0 auto 24px; }
.auth-title { text-align:center; font-size:1.6rem; font-weight:700; color:#fff; margin:0 0 6px; }
.auth-sub   { text-align:center; color:#666; font-size:.9rem; margin:0 0 32px; }
.auth-errors { background:#2a0a0a; border:1px solid #5a1a1a; border-radius:8px; padding:14px 18px; margin-bottom:24px; }
.auth-errors p { color:#ff6b6b; font-size:.85rem; margin:4px 0; }
.auth-success { background:#0a2a12; border:1px solid #1a5a28; border-radius:8px; padding:14px 18px; margin-bottom:24px; }
.auth-success p { color:#4ade80; font-size:.85rem; margin:4px 0; }
.auth-flash-warning { background:#2a200a; border:1px solid #5a3d0a; border-radius:8px; padding:14px 18px; margin-bottom:24px; }
.auth-flash-warning p { color:#fbbf24; font-size:.85rem; margin:0; }
.auth-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.auth-group { margin-bottom:20px; }
.auth-group label { display:block; font-size:.8rem; font-weight:600; color:#aaa; letter-spacing:.05em; text-transform:uppercase; margin-bottom:8px; }
.auth-group input { width:100%; background:#0d0d0d; border:1px solid #2a2a2a; border-radius:8px; padding:12px 16px; color:#fff; font-size:.95rem; transition:border-color .2s; box-sizing:border-box; }
.auth-group input:focus { outline:none; border-color:#e63946; }
.auth-group input::placeholder { color:#444; }
.auth-checkbox { display:flex; align-items:flex-start; gap:12px; margin-bottom:16px; cursor:pointer; }
.auth-checkbox input[type=checkbox] { width:18px; height:18px; min-width:18px; margin-top:2px; accent-color:#e63946; cursor:pointer; }
.auth-checkbox span { font-size:.85rem; color:#888; line-height:1.5; }
.auth-checkbox span a { color:#e63946; text-decoration:none; }
.auth-checkbox span a:hover { text-decoration:underline; }
.auth-btn { width:100%; background:#e63946; color:#fff; border:none; border-radius:8px; padding:14px; font-size:1rem; font-weight:700; cursor:pointer; transition:background .2s; margin-top:8px; letter-spacing:.03em; }
.auth-btn:hover { background:#c1121f; }
.auth-links { text-align:center; margin-top:24px; font-size:.875rem; color:#555; }
.auth-links a { color:#e63946; text-decoration:none; }
.auth-links a:hover { text-decoration:underline; }
.auth-divider { border:none; border-top:1px solid #1e1e1e; margin:24px 0; }
@media(max-width:520px){ .auth-card{padding:32px 20px;} .auth-form-row{grid-template-columns:1fr;} }
</style>

<div class="auth-page">
    <div class="auth-card">
        <img src="<?= SITE_URL ?>/assets/img/ssp.png" alt="SannaStudio" class="auth-logo">
        <h1 class="auth-title">Créer un compte</h1>
        <p class="auth-sub">Rejoignez SannaStudio et gérez vos projets</p>

        <?php if (!empty($errors)): ?>
            <div class="auth-errors">
                <?php foreach ($errors as $e): ?>
                    <p>⚠ <?= htmlspecialchars($e) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $flash = Session::getFlash(); if ($flash): ?>
            <div class="auth-<?= $flash['type'] === 'success' ? 'success' : 'errors' ?>">
                <p><?= htmlspecialchars($flash['msg']) ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= SITE_URL ?>/inscription" novalidate>
            <?= functions::csrfField() ?>

            <div class="auth-form-row">
                <div class="auth-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($old['prenom'] ?? '') ?>" placeholder="Jean" required autofocus>
                </div>
                <div class="auth-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($old['nom'] ?? '') ?>" placeholder="Dupont" required>
                </div>
            </div>

            <div class="auth-group">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="jean@exemple.com" required>
            </div>

            <div class="auth-group">
                <label for="telephone">Téléphone <span style="color:#555;font-weight:400;text-transform:none">(facultatif)</span></label>
                <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($old['telephone'] ?? '') ?>" placeholder="+1 (514) 000-0000">
            </div>

            <div class="auth-form-row">
                <div class="auth-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" placeholder="8 caractères min." required>
                </div>
                <div class="auth-group">
                    <label for="confirm_password">Confirmer *</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Répétez le mot de passe" required>
                </div>
            </div>

            <hr class="auth-divider">

            <label class="auth-checkbox">
                <input type="checkbox" name="accepte_cgu" required>
                <span>J'ai lu et j'accepte les <a href="#" target="_blank">Conditions Générales d'Utilisation (CGU)</a></span>
            </label>

            <label class="auth-checkbox">
                <input type="checkbox" name="accepte_politique" required>
                <span>J'accepte la <a href="#" target="_blank">Politique de confidentialité</a></span>
            </label>

            <button type="submit" class="auth-btn">Créer mon compte →</button>
        </form>

        <div class="auth-links">
            Déjà un compte ? <a href="<?= SITE_URL ?>/connexion">Se connecter</a>
        </div>
        <div class="auth-links" style="margin-top:10px;">
            <a href="<?= SITE_URL ?>">← Retour au site</a>
        </div>
    </div>
</div>
