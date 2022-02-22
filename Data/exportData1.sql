-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 17 fév. 2022 à 15:00
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `15th-project`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'comedy'),
(2, 'adventure'),
(3, 'action'),
(4, 'fantasy'),
(5, 'thriller'),
(6, 'drama'),
(7, 'horror'),
(8, 'romance'),
(9, 'science-fiction'),
(10, 'historical'),
(11, 'mecha'),
(12, 'sports'),
(13, 'shonen'),
(14, 'shojo'),
(15, 'seinen'),
(16, 'josei');

-- --------------------------------------------------------

--
-- Structure de la table `collecting`
--

CREATE TABLE `collecting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `collecting`
--

INSERT INTO `collecting` (`id`, `name`, `modified_at`, `created_at`) VALUES
(1, 'Anime', '2022-01-24 01:15:54', '2022-01-24 01:15:54'),
(2, 'Manga', '2022-01-24 01:15:54', '2022-01-24 01:15:54'),
(3, 'test', '2022-01-29 17:12:22', '2022-01-29 17:12:22'),
(8, 'testDeux', '2022-01-29 18:49:31', '2022-01-29 18:13:46'),
(9, 'z', '2022-02-06 14:35:56', '2022-02-06 14:35:56');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220209000003', '2022-02-09 00:01:54', 456),
('DoctrineMigrations\\Version20220209013027', '2022-02-09 01:30:37', 124),
('DoctrineMigrations\\Version20220209145125', '2022-02-09 14:52:13', 84),
('DoctrineMigrations\\Version20220209145202', '2022-02-09 14:52:13', 21),
('DoctrineMigrations\\Version20220210174700', '2022-02-10 17:47:12', 150),
('DoctrineMigrations\\Version20220212024001', '2022-02-12 02:41:03', 144);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `collecting_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` longtext COLLATE utf8mb4_unicode_ci,
  `chapters` int(11) DEFAULT NULL,
  `volumes_or_episodes` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `image_url` varchar(510) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `collecting_id`, `title`, `synopsis`, `chapters`, `volumes_or_episodes`, `start_date`, `end_date`, `image_url`) VALUES
(2, 2, 'One Piece', 'Gol D. Roger, a man referred to as the \"Pirate King,\" is set to be executed by the World Government. But just before his demise, he confirms the existence of a great treasure, One Piece, located somew...', 0, 0, '1997-07-22 00:00:00', NULL, 'https://cdn.myanimelist.net/images/manga/2/253146.jpg?s=e5286481ed2b4c11ab39d1420110dc43'),
(3, 1, 'Naruto', 'Moments prior to Naruto Uzumaki\'s birth, a huge demon known as the Kyuubi, the Nine-Tailed Fox, attacked Konohagakure, the Hidden Leaf Village, and wreaked havoc. In order to put an end to the Kyuubi\'...', NULL, 220, '2002-10-03 00:00:00', '2007-02-08 00:00:00', 'https://cdn.myanimelist.net/images/anime/13/17405.jpg?s=59241469eb470604a792add6fbe7cce6'),
(5, 2, 'Naruto', 'Whenever Naruto Uzumaki proclaims that he will someday become the Hokage—a title bestowed upon the best ninja in the Village Hidden in the Leaves—no one takes him seriously. Since birth, Naruto has be...', 700, 72, '1999-09-21 00:00:00', '2014-11-10 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/117681.jpg?s=6dc21454a32172a2e1783bd664668a22'),
(6, 2, 'City Hunter', 'Ryo Saeba is a \"sweeper\" in the city of Tokyo. His works as a trouble shooter, cleaning the streets of vermin, and helping out desperate people. Sometimes he\'s a bodyguard, sometimes he\'s an assassin,...', 193, 35, '1985-02-26 00:00:00', '1991-11-19 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/75879.jpg?s=6b82208568cca51b93529af50dfa5e0c'),
(8, 2, 'Death Note', 'Ryuk, a god of death, drops his Death Note into the human world for personal pleasure. In Japan, prodigious high school student Light Yagami stumbles upon it. Inside the notebook, he finds a chilling...', 108, 12, '2003-12-01 00:00:00', '2006-05-15 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/54453.jpg?s=64e676c2d2ea8370b400a0503db2bc46'),
(9, 1, 'Death Note', 'Brutal murders, petty thefts, and senseless violence pollute the human world. In contrast, the realm of death gods is a humdrum, unchanging gambling den. The ingenious 17-year-old Japanese student Lig...', NULL, 37, '2006-10-04 00:00:00', '2007-06-27 00:00:00', 'https://cdn.myanimelist.net/images/anime/9/9453.jpg?s=b89e80691ac5cc0610847ccbe0b8424a'),
(10, 2, 'Dragon Ball', 'Dragon Ball series follows the adventures of Son Goku from his childhood through adulthood as he trains in martial arts and explores the world in search of the seven mystical orbs known as the Dragon...', 520, 42, '1984-11-20 00:00:00', '1995-05-23 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/54545.jpg?s=cedcb190877bac2a2403ce36caac17bf'),
(11, 1, 'Dragon Ball', 'Gokuu Son is a young boy who lives in the woods all alone—that is, until a girl named Bulma runs into him in her search for a set of magical objects called the \\\"Dragon Balls.\\\" Since the artifacts are...', NULL, 153, '1986-02-26 00:00:00', '1989-04-12 00:00:00', 'https://cdn.myanimelist.net/images/anime/1887/92364.jpg?s=9710b6fb426a62c9ca2deb991f7abfb0'),
(12, 1, 'Captain Tsubasa', 'Captain Tsubasa is the passionate story of an elementary school student whose thoughts and dreams revolve almost entirely around the love of soccer. 11-year-old Tsubasa Oozora started playing soccer a...', NULL, 128, '1983-10-13 00:00:00', '1986-03-27 00:00:00', 'https://cdn.myanimelist.net/images/anime/9/26248.jpg?s=c2724412f3545fa4786c3ab73d817c9d'),
(13, 2, 'Captain Tsubasa', '11-year-old Tsubasa Ohzora transfers to his new school where he quickly becomes the star of the school\'s soccer team. His Brazilian coach, Roberto Hongo, notices the potential of the young athlete and...', 114, 37, '1981-03-31 00:00:00', '1988-04-26 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/29157.jpg?s=ace0aa51e342076346b34c5aefe7209a'),
(14, 2, 'Slam Dunk', 'Hanamichi Sakuragi, a tall, boisterous teenager with flame-red hair and physical strength beyond his years, is eager to put an end to his rejection streak of 50 and finally score a girlfriend as he be...', 276, 31, '1990-09-18 00:00:00', '1996-06-04 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/157904.jpg?s=c8477fd874de514caeb368880ec9e1db'),
(15, 1, 'Slam Dunk', 'Hanamichi Sakuragi, infamous for his temper, massive height, and fire-red hair, enrolls in Shohoku High, hoping to finally get a girlfriend and break his record of being rejected 50 consecutive times...', NULL, 101, '1993-10-16 00:00:00', '1996-03-23 00:00:00', 'https://cdn.myanimelist.net/images/anime/12/86890.jpg?s=bfc7954502569ff5c4d3533dcde8230f'),
(16, 1, 'GTO', 'Twenty-two-year-old Eikichi Onizuka—ex-biker gang leader, conqueror of Shonan, and virgin—has a dream: to become the greatest high school teacher in all of Japan. This isn\'t because of a passion for t...', NULL, 43, '1999-06-30 00:00:00', '2000-09-17 00:00:00', 'https://cdn.myanimelist.net/images/anime/13/11460.jpg?s=7e890b7e93b7b57c2de4aa90211931bd'),
(17, 2, 'GTO', '22-year-old Eikichi Onizuka: pervert, former gang member... and teacher? Great Teacher Onizuka follows the incredible, though often ridiculous, antics of the titular teacher as he attempts to outwit a...', 208, 25, '1996-12-11 00:00:00', '2002-01-30 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/172982.jpg?s=12df0730d20b4e6c9294bf8293feb5ee'),
(18, 2, 'Fullmetal Alchemist', 'Alchemists are knowledgeable and naturally talented individuals who can manipulate and modify matter due to their art. Yet despite the wide range of possibilities, alchemy is not as all-powerful as mo...', 116, 27, '2001-07-12 00:00:00', '2010-09-11 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/243675.jpg?s=8cb0a643f8a7597514447f2dd0e4ffc2'),
(19, 1, 'Fullmetal Alchemist', 'Edward Elric, a young, brilliant alchemist, has lost much in his twelve-year life: when he and his brother Alphonse try to resurrect their dead mother through the forbidden act of human transmutation,...', NULL, 51, '2003-10-04 00:00:00', '2004-10-02 00:00:00', 'https://cdn.myanimelist.net/images/anime/10/75815.jpg?s=095ef966da07a873a75e38378080a466'),
(20, 2, 'Kimetsu no Yaiba', 'Tanjirou Kamado lives with his impoverished family on a remote mountain. As the oldest sibling, he took upon the responsibility of ensuring his family\'s livelihood after the death of his father. On a...', 207, 23, '2016-02-15 00:00:00', '2020-05-18 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/179023.jpg?s=e79cbbeb57b734d4b5f6d29f94162627'),
(21, 1, 'Kimetsu no Yaiba', 'Ever since the death of his father, the burden of supporting the family has fallen upon Tanjirou Kamado\'s shoulders. Though living impoverished on a remote mountain, the Kamado family are able to enjo...', NULL, 26, '2019-04-06 00:00:00', '2019-09-28 00:00:00', 'https://cdn.myanimelist.net/images/anime/1286/99889.jpg?s=e497d08bef31ae412e314b90a54acfda'),
(22, 1, 'Bleach', 'Ichigo Kurosaki is an ordinary high schooler—until his family is attacked by a Hollow, a corrupt spirit that seeks to devour human souls. It is then that he meets a Soul Reaper named Rukia Kuchiki, wh...', NULL, 366, '2004-10-05 00:00:00', '2012-03-27 00:00:00', 'https://cdn.myanimelist.net/images/anime/3/40451.jpg?s=3aa217eced217b3b4223af21c30fe2ed'),
(23, 2, 'Bleach', 'For as long as he can remember, high school student Ichigo Kurosaki has been able to see the spirits of the dead, but that has not stopped him from leading an ordinary life. One day, Ichigo returns ho...', 705, 74, '2001-08-07 00:00:00', '2016-08-22 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/180089.jpg?s=6370e41455cb4d19c56a475065a69cde'),
(24, 2, 'Shingeki no Kyojin', 'Hundreds of years ago, horrifying creatures which resembled humans appeared. These mindless, towering giants, called \\\"titans,\\\" proved to be an existential threat, as they preyed on whatever humans the...', 141, 34, '2009-09-09 00:00:00', '2021-04-09 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/37846.jpg?s=bdda4d1c1d85237aead7d545f876c077'),
(25, 1, 'Shingeki no Kyojin', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly...', NULL, 25, '2013-04-07 00:00:00', '2013-09-29 00:00:00', 'https://cdn.myanimelist.net/images/anime/10/47347.jpg?s=29949c6e892df123f0b0563e836d3d98'),
(26, 1, 'Kaze no Tani no Nausicaä', 'A millennium has passed since the catastrophic nuclear war named the \\\"Seven Days of Fire,\\\" which destroyed nearly all life on Earth. Humanity now lives in a constant struggle against the treacherous j...', NULL, 1, '1984-03-11 00:00:00', '1984-03-11 00:00:00', 'https://cdn.myanimelist.net/images/anime/10/75914.jpg?s=7baf536ca16c2625bd3d615972f1fbfc'),
(27, 2, 'Kaze no Tani no Nausicaä', 'Humanity, once a technologically advanced and thriving civilization, has been pushed to the brink of extinction following a cataclysmic war known as the \\\"Seven Days of Fire.\\\" The remnants of the human...', 59, 7, '1982-10-09 00:00:00', '1994-02-10 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/156624.jpg?s=237768196e315e268bbf5709d52af55c'),
(32, 1, 'One Piece', 'Gol D. Roger was known as the \"Pirate King,\" the strongest and most infamous being to have sailed the Grand Line. The capture and execution of Roger by the World Government brought a change throughout...', NULL, NULL, '2022-10-20 00:00:00', '2022-02-05 00:00:00', 'https://cdn.myanimelist.net/images/anime/6/73245.jpg?s=f792b8c9e28534ae455d06b15e686a14'),
(33, 1, 'City Hunter', 'City Hunter\" is a notorious contractor group with the call sign \"XYZ.\" No matter the job, they will take it, cleaning up the scum on the streets of Tokyo. The key member of City Hunter is Ryou Saeba;...', NULL, 51, '1987-04-06 00:00:00', '1988-03-28 00:00:00', 'https://cdn.myanimelist.net/images/anime/8/20587.jpg?s=639bcae6b03127c0be15261bdf7f3898'),
(34, 2, 'Fruits Basket', 'Tooru Honda is an orphan with nowhere to go but a tent in the woods, until the Souma family takes her in. However, the Souma family is no ordinary family, and they hide a grave secret: when they are hugged by someone of the opposite gender, they turn into animals from the Chinese Zodiac!\r\nNow, Tooru must help Kyou and Yuki Souma hide their curse from their classmates, as well as her friends Arisa Uotani and Saki Hanajima. As she is drawn further into the mysterious world of the Soumas, she meets more of the family, forging friendships along the way.\r\nBut this curse has caused much suffering; it has broken many Soumas. Despite this, Tooru may just be able to heal their hearts and soothe their souls.', 136, 23, '1998-07-18 00:00:00', '2006-11-20 00:00:00', 'https://cdn.myanimelist.net/images/manga/2/155964.jpg?s=e2ad245fa7a85e9acb68c9568e76b311'),
(35, 1, 'Fruits Basket', 'After the accident in which she lost her mother, 16-year-old Tooru moves in with her grandfather, but due to his home being renovated, is unable to continue living with him. Claiming she will find someone to stay with but also fearing the criticism of her family and not wanting to burden any of her friends, Tooru resorts to secretly living on her own in a tent in the woods.\r\nOne night on her way back from work, she finds her tent buried underneath a landslide. Yuki Souma, the \"prince\" of her school, and his cousin Shigure Souma, a famous author, stumble across Tooru\'s situation and invite her to stay with them until her grandfather\'s home renovations are complete.\r\nUpon arriving at the Souma house, Tooru discovers their secret: if a Souma is hugged by someone of the opposite gender, they temporarily transform into one of the animals of the zodiac! However, this strange phenomenon is no laughing matter; rather, it is a terrible curse that holds a dark history. As she continues her journey, meeting more members of the zodiac family, will Tooru\'s kindhearted yet resilient nature be enough to prepare her for what lies behind the Souma household\'s doors?', NULL, 26, '2001-07-05 00:00:00', '2001-12-27 00:00:00', 'https://cdn.myanimelist.net/images/anime/4/75204.jpg?s=980d29f55c40ce6c7a7ed6b64ab13e99'),
(36, 1, 'test', 'teset jkgkjgvhjhgjgjgh', NULL, NULL, '2022-02-14 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `item_category`
--

CREATE TABLE `item_category` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item_category`
--

