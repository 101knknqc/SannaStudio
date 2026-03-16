<?php
class ControllerRdv extends Controller {
    public function __construct(array $url) {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
            exit;
        }

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
        $duree       = htmlspecialchars(trim($_POST['duree'] ?? 'Non précisée'));
        $message     = htmlspecialchars(trim($_POST['message']));

        $plats = $_POST['plateformes'] ?? [];
        $plateformes = is_array($plats) ? implode(', ', array_map('htmlspecialchars', $plats)) : htmlspecialchars($plats);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Adresse email invalide.']);
            exit;
        }

        // Sauvegarde en BDD
        $rdvM = new RdvManager();
        $rdvM->create([
            'client_id'  => Session::isLoggedIn() ? Session::getClientId() : null,
            'nom'        => $nom,
            'email'      => $email,
            'telephone'  => $telephone,
            'service'    => $service,
            'date'       => $date,
            'duree'      => $duree,
            'plateformes'=> $plateformes,
            'message'    => $message,
        ]);

        // Email équipe
        $toTeam    = CONTACT_EMAIL;
        $subjTeam  = "Nouvelle demande RDV — SannaStudio — $nom";
        $bodyTeam  = "Nouvelle demande de rendez-vous\n".str_repeat('=',50)."\n\n"
                   . "NOM        : $nom\nEMAIL      : $email\nTELEPHONE  : $telephone\n"
                   . "SERVICE    : $service\nDATE       : $date\nDURÉE      : $duree\n"
                   . "PLATEFORMES: $plateformes\n\nDÉTAILS:\n$message\n";

        $hdrs  = "From: no-reply@ssp.en.gp\r\nReply-To: $email\r\n";
        $hdrs .= "Content-Type: text/plain; charset=UTF-8\r\n";
        mail($toTeam, $subjTeam, $bodyTeam, $hdrs);

        // Email client (HTML via SMTP)
        Mailer::sendRdvConfirm($email, $nom, $service, $date);

        // Log backup
        $log = date('Y-m-d H:i:s')." | $nom | $email | $service | $date\n";
        @file_put_contents(__DIR__.'/../rdv_log.txt', $log, FILE_APPEND | LOCK_EX);

        echo json_encode(['success' => true]);
        exit;
    }
}
