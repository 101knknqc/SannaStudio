-- ═══════════════════════════════════════════
--  SannaStudio — Base de données
--  Créer cette base sur Plesk > Bases de données
-- ═══════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS sannastudio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sannastudio;

-- ── Table clients ──────────────────────────
CREATE TABLE IF NOT EXISTS `clients` (
  `id`              INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `prenom`          VARCHAR(80)     NOT NULL,
  `nom`             VARCHAR(80)     NOT NULL,
  `email`           VARCHAR(191)    NOT NULL,
  `telephone`       VARCHAR(30)     DEFAULT NULL,
  `password_hash`   VARCHAR(255)    NOT NULL,
  `token_verify`    VARCHAR(64)     DEFAULT NULL COMMENT 'token email vérification',
  `email_verified`  TINYINT(1)      NOT NULL DEFAULT 0,
  `token_reset`     VARCHAR(64)     DEFAULT NULL COMMENT 'token reset mot de passe',
  `token_reset_exp` DATETIME        DEFAULT NULL,
  `accepte_cgu`     TINYINT(1)      NOT NULL DEFAULT 0,
  `accepte_politique` TINYINT(1)    NOT NULL DEFAULT 0,
  `created_at`      DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table rdv_demandes ─────────────────────
CREATE TABLE IF NOT EXISTS `rdv_demandes` (
  `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `client_id`   INT UNSIGNED  DEFAULT NULL COMMENT 'NULL si soumis sans compte',
  `nom`         VARCHAR(120)  NOT NULL,
  `email`       VARCHAR(191)  NOT NULL,
  `telephone`   VARCHAR(30)   DEFAULT NULL,
  `service`     VARCHAR(80)   NOT NULL,
  `date_souhaitee` DATE       DEFAULT NULL,
  `duree`       VARCHAR(40)   DEFAULT NULL,
  `plateformes` VARCHAR(255)  DEFAULT NULL,
  `message`     TEXT          NOT NULL,
  `statut`      ENUM('nouveau','en_cours','termine','annule') NOT NULL DEFAULT 'nouveau',
  `created_at`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rdv_client` (`client_id`),
  CONSTRAINT `fk_rdv_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Table sessions_clients ─────────────────
CREATE TABLE IF NOT EXISTS `sessions_clients` (
  `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `client_id`   INT UNSIGNED  NOT NULL,
  `token`       VARCHAR(128)  NOT NULL,
  `ip`          VARCHAR(45)   DEFAULT NULL,
  `user_agent`  VARCHAR(255)  DEFAULT NULL,
  `expires_at`  DATETIME      NOT NULL,
  `created_at`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_token` (`token`),
  KEY `fk_sess_client` (`client_id`),
  CONSTRAINT `fk_sess_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
