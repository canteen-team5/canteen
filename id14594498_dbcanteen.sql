-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2020 at 05:19 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14594498_dbcanteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbcat`
--

DROP TABLE IF EXISTS `tbcat`;
CREATE TABLE IF NOT EXISTS `tbcat` (
  `catcod` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`catcod`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbcat`
--

INSERT INTO `tbcat` (`catcod`, `catname`) VALUES
(26, 'Food'),
(42, 'Bevereges'),
(49, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `tbmenu`
--

DROP TABLE IF EXISTS `tbmenu`;
CREATE TABLE IF NOT EXISTS `tbmenu` (
  `foodcod` int(11) NOT NULL AUTO_INCREMENT,
  `foodname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fooddsc` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foodpic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foodprc` int(11) NOT NULL,
  `foodcatcod` int(11) NOT NULL,
  `foodqty` int(11) NOT NULL,
  `foodispopular` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`foodcod`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbmenu`
--

INSERT INTO `tbmenu` (`foodcod`, `foodname`, `fooddsc`, `foodpic`, `foodprc`, `foodcatcod`, `foodqty`, `foodispopular`) VALUES
(36, 'Maggie', 'Maggie is an international brand of seasonings, instant soups, and noodles that originated in Switzerland in late 19th century.Maggie is a 2015 American post-apocalyptic horror drama film directed by Henry Hobson.  ', 'maggie.jpg', 20, 26, 42, 'yes'),
(39, 'Samosa', 'A samosa is a fried or baked pastry with a savoury filling, such as spiced potatoes, onions, peas, cheese, beef and other meats, or lentils. It may take different forms, including triangular, cone, or half-moon shapes, depending on the region.', 'samosa.webp', 8, 26, 2, 'yes'),
(40, 'Cold Drink', 'A soft drink is a drink that usually contains carbonated water, a sweetener, and a natural or artificial flavoring. The sweetener may be a sugar, high-fructose corn syrup, fruit juice, a sugar substitute, or some combination of these.', 'cold_drink.jpg', 20, 42, 4, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbord`
--

DROP TABLE IF EXISTS `tbord`;
CREATE TABLE IF NOT EXISTS `tbord` (
  `ordcod` int(11) NOT NULL AUTO_INCREMENT,
  `orddate` date NOT NULL,
  `ordusrcod` int(11) NOT NULL,
  `ordfoodcod` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ordtime` time NOT NULL,
  `ordstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ordcost` int(11) NOT NULL,
  `payment` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ordcod`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbord`
--

INSERT INTO `tbord` (`ordcod`, `orddate`, `ordusrcod`, `ordfoodcod`, `ordtime`, `ordstatus`, `ordcost`, `payment`) VALUES
(66, '2020-07-31', 10, '36,39,39', '17:13:44', 'Accepted', 36, 'COD'),
(81, '2020-07-31', 10, '39,40', '17:41:05', 'Accepted', 28, 'COD'),
(84, '2020-08-01', 10, '36,36,36,39', '10:22:15', 'Accepted', 68, 'COD'),
(166, '2020-08-11', 10, '40,40', '14:51:03', 'Cancelled', 40, 'COD'),
(167, '2020-08-11', 11, '36', '14:52:54', 'Accepted', 20, 'COD'),
(168, '2020-08-11', 11, '36', '14:56:56', 'Cancelled', 20, 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `tborddet`
--

DROP TABLE IF EXISTS `tborddet`;
CREATE TABLE IF NOT EXISTS `tborddet` (
  `orddetcod` int(11) NOT NULL AUTO_INCREMENT,
  `orddetordcod` int(11) NOT NULL,
  `orddetfoodcod` int(11) NOT NULL,
  `orddetfoodqty` int(11) NOT NULL,
  PRIMARY KEY (`orddetcod`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborddet`
--

INSERT INTO `tborddet` (`orddetcod`, `orddetordcod`, `orddetfoodcod`, `orddetfoodqty`) VALUES
(172, 166, 40, 2),
(173, 167, 36, 1),
(174, 168, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbusr`
--

DROP TABLE IF EXISTS `tbusr`;
CREATE TABLE IF NOT EXISTS `tbusr` (
  `usrcod` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` int(11) NOT NULL,
  `fname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usrpic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usrname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usrpwd` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usrrol` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `verification` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`usrcod`),
  UNIQUE KEY `usrname` (`usrname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `rollno` (`rollno`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbusr`
--

INSERT INTO `tbusr` (`usrcod`, `rollno`, `fname`, `lname`, `usrpic`, `mobile`, `email`, `gender`, `usrname`, `usrpwd`, `usrrol`, `verification`) VALUES
(10, 18409, 'Rajat', 'Sharma', 'rajat.jpeg', 8679688146, 'rajat18111999@gmail.com', 'Male', 'user1', 'pwd123', 'U', 'Verified'),
(11, 0, '', '', 'rajat.jpeg\r\n\r\n', 0, 'rs97404632@gmail.com', '', 'admin', 'admin', 'A', 'Verified'),
(23, 18430, 'Rohit', 'Kumar', '18430dummy.png', 7807043627, 'rk@gmail.com', 'Male', 'rohit', 'rohit', 'U', 'Pending');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
