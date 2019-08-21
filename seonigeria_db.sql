-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-ipg125.eigbox.net
-- Generation Time: Apr 17, 2019 at 08:49 PM
-- Server version: 5.6.41
-- PHP Version: 4.4.9
-- 
-- Database: `seonigeria`
-- 
CREATE DATABASE `seonigeria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `seonigeria`;

-- --------------------------------------------------------

-- 
-- Table structure for table `agents`
-- 

CREATE TABLE `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` varchar(6) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `agents`
-- 

INSERT INTO `agents` VALUES (1, 'Samuel Anyaele', '2348033954301', 'samuel@seonigeria.com', 'd8ae5776067290c4712fa454006c8ec6', 'SAM001', '2019-03-12 05:30:32', '2019-04-15 12:02:41');
INSERT INTO `agents` VALUES (2, 'Samson Moses', '2348038441930', 'samson@seonigeria.com', '2242a97ea96f6a6d4c7d67c4ff194fd0', 'CHU001', '2019-03-12 05:30:32', '2019-04-15 12:02:56');
INSERT INTO `agents` VALUES (3, 'Jennifer Ejinkonye', '2348179006456', 'jennifer@seonigeria.com', '1660fe5c81c4ce64a2611494c439e1ba', 'JEN001', '2019-03-12 05:32:18', '2019-04-15 12:03:23');
INSERT INTO `agents` VALUES (4, 'Uche Anyaele', '2348100369606', 'uche@seonigeria.com', '2283cad9ff389c03f08456cfbe16c362', 'UCH001', '2019-03-12 05:32:18', '2019-04-15 12:03:50');

-- --------------------------------------------------------

-- 
-- Table structure for table `coupons`
-- 

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `course_id` int(11) NOT NULL,
  `seats` tinyint(4) NOT NULL DEFAULT '1',
  `week1` enum('1','0') NOT NULL DEFAULT '0',
  `week2` enum('1','0') NOT NULL DEFAULT '0',
  `week3` enum('1','0') NOT NULL DEFAULT '0',
  `week4` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `coupons`
-- 

INSERT INTO `coupons` VALUES (1, 'GEL', 1, 2, '1', '0', '0', '1');
INSERT INTO `coupons` VALUES (2, 'GBSng19', 1, 1, '1', '0', '0', '1');

-- --------------------------------------------------------

-- 
-- Table structure for table `courses`
-- 

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `duration` varchar(15) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `courses`
-- 

INSERT INTO `courses` VALUES (1, 'Mobile Productivity Workshop', '4 weeks', 6250, 25000);

-- --------------------------------------------------------

-- 
-- Table structure for table `logs`
-- 

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `log` text NOT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `logs`
-- 

INSERT INTO `logs` VALUES (0, 'samuelanyaele@gmail.com', 'domain: myonedomain.com\n\n domain2: mytwodomain.com\n\n website: standard\n\n firstname: Samuel\n\n lastname: Anyaele\n\n email: samuelanyaele@gmail.com\n\n mobile: 08033954301\n\n for: Website\n\n amount: 10140\n\n pg: pay_partner\n\n ', '2018-11-05 11:12:13');
INSERT INTO `logs` VALUES (0, 'samuelanyaele@gmail.com', 'domain: myonedomain.com\n\n domain2: seconddomain.com.ng\n\n website: ecommerce\n\n firstname: Samuel\n\n lastname: Anyaele\n\n email: samuelanyaele@gmail.com\n\n mobile: 08033954301\n\n for: Website\n\n amount: 10140\n\n pg: pay_partner\n\n ', '2018-11-05 11:18:58');
INSERT INTO `logs` VALUES (0, 'samuelanyaele@gmail.com', 'domain: firstdomain.com\n\n domain2: seconddomain.com.ng\n\n website: standard\n\n firstname: Samuel\n\n lastname: Anyaele\n\n email: samuelanyaele@gmail.com\n\n mobile: 08033954301\n\n for: Website\n\n amount: 10140\n\n pg: pay_partner\n\n ', '2018-11-05 11:22:17');
INSERT INTO `logs` VALUES (0, 'sanyaele@yahoo.com', 'firstname: Samuel\n\n lastname: Anyaele\n\n email: sanyaele@yahoo.com\n\n mobile: 08033954301\n\n for: Payment Integration\n\n amount: 1000\n\n pg: pay_payment\n\n ', '2018-11-09 08:34:47');
INSERT INTO `logs` VALUES (0, 'samuelanyaele@gmail.com', 'firstname: Samuel\n\n lastname: Anyaele\n\n email: samuelanyaele@gmail.com\n\n mobile: 08033954301\n\n for: Payment Integration\n\n amount: 40000\n\n pg: pay_payment\n\n ', '2018-11-13 14:25:03');
INSERT INTO `logs` VALUES (0, 'wiwi@hdfmill.com', 'domain: www.hongdefa.com.ng\n\n domain2: www.hongdefa.com\n\n website: standard\n\n firstname: vivian \n\n lastname: lv\n\n email: wiwi@hdfmill.com\n\n mobile: 13722890692\n\n for: Domain name\n\n amount: 10000\n\n pg: pay_partner\n\n ', '2018-12-21 20:18:47');
INSERT INTO `logs` VALUES (0, 'wiwi@hdfmill.com', 'domain: www.hongdefa.com.ng\n\n domain2: www.hongdefa.ng\n\n website: standard\n\n firstname: vivian \n\n lastname: lv \n\n email: wiwi@hdfmill.com\n\n mobile: +86 137 2289 0692\n\n for: Domain name\n\n amount: 10000\n\n pg: pay_partner\n\n ', '2018-12-25 19:53:52');
INSERT INTO `logs` VALUES (0, 'hhdjddhdjjdnd@hdhbd.com', 'domain: Hbsghdhd.com\n\n domain2: Gdhdjjd.com\n\n website: standard\n\n firstname: Bbcnd\n\n lastname: Gsbbddb\n\n email: hhdjddhdjjdnd@hdhbd.com\n\n mobile: 08056787788\n\n for: Domain name\n\n amount: 10000\n\n pg: pay_partner\n\n ', '2019-01-15 15:00:11');

-- --------------------------------------------------------

-- 
-- Table structure for table `registration`
-- 

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('new','paid','failed') NOT NULL DEFAULT 'new',
  `course_id` int(11) NOT NULL,
  `coupon_name` varchar(20) NOT NULL,
  `seats` tinyint(4) NOT NULL DEFAULT '1',
  `class_day` enum('monday','tuesday','wednesday','thursday','friday','saturday','') NOT NULL DEFAULT '',
  `month_year` varchar(15) NOT NULL,
  `week1` enum('0','1') NOT NULL DEFAULT '0',
  `week2` enum('0','1') NOT NULL DEFAULT '0',
  `week3` enum('0','1') NOT NULL DEFAULT '0',
  `week4` enum('0','1') NOT NULL DEFAULT '0',
  `agent_id` int(11) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `pay_url` varchar(100) NOT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`course_id`,`coupon_name`,`month_year`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `registration`
-- 

INSERT INTO `registration` VALUES (1, 'Adesuwa', 'Ebewele', 'talk2zebby@yahoo.com', '07069367101', 0, 'paid', 1, 'GEL', 1, 'monday', 'April 2019', '1', '0', '0', '1', 4, 'MobileProductivityWorkshop2356', '', '2019-03-16 08:00:28');
INSERT INTO `registration` VALUES (3, 'Bert', 'Nina', 'bertillajae@yahoo.com', '08029931182', 10000, 'new', 1, '', 1, 'monday', 'April 2019', '0', '1', '0', '0', 0, 'MobileProductivityWorkshop1582', 'https://checkout.paystack.com/9aginhlfe8lfy4o', '2019-03-17 15:45:43');
INSERT INTO `registration` VALUES (10, 'Samson', 'Moses', 'chenbaland@gmail.com', '08038441830', 20000, 'new', 1, 'GEL', 1, 'monday', 'April 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop8371', 'https://checkout.paystack.com/h37kb0n79oareju', '2019-03-21 18:43:43');
INSERT INTO `registration` VALUES (17, 'Samuel', 'Anyaele', 'samuelanyaele@gmail.com', '08033954301', 12500, 'new', 1, 'GEL', 1, 'monday', 'April 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop9774', 'https://checkout.paystack.com/h5ig45slsq8nrvm', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (19, 'Iretiola', 'Adebayo-Olubi', 'iretiola.adebayoolubi@gmail.com', '234-8024444104', 25000, 'new', 1, 'GEL', 2, 'monday', 'April 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop1704', 'https://checkout.paystack.com/hoekh3o4sifn35e', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (20, 'SAKIRU', 'RAJI', 'princesakiruraji@gmail.com', '08033068189', 12500, 'new', 1, 'GEL', 1, 'monday', 'April 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop4868', 'https://checkout.paystack.com/2ms56513apo4exo', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (21, 'Folake', 'Adegbite', 'business@giantthoughts.com', '08088001000', 12500, 'new', 1, 'GEL', 1, 'monday', 'April 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop1384', 'https://checkout.paystack.com/n3ecpvw5beocam3', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (22, 'TIMILEHIN', 'ADAMOLEKUN', 'adamolekun_timilehin@yahoo.com', '07068758482', 0, 'paid', 1, 'GEL', 1, 'monday', 'April 2019', '1', '0', '0', '1', 4, 'MobileProductivityWorkshop1629', '', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (23, 'Wisdom', 'Uzoma', 'bwoychi@gmail.com', '08174072313', 12500, 'new', 1, 'GEL', 1, 'monday', 'April 2019', '1', '1', '1', '1', 4, 'MobileProductivityWorkshop7143', 'https://checkout.paystack.com/5nipvg4vp7dt9g7', '2019-04-05 15:38:16');
INSERT INTO `registration` VALUES (24, 'Kenneth', 'Meggison', 'Kmeggison91@gmail.com', '08106326064', 12500, 'new', 1, 'GEL', 1, 'tuesday', 'May 2019', '1', '1', '1', '1', 1, 'MobileProductivityWorkshop1941', 'https://checkout.paystack.com/oew686vsuylsx65', '2019-04-06 03:28:34');
