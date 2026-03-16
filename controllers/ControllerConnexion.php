<?php
class ControllerConnexion extends Controller {
    public function __construct(array $url) {
        $this->redirectIfLogged();
        $errors = []; $old = [];

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Token de sécurité invalide.';
            } else {
                $email = functions::post('email');
                $pass  = functions::post('password');
                $old   = ['email' => $email];

                if (empty($email) || empty($pass)) {
                    $errors[] = 'Email et mot de passe requis.';
                } else {
                    $um   = new UserManager();
                    $user = $um->getByEmail($email);
                    if (!$user || !password_verify($pass, $user->getPasswordHash())) {
                        $errors[] = 'Email ou mot de passe incorrect.';
                    } elseif (!$user->isEmailVerified()) {
                        $errors[] = 'Veuillez confirmer votre adresse email avant de vous connecter.';
                    } else {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
                        $um->recordLogin($user->getId(), $ip);
                        Session::loginUser($user);
                        Session::flash('success', 'Bon retour, '.$user->getFirstName().' !');

                        // Redirection selon le rôle
                        functions::redirect($user->isAdmin() ? 'admin' : 'dashboard');
                    }
                }
            }
        }

        $this->setView('Connexion', [
            'errors' => $errors, 'old' => $old,
            'flash'  => Session::getFlash(),
        ], true, 'Connexion — SannaStudio');
    }
}