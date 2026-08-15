-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2026 at 12:06 PM
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
(1, 5, 28, 'Male', 78.00, 178.00, 'moderately_active', 1.80, 65, 2560, 24.6, 'Normal weight', '2026-08-15', '2026-08-15 09:05:46'),
(2, 5, 28, 'Male', 78.00, 178.00, 'moderately_active', 1.80, 65, 2535, 24.6, 'Normal weight', '2026-08-15', '2026-08-15 09:06:47'),
(3, 5, 22, 'Female', 45.00, 152.00, 'very_active', 1.80, 60, 2510, 19.5, 'Normal weight', '2026-08-15', '2026-08-15 09:22:59'),
(4, 5, 22, 'Female', 45.00, 152.00, 'moderately_active', 1.80, 57, 2467, 19.5, 'Normal weight', '2026-08-15', '2026-08-15 09:43:34'),
(5, 6, 28, 'Male', 78.00, 178.00, 'moderately_active', 1.80, 58, 2481, 24.6, 'Normal weight', '2026-08-15', '2026-08-15 09:46:04');

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
(4, 'Kavishka', 'Dhananjaya', 'kavishkadhananjayaab@gmail.com', 'kavishka', '$2y$10$erUVNF6tz8edzCbXZNlKBeF6XQYjKrDvYi1wBQ5bYYOJgo4FXc.o6', '2026-08-11 20:28:51'),
(5, 'Pasan', 'Nadeesha', 'pasannadeesha1@gmail.com', 'pasannadeesha', '$2y$10$VOddEckwk0mGjqapiFoDpeTafUyWMoEwMkJ.toz6271NgIbk1E0Jy', '2026-08-14 16:47:01'),
(6, 'Dushan', 'Eranda', 'dushan@gmail.com', 'dushan', '$2y$10$h1UnlgxnLZ0sMJ67plK7Je5uBbd.u8W.mN9lkywrhcQooDBi9YcGy', '2026-08-15 09:27:00'),
(7, 'Zenith', 'Chethiya', 'zenith@gmail.com', 'zenith', '$2y$10$JGWkapZ7D51sk69UE.KKdOtV9ffClS7z6nkH1X0mfL0X.brHMr0J.', '2026-08-15 10:00:31');

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
(1, 5, 'Running', 20, 200, 'High', '2026-08-15 11:05:46'),
(2, 5, 'Cycling', 15, 120, 'Moderate', '2026-08-15 11:05:46'),
(3, 5, 'Weight Training', 10, 60, 'High', '2026-08-15 11:05:46'),
(4, 5, 'Swimming', 20, 180, 'Moderate', '2026-08-15 11:05:46'),
(5, 5, 'Running', 10, 100, 'High', '2026-08-15 11:06:47'),
(6, 5, 'Cycling', 30, 240, 'Moderate', '2026-08-15 11:06:47'),
(7, 5, 'Weight Training', 10, 60, 'High', '2026-08-15 11:06:47'),
(8, 5, 'Swimming', 15, 135, 'Moderate', '2026-08-15 11:06:47'),
(9, 5, 'Running', 15, 150, 'High', '2026-08-15 11:22:59'),
(10, 5, 'Cycling', 15, 120, 'Moderate', '2026-08-15 11:22:59'),
(11, 5, 'Weight Training', 10, 60, 'High', '2026-08-15 11:22:59'),
(12, 5, 'Swimming', 20, 180, 'Moderate', '2026-08-15 11:22:59'),
(13, 5, 'Running', 10, 100, 'High', '2026-08-15 11:43:34'),
(14, 5, 'Cycling', 20, 160, 'Moderate', '2026-08-15 11:43:34'),
(15, 5, 'Weight Training', 12, 72, 'High', '2026-08-15 11:43:34'),
(16, 5, 'Swimming', 15, 135, 'Moderate', '2026-08-15 11:43:34'),
(17, 6, 'Running', 10, 100, 'High', '2026-08-15 11:46:04'),
(18, 6, 'Cycling', 15, 120, 'Moderate', '2026-08-15 11:46:04'),
(19, 6, 'Weight Training', 12, 72, 'High', '2026-08-15 11:46:04'),
(20, 6, 'Swimming', 21, 189, 'Moderate', '2026-08-15 11:46:04');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `workout_history`
--
ALTER TABLE `workout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
