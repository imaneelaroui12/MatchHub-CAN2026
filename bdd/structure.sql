-- BASE DE DONNÉES CAN MAROC 2026 (Version Finale & Stricte)
CREATE DATABASE IF NOT EXISTS can_maroc_2026;
USE can_maroc_2026;

-- 1. TABLES DE BASE
CREATE TABLE villes (
    id_ville INT AUTO_INCREMENT PRIMARY KEY,
    nom_ville VARCHAR(100) NOT NULL
);

CREATE TABLE stades (
    id_stade INT AUTO_INCREMENT PRIMARY KEY,
    nom_stade VARCHAR(100) NOT NULL,
    capacite INT NOT NULL,
    id_ville INT NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville)
);

CREATE TABLE equipes (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nom_equipe VARCHAR(100) NOT NULL,
    pays VARCHAR(100) NOT NULL,
    groupe CHAR(1) NOT NULL
);

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'client'
);

-- 2. TABLES DES SERVICES (Séparées)
CREATE TABLE transports (
    id_transport INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL,
    compagnie VARCHAR(100) NOT NULL,
    trajet VARCHAR(255) NOT NULL,
    heure_depart TIME NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    lien VARCHAR(255) DEFAULT '#'
);

CREATE TABLE hotels (
    id_hotel INT AUTO_INCREMENT PRIMARY KEY,
    nom_hotel VARCHAR(100) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    etoiles INT NOT NULL,
    prix_nuit DECIMAL(10,2) NOT NULL,
    lien VARCHAR(255) DEFAULT '#'
);

-- 3. TABLES OPÉRATIONNELLES
CREATE TABLE matchs (
    id_match INT AUTO_INCREMENT PRIMARY KEY,
    id_equipe1 INT NOT NULL,
    id_equipe2 INT NOT NULL,
    id_stade INT NOT NULL,
    date_match DATE NOT NULL,
    heure_match TIME NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    places_restantes INT NOT NULL,
    FOREIGN KEY (id_equipe1) REFERENCES equipes(id_equipe),
    FOREIGN KEY (id_equipe2) REFERENCES equipes(id_equipe),
    FOREIGN KEY (id_stade) REFERENCES stades(id_stade)
);

CREATE TABLE billets (
    id_billet INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_match INT NOT NULL,
    numero_place INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_match) REFERENCES matchs(id_match)
);

CREATE TABLE reservations_services (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    type_service VARCHAR(50) NOT NULL,
    details VARCHAR(255) NOT NULL,
    prix_total DECIMAL(10,2) NOT NULL,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);