-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 06 Juin 2018 à 08:12
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base_test_2018`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_activity`
--

CREATE TABLE `t_activity` (
  `id` int(16) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'nom activité',
  `date_create` datetime NOT NULL COMMENT 'date creation',
  `color` varchar(7) NOT NULL COMMENT '#FFFFFF',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'true = grp, false = solo',
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_cdi_horaire`
--

CREATE TABLE `t_cdi_horaire` (
  `id` int(11) NOT NULL,
  `jour` varchar(12) NOT NULL,
  `h_ouvert_m` time NOT NULL,
  `h_fermer_m` time NOT NULL,
  `h_ouvert_s` time NOT NULL,
  `h_fermer_s` time NOT NULL,
  `code` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_cdi_horaire`
--

INSERT INTO `t_cdi_horaire` (`id`, `jour`, `h_ouvert_m`, `h_fermer_m`, `h_ouvert_s`, `h_fermer_s`, `code`) VALUES
(1, 'lundi', '08:00:00', '12:00:00', '13:00:00', '17:00:00', 0),
(2, 'mardi', '08:00:00', '11:00:00', '15:00:00', '17:00:00', 1),
(3, 'mercredi', '08:00:00', '11:00:00', '15:00:00', '17:00:00', 2),
(4, 'jeudi', '08:00:00', '11:00:00', '15:00:00', '17:00:00', 3),
(5, 'vendredi', '09:00:00', '11:00:00', '15:00:00', '17:00:00', 4),
(6, 'samedi', '08:00:00', '11:00:00', '15:00:00', '17:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_division`
--

CREATE TABLE `t_division` (
  `id` int(11) NOT NULL,
  `nom` varchar(12) NOT NULL,
  `niveau` varchar(12) NOT NULL,
  `color` varchar(7) NOT NULL COMMENT '#FFFFFF',
  `ordre` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_eleve`
--

CREATE TABLE `t_eleve` (
  `id` int(16) NOT NULL,
  `last_name` varchar(100) NOT NULL COMMENT 'NOM',
  `first_name` varchar(100) NOT NULL COMMENT 'Prénom',
  `date_born` date DEFAULT NULL COMMENT 'date naissance',
  `city` varchar(100) NOT NULL COMMENT 'ville',
  `post_code` varchar(6) NOT NULL COMMENT 'code postale',
  `id_division` int(6) NOT NULL,
  `id_demigroupe` int(16) DEFAULT NULL COMMENT 'Demi-groupe'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_eleve_join_groupe`
--

CREATE TABLE `t_eleve_join_groupe` (
  `id` int(16) NOT NULL,
  `id_groupe` int(16) NOT NULL,
  `id_eleve` int(16) NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_groupe`
--

CREATE TABLE `t_groupe` (
  `id` int(16) NOT NULL,
  `name` varchar(256) NOT NULL COMMENT 'nom grp',
  `date_create` datetime NOT NULL COMMENT 'date creation',
  `color` varchar(7) NOT NULL DEFAULT '#EE00FF' COMMENT '#FFFFFF',
  `id_division` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_groupe_join_activity`
--

CREATE TABLE `t_groupe_join_activity` (
  `id` int(16) NOT NULL,
  `id_activity` int(16) NOT NULL,
  `id_groupe` int(16) NOT NULL,
  `date_prog` datetime NOT NULL COMMENT 'date_programmé',
  `duration` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_password`
--

CREATE TABLE `t_password` (
  `id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `default_pass` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_password`
--

INSERT INTO `t_password` (`id`, `password`, `default_pass`) VALUES
(6, 'Fq$1579s6$V8', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_registration`
--

CREATE TABLE `t_registration` (
  `id` int(16) NOT NULL COMMENT 'id',
  `id_eleve` int(16) NOT NULL,
  `id_activity` int(16) NOT NULL,
  `date_create` datetime NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'durée'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_activity`
--
ALTER TABLE `t_activity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `t_cdi_horaire`
--
ALTER TABLE `t_cdi_horaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_division`
--
ALTER TABLE `t_division`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `ordre` (`ordre`);

--
-- Index pour la table `t_eleve`
--
ALTER TABLE `t_eleve`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_division` (`id_division`),
  ADD KEY `id_demigroupe` (`id_demigroupe`);

--
-- Index pour la table `t_eleve_join_groupe`
--
ALTER TABLE `t_eleve_join_groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_groupe` (`id_groupe`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- Index pour la table `t_groupe`
--
ALTER TABLE `t_groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_division` (`id_division`);

--
-- Index pour la table `t_groupe_join_activity`
--
ALTER TABLE `t_groupe_join_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activity` (`id_activity`);

--
-- Index pour la table `t_password`
--
ALTER TABLE `t_password`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_registration`
--
ALTER TABLE `t_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_eleve` (`id_eleve`),
  ADD KEY `id_activity` (`id_activity`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_activity`
--
ALTER TABLE `t_activity`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_cdi_horaire`
--
ALTER TABLE `t_cdi_horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_division`
--
ALTER TABLE `t_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT pour la table `t_eleve`
--
ALTER TABLE `t_eleve`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3841;
--
-- AUTO_INCREMENT pour la table `t_eleve_join_groupe`
--
ALTER TABLE `t_eleve_join_groupe`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_groupe`
--
ALTER TABLE `t_groupe`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT pour la table `t_groupe_join_activity`
--
ALTER TABLE `t_groupe_join_activity`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_password`
--
ALTER TABLE `t_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_registration`
--
ALTER TABLE `t_registration`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_eleve`
--
ALTER TABLE `t_eleve`
  ADD CONSTRAINT `t_eleve_ibfk_1` FOREIGN KEY (`id_division`) REFERENCES `t_division` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_eleve_ibfk_2` FOREIGN KEY (`id_demigroupe`) REFERENCES `t_groupe` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_eleve_join_groupe`
--
ALTER TABLE `t_eleve_join_groupe`
  ADD CONSTRAINT `t_eleve_join_groupe_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `t_eleve` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_eleve_join_groupe_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `t_groupe` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_groupe`
--
ALTER TABLE `t_groupe`
  ADD CONSTRAINT `t_groupe_ibfk_1` FOREIGN KEY (`id_division`) REFERENCES `t_division` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_groupe_join_activity`
--
ALTER TABLE `t_groupe_join_activity`
  ADD CONSTRAINT `t_groupe_join_activity_ibfk_1` FOREIGN KEY (`id_activity`) REFERENCES `t_activity` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_registration`
--
ALTER TABLE `t_registration`
  ADD CONSTRAINT `t_registration_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `t_eleve` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_registration_ibfk_2` FOREIGN KEY (`id_activity`) REFERENCES `t_activity` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
