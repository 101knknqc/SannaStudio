<?php
class ControllerInscription extends Controller {
    public function __construct(array $url) {
        $this->redirectIfLogged();

        $errors = [];
        $old    = [];

        if (functions::isPost()) {
            if (!functions::verifyCsrf()) {
                $errors[] = 'Token de sécurité invalide. Veuillez réessayer.';
            } else {
                $prenom    = functions::post('prenom');
                $nom       = functions::post('nom');
                $email     = functions::post('email');
                $telephone = functions::post('telephone');
                $password  = functions::post('password');
                $confirm   = functions::post('confirm_password');
                $cgu       = isset($_POST['accepte_cgu']);
                $politique = isset($_POST['accepte_politique']);

                $old = compact('prenom', 'nom', 'email', 'telephone');

                // Validation
                if (empty($prenom))  $errors[] = 'Le prénom est requis.';
                if (empty($nom))     $errors[] = 'Le nom est requis.';
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
                if (strlen($password) < 8) $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
                if ($password !== $confirm)  $errors[] = 'Les mots de passe ne correspondent pas.';
                if (!$cgu)       $errors[] = 'Vous devez accepter les CGU.';
                if (!$politique) $errors[] = 'Vous devez accepter la politique de confidentialité.';

                if (empty($errors)) {
                    $cm = new ClientManager();

                    if ($cm->getByEmail($email)) {
                        $errors[] = 'Cette adresse email est déjà utilisée.';
                    } else {
                        $id = $cm->create([
                            'prenom'    => $prenom,
                            'nom'       => $nom,
                            'email'     => $email,
                            'telephone' => $telephone ?: null,
                            'password'  => $password,
                        ]);

                        if ($id) {
                            $token  = $cm->getTokenVerifyFor($id);
                            $client = $cm->getById($id);
                            Mailer::sendBienvenue($client, $token);

                            Session::flash('success', 'Compte créé ! Consultez votre email pour confirmer votre adresse.');
                            functions::redirect('connexion');
                        } else {
                            $errors[] = 'Une erreur est survenue. Veuillez réessayer.';
                        }
                    }
                }
            }
        }

        $this->setView('Inscription', [
            'errors' => $errors,
            'old'    => $old,
            'title'  => 'Créer un compte — SannaStudio',
        ], true, 'Créer un compte — SannaStudio');
    }
}
