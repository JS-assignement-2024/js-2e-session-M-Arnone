-- Création de la base de données.
CREATE DATABASE IF NOT EXISTS calcul;

USE calcul;
ALTER TABLE exercises DROP FOREIGN KEY exercises_ibfk_1;
ALTER TABLE scores DROP FOREIGN KEY scores_ibfk_1;

DROP TABLE IF EXISTS scores CASCADE;
DROP TABLE IF EXISTS exercises CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- Création des TABLES

-- USERS --
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL UNIQUE,
);

-- SCORES --
CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    score INT,
    num_exercises INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
