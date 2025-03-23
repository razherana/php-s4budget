CREATE DATABASE Gestion_budget ;
USE Gestion_budget ;
CREATE TABLE Departement(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50)
	);

CREATE TABLE User(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50),
	email VARCHAR(50),
	password VARCHAR(50),
	id_departement int,
	FOREIGN KEY (id_departement) REFERENCES Departement(id)
	);
	
CREATE TABLE Budget(
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_departement INT,
	Solde DECIMALE(15,2),
	FOREIGN KEY (id_departement) REFERENCES Departement(id)
	);

CREATE TABLE Prevision(
	id INT PRIMARY KEY AUTO_INCREMENT,
	designation VARCHAR(50),
	id_departement INT,
	FOREIGN KEY (id_departement) REFERENCES Departement(id)
	);
	
CREATE TABLE Realisation(
	id PRIMARY KEY AUTO_INCREMENT,
	designation VARCHAR(50),
	type VARCHAR(50),
	prevision DECIMALE(15,2),
	realisation_solde DECIMALE(15,2)
	);
	

