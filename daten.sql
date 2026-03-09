use Stundenplan;
-- 1. Faecher zuerst (keine Abhängigkeiten)
INSERT INTO Faecher (F_Name) VALUES 
('Mathematik'), ('Deutsch'), ('Englisch'), ('Physik'), ('Informatik'),
('Biologie'), ('Geschichte'), ('Chemie'), ('Sport'), ('Kunst');

-- 2. Lehrer (keine Abhängigkeiten)
INSERT INTO Lehrer (Vorname, Nachname, Kuerzel, Aktiv) VALUES 
('Max', 'Mustermann', 'MUM', 1), ('Erika', 'Schmidt', 'SME', 1),
('Hans', 'Gruber', 'GRU', 1), ('Julia', 'Meier', 'MEJ', 1),
('Peter', 'Lustig', 'LUP', 0), ('Sarah', 'Kohl', 'KOS', 1),
('Bernd', 'Brot', 'BRB', 1), ('Monika', 'Bauer', 'BAM', 1),
('Klaus', 'Klein', 'KLK', 0), ('Petra', 'Pan', 'PAP', 1);

-- 3. User (keine Abhängigkeiten)
INSERT INTO User (Password) VALUES 
('hash_123'), ('secure_pw'), ('admin_2024'), ('pass_word'), ('student_pw'),
('geheim123'), ('abcd_efg'), ('qwertz_789'), ('user_pass'), ('let_me_in');

-- 4. Aufgaben (benötigt L_ID, F_Name und U_ID aus den oberen Tabellen)
INSERT INTO Aufgaben (Titel, Beschreibung, Faelligkeitsdatum, Erledigt, L_ID, F_Name, U_ID) VALUES 
('Hausaufgabe 1', 'S. 42 Nr. 1-3', '2024-05-10', 0, 1, 'Mathematik', 1),
('Vokabeltest', 'Unit 4 lernen', '2024-05-12', 0, 2, 'Englisch', 2),
('Aufsatz', 'Interpretation Faust', '2024-05-15', 0, 3, 'Deutsch', 3),
('Laborbericht', 'Versuch zur Dichte', '2024-05-20', 1, 4, 'Physik', 4),
('Programmierung', 'Java Schleifen', '2024-05-25', 0, 5, 'Informatik', 5),
('Referat', 'Zweiter Weltkrieg', '2024-06-01', 0, 6, 'Geschichte', 6),
('Zeichnung', 'Selbstporträt', '2024-06-05', 0, 10, 'Kunst', 7),
('Formeln lernen', 'Oxidation/Reduktion', '2024-05-18', 1, 8, 'Chemie', 8),
('Lauftraining', '5km Vorbereitung', '2024-05-15', 0, 9, 'Sport', 9),
('Zellaufbau', 'Skizze einer Pflanzenzelle', '2024-05-22', 0, 6, 'Biologie', 10);
