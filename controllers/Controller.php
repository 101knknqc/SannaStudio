<?php
require_once(__DIR__.'/../views/View.php');
class Controller {
    protected function setView(string $name, array $data=[], bool $tpl=true, ?string $title=null, string $folder='landing'): void {
        $view = new View($name, $folder);
        echo $view->prepare($data, $tpl, $title);
        exit;
    }

    // Redirige vers la bonne page si déjà connecté
    protected function redirectIfLogged(): void {
        if (Session::isLoggedIn()) {
            functions::redirect(Session::isAdmin() ? 'admin' : 'dashboard');
        }
    }

    // Vérifie que l'utilisateur est connecté ET est un client (pas admin)
    protected function requireAuth(): void {
        if (!Session::isLoggedIn()) {
            Session::flash('warning', 'Vous devez être connecté pour accéder à cette page.');
            functions::redirect('connexion');
        }
        // Admin n'a pas accès au dashboard client
        if (Session::isAdmin()) {
            functions::redirect('admin');
        }
    }

    // Vérifie que l'utilisateur est connecté ET est admin
    protected function requireAdmin(): void {
        if (!Session::isLoggedIn()) {
            Session::flash('warning', 'Accès réservé.');
            functions::redirect('connexion');
        }
        if (!Session::isAdmin()) {
            Session::flash('error', 'Accès refusé — droits insuffisants.');
            functions::redirect('dashboard');
        }
    }
}