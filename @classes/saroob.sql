-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 08:14 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fascalab_2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `saroob`
--

CREATE TABLE `saroob` (
  `id` int(11) NOT NULL,
  `datereceived` date NOT NULL,
  `datereprocessed` date NOT NULL,
  `datereturned` date NOT NULL,
  `datereleased` date NOT NULL,
  `ors` varchar(100) NOT NULL,
  `ponum` varchar(100) NOT NULL,
  `payee` varchar(100) NOT NULL,
  `particular` varchar(255) NOT NULL,
  `saronumber` varchar(100) NOT NULL,
  `ppa` varchar(100) NOT NULL,
  `uacs` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saroob`
--
ALTER TABLE `saroob`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saroob`
--
ALTER TABLE `saroob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
