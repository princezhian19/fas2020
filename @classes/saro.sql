-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 08:13 AM
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
-- Table structure for table `saro`
--

CREATE TABLE `saro` (
  `id` int(11) NOT NULL,
  `sarodate` date NOT NULL,
  `saronumber` varchar(100) NOT NULL,
  `fund` varchar(100) NOT NULL,
  `legalbasis` varchar(100) NOT NULL,
  `ppa` varchar(100) NOT NULL,
  `expenseclass` varchar(100) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `uacs` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `obligated` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saro`
--
ALTER TABLE `saro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saro`
--
ALTER TABLE `saro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
