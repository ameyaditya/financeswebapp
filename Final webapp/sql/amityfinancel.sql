-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2019 at 08:36 AM
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
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Init_date` datetime NOT NULL,
  `Balance` float NOT NULL,
  `Details_ID` int(11) NOT NULL,
  `Type_ID` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_no`, `Name`, `Init_date`, `Balance`, `Details_ID`, `Type_ID`, `deleted`) VALUES
('ARA10350', 'Sridhar', '2019-12-30 21:24:56', 0, 36, 2, 0),
('ARA12370', 'Archana', '2019-12-30 21:24:07', 0, 35, 2, 0),
('ARA13134', 'Anandatheertha Parimala', '2019-12-26 08:27:37', 0, 10, 2, 0),
('ARA13861', 'Srikanth K V ', '2019-12-26 08:36:27', 0, 22, 2, 0),
('ARA14002', 'Sathyanarayan', '2019-12-30 21:23:31', 0, 34, 2, 0),
('ARA14106', 'Sudha Murthy', '2019-12-26 08:26:00', 4000, 7, 2, 0),
('ARA14639', 'Sarika A', '2019-12-30 21:08:47', 4000, 27, 2, 0),
('ARA15869', 'Jayaram Gardener', '2019-12-30 21:41:48', 0, 40, 4, 0),
('ARA17868', 'Rajashekar', '2019-12-30 21:21:00', 0, 33, 2, 0),
('ARA18547', 'Sharath D', '2019-12-26 08:26:30', 4000, 8, 2, 0),
('ARA19804', 'Manoj', '2019-12-26 08:35:06', 0, 20, 2, 0),
('ARA21380', 'Miscellaneous', '2019-12-30 21:52:13', 0, 48, 3, 0),
('ARA26497', 'Madhu S', '2019-12-26 08:33:56', 0, 18, 2, 0),
('ARA28703', 'Pankaj Bajaj', '2019-12-26 08:37:14', 4000, 23, 2, 0),
('ARA32291', 'Jayaram S P', '2019-12-26 08:22:16', 0, 2, 2, 0),
('ARA33861', 'Vasant Hulagi', '2019-12-26 08:25:13', 4000, 6, 2, 0),
('ARA36071', 'Ramakrishna Zalaki', '2019-12-26 08:31:05', 4000, 15, 2, 0),
('ARA36129', 'Nivas N', '2019-12-26 08:28:11', 4000, 11, 2, 0),
('ARA36500', 'Raveendra Swimming Pool', '2019-12-30 21:47:50', 0, 44, 4, 0),
('ARA38523', 'Deepak S V', '2019-12-26 08:30:20', 4000, 14, 2, 0),
('ARA39123', 'Yatish Chavan', '2019-12-30 21:09:41', 7000, 29, 2, 0),
('ARA45053', 'Krishna Atreya', '2019-12-26 08:32:47', 4000, 17, 2, 0),
('ARA46031', 'Petrol Bunk', '2019-12-30 21:51:16', 0, 47, 3, 0),
('ARA47436', 'Ganesh', '2019-12-30 21:41:07', 0, 38, 4, 0),
('ARA49000', 'Sharath Babu', '2019-12-30 21:18:33', 4000, 31, 2, 0),
('ARA52446', 'Shrinidhi katti', '2019-12-30 21:07:48', 4000, 25, 2, 0),
('ARA58564', 'G Vishwanath Bhat', '2019-12-26 08:35:47', 4000, 21, 2, 0),
('ARA62127', 'Nagaraj', '2019-12-30 21:09:10', 4000, 28, 2, 0),
('ARA62957', 'Ravi N', '2019-12-26 08:24:32', 0, 5, 2, 0),
('ARA63371', 'Anil Annaporna water supply', '2019-12-30 21:43:57', 0, 41, 4, 0),
('ARA70611', 'Shilpa Aravind', '2019-12-30 21:16:08', 0, 30, 2, 0),
('ARA70813', 'Chandra sekar', '2019-12-26 08:26:58', 4000, 9, 2, 0),
('ARA78418', 'Gautham Achar', '2019-12-30 21:19:21', 4000, 32, 2, 0),
('ARA85270', 'Surya Lift', '2019-12-30 21:48:30', 0, 45, 4, 0),
('ARA87650', 'Yogeesh', '2019-12-26 08:23:53', 4000, 4, 2, 0),
('ARA88130', 'Sridhar G', '2019-12-30 21:08:18', 4000, 26, 2, 0),
('ARA90777', 'Parvathi', '2019-12-30 21:41:14', 0, 39, 4, 0),
('ARA91569', 'Bir', '2019-12-30 21:40:56', 0, 37, 4, 0),
('ARA92491', 'Prabhakara Shetty', '2019-12-26 08:29:45', 4000, 13, 2, 0),
('ARA92908', 'BESCOM Bill', '2019-12-30 21:49:12', 0, 46, 4, 0),
('ARA93987', 'Santhosh', '2019-12-26 08:34:32', 0, 19, 2, 0),
('ARA93988', 'Basant Kumar', '2019-12-26 08:22:52', 4000, 3, 2, 0),
('ARA94330', 'Vinutha Sudheer', '2019-12-26 08:31:30', 4000, 16, 2, 0),
('ARA95939', 'Krishna Pradeep', '2019-12-26 08:28:57', 4000, 12, 2, 0),
('ARA96665', 'Anil S Garbage Collector', '2019-12-30 21:45:56', 0, 43, 4, 0),
('ARA97299', 'Kumar Basaweshwara water supply', '2019-12-30 21:44:52', 0, 42, 4, 0),
('ARAMAIN1', 'Main Account', '2019-11-28 00:00:00', 438920, 1, 1, 0),
('ARAMAIN2', 'Main Account 2', '2019-12-26 09:47:24', 0, 24, 1, 0);

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
(3, 'Adithya', '34567'),
(4, 'jayaram', 'Jsp21362.');

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
(18, 'Income - Events', 'Income'),
(19, 'Internal - Transfer to Bank', 'Internal');

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
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Block` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Flat_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`Details_ID`, `Name`, `Block`, `Flat_no`, `Phone`, `Email`) VALUES
(1, 'Main Account', NULL, NULL, NULL, NULL),
(2, 'Jayaram S P', 'C', '212', '9449681774', 'jayaram.sp21362@gmail.com'),
(3, 'Basant Kumar', 'B', '309', '9900158974', 'basantkumar_srs@yahoo.com'),
(4, 'Yogeesh', 'B', '203', '9482018302', 'yogibarkur@yahoo.com'),
(5, 'Ravi N', 'C', 'G12', '9449504272', 'ravivignesh1959@gmail.com'),
(6, 'Vasant Hulagi', 'A', '108', '9945255223', 'vasant.hulagi@gmail.com'),
(7, 'Sudha Murthy', 'B', '104', '9448046591', 'sudha.murthy3@gmail.com'),
(8, 'Sharath D', 'B', 'G10', '9980077880', 'sharat_d5434@yahoo.co.in'),
(9, 'Chandra sekar', 'B', '204', '9381000925', 'harshini.taruni@gmail.com'),
(10, 'Anandatheertha Parimala', 'A', '306', '9035704982', 'Parimalaanands@gmail.com'),
(11, 'Nivas N', 'A', '406', '9945672686', 'nivasankalyan@gmail.com'),
(12, 'Krishna Pradeep', 'A', '208', '9986269281', 'kichoo.pradeep@gmail.com'),
(13, 'Prabhakara Shetty', 'B', 'G09', '9886295070', 'p_ahety@hotmail.com'),
(14, 'Deepak S V', 'B', '310', '9008770155', 'deepakhathwar.sv@gmail.com'),
(15, 'Ramakrishna Zalaki', 'C', 'G11', '9886552216', 'rgzalaki1986@gmail.com'),
(16, 'Vinutha Sudheer', 'C', '411', '9066053335', 'Pothurusudheer@gmail.com'),
(17, 'Krishna Atreya', 'A', '106', '9980838783', 'krishatreya.mys@gmail.com'),
(18, 'Madhu S', 'A', 'G06', '9845520679', 'kayalmadhus@gmail.com'),
(19, 'Santhosh', 'C', '211', '9972261116', 'santhu.may18@gmail.com'),
(20, 'Manoj', 'C', '102', '8050407346', 'Imbedmanoj@gmail.com'),
(21, 'G Vishwanath Bhat', 'A', '205', '8660350906', 'vishwanath.bhat@yahoo.com'),
(22, 'Srikanth K V ', 'C', '312', '9880520131', 'acharya_sreekanth@rediffmail.com'),
(23, 'Pankaj Bajaj', 'A', 'G08', '9342508438', 'Bajajhappy@gmail.com'),
(24, 'Main Account 2', NULL, NULL, NULL, NULL),
(25, 'Shrinidhi katti', 'A', '408', '8197646454', 'shrinidhi.katti@hotmail.com'),
(26, 'Sridhar G', 'B', '210', '7760984524', 'sridharg.blr@gmail.com'),
(27, 'Sarika A', 'A', '207', '9880991100', 'sagar.surya3@gmail.com'),
(28, 'Nagaraj', 'B', '209', '9686066556', 'Nagaraj.Kigga@gmail.com'),
(29, 'Yatish Chavan', 'A', '407', '8618679276', 'yatishchavan4@gmail.com'),
(30, 'Shilpa Aravind', 'A', 'G07', '9845340022', NULL),
(31, 'Sharath Babu', 'B', '304', '9448084304', NULL),
(32, 'Gautham Achar', 'B', '110', '9742528833', NULL),
(33, 'Rajashekar', 'C', 'G01', '9448775730', NULL),
(34, 'Sathyanarayan', 'C', '201', '9448683693', NULL),
(35, 'Archana', 'C', '202', '9481486788', NULL),
(36, 'Sridhar', 'C', '302', '9620391337', NULL),
(37, 'Bir', NULL, NULL, '8217826500', NULL),
(38, 'Ganesh', NULL, NULL, '8217826500', NULL),
(39, 'Parvathi', NULL, NULL, '8217826500', NULL),
(40, 'Jayaram Gardener', NULL, NULL, '9008953179', NULL),
(41, 'Anil Annaporna water supply', NULL, NULL, '9538961465', NULL),
(42, 'Kumar Basaweshwara water supply', NULL, NULL, '9845103459', NULL),
(43, 'Anil S Garbage Collector', NULL, NULL, NULL, NULL),
(44, 'Raveendra Swimming Pool', NULL, NULL, '9019428806', NULL),
(45, 'Surya Lift', NULL, NULL, NULL, NULL),
(46, 'BESCOM Bill', NULL, NULL, NULL, NULL),
(47, 'Petrol Bunk', NULL, NULL, NULL, NULL),
(48, 'Miscellaneous', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_details`
--

