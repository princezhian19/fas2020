-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 06:57 AM
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
-- Database: `midterm_zamora`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(5) NOT NULL,
  `customerFN` varchar(15) NOT NULL,
  `customerLN` varchar(15) NOT NULL,
  `customerAddress` varchar(30) NOT NULL,
  `customerAge` int(5) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerFN`, `customerLN`, `customerAddress`, `customerAge`, `contact`, `email`) VALUES
(3, 'Alver Sumampong', 'a', 'Batuan', 23, '', ''),
(4, 'JohnRill', 'Maglupay', 'Valencia', 18, '', ''),
(5, 'Rad', 'Zamora', 'Inabanga', 22, '', ''),
(6, 'Jason', 'Asa', 'Dauis', 23, '', ''),
(7, 'James Cyril', 'Tadena', 'Jagna', 22, '', ''),
(8, 'GN', 'Lebumfacil', 'Tagbilaran', 21, '', ''),
(9, 'Valerie', 'Omas-as', 'Tagbilaran', 22, '', ''),
(10, 'Grace', 'Cabrillos', 'Tagbilaran', 21, '', ''),
(11, 'Joshua', 'Abug', 'Baclayon', 23, '', ''),
(12, 'Jerel', 'Cagas', 'Jagna', 23, '', ''),
(13, 'asd', 'dsa', 'asd', 1, '', ''),
(14, 'asd', 'dsa', 'asd', 1, '', ''),
(15, 'asd', 'dsa', 'asd', 1, '', ''),
(16, 'asd', 'dsa', 'asd', 1, '', ''),
(17, 'asd', 'dsa', 'asd', 1, '', ''),
(18, 'asd', 'dsa', 'asd', 1, '', ''),
(19, 'asd', 'dsa', 'asd', 1, '', ''),
(20, 'asd', 'dsa', 'asd', 1, '', ''),
(21, 'asd', 'dsa', 'asd', 1, '', ''),
(22, 'asd', 'dsa', 'asd', 1, '', ''),
(23, 'asd', 'dsa', 'asd', 1, '', ''),
(24, 'asd', 'dsa', 'asd', 1, '', ''),
(25, 'asd', 'dsa', 'asd', 1, '', ''),
(26, 'asd', 'dsa', 'asd', 1, '', ''),
(27, 'asd', 'dsa', 'asd', 1, '', ''),
(28, 'asd', 'dsa', 'asd', 1, '', ''),
(29, 'Charles', 'Odi', 'Los Banos Laguna', 0, '0931231293809', 'odicharles@yahoo.com'),
(30, 'Kevin', 'Velchez', 'LB', 0, '0931231293809', 'imsogenerous@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodno` int(3) NOT NULL,
  `prodna` varchar(30) NOT NULL,
  `prodcost` float NOT NULL,
  `prodprice` float NOT NULL,
  `prodqty_sold` float NOT NULL,
  `sales` float NOT NULL,
  `netsales` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodno`, `prodna`, `prodcost`, `prodprice`, `prodqty_sold`, `sales`, `netsales`) VALUES
(1, 'Ballpen', 25, 37, 12, 444, 144),
(2, 'Ice Cream', 200, 250, 2, 500, 100);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `visitID` int(100) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `findings` varchar(255) NOT NULL,
  `customerID` int(5) NOT NULL,
  `dateVisit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`visitID`, `problem`, `findings`, `customerID`, `dateVisit`) VALUES
(1, 'Sample Problem', 'Sample Findings', 3, '2019-05-10 08:51:24'),
(2, 'asdasdasd', 'asdasdas', 4, '2019-05-10 08:51:24'),
(3, 'Problem Two', 'Findings Two', 3, '2019-05-10 08:51:24'),
(4, 'Test sample ', 'Test sample ', 3, '2019-05-10 08:51:24'),
(5, 'Problem ni kevin', 'Findings ni kevin', 30, '2019-05-14 04:05:12'),
(6, 'Problem ko', 'Findings ko', 29, '2019-05-14 04:18:29'),
(7, 'Problem ko2', 'Findings ko1', 29, '2019-05-14 04:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'markdalope', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodno`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`visitID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `visitID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
