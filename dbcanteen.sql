-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2020 at 01:16 PM
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

DROP PROCEDURE IF EXISTS `dspusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusr` ()  NO SQL
SELECT * from tbusr$$

DROP PROCEDURE IF EXISTS `fndcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndcat` (IN `ccod` INT)  NO SQL
SELECT * from tbcat WHERE catcod = ccod$$

DROP PROCEDURE IF EXISTS `fndmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndmenu` (IN `fcod` INT)  NO SQL
SELECT * from tbmenu WHERE foodcod=fcod$$

DROP PROCEDURE IF EXISTS `fndusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndusr` (IN `ucod` INT)  NO SQL
SELECT * FROM tbusr where usrcod=ucod$$

DROP PROCEDURE IF EXISTS `inscat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscat` (IN `catnam` VARCHAR(50))  NO SQL
INSERT tbcat VALUES(null,catnam)$$

DROP PROCEDURE IF EXISTS `insmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insmenu` (IN `fnam` VARCHAR(50), IN `fdsc` VARCHAR(500), IN `fpic` VARCHAR(100), IN `fprc` INT, IN `fcatcod` INT, IN `fisavl` CHAR(1), IN `fqty` INT)  NO SQL
INSERT tbmenu VALUES(null,fnam,fdsc,fpic,fprc,fcatcod,fisavl,fqty)$$

DROP PROCEDURE IF EXISTS `insord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insord` (IN `odate` DATE, IN `ousrcod` INT, IN `ofoodcod` INT, IN `oqty` INT, IN `otime` TIME)  NO SQL
INSERT tbord VALUES(null, odate, ousrcod, ofoodcod, oqty, otime)$$

DROP PROCEDURE IF EXISTS `insusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insusr` (IN `fnam` VARCHAR(20), IN `lnam` VARCHAR(20), IN `addr` VARCHAR(500), IN `mob` BIGINT, IN `email` VARCHAR(25), IN `usrnam` VARCHAR(20), IN `usrpwd` VARCHAR(20), IN `rollno` INT)  NO SQL
INSERT tbusr VALUES (null, rollno, fnam, lnam, addr, mob, email, usrnam, usrpwd, 'A')$$

DROP PROCEDURE IF EXISTS `updcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updcat` (IN `ccod` INT, IN `cnam` VARCHAR(50))  NO SQL
UPDATE tbcat SET catnam = cnam WHERE catcod = ccod$$

DROP PROCEDURE IF EXISTS `updmenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updmenu` (IN `fcod` INT, IN `fnam` VARCHAR(50), IN `fdsc` VARCHAR(500), IN `fprc` INT, IN `fcatcod` INT, IN `fisavl` CHAR(1), IN `fqty` INT, IN `fpic` VARCHAR(100))  NO SQL
UPDATE tbmenu set foodname=fnam, fooddsc=fdsc, foodpic=fpic, foodprc=fprc, foodcatcod=fcatcod, foodisavl=fisavl, foodqty=fqty$$

DROP PROCEDURE IF EXISTS `updusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updusr` (IN `ucod` INT, IN `rollno` INT, IN `fnam` VARCHAR(20), IN `lnam` VARCHAR(20), IN `addr` VARCHAR(500), IN `mob` BIGINT, IN `email` VARCHAR(25), IN `usrnam` VARCHAR(25), IN `usrpwd` VARCHAR(25))  NO SQL
UPDATE tbusr set rollno=rollno, fname=fnam, lname=lnam, address=addr, mobile=mob, email=email, usrname=usram, usrpwd=usrpwd where usrcod=ucod$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbcat`
--

DROP TABLE IF EXISTS `tbcat`;
CREATE TABLE IF NOT EXISTS `tbcat` (
  `catcod` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL,
  PRIMARY KEY (`catcod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbmenu`
--

DROP TABLE IF EXISTS `tbmenu`;
CREATE TABLE IF NOT EXISTS `tbmenu` (
  `foodcod` int(11) NOT NULL AUTO_INCREMENT,
  `foodname` varchar(50) NOT NULL,
  `fooddsc` varchar(500) NOT NULL,
  `foodpic` varchar(100) NOT NULL,
  `foodprc` int(11) NOT NULL,
  `foodcarcod` int(11) NOT NULL,
  `foodisavl` char(1) NOT NULL,
  `foodqty` int(11) NOT NULL,
  PRIMARY KEY (`foodcod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbord`
--

DROP TABLE IF EXISTS `tbord`;
CREATE TABLE IF NOT EXISTS `tbord` (
  `ordcod` int(11) NOT NULL AUTO_INCREMENT,
  `orddate` date NOT NULL,
  `ordusrcod` int(11) NOT NULL,
  `ordfoodcod` int(11) NOT NULL,
  `ordqty` int(11) NOT NULL,
  `ordtime` time NOT NULL,
  PRIMARY KEY (`ordcod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `ordstatus` varchar(50) NOT NULL,
  PRIMARY KEY (`orddetcod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbusr`
--

DROP TABLE IF EXISTS `tbusr`;
CREATE TABLE IF NOT EXISTS `tbusr` (
  `usrcod` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `gender` char(1) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `usrname` varchar(20) NOT NULL,
  `usrpwd` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usrrol` char(1) NOT NULL,
  PRIMARY KEY (`usrcod`),
  UNIQUE KEY `usrname` (`usrname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbusr`
--

INSERT INTO `tbusr` (`usrcod`, `rollno`, `fname`, `lname`, `Address`, `gender`, `mobile`, `email`, `usrname`, `usrpwd`, `usrrol`) VALUES
(1, 0, 'Admin', '', '', '', 0, '', 'admin', 'admin', 'A'),
(2, 18409, 'Rajat', 'Sharma', 'blp', '', 84794855, 'rajat@gmail.com', 'user', 'pwd', 'U');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
