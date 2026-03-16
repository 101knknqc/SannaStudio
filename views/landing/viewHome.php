    <!-- ══ HERO ══ -->
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>

        <div class="hero-layout">

            <!-- COL 1 : Texte -->
            <div class="hero-content">
                <div class="hero-badge"><?= Lang::t('hero.badge') ?></div>
                <h1 class="hero-title">
                    <span class="line-1"><?= Lang::t('hero.line1') ?></span><span class="line-2"><?= Lang::t('hero.line2') ?></span><span class="line-3"><?= Lang::t('hero.line3') ?></span>
                </h1>
                <p class="hero-sub">
                    SannaStudio n'est pas juste une équipe qui <strong>«fait des lives»</strong>.
                    C'est un prestataire technique en diffusion et intégration audiovisuelle —
                    de l'événement unique à l'installation permanente.
                </p>
                <div class="hero-actions">
                    <a href="#rdv" class="btn-primary"><?= Lang::t('hero.btn_primary') ?></a>
                    <a href="#services" class="btn-secondary"><?= Lang::t('hero.btn_secondary') ?></a>
                </div>
            </div>

            <!-- COL 2 : Visuel central -->
            <div class="hero-visual">
                <div class="hero-visual-ring ring-1"></div>
                <div class="hero-visual-ring ring-2"></div>
                <div class="hero-visual-ring ring-3"></div>
                <div class="hero-visual-core">
                    <img src="<?= SITE_URL ?>/assets/img/logo-white.png" alt="SannaStudio">
                </div>
                <div class="hero-orbit-dot dot-1"></div>
                <div class="hero-orbit-dot dot-2"></div>
                <div class="hero-orbit-dot dot-3"></div>
                <div class="hero-platform-tag tag-yt">▶ YouTube</div>
                <div class="hero-platform-tag tag-tt">♪ TikTok</div>
                <div class="hero-platform-tag tag-fb">f Facebook</div>
                <div class="hero-platform-tag tag-zm">Z Zoom</div>
            </div>

            <!-- COL 3 : Stats -->
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-num">5+</div>
                    <div class="stat-label">Plateformes simultanées</div>
                </div>
                <div class="stat">
                    <div class="stat-num">4K</div>
                    <div class="stat-label">Qualité de diffusion</div>
                </div>
                <div class="stat">
                    <div class="stat-num">24h</div>
                    <div class="stat-label">Support réactif</div>
                </div>
            </div>

        </div>
        <div class="scroll-hint"><?= Lang::t('hero.scroll') ?></div>
    </section>

    <!-- ══ TICKER ══ -->
    <div id="ticker-strip">
        <div class="ticker-inner">
            <span class="ticker-item">Webdiffusion événementielle</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Installation permanente</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">OBS Studio Pro</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Diffusion multi-plateformes</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Drone 4K</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Formation & Support</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Audio professionnel</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Encodeurs & Régie</span>
            <span class="ticker-sep">✦</span>
            <!-- Duplicate for seamless loop -->
            <span class="ticker-item">Webdiffusion événementielle</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Installation permanente</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">OBS Studio Pro</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Diffusion multi-plateformes</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Drone 4K</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Formation & Support</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Audio professionnel</span>
            <span class="ticker-sep">✦</span>
            <span class="ticker-item">Encodeurs & Régie</span>
            <span class="ticker-sep">✦</span>
        </div>
    </div>

    <!-- ══ SERVICES ══ -->
    <section id="services">
        <p class="section-label reveal">// 01 — Ce que nous faisons</p>
        <h2 class="section-title reveal">Nos <span>Services</span></h2>
        <p class="section-sub reveal">Trois approches complémentaires pour répondre à tous vos besoins en diffusion
            audiovisuelle.</p>

        <div class="services-new-grid">

            <!-- Service A -->
            <div class="svc-block reveal">
                <div class="svc-num">01</div>
                <div class="svc-header">
                    <div class="svc-icon-wrap"><svg class="svc-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9" />
                            <path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5" />
                            <path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1" />
                        </svg></div>
                    <div>
                        <p class="svc-tag">Service A — Mobile</p>
                        <h3 class="svc-title">Webdiffusion<br>Événementielle</h3>
                    </div>
                </div>
                <p class="svc-desc">Nous nous déplaçons chez vous avec notre équipement complet pour une diffusion live
                    professionnelle de votre événement.</p>
                <ul class="svc-list">
                    <li><span class="svc-check">✓</span> Caméras professionnelles & drone</li>
                    <li><span class="svc-check">✓</span> PC de régie & encodeurs</li>
                    <li><span class="svc-check">✓</span> Setup OBS Studio complet</li>
                    <li><span class="svc-check">✓</span> Diffusion multi-plateformes simultanée</li>
                    <li><span class="svc-check">✓</span> Installation, tests & supervision</li>
                    <li><span class="svc-check">✓</span> Démontage inclus</li>
                </ul>
                <a href="#rdv" class="svc-cta">Réserver un événement →</a>
            </div>

            <!-- Service B -->
            <div class="svc-block svc-featured reveal">
                <div class="svc-featured-badge">POPULAIRE</div>
                <div class="svc-num">02</div>
                <div class="svc-header">
                    <div class="svc-icon-wrap"><svg class="svc-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" />
                            <path d="M9 22v-4h6v4" />
                            <path d="M8 6h.01" />
                            <path d="M16 6h.01" />
                            <path d="M12 6h.01" />
                            <path d="M12 10h.01" />
                            <path d="M12 14h.01" />
                            <path d="M16 10h.01" />
                            <path d="M16 14h.01" />
                            <path d="M8 10h.01" />
                            <path d="M8 14h.01" />
                        </svg></div>
                    <div>
                        <p class="svc-tag">Service B — Permanent</p>
                        <h3 class="svc-title">Installation<br>Permanente</h3>
                    </div>
                </div>
                <p class="svc-desc">Nous intégrons un poste de webdiffusion complet dans vos locaux : école, église,
                    salle municipale, entreprise.</p>
                <ul class="svc-list">
                    <li><span class="svc-check">✓</span> Installation complète du matériel</li>
                    <li><span class="svc-check">✓</span> Configuration OBS avancée</li>
                    <li><span class="svc-check">✓</span> Création de scènes personnalisées</li>
                    <li><span class="svc-check">✓</span> Automatisation & workflow</li>
                    <li><span class="svc-check">✓</span> Formation du personnel</li>
                    <li><span class="svc-check">✓</span> Contrat de maintenance disponible</li>
                </ul>
                <a href="#rdv" class="svc-cta">Demander un devis →</a>
            </div>

            <!-- Service C -->
            <div class="svc-block reveal">
                <div class="svc-num">03</div>
                <div class="svc-header">
                    <div class="svc-icon-wrap"><svg class="svc-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c3 3 9 3 12 0v-5" />
                        </svg></div>
                    <div>
                        <p class="svc-tag">Service C — Formation</p>
                        <h3 class="svc-title">Formation &<br>Support Technique</h3>
                    </div>
                </div>
                <p class="svc-desc">Accompagnement technique de votre équipe pour maîtriser l'outil de diffusion et
                    assurer une autonomie complète.</p>
                <ul class="svc-list">
                    <li><span class="svc-check">✓</span> Formation OBS Studio</li>
                    <li><span class="svc-check">✓</span> Gestion des scènes & transitions</li>
                    <li><span class="svc-check">✓</span> Configuration audio en direct</li>
                    <li><span class="svc-check">✓</span> Dépannage & maintenance</li>
                    <li><span class="svc-check">✓</span> Support à distance</li>
                    <li><span class="svc-check">✓</span> Documentation personnalisée</li>
                </ul>
                <a href="#rdv" class="svc-cta">En savoir plus →</a>
            </div>

        </div>
    </section>

    <!-- ══ PROCESS ══ -->
    <div id="process-scroll-container">
        <div id="process-sticky">
            <section id="process">
                <p class="section-label">// 02 — Comment ça marche</p>
                <h2 class="section-title">Notre <span>Processus</span></h2>
                <p class="section-sub">De la prise de contact au live en direct, chaque étape est maîtrisée.</p>

                <div class="process-timeline">
                    <div class="ptl-track">
                        <div class="ptl-line-bg"></div>
                        <div class="ptl-line-fill" id="ptlFill"></div>
                        <div class="ptl-dot" id="ptlDot"></div>
                    </div>
                    <div class="ptl-steps">
                        <div class="ptl-step" data-step="0">
                            <div class="ptl-step-marker">
                                <div class="ptl-step-num">01</div>
                            </div>
                            <div class="ptl-step-label">Consultation</div>
                        </div>
                        <div class="ptl-step" data-step="1">
                            <div class="ptl-step-marker">
                                <div class="ptl-step-num">02</div>
                            </div>
                            <div class="ptl-step-label">Planification</div>
                        </div>
                        <div class="ptl-step" data-step="2">
                            <div class="ptl-step-marker">
                                <div class="ptl-step-num">03</div>
                            </div>
                            <div class="ptl-step-label">Installation</div>
                        </div>
                        <div class="ptl-step" data-step="3">
                            <div class="ptl-step-marker">
                                <div class="ptl-step-num">04</div>
                            </div>
                            <div class="ptl-step-label">Diffusion</div>
                        </div>
                    </div>
                </div>

                <div class="ptl-card" id="ptlCard">
                    <div class="ptl-card-inner">
                        <div class="ptl-card-num" id="ptlCardNum">01</div>
                        <div class="ptl-card-content">
                            <h3 class="ptl-card-title" id="ptlCardTitle">Consultation</h3>
                            <p class="ptl-card-desc" id="ptlCardDesc"></p>
                            <ul class="ptl-card-details" id="ptlCardDetails"></ul>
                        </div>
                    </div>
                </div>

                <!-- ── VERSION MOBILE : cartes empilées ── -->
                <div class="ptl-steps-mobile">
                    <div class="ptl-mobile-card">
                        <div class="ptl-mobile-card-header">
                            <div class="ptl-mobile-num">01</div>
                            <div class="ptl-mobile-title">Consultation</div>
                        </div>
                        <p class="ptl-mobile-desc">On prend le temps de comprendre votre projet, vos besoins techniques
                            et vos objectifs de diffusion.</p>
                        <ul class="ptl-mobile-details">
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg></span><span class="ptl-box-text"><strong>Analyse du
                                        lieu</strong><em>Contraintes techniques & acoustiques</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
                                        <line x1="12" y1="18" x2="12.01" y2="18" />
                                    </svg></span><span class="ptl-box-text"><strong>Choix des
                                        plateformes</strong><em>YouTube, TikTok, Facebook, Zoom…</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                        <circle cx="12" cy="13" r="3" />
                                    </svg></span><span class="ptl-box-text"><strong>Évaluation du
                                        matériel</strong><em>Inventaire & recommandations</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    </svg></span><span class="ptl-box-text"><strong>Budget &
                                        calendrier</strong><em>Estimation transparente</em></span></li>
                        </ul>
                    </div>
                    <div class="ptl-mobile-card">
                        <div class="ptl-mobile-card-header">
                            <div class="ptl-mobile-num">02</div>
                            <div class="ptl-mobile-title">Planification</div>
                        </div>
                        <p class="ptl-mobile-desc">On prépare chaque détail avant le jour J — devis précis, plan de
                            câblage et configuration OBS.</p>
                        <ul class="ptl-mobile-details">
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg></span><span class="ptl-box-text"><strong>Devis
                                        détaillé</strong><em>Transparent, sans surprise</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21" />
                                        <line x1="9" y1="3" x2="9" y2="18" />
                                        <line x1="15" y1="6" x2="15" y2="21" />
                                    </svg></span><span class="ptl-box-text"><strong>Schéma technique</strong><em>Plan de
                                        câblage & disposition</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3" />
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                                    </svg></span><span class="ptl-box-text"><strong>Config OBS à
                                        distance</strong><em>Scènes & encodage pré-paramétrés</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg></span><span class="ptl-box-text"><strong>Planning
                                        d'installation</strong><em>Horaires & coordination logistique</em></span></li>
                        </ul>
                    </div>
                    <div class="ptl-mobile-card">
                        <div class="ptl-mobile-card-header">
                            <div class="ptl-mobile-num">03</div>
                            <div class="ptl-mobile-title">Installation</div>
                        </div>
                        <p class="ptl-mobile-desc">Déploiement complet sur site — caméras, son, encodage, réseau. Tout
                            est testé avant que le live commence.</p>
                        <ul class="ptl-mobile-details">
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="23 7 16 12 23 17 23 7" />
                                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                                    </svg></span><span class="ptl-box-text"><strong>Caméras &
                                        câblage</strong><em>Installation et positionnement</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
                                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07" />
                                    </svg></span><span class="ptl-box-text"><strong>Audio
                                        multi-piste</strong><em>Micros, mixage & monitoring</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M1.42 9a16 16 0 0 1 21.16 0" />
                                        <path d="M5 12.55a11 11 0 0 1 14.08 0" />
                                        <path d="M10.54 16.1a6 6 0 0 1 2.92 0" />
                                        <line x1="12" y1="20" x2="12.01" y2="20" />
                                    </svg></span><span class="ptl-box-text"><strong>Réseau & bande
                                        passante</strong><em>Tests de débit & stabilité</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="4" y1="21" x2="4" y2="14" />
                                        <line x1="4" y1="10" x2="4" y2="3" />
                                        <line x1="12" y1="21" x2="12" y2="12" />
                                        <line x1="12" y1="8" x2="12" y2="3" />
                                        <line x1="20" y1="21" x2="20" y2="16" />
                                        <line x1="20" y1="12" x2="20" y2="3" />
                                        <line x1="1" y1="14" x2="7" y2="14" />
                                        <line x1="9" y1="8" x2="15" y2="8" />
                                        <line x1="17" y1="16" x2="23" y2="16" />
                                    </svg></span><span class="ptl-box-text"><strong>Calibration A/V</strong><em>Couleur,
                                        exposition & son</em></span></li>
                        </ul>
                    </div>
                    <div class="ptl-mobile-card">
                        <div class="ptl-mobile-card-header">
                            <div class="ptl-mobile-num">04</div>
                            <div class="ptl-mobile-title">Diffusion</div>
                        </div>
                        <p class="ptl-mobile-desc">On gère la régie en temps réel — transitions, alertes, qualité du
                            stream. Vous n'avez qu'à performer.</p>
                        <ul class="ptl-mobile-details">
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                        <line x1="8" y1="21" x2="16" y2="21" />
                                        <line x1="12" y1="17" x2="12" y2="21" />
                                    </svg></span><span class="ptl-box-text"><strong>Régie live</strong><em>Caméras,
                                        scènes & transitions</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="18" y1="20" x2="18" y2="10" />
                                        <line x1="12" y1="20" x2="12" y2="4" />
                                        <line x1="6" y1="20" x2="6" y2="14" />
                                    </svg></span><span class="ptl-box-text"><strong>Monitoring
                                        stream</strong><em>Qualité & stabilité en continu</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg></span><span class="ptl-box-text"><strong>Gestion des
                                        incidents</strong><em>Réaction immédiate si problème</em></span></li>
                            <li><span class="ptl-box-icon"><svg class="ptl-svg-icon" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                                    </svg></span><span class="ptl-box-text"><strong>Rapport
                                        post-événement</strong><em>Stats, retours & recommandations</em></span></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- ══ PLATEFORMES ══ -->
    <section id="platforms">
        <p class="section-label reveal">// 03 — Où vous diffuser</p>
        <h2 class="section-title reveal">Plateformes <span>Supportées</span></h2>
        <p class="section-sub reveal">Diffusion simultanée sur toutes les plateformes de streaming sans compromis de
            qualité.</p>

        <div class="platforms-slider-wrap">
            <div class="platforms-slider-track">
                <!-- Duplicate set for seamless loop -->
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2020/06/YouTube-Logo.png" alt="YouTube"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/TikTok_logo.svg" alt="TikTok"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png"
                        alt="Facebook" loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2021/03/Zoom-Logo.png" alt="Zoom"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2020/11/Twitch-Logo.png" alt="Twitch"
                        loading="lazy">
                </div>
                <!-- Duplicates for seamless loop -->
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2020/06/YouTube-Logo.png" alt="YouTube"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/TikTok_logo.svg" alt="TikTok"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png"
                        alt="Facebook" loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2021/03/Zoom-Logo.png" alt="Zoom"
                        loading="lazy">
                </div>
                <div class="pslide-item">
                    <img src="https://logos-world.net/wp-content/uploads/2020/11/Twitch-Logo.png" alt="Twitch"
                        loading="lazy">
                </div>
            </div>
        </div>

        <div class="obs-block reveal">
            <p class="section-label">Technologie utilisée</p>
            <h3>OBS Studio — Configuration Pro</h3>
            <p>
                Chaque setup est configuré avec OBS Studio dans sa version optimisée pour votre matériel.
                Scènes personnalisées, overlays brandés, encodage matériel (NVENC/QuickSync),
                et routage audio multi-piste pour une qualité broadcast sans compromis.
            </p>
        </div>
    </section>

    <!-- ══ ÉQUIPE ══ -->
    <section id="equipe">
        <p class="section-label reveal">// 04 — Qui sommes-nous</p>
        <h2 class="section-title reveal">Notre <span>Équipe</span></h2>
        <p class="section-sub reveal">Des passionnés de technologie audiovisuelle au service de vos événements.</p>

        <div class="team-new-grid">

            <div class="team-new-card reveal">
                <div class="team-new-photo">
                    <img src="<?= SITE_URL ?>/assets/img/thibauthozanne.png" alt="Thibaut Hozanne" loading="lazy">
                    <div class="team-new-overlay">
                        <div class="team-new-tags">
                            <span>OBS Studio</span>
                            <span>Direction artistique</span>
                            <span>Stratégie live</span>
                        </div>
                    </div>
                </div>
                <div class="team-new-info">
                    <div class="team-new-role-badge">Fondateur - Directeur</div>
                    <h3 class="team-new-name">Thibaut Hozanne</h3>
                    <p class="team-new-role">Directeur Technique</p>
                    <p class="team-new-bio">Expert en webdiffusion et intégration audiovisuelle.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ══ DEVIS CTA ══ -->
    <section id="devis">
        <p class="section-label reveal">// 05 — Estimez votre projet</p>
        <h2 class="section-title reveal">Votre <span>Devis</span> en 24h</h2>
        <p class="section-sub reveal">Chaque projet est unique. Contactez-nous et nous préparons une offre sur mesure,
            transparente et sans engagement.</p>

        <div class="devis-cta-block reveal">
            <div class="devis-cta-features">
                <div class="devis-cta-feature">
                    <span class="dcf-icon"><svg class="dcf-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                        </svg></span>
                    <div>
                        <strong>Réponse en 24h</strong>
                        <p>Nous reviendrons vers vous rapidement avec une estimation claire</p>
                    </div>
                </div>
                <div class="devis-cta-feature">
                    <span class="dcf-icon"><svg class="dcf-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="12" r="6" />
                            <circle cx="12" cy="12" r="2" />
                        </svg></span>
                    <div>
                        <strong>100% personnalisé</strong>
                        <p>Aucun forfait générique — chaque devis est adapté à votre projet</p>
                    </div>
                </div>
                <div class="devis-cta-feature">
                    <span class="dcf-icon"><svg class="dcf-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 9.9-1" />
                        </svg></span>
                    <div>
                        <strong>Sans engagement</strong>
                        <p>Obtenez une estimation gratuite, sans obligation de votre part</p>
                    </div>
                </div>
            </div>
            <a href="#rdv" class="devis-cta-btn">Demander mon devis gratuit →</a>
        </div>
    </section>

    <!-- ══ DISCORD ══ -->
    <section id="discord">
        <p class="section-label reveal">// 05b — Rejoignez la communauté</p>
        <h2 class="section-title reveal">Notre <span>Discord</span></h2>
        <p class="section-sub reveal">Rejoignez notre serveur pour suivre nos projets, poser vos questions et échanger
            avec l'équipe.</p>

        <div class="discord-block reveal">

            <!-- Widget custom (sans bots) -->
            <div class="discord-widget" id="discord-widget">
                <div class="dw-header">
                    <svg class="dw-logo" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z" />
                    </svg>
                    <div class="dw-header-text">
                        <span class="dw-server-name" id="dw-name">SannaStudio</span>
                        <span class="dw-online-count">
                            <span class="dw-dot"></span>
                            <span id="dw-count-num">…</span> en ligne
                        </span>
                    </div>
                </div>
                <div class="dw-members" id="dw-members">
                    <div class="dw-loading">
                        <div class="dw-spinner"></div>
                        <span>Chargement des membres…</span>
                    </div>
                </div>
                <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener" class="dw-invite-btn">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z" />
                    </svg>
                    Rejoindre le serveur
                </a>
            </div>

            <div class="discord-info">
                <div class="discord-logo-row">
                    <svg class="discord-svg-logo" viewBox="0 0 24 24" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z" />
                    </svg>
                    <div>
                        <p class="discord-server-label">SERVEUR OFFICIEL</p>
                        <h3 class="discord-server-name">SannaStudio</h3>
                    </div>
                </div>

                <p class="discord-desc">Accède aux annonces exclusives, aux coulisses de nos productions et bénéficie
                    d'un support direct de l'équipe technique.</p>

                <ul class="discord-feat-list">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <div><strong>Annonces & actualités</strong><span>Suivez nos dernières nouvelles en
                                avant-première</span></div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18" />
                            <line x1="7" y1="2" x2="7" y2="22" />
                            <line x1="17" y1="2" x2="17" y2="22" />
                            <line x1="2" y1="12" x2="22" y2="12" />
                            <line x1="2" y1="7" x2="7" y2="7" />
                            <line x1="2" y1="17" x2="7" y2="17" />
                            <line x1="17" y1="17" x2="22" y2="17" />
                            <line x1="17" y1="7" x2="22" y2="7" />
                        </svg>
                        <div><strong>Coulisses des productions</strong><span>Voyez nos setups et making-of en
                                exclusivité</span></div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                            <path d="M15.54 8.46a5 5 0 0 1 0 7.07M8.46 8.46a5 5 0 0 0 0 7.07" />
                        </svg>
                        <div><strong>Support technique direct</strong><span>Posez vos questions à l'équipe en temps
                                réel</span></div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        <div><strong>Échanges avec l'équipe</strong><span>Discussion ouverte, retours et conseils
                                pros</span></div>
                    </li>
                </ul>

                <a href="https://discord.gg/dadV5eSS4b" target="_blank" rel="noopener" class="discord-join-btn">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.03.054a19.9 19.9 0 0 0 5.993 3.03.077.077 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z" />
                    </svg>
                    Rejoindre le serveur
                </a>
            </div>

        </div>
    </section>

    <script>
        (async function () {
            const BOT_KEYWORDS = ['bot', 'music', 'carl', 'mee6', 'dyno', 'rythm', 'groovy', 'hydra', 'chip', 'pancake', 'fredboat', 'octave', 'vexera', 'dank memer', 'mudae', 'statbot', 'giveawaybot', 'streamcord', 'craig', 'carbon', 'clyde'];

            function isBot(m) {
                if (m.bot === true) return true;
                const name = (m.username || '').toLowerCase();
                return BOT_KEYWORDS.some(k => name.includes(k));
            }

            function statusColor(s) {
                return { online: '#23a55a', idle: '#f0b232', dnd: '#f23f43' }[s] || '#80848e';
            }

            function statusLabel(s) {
                return { online: 'En ligne', idle: 'Absent', dnd: 'Ne pas déranger' }[s] || 'Hors ligne';
            }

            try {
                const res = await fetch('https://discord.com/api/guilds/1390432827224358932/widget.json');
                const data = await res.json();
                const members = (data.members || []).filter(m => !isBot(m));
                const order = { online: 0, idle: 1, dnd: 2, offline: 3 };
                members.sort((a, b) => (order[a.status] ?? 3) - (order[b.status] ?? 3));

                document.getElementById('dw-name').textContent = data.name || 'SannaStudio';
                document.getElementById('dw-count-num').textContent = members.length;

                const container = document.getElementById('dw-members');
                if (!members.length) {
                    container.innerHTML = '<p class="dw-empty">Aucun membre en ligne pour le moment.</p>';
                    return;
                }

                container.innerHTML = members.map(m => `
          <div class="dw-member">
            <div class="dw-avatar-wrap">
              ${m.avatar_url
                        ? `<img src="${m.avatar_url}" alt="${m.username}">`
                        : `<span class="dw-avatar-fallback">${(m.username || '?')[0].toUpperCase()}</span>`
                    }
              <span class="dw-status-dot" style="background:${statusColor(m.status)}" title="${statusLabel(m.status)}"></span>
            </div>
            <div class="dw-member-info">
              <span class="dw-member-name">${m.username || 'Membre'}</span>
              <span class="dw-member-status">${m.game ? m.game.name : statusLabel(m.status)}</span>
            </div>
          </div>
        `).join('');
            } catch (e) {
                document.getElementById('dw-members').innerHTML = '<p class="dw-empty">Widget temporairement indisponible.</p>';
                document.getElementById('dw-count-num').textContent = '—';
            }
        })();
    </script>

    <!-- ══ PRISE DE RDV ══ -->
    <section id="rdv">
        <p class="section-label reveal">// 06 — On se parle</p>
        <h2 class="section-title reveal">Prendre un <span>Rendez-vous</span></h2>

        <div class="rdv-container">
            <div class="rdv-info reveal">
                <h3>Parlez-nous de votre projet</h3>
                <p>
                    Chaque événement est unique. Remplissez le formulaire et notre équipe vous contactera
                    sous 24h pour discuter de votre projet en détail et préparer une offre sur mesure.
                </p>

                <div class="contact-item">
                    <span class="contact-icon"><svg class="contact-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg></span>
                    <span><a href="/cdn-cgi/l/email-protection#6b0804051f0a081f2b18181b450e05450c1b"><span class="__cf_email__" data-cfemail="adcec2c3d9ccced9eddededd83c8c383cadd">[email&#160;protected]</span></a></span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><svg class="contact-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.59 1.87h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17z" />
                        </svg></span>
                    <span>+1 (367) 382-5551</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><svg class="contact-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg></span>
                    <span>Québec, Canada — Déplacement partout</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><svg class="contact-svg-icon" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg></span>
                    <span>Disponible 7j/7 selon disponibilité</span>
                </div>

                <div class="rdv-promise">
                    <p class="section-label">NOTRE PROMESSE</p>
                    <p>
                        Nous répondons à toutes les demandes sous 24h ouvrables.
                        Chaque devis est personnalisé et sans engagement.
                    </p>
                </div>
            </div>

            <form id="rdv-form" class="reveal" novalidate action="<?= SITE_URL ?>/rdv" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom complet *</label>
                        <input type="text" id="nom" name="nom" placeholder="Jean Dupont" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="jean@exemple.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="service">Type de service *</label>
                    <select id="service" name="service" required>
                        <option value="" disabled selected>Choisissez un service…</option>
                        <option value="webdiffusion_evenement">Webdiffusion événementielle</option>
                        <option value="installation_permanente">Installation permanente</option>
                        <option value="formation">Formation & support technique</option>
                        <option value="package_complet">Package complet (événement + installation)</option>
                        <option value="maintenance">Contrat de maintenance</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date souhaitée *</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="duree">Durée estimée</label>
                        <select id="duree" name="duree">
                            <option value="">Non précisée</option>
                            <option value="2h">2 heures</option>
                            <option value="demi-journee">Demi-journée</option>
                            <option value="journee">Journée complète</option>
                            <option value="multi-jours">Plusieurs jours</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Plateformes de diffusion</label>
                    <div class="platform-checkboxes">
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"
                                value="YouTube"><span>YouTube</span></label>
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"
                                value="TikTok"><span>TikTok</span></label>
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"
                                value="Facebook"><span>f Facebook</span></label>
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"
                                value="Zoom"><span>Z Zoom</span></label>
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"
                                value="Twitch"><span>Twitch</span></label>
                        <label class="platform-checkbox"><input type="checkbox" name="plateformes[]"><span>Autre
                            </span></label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">Détails du projet *</label>
                    <textarea id="message" name="message"
                        placeholder="Décrivez votre événement, le lieu, le nombre de caméras souhaité, vos besoins spécifiques…"
                        required></textarea>
                </div>

                <button type="submit" class="form-submit">Envoyer la demande →</button>
                <div class="form-msg" id="rdv-msg"></div>
            </form>
        </div>
    </section>

