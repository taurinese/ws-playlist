-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 mai 2020 à 18:36
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `playlist`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `artist_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `albums_artist_id` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `name`, `year`, `artist_id`) VALUES
(2, 'Gros carton tia vu', 2020, 3),
(3, 'Classique de fou', 1987, 3),
(8, 'Classique de fou furieux', 2023, 5);

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `image`) VALUES
(3, 'Jul', 'Saint-Jean la Puenta', NULL),
(5, 'Bob Sinclar', 'ohlala l\'enchainement', '5.jpg'),
(10, 'Bobby', 'pourquoi pas', NULL),
(36, 'test pour test', 'zezezez', NULL),
(37, 'Maxibebou', 'Artiste de grande renommée tu connais ou pas', '37.jfif'),
(45, 'ukikiki', 'kiukiukiu', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `artists_labels`
--

DROP TABLE IF EXISTS `artists_labels`;
CREATE TABLE IF NOT EXISTS `artists_labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artists_labels_artist_id` (`artist_id`) USING BTREE,
  KEY `artists_labels_label_id` (`label_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists_labels`
--

INSERT INTO `artists_labels` (`id`, `artist_id`, `label_id`) VALUES
(4, 3, 4),
(5, 10, 4),
(6, 5, 5),
(11, 10, 5),
(50, 36, 4),
(51, 37, 6),
(52, 37, 7),
(62, 45, 6);

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `labels`
--

INSERT INTO `labels` (`id`, `name`) VALUES
(4, 'D\'Or et de Platine'),
(5, 'Sony Music France'),
(6, 'Meilleur label de France tu connais'),
(7, 'Label trop fortiche');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `songs_artist_id` (`artist_id`),
  KEY `songs_album_id` (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist_id`, `album_id`) VALUES
(1, 'C\'est rien c\'est la rue', 3, 2),
(5, 'test song', 3, NULL),
(8, 'Toi même t\'es au courant', 5, 3),
(10, 'test', 3, 2),
(11, 'Baby Shark', 37, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artists_labels`
--
ALTER TABLE `artists_labels`
  ADD CONSTRAINT `artists_labels_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artists_labels_label_id` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_album_id` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `songs_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
