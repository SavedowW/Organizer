CREATE DATABASE IF NOT EXISTS organizer;

USE organizer;

DROP TABLE IF EXISTS `task`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `rights`;

CREATE TABLE `rights` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(45) DEFAULT NULL
);

CREATE TABLE `user` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Login` varchar(45) UNIQUE NOT NULL,
  `Password` varchar(60) NOT NULL,
  `RightsID` int NOT NULL,
  FOREIGN KEY (`RightsID`) REFERENCES `rights` (`ID`)
);

CREATE TABLE `task` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserID` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `CreationDate` DATE,
  `Deadline` DATE,
  `Priority` int NOT NULL,
  `StartDate` DATE,  
  FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`)
);

Insert into `rights` (Name)
  values('Host'),
  ('Admin'),
  ('User');

Insert into `user` (Login, Password, RightsID)
  values ("admin@gmail.com", "admin", 2);

INSERT INTO `task` (UserID, Name, Description, CreationDate, Deadline, Priority, StartDate) VALUES
  (1, "Ride wife", "Life good", CURDATE(), "2022-11-15", 2, "2022-11-14"),
  (1, "Wife fight back", "Kill wife", CURDATE(), "2022-11-16", 3, "2022-11-15"),
  (1, "Think about wife", "Regret", CURDATE(), "2022-11-17", 1, "2022-11-16");