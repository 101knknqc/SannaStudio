<section style="padding:120px 5% 80px">
    <p class="section-label reveal">// Actualités</p>
    <h1 class="section-title reveal">Notre <span>Blog</span></h1>
    <p class="section-sub reveal">Conseils, actualités et coulisses de SannaStudio.</p>

    <?php if (empty($posts)): ?>
    <div style="text-align:center;padding:80px 0;color:#555">
        <p style="font-size:18px">Aucun article publié pour l'instant.</p>
        <p style="font-size:14px;margin-top:8px">Revenez bientôt !</p>
    </div>
    <?php else: ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2px;background:rgba(123,47,190,.2)">
        <?php foreach ($posts as $post): ?>
        <a href="<?= SITE_URL ?>/blog/<?= htmlspecialchars($post->getSlug()) ?>" style="background:var(--dark);text-decoration:none;display:flex;flex-direction:column;transition:.3s;border:1px solid transparent" onmouseover="this.style.borderColor='rgba(123,47,190,.5)'" onmouseout="this.style.borderColor='transparent'">
            <?php if ($post->getCoverUrl()): ?>
            <div style="height:200px;overflow:hidden"><img src="<?= htmlspecialchars($post->getCoverUrl()) ?>" alt="" style="width:100%;height:100%;object-fit:cover;transition:.5s" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"></div>
            <?php else: ?>
            <div style="height:140px;background:linear-gradient(135deg,rgba(123,47,190,.15),var(--card-bg));display:flex;align-items:center;justify-content:center;font-size:40px">📡</div>
            <?php endif; ?>
            <div style="padding:28px;flex:1;display:flex;flex-direction:column">
                <p style="font-family:'Space Mono',monospace;font-size:10px;color:var(--purple-light);letter-spacing:2px;margin-bottom:12px"><?= $post->getPublishedAt() ? date('d/m/Y', strtotime($post->getPublishedAt())) : '' ?></p>
                <h2 style="font-family:'Oswald',sans-serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:12px;line-height:1.3"><?= htmlspecialchars($post->getTitle()) ?></h2>
                <?php if ($post->getExcerpt()): ?>
                <p style="color:#888;font-size:14px;line-height:1.7;flex:1"><?= htmlspecialchars(mb_substr($post->getExcerpt(),0,120)) ?>…</p>
                <?php endif; ?>
                <span style="margin-top:20px;font-family:'Oswald',sans-serif;font-size:13px;letter-spacing:2px;text-transform:uppercase;color:var(--purple-light)">Lire l'article →</span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>
