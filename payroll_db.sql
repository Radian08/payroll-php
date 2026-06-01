-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 07:20 AM
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
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time DEFAULT NULL,
  `notes` varchar(50) NOT NULL,
  `attendance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `userid`, `check_in`, `check_out`, `notes`, `attendance_date`) VALUES
(1, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-03'),
(2, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-04'),
(3, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-05'),
(4, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-06'),
(5, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-07'),
(6, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-10'),
(7, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-11'),
(8, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-12'),
(9, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-13'),
(10, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-14'),
(11, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-17'),
(12, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-18'),
(13, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-19'),
(14, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-20'),
(15, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-21'),
(16, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-24'),
(17, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-25'),
(18, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-26'),
(19, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-27'),
(20, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-03'),
(21, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-04'),
(22, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-05'),
(23, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-06'),
(24, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-07'),
(25, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-10'),
(26, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-11'),
(27, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-12'),
(28, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-13'),
(29, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-14'),
(30, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-17'),
(31, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-18'),
(32, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-19'),
(33, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-20'),
(34, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-21'),
(35, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-24'),
(36, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-25'),
(37, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-26'),
(38, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-27'),
(39, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-03'),
(40, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-04'),
(41, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-05'),
(42, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-06'),
(43, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-07'),
(44, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-10'),
(45, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-11'),
(46, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-12'),
(47, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-13'),
(48, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-14'),
(49, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-17'),
(50, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-18'),
(51, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-19'),
(52, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-20'),
(53, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-21'),
(54, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-24'),
(55, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-25'),
(56, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-26'),
(58, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-03'),
(59, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-04'),
(60, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-05'),
(61, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-06'),
(62, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-07'),
(63, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-10'),
(64, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-11'),
(65, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-12'),
(66, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-13'),
(67, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-14'),
(68, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-17'),
(69, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-18'),
(70, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-19'),
(71, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-20'),
(72, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-21'),
(73, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-24'),
(74, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-03-25'),
(75, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-01'),
(76, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-02'),
(77, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-03'),
(78, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-04'),
(79, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-07'),
(80, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-08'),
(81, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-09'),
(82, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-10'),
(83, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-11'),
(84, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-14'),
(85, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-15'),
(86, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-16'),
(87, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-17'),
(88, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-18'),
(89, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-21'),
(90, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-22'),
(91, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-23'),
(92, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-24'),
(93, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-25'),
(94, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-28'),
(95, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-29'),
(96, 1, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-30'),
(97, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-01'),
(98, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-02'),
(99, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-03'),
(100, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-04'),
(101, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-07'),
(102, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-08'),
(103, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-09'),
(104, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-10'),
(105, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-11'),
(106, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-14'),
(107, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-15'),
(108, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-16'),
(109, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-17'),
(110, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-18'),
(111, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-21'),
(112, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-22'),
(113, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-23'),
(114, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-24'),
(115, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-25'),
(116, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-28'),
(117, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-29'),
(118, 2, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-30'),
(119, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-01'),
(120, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-02'),
(121, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-03'),
(122, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-04'),
(123, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-07'),
(124, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-08'),
(125, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-09'),
(126, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-10'),
(127, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-11'),
(128, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-14'),
(129, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-15'),
(130, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-16'),
(131, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-17'),
(132, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-18'),
(133, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-21'),
(134, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-22'),
(135, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-23'),
(136, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-24'),
(137, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-25'),
(138, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-28'),
(139, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-29'),
(140, 3, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-30'),
(141, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-02'),
(142, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-03'),
(143, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-04'),
(144, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-01'),
(145, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-07'),
(146, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-08'),
(147, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-09'),
(148, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-10'),
(149, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-11'),
(150, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-14'),
(151, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-15'),
(152, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-16'),
(153, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-17'),
(154, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-18'),
(155, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-21'),
(156, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-22'),
(157, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-23'),
(158, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-24'),
(159, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-25'),
(160, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-28'),
(161, 4, '07:30:00', '16:30:00', 'Masuk dengan absen online', '2025-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `userid`, `leave_type`, `start_date`, `end_date`, `total_days`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Cuti Tahunan', '2025-03-25', '2025-03-27', 2, 'acara keluarga', 'approved', '2025-04-18 10:41:29', '2025-04-18 10:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `manual_allowances`
--

CREATE TABLE `manual_allowances` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payroll_month` varchar(2) NOT NULL,
  `payroll_year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_deductions`
--

CREATE TABLE `manual_deductions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payroll_month` varchar(2) NOT NULL,
  `payroll_year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `overtime_requests`
--

CREATE TABLE `overtime_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `overtime_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_time` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `overtime_requests`
--

