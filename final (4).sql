-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2024 at 04:33 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `actor_id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `directorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`actor_id`),
  KEY `fk_directorID` (`directorID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `last_name`, `first_name`, `date_of_birth`, `directorID`) VALUES
(1, 'Hyun', 'Bin', '1982-09-25', NULL),
(2, 'Song', 'Hye-kyo', '1981-11-22', NULL),
(3, 'Gong', 'Yoo', '1979-07-10', NULL),
(4, 'Park', 'Seo-joon', '1988-12-16', NULL),
(5, 'Jun', 'Ji-hyun', '1981-10-30', NULL),
(6, 'Lee', 'Hye-ri', '1994-06-09', NULL),
(7, 'Park', 'Bo-young', '1990-02-12', NULL),
(8, 'Song', 'Joong-ki', '1985-09-19', NULL),
(9, 'Park', 'Min-young', '1986-03-04', NULL),
(10, 'Bae', 'Suzy', '1994-10-10', NULL),
(11, 'Park', 'Seo-joon', '1988-12-16', NULL),
(12, 'Kim', 'Soo-hyun', '1988-02-16', NULL),
(13, 'Lee', 'Min-ho', '1987-06-22', NULL),
(14, 'Park', 'Eun-bin', '1992-09-04', NULL),
(15, 'Han', 'Ye-ri', '1984-12-23', NULL),
(16, 'Lee', 'Jung-jae', '1973-12-15', NULL),
(17, 'Kim', 'Se-jeong', '1996-08-28', NULL),
(18, 'Han', 'So-hee', '1994-11-18', NULL),
(19, 'Ha', 'Ji-won', '1978-06-28', NULL),
(20, 'Jung', 'Hae-in', '1988-04-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
  `awardID` int(10) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(75) DEFAULT NULL,
  `drama_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`awardID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`awardID`, `award_name`, `drama_id`) VALUES
(1, 'Daesang', NULL),
(2, 'Best Drama', NULL),
(3, 'Best Director', NULL),
(4, 'Best Screenplay', NULL),
(5, 'Excellence Award, Actor', NULL),
(6, 'Best New Actor', NULL),
(7, 'Best New Actress', NULL),
(8, 'Hallyu Star Award', NULL),
(9, 'Star of the Year Award', NULL),
(10, 'Popular Character Award', NULL),
(11, 'KBS Daesang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

DROP TABLE IF EXISTS `director`;
CREATE TABLE IF NOT EXISTS `director` (
  `directorID` int(10) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(25) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`directorID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`directorID`, `lastname`, `firstname`) VALUES
(1, 'Lee', 'Jung-hyo'),
(2, 'Lee', 'Eung-bok'),
(3, 'Lee', 'Eung-bok'),
(4, 'Kim', 'Sung-yoon'),
(5, 'Jang', 'Tae-yoo'),
(6, 'Shin', 'Won-ho'),
(7, 'Lee', 'Hyung-min'),
(8, 'Kim', 'Hee-won'),
(9, 'Park', 'Joon-hwa'),
(10, 'Oh', 'Choong-hwan'),
(11, 'Kang', 'Shin-hyo'),
(12, 'Yoo', 'In-shik'),
(13, 'Lee', 'Tae-gon'),
(14, 'Hwang', 'Dong-hyuk'),
(15, 'Park', 'Seon-ho'),
(16, 'Kim', 'Jin-min'),
(17, 'Shin', 'Woo-chul'),
(18, 'Song', 'Hyun-wook'),
(19, 'Ahn', 'Gil-ho'),
(20, 'Han', 'Jun-hee');

-- --------------------------------------------------------

--
-- Table structure for table `dramas`
--

