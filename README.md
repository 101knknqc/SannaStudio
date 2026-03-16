# SannaStudio — MVC v4

> Prestataire technique en webdiffusion professionnelle et intégration audiovisuelle au Québec.

---

## Nouveautés v4

| Fonctionnalité | Détails |
|---|---|
| **Notifications temps réel** | Bell dans le dashboard, badge unread, polling 60s, markAllRead |
| **Annulation de RDV** | Client peut annuler depuis son dashboard (statuts new/in_progress) |
| **Messagerie dashboard** | Inbox, envoi, lecture, badge non lus, notification admin |
| **Devis & factures PDF** | Liste par client + génération HTML printable (PDF via Ctrl+P) |
| **Page CGU** | `/cgu` — 9 sections légales, droit québécois |
| **Page Politique** | `/politique` — Loi 25 Québec, 8 sections |
| **Page Portfolio** | `/portfolio` — Projets avec hover overlay, tags, vidéo |
| **Page Tarifs** | `/tarifs` — 3 formules + options supplémentaires |
| **Blog** | `/blog` + `/blog/{slug}` — Articles dynamiques BDD |
| **Témoignages** | Section homepage dynamique depuis BDD + données de démo |
| **Compteurs animés** | 4 compteurs scroll-triggered sur la homepage |
| **Admin Kanban** | Drag-and-drop statuts RDV avec sauvegarde AJAX |
| **Admin Charts** | Donut répartition RDV + bar chart 7 jours (Chart.js) |
| **Email admin** | Notification email à chaque admin pour nouveau RDV |
| **Notification in-app** | Créée automatiquement lors d'un nouveau RDV (si connecté) |
| **Mode clair/sombre** | Toggle dans nav landing + dashboard, persisté localStorage |
| **Loader animé** | Bar de progression au premier chargement |
| **404 personnalisée** | Page d'erreur avec liens utiles et design du site |

---

## Structure complète

```
sannastudio/
├── index.php / defines.php / .htaccess / database.sql
├── .gitignore / defines.example.php
│
├── languages/
│   ├── fr.json   (155 clés)
│   └── en.json   (155 clés)
│
├── controllers/
│   ├── Router.php                     ← 18 routes
│   ├── Controller.php
│   ├── ControllerHome.php
│   ├── ControllerInscription.php      ← CGU obligatoires
│   ├── ControllerConnexion.php
│   ├── ControllerDeconnexion.php
│   ├── ControllerDashboard.php
│   ├── ControllerVerify.php           ← Mail confirmation
│   ├── ControllerRdv.php              ← Email admin + notif in-app
│   ├── ControllerMotDePasseOublie.php
│   ├── ControllerResetPassword.php
│   ├── ControllerAdmin.php            ← Kanban + charts + update-appt-status
│   ├── ControllerMessages.php         ← Messagerie inbox/sent/send/read
│   ├── ControllerNotifications.php    ← API JSON list + markread
│   ├── ControllerInvoices.php         ← Liste + téléchargement PDF
│   ├── ControllerAppointmentAction.php ← Annulation RDV client
│   ├── ControllerBlog.php             ← Liste + article
│   ├── ControllerPortfolio.php
│   ├── ControllerTarifs.php
│   ├── ControllerCgu.php
│   └── ControllerPolitique.php
│
├── models/
│   ├── Lang.php                       ← Traductions JSON
│   ├── Mailer.php                     ← +sendAdminNewRdv
│   ├── User.php / UserManager.php
│   ├── AppointmentManager.php         ← +updateStatus
│   ├── NotificationManager.php        ← NOUVEAU
│   ├── MessageManager.php             ← NOUVEAU
│   ├── InvoiceManager.php             ← NOUVEAU
│   ├── BlogManager.php                ← NOUVEAU
│   ├── PortfolioManager.php           ← NOUVEAU
│   ├── TestimonialManager.php         ← NOUVEAU
│   ├── Session.php / Alert.php / functions.php
│   └── Autoloader.php
│
├── views/
│   ├── landing/
│   │   ├── template.php               ← Loader + dark mode + lang + nav étendue
│   │   ├── viewHome.php               ← +compteurs +témoignages
│   │   ├── viewInscription.php        ← CGU obligatoires
│   │   ├── viewConnexion.php
│   │   ├── viewMotDePasseOublie.php
│   │   ├── viewResetPassword.php
│   │   ├── viewError.php              ← 404 personnalisée
│   │   ├── viewTarifs.php             ← NOUVEAU
│   │   ├── viewPortfolio.php          ← NOUVEAU
│   │   ├── viewBlog.php               ← NOUVEAU
│   │   ├── viewBlogPost.php           ← NOUVEAU
│   │   ├── viewCgu.php                ← NOUVEAU
│   │   └── viewPolitique.php          ← NOUVEAU
│   ├── dashboard/
│   │   ├── template.php               ← Bell notifs + dark mode + messages badge
│   │   ├── viewDashboard.php          ← +bouton annuler RDV
│   │   ├── viewMessages.php           ← NOUVEAU
│   │   ├── viewInvoices.php           ← NOUVEAU
│   │   └── viewError.php
│   └── admin/
│       ├── template.php
│       ├── viewAdminIndex.php         ← Charts Chart.js
│       ├── viewAdminAppointments.php  ← Kanban drag-and-drop
│       └── viewAdminUsers.php
│
└── assets/
    ├── css/style.css                  ← +loader +dark mode +compteurs +témoignages
    ├── css/auth.css
    ├── css/dashboard.css
    └── js/main.js
```

