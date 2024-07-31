-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 31, 2024 at 12:05 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

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

CREATE TABLE `actors` (
  `actor_id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `imagep` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `last_name`, `first_name`, `date_of_birth`, `imagep`) VALUES
(1, 'Hyun', 'Bin', '1982-09-25', 'img/hyunbin.jpeg'),
(2, 'Song', 'Hye-kyo', '1981-11-22', 'img/songhyekyo.webp'),
(3, 'Gong', 'Yoo', '1979-07-10', 'img/gongyoo.jpeg'),
(4, 'Park', 'Seo-joon', '1988-12-16', 'img/parksj.jpeg'),
(5, 'Jun', 'Ji-hyun', '1981-10-30', 'img/junjh.webp'),
(6, 'Lee', 'Hye-ri', '1994-06-09', 'img/hyeri.jpeg'),
(7, 'Park', 'Bo-young', '1990-02-12', 'img/parkby.jpeg'),
(8, 'Song', 'Joong-ki', '1985-09-19', 'img/joongki.jpeg'),
(9, 'Park', 'Min-young', '1986-03-04', 'img/parkmy.webp'),
(10, 'Bae', 'Suzy', '1994-10-10', 'img/suzy.webp'),
(12, 'Kim', 'Soo-hyun', '1988-02-16', 'img/psoohyun.jpeg'),
(13, 'Lee', 'Min-ho', '1987-06-22', 'img/minho.webp'),
(14, 'Park', 'Eun-bin', '1992-09-04', 'img/eunbin.jpeg'),
(15, 'Han', 'Ye-ri', '1984-12-23', 'img/hanyeri.jpeg'),
(16, 'Lee', 'Jung-jae', '1973-12-15', 'img/jungjae.jpeg'),
(17, 'Kim', 'Se-jeong', '1996-08-28', 'img/sejeong.jpeg'),
(18, 'Han', 'So-hee', '1994-11-18', 'img/hansohee.webp'),
(19, 'Ha', 'Ji-won', '1978-06-28', 'img/hajw.jpeg'),
(20, 'Jung', 'Hae-in', '1988-04-01', 'img/junghaein.jpeg'),
(21, 'Lee', 'Jong-suk', '1989-09-14', 'img/jongsuk.jpeg'),
(22, 'Lee', 'Dong-Wook', '1981-11-06', 'img/dongwook.jpeg'),
(23, 'Yook', 'Sung-Jae', '1995-05-02', 'img/sungjae.jpeg'),
(24, 'Park', 'Bo-Gum', '1993-06-16', 'img/bogum.png'),
(25, 'Kwon', 'Nara', '1991-03-13', 'img/nara.jpeg'),
(26, 'Park', 'Hyun-Sik', '1991-11-16', 'img/hyunsik.jpeg'),
(27, 'Kang', 'Ki-young', '1983-10-14', 'img/kiyoung.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `awardID` int(11) NOT NULL,
  `award_name` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`awardID`, `award_name`) VALUES
(1, 'Daesang'),
(2, 'Best Drama'),
(3, 'Best Director'),
(4, 'Best Screenplay'),
(5, 'Excellence Award - Actor'),
(6, 'Best New Actor'),
(7, 'Best New Actress'),
(8, 'Hallyu Star Award'),
(9, 'Star of the Year Award'),
(10, 'Popular Character Award'),
(11, 'KBS Daesang');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `directorID` int(10) NOT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(20, 'Han', 'Jun-hee'),
(21, 'Leep', 'Eung-bok'),
(22, 'Lee', 'Eung-bok');

-- --------------------------------------------------------

--
-- Table structure for table `dramas`
--

CREATE TABLE `dramas` (
  `drama_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(50) NOT NULL,
  `imagepath` varchar(100) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `rating` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `directorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dramas`
--

INSERT INTO `dramas` (`drama_id`, `title`, `release_date`, `genre`, `imagepath`, `synopsis`, `rating`, `price`, `directorID`) VALUES
(1, 'Crash Landing on You', '2019-12-14', 'Romance', 'img/crash.jpeg', 'A paragliding mishap drops a South Korean heiress in North Korea - and into the life of an army officer, who decides he will help her hide.', '8.7/10', '20.00', 1),
(2, 'Descendants of the Sun', '2016-02-24', 'Romance', 'img/sun.jpeg', 'A love story between a surgeon and a special forces officer, set against the backdrop of peacekeeping missions and humanitarian efforts.', '8.2/10', '20.00', 22),
(3, 'Goblin', '2016-12-02', 'Fantasy', 'img/goblin.jpeg', 'An immortal goblin who needs a human bride to end his cursed immortal life falls in love with a mortal girl who can see ghosts.', '8.6/10', '20.00', 3),
(4, 'Itaewon Class', '2020-01-31', 'Drama', 'img/itaewon.jpeg', 'A group of young people, led by an ex-convict, band together to pursue their dream of opening a street bar in Itaewon and taking down a powerful rival.', '8.2/10', '20.00', 4),
(5, 'My Love from the Star', '2013-12-18', 'Romance', 'img/star.jpeg', 'An alien who landed on Earth 400 years ago begins a romance with a famous actress just as he prepares to return to his home planet.', '8.2/10', '20.00', 5),
(6, 'Reply 1988', '2015-11-06', 'Drama', 'img/reply88.jpeg', 'A nostalgic coming-of-age story about five friends and their families living in the same neighborhood in 1988.', '9.1/10', '20.00', 6),
(7, 'Strong Woman Do Bong Soon', '2017-02-24', 'Comedy', 'img/strong.jpeg', 'A woman born with superhuman strength works as a bodyguard for a rich CEO, while trying to catch a serial kidnapper.', '8.2/10', '20.00', 7),
(8, 'Vincenzo', '2021-02-20', 'Crime', 'img/vincenzo.jpeg', 'A Korean-Italian mafia lawyer returns to South Korea and uses his skills to bring justice to corrupt organizations.\n\n', '8.4/10', '20.00', 8),
(9, 'What\'s Wrong with Secretary Kim', '2018-06-06', 'Romance', 'img/kim.webp', 'A narcissistic vice chairman of a company tries to figure out why his highly capable secretary wants to quit after nine years of working for him.', '8.0/10', '20.00', 9),
(10, 'While You Were Sleeping', '2017-09-27', 'Fantasy', 'img/sleep.jpeg', 'A young woman has premonitions in her dreams, and teams up with a prosecutor to prevent their tragic outcomes.', '8.3/10', '20.00', 10),
(11, 'The Heirs', '2013-10-09', 'Drama', 'img/heirs.jpeg', 'Wealthy high school students grapple with issues of love, friendship, and family obligations while preparing to inherit their family businesses.', '7.5/10', '20.00', 11),
(12, 'Extraordinary Attorney Woo', '2022-06-29', 'Drama', 'img/woo.jpeg', 'A brilliant but socially awkward lawyer with autism spectrum disorder faces challenges and triumphs in her professional and personal life.', '8.6/10', '20.00', 12),
(13, 'Hello, my twenties!', '2016-06-22', 'Comedy', 'img/hello.jpeg', 'Five girls with different personalities share a house, navigating their twenties through love, friendship, and personal growth.', '8.2/10', '20.00', 13),
(14, 'Squid Game', '2021-09-16', 'Thriller', 'img/squid.jpeg', 'Desperate contestants compete in deadly children\'s games for a chance to win a life-changing cash prize, revealing the darkest sides of human nature.', '8.0/10', '20.00', 14),
(15, 'Business Proposal', '2022-02-28', 'Romance', 'img/proposal.jpeg', 'A romantic comedy where an employee stands in for her friend on a blind date, only to discover her date is her company\'s CEO.', '8.1/10', '20.00', 15),
(16, 'My Name', '2021-10-15', 'Action', 'img/myname.jpeg', 'After witnessing her father\'s murder, a woman joins a gang and becomes an undercover cop to uncover the truth and seek revenge.', '7.8/10', '20.00', 16),
(17, 'Secret Garden', '2010-11-13', 'Comedy', 'img/garden.jpeg', 'A stuntwoman and a CEO magically swap bodies, leading to a series of comedic and romantic adventures as they learn to understand each other.', '8.1/10', '20.00', 17),
(18, 'The King\'s Affection', '2021-10-11', 'Historical', 'img/king.jpeg', 'A secret romance unfolds in the royal court when a crown prince, who is actually a woman disguised as her deceased brother, falls for her teacher.', '8.0/10', '20.00', 18),
(19, 'The Glory', '2022-12-30', 'Thriller', 'img/glory.jpeg', 'A woman, scarred by childhood bullying, meticulously plots revenge against her tormentors as an adult.', '8.1/10', '20.00', 19),
(20, 'D.P.', '2021-08-27', 'Action', 'img/dp.jpeg', 'A young private in the South Korean military is assigned to a unit that tracks down AWOL soldiers, uncovering personal and systemic issues within the army.', '8.2/10', '20.00', 20);

-- --------------------------------------------------------

--
-- Table structure for table `drama_actors`
--

CREATE TABLE `drama_actors` (
  `drama_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drama_actors`
--

INSERT INTO `drama_actors` (`drama_id`, `actor_id`) VALUES
(1, 1),
(1, 12),
(2, 2),
(2, 8),
(3, 3),
(3, 22),
(3, 23),
(4, 11),
(4, 24),
(4, 25),
(5, 5),
(5, 12),
(6, 6),
(6, 24),
(7, 7),
(8, 8),
(9, 9),
(9, 11),
(9, 26),
(10, 10),
(10, 20),
(11, 13),
(12, 14),
(12, 26),
(13, 14),
(13, 15),
(14, 3),
(14, 16),
(15, 17),
(16, 18),
(17, 1),
(17, 19),
(17, 21),
(18, 14),
(19, 2),
(20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `drama_awards`
--

CREATE TABLE `drama_awards` (
  `drama_id` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drama_awards`
--

INSERT INTO `drama_awards` (`drama_id`, `awardID`) VALUES
(2, 2),
(5, 2),
(11, 2),
(2, 3),
(6, 3),
(9, 3),
(10, 3),
(2, 5),
(6, 5),
(8, 5),
(5, 9),
(8, 9),
(10, 9),
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`) VALUES
(8, 0, '2024-07-31 01:34:35', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `drama_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `drama_id`, `quantity`, `unit_price`) VALUES
(9, 8, 1, 1, '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `drama_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `user_id`, `drama_id`, `purchase_date`) VALUES
(6, 0, 1, '2024-07-31 07:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `account_type`, `created_at`) VALUES
(1, '', '', 'admin', '$2y$10$eB7aZuCq.k7S6hYZ9x8M.eBl/DxuEfzOTCE2BftL3w7pxQG4BsTzK', 'admin@example.com', '', '2024-07-23 15:49:46'),
(2, '', '', 'user1', '$2y$10$EIXYH/fiwlZ/ZcKHZDGfX.JG9LglZy96k0JYVp5NUDUL3CpIZ4EE2', 'user1@example.com', '', '2024-07-23 15:49:46'),
(7, 'Bill', 'Smith', 'bsmith', '$2y$10$S9jJLNZ7bhkxyl7SvxZtGevaqaFUOlULPVOp365ZeJlKbkkyB8rPG', 'bsmith@gmail.com', 'admin', '2024-07-27 11:44:37'),
(10, 'Pauline', 'Jones', 'pjones', '$2y$10$GGEoEbVb5CnAS0i.h3WqzuD4SY6vm4HlnGhY3vkqtwKFvlckvhKZ.', 'pjones@gmail.com', 'user', '2024-07-31 08:17:40'),
(11, 'test', 'mctest', 'tester', '$2y$10$iSoU8QbzzsRsdGz/csBAROyORPo3eBBI0C5m5sFctb3J5g9P77.oK', 'test@gmail.com', 'admin', '2024-07-31 08:22:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`awardID`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`directorID`);

--
-- Indexes for table `dramas`
--
ALTER TABLE `dramas`
  ADD PRIMARY KEY (`drama_id`),
  ADD KEY `fk_director` (`directorID`);

--
-- Indexes for table `drama_actors`
--
ALTER TABLE `drama_actors`
  ADD PRIMARY KEY (`drama_id`,`actor_id`);

--
-- Indexes for table `drama_awards`
--
ALTER TABLE `drama_awards`
  ADD PRIMARY KEY (`drama_id`,`awardID`),
  ADD KEY `awardID` (`awardID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `drama_id` (`drama_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `drama_id` (`drama_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `awardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `directorID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `dramas`
--
ALTER TABLE `dramas`
  MODIFY `drama_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dramas`
--
ALTER TABLE `dramas`
  ADD CONSTRAINT `fk_director` FOREIGN KEY (`directorID`) REFERENCES `director` (`directorID`);

--
-- Constraints for table `drama_awards`
--
ALTER TABLE `drama_awards`
  ADD CONSTRAINT `fk_awards` FOREIGN KEY (`awardID`) REFERENCES `awards` (`awardID`),
  ADD CONSTRAINT `fk_drama` FOREIGN KEY (`drama_id`) REFERENCES `dramas` (`drama_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
