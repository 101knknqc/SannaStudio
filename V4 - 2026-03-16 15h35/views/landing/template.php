<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'SannaStudio') ?></title>
    <meta name="description" content="SannaStudio : prestataire technique en webdiffusion professionnelle et intégration audiovisuelle au Québec.">
    <meta property="og:title" content="SannaStudio — Webdiffusion Professionnelle Québec">
    <meta property="og:image" content="<?= SITE_URL ?>/assets/img/ssp.png">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/auth.css">
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/ssp.png" type="image/x-icon">
    <link rel="sitemap" type="application/xml" href="/sitemap.xml">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9637J3ZMH5"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-9637J3ZMH5');</script>
</head>
<body>

    <!-- ══ NAVIGATION ══ -->
    <nav>
        <a class="nav-logo" href="<?= SITE_URL ?>">
            <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio">
        </a>
        <ul class="nav-links">
            <li><a href="<?= SITE_URL ?>/#services"><?= Lang::t('nav.services') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#process"><?= Lang::t('nav.process') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#platforms"><?= Lang::t('nav.platforms') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#equipe"><?= Lang::t('nav.team') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#discord"><?= Lang::t('nav.discord') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#rdv" class="nav-cta"><?= Lang::t('nav.rdv') ?></a></li>
        </ul>

        <!-- Auth zone -->
        <div class="nav-auth">
            <?php if (Session::isLoggedIn()): ?>
                <div class="nav-auth-user">
                    <span><?= Lang::t('nav.hello') ?> <?= htmlspecialchars(Session::get('user_first_name')) ?></span>
                    <a href="<?= SITE_URL ?>/dashboard" class="dash-btn"><?= Lang::t('nav.dashboard') ?></a>
                    <a href="<?= SITE_URL ?>/deconnexion"><?= Lang::t('nav.logout') ?></a>
                </div>
            <?php else: ?>
                <a href="<?= SITE_URL ?>/connexion" class="nav-auth-login"><?= Lang::t('nav.login') ?></a>
                <a href="<?= SITE_URL ?>/inscription" class="nav-auth-btn"><?= Lang::t('nav.register') ?></a>
            <?php endif; ?>

            <!-- Sélecteur de langue -->
            <div class="lang-switcher" id="langSwitcher">
                <?php $langs = Lang::available(); $cur = Lang::current(); ?>
                <button class="lang-btn" onclick="document.getElementById('langDropdown').classList.toggle('open')" aria-label="Language">
                    <span class="lang-flag"><?= $langs[$cur]['emoji'] ?? '🌐' ?></span>
                    <span><?= strtoupper($cur) ?></span>
                    <span style="font-size:8px;opacity:.6">▼</span>
                </button>
                <div class="lang-dropdown" id="langDropdown">
                    <?php foreach ($langs as $code => $info): ?>
                        <a href="?lang=<?= $code ?>" class="lang-option <?= $code === $cur ? 'active' : '' ?>">
                            <span class="lang-flag"><?= $info['emoji'] ?></span>
                            <span><?= htmlspecialchars($info['name']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <button class="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- ══ CONTENU ══ -->
    <?= $content ?>

    <!-- ══ FOOTER ══ -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio" class="footer-main-logo" loading="lazy">
                <p><?= Lang::t('footer.desc') ?></p>
            </div>
            <div class="footer-col">
                <h4><?= Lang::t('footer.col1_title') ?></h4>
                <ul>
                    <li><a href="<?= SITE_URL ?>/#services"><?= Lang::t('services.svc1_title') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/#services"><?= Lang::t('services.svc2_title') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/#services"><?= Lang::t('services.svc3_title') ?></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?= Lang::t('footer.col2_title') ?></h4>
                <ul>
                    <li><a href="<?= SITE_URL ?>/#rdv"><?= Lang::t('footer.link_rdv') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/#platforms"><?= Lang::t('footer.link_platforms') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/#process"><?= Lang::t('footer.link_process') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/#equipe"><?= Lang::t('footer.link_team') ?></a></li>
                    <li><a href="<?= SITE_URL ?>/connexion"><?= Lang::t('footer.link_dashboard') ?></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date('Y') ?> <?= Lang::t('footer.copyright') ?></p>
        </div>
    </footer>

    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
    <script>
    // Fermer le dropdown lang en cliquant ailleurs
    document.addEventListener('click', function(e) {
        const sw = document.getElementById('langSwitcher');
        const dd = document.getElementById('langDropdown');
        if (sw && !sw.contains(e.target)) dd?.classList.remove('open');
    });
    </script>
</body>
</html>
