<?php
class ControllerMotDePasseOublie extends Controller {
    public function __construct(array $url) {
        $errors = []; $success = false;
        if (functions::isPost()) {
            if (!functions::verifyCsrf()) { $errors[] = 'Token invalide.'; }
            else {
                $email = functions::post('email');
                $um    = new UserManager();
                $user  = $um->getByEmail($email);
                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $um->setResetToken($user->getId(), $token);
                    Mailer::sendResetPassword($user, $token);
                }
                $success = true;
            }
        }
        $this->setView('MotDePasseOublie', ['errors'=>$errors,'success'=>$success,'flash'=>Session::getFlash()],
            true, 'Mot de passe oublié — SannaStudio');
    }
}
