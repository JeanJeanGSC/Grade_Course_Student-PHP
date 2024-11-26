-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_Etudiant;

-- Sélection de la base de données
USE gestion_Etudiant;

-- Création de la table Etudiant avec un point de départ de 27000
CREATE TABLE IF NOT EXISTS Etudiant (
    etudiantId INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    adresse VARCHAR(100),
    ville VARCHAR(50),
    pays VARCHAR(50),
    telephone VARCHAR(20),
    domaine VARCHAR(50)
) AUTO_INCREMENT = 27000;

-- Création de la table Cours avec un point de départ de 400
CREATE TABLE IF NOT EXISTS Cours (
    coursId INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    nombre_credits INT CHECK(nombre_credits >= 1 AND nombre_credits <= 8)
) AUTO_INCREMENT = 400;

-- Création de la table Resultat avec un point de départ de 2
CREATE TABLE IF NOT EXISTS Resultat (
    resultatId INT AUTO_INCREMENT PRIMARY KEY,
    etudiantId INT,
    coursId INT,
    session VARCHAR(50),
    note INT CHECK(note >= 0 AND note <= 100),  -- Note sur 100, uniquement des entiers
    FOREIGN KEY (etudiantId) REFERENCES Etudiant(etudiantId),
    FOREIGN KEY (coursId) REFERENCES Cours(coursId)
) AUTO_INCREMENT = 2;