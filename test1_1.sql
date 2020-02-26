-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 26 fév. 2020 à 13:19
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test1.1`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles_especes`
--

DROP TABLE IF EXISTS `articles_especes`;
CREATE TABLE IF NOT EXISTS `articles_especes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticle` int(11) NOT NULL,
  `datepub` date NOT NULL,
  `idEspeces` int(11) NOT NULL,
  `numlike` int(11) NOT NULL,
  `idCat` int(11) NOT NULL,
  `Titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Contenu` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Especes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E20C8A1168D3EA09` (`User_id`),
  KEY `IDX_E20C8A1118D13FC9` (`Especes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `articles_especes`
--

INSERT INTO `articles_especes` (`id`, `IdArticle`, `datepub`, `idEspeces`, `numlike`, `idCat`, `Titre`, `Contenu`, `image`, `User_id`, `Especes_id`) VALUES
(6, 0, '2015-01-01', 0, 0, 0, 'aze', 'sdsada', 'bata.jpg', NULL, NULL),
(7, 0, '2015-01-01', 0, 0, 0, 'hjklm', 'jkl', 'bata.jpg', NULL, NULL),
(8, 0, '2015-01-01', 0, 0, 0, 'ghjk', 'ghjk', 'Deer-forest-trees-sun-rays-glare_m.jpg', NULL, NULL),
(9, 0, '2015-01-01', 0, 0, 0, 'fgjio', 'fghjklm', 'pech.jpg', NULL, NULL),
(10, 0, '2015-01-01', 0, 0, 0, 'fgjio', 'fghjklm', 'pech.jpg', NULL, NULL),
(11, 0, '2015-01-01', 0, 0, 0, 'aaa', 'aaa', 'hache.jpg', NULL, NULL),
(12, 0, '2015-01-01', 0, 0, 0, 'aaa', 'aaa', 'hache.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cadeau`
--

DROP TABLE IF EXISTS `cadeau`;
CREATE TABLE IF NOT EXISTS `cadeau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codecadeau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cadeau`
--

INSERT INTO `cadeau` (`id`, `codecadeau`) VALUES
(1, '123');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'Chasse', 'Chasse'),
(2, 'Peche', 'Peche');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_espece`
--

DROP TABLE IF EXISTS `categorie_espece`;
CREATE TABLE IF NOT EXISTS `categorie_espece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie_espece`
--

INSERT INTO `categorie_espece` (`id`, `nom`, `nom_image`) VALUES
(1, 'Peche', 'images.jpg'),
(3, 'Chasse', 'kitchasse.jpg'),
(4, 'azeaze', 'kitchasse.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prixtotal` double NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D29A5EC27` (`produit`),
  KEY `IDX_6EEAA67D8D93D649` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `produit`, `user`, `quantite`, `prixtotal`, `etat`, `pay`) VALUES
(3, 4, 7, 2, 500, 'Validé', 'Payée');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `article` int(11) DEFAULT NULL,
  `date_pub` date NOT NULL,
  `contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC8D93D649` (`user`),
  KEY `IDX_67F068BC23A0E66` (`article`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user`, `article`, `date_pub`, `contenu`) VALUES
(1, 2, 1, '2020-02-25', 'klmkhvjg'),
(2, 2, 1, '2020-02-25', 'kj'),
(3, 7, 6, '2020-02-25', 'dhfgftgvnhgfl'),
(4, 7, 5, '2020-02-25', 'ddgd');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idU` int(11) DEFAULT NULL,
  `idE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idU` (`idU`,`idE`),
  KEY `idE` (`idE`),
  KEY `IDX_2694D7A5B1BBBA33` (`idU`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id`, `etat`, `idU`, `idE`) VALUES
(48, 'valider', 12, 35),
(49, 'valider', 12, 20),
(50, 'valider', 7, 35),
(51, 'en cours1', 7, 20);

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A2A1B1497DD634` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`id`, `categorie`, `nom`, `type`, `description`, `nom_image`) VALUES
(1, 1, '7out', 'y3oum', 'neder', 'a1.jpg'),
(2, 1, 'aaaa', 'aaaa', 'aaaa', 'a4.jpg'),
(3, 3, 'azz', 'azz', 'azz', 'images.jpg'),
(4, 1, 'aee', 'aee', 'aee', 'kitchasse.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `chef_id` int(11) NOT NULL,
  `nom_evenement` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `heure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` mediumblob,
  `nom_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_event`),
  KEY `IDX_89D7EABD150A48F1` (`chef_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `chef_id`, `nom_evenement`, `adresse`, `date`, `description`, `heure`, `image`, `nom_image`) VALUES
