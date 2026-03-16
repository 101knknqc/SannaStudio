-- ═══════════════════════════════════════════════════════════
--  SannaStudio — Database (English, unified)
--  Import via Plesk > phpMyAdmin
-- ═══════════════════════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS sannastudio
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE sannastudio;

-- ── Table: users ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `first_name`        VARCHAR(80)     NOT NULL,
    `last_name`         VARCHAR(80)     NOT NULL,
    `email`             VARCHAR(191)    NOT NULL,
    `phone`             VARCHAR(30)     DEFAULT NULL,
    `password_hash`     VARCHAR(255)    NOT NULL,
    `email_token`       VARCHAR(64)     DEFAULT NULL,
    `email_verified`    TINYINT(1)      NOT NULL DEFAULT 0,
    `reset_token`       VARCHAR(64)     DEFAULT NULL,
    `reset_token_exp`   DATETIME        DEFAULT NULL,
    `accepted_tos`      TINYINT(1)      NOT NULL DEFAULT 0,
    `accepted_privacy`  TINYINT(1)      NOT NULL DEFAULT 0,
    `last_login_at`     DATETIME        DEFAULT NULL,
    `last_login_ip`     VARCHAR(45)     DEFAULT NULL,
    `created_at`        DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_email` (`email`),
    KEY `idx_email_token` (`email_token`),
    KEY `idx_reset_token` (`reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: appointments ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS `appointments` (
    `id`             INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `user_id`        INT UNSIGNED    DEFAULT NULL,
    `full_name`      VARCHAR(120)    NOT NULL,
    `email`          VARCHAR(191)    NOT NULL,
    `phone`          VARCHAR(30)     DEFAULT NULL,
    `service`        VARCHAR(80)     NOT NULL,
    `requested_date` DATE            DEFAULT NULL,
    `duration`       VARCHAR(40)     DEFAULT NULL,
    `platforms`      VARCHAR(255)    DEFAULT NULL,
    `message`        TEXT            NOT NULL,
    `status`         ENUM('new','in_progress','completed','cancelled') NOT NULL DEFAULT 'new',
    `created_at`     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_appt_user` (`user_id`),
    CONSTRAINT `fk_appt_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: messages (messagerie client ↔ équipe) ──────────────
CREATE TABLE IF NOT EXISTS `messages` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `from_id`    INT UNSIGNED NOT NULL,
    `to_id`      INT UNSIGNED NOT NULL,
    `subject`    VARCHAR(200) NOT NULL DEFAULT '',
    `body`       TEXT NOT NULL,
    `read_at`    DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_msg_to` (`to_id`),
    KEY `idx_msg_from` (`from_id`),
    CONSTRAINT `fk_msg_from` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_msg_to`   FOREIGN KEY (`to_id`)   REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: invoices (devis/factures PDF) ───────────────────────
CREATE TABLE IF NOT EXISTS `invoices` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`      INT UNSIGNED NOT NULL,
    `appt_id`      INT UNSIGNED DEFAULT NULL,
    `number`       VARCHAR(30)  NOT NULL,
    `type`         ENUM('devis','facture') NOT NULL DEFAULT 'devis',
    `amount`       DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `status`       ENUM('draft','sent','paid','cancelled') NOT NULL DEFAULT 'draft',
    `pdf_path`     VARCHAR(255) DEFAULT NULL,
    `notes`        TEXT DEFAULT NULL,
    `issued_at`    DATE DEFAULT NULL,
    `created_at`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_inv_user` (`user_id`),
    CONSTRAINT `fk_inv_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: blog_posts ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `author_id`   INT UNSIGNED DEFAULT NULL,
    `title`       VARCHAR(255) NOT NULL,
    `slug`        VARCHAR(255) NOT NULL,
    `excerpt`     TEXT DEFAULT NULL,
    `content`     LONGTEXT NOT NULL,
    `cover_url`   VARCHAR(255) DEFAULT NULL,
    `published`   TINYINT(1) NOT NULL DEFAULT 0,
    `published_at` DATETIME DEFAULT NULL,
    `created_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_slug` (`slug`),
    KEY `fk_post_author` (`author_id`),
    CONSTRAINT `fk_post_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: testimonials ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(120) NOT NULL,
    `role`        VARCHAR(120) DEFAULT NULL,
    `photo_url`   VARCHAR(255) DEFAULT NULL,
    `content`     TEXT NOT NULL,
    `rating`      TINYINT UNSIGNED NOT NULL DEFAULT 5,
    `published`   TINYINT(1) NOT NULL DEFAULT 1,
    `created_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: portfolio ───────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `portfolio` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `category`    VARCHAR(80)  DEFAULT NULL,
    `cover_url`   VARCHAR(255) DEFAULT NULL,
    `video_url`   VARCHAR(255) DEFAULT NULL,
    `tags`        VARCHAR(255) DEFAULT NULL,
    `published`   TINYINT(1)  NOT NULL DEFAULT 1,
    `sort_order`  INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: totp_secrets (2FA) ──────────────────────────────────
CREATE TABLE IF NOT EXISTS `totp_secrets` (
    `user_id`    INT UNSIGNED NOT NULL,
    `secret`     VARCHAR(64)  NOT NULL,
    `enabled`    TINYINT(1)   NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`),
    CONSTRAINT `fk_totp_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table: notifications (temps réel RDV) ─────────────────────
CREATE TABLE IF NOT EXISTS `notifications` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    INT UNSIGNED NOT NULL,
    `type`       VARCHAR(50)  NOT NULL DEFAULT 'info',
    `title`      VARCHAR(200) NOT NULL,
    `body`       TEXT DEFAULT NULL,
    `link`       VARCHAR(255) DEFAULT NULL,
    `read_at`    DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_notif_user` (`user_id`),
    CONSTRAINT `fk_notif_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Données de démo ────────────────────────────────────────────
INSERT IGNORE INTO `testimonials` (`name`, `role`, `content`, `rating`) VALUES
('Marie Tremblay', 'Organisatrice d''événements — Montréal', 'SannaStudio a géré la diffusion live de notre gala annuel avec un professionnalisme impeccable. Tout était parfait du setup à la diffusion.', 5),
('Jean-François Côté', 'Directeur paroissial — Québec', 'Nous utilisons leur installation permanente depuis 6 mois. Fiable, simple à utiliser, et l''équipe répond toujours en moins d''une heure.', 5),
('Amélie Dubois', 'Coordonnatrice culturelle — Lévis', 'La formation OBS Studio était exactement ce dont mon équipe avait besoin. Claire, pratique et adaptée à notre niveau.', 4);

INSERT IGNORE INTO `portfolio` (`title`, `description`, `category`, `tags`) VALUES
('Gala de bienfaisance 2025', 'Diffusion live sur YouTube et Facebook simultanément pour 3 000 spectateurs en ligne.', 'Événementiel', 'youtube,facebook,live,gala'),
('Installation studio paroisse Saint-Jean', 'Mise en place d''un studio de diffusion permanent avec 2 caméras, régie OBS et encodeur Blackmagic.', 'Installation', 'permanent,obs,eglise'),
('Formation équipe Radio Communautaire', 'Journée de formation complète OBS Studio pour une équipe de 8 personnes.', 'Formation', 'obs,formation,radio');
