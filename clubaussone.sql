-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 nov. 2023 à 15:46
-- Version du serveur : 8.0.33
-- Version de PHP : 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clubaussone`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `idAdherent` int NOT NULL AUTO_INCREMENT,
  `nomAdherent` char(32) NOT NULL,
  `prenomAdherent` char(32) NOT NULL,
  `ageAdherent` int NOT NULL,
  `sexeAdherent` char(1) NOT NULL,
  `loginAdherent` char(20) NOT NULL,
  `pwdAdherent` char(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idAdherent`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`idAdherent`, `nomAdherent`, `prenomAdherent`, `ageAdherent`, `sexeAdherent`, `loginAdherent`, `pwdAdherent`) VALUES
(1, 'Dupont', 'Pierre', 8, 'F', 'a', '0cc175b9c0f1b6a831c399e269772661'),
(2, 'Dubois', 'Vincent', 10, 'M', 'vDubois', 'b6c7790658f2cabc77cfb445f3530cf4'),
(3, 'Durant', 'Jacques', 6, 'M', 'jDurant', '01e8e31b6f11b0872c662c306b3e87c9'),
(4, 'Fleur', 'Sophie', 7, 'F', 'sFleur', '520a72f041586acdeb770d35388ce6c4');

-- --------------------------------------------------------

--
-- Structure de la table `adherentequipe`
--

