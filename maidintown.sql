-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2015 at 08:51 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maidintown`
--

-- --------------------------------------------------------

--
-- Table structure for table `maids`
--

CREATE TABLE IF NOT EXISTS `maids` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contract` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maids`
--

INSERT INTO `maids` (`id`, `name`, `gender`, `contract`) VALUES
(3, 'Angelina Jolie', 'female', 'annual'),
(4, 'Brad Pitt', 'male', 'annual'),
(5, 'Megan Fox', 'female', 'annual'),
(6, 'Keira Knightley', 'female', 'monthly'),
(7, 'Tom Cruise', 'male', 'monthly'),
(11, 'Uma Thurman', 'female', 'annual'),
(14, 'Liz Taylor', 'female', 'annual'),
(15, 'Sonam Kapoor', 'female', 'annual'),
(20, 'Keanu Reeves', 'male', 'monthly'),
(22, 'Taylor Swift', 'female', 'monthly'),
(25, 'Justin Beiber', 'male', 'monthly');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dishes` tinyint(1) NOT NULL,
  `clothes` tinyint(1) NOT NULL,
  `cooking` tinyint(1) NOT NULL,
  `maintenance` tinyint(1) NOT NULL,
  `beautification` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `dishes`, `clothes`, `cooking`, `maintenance`, `beautification`) VALUES
(6, 13, 1, 1, 0, 0, 0),
(9, 14, 0, 1, 1, 0, 0),
(38, 15, 0, 0, 1, 1, 1),
(40, 16, 0, 0, 0, 0, 1),
(43, 12, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_price`
--

CREATE TABLE IF NOT EXISTS `task_price` (
`id` int(11) NOT NULL,
  `dishes` int(11) NOT NULL,
  `clothes` int(11) NOT NULL,
  `cooking` int(11) NOT NULL,
  `maintenance` int(11) NOT NULL,
  `beatification` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_price`
--

INSERT INTO `task_price` (`id`, `dishes`, `clothes`, `cooking`, `maintenance`, `beatification`) VALUES
(1, 100, 150, 200, 300, 500);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`) VALUES
(11, 'admin', 'admin@gmail.com', 'admin', 'BRACU', '01534657456'),
(12, 'Md. Rayed Bin Wahed', 'mohammedrayed@gmail.com', 'rayed', 'Uttara', '01534657456'),
(13, 'Rafiu Bin Wahed', 'rafiu.wahed@gmail.com', 'rafiu', 'Uttara', '0123123123'),
(14, 'just', 'just@yahoo.com', 'just', 'just', '23'),
(15, 'Salma Maliha Mou', 'salma_maliha@gmail.com', 'mou', 'Shegunbaghicha', '01757507678'),
(16, 'Saadruddin', 'saad@hotmail.com', 'saad', 'Mirpur', '123123123');

-- --------------------------------------------------------

--
-- Table structure for table `user_maid`
--

CREATE TABLE IF NOT EXISTS `user_maid` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `maid_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_maid`
--

INSERT INTO `user_maid` (`id`, `user_id`, `maid_id`, `total_price`) VALUES
(1, 12, 3, 650),
(5, 13, 25, 800),
(9, 14, 22, 800),
(10, 15, 11, 1000),
(11, 16, 3, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maids`
--
ALTER TABLE `maids`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task_price`
--
ALTER TABLE `task_price`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_maid`
--
ALTER TABLE `user_maid`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id_2` (`user_id`), ADD UNIQUE KEY `user_id_3` (`user_id`), ADD KEY `user_id` (`user_id`), ADD KEY `maid_id` (`maid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maids`
--
ALTER TABLE `maids`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `task_price`
--
ALTER TABLE `task_price`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_maid`
--
ALTER TABLE `user_maid`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_maid`
--
ALTER TABLE `user_maid`
ADD CONSTRAINT `user_maid_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_maid_ibfk_2` FOREIGN KEY (`maid_id`) REFERENCES `maids` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
