-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 mai 2023 à 13:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `motion_case`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `GetItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetItems` ()   SELECT * FROM `coque` 
JOIN `motif` ON coque.Id_motif = motif.Id_motif 
JOIN `modele` ON coque.Id_modele = modele.Id_modele$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `Id_Coque` int NOT NULL,
  `Id_couleur` int NOT NULL,
  PRIMARY KEY (`Id_Coque`,`Id_couleur`),
  KEY `Appartient_Couleur0_FK` (`Id_couleur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`Id_Coque`, `Id_couleur`) VALUES
(1, 1),
(2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

DROP TABLE IF EXISTS `archives`;
CREATE TABLE IF NOT EXISTS `archives` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coque`
--

DROP TABLE IF EXISTS `coque`;
CREATE TABLE IF NOT EXISTS `coque` (
  `Id_Coque` int NOT NULL AUTO_INCREMENT,
  `Prix` decimal(15,2) NOT NULL,
  `Marque` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'MotionCase',
  `description` longtext,
  `Id_motif` int NOT NULL,
  `Id_modele` int NOT NULL,
  PRIMARY KEY (`Id_Coque`),
  KEY `Id_Coque_Motif_FK` (`Id_motif`),
  KEY `Id_Coque_Modele0_FK` (`Id_modele`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `coque`
--

INSERT INTO `coque` (`Id_Coque`, `Prix`, `Marque`, `description`, `Id_motif`, `Id_modele`) VALUES
(1, '10.00', 'MotionCase', 'Coque avec un style neutre de toute beauté', 6, 1),
(2, '12.00', 'MotionCase', 'Coque avec un style naruto majestueuse ', 1, 3),
(11, '17.00', 'MotionCase', NULL, 4, 8),
(14, '33.00', 'MotionCase', NULL, 9, 2),
(15, '5.00', 'MotionCase', NULL, 2, 2),
(16, '5.00', 'MotionCase', NULL, 2, 2),
(17, '20.00', 'MotionCase', NULL, 10, 7),
(18, '14.75', 'MotionCase', NULL, 11, 2),
(19, '12.00', 'MotionCase', 'Coque incroyable au motif one piece', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `Id_couleur` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_couleur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`Id_couleur`, `Nom`) VALUES
(1, 'Jaune'),
(2, 'Noir'),
(3, 'Rouge'),
(4, 'Rose'),
(5, 'Orange'),
(6, 'Vert'),
(7, 'Violet'),
(8, 'Bleu'),
(9, 'Marron'),
(10, 'Gris '),
(11, 'Blanc'),
(12, 'Transparent');

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `Id_modele` int NOT NULL AUTO_INCREMENT,
  `modele` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_modele`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`Id_modele`, `modele`) VALUES
(1, '14 Pro max'),
(2, '14 Pro '),
(3, '14 '),
(4, '13 Pro Max '),
(5, '13 Pro'),
(6, '13'),
(7, '13 Mini'),
(8, '12 Pro Max '),
(9, '12 Pro'),
(10, '12'),
(11, '11 Pro Max'),
(12, '11 Pro'),
(13, '11 '),
(14, 'Xs Max'),
(15, 'Xs '),
(16, 'X'),
(17, 'Xr '),
(18, '12 Mini');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

DROP TABLE IF EXISTS `motif`;
CREATE TABLE IF NOT EXISTS `motif` (
  `Id_motif` int NOT NULL AUTO_INCREMENT,
  `motif` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_motif`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `motif`
--

INSERT INTO `motif` (`Id_motif`, `motif`) VALUES
(1, 'Naruto'),
(2, 'One piece '),
(3, 'Disney'),
(4, 'Dragon Ball '),
(5, 'Animaux'),
(6, 'Neutre'),
(7, 'Basketball'),
(8, 'Football'),
(9, 'Star Wars'),
(10, 'Nature'),
(11, 'Harry Potter '),
(12, 'Marvel'),
(13, 'Artiste');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `Appartient_Couleur0_FK` FOREIGN KEY (`Id_couleur`) REFERENCES `couleur` (`Id_couleur`),
  ADD CONSTRAINT `Appartient_Id_Coque_FK` FOREIGN KEY (`Id_Coque`) REFERENCES `coque` (`Id_Coque`);

--
-- Contraintes pour la table `coque`
--
ALTER TABLE `coque`
  ADD CONSTRAINT `Id_Coque_Modele0_FK` FOREIGN KEY (`Id_modele`) REFERENCES `modele` (`Id_modele`),
  ADD CONSTRAINT `Id_Coque_Motif_FK` FOREIGN KEY (`Id_motif`) REFERENCES `motif` (`Id_motif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
