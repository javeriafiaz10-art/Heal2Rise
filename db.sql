-- =====================================================================
--  Heal & Rise - NGO Rehabilitation & Empowerment Platform
--  Database: heal_rise
-- =====================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------
-- Table: users
-- Roles: admin, user (beneficiary), NGO, team_member, counselor
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `role` varchar(60) NOT NULL DEFAULT 'user',
  `status` varchar(32) NOT NULL DEFAULT 'Pending',
  `city` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `cnic` varchar(30) DEFAULT NULL,
  `address` text,
  `problem_category` varchar(100) DEFAULT NULL,
  `problem_details` text,
  `ngo_name` varchar(150) DEFAULT NULL,
  `specialization` varchar(150) DEFAULT NULL,
  `privacy_consent` varchar(5) DEFAULT 'No',
  `is_private` varchar(5) DEFAULT 'Yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Module 2: cases
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ngo_id` int(11) DEFAULT NULL,
  `team_member_id` int(11) DEFAULT NULL,
  `counselor_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `progress` varchar(32) NOT NULL DEFAULT 'New',
  `in_rehab` varchar(5) NOT NULL DEFAULT 'No',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ngo_id` (`ngo_id`),
  KEY `team_member_id` (`team_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Module 3: sessions
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_date` date DEFAULT NULL,
  `session_time` varchar(20) DEFAULT NULL,
  `meeting_link` varchar(255) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `notes` text,
  `status` varchar(32) NOT NULL DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`),
  KEY `counselor_id` (`counselor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Module 4: skills
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_name` varchar(150) NOT NULL,
  `description` text,
  `progress_percent` int(11) NOT NULL DEFAULT 0,
  `status` varchar(32) NOT NULL DEFAULT 'In Progress',
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Module 5: rehab
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rehab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admitted_on` date DEFAULT NULL,
  `discharged_on` date DEFAULT NULL,
  `remarks` text,
  `outcome` varchar(100) DEFAULT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'Admitted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Seed data (default password for all: 12345)
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `role`, `status`, `city`, `specialization`, `ngo_name`, `privacy_consent`, `is_private`) VALUES
(1, 'Admin', 'admin@yahoo.com', '12345', '03002526530', 'admin', 'Confirm', 'Lahore', NULL, NULL, 'Yes', 'Yes'),
(2, 'Hope Foundation', 'ngo@gmail.com', '12345', '03111222333', 'NGO', 'Confirm', 'Lahore', NULL, 'Hope Foundation', 'Yes', 'Yes'),
(3, 'Sara Khan', 'team@gmail.com', '12345', '03211222444', 'team_member', 'Confirm', 'Lahore', 'Case Monitoring', NULL, 'Yes', 'Yes'),
(4, 'Dr. Ahmed', 'counselor@gmail.com', '12345', '03311222555', 'counselor', 'Confirm', 'Lahore', 'Clinical Psychologist', NULL, 'Yes', 'Yes'),
(5, 'Ayesha', 'user@gmail.com', '12345', '03411222666', 'user', 'Confirm', 'Lahore', NULL, NULL, 'Yes', 'Yes');

INSERT INTO `cases` (`id`, `user_id`, `ngo_id`, `team_member_id`, `counselor_id`, `category`, `progress`, `in_rehab`, `notes`) VALUES
(1, 5, 2, 3, 4, 'Psychological Support', 'Counseling', 'No', 'Case connected to Hope Foundation.');

INSERT INTO `skills` (`id`, `case_id`, `user_id`, `skill_name`, `description`, `progress_percent`, `status`, `updated_by`) VALUES
(1, 1, 5, 'Basic Computer Skills', 'Introductory IT training for empowerment', 40, 'In Progress', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
