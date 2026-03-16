<?php
include_once(__DIR__.'/../defines.php');
require_once(__DIR__.'/../views/View.php');
require_once('Controller.php');

class Router {
    public function routeReq(): void {
        spl_autoload_register(function($class) {
            $f = PATH_MODELS.'/'.$class.'.php';
            if (file_exists($f)) require_once $f;
        });

        Session::start();
        Lang::init();

        try {
            $rawRoute = filter_var($_GET['route'] ?? '', FILTER_SANITIZE_URL);
            $segments = array_values(array_filter(explode('/', trim($rawRoute, '/'))));
            $page     = strtolower($segments[0] ?? 'home');

            $map = [
                ''                      => 'ControllerHome',
                'home'                  => 'ControllerHome',
                'admin'                 => 'ControllerAdmin',
                'inscription'           => 'ControllerInscription',
                'connexion'             => 'ControllerConnexion',
                'deconnexion'           => 'ControllerDeconnexion',
                'dashboard'             => 'ControllerDashboard',
                'verify'                => 'ControllerVerify',
                'rdv'                   => 'ControllerRdv',
                'reset-password'        => 'ControllerResetPassword',
                'mot-de-passe-oublie'   => 'ControllerMotDePasseOublie',
                // Nouvelles routes v4
                'messages'              => 'ControllerMessages',
                'notifications'         => 'ControllerNotifications',
                'invoices'              => 'ControllerInvoices',
                'blog'                  => 'ControllerBlog',
                'portfolio'             => 'ControllerPortfolio',
                'tarifs'                => 'ControllerTarifs',
                'cgu'                   => 'ControllerCgu',
                'politique'             => 'ControllerPolitique',
                'appointment-action'    => 'ControllerAppointmentAction',
            ];

            $controllerClass = $map[$page] ?? null;
            if (!$controllerClass) throw new Exception("404 — Page introuvable");

            $controllerFile = __DIR__.'/'.$controllerClass.'.php';
            if (!file_exists($controllerFile)) throw new Exception("404 — Contrôleur manquant : $controllerClass");

            require_once($controllerFile);
            new $controllerClass($segments);

        } catch (Exception $e) {
            http_response_code(404);
            $view = new View('Error');
            $view->generate(['errorMsg' => $e->getMessage(), 'title' => 'Erreur — SannaStudio']);
        }
    }
}
