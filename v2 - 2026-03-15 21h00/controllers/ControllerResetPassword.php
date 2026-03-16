<?php
class ControllerResetPassword extends Controller {
    public function __construct(array $url) {
        $token  = functions::get('token');
        $errors = [];

        $cm     = new ClientManager();
        $client = $cm->getByResetToken($token);

        if (!$client) {
            Session::flash('error', 'Lien invalide ou expiré. Faites une nouvelle demande.');
            functions::redirect('mot-de-passe-oublie');
        }

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Token de sécurité invalide.';
            } else {
                $password = functions::post('password');
                $confirm  = functions::post('confirm_password');

                if (strlen($password) < 8) $errors[] = 'Minimum 8 caractères.';
                if ($password !== $confirm) $errors[] = 'Les mots de passe ne correspondent pas.';

                if (empty($errors)) {
                    $cm->updatePassword($client->getId(), $password);
                    Session::flash('success', 'Mot de passe mis à jour ! Connectez-vous.');
                    functions::redirect('connexion');
                }
            }
        }

        $this->setView('ResetPassword', [
            'errors' => $errors,
            'token'  => $token,
        ], true, 'Nouveau mot de passe — SannaStudio');
    }
}
