-- Active: 1738011862925@@127.0.0.1@3306@ecommerceProjetS4
CREATE DATABASE ecommerceProjetS4;
USE ecommerceProjetS4;

CREATE TABLE ecommerce_user (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  user_email VARCHAR(50) NOT NULL UNIQUE,
  user_name VARCHAR(50) NOT NULL,
  user_password VARCHAR(100) NOT NULL,
  user_phone VARCHAR(15) NOT NULL
);

CREATE TABLE ecommerce_admin (
  admin_id INT PRIMARY KEY AUTO_INCREMENT,
  admin_name VARCHAR(50) UNIQUE NOT NULL,
  admin_password VARCHAR(100) NOT NULL
);

CREATE TABLE ecommerce_image (
  image_id INT PRIMARY KEY AUTO_INCREMENT,
  image_url VARCHAR(100) NOT NULL
);

-- Produits things

CREATE TABLE ecommerce_category (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  category_nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE ecommerce_product (
  product_id INT PRIMARY KEY AUTO_INCREMENT,
  product_name VARCHAR(255) NOT NULL,
  product_description TEXT NOT NULL,
  product_image INT NULL
);

CREATE TABLE ecommerce_image_produit (
  image_produit_id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT REFERENCES ecommerce_product(product_id),
  image_id INT REFERENCES ecommerce_image(image_id)
);
