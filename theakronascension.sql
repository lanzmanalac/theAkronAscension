-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 03:32 PM
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
-- Table structure for table `fanwall`
--

CREATE TABLE `fanwall` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `postedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjfinalspaths`
--

CREATE TABLE `lbjfinalspaths` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `finalsTitle` varchar(100) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `highlightVideoURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjmilestones`
--

CREATE TABLE `lbjmilestones` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dateAchieved` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mediaURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjpraise`
--

CREATE TABLE `lbjpraise` (
  `id` int(11) NOT NULL,
  `quotedBy` varchar(100) NOT NULL,
  `quoteText` text NOT NULL,
  `context` text DEFAULT NULL,
  `dateSaid` date DEFAULT NULL,
  `sourceURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjrivals`
--

CREATE TABLE `lbjrivals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `teamName` varchar(255) DEFAULT NULL,
  `notableEncounters` text DEFAULT NULL,
  `rivarlySummary` text DEFAULT NULL,
  `imageURL` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjstats`
--

CREATE TABLE `lbjstats` (
  `id` int(11) NOT NULL,
  `ppg` decimal(4,1) DEFAULT NULL,
  `rpg` decimal(4,1) DEFAULT NULL,
  `apg` decimal(4,1) DEFAULT NULL,
  `spg` decimal(4,1) DEFAULT NULL,
  `bpg` decimal(4,1) DEFAULT NULL,
  `gamesPlayed` int(11) DEFAULT NULL,
  `mpg` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lbjteammates`
--

CREATE TABLE `lbjteammates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `teamName` varchar(255) DEFAULT NULL,
  `yearsPlayedWith` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `notableMoments` text DEFAULT NULL,
  `imageURL` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `lbjtrophyroom`
--

CREATE TABLE `lbjtrophyroom` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `yearAwarded` year(4) NOT NULL,
  `description` text DEFAULT NULL,
  `imageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teamsplayedfor`
--

CREATE TABLE `teamsplayedfor` (
  `id` int(11) NOT NULL,
  `teamName` varchar(100) NOT NULL,
  `startYear` year(4) DEFAULT NULL,
  `endYear` year(4) DEFAULT NULL,
  `teamLogoURL` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fanwall`
--
ALTER TABLE `fanwall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `lbjfinalspaths`
--
ALTER TABLE `lbjfinalspaths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjmilestones`
--
ALTER TABLE `lbjmilestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjpraise`
--
ALTER TABLE `lbjpraise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjrivals`
--
ALTER TABLE `lbjrivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjstats`
--
ALTER TABLE `lbjstats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjteammates`
--
ALTER TABLE `lbjteammates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjtimeline`
--
ALTER TABLE `lbjtimeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lbjtrophyroom`
--
ALTER TABLE `lbjtrophyroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamsplayedfor`
--
ALTER TABLE `teamsplayedfor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fanwall`
--
ALTER TABLE `fanwall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjfinalspaths`
--
ALTER TABLE `lbjfinalspaths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjmilestones`
--
ALTER TABLE `lbjmilestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjpraise`
--
ALTER TABLE `lbjpraise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjrivals`
--
ALTER TABLE `lbjrivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjstats`
--
ALTER TABLE `lbjstats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjteammates`
--
ALTER TABLE `lbjteammates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjtimeline`
--
ALTER TABLE `lbjtimeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjtrophyroom`
--
ALTER TABLE `lbjtrophyroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teamsplayedfor`
--
ALTER TABLE `teamsplayedfor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fanwall`
--
ALTER TABLE `fanwall`
  ADD CONSTRAINT `fanwall_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
