-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 08:49 AM
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
-- Table structure for table `reply_votes`
--

CREATE TABLE `reply_votes` (
  `voteId` int(10) NOT NULL,
  `replyId` int(8) NOT NULL,
  `accountid` varchar(5) NOT NULL,
  `voteType` varchar(10) NOT NULL,
  `replyVoteDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply_votes`
--

INSERT INTO `reply_votes` (`voteId`, `replyId`, `accountid`, `voteType`, `replyVoteDate`) VALUES
(171, 80492084, 'R0002', 'upvote', '2023-09-04 14:22:53'),
(172, 35860036, 'R0002', 'upvote', '2023-09-04 14:22:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reply_votes`
--
ALTER TABLE `reply_votes`
  ADD PRIMARY KEY (`voteId`),
  ADD KEY `fk_reply_votes_replyId` (`replyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reply_votes`
--
ALTER TABLE `reply_votes`
  MODIFY `voteId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
