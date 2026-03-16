<article style="padding:120px 5% 80px;max-width:800px;margin:0 auto">
    <a href="<?= SITE_URL ?>/blog" style="font-family:'Space Mono',monospace;font-size:11px;color:var(--purple-light);text-decoration:none;letter-spacing:2px;display:inline-flex;align-items:center;gap:8px;margin-bottom:32px">← Blog</a>
    <?php if ($post->getCoverUrl()): ?>
    <img src="<?= htmlspecialchars($post->getCoverUrl()) ?>" alt="" style="width:100%;height:400px;object-fit:cover;margin-bottom:40px;border:1px solid var(--border)">
    <?php endif; ?>
    <p style="font-family:'Space Mono',monospace;font-size:11px;color:var(--purple-light);letter-spacing:2px;margin-bottom:12px"><?= $post->getPublishedAt() ? date('d/m/Y', strtotime($post->getPublishedAt())) : '' ?></p>
    <h1 style="font-family:'Oswald',sans-serif;font-size:clamp(28px,4vw,48px);font-weight:700;color:#fff;line-height:1.1;margin-bottom:32px"><?= htmlspecialchars($post->getTitle()) ?></h1>
    <div style="color:#bbb;font-size:16px;line-height:1.9;border-left:3px solid var(--purple);padding-left:24px;margin-bottom:40px"><?= nl2br(htmlspecialchars($post->getContent())) ?></div>
    <a href="<?= SITE_URL ?>/#rdv" class="btn-primary">Travailler avec nous →</a>
</article>