DROP TABLE IF EXISTS `adherentequipe`;
CREATE TABLE IF NOT EXISTS `adherentequipe` (
  `idEquipe` int NOT NULL,
  `idAdherent` int NOT NULL,
  KEY `idEquipe` (`idEquipe`,`idAdherent`),
  KEY `idAdherent` (`idAdherent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `adherentequipe`
--

INSERT INTO `adherentequipe` (`idEquipe`, `idAdherent`) VALUES
(1, 2),
(2, 3),
(2, 4),
(3, 1),
(4, 1);

--
-- Déclencheurs `adherentequipe`
--
DROP TRIGGER IF EXISTS `nbEquipeAdherent`;
DELIMITER $$
CREATE TRIGGER `nbEquipeAdherent` BEFORE INSERT ON `adherentequipe` FOR EACH ROW BEGIN
DECLARE resultat int DEFAULT 0;
DECLARE resultat2 int DEFAULT 0;
DECLARE nbPlace int DEFAULT 0;
SET resultat = (Select COUNT(adherentequipe.idAdherent)
                from adherentequipe
                where adherentequipe.idAdherent = new.idAdherent);

	if resultat = 3 THEN
    	SIGNAL SQLSTATE '10001'
        SET MESSAGE_TEXT = 'Pas plus de 3';
    END if;
    
SET resultat2 = (SELECT COUNT(adherentequipe.idAdherent)
                FROM adherentequipe
                where adherentequipe.idEquipe = new.idEquipe
               );
               
SET nbPlace = (Select equipe.nbrPlaceEquipe
              FROM equipe
              where equipe.idEquipe = new.idEquipe
              );
               
	if resultat2 >= nbPlace THEN
    	    	SIGNAL SQLSTATE '10004'
        SET MESSAGE_TEXT = 'Nombre de place atteinte';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `nomAdmin` char(32) NOT NULL,
  `prenomAdmin` char(32) NOT NULL,
  `loginAdmin` char(20) NOT NULL,
  `pwdAdmin` char(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `nomAdmin`, `prenomAdmin`, `loginAdmin`, `pwdAdmin`) VALUES
(1, 'LeFirst', 'Vincent', 'admin', '0cc175b9c0f1b6a831c399e269772661'),
(2, 'LeSecond', 'Pierre', 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Structure de la table `competent`
--

DROP TABLE IF EXISTS `competent`;
CREATE TABLE IF NOT EXISTS `competent` (
  `idEntraineur` int NOT NULL,
  `idSpecialite` int NOT NULL,
  KEY `fk_competent_entraineurSpecialite` (`idEntraineur`,`idSpecialite`),
  KEY `idSpecialite` (`idSpecialite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `competent`
--

INSERT INTO `competent` (`idEntraineur`, `idSpecialite`) VALUES
(1, 3),
(1, 4),
(1, 5),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entraineur`
--

DROP TABLE IF EXISTS `entraineur`;
CREATE TABLE IF NOT EXISTS `entraineur` (
  `idEntraineur` int NOT NULL AUTO_INCREMENT,
  `nomEntraineur` char(32) NOT NULL,
  `loginEntraineur` char(20) NOT NULL,
  `pwdEntraineur` char(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entraineur`
--

INSERT INTO `entraineur` (`idEntraineur`, `nomEntraineur`, `loginEntraineur`, `pwdEntraineur`) VALUES
(1, 'Delbert', 'Delbert', '0cc175b9c0f1b6a831c399e269772661'),
(2, 'Dubois', 'Dubois', '2da1fecc769db814efa8c4568a801ed3'),
(3, 'Bousquet', 'Bousquet', '3938b2f3fd8ef725d61e8f92c7dee52b');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `idEquipe` int NOT NULL AUTO_INCREMENT,
  `nomEquipe` char(32) NOT NULL,
  `nbrPlaceEquipe` int NOT NULL,
  `ageMinEquipe` int NOT NULL,
  `ageMaxEquipe` int NOT NULL,
  `sexeEquipe` char(1) NOT NULL,
  `idEntraineur` int NOT NULL,
  `idSport` int NOT NULL,
  PRIMARY KEY (`idEquipe`),
  KEY `fk_equipe_entraineur` (`idEntraineur`),
  KEY `fk_equipe_sport` (`idSport`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `nomEquipe`, `nbrPlaceEquipe`, `ageMinEquipe`, `ageMaxEquipe`, `sexeEquipe`, `idEntraineur`, `idSport`) VALUES
(1, 'Les daulphins volants', 1, 5, 8, 'F', 3, 1),
(2, 'Les footeux', 20, 10, 12, 'F', 2, 2),
(3, 'BriqueCasse', 10, 5, 8, 'F', 1, 3),
(4, 'FunPoney', 10, 5, 8, 'F', 1, 4),
(5, 'VolleyTeam', 10, 5, 8, 'F', 1, 5);

--
-- Déclencheurs `equipe`
--
DROP TRIGGER IF EXISTS `Entraineur`;
DELIMITER $$
CREATE TRIGGER `Entraineur` BEFORE INSERT ON `equipe` FOR EACH ROW BEGIN
    DECLARE resultat int DEFAULT 0;
    SET resultat = (Select COUNT(equipe.nomEquipe)
                    from equipe
                    where equipe.idEntraineur = new.idEntraineur);

	if resultat > 3 THEN
    	SIGNAL SQLSTATE '10002'
        SET MESSAGE_TEXT = 'Pas plus de 3 Entraineurs';
    END if;
    
    SET resultat = (Select COUNT(*)
                    FROM competent
                    where competent.idEntraineur = new.idEntraineur and competent.idSpecialite = new.idSport);
                    
                   
    if resultat = 0 THEN
    	    	SIGNAL SQLSTATE '10003'
        SET MESSAGE_TEXT = "L'entraineur n'est pas compétent";
    END if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `genretheme`
--

DROP TABLE IF EXISTS `genretheme`;
CREATE TABLE IF NOT EXISTS `genretheme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genretheme`
--

INSERT INTO `genretheme` (`id`, `genre`) VALUES
(1, 'Sport'),
(2, 'Culture');

-- --------------------------------------------------------

--
-- Structure de la table `logaction`
--

DROP TABLE IF EXISTS `logaction`;
CREATE TABLE IF NOT EXISTS `logaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `loginUtilisateur` varchar(20) NOT NULL,
  `roleUtilisateur` int NOT NULL,
  `dateConnexion` date NOT NULL,
  `actionUtilisateur` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `logaction`
--

INSERT INTO `logaction` (`id`, `loginUtilisateur`, `roleUtilisateur`, `dateConnexion`, `actionUtilisateur`) VALUES
(1, 'admin', 1, '2003-10-23', 'Connexion'),
(2, 'admin', 1, '2024-11-23', 'Connexion'),
(3, 'admin', 1, '2024-11-23', 'Connexion'),
(4, 'admin', 1, '2024-11-23', 'Connexion'),
(5, 'admin', 1, '2024-11-23', 'Connexion'),
(6, 'admin', 1, '2024-11-23', 'Connexion');

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `idSport` int NOT NULL,
  `libelle` varchar(32) NOT NULL,
  PRIMARY KEY (`idSport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`idSport`, `libelle`) VALUES
(1, 'natation'),
(2, 'foot'),
(3, 'judo'),
(4, 'equitation'),
(5, 'volley'),
(6, 'athletisme'),
(7, 'moto-cross'),
(8, 'natation');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dateParution` date DEFAULT NULL,
  `description` varchar(80) NOT NULL,
  `genretheme` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genretheme` (`genretheme`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `dateParution`, `description`, `genretheme`) VALUES
(1, '2023-09-05', 'La vidéothèque va bientot ouvrir.', 2),
(2, '2023-09-20', '10% de réduction sur le pass cinéma pour les mineurs.', 2),
(3, '2023-09-08', 'Le club de Boxe ouvrira le 7 Décembre 2023.', 1),
(4, '2023-09-06', 'Petite plage party ?', 1);

-- --------------------------------------------------------

--
-- Structure de la table `titulaire`
--

DROP TABLE IF EXISTS `titulaire`;
CREATE TABLE IF NOT EXISTS `titulaire` (
  `idEntraineur` int NOT NULL,
  `dateEmbauche` date NOT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `titulaire`
--

INSERT INTO `titulaire` (`idEntraineur`, `dateEmbauche`) VALUES
(1, '2022-10-10'),
(3, '2020-10-12');

-- --------------------------------------------------------

--
-- Structure de la table `vacataire`
--

DROP TABLE IF EXISTS `vacataire`;
CREATE TABLE IF NOT EXISTS `vacataire` (
  `idEntraineur` int NOT NULL,
  `telephoneVacataire` char(14) NOT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vacataire`
--

INSERT INTO `vacataire` (`idEntraineur`, `telephoneVacataire`) VALUES
(2, '06.25.45.12.15');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherentequipe`
--
ALTER TABLE `adherentequipe`
  ADD CONSTRAINT `adherentequipe_ibfk_1` FOREIGN KEY (`idAdherent`) REFERENCES `adherent` (`idAdherent`),
  ADD CONSTRAINT `adherentequipe_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Contraintes pour la table `competent`
--
ALTER TABLE `competent`
  ADD CONSTRAINT `competent_ibfk_1` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`),
  ADD CONSTRAINT `competent_ibfk_2` FOREIGN KEY (`idSpecialite`) REFERENCES `sport` (`idSport`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`),
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`idSport`) REFERENCES `sport` (`idSport`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
