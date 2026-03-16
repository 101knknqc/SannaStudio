# SannaStudio — MVC

## Structure
```
sannastudio-mvc/
├── index.php                  ← Point d'entrée unique
├── defines.php                ← Config (BDD, mail, URL)
├── .htaccess                  ← Réécriture d'URL
├── database.sql               ← Script SQL à importer dans Plesk
├── controllers/
│   ├── Router.php             ← Routeur
│   ├── Controller.php         ← Classe de base
│   ├── ControllerHome.php     ← Page d'accueil
│   ├── ControllerInscription.php
│   ├── ControllerConnexion.php
│   ├── ControllerDeconnexion.php
│   ├── ControllerDashboard.php ← Espace client (protégé)
│   ├── ControllerVerify.php   ← Vérification email
│   ├── ControllerRdv.php      ← Formulaire RDV (AJAX)
│   ├── ControllerMotDePasseOublie.php
│   └── ControllerResetPassword.php
├── models/
│   ├── Model.php              ← ORM de base (PDO)
│   ├── Client.php             ← Entité client
│   ├── ClientManager.php      ← CRUD clients
│   ├── RdvDemande.php         ← Entité RDV
│   ├── RdvManager.php         ← CRUD RDV
│   ├── Mailer.php             ← Envoi SMTP SSL (port 465)
│   ├── Session.php            ← Gestion sessions PHP
│   ├── Alert.php              ← Messages d'alerte
│   ├── Autoloader.php         ← Autoload models
│   └── functions.php          ← Utilitaires (CSRF, redirect…)
├── views/
│   ├── View.php               ← Moteur de vues
│   ├── landing/               ← Site public
│   │   ├── template.php       ← Nav + footer du site
│   │   ├── viewHome.php       ← Page principale (hero → rdv)
│   │   ├── viewInscription.php
│   │   ├── viewConnexion.php
│   │   ├── viewMotDePasseOublie.php
│   │   ├── viewResetPassword.php
│   │   └── viewError.php
│   └── dashboard/             ← Espace client
│       ├── template.php       ← Sidebar + topbar
│       ├── viewDashboard.php  ← "Salut, Prénom" + RDVs
│       └── viewError.php
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── img/
```

## Installation sur Plesk

### 1. Base de données
- Plesk → Bases de données → Créer une BDD `sannastudio`
- Importer `database.sql` via phpMyAdmin
- Remplir `defines.php` : `DB_USER`, `DB_PASS`, `DB_NAME`

### 2. Upload des fichiers
- Uploader tout le dossier dans `httpdocs/` (ou sous-dossier)
- Vérifier que mod_rewrite est activé (`.htaccess`)

### 3. Configuration defines.php
```php
define('DB_NAME', 'sannastudio');
define('DB_USER', 'votre_user_bdd');
define('DB_PASS', 'votre_mdp_bdd');
```
Les paramètres mail sont déjà remplis avec `no-reply@ssp.en.gp`.

## Routes disponibles
| URL | Contrôleur |
|-----|-----------|
| `/` | Accueil |
| `/inscription` | Formulaire inscription |
| `/connexion` | Connexion |
| `/deconnexion` | Déconnexion |
| `/dashboard` | Espace client (auth requis) |
| `/verify?token=…` | Vérification email |
| `/rdv` (POST) | Formulaire RDV (AJAX) |
| `/mot-de-passe-oublie` | Reset password step 1 |
| `/reset-password?token=…` | Reset password step 2 |

## Flux inscription
1. Client remplit le formulaire → BDD `clients` + email bienvenue SMTP
2. Client clique le lien `/verify?token=…` → `email_verified = 1`
3. Client se connecte → session PHP → accès `/dashboard`
4. Dashboard affiche "Salut, Prénom 👋" + ses RDVs
