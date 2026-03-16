<?php
class Session {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_name('sanna_sess');
            session_start();
        }
    }

    public static function set(string $key, $value): void {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function has(string $key): bool {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function delete(string $key): void {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void {
        self::start();
        session_unset();
        session_destroy();
    }

    // ── Auth client ─────────────────────────────────────────────
    public static function loginClient(Client $client): void {
        self::set('client_id',    $client->getId());
        self::set('client_prenom',$client->getPrenom());
        self::set('client_nom',   $client->getNom());
        self::set('client_email', $client->getEmail());
    }

    public static function logoutClient(): void {
        self::delete('client_id');
        self::delete('client_prenom');
        self::delete('client_nom');
        self::delete('client_email');
    }

    public static function isLoggedIn(): bool {
        return self::has('client_id') && self::get('client_id') > 0;
    }

    public static function getClientId(): int {
        return (int)(self::get('client_id') ?? 0);
    }

    // ── Flash messages ──────────────────────────────────────────
    public static function flash(string $type, string $msg): void {
        self::set('flash', ['type' => $type, 'msg' => $msg]);
    }

    public static function getFlash(): ?array {
        $f = self::get('flash');
        self::delete('flash');
        return $f;
    }
}
