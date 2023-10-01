-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2023 at 12:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Shamba`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cashflow`
--

CREATE TABLE `Cashflow` (
  `id` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Amount` varchar(500) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cashflow`
--

INSERT INTO `Cashflow` (`id`, `User`, `Amount`, `dateAdded`) VALUES
(1, 5, '980000', '2023-09-30 11:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `Expenditure`
--

CREATE TABLE `Expenditure` (
  `id` int(11) NOT NULL,
  `Expense` varchar(255) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Expenditure`
--

INSERT INTO `Expenditure` (`id`, `Expense`, `DateAdded`) VALUES
(1, 'Fertilizer', '2023-08-30 07:13:11'),
(3, 'Weeding', '2023-08-30 07:13:25'),
(4, 'Transport', '2023-08-30 07:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

CREATE TABLE `Projects` (
  `id` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `Tonage` varchar(255) DEFAULT NULL,
  `Size` varchar(255) DEFAULT NULL,
  `Season` varchar(255) NOT NULL,
  `Expense` varchar(255) DEFAULT NULL,
  `Amount` int(11) NOT NULL,
  `Date` date NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`id`, `ProjectName`, `Tonage`, `Size`, `Season`, `Expense`, `Amount`, `Date`, `DateAdded`) VALUES
(1, 'Project 2', '56', '400', 'Season 2', 'Fertilizer', 22000000, '2001-08-29', '2023-08-29 19:26:40'),
(2, 'Project 2', '220', '110', 'Season 2', 'Weeding', 46000, '1974-05-02', '2023-08-29 19:26:51'),
(3, 'Project 1', '23', '10', 'Season 1', 'Fertilizer', 860000, '2015-07-20', '2023-08-29 19:29:28'),
(4, 'Project 1', '65', '450', 'Season 2', 'Transport', 22000, '2001-08-29', '2023-08-29 19:42:12'),
(6, 'Project 1', '450', '34', 'Season 2', 'Weeding', 230000, '1972-09-24', '2023-08-30 08:40:37'),
(7, 'Project 1', '45', '34', 'Season 2', 'Transport', 500, '2023-08-23', '2023-08-30 18:10:49'),
(8, 'Project 1', '32', '4.5', 'Season 2', 'Fertilizer', 7500, '2023-08-01', '2023-08-30 18:54:17'),
(9, 'Project 1', NULL, NULL, 'Season 1', 'Fertilizer', 7000, '2023-09-25', '2023-10-01 09:58:22'),
(10, 'Project 2', NULL, NULL, 'Season 2', 'Weeding', 6000, '2023-09-24', '2023-10-01 10:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE `Registration` (
  `id` int(11) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Roles` varchar(100) NOT NULL,
  `Password` varchar(366) NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration`
--

INSERT INTO `Registration` (`id`, `Fname`, `Lname`, `Email`, `Phone`, `Roles`, `Password`, `DateAdded`) VALUES
(1, 'Bert-updated', 'Martin', 'zyqonawim@mailinator.com', '+1 (474) 571-7048', 'Admin', '$2y$10$mXkN/Tj68wuZJ3tUj8xAROmyfu.LeA0WuHBNx1iqOk9Gj1eJTYc5a', '2023-08-29 20:59:21'),
(2, 'Gwendolyn', 'Massey', 'tida@mailinator.com', '+1 (146) 919-9296', 'Admin', '$2y$10$vUvbW04Zo0wdQbbbFWx7U.MundhUlgRkYmyCHlxIQTnAPM86WVHau', '2023-08-29 21:03:42'),
(4, 'Chancellor', 'Salinas', 'wowajagir@mailinator.com', '+1 (346) 323-2276', 'Admin', '$2y$10$f9TeyXnfI7Kov8RecStYR.4nyRO8Qawg8R5Madgb0OLHpI3ioj5eW', '2023-08-29 21:07:09'),
(5, 'admin', 'admin', 'admin@gmail.com', '0712345678', 'Admin', '$2y$10$SNmNku248Y6/890ZsBWTpuSjzL9u23BtM/RZhYdX/dAy.f50NNc4W', '2023-08-29 23:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `Scope`
--

CREATE TABLE `Scope` (
  `id` int(11) NOT NULL,
  `Project` varchar(255) NOT NULL,
  `Season` varchar(100) NOT NULL,
  `Year` varchar(100) NOT NULL,
  `Dateadded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Scope`
--

INSERT INTO `Scope` (`id`, `Project`, `Season`, `Year`, `Dateadded`) VALUES
(1, 'Project 1', 'Season 1', '2023', '2023-08-30 06:30:47'),
(3, 'Project 1', 'Season 2', '2023', '2023-08-30 06:46:16'),
(4, 'Project 2', 'Season 2', '2023', '2023-08-30 18:59:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cashflow`
--
ALTER TABLE `Cashflow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`User`);

--
-- Indexes for table `Expenditure`
--
ALTER TABLE `Expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Projects`
--
ALTER TABLE `Projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Scope`
--
ALTER TABLE `Scope`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cashflow`
--
ALTER TABLE `Cashflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Expenditure`
--
ALTER TABLE `Expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Projects`
--
ALTER TABLE `Projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Scope`
--
ALTER TABLE `Scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cashflow`
--
ALTER TABLE `Cashflow`
  ADD CONSTRAINT `user` FOREIGN KEY (`User`) REFERENCES `Registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
