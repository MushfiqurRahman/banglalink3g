-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2014 at 05:43 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2014_banglalink_3g`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `region_id` int(3) NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `areas`
--


-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `area_id` int(3) NOT NULL,
  `team_id` int(4) NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `locations`
--


-- --------------------------------------------------------

--
-- Table structure for table `mobile_brands`
--

CREATE TABLE IF NOT EXISTS `mobile_brands` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `descr` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mobile_brands`
--

INSERT INTO `mobile_brands` (`id`, `title`, `descr`) VALUES
(1, 'Google', 'Google Smart Phone series');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE IF NOT EXISTS `occupations` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `title`) VALUES
(1, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `descr` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `descr`) VALUES
(1, '10MB', 'Daily Pack');

-- --------------------------------------------------------

--
-- Table structure for table `promoters`
--

CREATE TABLE IF NOT EXISTS `promoters` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `team_id` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `promoters`
--

INSERT INTO `promoters` (`id`, `team_id`, `name`, `code`) VALUES
(1, 1, 'First Promoter', 'bp_001');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `regions`
--


-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promoter_id` int(5) NOT NULL,
  `location_id` int(4) NOT NULL,
  `occupation_id` int(3) NOT NULL,
  `package_id` int(3) NOT NULL,
  `mobile_brand_id` int(5) NOT NULL,
  `is_3g` tinyint(1) NOT NULL DEFAULT '1',
  `is_smart_phone` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(40) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `age` int(3) NOT NULL,
  `date_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `surveys`
--


-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`) VALUES
(1, 'Test Team');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created`, `modified`) VALUES
(2, 'Mushfiqur Rahman', 'mushfique@codetrio.com', '3d2541b50cb7be0bcd8060c3af8ecfec8c8d73e5', '2014-05-18 02:08:27', '2014-05-18 06:21:38'),
(3, 'Imran Khan', 'imran@ihover.com', '8b9abc626b0c5052f191545d8201b80dec9f84ea', '2014-05-18 02:56:49', '2014-05-18 02:56:49');
