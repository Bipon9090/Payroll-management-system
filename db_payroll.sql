-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 09:42 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `user_name`, `email`, `password`, `user_type`) VALUES
(1, 'admin', 'admin@admin.com', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_id` int(20) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive,1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `dept_name`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Computer', '2019-03-28 02:51:48', '2019-06-18 12:14:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` int(20) NOT NULL,
  `emp_name` varchar(30) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dept_id` int(20) NOT NULL COMMENT 'Fk',
  `designation` varchar(20) NOT NULL,
  `join_date` varchar(20) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `national_id` varchar(30) NOT NULL,
  `basic_salary` varchar(40) NOT NULL,
  `house_rent` int(11) NOT NULL,
  `medical` int(11) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_name`, `user_name`, `password`, `gender`, `dept_id`, `designation`, `join_date`, `qualification`, `national_id`, `basic_salary`, `house_rent`, `medical`, `total`, `status`) VALUES
(1, 'Bipon', 'bipon', '1234', 'male', 1, 'software engineer', '2019-01-01', 'BSC', '19943022902000008', '10000', 10, 10, 12000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary`
--

CREATE TABLE `tbl_salary` (
  `salary_id` int(30) NOT NULL,
  `emp_id` int(30) NOT NULL COMMENT 'Fk',
  `amount` double NOT NULL,
  `month_year` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` date NOT NULL,
  `update_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salary`
--

INSERT INTO `tbl_salary` (`salary_id`, `emp_id`, `amount`, `month_year`, `create_date`, `update_date`, `update_by`) VALUES
(1, 1, 5000, 'January/2019', '2019-06-25 01:46:58', '0000-00-00', ''),
(2, 1, 5000, 'January/2019', '2019-06-25 01:59:08', '0000-00-00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_salary`
--
ALTER TABLE `tbl_salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `emp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_salary`
--
ALTER TABLE `tbl_salary`
  MODIFY `salary_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
