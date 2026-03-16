<?php
class ControllerAppointmentAction extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();
        header('Content-Type: application/json');
        if (!functions::verifyCsrf()) { echo json_encode(['success'=>false,'error'=>'Token invalide']); exit; }

        $id     = (int)($url[1] ?? 0);
        $action = $url[2] ?? '';
        $userId = Session::getUserId();
        $am     = new AppointmentManager();
        $nm     = new NotificationManager();

        // Trouver le RDV
        $appts = $am->getByUser($userId);
        $appt  = null;
        foreach ($appts as $a) { if ($a->getId() === $id) { $appt = $a; break; } }

        if (!$appt) { echo json_encode(['success'=>false,'error'=>'RDV introuvable']); exit; }

        if ($action === 'cancel') {
            if (!in_array($appt->getStatus(), ['new','in_progress'])) {
                echo json_encode(['success'=>false,'error'=>'Ce RDV ne peut plus être annulé']); exit;
            }
            $am->updateStatus($id, 'cancelled');
            $nm->create($userId, 'rdv', 'RDV annulé', 'Votre demande de RDV a été annulée.', SITE_URL.'/dashboard');
            echo json_encode(['success'=>true,'message'=>'RDV annulé']); exit;
        }

        echo json_encode(['success'=>false,'error'=>'Action inconnue']); exit;
    }
}
