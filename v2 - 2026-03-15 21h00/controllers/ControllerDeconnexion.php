<?php
class ControllerDeconnexion extends Controller {
    public function __construct(array $url) {
        Session::logoutClient();
        Session::flash('success', 'Vous avez été déconnecté.');
        functions::redirect('connexion');
    }
}
