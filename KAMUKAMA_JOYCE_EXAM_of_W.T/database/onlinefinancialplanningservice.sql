-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 02:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefinancialplanningservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `AssetID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `AssetName` varchar(100) DEFAULT NULL,
  `Value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`AssetID`, `UserID`, `AssetName`, `Value`) VALUES
(1, 3, 'Savings Account', 15000),
(2, 2, 'Stock Portfolio', 50000),
(3, 1, 'Vehicle', 10000),
(4, 4, '401(k)', 25000),
(5, 2, 'Cash', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PlannerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `UserID`, `PlannerID`) VALUES
(1, 4, 1),
(2, 3, 1),
(3, 1, 2),
(4, 4, 3),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `ConsultationID` int(11) NOT NULL,
  `PlannerID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Purpose` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`ConsultationID`, `PlannerID`, `ClientID`, `Date`, `Purpose`) VALUES
(1, 1, 5, '2024-05-01 09:00:00', 'Retirement Planning'),
(2, 1, 2, '2024-05-03 14:30:00', 'Investment Advice'),
(3, 2, 3, '2024-05-05 11:00:00', 'Debt Management'),
(4, 3, 4, '2024-05-07 10:00:00', 'Savings Strategy'),
(5, 4, 1, '2024-05-10 13:45:00', 'Financial Education');

-- --------------------------------------------------------

--
-- Table structure for table `financialplans`
--

CREATE TABLE `financialplans` (
  `PlanID` int(11) NOT NULL,
  `PlannerID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financialplans`
--

INSERT INTO `financialplans` (`PlanID`, `PlannerID`, `ClientID`, `Title`, `Description`) VALUES
(1, 5, 4, 'Retirement Plan', 'Plan designed to achieve retirement goals.'),
(2, 1, 5, 'Investment Portfolio', 'Portfolio diversified for long-term growth.'),
(3, 2, 3, 'Debt Repayment Plan', 'Strategy to pay off debts efficiently.'),
(4, 3, 2, 'Savings Plan', 'Plan to accumulate savings for future needs.'),
(5, 4, 1, 'Financial Literacy Plan', 'Educational plan for improving financial knowledge.');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `GoalID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `GoalText` varchar(222) DEFAULT NULL,
  `Deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`GoalID`, `UserID`, `GoalText`, `Deadline`) VALUES
(1, 1, 'Save $10,000 for emergency fund', '2024-12-31'),
(2, 2, 'Invest in real estate property', '2024-06-30'),
(3, 3, 'Pay off credit card debt', '2024-08-31'),
(4, 4, 'Start a retirement savings account', '2024-10-31'),
(5, 3, 'Learn about stock market investing', '2024-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `liabilities`
--

CREATE TABLE `liabilities` (
  `LiabilityID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LiabilityName` varchar(100) DEFAULT NULL,
  `Amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liabilities`
--

INSERT INTO `liabilities` (`LiabilityID`, `UserID`, `LiabilityName`, `Amount`) VALUES
(1, 4, 'Credit Card Debt', 5000),
(2, 2, 'Mortgage', 150000),
(3, 3, 'Auto Loan', 8000),
(4, 2, 'Student Loan', 20000),
(5, 1, 'Personal Loan', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `Message`, `Date`) VALUES
(1, 1, 'Your retirement plan consultation is scheduled for tomorrow.', '2024-04-30 15:00:00'),
(2, 2, 'Reminder: Investment advice session is on Thursday.', '2024-05-02 10:00:00'),
(3, 1, 'Debt management consultation is coming up on Friday.', '2024-05-04 12:00:00'),
(4, 4, 'Savings strategy session is scheduled for Monday morning.', '2024-05-06 09:30:00'),
(5, 3, 'Dont forget your financial education session next week.', '2024-05-09 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `ClientID`, `Amount`, `Date`) VALUES
(1, 5, 500.00, '2024-05-02'),
(2, 1, 1000.00, '2024-05-04'),
(3, 3, 200.00, '2024-05-06'),
(4, 4, 300.00, '2024-05-08'),
(5, 2, 50.00, '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `planners`
--

CREATE TABLE `planners` (
  `PlannerID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planners`
--

INSERT INTO `planners` (`PlannerID`, `UserID`) VALUES
(5, 1),
(2, 2),
(3, 3),
(1, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'kamukama', 'joice', 'kamukama45', 'joicekamukama@gmail.com', '0723333435', '$2y$10$XvQaQdu7K53ZlfKm5zXL9uJiG4H7hq6BPkZ4tOd4GSW8fPOthK0Uq', '2024-05-16 11:06:37', '98754', 0),
(2, 'phionnah', 'ishimwe', 'PHIONA09', 'ishimwephionnah@gmail.com', '07843222125', '$2y$10$0vl6m13P1aY.DSFQ2BFECuzlJwwX95/7WqLIu/lazMLdfYmACMiNW', '2024-05-16 11:07:31', '987654', 0),
(3, 'rugwiro', 'ishimwe', 'rugwiroishmwe', 'ishimwerugwiro@gmail.com', '0788903506', '$2y$10$xe6foM6XS9fSmMG99GdMHuF8r1T94lhix0LkOL5GfcFGDwjSCaV/C', '2024-05-16 11:09:19', '9090', 0),
(4, 'peter', 'muneza', 'peterm', 'muneza@gmail.com', '0721123456', '$2y$10$q4Gay50y3VP96IbU4sSTh.3rFxmyh4OtAMIkDoaa2R4n7ZOOzn7.m', '2024-05-16 11:09:59', '8976', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`AssetID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlannerID` (`PlannerID`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`ConsultationID`),
  ADD KEY `PlannerID` (`PlannerID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `financialplans`
--
ALTER TABLE `financialplans`
  ADD PRIMARY KEY (`PlanID`),
  ADD KEY `PlannerID` (`PlannerID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`GoalID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `liabilities`
--
ALTER TABLE `liabilities`
  ADD PRIMARY KEY (`LiabilityID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `planners`
--
ALTER TABLE `planners`
  ADD PRIMARY KEY (`PlannerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `ConsultationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `financialplans`
--
ALTER TABLE `financialplans`
  MODIFY `PlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `GoalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `liabilities`
--
ALTER TABLE `liabilities`
  MODIFY `LiabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `planners`
--
ALTER TABLE `planners`
  MODIFY `PlannerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`PlannerID`) REFERENCES `planners` (`PlannerID`);

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`PlannerID`) REFERENCES `planners` (`PlannerID`),
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `financialplans`
--
ALTER TABLE `financialplans`
  ADD CONSTRAINT `financialplans_ibfk_1` FOREIGN KEY (`PlannerID`) REFERENCES `planners` (`PlannerID`),
  ADD CONSTRAINT `financialplans_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `liabilities`
--
ALTER TABLE `liabilities`
  ADD CONSTRAINT `liabilities_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `planners`
--
ALTER TABLE `planners`
  ADD CONSTRAINT `planners_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
