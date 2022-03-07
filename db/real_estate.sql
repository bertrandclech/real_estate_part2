-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 06 mars 2022 à 19:07
-- Version du serveur : 5.7.37
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `real_estate`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

DROP TABLE IF EXISTS `advert`;
CREATE TABLE IF NOT EXISTS `advert` (
  `id_advert` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `reservation_message` text,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_advert`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id_advert`, `title`, `description`, `postcode`, `city`, `price`, `reservation_message`, `category_id`, `created_at`) VALUES
(10, 'fdgdfdf', 'dfgdfgd', '21111', 'dqsdssdq', 214500, 'disponible', 2, '2022-01-05 12:30:20'),
(11, 'maison le titre', 'la description', '25000', 'dijax', 125000, NULL, 2, '2022-01-05 12:30:20'),
(12, 'dsq', 'dqsdqs', '54545', 'dqdqd', 544554, NULL, 1, '2022-01-05 12:30:20'),
(13, 'dqsd', 'dddds', '65444', 'fdsfsdfd', 545454, NULL, 1, '2022-01-05 12:30:20'),
(14, 'sdds', 'ssdsdqsd', '65566', 'sffdfds', 656565, NULL, 2, '2022-01-05 12:30:20');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(30) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `value`) VALUES
(1, 'vente'),
(2, 'Location');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `advert_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
