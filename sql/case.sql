-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  lun. 20 mars 2023 à 14:37
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `case`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `Id_Coque` int(11) NOT NULL,
  `Id_couleur` int(11) NOT NULL,
  PRIMARY KEY (`Id_Coque`,`Id_couleur`),
  KEY `Appartient_Couleur0_FK` (`Id_couleur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`Id_Coque`, `Id_couleur`) VALUES
(1, 1),
(2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `coque`
--

DROP TABLE IF EXISTS `coque`;
CREATE TABLE IF NOT EXISTS `coque` (
  `Id_Coque` int(11) NOT NULL AUTO_INCREMENT,
  `Prix` decimal(15,3) NOT NULL,
  `Marque` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'MotionCase',
  `Id_Motif` int(11) NOT NULL,
  `Id_Modele` int(11) NOT NULL,
  PRIMARY KEY (`Id_Coque`),
  KEY `Id_Coque_Motif_FK` (`Id_Motif`),
  KEY `Id_Coque_Modele0_FK` (`Id_Modele`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `coque`
--

INSERT INTO `coque` (`Id_Coque`, `Prix`, `Marque`, `Id_Motif`, `Id_Modele`) VALUES
(1, '10.000', 'MotionCase', 6, 1),
(2, '12.000', 'MotionCase', 1, 3),
(11, '17.000', 'MotionCase', 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `Id_couleur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_couleur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

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
  `Id_Modele` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Modele`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`Id_Modele`, `Nom`) VALUES
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
  `Id_Motif` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Motif`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `motif`
--

INSERT INTO `motif` (`Id_Motif`, `Nom`) VALUES
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
  ADD CONSTRAINT `Id_Coque_Modele0_FK` FOREIGN KEY (`Id_Modele`) REFERENCES `modele` (`Id_Modele`),
  ADD CONSTRAINT `Id_Coque_Motif_FK` FOREIGN KEY (`Id_Motif`) REFERENCES `motif` (`Id_Motif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
