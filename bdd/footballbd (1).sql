-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 mars 2025 à 17:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `footballbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Num_admin` int(11) NOT NULL,
  `Nom_admin` varchar(25) DEFAULT NULL,
  `Prenom_admin` varchar(25) DEFAULT NULL,
  `Email_admin` varchar(25) DEFAULT NULL,
  `Pass_admin` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin_tournoi`
--

CREATE TABLE `admin_tournoi` (
  `Num_admin` int(11) NOT NULL,
  `Nom_admin` varchar(25) DEFAULT NULL,
  `Prenom_admin` varchar(25) DEFAULT NULL,
  `Email_admin` varchar(25) DEFAULT NULL,
  `Pass_admin` varchar(25) DEFAULT NULL,
  `NumTournoi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `arbitre`
--

CREATE TABLE `arbitre` (
  `NUM_ARBITRE` int(11) NOT NULL,
  `NOM_ARBITRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `arbitre`
--

INSERT INTO `arbitre` (`NUM_ARBITRE`, `NOM_ARBITRE`) VALUES
(1, 'arbitre1'),
(2, 'arbitre2\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_Article` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Categorie` varchar(100) NOT NULL,
  `Contenu` text NOT NULL,
  `DatePublication` datetime NOT NULL DEFAULT current_timestamp(),
  `Id_Image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_Article`, `Titre`, `Categorie`, `Contenu`, `DatePublication`, `Id_Image`) VALUES
(1, 'Grand Match de Ligue', 'Sport', 'Le choc entre les deux meilleures équipes de la saison a tenu toutes ses promesses...', '2024-03-20 15:30:00', 1),
(2, 'Performance Exceptionnelle', 'Sport', 'Le joueur vedette de l\'équipe a inscrit un triplé lors de la dernière rencontre...', '2024-03-19 18:00:00', 2),
(3, 'Ambiance Electrique au Stade', 'Supporters', 'Les fans ont répondu présents pour soutenir leur équipe avec une énergie incroyable...', '2024-03-18 20:15:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `but`
--

CREATE TABLE `but` (
  `Num_But` int(11) NOT NULL,
  `Minute_But` int(11) DEFAULT NULL,
  `Type_But` varchar(50) DEFAULT NULL,
  `NumJoueur` int(11) DEFAULT NULL,
  `NumMatch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `but`
--

INSERT INTO `but` (`Num_But`, `Minute_But`, `Type_But`, `NumJoueur`, `NumMatch`) VALUES
(1, 15, 'Pied droit', 1, 29),
(2, 30, 'Tête', 2, 30),
(3, 45, 'Penalty', 3, 30),
(4, 60, 'Contre son camp', 4, 31),
(5, 75, 'Pied gauche', 1, 32),
(6, 85, 'Reprise de volée', 2, 29),
(7, 90, 'Coup franc', 3, 30),
(8, 95, 'Pied droit', 4, 31);

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `NumJoueur` int(11) NOT NULL,
  `NumEquipe` int(11) NOT NULL,
  `DateD` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `NumdeTenu` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `composer`
--

INSERT INTO `composer` (`NumJoueur`, `NumEquipe`, `DateD`, `DateFin`, `NumdeTenu`) VALUES
(1, 2, '2025-01-28', '2025-03-08', '1'),
(1, 3, '2025-01-28', '2025-02-13', '2'),
(4, 4, '2025-03-20', '2025-03-20', '2'),
(5, 7, '2025-03-20', '2025-03-20', '4'),
(6, 4, '2025-03-20', '2025-03-20', '5'),
(7, 4, '2025-03-20', '2025-03-20', '3'),
(8, 4, '2025-03-20', '2025-03-20', '9'),
(9, 4, '2025-03-21', '2025-03-21', '9');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `NumEquipe` int(11) NOT NULL,
  `NomEquipe` varchar(50) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `NomImage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`NumEquipe`, `NomEquipe`, `DateCreation`, `Ville`, `NomImage`) VALUES
(1, 'v', '2025-02-27', 'b', ''),
(2, 'equipe1', '2025-02-27', 'casablanca', ''),
(3, 'equipe2', '2025-02-27', 'tanger', ''),
(4, 'raja', '2025-03-05', 'Casablanca', ''),
(5, 'widad', '2025-03-20', 'Casablanca', ''),
(6, 'real madrid', '2025-03-20', 'Barcelona', ''),
(7, 'FAR', '2025-03-20', 'Rabat', '');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `Id_Image` int(11) NOT NULL,
  `Alt` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `Lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`Id_Image`, `Alt`, `description`, `Lien`) VALUES
