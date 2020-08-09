-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2020 at 04:59 AM
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
-- Database: `dbcanteen`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `delcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delcat` (IN `ccod` INT)  NO SQL
DELETE from tbcat WHERE catcod = ccod$$

DROP PROCEDURE IF EXISTS `delmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delmenu` (IN `fcod` INT)  NO SQL
DELETE from tbmenu WHERE foodcod = fcod$$

DROP PROCEDURE IF EXISTS `delord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delord` (IN `ocod` INT)  NO SQL
DELETE from tbord WHERE ordcod=ocod$$

DROP PROCEDURE IF EXISTS `delusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delusr` (IN `ucod` INT)  NO SQL
DELETE FROM tbusr WHERE usrcod = ucod$$

DROP PROCEDURE IF EXISTS `dspcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspcat` ()  NO SQL
SELECT * FROM tbcat$$

DROP PROCEDURE IF EXISTS `dspmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspmenu` ()  NO SQL
SELECT * FROM tbmenu$$

DROP PROCEDURE IF EXISTS `dspord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspord` ()  NO SQL
SELECT * FROM tbord ORDER BY ordcod DESC$$

DROP PROCEDURE IF EXISTS `dspusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusr` ()  NO SQL
SELECT * from tbusr$$

DROP PROCEDURE IF EXISTS `fndcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndcat` (IN `ccod` INT)  NO SQL
SELECT * from tbcat WHERE catcod = ccod$$

DROP PROCEDURE IF EXISTS `fndmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndmenu` (IN `fcod` INT)  NO SQL
SELECT * from tbmenu WHERE foodcod=fcod$$

DROP PROCEDURE IF EXISTS `fndord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndord` (IN `ocod` INT)  NO SQL
SELECT * from tbord WHERE ordcod=ocod ORDER BY ordcod DESC$$

DROP PROCEDURE IF EXISTS `fndusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndusr` (IN `ucod` INT)  NO SQL
SELECT * FROM tbusr where usrcod=ucod$$

DROP PROCEDURE IF EXISTS `inscat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscat` (IN `catnam` VARCHAR(50))  NO SQL
INSERT tbcat VALUES(null,catnam)$$

DROP PROCEDURE IF EXISTS `insmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insmenu` (IN `fnam` VARCHAR(50), IN `fdsc` VARCHAR(500), IN `fpic` VARCHAR(100), IN `fprc` INT, IN `fcatcod` INT, IN `fisavl` CHAR(5), IN `fqty` INT, IN `fpop` VARCHAR(10))  NO SQL
INSERT tbmenu VALUES(null,fnam,fdsc,fpic,fprc,fcatcod,fisavl,fqty,fpop)$$

DROP PROCEDURE IF EXISTS `insord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insord` (IN `odate` DATE, IN `ousrcod` INT, IN `ofoodcod` VARCHAR(500), IN `otime` TIME, IN `ostatus` VARCHAR(20), IN `ocost` INT)  NO SQL
BEGIN
INSERT tbord VALUES(null, odate, ousrcod, ofoodcod, otime, ostatus, ocost);
END$$

DROP PROCEDURE IF EXISTS `insorddet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insorddet` (IN `odoc` INT, IN `odfc` INT, IN `odfqty` INT)  NO SQL
INSERT tborddet VALUES (null, odoc, odfc, odfqty)$$

DROP PROCEDURE IF EXISTS `insusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insusr` (IN `rollno` INT, IN `fnam` VARCHAR(20), IN `lnam` VARCHAR(20), IN `upic` VARCHAR(100), IN `mob` BIGINT, IN `email` VARCHAR(25), IN `gndr` VARCHAR(10), IN `usrnam` VARCHAR(20), IN `pwd` VARCHAR(20))  NO SQL
INSERT tbusr VALUES (null, rollno, fnam, lnam, upic, mob, email, gndr, usrnam, pwd, 'U', 'Pending')$$

