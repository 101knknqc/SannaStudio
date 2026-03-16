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

<!-- ══ LOADER ══ -->
<div id="page-loader">
    <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP" style="width:100px;height:auto">
    <div class="loader-bar-wrap"><div class="loader-bar"></div></div>
    <div class="loader-version">v4.0</div>
</div>

    <!-- ══ NAVIGATION ══ -->
    <nav>
        <a class="nav-logo" href="<?= SITE_URL ?>">
            <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP" style="height:38px;width:auto">
        </a>
        <ul class="nav-links">
            <li><a href="<?= SITE_URL ?>/#services"><?= Lang::t('nav.services') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#process"><?= Lang::t('nav.process') ?></a></li>
            <li><a href="<?= SITE_URL ?>/#equipe"><?= Lang::t('nav.team') ?></a></li>
            <li><a href="<?= SITE_URL ?>/tarifs">Tarifs</a></li>
            <li><a href="<?= SITE_URL ?>/portfolio">Portfolio</a></li>
            <li class="nav-more-wrap">
                <button class="nav-more-btn" onclick="toggleNavMore(event)">Plus <span style="font-size:8px">▼</span></button>
                <div class="nav-more-dropdown" id="navMoreDropdown">
                    <a href="<?= SITE_URL ?>/#platforms"><?= Lang::t('nav.platforms') ?></a>
                    <a href="<?= SITE_URL ?>/#discord"><?= Lang::t('nav.discord') ?></a>
                    <a href="<?= SITE_URL ?>/blog">Blog</a>
                    <a href="<?= SITE_URL ?>/cgu">CGU</a>
                    <a href="<?= SITE_URL ?>/politique">Politique</a>
                </div>
            </li>
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

            <!-- Dark mode toggle -->
            <div class="nav-extra">
                <button class="dark-toggle-landing" id="darkToggleLanding" onclick="toggleDarkLanding()" title="Mode clair/sombre" aria-label="Thème">
                    <svg id="darkIconLanding" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>
            </div>

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
                <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SSP" class="footer-main-logo" loading="lazy">
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
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap">
                <p>© <?= date('Y') ?> <?= Lang::t('footer.copyright') ?></p>
                <span style="font-family:'Space Mono',monospace;font-size:10px;color:rgba(123,47,190,.6);letter-spacing:2px;border:1px solid rgba(123,47,190,.25);padding:2px 8px;border-radius:2px">v4.0</span>
            </div>
            <div style="display:flex;gap:20px;flex-wrap:wrap">
                <a href="<?= SITE_URL ?>/cgu" style="color:#555;font-size:12px;text-decoration:none;transition:.2s" onmouseover="this.style.color='#9B4FDE'" onmouseout="this.style.color='#555'">CGU</a>
                <a href="<?= SITE_URL ?>/politique" style="color:#555;font-size:12px;text-decoration:none;transition:.2s" onmouseover="this.style.color='#9B4FDE'" onmouseout="this.style.color='#555'">Politique de confidentialité</a>
                <a href="<?= SITE_URL ?>/portfolio" style="color:#555;font-size:12px;text-decoration:none;transition:.2s" onmouseover="this.style.color='#9B4FDE'" onmouseout="this.style.color='#555'">Portfolio</a>
                <a href="<?= SITE_URL ?>/blog" style="color:#555;font-size:12px;text-decoration:none;transition:.2s" onmouseover="this.style.color='#9B4FDE'" onmouseout="this.style.color='#555'">Blog</a>
            </div>
        </div>
    </footer>

    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
    <script>
    // ── Loader ──
    window.addEventListener('load', () => {
        setTimeout(() => document.getElementById('page-loader')?.classList.add('hidden'), 800);
    });

    // ── Dark mode landing ──
    function toggleDarkLanding() {
        const isLight = document.body.classList.toggle('light-mode');
        localStorage.setItem('sanna_theme', isLight ? 'light' : 'dark');
        const icon = document.getElementById('darkIconLanding');
        if (icon) icon.innerHTML = isLight
            ? '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>'
            : '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>';
    }
    if (localStorage.getItem('sanna_theme') === 'light') {
        document.body.classList.add('light-mode');
        const icon = document.getElementById('darkIconLanding');
        if (icon) icon.innerHTML = '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>';
    }

    // ── Compteurs animés ──
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'));
        const suffix = el.getAttribute('data-suffix') || '';
        const duration = 1800;
        const start = performance.now();
        const update = (now) => {
            const elapsed = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - elapsed, 3);
            el.textContent = Math.round(ease * target) + suffix;
            if (elapsed < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }

    const counterObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                animateCounter(e.target);
                counterObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-counter]').forEach(el => counterObs.observe(el));
    </script>
    <script>
    // ── Nav "Plus" dropdown ──
    function toggleNavMore(e) {
        e.stopPropagation();
        document.getElementById('navMoreDropdown')?.classList.toggle('open');
    }

    // Fermer tous les dropdowns en cliquant ailleurs
    document.addEventListener('click', function(e) {
        const sw = document.getElementById('langSwitcher');
        const dd = document.getElementById('langDropdown');
        if (sw && !sw.contains(e.target)) dd?.classList.remove('open');

        const navMore = document.getElementById('navMoreDropdown');
        const navMoreBtn = document.querySelector('.nav-more-btn');
        if (navMore && !navMoreBtn?.contains(e.target)) navMore.classList.remove('open');
    });
    </script>
</body>
</html>
