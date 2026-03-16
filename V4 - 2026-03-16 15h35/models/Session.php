<?php
class Session {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_name('ssp_access');
            session_start();
        }
    }
    public static function set(string $key, $value): void { self::start(); $_SESSION[$key] = $value; }
    public static function get(string $key) { self::start(); return $_SESSION[$key] ?? null; }
    public static function has(string $key): bool { self::start(); return isset($_SESSION[$key]); }
    public static function delete(string $key): void { self::start(); unset($_SESSION[$key]); }
    public static function destroy(): void { self::start(); session_unset(); session_destroy(); }

    // ── Auth ────────────────────────────────────────────────────────
    public static function loginUser(User $user): void {
        self::set('user_id',         $user->getId());
        self::set('user_first_name', $user->getFirstName());
        self::set('user_last_name',  $user->getLastName());
        self::set('user_email',      $user->getEmail());
        self::set('user_role',       $user->getRole());
    }
    public static function logoutUser(): void {
        foreach (['user_id','user_first_name','user_last_name','user_email','user_role'] as $k)
            self::delete($k);
    }
    public static function isLoggedIn(): bool { return self::has('user_id') && self::get('user_id') > 0; }
    public static function getUserId(): int   { return (int)(self::get('user_id') ?? 0); }
    public static function isAdmin(): bool    { return self::get('user_role') === 'admin'; }

    // ── Flash ────────────────────────────────────────────────────────
    public static function flash(string $type, string $msg): void { self::set('flash', ['type'=>$type,'msg'=>$msg]); }
    public static function getFlash(): ?array { $f = self::get('flash'); self::delete('flash'); return $f; }
}