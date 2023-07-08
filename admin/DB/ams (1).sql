-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 09:13 PM
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
(1, 'casual', '2023-07-17 22:18:16.000000', '2023-07-18 22:18:16.000000', 10, 10, 'Approved', '0000-00-00 00:00:00.000000'),
(2, 'casual', '2023-07-17 22:18:16.000000', '2023-07-18 22:18:16.000000', 8, 3, 'Approved', '0000-00-00 00:00:00.000000');

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
(10, 'test@gmail.com', 'kamal@swishtag.com', '$2y$10$.fRf0MRRYMnPdz.ate2O2eG1KyMUizYSFhE017lG12h5tkIzeDGQa', 'Lahore', 0, 2),
(11, 'Ali', 'ali@gmail.com', '$2y$10$tZEkCH9TPkbax4y1mAn5Veb7bl87YPf7XWi8NoyB3rGoIJFUSDivm', 'Lahore', 0, 2),
(12, 'test@gmail.com', 'ali@KAMAL.com', '$2y$10$w.q3BBkH/IExgKt/4VszzO4fAjNlPbRlYMbhwX27LufcilPEJRWRa', '', 0, 2),
(13, 'test@gmail.com', 'ali222@swishtag.com', '$2y$10$jziYU7NcPiWOuliZpuyIm.95ZmksSaKJkuEk46gfYXNIr9oUSArQ.', '', 0, 2),
(14, 'test@gmail.com', 'alidd@swishtag.com', '$2y$10$b/48qQCt4lLGDH/ZLmM6P.5PGUQ6Q/w.BFoECUny3METq2o1CymPe', '', 0, 2);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
