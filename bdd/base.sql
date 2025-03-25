CREATE DATABASE Gestion_budget;
USE Gestion_budget;

CREATE TABLE Departement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    icon VARCHAR(50)
);

-- DEPARTEMENT -> CATEGORIES : PPN -> TYPES : RIZ, ETC -> (PREVISIONS (DEPENSE | RECETTE) : LIBELLE (ANARANY), REALISATION)

CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(50),
    id_departement int NOT NULL,
    is_super_admin int DEFAULT 0
);

CREATE TABLE Budget (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_departement INT, 
    solde DECIMAL (15, 2),
    locked INT NULL,
    updated_at TIMESTAMP,
    FOREIGN KEY (id_departement) REFERENCES Departement (id)
);

CREATE TABLE Categorie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50), -- PPN, ETC
    id_departement INT,
    FOREIGN KEY (id_departement) REFERENCES Departement (id)
);

CREATE TABLE Type (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50), -- RIZ, ETC
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES Categorie (id)
);

CREATE TABLE Prevision (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50),
    realisation DECIMAL (15, 2),
    prevision DECIMAL (15, 2),
    type INT(1), -- DEPENSE OU RECETTE
    id_type INT,
    `date` DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (id_type) REFERENCES Type (id)
);

INSERT INTO `User` VALUES (1,'admin','admin@admin.com', '123', 0, 1);
