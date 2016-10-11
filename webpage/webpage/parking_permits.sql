-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2016 at 11:31 PM
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
(3, 'drama'),
(4, 'sport');

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
(1, 'Liam Doyle', 'dylime1712@gmail.com', '$2y$10$5JbAVc4vsJ8PB427V0oou.xz6A53xTRpkD12/kmRiWCitXajpJQP6', 'student', NULL),
(2, 'Liam Doyle', 'root@qw.com', '$2y$10$9i2w009hZfbGwyUuVSUwAeCXfqJXEosrl5wBvBq1Y39gsB84eVt72', 'staff', NULL),
(3, 'eeee', 'root', '$2y$10$8so0NHFbxJ77fLeA7DVJ7OeIQ/pB1pHSBTkkl5sk/lAQ82gfqn6K6', 'student', NULL);

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
  MODIFY `department_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permits`
--
ALTER TABLE `permits`
  MODIFY `permit_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
