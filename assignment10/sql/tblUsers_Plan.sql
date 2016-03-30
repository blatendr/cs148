-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: webdb.uvm.edu
-- Generation Time: Dec 01, 2015 at 09:51 PM
-- Server version: 5.5.45-37.4-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `BCITRIN_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers_Plan`
--

CREATE TABLE IF NOT EXISTS `tblUsers_Plan` (
  `fnkPlanID` int(6) NOT NULL,
  `fldMoveOne` varchar(50) NOT NULL,
  `fldMoveTwo` varchar(50) NOT NULL,
  `fldMoveThree` varchar(50) NOT NULL,
  `fldGoalWeight` int(4) NOT NULL,
  `fldHeight` int(4) NOT NULL,
  `fnkEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblUsers_Plan`
--
ALTER TABLE `tblUsers_Plan`
 ADD PRIMARY KEY (`fnkPlanID`,`fnkEmail`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
