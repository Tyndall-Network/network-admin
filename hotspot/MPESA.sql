-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2020 at 06:29 PM
-- Server version: 10.3.24-MariaDB-2
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `MPESA`
--

CREATE TABLE `MPESA` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `merchantRequestID` varchar(255) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `checkoutRequestID` varchar(255) NOT NULL,
  `resultCode` int(11) DEFAULT NULL,
  `responseCode` int(11) DEFAULT NULL,
  `resultDesc` varchar(255) DEFAULT NULL,
  `responseDescription` varchar(255) DEFAULT NULL,
  `customerMessage` varchar(255) DEFAULT NULL,
  `mpesaReceiptNumber` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `transactionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `MPESA`
--
ALTER TABLE `MPESA`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MPESA`
--
ALTER TABLE `MPESA`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
