-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2017 at 03:13 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 5.6.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `church_camp`
--

-- --------------------------------------------------------

--
-- Table structure for table `churches`
--

CREATE TABLE `churches` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `churches`
--

INSERT INTO `churches` (`id`, `country`, `state`, `district`, `name`, `inserted_at`) VALUES
(1, 1, 1, 1, 'Thiruvananthapuram', '2017-12-04 10:26:14'),
(2, 1, 1, 2, 'Kollam', '2017-12-04 10:26:14'),
(3, 1, 1, 6, 'Pooyamkutty', '2017-12-04 10:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `inserted_at`) VALUES
(1, 'India', '2017-12-04 10:26:44'),
(2, 'United States', '2017-12-04 10:26:44'),
(3, 'Keniya', '2017-12-04 10:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `attendee_id` int(11) NOT NULL,
  `day1` tinyint(1) NOT NULL DEFAULT '0',
  `day2` tinyint(1) NOT NULL DEFAULT '0',
  `day3` tinyint(1) NOT NULL DEFAULT '0',
  `day4` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `attendee_id`, `day1`, `day2`, `day3`, `day4`) VALUES
(22, 22, 1, 1, 1, 1),
(24, 24, 0, 0, 1, 0),
(25, 25, 0, 0, 1, 0),
(26, 26, 0, 0, 1, 0),
(27, 27, 1, 1, 1, 1),
(28, 28, 1, 1, 1, 1),
(29, 29, 1, 1, 1, 1),
(30, 30, 1, 1, 1, 1),
(31, 31, 1, 1, 1, 1),
(32, 32, 1, 1, 1, 1),
(33, 33, 1, 1, 1, 1),
(34, 34, 1, 1, 1, 1),
(35, 35, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `country`, `state`, `name`, `inserted_at`) VALUES
(1, 1, 1, 'Thiruvananthapuram', '2017-12-04 10:27:02'),
(2, 1, 1, 'Kollam', '2017-12-04 10:27:02'),
(3, 1, 1, 'Pathanamthitta', '2017-12-04 10:27:02'),
(4, 1, 1, 'Kottayam', '2017-12-04 10:27:02'),
(5, 1, 1, 'Alapuzha', '2017-12-04 10:27:02'),
(6, 1, 1, 'Ernakulam', '2017-12-04 10:27:02'),
(7, 1, 1, 'Idukki', '2017-12-04 10:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `church` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `age` int(11) DEFAULT NULL,
  `accommodation` tinyint(4) NOT NULL DEFAULT '1',
  `hot_water` tinyint(1) NOT NULL DEFAULT '0',
  `milk` tinyint(1) DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inserted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `church`, `name`, `gender`, `age`, `accommodation`, `hot_water`, `milk`, `inserted_at`, `inserted_by`) VALUES
(22, 1, 'Joel James', 'M', 26, 0, 0, 0, '2017-12-05 13:27:49', NULL),
(24, 1, 'Sijo Joseph', 'M', 28, 1, 0, 0, '2017-12-05 13:56:12', NULL),
(25, 3, 'Gracy James', 'F', 60, 1, 0, 0, '2017-12-05 14:50:30', NULL),
(26, 1, 'Sherly Raju', 'F', 55, 1, 0, 0, '2017-12-05 15:08:15', NULL),
(27, 1, 'Julia Raju', 'F', 17, 1, 0, 0, '2017-12-05 15:12:48', NULL),
(28, 1, 'Raju T A', 'M', 58, 1, 0, 0, '2017-12-05 15:13:02', NULL),
(29, 1, 'Abraham Thomas', 'M', 23, 1, 0, 0, '2017-12-05 15:13:15', NULL),
(30, 1, 'Shintu Sebastin', 'M', 23, 1, 0, 0, '2017-12-05 15:13:35', NULL),
(31, 1, 'Gaius Mathew', 'M', 21, 1, 0, 0, '2017-12-05 15:13:55', NULL),
(32, 1, 'Praise Thomas', 'M', 21, 1, 0, 0, '2017-12-05 15:14:03', NULL),
(33, 1, 'Jonathan Cleetus', 'M', 21, 1, 0, 0, '2017-12-05 15:14:18', NULL),
(34, 1, 'Sam Sabu', 'M', 21, 1, 0, 0, '2017-12-05 15:14:28', NULL),
(35, 1, 'Sabu K S', 'M', 40, 1, 0, 0, '2017-12-05 21:42:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country`, `name`, `inserted_at`) VALUES
(1, 1, 'Kerala', '2017-12-04 10:27:19'),
(2, 1, 'Tamilnadu', '2017-12-04 10:27:19'),
(3, 1, 'Andra Pradesh', '2017-12-04 10:27:19'),
(4, 1, 'Karnataka', '2017-12-04 10:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `timing`
--

CREATE TABLE `timing` (
  `id` int(11) NOT NULL,
  `date_id` int(11) DEFAULT NULL,
  `day` tinyint(1) NOT NULL,
  `breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `lunch` tinyint(1) NOT NULL DEFAULT '0',
  `tea` tinyint(1) NOT NULL DEFAULT '0',
  `supper` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timing`
--

INSERT INTO `timing` (`id`, `date_id`, `day`, `breakfast`, `lunch`, `tea`, `supper`) VALUES
(69, 22, 1, 0, 0, 0, 1),
(70, 22, 2, 1, 1, 1, 0),
(71, 22, 3, 1, 1, 1, 0),
(72, 22, 4, 1, 1, 0, 0),
(77, 24, 1, 0, 0, 0, 1),
(78, 24, 2, 0, 0, 0, 0),
(79, 24, 3, 1, 1, 1, 0),
(80, 24, 4, 0, 0, 0, 0),
(81, 25, 1, 0, 0, 0, 1),
(82, 25, 2, 0, 0, 0, 0),
(83, 25, 3, 1, 1, 1, 0),
(84, 25, 4, 0, 0, 0, 0),
(85, 26, 1, 0, 0, 0, 0),
(86, 26, 2, 0, 0, 0, 0),
(87, 26, 3, 1, 1, 1, 1),
(88, 26, 4, 0, 0, 0, 0),
(89, 27, 1, 0, 0, 0, 1),
(90, 27, 2, 1, 1, 1, 1),
(91, 27, 3, 1, 1, 1, 1),
(92, 27, 4, 1, 1, 0, 0),
(93, 28, 1, 0, 0, 0, 1),
(94, 28, 2, 1, 1, 1, 1),
(95, 28, 3, 1, 1, 1, 1),
(96, 28, 4, 1, 1, 0, 0),
(97, 29, 1, 0, 0, 0, 1),
(98, 29, 2, 1, 1, 1, 1),
(99, 29, 3, 1, 1, 1, 1),
(100, 29, 4, 1, 1, 0, 0),
(101, 30, 1, 0, 0, 0, 1),
(102, 30, 2, 1, 1, 1, 1),
(103, 30, 3, 1, 1, 1, 1),
(104, 30, 4, 1, 1, 0, 0),
(105, 31, 1, 0, 0, 0, 1),
(106, 31, 2, 1, 1, 1, 1),
(107, 31, 3, 1, 1, 1, 1),
(108, 31, 4, 1, 1, 0, 0),
(109, 32, 1, 0, 0, 0, 1),
(110, 32, 2, 1, 1, 1, 1),
(111, 32, 3, 1, 1, 1, 1),
(112, 32, 4, 1, 1, 0, 0),
(113, 33, 1, 0, 0, 0, 1),
(114, 33, 2, 1, 1, 1, 1),
(115, 33, 3, 1, 1, 1, 1),
(116, 33, 4, 1, 1, 0, 0),
(117, 34, 1, 0, 0, 0, 1),
(118, 34, 2, 1, 1, 1, 1),
(119, 34, 3, 1, 1, 1, 1),
(120, 34, 4, 1, 1, 0, 0),
(121, 35, 1, 0, 0, 0, 0),
(122, 35, 2, 0, 0, 0, 0),
(123, 35, 3, 1, 1, 1, 1),
(124, 35, 4, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `is_admin`) VALUES
(1, 'admin', 'cc03e747a6afbbcbf8be7668acfebee5', '2017-11-27 12:03:15', 1),
(2, 'joel', 'cc03e747a6afbbcbf8be7668acfebee5', '2017-12-05 21:00:51', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `churches`
--
ALTER TABLE `churches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_country_id` (`country`),
  ADD KEY `fk_state_id` (`state`),
  ADD KEY `fk_district_id` (`district`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dates_user_id` (`attendee_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dist_country_id` (`country`),
  ADD KEY `fk_dist_state_id` (`state`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reg_church_id` (`church`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_state_country_id` (`country`);

--
-- Indexes for table `timing`
--
ALTER TABLE `timing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tim_date_id` (`date_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `churches`
--
ALTER TABLE `churches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `timing`
--
ALTER TABLE `timing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `churches`
--
ALTER TABLE `churches`
  ADD CONSTRAINT `fk_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_district_id` FOREIGN KEY (`district`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_state_id` FOREIGN KEY (`state`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `fk_dates_user_id` FOREIGN KEY (`attendee_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `fk_dist_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_dist_state_id` FOREIGN KEY (`state`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `fk_reg_church_id` FOREIGN KEY (`church`) REFERENCES `churches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `fk_state_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `timing`
--
ALTER TABLE `timing`
  ADD CONSTRAINT `fk_tim_date_id` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
