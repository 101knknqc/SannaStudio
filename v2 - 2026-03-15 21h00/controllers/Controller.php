<?php
require_once(__DIR__.'/../views/View.php');

class Controller {
    protected function setView(string $viewName, array $data = [], bool $template = true, ?string $title = null, string $folder = 'landing'): void {
        $view = new View($viewName, $folder);
        echo $view->prepare($data, $template, $title);
        exit;
    }

    protected function requireAuth(): void {
        if (!Session::isLoggedIn()) {
            Session::flash('warning', 'Vous devez être connecté pour accéder à cette page.');
            functions::redirect('connexion');
        }
    }

    protected function redirectIfLogged(): void {
        if (Session::isLoggedIn()) {
            functions::redirect('dashboard');
        }
    }
}
