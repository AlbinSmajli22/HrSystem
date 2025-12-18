-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 02:55 PM
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
-- Table structure for table `absencestatuses`
--

CREATE TABLE `absencestatuses` (
  `absencestatus_id` int(11) NOT NULL,
  `absencestatus_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absencestatuses`
--

INSERT INTO `absencestatuses` (`absencestatus_id`, `absencestatus_name`, `company_id`) VALUES
(1, 'Approved', 1),
(2, 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `owner` tinyint(1) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`, `name`, `surname`, `email`, `password`, `owner`, `company_id`) VALUES
(1, 17, 'Albin', 'Smajli', 'albin@metdaan.com', '$2y$10$bV9bJI.VRbsO98/wnSGvkOiTk3XCqFBN1PEwzqBvTI0Bb.ubZa49C', 1, 1),
(2, 1, 'Mimoza', 'Nuka', 'mimoza@metdaan.com', '$2y$10$bV9bJI.VRbsO98/wnSGvkOiTk3XCqFBN1PEwzqBvTI0Bb.ubZa49C', 0, 1),
(4, 26, 'Elmedin', 'Smajli', 'elmedin@metdaan.com', '$2y$10$VXKGv7kvu/NN3bNENmBk8OcAxVlss1TyYYordncP.Ey2GAsczszFS', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adress`
--

CREATE TABLE `adress` (
  `adress_id` int(11) NOT NULL,
  `address_type` varchar(200) DEFAULT NULL,
  `address_line_1` varchar(200) DEFAULT NULL,
  `address_line_2` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`adress_id`, `address_type`, `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `country`, `user_id`) VALUES
(2, 'Work', 'Maxhunaj, Rr. Haxhi Nazifi Nr.20', 'Maxhunaj, Rr. Paqja Nr.30', 'Vushtrri', '02', 42000, 'Kosovo', 17),
(5, 'Visiting', 'Rr. Tringë Smajli Nr.55', '', 'Prishtina', '01', 51000, 'Kosovo', 17);

-- --------------------------------------------------------

--
-- Table structure for table `amountoftimeoff`
--

CREATE TABLE `amountoftimeoff` (
  `id` int(11) NOT NULL,
  `allowance` double NOT NULL,
  `balance` double NOT NULL,
  `planned` double NOT NULL,
  `available` double DEFAULT NULL,
  `time_off_type` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amountoftimeoff`
--

INSERT INTO `amountoftimeoff` (`id`, `allowance`, `balance`, `planned`, `available`, `time_off_type`, `user_id`) VALUES
(1, 20, 12.5, 0, 10, 1, 17),
(2, 20, 5, 0, 5, 2, 17),
(3, 5, 5, 0, 5, 3, 17),
(5, 5, 5, 0, 5, 5, 17),
(6, 3, 0, 0, 3, 6, 17),
(7, 1, 0, 0, 0, 4, 17),
(8, 20, 20, 0, 20, 1, 12),
(9, 20, 20, 0, 20, 2, 12),
(10, 20, 20, 0, 20, 3, 12),
(11, 20, 20, 0, 20, 4, 12),
(12, 7.5, 7.5, 0, 7.5, 5, 12),
(13, 11, 11, 0, 11, 6, 12),
(14, 7.5, 20, 0, 7.5, 7, 43),
(15, 11, 11, 0, 11, 8, 43),
(16, 0, 0, 0, NULL, 1, 1),
(17, 0, 0, 0, NULL, 2, 1),
(18, 0, 0, 0, NULL, 3, 1),
(19, 0, 0, 0, NULL, 4, 1),
(20, 0, 0, 0, NULL, 5, 1),
(21, 0, 0, 0, NULL, 6, 1),
(22, 0, 0, 0, 0, 1, 4),
(23, 0, 0, 0, 0, 2, 4),
(24, 0, 0, 0, 0, 3, 4),
(25, 0, 0, 0, 0, 4, 4),
(26, 0, 0, 0, 0, 5, 4),
(27, 0, 0, 0, 0, 6, 4),
(28, 0, 5, 0, 0, 1, 5),
(29, 0, 10, 0, 0, 2, 5),
(30, 0, 5, 0, 0, 3, 5),
(31, 0, 2, 0, 0, 4, 5),
(32, 0, 3, 0, 0, 5, 5),
(33, 0, 4, 0, 0, 6, 5),
(34, 0, 0, 0, 0, 1, 8),
(35, 0, 0, 0, 0, 2, 8),
(36, 0, 0, 0, 0, 3, 8),
(37, 0, 0, 0, 0, 4, 8),
(38, 0, 0, 0, 0, 5, 8),
(39, 0, 0, 0, 0, 6, 8),
(40, 0, 0, 0, 0, 1, 9),
(41, 0, 0, 0, 0, 2, 9),
(42, 0, 0, 0, 0, 3, 9),
(43, 0, 0, 0, 0, 4, 9),
(44, 0, 0, 0, 0, 5, 9),
(45, 0, 0, 0, 0, 6, 9),
(46, 0, 0, 0, 20, 1, 10),
(47, 0, 0, 0, 0, 2, 10),
(48, 0, 0, 0, 0, 3, 10),
(49, 0, 0, 0, 0, 4, 10),
(50, 0, 0, 0, 0, 5, 10),
(51, 0, 0, 0, 0, 6, 10),
(52, 0, 0, 0, NULL, 1, 15),
(53, 0, 0, 0, NULL, 2, 15),
(54, 0, 0, 0, NULL, 3, 15),
(55, 0, 0, 0, NULL, 4, 15),
(56, 0, 0, 0, NULL, 5, 15),
(57, 0, 0, 0, NULL, 6, 15),
(58, 0, 0, 0, 0, 1, 19),
(59, 0, 0, 0, 0, 2, 19),
(60, 0, 0, 0, 0, 3, 19),
(61, 0, 0, 0, 0, 4, 19),
(62, 0, 0, 0, 0, 5, 19),
(63, 0, 0, 0, 0, 6, 19),
(64, 0, 20, 0, 0, 1, 21),
(65, 0, 20, 0, 0, 2, 21),
(66, 0, 0, 0, 0, 3, 21),
(67, 0, 0, 0, 0, 4, 21),
(68, 0, 0, 0, 0, 5, 21),
(69, 0, 0, 0, 0, 6, 21),
(70, 0, 0, 0, 0, 1, 26),
(71, 0, 0, 0, 0, 2, 26),
(72, 0, 0, 0, 0, 3, 26),
(73, 0, 0, 0, 0, 4, 26),
(74, 0, 0, 0, 0, 5, 26),
(75, 0, 0, 0, 0, 6, 26),
(76, 0, 0, 0, 0, 1, 46),
(77, 0, 0, 0, 0, 2, 46),
(78, 0, 0, 0, 0, 3, 46),
(79, 0, 0, 0, 0, 4, 46),
(80, 0, 0, 0, 0, 5, 46),
(81, 0, 0, 0, 0, 6, 46);

-- --------------------------------------------------------

--
-- Table structure for table `assettypes`
--

CREATE TABLE `assettypes` (
  `assettype_id` int(11) NOT NULL,
  `assettype_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assettypes`
--

INSERT INTO `assettypes` (`assettype_id`, `assettype_name`, `company_id`) VALUES
(1, 'Computer', 1),
(3, 'Phone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `emp_num` smallint(11) NOT NULL,
  `subscribed_until` date DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `emp_num`, `subscribed_until`, `timezone`, `country`, `image`) VALUES
(1, 'MetDaan', 100, '2025-08-31', 'Europe/Dublin', 'Ireland', ''),
(2, 'StarLabs', 50, NULL, NULL, NULL, NULL),
(28, 'EliTech', 55, NULL, NULL, NULL, NULL),
(29, 'Galaxy', 44, NULL, NULL, NULL, NULL),
(35, 'StarTech', 55, NULL, NULL, NULL, NULL),
(42, 'SLmedia', 23, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companygoals`
--

CREATE TABLE `companygoals` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `due_date` date NOT NULL,
  `created` date NOT NULL,
  `target_value` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `users` varchar(500) NOT NULL,
  `user_goal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companygoals`
--

INSERT INTO `companygoals` (`id`, `name`, `description`, `type`, `due_date`, `created`, `target_value`, `company_id`, `users`, `user_goal`) VALUES
(1, 'Multiple id-s', 'Make it able to insert multiple id in a single row cell ', 'Objective', '2025-03-30', '2025-01-14', NULL, 1, '[\"17\",\"12\",\"22\"] ', NULL),
(2, 'Finish Goals CRUD', 'Finish goal selection and user selection and after this fix adding those data into database. ', 'Objective', '2025-03-27', '2025-03-11', NULL, 1, '[\"17\",\"21\"]', NULL),
(3, 'Flexible sidebar', 'Make the sidebar flexible like when user shrink the page side bar names should be gone and only the icons will remine ', 'Number', '2025-04-01', '2025-03-11', '100', 1, '[\"12\"]', NULL),
(4, 'Goal 1', 'taskkkkkkk', 'Number', '2025-01-08', '2025-03-16', '200', 1, '[\"17\",\"21\",\"5\",\"15\"]', NULL),
(7, 'Goal 2', 'goal item details', 'Percentage', '2025-05-22', '2025-03-16', '100', 1, '[\"17\",\"9\",\"12\",\"15\"]', NULL),
(8, 'test item ', 'comments 2342344', 'Currency', '2025-05-22', '2025-05-02', '300', 1, '[\"5\",\"15\",\"1\"]', NULL),
(9, 'Site editing times', 'How many times you edited this site', 'Counter', '2025-05-30', '2025-05-04', '50', 1, '[\"12\"]', NULL),
(10, 'Reels for Instagram', 'finish editing 10 reels', 'Objective', '2025-05-19', '2025-05-17', '', 1, '\"12\"', 1),
(11, 'Albin\'s team goal', 'start working at the front of the pin board crud', 'Objective', '2025-05-21', '2025-05-20', '0', 1, '[\"5\",\"12\",\"26\",\"9\"]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companygoalsvalue`
--

CREATE TABLE `companygoalsvalue` (
  `value_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `company_goal` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `comment` varchar(800) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `edited` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companygoalsvalue`
--

INSERT INTO `companygoalsvalue` (`value_id`, `user`, `company_goal`, `value`, `completed`, `comment`, `done`, `edited`) VALUES
(2, 17, 1, NULL, 1, 'Done!', 1, '2025-05-05 00:00:00'),
(4, 9, 7, 100, NULL, 'Done!', 1, '2025-05-13 00:00:00'),
(5, 17, 7, 70, NULL, 'DOne', NULL, '2025-04-29 00:00:00'),
(7, 15, 7, 50, NULL, 'DOne', NULL, '2025-05-02 00:00:00'),
(8, 21, 2, NULL, NULL, 'Almost perfect !!!', 1, '2025-04-14 00:00:00'),
(45, 12, 3, 100, NULL, '', 1, '2025-05-16 01:09:44'),
(46, 12, 1, NULL, 1, '', 1, '2025-05-14 15:58:18'),
(47, 12, 7, 100, NULL, '', 1, '2025-05-16 01:09:28'),
(48, 12, 9, 50, NULL, '', 1, '2025-05-20 04:40:00'),
(49, 5, 8, 150, NULL, '', NULL, '2025-05-01 00:00:00'),
(100, 5, 4, 200, NULL, '', NULL, '2025-05-14 14:23:24'),
(102, 12, 10, NULL, 1, 'done', 1, '2025-05-22 02:31:04'),
(103, 5, 11, NULL, NULL, NULL, NULL, '2025-05-20 05:53:01'),
(104, 12, 11, NULL, NULL, NULL, NULL, '2025-05-20 05:53:01'),
(105, 26, 11, NULL, NULL, NULL, NULL, '2025-05-20 05:53:01'),
(106, 9, 11, NULL, NULL, NULL, NULL, '2025-05-20 06:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_type` varchar(200) NOT NULL,
  `details` varchar(100) NOT NULL,
  `primary_contact` tinyint(1) DEFAULT 0,
  `public` tinyint(1) DEFAULT 0,
  `emergency` tinyint(1) DEFAULT 0,
  `extra_info` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_type`, `details`, `primary_contact`, `public`, `emergency`, `extra_info`, `user_id`) VALUES
(1, 'Email', 'mimoza@metdaan.com', 1, 1, 0, '', 1),
(2, 'Email', 'gezim@metdaan.com', 1, 1, 0, '', 4),
(3, 'Email', 'fatlind@metdaan.com', 1, 1, 0, '', 5),
(4, 'Email', 'arben@metdaan.com', 1, 1, 0, '', 8),
(5, 'Email', 'meriton@metdaan.com', 1, 1, 0, '', 9),
(6, 'Email', 'gazmend@metdaan.com', 1, 1, 0, '', 10),
(8, 'Email', 'valmir@metdaan.com', 1, 1, 0, '', 12),
(9, 'Email', 'rinor@metdaan.com', 1, 1, 0, '', 15),
(10, 'Email', 'albin@metdaan.com', 1, 1, 0, '', 17),
(11, 'Email', 'arian@metdaan.com', 1, 1, 0, '', 19),
(12, 'Email', 'arbenita@metdaan.com', 1, 1, 0, '', 21),
(13, 'Email', 'elmedin@metdaan.com', 1, 1, 0, '', 26);

-- --------------------------------------------------------

--
-- Table structure for table `contacttypes`
--

CREATE TABLE `contacttypes` (
  `contacttype_id` int(11) NOT NULL,
  `contacttype_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departament`
--

CREATE TABLE `departament` (
  `departament_id` int(11) NOT NULL,
  `departament_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departament`
--

INSERT INTO `departament` (`departament_id`, `departament_name`, `company_id`) VALUES
(1, 'Video Editing', 1),
(2, 'Publishing', 1),
(5, 'Management', 1),
(6, 'Business Development', 1),
(7, 'Researching', 1),
(8, 'E-commerce', 1),
(9, 'Finance', 1),
(12, 'BackEnd', 2),
(16, 'Human Resources', 28),
(17, 'Human Resources', 29),
(23, 'Human Resources', 35),
(28, 'Human Resources', 42),
(29, 'IT', 1),
(30, 'Studio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employmentstatuses`
--

CREATE TABLE `employmentstatuses` (
  `employmentstatus_id` int(11) NOT NULL,
  `employmentstatus_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employmentstatuses`
--

INSERT INTO `employmentstatuses` (`employmentstatus_id`, `employmentstatus_name`, `company_id`) VALUES
(1, 'Full Time', 1),
(3, 'Part Time', 1),
(4, 'Contract', 1),
(5, 'Unpaid', 1),
(6, 'Casual', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenseapprovers`
--

CREATE TABLE `expenseapprovers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenseapprovers`
--

INSERT INTO `expenseapprovers` (`id`, `user_id`, `company_id`) VALUES
(1, 17, 1),
(2, 1, 1),
(3, 46, 42),
(4, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `send_to` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `claim_date` date NOT NULL,
  `currency` varchar(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `receipts` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `approved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `send_to`, `user_id`, `claim_date`, `currency`, `description`, `comments`, `category`, `details`, `amount`, `tax`, `receipts`, `status`, `created`, `approved`) VALUES
(9, 17, 12, '2024-12-02', '€', 'Udhetim Jasht Vendit', 'Bilet ekstra ', 'Traveling', 'Details', 3000, 3100, 'c54a6adf-004f-4613-ab41-b0a236730a9e.jpg', 'Approved', '2024-12-04', '2024-12-11'),
(10, 17, 12, '2024-12-11', 'L', 'description', 'Expense Comments', 'Electricity', 'https://www.linkedin.com/in/fatlind-rashica-4a42912a1/', 50, 70, 'bluza.PNG', 'Declined', '2024-12-11', '2024-12-11'),
(11, 17, 12, '2025-05-22', '€', 'description', 'Comments', 'Electricity', 'Details', 50, 52, 'cs2 craft.PNG', 'Submited', '2025-05-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expensescategory`
--

CREATE TABLE `expensescategory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expensescategory`
--

INSERT INTO `expensescategory` (`id`, `name`, `company_id`) VALUES
(1, 'Fule/Gas', 1),
(3, 'Traveling', 1),
(4, 'Electricity', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goalitems`
--

CREATE TABLE `goalitems` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `details` varchar(500) NOT NULL,
  `type` varchar(200) NOT NULL,
  `due_deadline` date NOT NULL,
  `target` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` date DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goalitems`
--

INSERT INTO `goalitems` (`id`, `name`, `details`, `type`, `due_deadline`, `target`, `created`, `updated`, `company_id`, `status`) VALUES
(1, 'Goal 1', 'taskkkkkkk', 'Number', '2025-01-08', 200, '2024-12-25', '0000-00-00', 1, NULL),
(2, 'Goal 2', 'goal item details', 'Number', '2025-01-11', 100, '2024-12-30', '0000-00-00', 1, NULL),
(3, 'test item ', 'comments 2342344', 'currency', '2025-05-22', 300, '2025-05-02', NULL, 1, NULL),
(4, 'Site editing times', 'How many times you edited this site', 'counter', '2025-05-30', 50, '2025-05-04', NULL, 1, NULL),
(5, 'Albin\'s team goal', 'start working at the front of the pin board crud', 'Objective', '2025-05-21', 0, '2025-05-20', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `timezone` varchar(500) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `country`, `timezone`, `company_id`) VALUES
(1, 'Main Office', 'Republic of Kosovo', 'Europe/Belgrade', 1),
(2, 'Production', 'Republic of Kosovo', 'Europe/Belgrade', 1),
(4, 'Sydney Office', 'Australia', 'Australia/Sydney', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `publish_on` date NOT NULL,
  `until` date DEFAULT NULL,
  `author` varchar(200) NOT NULL,
  `created` date NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `title`, `category`, `summary`, `content`, `publish_on`, `until`, `author`, `created`, `company_id`) VALUES
(10, 'titele test', 'Breaking', 'test', 'Content news Content news Content news Content news Content news Content news Content news Content news', '2025-11-01', '2025-11-05', 'Albin Smajli', '2025-11-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newscategories`
--

CREATE TABLE `newscategories` (
  `newscategory_id` int(11) NOT NULL,
  `newscategory_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newscategories`
--

INSERT INTO `newscategories` (`newscategory_id`, `newscategory_name`, `company_id`) VALUES
(1, 'Breaking', 1),
(2, 'Important', 1),
(3, 'General', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paylevels`
--

CREATE TABLE `paylevels` (
  `paylevel_id` int(11) NOT NULL,
  `paylevel_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paylevels`
--

INSERT INTO `paylevels` (`paylevel_id`, `paylevel_name`, `company_id`) VALUES
(1, 'Junior', 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `company_id`) VALUES
(1, 'CEO', 1),
(2, 'CFO', 1),
(5, 'Screenwriter/ Video researcher', 1),
(6, 'Video Editor', 1),
(9, 'Publisher', 1),
(13, 'Python dev', 2),
(14, 'Human Resource Manager', 28),
(17, 'Human Resource Manager', 35),
(22, 'Human Resource Manager', 42),
(23, 'Human Resource Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `company_id`) VALUES
(1, 'Intern', 1),
(2, 'Trainee', 1),
(3, 'Volunteer', 1),
(4, 'Project Alpha', 1);

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
  `duration` double NOT NULL,
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
(8, 10, 21, 'Wedding Day', '2023-12-29', '2023-12-30', 2, '.', '.', 'Approved', 17, '2024-08-05', '2023-12-26'),
(14, 10, 21, 'Child Born', '2024-01-03', '2024-01-12', 9, '.', '.', 'Approved', 21, '2024-01-02', '2024-01-01'),
(15, 10, 21, 'Wedding Day', '2024-01-07', '2024-01-07', 1, '.', '.', 'Approved', 17, '2024-04-08', '2024-01-03'),
(19, 17, 21, 'annual_leave', '2024-01-17', '2024-01-30', 13, 'Leave', '.', 'Approved', 17, '2024-04-06', '2024-01-13'),
(20, 5, 17, 'annual_leave', '2024-01-10', '2024-01-19', 9, 'Leave', '.', 'Approved', 17, '2024-04-06', '2024-01-08'),
(21, 17, 21, 'Wedding Day', '2024-01-13', '2024-01-15', 2, 'Darsma', '.', 'Approved', 17, '2024-04-06', '2024-01-09'),
(22, 15, 21, 'Moving Day', '2024-01-16', '2024-01-17', 1, 'Zhvendosje ', 'Zhvendosje nga vendbanimi aktual', 'Approved', 17, '2024-04-06', '2023-01-14'),
(37, 15, 21, 'Annual Leave', '2024-04-02', '2024-04-03', 1, 'adasa', 'asdsadsa', 'Approved', 17, '2024-04-06', '2024-04-01'),
(38, 17, 21, 'Annual Leave', '2024-04-02', '2024-04-03', 1, 'test', 'test', 'Approved', 17, '2024-04-06', '2024-04-01'),
(39, 5, 17, 'Annual Leave', '2024-04-01', '2024-04-03', 2, 'sdasd', 'asdasda', 'Approved', 17, '2024-04-14', '2024-04-01'),
(57, 15, 21, 'Death of Family Member', '2024-04-06', '2024-04-09', 3, 'sda', 'asdsa', 'Approved', 17, '2024-04-06', '2024-04-06'),
(58, 17, 21, 'Child Born', '2024-04-06', '2024-04-09', 3, 'child', 'child', 'Approved', 17, '2024-04-06', '2024-04-06'),
(59, 17, 21, 'Sick Leave', '2024-04-06', '2024-04-25', 19, 'sick', 'sick', 'Approved', 17, '2024-04-06', '2024-04-06'),
(60, 17, 21, 'Moving Day', '2024-04-06', '2024-04-08', 2, 'as', 'as', 'Approved', 17, '2024-04-06', '2024-04-06'),
(61, 17, 21, 'Child Born', '2024-04-06', '2024-04-08', 2, 'child', 'child', 'Declined', 17, '2024-04-06', '2024-04-06'),
(62, 17, 21, 'Annual Leave', '2024-04-06', '2024-04-07', 1, 'asd', 'asd', 'Approved', 17, '2024-04-06', '2024-04-06'),
(63, 15, 21, 'Sick Leave', '2024-04-06', '2024-04-20', 14, 'as', 'as', 'Declined', 17, '2024-04-06', '2024-04-06'),
(64, 17, 21, 'Sick Leave', '2024-04-06', '2024-04-16', 10, 'as', 'as', 'Declined', 17, '2024-04-06', '2024-04-06'),
(65, 15, 21, 'Annual Leave', '2024-04-06', '2024-04-07', 1, 'as', 'as', 'Approved', 17, '2024-04-14', '2024-04-06'),
(66, 15, 21, 'Child Born', '2024-04-06', '2024-04-09', 3, 's', 's', 'Approved', 17, '2024-04-06', '2024-04-06'),
(72, 17, 21, 'Annual Leave', '2024-04-10', '2024-04-12', 2, 'as', 'as', 'Approved', 17, '2024-04-08', '2024-04-08'),
(73, 17, 21, 'Annual Leave', '2024-04-09', '2024-04-12', 3, 'pushim', 'Pushime jasht vendit', 'Approved', 17, '2024-04-09', '2024-04-09'),
(74, 17, 21, 'Annual Leave', '2024-04-24', '2024-04-27', 3, 'as', 'as', 'Approved', 17, '2024-04-09', '2024-04-09'),
(75, 17, 21, 'Annual Leave', '2024-04-25', '2024-04-29', 4, 'as', 'as', 'Approved', 17, '2024-04-09', '2024-04-09'),
(76, 10, 21, 'Annual Leave', '2024-05-13', '2024-05-16', 3, 'q', 'q', 'Approved', 17, '2024-08-05', '2024-05-13'),
(77, 17, 21, 'Annual Leave', '2024-09-21', '2024-09-22', 1, 'm ka lind djal', 'lindje', 'Approved', 17, '2024-09-20', '2024-09-20'),
(78, 17, 21, 'Wedding Day', '2024-10-23', '2024-10-26', 3, 'asdasd', 'asdas', 'Declined', 17, '2024-10-23', '2024-10-23'),
(82, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(83, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(84, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(85, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(86, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(87, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(88, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(89, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(90, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(91, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-25', 3, 'fsddsfsd', 'sadasd', 'Declined', 17, '2024-10-23', '2024-10-23'),
(92, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-23', 1, 'half day', ' half day', 'Declined', 17, '2024-10-23', '2024-10-23'),
(93, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-23', 1, 'half day', ' half day', 'Approved', 17, '2024-10-24', '2024-10-23'),
(94, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-23', 1, 'sdasd', 'asdasd', 'Approved', 17, '2024-10-24', '2024-10-23'),
(95, 17, 21, 'Annual Leave', '2024-10-23', '2024-10-23', 1, 'half day', 'half day', 'Approved', 17, '2024-10-24', '2024-10-23'),
(96, 17, 21, 'Annual Leave', '2024-10-24', '2024-10-25', 2, 'sdasd', 'asdas', 'Submited', NULL, NULL, '2024-10-24'),
(97, 12, 17, 'Annual Leave', '2024-11-05', '2024-11-15', 11, '.', '.', 'Declined', 17, '2025-01-14', '2024-11-05'),
(98, 12, 19, 'Sick Leave', '2024-11-06', '2024-11-08', 3, 'sick', 'sick', 'Declined', 17, '2025-01-14', '2024-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `timeofftype`
--

CREATE TABLE `timeofftype` (
  `id` int(11) NOT NULL,
  `time_off` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeofftype`
--

INSERT INTO `timeofftype` (`id`, `time_off`, `company_id`) VALUES
(1, 'Annual Leave', 1),
(2, 'Sick Leave', 1),
(3, 'Wedding Day', 1),
(4, 'Moving Day', 1),
(5, 'Child Born', 1),
(6, 'Death Of Family Member', 1),
(7, 'Annual Leave', 42),
(8, 'Sick Leave', 42),
(11, 'Work From Home', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `Position_ID` int(11) DEFAULT NULL,
  `Departament_ID` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `report_to` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `born` date DEFAULT NULL,
  `started` date DEFAULT NULL,
  `company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `image`, `name`, `surname`, `email`, `password`, `Position_ID`, `Departament_ID`, `role`, `location`, `status`, `report_to`, `gender`, `born`, `started`, `company`) VALUES
(1, NULL, 'Mimoza', 'Nuka', 'mimoza@metdaan.com', '$2y$10$biyuRS2zYJqR6AQhljHKm.leMoUZvs6DkCwkWbj9Xl7sq2vn8iCJW', 9, 1, 0, 'Main Office', 'Full Time', 1, 'Fmale', NULL, NULL, 1),
(4, NULL, 'Gezim', 'Berisha', 'gezim@metdaan.com', '$2y$10$Dpoy8PwyXVdz4p4xsMsoP./8fC9p8jcRx.kEMgdsT9IUpB5vsTTla', 1, 5, 0, 'Main Office', 'Full Time', 1, 'Male', '1985-12-20', NULL, 1),
(5, NULL, 'Fatlind', 'Rashica', 'fatlind@metdaan.com', '$2y$10$PlRdBusrrxqTvN1Dw2qjn.iEHeLFg1Qi99i69CuoZCqMGBjhe8fSC', 6, 1, 0, 'Main Office', 'Full Time', 17, 'Male', NULL, NULL, 1),
(8, NULL, 'Arben', 'Berisha', 'arben@metdaan.com', '$2y$10$aX4t7/Rb.8TNYHQO1hCLnu8qA1JKp6RvBuQdid4nMjrbmrC74bH.C', 2, 5, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL, 1),
(9, NULL, 'Meriton', 'Feka', 'meriton@metdaan.com', '$2y$10$t4RQUE7iXMbHSSYPj2iEm.bSMICn1us06nZ.DuBHz.YJKcAEvcTWm', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL, 1),
(10, NULL, 'Gazmend', 'Berisha', 'gazmend@metdaan.com', '$2y$10$3tEdolNwZUIdoPpZ8xReC.bt.f6dDyQQodDXNgG6Pt3gBvkV837QO', 9, 2, 0, 'Main Office', 'Full Time', 1, 'Male', '1984-12-18', NULL, 1),
(12, 'bluza2.PNG', 'Valmir', 'Leci', 'valmir@metdaan.com', '$2y$10$PlRdBusrrxqTvN1Dw2qjn.iEHeLFg1Qi99i69CuoZCqMGBjhe8fSC', 6, 1, 0, 'Main Office', 'Full Time', 17, 'Male', '1988-12-21', '2021-10-12', 1),
(15, NULL, 'Rinor', 'Berisha', 'rinor@metdaan.com', '$2y$10$PB6FHjvF3PbIsu/Lz9k1huXmA1Go2Dr/thStoa6ht9G0U1dLMWWbm', 1, 5, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL, 1),
(17, 'profil.jpg', 'Albin', 'Smajli', 'albin@metdaan.com', '$2y$10$bV9bJI.VRbsO98/wnSGvkOiTk3XCqFBN1PEwzqBvTI0Bb.ubZa49C', 5, 7, 1, 'Main Office', 'Full Time', 21, 'Male', '2002-11-27', '2023-03-01', 1),
(19, NULL, 'Arian', 'Mehmeti', 'arian@metdaan.com', '$2y$10$25BKuMIaT9R9UTN32iwLzOJPsDacreCFxYDW8Mn6o/icaDxP/Tu0u', 6, 1, 0, 'Main Office', 'Full Time', 1, 'Male', NULL, NULL, 1),
(21, NULL, 'Arbenita', 'Krasniqi', 'arbenita@metdaan.com', '$2y$10$yIkR0ZKjZPbik1BDXS9/JOsE6C7PT0hJ4nDX0BNDez8X.vpECUUOO', 1, 5, 0, 'Production', 'Full Time', 8, 'Fmale', NULL, NULL, 1),
(26, NULL, 'Elmedin', 'Smajli', 'elmedin@metdaan.com', '$2y$10$VXKGv7kvu/NN3bNENmBk8OcAxVlss1TyYYordncP.Ey2GAsczszFS', 6, 1, 0, 'Main Office', 'Full Time', 19, 'Fmale', '2008-09-29', '2024-05-15', 1),
(28, NULL, 'Endrit', 'Saiti', 'endrit@starlabs.com', '$2y$10$bV9bJI.VRbsO98/wnSGvkOiTk3XCqFBN1PEwzqBvTI0Bb.ubZa49C', 13, 12, 1, 'Main Office', 'Full Time', 28, NULL, NULL, NULL, 2),
(30, 'pngwing.com (4).png', 'Elmedin', 'Smajli', 'elmedin@gmail.com', '$2y$10$uI023PpTNVQiFD2I8zX5me1UKFBaolks0.TIl3D55LK.alrAltdS2', 14, 16, 1, NULL, NULL, 30, NULL, NULL, '2024-10-14', 28),
(31, NULL, 'Fisnik', 'Maloku', 'albinibini@outlook.com', '$2y$10$hCbhoACVb8qJNTLa5.KRmuUZVlkHv1XVlmmZiRWs0yQnHRbDryn1S', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2024-10-14', 29),
(38, NULL, 'Albin', 'Smajli', 'albin22@hotmail.com', '$2y$10$mHbo7BlkmFkefEee0ymEQOM3iDXhcm0b2jnOaH9TCUkmCNJSrO7o2', 17, 23, 1, NULL, NULL, NULL, NULL, NULL, '2024-10-17', 35),
(43, NULL, 'Shpend', 'Halimi', 'Shpend@SLmedia.com', '$2y$10$VQW1GCA/saWAuscBOKQo6eKUCqHloFyftZk2emFY/iVQhLhEUcug6', 22, 28, 1, NULL, NULL, 43, NULL, NULL, '2024-10-20', 42),
(46, NULL, 'Granit', 'Gashi', 'granit@metdaan.com', '$2y$10$wI6S3wp7zduDG0ALqCN8Iu8lDhkUBGhuaBDJ/QJfjFZRCypAc1mFO', 9, 2, 0, 'Main Office', 'Full Time', 10, 'Male', '1995-11-25', '2014-05-12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absencestatuses`
--
ALTER TABLE `absencestatuses`
  ADD PRIMARY KEY (`absencestatus_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id_user_id` (`user_id`);

--
-- Indexes for table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`adress_id`);

--
-- Indexes for table `amountoftimeoff`
--
ALTER TABLE `amountoftimeoff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_off_type` (`time_off_type`),
  ADD KEY `user_relation` (`user_id`);

--
-- Indexes for table `assettypes`
--
ALTER TABLE `assettypes`
  ADD PRIMARY KEY (`assettype_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `companygoals`
--
ALTER TABLE `companygoals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companygoal-company` (`company_id`);

--
-- Indexes for table `companygoalsvalue`
--
ALTER TABLE `companygoalsvalue`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `companygoal-value` (`company_goal`),
  ADD KEY `value-user` (`user`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contact` (`user_id`);

--
-- Indexes for table `contacttypes`
--
ALTER TABLE `contacttypes`
  ADD PRIMARY KEY (`contacttype_id`);

--
-- Indexes for table `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`departament_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employmentstatuses`
--
ALTER TABLE `employmentstatuses`
  ADD PRIMARY KEY (`employmentstatus_id`);

--
-- Indexes for table `expenseapprovers`
--
ALTER TABLE `expenseapprovers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenseApprove` (`user_id`),
  ADD KEY `expenseApproveCompany` (`company_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Expenses_user` (`user_id`),
  ADD KEY `Expenses_staff` (`send_to`);

--
-- Indexes for table `expensescategory`
--
ALTER TABLE `expensescategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Company_exceptions` (`company_id`);

--
-- Indexes for table `goalitems`
--
ALTER TABLE `goalitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goal_item_company` (`company_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`),
  ADD KEY `Company_News` (`company_id`),
  ADD KEY `User_News` (`author`);

--
-- Indexes for table `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`newscategory_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`),
  ADD KEY `User_Notes` (`user`),
  ADD KEY `Company_Notes` (`company`);

--
-- Indexes for table `paylevels`
--
ALTER TABLE `paylevels`
  ADD PRIMARY KEY (`paylevel_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `Position_Company` (`company_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `timeoffrequests_ibfk_1` (`Head_ID`),
  ADD KEY `timeoffrequests_ibfk_2` (`checkedby`);

--
-- Indexes for table `timeofftype`
--
ALTER TABLE `timeofftype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_relation` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `report_to` (`report_to`),
  ADD KEY `company` (`company`),
  ADD KEY `departament_user` (`Departament_ID`),
  ADD KEY `position_user` (`Position_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absencestatuses`
--
ALTER TABLE `absencestatuses`
  MODIFY `absencestatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `adress`
--
ALTER TABLE `adress`
  MODIFY `adress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `amountoftimeoff`
--
ALTER TABLE `amountoftimeoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `assettypes`
--
ALTER TABLE `assettypes`
  MODIFY `assettype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `companygoals`
--
ALTER TABLE `companygoals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `companygoalsvalue`
--
ALTER TABLE `companygoalsvalue`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contacttypes`
--
ALTER TABLE `contacttypes`
  MODIFY `contacttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departament`
--
ALTER TABLE `departament`
  MODIFY `departament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employmentstatuses`
--
ALTER TABLE `employmentstatuses`
  MODIFY `employmentstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenseapprovers`
--
ALTER TABLE `expenseapprovers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expensescategory`
--
ALTER TABLE `expensescategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `goalitems`
--
ALTER TABLE `goalitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `newscategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paylevels`
--
ALTER TABLE `paylevels`
  MODIFY `paylevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `timeofftype`
--
ALTER TABLE `timeofftype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `amountoftimeoff`
--
ALTER TABLE `amountoftimeoff`
  ADD CONSTRAINT `time_off_type` FOREIGN KEY (`time_off_type`) REFERENCES `timeofftype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `companygoals`
--
ALTER TABLE `companygoals`
  ADD CONSTRAINT `companygoal-company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `companygoalsvalue`
--
ALTER TABLE `companygoalsvalue`
  ADD CONSTRAINT `companygoal-value` FOREIGN KEY (`company_goal`) REFERENCES `companygoals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `value-user` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departament`
--
ALTER TABLE `departament`
  ADD CONSTRAINT `company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenseapprovers`
--
ALTER TABLE `expenseapprovers`
  ADD CONSTRAINT `expenseApprove` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenseApproveCompany` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `Expenses_staff` FOREIGN KEY (`send_to`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Expenses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expensescategory`
--
ALTER TABLE `expensescategory`
  ADD CONSTRAINT `Company_exceptions` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goalitems`
--
ALTER TABLE `goalitems`
  ADD CONSTRAINT `goal_item_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `Company_News` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `Company_Notes` FOREIGN KEY (`company`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_Notes` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `Position_Company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  ADD CONSTRAINT `User_ID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timeoffrequests_ibfk_1` FOREIGN KEY (`Head_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timeoffrequests_ibfk_2` FOREIGN KEY (`checkedby`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timeofftype`
--
ALTER TABLE `timeofftype`
  ADD CONSTRAINT `company_relation` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `company` FOREIGN KEY (`company`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `departament_user` FOREIGN KEY (`Departament_ID`) REFERENCES `departament` (`departament_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `position_user` FOREIGN KEY (`Position_ID`) REFERENCES `position` (`position_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_to` FOREIGN KEY (`report_to`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
