-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 12:49 AM
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
-- Table structure for table `communitycreations`
--

CREATE TABLE `communitycreations` (
  `creationid` varchar(19) NOT NULL,
  `accountid` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `description` text DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `filedata` text DEFAULT NULL,
  `filters` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communitycreations`
--

INSERT INTO `communitycreations` (`creationid`, `accountid`, `title`, `religion`, `description`, `filename`, `filetype`, `filesize`, `filedata`, `filters`, `status`, `date`) VALUES
('CC1559493964', 'R0003', 'Embracing Submission and Compassion: Exploring Islam', 'Islam', 'Islam, a faith embraced by millions around the world, offers a transformative journey of submission, peace, and compassion. Rooted in the teachings of the Prophet Muhammad, Islam presents a comprehensive way of life that encompasses spirituality, morality, and social justice.\n\nAt its core, Islam emphasizes the belief in the oneness of God, known as Allah, and the importance of submission to His will. Muslims find guidance and solace in the Quran, the sacred book revealed to Prophet Muhammad, which contains divine revelations and timeless wisdom that guide their daily lives.\n\nThe Five Pillars of Islam form the foundation of Muslim practice, including the declaration of faith (Shahada), prayer (Salah), giving of alms (Zakah), fasting during the month of Ramadan (Sawm), and pilgrimage to Mecca (Hajj). These pillars provide a framework for spiritual devotion, social responsibility, and personal growth.\n\nMay the teachings of Islam inspire us to cultivate peace, compassion, and a deeper understanding of our shared humanity, fostering unity and harmony in a diverse world.\n\nAssalamu Alaikum.', '', '', 1090, '', '', 'Published', '2023-07-18'),
('CC2134943963', 'R0003', 'Embarking on a Path of Peace: Exploring Buddhism', 'Buddhism', 'In a fast-paced and often chaotic world, many seek solace and inner peace. Buddhism, an ancient and profound philosophy, offers a guiding light on this transformative journey.\n\nAt its core, Buddhism teaches the path to liberation from suffering, known as \"Dukkha.\" It invites us to look within and understand the nature of our desires, attachments, and the impermanence of life. Through mindfulness and meditation, Buddhists cultivate a deep sense of awareness, compassion, and wisdom.\n\nOne of the key teachings of Buddhism is the Four Noble Truths, which reveal the reality of suffering, its causes, the possibility of its cessation, and the path to achieve it. The Eightfold Path, another vital aspect of Buddhist practice, guides individuals towards right understanding, intention, speech, action, livelihood, effort, mindfulness, and concentration.\n\nMay the wisdom of Buddhism continue to illuminate our hearts and guide us towards a life of peace, harmony, and profound spiritual awakening.\n\nNamaste.', '', '', 1019, '', '', 'Published', '2023-07-18'),
('CC3087091904', 'R0003', 'Embracing Faith and Grace: Exploring Christianity', 'Christianity', 'Christianity, a global faith that has shaped the lives of millions, offers a profound journey of love, redemption, and spiritual transformation. Rooted in the life and teachings of Jesus Christ, Christianity encompasses a rich tapestry of beliefs, traditions, and practices that inspire and guide its followers.\n\nAt its core, Christianity centers around the belief in Jesus Christ as the Son of God and the Savior of humanity. Through his teachings, sacrificial death, and resurrection, Christians find hope, forgiveness, and the promise of eternal life.\n\nCentral to Christianity is the Bible, the sacred text that chronicles the life, teachings, and divine revelations. It serves as a compass, providing guidance, wisdom, and stories of faith that resonate across generations.\n\nMay the timeless teachings of Christianity continue to inspire and guide us, leading us towards a life of faith, hope, and love.\n\nAmen.', '', '', 928, '', '', 'Published', '2023-07-18'),
('CC6126719772', 'R0003', 'Embracing Divine Wisdom: Exploring Hinduism', 'Hinduism', 'Hinduism, one of the world\'s oldest religions, unfolds a captivating tapestry of spirituality, rituals, and profound insights into the nature of existence. Rooted in ancient scriptures, Hinduism offers a vast and diverse spiritual path that celebrates the unity of all beings and the eternal quest for self-realization.\n\nAt its essence, Hinduism acknowledges the divinity within every individual and recognizes the interconnectedness of all creation. The pursuit of Moksha, liberation from the cycle of birth and death, lies at the heart of Hindu philosophy.\n\nHinduism encompasses a multitude of gods and goddesses, each representing various aspects of the divine. From Brahma, the creator, to Vishnu, the preserver, and Shiva, the destroyer, Hindu deities embody cosmic forces and guide devotees on their spiritual journey.\n\nMay the teachings of Hinduism inspire us to embrace unity, diversity, and the eternal quest for self-realization, leading us towards a life of spiritual awakening, harmony, and profound inner peace.\n\nOm Shanti.', '', '', 1030, '', '', 'Published', '2023-07-18'),
('CC64b97bee81dec', 'R0003', 'Buddhist Temple', 'Buddhism', 'Discover tranquility and inner peace at the serene and awe-inspiring Buddhist temple. Step into a world of sacred beauty, adorned with intricate architecture and ornate statues. Immerse yourself in the gentle ambiance, where the scent of incense fills the air and soft chants resonate, inviting you to reflect, meditate, and find solace in the teachings of the Buddha. Experience a spiritual journey like no other as you explore the temple grounds, engage in contemplation, and witness the profound devotion of fellow seekers. ', 'Buddhist Temple.jpg', 'image/jpeg', 2501659, '../views/assets/data/community/CC64b97bee81dec.jpg', '', 'Published', '2023-07-20'),
('CC64b97c0649da8', 'R0003', 'The Bible', 'Christianity', 'Open the pages of inspiration and embark on a transformative journey through the timeless wisdom of the Bible. Dive into the profound teachings, stories, and guidance that have touched hearts for centuries. Let the words come alive as you explore the narratives of faith, love, hope, and redemption. Discover the power of scripture as it illuminates your path, ignites your spirit, and deepens your connection with the divine. Join the countless seekers who have found solace, guidance, and strength within the sacred pages of this eternal book. ', 'The Bible.jpg', 'image/jpeg', 1961796, '../views/assets/data/community/CC64b97c0649da8.jpg', '', 'Published', '2023-07-20'),
('CC64b97c1a1e976', 'R0003', 'Hindu Ritual', 'Hinduism', 'Step into the realm of ancient wisdom and experience the enchanting world of Hindu rituals. Immerse yourself in a tapestry of sacred traditions, vibrant colors, and intricate rituals that have been passed down through generations. Witness the profound devotion and spiritual connection as devotees come together to honor deities, seek blessings, and celebrate auspicious occasions. From the rhythmic chants to the fragrant incense, every aspect of the ritual invokes a sense of divine presence and inner transformation. Join the journey of spiritual awakening and immerse yourself in the rich tapestry of Hindu rituals. ', 'Hinduism Ritual.jpg', 'image/jpeg', 3639169, '../views/assets/data/community/CC64b97c1a1e976.jpg', '', 'Published', '2023-07-20'),
('CC64b97c520702b', 'R0003', 'How Muslims Worship', 'Islam', 'Discover the beauty and devotion of Muslim worship as you delve into the profound practices that shape their spiritual journey. Witness the unity and reverence as Muslims gather in mosques, bowing in prayer, and seeking a deep connection with the Divine. Experience the soul-stirring recitation of the Quran, resonating with timeless wisdom and guidance. From the call to prayer that echoes through the air to the profound prostration in humility, Muslim worship embodies devotion, surrender, and a profound sense of peace. Join in the journey of spiritual surrender and experience the power of Muslim worship. ', 'Islam Worship.jpg', 'image/jpeg', 2269810, '../views/assets/data/community/CC64b97c520702b.jpg', '', 'Published', '2023-07-20'),
('CC64b97c6e11aae', 'R0003', 'The Menorah', 'Judaism', 'Illuminate the darkness and embrace the spirit of hope with the symbolic menorah of the Jewish tradition. The menorah, with its flickering flames, represents the triumph of light over darkness and serves as a powerful reminder of faith and resilience. Each candle tells a story, recounting the miraculous events of Hanukkah and the enduring spirit of the Jewish people. Join in the celebration as families gather around the menorah, kindling the lights one by one, and embracing the warmth of togetherness and the joy of tradition. Experience the radiance and symbolism of the menorah as it ignites hearts and inspires a sense of unity and hope. ', 'Judaism Menorah.jpg', 'image/jpeg', 3694570, '../views/assets/data/community/CC64b97c6e11aae.jpg', '', 'Published', '2023-07-20'),
('CC64b97cd9473a0', 'R0003', 'Reading the Bible', 'Christianity', 'Open the pages of divine wisdom and embark on a transformative journey through reading the Bible. Immerse yourself in the sacred text, where stories of faith, love, redemption, and guidance await. Allow the words to resonate within you, sparking introspection and deepening your connection with the divine. Engage in the timeless dialogue between the divine and the human, as you explore the rich tapestry of wisdom that the Bible offers. Experience the power of reading the Bible as it illuminates your path, inspires your spirit, and enriches your understanding of faith.', 'Reading the Bible.mp4', 'video/mp4', 23141605, '../views/assets/data/community/CC64b97cd9473a0.mp4', '', 'Published', '2023-07-20'),
('CC64b97cef94dca', 'R0003', 'Attending a Hindu Festival', 'Hinduism', 'Immerse yourself in the vibrant colors, joyful celebrations, and sacred traditions of attending a Hindu festival. Experience the palpable energy as devotees come together to honor deities, offer prayers, and partake in cultural festivities. From the rhythmic beats of drums to the mesmerizing dances and elaborate rituals, every moment is filled with devotion and spiritual fervor. Join in the festivities, taste the delicious food, witness the breathtaking rituals, and embrace the sense of unity and joy that permeates the atmosphere. ', 'Hindu Festival.mp4', 'video/mp4', 8287675, '../views/assets/data/community/CC64b97cef94dca.mp4', '', 'Published', '2023-07-20'),
('CC64b97d099c220', 'R0003', 'Inside a Mosque', 'Islam', 'Inside a mosque, you will discover a serene and reverent atmosphere that encourages spiritual contemplation and connection with the divine. The main prayer hall is typically spacious, adorned with intricate decorations, elegant calligraphy, and beautiful geometric patterns. The focal point is the mihrab, a niche indicating the direction of Mecca, towards which Muslims face during prayer. Carpeted floors provide a comfortable space for worshippers to kneel and prostrate during prayer. The air is often scented with the lingering aroma of incense or the subtle fragrance of floral arrangements. Islamic art, such as paintings and verses from the Quran, may grace the walls, serving as visual reminders of the faith. The atmosphere is one of tranquility, devotion, and communal unity as individuals come together to engage in prayer, recitation of the Quran, and supplication.', 'Inside a Mosque.mp4', 'video/mp4', 7707481, '../views/assets/data/community/CC64b97d099c220.mp4', '', 'Published', '2023-07-20'),
('CC64b97d20e8599', 'R0003', 'During the Hanukkah', 'Judaism', 'During the Jewish festival of Hanukkah, the atmosphere inside a Jewish home or synagogue is filled with warmth, joy, and a sense of celebration. The centerpiece is the menorah, a nine-branched candelabrum, often placed in a prominent location. Each night of Hanukkah, a new candle is lit, and blessings are recited, symbolizing the miracle of the oil that burned for eight days in the ancient Temple. The glow of the menorah\'s candles creates a cozy and intimate ambiance. Traditional songs, prayers, and stories are shared, and delicious foods like latkes (potato pancakes) and sufganiyot (jelly-filled donuts) are enjoyed. Family and friends gather, creating a sense of togetherness, gratitude, and celebration of the miracle and resilience of the Jewish faith.', 'During the Hanukkah.mp4', 'video/mp4', 21311638, '../views/assets/data/community/CC64b97d20e8599.mp4', '', 'Published', '2023-07-20'),
('CC64b9fae095a28', 'R0003', 'How Monks Meditate', 'Buddhism', 'Find serenity in the stillness as Buddhist monks embark on their meditative journey. Witness their unwavering focus and inner peace as they enter deep states of contemplation. Through disciplined practice, they cultivate mindfulness, clarity, and compassion, harnessing the power of meditation to attain spiritual awakening. Join in the sacred silence and experience the profound tranquility that arises from their dedicated pursuit of inner enlightenment.', 'Monk Meditation.mp4', 'video/mp4', 27967178, '../views/assets/data/community/CC64b9fae095a28.mp4', '', 'Published', '2023-07-21'),
('CC64bdbb69af3c7', 'R0005', 'Christian Painting', 'Christianity', 'I painting I saw while traveling.', 'image (4).jpg', 'image/jpeg', 456470, '../views/assets/data/community/CC64bdbb69af3c7.jpg', '', 'Published', '2023-07-23'),
('CC9938340509', 'R0003', 'Embracing Covenant and Tradition: Exploring Judaism', 'Judaism', 'Judaism, an ancient and enduring faith, weaves a beautiful tapestry of spiritual devotion, ethical values, and rich traditions. Rooted in the covenant between God and the Jewish people, Judaism offers a profound journey of connection, community, and personal growth.\n\nAt its essence, Judaism centers around the belief in the one God, who revealed Himself to the ancient Israelites. Jews find guidance and inspiration in the Torah, the sacred scripture containing the Five Books of Moses, which serves as a blueprint for a righteous and purposeful life.\n\nCentral to Jewish practice is the observance of mitzvot, the commandments that guide ethical behavior and foster a sense of holiness in daily life. From acts of loving-kindness (gemilut chasadim) to observing the Sabbath (Shabbat) and celebrating festivals, Jews seek to embody the values of justice, compassion, and gratitude.\n\nMay the teachings of Judaism inspire us to cultivate spiritual growth, celebrate our shared heritage, and work towards a more just and compassionate world.\n\nShalom.', '', '', 1040, '', '', 'Published', '2023-07-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communitycreations`
--
ALTER TABLE `communitycreations`
  ADD PRIMARY KEY (`creationid`),
  ADD KEY `accountid` (`accountid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
