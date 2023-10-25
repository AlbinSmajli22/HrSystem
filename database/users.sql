-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 01:41 AM
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
(1, 'Mimoza', 'Nuka', 'mimoza@metdaan.com', '$2y$10$3XpTYHVLdCKi8dlwLx191es9TJM7EZQLUPdMBbjnzqAmoPS6xBvdW', 2, 5, 1, 'Main Office', 'Full Time', 1, 'Fmale', NULL, NULL),
(4, 'Gezim', 'Berisha', 'gezim@metdaan.com', '$2y$10$Dpoy8PwyXVdz4p4xsMsoP./8fC9p8jcRx.kEMgdsT9IUpB5vsTTla', 1, 5, 1, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(8, 'Arben', 'Berisha', 'arben@metdaan.com', '$2y$10$aX4t7/Rb.8TNYHQO1hCLnu8qA1JKp6RvBuQdid4nMjrbmrC74bH.C', 2, 5, 1, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(9, 'Meriton', 'Feka', 'meriton@metdaan.com', '$2y$10$t4RQUE7iXMbHSSYPj2iEm.bSMICn1us06nZ.DuBHz.YJKcAEvcTWm', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(10, 'Gazmend', 'Berisha', 'gazmend@metdaan.com', '$2y$10$3tEdolNwZUIdoPpZ8xReC.bt.f6dDyQQodDXNgG6Pt3gBvkV837QO', 9, 2, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(11, 'Granit', 'Gashi', 'granit@metdaan.com', '$2y$10$GuSEiN4Nlu6rewrEnpsTj.Xq9nsjklkqQSoFLaAShWdiVTzobmarS', 9, 2, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(12, 'Valmir', 'Leci', 'valmir@metdaan.com', '$2y$10$PlRdBusrrxqTvN1Dw2qjn.iEHeLFg1Qi99i69CuoZCqMGBjhe8fSC', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(15, ' Rinor', 'Berisha', 'rinor@metdaan.com', '$2y$10$PB6FHjvF3PbIsu/Lz9k1huXmA1Go2Dr/thStoa6ht9G0U1dLMWWbm', 1, 5, 1, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(17, 'Albin', 'Smajli', 'albin@metdaan.com', '$2y$10$yIkR0ZKjZPbik1BDXS9/JOsE6C7PT0hJ4nDX0BNDez8X.vpECUUOO', 5, 7, 1, 'Main Office', 'Full Time', 21, 'Male', '2002-11-27', '2023-03-01'),
(19, 'Arian', 'Mehmeti', 'arian@metdaan.com', '$2y$10$25BKuMIaT9R9UTN32iwLzOJPsDacreCFxYDW8Mn6o/icaDxP/Tu0u', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL),
(21, 'Arbenita', 'Krasniqi', 'arbenita@metdaan.com', '$2y$10$yIkR0ZKjZPbik1BDXS9/JOsE6C7PT0hJ4nDX0BNDez8X.vpECUUOO', 1, 5, 0, 'Production', 'Full Time', 8, 'Fmale', NULL, NULL),
(23, 'Erza', 'Jonuzi', 'erza@metdaan.com', '$2y$10$jPQjU4xRRhDiLXV1TuSbWu46Mch.fmUIDuduA25zMxIiqkjWnGfkq', 6, 1, 0, 'Main Office', 'Full Time', 9, 'Fmale', '2002-06-18', '2023-11-01'),
(24, 'Fatlind', 'Rashica', 'fatlind@metdaan.com', '$2y$10$Q19iIwS5Qq/om8CL/JZ7xO8orlhI21qpHtDbhZ9P2k5hlzZABmnW6', 6, 1, 0, 'Main Office', 'Full Time', 9, 'Male', '2003-09-24', '2023-02-01');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `report_to` FOREIGN KEY (`report_to`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
