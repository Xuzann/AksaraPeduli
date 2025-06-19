-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table aksarapeduli.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping data for table aksarapeduli.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping data for table aksarapeduli.campaigns: ~4 rows (approximately)
DELETE FROM `campaigns`;
INSERT INTO `campaigns` (`campaign_id`, `title`, `description`, `image`, `target_amount`, `collected_amount`, `deadline`, `updates`, `created_at`, `updated_at`) VALUES
	(2, 'Pembelian Buku Sekolah SMPN Jaya Wijaya', 'Siswa dan siswi MPN Jawa Wijaya di Irian Jaya butuh buku pelajaran segera untuk melanjutkan aktivitas pembelajaran mereka. Mari  beri uluran tanganmu untuk kehidupan pembelajaran yang lebih baik bagi mereka!', 'uploads/campaigns/1749388137_jayawijaya.jpg', 10000000.00, 1550000.00, '2025-06-30', '• Kunjungan ke Sekolah\r\nKami telah mengunjungi sekolah ini dan menemukan kabar bahwa buku pelajaran mereka sudah tak layak pakai.', '2025-06-08 02:13:04', '2025-06-10 23:31:36'),
	(3, 'Perbaikan Fasilitas UPN Yogyakarta', 'UPN Yogyakarta butuh bantuanmu! Beberapa fasilitas di kampus ini mengalami kerusakan karena imbas dari bencana banjir yang terjadi. Mari berkontribusi mewujudkan Indonesia Emas 2045 dengan membantu generasi muda!', 'uploads/campaigns/1749389137_upn.jpg', 50000000.00, 1250000.00, '2025-07-30', '• Kunjungan ke Kampus\r\nKami telah mengunjungi dan meninjau kondisi terkini dari kampus ini', '2025-06-08 06:25:37', '2025-06-10 23:22:49'),
	(5, 'Perbaikan Bangunan SDN Tadika Mesra', 'SDN Tadika Mesra sedang butuh bantuanmu! Siswa-siswinya harus menjalani masa-masa pembelajaran di bangunan sekolah yang rusak akibat bencana. Mari rangkul siswa-siswi SDN Tadika Mesra dengan memberikan tempat belajar terbaik bagi mereka!', 'uploads/campaigns/1749390160_sdn.jpg', 70000000.00, 1010000.00, '2025-07-30', '• Kunjungan ke Sekolah\r\nKami sudah mengunjungi dan meninjau langsung kondisi bangunan sekolah beberapa hari yang lalu', '2025-06-08 06:42:40', '2025-06-15 07:09:19'),
	(6, 'Bantuan untuk Murid Kurang Mampu', 'Masih banyak murid-murid yang kesulitan untuk membiayai biaya pendidikan mereka di luar sana. Mari berikan pendidikan yang layak bagi mereka yang membutuhkan melalui donasi ini! Jangan biarkan mereka putus sekolah!', 'uploads/campaigns/1749999311_siswa.jpg', 5000000.00, 0.00, '2025-06-23', '• Menemui Murid yang Membutuhkan\r\nKami sudah menemui beberapa murid yang membutuhkan bantuan untuk membiayai pendidikan mereka.', '2025-06-15 07:55:11', '2025-06-15 21:04:46');

-- Dumping data for table aksarapeduli.donations: ~7 rows (approximately)
DELETE FROM `donations`;
INSERT INTO `donations` (`id`, `user_id`, `campaign_id`, `amount`, `payment_method`, `review_text`, `donation_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 250000.00, 'gopay', 'Semoga bermanfaat', '2025-06-11', '2025-06-11 04:37:44', '2025-06-10 21:24:24'),
	(2, 1, 3, 250000.00, 'gopay', 'Semoga dapat membantu', '2025-06-11', '2025-06-10 21:32:04', '2025-06-10 21:32:04'),
	(3, 1, 3, 1000000.00, 'bank_transfer', 'Semoga bermanfaat', '2025-06-11', '2025-06-10 23:22:49', '2025-06-10 23:22:49'),
	(4, 1, 2, 50000.00, 'shopeepay', '', '2025-06-11', '2025-06-10 23:29:40', '2025-06-10 23:29:40'),
	(5, 1, 2, 1500000.00, 'credit_card', 'semoga bukunya bermanfaat', '2025-06-11', '2025-06-10 23:31:36', '2025-06-10 23:31:36'),
	(6, 1, 5, 10000.00, 'gopay', '', '2025-06-15', '2025-06-15 07:09:04', '2025-06-15 07:09:04'),
	(7, 1, 5, 750000.00, 'ovo', '', '2025-06-15', '2025-06-15 07:09:19', '2025-06-15 07:09:19');

-- Dumping data for table aksarapeduli.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table aksarapeduli.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping data for table aksarapeduli.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping data for table aksarapeduli.migrations: ~5 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_03_151343_create_campaigns_table', 1),
	(5, '2025_06_03_151756_create_donations_table', 1);

-- Dumping data for table aksarapeduli.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping data for table aksarapeduli.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('qhQ6z1v4clIY0JVzRppjHuLKl0G9a63BDLP8TdIZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSnl0cTlNQWRFT29PRWdXbXY3M01TdTJkTUlpODhsYkV1a3NHRExMOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9ha3NhcmFwZWR1bGkuY29tL2NhbXBhaWducyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1750331353);

-- Dumping data for table aksarapeduli.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `nama`, `email`, `role`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'farrel', 'farrel@gmail.com', 'user', 'uploads/profile_pictures/1750215107_2084-JASHITAMBERDASI-ORIGINALSIZE.jpg', NULL, '$2y$12$zHAg7ydW7wUjMk/8J4oGg.aNs.w1jgNxRX0IL4CkGD6dY6.Ls8kYC', NULL, '2025-06-07 07:29:06', '2025-06-17 19:53:44'),
	(2, 'admin', 'admin@gmail.com', 'admin', 'uploads/profile_pictures/1750046733_default_profile.png', NULL, '$2y$12$z9y7/7zQ8FEJL9l62KsmI.q4s0Ppf99QoyxKcxRUuJhPHo3q2GQTK', NULL, '2025-06-07 09:51:15', '2025-06-15 21:05:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
