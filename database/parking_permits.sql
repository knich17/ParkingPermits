-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 03:29 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking_permits`
--

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `citation_id` int(9) NOT NULL,
  `admin_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `time` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(4) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `name`) VALUES
(1, 'IT'),
(2, 'Business'),
(3, 'Drama'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `has_violations`
--

CREATE TABLE `has_violations` (
  `violation_id` int(9) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department_id` int(4) DEFAULT NULL,
  `time` datetime NOT NULL,
  `description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `has_violations`
--

INSERT INTO `has_violations` (`violation_id`, `name`, `department_id`, `time`, `description`) VALUES
(17, 'NULL', 1, '2016-01-01 01:00:00', 'stuff happened'),
(18, 'me', 1, '2016-01-01 02:00:00', 'more stuff happened'),
(19, 'Kane Nicholson', 3, '2016-12-05 02:00:00', 'demonstration');

-- --------------------------------------------------------

--
-- Table structure for table `has_violations_resolved`
--

CREATE TABLE `has_violations_resolved` (
  `violation_id` int(9) NOT NULL,
  `time_resolved` datetime NOT NULL,
  `actions_taken` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parking_citations`
--

CREATE TABLE `parking_citations` (
  `citation_id` int(9) NOT NULL,
  `permit_id` int(9) DEFAULT NULL,
  `rego` varchar(6) NOT NULL,
  `vehicle_type` enum('2 wheels','4 wheels','other') NOT NULL DEFAULT '4 wheels'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permits`
--

CREATE TABLE `permits` (
  `permit_id` int(9) NOT NULL,
  `vehicle_rego` varchar(6) NOT NULL,
  `vehicle_type` enum('2 wheels','4 wheels','other') NOT NULL DEFAULT '4 wheels',
  `user_id` int(9) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permits`
--

INSERT INTO `permits` (`permit_id`, `vehicle_rego`, `vehicle_type`, `user_id`, `start_date`, `end_date`) VALUES
(3, 'aaa333', '4 wheels', 1, '2001-09-16 00:00:00', '2001-09-16 00:00:00'),
(4, 'aaa333', '4 wheels', 1, '2001-09-16 00:00:00', '2001-09-16 00:00:00'),
(5, 'bbb444', '2 wheels', 1, '2010-11-16 00:00:00', '2010-11-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permit_status`
--

CREATE TABLE `permit_status` (
  `permit_id` int(9) NOT NULL,
  `status` enum('approved','denied') NOT NULL,
  `admin_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smoking_citations`
--

CREATE TABLE `smoking_citations` (
  `citation_id` int(9) NOT NULL,
  `location` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `type` enum('admin','staff','student','visitor') NOT NULL,
  `department_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password_hash`, `type`, `department_id`) VALUES
(1, 'Kane Nicholson', 'kane@kane.com', '$2y$10$iLVo0FjXXWCaUx/W30ikI.N3EcND8YCbZ3zcfrDsJWU9fmJs.QUEe', 'student', 1),
(2, 'Lachlan', 'lachlan@lachlan.com', '$2y$10$.mxiKBkkeU5V1lR1VjFmje46AGe21c9cU9nLSgLIp91aoJTjp2qTS', 'student', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`citation_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `has_violations`
--
ALTER TABLE `has_violations`
  ADD PRIMARY KEY (`violation_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `has_violations_resolved`
--
ALTER TABLE `has_violations_resolved`
  ADD PRIMARY KEY (`violation_id`);

--
-- Indexes for table `parking_citations`
--
ALTER TABLE `parking_citations`
  ADD PRIMARY KEY (`citation_id`),
  ADD KEY `permit_id` (`permit_id`);

--
-- Indexes for table `permits`
--
ALTER TABLE `permits`
  ADD PRIMARY KEY (`permit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permit_status`
--
ALTER TABLE `permit_status`
  ADD PRIMARY KEY (`permit_id`);

--
-- Indexes for table `smoking_citations`
--
ALTER TABLE `smoking_citations`
  ADD PRIMARY KEY (`citation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `citation_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `has_violations`
--
ALTER TABLE `has_violations`
  MODIFY `violation_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `permits`
--
ALTER TABLE `permits`
  MODIFY `permit_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `citations`
--
ALTER TABLE `citations`
  ADD CONSTRAINT `fk_citations_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_citations_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `has_violations`
--
ALTER TABLE `has_violations`
  ADD CONSTRAINT `fk_has_violations_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE SET NULL;

--
-- Constraints for table `has_violations_resolved`
--
ALTER TABLE `has_violations_resolved`
  ADD CONSTRAINT `fk_resolved_violations_violation_id` FOREIGN KEY (`violation_id`) REFERENCES `has_violations` (`violation_id`) ON DELETE CASCADE;

--
-- Constraints for table `parking_citations`
--
ALTER TABLE `parking_citations`
  ADD CONSTRAINT `fk_parking_violations_permit_id` FOREIGN KEY (`permit_id`) REFERENCES `permits` (`permit_id`) ON DELETE SET NULL;

--
-- Constraints for table `permits`
--
ALTER TABLE `permits`
  ADD CONSTRAINT `fk_permits_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `permit_status`
--
ALTER TABLE `permit_status`
  ADD CONSTRAINT `fk_permit_status_permit_id` FOREIGN KEY (`permit_id`) REFERENCES `permits` (`permit_id`) ON DELETE CASCADE;

--
-- Constraints for table `smoking_citations`
--
ALTER TABLE `smoking_citations`
  ADD CONSTRAINT `fk_smoking_violations_citation_id` FOREIGN KEY (`citation_id`) REFERENCES `citations` (`citation_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
