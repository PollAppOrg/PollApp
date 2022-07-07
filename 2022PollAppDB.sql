-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2022 at 03:31 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2022pollappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `vote_1` int(11) NOT NULL DEFAULT '0',
  `vote_2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `image`, `author_id`, `option_1`, `option_2`, `date_created`, `date_modified`, `vote_1`, `vote_2`) VALUES
(4, 'What should I wear today?', 'soss2', 'public/images/itec_62b751c2a1f24.jpeg', 1, 'T-Shirt', 'Jackettu', '2022-06-24 18:51:20', NULL, 2, 1),
(6, 'Love or Career?', 'sosowewq', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Love', 'Career', '2022-06-24 19:06:06', NULL, 14, 7),
(7, 'Pineapple on pizza?', 'yes or no', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Yes', 'No', '2022-06-24 19:06:34', NULL, 3, 1),
(8, 'Cat or Dog?', '...._....', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Cat', 'Dog', '2022-06-24 19:06:56', NULL, 1, 1),
(9, 'Coke or Pepsi?', ':&gt;', 'public\\images\\cho-corgi-mong-to.jpg', 1, 'Coke', 'Pepsi', '2022-06-24 20:08:46', NULL, 1, 0),
(10, 'Sleep or Study?', 'zzzzzzz', 'public\\images\\cho-corgi-mong-to.jpg', 1, 'Sleep', 'Study', '2022-06-24 20:09:08', NULL, 0, 1),
(11, 'Run or Walk', 'I don\'t know', 'public/images/cho-corgi-mong-to.jpg', 1, 'Run', 'Walk', '2022-07-06 10:04:46', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '2',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `date_created`, `date_updated`, `img`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Jmn/6WuYwvE1Q9ynlb2IaO9NuAfXZoKr5TAbGlBHkezlmbyM4xrwC', 1, '2022-06-16 15:05:30', NULL, 'images/pollapp_user.png'),
(10, 'admin2', 'admin@gmail.com', '$2y$10$fafn4FXhmbkaABJz.Jw8a.WY/Z05G1lsOrLqSHPQs90sstORvRT4e', 2, '2022-06-24 15:15:33', NULL, 'images/pollapp_user.png');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `username` varchar(55) NOT NULL,
  `pool_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`username`, `pool_id`) VALUES
('admin', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