INSERT INTO `overtime_requests` (`id`, `userid`, `overtime_date`, `start_time`, `end_time`, `total_time`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-03-26', '19:00:00', '22:00:00', 3, 'deploy fitur baru', 'approved', '2025-04-18 10:53:06', '2025-04-18 10:54:02'),
(2, 3, '2025-03-28', '18:00:00', '23:00:00', 5, 'tutup buku', 'approved', '2025-04-18 12:58:30', '2025-04-18 12:59:09'),
(3, 4, '2025-03-25', '18:00:00', '20:00:00', 2, 'ngopi', 'rejected', '2025-04-18 12:59:49', '2025-04-18 13:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payroll_month` varchar(2) NOT NULL,
  `payroll_year` varchar(4) NOT NULL,
  `base_salary` int(11) NOT NULL,
  `total_overtime` int(11) NOT NULL,
  `total_allowance` int(11) NOT NULL,
  `total_deduction` int(11) NOT NULL,
  `net_salary` int(11) NOT NULL,
  `generated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `userid`, `payroll_month`, `payroll_year`, `base_salary`, `total_overtime`, `total_allowance`, `total_deduction`, `net_salary`, `generated_at`) VALUES
(11, 1, '03', '2025', 1000000, 0, 1337000, 500000, 1837000, '2025-04-29 06:00:55'),
(12, 4, '03', '2025', 3000000, 0, 3811000, 0, 6811000, '2025-04-29 06:00:55'),
(13, 2, '03', '2025', 1000000, 90000, 1337000, 0, 2427000, '2025-04-29 06:00:55'),
(14, 3, '03', '2025', 2000000, 250000, 2574000, 105263, 4718737, '2025-04-29 06:00:55'),
(15, 1, '04', '2025', 1000000, 0, 337000, 0, 1337000, '2025-05-01 07:52:14'),
(16, 4, '04', '2025', 3000000, 0, 811000, 136364, 3674636, '2025-05-01 07:52:14'),
(17, 2, '04', '2025', 1000000, 0, 1337000, 0, 2337000, '2025-05-01 07:52:14'),
(18, 3, '04', '2025', 2000000, 0, 574000, 0, 2574000, '2025-05-01 07:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` int(11) NOT NULL,
  `payroll_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payroll_type` enum('allowance','deduction') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `payroll_id`, `name`, `amount`, `payroll_type`) VALUES
(29, 11, 'Uang Makan', 300000, 'allowance'),
(30, 11, 'BPJS Kesehatan (3,7%)', 337000, 'allowance'),
(31, 11, 'THR 2025', 1000000, 'allowance'),
(32, 11, 'Kasbon', 500000, 'deduction'),
(33, 12, 'Uang Makan', 700000, 'allowance'),
(34, 12, 'BPJS Kesehatan (3,7%)', 811000, 'allowance'),
(35, 12, 'THR 2025', 3000000, 'allowance'),
(36, 13, 'Uang Makan', 300000, 'allowance'),
(37, 13, 'BPJS Kesehatan (3,7%)', 337000, 'allowance'),
(38, 13, 'THR 2025', 1000000, 'allowance'),
(39, 14, 'Alpha', 105263, 'deduction'),
(40, 14, 'Uang Makan', 500000, 'allowance'),
(41, 14, 'BPJS Kesehatan (3,7%)', 574000, 'allowance'),
(42, 14, 'THR 2025', 2000000, 'allowance'),
(43, 15, 'Uang Makan', 300000, 'allowance'),
(44, 15, 'BPJS Kesehatan (3,7%)', 337000, 'allowance'),
(45, 16, 'Alpha', 136364, 'deduction'),
(46, 16, 'Uang Makan', 700000, 'allowance'),
(47, 16, 'BPJS Kesehatan (3,7%)', 811000, 'allowance'),
(48, 17, 'Uang Makan', 300000, 'allowance'),
(49, 17, 'BPJS Kesehatan (3,7%)', 337000, 'allowance'),
(50, 17, 'Uang Cuti 2025', 1000000, 'allowance'),
(51, 18, 'Uang Makan', 500000, 'allowance'),
(52, 18, 'BPJS Kesehatan (3,7%)', 574000, 'allowance');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `base_salary` int(11) NOT NULL,
  `overtime_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `base_salary`, `overtime_rate`) VALUES
(1, 'Staff', 1000000, 30000),
(2, 'Supervisor', 2000000, 50000),
(3, 'Manager', 3000000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `position_allowances`
--

CREATE TABLE `position_allowances` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `allowance_type` enum('fixed','percentage') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position_allowances`
--

INSERT INTO `position_allowances` (`id`, `position_id`, `name`, `amount`, `allowance_type`) VALUES
(1, 1, 'Uang Makan', 300000.00, 'fixed'),
(2, 1, 'BPJS Kesehatan (3,7%)', 3.70, 'percentage'),
(3, 2, 'Uang Makan', 500000.00, 'fixed'),
(4, 2, 'BPJS Kesehatan (3,7%)', 3.70, 'percentage'),
(5, 3, 'Uang Makan', 700000.00, 'fixed'),
(6, 3, 'BPJS Kesehatan (3,7%)', 3.70, 'percentage');

-- --------------------------------------------------------

--
-- Table structure for table `public_holidays`
--

CREATE TABLE `public_holidays` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(100) NOT NULL,
  `holiday_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_holidays`
--

INSERT INTO `public_holidays` (`id`, `holiday_name`, `holiday_date`, `created_by`, `created_at`) VALUES
(1, 'Cuti Bersama', '2025-03-28', 1, '2025-03-23 09:25:56'),
(2, 'Hari Suci Nyepi', '2025-03-29', 1, '2025-03-23 09:32:00'),
(5, 'Hari Raya Idul Fitri 1446 H', '2025-03-31', 1, '2025-03-23 10:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `position_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `position_id`, `created_at`) VALUES
(1, 'Radiansyah Akmal', 'admin', '$2y$10$Am4FslRNj6PSwbN4qOiMsemnLnRvR2V3qnZDwZPzaFRTZT60ijguy', 'admin', 3, '2025-04-18 10:37:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_allowances`
--
ALTER TABLE `manual_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_deductions`
--
ALTER TABLE `manual_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_requests`
--
ALTER TABLE `overtime_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_allowances`
--
ALTER TABLE `position_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_holidays`
--
ALTER TABLE `public_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manual_allowances`
--
ALTER TABLE `manual_allowances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manual_deductions`
--
ALTER TABLE `manual_deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `overtime_requests`
--
ALTER TABLE `overtime_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position_allowances`
--
ALTER TABLE `position_allowances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `public_holidays`
--
ALTER TABLE `public_holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