(14, 7, 'peche', 'Bizerte', '2015-01-01', 'Participer à un évènement !', '01:00:00', NULL, 'images (1).jpg'),
(17, 7, 'chasse', 'Boumhal', '2015-01-01', 'oui oui je sais', '00:00:00', NULL, 'images.jpg'),
(18, 7, 'Peche 2', 'Mansoura', '2015-01-01', 'Bienvenue', '00:00:00', NULL, 'images (2).jpg'),
(19, 7, 'Chasse 2', 'Bouseelim', '2015-01-01', 'Evénement :)', '00:00:00', NULL, 'téléchargement.jpg'),
(20, 7, 'chasse5', 'Tuniss', '2021-01-01', 'hello', '18:00:00', NULL, 'f2.jpg'),
(32, 6, 'ppppp', '88888888', '2020-02-23', '8888888', '19:00:00', NULL, 'features-icon-2.png'),
(34, 11, 'testttt', 'azerty', '2020-02-21', 'uazerty', '00:00:00', NULL, 'certification-img-3.jpg'),
(35, 12, 'azertyuio', 'azertyuiop', '2020-02-29', 'azsdfghjklmù', '00:00:00', NULL, 'Accepter refuser demande.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `chef_id` int(11) NOT NULL,
  `nom_association` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `capital` int(11) NOT NULL,
  `image` mediumblob,
  `nom_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_event`),
  KEY `IDX_FA6F25A3150A48F1` (`chef_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `nom`, `prenom`, `img`, `nomImage`) VALUES
(2, 'anass', 'merai', NULL, 'bae.png');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formateur` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbrplace` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_404021BFED767E4F` (`formateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `formateur`, `nom`, `type`, `date`, `lieu`, `description`, `heure`, `nbrplace`, `img`, `nomImage`) VALUES
(1, 2, 'formationdepeche', 'Peche', '2020-02-29', 'aaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', '16:00:00', 4, NULL, 'animal.jpg'),
(2, 2, 'formation', 'Chasse', '2020-02-29', 'aaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', '06:00:00', 14, NULL, 'unnamed.jpg'),
(3, 2, 'Miraaco', 'Peche', '2020-02-25', 'jjjjjjjjjjjjjjjjjjjjjjjjj', 'fffffffffffffffffff', '04:00:00', 13, NULL, '561b33486f1e4bc55f46f7db0730885d.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datedenaissance` date DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `prenom`, `nom`, `datedenaissance`, `adresse`, `telephone`, `grade`) VALUES
(4, 'aze', 'aze', 'milimiti@hotmail.fr', 'milimiti@hotmail.fr', 1, NULL, '$2y$13$FzO8akXmu1H35UZu7aL4f.pN2ZsmVk6NnMFWQ6atgUnlaWYrm4uDq', '2020-02-26 11:07:21', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '', '', NULL, '', NULL, NULL),
(5, 'anass', 'anass', 'aze@a.a', 'aze@a.a', 1, NULL, '$2y$13$ykYfWt/vWGweSNAdGZqhueS9ITEvNf/rT8NkEX9Z5ilMPSVPE4AUi', '2020-02-09 19:40:32', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'anass', '', NULL, '', NULL, NULL),
(6, 'user', 'user', 'merai.miraco@gmil.com', 'merai.miraco@gmil.com', 1, NULL, '$2y$13$UVa2L6HuegkMT06.ofWQNuQ1stQwyv8NX4rcTAyq6xRizirICy3Cu', '2020-02-18 18:44:58', NULL, NULL, 'a:0:{}', 'user', '', NULL, '', NULL, NULL),
(7, 'aaaaa', 'aaaaa', 'anass.merai@esprit.tn', 'anass.merai@esprit.tn', 1, NULL, '$2y$13$6Kdspm3ICozq6gkB8arESOfcCxcgoEW39gV053CS0Q6PoBBfFZQJ.', '2020-02-26 11:05:26', NULL, NULL, 'a:0:{}', 'aaaaa', 'aaaaa', '2025-11-17', 'aaaaa', 9562, NULL),
(8, 'admin1', 'admin1', 'user@aze.aaze', 'user@aze.aaze', 1, NULL, '$2y$13$nscMxeWAHkIVj7G.oHx80OoQfos/CLWScJyGmJSVu5CEJLwhe8dme', '2020-02-12 20:58:05', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'admin1', 'admin1', '2017-12-16', 'mannouba', 8541254, NULL),
(9, 'user1', 'user1', '65651@aze.a', '65651@aze.a', 1, NULL, '$2y$13$zH9R05vW21yzEvhKULvy/ucVEn7v.gyVyfd.arcZswSaUncB3fD8q', '2020-02-17 20:47:39', NULL, NULL, 'a:0:{}', 'user1', 'user1', '2024-12-18', 'azeaaaaaa', 29119391, NULL),
(10, 'valid', 'valid', 'merai.miraco@gmail.com', 'merai.miraco@gmail.com', 1, NULL, '$2y$13$96jWTwwqMbLcRbHy1aIwUOnli47XnIysSyQb/C25GUU4CydgfbNTe', '2020-02-19 23:18:23', NULL, NULL, 'a:0:{}', 'validation', 'validation', '2016-02-20', 'aze', 2222222, NULL),
(11, 'testt', 'testt', 'mohamedamine.hechmi@esprit.tn', 'mohamedamine.hechmi@esprit.tn', 1, NULL, '$2y$13$hFW9mfHrhXsysfujrp5yku4L7Z.wk3FYfQY3mdpykTKr4Jy.FF/cO', '2020-02-20 10:23:27', NULL, NULL, 'a:0:{}', 'testt', 'testt', '2018-04-19', 'aze', 29119391, NULL),
(12, 'tess', 'tess', 'tesnime.ammar@esprit.tn', 'tesnime.ammar@esprit.tn', 1, NULL, '$2y$13$2xJpAiCMcJBr95jssrizd.MVstCx0SSpvsrYJNNQUVQRnGqZO5YKq', '2020-02-22 22:33:02', NULL, NULL, 'a:0:{}', 'tess', 'tess', '2015-06-06', 'aze', 9562, NULL),
(13, 'yass4', 'yass4', 'mohamedyassine.bennacef@esprit.tn', 'mohamedyassine.bennacef@esprit.tn', 1, NULL, '$2y$13$9HMIrH7qlrUkSJ47qlUBIuXcFhGClQzCVZP4zgxx.tdFcMQyvQHKi', '2020-02-26 10:57:46', NULL, NULL, 'a:0:{}', 'yassine', 'yassine', '2015-06-04', 'mannouba', 58709502, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nblike`
--

DROP TABLE IF EXISTS `nblike`;
CREATE TABLE IF NOT EXISTS `nblike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `article` int(11) DEFAULT NULL,
  `commentaire` int(11) DEFAULT NULL,
  `Likesnumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDE9740B8D93D649` (`user`),
  KEY `IDX_EDE9740B23A0E66` (`article`),
  KEY `IDX_EDE9740B26C8D099` (`Likesnumber`),
  KEY `IDX_EDE9740B67F068BC` (`commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `nblike`
--

INSERT INTO `nblike` (`id`, `user`, `article`, `commentaire`, `Likesnumber`) VALUES
(1, 2, 1, NULL, NULL),
(2, 7, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_parameters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `notification_date` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CA99B902AD` (`idu`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `idu`, `title`, `description`, `icon`, `route`, `route_parameters`, `notification_date`, `seen`) VALUES
(51, 5, 'nouveau demande de participation !', 'tess', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"35\";s:3:\"idu\";i:12;}', '2020-02-22 18:05:45', 0),
(52, 5, 'nouveau demande de participation !', 'tess', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"35\";s:3:\"idu\";i:12;}', '2020-02-22 18:07:13', 0),
(56, 5, 'nouveau demande de participation !', 'tess', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"35\";s:3:\"idu\";i:12;}', '2020-02-22 18:18:13', 0),
(57, 5, 'nouveau demande de participation !', 'tess', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"20\";s:3:\"idu\";i:12;}', '2020-02-22 22:35:49', 0),
(58, 5, 'nouveau demande de participation !', 'aaaaa', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"35\";s:3:\"idu\";i:7;}', '2020-02-25 10:42:36', 0),
(60, 12, 'demande de participation accepter', 'aze', NULL, 'user_homepage', 'a:1:{s:3:\"ida\";s:2:\"49\";}', '2020-02-25 10:43:10', 0),
(61, 12, 'demande de participation accepter', 'aze', NULL, 'user_homepage', 'a:1:{s:3:\"ida\";s:2:\"48\";}', '2020-02-25 10:43:13', 0),
(62, 5, 'nouveau demande de participation !', 'aaaaa', NULL, 'user_homepage', 'a:2:{s:3:\"ide\";s:2:\"20\";s:3:\"idu\";i:7;}', '2020-02-25 14:00:05', 0);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `number`, `description`, `client_email`, `client_id`, `total_amount`, `currency_code`, `details`) VALUES
(1, '5e529c3237909', 'Paiement effectué avec succés', 'mohamedyassine.bennacef@esprit.tn', '13', 24, 'TND', '[]'),
(2, '5e5651828521b', 'Paiement effectué avec succés', 'anass.merai@esprit.tn', '7', 500, 'TND', '[]');

-- --------------------------------------------------------

--
-- Structure de la table `payment_token`
--

DROP TABLE IF EXISTS `payment_token`;
CREATE TABLE IF NOT EXISTS `payment_token` (
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:object)',
  `after_url` longtext COLLATE utf8_unicode_ci,
  `target_url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gateway_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `rating` double NOT NULL,
  `nbrrating` int(11) NOT NULL,
  `sommerating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27497DD634` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `categorie`, `nom`, `prix`, `description`, `nom_image`, `quantite`, `rating`, `nbrrating`, `sommerating`) VALUES
(4, 1, 'Kit Chasse', 250, 'Kit Chasse contenat plusieurs matériels', 'kitchasse.jpg', 8, 0, 0, 0),
(5, 1, 'Hache', 120, 'Hache de chasse très puissante', 'hache.jpg', 20, 0, 0, 0),
(6, 1, 'Sac + Carabine', 100, 'Sac Decathlon + Carabine 9mm', 'sac+carabine.jpg', 10, 0, 0, 0),
(7, 2, 'Moulinée', 64, 'Moulinée en aluminium', 'moulinee.jpg', 100, 1, 1, 100),
(8, 2, 'Cane à peche', 67, 'Cane a peche telescopique', 'mini-portable-telescopique-canne-a-peche-filage-ca.jpg', 50, 0.5, 1, 50),
(9, 1, 'Ammunitions', 60, '30 pièces d\'ammunitions', 'ammunitions.jpg', 60, 0, 0, 0),
(10, 2, 'Hameçons', 2, 'Hameçons réutilisable', 'aaa.jfif', 100, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idU` int(11) DEFAULT NULL,
  `idE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8892622BF603201` (`idE`),
  KEY `IDX_D8892622A2D72265` (`idU`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`id`, `value`, `description`, `idU`, `idE`) VALUES
(19, 1, 'aze', 7, 35);

-- --------------------------------------------------------

--
-- Structure de la table `ratingp`
--

DROP TABLE IF EXISTS `ratingp`;
CREATE TABLE IF NOT EXISTS `ratingp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `degre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57BF567329A5EC27` (`produit`),
  KEY `IDX_57BF56738D93D649` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ratingp`
--

INSERT INTO `ratingp` (`id`, `produit`, `user`, `degre`, `commentaire`) VALUES
(5, 7, 7, 'Très Satisfait', 'j\'aime'),
(6, 8, 7, 'Passable', 'j\'aime');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `idformation` int(11) DEFAULT NULL,
  `idr` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idr`),
  KEY `reservation_ibfk_1` (`idu`),
  KEY `reservation_ibfk_2` (`idformation`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idformation`, `idr`, `etat`, `avis`, `idu`) VALUES
(2, 121, 'non interssé', 'pas encore', 12),
(3, 122, 'non interessé', 'pas encore', 12),
(3, 123, 'non interessé', 'pas encore', 7),
(1, 124, 'interssé', 'pas encore', 7),
(2, 125, 'interssé', 'pas encore', 7);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_especes`
--
ALTER TABLE `articles_especes`
  ADD CONSTRAINT `FK_E20C8A1118D13FC9` FOREIGN KEY (`Especes_id`) REFERENCES `espece` (`id`),
  ADD CONSTRAINT `FK_E20C8A1168D3EA09` FOREIGN KEY (`User_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D29A5EC27` FOREIGN KEY (`produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_6EEAA67D8D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_2694D7A5A2D72265` FOREIGN KEY (`idU`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_2694D7A5BF603201` FOREIGN KEY (`idE`) REFERENCES `evenement` (`id_event`);

--
-- Contraintes pour la table `espece`
--
ALTER TABLE `espece`
  ADD CONSTRAINT `FK_1A2A1B1497DD634` FOREIGN KEY (`categorie`) REFERENCES `categorie_espece` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_89D7EABD150A48F1` FOREIGN KEY (`chef_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_FA6F25A3150A48F1` FOREIGN KEY (`chef_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BFED767E4F` FOREIGN KEY (`formateur`) REFERENCES `formateur` (`id`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CA99B902AD` FOREIGN KEY (`idu`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27497DD634` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_D8892622A2D72265` FOREIGN KEY (`idU`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_D8892622BF603201` FOREIGN KEY (`idE`) REFERENCES `evenement` (`id_event`);

--
-- Contraintes pour la table `ratingp`
--
ALTER TABLE `ratingp`
  ADD CONSTRAINT `FK_57BF567329A5EC27` FOREIGN KEY (`produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_57BF56738D93D649` FOREIGN KEY (`user`) REFERENCES `fos_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
