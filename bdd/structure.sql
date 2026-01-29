-- BASE DE DONNÉES CAN MAROC 2026
-- Création complète avec données de test

CREATE DATABASE IF NOT EXISTS can_maroc_2026;
USE can_maroc_2026;

-- 1. Table VILLES
CREATE TABLE villes (
    id_ville INT AUTO_INCREMENT PRIMARY KEY,
    nom_ville VARCHAR(100) NOT NULL
);

-- 2. Table STADES
CREATE TABLE stades (
    id_stade INT AUTO_INCREMENT PRIMARY KEY,
    nom_stade VARCHAR(100) NOT NULL,
    capacite INT NOT NULL,
    id_ville INT NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville)
);

-- 3. Table EQUIPES
CREATE TABLE equipes (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nom_equipe VARCHAR(100) NOT NULL,
    pays VARCHAR(100) NOT NULL
);

-- 4. Table USERS
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client','admin') DEFAULT 'client'
);

-- 5. Table MATCHS
CREATE TABLE matchs (
    id_match INT AUTO_INCREMENT PRIMARY KEY,
    id_equipe1 INT NOT NULL,
    id_equipe2 INT NOT NULL,
    id_stade INT NOT NULL,
    date_match DATE NOT NULL,
    heure_match TIME NOT NULL,
    prix DECIMAL(6,2) NOT NULL,
    places_restantes INT NOT NULL,
    FOREIGN KEY (id_equipe1) REFERENCES equipes(id_equipe),
    FOREIGN KEY (id_equipe2) REFERENCES equipes(id_equipe),
    FOREIGN KEY (id_stade) REFERENCES stades(id_stade)
);

-- 6. Table BILLETS
CREATE TABLE billets (
    id_billet INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_match INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    numero_place INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_match) REFERENCES matchs(id_match)
);

-- 7. Table SERVICES
CREATE TABLE services (
    id_service INT AUTO_INCREMENT PRIMARY KEY,
    type_service ENUM('hotel','transport') NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(6,2) NOT NULL,
    id_ville INT NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville)
);

-- ============================================
-- DONNÉES DE TEST
-- ============================================

-- Villes
INSERT INTO villes (nom_ville) VALUES 
('Casablanca'),
('Rabat'),
('Marrakech'),
('Fès'),
('Tanger');

-- Stades
INSERT INTO stades (nom_stade, capacite, id_ville) VALUES
('Stade Mohammed V', 45000, 1),
('Stade Moulay Abdellah', 53000, 2),
('Stade de Marrakech', 35000, 3);

-- Équipes
INSERT INTO equipes (nom_equipe, pays) VALUES
('Lions de l''Atlas', 'Maroc'),
('Les Fennecs', 'Algérie'),
('Les Aigles', 'Mali'),
('Les Lions', 'Sénégal'),
('Les Éléphants', 'Côte d''Ivoire');

-- Utilisateurs
INSERT INTO users (nom, email, password, role) VALUES
('Admin CAN', 'admin@can2026.ma', 'can2026admin', 'admin'),
('Karim Saidi', 'karim@email.com', 'pass123', 'client'),
('Leila Benani', 'leila@email.com', 'pass456', 'client');

-- Services
INSERT INTO services (type_service, description, prix, id_ville) VALUES
('hotel', 'Hôtel 5 étoiles centre-ville Casablanca', 650.00, 1),
('transport', 'Navette aéroport-stade Rabat', 35.00, 2),
('hotel', 'Riad traditionnel Marrakech', 420.00, 3);

-- Message de confirmation
SELECT 'Base de données CAN 2026 créée avec succès !' as Message;