DROP TABLE IF EXISTS `dramas`;
CREATE TABLE IF NOT EXISTS `dramas` (
  `drama_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(50) NOT NULL,
  `imagepath` varchar(100) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `rating` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`drama_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dramas`
--

INSERT INTO `dramas` (`drama_id`, `title`, `release_date`, `genre`, `imagepath`, `synopsis`, `rating`, `price`) VALUES
(1, 'Crash Landing on You', '2019-12-14', 'Romance', 'img/crash.jpeg', 'A South Korean heiress accidentally paraglides into North Korea and crashes into the life of an elite North Korean officer, who decides he will help her hide.', '8.7/10', '20.00'),
(2, 'Descendants of the Sun', '2016-02-24', 'Romance', 'img/sun.jpeg', 'A love story between a surgeon and a special forces officer, set against the backdrop of peacekeeping missions and humanitarian efforts.', '8.2/10', '20.00'),
(3, 'Goblin', '2016-12-02', 'Fantasy', 'img/goblin.jpeg', 'An immortal goblin who needs a human bride to end his cursed immortal life falls in love with a mortal girl who can see ghosts.', '8.6/10', '20.00'),
(4, 'Itaewon Class', '2020-01-31', 'Drama', 'img/itaewon.jpeg', 'A group of young people, led by an ex-convict, band together to pursue their dream of opening a street bar in Itaewon and taking down a powerful rival.', '8.2/10', '20.00'),
(5, 'My Love from the Star', '2013-12-18', 'Romance', 'img/star.jpeg', 'An alien who landed on Earth 400 years ago begins a romance with a famous actress just as he prepares to return to his home planet.', '8.2/10', '20.00'),
(6, 'Reply 1988', '2015-11-06', 'Drama', 'img/reply88.jpeg', 'A nostalgic coming-of-age story about five friends and their families living in the same neighborhood in 1988.', '9.1/10', '20.00'),
(7, 'Strong Woman Do Bong Soon', '2017-02-24', 'Comedy', 'img/strong.jpeg', 'A woman born with superhuman strength works as a bodyguard for a rich CEO, while trying to catch a serial kidnapper.', '8.2/10', '20.00'),
(8, 'Vincenzo', '2021-02-20', 'Crime', 'img/vincenzo.jpeg', 'A Korean-Italian mafia lawyer returns to South Korea and uses his skills to bring justice to corrupt organizations.\n\n', '8.4/10', '20.00'),
(9, 'What\'s Wrong with Secretary Kim', '2018-06-06', 'Romance', 'img/kim.webp', 'A narcissistic vice chairman of a company tries to figure out why his highly capable secretary wants to quit after nine years of working for him.', '8.0/10', '20.00'),
(10, 'While You Were Sleeping', '2017-09-27', 'Fantasy', 'img/sleep.jpeg', 'A young woman has premonitions in her dreams, and teams up with a prosecutor to prevent their tragic outcomes.', '8.3/10', '20.00'),
(11, 'The Heirs', '2013-10-09', 'Drama', 'img/heirs.jpeg', 'Wealthy high school students grapple with issues of love, friendship, and family obligations while preparing to inherit their family businesses.', '7.5/10', '20.00'),
(12, 'Extraordinary Attorney Woo', '2022-06-29', 'Drama', 'img/woo.jpeg', 'A brilliant but socially awkward lawyer with autism spectrum disorder faces challenges and triumphs in her professional and personal life.', '8.6/10', '20.00'),
(13, 'Hello, my twenties!', '2016-06-22', 'Comedy', 'img/hello.jpeg', 'Five girls with different personalities share a house, navigating their twenties through love, friendship, and personal growth.', '8.2/10', '20.00'),
(14, 'Squid Game', '2021-09-16', 'Thriller', 'img/squid.jpeg', 'Desperate contestants compete in deadly children\'s games for a chance to win a life-changing cash prize, revealing the darkest sides of human nature.', '8.0/10', '20.00'),
(15, 'Business Proposal', '2022-02-28', 'Romance', 'img/proposal.jpeg', 'A romantic comedy where an employee stands in for her friend on a blind date, only to discover her date is her company\'s CEO.', '8.1/10', '20.00'),
(16, 'My Name', '2021-10-15', 'Action', 'img/myname.jpeg', 'After witnessing her father\'s murder, a woman joins a gang and becomes an undercover cop to uncover the truth and seek revenge.', '7.8/10', '20.00'),
(17, 'Secret Garden', '2010-11-13', 'Comedy', 'img/garden.jpeg', 'A stuntwoman and a CEO magically swap bodies, leading to a series of comedic and romantic adventures as they learn to understand each other.', '8.1/10', '20.00'),
(18, 'The King\'s Affection', '2021-10-11', 'Historical', 'img/king.jpeg', 'A secret romance unfolds in the royal court when a crown prince, who is actually a woman disguised as her deceased brother, falls for her teacher.', '8.0/10', '20.00'),
(19, 'The Glory', '2022-12-30', 'Thriller', 'img/glory.jpeg', 'A woman, scarred by childhood bullying, meticulously plots revenge against her tormentors as an adult.', '8.1/10', '20.00'),
(20, 'D.P.', '2021-08-27', 'Action', 'img/dp.jpeg', 'A young private in the South Korean military is assigned to a unit that tracks down AWOL soldiers, uncovering personal and systemic issues within the army.', '8.2/10', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`) VALUES
(1, 0, '2024-07-30 17:43:46', '20.00'),
(2, 0, '2024-07-30 17:44:09', '20.00'),
(3, 0, '2024-07-30 17:46:56', '20.00'),
(4, 0, '2024-07-30 17:50:37', '20.00'),
(5, 0, '2024-07-30 17:59:34', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `drama_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `drama_id` (`drama_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `drama_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 1, '20.00'),
(2, 2, 1, 1, '20.00'),
(3, 3, 1, 1, '20.00'),
(4, 4, 1, 1, '20.00'),
(5, 5, 2, 1, '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `drama_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`),
  KEY `user_id` (`user_id`),
  KEY `drama_id` (`drama_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `user_id`, `drama_id`, `purchase_date`) VALUES
(1, 1, 2, '2024-07-30 23:57:13'),
(2, 0, 2, '2024-07-30 23:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `username`, `role`) VALUES
(1, 'bsmith', 'admin'),
(2, 'pjones', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `account_type`, `created_at`) VALUES
(1, '', '', 'admin', '$2y$10$eB7aZuCq.k7S6hYZ9x8M.eBl/DxuEfzOTCE2BftL3w7pxQG4BsTzK', 'admin@example.com', '', '2024-07-23 15:49:46'),
(2, '', '', 'user1', '$2y$10$EIXYH/fiwlZ/ZcKHZDGfX.JG9LglZy96k0JYVp5NUDUL3CpIZ4EE2', 'user1@example.com', '', '2024-07-23 15:49:46'),
(7, 'Bill', 'Smith', 'bsmith', '$2y$10$S9jJLNZ7bhkxyl7SvxZtGevaqaFUOlULPVOp365ZeJlKbkkyB8rPG', 'bsmith@gmail.com', 'admin', '2024-07-27 11:44:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
