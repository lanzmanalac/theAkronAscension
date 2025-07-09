-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 05:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theakronascension`
--

-- --------------------------------------------------------

--
-- Table structure for table `lbjtimeline`
--

CREATE TABLE `lbjtimeline` (
  `id` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lbjtimeline`
--

INSERT INTO `lbjtimeline` (`id`, `year`, `title`, `description`) VALUES
(1, '2003', 'Drafted by Cavaliers', 'LeBron James was the first overall pick in the 2003 NBA Draft.'),
(2, '2010', 'Signed with Miami Heat', 'Joined forces with Dwyane Wade and Chris Bosh.'),
(3, '2012', 'First NBA Championship', 'Won his first title with Miami Heat.'),
(4, '2016', 'Championship with Cavs', 'Historic comeback to win NBA Finals with Cleveland.'),
(5, '2018', 'Joined the Los Angeles Lakers', 'LeBron James signed with the Lakers in 2018, continuing his dominance and later winning a title with them in 2020.'),
(6, '2020', 'NBA Championship with Lakers', 'Led the Lakers to their 17th NBA title in the 2020 NBA Finals inside the Orlando bubble, earning his fourth Finals MVP award.'),
(8, '2013', 'Back-to-Back Championship', 'LeBron James led the Miami Heat to their second consecutive NBA championship, defeating the San Antonio Spurs in a thrilling seven-game series.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lbjtimeline`
--
ALTER TABLE `lbjtimeline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lbjtimeline`
--
ALTER TABLE `lbjtimeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
