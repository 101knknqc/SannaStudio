<?php
class ControllerRdv extends Controller {
    public function __construct(array $url) {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success'=>false,'error'=>'Méthode non autorisée']); exit;
        }
        foreach (['nom','email','service','date','message'] as $f) {
            if (empty($_POST[$f])) {
                echo json_encode(['success'=>false,'error'=>"Le champ '$f' est requis."]); exit;
            }
        }
        $nom      = htmlspecialchars(trim($_POST['nom']));
        $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone    = htmlspecialchars(trim($_POST['telephone']));
        $service  = htmlspecialchars(trim($_POST['service']));
        $date     = htmlspecialchars(trim($_POST['date']));
        $duration = htmlspecialchars(trim($_POST['duree'] ?? ''));
        $message  = htmlspecialchars(trim($_POST['message']));
        $plats     = $_POST['plateformes'] ?? [];
        if (is_array($plats)) {
            $platforms = implode(', ', array_map('htmlspecialchars', $plats));
        } else {
            $platforms = htmlspecialchars(trim($plats));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success'=>false,'error'=>'Adresse email invalide.']); exit;
        }

        $am = new AppointmentManager();
        $am->create([
            'user_id'   => Session::isLoggedIn() ? Session::getUserId() : null,
            'full_name' => $nom,
            'email'     => $email,
            'phone'     => $phone,
            'service'   => $service,
            'date'      => $date,
            'duration'  => $duration,
            'platforms' => $platforms,
            'message'   => $message,
        ]);

        Mailer::sendAppointmentConfirm($email, $nom, $service, $date);

        $log = date('Y-m-d H:i:s')." | $nom | $email | $service | $date\n";
        @file_put_contents(__DIR__.'/../rdv_log.txt', $log, FILE_APPEND | LOCK_EX);

        echo json_encode(['success'=>true]); exit;
    }
}
