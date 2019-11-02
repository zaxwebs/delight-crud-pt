-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2019 at 06:00 PM
-- Server version: 5.7.19
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delight-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `person_id`, `content`, `time`) VALUES
(11, 11, 'Obsessed with the string theory?', '2019-11-01 17:52:55'),
(12, 11, 'Might \'Bazinga!\' you.', '2019-11-01 17:53:16'),
(13, 8, 'Now in California.', '2019-11-01 17:53:34'),
(14, 8, 'Likes pizzas!', '2019-11-01 17:53:48'),
(15, 2, 'Likes building things.', '2019-11-01 17:54:16'),
(16, 7, 'Might not be a noble judge.', '2019-11-01 17:54:42'),
(17, 7, 'Likes Fortnite.', '2019-11-01 17:55:25'),
(18, 2, 'Enjoys solitude.', '2019-11-01 17:56:12'),
(19, 9, 'Loves POP music.', '2019-11-01 17:56:27'),
(20, 9, 'A secret fan of BTS.', '2019-11-01 17:56:42'),
(21, 10, 'Invested $20M in VR recently.', '2019-11-01 17:58:04'),
(23, 2, 'Spins digital webs at times.', '2019-11-01 17:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `intro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `intro`) VALUES
(2, 'Zack Webster', 'Your friendly neighbourhood webster.'),
(7, 'Judy Noble', 'My best friend.'),
(8, 'Jazmin Pearson', 'My friend since school.'),
(9, 'Lucy Quest', 'The workplace friend who is just amazing.'),
(10, 'Shyam Allison', 'CEO of Mega Corp Inc.'),
(11, 'Sheldon Cooper', 'The scientist we all know.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes-person` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
