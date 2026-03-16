<section style="padding:120px 5% 80px;max-width:900px;margin:0 auto">
    <p class="section-label">// Légal</p>
    <h1 class="section-title">Politique de <span>Confidentialité</span></h1>
    <p style="color:#666;font-size:13px;margin-bottom:48px">Dernière mise à jour : <?= date('d/m/Y') ?></p>

    <?php
    $sections = [
        ['Données collectées', 'SannaStudio collecte les données suivantes lors de votre inscription ou de l\'utilisation de nos services : nom, prénom, adresse email, numéro de téléphone (facultatif), adresse IP de connexion, historique des demandes de rendez-vous.'],
        ['Finalité du traitement', 'Ces données sont utilisées exclusivement pour : gérer votre compte client, traiter vos demandes de rendez-vous, vous envoyer des communications liées à vos projets, améliorer nos services.'],
        ['Base légale', 'Le traitement est fondé sur l\'exécution du contrat de service, le consentement explicite de l\'utilisateur lors de l\'inscription, et nos intérêts légitimes en matière de gestion de la relation client.'],
        ['Conservation des données', 'Vos données sont conservées pendant la durée de votre relation avec SannaStudio, puis archivées pour 3 ans conformément aux obligations légales québécoises.'],
        ['Partage des données', 'SannaStudio ne vend ni ne loue vos données personnelles à des tiers. Elles peuvent être partagées avec nos prestataires techniques (hébergement, email) dans le cadre strict de l\'exécution des services.'],
        ['Vos droits', 'Conformément à la Loi 25 (Loi modernisant des dispositions législatives en matière de protection des renseignements personnels), vous disposez d\'un droit d\'accès, de rectification, de suppression et de portabilité de vos données. Pour exercer ces droits : contact@sannastudio.ca.'],
        ['Cookies', 'Le site utilise uniquement un cookie de session (nécessaire au fonctionnement) et un cookie de langue. Aucun cookie publicitaire ou de traçage tiers n\'est utilisé.'],
        ['Contact DPO', 'Pour toute question relative à la protection de vos données personnelles, contactez-nous à : contact@sannastudio.ca · +1 (367) 382-5551'],
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
