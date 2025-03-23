-- Active: 1738011862925@@127.0.0.1@3306@Gestion_budget
CREATE DATABASE Gestion_budget;

USE Gestion_budget;

CREATE TABLE Departement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);

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
    Solde DECIMAL (15, 2),
    FOREIGN KEY (id_departement) REFERENCES Departement (id)
);

CREATE TABLE Prevision (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50),
    id_departement INT,
    FOREIGN KEY (id_departement) REFERENCES Departement (id)
);

CREATE TABLE Realisation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50),
    type VARCHAR(50),
    prevision DECIMAL (15, 2),
    solde DECIMAL (15, 2)
);