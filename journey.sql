-- phpMyAdmin SQL Dump
-- LeBron James Team Journey - "The Journey"
-- Focusing on LeBron's performance with each team throughout his career

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theakronascension`
--

-- --------------------------------------------------------

--
-- Table structure for table `team_journey`
--

CREATE TABLE `team_journey` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `stint_number` int(2) NOT NULL,
  `years_span` varchar(20) NOT NULL,
  `seasons_played` int(2) NOT NULL,
  `team_colors` varchar(50) NOT NULL,
  `team_logo` varchar(255) DEFAULT NULL,
  `regular_season_stats` text NOT NULL,
  `playoff_achievements` text NOT NULL,
  `championships_won` int(2) NOT NULL DEFAULT 0,
  `finals_appearances` int(2) NOT NULL DEFAULT 0,
  `memorable_moments` text NOT NULL,
  `team_impact` text NOT NULL,
  `legacy_with_team` text NOT NULL,
  `key_teammates` text NOT NULL,
  `order_sequence` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_journey`
--

INSERT INTO `team_journey` (`id`, `team_name`, `stint_number`, `years_span`, `seasons_played`, `team_colors`, `team_logo`, `regular_season_stats`, `playoff_achievements`, `championships_won`, `finals_appearances`, `memorable_moments`, `team_impact`, `legacy_with_team`, `key_teammates`, `order_sequence`) VALUES
(1, 'Cleveland Cavaliers', 1, '2003-2010', 7, '#041E42, #FDBB30', 'images/logos/cavaliers_logo.png', 'Averaged 27.8 PPG, 7.0 RPG, 7.0 APG over 7 seasons. Shot 47.3% from field. Evolved from promising rookie to MVP-caliber superstar. Won back-to-back MVPs in 2009 and 2010.', '5 playoff appearances, reached 2007 NBA Finals at age 22. Lost to San Antonio Spurs 4-0. Multiple Conference Finals appearances. Carried teams that weren''t championship-caliber.', 0, 1, 'Game 5 vs Detroit 2007 - 25 straight points in Eastern Conference Finals. 2009 MVP season with 66 wins. "The Decision" announcement in 2010. Carrying Cleveland on his back for 7 years.', 'Transformed a losing franchise into a contender. Put Cleveland basketball on the map. Made the city believe in championship possibilities. Became the face of the franchise and the city.', 'The Chosen One who carried Cleveland''s hopes. Left to learn how to win, but promised to return. First stint established him as a generational talent who needed help to reach the summit.', 'Zydrunas Ilgauskas, Mo Williams, Anderson Varejao, Antawn Jamison, Shaquille O''Neal (briefly)', 1),

(2, 'Miami Heat', 1, '2010-2014', 4, '#98002E, #F9A01B', 'images/logos/heat_logo.png', 'Averaged 26.9 PPG, 7.6 RPG, 6.7 APG over 4 seasons. Shot 53.6% from field. Peak athletic prime. Most dominant two-way player in the league. Improved three-point shooting and post game.', '4 consecutive Finals appearances. 2 championships (2012, 2013). 27-game winning streak in 2013. 2 Finals MVPs. Formed legendary Big Three with Wade and Bosh.', 2, 4, '2011 Finals loss to Dallas - learning experience. 2012 breakthrough championship. Ray Allen''s shot in 2013 Game 6. "Not 5, not 6, not 7" prediction. The Heatles era.', 'Created a championship culture. Elevated teammates to new levels. Made Miami a destination for stars. Brought multiple championships to South Beach.', 'The Decision maker who learned how to win. Formed the Big Three and delivered on championship promises. Peak years of dominance and cultural impact. Villain to hero arc.', 'Dwyane Wade, Chris Bosh, Ray Allen, Mario Chalmers, Shane Battier, Udonis Haslem', 2),

(3, 'Cleveland Cavaliers', 2, '2014-2018', 4, '#041E42, #FDBB30', 'images/logos/cavaliers_logo.png', 'Averaged 26.2 PPG, 8.1 RPG, 8.7 APG over 4 seasons. Shot 53.4% from field. Most complete player in league. Triple-double machine. Elite playmaking and basketball IQ.', '4 consecutive Finals appearances. 1 championship (2016). Greatest comeback in Finals history (3-1 deficit). Beat 73-win Warriors. Ended Cleveland''s 52-year championship drought.', 1, 4, 'The Block and The Shot in 2016 Game 7. "Cleveland, this is for you!" 2016 championship parade. Coming home essay. Greatest individual Finals performance in 2015 despite loss.', 'Fulfilled "The Promise" to bring championship to Cleveland. United a city and ended decades of heartbreak. Made Cleveland relevant in sports again.', 'The Prodigal Son who returned home and delivered the ultimate prize. Most meaningful championship in NBA history. Cemented status as Cleveland legend forever.', 'Kyrie Irving, Kevin Love, J.R. Smith, Tristan Thompson, Kyle Korver, Richard Jefferson', 3),

(4, 'Los Angeles Lakers', 1, '2018-Present', 7, '#552583, #FDB927', 'images/logos/lakers_logo.png', 'Averaging 27.2 PPG, 8.2 RPG, 8.1 APG through 2024. Shot 51.8% from field. Father Time remains undefeated, but LeBron keeps fighting. All-time scoring leader.', '3 playoff appearances so far. 1 championship (2020). 1 Finals MVP. Bubble championship during pandemic. Made playoffs in 4 of 6 seasons.', 1, 1, 'Bubble championship in 2020 honoring Kobe. Breaking Kareem''s scoring record in 2023. Playing with son Bronny in 2024. "Job finished" mentality. Multiple injuries but keeps producing.', 'Brought Lakers back to relevance after post-Kobe struggles. Added to Lakers'' championship legacy. Mentored young players and veterans alike.', 'The ageless wonder who continues to defy time. Added to Lakers lore with bubble championship. Chasing more rings in the twilight of legendary career.', 'Anthony Davis, Russell Westbrook, Carmelo Anthony, Dwight Howard, Rajon Rondo, Bronny James', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team_journey`
--
ALTER TABLE `team_journey`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_stint` (`team_name`, `stint_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `team_journey`
--
ALTER TABLE `team_journey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;