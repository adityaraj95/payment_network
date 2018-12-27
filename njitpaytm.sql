-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2018 at 05:16 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `njitpaytm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankaccount`
--

DROP TABLE IF EXISTS `bankaccount`;
CREATE TABLE IF NOT EXISTS `bankaccount` (
  `bankID` int(10) NOT NULL,
  `accountNumber` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `isPrimary` int(1) NOT NULL,
  `isVerified` int(1) NOT NULL,
  PRIMARY KEY (`bankID`,`accountNumber`,`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankaccount`
--

INSERT INTO `bankaccount` (`bankID`, `accountNumber`, `userID`, `isPrimary`, `isVerified`) VALUES
(1, 65666, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `PlanID` int(10) NOT NULL,
  `WeeklyTransferLimit` decimal(65,2) NOT NULL,
  `SingleTransferLimit` decimal(65,2) NOT NULL,
  `WeeklyPaymentLimit` decimal(65,2) NOT NULL,
  PRIMARY KEY (`PlanID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requestpayment`
--

DROP TABLE IF EXISTS `requestpayment`;
CREATE TABLE IF NOT EXISTS `requestpayment` (
  `RequestID` int(255) NOT NULL AUTO_INCREMENT,
  `payeeUserID` int(255) NOT NULL,
  `requestDateTime` datetime NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `memo` varchar(255) NOT NULL,
  PRIMARY KEY (`RequestID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestpayment`
--

INSERT INTO `requestpayment` (`RequestID`, `payeeUserID`, `requestDateTime`, `amount`, `memo`) VALUES
(4, 1, '2018-12-08 21:00:09', '12.00', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `requestpaymenttoken`
--

DROP TABLE IF EXISTS `requestpaymenttoken`;
CREATE TABLE IF NOT EXISTS `requestpaymenttoken` (
  `RequestID` int(10) NOT NULL,
  `payorTokenId` int(10) NOT NULL,
  PRIMARY KEY (`RequestID`,`payorTokenId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestpaymenttoken`
--

INSERT INTO `requestpaymenttoken` (`RequestID`, `payorTokenId`) VALUES
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sendpayment`
--

DROP TABLE IF EXISTS `sendpayment`;
CREATE TABLE IF NOT EXISTS `sendpayment` (
  `paymentID` int(255) NOT NULL AUTO_INCREMENT,
  `payorUserID` int(10) NOT NULL,
  `payeeTokenID` int(10) NOT NULL,
  `paymentDateTime` datetime NOT NULL,
  `amount` int(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `isCancelled` int(1) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sendpayment`
--

INSERT INTO `sendpayment` (`paymentID`, `payorUserID`, `payeeTokenID`, `paymentDateTime`, `amount`, `memo`, `isCancelled`) VALUES
(1, 1, 2, '2018-12-08 00:00:00', 111, 'lol', 0),
(2, 2, 1, '2018-12-08 00:00:00', 11, 'Test', 0),
(3, 2, 1, '2018-12-08 00:00:00', 12, 'Test', 0),
(4, 2, 1, '2018-12-08 18:06:06', 12, 'Test', 0),
(5, 1, 2, '2018-12-08 22:26:12', 99, 'lele', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `tokenID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `tokenType` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneNumber` int(255) NOT NULL,
  `isVerifiedToken` int(1) NOT NULL,
  PRIMARY KEY (`tokenID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`tokenID`, `userID`, `tokenType`, `email`, `phoneNumber`, `isVerifiedToken`) VALUES
(1, 1, 'e', 'tg273@njit.edu', 0, 1),
(2, 2, 'e', 'ac968@njit.edu', 123123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(30) NOT NULL,
  `pEmailID` varchar(30) NOT NULL,
  `password` varchar(14) NOT NULL,
  `planID` int(30) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `SSN` int(10) NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  `isConfirmed` int(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `SSN` (`SSN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `pEmailID`, `password`, `planID`, `firstName`, `lastName`, `SSN`, `balance`, `isConfirmed`) VALUES
(1, 'tg273@njit.edu', '123123', 1, 'Tanay', 'Ghosh', 123456789, '598.00', 1),
(2, 'ac968@njit.edu', 'terimaka', 2, 'Adityaraj', 'Chauhan', 420666420, '382.00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
