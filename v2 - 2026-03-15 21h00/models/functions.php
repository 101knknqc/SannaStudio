<?php
class functions {
    public static function redirect(string $path): void {
        header('Location: '.SITE_URL.'/'.$path);
        exit;
    }

    public static function e(string $str): string {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    public static function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function post(string $key, string $default = ''): string {
        return trim($_POST[$key] ?? $default);
    }

    public static function get(string $key, string $default = ''): string {
        return trim($_GET[$key] ?? $default);
    }

    public static function csrfToken(): string {
        Session::start();
        if (!Session::has('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return Session::get('csrf_token');
    }

    public static function csrfField(): string {
        return '<input type="hidden" name="csrf_token" value="'.self::csrfToken().'">';
    }

    public static function verifyCsrf(): bool {
        $token = $_POST['csrf_token'] ?? '';
        return hash_equals(Session::get('csrf_token') ?? '', $token);
    }
}
