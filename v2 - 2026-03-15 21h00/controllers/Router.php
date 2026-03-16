<?php
include_once(__DIR__.'/../defines.php');
require_once(__DIR__.'/../views/View.php');
require_once('Controller.php');

class Router {
    public function routeReq(): void {
        // Autoload models
        spl_autoload_register(function($class) {
            $f = PATH_MODELS.'/'.$class.'.php';
            if (file_exists($f)) require_once $f;
        });

        Session::start();

        try {
            $rawRoute = filter_var($_GET['route'] ?? '', FILTER_SANITIZE_URL);
            $segments = array_values(array_filter(explode('/', trim($rawRoute, '/'))));
            $page     = strtolower($segments[0] ?? 'home');

            // Mapping routes → controllers
            $map = [
                ''               => 'ControllerHome',
                'home'           => 'ControllerHome',
                'inscription'    => 'ControllerInscription',
                'connexion'      => 'ControllerConnexion',
                'deconnexion'    => 'ControllerDeconnexion',
                'dashboard'      => 'ControllerDashboard',
                'verify'         => 'ControllerVerify',
                'rdv'            => 'ControllerRdv',
                'reset-password' => 'ControllerResetPassword',
                'mot-de-passe-oublie' => 'ControllerMotDePasseOublie',
            ];

            $controllerClass = $map[$page] ?? null;

            if (!$controllerClass) throw new Exception("404 — Page introuvable");

            $controllerFile = __DIR__.'/'.$controllerClass.'.php';
            if (!file_exists($controllerFile)) throw new Exception("404 — Contrôleur manquant");

            require_once($controllerFile);
            new $controllerClass($segments);

        } catch (Exception $e) {
            http_response_code(404);
            $view = new View('Error');
            $view->generate(['errorMsg' => $e->getMessage(), 'title' => 'Erreur — SannaStudio']);
        }
    }
}
