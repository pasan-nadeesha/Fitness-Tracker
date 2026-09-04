-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2026 at 07:59 AM
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
(71, 8, 'Swimming', 15, 135, 'Moderate', '2026-08-16 14:08:17'),
(72, 8, 'Running', 15, 150, 'High', '2026-09-04 07:49:17'),
(73, 8, 'Cycling', 20, 160, 'Moderate', '2026-09-04 07:49:17'),
(74, 8, 'Weight Training', 10, 60, 'High', '2026-09-04 07:49:17'),
(75, 8, 'Swimming', 5, 45, 'Moderate', '2026-09-04 07:49:17'),
(76, 9, 'Running', 16, 160, 'High', '2026-09-04 07:54:44'),
(77, 9, 'Cycling', 11, 88, 'Moderate', '2026-09-04 07:54:44'),
(78, 9, 'Weight Training', 11, 66, 'High', '2026-09-04 07:54:44'),
(79, 9, 'Swimming', 19, 171, 'Moderate', '2026-09-04 07:54:44');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `workout_history`
--
ALTER TABLE `workout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workout_history`
--
ALTER TABLE `workout_history`
  ADD CONSTRAINT `workout_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
