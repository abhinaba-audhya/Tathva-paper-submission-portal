-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.17
-- Generation Time: Apr 19, 2014 at 03:36 PM
-- Server version: 5.5.33
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `papersubmission`
--

-- --------------------------------------------------------

--
-- Table structure for table `Competition`
--

CREATE TABLE `Competition` (
  `C_Id` int(5) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Judge1_chk` int(3) NOT NULL DEFAULT '0',
  `Judge2_chk` int(3) NOT NULL DEFAULT '0',
  `Judge3_chk` int(3) NOT NULL DEFAULT '0',
  `Result` varchar(50) NOT NULL DEFAULT 'Result Yet to be published',
  PRIMARY KEY (`C_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Competition`
--

INSERT INTO `Competition` VALUES(1, '2014-04-17', '2014-04-22', 0, 0, 0, 'Result Yet to be published');

-- --------------------------------------------------------

--
-- Table structure for table `Judge_Paper`
--

CREATE TABLE `Judge_Paper` (
  `P_Id` int(10) NOT NULL,
  `Judge_1` int(10) NOT NULL DEFAULT '0',
  `Judge_2` int(10) NOT NULL DEFAULT '0',
  `Judge_3` int(10) NOT NULL DEFAULT '0',
  `Total` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`P_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Judge_Paper`
--

INSERT INTO `Judge_Paper` VALUES(41, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Memberid` int(10) NOT NULL AUTO_INCREMENT,
  `Username` varchar(40) NOT NULL,
  `Institute` varchar(50) NOT NULL,
  `Roll` varchar(20) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Activation` varchar(40) DEFAULT NULL,
  `Permission` int(2) NOT NULL DEFAULT '0',
  `Ack` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` VALUES(43, 'vikash keshri', 'NIT CALICUT', 'M120354CA', '1234567890', 'vkkeshari20@gmail.com', '123', NULL, 13, 0);
INSERT INTO `User` VALUES(41, 'George Auddy', 'NIT CALICUT', 'm123', '9051919193', 'george.auddy3@gmail.com', '123', NULL, 0, 2);
INSERT INTO `User` VALUES(42, 'Jay Shankar', 'sexy', 'm220360', '54654', 'me.jayshankar051990@gmail.com', '123', NULL, 0, 3);
INSERT INTO `User` VALUES(40, 'Abhinaba Audhya', 'NIT CALICUT', 'M120360CA', '918893090310', 'abhinaba.audhya@gmail.com', '123', NULL, 0, 3);
INSERT INTO `User` VALUES(44, 'jay', 'NIT CALICUT', 'M120387CA', '1234567891', 'jayshankarlenovo@gmail.com', '123', NULL, 4, 0);
INSERT INTO `User` VALUES(45, 'rakesh', 'NIT CALICUT', 'M120363CA', '1234567892', 'rakesh@gmail.com', '123', NULL, 1, 0);
INSERT INTO `User` VALUES(46, 'arvind', 'NIT CALICUT', 'M120352CA', '1234567893', 'arvind@gmail.com', '123', NULL, 2, 0);
INSERT INTO `User` VALUES(47, 'sujay', 'NIT CALICUT', 'M120361CA', '1234567883', 'sujay@gmail.com', '123', NULL, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User_Paper`
--

CREATE TABLE `User_Paper` (
  `Memberid` int(10) NOT NULL,
  `P_Id` int(10) NOT NULL,
  `Topic` varchar(20) NOT NULL,
  `Upload` varchar(40) NOT NULL,
  PRIMARY KEY (`Memberid`,`P_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_Paper`
--

INSERT INTO `User_Paper` VALUES(41, 41, 'ticket_1', 'clt_ypr.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `Validator_Paper`
--

CREATE TABLE `Validator_Paper` (
  `P_Id` int(10) NOT NULL,
  `Valid_Bit` int(5) NOT NULL DEFAULT '0',
  `Chk_Bit` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`P_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Validator_Paper`
--

INSERT INTO `Validator_Paper` VALUES(41, 1, 1);
