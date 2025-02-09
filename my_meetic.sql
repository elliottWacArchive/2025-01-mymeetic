-- phpMyAdmin SQL Dump
-- version 5.2.2deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 09 fév. 2025 à 20:58
-- Version du serveur : 11.4.4-MariaDB-3
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_meetic`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user1`, `user2`) VALUES
(4, 17, 18),
(5, 23, 18);

-- --------------------------------------------------------

--
-- Structure de la table `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `hobbies`
--

INSERT INTO `hobbies` (`id`, `name`) VALUES
(12, 'art'),
(13, 'musique'),
(14, 'vocaloid'),
(15, 'sport'),
(16, 'programmation'),
(17, 'trainer avec elliott'),
(24, 'cinéma'),
(25, 'jeux vidéo');

-- --------------------------------------------------------

--
-- Structure de la table `is_match`
--

CREATE TABLE `is_match` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cible` int(11) NOT NULL,
  `is_match` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `is_match`
--

INSERT INTO `is_match` (`id`, `id_user`, `id_cible`, `is_match`) VALUES
(40, 18, 17, 1),
(41, 18, 20, 1),
(42, 18, 21, 0),
(43, 24, 18, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `conversation` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `conversation`, `sender`, `message`) VALUES
(5, 4, 17, 'salut'),
(6, 4, 18, 'tfk'),
(7, 5, 23, 'salut!'),
(8, 5, 18, 'salut tux comment vas tu ?'),
(9, 5, 23, 'écoute moi ça va et toi ?'),
(10, 5, 18, 'ça va plutot bien ma foi'),
(11, 5, 18, 'quoi de neuf'),
(12, 5, 23, 'rien... J\'aimerais bien que tu mettes à jours tes packages stp...'),
(13, 5, 18, 'oups...'),
(14, 4, 17, 'rien de spécial et toi ?'),
(15, 4, 18, 'rien... je code...'),
(16, 4, 17, 'trop cool le code!!!'),
(17, 4, 18, 'je vais te spam att'),
(18, 4, 18, 'ffzfzz'),
(19, 4, 18, 'llllll'),
(20, 4, 18, 'lllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll'),
(21, 4, 18, 'dccsvvsdvv'),
(22, 4, 18, 'lxcdsvsdvdv'),
(23, 4, 18, 'ldflbvdflvldf'),
(24, 4, 18, 'lvdflvdfvfdvvd'),
(25, 4, 18, 'lvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv'),
(26, 4, 18, 'vlllllllllllllllllllllllllllll'),
(27, 4, 18, 'fllllllllllllllllllllllllllllllll'),
(28, 4, 18, 'fllllllllllllllllllllllllllllllllllllllllll'),
(29, 4, 17, 'cette scrollbar est vrm belle');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `pp` varchar(255) DEFAULT 'default.jpg',
  `token` varchar(255) NOT NULL,
  `isConfigure` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `mail`, `password`, `birthdate`, `age`, `city`, `gender`, `pp`, `token`, `isConfigure`, `active`) VALUES
(17, 'tetoo', 'teto', 'kasane', 'teto.kasane@vocaloid.fr', '$2y$10$YmmWPIJkaYt98835WgBTNOFAIqyzZQKl3piNpwXvdoiJeM.ckfiV.', '2001-04-01', 23, '2channel', 'female', '17.jpg', '691622daec48fb64981bed111b856590', 1, 1),
(18, 'elliott:3', 'Elliott', 'Ramet', 'elliott.ramet@nugget.fr', '$2y$10$sWtjF9rh9aXQxGx5PEb1ZeRwPCfQRvRej9oDWRM5ujHP6E1tIHSPe', '2005-09-01', 19, 'lyon', 'male', '18.jpg', '3026fc1fe6bb01a83620aa9a5841c6ed', 1, 1),
(19, 'sonic69', 'sonic', 'hedgehog', 'sonic@sega.jp', '$2y$10$dMxhYsbyjghPof.kEkIRYOiEyz0h6AV/iZ7PcN/XsF3Kr9huDGG2y', '1991-06-23', 33, 'lyon', 'male', '19.jpg', '9a033e1a6a66e72030520c0bcf1216a2', 1, 1),
(20, 'lain', 'lain', 'iwakura', 'lain@wired.jp', '$2y$10$x5WLcZ5I6lbjuNtiRhtTfe0DY5B179gVvTo2EakDHcsmY6KDGNCBm', '1998-06-06', 26, 'wired', 'female', '20.jpg', 'e1198852b16ce005909afc5383fac54e', 1, 1),
(21, 'hatsunemiku', 'miku', 'hatsune', 'hatsune.miku@vocaloid.jp', '$2y$10$GjWWYsNMur5gkCvXH3ZzlOukoSqjhMUrQ5dVaFY5hHHIM/OFvrANS', '2005-08-31', 19, 'lyon', 'female', '21.jpg', '0223424e57f4323a52ed79e47c34f143', 1, 1),
(22, 'tomok0', 'tomoko', 'kuroki', 'tomoko@gmail.com', '$2y$10$FsQ91fB6TyxlJ2mbOZNCyuaS8oAI3txzcwuX6/K7hJbsJbjkGwgEm', '2006-01-10', 19, 'paris', 'female', '22.jpg', '311285cf182d2b11ebc539691ce64f81', 1, 1),
(23, 'tux', 'tux', 'pinguin', 'tux@linux.tux', '$2y$10$yymGG2IMmNZ.vsap2.PHFuOvVEaeVTRe0aSY6l/rjBaZvpU/EXzwO', '1991-01-01', 34, 'computer', 'male', '23.jpg', '3148e4e16eaaefc03b268b6a8939a5de', 1, 1),
(24, 'jevaismesupprimer', 'supprimable', 'compte', 'aurevoirdb@db.c', '$2y$10$UPv69S.hP5zILY98bmO65u.LwLQ949NAkUSk9Y/sPjOlkzrM8VKiO', '2001-01-01', 24, 'compte', 'male', '24.jpg', 'e53879975f84557fd6e615d23959f1d9', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_hobbies`
--

CREATE TABLE `user_hobbies` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hobbies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `user_hobbies`
--

INSERT INTO `user_hobbies` (`id`, `id_user`, `id_hobbies`) VALUES
(18, 17, 17),
(19, 17, 13),
(20, 17, 14),
(21, 18, 12),
(22, 18, 13),
(23, 18, 16),
(24, 18, 24),
(25, 19, 15),
(26, 19, 25),
(27, 20, 17),
(28, 20, 16),
(29, 21, 14),
(30, 21, 17),
(31, 22, 17),
(32, 23, 16),
(33, 23, 25);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `is_match`
--
ALTER TABLE `is_match`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `is_match`
--
ALTER TABLE `is_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
