-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for marketplace_katering
DROP DATABASE IF EXISTS `marketplace_katering`;
CREATE DATABASE IF NOT EXISTS `marketplace_katering` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `marketplace_katering`;

-- Dumping structure for table marketplace_katering.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table marketplace_katering.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table marketplace_katering.carts
DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_menu_id_foreign` (`menu_id`),
  CONSTRAINT `carts_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.carts: ~0 rows (approximately)
DELETE FROM `carts`;

-- Dumping structure for table marketplace_katering.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table marketplace_katering.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table marketplace_katering.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table marketplace_katering.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_user_id_foreign` (`user_id`),
  CONSTRAINT `menus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.menus: ~6 rows (approximately)
DELETE FROM `menus`;
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image_path`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Mochi', 'lezat, 8 per bungkus', 50000, 'menus/NuK9xCmOOkCgpGkVoFx4dxbMNbXEWjqnWOOYgCLz.jpg', 2, '2024-11-22 01:22:32', '2024-11-22 01:22:39'),
	(2, 'Lemper', 'Tradisional, 5 per bungkus', 35000, 'menus/7B8DOE84I9f7mVsDFjH6wbtdZxreffXeKusH7FmN.jpg', 2, '2024-11-22 01:23:56', '2024-11-22 01:23:56'),
	(3, 'Bolu Gulung', 'Gurih, 2 per bungkus', 80000, 'menus/WAj1NxMn7nBRHObm84R9GwbZVn9b4u0hjdVmqbJp.jpg', 2, '2024-11-22 01:25:07', '2024-11-22 01:25:20'),
	(4, 'Ayam Geprek', 'per porsi 5', 75000, 'menus/zqewvGWuUb1fXbl7PKWbHskd0YBYR7PiNHbTGXGD.jpg', 3, '2024-11-22 01:27:33', '2024-11-22 01:27:33'),
	(5, 'Nasi Goreng', 'per porsi 10', 125000, 'menus/ydnyENhpoD1u4kfBWDjkiygmIdj8yCMJbkrMgLGg.jpg', 3, '2024-11-22 01:28:03', '2024-11-22 01:28:03'),
	(6, 'Mie Goreng', 'per porsi 15', 140000, 'menus/CoWhtCwmQLr730yavuC7Z85IgnvaCIOID7UnRoSe.jpg', 3, '2024-11-22 01:28:31', '2024-11-22 01:28:31');

-- Dumping structure for table marketplace_katering.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.migrations: ~1 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_11_12_082958_create_menus_table', 1),
	(5, '2024_11_12_092515_create_orders_table', 1),
	(6, '2024_11_21_192747_create_carts_table', 1),
	(7, '2024_11_21_192949_create_order_items_table', 1);

-- Dumping structure for table marketplace_katering.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `merchant_id` bigint unsigned NOT NULL,
  `status` enum('pending','confirmed','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_date` date NOT NULL,
  `total_price` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_merchant_id_foreign` (`merchant_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.orders: ~7 rows (approximately)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `customer_id`, `merchant_id`, `status`, `delivery_date`, `total_price`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'confirmed', '2024-11-27', 175000, '2024-11-22 01:35:26', '2024-11-22 01:46:51'),
	(2, 1, 2, 'cancelled', '2024-11-23', 310000, '2024-11-22 01:36:01', '2024-11-22 02:04:15'),
	(3, 1, 2, 'pending', '2024-11-30', 320000, '2024-11-22 01:36:53', '2024-11-22 01:36:53'),
	(4, 1, 3, 'completed', '2024-11-30', 550000, '2024-11-22 01:36:53', '2024-11-22 02:03:44'),
	(5, 4, 3, 'completed', '2024-11-26', 525000, '2024-11-22 01:49:32', '2024-11-22 02:08:15'),
	(6, 4, 2, 'pending', '2024-12-05', 105000, '2024-11-22 02:44:32', '2024-11-22 02:44:32'),
	(7, 4, 3, 'confirmed', '2024-12-05', 580000, '2024-11-22 02:44:32', '2024-11-22 02:44:53');

