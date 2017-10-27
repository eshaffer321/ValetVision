-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 07:45 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `valet`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `make` varchar(10) NOT NULL,
  `model` varchar(10) NOT NULL,
  `paid_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `make`, `model`, `paid_status`) VALUES
(1, 'Steve Jobs', 'Ford', 'F150', 1),
(2, 'Stevie Wonder', 'Tesla', 'Model 2', 1),
(3, 'Tim Hardaway', 'Chevy', 'Nova', 1),
(4, 'Terry Crews', 'Honda', 'Civic', 0),
(5, 'Jake Shields', 'Mazda', 'RX8', 1),
(6, 'Daniel Chong', 'Honda', 'Accord', 0),
(7, 'Marcus Mariota', 'Mercedes-B', 'CLK', 1),
(8, 'John Madden', 'Dodge', 'Charger', 1),
(9, 'Ryan Braun', 'Toyota', 'Tacoma', 0),
(10, 'Jennifer Lopez', 'Land Rover', 'Range Rove', 1),
(11, 'Christian Bale', 'Dodge', 'Challenger', 0),
(12, 'Ben Dover', 'Kia', 'Optima', 1),
(13, 'Hue Mungus', 'Ford', 'F450', 1),
(14, 'Master P', 'Rolls Royc', 'Fantom', 1),
(15, 'John Gotti', 'Cadillac', 'Escalade', 0),
(16, 'Jimmy Hoffa', 'Dodge', 'Ram', 0),
(17, 'Ray Cruz', 'Honda', 'Civic', 1),
(18, 'Tom Collins', 'Nissan', 'Maxima', 0),
(19, 'Roy Rodgers', 'Nissan', 'Altima', 0),
(20, 'Henry Cejudo', 'Lincoln', 'LS', 0),
(21, 'Jeff Tedford', 'Toyota', 'Prius', 0),
(22, 'Barry Bonds', 'Dodge', 'Viper', 0),
(23, 'Chael Sonnen', 'Chevy', 'Corvette', 1),
(24, 'Tom Hanks', 'Mercedes-B', 'CLK', 0),
(25, 'Angelina Jolie', 'Chevy', 'Suburban', 0),
(26, 'Angie Martinez', 'Dodge', 'Charger', 0),
(27, 'Stan Lee', 'Toyota', 'Tacoma', 0),
(28, 'Jessica Simpson', 'Chevy', 'Impala', 1),
(29, 'Robyn Cherbotsky', 'Ford', 'Focus', 0),
(30, 'Sam Shields', 'Toyota', 'Prius', 0),
(31, 'Erick Shaffer', 'Mazda', 'Speed3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `name`, `active_status`) VALUES
(1, 'Adrian Martinez', 1),
(2, 'Erick Shaffer', 1),
(3, 'Mike Divis', 0),
(4, 'Jason Henderson', 1),
(5, 'Tiger Woods', 1),
(6, 'OJ Simpson', 1),
(7, 'Jon Jones', 1),
(8, 'Vince Vaughan', 1),
(9, 'Mike Honcho', 1),
(10, 'Jason Borne', 1),
(11, 'Mike Katz', 1),
(12, 'Freedom Ryder', 0),
(13, 'Harry Hover', 1),
(14, 'James Sond', 0),
(15, 'William Ackerman', 0),
(16, 'Don Vito', 0),
(17, 'Mike Chang', 1),
(18, 'Ben Dover', 0),
(19, 'Justin Credible', 1),
(20, 'Bill Ding', 0),
(21, 'Isaac Hunt', 1),
(22, 'Tom Kat', 0),
(23, 'Leman Jelo', 1),
(24, 'Oran Jelo', 1),
(25, 'Mike Oxlong', 1),
(26, 'Emma Royds', 0),
(27, 'Billy Reuben', 0),
(28, 'Anne Thrax', 1),
(29, 'Moe Lasses', 1),
(30, 'Hope Knott', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parking_spot`
--

CREATE TABLE IF NOT EXISTS `parking_spot` (
  `parking_spot_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`parking_spot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `parking_spot`
--

INSERT INTO `parking_spot` (`parking_spot_id`, `status`, `ticket_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 11),
(6, 1, 12),
(7, 1, 27),
(8, 1, 13),
(9, 1, 14),
(10, 1, 15),
(11, 0, NULL),
(12, 1, 16),
(13, 0, NULL),
(14, 1, 21),
(15, 1, 23),
(16, 0, NULL),
(17, 1, 22),
(18, 1, 20),
(19, 0, NULL),
(20, 1, 19),
(21, 1, 24),
(22, 1, 25),
(23, 0, NULL),
(24, 1, 26),
(25, 0, NULL),
(26, 0, NULL),
(27, 0, NULL),
(28, 0, NULL),
(29, 0, NULL),
(30, 0, NULL),
(31, 0, NULL),
(32, 0, NULL),
(33, 0, NULL),
(34, 0, NULL),
(35, 0, NULL),
(36, 0, NULL),
(37, 0, NULL),
(38, 0, NULL),
(39, 0, NULL),
(40, 0, NULL),
(41, 0, NULL),
(42, 0, NULL),
(43, 0, NULL),
(44, 0, NULL),
(45, 0, NULL),
(46, 0, NULL),
(47, 0, NULL),
(48, 0, NULL),
(49, 0, NULL),
(50, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `drop_off_driver` int(11) NOT NULL,
  `pick_up_driver` int(11) DEFAULT NULL,
  `parking_spot_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ticket_id`),
  UNIQUE KEY `idx_customer_id` (`customer_id`),
  UNIQUE KEY `idx_parking_spot` (`parking_spot_id`),
  KEY `idx_drop_off_driver` (`drop_off_driver`),
  KEY `idx_pick_up_driver` (`pick_up_driver`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `customer_id`, `drop_off_driver`, `pick_up_driver`, `parking_spot_id`, `time`) VALUES
(1, 1, 8, NULL, 1, '2017-10-17 03:15:00'),
(2, 2, 2, NULL, 2, '2017-10-17 03:25:00'),
(3, 3, 4, NULL, 3, '2017-10-17 08:17:00'),
(4, 4, 5, NULL, 4, '2017-10-17 05:05:00'),
(11, 5, 5, NULL, 5, '2017-10-17 08:12:00'),
(12, 6, 8, NULL, 6, '2017-10-17 07:21:00'),
(13, 7, 4, NULL, 8, '2017-10-17 09:12:00'),
(14, 8, 3, NULL, 9, '2017-10-17 02:42:00'),
(15, 9, 4, NULL, 10, '2017-10-17 02:12:00'),
(16, 10, 3, NULL, 12, '2017-10-17 06:08:00'),
(19, 12, 7, NULL, 20, '2017-10-17 06:09:00'),
(20, 11, 2, NULL, 18, '2017-10-17 04:11:00'),
(21, 13, 3, NULL, 14, '2017-10-17 05:26:00'),
(22, 14, 2, NULL, 17, '2017-10-17 06:08:00'),
(23, 15, 2, NULL, 15, '2017-10-17 07:16:00'),
(24, 16, 2, NULL, 21, '2017-10-17 03:08:00'),
(25, 17, 3, NULL, 22, '2017-10-17 02:11:00'),
(26, 18, 1, NULL, 24, '2017-10-17 10:01:00'),
(27, 31, 6, NULL, 7, '2017-10-27 01:22:28');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`drop_off_driver`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`pick_up_driver`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`parking_spot_id`) REFERENCES `parking_spot` (`parking_spot_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;