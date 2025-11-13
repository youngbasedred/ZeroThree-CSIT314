-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 03:24 PM
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
-- Database: `zerothree`
--
CREATE DATABASE IF NOT EXISTS `zerothree` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `zerothree`;

-- --------------------------------------------------------

--
-- Table structure for table `login_audit`
--

CREATE TABLE `login_audit` (
  `audit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` enum('LOGIN','LOGOUT') NOT NULL,
  `action_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_audit`
--

INSERT INTO `login_audit` (`audit_id`, `user_id`, `action`, `action_time`, `ip_address`) VALUES
(1, 1, 'LOGIN', '2025-11-11 00:25:20', '127.0.0.1'),
(2, 1, 'LOGOUT', '2025-11-11 00:25:20', '127.0.0.1'),
(3, 11, 'LOGIN', '2025-11-11 00:25:20', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `pin_user_id` int(11) NOT NULL,
  `csr_user_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `status` enum('CONFIRMED','COMPLETED','CANCELLED') NOT NULL DEFAULT 'CONFIRMED',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `request_id`, `pin_user_id`, `csr_user_id`, `service_date`, `status`, `created_at`, `completed_at`) VALUES
(1, 2, 11, 41, '2025-11-18', 'COMPLETED', '2025-11-11 00:25:20', '2025-11-18 00:00:00'),
(2, 4, 13, 42, '2025-11-05', 'COMPLETED', '2025-11-11 00:25:20', '2025-11-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `pin_user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `status` enum('OPEN','CONFIRMED','COMPLETED','CANCELLED') NOT NULL DEFAULT 'OPEN',
  `view_count` int(11) NOT NULL DEFAULT 0,
  `shortlist_count` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `pin_user_id`, `category_id`, `title`, `description`, `location`, `preferred_date`, `status`, `view_count`, `shortlist_count`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'Weekly Meal Delivery', 'Need volunteers to deliver cooked meals to my block.', 'Bedok', '2025-11-20', 'OPEN', 5, 1, '2025-11-11 00:25:19', NULL),
(2, 11, 2, 'Escort to Clinic', 'Require help to go to clinic appointment.', 'Tampines', '2025-11-18', 'CONFIRMED', 10, 2, '2025-11-11 00:25:19', NULL),
(3, 12, 3, 'Homework Coaching', 'Need tutor for primary school math.', 'Hougang', '2025-11-25', 'OPEN', 3, 0, '2025-11-11 00:25:19', NULL),
(4, 13, 4, 'Park Cleanup Event', 'Looking for volunteers to clean local park.', 'Pasir Ris Park', '2025-12-02', 'COMPLETED', 20, 4, '2025-11-11 00:25:19', NULL),
(5, 14, 5, 'Health Screening Support', 'Help with registration at health screening event.', 'Yishun CC', '2025-11-30', 'OPEN', 2, 1, '2025-11-11 00:25:19', NULL),
(13, 11, 3, 'davidtest', 'davidtest1', 'Bedok', '2025-11-13', 'OPEN', 0, 0, '2025-11-11 17:13:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_shortlists`
--

CREATE TABLE `request_shortlists` (
  `shortlist_id` int(11) NOT NULL,
  `csr_user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `shortlisted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_shortlists`
--

INSERT INTO `request_shortlists` (`shortlist_id`, `csr_user_id`, `request_id`, `shortlisted_at`) VALUES
(1, 41, 1, '2025-11-11 00:25:20'),
(2, 41, 2, '2025-11-11 00:25:20'),
(3, 42, 2, '2025-11-11 00:25:20'),
(4, 42, 4, '2025-11-11 00:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Food Distribution', 'Deliver meals to families in need', 1, '2025-11-11 00:25:19', NULL),
(2, 'Elderly Care', 'Assist seniors with daily activities', 1, '2025-11-11 00:25:19', NULL),
(3, 'Education Support', 'Tutoring and mentoring students', 1, '2025-11-11 00:25:19', NULL),
(4, 'Environmental Cleanup', 'Clean public areas and parks', 1, '2025-11-11 00:25:19', NULL),
(5, 'Healthcare Aid', 'Support medical/health events', 1, '2025-11-11 00:25:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shortlist`
--

CREATE TABLE `shortlist` (
  `shortlist_id` int(11) NOT NULL,
  `csr_user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('ACTIVE','SUSPENDED') NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `last_login_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_id`, `username`, `role`, `password`, `email`, `phone`, `status`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 1, 'useradmin01', 'User Admin', 'useradmin01pass', 'useradmin01@example.com', '80000001', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(2, 1, 'useradmin02', 'User Admin', 'useradmin02pass', 'useradmin02@example.com', '80000002', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(3, 1, 'useradmin03', 'User Admin', 'useradmin03pass', 'useradmin03@example.com', '80000003', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(4, 1, 'useradmin04', 'User Admin', 'useradmin04pass', 'useradmin04@example.com', '80000004', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(5, 1, 'useradmin05', 'User Admin', 'useradmin05pass', 'useradmin05@example.com', '80000005', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(6, 1, 'useradmin06', 'User Admin', 'useradmin06pass', 'useradmin06@example.com', '80000006', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(7, 1, 'useradmin07', 'User Admin', 'useradmin07pass', 'useradmin07@example.com', '80000007', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(8, 1, 'useradmin08', 'User Admin', 'useradmin08pass', 'useradmin08@example.com', '80000008', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(9, 1, 'useradmin09', 'User Admin', 'useradmin09pass', 'useradmin09@example.com', '80000009', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(10, 1, 'useradmin10', 'User Admin', 'useradmin10pass', 'useradmin10@example.com', '80000010', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 11:59:24', NULL),
(11, 2, 'pin01', 'PIN', 'pin01pass', 'pin01@example.com', '80000011', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(12, 2, 'pin02', 'PIN', 'pin02pass', 'pin02@example.com', '80000012', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 20:51:52', NULL),
(13, 2, 'pin03', 'PIN', 'pin03pass', 'pin03@example.com', '80000013', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(14, 2, 'pin04', 'PIN', 'pin04pass', 'pin04@example.com', '80000014', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(15, 2, 'pin05', 'PIN', 'pin05pass', 'pin05@example.com', '80000015', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(16, 2, 'pin06', 'PIN', 'pin06pass', 'pin06@example.com', '80000016', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(17, 2, 'pin07', 'PIN', 'pin07pass', 'pin07@example.com', '80000017', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(18, 2, 'pin08', 'PIN', 'pin08pass', 'pin08@example.com', '80000018', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(19, 2, 'pin09', 'PIN', 'pin09pass', 'pin09@example.com', '80000019', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(20, 2, 'pin10', 'PIN', 'pin10pass', 'pin10@example.com', '80000020', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(21, 2, 'pin11', 'PIN', 'pin11pass', 'pin11@example.com', '80000021', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(22, 2, 'pin12', 'PIN', 'pin12pass', 'pin12@example.com', '80000022', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(23, 2, 'pin13', 'PIN', 'pin13pass', 'pin13@example.com', '80000023', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(24, 2, 'pin14', 'PIN', 'pin14pass', 'pin14@example.com', '80000024', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(25, 2, 'pin15', 'PIN', 'pin15pass', 'pin15@example.com', '80000025', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(26, 2, 'pin16', 'PIN', 'pin16pass', 'pin16@example.com', '80000026', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(27, 2, 'pin17', 'PIN', 'pin17pass', 'pin17@example.com', '80000027', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(28, 2, 'pin18', 'PIN', 'pin18pass', 'pin18@example.com', '80000028', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(29, 2, 'pin19', 'PIN', 'pin19pass', 'pin19@example.com', '80000029', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(30, 2, 'pin20', 'PIN', 'pin20pass', 'pin20@example.com', '80000030', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(31, 2, 'pin21', 'PIN', 'pin21pass', 'pin21@example.com', '80000031', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(32, 2, 'pin22', 'PIN', 'pin22pass', 'pin22@example.com', '80000032', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(33, 2, 'pin23', 'PIN', 'pin23pass', 'pin23@example.com', '80000033', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(34, 2, 'pin24', 'PIN', 'pin24pass', 'pin24@example.com', '80000034', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(35, 2, 'pin25', 'PIN', 'pin25pass', 'pin25@example.com', '80000035', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(36, 2, 'pin26', 'PIN', 'pin26pass', 'pin26@example.com', '80000036', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(37, 2, 'pin27', 'PIN', 'pin27pass', 'pin27@example.com', '80000037', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(38, 2, 'pin28', 'PIN', 'pin28pass', 'pin28@example.com', '80000038', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(39, 2, 'pin29', 'PIN', 'pin29pass', 'pin29@example.com', '80000039', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(40, 2, 'pin30', 'PIN', 'pin30pass', 'pin30@example.com', '80000040', 'ACTIVE', '2025-11-11 00:25:19', NULL, NULL),
(41, 3, 'csr01', 'CSR', 'csr01pass', 'csr01@example.com', '80000041', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(42, 3, 'csr02', 'CSR', 'csr02pass', 'csr02@example.com', '80000042', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(43, 3, 'csr03', 'CSR', 'csr03pass', 'csr03@example.com', '80000043', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(44, 3, 'csr04', 'CSR', 'csr04pass', 'csr04@example.com', '80000044', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(45, 3, 'csr05', 'CSR', 'csr05pass', 'csr05@example.com', '80000045', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(46, 3, 'csr06', 'CSR', 'csr06pass', 'csr06@example.com', '80000046', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(47, 3, 'csr07', 'CSR', 'csr07pass', 'csr07@example.com', '80000047', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(48, 3, 'csr08', 'CSR', 'csr08pass', 'csr08@example.com', '80000048', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(49, 3, 'csr09', 'CSR', 'csr09pass', 'csr09@example.com', '80000049', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(50, 3, 'csr10', 'CSR', 'csr10pass', 'csr10@example.com', '80000050', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(51, 3, 'csr11', 'CSR', 'csr11pass', 'csr11@example.com', '80000051', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(52, 3, 'csr12', 'CSR', 'csr12pass', 'csr12@example.com', '80000052', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(53, 3, 'csr13', 'CSR', 'csr13pass', 'csr13@example.com', '80000053', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(54, 3, 'csr14', 'CSR', 'csr14pass', 'csr14@example.com', '80000054', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(55, 3, 'csr15', 'CSR', 'csr15pass', 'csr15@example.com', '80000055', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(56, 3, 'csr16', 'CSR', 'csr16pass', 'csr16@example.com', '80000056', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(57, 3, 'csr17', 'CSR', 'csr17pass', 'csr17@example.com', '80000057', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(58, 3, 'csr18', 'CSR', 'csr18pass', 'csr18@example.com', '80000058', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(59, 3, 'csr19', 'CSR', 'csr19pass', 'csr19@example.com', '80000059', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(60, 3, 'csr20', 'CSR', 'csr20pass', 'csr20@example.com', '80000060', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(61, 3, 'csr21', 'CSR', 'csr21pass', 'csr21@example.com', '80000061', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(62, 3, 'csr22', 'CSR', 'csr22pass', 'csr22@example.com', '80000062', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(63, 3, 'csr23', 'CSR', 'csr23pass', 'csr23@example.com', '80000063', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(64, 3, 'csr24', 'CSR', 'csr24pass', 'csr24@example.com', '80000064', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(65, 3, 'csr25', 'CSR', 'csr25pass', 'csr25@example.com', '80000065', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(66, 3, 'csr26', 'CSR', 'csr26pass', 'csr26@example.com', '80000066', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(67, 3, 'csr27', 'CSR', 'csr27pass', 'csr27@example.com', '80000067', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(68, 3, 'csr28', 'CSR', 'csr28pass', 'csr28@example.com', '80000068', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(69, 3, 'csr29', 'CSR', 'csr29pass', 'csr29@example.com', '80000069', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(70, 3, 'csr30', 'CSR', 'csr30pass', 'csr30@example.com', '80000070', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(71, 3, 'csr31', 'CSR', 'csr31pass', 'csr31@example.com', '80000071', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(72, 3, 'csr32', 'CSR', 'csr32pass', 'csr32@example.com', '80000072', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(73, 3, 'csr33', 'CSR', 'csr33pass', 'csr33@example.com', '80000073', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(74, 3, 'csr34', 'CSR', 'csr34pass', 'csr34@example.com', '80000074', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(75, 3, 'csr35', 'CSR', 'csr35pass', 'csr35@example.com', '80000075', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(76, 3, 'csr36', 'CSR', 'csr36pass', 'csr36@example.com', '80000076', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(77, 3, 'csr37', 'CSR', 'csr37pass', 'csr37@example.com', '80000077', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(78, 3, 'csr38', 'CSR', 'csr38pass', 'csr38@example.com', '80000078', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(79, 3, 'csr39', 'CSR', 'csr39pass', 'csr39@example.com', '80000079', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(80, 3, 'csr40', 'CSR', 'csr40pass', 'csr40@example.com', '80000080', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(81, 4, 'pm01', 'PM', 'pm01pass', 'pm01@example.com', '80000081', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(82, 4, 'pm02', 'PM', 'pm02pass', 'pm02@example.com', '80000082', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(83, 4, 'pm03', 'PM', 'pm03pass', 'pm03@example.com', '80000083', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(84, 4, 'pm04', 'PM', 'pm04pass', 'pm04@example.com', '80000084', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(85, 4, 'pm05', 'PM', 'pm05pass', 'pm05@example.com', '80000085', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(86, 4, 'pm06', 'PM', 'pm06pass', 'pm06@example.com', '80000086', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(87, 4, 'pm07', 'PM', 'pm07pass', 'pm07@example.com', '80000087', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(88, 4, 'pm08', 'PM', 'pm08pass', 'pm08@example.com', '80000088', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(89, 4, 'pm09', 'PM', 'pm09pass', 'pm09@example.com', '80000089', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(90, 4, 'pm10', 'PM', 'pm10pass', 'pm10@example.com', '80000090', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(91, 4, 'pm11', 'PM', 'pm11pass', 'pm11@example.com', '80000091', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(92, 4, 'pm12', 'PM', 'pm12pass', 'pm12@example.com', '80000092', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(93, 4, 'pm13', 'PM', 'pm13pass', 'pm13@example.com', '80000093', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(94, 4, 'pm14', 'PM', 'pm14pass', 'pm14@example.com', '80000094', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(95, 4, 'pm15', 'PM', 'pm15pass', 'pm15@example.com', '80000095', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(96, 4, 'pm16', 'PM', 'pm16pass', 'pm16@example.com', '80000096', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(97, 4, 'pm17', 'PM', 'pm17pass', 'pm17@example.com', '80000097', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(98, 4, 'pm18', 'PM', 'pm18pass', 'pm18@example.com', '80000098', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(99, 4, 'pm19', 'PM', 'pm19pass', 'pm19@example.com', '80000099', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(100, 4, 'pm20', 'PM', 'pm20pass', 'pm20@example.com', '80000100', 'ACTIVE', '2025-11-11 00:25:19', '2025-11-13 02:01:06', NULL),
(123, 2, '123456', 'PIN', '12456', '123456@gmail.com', '12345', 'ACTIVE', '2025-11-13 21:36:34', NULL, NULL),
(124, 3, '123', 'CSR Representative', '123', '123@gmail.com', '123', 'ACTIVE', '2025-11-13 21:36:58', NULL, NULL),
(125, 4, '1234', 'Platform Manager', '1234', '1234@gmail.com', '12345679', 'ACTIVE', '2025-11-13 21:37:23', NULL, NULL),
(126, 1, 'phpunit_user_6915e16108d1d', 'User Admin', 'secret123', 'phpunit_user_6915e16108d1d@example.com', '99999999', 'ACTIVE', '2025-11-13 21:47:13', NULL, NULL),
(127, 1, 'phpunit_dup_6915e1610b130', 'User Admin', 'secret123', 'phpunit_dup_6915e1610b130@example.com', '88888888', 'ACTIVE', '2025-11-13 21:47:13', NULL, NULL),
(128, 1, 'phpunit_dup_6915e67c9a873', 'User Admin', 'Password123!', 'phpunit_dup_6915e67c9a873@example.com', '99999999', 'ACTIVE', '2025-11-13 22:09:00', NULL, NULL),
(129, 1, 'phpunit_user_6915e67c9c9e4', 'User Admin', 'Password123!', 'phpunit_user_6915e67c9c9e4@example.com', '99999999', 'ACTIVE', '2025-11-13 22:09:00', NULL, NULL),
(130, 1, 'phpunit_user_6915e67ca029d', 'User Admin', 'Password123!', 'phpunit_user_6915e67ca029d@example.com', '99999999', 'ACTIVE', '2025-11-13 22:09:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `profile_id` int(11) NOT NULL,
  `profile_name` varchar(50) NOT NULL,
  `profile_status` enum('ACTIVE','SUSPENDED') NOT NULL DEFAULT 'ACTIVE',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`profile_id`, `profile_name`, `profile_status`, `description`) VALUES
(1, 'User Admin', 'ACTIVE', 'Manages user accounts and profiles'),
(2, 'PIN', 'ACTIVE', 'Person-in-Need who requests assistance'),
(3, 'CSR Representative', 'ACTIVE', 'Corporate volunteer representative'),
(4, 'Platform Manager', 'ACTIVE', 'Manages categories and reports');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_audit`
--
ALTER TABLE `login_audit`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `fk_audit_user` (`user_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `fk_matches_request` (`request_id`),
  ADD KEY `fk_matches_pin` (`pin_user_id`),
  ADD KEY `fk_matches_csr` (`csr_user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_requests_pin` (`pin_user_id`),
  ADD KEY `fk_requests_category` (`category_id`);

--
-- Indexes for table `request_shortlists`
--
ALTER TABLE `request_shortlists`
  ADD PRIMARY KEY (`shortlist_id`),
  ADD UNIQUE KEY `uniq_csr_request` (`csr_user_id`,`request_id`),
  ADD KEY `fk_shortlist_request` (`request_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `shortlist`
--
ALTER TABLE `shortlist`
  ADD PRIMARY KEY (`shortlist_id`),
  ADD KEY `csr_user_id` (`csr_user_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_profile` (`profile_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `profile_name` (`profile_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_audit`
--
ALTER TABLE `login_audit`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `request_shortlists`
--
ALTER TABLE `request_shortlists`
  MODIFY `shortlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shortlist`
--
ALTER TABLE `shortlist`
  MODIFY `shortlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_audit`
--
ALTER TABLE `login_audit`
  ADD CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_matches_csr` FOREIGN KEY (`csr_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_matches_pin` FOREIGN KEY (`pin_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_matches_request` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`),
  ADD CONSTRAINT `fk_requests_pin` FOREIGN KEY (`pin_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `request_shortlists`
--
ALTER TABLE `request_shortlists`
  ADD CONSTRAINT `fk_shortlist_csr` FOREIGN KEY (`csr_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_shortlist_request` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `shortlist`
--
ALTER TABLE `shortlist`
  ADD CONSTRAINT `shortlist_ibfk_1` FOREIGN KEY (`csr_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `shortlist_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profile` FOREIGN KEY (`profile_id`) REFERENCES `user_profiles` (`profile_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
