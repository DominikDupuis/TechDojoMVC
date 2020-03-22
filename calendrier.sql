SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Entreprises` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `Email` VARCHAR(100) NOT NULL,
    `NomEntreprise` VARCHAR(100) NOT NULL,
    `Adresse` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`ID`)
);

CREATE TABLE IF NOT EXISTS `Dispos` (
    `EntrepriseID` INT NOT NULL,
    `Date` DATE NOT NULL,
    `HeureDebut` TIME DEFAULT NULL,
    `HeureFin` TIME DEFAULT NULL,
    FOREIGN KEY (`EntrepriseID`) REFERENCES Entreprises(`ID`)
);

CREATE TABLE IF NOT EXISTS `Clients` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `Email` VARCHAR(100) NOT NULL,
    `Nom` VARCHAR(100) NOT NULL,
    `Prenom` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`ID`)
);

CREATE TABLE IF NOT EXISTS `RDV` (
    `dateHeure` DATETIME NOT NULL,
    `ClientID` INT NOT NULL,
    `EntrepriseID` INT NOT NULL,
    FOREIGN KEY (`ClientID`) REFERENCES Clients(`ID`),
    FOREIGN KEY (`EntrepriseID`) REFERENCES Entreprises(`ID`)
);