-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 05:52 PM
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
-- Database: `movers`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `e_attendance_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `Overtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `e_attendance_id`, `date`, `time_in`, `time_out`, `Overtime`) VALUES
(19, 1, '2024-11-08', '18:17:08', '00:00:00', '00:00:00'),
(20, 1, '2024-11-08', '18:17:50', '00:00:00', '00:00:00'),
(21, 1, '2024-11-08', '18:51:20', '00:00:00', '00:00:00'),
(22, 1, '2024-11-08', '18:51:25', '00:00:00', '00:00:00'),
(23, 1, '2024-11-08', '18:51:26', '00:00:00', '00:00:00'),
(24, 1, '2024-11-27', '00:11:37', '00:00:00', '00:00:00'),
(25, 5, '2024-11-27', '00:36:17', '00:00:00', '00:00:00'),
(26, 5, '2024-11-27', '00:36:19', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(1, 'HR'),
(2, 'CORE'),
(3, 'FINANCE');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `birthday` date NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `mobile`, `password`, `department_id`, `address`, `birthday`, `role`) VALUES
(1, 'Patrick Joseph Puzon', 'patrick@gmail.com', '09555555555', '123', 1, '78 Barzalona Street Walayan, Bangkok novaliches City', '2001-10-28', 2),
(2, 'admin', 'admin@gmail.com', '0961616161', 'admin', 0, '16 Street Barangay City', '2024-10-02', 1),
(4, 'alkgfjakgkagagasgasg', 'test@gmail.com', 'asgarsgaf', '123', 1, 'awfsawda', '2024-10-25', 2),
(5, '456', '456@gmail.com', '456', '456', 1, '456', '0006-04-05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_description` text NOT NULL,
  `leave_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `employee_id`, `leave_id`, `leave_from`, `leave_to`, `leave_description`, `leave_status`) VALUES
(1, 1, 6, '2024-10-10', '2024-10-12', 'Vacation', 3),
(5, 1, 14, '2024-03-08', '2024-10-25', 'dwadswa 12 123 123123 123 12 31 23123 123 123 1 51 31 32123 11  23 ', 1),
(7, 1, 14, '2024-10-02', '2024-10-30', 'waDASFAWFA', 2),
(8, 5, 14, '2024-10-05', '2024-10-18', '', 2),
(9, 1, 13, '2024-10-03', '2024-10-26', '123213213123123123231231', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`) VALUES
(1, 'Sick Leave'),
(2, 'Paternity leave'),
(3, 'Sabbatical leave'),
(4, 'Unpaid leave'),
(5, 'Medical leave'),
(6, 'Vacation leave'),
(7, 'Religious leave'),
(8, 'Time off in lieu (toil)'),
(9, 'Maternity leave'),
(10, 'Annual leave'),
(11, 'Military leave'),
(12, 'Study leave'),
(13, 'Casual leave'),
(14, 'Voting leave'),
(15, 'Adoption leave'),
(16, 'Voluntary leave'),
(17, 'Bereavement leave'),
(18, 'Jury duty'),
(19, 'Public holidays'),
(20, 'Compensatory leave'),
(21, 'Holidays'),
(22, 'Marriage leave'),
(23, 'Mandatory leave'),
(24, 'Adverse weather');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
