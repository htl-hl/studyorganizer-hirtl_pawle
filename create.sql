drop database if exists Stundenplan ;
Create database Stundenplan;
use Stundenplan;
create table User(
	U_ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Password varchar(255)
);
create table Lehrer(
	L_ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Vorname varchar (255),
	Nachname varchar (255),
	Kuerzel varchar (255),
	Status boolean
);
create table Faecher(
	F_Name varchar (255) Unique PRIMARY KEY
);
create table Lehrer_hat_Fach(
	LHF_F_Name varchar (255),
	LHF_L_ID int NOT NULL,
	FOREIGN KEY (LHF_F_Name) REFERENCES Faecher(F_Name),
	FOREIGN KEY (LHF_L_ID) REFERENCES Lehrer(L_ID),
	PRIMARY KEY (LHF_F_Name, LHF_L_ID)
);
create table Aufgaben(
	Aufgaben_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Titel varchar (255),
	Beschreibung varchar (255),
	Faelligkeitsdatum DATE,
	Erledigt boolean,
	L_ID int NOT NULL,
	F_Name varchar (255),
	U_ID int NOT NULL,
	FOREIGN KEY (L_ID) references Lehrer(L_ID),
	FOREIGN KEY (F_Name) references Faecher(F_Name),
	FOREIGN KEY (U_ID) references User(U_ID)
);