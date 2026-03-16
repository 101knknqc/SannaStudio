<?php
class ControllerAdmin extends Controller {
    public function __construct(array $url) {
        $this->requireAdmin(); // Bloque tout non-admin

        $um  = new UserManager();
        $am  = new AppointmentManager();
        $sub = $url[1] ?? 'index';

        // Action AJAX : changer statut RDV (admin)
        if ($sub === 'update-appt-status' && functions::isPost()) {
            header('Content-Type: application/json');
            if (!functions::verifyCsrf()) { echo json_encode(['success'=>false]); exit; }
            $id     = (int)functions::post('id');
            $status = trim(functions::post('status'));
            $allowed = ['new','in_progress','completed','cancelled'];
            if (!in_array($status, $allowed)) { echo json_encode(['success'=>false,'error'=>'Statut invalide']); exit; }
            $am->updateStatus($id, $status);
            // Notifier le client
            $appts = $am->getRecent(200);
            foreach ($appts as $a) {
                if ($a->getId() === $id && $a->getUserId()) {
                    $nm = new NotificationManager();
                    $labels = ['new'=>'En attente','in_progress'=>'En cours','completed'=>'Terminé','cancelled'=>'Annulé'];
                    $nm->create($a->getUserId(), 'rdv', 'Statut RDV mis à jour', 'Votre RDV est maintenant : '.$labels[$status], SITE_URL.'/dashboard');
                    break;
                }
            }
            echo json_encode(['success'=>true]); exit;
        }

        switch ($sub) {
            case 'users':
                $this->setView('AdminUsers', [
                    'users' => $um->getAll(),
                    'flash' => Session::getFlash(),
                ], true, 'Clients — Admin SannaStudio', 'admin');
                break;

            case 'appointments':
                $this->setView('AdminAppointments', [
                    'appointments' => $am->getRecent(50),
                    'flash'        => Session::getFlash(),
                ], true, 'Demandes RDV — Admin SannaStudio', 'admin');
                break;

            default:
                $this->setView('AdminIndex', [
                    'total_users'  => $um->countAll(),
                    'total_appts'  => $am->countAll(),
                    'new_appts'    => $am->countNew(),
                    'recent_appts' => $am->getRecent(5),
                    'recent_users' => $um->getRecent(5),
                    'flash'        => Session::getFlash(),
                ], true, 'Dashboard Admin — SannaStudio', 'admin');
        }
    }
}