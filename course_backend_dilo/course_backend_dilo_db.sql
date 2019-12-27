-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2019 at 03:43 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_backend_dilo_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_GAME` (IN `idgame` INT(255))  NO SQL
BEGIN
	DELETE from level_tbl where id_game = idgame;
    DELETE from game_tbl where id_game = idgame;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GAME` ()  NO SQL
BEGIN
	select * from game_tbl;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_HighScore` ()  NO SQL
BEGIN
select a.username,sum(a.sc), a.id_game from (select id_level,username, max(score) as sc,id_game from interaksi_tbl join level_tbl using(id_level) group by username, id_level) a group by a.username, a.id_game ORDER BY `a`.`id_game` ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_LEVEL` ()  NO SQL
BEGIN
	select id_level,concat(game_tbl.nama,' - ',level_tbl.nama) as nama from level_tbl join game_tbl using(id_game) where status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_LEVEL_ONLY` ()  NO SQL
BEGIN
	SELECT * from level_tbl;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `game_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `game_leaderboard` (
`username` varchar(255)
,`score` decimal(65,0)
,`id_game` int(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `game_tbl`
--

CREATE TABLE `game_tbl` (
  `id_game` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_tbl`
--

INSERT INTO `game_tbl` (`id_game`, `nama`, `status`) VALUES
(1, 'Tebak Saya', 1),
(2, 'Ini Game Apa', 1),
(3, 'Hoax Game', 0);

-- --------------------------------------------------------

--
-- Table structure for table `interaksi_tbl`
--

CREATE TABLE `interaksi_tbl` (
  `id_interaksi` int(255) NOT NULL,
  `id_level` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `score` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interaksi_tbl`
--

INSERT INTO `interaksi_tbl` (`id_interaksi`, `id_level`, `username`, `score`) VALUES
(1, 1, 'admin', 100),
(5, 2, 'admin', 90),
(6, 3, 'admin', 80),
(7, 4, 'admin', 70),
(8, 5, 'admin', 50),
(9, 6, 'admin', 50),
(10, 7, 'admin', 60),
(11, 8, 'admin', 70),
(12, 9, 'admin', 100),
(13, 5, 'admin', 100),
(14, 4, 'admin', 80),
(15, 1, 'Hoax', 100),
(16, 2, 'Hoax', 80),
(17, 2, 'Hoax', 60),
(18, 3, 'Hoax', 100),
(19, 4, 'Hoax', 20),
(20, 6, 'Hoax', 100),
(21, 7, 'Hoax', 100),
(22, 8, 'Hoax', 100);

-- --------------------------------------------------------

--
-- Table structure for table `level_tbl`
--

CREATE TABLE `level_tbl` (
  `id_level` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_game` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_tbl`
--

INSERT INTO `level_tbl` (`id_level`, `nama`, `id_game`) VALUES
(1, 'Level - 01', 1),
(2, 'Level - 02', 1),
(3, 'Level - 03', 1),
(4, 'Level - 04', 1),
(5, 'Level - 05', 1),
(6, 'Level - 01', 2),
(7, 'Level - 02', 2),
(8, 'Level - 03', 2),
(9, 'Level - 04', 2),
(10, 'Level - 01', 3),
(11, 'Level - 02', 3),
(12, 'Level - 03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`username`, `nama`, `password`, `token`, `email`, `status`) VALUES
('admin', 'Kaonia', '202cb962ac59075b964b07152d234b70', '68c6dc1bc334139edcad53de6513966a', 'araara@gmail.com', 0),
('Hoax', 'Koari', '250cf8b51c773f3f8dc8b4be867a9a02', '7d1b11d99067ae660bf189dfd0efc161', 'apa@mail.com', 0),
('iniadmin', 'Koari Kaonia', 'e10adc3949ba59abbe56e057f20f883e', 'd1c2349d78e45b636ff54b2fc870bf7b', 'arinia@mail.com', 1);

-- --------------------------------------------------------

--
-- Structure for view `game_leaderboard`
--
DROP TABLE IF EXISTS `game_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `game_leaderboard`  AS  select `a`.`username` AS `username`,sum(`a`.`sc`) AS `score`,`a`.`id_game` AS `id_game` from (select `interaksi_tbl`.`username` AS `username`,max(`interaksi_tbl`.`score`) AS `sc`,`level_tbl`.`id_game` AS `id_game` from (`interaksi_tbl` join `level_tbl` on(`interaksi_tbl`.`id_level` = `level_tbl`.`id_level`)) group by `interaksi_tbl`.`username`,`interaksi_tbl`.`id_level`) `a` group by `a`.`username`,`a`.`id_game` order by `a`.`id_game` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_tbl`
--
ALTER TABLE `game_tbl`
  ADD PRIMARY KEY (`id_game`);

--
-- Indexes for table `interaksi_tbl`
--
ALTER TABLE `interaksi_tbl`
  ADD PRIMARY KEY (`id_interaksi`),
  ADD KEY `FK_LEVEL_TBL_LEVELID` (`id_level`),
  ADD KEY `FK_USER_TBL_USERNAME` (`username`);

--
-- Indexes for table `level_tbl`
--
ALTER TABLE `level_tbl`
  ADD PRIMARY KEY (`id_level`),
  ADD KEY `FK_GAME_TBL_GAMEID` (`id_game`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_tbl`
--
ALTER TABLE `game_tbl`
  MODIFY `id_game` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interaksi_tbl`
--
ALTER TABLE `interaksi_tbl`
  MODIFY `id_interaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `level_tbl`
--
ALTER TABLE `level_tbl`
  MODIFY `id_level` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interaksi_tbl`
--
ALTER TABLE `interaksi_tbl`
  ADD CONSTRAINT `FK_LEVEL_TBL_LEVELID` FOREIGN KEY (`id_level`) REFERENCES `level_tbl` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USER_TBL_USERNAME` FOREIGN KEY (`username`) REFERENCES `user_tbl` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `level_tbl`
--
ALTER TABLE `level_tbl`
  ADD CONSTRAINT `FK_GAME_TBL_GAMEID` FOREIGN KEY (`id_game`) REFERENCES `game_tbl` (`id_game`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
