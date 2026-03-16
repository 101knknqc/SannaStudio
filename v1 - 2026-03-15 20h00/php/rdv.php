<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

// ── Validation ──
$required = ['nom', 'email', 'telephone', 'service', 'date', 'message'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'error' => "Le champ '$field' est requis."]);
        exit;
    }
}

$nom         = htmlspecialchars(trim($_POST['nom']));
$email       = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$telephone   = htmlspecialchars(trim($_POST['telephone']));
$service     = htmlspecialchars(trim($_POST['service']));
$date        = htmlspecialchars(trim($_POST['date']));
$duree       = htmlspecialchars(trim($_POST['duree']       ?? 'Non précisée'));
$plateformes = htmlspecialchars(trim($_POST['plateformes'] ?? 'Non précisées'));
$message     = htmlspecialchars(trim($_POST['message']));

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Adresse email invalide.']);
    exit;
}

$headers_base  = "From: no-reply@ssp.en.gp\r\n";
$headers_base .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers_base .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ── 1) Email équipe — tous les détails ──
$to_team      = 'contact@ssp.en.gp';
$subject_team = "Nouvelle demande de RDV - SannaStudio - $nom";
$body_team    = "Nouvelle demande de rendez-vous via le site SannaStudio\n"
              . str_repeat('=', 50) . "\n\n"
              . "NOM        : $nom\n"
              . "EMAIL      : $email\n"
              . "TELEPHONE  : $telephone\n"
              . "SERVICE    : $service\n"
              . "DATE       : $date\n"
              . "DUREE      : $duree\n"
              . "PLATEFORMES: $plateformes\n\n"
              . "DETAILS :\n$message\n";

$headers_team  = $headers_base;
$headers_team .= "Reply-To: $email\r\n";

$sent_team = mail($to_team, $subject_team, $body_team, $headers_team);

// ── 2) Email client — confirmation simple ──
$subject_client = "Nous avons bien reçu votre demande — SannaStudio";
$body_client    = "Bonjour $nom,\n\n"
                . "Votre demande de rendez-vous a bien été transmise à notre équipe.\n\n"
                . "Nous reviendrons vers vous dans les 24 heures pour discuter\n"
                . "de votre projet et préparer une offre sur mesure.\n\n"
                . "À très bientôt,\n"
                . "L'équipe SannaStudio\n\n"
                . str_repeat('-', 40) . "\n"
                . "SannaStudio — Webdiffusion & Intégration Audiovisuelle\n"
                . "contact@ssp.en.gp | sannastudio.ca\n";

$headers_client  = $headers_base;
$headers_client .= "Reply-To: contact@ssp.en.gp\r\n";

mail($email, $subject_client, $body_client, $headers_client);

// ── Sauvegarde locale (backup log) ──
$log = date('Y-m-d H:i:s') . " | $nom | $email | $service | $date\n";
file_put_contents(__DIR__ . '/rdv_log.txt', $log, FILE_APPEND | LOCK_EX);

if ($sent_team) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => true, 'note' => 'Sauvegarde locale effectuee.']);
}