USE covoiturage;

-- =========================
-- EMPLOYEES (données RH)
-- =========================
INSERT INTO employees (id, firstname, lastname, phone, email, role, password) VALUES
(1,'Martin','Alexandre','612345678','alexandre.martin@email.fr','USER','$2y$10$testhash'),
(2,'Dubois','Sophie','698765432','sophie.dubois@email.fr','USER','$2y$10$testhash'),
(3,'Bernard','Julien','622446688','julien.bernard@email.fr','USER','$2y$10$testhash'),
(4,'Moreau','Camille','611223344','camille.moreau@email.fr','USER','$2y$10$testhash'),
(5,'Lefevre','Lucie','777889900','lucie.lefevre@email.fr','USER','$2y$10$testhash'),
(6,'Leroy','Thomas','655443322','thomas.leroy@email.fr','USER','$2y$10$testhash'),
(7,'Roux','Chloe','633221199','chloe.roux@email.fr','USER','$2y$10$testhash'),
(8,'Petit','Maxime','766778899','maxime.petit@email.fr','USER','$2y$10$testhash'),
(9,'Garnier','Laura','688776655','laura.garnier@email.fr','USER','$2y$10$testhash'),
(10,'Dupuis','Antoine','744556677','antoine.dupuis@email.fr','USER','$2y$10$testhash'),
(11,'Lefebvre','Emma','699887766','emma.lefebvre@email.fr','USER','$2y$10$testhash'),
(12,'Fontaine','Louis','655667788','louis.fontaine@email.fr','USER','$2y$10$testhash'),
(13,'Chevalier','Clara','788990011','clara.chevalier@email.fr','USER','$2y$10$testhash'),
(14,'Robin','Nicolas','644332211','nicolas.robin@email.fr','USER','$2y$10$testhash'),
(15,'Gauthier','Marine','677889922','marine.gauthier@email.fr','USER','$2y$10$testhash'),
(16,'Fournier','Pierre','722334455','pierre.fournier@email.fr','USER','$2y$10$testhash'),
(17,'Girard','Sarah','688665544','sarah.girard@email.fr','USER','$2y$10$testhash'),
(18,'Lambert','Hugo','611223366','hugo.lambert@email.fr','USER','$2y$10$testhash'),
(19,'Masson','Julie','733445566','julie.masson@email.fr','USER','$2y$10$testhash'),
(20,'Henry','Arthur','666554433','arthur.henry@email.fr','USER','$2y$10$testhash');


-- =========================
-- AGENCIES
-- =========================
INSERT INTO agencies (name) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- =========================
-- TRIPS (test)
-- =========================
INSERT INTO trips (
    departure_agency_id,
    arrival_agency_id,
    departure_datetime,
    arrival_datetime,
    total_seats,
    available_seats,
    contact_employee_id
) VALUES (
    1,
    2,
    '2025-12-10 08:00:00',
    '2025-12-10 12:00:00',
    4,
    2,
    2
);

