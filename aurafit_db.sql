-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2026 at 06:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aurafit_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_fitness_logs`
--

CREATE TABLE `daily_fitness_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `activity_level` varchar(50) NOT NULL,
  `water_intake` decimal(4,2) DEFAULT 0.00,
  `total_workout_time` int(11) DEFAULT 0,
  `total_calories` int(11) DEFAULT 2000,
  `bmi` decimal(4,1) DEFAULT NULL,
  `bmi_status` varchar(50) DEFAULT NULL,
  `log_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_fitness_logs`
--

INSERT INTO `daily_fitness_logs` (`id`, `user_id`, `age`, `gender`, `weight`, `height`, `activity_level`, `water_intake`, `total_workout_time`, `total_calories`, `bmi`, `bmi_status`, `log_date`, `created_at`) VALUES
(17, 8, 22, 'Male', 52.00, 152.00, 'lightly_active', 1.00, 51, 439, 22.5, 'Normal weight', '2026-08-16', '2026-08-16 11:20:01'),
(18, 8, 22, 'Male', 52.00, 152.00, 'moderately_active', 0.60, 40, 325, 22.5, 'Normal weight', '2026-08-16', '2026-08-16 12:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `created_at`) VALUES
(8, 'Pasan', 'Nadeesha', 'pasannadeesha1@gmail.com', 'pasannadeesha', '$2y$10$DMejtrtsnw0afwqPc3ZXfe4Blx6b6VnEnEcH23JIRnisMrg0nUxU2', '2026-08-16 11:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `workout_history`
--

CREATE TABLE `workout_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `workout_type` varchar(50) NOT NULL,
  `duration_min` int(11) NOT NULL,
  `calories_burned` int(11) NOT NULL,
  `intensity` varchar(20) DEFAULT 'Moderate',
  `workout_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_history`
--

INSERT INTO `workout_history` (`id`, `user_id`, `workout_type`, `duration_min`, `calories_burned`, `intensity`, `workout_datetime`) VALUES
(64, 8, 'Running', 10, 100, 'High', '2026-08-16 13:20:01'),
(65, 8, 'Cycling', 15, 120, 'Moderate', '2026-08-16 13:20:01'),
(66, 8, 'Weight Training', 5, 30, 'High', '2026-08-16 13:20:01'),
(67, 8, 'Swimming', 21, 189, 'Moderate', '2026-08-16 13:20:01'),
(68, 8, 'Running', 5, 50, 'High', '2026-08-16 14:08:17'),
(69, 8, 'Cycling', 10, 80, 'Moderate', '2026-08-16 14:08:17'),
(70, 8, 'Weight Training', 10, 60, 'High', '2026-08-16 14:08:17'),
(71, 8, 'Swimming', 15, 135, 'Moderate', '2026-08-16 14:08:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_fitness_logs`
--
ALTER TABLE `daily_fitness_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `workout_history`
--
ALTER TABLE `workout_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_fitness_logs`
--
ALTER TABLE `daily_fitness_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `workout_history`
--
ALTER TABLE `workout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_fitness_logs`
--
ALTER TABLE `daily_fitness_logs`
  ADD CONSTRAINT `daily_fitness_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_history`
--
ALTER TABLE `workout_history`
  ADD CONSTRAINT `workout_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
