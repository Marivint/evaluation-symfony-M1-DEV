-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 déc. 2018 à 15:52
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony_yvann_marivint`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_crea` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `montre`
--

DROP TABLE IF EXISTS `montre`;
CREATE TABLE IF NOT EXISTS `montre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B61A93A4C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `montre`
--

INSERT INTO `montre` (`id`, `intitule`, `description`, `type_id`) VALUES
(3, 'LA SULLY - OR ROSE', 'montre', 3),
(4, 'LA SULLY OR ROSE - NOIR', 'montre', 2),
(5, 'BASTILLE B4.6 - PANDA BLEU', 'montre', 2),
(6, 'HORIZON - BLANC', 'MONTRE', 2),
(7, 'GR - BLEU OCEAN', 'montre', 2),
(8, 'test', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `intitule`) VALUES
(2, 'Type1'),
(3, 'Type2');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `date_crea` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `admin`, `date_crea`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$k5jbeEOzXKgna.b7azhtvexhsfRGveYJXlp8dJrLFJVjRjp.g/ZLq', 1, '2018-12-03'),
(2, 'utilisateur', 'utilisateur', 'utilisateur@gmail.com', '$2y$10$ohhhGLzUWjoa70.oklKOZ.l.ndQMlROuRUvxxoFAJtf0a37vrcc.C', 0, '2018-12-04');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_commande`
--

DROP TABLE IF EXISTS `utilisateur_commande`;
CREATE TABLE IF NOT EXISTS `utilisateur_commande` (
  `utilisateur_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  PRIMARY KEY (`utilisateur_id`,`commande_id`),
  KEY `IDX_70915FE2FB88E14F` (`utilisateur_id`),
  KEY `IDX_70915FE282EA2E54` (`commande_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `variante`
--

DROP TABLE IF EXISTS `variante`;
CREATE TABLE IF NOT EXISTS `variante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` double NOT NULL,
  `montres_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_474CE6B06EBDA8D5` (`montres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `variante`
--

INSERT INTO `variante` (`id`, `intitule`, `description`, `prix`, `montres_id`, `filename`) VALUES
(6, 'SULLY 1', 'SULLY 1', 10, 3, 'dafdbe5c467a96812574fe603862f80b.png'),
(7, 'SULLY NOIR 1', 'test', 10, 4, 'b7d4e56253efebb5747c9a91715ef525.png'),
(8, 'BLEU OCEAN 1', 'test', 10, 7, '6d2932adf4de064de8f43ee1e21cc914.png'),
(9, 'test', 'test', 10, 6, '9eb5a057cd12d6f4a5a3ad5e193947e6.png'),
(10, 'BASTILLE 4.6 1', 'test', 10, 5, 'd68012a385e019b1cbcde2aa1ff70ec4.png'),
(11, 'SULLY 2', 'montre', 10, 3, '17524df55a27ef58593dfc77b6928c97.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `montre`
--
ALTER TABLE `montre`
  ADD CONSTRAINT `FK_B61A93A4C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `utilisateur_commande`
--
ALTER TABLE `utilisateur_commande`
  ADD CONSTRAINT `FK_70915FE282EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_70915FE2FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `variante`
--
ALTER TABLE `variante`
  ADD CONSTRAINT `FK_474CE6B06EBDA8D5` FOREIGN KEY (`montres_id`) REFERENCES `montre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
