-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 02:58 AM
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
-- Database: `db_dilg_pmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `disbursement`
--

CREATE TABLE `disbursement` (
  `ID` int(11) NOT NULL,
  `dv` varchar(255) NOT NULL,
  `ors` varchar(255) NOT NULL,
  `sr` varchar(255) NOT NULL,
  `ppa` varchar(255) NOT NULL,
  `uacs` varchar(255) NOT NULL,
  `datereceived` date NOT NULL,
  `timereceived` time DEFAULT NULL,
  `payee` varchar(255) NOT NULL,
  `particular` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `gsis` double NOT NULL,
  `pagibig` double NOT NULL,
  `philhealth` double NOT NULL,
  `other` double NOT NULL,
  `total` double NOT NULL,
  `net` double NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disbursement`
--

INSERT INTO `disbursement` (`ID`, `dv`, `ors`, `sr`, `ppa`, `uacs`, `datereceived`, `timereceived`, `payee`, `particular`, `amount`, `tax`, `gsis`, `pagibig`, `philhealth`, `other`, `total`, `net`, `remarks`, `status`) VALUES
(4, '111111111', '2387 ', 'SR2019-07-1382', '200000100005000', '5-02-12-990-99', '2019-12-27', '04:00:00', 'DANIEL CARLO M. FARENAS', 'Services rendered- Oct 11-25, 2019', 21650.39, 100, 0, 0, 100, 0, 200, 21450.39, 'Returned', 'Pending'),
(5, '121212', '239 ', 'SR2019-07-1369', '200000100004000', '5-02-12-990-99', '2019-12-26', '02:00:00', 'LOUIE G. BUENAVENTURA', 'Services rendered- Oct 11-25, 2019', 13141.57, 100, 100, 100, 100, 100, 500, 12641.57, 'OK', 'Disbursed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disbursement`
--
ALTER TABLE `disbursement`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disbursement`
--
ALTER TABLE `disbursement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
