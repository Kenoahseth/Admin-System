-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 05:56 PM
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
-- Database: `clinic_db`
--
CREATE DATABASE IF NOT EXISTS `clinic_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinic_db`;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `appt_id` int(11) NOT NULL,
  `pat_stdnum` int(11) DEFAULT NULL,
  `pat_name` varchar(50) NOT NULL,
  `pat_gender` varchar(50) NOT NULL,
  `appt_time` time(4) NOT NULL,
  `appt_date` date NOT NULL,
  `pat_type` varchar(50) NOT NULL,
  `pat_contactnum` int(11) NOT NULL,
  `appt_type` varchar(20) NOT NULL,
  `pat_medicalconcern` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--

INSERT INTO `appointment_tbl` (`appt_id`, `pat_stdnum`, `pat_name`, `pat_gender`, `appt_time`, `appt_date`, `pat_type`, `pat_contactnum`, `appt_type`, `pat_medicalconcern`) VALUES
(30, 222160, 'Kenoah', 'male', '10:00:00.0000', '2023-12-13', 'student', 2147483647, 'General Health Check', 'Masakit Ulo'),
(31, 876927, 'Mikimaws', 'female', '13:00:00.0000', '2023-12-26', 'student', 17239013, 'Medication', 'nakagat ng daga'),
(32, 707897, 'Remi', 'male', '15:00:00.0000', '2023-12-20', 'teacher', 4121441, 'Urgent Emergency', 'Food Poisoning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`appt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `appt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Database: `db_gradingsystemg1`
--
CREATE DATABASE IF NOT EXISTS `db_gradingsystemg1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_gradingsystemg1`;

-- --------------------------------------------------------

--
-- Table structure for table `addstudent`
--

CREATE TABLE `addstudent` (
  `StdNumber` varchar(7) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addstudent`
--

INSERT INTO `addstudent` (`StdNumber`, `firstName`, `middleName`, `lastName`) VALUES
('', '', '', ''),
('123', 'qwe', 'qwe', 'wqe'),
('123456', 'eryt', 'dg', 'asda');

-- --------------------------------------------------------

--
-- Table structure for table `final_grades`
--

CREATE TABLE `final_grades` (
  `StdNumber` varchar(7) NOT NULL,
  `Quiz1_FT` decimal(10,0) NOT NULL,
  `Quiz2_FT` decimal(10,0) NOT NULL,
  `ClassSTand_FT` decimal(10,0) NOT NULL,
  `Exam_FT` decimal(10,0) NOT NULL,
  `FinalGrade` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `final_grades`
--

INSERT INTO `final_grades` (`StdNumber`, `Quiz1_FT`, `Quiz2_FT`, `ClassSTand_FT`, `Exam_FT`, `FinalGrade`) VALUES
('123', 77, 23, 76, 56, 67),
('123456', 90, 78, 89, 98, 96);

-- --------------------------------------------------------

--
-- Table structure for table `midterm_grades`
--

CREATE TABLE `midterm_grades` (
  `StdNumber` varchar(7) NOT NULL,
  `Quiz1_MT` decimal(10,0) DEFAULT NULL,
  `Quiz2_MT` decimal(10,0) DEFAULT NULL,
  `ClassStand_MT` decimal(10,0) DEFAULT NULL,
  `Exam_MT` decimal(10,0) DEFAULT NULL,
  `MidGrade` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midterm_grades`
--

INSERT INTO `midterm_grades` (`StdNumber`, `Quiz1_MT`, `Quiz2_MT`, `ClassStand_MT`, `Exam_MT`, `MidGrade`) VALUES
('123', 23, 23, 34, 34, 30),
('123456', 43, 78, 78, 78, 72);

-- --------------------------------------------------------

--
-- Table structure for table `overall_grades`
--

CREATE TABLE `overall_grades` (
  `StdNumber` varchar(7) NOT NULL,
  `MT_overallGrade` decimal(10,0) NOT NULL,
  `FT_overallGrade` decimal(10,0) NOT NULL,
  `equiv_overallGrade` decimal(10,0) NOT NULL,
  `equivalant_grade` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `overall_grades`
--

INSERT INTO `overall_grades` (`StdNumber`, `MT_overallGrade`, `FT_overallGrade`, `equiv_overallGrade`, `equivalant_grade`, `remarks`) VALUES
('123', 30, 67, 30, '', 'Failed'),
('123456', 72, 96, 72, '3.0', 'Passed');

-- --------------------------------------------------------

--
-- Table structure for table `signup_faculty`
--

CREATE TABLE `signup_faculty` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(7) NOT NULL,
  `Prefix` varchar(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `middleName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `pin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup_student`
--

CREATE TABLE `signup_student` (
  `Id` int(11) NOT NULL,
  `stdNumber` varchar(7) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `pin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_student`
--

INSERT INTO `signup_student` (`Id`, `stdNumber`, `firstName`, `middleName`, `lastName`, `username`, `password`, `pin`) VALUES
(7, '123', 'qewr', 'ter', 'asd', 'bilao', 'qweqw', 54321),
(8, '3743', 'sdf', 'fgd', 'dfg', 'qwewqr', 'tae', 4321),
(9, '123', 'werwfs', 'sdaf', 'adf', 'sadf', '123', 123),
(10, '123456', 'ge', 'wer', 'fwfw', 'wqwqe', 'ASDA', 123123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addstudent`
--
ALTER TABLE `addstudent`
  ADD PRIMARY KEY (`StdNumber`),
  ADD KEY `StdNumber` (`StdNumber`);

--
-- Indexes for table `final_grades`
--
ALTER TABLE `final_grades`
  ADD PRIMARY KEY (`StdNumber`);

--
-- Indexes for table `midterm_grades`
--
ALTER TABLE `midterm_grades`
  ADD PRIMARY KEY (`StdNumber`);

--
-- Indexes for table `overall_grades`
--
ALTER TABLE `overall_grades`
  ADD PRIMARY KEY (`StdNumber`),
  ADD KEY `StdNumber` (`StdNumber`);

--
-- Indexes for table `signup_faculty`
--
ALTER TABLE `signup_faculty`
  ADD PRIMARY KEY (`id`,`faculty_id`,`username`,`password`,`pin`);

--
-- Indexes for table `signup_student`
--
ALTER TABLE `signup_student`
  ADD PRIMARY KEY (`Id`,`stdNumber`,`pin`,`password`,`username`),
  ADD KEY `fk` (`stdNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signup_faculty`
--
ALTER TABLE `signup_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signup_student`
--
ALTER TABLE `signup_student`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Database: `enrollment_db-habaradas`
--
CREATE DATABASE IF NOT EXISTS `enrollment_db-habaradas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `enrollment_db-habaradas`;

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `Employee_ID` int(11) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Middle_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblestud_details`
--

CREATE TABLE `tblestud_details` (
  `Detail_ID` int(11) NOT NULL,
  `Stud_ID` int(11) NOT NULL,
  `Fathers_name` varchar(50) NOT NULL,
  `F_Occupation` varchar(50) NOT NULL,
  `Mothers_name` varchar(50) NOT NULL,
  `M_Occupation` varchar(50) NOT NULL,
  `Guardians_name` varchar(50) NOT NULL,
  `G_Occupation` varchar(50) NOT NULL,
  `Parents_address` varchar(50) NOT NULL,
  `Parents_phonenum` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblrequirements`
--

CREATE TABLE `tblrequirements` (
  `Requirements_ID` int(11) NOT NULL,
  `Stud_ID` int(11) NOT NULL,
  `NSO` tinyint(1) NOT NULL,
  `Baptismal` tinyint(1) NOT NULL,
  `Entrance Exam Result` varchar(50) NOT NULL,
  `Certificate of Transfer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblschool_year`
--

CREATE TABLE `tblschool_year` (
  `Stud_ID` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `Stud_ID` int(11) NOT NULL,
  `First _name` varchar(50) NOT NULL,
  `Middle_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Birthday` varchar(50) NOT NULL,
  `Birth_place` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `Religion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `Trans_ID` int(11) NOT NULL,
  `Stud_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Particular_payables` varchar(50) NOT NULL,
  `Amount_paid` varchar(50) NOT NULL,
  `Balance` int(11) NOT NULL,
  `Payment_date` varchar(11) NOT NULL,
  `Payment_time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `tblestud_details`
--
ALTER TABLE `tblestud_details`
  ADD PRIMARY KEY (`Detail_ID`),
  ADD KEY `Foreign Key` (`Stud_ID`);

--
-- Indexes for table `tblrequirements`
--
ALTER TABLE `tblrequirements`
  ADD PRIMARY KEY (`Requirements_ID`),
  ADD KEY `Foreign Key` (`Stud_ID`);

--
-- Indexes for table `tblschool_year`
--
ALTER TABLE `tblschool_year`
  ADD KEY `Stud_ID` (`Stud_ID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`Stud_ID`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`Trans_ID`),
  ADD KEY `Stud_ID` (`Stud_ID`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD CONSTRAINT `Fk` FOREIGN KEY (`Stud_ID`) REFERENCES `tblestud_details` (`Stud_ID`),
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`Stud_ID`) REFERENCES `tblrequirements` (`Stud_ID`);
--
-- Database: `grading_system`
--
CREATE DATABASE IF NOT EXISTS `grading_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `grading_system`;

-- --------------------------------------------------------

--
-- Table structure for table `final_grades`
--

CREATE TABLE `final_grades` (
  `StdNumber` int(6) NOT NULL,
  `FinalQ1` decimal(11,0) DEFAULT NULL,
  `FinalQ2` decimal(11,0) DEFAULT NULL,
  `FinalCS` decimal(11,0) DEFAULT NULL,
  `FinalExam` decimal(11,0) DEFAULT NULL,
  `FinalGrade` decimal(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `midter_grades`
--

CREATE TABLE `midter_grades` (
  `StdNumber` int(6) NOT NULL,
  `StdName` varchar(50) DEFAULT NULL,
  `MidQ1` decimal(11,0) DEFAULT NULL,
  `MidQ2` decimal(11,0) DEFAULT NULL,
  `MidCS` decimal(11,0) DEFAULT NULL,
  `MidExam` decimal(11,0) DEFAULT NULL,
  `MidGrade` decimal(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midter_grades`
--

INSERT INTO `midter_grades` (`StdNumber`, `StdName`, `MidQ1`, `MidQ2`, `MidCS`, `MidExam`, `MidGrade`) VALUES
(123456, 'Jansi', 98, 98, 98, 98, 98),
(124562, 'ediwaw', 32, 32, 32, 41, 35),
(234567, 'Bading', 98, 98, 98, 98, 98),
(344535, 'kinawa', 34, 34, 34, 34, 34),
(456232, 'Kim', 98, 98, 98, 98, 98),
(676767, 'fregal', 23, 23, 23, 23, 23),
(876543, 'qewer', 12, 12, 12, 55, 26),
(879876, 'defensse', 34, 56, 67, 78, 63),
(7645456, 'sdfdfWF', 12, 12, 12, 12, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_grades`
--
ALTER TABLE `final_grades`
  ADD KEY `fk` (`StdNumber`);

--
-- Indexes for table `midter_grades`
--
ALTER TABLE `midter_grades`
  ADD PRIMARY KEY (`StdNumber`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_grades`
--
ALTER TABLE `final_grades`
  ADD CONSTRAINT `fk` FOREIGN KEY (`StdNumber`) REFERENCES `midter_grades` (`StdNumber`);
--
-- Database: `hoteldb`
--
CREATE DATABASE IF NOT EXISTS `hoteldb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hoteldb`;

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
(1, 'sample ppt file upload', 'uploads/Diagram_Group ni Joaquin Ebicner_AR101-Project-Proposal.docx.pdf', 'application/pdf', '2024-11-22 14:25:31'),
(2, 'sfasafsdfsdf', '', 'file', '2024-11-22 14:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `events_table`
--

CREATE TABLE `events_table` (
  `event_id` int(6) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_description` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_organizer` varchar(50) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `event_name`, `event_description`, `event_date`, `event_organizer`, `user_id`) VALUES
(1, 'christmas party', 'a;dfhowicmewiofoweieowdsknnivhe', '2024-12-25', 'Boss kups', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logs_table`
--

CREATE TABLE `logs_table` (
  `activity_name` varchar(50) NOT NULL,
  `data_recorded` date NOT NULL,
  `user_recorded` varchar(50) NOT NULL,
  `user_id` int(6) NOT NULL,
  `log_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `height` varchar(4) NOT NULL,
  `weight` varchar(4) NOT NULL,
  `civ_stat` varchar(11) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `educational_attainment` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnum` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs_table`
--

INSERT INTO `staffs_table` (`staff_id`, `firstname`, `lastname`, `sex`, `age`, `shift`, `shift_start`, `shift_end`, `bdate`, `height`, `weight`, `civ_stat`, `nationality`, `address`, `languages`, `educational_attainment`, `religion`, `status`, `email`, `cnum`) VALUES
(69, 'kenoah', 'habaradas', 'male', 13, 'day', '12:27:30', '12:30:00', '2004-01-03', '5\'3', '57kg', 'single', 'filipino', '14 road 2 project. 6 Quezon City, Metro Manila', 'English, Filipino', 'College Degree', 'baptist', 'Active', 'kenoah@gmail.com', '9165641962'),
(420, 'Juan', 'DelaCruz', 'male', 45, 'day', '09:30:00', '17:30:00', '1990-05-16', '4\"11', '5kg', 'Married', 'filipino', '673 Quirino Hwy, Novaliches, Quezon City, Metro Ma', 'English, Filipino', 'Master\'s Degree, Phd in monitoring', 'Cathholic', 'Active', 'juan23@gmail.com', '0916221962'),
(421, 'jean', 'bilog', 'female', 25, '', '19:49:00', '22:52:00', '2024-11-23', '', '', 'single', 'Filipino', 'North Avenue, corner Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila', '', 'shs', 'Catholic', '', '', '345234');

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
-- Indexes for table `documents_table`
--
ALTER TABLE `documents_table`
  ADD PRIMARY KEY (`docu_id`);

--
-- Indexes for table `events_table`
--
ALTER TABLE `events_table`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `eve_user_id` (`user_id`);

--
-- Indexes for table `logs_table`
--
ALTER TABLE `logs_table`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `logs_user_id` (`user_id`);

--
-- Indexes for table `staffs_table`
--
ALTER TABLE `staffs_table`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents_table`
--
ALTER TABLE `documents_table`
  MODIFY `docu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events_table`
--
ALTER TABLE `events_table`
  MODIFY `event_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs_table`
--
ALTER TABLE `logs_table`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs_table`
--
ALTER TABLE `staffs_table`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_table`
--
ALTER TABLE `events_table`
  ADD CONSTRAINT `eve_user_id` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`);

--
-- Constraints for table `logs_table`
--
ALTER TABLE `logs_table`
  ADD CONSTRAINT `logs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`);
--
-- Database: `hris_db`
--
CREATE DATABASE IF NOT EXISTS `hris_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hris_db`;

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo_table`
--

CREATE TABLE `employeeinfo_table` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `age` int(3) NOT NULL,
  `shift` time NOT NULL,
  `bdate` date NOT NULL,
  `height` varchar(4) NOT NULL,
  `weight` varchar(4) NOT NULL,
  `civ_stat` varchar(11) NOT NULL,
  `nation` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeinfo_table`
--
ALTER TABLE `employeeinfo_table`
  ADD PRIMARY KEY (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employeeinfo_table`
--
ALTER TABLE `employeeinfo_table`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `marblegranite_db`
--
CREATE DATABASE IF NOT EXISTS `marblegranite_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `marblegranite_db`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE `accounts_tbl` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`id`, `username`, `email`, `password`, `number`, `address`) VALUES
(4, 'peter', 'peterricsfranca@gmail.co', 'a@3dwed2d', 2147483647, '56 baranggay san jose road 3 QC'),
(5, 'John', 'Johnpaul@gmail.com', 'Pass1234!', 2147483647, '34 Road 4 Cornelia st. Quezon City'),
(9, 'Kenoah', 'oahhabaradas@gmail.com', 'pass1234!', 2147483647, '34 Road 4 Cornelia st. Quezon City'),
(10, 'Kenoah', 'oahhabaradas@gmail.com', 'pass1234!', 2147483647, '34 Road 4 Cornelia st. Quezon City');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"clinic_db\",\"table\":\"appointment_tbl\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-12-12 11:06:30', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