---

## Installation

### 1. Base de données

```bash
# Importer database.sql via phpMyAdmin
# Contient toutes les tables dont les nouvelles :
# messages, invoices, notifications, blog_posts, testimonials, portfolio
```

### 2. Configuration defines.php

Copier `defines.example.php` → `defines.php` et remplir BDD + SMTP.

### 3. Routes disponibles

| URL | Description |
|-----|-------------|
| `/` | Homepage (compteurs + témoignages) |
| `/inscription` | Compte (CGU obligatoires) |
| `/connexion` | Connexion |
| `/dashboard` | Espace client |
| `/messages` | Messagerie client |
| `/invoices` | Devis & factures |
| `/notifications` | API JSON notifications |
| `/appointment-action/{id}/cancel` | Annuler un RDV |
| `/tarifs` | Grille tarifaire |
| `/portfolio` | Réalisations |
| `/blog` | Articles |
| `/blog/{slug}` | Article |
| `/cgu` | CGU |
| `/politique` | Politique de confidentialité |
| `/admin` | Dashboard admin |
| `/admin/appointments` | Kanban RDV |
| `/admin/users` | Liste clients |
| `/admin/update-appt-status` | API AJAX statut RDV |
| `?lang=fr\|en` | Changer la langue |

---

## Ajouter du contenu

### Témoignage
```sql
INSERT INTO testimonials (name, role, content, rating) VALUES
('Prénom Nom', 'Rôle — Ville', 'Texte du témoignage.', 5);
```

### Article de blog
```sql
INSERT INTO blog_posts (title, slug, excerpt, content, published, published_at) VALUES
('Mon titre', 'mon-titre', 'Résumé court.', 'Contenu complet...', 1, NOW());
```

### Projet portfolio
```sql
INSERT INTO portfolio (title, description, category, cover_url, tags) VALUES
('Nom du projet', 'Description.', 'Événementiel', 'https://...image.jpg', 'live,youtube');
```

### Facture client (admin)
```sql
INSERT INTO invoices (user_id, number, type, amount, status, notes, issued_at) VALUES
(1, 'SSP-2026-0001', 'devis', 1200.00, 'sent', 'Webdiffusion événementielle', CURDATE());
```
