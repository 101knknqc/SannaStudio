<?php
// ── URL & Nom ─────────────────────────────────────────────────────────────
define('SITE_URL',  rtrim((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'], '/'));
define('SITE_NAME', 'SannaStudio');

// ── Base de données ───────────────────────────────────────────────────────
define('DB_HOST', 'localhost');
define('DB_NAME', 'sannastudio');
define('DB_USER', 'votre_user_bdd');
define('DB_PASS', 'votre_mdp_bdd');

// ── Mail SMTP ─────────────────────────────────────────────────────────────
define('MAIL_HOST',      'mail.votredomaine.com');
define('MAIL_PORT',      465);
define('MAIL_USER',      'no-reply@votredomaine.com');
define('MAIL_PASS',      'votre_mdp_mail');
define('MAIL_FROM',      'no-reply@votredomaine.com');
define('MAIL_FROM_NAME', 'SannaStudio');
define('MAIL_SECURE',    'ssl');

// ── Contact ───────────────────────────────────────────────────────────────
define('CONTACT_EMAIL', 'contact@sannastudio.ca');
define('CONTACT_PHONE', '+1 (000) 000-0000');
define('DISCORD_URL',   'https://discord.gg/XXXXXXXXX');
define('DISCORD_GUILD', 'VOTRE_GUILD_ID');

// ── Chemins ───────────────────────────────────────────────────────────────
define('PATH_CONTROLLERS', __DIR__.'/controllers');
define('PATH_VIEWS',       __DIR__.'/views');
define('PATH_MODELS',      __DIR__.'/models');
