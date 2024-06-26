-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 11:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `departament`
--

CREATE TABLE `departament` (
  `departament_id` int(11) NOT NULL,
  `departament_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departament`
--

INSERT INTO `departament` (`departament_id`, `departament_name`) VALUES
(1, 'Video Editing'),
(2, 'Publishing'),
(5, 'Management'),
(6, 'Business Development'),
(7, 'Researching'),
(8, 'E-commerce'),
(9, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `Departament_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `Departament_ID`) VALUES
(1, 'CEO', 5),
(2, 'CFO', 5),
(5, 'Screenwriter/ Video researcher', 7),
(6, 'Video Editor', 1),
(9, 'Publisher', 2);

-- --------------------------------------------------------

--
-- Table structure for table `timeoff`
--

CREATE TABLE `timeoff` (
  `timeoff_id` int(11) NOT NULL,
  `annual_leave` double NOT NULL,
  `child_born` double NOT NULL,
  `death_of_family_member` double NOT NULL,
  `moving_day` double NOT NULL,
  `wedding_day` double NOT NULL,
  `sick_leave` double NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeoff`
--

INSERT INTO `timeoff` (`timeoff_id`, `annual_leave`, `child_born`, `death_of_family_member`, `moving_day`, `wedding_day`, `sick_leave`, `User_ID`) VALUES
(3, 1.9, 0, 0, 0, 0, 2, 17),
(5, 20, 3, 3, 1, 3, 20, 12);

-- --------------------------------------------------------

--
-- Table structure for table `timeoffrequests`
--

CREATE TABLE `timeoffrequests` (
  `request_id` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Head_ID` int(11) NOT NULL,
  `leave_type` varchar(500) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `duration` int(11) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `checkedby` int(11) DEFAULT NULL,
  `checkDate` date DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeoffrequests`
--

INSERT INTO `timeoffrequests` (`request_id`, `User_ID`, `Head_ID`, `leave_type`, `from`, `to`, `duration`, `short_description`, `reason`, `status`, `checkedby`, `checkDate`, `created`) VALUES
(8, 17, 21, 'Wedding Day', '2023-12-29', '2023-12-30', 2, '.', '.', 'Submited', 21, '2023-12-27', '2023-12-26'),
(14, 17, 21, 'Child Born', '2024-01-03', '2024-01-12', 9, '.', '.', 'Approved', 21, '2024-01-02', '2024-01-01'),
(15, 17, 21, 'Wedding Day', '2024-01-07', '2024-01-07', 1, '.', '.', 'Declined', 21, '2024-01-04', '2024-01-03'),
(19, 17, 21, 'annual_leave', '2024-01-17', '2024-01-30', 13, 'Leave', '.', 'Approved', 21, '2024-01-14', '2024-01-13'),
(20, 17, 21, 'annual_leave', '2024-01-10', '2024-01-19', 9, 'Leave', '.', 'Approved', 21, '2024-01-09', '2024-01-08'),
(21, 17, 21, 'Wedding Day', '2024-01-13', '2024-01-15', 2, 'Darsma', '.', 'Submited', 21, '2024-01-10', '2024-01-09'),
(22, 17, 21, 'Moving Day', '2024-01-16', '2024-01-17', 1, 'Zhvendosje ', 'Zhvendosje nga vendbanimi aktual', 'Submited', NULL, NULL, '2024-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `Position_ID` int(11) NOT NULL,
  `Departament_ID` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `report_to` int(11) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `born` date DEFAULT NULL,
  `started` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `Position_ID`, `Departament_ID`, `role`, `location`, `status`, `report_to`, `gender`, `born`, `started`) VALUES
(1, 'Mimoza', 'Nuka', 'mimoza@metdaan.com', '$2y$10$3XpTYHVLdCKi8dlwLx191es9TJM7EZQLUPdMBbjnzqAmoPS6xBvdW', 2, 5, 0, 'Main Office', 'Full Time', 1, 'Fmale', NULL, NULL),
(4, 'Gezim', 'Berisha', 'gezim@metdaan.com', '$2y$10$Dpoy8PwyXVdz4p4xsMsoP./8fC9p8jcRx.kEMgdsT9IUpB5vsTTla', 1, 5, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(5, 'Fatlind', 'Rashica', 'fatlind@metdaan.com', '$2y$10$y1yTZpuu4SPiPrfZQnVTsuIwQsWRs7o992j8aU7KpXM/GXFiQDaCW', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(8, 'Arben', 'Berisha', 'arben@metdaan.com', '$2y$10$aX4t7/Rb.8TNYHQO1hCLnu8qA1JKp6RvBuQdid4nMjrbmrC74bH.C', 2, 5, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(9, 'Meriton', 'Feka', 'meriton@metdaan.com', '$2y$10$t4RQUE7iXMbHSSYPj2iEm.bSMICn1us06nZ.DuBHz.YJKcAEvcTWm', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(10, 'Gazmend', 'Berisha', 'gazmend@metdaan.com', '$2y$10$3tEdolNwZUIdoPpZ8xReC.bt.f6dDyQQodDXNgG6Pt3gBvkV837QO', 9, 2, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(11, 'Granit', 'Gashi', 'granit@metdaan.com', '$2y$10$GuSEiN4Nlu6rewrEnpsTj.Xq9nsjklkqQSoFLaAShWdiVTzobmarS', 9, 2, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(12, 'Valmir', 'Leci', 'valmir@metdaan.com', '$2y$10$PlRdBusrrxqTvN1Dw2qjn.iEHeLFg1Qi99i69CuoZCqMGBjhe8fSC', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(15, ' Rinor', 'Berisha', 'rinor@metdaan.com', '$2y$10$PB6FHjvF3PbIsu/Lz9k1huXmA1Go2Dr/thStoa6ht9G0U1dLMWWbm', 1, 5, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(17, 'Albin', 'Smajli', 'albin@metdaan.com', '$2y$10$yIkR0ZKjZPbik1BDXS9/JOsE6C7PT0hJ4nDX0BNDez8X.vpECUUOO', 5, 7, 1, 'Main Office', 'Full Time', 21, 'Male', '2002-11-27', '2023-03-01'),
(19, 'Arian', 'Mehmeti', 'arian@metdaan.com', '$2y$10$25BKuMIaT9R9UTN32iwLzOJPsDacreCFxYDW8Mn6o/icaDxP/Tu0u', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(21, 'Arbenita', 'Krasniqi', 'arbenita@metdaan.com', '$2y$10$yIkR0ZKjZPbik1BDXS9/JOsE6C7PT0hJ4nDX0BNDez8X.vpECUUOO', 1, 5, 0, 'Production', 'Full Time', 8, 'Fmale', NULL, NULL),
(23, 'Besart', 'Maxhuni', 'besart@metdaan.com', '$2y$10$YmZiQFud7dd6IMpmEZ3MKO2peF2EOUcwpIWkvHXBVm78YmKfXL9wK', 1, 1, 0, 'Main Office', 'Full Time', 1, 'Male', '1985-06-19', '2017-05-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`departament_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `Departament_ID` (`Departament_ID`);

--
-- Indexes for table `timeoff`
--
ALTER TABLE `timeoff`
  ADD PRIMARY KEY (`timeoff_id`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `report_to` (`report_to`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departament`
--
ALTER TABLE `departament`
  MODIFY `departament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `timeoff`
--
ALTER TABLE `timeoff`
  MODIFY `timeoff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `Departament_ID` FOREIGN KEY (`Departament_ID`) REFERENCES `departament` (`departament_id`);

--
-- Constraints for table `timeoff`
--
ALTER TABLE `timeoff`
  ADD CONSTRAINT `timeoff_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `report_to` FOREIGN KEY (`report_to`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
