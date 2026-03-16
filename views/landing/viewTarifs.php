<section id="tarifs" style="padding:120px 5% 80px">
    <p class="section-label reveal">// 06 — Investissement</p>
    <h1 class="section-title reveal">Nos <span>Tarifs</span></h1>
    <p class="section-sub reveal">Des prix transparents, sans surprise. Chaque projet est unique — ces tarifs sont indicatifs, un devis personnalisé vous sera fourni gratuitement.</p>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2px;max-width:1100px;margin:0 auto 80px" class="reveal">
        <?php
        $plans = [
            ['name'=>'Événementiel', 'badge'=>'', 'price'=>'350', 'unit'=>'/demi-journée', 'featured'=>false, 'desc'=>'Diffusion live sur place pour votre événement.', 'items'=>['Déplacement inclus (région de Québec)','Caméras professionnelles','Setup OBS Studio complet','Diffusion multi-plateformes','Supervision en direct','Démontage inclus']],
            ['name'=>'Installation', 'badge'=>'POPULAIRE', 'price'=>'800', 'unit'=>'/installation', 'featured'=>true, 'desc'=>'Studio de diffusion permanent clé en main.', 'items'=>['Audit & planification','Installation matérielle complète','Configuration OBS sur mesure','Formation du personnel (½ journée)','Documentation technique','1 mois de support inclus']],
            ['name'=>'Formation', 'badge'=>'', 'price'=>'250', 'unit'=>'/demi-journée', 'featured'=>false, 'desc'=>'Formation OBS Studio pour votre équipe.', 'items'=>['Formation en présentiel ou visio','Groupe jusqu\'à 8 personnes','Support de cours fourni','Exercices pratiques','Certification de participation','Suivi 30 jours par email']],
        ];
        foreach ($plans as $p):
        $bg = $p['featured'] ? 'background:linear-gradient(160deg,rgba(123,47,190,.18)0%,var(--dark)60%);border:1px solid var(--purple)' : 'background:var(--dark)';
        ?>
        <div style="<?= $bg ?>;padding:48px 36px;position:relative;display:flex;flex-direction:column">
            <?php if ($p['badge']): ?><div style="position:absolute;top:-1px;left:36px;background:var(--purple);color:#fff;font-family:'Space Mono',monospace;font-size:10px;letter-spacing:3px;padding:4px 14px;text-transform:uppercase"><?= $p['badge'] ?></div><?php endif; ?>
            <div style="font-family:'Space Mono',monospace;font-size:10px;color:var(--purple-light);letter-spacing:2px;text-transform:uppercase;margin-bottom:16px"><?= htmlspecialchars($p['desc']) ?></div>
            <div style="font-family:'Oswald',sans-serif;font-size:48px;font-weight:700;color:var(--purple);line-height:1"><?= $p['price'] ?> $<span style="font-size:16px;color:#666;font-weight:400"> CAD</span></div>
            <div style="font-size:13px;color:#666;margin-bottom:8px"><?= $p['unit'] ?></div>
            <div style="font-family:'Oswald',sans-serif;font-size:24px;font-weight:700;color:#fff;margin-bottom:20px;text-transform:uppercase"><?= htmlspecialchars($p['name']) ?></div>
            <ul style="list-style:none;display:flex;flex-direction:column;gap:10px;flex:1;margin-bottom:32px">
                <?php foreach ($p['items'] as $item): ?>
                <li style="display:flex;align-items:flex-start;gap:10px;font-size:14px;color:#ccc">
                    <span style="color:var(--purple-light);font-weight:700;flex-shrink:0">✓</span><?= htmlspecialchars($item) ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="<?= SITE_URL ?>/#rdv" style="display:block;text-align:center;<?= $p['featured'] ? 'background:var(--purple);color:#fff' : 'background:transparent;color:var(--purple-light);border:1px solid var(--border)' ?>;padding:14px 20px;font-family:'Oswald',sans-serif;font-size:14px;letter-spacing:2px;text-transform:uppercase;text-decoration:none;transition:.2s">
                Obtenir un devis →
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Options supplémentaires -->
    <div style="max-width:900px;margin:0 auto" class="reveal">
        <h2 class="section-title" style="margin-bottom:32px">Options <span>supplémentaires</span></h2>
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:2px;background:rgba(123,47,190,.2)">
            <?php
            $opts = [
                ['Prise de vue drone 4K','+ 200 $ / session'],
                ['Déplacement hors région de Québec','Sur devis'],
                ['Encodeur Blackmagic fourni','+ 80 $ / jour'],
                ['Maintenance mensuelle','+ 120 $ / mois'],
                ['Formation supplémentaire','+ 250 $ / ½ journée'],
                ['Support d\'urgence (< 24h)','+ 25 % sur le tarif'],
            ];
            foreach ($opts as [$name, $price]):
            ?>
            <div style="background:var(--dark);padding:20px 28px;display:flex;justify-content:space-between;align-items:center">
                <span style="font-size:14px;color:#ccc"><?= htmlspecialchars($name) ?></span>
                <span style="font-family:'Space Mono',monospace;font-size:13px;color:var(--purple-light)"><?= htmlspecialchars($price) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- CTA -->
    <div style="text-align:center;margin-top:80px" class="reveal">
        <p style="color:#888;margin-bottom:24px;font-size:16px">Tous les tarifs sont indicatifs et en dollars canadiens (CAD), taxes en sus.<br>Un devis personnalisé gratuit vous est remis sous 24h.</p>
        <a href="<?= SITE_URL ?>/#rdv" class="btn-primary">Demander un devis gratuit</a>
    </div>
</section>
