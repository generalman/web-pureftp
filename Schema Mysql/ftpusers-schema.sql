-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.49-1ubuntu8.1


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ftpusers
--

CREATE DATABASE IF NOT EXISTS ftpusers;
USE ftpusers;
CREATE TABLE  `ftpusers`.`admin` (
  `Username` varchar(35) NOT NULL DEFAULT '',
  `Password` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `DefaultDir` varchar(254) NOT NULL,
  `Client` varchar(50) NOT NULL,
  `QuotaClient` int(11) NOT NULL,
  PRIMARY KEY (`Username`),
  FULLTEXT KEY `DefaultDir` (`DefaultDir`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO `ftpusers`.`admin` VALUES  ('Administrator',0x3136316562643764343530383962333434366565346530643836646263663932,'/var/ftp','Administrator',0),

CREATE TABLE  `ftpusers`.`corbeille` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `User` varchar(16) NOT NULL DEFAULT '',
  `Password` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `Uid` int(11) NOT NULL DEFAULT '14',
  `Gid` int(11) NOT NULL DEFAULT '5',
  `Dir` varchar(128) NOT NULL DEFAULT '',
  `QuotaFiles` int(10) NOT NULL DEFAULT '500',
  `QuotaSize` int(10) NOT NULL DEFAULT '30',
  `ULBandwidth` int(10) NOT NULL DEFAULT '80',
  `DLBandwidth` int(10) NOT NULL DEFAULT '80',
  `Ipaddress` varchar(15) NOT NULL DEFAULT '*',
  `Comment` tinytext,
  `Status` enum('0','1') NOT NULL DEFAULT '1',
  `ULRatio` smallint(5) NOT NULL DEFAULT '1',
  `DLRatio` smallint(5) NOT NULL DEFAULT '1',
  `QuotaDiskUsage` int(15) NOT NULL,
  `QuotaFilesUsage` int(15) NOT NULL,
  `Client` varchar(50) NOT NULL,
  `QuotaClientPercentUse` int(15) DEFAULT NULL,
  `block` smallint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

CREATE TABLE  `ftpusers`.`users` (
  `User` varchar(16) NOT NULL DEFAULT '',
  `Password` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `Uid` int(11) NOT NULL DEFAULT '14',
  `Gid` int(11) NOT NULL DEFAULT '5',
  `Dir` varchar(128) NOT NULL DEFAULT '',
  `QuotaFiles` int(10) NOT NULL DEFAULT '500',
  `QuotaSize` int(10) NOT NULL DEFAULT '30',
  `ULBandwidth` int(10) NOT NULL DEFAULT '80',
  `DLBandwidth` int(10) NOT NULL DEFAULT '80',
  `Ipaddress` varchar(15) NOT NULL DEFAULT '*',
  `Comment` tinytext,
  `Status` enum('0','1') NOT NULL DEFAULT '1',
  `ULRatio` smallint(5) NOT NULL DEFAULT '1',
  `DLRatio` smallint(5) NOT NULL DEFAULT '1',
  `QuotaDiskUsage` int(15) NOT NULL,
  `QuotaFilesUsage` int(15) NOT NULL,
  `Client` varchar(50) NOT NULL,
  `QuotaClientPercentUse` int(15) DEFAULT NULL,
  `block` smallint(2) NOT NULL,
  PRIMARY KEY (`User`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
