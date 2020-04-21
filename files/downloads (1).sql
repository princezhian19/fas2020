-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2020 at 02:06 AM
-- Server version: 10.2.31-MariaDB-log
-- PHP Version: 7.3.6

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
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `download_id` int(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `file` varchar(200) NOT NULL DEFAULT '',
  `category` int(11) NOT NULL,
  `dateposted` date NOT NULL DEFAULT '0000-00-00',
  `postedby` varchar(50) NOT NULL,
  `hits` int(7) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `office` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`download_id`, `title`, `file`, `category`, `dateposted`, `postedby`, `hits`, `url`, `office`) VALUES
(31, 'ICT Technical Assistance Request Form (TARF)', 'dilg_docs_201988_371edd73d7.pdf', 19, '2019-08-08', 'mmmonteiro', NULL, '', ''),
(38, 'ORD - PPA Implementation Monitoring Summary Log Sheet', 'dilg_docs_2018718_e7f67677b3.docx', 20, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(39, 'ORD - Operational Planning and Budgeting Summary Log Sheet REGION', 'dilg_docs_2018718_9b48801a97.docx', 20, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(40, 'QP#19 (FAD-GSS) Repair Request Summary Log Sheet PROVINCE', 'dilg_docs_2018719_44181b2d21.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(41, 'FAD-GSS-Function Room Summary Log Sheet', 'dilg_docs_2018718_cd6c104128.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(42, 'FAD-GSS-Repair Request Monitoring Log Sheet', 'dilg_docs_2018718_c18e9dee5e.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(43, 'FAD-GSS-Function Room Request Monitoring Log Sheet', 'dilg_docs_2018718_9f2a4c26f1.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(44, 'FAD-GSS-Vehicle Request Summary Log Sheet', 'dilg_docs_2018718_cfe86af488.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(45, 'FAD-GSS-Vehicle Request Monitoring Log Sheet', 'dilg_docs_2018718_7d9319fdfd.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(47, 'FAD-GSS-Provision of Vehicular Support Summary LogSheet', 'dilg_docs_2018718_3b693392ba.docx', 20, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(48, 'FAD-GSS-Maintenance of Vehicles Summary Log Sheet', 'dilg_docs_2018718_4fa9bbd526.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(49, 'FAD-GSS-Maintenance of Vehicles Monitoring Log Sheet', 'dilg_docs_2018718_6db0527641.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(50, 'FAD-GSS-Disposal Summary Log Sheet', 'dilg_docs_2018718_ae9e809534.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(51, 'FAD-GSS-Public Bidding Summary Log Sheet', 'dilg_docs_2018718_0a869a742c.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(52, 'FAD-GSS-Public Bidding Monitoring Log Sheet', 'dilg_docs_2018718_c4cc5df716.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(53, 'FAD-GSS-Public Bidding-Disbursement Voucher Monitoring Log Sheet', 'dilg_docs_2018718_2a982f4cb7.docx', 21, '2018-07-18', 'mmmonteiro', NULL, '', ''),
(54, 'FAD-GSS-NP-SVP Summary Log Sheet', 'dilg_docs_2018719_ae9a68946f.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(55, 'FAD-GSS-NP-SVP Monitoring Log Sheet', 'dilg_docs_2018719_9b33af7913.docx', 20, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(56, 'FAD-GSS-NP-SVP Monitoring LogSheet', 'dilg_docs_2018719_811b6de49f.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(57, 'FAD-GSS-NP-SVP-Disbursement Voucher Monitoring Log Sheet', 'dilg_docs_2018719_6713bf415a.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(58, 'FAD-GSS-Shopping Summary Log Sheet', 'dilg_docs_2018719_da5fbdba1a.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(59, 'FAD-GSS-Shopping Monitoring Log Sheet', 'dilg_docs_2018719_48998dbc2a.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(60, 'FAD-GSS-Shopping-Disbursement Voucher Monitoring Log Sheet', 'dilg_docs_2018719_b8c9ebfe97.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(61, 'FAD-GSS-PS-DBM Summary Log Sheet', 'dilg_docs_2018719_3351f0801e.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(62, 'FAD-GSS-PS-DBM Monitoring Log Sheet', 'dilg_docs_2018719_200c7aa9b3.docx', 21, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(84, '2nd Sem 2018 OPCR Commitment', 'dilg_docs_2018925_d30057de72.pdf', 0, '2018-09-25', 'aaidlao', NULL, '', ''),
(64, 'QP#18 (FAD-GSS) Preparation of APP Summary Log Sheet', 'dilg_docs_2018719_c7bccacc0b.docx', 20, '2018-07-19', 'mmmonteiro', NULL, '', ''),
(67, 'STANDARD SPMS Standard Success Indicators', 'dilg_docs_201888_498c7424d6.pdf', 0, '2018-08-08', 'aaidlao', NULL, '', ''),
(81, '2018 Second Semester Realignment PDF', 'dilg_docs_2018829_e52208808b.pdf', 0, '2018-08-29', 'aaidlao', NULL, '', ''),
(79, '2019 Indicative AOPB', 'dilg_docs_2018817_41c28de6ca.xlsx', 0, '2018-08-17', 'aaidlao', NULL, '', ''),
(80, '2018 Second Semester Realignment', 'dilg_docs_2018820_0dfa096291.xlsx', 0, '2018-08-20', 'aaidlao', NULL, '', ''),
(82, 'Latest SMPS Forms (ISO) as of 2nd Semester 2018', 'dilg_docs_2018829_c4253e5fbe.xlsx', 0, '2018-08-29', 'aaidlao', NULL, '', ''),
(83, '3Q Accomplishment Report', 'dilg_docs_2018917_58197e72eb.xlsx', 0, '2018-09-17', 'aaidlao', NULL, '', ''),
(85, 'Monthly Activity Tracking Report Format', 'dilg_docs_2019220_03488e45e7.xlsx', 0, '2019-02-20', 'aaidlao', NULL, '', ''),
(87, '2020 BUDGET PROPOSAL', 'dilg_docs_2019214_86e2e34cc8.pdf', 0, '2019-02-14', 'aaidlao', NULL, '', ''),
(88, 'try', 'Memo-Processing-of-Salaries-of-Employees-under-COS.pdf', 21, '2020-04-20', 'cvferrer', NULL, '', ''),
(89, 'a', '', 21, '2020-04-20', 'mmmonteiro', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`),
  ADD UNIQUE KEY `download_id` (`download_id`),
  ADD KEY `download_id_2` (`download_id`,`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
