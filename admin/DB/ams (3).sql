-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 09:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendences`
--

CREATE TABLE `attendences` (
  `id` int(100) NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp(6) NULL DEFAULT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendences`
--

INSERT INTO `attendences` (`id`, `check_in`, `check_out`, `user_id`) VALUES
(1, '2023-07-24 19:11:00', '2023-07-26 19:14:00.000000', 18),
(2, '2023-07-26 19:15:00', NULL, 19),
(3, '2023-07-26 19:24:00', '2023-07-26 19:25:00.000000', 18),
(4, '2023-07-28 14:30:00', '2023-07-28 17:41:00.000000', 18),
(5, '2023-07-28 18:37:00', '2023-07-28 18:37:00.000000', 11),
(7, '2023-07-28 19:14:00', NULL, 18);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `id` int(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` datetime(6) NOT NULL,
  `end_date` datetime(6) NOT NULL,
  `leave_count` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`id`, `leave_type`, `start_date`, `end_date`, `leave_count`, `user_id`, `status`, `created_at`) VALUES
(1, 'casual', '2023-07-04 00:00:00.000000', '2023-07-21 00:00:00.000000', 17, 11, 'Approved', '2023-07-23 15:01:22.881314'),
(2, 'casual', '2023-07-04 00:00:00.000000', '2023-07-12 00:00:00.000000', 8, 18, 'Rejected', '2023-07-23 15:11:31.452925'),
(3, 'sick', '2023-07-04 00:00:00.000000', '2023-07-13 00:00:00.000000', 9, 18, 'Approved', '2023-07-23 15:43:55.292184'),
(4, 'casual', '2023-07-26 00:00:00.000000', '2023-07-29 00:00:00.000000', 4, 18, 'Approved', '2023-07-27 00:29:09.536082'),
(5, 'casual', '2023-07-28 00:00:00.000000', '2023-07-30 00:00:00.000000', 2, 18, 'Approved', '2023-07-27 00:34:46.639083');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(100) NOT NULL,
  `casual_leaves` int(100) NOT NULL,
  `componsatory_leaves` int(100) NOT NULL,
  `medical_leaves` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `casual_leaves`, `componsatory_leaves`, `medical_leaves`) VALUES
(1, 22, 2, 80);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `type`) VALUES
(1, 'Admin', 'admin'),
(2, 'Employee', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `remaining_leaves` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `city`, `remaining_leaves`, `role_id`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$o1GR69mFeGTZf5DOz625N.5DZZeQsBjZHEU5s5Sip7VyYdlOw8Q6C', 'Lahore', 0, 1),
(10, 'Kamal khna', 'kamal@swishtag.com', '$2y$10$XqRb29PY43e9MnLwDIPZfOdg4QuzgSLfizpBrtvsi4GVYNQHJXlAm', 'Lahore', 0, 2),
(11, 'Ali', 'ali@gmail.com', '$2y$10$VehjVev/dtwIhTFc0Cq1s.dnA0R5J84v5SppaVR7m9G12yGqpnUja', 'Lahore', 0, 2),
(12, 'test@gmail.com', 'ali@KAMAL.com', '$2y$10$w.q3BBkH/IExgKt/4VszzO4fAjNlPbRlYMbhwX27LufcilPEJRWRa', '', 0, 2),
(13, 'test@gmail.com', 'ali222@swishtag.com', '$2y$10$jziYU7NcPiWOuliZpuyIm.95ZmksSaKJkuEk46gfYXNIr9oUSArQ.', '', 0, 2),
(14, 'test@gmail.com', 'alidd@swishtag.com', '$2y$10$b/48qQCt4lLGDH/ZLmM6P.5PGUQ6Q/w.BFoECUny3METq2o1CymPe', '', 0, 2),
(18, 'Ahmed', 'ahmed@gmail.com', '$2y$10$.GYYoRo7pfXoVO/mKbLNOuyjzS180jPpGZDzEd68KwhLHJ58H5dh2', '', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendences`
--
ALTER TABLE `attendences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `attendences`
--
ALTER TABLE `attendences`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
