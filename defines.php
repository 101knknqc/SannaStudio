<?php
// ── URL & Nom ─────────────────────────────────────────────────────────────
define('SITE_URL',  rtrim((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'], '/'));
define('SITE_NAME', 'SannaStudio');
define('SITE_PATH', '');

// ── Base de données ───────────────────────────────────────────────────────
define('DB_HOST', 'localhost');
define('DB_NAME', 'sannastudio');   // ← nom de ta BDD dans Plesk
define('DB_USER', 'root');    // ← utilisateur BDD Plesk
define('DB_PASS', ''); // ← à remplir

// ── Mail SMTP Plesk ───────────────────────────────────────────────────────
define('MAIL_HOST',     'ssp.en.gp');
define('MAIL_PORT',     465);
define('MAIL_USER', 're-reply@ssp.en.gp');
define('MAIL_PASS', '69i%24Qtd');
define('MAIL_FROM', 're-reply@ssp.en.gp');
define('MAIL_FROM_NAME','SannaStudio');
define('MAIL_SECURE',   'ssl');

// ── Contact ───────────────────────────────────────────────────────────────
define('CONTACT_EMAIL',  'contact@sannastudio.ca');
define('CONTACT_PHONE',  '+1 (367) 382-5551');
define('DISCORD_URL',    'https://discord.gg/dadV5eSS4b');
define('DISCORD_GUILD',  '1390432827224358932');

// ── Chemins ───────────────────────────────────────────────────────────────
define('PATH_CONTROLLERS', __DIR__.'/controllers');
define('PATH_VIEWS',       __DIR__.'/views');
define('PATH_MODELS',      __DIR__.'/models');
