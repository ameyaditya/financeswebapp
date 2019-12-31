-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 09:42 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amityfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Account_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Init_date` datetime NOT NULL,
  `Balance` float NOT NULL,
  `Details_ID` int(11) NOT NULL,
  `Type_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_no`, `Name`, `Init_date`, `Balance`, `Details_ID`, `Type_ID`) VALUES
('ARAMAIN1', 'Main Account', '2019-11-28 00:00:00', 100000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `Type_ID` int(11) NOT NULL,
  `Type_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`Type_ID`, `Type_name`) VALUES
(1, 'Main'),
(2, 'Resident'),
(3, 'Expense'),
(4, 'Payment');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Username`, `Password`) VALUES
(1, 'Amey', '12345'),
(2, 'Kalpaj', '23456'),
(3, 'Adithya', '34567');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_name`, `Type`) VALUES
(1, 'Income - Resident Share', 'Income'),
(2, 'Income - Others', 'Income'),
(3, 'Payment - Garden Maintenance', 'Payment'),
(4, 'Payment - Generator AMC', 'Payment'),
(5, 'Payment - Security Guard', 'Payment'),
(6, 'Payment - House Keeping', 'Payment'),
(7, 'Payment - Water Charges', 'Payment'),
(8, 'Payment - Swimming Pool Maintenance', 'Payment'),
(9, 'Payment - Garbage', 'Payment'),
(10, 'Payment - Common Area Electricity', 'Payment'),
(11, 'Expense - Cleaning and Electrical Materials', 'Expense'),
(12, 'Expense - Generator Diesel', 'Expense'),
(13, 'Expense - Furniture', 'Expense'),
(14, 'Expense - Generator Service', 'Expense'),
(15, 'Expense - Sump and Tank Cleaning', 'Expense'),
(16, 'Expense - Pest Control', 'Expense'),
(17, 'Expense - Others', 'Expense'),
(18, 'Income - Events', 'Income');

-- --------------------------------------------------------

--
-- Table structure for table `denominations`
--

CREATE TABLE `denominations` (
  `Denominations_ID` int(11) NOT NULL,
  `2000` int(11) DEFAULT NULL,
  `500` int(11) DEFAULT NULL,
  `200` int(11) DEFAULT NULL,
  `100` int(11) DEFAULT NULL,
  `50` int(11) DEFAULT NULL,
  `20` int(11) DEFAULT NULL,
  `10` int(11) DEFAULT NULL,
  `5` int(11) DEFAULT NULL,
  `2` int(11) DEFAULT NULL,
  `1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `Details_ID` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Block` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Flat_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`Details_ID`, `Name`, `Block`, `Flat_no`, `Phone`, `Email`) VALUES
(1, 'Main Account', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recon`
--

CREATE TABLE `recon` (
  `Recon_ID` int(11) NOT NULL,
  `2000` int(11) NOT NULL DEFAULT '0',
  `500` int(11) NOT NULL DEFAULT '0',
  `200` int(11) NOT NULL DEFAULT '0',
  `100` int(11) NOT NULL DEFAULT '0',
  `50` int(11) NOT NULL DEFAULT '0',
  `20` int(11) NOT NULL DEFAULT '0',
  `10` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recon`
--

INSERT INTO `recon` (`Recon_ID`, `2000`, `500`, `200`, `100`, `50`, `20`, `10`, `5`, `2`, `1`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_ID` int(11) NOT NULL,
  `From_acc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `To_acc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date_of_transaction` datetime NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Mode_of_payment` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Deno_ID` int(11) DEFAULT NULL,
  `Voucher_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Amount` float NOT NULL,
  `Comments` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_no`),
  ADD KEY `Details_ID` (`Details_ID`),
  ADD KEY `Type_ID` (`Type_ID`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `denominations`
--
ALTER TABLE `denominations`
  ADD PRIMARY KEY (`Denominations_ID`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`Details_ID`);

--
-- Indexes for table `recon`
--
ALTER TABLE `recon`
  ADD PRIMARY KEY (`Recon_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Transaction_ID`),
  ADD KEY `From_acc` (`From_acc`),
  ADD KEY `To_acc` (`To_acc`),
  ADD KEY `Category_ID` (`Category_ID`),
  ADD KEY `Deno_ID` (`Deno_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `denominations`
--
ALTER TABLE `denominations`
  MODIFY `Denominations_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `Details_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recon`
--
ALTER TABLE `recon`
  MODIFY `Recon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`Details_ID`) REFERENCES `details` (`Details_ID`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`Type_ID`) REFERENCES `account_type` (`Type_ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`From_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_10` FOREIGN KEY (`Deno_ID`) REFERENCES `denominations` (`Denominations_ID`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`To_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
