<section style="padding:120px 5% 80px;max-width:900px;margin:0 auto">
    <p class="section-label">// Légal</p>
    <h1 class="section-title">Conditions Générales <span>d'Utilisation</span></h1>
    <p style="color:#666;font-size:13px;margin-bottom:48px">Dernière mise à jour : <?= date('d/m/Y') ?></p>

    <?php
    $sections = [
        ['Objet', 'Les présentes Conditions Générales d\'Utilisation (CGU) régissent l\'utilisation du site sannastudio.ca et des services proposés par SannaStudio, prestataire technique en webdiffusion professionnelle et intégration audiovisuelle au Québec.'],
        ['Accès au service', 'L\'utilisation du site est réservée aux personnes majeures ou autorisées par un représentant légal. SannaStudio se réserve le droit de refuser l\'accès à tout utilisateur ne respectant pas les présentes conditions.'],
        ['Compte utilisateur', 'La création d\'un compte nécessite de fournir des informations exactes et à jour. L\'utilisateur est responsable de la confidentialité de ses identifiants. Tout accès non autorisé doit être signalé immédiatement à contact@sannastudio.ca.'],
        ['Services', 'SannaStudio propose des services de webdiffusion événementielle, d\'installation permanente, de formation OBS Studio et de support technique. Les conditions tarifaires sont précisées dans les devis fournis individuellement.'],
        ['Propriété intellectuelle', 'L\'ensemble du contenu du site (textes, images, logos, code) est la propriété exclusive de SannaStudio. Toute reproduction sans autorisation écrite est interdite.'],
        ['Limitation de responsabilité', 'SannaStudio ne saurait être tenu responsable des interruptions de service liées à des facteurs extérieurs (pannes réseau, cas de force majeure). La responsabilité de SannaStudio est limitée au montant des services facturés.'],
        ['Modification des CGU', 'SannaStudio se réserve le droit de modifier les présentes CGU à tout moment. Les utilisateurs seront informés par email en cas de modification substantielle.'],
        ['Droit applicable', 'Les présentes CGU sont soumises au droit québécois. Tout litige relève de la compétence exclusive des tribunaux de la province de Québec.'],
        ['Contact', 'Pour toute question : contact@sannastudio.ca · +1 (367) 382-5551'],
    ];
    foreach ($sections as $i => [$title, $content]):
    ?>
    <div style="margin-bottom:36px;padding-bottom:36px;border-bottom:1px solid rgba(123,47,190,.15)">
        <h2 style="font-family:'Oswald',sans-serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:12px;text-transform:uppercase;letter-spacing:1px">
            <span style="color:var(--purple);margin-right:8px"><?= $i+1 ?>.</span><?= htmlspecialchars($title) ?>
        </h2>
        <p style="color:#999;font-size:15px;line-height:1.8"><?= htmlspecialchars($content) ?></p>
    </div>
    <?php endforeach; ?>
</section>