INSERT INTO `item_category` (`item_id`, `category_id`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 13),
(5, 1),
(5, 2),
(5, 3),
(5, 13),
(6, 1),
(6, 2),
(6, 13),
(8, 6),
(8, 13),
(9, 13),
(10, 1),
(10, 2),
(10, 3),
(10, 9),
(10, 13),
(11, 1),
(11, 2),
(11, 4),
(11, 13),
(12, 3),
(12, 12),
(12, 13),
(13, 3),
(13, 12),
(13, 13),
(14, 1),
(14, 6),
(14, 12),
(14, 13),
(15, 1),
(15, 6),
(15, 12),
(15, 13),
(16, 1),
(16, 6),
(16, 13),
(17, 1),
(17, 3),
(17, 6),
(17, 13),
(18, 1),
(18, 2),
(18, 3),
(18, 6),
(18, 13),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 6),
(19, 13),
(20, 3),
(20, 13),
(21, 3),
(21, 13),
(22, 1),
(22, 2),
(22, 3),
(22, 13),
(23, 2),
(23, 3),
(23, 13),
(24, 3),
(24, 4),
(24, 6),
(24, 13),
(25, 3),
(25, 4),
(25, 6),
(25, 13),
(26, 2),
(26, 4),
(27, 2),
(27, 3),
(27, 4),
(32, 1),
(32, 2),
(32, 3),
(32, 13),
(33, 1),
(33, 3),
(33, 13),
(34, 1),
(34, 6),
(34, 8),
(35, 1),
(35, 6),
(35, 8),
(35, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `date_of_birth`, `modified_at`, `created_at`) VALUES
(1, 'yimpatrick@hotmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$rQ1QGS.HS6Trhn2TDC4zQ.28r2d.PffeMm2asTyJ7YrgzInXYd//2', 'Patrick', 'Yim', '1983-10-08 00:00:00', '2022-02-07 22:16:10', '2022-02-07 22:16:10'),
(2, 'jeandeux@jdeux.fr', '[]', '$2y$13$6rF2CL4gAXvzi6jRytiNEuqduvgrG3hMmiPKApsdEQ3Q8mgjyjhJ6', 'Jean', 'Deux', '2002-02-02 00:00:00', '2022-02-07 22:19:52', '2022-02-07 22:19:52'),
(3, 'jeantrois@jtrois.fr', '[]', '$2y$13$YwklDjwTkMLRviZVqOi3h.wqysmpPlU2n82cmyBMkMci2O2TOth1.', 'Jean', 'Trois', '1984-10-09 00:00:00', '2022-02-10 18:58:57', '2022-02-10 18:58:57'),
(4, 'blah@blah.fr', '[]', '$2y$13$f20YV2l43K5YuRN8LYj39.Hkq/OT/l3yir9V2DV021g4ET4NIah5.', 'sljls', '<script>console.log(\'toto\')</script>', '2022-02-12 00:00:00', '2022-02-13 01:52:55', '2022-02-13 01:52:55');

