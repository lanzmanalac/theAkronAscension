-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 11:59 AM
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
-- Table structure for table `career_milestones`
--

CREATE TABLE `career_milestones` (
  `id` int(11) NOT NULL,
  `milestone_title` varchar(200) NOT NULL,
  `date_achieved` date NOT NULL,
  `category` enum('Scoring','Championships','Records','Historic Moments','Social Impact','Legacy') NOT NULL,
  `significance_level` enum('Historic','Major','Legendary','GOAT-Level') NOT NULL,
  `description` text NOT NULL,
  `impact_on_basketball` text NOT NULL,
  `career_context` text NOT NULL,
  `stats_details` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `video_highlight` varchar(255) DEFAULT NULL,
  `quote_from_lebron` text DEFAULT NULL,
  `media_reaction` text DEFAULT NULL,
  `order_sequence` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career_milestones`
--

INSERT INTO `career_milestones` (`id`, `milestone_title`, `date_achieved`, `category`, `significance_level`, `description`, `impact_on_basketball`, `career_context`, `stats_details`, `image_url`, `video_highlight`, `quote_from_lebron`, `media_reaction`, `order_sequence`) VALUES
(1, 'NBA Draft - The Chosen One', '2003-06-26', 'Historic Moments', 'GOAT-Level', 'Selected #1 overall by Cleveland Cavaliers straight from high school. The most hyped prospect since Michael Jordan, living up to every expectation and more.', 'Changed how high school players were evaluated. Set the standard for generational prospects. Proved that hype could be justified with performance.', 'Coming straight from St. Vincent-St. Mary High School in Akron, LeBron was already on the cover of Sports Illustrated as \"The Chosen One\" at age 17.', 'First overall pick, youngest player in NBA history at the time. Signed largest rookie shoe deal ever with Nike ($90 million over 7 years).', 'images/draft_2003.jpg', 'highlights/draft_2003.mp4', '\"I know I\'m ready. I\'ve been ready my whole life for this moment.\"', 'ESPN called it the most anticipated draft pick since Magic Johnson. National media coverage unlike any rookie before.', 1),
(2, 'First Triple-Double & Youngest Records', '2005-01-19', 'Records', 'Historic', 'Became youngest player to record a triple-double at 20 years, 20 days old. Started a career-long pattern of achieving \"youngest ever\" milestones.', 'Redefined what young players could accomplish. Showed that age was just a number for generational talents.', 'Second season in the league, already showing the versatility that would define his career. First glimpse of the complete player he would become.', '27 points, 11 rebounds, 10 assists vs Portland Trail Blazers. Broke Kobe Bryant\'s previous record.', 'images/first_triple_double.jpg', 'highlights/first_triple_double.mp4', '\"I just try to play the game the right way and help my team win.\"', 'Analysts began comparing his versatility to Magic Johnson despite being 6\'8\" and athletic.', 2),
(3, 'The 2007 Finals Run - Carrying Cleveland', '2007-06-14', 'Historic Moments', 'Legendary', 'At age 22, single-handedly carried Cleveland to their first NBA Finals. Epic Game 5 performance against Detroit where he scored 25 straight points.', 'Proved young players could carry teams to the Finals. Showed individual brilliance could overcome team deficiencies.', 'Fourth year in league, first Finals appearance. Faced San Antonio Spurs, got swept but gained invaluable experience that would pay dividends later.', 'Game 5 vs Detroit: 48 points, 25 straight in final quarters. Finals: 22 PPG, 7 RPG, 6.8 APG against Spurs.', 'images/2007_finals.jpg', 'highlights/game5_detroit.mp4', '\"I felt like I was in a zone. Everything felt right, every shot felt good.\"', '\"We just witnessed the birth of a superstar\" - TNT analysts after Game 5 performance.', 3),
(4, 'Back-to-Back MVPs (2009, 2010)', '2010-05-02', 'Records', 'Historic', 'Won consecutive NBA MVP awards, joining elite company of players to achieve this feat. Dominated regular seasons with incredible all-around play.', 'Established himself among the NBA elite. Showed he could be the best regular season player while carrying inferior rosters.', 'Peak of first Cleveland stint. Despite team limitations, put up MVP-caliber numbers and led Cavs to best records in the league.', '2009: 28.4 PPG, 7.6 RPG, 7.2 APG. 2010: 29.7 PPG, 7.3 RPG, 8.6 APG. Led Cavs to 66 and 61 wins respectively.', 'images/back_to_back_mvp.jpg', 'highlights/mvp_seasons.mp4', '\"Individual awards are nice, but I want championships. That\'s what drives me.\"', 'Unanimously considered the best player in the world. Questions arose about his supporting cast.', 4),
(5, 'The Decision - Changing NBA Landscape', '2010-07-08', 'Social Impact', 'GOAT-Level', 'Announced on live TV that he was \"taking his talents to South Beach.\" Most controversial and influential decision in modern NBA history.', 'Changed how superstars control their destiny. Started the era of player empowerment and super team formations.', 'After 7 years in Cleveland without a championship, made the difficult decision to join Dwyane Wade and Chris Bosh in Miami.', 'Left as free agent after averaging 29.7 PPG and leading Cavs to 61 wins. Chose winning opportunity over hometown loyalty initially.', 'images/the_decision.jpg', 'highlights/decision_tv.mp4', '\"I\'m going to take my talents to South Beach and join the Miami Heat.\"', 'Most polarizing moment in NBA history. Made LeBron a villain but changed the league forever.', 5),
(6, 'First Championship & Finals MVP (2012)', '2012-06-21', 'Championships', 'Legendary', 'Won his first NBA championship and Finals MVP after failing in 2011. Broke through the championship barrier that had eluded him.', 'Proved he could win the big one. Validated \"The Decision\" and showed he could deliver in clutch moments.', 'Year 9 of career, finally achieving his ultimate goal. Defeated young Oklahoma City Thunder 4-1 with dominant performance.', 'Finals: 28.6 PPG, 10.2 RPG, 7.4 APG. Playoffs: 30.3 PPG, 9.7 RPG, 5.6 APG over 23 games.', 'images/first_championship.jpg', 'highlights/2012_finals.mp4', '\"It\'s about damn time! It\'s about damn time!\"', '\"The monkey is off his back\" - National media finally recognized his championship ability.', 6),
(7, 'Ray Allen Game 6 & 2013 Championship', '2013-06-18', 'Championships', 'GOAT-Level', 'Most dramatic championship ever. Ray Allen\'s corner three after LeBron\'s offensive rebound saved the season, leading to Game 7 victory.', 'Created one of the most iconic Finals moments ever. Showed championship teams need luck and clutch performances from everyone.', 'Back-to-back champion, proving 2012 wasn\'t a fluke. Dominated Game 7 against Spurs after being seconds away from losing the series.', 'Game 6: 32 points, 10 rebounds. Game 7: 37 points, 12 rebounds. Finals: 25.3 PPG, 10.9 RPG, 7.0 APG.', 'images/ray_allen_shot.jpg', 'highlights/game6_miracle.mp4', '\"Rebound Bosh, back out to Allen, his three-pointer... BANG!\" - Mike Breen call', 'Called one of the greatest Finals games ever. LeBron\'s Game 7 performance was legendary.', 7),
(8, 'Return to Cleveland - \"I\'m Coming Home\"', '2014-07-11', 'Social Impact', 'GOAT-Level', 'Announced his return to Cleveland with emotional letter. Promised to bring a championship to his hometown and ended his villain era.', 'Showed superstar loyalty could still exist. Changed narrative from villain to hero. Started new era of player agency with meaningful reasons.', 'After 4 years and 2 championships in Miami, chose to return home and attempt the impossible - bring Cleveland its first championship.', 'Left Miami as two-time champion and Finals MVP. Returned to Cleveland as mature leader ready to fulfill his promise.', 'images/return_home.jpg', 'highlights/coming_home.mp4', '\"I want to give Cleveland everything I have. I want to lead them to a championship.\"', 'Sports Illustrated letter broke the internet. Immediate forgiveness from Cleveland fans.', 8),
(9, 'The Block & 2016 Championship Miracle', '2016-06-19', 'Championships', 'GOAT-Level', 'Led greatest Finals comeback ever, defeating 73-win Warriors after being down 3-1. \"The Block\" on Iguodala became iconic. Ended Cleveland\'s 52-year championship drought.', 'Greatest individual Finals performance in history. Proved that history could be made even against impossible odds.', 'Year 13, finally delivered on his promise to Cleveland. Most meaningful championship in NBA history, ending decades of Cleveland sports heartbreak.', 'Finals: 29.7 PPG, 11.3 RPG, 8.9 APG, 2.6 SPG, 2.3 BPG. First player to lead all five statistical categories in Finals history.', 'images/the_block.jpg', 'highlights/the_block.mp4', '\"Cleveland! This is for you!\"', 'Unanimous opinion as greatest individual Finals performance ever. Made him top-3 all-time in most discussions.', 9),
(10, 'All-Time Scoring Record', '2023-02-07', 'Records', 'GOAT-Level', 'Broke Kareem Abdul-Jabbar\'s all-time scoring record that stood for 39 years. Became NBA\'s all-time leading scorer in his 20th season.', 'Broke the most prestigious individual record in basketball. Cemented his place among the greatest to ever play the game.', 'Year 20 of career, still playing at elite level. Achieved record while maintaining efficiency and all-around excellence.', '38,388 career points and counting. Passed Kareem on fadeaway jumper vs Oklahoma City Thunder. Currently over 40,000 points.', 'images/scoring_record.jpg', 'highlights/scoring_record.mp4', '\"To be able to be in the same breath as the greats... it means so much to me.\"', 'Universal praise from players and media. Recognized as one of the greatest achievements in sports history.', 10),
(11, 'Playing with Son Bronny', '2024-10-06', 'Legacy', 'Historic', 'Became first father-son duo to play together in NBA history. Historic moment as LeBron and Bronny James shared the court for the Lakers.', 'Created new legacy milestone that may never be replicated. Showed longevity and family legacy intersecting in sports.', 'Year 22 of career, still playing at high level while his son begins his NBA journey. Ultimate family and professional achievement.', 'Both scored in their first game together. LeBron at age 39, Bronny at age 20 - 19-year age gap on same team.', 'images/lebron_bronny.jpg', 'highlights/father_son.mp4', '\"That moment, us being at the scorer\'s table together, it\'s a moment I\'ll never forget.\"', 'Feel-good story that transcended basketball. Praised universally as heartwarming achievement.', 11),
(12, 'Bubble Championship - Honoring Kobe', '2020-10-11', 'Championships', 'Legendary', 'Led Lakers to championship in Orlando bubble during pandemic. Dedicated season to Kobe Bryant after his tragic death. Fourth championship with third different franchise.', 'Showed mental toughness in unprecedented circumstances. Honored fallen legend while adding to his own legacy.', 'Year 17, proving he could still be Finals MVP. Most unique championship circumstances in NBA history during global pandemic.', 'Finals: 29.8 PPG, 11.8 RPG, 8.5 APG. Fourth Finals MVP award. \"Job finished\" mentality throughout bubble playoffs.', 'images/bubble_championship.jpg', 'highlights/bubble_finals.mp4', '\"Job finished. Job finished. Mamba out, but job finished.\"', 'Praised for leadership in difficult circumstances. Championship meant more due to Kobe tribute aspect.', 12);

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
(1, '2012', 'Miami Heat', 'First Championship - Breaking Through', 'Oklahoma City Thunder', '4-1', 'After the heartbreak of 2011, LeBron and the Heat returned with vengeance. They dominated the Eastern Conference playoffs, going 12-3 before facing the young Thunder. LeBron finally got his first ring, silencing critics and proving he could win the big one.', 'Game 4 triple-double (26 pts, 11 reb, 13 ast) to take commanding 3-1 lead. Game 5 clincher with 26 points and emotional celebration. \"It\'s about damn time\" moment after years of criticism.', 'Finals: 28.6 PPG, 10.2 RPG, 7.4 APG, 1.6 SPG on 47.2% shooting. Playoffs: 30.3 PPG, 9.7 RPG, 5.6 APG. Dominant two-way performance throughout.', 1, '#98002E', 'images/2012_championship.jpg'),
(2, '2013', 'Miami Heat', 'Back-to-Back - Defending the Crown', 'San Antonio Spurs', '4-3', 'The most dramatic championship run of LeBron\'s career. Down 3-2 to the Spurs and seconds away from losing in Game 6, Ray Allen\'s miracle three sent it to overtime. LeBron then dominated Game 7 to complete one of the greatest comebacks in Finals history.', 'Game 6: Ray Allen\'s corner three after LeBron\'s offensive rebound. Game 7: 37 points, 12 rebounds performance to close out series. \"Headband off\" moment in Game 6 fourth quarter. Triple-double in clinching Game 7.', 'Finals: 25.3 PPG, 10.9 RPG, 7.0 APG, 2.3 SPG. Game 7: 37 pts, 12 reb. Most clutch performance when facing elimination. Shot 52.9% from field in final two games.', 1, '#98002E', 'images/2013_championship.jpg'),
(3, '2016', 'Cleveland Cavaliers', 'The Promise - Coming Home Champion', 'Golden State Warriors', '4-3', 'The most meaningful championship in NBA history. LeBron fulfilled his promise to bring a title to Cleveland, ending the city\'s 52-year championship drought. Down 3-1 to the 73-win Warriors, he led the greatest comeback in Finals history with legendary performances.', 'Game 5: 41 points to stave off elimination. Game 6: 41 points and 11 assists. Game 7: Triple-double and \"The Block\" on Andre Iguodala. \"Cleveland, this is for you!\" speech. Emotional breakdown after winning.', 'Finals: 29.7 PPG, 11.3 RPG, 8.9 APG, 2.6 SPG, 2.3 BPG. First player to lead all statistical categories in Finals. Back-to-back 41-point games in elimination games. The Block and The Shot in Game 7.', 1, '#FDBB30', 'images/2016_championship.jpg'),
(4, '2020', 'Los Angeles Lakers', 'The Mamba Mentality - Honoring Kobe', 'Miami Heat', '4-2', 'In the Orlando bubble during a global pandemic, LeBron led the Lakers to their first championship in 10 years. Playing with heavy hearts after Kobe Bryant\'s tragic death, LeBron channeled the Mamba Mentality to deliver LA another title and honor his fallen friend.', 'Game 6 clincher: 28 points, 14 rebounds, 10 assists triple-double. \"Job finished\" mentality throughout bubble. Dedication to Kobe Bryant and Gianna. Leading Lakers back to prominence after joining in 2018.', 'Finals: 29.8 PPG, 11.8 RPG, 8.5 APG, 1.2 SPG. Playoffs: 27.6 PPG, 10.8 RPG, 8.8 APG. At age 35, proved he could still be the best player in the world. Fourth Finals MVP with third different franchise.', 1, '#FDB927', 'images/2020_championship.jpg');

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

--
-- Dumping data for table `fanwall`
--

INSERT INTO `fanwall` (`id`, `userID`, `message`, `postedAt`) VALUES
(1, NULL, 'The earliest memory I can think of Lebron is when he won the championship game during his time with the Miami Heat.\r\n', '2025-07-11 06:30:06');

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

--
-- Dumping data for table `lbjpraise`
--

INSERT INTO `lbjpraise` (`id`, `quotedBy`, `quoteText`, `context`, `dateSaid`, `sourceURL`) VALUES
(1, 'Stephen Curry', 'LeBron is the greatest player of our generation. His longevity and impact on and off the court is unmatched.', 'Said during a post-game interview after facing the Lakers', '2023-12-15', 'https://example.com/curry-lebron-interview'),
(2, 'Michael Jordan', 'LeBron took a different path than me, but he has proven himself to be one of the greatest to ever play the game.', 'Comments from The Last Dance documentary follow-up interview', '2023-06-01', 'https://example.com/jordan-lebron-comments');

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
  `season` varchar(9) NOT NULL,
  `ppg` decimal(4,1) DEFAULT NULL,
  `rpg` decimal(4,1) DEFAULT NULL,
  `apg` decimal(4,1) DEFAULT NULL,
  `spg` decimal(4,1) DEFAULT NULL,
  `bpg` decimal(4,1) DEFAULT NULL,
  `gamesPlayed` int(11) DEFAULT NULL,
  `mpg` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lbjstats`
--

INSERT INTO `lbjstats` (`id`, `season`, `ppg`, `rpg`, `apg`, `spg`, `bpg`, `gamesPlayed`, `mpg`) VALUES
(1, '2003-04', 20.9, 5.5, 5.9, 1.6, 0.7, 79, 39.5),
(2, '2004-05', 27.2, 7.4, 7.2, 2.2, 0.7, 80, 42.4),
(3, '2005-06', 31.4, 7.0, 6.6, 1.6, 0.8, 79, 42.5),
(4, '2006-07', 27.3, 6.7, 6.0, 1.6, 0.7, 78, 40.9),
(5, '2007-08', 30.0, 7.9, 7.2, 1.8, 1.1, 75, 40.4),
(6, '2008-09', 28.4, 7.6, 7.2, 1.7, 1.1, 81, 37.7),
(7, '2009-10', 29.7, 7.3, 8.6, 1.6, 1.0, 76, 39.0),
(8, '2010-11', 26.7, 7.5, 7.0, 1.6, 0.6, 79, 38.8),
(9, '2011-12', 27.1, 7.9, 6.2, 1.9, 0.8, 62, 37.5),
(10, '2012-13', 26.8, 8.0, 7.3, 1.7, 0.9, 76, 37.9),
(11, '2013-14', 27.1, 6.9, 6.4, 1.6, 0.3, 77, 37.7),
(12, '2014-15', 25.3, 6.0, 7.4, 1.6, 0.7, 69, 36.1),
(13, '2015-16', 25.3, 7.4, 6.8, 1.4, 0.6, 76, 35.6),
(14, '2016-17', 26.4, 8.6, 8.7, 1.2, 0.6, 74, 37.8),
(15, '2017-18', 27.5, 8.6, 9.1, 1.4, 0.9, 82, 36.9),
(16, '2018-19', 27.4, 8.5, 8.3, 1.3, 0.6, 55, 35.2),
(17, '2019-20', 25.3, 7.8, 10.2, 1.2, 0.5, 67, 34.6),
(18, '2020-21', 25.0, 7.7, 7.8, 1.1, 0.6, 45, 33.4),
(19, '2021-22', 30.3, 8.2, 6.2, 1.3, 1.1, 56, 37.2),
(20, '2022-23', 28.9, 8.3, 6.8, 0.9, 0.6, 55, 35.5),
(21, '2023-24', 25.7, 7.3, 8.3, 1.3, 0.5, 71, 35.3),
(22, '2024-25', 24.4, 7.8, 8.2, 1.0, 0.6, 70, 34.9);

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
-- Indexes for table `career_milestones`
--
ALTER TABLE `career_milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `significance_level` (`significance_level`),
  ADD KEY `date_achieved` (`date_achieved`);

--
-- Indexes for table `championshippaths`
--
ALTER TABLE `championshippaths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

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
-- AUTO_INCREMENT for table `career_milestones`
--
ALTER TABLE `career_milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `championshippaths`
--
ALTER TABLE `championshippaths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fanwall`
--
ALTER TABLE `fanwall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lbjrivals`
--
ALTER TABLE `lbjrivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjstats`
--
ALTER TABLE `lbjstats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lbjteammates`
--
ALTER TABLE `lbjteammates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lbjtimeline`
--
ALTER TABLE `lbjtimeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