CREATE TABLE `main_details` (
  `ID` int(11) NOT NULL,
  `Maintenance_amount` int(11) NOT NULL,
  `Current_month` int(11) NOT NULL,
  `Total_amount` float NOT NULL,
  `Account_amount` float NOT NULL,
  `Cash_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_details`
--

INSERT INTO `main_details` (`ID`, `Maintenance_amount`, `Current_month`, `Total_amount`, `Account_amount`, `Cash_amount`) VALUES
(1, 4000, 12, 438920, 291696, 147224);

--
-- Triggers `main_details`
--
DELIMITER $$
CREATE TRIGGER `update_res` AFTER UPDATE ON `main_details` FOR EACH ROW if old.Current_month != new.Current_month
THEN
UPDATE accounts SET Balance = Balance + New.Maintenance_amount WHERE Type_ID = 2 AND deleted = 0;
END if
$$
DELIMITER ;

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
(1, 21, 210, 0, 2, 0, 0, 2, 0, 2, 0);

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
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `updatebalances` AFTER INSERT ON `transaction` FOR EACH ROW BEGIN
UPDATE accounts SET Balance = Balance - NEW.Amount WHERE Account_no = NEW.From_acc;
UPDATE accounts SET Balance = Balance + NEW.Amount WHERE Account_no = NEW.To_acc;
if New.Mode_of_payment = 'Cash' THEN
	if New.From_acc = 'ARAMAIN1' THEN
    	UPDATE main_details SET Cash_amount = Cash_amount - New.Amount WHERE ID = 1;
        UPDATE main_details SET Total_amount = Total_amount - New.Amount WHERE ID = 1;
	END IF;
    if New.To_acc = 'ARAMAIN1' THEN
    	UPDATE main_details SET Cash_amount = Cash_amount + New.Amount WHERE ID = 1;
        UPDATE main_details SET Total_amount = Total_amount + New.Amount WHERE ID = 1;
    END IF;
ELSE
	if New.From_acc = 'ARAMAIN1' THEN
    	UPDATE main_details SET Account_amount = Account_amount - New.Amount WHERE ID = 1;
        UPDATE main_details SET Total_amount = Total_amount - New.Amount WHERE ID = 1;
	END IF;
    if New.To_acc = 'ARAMAIN1' THEN
    	UPDATE main_details SET Account_amount = Account_amount + New.Amount WHERE ID = 1;
        UPDATE main_details SET Total_amount = Total_amount + New.Amount WHERE ID = 1;
    END IF;
END IF;
END
$$
DELIMITER ;

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
-- Indexes for table `main_details`
--
ALTER TABLE `main_details`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `denominations`
--
ALTER TABLE `denominations`
  MODIFY `Denominations_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `Details_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `main_details`
--
ALTER TABLE `main_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`From_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`To_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_6` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `transaction_ibfk_7` FOREIGN KEY (`From_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_8` FOREIGN KEY (`To_acc`) REFERENCES `accounts` (`Account_no`),
  ADD CONSTRAINT `transaction_ibfk_9` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
