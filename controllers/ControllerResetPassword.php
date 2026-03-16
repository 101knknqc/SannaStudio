<?php
class ControllerResetPassword extends Controller {
    public function __construct(array $url) {
        $token = functions::get('token');
        $errors = [];
        $um   = new UserManager();
        $user = $um->getByResetToken($token);
        if (!$user) { Session::flash('error', 'Lien invalide ou expiré.'); functions::redirect('mot-de-passe-oublie'); }
        if (functions::isPost()) {
            if (!functions::verifyCsrf()) { $errors[] = 'Token invalide.'; }
            else {
                $pass    = functions::post('password');
                $confirm = functions::post('confirm_password');
                if (strlen($pass) < 8) $errors[] = 'Minimum 8 caractères.';
                if ($pass !== $confirm) $errors[] = 'Les mots de passe ne correspondent pas.';
                if (empty($errors)) {
                    $um->updatePassword($user->getId(), $pass);
                    Session::flash('success', 'Mot de passe mis à jour !');
                    functions::redirect('connexion');
                }
            }
        }
        $this->setView('ResetPassword', ['errors'=>$errors,'token'=>$token],
            true, 'Nouveau mot de passe — SannaStudio');
    }
}
