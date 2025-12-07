-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 08:05 AM
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
-- Database: `biyaheph`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `price_per_night` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `name`, `description`, `location`, `price_per_night`, `created_at`, `updated_at`) VALUES
(2, 'noli me tangero', 'walalangdhsad', 'talaocogon', 5000.00, '2025-12-01 03:01:59', '2025-12-01 03:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` varchar(191) NOT NULL,
  `details` longtext DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `mac_address` varchar(100) DEFAULT NULL,
  `user_agent` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `name`, `role`, `action`, `details`, `ip_address`, `mac_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:14:32'),
(2, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:14:51'),
(3, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:14:54'),
(4, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:16:40'),
(5, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:17:26'),
(6, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:17:46'),
(7, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:18:43'),
(8, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:22:26'),
(9, 2, 'daniela', 'tourist', 'login_success', '{\"user_id\":\"2\"}', '192.168.10.9', '40-23-43-7E-98-D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:22:35'),
(10, 2, 'daniela', 'tourist', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"get\":[],\"post\":{\"username\":\"daniela\"},\"status\":303}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:22:35'),
(11, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/dashboard', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:22:35'),
(12, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/packages', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:22:40'),
(13, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/bookings/my-bookings', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:22:42'),
(14, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:22:46'),
(15, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:22:56'),
(16, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:22:58'),
(17, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:00'),
(18, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"get\":[],\"post\":[],\"status\":303}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:03'),
(19, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:04'),
(20, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:09'),
(21, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:30'),
(22, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"get\":[],\"post\":[],\"status\":303}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:33'),
(23, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:33'),
(24, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/', '{\"get\":[],\"post\":[],\"status\":200}', '::1', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:39'),
(25, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:23:45'),
(26, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:24:11'),
(27, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages/create', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:24:16'),
(28, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:24:18'),
(29, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:24:19'),
(30, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"get\":[],\"post\":[],\"status\":200}', '192.168.10.9', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:24:21'),
(31, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:25:40'),
(32, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:25:43'),
(33, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:25:54'),
(34, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:25:57'),
(35, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:25:57'),
(36, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:26:01'),
(37, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:26:02'),
(38, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:26:05'),
(39, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:28:11'),
(40, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:28:54'),
(41, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages/create', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/packages/create\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:28:56'),
(42, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/packages/store', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/packages/store\",\"status\":303,\"get\":[],\"post\":{\"title\":\"Package 5\",\"details\":\"aslkaoiucgas\",\"type\":\"exclusive\",\"date_from\":\"2025-12-05\",\"date_to\":\"2025-12-06\",\"price\":\"1000000\",\"rate_per_tourist\":\"1000\",\"max_tourists\":\"10\",\"accommodation_id\":\"2\",\"tour_agency_id\":\"2\",\"tour_guide_id\":\"1\",\"tourist_spots\":[\"2\"]}}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:29:43'),
(43, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/packages\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:29:43'),
(44, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:29:47'),
(45, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:43:30'),
(46, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:44:16'),
(47, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":{\"page\":\"2\"},\"post\":[]}', '192.168.10.9', '2C-EA-7F-01-4F-F9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:44:58'),
(48, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":{\"page\":\"2\"},\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:08'),
(49, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:15'),
(50, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:20'),
(51, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:21'),
(52, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:25'),
(53, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:28'),
(54, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:36'),
(55, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 05:54:43'),
(56, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:00:22'),
(57, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:03:06'),
(58, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:08'),
(59, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/packages/create', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/packages/create\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:26'),
(60, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/bookings/manage', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/bookings/manage\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:29'),
(61, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:32'),
(62, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:39'),
(63, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:44'),
(64, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:45'),
(65, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:49'),
(66, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:07:53'),
(67, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:03'),
(68, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:07'),
(69, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:08'),
(70, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:13'),
(71, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:14'),
(72, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:18'),
(73, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:22'),
(74, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:08:29'),
(75, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:10:14'),
(76, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:10:19'),
(77, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:17:25'),
(78, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:17:31'),
(79, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"off\",\"new_status\":\"on\",\"action\":\"enabled\",\"timestamp\":\"2025-12-01 06:21:00\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:01'),
(80, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:02'),
(81, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:04'),
(82, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/bookings/manage', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/bookings/manage\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:17'),
(83, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"on\",\"new_status\":\"off\",\"action\":\"disabled\",\"timestamp\":\"2025-12-01 06:21:20\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:21'),
(84, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:22'),
(85, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/bookings/manage', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/bookings/manage\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:24'),
(86, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:32'),
(87, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"off\",\"new_status\":\"on\",\"action\":\"enabled\",\"timestamp\":\"2025-12-01 06:21:38\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:40'),
(88, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:41'),
(89, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:42'),
(90, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:50'),
(91, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:51'),
(92, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"on\",\"new_status\":\"off\",\"action\":\"disabled\",\"timestamp\":\"2025-12-01 06:21:54\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:55'),
(93, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:56'),
(94, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:21:57'),
(95, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:22:26'),
(96, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"off\",\"new_status\":\"on\",\"action\":\"enabled\",\"timestamp\":\"2025-12-01 06:24:06\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:07'),
(97, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:08'),
(98, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:09'),
(99, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:16'),
(100, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:18'),
(101, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:19'),
(102, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"on\",\"new_status\":\"off\",\"action\":\"disabled\",\"timestamp\":\"2025-12-01 06:24:22\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:23'),
(103, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:23'),
(104, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:25'),
(105, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:48'),
(106, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:51'),
(107, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:24:59'),
(108, 1, 'admin', 'admin', 'toggle_maintenance_mode', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"previous_status\":\"off\",\"new_status\":\"on\",\"action\":\"enabled\",\"timestamp\":\"2025-12-01 06:25:18\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:19'),
(109, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/admin/maintenance/toggle', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/admin/maintenance/toggle\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:20'),
(110, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:21'),
(111, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:35'),
(112, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:39'),
(113, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:46'),
(114, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:51'),
(115, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:52'),
(116, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/admin/activity-logs', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/admin/activity-logs\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:25:56'),
(117, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:38:50'),
(118, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:39:03'),
(119, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:29'),
(120, 2, 'daniela', 'tourist', 'login_success', '{\"user_id\":\"2\",\"user_name\":\"daniela\",\"role\":\"tourist\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:35'),
(121, 2, 'daniela', 'tourist', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"daniela\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:36'),
(122, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:37'),
(123, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:47'),
(124, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/bookings/my-bookings', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/bookings/my-bookings\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:51'),
(125, 2, 'daniela', 'tourist', 'logout', '{\"user_id\":\"2\",\"user_name\":\"daniela\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:58'),
(126, 2, 'daniela', 'tourist', 'GET /biyaheph/public/index.php/auth/logout', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/logout\",\"status\":302,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:53:59'),
(127, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:00'),
(128, 1, 'admin', 'admin', 'login_success', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"role\":\"admin\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:04'),
(129, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"admin\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:05'),
(130, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:06'),
(131, 1, 'admin', 'admin', 'logout', '{\"user_id\":\"1\",\"user_name\":\"admin\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:09'),
(132, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/auth/logout', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/logout\",\"status\":302,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:10'),
(133, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:11'),
(134, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/register', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/register\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:15'),
(135, NULL, NULL, NULL, 'register_success', '{\"user_id\":8,\"user_name\":\"junsay\",\"role\":\"tourist\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `name`, `role`, `action`, `details`, `ip_address`, `mac_address`, `user_agent`, `created_at`) VALUES
(136, NULL, NULL, NULL, 'POST /biyaheph/public/index.php/auth/registerPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/registerPost\",\"status\":303,\"get\":[],\"post\":{\"name\":\"rolly\",\"username\":\"junsay\",\"email\":\"junsay@gmail.com\",\"role\":\"tourist\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:41'),
(137, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:54:42'),
(138, NULL, NULL, NULL, 'login_failed', '{\"username\":\"jusay\",\"reason\":\"username_not_found\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:04'),
(139, NULL, NULL, NULL, 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"jusay\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:05'),
(140, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:06'),
(141, 8, 'junsay', 'tourist', 'login_success', '{\"user_id\":\"8\",\"user_name\":\"junsay\",\"role\":\"tourist\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:17'),
(142, 8, 'junsay', 'tourist', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"junsay\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:18'),
(143, 8, 'junsay', 'tourist', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:19'),
(144, 8, 'junsay', 'tourist', 'logout', '{\"user_id\":\"8\",\"user_name\":\"junsay\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:27'),
(145, 8, 'junsay', 'tourist', 'GET /biyaheph/public/index.php/auth/logout', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/logout\",\"status\":302,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:28'),
(146, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:29'),
(147, 1, 'admin', 'admin', 'login_success', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"role\":\"admin\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:34'),
(148, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"admin\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:35'),
(149, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:36'),
(150, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:55:40'),
(151, 1, 'admin', 'admin', 'logout', '{\"user_id\":\"1\",\"user_name\":\"admin\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:56:12'),
(152, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/auth/logout', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/logout\",\"status\":302,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:56:13'),
(153, NULL, NULL, NULL, 'GET /biyaheph/public/index.php/auth/login', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/auth/login\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 06:56:14'),
(154, 1, 'admin', 'admin', 'login_success', '{\"user_id\":\"1\",\"user_name\":\"admin\",\"role\":\"admin\"}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:05'),
(155, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/auth/loginPost', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/auth/loginPost\",\"status\":303,\"get\":[],\"post\":{\"username\":\"admin\"}}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:06'),
(156, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/dashboard', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/dashboard\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:08'),
(157, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:28'),
(158, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:45'),
(159, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:04:47'),
(160, 1, 'admin', 'admin', 'POST /biyaheph/public/index.php/settings/toggle-maintenance', '{\"method\":\"POST\",\"path\":\"/biyaheph/public/index.php/settings/toggle-maintenance\",\"status\":303,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:05:00'),
(161, 1, 'admin', 'admin', 'GET /biyaheph/public/index.php/settings/maintenance', '{\"method\":\"GET\",\"path\":\"/biyaheph/public/index.php/settings/maintenance\",\"status\":200,\"get\":[],\"post\":[]}', '192.168.10.9', '40:23:43:7E:98:D3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-12-01 07:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `package_id` int(11) UNSIGNED NOT NULL,
  `number_of_tourists` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') DEFAULT 'pending',
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `number_of_tourists`, `total_price`, `status`, `contact_name`, `contact_email`, `contact_phone`, `special_requests`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 1, 0.00, 'approved', 'daniela', 'daniela@gmail.com', '09078704573', 'asaw', '2025-12-01 03:24:55', '2025-12-01 03:47:49'),
(3, 2, 2, 1, 0.00, 'cancelled', 'daniela', 'daniela@gmail.com', '09078704573', 'dadaw', '2025-12-01 03:35:25', '2025-12-01 03:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `ip_blocklist`
--

CREATE TABLE `ip_blocklist` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `reason` text DEFAULT NULL,
  `blocked_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(9, '2025-11-30-153442', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1764537865, 1),
(10, '2025-11-30-155113', 'App\\Database\\Migrations\\CreateTourPackagesTable', 'default', 'App', 1764537865, 1),
(11, '2025-11-30-164826', 'App\\Database\\Migrations\\CreateBookingsTable', 'default', 'App', 1764537865, 1),
(12, '2025-11-30-164826', 'App\\Database\\Migrations\\CreatePaymentsTable', 'default', 'App', 1764537865, 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_tourist_spots`
--

CREATE TABLE `package_tourist_spots` (
  `id` int(11) UNSIGNED NOT NULL,
  `package_id` int(11) UNSIGNED NOT NULL,
  `tourist_spot_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `stripe_payment_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'php',
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `maintenance_mode` tinyint(1) DEFAULT 0,
  `maintenance_message` text DEFAULT NULL,
  `admin_ips` text DEFAULT NULL COMMENT 'Comma-separated list of admin IPs',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `maintenance_mode`, `maintenance_message`, `admin_ips`, `created_at`, `updated_at`) VALUES
(1, 0, 'We are currently under maintenance. Please check back soon!', '', '2025-12-01 04:42:28', '2025-12-01 07:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `tourist_spots`
--

CREATE TABLE `tourist_spots` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourist_spots`
--

INSERT INTO `tourist_spots` (`id`, `name`, `description`, `location`, `created_at`, `updated_at`) VALUES
(2, 'Jmalls', 'ouahsduashrwae', 'dinagat', '2025-12-01 03:02:42', '2025-12-01 03:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `tour_agencies`
--

CREATE TABLE `tour_agencies` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_agencies`
--

INSERT INTO `tour_agencies` (`id`, `name`, `contact`, `email`, `address`, `created_at`, `updated_at`) VALUES
(2, 'Isla agency', '09123124', 'salangej22@gmail.com', 'talacogon del monte', '2025-12-01 03:03:33', '2025-12-01 03:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `tour_guides`
--

CREATE TABLE `tour_guides` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `expertise` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_guides`
--

INSERT INTO `tour_guides` (`id`, `name`, `email`, `phone`, `expertise`, `created_at`, `updated_at`) VALUES
(1, 'adsa', 'daniela@gmail.com', '09078704573', 'asdasd', '2025-11-30 20:42:18', '2025-11-30 20:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Package 1', '', 5000.00, '1764558328_a12470fe6a534ecb2358.jpg', '2025-12-01 03:05:28', '2025-12-01 03:05:28'),
(3, 'Package 3', '', 5000.00, '1764560779_c24428abce363b2ac239.jpg', '2025-12-01 03:46:19', '2025-12-01 03:46:19'),
(4, 'Package 5', '', 1000000.00, '1764566983_76324dece3a7731c1bf2.jpg', '2025-12-01 05:29:43', '2025-12-01 05:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','tourist') NOT NULL DEFAULT 'tourist',
  `approved` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `approved`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin.1764538052@noemail.local', '$2y$10$MqvrlWiSrLKZx.fuVNP59uIN4DdLrvZCVZN0XRY//hxS54ICDZ7rO', 'admin', 1, '2025-11-30 21:27:32', '2025-12-01 09:49:24'),
(2, 'daniela', 'daniela.1764538282@noemail.local', '$2y$10$9.P9vcdVATEbnv9v9.YQ/.AY1B9qqlDesgIQxefUdu4bAVyc2Ucbq', 'tourist', 0, '2025-11-30 21:31:23', '2025-11-30 21:31:23'),
(5, 'admin22', 'admin22.1764554005@noemail.local', '$2y$10$DGNw25/KuyidGrgnEUUjkeUK68tsw2Fj7PclbZbMWKd1F8Axigy.y', 'admin', 0, '2025-12-01 01:53:25', '2025-12-01 01:53:25'),
(6, 'rocero22', 'rocero22.1764562829@noemail.local', '$2y$10$chkSmdn7D46sGhwAY5ElwO.1QENmwBV47K.kO9TzFhnp897fIXLDC', 'tourist', 1, '2025-12-01 04:20:30', '2025-12-01 04:20:30'),
(7, 'rocero20', 'rocero20.1764563140@noemail.local', '$2y$10$e0K5mAslrqqIGvhv3Oofz.vPtJJ2ES7lbwgWLVYVZ/g5Z/ZsNC6aq', 'admin', 0, '2025-12-01 04:25:40', '2025-12-01 04:25:40'),
(8, 'junsay', 'junsay.1764572079@noemail.local', '$2y$10$R49O0/G9xVq8KL2iXUOFQeuV/dePfEG1QoAq4Lt6ZG5uA62GQFHFy', 'tourist', 1, '2025-12-01 06:54:39', '2025-12-01 06:54:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ip_created_at` (`ip_address`,`created_at`),
  ADD KEY `idx_user_created_at` (`user_id`,`created_at`),
  ADD KEY `idx_action_created_at` (`action`,`created_at`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `ip_blocklist`
--
ALTER TABLE `ip_blocklist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_address` (`ip_address`),
  ADD KEY `idx_ip_address` (`ip_address`),
  ADD KEY `idx_blocked_by` (`blocked_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_tourist_spots`
--
ALTER TABLE `package_tourist_spots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `tourist_spot_id` (`tourist_spot_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourist_spots`
--
ALTER TABLE `tourist_spots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_agencies`
--
ALTER TABLE `tour_agencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ip_blocklist`
--
ALTER TABLE `ip_blocklist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `package_tourist_spots`
--
ALTER TABLE `package_tourist_spots`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tourist_spots`
--
ALTER TABLE `tourist_spots`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tour_agencies`
--
ALTER TABLE `tour_agencies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tour_guides`
--
ALTER TABLE `tour_guides`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_tourist_spots`
--
ALTER TABLE `package_tourist_spots`
  ADD CONSTRAINT `package_tourist_spots_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_tourist_spots_ibfk_2` FOREIGN KEY (`tourist_spot_id`) REFERENCES `tourist_spots` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
