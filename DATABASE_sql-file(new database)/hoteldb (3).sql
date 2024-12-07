-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 03:00 AM
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
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_table`
--

CREATE TABLE `attendance_table` (
  `att_id` int(50) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL,
  `overtime` time NOT NULL,
  `undertime` time NOT NULL,
  `assigned_id` int(50) NOT NULL,
  `recorded_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_table`
--

INSERT INTO `attendance_table` (`att_id`, `time_in`, `time_out`, `date`, `overtime`, `undertime`, `assigned_id`, `recorded_status`) VALUES
(26, '19:41:24', '19:41:36', '2024-11-29', '00:00:00', '00:00:00', 123123, 'Active'),
(27, '13:42:33', '13:42:49', '2024-12-04', '00:00:00', '00:00:00', 123123, 'Active'),
(29, '01:05:17', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(30, '16:53:53', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(31, '17:21:59', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(32, '17:22:57', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(33, '17:27:48', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(34, '17:28:21', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(35, '17:28:45', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(36, '17:28:53', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(37, '17:33:05', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(38, '17:57:07', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(39, '18:05:53', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(40, '18:08:39', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(41, '18:18:32', '18:18:34', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active'),
(42, '18:28:42', '00:00:00', '2024-12-06', '00:00:00', '00:00:00', 123123, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `documents_table`
--

CREATE TABLE `documents_table` (
  `docu_id` int(11) NOT NULL,
  `docu_name` varchar(255) NOT NULL,
  `docu_path` varchar(255) NOT NULL,
  `docu_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents_table`
--

INSERT INTO `documents_table` (`docu_id`, `docu_name`, `docu_path`, `docu_type`, `created_at`) VALUES
(14, 'project proposal', 'uploads/Diagram_Group ni Joaquin Ebicner_AR101-Project-Proposal.docx (3).pdf', 'file', '2024-12-06 16:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `events_table`
--

CREATE TABLE `events_table` (
  `event_id` int(6) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_description` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_organizer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `event_name`, `event_description`, `event_date`, `event_organizer`) VALUES
