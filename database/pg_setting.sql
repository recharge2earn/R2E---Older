-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2022 at 10:22 PM
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
-- Table structure for table `pg_setting`
--

CREATE TABLE IF NOT EXISTS `pg_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `token` varchar(500) NOT NULL,
  `mid` varchar(500) NOT NULL,
  `web_status` varchar(100) NOT NULL,
  `app_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pg_setting`
--

INSERT INTO `pg_setting` (`id`, `name`, `token`, `mid`, `web_status`, `app_status`) VALUES
(1, 'PAYTM', '0', '0', 'OFF', 'OFF'),
(2, 'UPI', '0', '', 'OFF', 'OFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pg_setting`
--
ALTER TABLE `pg_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pg_setting`
--
ALTER TABLE `pg_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