-- Dumping structure for table marketplace_katering.order_items
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.order_items: ~11 rows (approximately)
DELETE FROM `order_items`;
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 5, 35000.00, '2024-11-22 01:35:26', '2024-11-22 01:35:26'),
	(2, 2, 1, 3, 50000.00, '2024-11-22 01:36:01', '2024-11-22 01:36:01'),
	(3, 2, 3, 2, 80000.00, '2024-11-22 01:36:01', '2024-11-22 01:36:01'),
	(4, 3, 3, 4, 80000.00, '2024-11-22 01:36:53', '2024-11-22 01:36:53'),
	(5, 4, 5, 2, 125000.00, '2024-11-22 01:36:53', '2024-11-22 01:36:53'),
	(6, 4, 4, 4, 75000.00, '2024-11-22 01:36:53', '2024-11-22 01:36:53'),
	(7, 5, 5, 3, 125000.00, '2024-11-22 01:49:32', '2024-11-22 01:49:32'),
	(8, 5, 4, 2, 75000.00, '2024-11-22 01:49:32', '2024-11-22 01:49:32'),
	(9, 6, 2, 3, 35000.00, '2024-11-22 02:44:32', '2024-11-22 02:44:32'),
	(10, 7, 6, 2, 140000.00, '2024-11-22 02:44:32', '2024-11-22 02:44:32'),
	(11, 7, 4, 4, 75000.00, '2024-11-22 02:44:32', '2024-11-22 02:44:32');

-- Dumping structure for table marketplace_katering.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table marketplace_katering.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.sessions: ~3 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('1ATSZxS6d0R32PxQMpYGwINgXFbYnnpYXzHEnwbM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3NIOVQxM2xTVFFLNFV4NEdiTlA2MVJqQm9uQTJvR2dHdDRHYkpaTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vbWFya2V0cGxhY2Uta2F0ZXJpbmcudGVzdC9sb2dpbiI7fX0=', 1732269920),
	('9Pg5ey6EXAH5EdQFJZrk2RjM1fmdIdDNZcljqRTe', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiek5naG5UdjZZanIwOERlRTdIbHRNSXZYYzVkT25tZkh5aUhSWU9VMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vbWFya2V0cGxhY2Uta2F0ZXJpbmcudGVzdC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1732269661),
	('HDbjIsxUmJDu3FBi8pNNvOjuyEyVSh6W0JinscVF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicGE0Wm1OclhTY2xFV2lnendxY3FpcG5VUEJOSGUzUUdETkJlcUtwUyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwczovL21hcmtldHBsYWNlLWthdGVyaW5nLnRlc3Qvb3JkZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1732265211);

-- Dumping structure for table marketplace_katering.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('merchant','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table marketplace_katering.users: ~4 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `address`, `contact`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'PT Transindo Data Perkasa', 'michael.isaiah.02@gmail.com', '$2y$12$vKi61vOrNVIKpBxq8tGwZOteqwBBJE0ZBomKWVvrdnNhqVEYhzXVS', 'customer', 'Gg. H. Hasan No. 46', '089669045879', NULL, '2024-11-22 01:21:05', '2024-11-22 01:21:05'),
	(2, 'B\'Katering', 'michael.isaiah.bdg@gmail.com', '$2y$12$rKOqmX5RgZSlV.4hlzuyPu5dgTxbQ3o7QiSNNCybSBofcQn/fUAKq', 'merchant', 'Gg. H. Hasan No. 46', '089669045879', 'Dessert', '2024-11-22 01:21:50', '2024-11-22 01:21:50'),
	(3, 'BLD Katering', 'michael.isaiah.1@gmail.com', '$2y$12$3yrCoWw2hRchUQt6ghCJYuBglplLZUPg02vh2/C6xMHmKWAcHdyua', 'merchant', 'Gg. H. Hasan No. 46 Kota Bandung', '089669045879', 'Makanan Berat', '2024-11-22 01:26:43', '2024-11-22 01:26:43'),
	(4, 'Isaiah Collection', 'michael.isaiah.05@gmail.com', '$2y$12$NTQzpyx5MWfgI8ou0/3ROOm4mRf3KUy4wnyf4UdUjoN7MzW1Y/thK', 'customer', 'Gg. H. Hasan No. 46\r\nCicaheum, Kiaracondong', '089669045879', NULL, '2024-11-22 01:42:05', '2024-11-22 01:42:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
