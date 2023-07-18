-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 08:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `religionexplorer`
--

-- --------------------------------------------------------

--
-- Table structure for table `topic_votes`
--

CREATE TABLE `topic_votes` (
  `voteId` int(10) NOT NULL,
  `topicId` int(8) NOT NULL,
  `accountid` varchar(5) NOT NULL,
  `voteType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic_votes`
--

INSERT INTO `topic_votes` (`voteId`, `topicId`, `accountid`, `voteType`) VALUES
(8, 89888896, 'R0001', 'upvote'),
(9, 75631721, 'R0001', 'upvote'),
(10, 21767941, 'R0001', 'upvote'),
(11, 79165743, 'R0001', 'upvote'),
(12, 89888896, 'R0002', 'upvote'),
(14, 21767941, 'R0002', 'upvote');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topic_votes`
--
ALTER TABLE `topic_votes`
  ADD PRIMARY KEY (`voteId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `topic_votes`
--
ALTER TABLE `topic_votes`
  MODIFY `voteId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `topic_votes`
--
ALTER TABLE `topic_votes`
  ADD CONSTRAINT `fk_topic_votes_topicId` FOREIGN KEY (`topicId`) REFERENCES `topics` (`topicId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
