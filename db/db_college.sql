-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 08:23 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_college_mst`
--

CREATE TABLE `tbl_college_mst` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `college_logo` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pin_code` int(11) DEFAULT NULL,
  `college_grade` varchar(100) DEFAULT NULL,
  `college_email_id` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active college 1: inactive college',
  `contact_person_name` varchar(255) DEFAULT NULL,
  `contact_person_no` bigint(20) DEFAULT NULL,
  `plan_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_college_mst`
--

INSERT INTO `tbl_college_mst` (`college_id`, `college_name`, `city`, `phone_no`, `college_logo`, `address`, `pin_code`, `college_grade`, `college_email_id`, `is_active`, `contact_person_name`, `contact_person_no`, `plan_id_fk`) VALUES
(1, 'KTHM COLLEGE', 'NASHIK', '0223062633', NULL, 'Shivajinagar Nashik', 422013, 'A+', 'kthmcollege@gmail.com', '0', 'BG Wagh Sir', 96858458541, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` bigint(20) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `course_code` char(50) DEFAULT NULL,
  `course_year` int(11) DEFAULT NULL,
  `no_of_semister` int(11) DEFAULT NULL,
  `college_id_fk` int(11) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active class 1: inactive class',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: not deleted 1: deleted',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `course_code`, `course_year`, `no_of_semister`, `college_id_fk`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Batchler of Computer Sci', 'BCS', 2, 4, 1, '0', '0', 1, '2021-06-25 23:08:59', 1, '2021-07-05 23:26:00', NULL, NULL),
(2, 'Batchler of Chemical', 'BC', 4, 5, 1, '0', '0', 1, '2021-06-25 23:42:25', NULL, NULL, NULL, NULL),
(3, 'Test course', 'TC', 4, 8, 1, '0', '1', 1, '2021-07-05 22:50:19', NULL, NULL, 1, '2021-07-05 23:01:35'),
(4, 'anothere test test', 'ATT', 3, 6, 1, '0', '0', 1, '2021-07-05 22:50:49', 1, '2021-07-05 23:26:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_mst`
--

CREATE TABLE `tbl_module_mst` (
  `id` int(11) NOT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active module 1: inactive module'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_module_mst`
--

INSERT INTO `tbl_module_mst` (`id`, `module_name`, `is_active`) VALUES
(1, 'Student managment', '0'),
(2, 'Teacher management', '0'),
(3, 'SMS', '0'),
(4, 'Fees Management', '0'),
(5, 'QR Code integration', '0'),
(6, 'Biometric Attendance ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset_tokens`
--

CREATE TABLE `tbl_password_reset_tokens` (
  `id` bigint(20) NOT NULL,
  `login_id_fk` bigint(20) DEFAULT NULL,
  `password_reset_token` varchar(100) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `is_used` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: token not used 1: token used.',
  `password_reset_on` datetime DEFAULT NULL,
  `reset_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: reset pending 1: reset successfully'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_password_reset_tokens`
--

INSERT INTO `tbl_password_reset_tokens` (`id`, `login_id_fk`, `password_reset_token`, `date_time`, `is_used`, `password_reset_on`, `reset_status`) VALUES
(1, 1, 'c06fec79-2bdd-4e74-8083-15f9d9988371', '2021-06-20 23:49:36', '0', NULL, '0'),
(2, 1, 'e7734375-1a16-458c-ae12-5e2aae84d79a', '2021-06-20 23:59:43', '0', NULL, '0'),
(3, 1, '6c082287-a5f6-4280-9f63-b169ecd60d93', '2021-06-21 00:02:33', '0', NULL, '0'),
(4, 1, '2f106348-1be8-463f-83c0-a11085e4e89e', '2021-06-21 00:02:35', '0', NULL, '0'),
(5, 1, '69ead92f-f2eb-4f20-bcfe-7ee8979a9c56', '2021-06-21 00:03:49', '0', NULL, '0'),
(6, 1, '0a52161c-ca62-4d75-8254-4efcf35f3ff8', '2021-06-21 00:06:28', '0', NULL, '0'),
(7, 1, 'aa8e5170-d653-4178-a498-b4545cf59212', '2021-06-21 00:09:37', '0', NULL, '0'),
(8, 1, '35438bd0-9dd6-4e5d-be08-b09d25378b1f', '2021-06-21 00:10:17', '0', NULL, '0'),
(9, 1, 'f70d761a-ee81-43c9-b40c-c13a41ee6ca9', '2021-06-21 00:15:02', '0', NULL, '0'),
(10, 1, '7f21b32e-8645-43a9-aa3a-cd10d0d3573a', '2021-06-21 00:15:12', '0', NULL, '0'),
(11, 1, '36d880db-a82e-4447-85a8-7a584284bf2f', '2021-06-21 00:21:50', '0', NULL, '0'),
(12, 1, 'b667d4aa-9576-421d-b14e-d3a9a93935ec', '2021-06-21 00:23:03', '0', NULL, '0'),
(13, 1, 'b958c20c-cfdd-4737-8f88-fec9c4a51f5e', '2021-06-21 22:58:56', '0', NULL, '0'),
(14, 1, '8cbaf619-d7b8-463e-8cf6-0529f4e9ce19', '2021-06-21 23:03:49', '0', NULL, '0'),
(15, 1, 'e621c760-08b2-48e9-bfb2-707acec3b4cf', '2021-06-21 23:04:46', '0', NULL, '0'),
(16, 1, '0116f18e-9941-4ad5-aeb1-e95aafef356e', '2021-06-21 23:12:17', '0', NULL, '0'),
(17, 1, '1b9fdd3d-bf87-4c5f-877f-e2a9fe08ab68', '2021-06-21 23:13:01', '0', NULL, '0'),
(18, 1, '49379bbb-2591-48f3-bab6-856fa6a883a0', '2021-06-21 23:28:15', '0', NULL, '0'),
(19, 1, 'be15eab4-0a59-4c6e-9efa-c689c7b2573f', '2021-06-22 22:48:23', '1', NULL, '0'),
(20, 1, '948a2758-9303-4a7c-a73d-7d7032e789e7', '2021-06-22 23:18:57', '1', NULL, '0'),
(21, 1, 'e8178246-f767-474c-8a06-8d407fe00c17', '2021-06-22 23:32:08', '0', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) DEFAULT NULL,
  `permission_name` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active permission  1: inactive permission'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `permission_name`, `is_active`) VALUES
(1, 'Add', '0'),
(2, 'Update', '0'),
(3, 'Delete', '0'),
(4, 'View', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plan_modules`
--

CREATE TABLE `tbl_plan_modules` (
  `id` int(11) NOT NULL,
  `module_id_fk` int(11) DEFAULT NULL,
  `plan_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_plan_modules`
--

INSERT INTO `tbl_plan_modules` (`id`, `module_id_fk`, `plan_id_fk`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 6, 3),
(4, 4, 3),
(5, 3, 3),
(6, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plan_mst`
--

CREATE TABLE `tbl_plan_mst` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_plan_mst`
--

INSERT INTO `tbl_plan_mst` (`id`, `plan_name`) VALUES
(1, 'Basic'),
(2, 'Premium'),
(3, 'KTHM College Plan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_mst`
--

CREATE TABLE `tbl_role_mst` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active role 1: inactive role'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role_mst`
--

INSERT INTO `tbl_role_mst` (`role_id`, `role_name`, `is_active`) VALUES
(1, 'Teacher', '0'),
(2, 'Clerk', '0'),
(3, 'Student', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_permission_mst`
--

CREATE TABLE `tbl_role_permission_mst` (
  `id` bigint(20) NOT NULL,
  `role_id_fk` int(11) DEFAULT NULL,
  `module_id_fk` int(11) DEFAULT NULL,
  `permission_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role_permission_mst`
--

INSERT INTO `tbl_role_permission_mst` (`id`, `role_id_fk`, `module_id_fk`, `permission_ids`) VALUES
(1, 1, 1, '1,2,3'),
(2, 1, 4, '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_mst`
--

CREATE TABLE `tbl_staff_mst` (
  `staff_id` bigint(20) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff_mst`
--

INSERT INTO `tbl_staff_mst` (`staff_id`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Manoj', 'T', 'Jadhav');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_login`
--

CREATE TABLE `tbl_users_login` (
  `login_id` bigint(20) NOT NULL,
  `college_id_fk` int(11) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: active user 1: inactive user',
  `role_id_fk` int(11) DEFAULT NULL,
  `staff_id_fk` bigint(20) DEFAULT NULL,
  `student_id_fk` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: not deleted 1: deleted',
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users_login`
--

INSERT INTO `tbl_users_login` (`login_id`, `college_id_fk`, `email_id`, `mobile_no`, `password`, `is_active`, `role_id_fk`, `staff_id_fk`, `student_id_fk`, `created_at`, `updated_at`, `deleted_at`, `is_deleted`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 'teacher@gmail.com', 9604460441, 'VlZWdUxOUFdqd3pnU3JYZ1BJVkg0Zz09', '0', 1, 1, NULL, '2021-06-19 22:48:52', '2021-06-22 23:19:48', NULL, '0', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_college_mst`
--
ALTER TABLE `tbl_college_mst`
  ADD PRIMARY KEY (`college_id`),
  ADD KEY `plan_id_fk` (`plan_id_fk`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `college_id_fk` (`college_id_fk`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `tbl_module_mst`
--
ALTER TABLE `tbl_module_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_password_reset_tokens`
--
ALTER TABLE `tbl_password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_plan_modules`
--
ALTER TABLE `tbl_plan_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id_fk` (`module_id_fk`),
  ADD KEY `plan_id_fk` (`plan_id_fk`);

--
-- Indexes for table `tbl_plan_mst`
--
ALTER TABLE `tbl_plan_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role_mst`
--
ALTER TABLE `tbl_role_mst`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_permission_mst`
--
ALTER TABLE `tbl_role_permission_mst`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id_fk` (`role_id_fk`),
  ADD KEY `module_id_fk` (`module_id_fk`);

--
-- Indexes for table `tbl_staff_mst`
--
ALTER TABLE `tbl_staff_mst`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_users_login`
--
ALTER TABLE `tbl_users_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `college_id_fk` (`college_id_fk`),
  ADD KEY `staff_id_fk` (`staff_id_fk`),
  ADD KEY `role_id_fk` (`role_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_college_mst`
--
ALTER TABLE `tbl_college_mst`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_module_mst`
--
ALTER TABLE `tbl_module_mst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_password_reset_tokens`
--
ALTER TABLE `tbl_password_reset_tokens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_plan_modules`
--
ALTER TABLE `tbl_plan_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_plan_mst`
--
ALTER TABLE `tbl_plan_mst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_role_mst`
--
ALTER TABLE `tbl_role_mst`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role_permission_mst`
--
ALTER TABLE `tbl_role_permission_mst`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_staff_mst`
--
ALTER TABLE `tbl_staff_mst`
  MODIFY `staff_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users_login`
--
ALTER TABLE `tbl_users_login`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_college_mst`
--
ALTER TABLE `tbl_college_mst`
  ADD CONSTRAINT `tbl_college_mst_ibfk_1` FOREIGN KEY (`plan_id_fk`) REFERENCES `tbl_plan_mst` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `tbl_course_ibfk_1` FOREIGN KEY (`college_id_fk`) REFERENCES `tbl_college_mst` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_course_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `tbl_staff_mst` (`staff_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_course_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `tbl_staff_mst` (`staff_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_course_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `tbl_staff_mst` (`staff_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_plan_modules`
--
ALTER TABLE `tbl_plan_modules`
  ADD CONSTRAINT `tbl_plan_modules_ibfk_1` FOREIGN KEY (`module_id_fk`) REFERENCES `tbl_module_mst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_plan_modules_ibfk_2` FOREIGN KEY (`plan_id_fk`) REFERENCES `tbl_plan_mst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_role_permission_mst`
--
ALTER TABLE `tbl_role_permission_mst`
  ADD CONSTRAINT `tbl_role_permission_mst_ibfk_1` FOREIGN KEY (`role_id_fk`) REFERENCES `tbl_role_mst` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_role_permission_mst_ibfk_2` FOREIGN KEY (`module_id_fk`) REFERENCES `tbl_module_mst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users_login`
--
ALTER TABLE `tbl_users_login`
  ADD CONSTRAINT `tbl_users_login_ibfk_1` FOREIGN KEY (`college_id_fk`) REFERENCES `tbl_college_mst` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_users_login_ibfk_2` FOREIGN KEY (`staff_id_fk`) REFERENCES `tbl_staff_mst` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_users_login_ibfk_3` FOREIGN KEY (`role_id_fk`) REFERENCES `tbl_role_mst` (`role_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
