-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2019 at 01:52 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seonigeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` varchar(6) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `password`, `code`, `added_on`, `updated_on`) VALUES
(1, 'Samuel Anyaele', 'samuel@seonigeria.com', 'd8ae5776067290c4712fa454006c8ec6', 'SAM001', '2019-03-12 09:30:32', '2019-03-13 12:22:22'),
(2, 'Samson Moses', 'samson@seonigeria.com', '2242a97ea96f6a6d4c7d67c4ff194fd0', 'CHU001', '2019-03-12 09:30:32', '2019-03-12 09:33:24'),
(3, 'Jennifer Ejinkonye', 'jennifer@seonigeria.com', '1660fe5c81c4ce64a2611494c439e1ba', 'JEN001', '2019-03-12 09:32:18', NULL),
(4, 'Uche Anyaele', 'uche@seonigeria.com', '2283cad9ff389c03f08456cfbe16c362', 'UCH001', '2019-03-12 09:32:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `course_id` int(11) NOT NULL,
  `week1` enum('1','0') NOT NULL DEFAULT '0',
  `week2` enum('1','0') NOT NULL DEFAULT '0',
  `week3` enum('1','0') NOT NULL DEFAULT '0',
  `week4` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `course_id`, `week1`, `week2`, `week3`, `week4`) VALUES
(1, 'GEL', 1, '1', '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `duration` varchar(15) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `duration`, `unit_cost`, `total_cost`) VALUES
(1, 'Mobile Productivity Workshop', '4 weeks', 10000, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
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
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `lastname`, `email`, `telephone`, `amount`, `status`, `course_id`, `coupon_name`, `seats`, `class_day`, `month_year`, `week1`, `week2`, `week3`, `week4`, `agent_id`, `ref`, `pay_url`, `date_changed`) VALUES
(1, 'Samuel', 'Anyaele', 'samuelanyaele@gmail.com', '08033954301', 0, 'paid', 1, 'GEL', 3, 'monday', 'April 2019', '1', '0', '0', '1', 0, 'Webpay-5076', '', '2019-03-08 08:17:15'),
(2, 'Samson', 'Moses', 'chenbaland@gmail.com', '08038441830', 0, 'paid', 1, 'GEL', 7, 'monday', 'April 2019', '1', '0', '0', '1', 0, 'Webpay-3603', '', '2019-03-08 08:54:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
