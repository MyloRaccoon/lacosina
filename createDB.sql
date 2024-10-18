CREATE DATABASE lacosina;

CREATE TABLE recettes(
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100),
    description TEXT,
    auteur VARCHAR(100),
    date_creation DATETIME,
    image VARCHAR(100)
);

CREATE Table contact (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    description TEXT,
);