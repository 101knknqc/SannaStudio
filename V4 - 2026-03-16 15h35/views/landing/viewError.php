<style>
.error-page{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:120px 20px 60px;text-align:center}
.error-code{font-size:8rem;font-weight:900;color:#1a1a1a;line-height:1;font-family:'Oswald',sans-serif;letter-spacing:-.05em}
.error-title{font-size:1.5rem;font-weight:700;color:var(--white);margin:8px 0 16px;font-family:'Oswald',sans-serif;text-transform:uppercase;letter-spacing:.05em}
.error-msg{color:var(--gray);font-size:.95rem;max-width:400px;margin:0 auto 32px;line-height:1.7}
.error-btn{display:inline-block;background:var(--purple);color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700;font-size:.9rem;font-family:'Oswald',sans-serif;letter-spacing:.06em;text-transform:uppercase;transition:background .2s}
.error-btn:hover{background:var(--purple-dark)}
</style>
<div class="error-page">
    <div>
        <div class="error-code">4<span style="color:var(--purple)">0</span>4</div>
        <h1 class="error-title">Page introuvable</h1>
        <p class="error-msg"><?= htmlspecialchars($errorMsg ?? 'Cette page n\'existe pas ou a été déplacée.') ?></p>
        <a href="<?= SITE_URL ?>" class="error-btn">← Retour à l'accueil</a>
    </div>
</div>
