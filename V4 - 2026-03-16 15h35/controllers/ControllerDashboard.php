<?php
class ControllerDashboard extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();
        $um   = new UserManager();
        $am   = new AppointmentManager();
        $user = $um->getById(Session::getUserId());
        if (!$user) { Session::logoutUser(); functions::redirect('connexion'); }
        $appointments = $am->getByUser($user->getId());
        $this->setView('Dashboard', [
            'user'         => $user,
            'appointments' => $appointments,
            'flash'        => Session::getFlash(),
        ], true, 'Mon espace — SannaStudio', 'dashboard');
    }
}
