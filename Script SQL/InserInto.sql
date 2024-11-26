-- Insertion de 10 étudiants
INSERT INTO Etudiant (prenom, nom, adresse, ville, pays, telephone, domaine)
VALUES 
    ('Jean', 'Dupont', '123 Rue Principale', 'Montréal', 'Canada', '5141234567', 'Informatique'),
    ('Marie', 'Curie', '456 Avenue de la Science', 'Paris', 'France', '33123456789', 'Physique'),
    ('Alice', 'Johnson', '789 Boulevard des Étoiles', 'New York', 'USA', '1212345678', 'Mathématiques'),
    ('Peter', 'Parker', '22 Spider Lane', 'Queens', 'USA', '19123456789', 'Biologie'),
    ('John', 'Doe', '1010 Elm Street', 'Los Angeles', 'USA', '1812345678', 'Chimie'),
    ('Emma', 'Watson', '876 Baker Street', 'Londres', 'UK', '441234567890', 'Littérature'),
    ('Hiroshi', 'Tanaka', '12 Sakura Road', 'Tokyo', 'Japon', '81312345678', 'Robotique'),
    ('Amélie', 'Poulain', '1 Rue des Champs', 'Paris', 'France', '33123456789', 'Cinéma'),
    ('Bruce', 'Wayne', '1007 Mountain Drive', 'Gotham', 'USA', '1812345678', 'Justice'),
    ('Clark', 'Kent', '344 Clinton Street', 'Metropolis', 'USA', '1212345678', 'Journalisme');

-- Insertion de 5 cours
INSERT INTO Cours (nom, nombre_credits)
VALUES 
    ('Programmation en C++', 4),
    ('Bases de Données', 3),
    ('Développement Web', 5),
    ('Algorithmes Avancés', 4),
    ('Analyse de Données', 3);
    
-- Insertion des résultats (3 résultats par étudiant et par cours)
INSERT INTO Resultat (etudiantId, coursId, session, note)
VALUES 
    (27000, 400, 'Printemp 2024', 85), (27000, 401, 'Automne 2024', 72), (27000, 402, 'Hiver 2023', 90),
    (27001, 400, 'Printemp 2024', 67), (27001, 401, 'Automne 2024', 75), (27001, 402, 'Hiver 2023', 80),
    (27002, 400, 'Printemp 2024', 50), (27002, 404, 'Automne 2024', 88), (27002, 400, 'Hiver 2023', 70),
    (27003, 403, 'Printemp 2024', 95), (27003, 401, 'Automne 2024', 78), (27003, 402, 'Hiver 2023', 82),
    (27004, 400, 'Printemp 2024', 89), (27004, 401, 'Automne 2024', 65), (27004, 402, 'Hiver 2023', 76),
    (27005, 404, 'Printemp 2024', 73), (27005, 403, 'Automne 2024', 58), (27005, 402, 'Hiver 2023', 62),
    (27006, 400, 'Printemp 2024', 81), (27006, 401, 'Automne 2024', 70), (27006, 403, 'Hiver 2023', 75),
    (27007, 400, 'Printemp 2024', 49), (27007, 404, 'Automne 2024', 69), (27007, 402, 'Hiver 2023', 80),
    (27008, 401, 'Printemp 2024', 88), (27008, 404, 'Automne 2024', 79), (27008, 402, 'Hiver 2023', 92),
    (27009, 400, 'Printemp 2024', 92), (27009, 401, 'Automne 2024', 64), (27009, 402, 'Hiver 2023', 71);    
    

select * from Etudiant;
select * from Cours;
select * from Resultat;