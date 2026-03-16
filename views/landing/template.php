<!DOCTYPE html>
<html lang="fr">
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
            <li><a href="<?= SITE_URL ?>/#services">Services</a></li>
            <li><a href="<?= SITE_URL ?>/#process">Processus</a></li>
            <li><a href="<?= SITE_URL ?>/#platforms">Plateformes</a></li>
            <li><a href="<?= SITE_URL ?>/#equipe">Équipe</a></li>
            <li><a href="<?= SITE_URL ?>/#discord">Discord</a></li>
            <li><a href="<?= SITE_URL ?>/#rdv" class="nav-cta">Prendre RDV</a></li>
        </ul>

        <!-- Auth zone -->
        <div class="nav-auth">
            <?php if (Session::isLoggedIn()): ?>
                <div class="nav-auth-user">
                    <span>👋 <?= htmlspecialchars(Session::get('user_first_name')) ?></span>
                    <a href="<?= SITE_URL ?>/dashboard" class="dash-btn">Mon espace</a>
                    <a href="<?= SITE_URL ?>/deconnexion">Déconnexion</a>
                </div>
            <?php else: ?>
                <a href="<?= SITE_URL ?>/connexion" class="nav-auth-login">Connexion</a>
                <a href="<?= SITE_URL ?>/inscription" class="nav-auth-btn">Créer un compte</a>
            <?php endif; ?>
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
                <p>SannaStudio est un prestataire technique spécialisé en webdiffusion professionnelle et intégration audiovisuelle. De l'événement unique à l'installation permanente.</p>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="<?= SITE_URL ?>/#services">Webdiffusion événementielle</a></li>
                    <li><a href="<?= SITE_URL ?>/#services">Installation permanente</a></li>
                    <li><a href="<?= SITE_URL ?>/#services">Formation OBS Studio</a></li>
                    <li><a href="<?= SITE_URL ?>/#services">Support technique</a></li>
                    <li><a href="<?= SITE_URL ?>/#services">Maintenance</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="<?= SITE_URL ?>/#rdv">Prendre rendez-vous</a></li>
                    <li><a href="<?= SITE_URL ?>/#platforms">Plateformes</a></li>
                    <li><a href="<?= SITE_URL ?>/#process">Notre processus</a></li>
                    <li><a href="<?= SITE_URL ?>/#equipe">Notre équipe</a></li>
                    <li><a href="<?= SITE_URL ?>/connexion">Mon espace client</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date('Y') ?> SannaStudio. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>