(1, 'Football Match', 'Un match passionnant entre deux grandes équipes.', 'images/slides/im1.jpg'),
(2, 'Joueur Star', 'Le meilleur buteur de la saison en action.', 'images/slides/im2.jpg'),
(3, 'Stade Rempli', 'Les supporters en feu lors du dernier match.', 'images/slides/im3.jpeg'),
(4, 'Entraînement Intensif', 'Les joueurs se préparent pour le prochain match.', 'images/slides/im4.jpeg'),
(5, 'Trophée de la Saison', 'Le trophée tant convoité par toutes les équipes.', 'images/slides/im3.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `NumJoueur` int(11) NOT NULL,
  `NomJoueur` varchar(50) DEFAULT NULL,
  `PrenomJoueur` varchar(50) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `NumEquipe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`NumJoueur`, `NomJoueur`, `PrenomJoueur`, `DateNaissance`, `NumEquipe`) VALUES
(1, 'joueur 1', 'joueur1', '2000-02-02', 2),
(2, 'Joueur 2', 'Joueur2', '2000-02-02', 3),
(3, 'joueur 3', 'joeur3', '2000-02-02', 2),
(4, 'zaazaa', 'Imane', '2025-03-20', NULL),
(5, 'moatassim', 'soumia', '2025-03-20', NULL),
(6, 'menan', 'aya', '2025-03-20', NULL),
(7, 'mazouz', 'ikram', '2025-03-20', NULL),
(8, 'lafdili', 'malak', '2025-03-20', NULL),
(9, 'zaazaa', 'sihame', '2025-03-21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `NumMatch` int(11) NOT NULL,
  `NombreSpectateur` int(11) DEFAULT NULL,
  `DateMatch` datetime DEFAULT NULL,
  `Num_Stade` int(11) DEFAULT NULL,
  `NumTournoi` int(11) DEFAULT NULL,
  `Num_Arbitre` int(11) NOT NULL,
  `NumEquipeDomicile` int(11) NOT NULL,
  `NumEquipeExterieur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`NumMatch`, `NombreSpectateur`, `DateMatch`, `Num_Stade`, `NumTournoi`, `Num_Arbitre`, `NumEquipeDomicile`, `NumEquipeExterieur`) VALUES
