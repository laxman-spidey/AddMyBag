-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2016 at 03:25 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `addmybag`
--
CREATE DATABASE IF NOT EXISTS `addmybag` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `addmybag`;

-- --------------------------------------------------------

--
-- Table structure for table `add_request`
--

CREATE TABLE IF NOT EXISTS `add_request` (
  `Request_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL COMMENT 'User ID FK',
  `ToCountry` varchar(50) NOT NULL,
  `ToLocation` varchar(100) NOT NULL,
  `FromCountry` varchar(50) NOT NULL,
  `FromLocation` varchar(100) NOT NULL,
  `PreferredTimeOfArrival` datetime NOT NULL,
  `Comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ItemId` int(11) NOT NULL,
  `Item_category` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Weight` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `LocationId` int(11) NOT NULL,
  `PlaceId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Latitude` varchar(100) NOT NULL,
  `Longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Location Master table';

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `MapId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `RequestId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `Review_Id` int(11) NOT NULL,
  `Review_on_request` tinyint(1) NOT NULL COMMENT '0 for Post, 1 for Request',
  `ByUserId` int(11) NOT NULL,
  `Rating` decimal(10,0) NOT NULL,
  `Review_txt` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_post`
--

CREATE TABLE IF NOT EXISTS `travel_post` (
  `Post_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL COMMENT 'User ID FK',
  `From_country` varchar(50) NOT NULL,
  `From_location` varchar(100) NOT NULL,
  `To_country` varchar(50) NOT NULL,
  `To_location` varchar(100) NOT NULL,
  `Available_weight` decimal(10,0) NOT NULL,
  `DateAndTimeOfDeparture` datetime NOT NULL,
  `DateAndTimeOfArrival` datetime NOT NULL,
  `PricePerKg` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone Number` bigint(20) NOT NULL,
  `Address` varchar(10000) NOT NULL,
  `GoogleId` varchar(100) NOT NULL,
  `FacebookId` varchar(100) NOT NULL,
  `Alternate Number` int(11) NOT NULL,
  `UserCreatedTs` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
