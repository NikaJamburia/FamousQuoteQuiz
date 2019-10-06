-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2019 at 11:35 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotequiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Oscar Wilde'),
(2, 'Albert Einstein'),
(3, 'Franz Kafka'),
(4, 'Karl Marx'),
(5, 'Soren Kierkegaard'),
(6, 'Socrates'),
(7, 'Immanuel Kant'),
(8, 'Jean-Paul Sartre'),
(9, 'Baruch Spinoza'),
(10, 'David Hume'),
(11, 'Friedrich Engels'),
(12, 'Karl Popper'),
(13, 'Max Stirner'),
(14, 'Herbert Marcuse'),
(15, 'Friedrich Nietzsche'),
(16, 'Protagoras'),
(17, 'William James'),
(18, 'Guy Debord');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(100) NOT NULL,
  `body` text NOT NULL,
  `author_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `body`, `author_id`) VALUES
(1, 'Be yourself; everyone else is already taken.', 1),
(2, 'Few are those who see with their own eyes and feel with their own hearts.', 2),
(4, 'You are free, and that is why you are lost.', 3),
(5, 'History repeats itself, first as tragedy, second as farce.', 4),
(6, 'Life can only be understood backwards; but it must be lived forwards.', 5),
(8, 'True wisdom comes to each of us when we realize how little we understand about life, ourselves, and the world around us.', 6),
(9, 'In law a man is guilty when he violates the rights of others. In ethics he is guilty if he only thinks of doing so.', 7),
(10, 'Only the guy who isn\'t rowing has time to rock the boat.', 8),
(11, 'The highest activity a human being can attain is learning for understanding, because to understand is to be free.', 9),
(12, 'It\'s when we start working together that the real healing takes place... it\'s when we start spilling our sweat, and not our blood.', 10),
(14, 'Freedom is the recognition of necessity.', 11),
(15, 'My thought is me: that is why I cannot stop thinking. I exist because I think I cannot keep from thinking.', 8),
(16, 'Man is condemned to be free; because once thrown into the world, he is responsible for everything he does.', 8),
(17, 'It is only in our decisions that we are important.', 8),
(18, 'We have become makers of our fate when we have ceased to pose as its prophets.', 12),
(19, 'Whoever will be free must make himself free. Freedom is no fairy gift to fall into a man\'s lap. What is freedom? To have the will to be responsible for one\'s self.', 13),
(20, 'Under the rule of a repressive whole, liberty can be made into a powerful instrument of domination.', 14),
(21, 'The unexamined life is not worth living.', 6),
(22, 'Happiness is not an ideal of reason but of imagination.', 7),
(23, 'There is only one good, knowledge, and one evil, ignorance', 6),
(24, 'Is man merely a mistake of God\'s? Or God merely a mistake of man\'s?', 15),
(25, 'Man is the measure of all things', 6),
(26, 'Philosophy is at once the most sublime and the most trivial of human pursuits', 17),
(27, 'Quotations are useful in periods of ignorance or obscurantist beliefs.', 18),
(28, 'In societies where modern conditions of production prevail, all of life presents itself as an immense accumulation of spectacles. Everything that was directly lived has moved away into a representation.', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