DROP PROCEDURE IF EXISTS `login_check`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login_check` (IN `usrnam` VARCHAR(20), IN `pwd` VARCHAR(20))  NO SQL
select * from tbusr where usrname=usrnam and usrpwd=pwd$$

DROP PROCEDURE IF EXISTS `updcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updcat` (IN `ccod` INT, IN `cnam` VARCHAR(50))  NO SQL
UPDATE tbcat SET catname = cnam WHERE catcod = ccod$$

DROP PROCEDURE IF EXISTS `updmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updmenu` (IN `fcod` INT, IN `fnam` VARCHAR(50), IN `fdsc` VARCHAR(500), IN `fpic` VARCHAR(100), IN `fprc` INT, IN `fcatcod` INT, IN `fisavl` CHAR(5), IN `fqty` INT)  NO SQL
UPDATE tbmenu set foodname=fnam, fooddsc=fdsc, foodpic=fpic, foodprc=fprc, foodcatcod=fcatcod, foodisavl=fisavl, foodqty=fqty where foodcod = fcod$$

DROP PROCEDURE IF EXISTS `updord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updord` (IN `ocod` INT, IN `oqty` INT, IN `ostatus` VARCHAR(20))  NO SQL
UPDATE tbord set ordqty=oqty, ordstatus=ostatus where ordcod=ocod$$

DROP PROCEDURE IF EXISTS `updusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updusr` (IN `ucod` INT, IN `rollno` INT, IN `fnam` VARCHAR(20), IN `lnam` VARCHAR(20), IN `upic` VARCHAR(100), IN `mob` BIGINT, IN `email` VARCHAR(25), IN `gndr` VARCHAR(10), IN `unam` VARCHAR(20))  NO SQL
UPDATE tbusr set rollno=rollno, fname=fnam, lname=lnam, usrpic=upic, mobile=mob, email=email, gender=gndr, usrname=unam where usrcod=ucod$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbcat`
--

DROP TABLE IF EXISTS `tbcat`;
CREATE TABLE IF NOT EXISTS `tbcat` (
  `catcod` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
  `foodname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fooddsc` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `foodpic` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `foodprc` int(11) NOT NULL,
  `foodcatcod` int(11) NOT NULL,
  `foodisavl` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foodqty` int(11) NOT NULL,
  `foodispopular` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`foodcod`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbmenu`
--

INSERT INTO `tbmenu` (`foodcod`, `foodname`, `fooddsc`, `foodpic`, `foodprc`, `foodcatcod`, `foodisavl`, `foodqty`, `foodispopular`) VALUES
(36, 'Maggie', 'Maggie is an international brand of seasonings, instant soups, and noodles that originated in Switzerland in late 19th century.Maggie is a 2015 American post-apocalyptic horror drama film directed by Henry Hobson.  ', 'maggie.jpg', 20, 26, 'True', 2, 'yes'),
(39, 'Samosa', 'A samosa is a fried or baked pastry with a savoury filling, such as spiced potatoes, onions, peas, cheese, beef and other meats, or lentils. It may take different forms, including triangular, cone, or half-moon shapes, depending on the region.', 'samosa.webp', 8, 26, 'True', 2, 'yes'),
(40, 'Cold Drink', 'A soft drink is a drink that usually contains carbonated water, a sweetener, and a natural or artificial flavoring. The sweetener may be a sugar, high-fructose corn syrup, fruit juice, a sugar substitute, or some combination of these.', 'cold_drink.jpg', 20, 42, 'True', 3, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbord`
--

DROP TABLE IF EXISTS `tbord`;
CREATE TABLE IF NOT EXISTS `tbord` (
  `ordcod` int(11) NOT NULL AUTO_INCREMENT,
  `orddate` date NOT NULL,
  `ordusrcod` int(11) NOT NULL,
  `ordfoodcod` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `ordtime` time NOT NULL,
  `ordstatus` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ordcost` int(11) NOT NULL,
  `payment` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ordcod`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbord`
--

INSERT INTO `tbord` (`ordcod`, `orddate`, `ordusrcod`, `ordfoodcod`, `ordtime`, `ordstatus`, `ordcost`, `payment`) VALUES
(66, '2020-07-31', 10, '36,39,39', '17:13:44', 'Accepted', 36, ''),
(81, '2020-07-31', 10, '39,40', '17:41:05', 'Accepted', 28, ''),
(84, '2020-08-01', 10, '36,36,36,39', '10:22:15', 'Accepted', 68, ''),
(138, '2020-08-08', 11, '40', '19:30:27', 'Pending', 20, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborddet`
--

INSERT INTO `tborddet` (`orddetcod`, `orddetordcod`, `orddetfoodcod`, `orddetfoodqty`) VALUES
(119, 138, 40, 1),
(121, 139, 36, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbusr`
--

DROP TABLE IF EXISTS `tbusr`;
CREATE TABLE IF NOT EXISTS `tbusr` (
  `usrcod` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` int(11) NOT NULL,
  `fname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `usrpic` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `usrname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `usrpwd` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usrrol` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `verification` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
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
(11, 0, '', '', 'rajat.jpeg\r\n\r\n', 0, '', '', 'admin', 'admin', 'A', 'Verified'),
(23, 18430, 'Rohit', 'Kumar', '18430dummy.png', 7807043627, 'rk@gmail.com', 'Male', 'rohit', 'rohit', 'U', 'Pending');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
