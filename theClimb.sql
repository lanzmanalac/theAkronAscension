-- phpMyAdmin SQL Dump
-- LeBron James Championship Paths - "The Climb"
-- Focusing on each of LeBron's 4 championship runs

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
-- Table structure for table `championshippaths`
--

CREATE TABLE `championshippaths` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `team` varchar(100) NOT NULL,
  `championship_title` varchar(200) NOT NULL,
  `finals_opponent` varchar(100) NOT NULL,
  `series_result` varchar(20) NOT NULL,
  `path_summary` text NOT NULL,
  `key_moments` text NOT NULL,
  `lebron_stats` text NOT NULL,
  `finals_mvp` tinyint(1) NOT NULL DEFAULT 1,
  `team_color` varchar(7) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `championshippaths`
--

INSERT INTO `championshippaths` (`id`, `year`, `team`, `championship_title`, `finals_opponent`, `series_result`, `path_summary`, `key_moments`, `lebron_stats`, `finals_mvp`, `team_color`, `image_url`) VALUES
(1, 2012, 'Miami Heat', 'First Championship - Breaking Through', 'Oklahoma City Thunder', '4-1', 'After the heartbreak of 2011, LeBron and the Heat returned with vengeance. They dominated the Eastern Conference playoffs, going 12-3 before facing the young Thunder. LeBron finally got his first ring, silencing critics and proving he could win the big one.', 'Game 4 triple-double (26 pts, 11 reb, 13 ast) to take commanding 3-1 lead. Game 5 clincher with 26 points and emotional celebration. "It''s about damn time" moment after years of criticism.', 'Finals: 28.6 PPG, 10.2 RPG, 7.4 APG, 1.6 SPG on 47.2% shooting. Playoffs: 30.3 PPG, 9.7 RPG, 5.6 APG. Dominant two-way performance throughout.', 1, '#98002E', 'images/2012_championship.jpg'),

(2, 2013, 'Miami Heat', 'Back-to-Back - Defending the Crown', 'San Antonio Spurs', '4-3', 'The most dramatic championship run of LeBron''s career. Down 3-2 to the Spurs and seconds away from losing in Game 6, Ray Allen''s miracle three sent it to overtime. LeBron then dominated Game 7 to complete one of the greatest comebacks in Finals history.', 'Game 6: Ray Allen''s corner three after LeBron''s offensive rebound. Game 7: 37 points, 12 rebounds performance to close out series. "Headband off" moment in Game 6 fourth quarter. Triple-double in clinching Game 7.', 'Finals: 25.3 PPG, 10.9 RPG, 7.0 APG, 2.3 SPG. Game 7: 37 pts, 12 reb. Most clutch performance when facing elimination. Shot 52.9% from field in final two games.', 1, '#98002E', 'images/2013_championship.jpg'),

(3, 2016, 'Cleveland Cavaliers', 'The Promise - Coming Home Champion', 'Golden State Warriors', '4-3', 'The most meaningful championship in NBA history. LeBron fulfilled his promise to bring a title to Cleveland, ending the city''s 52-year championship drought. Down 3-1 to the 73-win Warriors, he led the greatest comeback in Finals history with legendary performances.', 'Game 5: 41 points to stave off elimination. Game 6: 41 points and 11 assists. Game 7: Triple-double and "The Block" on Andre Iguodala. "Cleveland, this is for you!" speech. Emotional breakdown after winning.', 'Finals: 29.7 PPG, 11.3 RPG, 8.9 APG, 2.6 SPG, 2.3 BPG. First player to lead all statistical categories in Finals. Back-to-back 41-point games in elimination games. The Block and The Shot in Game 7.', 1, '#FDBB30', 'images/2016_championship.jpg'),

(4, 2020, 'Los Angeles Lakers', 'The Mamba Mentality - Honoring Kobe', 'Miami Heat', '4-2', 'In the Orlando bubble during a global pandemic, LeBron led the Lakers to their first championship in 10 years. Playing with heavy hearts after Kobe Bryant''s tragic death, LeBron channeled the Mamba Mentality to deliver LA another title and honor his fallen friend.', 'Game 6 clincher: 28 points, 14 rebounds, 10 assists triple-double. "Job finished" mentality throughout bubble. Dedication to Kobe Bryant and Gianna. Leading Lakers back to prominence after joining in 2018.', 'Finals: 29.8 PPG, 11.8 RPG, 8.5 APG, 1.2 SPG. Playoffs: 27.6 PPG, 10.8 RPG, 8.8 APG. At age 35, proved he could still be the best player in the world. Fourth Finals MVP with third different franchise.', 1, '#FDB927', 'images/2020_championship.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `championshippaths`
--
ALTER TABLE `championshippaths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `championshippaths`
--
ALTER TABLE `championshippaths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;