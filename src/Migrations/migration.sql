-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2024 at 09:27 AM
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
  `Id_personnel` int NOT NULL,
  `Id_vehicule` int NOT NULL,
  `texte` varchar(250) NOT NULL,
  `dtc` datetime NOT NULL,
  PRIMARY KEY (`Id_commentaire`),
  UNIQUE KEY `UQ_Id_commentaire` (`Id_commentaire`),
  KEY `FK_transport_vehicules_TO_transport_commentaires` (`Id_vehicule`),
  KEY `FK_transport_personnels_TO_transport_commentaires` (`Id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_etat`
--

DROP TABLE IF EXISTS `transport_etat`;
CREATE TABLE IF NOT EXISTS `transport_etat` (
  `Id_etat_vehicule` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_etat_vehicule`),
  UNIQUE KEY `UQ_Id_etat_vehicule` (`Id_etat_vehicule`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_etat`
--

INSERT INTO `transport_etat` (`Id_etat_vehicule`, `nom`) VALUES
(1, 'circulation'),
(2, 'parking'),
(3, 'garage');

-- --------------------------------------------------------

--
-- Table structure for table `transport_evaluations`
--

DROP TABLE IF EXISTS `transport_evaluations`;
CREATE TABLE IF NOT EXISTS `transport_evaluations` (
  `Id_evaluation` int NOT NULL AUTO_INCREMENT,
  `texte` varchar(250) NOT NULL,
  `dtc` datetime NOT NULL,
  `Id_admin` int NOT NULL,
  `Id_personnel` int NOT NULL,
  PRIMARY KEY (`Id_evaluation`),
  UNIQUE KEY `UQ_Id_evaluation` (`Id_evaluation`),
  KEY `FK_transport_personnels_TO_transport_evaluations` (`Id_admin`),
  KEY `FK_transport_personnels_TO_transport_evaluations1` (`Id_personnel`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_evaluations`
--

INSERT INTO `transport_evaluations` (`Id_evaluation`, `texte`, `dtc`, `Id_admin`, `Id_personnel`) VALUES
(25, 'dfgerer', '2024-08-22 16:57:51', 1, 3),
(26, 'dsd', '2024-08-23 10:11:07', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transport_personnels`
--

DROP TABLE IF EXISTS `transport_personnels`;
CREATE TABLE IF NOT EXISTS `transport_personnels` (
  `Id_personnel` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_arrive` date NOT NULL,
  `telephone` int NOT NULL,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `dtc` datetime NOT NULL,
  `Id_role` int NOT NULL,
  PRIMARY KEY (`Id_personnel`),
  UNIQUE KEY `UQ_Id_personnel` (`Id_personnel`),
  UNIQUE KEY `UQ_email` (`email`),
  KEY `FK_transport_roles_TO_transport_personnels` (`Id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_personnels`
--

INSERT INTO `transport_personnels` (`Id_personnel`, `nom`, `prenom`, `date_arrive`, `telephone`, `email`, `mdp`, `dtc`, `Id_role`) VALUES
(1, 'ss', 'feras', '2024-08-20', 2147483647, 'admin@agtc.fr', '$2y$10$jED32m6q7EvYI0dHze9N8e.yY3sQ7sdSD38km/shhgrO/.znkR.P.', '2024-08-20 07:26:12', 1),
(2, 'sss', 'sam', '2024-08-20', 47, 'conducteur@agtc.fr', '$2y$10$X6DmEq47ZGn37uxb.3YPne2DoHQnDv0zO1Sa973zXcuFSyC7LkZZa', '2024-08-20 11:22:37', 3),
(3, 'EF', 'joseph', '2024-08-20', 2147483647, 'mecanicien@agtc.fr', '$2y$10$fK/3c0A5eLbZa3AImV6gUeUi4RSF/xwBiCaYJcz0n4BC90XdQUADO', '2024-08-20 11:23:46', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transport_roles`
--

DROP TABLE IF EXISTS `transport_roles`;
CREATE TABLE IF NOT EXISTS `transport_roles` (
  `Id_role` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_role`),
  UNIQUE KEY `UQ_Id_role` (`Id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Id_statut` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_statut`),
  UNIQUE KEY `UQ_Id_status` (`Id_statut`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_statut`
--

INSERT INTO `transport_statut` (`Id_statut`, `nom`) VALUES
(1, 'present'),
(2, 'vacances'),
(3, 'maladie');

-- --------------------------------------------------------

--
-- Table structure for table `transport_statut_personnel`
--

DROP TABLE IF EXISTS `transport_statut_personnel`;
CREATE TABLE IF NOT EXISTS `transport_statut_personnel` (
  `Id_statut_personnels` int NOT NULL AUTO_INCREMENT,
  `Id_statut` int NOT NULL,
  `Id_personnel` int NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `dtc` datetime NOT NULL,
  PRIMARY KEY (`Id_statut_personnels`),
  UNIQUE KEY `UQ_Id_statut_personnels` (`Id_statut_personnels`),
  KEY `FK_transport_statut_TO_transport_statut_personnel` (`Id_statut`),
  KEY `FK_transport_personnels_TO_transport_statut_personnel` (`Id_personnel`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_statut_personnel`
--

INSERT INTO `transport_statut_personnel` (`Id_statut_personnels`, `Id_statut`, `Id_personnel`, `date_debut`, `date_fin`, `dtc`) VALUES
(22, 1, 1, '0000-00-00', '0000-00-00', '2024-08-23 10:10:53'),
(20, 1, 2, '0000-00-00', '0000-00-00', '2024-08-22 16:32:39'),
(19, 1, 1, '0000-00-00', '0000-00-00', '2024-08-22 16:32:25'),
(18, 1, 3, '0000-00-00', '0000-00-00', '2024-08-22 16:32:11');

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
  UNIQUE KEY `UQ_Id_vehicule` (`Id_vehicule`),
  KEY `FK_transport_etat_TO_transport_vehicules` (`Id_etat_vehicule`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_vehicules`
--

INSERT INTO `transport_vehicules` (`Id_vehicule`, `numero`, `type`, `date_ct`, `km`, `Id_etat_vehicule`) VALUES
(1, 'BUS001', 'bus', '2024-08-01', 10000, 1),
(2, 'BUS002', 'bus', '2024-08-02', 10500, 1),
(3, 'BUS003', 'bus', '2024-08-03', 11000, 1),
(4, 'BUS004', 'bus', '2024-08-04', 11500, 1),
(5, 'BUS005', 'bus', '2024-08-05', 12000, 1),
(6, 'BUS006', 'bus', '2024-08-06', 12500, 1),
(7, 'BUS007', 'bus', '2024-08-07', 13000, 1),
(8, 'BUS008', 'bus', '2024-08-08', 13500, 1),
(9, 'BUS009', 'bus', '2024-08-09', 14000, 1),
(10, 'BUS010', 'bus', '2024-08-10', 14500, 1),
(11, 'TRAM001', 'tram', '2024-08-11', 20000, 1),
(12, 'TRAM002', 'tram', '2024-08-12', 20500, 1),
(13, 'TRAM003', 'tram', '2024-08-13', 21000, 1),
(14, 'TRAM004', 'tram', '2024-08-14', 21500, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
