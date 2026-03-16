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
