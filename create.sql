drop database Studnenplan if exists;
Create database Stundenplan;
use Stundenplan;
create table  User (
    U_ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Password varchar(255);
);
