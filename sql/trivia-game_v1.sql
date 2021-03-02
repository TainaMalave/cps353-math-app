-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2021 at 07:50 PM
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
-- Database: `trivia-game`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `q_id` bigint(20) NOT NULL,
  `a_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_answers` (`q_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `q_id`, `a_text`, `is_correct`) VALUES
(7, 4, '81', 0),
(8, 4, '9', 1),
(9, 4, '22', 0),
(10, 4, '10', 0),
(11, 3, 'Donald Trump', 0),
(12, 3, 'Bill Clinton', 0),
(13, 3, 'George Washington', 0),
(14, 3, 'Martin Luther King Jr.', 1),
(15, 5, 'Alaska', 1),
(16, 5, 'Rhode Island ', 0),
(17, 5, 'California', 0),
(18, 5, 'New York', 0),
(19, 6, 'Iowa', 0),
(20, 6, 'Texas', 0),
(21, 6, 'New York', 0),
(22, 6, 'Delaware', 1),
(23, 7, 'Erie', 0),
(24, 7, 'Finger Lakes', 1),
(25, 7, 'Ontario', 0),
(26, 7, 'Superior', 0),
(27, 8, 'True', 1),
(28, 8, 'False', 0),
(29, 9, 'False', 0),
(30, 9, 'True', 1),
(31, 10, 'English romantic poet', 1),
(32, 10, 'English Author', 0),
(33, 10, 'Famous English Scientist', 0),
(34, 10, 'A famous geologist ', 0),
(35, 11, 'acute angle', 0),
(36, 11, 'left angle', 0),
(37, 11, 'right angle', 1),
(38, 11, 'obtuse angle', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `q_title` text NOT NULL,
  `q_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `q_title`, `q_text`) VALUES
(3, 'Who was the speaker that gave the \"I had a dream speach\"?', 'MLK Jr'),
(4, 'What is the square root of 81?', '9'),
(5, 'What is the largest state in the United States of America? ', 'Alaska'),
(6, 'Dover is the capital of which state?', 'Delaware'),
(7, 'Which of the following is not one of the 5 great lakes? ', 'Finger Lakes'),
(8, 'True or False: The temporal lobe is located in the brain?', 'true'),
(9, 'True or False: The indication of any future event is known as foreshadowing?', 'true'),
(10, 'Who was William Wordsworth?', 'english romantic poet'),
(11, 'A 90 degree angle is called what?', 'a right angle');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `deleted_at`) VALUES
(2, 'tmalave', '32250170a0dca92d53ec9624f336ca24', '2021-03-01 14:11:03', NULL),
(3, 'tainamalave', '482c811da5d5b4bc6d497ffa98491e38', '2021-03-01 16:49:53', NULL),
(4, 'tai', '5f4dcc3b5aa765d61d8327deb882cf99', '2021-03-01 18:15:22', NULL),
(5, 'tm', '1a1dc91c907325c69271ddf0c944bc72', '2021-03-02 11:35:01', NULL),
(6, 'rachel', '5f4dcc3b5aa765d61d8327deb882cf99', '2021-03-02 13:20:44', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_questions_answers` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
