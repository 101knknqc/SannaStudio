<?php
class ControllerVerify extends Controller {
    public function __construct(array $url) {
        $token = functions::get('token');
        if (empty($token)) {
            Session::flash('error', 'Token manquant.');
            functions::redirect('connexion');
        }

        $um   = new UserManager();
        $user = $um->getByEmailToken($token);

        if (!$user) {
            Session::flash('error', 'Lien invalide ou expiré.');
            functions::redirect('connexion');
        }

        $um->verifyEmail($user->getId());

        // Mail de confirmation d'activation
        Mailer::sendAccountConfirmed($user);

        Session::flash('success', 'Email confirmé ! Bienvenue sur SannaStudio 🎉');
        functions::redirect('connexion');
    }
}