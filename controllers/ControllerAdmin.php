<?php
class ControllerAdmin extends Controller {
    public function __construct(array $url) {
        $this->requireAdmin(); // Bloque tout non-admin

        $um  = new UserManager();
        $am  = new AppointmentManager();
        $sub = $url[1] ?? 'index';

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