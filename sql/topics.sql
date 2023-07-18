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
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topicId` int(8) NOT NULL,
  `topicTitle` varchar(255) NOT NULL,
  `topicDate` datetime NOT NULL,
  `topicContent` text NOT NULL,
  `accountid` varchar(5) NOT NULL,
  `upvotes` int(10) NOT NULL,
  `downvotes` int(10) NOT NULL,
  `anonymous` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicId`, `topicTitle`, `topicDate`, `topicContent`, `accountid`, `upvotes`, `downvotes`, `anonymous`) VALUES
(21767941, 'The Profound Influence of Religion on Human Civilization: A Historical and Contemporary Perspective', '2023-07-18 03:28:20', 'Religion has been an integral part of human civilization since its earliest origins, permeating every facet of life and leaving an indelible mark on history. From the ancient polytheistic beliefs of the Egyptians and Greeks to the monotheistic traditions of Judaism, Christianity, and Islam, religion has provided a moral compass, shaped cultural practices, and influenced societal norms. In ancient times, religious beliefs and rituals were deeply intertwined with daily life, dictating everything from social hierarchies to agricultural practices. The construction of monumental religious structures, such as the Egyptian pyramids or the Mayan temples, showcased the power and influence of religion in society. Religion served as a source of solace and hope, offering explanations for natural phenomena and providing comfort in times of hardship. As civilizations evolved, religious institutions gained prominence, establishing codes of conduct and moral frameworks that guided individuals\' behavior and shaped the fabric of society. Religion also played a significant role in education, with religious institutions serving as centers of learning and knowledge preservation. The monastic schools of medieval Europe and the Islamic madrasas were instrumental in the preservation and dissemination of knowledge during times of intellectual darkness. However, alongside its positive contributions, religion has also been a catalyst for conflicts and divisions.', 'R0001', 2, 0, 0),
(75631721, 'Religion and Science: Bridging the Gap between Faith and Reason', '2023-07-18 03:26:36', 'In this discussion, we delve into the relationship between religion and science, exploring how they can coexist and complement each other, and addressing common misconceptions and conflicts that arise between these two realms of knowledge.\n\n', 'R0001', 1, 0, 0),
(79165743, 'Interfaith Dialogue: Building Bridges of Understanding and Harmony', '2023-07-18 03:26:24', 'This discussion focuses on the importance of interfaith dialogue as a means to promote mutual respect, understanding, and cooperation among different religious communities, fostering a more inclusive and peaceful world.\n\n', 'R0001', 1, 0, 0),
(89888896, 'The Role of Faith in Modern Society: Perspectives and Challenges', '2023-07-18 03:26:10', 'In this discussion, we explore how religion continues to shape and influence contemporary society, the challenges it faces in an increasingly secular world, and the significance of faith in people\'s lives.\n\n', 'R0001', 2, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topicId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topicId` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96096791;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
