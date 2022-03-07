-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 07 mars 2022 à 17:19
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
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(150) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `mail`, `password`, `role`, `created_at`) VALUES
(9, 'test', 't@t.t', '$2y$12$Fx0fFmIATkwl6RIpAHAQ5uAMtdpdgKyRSAWY2oFrbNeTq0kmiV6LS', 0, '2022-03-07 15:20:20'),
(10, 'guillaume', 'g@g.g', '$2y$12$rNvRWZK.2hFefq32fNf99eUVUcuGUP1.W3IIdxCW9y5J7iZyG1gxW', 0, '2022-03-07 15:23:01'),
(11, 'testeur', 'test@email.fr', '$2y$12$I6BWBwOe6XvRc7e0EWnuWuZdSBbSgRPSxZ5ZN7rBjyHjcsVm0PIna', 0, '2022-03-07 15:24:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
