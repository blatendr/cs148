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
-- Table structure for table `tblPlan`
--

CREATE TABLE IF NOT EXISTS `tblPlan` (
  `pmkPlanID` int(4) NOT NULL,
  `fldMoveOne` varchar(50) NOT NULL,
  `fldMoveTwo` varchar(50) NOT NULL,
  `fldMoveThree` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblPlan`
--

INSERT INTO `tblPlan` (`pmkPlanID`, `fldMoveOne`, `fldMoveTwo`, `fldMoveThree`) VALUES
(1, 'Bicep Curls', 'Tricep Dips', 'Push-ups'),
(2, 'Front Squats', 'Leg Press', 'Calf Raises'),
(3, 'Weighted Plank', 'Sit-ups', 'Cable Crunch'),
(4, 'Lay Down Push-ups', 'Overhead Press', 'Commandos'),
(5, 'Reverse Lunge', 'Sumo Squats', 'Knee-ups'),
(6, 'Straight-leg Jackknifes', 'Mountain Climbers', 'Ab Bikes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblPlan`
--
ALTER TABLE `tblPlan`
 ADD PRIMARY KEY (`pmkPlanID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