-- --------------------------------------------------------

--
-- Structure de la table `user_collecting`
--

CREATE TABLE `user_collecting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `collecting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_collecting`
--

INSERT INTO `user_collecting` (`id`, `user_id`, `collecting_id`) VALUES
(1, 2, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_item`
--

CREATE TABLE `user_item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_item`
--

INSERT INTO `user_item` (`id`, `user_id`, `item_id`) VALUES
(1, 2, 3),
(2, 2, 6),
(3, 2, 16),
(4, 2, 27),
(5, 2, 17),
(6, 2, 14),
(7, 2, 22),
(8, 2, 11),
(9, 1, 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `collecting`
--
ALTER TABLE `collecting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F1B251E112130C7` (`collecting_id`);

--
-- Index pour la table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`item_id`,`category_id`),
  ADD KEY `IDX_6A41D10A126F525E` (`item_id`),
  ADD KEY `IDX_6A41D10A12469DE2` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `user_collecting`
--
ALTER TABLE `user_collecting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BED2A3BA76ED395` (`user_id`),
  ADD KEY `IDX_3BED2A3B112130C7` (`collecting_id`);

--
-- Index pour la table `user_item`
--
ALTER TABLE `user_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_659A69D7A76ED395` (`user_id`),
  ADD KEY `IDX_659A69D7126F525E` (`item_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `collecting`
--
ALTER TABLE `collecting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user_collecting`
--
ALTER TABLE `user_collecting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_item`
--
ALTER TABLE `user_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E112130C7` FOREIGN KEY (`collecting_id`) REFERENCES `collecting` (`id`);

--
-- Contraintes pour la table `item_category`
--
ALTER TABLE `item_category`
  ADD CONSTRAINT `FK_6A41D10A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6A41D10A126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_collecting`
--
ALTER TABLE `user_collecting`
  ADD CONSTRAINT `FK_3BED2A3B112130C7` FOREIGN KEY (`collecting_id`) REFERENCES `collecting` (`id`),
  ADD CONSTRAINT `FK_3BED2A3BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_item`
--
ALTER TABLE `user_item`
  ADD CONSTRAINT `FK_659A69D7126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `FK_659A69D7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
