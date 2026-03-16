<?php
class ControllerMotDePasseOublie extends Controller {
    public function __construct(array $url) {
        $errors  = [];
        $success = false;

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Token de sécurité invalide.';
            } else {
                $email  = functions::post('email');
                $cm     = new ClientManager();
                $client = $cm->getByEmail($email);

                // On répond toujours pareil pour éviter l'énumération
                if ($client) {
                    $token = bin2hex(random_bytes(32));
                    $cm->setResetToken($client->getId(), $token);
                    Mailer::sendResetPassword($client, $token);
                }

                $success = true;
            }
        }

        $this->setView('MotDePasseOublie', [
            'errors'  => $errors,
            'success' => $success,
            'flash'   => Session::getFlash(),
        ], true, 'Mot de passe oublié — SannaStudio');
    }
}
