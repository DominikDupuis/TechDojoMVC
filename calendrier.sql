-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2020 at 05:53 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendrier`
--

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `email`, `username`, `pass`, `type`) VALUES
(1, 'avpdom@gmail.com', 'Dominik', '$2y$10$PT0FG51YKQYR84EWasecEOzwfljn00NBjB024qkKZfCZjzEMT/utC', 'admin'),
(5, 'va@gmail.com', 'omo', '$2y$10$8hCFPxA61neCHOtUBA5pI.HwcVMijeIp8v0lAu.C4Eyw5jrMgmZO6', 'utilisateur'),
(6, 'baba@hotmail.com', 'baba', '$2y$10$uMlVOTn/TZaKSG2AdVVh4OanTMd7vqHdozOR4a04TtELBONCVirkq', 'utilisateur'),
(7, 'annieboulianne05@outlook.fr', 'Annie', '$2y$10$KvlhPfrt9eoiacMXzRuPe.AQCjAjgUclXnOFC5GPYxBPX5KIS.PuC', 'utilisateur'),
(8, 'bobby@gmail.com', 'Robert', '$2y$10$UgW0hak.caSRyrlKZ3B2S.yqobtDJzGMhpCvhcLfXQ0Gn9R1is0UK', 'utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateRdv` date NOT NULL,
  `ClientID` int(11) NOT NULL,
  `Statut` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ClientID` (`ClientID`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`id`, `dateRdv`, `ClientID`, `Statut`) VALUES
(1, '2020-05-27', 1, 'À venir'),
(2, '2020-05-27', 1, 'À venir'),
(9, '2020-05-14', 1, 'À venir'),
(10, '2020-05-14', 1, 'À venir'),
(11, '2020-05-14', 1, 'À venir'),
(12, '2020-05-29', 1, 'À venir'),
(13, '2020-05-28', 1, 'À venir'),
(15, '2020-05-22', 1, 'À venir'),
(16, '2020-05-18', 1, 'À venir'),
(17, '2020-05-25', 1, 'À venir'),
(20, '2020-05-26', 1, 'À venir'),
(21, '2020-05-29', 1, 'À venir'),
(35, '2020-05-29', 1, 'À venir'),
(60, '2020-05-29', 1, 'À venir'),
(103, '2020-05-21', 8, 'À venir'),
(104, '2020-05-26', 8, 'À venir'),
(107, '2020-05-21', 1, 'À venir'),
(123, '2020-03-16', 1, 'Complété'),
(124, '2020-05-15', 1, 'À venir'),
(125, '2020-05-15', 6, 'À venir'),
(126, '2020-05-22', 8, 'À venir');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
