<?php
class ControllerDashboard extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();

        $cm     = new ClientManager();
        $rdvM   = new RdvManager();
        $client = $cm->getById(Session::getClientId());

        if (!$client) {
            Session::logoutClient();
            functions::redirect('connexion');
        }

        $rdvs = $rdvM->getByClient($client->getId());

        $this->setView('Dashboard', [
            'client' => $client,
            'rdvs'   => $rdvs,
            'flash'  => Session::getFlash(),
        ], true, 'Mon espace — SannaStudio', 'dashboard');
    }
}
