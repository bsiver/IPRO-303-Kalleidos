-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2011 at 05:00 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ipro303`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `username` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `location` varchar(100) default NULL,
  `date` varchar(100) default NULL,
  `category` varchar(100) default NULL,
  `source` varchar(100) default NULL,
  `gender` varchar(100) default NULL,
  PRIMARY KEY  (`comment`),
  KEY `location` (`location`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `Images`
--

CREATE TABLE IF NOT EXISTS `Images` (
  `username` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `date` varchar(100) default NULL,
  `category` varchar(100) default NULL,
  `location` varchar(100) default NULL,
  PRIMARY KEY  (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Images`
--


-- --------------------------------------------------------

--
-- Table structure for table `POI`
--

CREATE TABLE IF NOT EXISTS `POI` (
  `name` varchar(100) NOT NULL,
  `address` varchar(100) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `zip` varchar(30) default NULL,
  `phone` varchar(20) default NULL,
  `type` varchar(100) default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `POI`
--


-- --------------------------------------------------------

--
-- Table structure for table `Statistics`
--

CREATE TABLE IF NOT EXISTS `Statistics` (
  `dateRequested` datetime NOT NULL,
  `numguys` int(11) NOT NULL,
  `numgirls` int(11) NOT NULL,
  PRIMARY KEY  (`dateRequested`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Statistics`
--


-- --------------------------------------------------------

--
-- Table structure for table `Zipcodes`
--

CREATE TABLE IF NOT EXISTS `Zipcodes` (
  `zip` char(5) NOT NULL,
  `city` varchar(64) default NULL,
  `state` char(2) default NULL,
  `area` varchar(500) default NULL,
  `latitude` decimal(12,6) default NULL,
  `longitude` decimal(12,6) default NULL,
  `timezone` int(11) default NULL,
  `dst` int(11) default NULL,
  PRIMARY KEY  (`zip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Zipcodes`
--

