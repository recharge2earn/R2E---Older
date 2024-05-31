-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2022 at 10:23 PM
-- Server version: 5.6.49-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_asa_in_net`
--

-- --------------------------------------------------------

--
-- Table structure for table `robotic`
--

CREATE TABLE IF NOT EXISTS `robotic` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `lapu_id` varchar(500) NOT NULL,
  `token` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `response` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `txid` varchar(500) NOT NULL,
  `utr` varchar(500) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `robotic`
--

INSERT INTO `robotic` (`id`, `user_id`, `lapu_id`, `token`, `date`, `response`, `amount`, `status`, `txid`, `utr`) VALUES
(1, '213123', '31231', '3123', '2022-06-07', '3123', '3123', '3123', '3123', '3123'),
(2, '1242', '', '', '2022-06-22', '', '500', 'Pending', 'RC242111565755', ''),
(3, '2491', '', '', '2022-06-22', '', '1000', 'Pending', 'RC230774254011', ''),
(4, '2491', '', '', '2022-06-22', '', '100', 'Pending', 'RC338909858128', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `robotic`
--
ALTER TABLE `robotic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `robotic`
--
ALTER TABLE `robotic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
