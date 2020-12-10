

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



-- --------------------------------------------------------

--
-- Table structure for table `hco`
--

DROP TABLE IF EXISTS `hco`;
CREATE TABLE IF NOT EXISTS `hco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hco_name` varchar(500) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(5) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hco`
--

INSERT INTO `hco` (`id`, `hco_name`, `city`, `state`, `zip`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'HCA Healthcare', 'Nashville', 'TX', '32767', '2020-12-09 11:03:12', NULL, 0),
(2, '1st Choice Healthcare', 'Goldsboro', 'NC', '27534', '2020-12-09 11:03:35', NULL, 0),
(3, 'Aabr, Inc', 'College Point', 'NY', '11356', '2020-12-09 11:03:57', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hco_hcp`
--

DROP TABLE IF EXISTS `hco_hcp`;
CREATE TABLE IF NOT EXISTS `hco_hcp` (
  `hco_id` int(11) NOT NULL,
  `hcp_id` int(11) NOT NULL,
  KEY `hco_id` (`hco_id`),
  KEY `hcp_id` (`hcp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hco_hcp`
--

INSERT INTO `hco_hcp` (`hco_id`, `hcp_id`) VALUES
(1, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hco_specialty`
--

DROP TABLE IF EXISTS `hco_specialty`;
CREATE TABLE IF NOT EXISTS `hco_specialty` (
  `hco_id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  KEY `hco_id` (`hco_id`),
  KEY `specialty_id` (`specialty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hco_specialty`
--

INSERT INTO `hco_specialty` (`hco_id`, `specialty_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hcp`
--

DROP TABLE IF EXISTS `hcp`;
CREATE TABLE IF NOT EXISTS `hcp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hcp_name` varchar(500) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(5) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `specialty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hcp`
--

INSERT INTO `hcp` (`id`, `hcp_name`, `city`, `state`, `zip`, `specialty_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Cecilia Lu Fry', 'Ketchikan', 'AK', '9901', 3, '2020-12-09 11:04:31', '2020-12-10 04:09:54', 0),
(2, 'Eleen Ann Kirman', 'Gilbert', 'AZ', '32767', 1, '2020-12-09 11:04:59', NULL, 0),
(3, 'Neelshah', 'Warrenton', 'VA', '20186', 2, '2020-12-09 11:05:22', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
CREATE TABLE IF NOT EXISTS `specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialty_name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`id`, `specialty_name`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Cancer', '2020-12-09 11:02:07', NULL, 0),
(2, 'ENT', '2020-12-09 11:02:07', NULL, 0),
(3, 'General', '2020-12-09 11:02:15', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hco_hcp`
--
ALTER TABLE `hco_hcp`
  ADD CONSTRAINT `hco_hcp_ibfk_1` FOREIGN KEY (`hco_id`) REFERENCES `hco` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hco_hcp_ibfk_2` FOREIGN KEY (`hcp_id`) REFERENCES `hcp` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `hco_specialty`
--
ALTER TABLE `hco_specialty`
  ADD CONSTRAINT `hco_specialty_ibfk_1` FOREIGN KEY (`hco_id`) REFERENCES `hco` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hco_specialty_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON UPDATE CASCADE;
