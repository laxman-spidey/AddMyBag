
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
CREATE DATABASE IF NOT EXISTS `AddMyBag` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `AddMyBag`;

-- --------------------------------------------------------

--
-- Table structure for table `add_request`
--

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `google_id` varchar(100) NOT NULL,
  `facebook_id` varchar(100) NOT NULL,
  `alternate_phone` int(11) NOT NULL,
  `user_created_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `place_id` VARCHAR(70) NOT NULL UNIQUE,
  `address` varchar(75) NOT NULL,
  `locality` varchar(30),
  `sub_locality` varchar(30),
  `administrative_area_level_2` varchar(30),
  `administrative_area_level_1` varchar(30),
  `country` varchar(30),
  `latitude` DECIMAL(8,5) NOT NULL,
  `longitude` DECIMAL(8,5) NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Location Master table';

-- --------------------------------------------------------




CREATE TABLE IF NOT EXISTS `add_request` (
  `request_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'User ID FK',
  `from_location` int(11) NOT NULL,
  `to_location` int(11) NOT NULL,
  `preferred_time_of_arrival` datetime,
  `weight` DECIMAL(7,2),
  `comment` varchar(200),
  `status` varchar(1),
  CONSTRAINT fk_add_from FOREIGN KEY (from_location) REFERENCES location(location_id),
  CONSTRAINT fk_add_to FOREIGN KEY (to_location) REFERENCES location(location_id),
  CONSTRAINT fk_add_user FOREIGN KEY (user_id) REFERENCES user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_post`
--

CREATE TABLE IF NOT EXISTS `travel_post` (
  `post_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'User ID FK',
  `from_location` int(11) NOT NULL,
  `to_location` int(11) NOT NULL,
  `available_weight` decimal(7,2) NOT NULL,
  `date_time_of_departure` datetime,
  `date_time_of_arrival` datetime NOT NULL,
  `price_per_kg` DECIMAL(7,2) DEFAULT 0,
  `comment` varchar(200),
  `status` varchar(1),
  CONSTRAINT fk_post_from FOREIGN KEY (from_location) REFERENCES location(location_id),
  CONSTRAINT fk_post_to FOREIGN KEY (to_location) REFERENCES location(location_id),
  CONSTRAINT fk_post_user FOREIGN KEY (user_id) REFERENCES user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `item_category` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `weight` decimal(10,0) NOT NULL,
  CONSTRAINT fk_item_add FOREIGN KEY (request_id) REFERENCES add_request(request_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `rating` decimal(10,0) NOT NULL,
  `review_txt` varchar(500)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `link_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `review_on_add_id` int(11),
  `review_on_post_id` int(11),
  `status` varchar(1),
  CONSTRAINT fk_link_add FOREIGN KEY (request_id) REFERENCES add_request(request_id),
  CONSTRAINT fk_link_post FOREIGN KEY (post_id) REFERENCES travel_post(post_id),
  CONSTRAINT fk_link_post_review FOREIGN KEY (review_on_add_id) REFERENCES review(review_id),
  CONSTRAINT fk_link_add_review FOREIGN KEY (review_on_post_id) REFERENCES review(review_id)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
