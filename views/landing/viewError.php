<!-- ══ PAGE 404 ══ -->
<section style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:80px 5%;position:relative;overflow:hidden">
    <!-- Background -->
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 50%,rgba(123,47,190,.12)0%,transparent 70%),var(--black);z-index:0"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(123,47,190,.04)1px,transparent 1px),linear-gradient(90deg,rgba(123,47,190,.04)1px,transparent 1px);background-size:60px 60px;z-index:0"></div>

    <div style="position:relative;z-index:1;text-align:center;max-width:600px">
        <div style="font-family:'Oswald',sans-serif;font-size:clamp(100px,18vw,200px);font-weight:700;line-height:0.85;color:transparent;-webkit-text-stroke:2px rgba(123,47,190,.4);letter-spacing:-8px;margin-bottom:32px;animation:slideUp .7s ease both">
            404
        </div>
        <p class="section-label" style="margin-bottom:16px">// Page introuvable</p>
        <h1 style="font-family:'Oswald',sans-serif;font-size:clamp(28px,5vw,48px);font-weight:700;color:#fff;margin-bottom:16px;line-height:1.1">
            Cette page n'existe <span style="color:var(--purple)">pas</span>
        </h1>
        <p style="color:#888;font-size:16px;margin-bottom:40px;line-height:1.7">
            <?= htmlspecialchars($errorMsg ?? 'La page que vous recherchez a été déplacée ou supprimée.') ?>
        </p>
        <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
            <a href="<?= SITE_URL ?>" class="btn-primary">← Retour à l'accueil</a>
            <a href="<?= SITE_URL ?>/#rdv" class="btn-secondary">Nous contacter</a>
        </div>

        <!-- Petits liens utiles -->
        <div style="margin-top:48px;display:flex;gap:24px;justify-content:center;flex-wrap:wrap">
            <?php foreach ([['Services','/#services'],['Tarifs','/tarifs'],['Portfolio','/portfolio'],['Blog','/blog']] as [$label,$link]): ?>
            <a href="<?= SITE_URL.$link ?>" style="font-family:'Space Mono',monospace;font-size:11px;letter-spacing:2px;color:#555;text-decoration:none;text-transform:uppercase;transition:.2s" onmouseover="this.style.color='#9B4FDE'" onmouseout="this.style.color='#555'"><?= $label ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
