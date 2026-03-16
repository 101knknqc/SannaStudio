<?php
class ControllerDeconnexion extends Controller {
    public function __construct(array $url) {
        Session::logoutUser();
        Session::flash('success', 'Vous avez été déconnecté.');
        functions::redirect('connexion');
    }
}
