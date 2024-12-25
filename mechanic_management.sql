-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 05:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mechanic_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'aditi roy', 'aditi123@gmail.com', 'aditi1234567');

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `level` enum('Expert','Medium','New Recruit','Trainee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `name`, `email`, `mobile_no`, `password`, `picture`, `level`) VALUES
(1, 'Debasish Mandal', 'mandalbabu7586@gmail.com', '7679456201', '$2y$10$BNgptis17eabcSw5GfZjFOqJmDEy2gwaTkITkrTmmy3PyuE0OIPFO', 'unnamed (1).jpg', 'New Recruit'),
(2, 'Aditi Singh Roy', 'aditising@gmail.com', '8927419800', '$2y$10$Qvt6.0LVm.P55nkgw.JCF.ppUmpsOKUC9umlHOivRqks6CjfUCCO.', 'unnamed.jpg', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `tool_name` varchar(100) DEFAULT NULL,
  `tool_category` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tool_issue_register`
--

CREATE TABLE `tool_issue_register` (
  `id` int(11) NOT NULL,
  `mechanic_id` int(11) DEFAULT NULL,
  `tool_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tool_issue_register`
--
ALTER TABLE `tool_issue_register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mechanic_id` (`mechanic_id`),
  ADD KEY `tool_id` (`tool_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tool_issue_register`
--
ALTER TABLE `tool_issue_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tool_issue_register`
--
ALTER TABLE `tool_issue_register`
  ADD CONSTRAINT `tool_issue_register_ibfk_1` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanics` (`id`),
  ADD CONSTRAINT `tool_issue_register_ibfk_2` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
