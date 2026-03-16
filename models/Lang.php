<?php
/**
 * Lang — Gestionnaire de traductions JSON
 * Usage: Lang::t('nav.services') → "Services"
 *        Lang::get()            → retourne l'array complet
 *        Lang::setCookie('en')  → change la langue
 */
class Lang {
    private static array $data = [];
    private static string $current = 'fr';
    private static array $available = ['fr', 'en'];

    public static function init(): void {
        // Priorité : GET > Cookie > Défaut
        if (!empty($_GET['lang']) && in_array($_GET['lang'], self::$available)) {
            self::$current = $_GET['lang'];
            setcookie('lang', self::$current, time() + 60 * 60 * 24 * 365, '/');
        } elseif (!empty($_COOKIE['lang']) && in_array($_COOKIE['lang'], self::$available)) {
            self::$current = $_COOKIE['lang'];
        }

        $file = __DIR__.'/../languages/'.self::$current.'.json';
        if (!file_exists($file)) {
            $file = __DIR__.'/../languages/fr.json';
            self::$current = 'fr';
        }

        self::$data = json_decode(file_get_contents($file), true) ?? [];
    }

    /**
     * Récupère une traduction par clé pointée
     * Ex: Lang::t('nav.services') → "Services"
     */
    public static function t(string $key, array $replace = []): string {
        $parts = explode('.', $key);
        $val = self::$data;
        foreach ($parts as $part) {
            if (!isset($val[$part])) return $key;
            $val = $val[$part];
        }
        $str = is_string($val) ? $val : $key;
        foreach ($replace as $k => $v) {
            $str = str_replace(':' . $k, $v, $str);
        }
        return $str;
    }

    public static function get(): array {
        return self::$data;
    }

    public static function current(): string {
        return self::$current;
    }

    public static function available(): array {
        $list = [];
        foreach (self::$available as $code) {
            $file = __DIR__.'/../languages/'.$code.'.json';
            if (file_exists($file)) {
                $d = json_decode(file_get_contents($file), true) ?? [];
                $list[$code] = [
                    'code'  => $code,
                    'name'  => $d['lang_name'] ?? $code,
                    'emoji' => $d['lang_emoji'] ?? '',
                ];
            }
        }
        return $list;
    }
}
