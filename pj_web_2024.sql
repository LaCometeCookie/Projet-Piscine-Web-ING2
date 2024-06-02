-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 mai 2024 à 12:29
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pj web 2024`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `ID_connexion` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`ID`, `Nom`, `Prenom`, `Mail`, `mdp`, `ID_connexion`) VALUES
(2, 'Andriamanga', 'Andy', 'andriamanga.andy@gmail.com', 'Andy*2004', 400653933),
(13, 'Boutevin', 'Côme', 'come.boutevin@gmail.com', 'Come*2003', 132567655);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Cvitale` varchar(255) NOT NULL,
  `Paiement` varchar(255) NOT NULL,
  `ID_connexion` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID`, `Nom`, `Prenom`, `Mail`, `mdp`, `Adresse`, `Cvitale`, `Paiement`, `ID_connexion`) VALUES
(5, 'Lugagne', 'Justin', 'paris.michel@medicare.com', 'Justin*2003', '14 rue sextius michel', '10306012145', 'visa', 776488339),
(89, 'Chose', 'Truc', 'chose.truc@medicare.com', 'Chose*Truc', '13 rue machin', '10234677148', 'visa', 776487835);

-- --------------------------------------------------------

--
-- Structure de la table `labos`
--

DROP TABLE IF EXISTS `labos`;
CREATE TABLE IF NOT EXISTS `labos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Salle` varchar(255) NOT NULL,
  `telephone` int(12) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Service1` varchar(255) NOT NULL,
  `Service2` varchar(255) NOT NULL,
  `Service3` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `labos`
--

INSERT INTO `labos` (`ID`, `Nom`, `Adresse`, `Salle`, `telephone`, `Mail`, `Service1`, `Service2`, `Service3`) VALUES
(1, 'Paris', '14 rue sextius michel', 'EM226', 146532584, 'paris.michel@medicare.com', 'covid', 'biologie_femme', 'gynecologie'),
(2, 'Pollux', '35 Quai de Grenelle', 'P103', 146538463, 'paris.pollux@medicare.com', 'biologie_prev', 'biologie_femme', 'cencerologie');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

DROP TABLE IF EXISTS `medecins`;
CREATE TABLE IF NOT EXISTS `medecins` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `telephone` int(12) NOT NULL,
  `CV` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `ID_connexion` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`ID`, `Nom`, `Prenom`, `specialite`, `Mail`, `mdp`, `telephone`, `CV`, `photo`, `ID_connexion`) VALUES
(4, 'Ho', 'Kimi', 'addictologie', 'paris.pollux@medicare.com', 'Kimi*2004', 614121315, 'oui', 'non', NULL),
(51, 'Ribaute', 'Maxence', 'psychiatrie', 'maxence.ribaute@medicare.com', 'Maxence*2004', 614131215, 'oui', 'non', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Patient` varchar(255) NOT NULL,
  `Docteur` varchar(255) NOT NULL,
  `Date_prise` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
