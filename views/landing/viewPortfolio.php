<section style="padding:120px 5% 80px">
    <p class="section-label reveal">// Nos réalisations</p>
    <h1 class="section-title reveal">Notre <span>Portfolio</span></h1>
    <p class="section-sub reveal">Quelques projets dont nous sommes fiers.</p>

    <?php if (empty($items)): ?>
    <div style="text-align:center;padding:80px 0;color:#555">
        <p>Portfolio en construction — revenez bientôt !</p>
    </div>
    <?php else: ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:2px;background:rgba(123,47,190,.15)" class="reveal">
        <?php foreach ($items as $item): ?>
        <div style="background:var(--dark);overflow:hidden;position:relative;group" onmouseover="this.querySelector('.port-overlay').style.opacity='1'" onmouseout="this.querySelector('.port-overlay').style.opacity='0'">
            <?php if ($item->getCoverUrl()): ?>
            <img src="<?= htmlspecialchars($item->getCoverUrl()) ?>" alt="" style="width:100%;height:260px;object-fit:cover;display:block;transition:.5s" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <?php else: ?>
            <div style="height:260px;background:linear-gradient(135deg,rgba(123,47,190,.15),var(--card-bg));display:flex;align-items:center;justify-content:center;font-size:60px">📺</div>
            <?php endif; ?>
            <div class="port-overlay" style="position:absolute;inset:0;background:rgba(10,10,10,.85);display:flex;flex-direction:column;justify-content:center;align-items:center;opacity:0;transition:.3s;padding:28px;text-align:center">
                <?php if ($item->getVideoUrl()): ?>
                <a href="<?= htmlspecialchars($item->getVideoUrl()) ?>" target="_blank" style="background:var(--purple);color:#fff;padding:12px 24px;text-decoration:none;font-family:'Oswald',sans-serif;font-size:14px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">▶ Voir la vidéo</a>
                <?php endif; ?>
                <p style="color:#ccc;font-size:14px;line-height:1.7"><?= htmlspecialchars($item->getDescription()) ?></p>
            </div>
            <div style="padding:20px 24px">
                <p style="font-family:'Space Mono',monospace;font-size:10px;color:var(--purple-light);letter-spacing:2px;margin-bottom:6px;text-transform:uppercase"><?= htmlspecialchars($item->getCategory()) ?></p>
                <h3 style="font-family:'Oswald',sans-serif;font-size:18px;font-weight:700;color:#fff;margin-bottom:10px"><?= htmlspecialchars($item->getTitle()) ?></h3>
                <div style="display:flex;flex-wrap:wrap;gap:6px">
                    <?php foreach ($item->getTags() as $tag): ?>
                    <span style="background:rgba(123,47,190,.12);border:1px solid rgba(123,47,190,.3);color:var(--purple-light);font-family:'Space Mono',monospace;font-size:9px;padding:3px 8px;text-transform:uppercase;letter-spacing:1px"><?= htmlspecialchars($tag) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div style="text-align:center;margin-top:64px" class="reveal">
        <a href="<?= SITE_URL ?>/#rdv" class="btn-primary">Votre projet nous intéresse →</a>
    </div>
</section>
