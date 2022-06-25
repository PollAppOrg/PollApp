-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2022 at 06:30 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `image`, `author_id`, `option_1`, `option_2`, `date_created`, `date_modified`, `vote_1`, `vote_2`) VALUES
(4, 'What should I wear today?', 'soss2', 'public/images/itec_62b751c2a1f24.jpeg', 1, 'T-Shirt', 'Jackettu', '2022-06-24 18:51:20', NULL, 2, 1),
(6, 'Love or Career?', 'sosowewq', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Love', 'Career', '2022-06-24 19:06:06', NULL, 4, 1),
(7, 'Pineapple on pizza?', 'yes or no', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Yes', 'No', '2022-06-24 19:06:34', NULL, 0, 1),
(8, 'Cat or Dog?', '...._....', 'public\\images\\cho-corgi-mong-to.jpg', 10, 'Cat', 'Dog', '2022-06-24 19:06:56', NULL, 0, 1),
(9, 'Coke or Pepsi?', ':&gt;', 'public\\images\\cho-corgi-mong-to.jpg', 1, 'Coke', 'Pepsi', '2022-06-24 20:08:46', NULL, 1, 0),
(10, 'Sleep or Study?', 'zzzzzzz', 'public\\images\\cho-corgi-mong-to.jpg', 1, 'Sleep', 'Study', '2022-06-24 20:09:08', NULL, 0, 1),
(14, 'asdfasd', 'fsadfasd', 'public/images/cho-corgi-mong-to.jpg', 1, 'adfa', 'sdaf', '2022-06-26 00:47:00', NULL, 0, 0),
(15, 'asdfasd', 'fsadfasd', 'public/images/cho-corgi-mong-to.jpg', 1, 'adfa', 'sdaf', '2022-06-26 00:47:27', NULL, 0, 0),
(21, 'asdfasdf', 'Ã¡dfa', 'public/images/itec_62b751c2a1f24.jpeg', 1, 'sdfas', 'Ã¡', '2022-06-26 01:19:46', NULL, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
