-- Création de la base si elle n'existe pas
CREATE DATABASE IF NOT EXISTS scinote_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE scinote_db;

-- Table utilisateurs
CREATE TABLE `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('auteur','admin','lecteur') NOT NULL DEFAULT 'auteur',
  `date_inscription` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Table articles
CREATE TABLE `articles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `date_publication` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prix` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `auteur` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `photo` VARCHAR(255)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Données de test
INSERT INTO `users` (`nom`, `email`, `password`, `role`)
VALUES
  ('Test Auteur', 'auteur@example.com', SHA2('motdepasse123',256), 'auteur'),
  ('Admin Site', 'admin@example.com', SHA2('adminpass',256), 'admin');

INSERT INTO `articles` (`nom`, `description`, `date_publication`, `prix`, `auteur`, `email`, `photo`)
VALUES
  ('Premier article test', 'Ceci est un résumé de test.', NOW(), 0.00, 'Test Auteur', 'auteur@example.com', 'photo1.jpg');