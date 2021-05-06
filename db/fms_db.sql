-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 07:33 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `attendance_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `attendance_date` varchar(100) NOT NULL,
  `attendance_timestamp_one` timestamp NOT NULL DEFAULT current_timestamp(),
  `attendance_timestamp_two` varchar(100) NOT NULL,
  `attendance_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`attendance_id`, `emp_id`, `attendance_date`, `attendance_timestamp_one`, `attendance_timestamp_two`, `attendance_status`) VALUES
('ATT0000001', 'EMP0000002', '2021-02-03', '2021-02-03 08:38:34', '2021-02-03 15:26:29', 0),
('ATT0000002', 'EMP0000002', '2021-02-04', '2021-02-04 04:22:26', '2021-02-04 20:13:04', 0),
('ATT0000003', 'EMP0000005', '2021-02-04', '2021-02-04 16:45:03', '2021-02-04 22:15:21', 0),
('ATT0000004', 'EMP0000005', '2021-02-04', '2021-02-04 16:46:01', '2021-02-04 22:16:15', 0),
('ATT0000005', 'EMP0000002', '2021-02-06', '2021-02-06 12:43:17', '2021-02-06 18:13:52', 0),
('ATT0000006', 'EMP0000002', '2021-04-08', '2021-04-08 18:02:41', '2021-04-08 23:45:17', 0),
('ATT0000007', 'EMP0000001', '2021-04-08', '2021-04-08 18:16:24', '2021-04-29 12:17:23', 0),
('ATT0000008', 'EMP0000005', '2021-04-08', '2021-04-08 18:17:12', '2021-04-29 12:18:06', 0),
('ATT0000009', 'EMP0000002', '2021-04-29', '2021-04-29 06:44:30', '2021-05-01 20:43:42', 0),
('ATT0000010', 'EMP0000008', '2021-04-29', '2021-04-29 06:45:57', '2021-05-01 20:45:04', 0),
('ATT0000011', 'EMP0000003', '2021-04-29', '2021-04-29 06:47:52', '2021-05-01 20:43:47', 0),
('ATT0000012', 'EMP0000007', '2021-04-29', '2021-04-29 06:51:37', '2021-05-01 20:44:55', 0),
('ATT0000013', 'EMP0000005', '2021-04-29', '2021-04-29 06:52:51', '2021-04-30 00:47:03', 0),
('ATT0000014', 'EMP0000004', '2021-04-29', '2021-04-29 19:16:32', '2021-05-01 20:43:54', 0),
('ATT0000015', 'EMP0000001', '2021-05-01', '2021-05-01 15:13:29', '2021-05-01 20:53:13', 0),
('ATT0000016', 'EMP0000005', '2021-05-01', '2021-05-01 15:13:57', '2021-05-01 20:54:26', 0),
('ATT0000017', 'EMP0000006', '2021-05-01', '2021-05-01 15:14:43', '2021-05-01 20:55:00', 0),
('ATT0000018', 'EMP0000002', '2021-05-01', '2021-05-01 02:26:24', '2021-05-02 11:18:55', 0),
('ATT0000019', 'EMP0000001', '2021-05-02', '2021-05-02 05:48:42', '2021-05-02 17:02:24', 0),
('ATT0000020', 'EMP0000002', '2021-05-02', '2021-05-02 05:49:50', '2021-05-02 17:02:38', 0),
('ATT0000021', 'EMP0000003', '2021-05-02', '2021-05-02 05:50:03', '2021-05-02 17:02:52', 0),
('ATT0000022', 'EMP0000004', '2021-05-02', '2021-05-02 05:50:18', '2021-05-02 17:03:06', 0),
('ATT0000023', 'EMP0000005', '2021-05-02', '2021-05-02 05:50:35', '2021-05-02 17:03:21', 0),
('ATT0000024', 'EMP0000006', '2021-05-02', '2021-05-02 05:50:49', '2021-05-02 17:03:34', 0),
('ATT0000025', 'EMP0000007', '2021-05-02', '2021-05-02 05:51:03', '2021-05-02 17:03:47', 0),
('ATT0000026', 'EMP0000008', '2021-05-02', '2021-05-02 05:51:18', '2021-05-02 17:04:02', 0),
('ATT0000027', 'EMP0000009', '2021-05-02', '2021-05-02 05:51:32', '2021-05-02 17:04:16', 0),
('ATT0000028', 'EMP0000001', '2021-05-03', '2021-05-03 07:37:25', '2021-05-03 21:49:33', 0),
('ATT0000029', 'EMP0000002', '2021-05-03', '2021-05-03 07:37:38', '2021-05-03 21:50:04', 0),
('ATT0000030', 'EMP0000003', '2021-05-03', '2021-05-03 07:38:00', '2021-05-03 21:50:17', 0),
('ATT0000031', 'EMP0000004', '2021-05-03', '2021-05-03 07:38:14', '2021-05-03 21:50:49', 0),
('ATT0000032', 'EMP0000005', '2021-05-03', '2021-05-03 07:38:26', '2021-05-03 21:51:01', 0),
('ATT0000033', 'EMP0000006', '2021-05-03', '2021-05-03 07:38:39', '2021-05-03 21:51:14', 0),
('ATT0000034', 'EMP0000007', '2021-05-03', '2021-05-03 07:39:03', '2021-05-03 21:51:26', 0),
('ATT0000035', 'EMP0000008', '2021-05-03', '2021-05-03 07:39:18', '2021-05-03 21:51:39', 0),
('ATT0000036', 'EMP0000009', '2021-05-03', '2021-05-03 07:39:31', '2021-05-03 21:51:53', 0),
('ATT0000037', 'EMP0000008', '2021-05-03', '2021-05-03 16:38:35', '', 1),
('ATT0000038', 'EMP0000001', '2021-05-03', '2021-05-03 16:39:24', '2021-05-03 22:12:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cus_tbl`
--

CREATE TABLE `cus_tbl` (
  `cus_id` char(10) NOT NULL,
  `cus_first_name` varchar(100) NOT NULL,
  `cus_last_name` varchar(100) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_code_phoneone` varchar(50) NOT NULL,
  `cus_phone_one` char(10) NOT NULL,
  `cus_code_phonetwo` varchar(50) DEFAULT NULL,
  `cus_phone_two` char(10) DEFAULT NULL,
  `cus_houseno` varchar(50) NOT NULL,
  `cus_street_one` varchar(100) NOT NULL,
  `cus_street_two` varchar(100) DEFAULT NULL,
  `cus_city` varchar(100) NOT NULL,
  `cus_postal_code` varchar(50) NOT NULL,
  `cus_status` int(2) NOT NULL DEFAULT 1,
  `cus_add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_tbl`
--

INSERT INTO `cus_tbl` (`cus_id`, `cus_first_name`, `cus_last_name`, `cus_email`, `cus_code_phoneone`, `cus_phone_one`, `cus_code_phonetwo`, `cus_phone_two`, `cus_houseno`, `cus_street_one`, `cus_street_two`, `cus_city`, `cus_postal_code`, `cus_status`, `cus_add_date`) VALUES
('CUS0000001', 'Dilshan', 'Liyanage', 'dilshanliyanage@gmail.com', '+94', '771586351', '+94', '719106960', '36', 'Kaduwela Road', 'Maaula', 'Gampola', '055256', 1, '2021-02-19 17:08:48'),
('CUS0000002', 'Dian', 'Malaka', 'dianskyline@gmail.com', '+94', '771587458', '+94', '115896589', '77', 'Howard Lane', 'Kanagaluwa', 'Kegalle', '055625', 1, '2021-02-19 17:08:52'),
('CUS0000003', 'Steve', 'Jobs', 'dilshanliyanage@gmail.com', '+94', '771234567', '+94', '111111111', '3/12', 'Restville', 'Malgarden', 'Kurunegala', '088987', 1, '2021-02-19 17:08:56'),
('CUS0000004', 'Kaushani', 'Nathashiya', 'kaushi10@gmail.com', '+94', '778958965', '+94', '554785478', '09', 'Richards Lane', 'Vyaparimoolai', 'Jaffna', '001256', 1, '2021-02-19 17:09:00'),
('CUS0000005', 'Mahesh', 'Jayawardhane', 'mahesh9200@gmail.com', '+94', '121233652', '+94', '489687496', '87', 'Harvey Lane', 'Nuwara Eliya Road', 'Pussellawa', '20570', 1, '2021-05-01 16:01:25'),
('CUS0000006', 'Sajith', 'Premadasa', 'sajith@gmail.com', '+94', '767858958', '+94', '774152415', '97', 'Markinson Lane', 'Wellawatte', 'Colombo 5', '055014', 1, '2021-02-19 17:09:17'),
('CUS0000007', 'Suranga', 'Herath', 'suranga@gmail.com', '+94', '071453453', '+94', '077894545', '45', 'Wales Road', 'Solomon Road', 'Negambo', '007845', 1, '2021-02-19 17:09:23'),
('CUS0000008', 'Chathura', 'Udurawana', 'cj@hotmail.com', '+94', '122587419', '+94', '112233669', '12', 'Castle Lane', 'Bambalapitiya', 'Colombo 6', '005689', 1, '2021-02-19 17:09:28'),
('CUS0000009', 'Simon', 'Walls', 'simon1000@hotmail.com', '+94', '775454659', '+94', '255658966', '12/3', 'Tornado Lane', 'Divulapitiya', 'Kaudulla', '255026', 0, '2021-05-02 12:32:30'),
('CUS0000010', 'Shakthi', 'Liyanage', 'shakthi2005@gmail.com', '+94', '771586354', '+94', '', 'No. 16', '', 'Keerapone Road', 'Gampola', '20500', 1, '2021-04-17 19:14:49'),
('CUS0000011', 'Mr. Sumithra', 'Perea', 'sumithra@gmail.com', '+94', '785411215', '+94', '775258998', 'No.23', 'Magahena Road', 'Thalawaththa', 'Kaluthara', '', 1, '2021-05-02 17:26:53'),
('CUS0000012', 'Mr. Hashan', 'Welegama', '', '+94', '775541445', '+94', '', 'No. 34', 'New Mosaal Road', 'Mawathagama', 'Kurunegala', '', 1, '2021-05-03 09:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `emp_jobrole_tbl`
--

CREATE TABLE `emp_jobrole_tbl` (
  `jobrole_id` char(10) NOT NULL,
  `jobrole_name` varchar(100) NOT NULL,
  `jobrole_basicsal` float NOT NULL,
  `jobrole_maxsal` float NOT NULL,
  `jobrole_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_jobrole_tbl`
--

INSERT INTO `emp_jobrole_tbl` (`jobrole_id`, `jobrole_name`, `jobrole_basicsal`, `jobrole_maxsal`, `jobrole_status`) VALUES
('EJR0000001', 'Administrator', 200, 230, 1),
('EJR0000002', 'Supervisor', 320, 345, 1),
('EJR0000003', 'Maintenance Staff', 100, 125, 1),
('EJR0000004', 'Clerk', 250, 270, 1),
('EJR0000005', 'Kitchen Staff', 100, 125, 1),
('EJR0000006', 'Production Staff', 220, 270, 1),
('EJR0000007', 'IT Staff', 100, 125, 1),
('EJR0000008', 'Transportation Staff', 100, 125, 1),
('EJR0000009', 'In-office Employee', 180, 200, 1),
('EJR0000010', 'Receptionist', 125, 150, 1),
('EJR0000011', 'Security Staff', 100, 125, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_payroll_tbl`
--

CREATE TABLE `emp_payroll_tbl` (
  `payroll_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `attendance_id` char(10) NOT NULL,
  `attendance_date` varchar(10) NOT NULL,
  `tot_work_mins` float NOT NULL,
  `payroll_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_payroll_tbl`
--

INSERT INTO `emp_payroll_tbl` (`payroll_id`, `emp_id`, `attendance_id`, `attendance_date`, `tot_work_mins`, `payroll_status`) VALUES
('PAY0000001', 'EMP0000001', 'ATT0000001', '2021-02-03', 77, 1),
('PAY0000002', 'EMP0000002', 'ATT0000001', '2021-02-03', 120, 1),
('PAY0000003', 'EMP0000005', 'ATT0000003', '2021-02-04', 16000, 1),
('PAY0000004', 'EMP0000005', 'ATT0000003', '2021-02-04', 25, 1),
('PAY0000005', 'EMP0000005', 'ATT0000005', '2021-02-06', 0, 1),
('PAY0000006', 'EMP0000002', 'ATT0000006', '2021-04-08', 12, 1),
('PAY0000007', 'EMP0000001', '', '2021-04-29', 0, 1),
('PAY0000008', 'EMP0000005', '', '2021-04-29', 0, 1),
('PAY0000009', 'EMP0000005', 'ATT0000013', '2021-04-29', 744, 1),
('PAY0000010', 'EMP0000002', '', '2021-05-01', 0, 1),
('PAY0000011', 'EMP0000003', '', '2021-05-01', 0, 1),
('PAY0000012', 'EMP0000004', '', '2021-05-01', 0, 1),
('PAY0000013', 'EMP0000007', '', '2021-05-01', 0, 1),
('PAY0000014', 'EMP0000008', '', '2021-05-01', 0, 1),
('PAY0000015', 'EMP0000001', 'ATT0000015', '2021-05-01', 9, 1),
('PAY0000016', 'EMP0000005', 'ATT0000016', '2021-05-01', 10, 1),
('PAY0000017', 'EMP0000006', 'ATT0000017', '2021-05-01', 10, 1),
('PAY0000018', 'EMP0000002', '', '2021-05-02', 0, 1),
('PAY0000019', 'EMP0000001', 'ATT0000019', '2021-05-02', 343, 1),
('PAY0000020', 'EMP0000002', 'ATT0000020', '2021-05-02', 342, 1),
('PAY0000021', 'EMP0000003', 'ATT0000021', '2021-05-02', 342, 1),
('PAY0000022', 'EMP0000004', 'ATT0000022', '2021-05-02', 342, 1),
('PAY0000023', 'EMP0000005', 'ATT0000023', '2021-05-02', 342, 1),
('PAY0000024', 'EMP0000006', 'ATT0000024', '2021-05-02', 342, 1),
('PAY0000025', 'EMP0000007', 'ATT0000025', '2021-05-02', 342, 1),
('PAY0000026', 'EMP0000008', 'ATT0000026', '2021-05-02', 342, 1),
('PAY0000027', 'EMP0000009', 'ATT0000027', '2021-05-02', 342, 1),
('PAY0000028', 'EMP0000001', 'ATT0000028', '2021-05-03', 522, 1),
('PAY0000029', 'EMP0000002', 'ATT0000029', '2021-05-03', 522, 1),
('PAY0000030', 'EMP0000003', 'ATT0000030', '2021-05-03', 522, 1),
('PAY0000031', 'EMP0000004', 'ATT0000031', '2021-05-03', 522, 1),
('PAY0000032', 'EMP0000005', 'ATT0000032', '2021-05-03', 522, 1),
('PAY0000033', 'EMP0000006', 'ATT0000033', '2021-05-03', 522, 1),
('PAY0000034', 'EMP0000007', 'ATT0000034', '2021-05-03', 522, 1),
('PAY0000035', 'EMP0000008', 'ATT0000035', '2021-05-03', 522, 1),
('PAY0000036', 'EMP0000009', 'ATT0000036', '2021-05-03', 522, 1),
('PAY0000037', 'EMP0000001', 'ATT0000028', '2021-05-03', 522, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_tbl`
--

CREATE TABLE `emp_salary_tbl` (
  `sal_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `sal_month` char(7) NOT NULL,
  `sal_totwork_hrs` double NOT NULL,
  `sal_work_hrs` double NOT NULL,
  `sal_current_sal` double NOT NULL,
  `sal_otwork_hrs` double NOT NULL,
  `sal_ot_sal` double NOT NULL,
  `sal_currentpay` double NOT NULL,
  `sal_otpay` double NOT NULL,
  `sal_totmonthsal` double NOT NULL,
  `sal_report_pdf` varchar(1000) NOT NULL,
  `sal_create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sal_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_salary_tbl`
--

INSERT INTO `emp_salary_tbl` (`sal_id`, `emp_id`, `sal_month`, `sal_totwork_hrs`, `sal_work_hrs`, `sal_current_sal`, `sal_otwork_hrs`, `sal_ot_sal`, `sal_currentpay`, `sal_otpay`, `sal_totmonthsal`, `sal_report_pdf`, `sal_create_time`, `sal_status`) VALUES
('ESL0000001', 'EMP0000005', '2021-02', 267.1, 204, 100, 63.1, 125, 25500, 7890, 33390, '../../docs/salary_report/ESL0000001-EMP0000005.pdf', '2021-04-23 06:01:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_tbl`
--

CREATE TABLE `emp_tbl` (
  `emp_id` char(10) NOT NULL,
  `emp_fname` varchar(30) NOT NULL,
  `emp_lname` varchar(30) NOT NULL,
  `jobrole_id` char(10) NOT NULL,
  `emp_nic` varchar(10) NOT NULL,
  `emp_telno` char(10) NOT NULL,
  `emp_telno_2` char(10) DEFAULT NULL,
  `emp_address` varchar(250) NOT NULL,
  `emp_email` varchar(250) DEFAULT NULL,
  `emp_img_path` varchar(100) NOT NULL,
  `emp_status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_tbl`
--

INSERT INTO `emp_tbl` (`emp_id`, `emp_fname`, `emp_lname`, `jobrole_id`, `emp_nic`, `emp_telno`, `emp_telno_2`, `emp_address`, `emp_email`, `emp_img_path`, `emp_status`) VALUES
('EMP0000001', 'Dilshan', 'Liyanage', 'EJR0000001', '952893676V', '0771586351', '0719106960', '16, Keerapone Road, Gampola', 'dilshan@gmail.com', 'images/employee/EMP0000001Dilshan.jpg', 1),
('EMP0000002', 'Saman', 'Weerasekara', 'EJR0000004', '947934525V', '0776185965', '0781422554', '14, Daulagala Road, Penideniya, Peradeniya', 'saman@gmail.com', 'images/employee/EMP0000002Dian.jpg', 1),
('EMP0000003', 'Mahesh', 'Nawarathne', 'EJR0000008', '928453856V', '0715893233', '0774589669', '14/4, Kandy Road, Lewella', 'mahesh@gmail.com', 'images/employee/EMP0000003Mahesh.jpg', 0),
('EMP0000004', 'Chathura', 'Udurawana', 'EJR0000002', '973216235V', '0715211325', '0775863231', '16/A, Maharaja Maawatha, Kandy Road, Aniwatte', 'chathura@yahoo.com', 'images/employee/EMP0000004Chathura.jpg', 1),
('EMP0000005', 'Mevan', 'Supeshala', 'EJR0000007', '991325641V', '0775322879', '0765899547', '15C, Nawaraja Maawatha, Bowalawaththe', 'mevan@gmail.com', 'images/employee/EMP0000005Mevan.jpg', 1),
('EMP0000006', 'John', 'Connor Jr.', 'EJR0000005', '969969750V', '0112266325', '0781122335', 'No.65, Colombo Road, Kiribathgoda', 'john@gmail.com', 'images/employee/EMP0000006JConnor.jpg', 1),
('EMP0000007', 'Thanura', 'Weerage', 'EJR0000011', '952216357V', '0771142001', '0378954125', 'Kandy Lake Side', 'thanura@gmail.com', 'images/employee/EMP0000007Thanura.jpeg', 1),
('EMP0000008', 'Sanduni', 'Dissanayake', 'EJR0000002', '982451412V', '0775411414', '0781122334', 'No.13, Athul Road, Illukwatte, Kadugannawa', 'sanduni@gmail.com', 'images/employee/EMP0000008Sanduni.jpg', 1),
('EMP0000009', 'Ariana', 'Grande', 'EJR0000002', '992451452V', '0775411414', '0772163569', 'No. 12, New Ferry Road, Horton Lands, CA.', 'ariana@gmail.com', 'images/employee/EMP0000009-ArianaGrande.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goodsrecievednote_tbl`
--

CREATE TABLE `goodsrecievednote_tbl` (
  `grn_id` char(10) NOT NULL,
  `sup_id` char(10) NOT NULL,
  `create_date` date NOT NULL,
  `user_id` char(10) NOT NULL,
  `wh_id` char(10) NOT NULL,
  `grn_ref_code` varchar(50) NOT NULL,
  `grn_due_date` date NOT NULL,
  `grn_paid_date` date DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL,
  `grn_scan_path` varchar(100) NOT NULL,
  `grn_path` varchar(500) NOT NULL,
  `grn_total_amt` varchar(50) NOT NULL,
  `grn_additionalnote` varchar(100) NOT NULL,
  `grn_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `grn_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goodsrecievednote_tbl`
--

INSERT INTO `goodsrecievednote_tbl` (`grn_id`, `sup_id`, `create_date`, `user_id`, `wh_id`, `grn_ref_code`, `grn_due_date`, `grn_paid_date`, `payment_status`, `grn_scan_path`, `grn_path`, `grn_total_amt`, `grn_additionalnote`, `grn_timestamp`, `grn_status`) VALUES
('GRN0000001', 'SUP0000003', '2021-04-19', 'USR0000001', 'WRH0000001', 'GRS2136548', '2021-05-30', '2021-05-30', 'Pending', '../../docs/grn_recieved_invoice/GRN0000001-Eligible list.pdf', '../../docs/goodsrecievednote/GRN0000001-GRS2136548.pdf', '8650000', '', '2021-04-19 03:22:18', 1),
('GRN0000002', 'SUP0000003', '2021-04-19', 'USR0000001', 'WRH0000001', 'RWD1645425', '2021-04-19', '2021-04-19', 'Paid', '../../docs/grn_recieved_invoice/GRN0000002-Eligible list.pdf', '../../docs/goodsrecievednote/GRN0000002-RWD1645425.pdf', '4300000', '', '2021-04-19 03:43:44', 1),
('GRN0000003', 'SUP0000002', '2021-04-30', 'USR0000001', 'WRH0000002', 'VYKGV5959595', '2021-05-01', '2021-05-01', 'Paid', '../../docs/grn_recieved_invoice/GRN0000003-XML-Lesson4_Stylesheets.pdf', '../../docs/goodsrecievednote/GRN0000003-VYKGV5959595.pdf', '1882400', '', '2021-04-30 20:49:34', 1),
('GRN0000004', 'SUP0000001', '2021-05-01', 'USR0000001', 'WRH0000002', 'FUKJFJK5169334', '2021-05-01', '2021-05-01', 'Paid', '../../docs/grn_recieved_invoice/GRN0000004-XML-Lesson1.pdf', '../../docs/goodsrecievednote/GRN0000004-FUKJFJK5169334.pdf', '162500', '', '2021-05-01 17:15:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grn_items_tbl`
--

CREATE TABLE `grn_items_tbl` (
  `git_id` char(10) NOT NULL,
  `grn_id` char(10) NOT NULL,
  `rm_id` char(10) NOT NULL,
  `git_rm_name` varchar(100) NOT NULL,
  `git_unit_price` float NOT NULL,
  `git_qty` varchar(100) NOT NULL,
  `git_tot_price` float NOT NULL,
  `git_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grn_items_tbl`
--

INSERT INTO `grn_items_tbl` (`git_id`, `grn_id`, `rm_id`, `git_rm_name`, `git_unit_price`, `git_qty`, `git_tot_price`, `git_status`) VALUES
('GIT0000001', 'GRN0000001', 'RMT0000003', 'Aluminium', 48000, '100', 4800000, 1),
('GIT0000002', 'GRN0000001', 'RMT0000002', 'Cast Iron', 38500, '100', 3850000, 1),
('GIT0000003', 'GRN0000002', 'RMT0000005', 'Brass', 86000, '50', 4300000, 1),
('GIT0000004', 'GRN0000003', 'RMT0000002', 'Cast Iron', 5200, '362', 1882400, 1),
('GIT0000005', 'GRN0000004', 'RMT0000004', 'Bronze', 6500, '25', 162500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items_tbl`
--

CREATE TABLE `invoice_items_tbl` (
  `init_id` char(10) NOT NULL,
  `inv_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `prod_unit_price` float NOT NULL,
  `prod_qty` float NOT NULL,
  `prod_total_price` double NOT NULL,
  `init_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_items_tbl`
--

INSERT INTO `invoice_items_tbl` (`init_id`, `inv_id`, `prod_id`, `prod_unit_price`, `prod_qty`, `prod_total_price`, `init_status`) VALUES
('IVI0000001', 'INV0000001', 'PRD0000001', 55000, 2, 110000, 1),
('IVI0000002', 'INV0000001', 'PRD0000007', 85000, 3, 255000, 1),
('IVI0000003', 'INV0000002', 'PRD0000007', 90000, 2, 180000, 1),
('IVI0000004', 'INV0000002', 'PRD0000003', 110000, 2, 220000, 1),
('IVI0000005', 'INV0000003', 'PRD0000002', 60000, 2, 120000, 1),
('IVI0000006', 'INV0000003', 'PRD0000008', 115000, 1, 115000, 1),
('IVI0000007', 'INV0000004', 'PRD0000002', 60000, 3, 180000, 1),
('IVI0000008', 'INV0000004', 'PRD0000009', 40000, 1, 40000, 1),
('IVI0000009', 'INV0000005', 'PRD0000002', 60000, 3, 180000, 1),
('IVI0000010', 'INV0000005', 'PRD0000005', 185000, 2, 370000, 1),
('IVI0000011', 'INV0000006', 'PRD0000001', 55000, 2, 110000, 1),
('IVI0000012', 'INV0000006', 'PRD0000004', 165000, 3, 495000, 1),
('IVI0000013', 'INV0000006', 'PRD0000008', 115000, 2, 230000, 1),
('IVI0000014', 'INV0000007', 'PRD0000002', 60000, 1, 60000, 1),
('IVI0000015', 'INV0000007', 'PRD0000004', 165000, 1, 165000, 1),
('IVI0000016', 'INV0000007', 'PRD0000009', 40000, 2, 80000, 1),
('IVI0000017', 'INV0000008', 'PRD0000003', 110000, 2, 220000, 0),
('IVI0000018', 'INV0000008', 'PRD0000010', 45000, 2, 90000, 0),
('IVI0000019', 'INV0000009', 'PRD0000012', 675000, 2, 1350000, 1),
('IVI0000020', 'INV0000010', 'PRD0000001', 55000, 2, 110000, 1),
('IVI0000021', 'INV0000010', 'PRD0000011', 110000, 1, 110000, 1),
('IVI0000022', 'INV0000011', 'PRD0000012', 675000, 2, 1350000, 1),
('IVI0000023', 'INV0000012', 'PRD0000012', 675000, 1, 675000, 1),
('IVI0000024', 'INV0000012', 'PRD0000006', 140000, 2, 280000, 1),
('IVI0000025', 'INV0000013', 'PRD0000001', 55000, 2, 110000, 1),
('IVI0000026', 'INV0000013', 'PRD0000005', 185000, 1, 185000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_parts_items_tbl`
--

CREATE TABLE `invoice_parts_items_tbl` (
  `pinit_id` char(10) NOT NULL,
  `p_inv_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `part_unit_price` float NOT NULL,
  `part_qty` float NOT NULL,
  `part_total_price` double NOT NULL,
  `pinit_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_parts_items_tbl`
--

INSERT INTO `invoice_parts_items_tbl` (`pinit_id`, `p_inv_id`, `part_id`, `part_unit_price`, `part_qty`, `part_total_price`, `pinit_status`) VALUES
('PVI0000001', 'PIV0000001', 'PRT0000002', 7500, 2, 15000, 0),
('PVI0000002', 'PIV0000001', 'PRT0000009', 1500, 1, 1500, 0),
('PVI0000003', 'PIV0000001', 'PRT0000008', 850, 3, 2550, 0),
('PVI0000004', 'PIV0000001', 'PRT0000014', 2150, 2, 4300, 0),
('PVI0000005', 'PIV0000002', 'PRT0000003', 4500, 2, 9000, 1),
('PVI0000006', 'PIV0000002', 'PRT0000009', 1500, 1, 1500, 1),
('PVI0000007', 'PIV0000002', 'PRT0000015', 750, 1, 750, 1),
('PVI0000008', 'PIV0000002', 'PRT0000014', 2150, 3, 6450, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_parts_tbl`
--

CREATE TABLE `invoice_parts_tbl` (
  `p_inv_id` char(10) NOT NULL,
  `cus_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `p_inv_total_price` double NOT NULL,
  `p_inv_discount` float NOT NULL,
  `p_inv_final_price` double NOT NULL,
  `payment_id` char(10) NOT NULL,
  `p_inv_date` date NOT NULL,
  `p_inv_pdf_path` varchar(1000) NOT NULL,
  `p_aod_pdf_path` varchar(1000) NOT NULL,
  `p_gio_pdf_path` varchar(1000) NOT NULL,
  `p_inv_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_parts_tbl`
--

INSERT INTO `invoice_parts_tbl` (`p_inv_id`, `cus_id`, `user_id`, `p_inv_total_price`, `p_inv_discount`, `p_inv_final_price`, `payment_id`, `p_inv_date`, `p_inv_pdf_path`, `p_aod_pdf_path`, `p_gio_pdf_path`, `p_inv_status`) VALUES
('PIV0000001', 'CUS0000004', 'USR0000001', 23350, 0, 23350, 'PAY0000032', '2021-04-25', '../../docs/part_invoice/PIV0000001-CUS0000004.pdf', '../../docs/parts_aod/AOD0000001-PIV0000001.pdf', '../../docs/parts_gio/GIO0000001-PIV0000001.pdf', 0),
('PIV0000002', 'CUS0000005', 'USR0000001', 17700, 0, 17700, 'PAY0000034', '2021-04-27', '../../docs/part_invoice/PIV0000002-CUS0000005.pdf', '../../docs/parts_aod/AOD0000002-PIV0000002.pdf', '../../docs/parts_gio/GIO0000002-PIV0000002.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `inv_id` char(10) NOT NULL,
  `cus_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `inv_total_price` double NOT NULL,
  `inv_discount` float NOT NULL,
  `inv_final_price` double NOT NULL,
  `payment_id` char(10) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_pdf_path` varchar(1000) NOT NULL,
  `aod_pdf_path` varchar(1000) NOT NULL,
  `gio_pdf_path` varchar(1000) NOT NULL,
  `inv_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`inv_id`, `cus_id`, `user_id`, `inv_total_price`, `inv_discount`, `inv_final_price`, `payment_id`, `inv_date`, `inv_pdf_path`, `aod_pdf_path`, `gio_pdf_path`, `inv_status`) VALUES
('INV0000001', 'CUS0000005', 'USR0000001', 365000, 5, 346750, 'PAY0000027', '2021-04-05', '../../docs/invoice/INV0000001-CUS0000005.pdf', '', '', 1),
('INV0000002', 'CUS0000005', 'USR0000001', 400000, 5, 380000, 'PAY0000028', '2021-04-17', '../../docs/invoice/INV0000002-CUS0000005.pdf', '', '', 1),
('INV0000003', 'CUS0000010', 'USR0000001', 235000, 5, 223250, 'PAY0000030', '2021-04-18', '../../docs/invoice/INV0000003-CUS0000010.pdf', '', '', 1),
('INV0000004', 'CUS0000007', 'USR0000001', 220000, 5, 209000, 'PAY0000031', '2021-04-18', '../../docs/invoice/INV0000004-CUS0000007.pdf', '../../docs/advice_of_dispatch/AOD0000004-INV0000004.pdf', '../../docs/goods_issued_order/GIO0000004-INV0000004.pdf', 1),
('INV0000005', 'CUS0000009', 'USR0000001', 550000, 10, 495000, 'PAY0000032', '2021-04-25', '../../docs/invoice/INV0000005-CUS0000009.pdf', '../../docs/advice_of_dispatch/AOD0000005-INV0000005.pdf', '../../docs/goods_issued_order/GIO0000005-INV0000005.pdf', 1),
('INV0000006', 'CUS0000002', 'USR0000001', 835000, 10, 751500, 'PAY0000033', '2021-04-27', '../../docs/invoice/INV0000006-CUS0000002.pdf', '../../docs/advice_of_dispatch/AOD0000006-INV0000006.pdf', '../../docs/goods_issued_order/GIO0000006-INV0000006.pdf', 1),
('INV0000007', 'CUS0000003', 'USR0000001', 305000, 5, 289750, 'PAY0000035', '2021-04-29', '../../docs/invoice/INV0000007-CUS0000003.pdf', '../../docs/advice_of_dispatch/AOD0000007-INV0000007.pdf', '../../docs/goods_issued_order/GIO0000007-INV0000007.pdf', 1),
('INV0000008', 'CUS0000006', 'USR0000001', 310000, 10, 279000, 'PAY0000036', '2021-05-01', '../../docs/invoice/INV0000008-CUS0000006.pdf', '../../docs/advice_of_dispatch/AOD0000008-INV0000008.pdf', '../../docs/goods_issued_order/GIO0000008-INV0000008.pdf', 0),
('INV0000009', 'CUS0000001', 'USR0000001', 1350000, 15, 1147500, 'PAY0000037', '2021-05-02', '../../docs/invoice/INV0000009-CUS0000001.pdf', '../../docs/advice_of_dispatch/AOD0000009-INV0000009.pdf', '../../docs/goods_issued_order/GIO0000009-INV0000009.pdf', 1),
('INV0000010', 'CUS0000002', 'USR0000001', 220000, 5, 209000, 'PAY0000038', '2021-05-02', '../../docs/invoice/INV0000010-CUS0000002.pdf', '../../docs/advice_of_dispatch/AOD0000010-INV0000010.pdf', '../../docs/goods_issued_order/GIO0000010-INV0000010.pdf', 1),
('INV0000011', 'CUS0000003', 'USR0000001', 1350000, 5, 1282500, 'PAY0000039', '2021-05-03', '../../docs/invoice/INV0000011-CUS0000003.pdf', '../../docs/advice_of_dispatch/AOD0000011-INV0000011.pdf', '../../docs/goods_issued_order/GIO0000011-INV0000011.pdf', 1),
('INV0000012', 'CUS0000012', 'USR0000004', 955000, 15, 811750, 'PAY0000040', '2021-05-03', '../../docs/invoice/INV0000012-CUS0000012.pdf', '../../docs/advice_of_dispatch/AOD0000012-INV0000012.pdf', '../../docs/goods_issued_order/GIO0000012-INV0000012.pdf', 1),
('INV0000013', 'CUS0000005', 'USR0000004', 295000, 5, 280250, 'PAY0000041', '2021-05-03', '../../docs/invoice/INV0000013-CUS0000005.pdf', '../../docs/advice_of_dispatch/AOD0000013-INV0000013.pdf', '../../docs/goods_issued_order/GIO0000013-INV0000013.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mail_log`
--

CREATE TABLE `mail_log` (
  `mail_id` char(10) NOT NULL,
  `po_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `sup_id` char(10) NOT NULL,
  `recipient_address` varchar(1000) NOT NULL,
  `mail_attachment` varchar(500) NOT NULL,
  `mail_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mail_log`
--

INSERT INTO `mail_log` (`mail_id`, `po_id`, `user_id`, `sup_id`, `recipient_address`, `mail_attachment`, `mail_status`) VALUES
('MLT0000001', 'PCO0000001', 'USR0000001', 'SUP0000002', 'tesco@testmail.com', '../../docs/purchase_orders/PCO0000001-RQS0000011.pdf', 1),
('MLT0000002', 'PCO0000001', 'USR0000001', 'SUP0000002', 'tesco@testmail.com', '../../docs/purchase_orders/PCO0000001-RQS0000011.pdf', 1),
('MLT0000003', 'PCO0000003', 'USR0000001', 'SUP0000003', 'asirielectricals@testmail.com', '../../docs/purchase_orders/PCO0000003-RQS0000012.pdf', 1),
('MLT0000004', 'PCO0000004', 'USR0000001', 'SUP0000001', 'suranga@testmail.com', '../../docs/purchase_orders/PCO0000004-RQS0000015.pdf', 1),
('MLT0000005', 'PCO0000003', 'USR0000001', 'SUP0000003', 'asirielectricals@testmail.com', '../../docs/purchase_orders/PCO0000003-RQS0000012.pdf', 1),
('MLT0000006', 'PCO0000006', 'USR0000002', 'SUP0000001', 'suranga@testmail.com', '../../docs/purchase_orders/PCO0000006-RQS0000020.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `notif_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `rqst_type` varchar(500) NOT NULL,
  `notif_title` varchar(200) NOT NULL,
  `notif_body` varchar(4000) NOT NULL,
  `notif_rqst_stt` varchar(100) NOT NULL DEFAULT 'Pending',
  `notif_date` varchar(200) NOT NULL,
  `notif_accepted_date` varchar(500) NOT NULL,
  `set_date` char(10) NOT NULL,
  `notif_show_status` varchar(100) NOT NULL DEFAULT 'show',
  `acc_date` char(10) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`notif_id`, `rqst_id`, `user_id`, `rqst_type`, `notif_title`, `notif_body`, `notif_rqst_stt`, `notif_date`, `notif_accepted_date`, `set_date`, `notif_show_status`, `acc_date`, `notif_status`) VALUES
('NTF0000002', 'RQS0000002', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Chathura Udurawana', 'Request includes production request of (UG7-3) Grinding Machine No.07</br> Specifications :</br>3HP E/Motor</br>A quantity of 5, with Low urgency level. (UG7/UD15-3) Multi-Purpose Grinding Machine (7-15)</br> Specifications :</br>3HP E/Motor</br>A quantity of 6, with High urgency level. ', 'Declined', '2021-04-06 @ 09:00:38am', '2021-05-02 @ 11:39:33pm', '2021-04-06', 'show', '2021-05-02', 1),
('NTF0000003', 'RQS0000003', 'USR0000001', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Ariana Grande', 'Request includes part production request of (SPG07-0014) Steel Hopper of Grinding Machine No.07 (2HP) with a quantity of 15, with Low urgency level. (SPG07-0004 ) Bracket of Grinding Machine No.07 (2HP) with a quantity of 20, with High urgency level. (SPG07-0010 ) Motor Pulley A 4”  of Grinding Machine No.07 (2HP) with a quantity of 20, with High urgency level. ', 'Confirmed', '2021-04-06 @ 10:33:43am', '2021-04-17 @ 08:46:11pm', '2021-04-06', 'show', '2021-04-06', 1),
('NTF0000004', 'RQS0000004', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Sanduni Dissanayake', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 4, with Low urgency level. ', 'Confirmed', '2021-04-17 @ 09:59:24pm', '2021-04-17 @ 11:54:50pm', '2021-04-17', 'show', '2021-04-17', 1),
('NTF0000005', 'RQS0000005', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Chathura Udurawana', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 3, with Low urgency level. ', 'Confirmed', '2021-04-19 @ 01:06:46am', '2021-04-19 @ 09:32:20am', '2021-04-19', 'show', '2021-04-19', 1),
('NTF0000007', 'RQS0000007', 'USR0000001', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Sanduni Dissanayake', 'Request includes part production request of (SPG07-0010 ) Motor Pulley A 4”  of Grinding Machine No.07 (2HP) with a quantity of 4, with Low urgency level. (SPG07-0006) Main Shaft of Grinding Machine No.07 (2HP) with a quantity of 5, with Low urgency level. ', 'Confirmed', '2021-04-23 @ 04:04:13pm', '2021-04-26 @ 12:07:32am', '2021-04-23', 'show', '2021-04-26', 1),
('NTF0000008', 'RQS0000008', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Ariana Grande', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 1, with Medium urgency level. ', 'Confirmed', '2021-04-23 @ 04:39:38pm', '2021-04-23 @ 05:01:22pm', '2021-04-23', 'show', '2021-04-23', 1),
('NTF0000009', 'RQS0000009', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Ariana Grande', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 2, with Low urgency level. ', 'Pending', '2021-04-24 @ 11:59:25pm', '', '2021-04-24', 'show', '', 1),
('NTF0000010', 'RQS0000010', 'USR0000001', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Ariana Grande', 'Request includes part production request of (SPG07-0017) Brass Bush For Bracket (34mm) of Grinding Machine No.07 (2HP) with a quantity of 20, with High urgency level. (SPG07-0018) Brass Bush For Housing (54mm) of Grinding Machine No.07 (2HP) with a quantity of 20, with High urgency level. (USPRI-0009) Spring No.09 of Grinding Machine No.07 (2HP) with a quantity of 100, with High urgency level. ', 'Confirmed', '2021-04-25 @ 12:08:32am', '2021-04-26 @ 12:03:08am', '2021-04-25', 'show', '2021-04-26', 1),
('NTF0000011', 'RQS0000011', 'USR0000001', 'RM-REQUEST', 'New Raw Material Request From Chathura Udurawana', 'Request includes raw materials of Cast Iron from Tesco & Co Ltd with a quantity of 150 load(s), with High urgency level. Aluminium from Tesco & Co Ltd with a quantity of 80 load(s), with High urgency level. ', 'Confirmed', '2021-04-25 @ 03:28:16pm', '2021-04-25 @ 03:32:43pm', '2021-04-25', 'show', '2021-04-25', 1),
('NTF0000012', 'RQS0000012', 'USR0000001', 'RM-REQUEST', 'New Raw Material Request From Chathura Udurawana', 'Request includes raw materials of Bronze from Suranga Crushers with a quantity of 150 load(s), with High urgency level. Brass from Asiri Tradings PTV Ltd with a quantity of 100 load(s), with Medium urgency level. ', 'Confirmed', '2021-04-25 @ 03:30:16pm', '2021-04-25 @ 03:33:35pm', '2021-04-25', 'show', '2021-04-25', 1),
('NTF0000013', 'RQS0000013', 'USR0000001', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Sanduni Dissanayake', 'Request includes part production request of (SPG07-0005) Feed Controlling Gate of Grinding Machine No.07 (2HP) with a quantity of 7, with Medium urgency level. (SPG07-0001) Bass Frame of Grinding Machine No.07 (2HP) with a quantity of 3, with Medium urgency level. ', 'Confirmed', '2021-04-26 @ 12:18:11am', '2021-05-03 @ 02:49:59am', '2021-04-26', 'show', '2021-05-03', 1),
('NTF0000014', 'RQS0000014', 'USR0000001', 'PRODUCTION-REQUEST', 'New Production Request From Sanduni Dissanayake', 'Request includes production request of (UVCO-5) Virgin Coconut Oil Expeller</br> Specifications :</br>5HP E/Motor</br>A quantity of 5, with Medium urgency level. ', 'Confirmed', '2021-05-03 @ 02:17:30am', '2021-05-03 @ 02:23:30am', '2021-05-03', 'show', '2021-05-03', 1),
('NTF0000015', 'RQS0000015', 'USR0000001', 'RM-REQUEST', 'New Raw Material Request From Sanduni Dissanayake', 'Request includes raw materials of Copper from Suranga Crushers with a quantity of 100 load(s), with Medium urgency level. Zinc from Tesco & Co Ltd with a quantity of 200 load(s), with Medium urgency level. ', 'Confirmed', '2021-05-03 @ 02:52:07am', '2021-05-03 @ 02:52:42am', '2021-05-03', 'show', '2021-05-03', 1),
('NTF0000016', 'RQS0000016', 'USR0000003', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Sanduni Dissanayake', 'Request includes part production request of (SPVCO-0001) V.C.O. Housing of Virgin Coconut Oil Expeller (5HP) with a quantity of 10, with Medium urgency level. (SPVCO-0005) V.C.O. Stainless Steel Hopper of Virgin Coconut Oil Expeller (5HP) with a quantity of 5, with High urgency level. ', 'Confirmed', '2021-05-03 @ 12:56:21pm', '2021-05-03 @ 01:11:22pm', '2021-05-03', 'hide', '2021-05-03', 1),
('NTF0000017', 'RQS0000017', 'USR0000003', 'PRODUCTION-REQUEST', 'New Production Request From Sanduni Dissanayake', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 3, with Low urgency level. ', 'Pending', '2021-05-03 @ 08:32:10pm', '', '2021-05-03', 'show', '', 1),
('NTF0000018', 'RQS0000018', 'USR0000003', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Sanduni Dissanayake', 'Request includes part production request of (SPG07-0017) Brass Bush For Bracket (34mm) of Grinding Machine No.07 (2HP) with a quantity of 30, with Medium urgency level. (SPG07-0018) Brass Bush For Housing (54mm) of Grinding Machine No.07 (2HP) with a quantity of 30, with Medium urgency level. (USPRI-0009) Spring No.09 of Grinding Machine No.07 (2HP) with a quantity of 100, with Medium urgency level. ', 'Confirmed', '2021-05-03 @ 08:36:42pm', '2021-05-03 @ 08:41:15pm', '2021-05-03', 'hide', '2021-05-03', 1),
('NTF0000019', 'RQS0000019', 'USR0000004', 'PRODUCTION-REQUEST', 'New Production Request From Ariana Grande', 'Request includes production request of (UG7-2) Grinding Machine No.07</br> Specifications :</br>2HP E/Motor</br>A quantity of 3, with Medium urgency level. ', 'Confirmed', '2021-05-03 @ 09:18:42pm', '2021-05-03 @ 09:21:16pm', '2021-05-03', 'show', '2021-05-03', 1),
('NTF0000020', 'RQS0000020', 'USR0000004', 'RM-REQUEST', 'New Raw Material Request From Ariana Grande', 'Request includes raw materials of Copper from Suranga Crushers with a quantity of 120 load(s), with Medium urgency level. Brass from Tensa Holdings with a quantity of 60 load(s), with High urgency level. ', 'Confirmed', '2021-05-03 @ 09:28:00pm', '2021-05-03 @ 09:28:28pm', '2021-05-03', 'show', '2021-05-03', 1),
('NTF0000021', 'RQS0000021', 'USR0000003', 'PART-PRODUCTION-REQUEST', 'New Part Production Request From Sanduni Dissanayake', 'Request includes part production request of (SPG07-0003) Outlet of Grinding Machine No.07 (2HP) with a quantity of 4, with Medium urgency level. ', 'Pending', '2021-05-03 @ 10:24:04pm', '', '2021-05-03', 'show', '', 1),
('NTF0000022', 'RQS0000022', 'USR0000003', 'PRODUCTION-REQUEST', 'New Production Request From Sanduni Dissanayake', 'Request includes production request of (UVCO-5) Virgin Coconut Oil Expeller</br> Specifications :</br>5HP E/Motor</br>A quantity of 2, with High urgency level. ', 'Pending', '2021-05-03 @ 10:41:47pm', '', '2021-05-03', 'show', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parts_tbl`
--

CREATE TABLE `parts_tbl` (
  `part_id` char(10) NOT NULL,
  `part_code` varchar(150) NOT NULL,
  `part_name` varchar(100) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `part_weight` float NOT NULL,
  `part_w_unit` char(4) NOT NULL,
  `part_desc` varchar(500) NOT NULL,
  `part_unit_price` float NOT NULL,
  `part_reorder_level` float NOT NULL,
  `part_img_path` varchar(100) NOT NULL,
  `part_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts_tbl`
--

INSERT INTO `parts_tbl` (`part_id`, `part_code`, `part_name`, `prod_id`, `part_weight`, `part_w_unit`, `part_desc`, `part_unit_price`, `part_reorder_level`, `part_img_path`, `part_status`) VALUES
('PRT0000001', 'SPG07-0001', 'Bass Frame', 'PRD0000001', 37.8, 'kg', '', 4500, 20, '../../images/part/PRT0000001-Base Frame.png', 1),
('PRT0000002', 'SPG07-0002', 'Housing', 'PRD0000001', 79.58, 'kg', '', 7500, 10, '../../images/part/PRT0000002-Housing.png', 1),
('PRT0000003', 'SPG07-0003', 'Outlet', 'PRD0000001', 68.5, 'kg', '', 4500, 10, '../../images/part/PRT0000003-Outlet.png', 1),
('PRT0000004', 'SPG07-0004 ', 'Bracket', 'PRD0000001', 86.52, 'kg', '', 2000, 10, '../../images/part/PRT0000004-Bracket.png', 1),
('PRT0000005', 'SPG07-0005', 'Feed Controlling Gate', 'PRD0000001', 2.85, 'kg', '', 500, 30, '../../images/part/PRT0000005-Feed Controlling Gate.png', 1),
('PRT0000006', 'SPG07-0006', 'Main Shaft', 'PRD0000001', 5.86, 'kg', '', 4500, 15, '../../images/part/PRT0000006-Main Shaft.png', 1),
('PRT0000007', 'SPG07-0007', 'Pressure Bolt', 'PRD0000001', 450, 'g', '', 1000, 150, '../../images/part/PRT0000007-Pressure Bolt.png', 1),
('PRT0000008', 'SPG07-0008', 'Lock Handle', 'PRD0000001', 1.86, 'kg', '', 850, 80, '../../images/part/PRT0000008-Lock Handle.png', 1),
('PRT0000009', 'SPG07-0009', 'Grinding Plate', 'PRD0000001', 12.3, 'kg', '', 1500, 50, '../../images/part/PRT0000009-Grinding Plate.png', 1),
('PRT0000010', 'SPG07-0010 ', 'Motor Pulley A 4” ', 'PRD0000001', 4.72, 'kg', '', 1100, 50, '../../images/part/PRT0000010-Motor Pulley A 4-inch.png', 1),
('PRT0000011', 'SPG07-0011', 'Motor Pulley A 7\"', 'PRD0000001', 5.85, 'kg', '', 1900, 40, '../../images/part/PRT0000011-Motor Pulley A 7-inch.png', 1),
('PRT0000012', 'SPG07-0012', 'Steel Ball 3/4\"', 'PRD0000001', 65, 'g', '', 300, 200, '../../images/part/PRT0000012-Steel Ball 3quarter-inch.png', 1),
('PRT0000013', 'SPG07-0013', 'Collar Of Main Shaft', 'PRD0000001', 30, 'g', '', 400, 500, '../../images/part/PRT0000013-Collar of Main Shaft.png', 1),
('PRT0000014', 'SPG07-0014', 'Steel Hopper', 'PRD0000001', 2.7, 'kg', '', 2150, 30, '../../images/part/PRT0000014-Steel Hopper.png', 1),
('PRT0000015', 'SPG07-0017', 'Brass Bush For Bracket (34mm)', 'PRD0000001', 130, 'g', '', 750, 250, '../../images/part/PRT0000015-Bass Bush For Bracket (34mm).png', 1),
('PRT0000016', 'SPG07-0018', 'Brass Bush For Housing (54mm)', 'PRD0000001', 180, 'g', '', 950, 200, '../../images/part/PRT0000016-Brass Bush For Housing (54mm).png', 1),
('PRT0000017', 'USPRI-0009', 'Spring No.09', 'PRD0000001', 16, 'g', '', 250, 500, '../../images/part/PRT0000017-Spring No.09.png', 1),
('PRT0000018', 'UGREA-0003', 'Grease Cup No.03 (1/4\") ', 'PRD0000001', 200, 'g', '', 300, 500, '../../images/part/PRT0000018-Grease Cup No.03 (quarter-inch).png', 1),
('PRT0000019', 'OEEM-0002', '2HP Motor (Single Phase)', 'PRD0000001', 38.8, 'kg', '', 21500, 100, '../../images/part/PRT0000019-2HP Motor Single Phase.png', 1),
('PRT0000020', 'SPVCO-0001', 'V.C.O. Housing', 'PRD0000012', 22.5, 'kg', '', 0.185, 20, '../../images/part/PRT0000020-Housing.png', 1),
('PRT0000021', 'SPVCO-0002', 'V.C.O. Filter Unit', 'PRD0000012', 5.6, 'kg', '', 7250, 25, '../../images/part/PRT0000021-FilterUnit.png', 1),
('PRT0000022', 'SPVCO-0003', 'V.C.O. Sleeve', 'PRD0000012', 5.2, 'kg', '', 7250, 30, '../../images/part/PRT0000022-Sleeve.png', 1),
('PRT0000023', 'SPVCO-0004', 'V.C.O. Bearing End Cap 4”', 'PRD0000012', 5.8, 'kg', '', 8000, 15, '../../images/part/PRT0000023-BearingEndCap(4).png', 1),
('PRT0000024', 'SPVCO-0005', 'V.C.O. Stainless Steel Hopper', 'PRD0000012', 5.1, 'kg', '', 15800, 20, '../../images/part/PRT0000024-StainlessSteelHopper.png', 1),
('PRT0000025', 'SPVCO-0006', 'V.C.O. Cooling Unit', 'PRD0000012', 3.9, 'kg', '', 8750, 20, '../../images/part/PRT0000025-CoolingUnit.png', 1),
('PRT0000026', 'SPVCO-0007', 'V.C.O. Lock Nut', 'PRD0000012', 350, 'g', '', 2750, 50, '../../images/part/PRT0000026-LockNut.png', 1),
('PRT0000027', 'SPVCO-0008', 'V.C.O. Bearing End Cap 5”', 'PRD0000012', 7.5, 'kg', '', 9850, 10, '../../images/part/PRT0000027-BearingEndCap(5).png', 1),
('PRT0000028', 'SPVCO-0009', 'V.C.O Warm Shaft', 'PRD0000012', 4.8, 'kg', '', 7650, 20, '../../images/part/PRT0000028-WarmShaft.png', 1),
('PRT0000029', 'SPVCO-0010', 'V.C.O. Holder', 'PRD0000012', 8.74, 'kg', '', 24000, 10, '../../images/part/PRT0000029-Holder.png', 1),
('PRT0000030', 'SPVCO-0011', 'V.C.O. Gear Wheel 82 Teeth', 'PRD0000012', 3.25, 'kg', '', 8400, 20, '../../images/part/PRT0000030-GearWheelTeeth82(34mm).png', 1),
('PRT0000031', 'SPVCO-0012', 'V.C.O. Gear Wheel 23 Teeth', 'PRD0000012', 3.4, 'kg', '', 5400, 20, '../../images/part/PRT0000031-GearWheelTeeth82(64mm).png', 1),
('PRT0000032', 'SPVCO-0013', 'V.C.O. Idle Gear Wheel', 'PRD0000012', 1.08, 'kg', '', 1750, 50, '../../images/part/PRT0000032-IdleGearWheel.png', 1),
('PRT0000033', 'SPVCO-0014', 'V.C.O. Rachet Set', 'PRD0000012', 2.7, 'kg', '', 3500, 20, '../../images/part/PRT0000033-RachetSet.png', 1),
('PRT0000034', 'SPVCO-0015', 'V.C.O. Main Shaft', 'PRD0000012', 3.8, 'kg', '', 12500, 20, '../../images/part/PRT0000034-MainShaft.png', 1),
('PRT0000035', 'SPVCO-0016', 'V.C.O. Rachet Shaft', 'PRD0000012', 8.1, 'kg', '', 10500, 20, '../../images/part/PRT0000035-RachetShaft.png', 1),
('PRT0000036', 'SPVCO-0017', 'V.C.O. Outlet', 'PRD0000012', 1.05, 'kg', '', 3500, 30, '../../images/part/PRT0000036-OutletChute.png', 1),
('PRT0000037', 'SPVCO-0018', 'V.C.O Star Nipple', 'PRD0000012', 500, 'g', '', 3750, 30, '../../images/part/PRT0000037-StarPoint.png', 1),
('PRT0000038', 'SPVCO-0019', 'V.C.O. Rachet Lock Nut', 'PRD0000012', 1.75, 'kg', '', 3000, 20, '../../images/part/PRT0000038-RachetLockNut.png', 1),
('PRT0000039', 'SPVCO-0020', 'V.C.O. Machine Pulley A3 10\"', 'PRD0000012', 5.85, 'kg', '', 8750, 10, '../../images/part/PRT0000039-PulleyA3(10).png', 1),
('PRT0000040', 'SPVCO-0021', 'V.C.O. Machine Pulley A3 4\"', 'PRD0000012', 2.24, 'kg', '', 5750, 20, '../../images/part/PRT0000040-PulleyA3(4).png', 1),
('PRT0000041', 'UVBLA-0059', 'V.C.O. V Belt A-78', 'PRD0000012', 300, 'g', '', 1250, 20, '../../images/part/PRT0000041-VBeltA78.png', 1),
('PRT0000042', 'USNMT-0001', 'V.C.O. Temperature Sensor K Type', 'PRD0000012', 750, 'g', '', 750, 50, '../../images/part/PRT0000042-TemperatureSensorKType.png', 1),
('PRT0000043', 'UOLSL-0014', 'V.C.O. Oil Seal 30-45-8', 'PRD0000012', 450, 'g', '', 350, 50, '../../images/part/PRT0000043-OilSeal(30-45-8).png', 1),
('PRT0000044', 'UOLSL-0030', 'V.C.O. Oil Seal 55-78-12', 'PRD0000012', 850, 'g', '', 1200, 50, '../../images/part/PRT0000044-OilSeal(55-78-12).png', 1),
('PRT0000045', 'UBRTR-0004 ', 'V.C.O. Bearing Taper Roller 30305', 'PRD0000012', 3.2, 'kg', '', 3000, 15, '../../images/part/PRT0000045-Bearing30-305.png', 1),
('PRT0000046', 'UBREN-0035', 'V.C.O. Bearing 6206 ZZ', 'PRD0000012', 3.8, 'kg', '', 3500, 15, '../../images/part/PRT0000046-Bearing6206zz.png', 1),
('PRT0000047', 'UBREN-0041', 'V.C.O. Bearing 6211 ZZ', 'PRD0000012', 3.2, 'kg', '', 3500, 15, '../../images/part/PRT0000047-Bearing6211zz.png', 1),
('PRT0000048', 'UBREN-0047 ', 'V.C.O. Bearing 6305 ZZ', 'PRD0000012', 3.5, 'kg', '', 7800, 15, '../../images/part/PRT0000048-Bearing6305zz.png', 1),
('PRT0000049', 'UBRTH-0008', 'V.C.O. Bearing Thrust O-12', 'PRD0000012', 5.6, 'kg', '', 3850, 15, '../../images/part/PRT0000049-Bearing0-12Thrust.png', 1),
('PRT0000050', 'OEEM-0005', '5HP Motor (Single Phase)', 'PRD0000012', 48.5, 'kg', '', 45000, 20, '../../images/part/PRT0000050-Motor(5HP).png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `part_prod_tbl`
--

CREATE TABLE `part_prod_tbl` (
  `ptpr_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `part_qty` float NOT NULL,
  `ptpr_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_prod_tbl`
--

INSERT INTO `part_prod_tbl` (`ptpr_id`, `prod_id`, `part_id`, `part_qty`, `ptpr_status`) VALUES
('PPR0000001', 'PRD0000001', 'PRT0000001', 1, 1),
('PPR0000002', 'PRD0000001', 'PRT0000002', 1, 1),
('PPR0000003', 'PRD0000001', 'PRT0000003', 1, 1),
('PPR0000004', 'PRD0000001', 'PRT0000004', 1, 1),
('PPR0000005', 'PRD0000001', 'PRT0000005', 1, 1),
('PPR0000006', 'PRD0000001', 'PRT0000006', 2, 1),
('PPR0000007', 'PRD0000001', 'PRT0000007', 2, 1),
('PPR0000008', 'PRD0000001', 'PRT0000008', 1, 1),
('PPR0000009', 'PRD0000001', 'PRT0000009', 1, 1),
('PPR0000010', 'PRD0000001', 'PRT0000010', 1, 1),
('PPR0000011', 'PRD0000001', 'PRT0000011', 1, 1),
('PPR0000012', 'PRD0000001', 'PRT0000012', 1, 1),
('PPR0000013', 'PRD0000001', 'PRT0000013', 1, 1),
('PPR0000014', 'PRD0000001', 'PRT0000014', 1, 1),
('PPR0000015', 'PRD0000001', 'PRT0000015', 4, 1),
('PPR0000016', 'PRD0000001', 'PRT0000016', 4, 1),
('PPR0000017', 'PRD0000001', 'PRT0000017', 6, 1),
('PPR0000018', 'PRD0000001', 'PRT0000018', 1, 1),
('PPR0000019', 'PRD0000001', 'PRT0000019', 1, 1),
('PPR0000020', 'PRD0000012', 'PRT0000020', 1, 1),
('PPR0000021', 'PRD0000012', 'PRT0000021', 1, 1),
('PPR0000022', 'PRD0000012', 'PRT0000022', 2, 1),
('PPR0000023', 'PRD0000012', 'PRT0000023', 1, 1),
('PPR0000024', 'PRD0000012', 'PRT0000024', 1, 1),
('PPR0000025', 'PRD0000012', 'PRT0000025', 2, 1),
('PPR0000026', 'PRD0000012', 'PRT0000026', 1, 1),
('PPR0000027', 'PRD0000012', 'PRT0000027', 1, 1),
('PPR0000028', 'PRD0000012', 'PRT0000028', 1, 1),
('PPR0000029', 'PRD0000012', 'PRT0000029', 1, 1),
('PPR0000030', 'PRD0000012', 'PRT0000030', 2, 1),
('PPR0000031', 'PRD0000012', 'PRT0000031', 3, 1),
('PPR0000032', 'PRD0000012', 'PRT0000032', 2, 1),
('PPR0000033', 'PRD0000012', 'PRT0000033', 2, 1),
('PPR0000034', 'PRD0000012', 'PRT0000034', 1, 1),
('PPR0000035', 'PRD0000012', 'PRT0000035', 1, 1),
('PPR0000036', 'PRD0000012', 'PRT0000036', 2, 1),
('PPR0000037', 'PRD0000012', 'PRT0000037', 1, 1),
('PPR0000038', 'PRD0000012', 'PRT0000038', 2, 1),
('PPR0000039', 'PRD0000012', 'PRT0000039', 1, 1),
('PPR0000040', 'PRD0000012', 'PRT0000040', 2, 1),
('PPR0000041', 'PRD0000012', 'PRT0000041', 1, 1),
('PPR0000042', 'PRD0000012', 'PRT0000042', 1, 1),
('PPR0000043', 'PRD0000012', 'PRT0000043', 4, 1),
('PPR0000044', 'PRD0000012', 'PRT0000044', 4, 1),
('PPR0000045', 'PRD0000012', 'PRT0000045', 2, 1),
('PPR0000046', 'PRD0000012', 'PRT0000046', 2, 1),
('PPR0000047', 'PRD0000012', 'PRT0000047', 2, 1),
('PPR0000048', 'PRD0000012', 'PRT0000048', 2, 1),
('PPR0000049', 'PRD0000012', 'PRT0000049', 2, 1),
('PPR0000050', 'PRD0000012', 'PRT0000050', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `payment_id` char(10) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_amount` double NOT NULL,
  `payment_cardreceipt` varchar(100) NOT NULL,
  `payment_chequeNo` varchar(100) NOT NULL,
  `payment_chequeDate` date DEFAULT NULL,
  `payment_status` int(1) NOT NULL DEFAULT 1,
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `payment_type`, `payment_amount`, `payment_cardreceipt`, `payment_chequeNo`, `payment_chequeDate`, `payment_status`, `payment_time`) VALUES
('PAY0000026', 'cash', 190000, '', '', '0000-00-00', 1, '2021-03-22 06:40:33'),
('PAY0000027', 'cash', 346750, '', '', '0000-00-00', 1, '2021-04-05 03:26:16'),
('PAY0000028', 'cash', 380000, '', '', '0000-00-00', 1, '2021-04-17 15:19:42'),
('PAY0000029', 'card', 223250, '', '', '0000-00-00', 1, '2021-04-17 19:12:30'),
('PAY0000030', 'card', 223250, 'T124563258', '', '0000-00-00', 1, '2021-04-17 19:14:49'),
('PAY0000031', 'card', 209000, 'T321658425', '', '0000-00-00', 1, '2021-04-17 20:38:27'),
('PAY0000032', 'cash', 23350, '', '', '0000-00-00', 1, '2021-04-25 18:26:49'),
('PAY0000033', 'card', 751500, 'CDR00121058', '', '0000-00-00', 1, '2021-04-27 06:35:12'),
('PAY0000034', 'cash', 17700, '', '', '0000-00-00', 1, '2021-04-27 06:35:46'),
('PAY0000035', 'cash', 289750, '', '', '0000-00-00', 1, '2021-04-29 08:15:21'),
('PAY0000036', 'cash', 279000, '', '', '0000-00-00', 1, '2021-05-01 15:53:15'),
('PAY0000037', 'cash', 1147500, '', '', '0000-00-00', 1, '2021-05-02 17:20:40'),
('PAY0000038', 'card', 209000, 'TRGED8856586', '', '0000-00-00', 1, '2021-05-02 17:21:45'),
('PAY0000039', 'card', 1282500, 'TREUJD088844564', '', '0000-00-00', 1, '2021-05-02 20:40:49'),
('PAY0000040', 'cheque', 811750, '', '258-148-752', '2021-06-04', 1, '2021-05-03 09:26:49'),
('PAY0000041', 'cash', 280250, '', '', '0000-00-00', 1, '2021-05-03 09:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `prd_production_history_tbl`
--

CREATE TABLE `prd_production_history_tbl` (
  `pph_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `prod_pre_qty` double NOT NULL,
  `prod_qty` double NOT NULL,
  `prod_post_qty` double NOT NULL,
  `pph_date` date NOT NULL,
  `pph_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pph_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prd_production_history_tbl`
--

INSERT INTO `prd_production_history_tbl` (`pph_id`, `rqst_id`, `emp_id`, `user_id`, `prod_id`, `prod_pre_qty`, `prod_qty`, `prod_post_qty`, `pph_date`, `pph_timestamp`, `pph_status`) VALUES
('PPH0000001', '', 'EMP0000004', 'USR0000001', 'PRD0000006', 2, 10, 12, '2021-04-06', '2021-04-06 05:12:21', 1),
('PPH0000002', '', 'EMP0000004', 'USR0000001', 'PRD0000004', 12, 15, 27, '2021-04-06', '2021-04-06 05:12:21', 1),
('PPH0000003', '', 'EMP0000001', 'USR0000001', 'PRD0000001', 0, 10, 10, '2021-04-18', '2021-04-18 17:42:45', 1),
('PPH0000004', '', 'EMP0000001', 'USR0000001', 'PRD0000002', 8, 10, 18, '2021-04-18', '2021-04-18 17:42:45', 1),
('PPH0000005', '', 'EMP0000001', 'USR0000001', 'PRD0000003', 18, 15, 33, '2021-04-18', '2021-04-18 17:42:45', 1),
('PPH0000006', '', 'EMP0000001', 'USR0000001', 'PRD0000004', 27, 5, 32, '2021-04-18', '2021-04-18 17:42:45', 1),
('PPH0000007', '', 'EMP0000001', 'USR0000001', 'PRD0000005', 38, 3, 41, '2021-04-18', '2021-04-18 17:42:45', 1),
('PPH0000008', '', 'EMP0000008', 'USR0000001', 'PRD0000006', 12, 8, 20, '2021-04-24', '2021-04-24 16:53:55', 1),
('PPH0000009', '', 'EMP0000004', 'USR0000001', 'PRD0000001', 10, 10, 20, '2021-04-27', '2021-04-27 06:32:30', 1),
('PPH0000010', '', 'EMP0000004', 'USR0000001', 'PRD0000002', 15, 10, 25, '2021-04-27', '2021-04-27 06:32:30', 1),
('PPH0000011', '', 'EMP0000004', 'USR0000001', 'PRD0000003', 33, 10, 43, '2021-04-27', '2021-04-27 06:32:30', 1),
('PPH0000012', '', 'EMP0000004', 'USR0000001', 'PRD0000004', 32, 10, 42, '2021-04-27', '2021-04-27 06:32:30', 1),
('PPH0000013', '', 'EMP0000004', 'USR0000001', 'PRD0000006', 20, 5, 25, '2021-04-27', '2021-04-27 06:32:30', 1),
('PPH0000014', '', 'EMP0000004', 'USR0000001', 'PRD0000001', 20, 10, 30, '2021-04-27', '2021-04-27 06:32:40', 1),
('PPH0000015', '', 'EMP0000004', 'USR0000001', 'PRD0000002', 25, 10, 35, '2021-04-27', '2021-04-27 06:32:40', 1),
('PPH0000016', '', 'EMP0000004', 'USR0000001', 'PRD0000006', 25, 5, 30, '2021-04-27', '2021-04-27 06:32:40', 1),
('PPH0000017', '', 'EMP0000004', 'USR0000001', 'PRD0000001', 30, 10, 40, '2021-04-27', '2021-04-27 06:32:51', 1),
('PPH0000018', '', 'EMP0000004', 'USR0000001', 'PRD0000002', 35, 10, 45, '2021-04-27', '2021-04-27 06:32:51', 1),
('PPH0000019', '', 'EMP0000004', 'USR0000001', 'PRD0000006', 30, 5, 35, '2021-04-27', '2021-04-27 06:32:51', 1),
('PPH0000020', '', 'EMP0000004', 'USR0000001', 'PRD0000001', 40, 10, 50, '2021-04-27', '2021-04-27 06:32:55', 1),
('PPH0000021', 'RQS0000014', 'EMP0000008', 'USR0000001', 'PRD0000012', 11, 5, 16, '2021-05-03', '2021-05-02 22:01:56', 1),
('PPH0000022', '', 'EMP0000008', 'USR0000001', 'PRD0000012', 16, 4, 20, '2021-05-03', '2021-05-02 22:43:44', 1),
('PPH0000023', '', 'EMP0000008', 'USR0000003', 'PRD0000001', 44, 5, 49, '2021-05-03', '2021-05-03 10:05:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_diagnosis_tbl`
--

CREATE TABLE `product_diagnosis_tbl` (
  `diag_id` char(10) NOT NULL,
  `cus_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `cus_statement` varchar(100) NOT NULL,
  `inital_d_statement` varchar(100) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL,
  `diag_uploaded_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diag_check_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `diag_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_diagnosis_tbl`
--

INSERT INTO `product_diagnosis_tbl` (`diag_id`, `cus_id`, `prod_id`, `cus_statement`, `inital_d_statement`, `img_1`, `img_2`, `diag_uploaded_date`, `diag_check_status`, `diag_status`) VALUES
('PDD0000001', 'CUS0000004', 'PRD0000004', 'Inital Cust', 'Initial Defect', '../../images/product_diagnosis/PDD0000001/PDD0000001-Lock Handle.png', '../../images/product_diagnosis/PDD0000001/PDD0000001-Motor Pulley A 4-inch.png', '2021-04-20 18:30:22', 'Checked', 1),
('PDD0000002', 'CUS0000010', 'PRD0000002', 'Inital Cust2', 'Initial Defect2', '../../images/product_diagnosis/PDD0000002/PDD0000002-Steel Ball 3quarter-inch.png', '../../images/product_diagnosis/PDD0000002/PDD0000002-Grease Cup No.03 (quarter-inch).png', '2021-05-02 22:27:15', 'Pending', 1),
('PDD0000003', 'CUS0000005', 'PRD0000012', 'Not enought output as expected', 'Product looks to be fine and as to provided input, the output is lesser than specified outcome', '../../images/product_diagnosis/PDD0000003/PDD0000003-vc scan one.png', '../../images/product_diagnosis/PDD0000003/PDD0000003-vc scan two.png', '2021-05-02 22:35:55', 'Checked', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_diag_finalized_tbl`
--

CREATE TABLE `product_diag_finalized_tbl` (
  `pfd_id` char(10) NOT NULL,
  `diag_id` char(10) NOT NULL,
  `pfd_warranty_stt` varchar(50) NOT NULL,
  `pfd_eligibility` varchar(200) NOT NULL,
  `pfd_repair_cost` double DEFAULT NULL,
  `pfd_prod_condition` varchar(50) NOT NULL,
  `pfd_final_diag` varchar(1000) NOT NULL,
  `pfd_pdf_path` varchar(500) NOT NULL,
  `pfd_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_diag_finalized_tbl`
--

INSERT INTO `product_diag_finalized_tbl` (`pfd_id`, `diag_id`, `pfd_warranty_stt`, `pfd_eligibility`, `pfd_repair_cost`, `pfd_prod_condition`, `pfd_final_diag`, `pfd_pdf_path`, `pfd_status`) VALUES
('PFD0000001', 'PDD0000001', 'yes', 'onetonereplacement', 0, 'excellent', 'This product has a faulty motor', '../../docs/product_defect_diagnosis/PFD0000001-PDD0000001.pdf', 1),
('PFD0000002', 'PDD0000003', 'no', 'repair', 20000, 'moderate', 'This product has a problem in the main chamber, blockage.', '../../docs/product_defect_diagnosis/PFD0000002-PDD0000003.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `prod_id` char(13) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_code` varchar(100) NOT NULL,
  `prod_description` varchar(100) NOT NULL,
  `prod_capacity` varchar(50) NOT NULL,
  `prod_motor_capacity` varchar(100) NOT NULL,
  `prod_motor_speed` varchar(100) NOT NULL,
  `prod_phase` varchar(50) NOT NULL,
  `prod_unit_price` float NOT NULL,
  `prod_reorder_level` int(10) NOT NULL,
  `prod_img_path` varchar(200) NOT NULL,
  `prod_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`prod_id`, `prod_name`, `prod_code`, `prod_description`, `prod_capacity`, `prod_motor_capacity`, `prod_motor_speed`, `prod_phase`, `prod_unit_price`, `prod_reorder_level`, `prod_img_path`, `prod_status`) VALUES
('PRD0000001', 'Grinding Machine No.07', 'UG7-2', 'Chilli and Spices Grinding Machine', '~8 Kg/hr.', '2HP', '1440RPM', 'Single Phase', 55000, 10, '../../images/product/PRD0000001-Grinding Mill No.07.png', '1'),
('PRD0000002', 'Grinding Machine No.07', 'UG7-3', 'Chilli and Spices Grinding Machine', '~8 Kg/hr.', '3HP', '1440RPM', 'Single Phase', 60000, 10, '../../images/product/PRD0000002-Grinding Mill No.07.png', '1'),
('PRD0000003', 'Grinding Machine No.10', 'UG10-5', 'Chilli and Spices Grinding Machine', '20-25 Kg/hr.', '5HP', '1440RPM', 'Single Phase', 110000, 5, '../../images/product/PRD0000003-Grinding Mill No.10.png', '1'),
('PRD0000004', 'Grinding Machine No.12', 'UG12-10', 'Chilli and Spices Grinding Machine', '30-40 Kg/hr.', '10HP', '1440RPM', 'Three Phase', 165000, 5, '../../images/product/PRD0000004-Grinding Mill No.12.png', '0'),
('PRD0000005', 'Grinding Machine No.12', 'UG12-15', 'Chilli and Spices Grinding Machine', '35-40 Kg/hr.', '15HP', '1440RPM', 'Three Phase', 185000, 5, '../../images/product/PRD0000005-Grinding Mill No.12.png', '0'),
('PRD0000006', 'Oil Expeller', 'UOISP-05', 'Udaya Oil Expeller', '20-25 Ltr/hr', '5HP', '1440RPM', 'Single Phase', 140000, 5, '../../images/product/PRD0000006-Oil Expeller SP.jpg', '1'),
('PRD0000007', 'Multi-Purpose Grinding Machine (7-15)', 'UG7/UD15-3', 'Multi Purpose Chilli and Spices Grinding Machine', '8-20 Kg/hr.', '3HP', '1440RPM', 'Single Phase', 90000, 5, '../../images/product/PRD0000007-Multipurpose Grinder 7-15.png', '0'),
('PRD0000008', 'Multi-Purpose Grinding Machine (7-23)', 'UG7/UD23-5', 'Multi Purpose Chilli and Spices Grinding Machine', '10-20 Kg/hr.', '5HP', '1440RPM', 'Single Phase', 115000, 5, '../../images/product/PRD0000008-Multi Purpose Grinder 7-23.png', '0'),
('PRD0000009', 'Disk Mill No.15', 'UD15-2', '', '20 Kg/hr', '2HP', '1440RPM', 'Single Phase', 40000, 10, '../../images/product/PRD0000009-Disk Mill No.15.png', '0'),
('PRD0000010', 'Disk Mill No.15', 'UD15-3', '', '20 Kg/hr', '3HP', '1440RPM', 'Single Phase', 45000, 10, '../../images/product/PRD0000010-Disk Mill No.15.png', '0'),
('PRD0000011', 'Super Shot Grinding Machine', 'USS-5', '', '20-25 Kg/hr.', '5HP', '1440RPM', 'Single Phase', 110000, 15, '../../images/product/PRD0000014-Super Shot.png', '1'),
('PRD0000012', 'Virgin Coconut Oil Expeller', 'UVCO-5', 'Virgin Coconut Oil Expeller', '20-25 Ltr/hr', '5HP', '1440RPM', 'Single Phase', 675000, 10, '../../images/product/PRD0000012-Virgin Coconut Oil.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `prt_production_history_tbl`
--

CREATE TABLE `prt_production_history_tbl` (
  `ptph_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `part_pre_qty` double NOT NULL,
  `part_qty` double NOT NULL,
  `post_part_qty` double NOT NULL,
  `ptph_date` date NOT NULL,
  `ptph_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ptph_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prt_production_history_tbl`
--

INSERT INTO `prt_production_history_tbl` (`ptph_id`, `rqst_id`, `emp_id`, `user_id`, `part_id`, `part_pre_qty`, `part_qty`, `post_part_qty`, `ptph_date`, `ptph_timestamp`, `ptph_status`) VALUES
('PTH0000001', '', 'EMP0000008', 'USR0000001', 'PRT0000001', 0, 10, 10, '2021-04-06', '2021-04-06 10:24:29', 1),
('PTH0000002', '', 'EMP0000008', 'USR0000001', 'PRT0000002', 0, 10, 10, '2021-04-06', '2021-04-06 10:24:29', 1),
('PTH0000003', '', 'EMP0000008', 'USR0000001', 'PRT0000003', 0, 10, 10, '2021-04-06', '2021-04-06 10:24:29', 1),
('PTH0000004', '', 'EMP0000008', 'USR0000001', 'PRT0000004', 0, 10, 10, '2021-04-06', '2021-04-06 10:24:30', 1),
('PTH0000005', '', 'EMP0000009', 'USR0000001', 'PRT0000014', 0, 10, 10, '2021-04-08', '2021-04-08 17:41:24', 1),
('PTH0000006', '', 'EMP0000009', 'USR0000001', 'PRT0000015', 0, 10, 10, '2021-04-08', '2021-04-23 18:47:01', 1),
('PTH0000007', '', 'EMP0000009', 'USR0000001', 'PRT0000016', 0, 10, 10, '2021-04-08', '2021-04-08 17:41:24', 1),
('PTH0000008', '', 'EMP0000004', 'USR0000001', 'PRT0000001', 10, 10, 20, '2021-04-23', '2021-04-23 10:02:40', 1),
('PTH0000009', '', 'EMP0000004', 'USR0000001', 'PRT0000002', 10, 5, 15, '2021-04-23', '2021-04-23 10:02:40', 1),
('PTH0000010', 'RQS0000018', 'EMP0000008', 'USR0000001', 'PRT0000015', 25, 30, 55, '2021-05-03', '2021-05-03 15:22:14', 1),
('PTH0000011', 'RQS0000018', 'EMP0000008', 'USR0000001', 'PRT0000016', 25, 30, 55, '2021-05-03', '2021-05-03 15:22:18', 1),
('PTH0000012', 'RQS0000018', 'EMP0000008', 'USR0000001', 'PRT0000017', 5, 100, 105, '2021-05-03', '2021-05-03 15:22:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_tbl`
--

CREATE TABLE `purchase_order_tbl` (
  `po_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `sup_id` char(10) NOT NULL,
  `po_pdf_path` varchar(500) NOT NULL,
  `po_form_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `po_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order_tbl`
--

INSERT INTO `purchase_order_tbl` (`po_id`, `rqst_id`, `sup_id`, `po_pdf_path`, `po_form_status`, `po_status`) VALUES
('PCO0000001', 'RQS0000011', 'SUP0000002', '../../docs/purchase_orders/PCO0000001-RQS0000011.pdf', 'Pending', 1),
('PCO0000002', 'RQS0000012', 'SUP0000001', '../../docs/purchase_orders/PCO0000002-RQS0000012.pdf', 'Pending', 1),
('PCO0000003', 'RQS0000012', 'SUP0000003', '../../docs/purchase_orders/PCO0000003-RQS0000012.pdf', 'Pending', 1),
('PCO0000004', 'RQS0000015', 'SUP0000001', '../../docs/purchase_orders/PCO0000004-RQS0000015.pdf', 'Pending', 1),
('PCO0000005', 'RQS0000015', 'SUP0000002', '../../docs/purchase_orders/PCO0000005-RQS0000015.pdf', 'Pending', 1),
('PCO0000006', 'RQS0000020', 'SUP0000001', '../../docs/purchase_orders/PCO0000006-RQS0000020.pdf', 'Pending', 1),
('PCO0000007', 'RQS0000020', 'SUP0000004', '../../docs/purchase_orders/PCO0000007-RQS0000020.pdf', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_tbl`
--

CREATE TABLE `quotation_tbl` (
  `qt_id` char(13) NOT NULL,
  `cus_id` char(13) NOT NULL,
  `qt_pdf_path` varchar(100) NOT NULL,
  `qt_form_status` varchar(100) NOT NULL,
  `qt_desc` varchar(500) NOT NULL,
  `qt_date` varchar(20) NOT NULL,
  `qt_create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qt_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation_tbl`
--

INSERT INTO `quotation_tbl` (`qt_id`, `cus_id`, `qt_pdf_path`, `qt_form_status`, `qt_desc`, `qt_date`, `qt_create_time`, `qt_status`) VALUES
('UIQ0000001', 'CUS0000002', '../../docs/quotation/UIQ0000001-CUS0000002.pdf', 'Pending', '[UG12-10] Grinding Machine No.12 / [UG10-5] Grinding Machine No.10 / ', '07-04-2021', '2021-05-02 17:39:12', 0),
('UIQ0000002', 'CUS0000001', '../../docs/quotation/UIQ0000002-CUS0000001.pdf', 'Confirmed', '[UG7-3] Grinding Machine No.07 / [UG10-5] Grinding Machine No.10 / ', '01-05-2021', '2021-05-02 17:19:26', 1),
('UIQ0000003', 'CUS0000011', '../../docs/quotation/UIQ0000003-CUS0000011.pdf', 'Confirmed', '[UOISP-05] Oil Expeller / [UVCO-5] Virgin Coconut Oil Expeller / ', '02-05-2021', '2021-05-02 17:54:46', 1),
('UIQ0000004', 'CUS0000005', '../../docs/quotation/UIQ0000004-CUS0000005.pdf', 'Pending', '[UG12-10] Grinding Machine No.12 / ', '02-05-2021', '2021-05-02 17:46:45', 1),
('UIQ0000005', 'CUS0000003', '../../docs/quotation/UIQ0000005-CUS0000003.pdf', 'Pending', '[UVCO-5] Virgin Coconut Oil Expeller / ', '03-05-2021', '2021-05-02 20:27:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterial_tbl`
--

CREATE TABLE `rawmaterial_tbl` (
  `rm_id` char(10) NOT NULL,
  `rm_name` varchar(100) NOT NULL,
  `rm_description` varchar(500) NOT NULL,
  `rm_reorder_level` float NOT NULL,
  `rm_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rawmaterial_tbl`
--

INSERT INTO `rawmaterial_tbl` (`rm_id`, `rm_name`, `rm_description`, `rm_reorder_level`, `rm_status`) VALUES
('RMT0000001', 'Graphite Powder', 'desc1', 1200, 1),
('RMT0000002', 'Cast Iron', 'desc2', 4500, 1),
('RMT0000003', 'Aluminium', 'desc3', 3000, 1),
('RMT0000004', 'Bronze', 'desc4', 1650, 1),
('RMT0000005', 'Brass', 'desc5', 1450, 1),
('RMT0000006', 'Copper', 'desc6', 1250, 1),
('RMT0000007', 'Zinc', 'desc7', 3500, 1),
('RMT0000008', 'Steel', 'desc8', 2350, 1),
('RMT0000009', 'Silicon', 'desc9', 2200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `rqst_id` char(10) NOT NULL,
  `rqst_type` varchar(100) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `user_id` char(10) NOT NULL,
  `rqst_date` date NOT NULL,
  `rqst_pdf` varchar(1000) NOT NULL,
  `rqst_status` varchar(100) NOT NULL,
  `row_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`rqst_id`, `rqst_type`, `emp_id`, `user_id`, `rqst_date`, `rqst_pdf`, `rqst_status`, `row_status`) VALUES
('RQS0000002', 'PRODUCTION-REQUEST', 'EMP0000004', 'USR0000001', '2021-04-06', '', 'Declined', 1),
('RQS0000003', 'PART-PRODUCTION-REQUEST', 'EMP0000009', 'USR0000001', '2021-04-06', '../../docs/part_production_notice/RQS0000003-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000004', 'PRODUCTION-REQUEST', 'EMP0000008', 'USR0000001', '2021-04-17', '../../docs/prod_production_notice/RQS0000004-PROD-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000005', 'PRODUCTION-REQUEST', 'EMP0000004', 'USR0000001', '2021-04-19', '../../docs/prod_production_notice/RQS0000005-PROD-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000007', 'PART-PRODUCTION-REQUEST', 'EMP0000008', 'USR0000001', '2021-04-23', '../../docs/part_production_notice/RQS0000007-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000008', 'PRODUCTION-REQUEST', 'EMP0000009', 'USR0000001', '2021-04-23', '../../docs/prod_production_notice/RQS0000008-PROD-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000009', 'PRODUCTION-REQUEST', 'EMP0000009', 'USR0000001', '2021-04-24', '', 'Pending', 1),
('RQS0000010', 'PART-PRODUCTION-REQUEST', 'EMP0000009', 'USR0000001', '2021-04-25', '../../docs/part_production_notice/RQS0000010-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000011', 'RM-REQUEST', 'EMP0000004', 'USR0000001', '2021-04-25', '', 'Confirmed', 1),
('RQS0000012', 'RM-REQUEST', 'EMP0000004', 'USR0000001', '2021-04-25', '', 'Confirmed', 1),
('RQS0000013', 'PART-PRODUCTION-REQUEST', 'EMP0000008', 'USR0000001', '2021-04-26', '../../docs/part_production_notice/RQS0000013-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000014', 'PRODUCTION-REQUEST', 'EMP0000008', 'USR0000001', '2021-05-03', '../../docs/prod_production_notice/RQS0000014-PROD-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000015', 'RM-REQUEST', 'EMP0000008', 'USR0000001', '2021-05-03', '', 'Confirmed', 1),
('RQS0000016', 'PART-PRODUCTION-REQUEST', 'EMP0000008', 'USR0000003', '2021-05-03', '../../docs/part_production_notice/RQS0000016-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000017', 'PRODUCTION-REQUEST', 'EMP0000008', 'USR0000003', '2021-05-03', '', 'Pending', 1),
('RQS0000018', 'PART-PRODUCTION-REQUEST', 'EMP0000008', 'USR0000003', '2021-05-03', '../../docs/part_production_notice/RQS0000018-PART-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000019', 'PRODUCTION-REQUEST', 'EMP0000009', 'USR0000004', '2021-05-03', '../../docs/prod_production_notice/RQS0000019-PROD-PRODUCTION-NOTE.pdf', 'Confirmed', 1),
('RQS0000020', 'RM-REQUEST', 'EMP0000009', 'USR0000004', '2021-05-03', '', 'Confirmed', 1),
('RQS0000021', 'PART-PRODUCTION-REQUEST', 'EMP0000008', 'USR0000003', '2021-05-03', '', 'Pending', 1),
('RQS0000022', 'PRODUCTION-REQUEST', 'EMP0000008', 'USR0000003', '2021-05-03', '', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rm_part_tbl`
--

CREATE TABLE `rm_part_tbl` (
  `rmpt_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `rm_id` char(10) NOT NULL,
  `rm_qty` float NOT NULL,
  `rm_w_unit` varchar(50) NOT NULL,
  `rmpt_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rm_part_tbl`
--

INSERT INTO `rm_part_tbl` (`rmpt_id`, `part_id`, `rm_id`, `rm_qty`, `rm_w_unit`, `rmpt_status`) VALUES
('PRM0000001', 'PRT0000001', 'RMT0000002', 7.25, 'kg', 1),
('PRM0000002', 'PRT0000001', 'RMT0000007', 400, 'g', 1),
('PRM0000003', 'PRT0000001', 'RMT0000004', 250, 'g', 1),
('PRM0000004', 'PRT0000002', 'RMT0000002', 18.75, 'kg', 1),
('PRM0000005', 'PRT0000002', 'RMT0000001', 5.3, 'kg', 1),
('PRM0000006', 'PRT0000014', 'RMT0000002', 4.85, 'kg', 1),
('PRM0000007', 'PRT0000014', 'RMT0000009', 2.5, 'kg', 1),
('PRM0000008', 'PRT0000014', 'RMT0000008', 10.2, 'kg', 1),
('PRM0000009', 'PRT0000004', 'RMT0000002', 43.85, 'kg', 1),
('PRM0000010', 'PRT0000004', 'RMT0000007', 20, 'kg', 1),
('PRM0000011', 'PRT0000004', 'RMT0000009', 30.8, 'kg', 1),
('PRM0000012', 'PRT0000010', 'RMT0000002', 3.8, 'kg', 1),
('PRM0000013', 'PRT0000010', 'RMT0000008', 1.89, 'kg', 1),
('PRM0000016', 'PRT0000006', 'RMT0000002', 5.05, 'kg', 1),
('PRM0000017', 'PRT0000006', 'RMT0000007', 1.1, 'kg', 1),
('PRM0000018', 'PRT0000007', 'RMT0000008', 400, 'g', 1),
('PRM0000019', 'PRT0000007', 'RMT0000007', 100, 'g', 1),
('PRM0000020', 'PRT0000008', 'RMT0000002', 1.23, 'kg', 1),
('PRM0000021', 'PRT0000008', 'RMT0000009', 860, 'g', 1),
('PRM0000022', 'PRT0000009', 'RMT0000002', 11.65, 'kg', 1),
('PRM0000023', 'PRT0000009', 'RMT0000003', 1.2, 'kg', 1),
('PRM0000024', 'PRT0000009', 'RMT0000008', 1.02, 'kg', 1),
('PRM0000025', 'PRT0000011', 'RMT0000002', 4.58, 'kg', 1),
('PRM0000026', 'PRT0000011', 'RMT0000007', 1.8, 'kg', 1),
('PRM0000027', 'PRT0000012', 'RMT0000008', 70, 'g', 1),
('PRM0000028', 'PRT0000013', 'RMT0000002', 35, 'g', 1),
('PRM0000029', 'PRT0000015', 'RMT0000005', 140, 'g', 1),
('PRM0000030', 'PRT0000016', 'RMT0000005', 200, 'g', 1),
('PRM0000031', 'PRT0000017', 'RMT0000008', 20, 'g', 1),
('PRM0000032', 'PRT0000018', 'RMT0000003', 230, 'g', 1),
('PRM0000033', 'PRT0000003', 'RMT0000002', 6.58, 'kg', 1),
('PRM0000034', 'PRT0000003', 'RMT0000008', 1.85, 'kg', 1),
('PRM0000035', 'PRT0000003', 'RMT0000003', 1.05, 'kg', 1),
('PRM0000036', 'PRT0000005', 'RMT0000002', 2.5, 'kg', 1),
('PRM0000037', 'PRT0000005', 'RMT0000007', 1, 'kg', 1),
('PRM0000038', 'PRT0000019', 'RMT0000008', 10, 'kg', 1),
('PRM0000039', 'PRT0000019', 'RMT0000003', 5, 'kg', 1),
('PRM0000040', 'PRT0000019', 'RMT0000006', 3, 'kg', 1),
('PRM0000041', 'PRT0000049', 'RMT0000002', 2.5, 'kg', 1),
('PRM0000042', 'PRT0000045', 'RMT0000002', 3.5, 'kg', 1),
('PRM0000043', 'PRT0000046', 'RMT0000002', 4.05, 'kg', 1),
('PRM0000044', 'PRT0000047', 'RMT0000002', 3.8, 'kg', 1),
('PRM0000045', 'PRT0000048', 'RMT0000002', 3.1, 'kg', 1),
('PRM0000046', 'PRT0000048', 'RMT0000008', 1.8, 'kg', 1),
('PRM0000047', 'PRT0000023', 'RMT0000002', 4.9, 'kg', 1),
('PRM0000048', 'PRT0000023', 'RMT0000008', 1.6, 'kg', 1),
('PRM0000049', 'PRT0000027', 'RMT0000002', 6.3, 'kg', 1),
('PRM0000050', 'PRT0000027', 'RMT0000008', 1.08, 'kg', 1),
('PRM0000051', 'PRT0000025', 'RMT0000008', 4.1, 'kg', 1),
('PRM0000052', 'PRT0000021', 'RMT0000002', 4.3, 'kg', 1),
('PRM0000053', 'PRT0000021', 'RMT0000008', 1.23, 'kg', 1),
('PRM0000054', 'PRT0000030', 'RMT0000002', 2.68, 'kg', 1),
('PRM0000055', 'PRT0000030', 'RMT0000008', 1.25, 'kg', 1),
('PRM0000056', 'PRT0000031', 'RMT0000002', 3.15, 'kg', 1),
('PRM0000057', 'PRT0000031', 'RMT0000008', 1.1, 'kg', 1),
('PRM0000058', 'PRT0000029', 'RMT0000002', 9, 'kg', 1),
('PRM0000059', 'PRT0000020', 'RMT0000002', 21.5, 'kg', 1),
('PRM0000060', 'PRT0000020', 'RMT0000008', 1.01, 'kg', 1),
('PRM0000061', 'PRT0000032', 'RMT0000008', 1.5, 'kg', 1),
('PRM0000062', 'PRT0000026', 'RMT0000008', 0.85, 'kg', 1),
('PRM0000063', 'PRT0000034', 'RMT0000002', 2.85, 'kg', 1),
('PRM0000064', 'PRT0000034', 'RMT0000008', 1.8, 'kg', 1),
('PRM0000065', 'PRT0000050', 'RMT0000008', 12, 'kg', 1),
('PRM0000066', 'PRT0000050', 'RMT0000003', 10, 'kg', 1),
('PRM0000067', 'PRT0000050', 'RMT0000006', 5.8, 'kg', 1),
('PRM0000068', 'PRT0000043', 'RMT0000003', 0.85, 'kg', 1),
('PRM0000069', 'PRT0000044', 'RMT0000003', 1.02, 'kg', 1),
('PRM0000070', 'PRT0000036', 'RMT0000008', 1.56, 'kg', 1),
('PRM0000071', 'PRT0000040', 'RMT0000002', 2, 'kg', 1),
('PRM0000072', 'PRT0000040', 'RMT0000008', 1.6, 'kg', 1),
('PRM0000073', 'PRT0000039', 'RMT0000002', 5.01, 'kg', 1),
('PRM0000074', 'PRT0000039', 'RMT0000008', 1.65, 'kg', 1),
('PRM0000075', 'PRT0000038', 'RMT0000008', 1.89, 'kg', 1),
('PRM0000076', 'PRT0000033', 'RMT0000008', 3.01, 'kg', 1),
('PRM0000077', 'PRT0000035', 'RMT0000002', 7.89, 'kg', 1),
('PRM0000078', 'PRT0000035', 'RMT0000008', 1.25, 'kg', 1),
('PRM0000079', 'PRT0000022', 'RMT0000008', 5.5, 'kg', 1),
('PRM0000080', 'PRT0000024', 'RMT0000008', 5.85, 'kg', 1),
('PRM0000081', 'PRT0000037', 'RMT0000002', 0.25, 'kg', 1),
('PRM0000082', 'PRT0000037', 'RMT0000008', 0.5, 'kg', 1),
('PRM0000083', 'PRT0000042', 'RMT0000008', 1.02, 'kg', 1),
('PRM0000084', 'PRT0000041', 'RMT0000009', 1.02, 'kg', 1),
('PRM0000085', 'PRT0000028', 'RMT0000008', 5.05, 'kg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rqst_items_tbl`
--

CREATE TABLE `rqst_items_tbl` (
  `rqit_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `sup_id` char(10) NOT NULL,
  `rm_id` char(10) NOT NULL,
  `rm_qty` float NOT NULL,
  `rm_urgency` varchar(50) NOT NULL,
  `rm_notes` varchar(100) NOT NULL,
  `rqit_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rqst_items_tbl`
--

INSERT INTO `rqst_items_tbl` (`rqit_id`, `rqst_id`, `sup_id`, `rm_id`, `rm_qty`, `rm_urgency`, `rm_notes`, `rqit_status`) VALUES
('RQI0000001', 'RQS0000011', 'SUP0000002', 'RMT0000002', 150, 'High', '', 1),
('RQI0000002', 'RQS0000011', 'SUP0000002', 'RMT0000003', 80, 'High', '', 1),
('RQI0000003', 'RQS0000012', 'SUP0000001', 'RMT0000004', 150, 'High', '', 1),
('RQI0000004', 'RQS0000012', 'SUP0000003', 'RMT0000005', 100, 'Medium', '', 1),
('RQI0000005', 'RQS0000015', 'SUP0000001', 'RMT0000006', 100, 'Medium', '', 1),
('RQI0000006', 'RQS0000015', 'SUP0000002', 'RMT0000007', 200, 'Medium', '', 1),
('RQI0000007', 'RQS0000020', 'SUP0000001', 'RMT0000006', 120, 'Medium', '', 1),
('RQI0000008', 'RQS0000020', 'SUP0000004', 'RMT0000005', 60, 'High', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rqst_part_production_tbl`
--

CREATE TABLE `rqst_part_production_tbl` (
  `rqpt_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `rqpt_qty` float NOT NULL,
  `rqpt_urgency` varchar(100) NOT NULL,
  `rqpt_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rqst_part_production_tbl`
--

INSERT INTO `rqst_part_production_tbl` (`rqpt_id`, `rqst_id`, `part_id`, `rqpt_qty`, `rqpt_urgency`, `rqpt_status`) VALUES
('RPT0000001', 'RQS0000003', 'PRT0000014', 15, 'Low', 1),
('RPT0000002', 'RQS0000003', 'PRT0000004', 20, 'High', 1),
('RPT0000003', 'RQS0000003', 'PRT0000010', 20, 'High', 1),
('RPT0000004', 'RQS0000007', 'PRT0000010', 4, 'Low', 1),
('RPT0000005', 'RQS0000007', 'PRT0000006', 5, 'Low', 1),
('RPT0000006', 'RQS0000010', 'PRT0000015', 20, 'High', 1),
('RPT0000007', 'RQS0000010', 'PRT0000016', 20, 'High', 1),
('RPT0000008', 'RQS0000010', 'PRT0000017', 100, 'High', 1),
('RPT0000009', 'RQS0000013', 'PRT0000005', 7, 'Medium', 1),
('RPT0000010', 'RQS0000013', 'PRT0000001', 3, 'Medium', 1),
('RPT0000011', 'RQS0000016', 'PRT0000020', 10, 'Medium', 1),
('RPT0000012', 'RQS0000016', 'PRT0000024', 5, 'High', 1),
('RPT0000013', 'RQS0000018', 'PRT0000015', 30, 'Medium', 1),
('RPT0000014', 'RQS0000018', 'PRT0000016', 30, 'Medium', 1),
('RPT0000015', 'RQS0000018', 'PRT0000017', 100, 'Medium', 1),
('RPT0000016', 'RQS0000021', 'PRT0000003', 4, 'Medium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rqst_production_tbl`
--

CREATE TABLE `rqst_production_tbl` (
  `rqpr_id` char(10) NOT NULL,
  `rqst_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `rqpr_qty` float NOT NULL,
  `rqpr_urgency` varchar(100) NOT NULL,
  `rqpr_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rqst_production_tbl`
--

INSERT INTO `rqst_production_tbl` (`rqpr_id`, `rqst_id`, `prod_id`, `rqpr_qty`, `rqpr_urgency`, `rqpr_status`) VALUES
('RQP0000001', 'RQS0000002', 'PRD0000002', 5, 'Low', 1),
('RQP0000002', 'RQS0000002', 'PRD0000007', 6, 'High', 1),
('RQP0000003', 'RQS0000004', 'PRD0000001', 4, 'Low', 1),
('RQP0000004', 'RQS0000005', 'PRD0000001', 3, 'Low', 1),
('RQP0000005', 'RQS0000008', 'PRD0000001', 1, 'Medium', 1),
('RQP0000006', 'RQS0000009', 'PRD0000001', 2, 'Low', 1),
('RQP0000007', 'RQS0000014', 'PRD0000012', 5, 'Medium', 1),
('RQP0000008', 'RQS0000017', 'PRD0000001', 3, 'Low', 1),
('RQP0000009', 'RQS0000019', 'PRD0000001', 3, 'Medium', 1),
('RQP0000010', 'RQS0000022', 'PRD0000012', 2, 'High', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_part_tbl`
--

CREATE TABLE `stock_part_tbl` (
  `stock_part_id` char(10) NOT NULL,
  `part_id` char(10) NOT NULL,
  `part_qty` float NOT NULL,
  `stock_part_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_part_tbl`
--

INSERT INTO `stock_part_tbl` (`stock_part_id`, `part_id`, `part_qty`, `stock_part_status`) VALUES
('PTS0000001', 'PRT0000001', 17, 1),
('PTS0000002', 'PRT0000002', 17, 1),
('PTS0000003', 'PRT0000003', 17, 1),
('PTS0000004', 'PRT0000004', 17, 1),
('PTS0000005', 'PRT0000005', 17, 1),
('PTS0000006', 'PRT0000006', 9, 1),
('PTS0000007', 'PRT0000007', 9, 1),
('PTS0000008', 'PRT0000008', 17, 1),
('PTS0000009', 'PRT0000009', 17, 1),
('PTS0000010', 'PRT0000010', 17, 1),
('PTS0000011', 'PRT0000011', 17, 1),
('PTS0000012', 'PRT0000012', 17, 1),
('PTS0000013', 'PRT0000012', 17, 1),
('PTS0000014', 'PRT0000012', 17, 1),
('PTS0000015', 'PRT0000012', 17, 1),
('PTS0000016', 'PRT0000013', 17, 1),
('PTS0000017', 'PRT0000014', 17, 1),
('PTS0000018', 'PRT0000015', 43, 1),
('PTS0000019', 'PRT0000016', 43, 1),
('PTS0000020', 'PRT0000017', 87, 1),
('PTS0000021', 'PRT0000018', 17, 1),
('PTS0000022', 'PRT0000019', 17, 1),
('PTS0000023', 'PRT0000020', 16, 1),
('PTS0000024', 'PRT0000021', 16, 1),
('PTS0000025', 'PRT0000022', 7, 1),
('PTS0000026', 'PRT0000023', 16, 1),
('PTS0000027', 'PRT0000024', 16, 1),
('PTS0000028', 'PRT0000025', 7, 1),
('PTS0000029', 'PRT0000026', 16, 1),
('PTS0000030', 'PRT0000027', 16, 1),
('PTS0000031', 'PRT0000028', 16, 1),
('PTS0000032', 'PRT0000029', 16, 1),
('PTS0000033', 'PRT0000030', 7, 1),
('PTS0000034', 'PRT0000031', -2, 1),
('PTS0000035', 'PRT0000032', 7, 1),
('PTS0000036', 'PRT0000033', 7, 1),
('PTS0000037', 'PRT0000034', 16, 1),
('PTS0000038', 'PRT0000035', 16, 1),
('PTS0000039', 'PRT0000036', 7, 1),
('PTS0000040', 'PRT0000037', 16, 1),
('PTS0000041', 'PRT0000038', 7, 1),
('PTS0000042', 'PRT0000039', 16, 1),
('PTS0000043', 'PRT0000040', 7, 1),
('PTS0000044', 'PRT0000041', 16, 1),
('PTS0000045', 'PRT0000042', 16, 1),
('PTS0000046', 'PRT0000043', -11, 1),
('PTS0000047', 'PRT0000044', -11, 1),
('PTS0000048', 'PRT0000045', 7, 1),
('PTS0000049', 'PRT0000046', 7, 1),
('PTS0000050', 'PRT0000047', 7, 1),
('PTS0000051', 'PRT0000048', 7, 1),
('PTS0000052', 'PRT0000049', 7, 1),
('PTS0000053', 'PRT0000050', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_prod_tbl`
--

CREATE TABLE `stock_prod_tbl` (
  `stock_prod_id` char(10) NOT NULL,
  `prod_id` char(10) NOT NULL,
  `prod_qty` double NOT NULL DEFAULT 0,
  `stock_prod_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_prod_tbl`
--

INSERT INTO `stock_prod_tbl` (`stock_prod_id`, `prod_id`, `prod_qty`, `stock_prod_status`) VALUES
('PRS0000001', 'PRD0000001', 49, 1),
('PRS0000002', 'PRD0000002', 44, 1),
('PRS0000003', 'PRD0000003', 43, 1),
('PRS0000004', 'PRD0000004', 38, 1),
('PRS0000005', 'PRD0000005', 38, 1),
('PRS0000006', 'PRD0000006', 33, 1),
('PRS0000007', 'PRD0000007', 23, 1),
('PRS0000008', 'PRD0000008', 13, 1),
('PRS0000009', 'PRD0000009', 10, 1),
('PRS0000010', 'PRD0000010', 18, 1),
('PRS0000011', 'PRD0000011', 4, 1),
('PRS0000012', 'PRD0000012', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_rm_tbl`
--

CREATE TABLE `stock_rm_tbl` (
  `stock_rm_id` char(10) NOT NULL,
  `rm_id` char(10) NOT NULL,
  `rm_qty` double NOT NULL,
  `rm_w_unit` varchar(10) NOT NULL DEFAULT 'kg',
  `stock_rm_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_rm_tbl`
--

INSERT INTO `stock_rm_tbl` (`stock_rm_id`, `rm_id`, `rm_qty`, `rm_w_unit`, `stock_rm_status`) VALUES
('SRM0000001', 'RMT0000001', 5521, 'kg', 1),
('SRM0000002', 'RMT0000002', 7530.75, 'kg', 1),
('SRM0000003', 'RMT0000003', 3856, 'kg', 1),
('SRM0000004', 'RMT0000004', 9249.25, 'kg', 1),
('SRM0000005', 'RMT0000005', 1489.8, 'kg', 1),
('SRM0000006', 'RMT0000006', 1875, 'kg', 1),
('SRM0000007', 'RMT0000007', 7356.8, 'kg', 1),
('SRM0000008', 'RMT0000008', 2413.65, 'kg', 1),
('SRM0000009', 'RMT0000009', 6322, 'kg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_rm_tbl`
--

CREATE TABLE `supplier_rm_tbl` (
  `rm_sup_id` char(10) NOT NULL,
  `sup_id` char(10) NOT NULL,
  `rm_id` char(10) NOT NULL,
  `row_stt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_rm_tbl`
--

INSERT INTO `supplier_rm_tbl` (`rm_sup_id`, `sup_id`, `rm_id`, `row_stt`) VALUES
('RMS0000008', 'SUP0000003', 'RMT0000003', 1),
('RMS0000009', 'SUP0000003', 'RMT0000002', 1),
('RMS0000010', 'SUP0000003', 'RMT0000005', 1),
('RMS0000011', 'SUP0000001', 'RMT0000006', 1),
('RMS0000012', 'SUP0000001', 'RMT0000004', 1),
('RMS0000013', 'SUP0000001', 'RMT0000009', 1),
('RMS0000014', 'SUP0000002', 'RMT0000002', 1),
('RMS0000015', 'SUP0000002', 'RMT0000008', 1),
('RMS0000016', 'SUP0000002', 'RMT0000007', 1),
('RMS0000017', 'SUP0000002', 'RMT0000001', 1),
('RMS0000018', 'SUP0000002', 'RMT0000003', 1),
('RMS0000019', 'SUP0000004', 'RMT0000004', 1),
('RMS0000020', 'SUP0000004', 'RMT0000009', 1),
('RMS0000021', 'SUP0000004', 'RMT0000005', 1),
('RMS0000022', 'SUP0000004', 'RMT0000008', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_tbl`
--

CREATE TABLE `supplier_tbl` (
  `sup_id` char(12) NOT NULL,
  `sup_company_name` varchar(200) NOT NULL,
  `sup_phone` char(10) NOT NULL,
  `sup_phone_two` char(10) NOT NULL,
  `sup_fax_number` char(12) NOT NULL DEFAULT '-',
  `sup_address` varchar(200) NOT NULL,
  `sup_email` varchar(200) NOT NULL,
  `sup_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_tbl`
--

INSERT INTO `supplier_tbl` (`sup_id`, `sup_company_name`, `sup_phone`, `sup_phone_two`, `sup_fax_number`, `sup_address`, `sup_email`, `sup_status`) VALUES
('SUP0000001', 'Suranga Crushers', '0771122334', '0812457854', '', '14, Kandy Road, Penideniya', 'suranga@testmail.com', 1),
('SUP0000002', 'Tesco & Co Ltd', '0774589654', '0818958245', '', 'No. 434, New Wesley Road, Hinnarandeniya', 'tesco@testmail.com', 1),
('SUP0000003', 'Asiri Tradings PVT Ltd', '0775465285', '0812465895', '0815464658', 'No. 34/8, Kandy Road, Gelioya', 'asirielectricals@testmail.com', 1),
('SUP0000004', 'Tensa Holdings', '0775689547', '0815468587', '333333333', 'No. 12/1/A, Katuwatte Road, Ratnapura', 'tensa@testmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_part_qty_tbl`
--

CREATE TABLE `temp_part_qty_tbl` (
  `part_id` char(10) NOT NULL,
  `part_qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_part_tbl`
--

CREATE TABLE `temp_part_tbl` (
  `part_id` char(10) NOT NULL,
  `part_code` varchar(500) NOT NULL,
  `part_name` varchar(500) NOT NULL,
  `part_weight` double NOT NULL,
  `part_w_unit` varchar(5) NOT NULL,
  `part_qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_prod_tbl`
--

CREATE TABLE `temp_prod_tbl` (
  `prod_id` char(10) NOT NULL,
  `prod_code` varchar(100) NOT NULL,
  `prod_name` varchar(500) NOT NULL,
  `prod_motor_capacity` varchar(50) NOT NULL,
  `prod_qty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_rawmat_qty_tbl`
--

CREATE TABLE `temp_rawmat_qty_tbl` (
  `rm_id` char(10) NOT NULL,
  `rm_qty` double NOT NULL,
  `rm_w_unit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` char(10) NOT NULL,
  `emp_id` char(10) NOT NULL,
  `user_pwd` varchar(100) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `emp_id`, `user_pwd`, `user_role`, `user_status`) VALUES
('USR0000001', 'EMP0000001', '0e27139a924aa42f36643b8c33c8e604', '1', 1),
('USR0000002', 'EMP0000004', 'e359d1a949dac99a0cd65cb5fb5ed942', '2', 1),
('USR0000003', 'EMP0000008', '49d29dd9af5a9af51572688ddcccb88d', '3', 1),
('USR0000004', 'EMP0000009', '7d1985b5f431fed327c188510e94b251', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tbl`
--

CREATE TABLE `vehicle_tbl` (
  `vehicle_id` char(10) NOT NULL,
  `v_plate_type` varchar(10) NOT NULL,
  `v_plate_identifier` char(10) DEFAULT NULL,
  `v_province` char(5) DEFAULT NULL,
  `v_reg_letters` char(10) DEFAULT NULL,
  `v_i_number` char(10) DEFAULT NULL,
  `v_reg_number` char(10) DEFAULT NULL,
  `v_old_reg_no` char(10) DEFAULT NULL,
  `v_brand` varchar(50) NOT NULL,
  `v_model` varchar(50) NOT NULL,
  `v_category` varchar(50) NOT NULL,
  `v_description` varchar(100) NOT NULL,
  `v_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_tbl`
--

INSERT INTO `vehicle_tbl` (`vehicle_id`, `v_plate_type`, `v_plate_identifier`, `v_province`, `v_reg_letters`, `v_i_number`, `v_reg_number`, `v_old_reg_no`, `v_brand`, `v_model`, `v_category`, `v_description`, `v_status`) VALUES
('VHL0000001', 'ENG', '-', 'UP', 'KM', NULL, '3344', NULL, 'Toyota', 'Allion', 'Buddy Lorry', 'Toyota Allion used for transportation', 0),
('VHL0000002', 'ENG', '-', 'NP', 'NB', NULL, '2732', NULL, 'Ashoka', 'Layland', 'Lorry', 'Lorry for transporting grinders', 1),
('VHL0000003', 'Dash', '-', NULL, NULL, '32', NULL, '1002', 'Isuzu', 'MonoTruck', 'Lorry', 'Descrition of shit', 1),
('VHL0000004', 'Sri', 'ශ්‍රී', NULL, NULL, '12', NULL, '6985', 'Exho', 'Hasulto', 'Container', 'Description of Hosulto', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_tbl`
--

CREATE TABLE `warehouse_tbl` (
  `wh_id` char(10) NOT NULL,
  `wh_location` varchar(50) NOT NULL,
  `wh_address` varchar(100) NOT NULL,
  `wh_phone_one` char(10) NOT NULL,
  `wh_phone_two` char(10) DEFAULT NULL,
  `wh_description` varchar(100) NOT NULL,
  `wh_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse_tbl`
--

INSERT INTO `warehouse_tbl` (`wh_id`, `wh_location`, `wh_address`, `wh_phone_one`, `wh_phone_two`, `wh_description`, `wh_status`) VALUES
('WRH0000001', 'Weligalla (Store House 1)', 'No. 112, Uda Aludeniya, Weligalla', '0775896585', '0715548788', 'This warehouse exits in Weligalla', 1),
('WRH0000002', 'Weligalla (Store House 2)', 'No. 112, Uda Aludeniya, Weligalla', '0812121245', '0772213265', 'This warehouse exists in Weligalla', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `cus_tbl`
--
ALTER TABLE `cus_tbl`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `emp_jobrole_tbl`
--
ALTER TABLE `emp_jobrole_tbl`
  ADD PRIMARY KEY (`jobrole_id`);

--
-- Indexes for table `emp_payroll_tbl`
--
ALTER TABLE `emp_payroll_tbl`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `emp_salary_tbl`
--
ALTER TABLE `emp_salary_tbl`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `goodsrecievednote_tbl`
--
ALTER TABLE `goodsrecievednote_tbl`
  ADD PRIMARY KEY (`grn_id`);

--
-- Indexes for table `grn_items_tbl`
--
ALTER TABLE `grn_items_tbl`
  ADD PRIMARY KEY (`git_id`);

--
-- Indexes for table `invoice_items_tbl`
--
ALTER TABLE `invoice_items_tbl`
  ADD PRIMARY KEY (`init_id`);

--
-- Indexes for table `invoice_parts_items_tbl`
--
ALTER TABLE `invoice_parts_items_tbl`
  ADD PRIMARY KEY (`pinit_id`);

--
-- Indexes for table `invoice_parts_tbl`
--
ALTER TABLE `invoice_parts_tbl`
  ADD PRIMARY KEY (`p_inv_id`);

--
-- Indexes for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `mail_log`
--
ALTER TABLE `mail_log`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `parts_tbl`
--
ALTER TABLE `parts_tbl`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `part_prod_tbl`
--
ALTER TABLE `part_prod_tbl`
  ADD PRIMARY KEY (`ptpr_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `prd_production_history_tbl`
--
ALTER TABLE `prd_production_history_tbl`
  ADD PRIMARY KEY (`pph_id`);

--
-- Indexes for table `product_diagnosis_tbl`
--
ALTER TABLE `product_diagnosis_tbl`
  ADD PRIMARY KEY (`diag_id`);

--
-- Indexes for table `product_diag_finalized_tbl`
--
ALTER TABLE `product_diag_finalized_tbl`
  ADD PRIMARY KEY (`pfd_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `prt_production_history_tbl`
--
ALTER TABLE `prt_production_history_tbl`
  ADD PRIMARY KEY (`ptph_id`);

--
-- Indexes for table `purchase_order_tbl`
--
ALTER TABLE `purchase_order_tbl`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `quotation_tbl`
--
ALTER TABLE `quotation_tbl`
  ADD PRIMARY KEY (`qt_id`);

--
-- Indexes for table `rawmaterial_tbl`
--
ALTER TABLE `rawmaterial_tbl`
  ADD PRIMARY KEY (`rm_id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`rqst_id`);

--
-- Indexes for table `rm_part_tbl`
--
ALTER TABLE `rm_part_tbl`
  ADD PRIMARY KEY (`rmpt_id`);

--
-- Indexes for table `rqst_items_tbl`
--
ALTER TABLE `rqst_items_tbl`
  ADD PRIMARY KEY (`rqit_id`);

--
-- Indexes for table `rqst_part_production_tbl`
--
ALTER TABLE `rqst_part_production_tbl`
  ADD PRIMARY KEY (`rqpt_id`);

--
-- Indexes for table `rqst_production_tbl`
--
ALTER TABLE `rqst_production_tbl`
  ADD PRIMARY KEY (`rqpr_id`);

--
-- Indexes for table `stock_part_tbl`
--
ALTER TABLE `stock_part_tbl`
  ADD PRIMARY KEY (`stock_part_id`);

--
-- Indexes for table `stock_prod_tbl`
--
ALTER TABLE `stock_prod_tbl`
  ADD PRIMARY KEY (`stock_prod_id`);

--
-- Indexes for table `stock_rm_tbl`
--
ALTER TABLE `stock_rm_tbl`
  ADD PRIMARY KEY (`stock_rm_id`);

--
-- Indexes for table `supplier_rm_tbl`
--
ALTER TABLE `supplier_rm_tbl`
  ADD PRIMARY KEY (`rm_sup_id`);

--
-- Indexes for table `supplier_tbl`
--
ALTER TABLE `supplier_tbl`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `temp_part_tbl`
--
ALTER TABLE `temp_part_tbl`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `temp_prod_tbl`
--
ALTER TABLE `temp_prod_tbl`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `temp_rawmat_qty_tbl`
--
ALTER TABLE `temp_rawmat_qty_tbl`
  ADD PRIMARY KEY (`rm_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle_tbl`
--
ALTER TABLE `vehicle_tbl`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `warehouse_tbl`
--
ALTER TABLE `warehouse_tbl`
  ADD PRIMARY KEY (`wh_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
