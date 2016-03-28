-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 28 Mars 2016 à 22:04
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_rss_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `fluxrss`
--

CREATE TABLE `fluxrss` (
  `ID` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `numuser` int(11) NOT NULL,
  `fluxdate` datetime NOT NULL,
  `stateflux` enum('activated','desactivated','erase') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rssarticle`
--

CREATE TABLE `rssarticle` (
  `articleID` int(255) NOT NULL,
  `fluxID` int(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `articlelink` varchar(1000) NOT NULL,
  `articledate` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `statearticle` enum('activated','desactivated','erase') NOT NULL,
  `numuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `pwd` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `fluxrss`
--
ALTER TABLE `fluxrss`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`numuser`);

--
-- Index pour la table `rssarticle`
--
ALTER TABLE `rssarticle`
  ADD PRIMARY KEY (`articleID`),
  ADD KEY `FluxrssID` (`fluxID`),
  ADD KEY `userID` (`numuser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fluxrss`
--
ALTER TABLE `fluxrss`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rssarticle`
--
ALTER TABLE `rssarticle`
  MODIFY `articleID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
