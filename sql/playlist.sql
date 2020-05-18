-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 02 mars 2020 à 17:00
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `name`, `year`, `artist_id`) VALUES
(1, 'Lucky Jim', 1993, 6),
(5, 'Fire of Love', 1981, 6),
(8, 'The Doors', 1967, 15),
(10, 'The Stooges', 1969, 3),
(13, 'Funhouse', 1970, 3),
(42, 'Brothers In Arms', 1985, 42),
(49, 'Dire Straits', 1978, 42),
(69, 'Doolittle', 1989, 54);

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `biography` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`) VALUES
(3, 'The Stooges', 'Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus.'),
(6, 'The Gun Club', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien.'),
(15, 'The Doors', 'Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.'),
(33, 'Pink Floyd', 'Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'),
(42, 'Dire Straits', 'Fusce vulputate sem at sapien. Vivamus leo. Aliquam libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo.'),
(54, 'Pixies', 'Praesent blandit odio eu enim.');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist_id`, `album_id`) VALUES
(18, 'She\'s like Heroin to Me', 6, 5),
(24, 'Hey', 54, 69),
(25, 'No Fun', 3, 10),
(38, 'Money For Nothing', 42, 42),
(56, 'Break on Through (To the other side)', 15, 8),
(63, 'Gouge Away', 54, 69),
(76, 'Light My Fire', 15, 8),
(98, 'Sex Beat', 6, 5),
(122, 'Sultans of Swing', 42, 49),
(344, 'I Wanna Be Your Dog', 3, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