(1, 'christmas party', 'a;dfhowicmewiofoweieowdsknnivhe', '2024-12-25', 'Boss kups'),
(3, 'Despidida', 'bring your own kanin, magic sarap ulam', '2024-12-24', 'Lodicakes'),
(4, 'bday', 'penge sweater', '2025-01-03', 'Maris Racal'),
(5, 'asfa', 'sadfas', '2024-12-08', 'asf'),
(6, 'asd', 'asd', '2024-12-08', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `logs_table`
--

CREATE TABLE `logs_table` (
  `activity_name` varchar(50) NOT NULL,
  `data_recorded` text NOT NULL,
  `date_recorded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_recorded` varchar(50) NOT NULL,
  `log_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_table`
--

INSERT INTO `logs_table` (`activity_name`, `data_recorded`, `date_recorded`, `user_recorded`, `log_id`) VALUES
('Add Event', 'Event: asd, Date: 2024-12-08, Organizer: asd', '2024-12-04 17:08:39', 'admin', 1),
('Time In', 'Employee ID: 0, Time In: 23:00:31, Date: 2024-12-05', '2024-12-05 15:00:31', 'admin', 2),
('Status Update', 'Employee ID: 0, Status: Active', '2024-12-05 15:00:31', 'admin', 3),
('Time In', 'Employee ID: 123123, Time In: 01:05:17, Date: 2024-12-06', '2024-12-05 17:05:18', 'admin', 4),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-05 17:05:18', 'admin', 5),
('Time Out', 'Employee ID: 123123, Time Out: 01:05:27, Date: 2024-12-06', '2024-12-05 17:05:27', 'admin', 6),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-05 17:05:27', 'admin', 7),
('Time In', 'Employee ID: 123123, Time In: 16:53:53, Date: 2024-12-06', '2024-12-06 08:53:53', 'admin', 8),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 08:53:53', 'admin', 9),
('Time In', 'Employee ID: 123123, Time In: 17:21:59, Date: 2024-12-06', '2024-12-06 09:21:59', 'admin', 10),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:21:59', 'admin', 11),
('Time Out', 'Employee ID: 123123, Time Out: 17:22:47, Date: 2024-12-06', '2024-12-06 09:22:47', 'admin', 12),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:22:47', 'admin', 13),
('Time In', 'Employee ID: 123123, Time In: 17:22:57, Date: 2024-12-06', '2024-12-06 09:22:57', 'admin', 14),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:22:58', 'admin', 15),
('Time In', 'Employee ID: 123123, Time In: 17:27:48, Date: 2024-12-06', '2024-12-06 09:27:48', 'admin', 16),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:27:48', 'admin', 17),
('Time Out', 'Employee ID: 123123, Time Out: 17:27:57, Date: 2024-12-06', '2024-12-06 09:27:57', 'admin', 18),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:27:57', 'admin', 19),
('Time Out', 'Employee ID: 123123, Time Out: 17:28:13, Date: 2024-12-06', '2024-12-06 09:28:13', 'admin', 20),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:28:13', 'admin', 21),
('Time In', 'Employee ID: 123123, Time In: 17:28:21, Date: 2024-12-06', '2024-12-06 09:28:21', 'admin', 22),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:28:21', 'admin', 23),
('Time In', 'Employee ID: 123123, Time In: 17:28:45, Date: 2024-12-06', '2024-12-06 09:28:45', 'admin', 24),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:28:45', 'admin', 25),
('Time Out', 'Employee ID: 123123, Time Out: 17:28:48, Date: 2024-12-06', '2024-12-06 09:28:48', 'admin', 26),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:28:48', 'admin', 27),
('Time In', 'Employee ID: 123123, Time In: 17:28:53, Date: 2024-12-06', '2024-12-06 09:28:53', 'admin', 28),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:28:53', 'admin', 29),
('Time Out', 'Employee ID: 123123, Time Out: 17:32:56, Date: 2024-12-06', '2024-12-06 09:32:56', 'admin', 30),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:32:56', 'admin', 31),
('Time In', 'Employee ID: 123123, Time In: 17:33:05, Date: 2024-12-06', '2024-12-06 09:33:05', 'admin', 32),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:33:05', 'admin', 33),
('Time Out', 'Employee ID: 123123, Time Out: 17:33:10, Date: 2024-12-06', '2024-12-06 09:33:10', 'admin', 34),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:33:10', 'admin', 35),
('Time In', 'Employee ID: 123123, Time In: 17:57:07, Date: 2024-12-06', '2024-12-06 09:57:07', 'admin', 36),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 09:57:07', 'admin', 37),
('Time Out', 'Employee ID: 123123, Time Out: 17:59:38, Date: 2024-12-06', '2024-12-06 09:59:38', 'admin', 38),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 09:59:38', 'admin', 39),
('Time In', 'Employee ID: 123123, Time In: 18:05:53, Date: 2024-12-06', '2024-12-06 10:05:53', 'admin', 40),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 10:05:53', 'admin', 41),
('Time In', 'Employee ID: 123123, Time In: 18:08:39, Date: 2024-12-06', '2024-12-06 10:08:39', 'admin', 42),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 10:08:39', 'admin', 43),
('Time Out', 'Employee ID: 123123, Time Out: 18:18:20, Date: 2024-12-06', '2024-12-06 10:18:20', 'admin', 44),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 10:18:20', 'admin', 45),
('Time In', 'Employee ID: 123123, Time In: 18:18:32, Date: 2024-12-06', '2024-12-06 10:18:32', 'admin', 46),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 10:18:32', 'admin', 47),
('Time Out', 'Employee ID: 123123, Time Out: 18:18:34, Date: 2024-12-06', '2024-12-06 10:18:34', 'admin', 48),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 10:18:34', 'admin', 49),
('Time In', 'Employee ID: 123123, Time In: 18:28:42, Date: 2024-12-06', '2024-12-06 10:28:42', 'admin', 50),
('Status Update', 'Employee ID: 123123, Status: Active', '2024-12-06 10:28:42', 'admin', 51),
('Add Employee', 'Employee: arduino uno, ID: 101010', '2024-12-06 18:20:05', 'admin', 52),
('Add Employee', 'Employee: arduino uno, ID: 111000', '2024-12-06 18:45:40', 'admin', 53),
('Time Out', 'Employee ID: 123123, Time Out: 03:02:30, Date: 2024-12-07', '2024-12-06 19:02:30', 'admin', 54),
('Status Update', 'Employee ID: 123123, Status: Inactive', '2024-12-06 19:02:30', 'admin', 55);

-- --------------------------------------------------------

--
-- Table structure for table `salary_table`
--

CREATE TABLE `salary_table` (
  `pay_id` int(50) NOT NULL,
  `basic` decimal(10,2) NOT NULL,
  `incentives` decimal(10,2) DEFAULT NULL,
  `overtime` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `sss` decimal(10,2) NOT NULL,
  `pagibig` decimal(10,2) NOT NULL,
  `philhealth` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_table`
--

INSERT INTO `salary_table` (`pay_id`, `basic`, `incentives`, `overtime`, `total`, `sss`, `pagibig`, `philhealth`, `grand_total`, `staff_id`) VALUES
(123, 123.00, 123.00, 123.00, 0.00, 123.00, 123.00, 123.00, 123.00, 69),
(124, 99999999.99, 123.00, 123.00, 99999999.99, 99999999.99, 1123.00, 1233.00, -99999999.99, 69),
(125, 123.00, 123.00, 123.00, 369.00, 123.00, 123.00, 123.00, 0.00, 69);

-- --------------------------------------------------------

--
-- Table structure for table `staffs_table`
--

CREATE TABLE `staffs_table` (
  `staff_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `age` int(3) NOT NULL,
  `shift` varchar(11) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL,
  `bdate` date NOT NULL,
  `height` varchar(6) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `civ_stat` varchar(11) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `educational_attainment` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnum` varchar(11) NOT NULL,
  `assigned_id` int(50) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs_table`
--

INSERT INTO `staffs_table` (`staff_id`, `firstname`, `lastname`, `sex`, `age`, `shift`, `shift_start`, `shift_end`, `bdate`, `height`, `weight`, `civ_stat`, `nationality`, `address`, `languages`, `educational_attainment`, `religion`, `status`, `email`, `cnum`, `assigned_id`, `profile_picture`, `position`) VALUES
(69, 'kenoah', 'habaradas', 'male', 13, 'day', '12:27:30', '12:30:00', '2004-01-03', '5\'3', '57', 'single', 'filipino', '14 road 2 project. 6 Quezon City, Metro Manila', 'English, Filipino', 'College Degree', 'baptist', 'Inactive', 'kenoah@gmail.com', '9165641962', 123123, NULL, 'admin'),
(420, 'Juan', 'DelaCruz', 'male', 45, 'day', '09:30:00', '17:30:00', '1990-05-16', '4\"11', '5kg', 'Married', 'filipino', '673 Quirino Hwy, Novaliches, Quezon City, Metro Ma', 'English, Filipino', 'Master\'s Degree, Phd in monitoring', 'Cathholic', 'Active', 'juan23@gmail.com', '0916221962', 221623, NULL, ''),
(421, 'jean', 'bilog', 'female', 25, '', '19:49:00', '22:52:00', '2024-11-23', '', '', 'single', 'Filipino', 'North Avenue, corner Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila', '', 'shs', 'Catholic', 'Active', '', '345234', 0, NULL, ''),
(423, 'skibidi', 'sigma', 'female', 25, '', '05:56:00', '14:00:00', '2024-11-16', '', '', 'married', 'Filipino', 'North Avenue, corner Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila', '', 'college', 'Catholic', '', '', '09876576512', 69420, NULL, ''),
(425, 'alllen jusde', 'edrosolo', 'male', 21, '', '17:00:00', '01:00:00', '2024-12-25', '', '', 'single', 'Filipino', 'North Avenue, corner Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila', '', 'college', 'baptist', '', '', '0915625746', 1928, NULL, ''),
(427, 'arduino', 'uno', 'male', 5, '', '06:45:00', '14:45:00', '2024-12-22', '', '', 'single', 'Filipino', 'North Avenue, corner Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila', '', 'shs', 'robotics', '', '', '1234', 111000, 'uploads/profile_pictures/arduino img.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `email`, `password`, `user_type`, `name`, `date_created`) VALUES
(2, 'oah@gmail.com', '123', 'admin', 'kenoah', '0001-02-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_table`
--
ALTER TABLE `attendance_table`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `fk_assigned_id` (`assigned_id`);

--
-- Indexes for table `documents_table`
--
ALTER TABLE `documents_table`
  ADD PRIMARY KEY (`docu_id`);

--
-- Indexes for table `events_table`
--
ALTER TABLE `events_table`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `logs_table`
--
ALTER TABLE `logs_table`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `salary_table`
--
ALTER TABLE `salary_table`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `fksalary_staff_id` (`staff_id`);

--
-- Indexes for table `staffs_table`
--
ALTER TABLE `staffs_table`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `assigned_id` (`assigned_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_table`
--
ALTER TABLE `attendance_table`
  MODIFY `att_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `documents_table`
--
ALTER TABLE `documents_table`
  MODIFY `docu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events_table`
--
ALTER TABLE `events_table`
  MODIFY `event_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs_table`
--
ALTER TABLE `logs_table`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `salary_table`
--
ALTER TABLE `salary_table`
  MODIFY `pay_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `staffs_table`
--
ALTER TABLE `staffs_table`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_table`
--
ALTER TABLE `attendance_table`
  ADD CONSTRAINT `fk_assigned_id` FOREIGN KEY (`assigned_id`) REFERENCES `staffs_table` (`assigned_id`);

--
-- Constraints for table `salary_table`
--
ALTER TABLE `salary_table`
  ADD CONSTRAINT `fksalary_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs_table` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
