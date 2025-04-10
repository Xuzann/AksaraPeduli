-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 02:05 PM
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
-- Database: `aksarapeduli`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `user_id`, `amount`, `donation_date`) VALUES
(1, 4, 50000.00, '2024-01-09 17:00:00'),
(2, 4, 75000.00, '2024-02-14 17:00:00'),
(3, 4, 30000.00, '2024-02-27 17:00:00'),
(4, 4, 100000.00, '2024-03-04 17:00:00'),
(5, 4, 25000.00, '2024-04-19 17:00:00'),
(6, 4, 60000.00, '2024-05-11 17:00:00'),
(7, 4, 90000.00, '2024-06-24 17:00:00'),
(8, 4, 120000.00, '2024-07-06 17:00:00'),
(9, 4, 35000.00, '2024-08-18 17:00:00'),
(10, 4, 40000.00, '2024-09-29 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `email`, `password`, `profile_picture`, `created_at`) VALUES
(4, 'admin', 'admin@gmail.com', '$2y$10$pvO9wwg48nlBNqIiPfsIveVohwv8uJEjj3W36QtR./W.Zq8CvGY9K', 'profile_67e278ac9514e.jpg', '2025-03-23 08:22:06'),
(8, 'Farrel Ega', '23082010143@student.upnjatim.ac.id', '$2y$10$mQmp.eSeFFvBOTmu14S9YeVYS1LHR2hJkwws/so8P6zabdmNy8ZvG', 'profile_67f51ed82e8d7.jpg', '2025-04-08 13:01:46'),
(10, 'admin1', 'admin1@gmail.com', '$2y$10$DI61KnBS/Sck.sDgcC5H5.i6gCZ4f/m5mG4htpWBbI.y3Ch47I5wS', '', '2025-04-08 14:23:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
