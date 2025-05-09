-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:23 AM
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
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updates` text DEFAULT NULL,
  `target_amount` bigint(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `title`, `image`, `description`, `updates`, `target_amount`, `deadline`, `created_at`) VALUES
(2, 'Perbaikan Sekolah SDN Tadika Mesra', '../uploads/campaigns/67fb64094ade2_sekolah.jpg', 'Ruang kelas bocor, dinding retak, tapi semangat anak-anak SDN Tadika Mesra tak pernah padam. Bantu mereka mendapat tempat belajar yang layak. Sekecil apa pun donasimu, besar artinya bagi masa depan mereka.', 'Sebanyak 50 set meja dan kursi telah berhasil dipesan dan saat ini tengah dalam proses pengiriman. Diperkirakan akan tiba di lokasi dalam dua minggu ke depan. Kehadiran sarana ini sangat dinanti-nanti, karena sebelumnya para siswa harus belajar tanpa tempat duduk yang layak.', 30000000, '2025-07-01', '2025-04-13 07:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `campaign_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `user_id`, `amount`, `payment_method`, `donation_date`, `campaign_id`, `review_text`) VALUES
(11, 8, 50000.00, '', '2025-03-01 02:00:00', 2, NULL),
(12, 8, 75000.00, '', '2025-04-05 03:30:00', 2, NULL),
(13, 8, 100000.00, '', '2025-05-08 04:45:00', 2, NULL),
(14, 8, 25000.00, '', '2025-06-12 01:15:00', 2, NULL),
(15, 8, 120000.00, '', '2025-07-15 06:00:00', 2, NULL),
(16, 8, 30000.00, '', '2025-08-18 07:20:00', 2, NULL),
(17, 8, 45000.00, '', '2025-03-20 02:50:00', 2, NULL),
(18, 8, 95000.00, '', '2025-04-22 03:10:00', 2, NULL),
(19, 8, 150000.00, '', '2025-05-25 08:30:00', 2, NULL),
(20, 8, 60000.00, '', '2025-06-27 00:45:00', 2, NULL),
(21, 8, 85000.00, '', '2025-07-29 05:00:00', 2, NULL),
(22, 8, 20000.00, '', '2025-08-01 03:10:00', 2, NULL),
(23, 8, 105000.00, '', '2025-04-03 04:15:00', 2, NULL),
(24, 8, 40000.00, '', '2025-05-06 06:45:00', 2, NULL),
(25, 8, 70000.00, '', '2025-06-08 02:30:00', 2, NULL),
(26, 8, 1000000.00, 'shopeepay', '2025-04-13 13:07:18', 2, 'Semoga membantu'),
(28, 8, 1500000.00, 'ovo', '2025-04-13 13:08:01', 2, 'keren banget'),
(30, 8, 10000000.00, 'gopay', '2025-04-13 13:12:58', 2, 'Semoga amanah'),
(31, 11, 20000000.00, 'debit', '2025-04-13 13:21:28', 2, 'Semoga membantu ya');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `email`, `password`, `profile_picture`, `created_at`) VALUES
(8, 'Farrel', '23082010143@student.upnjatim.ac.id', '$2y$10$DaJOIWJ3Bp6sH81acP5QUeK4YBKk2TrmEIXx8jNFBSZoRnVhhPDRu', 0x70726f66696c655f363766623535623335356363312e6a7067, '2025-04-08 13:01:46'),
(10, 'admin1', 'admin1@gmail.com', '$2y$10$DI61KnBS/Sck.sDgcC5H5.i6gCZ4f/m5mG4htpWBbI.y3Ch47I5wS', '', '2025-04-08 14:23:04'),
(11, 'wahyu', '23082010142@student.upnjatim.ac.id', '$2y$10$Oq6GBoz/nzv25AoEq/oDFOO/Js2fdRfRiyX8ilhKYoLVkEAPgz1KK', 0x70726f66696c655f363766626239666365636361342e6a7067, '2025-04-13 13:19:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`);

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
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
