<?php
class ControllerConnexion extends Controller {
    public function __construct(array $url) {
        $this->redirectIfLogged();

        $errors = [];
        $old    = [];

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Token de sécurité invalide.';
            } else {
                $email    = functions::post('email');
                $password = functions::post('password');
                $old      = ['email' => $email];

                if (empty($email) || empty($password)) {
                    $errors[] = 'Email et mot de passe requis.';
                } else {
                    $cm     = new ClientManager();
                    $client = $cm->getByEmail($email);

                    if (!$client || !password_verify($password, $client->getPasswordHash())) {
                        $errors[] = 'Email ou mot de passe incorrect.';
                    } elseif (!$client->isEmailVerified()) {
                        $errors[] = 'Veuillez confirmer votre adresse email avant de vous connecter.';
                    } else {
                        Session::loginClient($client);
                        Session::flash('success', 'Bon retour, '.$client->getPrenom().' !');
                        functions::redirect('dashboard');
                    }
                }
            }
        }

        $this->setView('Connexion', [
            'errors' => $errors,
            'old'    => $old,
            'flash'  => Session::getFlash(),
        ], true, 'Connexion — SannaStudio');
    }
}
