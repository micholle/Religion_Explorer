-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 12:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationid` int(11) NOT NULL,
  `accountid` varchar(5) NOT NULL,
  `personaleventid` varchar(19) DEFAULT NULL,
  `creationid` varchar(19) DEFAULT NULL,
  `topicid` int(8) DEFAULT NULL,
  `postid` int(8) DEFAULT NULL,
  `replyid` int(8) DEFAULT NULL,
  `reportid` int(11) DEFAULT NULL,
  `achievementid` int(11) DEFAULT NULL,
  `personInvolved` varchar(5) DEFAULT NULL,
  `notificationSource` text NOT NULL,
  `notificationDate` date NOT NULL,
  `notificationStatus` text NOT NULL DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationid`),
  ADD KEY `accountid` (`accountid`),
  ADD KEY `postId` (`postid`),
  ADD KEY `replyId` (`replyid`),
  ADD KEY `personInvolved` (`personInvolved`),
  ADD KEY `creationid` (`creationid`),
  ADD KEY `personaleventid` (`personaleventid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notificationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
