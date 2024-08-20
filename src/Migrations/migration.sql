-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2024 at 07:34 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agtc`
--

-- --------------------------------------------------------

--
-- Table structure for table `transport_commentaires`
--

DROP TABLE IF EXISTS `transport_commentaires`;
CREATE TABLE IF NOT EXISTS `transport_commentaires` (
  `Id_commentaire` int NOT NULL AUTO_INCREMENT,
  `Id_personel` int NOT NULL,
  `Id_vehicule` int NOT NULL,
  `texte` varchar(250) NOT NULL,
  `dtc` datetime NOT NULL,
  PRIMARY KEY (`Id_commentaire`),
  KEY `FK_transport_vehicules_TO_transport_commentaires` (`Id_vehicule`),
  KEY `FK_transport_personnel_TO_transport_commentaires` (`Id_personel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_etat`
--

DROP TABLE IF EXISTS `transport_etat`;
CREATE TABLE IF NOT EXISTS `transport_etat` (
  `Id_etat_vehicule` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_etat_vehicule`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transport_etat`
--

INSERT INTO `transport_etat` (`Id_etat_vehicule`, `nom`) VALUES
(1, 'circulation'),
(2, 'parking'),
(3, 'garage');

-- --------------------------------------------------------

--
-- Table structure for table `transport_evaluation`
--

DROP TABLE IF EXISTS `transport_evaluation`;
CREATE TABLE IF NOT EXISTS `transport_evaluation` (
  `Id_evaluation` int NOT NULL AUTO_INCREMENT,
  `texte` varchar(250) NOT NULL,
  `dtc` datetime NOT NULL,
  `Id_personel` int NOT NULL,
  `Id_personel_1` int NOT NULL,
  PRIMARY KEY (`Id_evaluation`),
  KEY `FK_transport_personnel_TO_transport_evaluation` (`Id_personel`),
  KEY `FK_transport_personnel_TO_transport_evaluation1` (`Id_personel_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_personnel`
--

DROP TABLE IF EXISTS `transport_personnel`;
CREATE TABLE IF NOT EXISTS `transport_personnel` (
  `Id_personel` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_arrive` date NOT NULL,
  `telephone` int NOT NULL,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `dtc` datetime NOT NULL,
  `Id_statut_personnels` int NOT NULL,
  `Id_role` int NOT NULL,
  PRIMARY KEY (`Id_personel`),
  KEY `FK_transport_statut_TO_transport_personnel` (`Id_statut_personnels`),
  KEY `FK_transport_roles_TO_transport_personnel` (`Id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transport_personnel`
--

INSERT INTO `transport_personnel` (`Id_personel`, `nom`, `prenom`, `date_arrive`, `telephone`, `email`, `mdp`, `dtc`, `Id_statut_personnels`, `Id_role`) VALUES
(1, 'admin', 'admin', '2024-08-20', 2147483647, 'admin@agtc.fr', '$2y$10$jED32m6q7EvYI0dHze9N8e.yY3sQ7sdSD38km/shhgrO/.znkR.P.', '2024-08-20 07:26:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transport_roles`
--

DROP TABLE IF EXISTS `transport_roles`;
CREATE TABLE IF NOT EXISTS `transport_roles` (
  `Id_role` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transport_roles`
--

INSERT INTO `transport_roles` (`Id_role`, `nom`) VALUES
(1, 'admin'),
(2, 'mecanicien'),
(3, 'conducteur');

-- --------------------------------------------------------

--
-- Table structure for table `transport_statut`
--

DROP TABLE IF EXISTS `transport_statut`;
CREATE TABLE IF NOT EXISTS `transport_statut` (
  `Id_statut_personnels` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`Id_statut_personnels`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transport_statut`
--

INSERT INTO `transport_statut` (`Id_statut_personnels`, `nom`, `date_debut`, `date_fin`) VALUES
(1, 'present', NULL, NULL),
(2, 'vacances', NULL, NULL),
(3, 'maladie', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transport_vehicules`
--

DROP TABLE IF EXISTS `transport_vehicules`;
CREATE TABLE IF NOT EXISTS `transport_vehicules` (
  `Id_vehicule` int NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date_ct` date NOT NULL,
  `km` int NOT NULL,
  `Id_etat_vehicule` int NOT NULL,
  PRIMARY KEY (`Id_vehicule`),
  KEY `FK_transport_etat_TO_transport_vehicules` (`Id_etat_vehicule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
