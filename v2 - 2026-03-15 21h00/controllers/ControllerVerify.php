<?php
class ControllerVerify extends Controller {
    public function __construct(array $url) {
        $token = functions::get('token');

        if (empty($token)) {
            Session::flash('error', 'Token manquant.');
            functions::redirect('connexion');
        }

        $cm     = new ClientManager();
        $client = $cm->getByToken($token);

        if (!$client) {
            Session::flash('error', 'Lien de vérification invalide ou expiré.');
            functions::redirect('connexion');
        }

        $cm->verifyEmail($client->getId());
        Session::flash('success', 'Email confirmé ! Vous pouvez maintenant vous connecter.');
        functions::redirect('connexion');
    }
}