(14, NULL, '2025-03-09 13:30:00', 1, 1, 2, 2, 3),
(29, 50000, '2025-02-27 20:00:00', 1, 1, 1, 1, 2),
(30, 30000, '2025-02-27 18:00:00', 2, 1, 2, 3, 4),
(31, 45000, '2025-02-27 21:00:00', 3, 1, 2, 3, 2),
(32, 35000, '2025-03-05 19:00:00', 1, 2, 1, 3, 1),
(33, 55000, '2025-03-20 20:30:00', 2, 2, 2, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `observer`
--

CREATE TABLE `observer` (
  `NumMatch` int(11) NOT NULL,
  `NUM_ARBITRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `NumeroParticipation` int(11) NOT NULL,
  `MinuteDebut` int(11) DEFAULT NULL,
  `MinuteFin` int(11) DEFAULT NULL,
  `Km` float DEFAULT NULL,
  `Note` float DEFAULT NULL,
  `NumEquipe` int(11) DEFAULT NULL,
  `NumMatch` int(11) DEFAULT NULL,
  `NumJoueur` int(11) DEFAULT NULL,
  `role` enum('principal','remplaçant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`NumeroParticipation`, `MinuteDebut`, `MinuteFin`, `Km`, `Note`, `NumEquipe`, `NumMatch`, `NumJoueur`, `role`) VALUES
(21, NULL, NULL, NULL, NULL, 3, 14, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE `participer` (
  `NumTournoi` int(11) NOT NULL,
  `NumEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stade`
--

CREATE TABLE `stade` (
  `Num_Stade` int(11) NOT NULL,
  `Nom_Stade` varchar(50) DEFAULT NULL,
  `Ville_Stade` varchar(50) DEFAULT NULL,
  `Date_Construction` date DEFAULT NULL,
  `Disponible` tinyint(1) DEFAULT NULL,
  `Capacite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stade`
--

INSERT INTO `stade` (`Num_Stade`, `Nom_Stade`, `Ville_Stade`, `Date_Construction`, `Disponible`, `Capacite`) VALUES
(1, 'Mohammed V', 'Casabanca', '0000-00-00', 1, 1000),
(2, 'mohammed 5', 'Casablanca', '2025-03-20', 1, 4000),
(3, 'stade1', 'Casablanca', '2025-03-20', 1, 4000),
(4, 'stade2', 'Casablanca', '2025-03-20', 1, 4000);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `NumStaff` int(11) NOT NULL,
  `NomStaff` varchar(50) DEFAULT NULL,
  `PrenomStaff` varchar(15) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `DateDebutStaff` date DEFAULT NULL,
  `DateFinStaff` date DEFAULT NULL,
  `NumEquipe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`NumStaff`, `NomStaff`, `PrenomStaff`, `Role`, `DateDebutStaff`, `DateFinStaff`, `NumEquipe`) VALUES
(1, 'menan', 'aya', 'Entraîneur principal', '2025-03-21', '2027-10-21', 4),
(2, 'zaazaa', 'Imane', 'Préparateur physique', '2025-03-21', '2025-03-21', 4);

-- --------------------------------------------------------

--
-- Structure de la table `tournoi`
--

CREATE TABLE `tournoi` (
  `NumTournoi` int(11) NOT NULL,
  `NomTournoi` varchar(50) NOT NULL,
  `TypeTournoi` varchar(50) DEFAULT NULL,
  `DateDebutTournoi` date NOT NULL,
  `DateFinTournoi` date NOT NULL,
  `Status` varchar(25) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournoi`
--

INSERT INTO `tournoi` (`NumTournoi`, `NomTournoi`, `TypeTournoi`, `DateDebutTournoi`, `DateFinTournoi`, `Status`, `Description`) VALUES
(1, 'coupe du trône 2025', 'national', '2025-02-01', '2025-02-28', 'en cours', NULL),
(2, 'coupe du trône 2024', 'national', '2025-02-01', '2025-02-28', 'terminé', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Num_user` int(11) NOT NULL,
  `Nom_User` varchar(25) DEFAULT NULL,
  `Prenom_User` varchar(25) DEFAULT NULL,
  `Email_User` varchar(25) DEFAULT NULL,
  `Pass_user` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Num_user`, `Nom_User`, `Prenom_User`, `Email_User`, `Pass_user`) VALUES
(2, 'moatassim', 'soumia', 'moatassimsoumia@gmail.com', 'imane'),
(3, 'zaazaa', 'Imane', 'zaazaaimane24@gmail.com', 'imanesihame');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `NumVote` int(11) NOT NULL,
  `NumMatch` int(11) NOT NULL,
  `NumEquipe` int(11) NOT NULL,
  `NombreVotes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`NumVote`, `NumMatch`, `NumEquipe`, `NombreVotes`) VALUES
(14, 14, 1, 100),
(15, 29, 2, 150),
(16, 30, 1, 120),
(17, 31, 3, 200),
(18, 32, 3, 250),
(19, 32, 1, 200),
(20, 33, 2, 102),
(21, 33, 3, 151);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Num_admin`);

--
-- Index pour la table `admin_tournoi`
--
ALTER TABLE `admin_tournoi`
  ADD PRIMARY KEY (`Num_admin`),
  ADD KEY `fk_tournoi_admin` (`NumTournoi`);

--
-- Index pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD PRIMARY KEY (`NUM_ARBITRE`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_Article`),
  ADD KEY `fk_image` (`Id_Image`);

--
-- Index pour la table `but`
--
ALTER TABLE `but`
  ADD PRIMARY KEY (`Num_But`),
  ADD KEY `NumJoueur` (`NumJoueur`),
  ADD KEY `fk_NumMatch` (`NumMatch`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`NumJoueur`,`NumEquipe`),
  ADD KEY `NumEquipe` (`NumEquipe`),
  ADD KEY `NumJoueur` (`NumJoueur`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`NumEquipe`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`Id_Image`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`NumJoueur`),
  ADD KEY `fk_joueur_equipe` (`NumEquipe`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`NumMatch`),
  ADD UNIQUE KEY `unique_match` (`NumTournoi`,`Num_Stade`,`DateMatch`),
  ADD KEY `Num_Stade` (`Num_Stade`),
  ADD KEY `fk_arbitre` (`Num_Arbitre`),
  ADD KEY `fk_equipe_domicile` (`NumEquipeDomicile`),
  ADD KEY `fk_equipe_exterieur` (`NumEquipeExterieur`);

