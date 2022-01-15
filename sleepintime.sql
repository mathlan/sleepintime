-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 avr. 2021 à 15:21
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sleepintime`
--

-- --------------------------------------------------------

--
-- Structure de la table `sleep_db`
--

CREATE TABLE `sleep_db` (
  `id_sleep` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_sleep` date DEFAULT NULL,
  `time_sleep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_db`
--

CREATE TABLE `user_db` (
  `id_user` int(11) NOT NULL,
  `firstname_user` varchar(20) NOT NULL,
  `nickname_user` varchar(20) NOT NULL,
  `password_user` varchar(30) NOT NULL,
  `email_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sleep_db`
--
ALTER TABLE `sleep_db`
  ADD PRIMARY KEY (`id_sleep`),
  ADD KEY `FK_sleepuser` (`id_user`);

--
-- Index pour la table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sleep_db`
--
ALTER TABLE `sleep_db`
  MODIFY `id_sleep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sleep_db`
--
ALTER TABLE `sleep_db`
  ADD CONSTRAINT `FK_sleepuser` FOREIGN KEY (`id_user`) REFERENCES `user_db` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
