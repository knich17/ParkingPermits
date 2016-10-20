-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 06:59 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parking_permits`
--

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE IF NOT EXISTS `citations` (
  `citation_id` int(9) NOT NULL AUTO_INCREMENT,
  `admin_id` int(9) NOT NULL,
  `time` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`citation_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `citations`
--

INSERT INTO `citations` (`citation_id`, `admin_id`, `time`, `description`, `paid`) VALUES
(1, 1, '2016-10-12 00:00:00', 'Stuff', 0),
(2, 1, '2017-01-01 01:00:00', 'Stuff happened', 0),
(3, 1, '2017-01-01 01:00:00', 'Stuff happened', 0),
(4, 1, '2017-01-01 01:00:00', 'Stuff happened', 0),
(5, 1, '2017-01-01 01:00:00', 'smoking happened', 0),
(6, 1, '2017-01-01 01:00:00', 'smoking happened', 0),
(7, 1, '2017-01-01 01:00:00', 'smoking happened', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `has_violations` (
  `violation_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `department_id` int(4) DEFAULT NULL,
  `time` datetime NOT NULL,
  `description` varchar(10000) NOT NULL,
  PRIMARY KEY (`violation_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `has_violations`
--

INSERT INTO `has_violations` (`violation_id`, `name`, `department_id`, `time`, `description`) VALUES
(1, 'kaney', NULL, '2016-01-01 01:00:00', 'die'),
(2, 'NULL', NULL, '1970-01-01 01:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `has_violations_resolved`
--

CREATE TABLE IF NOT EXISTS `has_violations_resolved` (
  `violation_id` int(9) NOT NULL,
  `time_resolved` datetime NOT NULL,
  `actions_taken` varchar(10000) NOT NULL,
  PRIMARY KEY (`violation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parking_citations`
--

CREATE TABLE IF NOT EXISTS `parking_citations` (
  `citation_id` int(9) NOT NULL,
  `permit_id` int(9) DEFAULT NULL,
  `rego` varchar(6) NOT NULL,
  `vehicle_type` enum('2 wheels','4 wheels','other') NOT NULL DEFAULT '4 wheels',
  PRIMARY KEY (`citation_id`),
  KEY `permit_id` (`permit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_citations`
--

INSERT INTO `parking_citations` (`citation_id`, `permit_id`, `rego`, `vehicle_type`) VALUES
(3, NULL, 'aaa555', '4 wheels'),
(4, NULL, 'aaa333', '4 wheels'),
(5, NULL, 'aaa333', '4 wheels'),
(6, NULL, 'aaa333', '4 wheels');

-- --------------------------------------------------------

--
-- Table structure for table `permits`
--

CREATE TABLE IF NOT EXISTS `permits` (
  `permit_id` int(9) NOT NULL AUTO_INCREMENT,
  `vehicle_rego` varchar(6) NOT NULL,
  `vehicle_type` enum('2 wheels','4 wheels','other') NOT NULL DEFAULT '4 wheels',
  `user_id` int(9) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`permit_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permits`
--

INSERT INTO `permits` (`permit_id`, `vehicle_rego`, `vehicle_type`, `user_id`, `start_date`, `end_date`) VALUES
(4, '', '4 wheels', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '', '4 wheels', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permit_status`
--

CREATE TABLE IF NOT EXISTS `permit_status` (
  `permit_id` int(9) NOT NULL,
  `status` enum('approved','denied') NOT NULL,
  `admin_id` int(9) NOT NULL,
  PRIMARY KEY (`permit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smoking_citations`
--

CREATE TABLE IF NOT EXISTS `smoking_citations` (
  `citation_id` int(9) NOT NULL,
  `violator_name` varchar(100) NOT NULL,
  `department_id` int(4) NOT NULL,
  `supervisor_name` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL,
  PRIMARY KEY (`citation_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smoking_citations`
--

INSERT INTO `smoking_citations` (`citation_id`, `violator_name`, `department_id`, `supervisor_name`, `location`) VALUES
(7, 'Kane the smoker', 3, 'Boss man', 'Cool kids block');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` int(10) NOT NULL,
  `type` enum('admin','staff','student','visitor') NOT NULL,
  `department_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password_hash`, `type`, `department_id`) VALUES
(1, 'Kane Nicholson', 'kane@kane.com', 0, 'admin', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citations`
--
ALTER TABLE `citations`
  ADD CONSTRAINT `fk_citations_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `fk_smoking_violations_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_smoking_violations_citation_id` FOREIGN KEY (`citation_id`) REFERENCES `citations` (`citation_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
