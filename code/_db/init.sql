-- Création de la base de données.
CREATE DATABASE IF NOT EXISTS calcul;

USE calcul;
ALTER TABLE exercises DROP FOREIGN KEY exercises_ibfk_1;
ALTER TABLE scores DROP FOREIGN KEY scores_ibfk_1;

DROP TABLE IF EXISTS score CASCADE;
DROP TABLE IF EXISTS exercices CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- Création des TABLES
-- USERS --
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    score INT DEFAULT 0
);

-- EXERCICES --
CREATE TABLE IF NOT EXISTS exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    question TEXT,
    correct_answer VARCHAR(255),
    user_answer VARCHAR(255),
    is_correct BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- SCORES --
CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    score INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
