-- Création de la base de données
CREATE DATABASE IF NOT EXISTS covoiturage
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE covoiturage;

-- =========================
-- TABLE : employees
-- =========================
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(30),
    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
    password VARCHAR(255) NOT NULL
);

-- =========================
-- TABLE : agencies
-- =========================
CREATE TABLE agencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE
);

-- =========================
-- TABLE : trips
-- =========================
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,
    departure_datetime DATETIME NOT NULL,
    arrival_datetime DATETIME NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL,
    contact_employee_id INT NOT NULL,

    CONSTRAINT fk_trip_departure_agency
        FOREIGN KEY (departure_agency_id) REFERENCES agencies(id),

    CONSTRAINT fk_trip_arrival_agency
        FOREIGN KEY (arrival_agency_id) REFERENCES agencies(id),

    CONSTRAINT fk_trip_employee
        FOREIGN KEY (contact_employee_id) REFERENCES employees(id)
);

