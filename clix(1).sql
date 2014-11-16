-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2014 at 09:52 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clix`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `languageID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `languageID`, `title`, `text`, `photo`, `date`) VALUES
(3, 1, 'kamal', 'amar', 'images/ads/4elect.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `attribute-group`
--

CREATE TABLE IF NOT EXISTS `attribute-group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enName` varchar(500) NOT NULL,
  `arName` varchar(500) NOT NULL,
  `organize` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attribute-type`
--

CREATE TABLE IF NOT EXISTS `attribute-type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `attribute-type`
--

INSERT INTO `attribute-type` (`id`, `type`) VALUES
(2, 'string'),
(3, 'int'),
(4, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `photo`) VALUES
(6, 'Samsung', ''),
(7, 'Nokia', ''),
(8, 'Iphone', ''),
(9, 'Black Berry', ''),
(10, 'Sony Ericsson', 'images/brands/15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deviceTypeID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `name`, `deviceTypeID`, `brandID`, `photo`, `date`) VALUES
(7, 'Samsung Galaxy Win I8550', 3, 6, 'images/devices/4elect3.jpg', '2014-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `device-attribute`
--

CREATE TABLE IF NOT EXISTS `device-attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceAttributeUnitID` int(11) NOT NULL,
  `attributeGroupID` int(11) NOT NULL,
  `enName` varchar(255) NOT NULL,
  `arName` varchar(255) NOT NULL,
  `attributeType` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `device-attribute`
--

INSERT INTO `device-attribute` (`id`, `deviceAttributeUnitID`, `attributeGroupID`, `enName`, `arName`, `attributeType`) VALUES
(4, 7, 0, '2G Network', 'شبكة 2G', 3),
(5, 7, 0, '3G Network', 'شبكة 3G', 3),
(6, 3, 0, 'SIM', 'البطاقة', 3),
(7, 4, 0, 'Height', 'الطول', 2),
(8, 4, 0, 'Width', 'العرض', 2),
(9, 3, 0, 'Display Type', 'نوع الشاشة', 3),
(10, 8, 0, 'Display Size', 'حجم الشاشة', 3),
(11, 4, 0, 'Multitouch', 'متعدد اللمس', 3),
(12, 5, 0, 'Card slot Memory', 'بطاقة الذاكرة', 1),
(13, 5, 0, 'Internal Memory', 'الذاكرة الداخلية', 1),
(14, 6, 0, 'Camera resoiution', 'دقة الكاميرا', 2),
(15, 3, 0, 'OS', 'نظام التشغيل', 3),
(16, 3, 0, 'CPU Chipset', 'بطاقة المعالح', 3),
(17, 3, 0, 'CPU', 'المعالج', 3),
(18, 3, 0, 'power', 'efref', 0);

-- --------------------------------------------------------

--
-- Table structure for table `device-attribute-type`
--

CREATE TABLE IF NOT EXISTS `device-attribute-type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceTypeID` int(11) NOT NULL,
  `deviceAttributeID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `device-attribute-type`
--

INSERT INTO `device-attribute-type` (`id`, `deviceTypeID`, `deviceAttributeID`) VALUES
(1, 1, 1),
(3, 1, 2),
(4, 3, 3),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(15, 3, 14),
(16, 3, 15),
(17, 3, 16),
(18, 3, 17),
(19, 3, 4),
(20, 5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `device-attribute-unit`
--

CREATE TABLE IF NOT EXISTS `device-attribute-unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `device-attribute-unit`
--

INSERT INTO `device-attribute-unit` (`id`, `name`) VALUES
(1, 'cm'),
(2, 'gm'),
(3, 'none'),
(4, 'mm'),
(5, 'GB'),
(6, 'MP'),
(7, 'MHZ'),
(8, 'inch');

-- --------------------------------------------------------

--
-- Table structure for table `device-for-sale`
--

CREATE TABLE IF NOT EXISTS `device-for-sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `isNew` tinyint(4) NOT NULL,
  `countryID` int(11) NOT NULL,
  `deviceID` int(11) NOT NULL,
  `state` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `device-for-sale`
--

INSERT INTO `device-for-sale` (`id`, `userID`, `date`, `price`, `isNew`, `countryID`, `deviceID`, `state`) VALUES
(2, 0, '2014-11-13', 18000, 1, 0, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device-photo`
--

CREATE TABLE IF NOT EXISTS `device-photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceID` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `device-property`
--

CREATE TABLE IF NOT EXISTS `device-property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceID` int(11) NOT NULL,
  `deviceAttributeID` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `device-property`
--

INSERT INTO `device-property` (`id`, `deviceID`, `deviceAttributeID`, `value`) VALUES
(1, 1, 1, '9'),
(2, 1, 1, '1'),
(31, 7, 5, '1800'),
(32, 7, 6, '2'),
(33, 7, 7, '100'),
(34, 7, 8, '20'),
(35, 7, 9, 'lcd'),
(36, 7, 10, '7'),
(37, 7, 11, 'yes'),
(38, 7, 12, '1'),
(39, 7, 13, '1'),
(40, 7, 14, '5'),
(41, 7, 15, 'android'),
(42, 7, 16, 'snap dragon'),
(43, 7, 17, '1200'),
(44, 7, 4, '1800');

-- --------------------------------------------------------

--
-- Table structure for table `device-type`
--

CREATE TABLE IF NOT EXISTS `device-type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `device-type`
--

INSERT INTO `device-type` (`id`, `name`) VALUES
(3, 'Mobile'),
(5, 'accessories');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'english'),
(2, 'arabic');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `languageID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(2500) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `languageID`, `title`, `text`, `photo`, `date`) VALUES
(1, 1, 'njnrf', 'jijerf', 'images/news/15.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `languageID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offer-device`
--

CREATE TABLE IF NOT EXISTS `offer-device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerID` int(11) NOT NULL,
  `deviceID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `languageID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(1500) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `languageID`, `title`, `text`, `photo`) VALUES
(1, 1, 'samer', 'shatta', 'images/slider/15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `email`, `mobileNumber`, `password`, `lastLogin`) VALUES
(1, 'admin', 'admin@admin.com', '00', 'admin', '2014-11-02 03:08:09'),
(2, 'samer', 'samer.shatta@gmail.com', '0932525649', '123', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user-cart`
--

CREATE TABLE IF NOT EXISTS `user-cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `deviceForSaleID` int(11) NOT NULL,
  `offerID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `isProcessed` tinyint(4) NOT NULL,
  `processingDate` datetime NOT NULL,
  `isAccepted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user-cart`
--

INSERT INTO `user-cart` (`id`, `userID`, `deviceForSaleID`, `offerID`, `date`, `isProcessed`, `processingDate`, `isAccepted`) VALUES
(1, 2, 2, -1, '2014-11-13 12:36:21', 1, '0000-00-00 00:00:00', 1),
(2, 2, 2, -1, '2014-11-13 12:43:12', 1, '2014-11-14 14:59:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user-social-account`
--

CREATE TABLE IF NOT EXISTS `user-social-account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `socialAccountType` int(11) NOT NULL,
  `socialAccountID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
