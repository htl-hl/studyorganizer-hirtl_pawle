use Stundenplan;

INSERT INTO Lehrer (Vorname, Nachname, Kuerzel, Aktiv) VALUES 
('Max', 'Mustermann', 'MUM', 1), ('Erika', 'Schmidt', 'SME', 1),
('Hans', 'Gruber', 'GRU', 1), ('Julia', 'Meier', 'MEJ', 1),
('Peter', 'Lustig', 'LUP', 0), ('Sarah', 'Kohl', 'KOS', 1),
('Bernd', 'Brot', 'BRB', 1), ('Monika', 'Bauer', 'BAM', 1),
('Klaus', 'Klein', 'KLK', 0), ('Petra', 'Pan', 'PAP', 1);


INSERT INTO Faecher (F_Name) VALUES 
('Mathematik'), ('Deutsch'), ('Englisch'), ('Physik'), ('Informatik'),
('Biologie'), ('Geschichte'), ('Chemie'), ('Sport'), ('Kunst');


INSERT INTO Lehrer_hat_Fach (LHF_F_Name, LHF_L_ID) VALUES
-- Max Mustermann
('Deutsch', 1),
('Geschichte', 1),
-- Erika Schmidt
('Biologie', 2),
('Chemie', 2),
-- Hans Gruber
('Informatik', 3),
('Mathematik', 3),
-- Julia Meier
('Englisch', 4),
('Deutsch', 4),
-- Peter Lustig
('Physik', 5),
('Chemie', 5),
-- Sarah Kohl
('Kunst', 6),
('Geschichte', 6),
-- Bernd Brot
('Sport', 7),
('Biologie', 7),
-- Monika Bauer
('Mathematik', 8),
('Englisch', 8),
-- Klaus Klein
('Informatik', 9),
('Physik', 9),
-- Petra Pan
('Kunst', 10),
('Sport', 10);


INSERT INTO User (Password) VALUES 
('hash_123'), ('secure_pw'), ('admin_2024'), ('pass_word'), ('student_pw'),
('geheim123'), ('abcd_efg'), ('qwertz_789'), ('user_pass'), ('let_me_in');


INSERT INTO Aufgaben (Titel, Beschreibung, Faelligkeitsdatum, Erledigt, L_ID, F_Name, U_ID) VALUES 
('Hausaufgabe 1', 'S. 42 Nr. 1-3', '2024-05-10', 0, 1, 'Mathematik', 1),
('Vokabeltest', 'Unit 4 lernen', '2026-05-12', 0, 2, 'Englisch', 2),
('Aufsatz', 'Interpretation Faust', '2024-05-15', 0, 3, 'Deutsch', 3),
('Laborbericht', 'Versuch zur Dichte', '2024-05-20', 1, 4, 'Physik', 4),
('Programmierung', 'Java Schleifen', '2026-03-15', 0, 5, 'Informatik', 5),
('Referat', 'Zweiter Weltkrieg', '2024-06-01', 0, 6, 'Geschichte', 6),
('Zeichnung', 'Selbstporträt', '2026-03-27', 0, 10, 'Kunst', 7),
('Formeln lernen', 'Oxidation/Reduktion', '2024-05-18', 1, 8, 'Chemie', 8),
('Lauftraining', '5km Vorbereitung', '2026-03-15', 0, 9, 'Sport', 9),
('Zellaufbau', 'Skizze einer Pflanzenzelle', '2024-05-22', 0, 6, 'Biologie', 10);