--
-- Index pour la table `observer`
--
ALTER TABLE `observer`
  ADD PRIMARY KEY (`NumMatch`,`NUM_ARBITRE`),
  ADD KEY `NUM_ARBITRE` (`NUM_ARBITRE`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`NumeroParticipation`),
  ADD KEY `NumEquipe` (`NumEquipe`),
  ADD KEY `NumMatch` (`NumMatch`),
  ADD KEY `NumJoueur` (`NumJoueur`);

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`NumTournoi`,`NumEquipe`),
  ADD KEY `NumEquipe` (`NumEquipe`);

--
-- Index pour la table `stade`
--
ALTER TABLE `stade`
  ADD PRIMARY KEY (`Num_Stade`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`NumStaff`),
  ADD KEY `NumEquipe` (`NumEquipe`);

--
-- Index pour la table `tournoi`
--
ALTER TABLE `tournoi`
  ADD PRIMARY KEY (`NumTournoi`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Num_user`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`NumVote`),
  ADD KEY `NumMatch` (`NumMatch`),
  ADD KEY `NumEquipe` (`NumEquipe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arbitre`
--
ALTER TABLE `arbitre`
  MODIFY `NUM_ARBITRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `but`
--
ALTER TABLE `but`
  MODIFY `Num_But` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `NumEquipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `Id_Image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `NumJoueur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `NumMatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `NumeroParticipation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `stade`
--
ALTER TABLE `stade`
  MODIFY `Num_Stade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `NumStaff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tournoi`
--
ALTER TABLE `tournoi`
  MODIFY `NumTournoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Num_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `NumVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin_tournoi`
--
ALTER TABLE `admin_tournoi`
  ADD CONSTRAINT `fk_tournoi_admin` FOREIGN KEY (`NumTournoi`) REFERENCES `tournoi` (`NumTournoi`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`Id_Image`) REFERENCES `images` (`Id_Image`) ON DELETE SET NULL;

--
-- Contraintes pour la table `but`
--
ALTER TABLE `but`
  ADD CONSTRAINT `but_ibfk_1` FOREIGN KEY (`NumJoueur`) REFERENCES `joueur` (`NumJoueur`),
  ADD CONSTRAINT `fk_NumMatch` FOREIGN KEY (`NumMatch`) REFERENCES `matchs` (`NumMatch`) ON DELETE CASCADE;

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_1` FOREIGN KEY (`NumJoueur`) REFERENCES `joueur` (`NumJoueur`),
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `fk_joueur_equipe` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`);

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `fk_arbitre` FOREIGN KEY (`Num_Arbitre`) REFERENCES `arbitre` (`NUM_ARBITRE`),
  ADD CONSTRAINT `fk_equipe_domicile` FOREIGN KEY (`NumEquipeDomicile`) REFERENCES `equipe` (`NumEquipe`),
  ADD CONSTRAINT `fk_equipe_exterieur` FOREIGN KEY (`NumEquipeExterieur`) REFERENCES `equipe` (`NumEquipe`),
  ADD CONSTRAINT `fk_tournoi_match` FOREIGN KEY (`NumTournoi`) REFERENCES `tournoi` (`NumTournoi`),
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`Num_Stade`) REFERENCES `stade` (`Num_Stade`);

--
-- Contraintes pour la table `observer`
--
ALTER TABLE `observer`
  ADD CONSTRAINT `observer_ibfk_1` FOREIGN KEY (`NUM_ARBITRE`) REFERENCES `arbitre` (`NUM_ARBITRE`),
  ADD CONSTRAINT `observer_ibfk_2` FOREIGN KEY (`NumMatch`) REFERENCES `matchs` (`NumMatch`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`NumMatch`) REFERENCES `matchs` (`NumMatch`),
  ADD CONSTRAINT `participation_ibfk_3` FOREIGN KEY (`NumJoueur`) REFERENCES `joueur` (`NumJoueur`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`NumTournoi`) REFERENCES `tournoi` (`NumTournoi`);

--
-- Contraintes pour la table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`);

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`NumMatch`) REFERENCES `matchs` (`NumMatch`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`NumEquipe`) REFERENCES `equipe` (`NumEquipe`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
