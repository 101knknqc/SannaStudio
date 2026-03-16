<?php
class ControllerInscription extends Controller {
    public function __construct(array $url) {
        $this->redirectIfLogged();
        $errors = []; $old = [];

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Invalid security token. Please try again.';
            } else {
                $first   = functions::post('first_name');
                $last    = functions::post('last_name');
                $email   = functions::post('email');
                $phone   = functions::post('phone');
                $pass    = functions::post('password');
                $confirm = functions::post('confirm_password');
                $tos     = isset($_POST['accepted_tos']);
                $priv    = isset($_POST['accepted_privacy']);
                $old = compact('first', 'last', 'email', 'phone');

                if (empty($first))  $errors[] = 'Le prénom est requis.';
                if (empty($last))   $errors[] = 'Le nom est requis.';
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
                if (strlen($pass) < 8) $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
                if ($pass !== $confirm) $errors[] = 'Les mots de passe ne correspondent pas.';
                if (!$tos)  $errors[] = 'Vous devez accepter les CGU.';
                if (!$priv) $errors[] = 'Vous devez accepter la politique de confidentialité.';

                if (empty($errors)) {
                    $um = new UserManager();
                    if ($um->getByEmail($email)) {
                        $errors[] = 'Cette adresse email est déjà utilisée.';
                    } else {
                        $id = $um->create([
                            'first_name' => $first,
                            'last_name'  => $last,
                            'email'      => $email,
                            'phone'      => $phone ?: null,
                            'password'   => $pass,
                        ]);
                        if ($id) {
                            $token = $um->getEmailToken($id);
                            $user  = $um->getById($id);
                            Mailer::sendWelcome($user, $token);
                            Session::flash('success', 'Compte créé ! Consultez votre email pour confirmer votre adresse.');
                            functions::redirect('connexion');
                        } else {
                            $errors[] = 'Une erreur est survenue. Veuillez réessayer.';
                        }
                    }
                }
            }
        }

        $this->setView('Inscription', ['errors' => $errors, 'old' => $old],
            true, 'Créer un compte — SannaStudio');
    }
}
