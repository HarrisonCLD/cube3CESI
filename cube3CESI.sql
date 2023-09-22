-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 22 sep. 2023 à 11:55
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cube3CESI`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `contenu` varchar(1000) NOT NULL,
  `auteur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `titre`, `categorie`, `contenu`, `auteur`) VALUES
(1, '1ère annonces :', 'Nouveau', 'blablablablablablablablablablablablablablabla', 'Directeur'),
(2, '2ème annonces :', 'New 2', 'eaezeazeoaze,azkld,qspifangomgqdfqomjbgneO', 'Directeur');

-- --------------------------------------------------------

--
-- Structure de la table `congesPaye`
--

CREATE TABLE `congesPaye` (
  `id_congesPaye` int(11) NOT NULL,
  `debutCP` date NOT NULL,
  `finCP` date NOT NULL,
  `statut_CP` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `congesPaye`
--

INSERT INTO `congesPaye` (`id_congesPaye`, `debutCP`, `finCP`, `statut_CP`) VALUES
(2, '2023-02-16', '2023-02-18', NULL),
(3, '2023-02-16', '2023-02-18', NULL),
(4, '2023-02-16', '2023-02-18', NULL),
(5, '2023-02-16', '2023-02-18', NULL),
(6, '2023-02-16', '2023-02-18', NULL),
(7, '2023-02-16', '2023-02-18', NULL),
(8, '2023-02-16', '2023-02-18', NULL),
(9, '2023-02-16', '2023-02-18', NULL),
(10, '2023-02-16', '2023-02-18', NULL),
(11, '2023-02-16', '2023-02-18', NULL),
(12, '2023-02-16', '2023-02-18', NULL),
(13, '2023-02-16', '2023-02-18', NULL),
(14, '2023-01-01', '2023-01-08', NULL),
(15, '2023-01-01', '2023-01-08', NULL),
(16, '2023-01-01', '2023-01-08', NULL),
(17, '2023-01-01', '2023-01-08', NULL),
(18, '2023-01-01', '2023-01-08', NULL),
(19, '2023-01-01', '2023-01-08', NULL),
(20, '2023-01-01', '2023-01-08', NULL),
(21, '2023-01-01', '2023-01-08', NULL),
(22, '2023-01-01', '2023-01-08', NULL),
(23, '2023-01-01', '2023-01-08', NULL),
(24, '2023-01-01', '2023-01-08', NULL),
(25, '2023-01-01', '2023-01-08', NULL),
(26, '2023-01-01', '2023-01-08', NULL),
(27, '2023-01-01', '2023-01-08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id_horaires` int(11) NOT NULL,
  `employé` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id_horaires`, `employé`, `date`) VALUES
(4, 'azezaeza', '2023-09-21 16:37:47'),
(5, 'ibeazez', '2023-09-22 12:19:19');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `numeroDeBadge` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nomDeCompte` varchar(100) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `statut` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `numeroDeBadge`, `email`, `nom`, `prenom`, `nomDeCompte`, `motDePasse`, `statut`) VALUES
(21, '123456', 'ezaeaz', 'ezezaeaz', 'razraraq', 'eaeazea', '$2y$10$Yr8XcIWGjkXt5uCavcWiVOuL3nMa.x7Mvn9C286oDTSgKw1Wtf1cW', NULL),
(22, '102938', 'eaeazea', 'enfodsfn', 'ndfisufs', 'user', '$2y$10$CS6h6Lb6i31gODGcltlg2uk605zNFVWT5THo/psNNFFL0A7fGkqdK', 'user'),
(23, '123456', 'eaeaze', 'dqfqfqfqss', 'qfqsfsqfqf', 'admn', '$2y$10$vzuFvGEITxC8lfjKzD45RuLVkI4y.9KM8tCKauW8oUiBXNpNNrSxC', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`);

--
-- Index pour la table `congesPaye`
--
ALTER TABLE `congesPaye`
  ADD PRIMARY KEY (`id_congesPaye`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id_horaires`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `congesPaye`
--
ALTER TABLE `congesPaye`
  MODIFY `id_congesPaye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id_horaires` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
