-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2026 at 09:45 AM
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
-- Database: `labflow_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `tahun_pembuatan` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `foto_thumbnail` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(30) DEFAULT NULL,
  `jumlah_tersedia` int(11) NOT NULL DEFAULT 0,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `ruang_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `deskripsi`, `merk`, `tahun_pembuatan`, `foto`, `foto_thumbnail`, `stok`, `satuan`, `jumlah_tersedia`, `prodi_id`, `kategori_id`, `ruang_id`, `kondisi_id`, `created_at`, `updated_at`) VALUES
(3, 'RPL-202604-0001', 'Kabel HDMI', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 18, 4, 1, '2026-04-23 08:29:36', '2026-04-29 21:31:42'),
(4, 'RPL-202604-0002', 'Docker HDD', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 13, 4, 1, '2026-04-23 08:30:19', '2026-04-23 08:30:19'),
(5, 'RPL-202604-0003', 'LAN Tester', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 19, 4, 1, '2026-04-23 08:31:42', '2026-04-23 08:31:42'),
(6, 'RPL-202604-0004', 'Raspberry Pie 3', NULL, 'Raspberry Pie 3', NULL, NULL, NULL, 3, 'Unit', 3, 1, 17, 4, 1, '2026-04-23 08:32:27', '2026-04-23 08:32:27'),
(7, 'RPL-202604-0005', 'Palu', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 1, 4, 1, '2026-04-23 08:33:07', '2026-04-23 08:33:07'),
(8, 'RPL-202604-0006', 'Arduino', NULL, 'Arduino', NULL, NULL, NULL, 5, 'Unit', 5, 1, 17, 4, 1, '2026-04-23 08:33:39', '2026-04-23 08:33:39'),
(9, 'RPL-202604-0007', 'Tape Dispenser', NULL, 'Kenko', NULL, NULL, NULL, 1, 'Unit', 1, 1, 1, 4, 1, '2026-04-23 08:34:32', '2026-04-23 08:34:32'),
(10, 'RPL-202604-0008', 'Vacum Cleaner', NULL, 'Modena', NULL, NULL, NULL, 1, 'Unit', 1, 1, 16, 4, 1, '2026-04-23 08:35:01', '2026-04-29 21:25:31'),
(11, 'RPL-202604-0009', 'Converter HDMI', NULL, '-', NULL, NULL, NULL, 4, 'Unit', 4, 1, 13, 4, 1, '2026-04-23 08:35:27', '2026-04-29 17:26:21'),
(12, 'RPL-202604-0010', 'Kabel Roll', NULL, 'Tempur', NULL, NULL, NULL, 3, 'Unit', 3, 1, 18, 4, 1, '2026-04-23 08:36:14', '2026-04-29 21:32:45'),
(13, 'RPL-202604-0011', 'Staples Tembak', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 0, 1, 44, 4, 1, '2026-04-23 08:38:18', '2026-04-29 15:01:01'),
(14, 'RPL-202604-0012', 'Kursi', NULL, '-', NULL, NULL, NULL, 3, 'Unit', 3, 1, 7, 4, 1, '2026-04-23 08:38:45', '2026-04-23 08:38:45'),
(15, 'RPL-202604-0013', 'Meja Kayu', NULL, '-', NULL, NULL, NULL, 5, 'Unit', 5, 1, 5, 4, 1, '2026-04-23 08:39:22', '2026-04-23 08:39:22'),
(16, 'RPL-202604-0014', 'Lemari Kayu', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 6, 4, 1, '2026-04-23 08:39:44', '2026-04-23 08:39:44'),
(17, 'RPL-202604-0015', 'Lemari Besi', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 6, 4, 1, '2026-04-23 08:40:39', '2026-04-23 08:40:39'),
(18, 'RPL-202604-0016', 'Rak', NULL, '-', NULL, NULL, NULL, 2, 'Unit', 2, 1, 14, 4, 1, '2026-04-23 08:41:05', '2026-04-23 08:41:05'),
(19, 'RPL-202604-0017', 'Speaker Portable', NULL, 'Aima', NULL, NULL, NULL, 1, 'Unit', 1, 1, 12, 4, 1, '2026-04-23 08:41:44', '2026-04-23 08:41:44'),
(20, 'RPL-202604-0018', 'AC', NULL, 'GREE', NULL, NULL, NULL, 3, 'Unit', 3, 1, 9, 3, 1, '2026-04-23 18:35:47', '2026-04-23 18:35:47'),
(21, 'RPL-202604-0019', 'FIGURA Garuda Pancasila', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 20, 3, 1, '2026-04-23 18:39:59', '2026-04-23 18:41:45'),
(22, 'RPL-202604-0020', 'FIGURA PRESIDEN', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 20, 3, 1, '2026-04-23 18:41:30', '2026-04-23 18:41:30'),
(23, 'RPL-202604-0021', 'FIGURA WAKIL PRESIDEN', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 20, 3, 1, '2026-04-23 18:41:58', '2026-04-23 18:41:58'),
(24, 'RPL-202604-0022', 'KOMPUTER', 'All in One Aspire C22-1650, Intel Core i5-1135G7 2.4GHz, 8GB RAM', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:44:32', '2026-04-23 18:44:32'),
(25, 'RPL-202604-0023', 'KOMPUTER', 'Intel Core i3-4170 3.70GH, Gigabyte H81M-S1, 4GB DDR 3', 'ARMAGGEDDON NANOTRON T1X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:46:44', '2026-04-23 18:46:44'),
(26, 'RPL-202604-0024', 'KOMPUTER', 'Intel Core i5-7400 3.00GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGGEDDON VULCAN V1FX', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:47:52', '2026-04-23 18:47:52'),
(27, 'RPL-202604-0025', 'KOMPUTER', 'Intel Core i3-4170 3.70GHz, Gigabyte H81M-S1, 4GB DDR3', 'DAZUMA D-VITO 530', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:48:54', '2026-04-23 18:48:54'),
(28, 'RPL-202604-0026', 'KOMPUTER', 'Intel Core i3-4160T 3.10GHz, Gigabyte H81M-S1, 4GB DDR3', 'DAZUMA DE 261', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:49:49', '2026-04-23 18:49:49'),
(29, 'RPL-202604-0027', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, ASUS, 4GB DDR3', 'SIMBADDA', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 3, 1, '2026-04-23 18:50:52', '2026-04-23 18:50:52'),
(30, 'RPL-202604-0028', 'KOMPUTER', 'MATI - Intel Core i3-4160 3.60GHz, ASUS, 4GB DDR3', 'SIMBADDA', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 2, '2026-04-23 18:52:32', '2026-04-23 18:52:32'),
(31, 'RPL-202604-0029', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, Gigabyte H81M-S1, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 3, 'Unit', 3, 1, 2, 3, 1, '2026-04-23 18:53:51', '2026-04-23 18:53:51'),
(32, 'RPL-202604-0030', 'KOMPUTER', 'Intel Core i5-3570 3.40GHz, Gigabyte H61M-DS2, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:54:50', '2026-04-23 18:54:50'),
(33, 'RPL-202604-0031', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-DS2, 4GB DDR4', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 3, 1, '2026-04-23 18:55:54', '2026-04-23 18:55:54'),
(34, 'RPL-202604-0032', 'KURSI KANTOR KK-4005', NULL, 'ACERO', NULL, NULL, NULL, 24, 'Unit', 24, 1, 7, 3, 1, '2026-04-23 18:57:19', '2026-04-23 18:57:19'),
(35, 'RPL-202604-0033', 'KURSI KANTOR KK-4005', NULL, 'ACERO', NULL, NULL, NULL, 13, 'Unit', 13, 1, 7, 3, 3, '2026-04-23 18:58:17', '2026-04-23 18:58:17'),
(36, 'RPL-202604-0034', 'KURSI PUTAR', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 7, 3, 1, '2026-04-23 18:58:58', '2026-04-23 18:58:58'),
(37, 'RPL-202604-0035', 'KURSI SISWA', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 7, 3, 1, '2026-04-23 19:00:00', '2026-04-23 19:00:00'),
(38, 'RPL-202604-0036', 'LAYAR PROYEKTOR', 'Manual gantung 70 inch', 'WORLD', NULL, NULL, NULL, 1, 'Unit', 1, 1, 8, 3, 1, '2026-04-23 19:01:14', '2026-04-23 19:01:14'),
(39, 'RPL-202604-0037', 'MEJA KOMPUTER', 'Conference, HPL Putih 250×100×80 cm', '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 5, 3, 1, '2026-04-23 19:03:12', '2026-04-23 19:03:12'),
(40, 'RPL-202604-0038', 'MEJA KOMPUTER', 'Single HPL Putih 120×60×75cm', '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 5, 3, 1, '2026-04-23 19:04:55', '2026-04-23 19:04:55'),
(41, 'RPL-202604-0039', 'MEJA KOMPUTER', 'Single HPL Putih 90×60×60cm', '-', NULL, NULL, NULL, 16, 'Unit', 16, 1, 5, 3, 1, '2026-04-23 19:05:57', '2026-04-23 19:05:57'),
(42, 'RPL-202604-0040', 'MEJA KOMPUTER', 'VINO CT 80 WARNA BEECH 80×40×73cm', 'ACTIVE', NULL, NULL, NULL, 2, 'Unit', 2, 1, 5, 3, 1, '2026-04-23 19:07:43', '2026-04-23 19:07:43'),
(43, 'RPL-202604-0041', 'MONITOR KOMPUTER', 'LED Monitor P166HQL 16 inch', 'ACER', NULL, NULL, NULL, 8, 'Unit', 8, 1, 11, 3, 1, '2026-04-23 19:15:59', '2026-04-23 19:15:59'),
(44, 'RPL-202604-0042', 'MONITOR KOMPUTER', 'LED Monitor G615HDPL 16 inch', 'BENQ', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 3, 2, '2026-04-23 19:17:25', '2026-04-23 19:17:25'),
(45, 'RPL-202604-0043', 'MONITOR KOMPUTER', 'LCD Monitor CQ1569X 16inch', 'HP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 3, 1, '2026-04-23 19:19:02', '2026-04-23 19:19:02'),
(46, 'RPL-202604-0044', 'MONITOR KOMPUTER', 'LED Monitor CMV 633A-C 16 inch', 'ZYREX', NULL, NULL, NULL, 2, 'Unit', 2, 1, 11, 3, 1, '2026-04-23 19:21:49', '2026-04-23 19:21:49'),
(47, 'RPL-202604-0045', 'WHITEBOARD DINDING', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 10, 3, 2, '2026-04-23 19:24:00', '2026-04-23 19:24:00'),
(48, 'RPL-202604-0046', 'WHITEBOARD STAND', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 10, 3, 1, '2026-04-23 19:24:32', '2026-04-23 19:24:32'),
(49, 'RPL-202604-0047', 'PROYEKTOR', 'MX532 DLP XGA (1024×768)', 'BENQ', NULL, NULL, NULL, 1, 'Unit', 1, 1, 8, 3, 1, '2026-04-23 19:26:10', '2026-04-23 19:26:10'),
(50, 'RPL-202604-0048', 'SPEAKER', 'WAS 112LVE', 'NAIWA', NULL, NULL, NULL, 1, 'Unit', 1, 1, 12, 3, 1, '2026-04-23 19:27:31', '2026-04-23 19:27:31'),
(51, 'RPL-202604-0049', 'AC', NULL, 'LG', NULL, NULL, NULL, 1, 'Unit', 1, 1, 9, 1, 1, '2026-04-24 07:28:52', '2026-04-24 07:28:52'),
(52, 'RPL-202604-0050', 'AC', NULL, 'PANASONIC', NULL, NULL, NULL, 1, 'Unit', 1, 1, 9, 1, 1, '2026-04-24 07:29:31', '2026-04-24 07:29:31'),
(53, 'RPL-202604-0051', 'AC', NULL, 'SHARP', NULL, NULL, NULL, 2, 'Unit', 2, 1, 9, 1, 1, '2026-04-24 07:29:56', '2026-04-24 07:29:56'),
(54, 'RPL-202604-0052', 'FIGURA PRESIDEN', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 20, 1, 1, '2026-04-24 07:30:41', '2026-04-24 07:30:41'),
(55, 'RPL-202604-0053', 'FIGURA WAKIL PRESIDEN', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 20, 1, 1, '2026-04-24 07:31:05', '2026-04-24 07:31:05'),
(56, 'RPL-202604-0054', 'KOMPUTER', 'All in One ACX24, Intel Core i5-12450H, 8GB RAM', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:32:44', '2026-04-24 07:32:44'),
(57, 'RPL-202604-0055', 'FILLING KABINET', NULL, 'BROTHER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 6, 1, 1, '2026-04-24 07:33:31', '2026-04-24 07:33:31'),
(58, 'RPL-202604-0056', 'KOMPUTER', 'All in One Aspire C22-1650, Intel Core 15-1135G7 2.4GHz, 8GB RAM', 'ACER', NULL, NULL, NULL, 9, 'Unit', 9, 1, 2, 1, 1, '2026-04-24 07:34:58', '2026-04-24 07:34:58'),
(59, 'RPL-202604-0057', 'KOMPUTER', 'All in One Aspire C22-1700, Intel Core 15-1235U 1.3GHz, 8GB RAM', 'ACER', NULL, NULL, NULL, 7, 'Unit', 7, 1, 2, 1, 1, '2026-04-24 07:36:33', '2026-04-24 07:36:33'),
(60, 'RPL-202604-0058', 'KOMPUTER', 'Intel Core i3-4150 3.50GHz, Gigabyte H81M-S1, 8GB DDR3', 'ARMAGGEDDON MICROTRON T2X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:38:28', '2026-04-24 07:38:28'),
(61, 'RPL-202604-0059', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, Gigabyte H81M-S1, 8GB DDR 3', 'ARMAGGEDDON NANOTRON T1X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:39:53', '2026-04-24 07:39:53'),
(62, 'RPL-202604-0060', 'KOMPUTER', 'Intel Core i3-4170 3.70GHz, Gigabyte H81M-S1, 8GB DDR3', 'ARMAGGEDDON NANOTRON T1X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:40:41', '2026-04-24 07:40:41'),
(63, 'RPL-202604-0061', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGGEDDON T7X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:41:47', '2026-04-24 07:41:47'),
(64, 'RPL-202604-0062', 'KOMPUTER', 'Intel Core i3-7320 4.10GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGGEDDON VULCAN V1FX', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:42:37', '2026-04-24 07:42:37'),
(65, 'RPL-202604-0063', 'KOMPUTER', 'Intel Core i5-7400 3.00GHz, ASUS, 8GB DDR4', 'ARMAGGEDDON VULCAN V1FX', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 1, 1, '2026-04-24 07:44:09', '2026-04-24 07:44:09'),
(66, 'RPL-202604-0064', 'KOMPUTER', 'Intel Core i5-10400 2.90GHz, Gigabyte H410M H V2, 8GB DDR4', 'POWER UP ELEMENT 901', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:45:13', '2026-04-24 07:45:13'),
(67, 'RPL-202604-0065', 'KOMPUTER', 'Intel Core i5-10400 2.90GHz, MSI MS-7D82, 8GB DDR4', 'POWER UP ELEMENT 901', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:45:51', '2026-04-24 07:45:51'),
(68, 'RPL-202604-0066', 'KOMPUTER', 'Intel Core i5-10400 2.90GHz, MSI MS-7D82, 8GB DDR4', 'POWER UP ELEMENT 901', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:46:33', '2026-04-24 07:46:33'),
(69, 'RPL-202604-0067', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, Gigabyte H81M-S1, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:47:33', '2026-04-24 07:47:33'),
(70, 'RPL-202604-0068', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-H, 8GB DDR4', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:48:24', '2026-04-24 07:48:24'),
(71, 'RPL-202604-0069', 'KOMPUTER', 'Intel Core i5-3470 3.20GHz, Gigabyte H61M-DS2, 8GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:48:57', '2026-04-24 07:48:57'),
(72, 'RPL-202604-0070', 'KOMPUTER', 'Intel Core i5-3570 3.40GHz, Gigabyte H61M-DS2, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:49:28', '2026-04-24 07:49:28'),
(73, 'RPL-202604-0071', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-DS2, 4GB', 'SIMBADDA SIM V 3138', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:50:11', '2026-04-24 07:50:11'),
(74, 'RPL-202604-0072', 'KOMPUTER', 'Intel Core i3-3240 3.40GHz, Bulldozer H61, 8GB DDR3', 'SIMBADDA SIM V 3145', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 1, 1, '2026-04-24 07:51:04', '2026-04-24 07:51:04'),
(75, 'RPL-202604-0073', 'KURSI GURU', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 7, 1, 1, '2026-04-24 07:51:37', '2026-04-24 07:51:37'),
(76, 'RPL-202604-0074', 'LEMARI', 'Standar 2 pintu jendela kaca', '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 6, 1, 1, '2026-04-24 07:52:29', '2026-04-24 07:52:29'),
(77, 'RPL-202604-0075', 'MEJA GURU', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 5, 1, 1, '2026-04-24 07:52:52', '2026-04-24 07:52:52'),
(78, 'RPL-202604-0076', 'MEJA KOMPUTER', 'MTC 8060 uk. 80×60×70', 'EXPO', NULL, NULL, NULL, 36, 'Unit', 36, 1, 5, 1, 1, '2026-04-24 07:54:04', '2026-04-24 07:54:04'),
(79, 'RPL-202604-0077', 'MONITOR KOMPUTER', 'LCD Monitor K202HQL 19.5inch', 'ACER', NULL, NULL, NULL, 3, 'Unit', 3, 1, 11, 1, 1, '2026-04-24 07:55:13', '2026-04-24 07:55:13'),
(80, 'RPL-202604-0078', 'MONITOR KOMPUTER', 'LED Monitor E1900HQ 18.5inch', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 1, '2026-04-24 07:56:27', '2026-04-24 07:56:27'),
(81, 'RPL-202604-0079', 'MONITOR KOMPUTER', 'LED Monitor P166HQL 16 inch', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 2, '2026-04-24 07:57:24', '2026-04-24 07:57:24'),
(82, 'RPL-202604-0080', 'MONITOR KOMPUTER', 'LED Monitor E2015HVF 19.5 inch', 'DELL', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 3, '2026-04-24 07:58:57', '2026-04-24 07:58:57'),
(83, 'RPL-202604-0081', 'MONITOR KOMPUTER', 'LCD Monitor CQ1569X 16 inch', 'HP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 2, '2026-04-24 08:00:03', '2026-04-24 08:00:03'),
(84, 'RPL-202604-0082', 'MONITOR KOMPUTER', 'LCD Monitor ThinkVision E1922S 18.5 inch', 'LENOVO', NULL, NULL, NULL, 2, 'Unit', 2, 1, 11, 1, 1, '2026-04-24 08:01:12', '2026-04-24 08:01:12'),
(85, 'RPL-202604-0083', 'MONITOR KOMPUTER', 'LED Monitor 19M38A 19 inch', 'LG', NULL, NULL, NULL, 5, 'Unit', 5, 1, 11, 1, 1, '2026-04-24 08:02:15', '2026-04-24 08:02:15'),
(86, 'RPL-202604-0084', 'MONITOR KOMPUTER', 'LED Monitor  M. 18.5W2 18.5 inch', 'POWER UP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 1, '2026-04-24 08:03:30', '2026-04-24 08:03:30'),
(87, 'RPL-202604-0085', 'MONITOR KOMPUTER', 'LCD Monitor CMV 633A-C 16 inch', 'ZYREX', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 1, 1, '2026-04-24 08:04:38', '2026-04-24 08:04:38'),
(88, 'RPL-202604-0086', 'AC', NULL, 'FLiFE', NULL, NULL, NULL, 1, 'Unit', 1, 1, 9, 2, 1, '2026-04-29 10:30:22', '2026-04-29 10:30:22'),
(89, 'RPL-202604-0087', 'AC', NULL, 'LG', NULL, NULL, NULL, 1, 'Unit', 1, 1, 9, 2, 1, '2026-04-29 10:30:54', '2026-04-29 10:30:54'),
(90, 'RPL-202604-0088', 'AC', NULL, 'SHARP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 9, 2, 1, '2026-04-29 10:31:25', '2026-04-29 10:31:25'),
(91, 'RPL-202604-0089', 'ETALASE', '2×2×0, 5cm', '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 26, 2, 1, '2026-04-29 10:32:22', '2026-04-29 10:32:22'),
(92, 'RPL-202604-0090', 'KOMPUTER', 'All in One Aspire C22-1700, Intel Core i5-1235U 1.3GHz, 8GB RAM', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:33:08', '2026-04-29 10:33:08'),
(93, 'RPL-202604-0091', 'KOMPUTER', 'Intel Core i3-4150 3.50GHz, Gigabyte H81M-S1, 4GB DDR3', 'ARMAGGEDDON MICROTRON T2X', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 2, 1, '2026-04-29 10:34:21', '2026-04-29 10:34:21'),
(94, 'RPL-202604-0092', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGEDDON T7X', NULL, NULL, NULL, 6, 'Unit', 6, 1, 2, 2, 1, '2026-04-29 10:35:19', '2026-04-29 10:35:19'),
(95, 'RPL-202604-0093', 'KOMPUTER', 'Intel Core i3-7320 4.10GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGEDDON T7X', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:36:20', '2026-04-29 10:36:20'),
(96, 'RPL-202604-0094', 'KOMPUTER', 'Intel Core i3-7320 4.10GHz, Gigabyte H110M-DS2, 8GB DDR4', 'ARMAGGEDDON VULCAN V1FX', NULL, NULL, NULL, 4, 'Unit', 4, 1, 2, 2, 1, '2026-04-29 10:37:43', '2026-04-29 10:37:43'),
(97, 'RPL-202604-0095', 'KOMPUTER', 'Intel Core i3-4170 3.70GHz, Gigabyte H81M-S1, 4GB DDR3', 'DAZUMA D-VITO 530', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:38:38', '2026-04-29 10:38:38'),
(98, 'RPL-202604-0096', 'KOMPUTER', 'Intel Core i5-10400 2.90GHz, Gigabyte H410M H V2, 8GB DDR4', 'POWER UP ELEMENT 901', NULL, NULL, NULL, 4, 'Unit', 4, 1, 2, 2, 1, '2026-04-29 10:39:24', '2026-04-29 10:39:24'),
(99, 'RPL-202604-0097', 'KOMPUTER', 'Intel Core i3-4150 3.50GHz, MSI MS-7817, 8GB DDR3', 'SIMBADDA SIM V 2918', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:41:16', '2026-04-29 10:41:16'),
(100, 'RPL-202604-0098', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, Gigabyte H81M-S1, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 3, 'Unit', 3, 1, 2, 2, 1, '2026-04-29 10:42:05', '2026-04-29 10:42:05'),
(101, 'RPL-202604-0099', 'KOMPUTER', 'Intel Core i3-4160 3.60GHz, Gigabyte H81M-S1, 8GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:42:58', '2026-04-29 10:42:58'),
(102, 'RPL-202604-0100', 'KOMPUTER', 'Intel Core i3-4170 3.70GHz, Gigabyte H81M-DS2, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:43:50', '2026-04-29 10:43:50'),
(103, 'RPL-202604-0101', 'KOMPUTER', 'Intel Core i3-4170 3.70GHz, Gigabyte H81M-DS2, 8GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 2, 1, '2026-04-29 10:44:54', '2026-04-29 10:44:54'),
(104, 'RPL-202604-0102', 'KOMPUTER', 'Intel Core i5-3470 3.20GHz, Gigabyte H61M-DS2, 8GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 2, 1, '2026-04-29 10:46:11', '2026-04-29 10:46:11'),
(105, 'RPL-202604-0103', 'KOMPUTER', 'Intel Core i5-3570 3.40GHz, Gigabyte H61M-DS2, 4GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 2, 'Unit', 2, 1, 2, 2, 1, '2026-04-29 10:47:30', '2026-04-29 10:47:30'),
(106, 'RPL-202604-0104', 'KOMPUTER', 'Intel Core i5-3570 3.40GHz, Gigabyte H61M-DS2, 8GB DDR3', 'SIMBADDA SIM V 2922', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:48:48', '2026-04-29 10:48:48'),
(107, 'RPL-202604-0105', 'KOMPUTER', 'Intel Core i3-7100 3.90GHz, Gigabyte H110M-DS2, 4GB', 'SIMBADDA SIM V 3138', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:49:44', '2026-04-29 10:49:44'),
(108, 'RPL-202604-0106', 'KOMPUTER', 'Intel Core 13-3240 3.40GHz, Bulldozer H61. 8GB DDR3', 'SIMBADDA SIM V 3145', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:50:50', '2026-04-29 10:50:50'),
(109, 'RPL-202604-0107', 'KOMPUTER', 'Intel Core i3-4160T 3.10GHz, Jetway T181 MG, BGB DDR3', 'SPC', NULL, NULL, NULL, 1, 'Unit', 1, 1, 2, 2, 1, '2026-04-29 10:51:41', '2026-04-29 10:51:41'),
(110, 'RPL-202604-0108', 'KURSI LIPAT', NULL, '-', NULL, NULL, NULL, 37, NULL, 37, 1, 7, 2, 1, '2026-04-29 10:52:17', '2026-04-29 10:52:17'),
(111, 'RPL-202604-0109', 'MEJA KOMPUTER', 'DOUBLE, HPL, PUTIH', '-', NULL, NULL, NULL, 11, NULL, 11, 1, 5, 2, 1, '2026-04-29 10:53:23', '2026-04-29 10:53:23'),
(112, 'RPL-202604-0110', 'MEJA KOMPUTER', 'DOUBLE, PLITUR, COKLAT', '-', NULL, NULL, NULL, 2, 'Unit', 2, 1, 25, 2, 1, '2026-04-29 10:55:05', '2026-04-29 10:55:05'),
(113, 'RPL-202604-0111', 'MEJA KOMPUTER', 'SINGLE, HPL, PUTIH', '-', NULL, NULL, NULL, 4, 'Unit', 4, 1, 5, 2, 1, '2026-04-29 10:55:42', '2026-04-29 10:55:42'),
(114, 'RPL-202604-0112', 'MEJA KOMPUTER', 'SINGLE, HPL, PUTIH, ABU ABU', '-', NULL, NULL, NULL, 2, 'Unit', 2, 1, 5, 2, 1, '2026-04-29 10:57:01', '2026-04-29 10:57:01'),
(115, 'RPL-202604-0113', 'MEJA KOMPUTER', 'SINGLE, HPL PUTIH, LIST TEPI PLASTIK', '-', NULL, NULL, NULL, 3, 'Unit', 3, 1, 5, 2, 1, '2026-04-29 10:58:02', '2026-04-29 10:58:02'),
(116, 'RPL-202604-0114', 'MEJA KOMPUTER', 'Vino CT 80 warna beech', 'ACTIVE', NULL, NULL, NULL, 2, 'Unit', 2, 1, 5, 2, 1, '2026-04-29 10:59:16', '2026-04-29 10:59:16'),
(117, 'RPL-202604-0115', 'MONITOR KOMPUTER', 'LED Monitor P166HQL 16 inch', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 1, '2026-04-29 11:00:37', '2026-04-29 11:00:37'),
(118, 'RPL-202604-0116', 'MONITOR KOMPUTER', 'LED Monitor P166HQL 16 inch', 'ACER', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 2, '2026-04-29 11:02:25', '2026-04-29 11:02:25'),
(119, 'RPL-202604-0117', 'MONITOR KOMPUTER', 'LED Monitor P166HQL 16 inch ( VIGNET PUTIH)', 'ACER', NULL, NULL, NULL, 3, 'Unit', 3, 1, 11, 2, 2, '2026-04-29 11:03:41', '2026-04-29 11:03:41'),
(120, 'RPL-202604-0118', 'MONITOR KOMPUTER', 'LCD Monitor G610HDA 16 inch', 'BENQ', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 1, '2026-04-29 11:04:33', '2026-04-29 11:04:33'),
(121, 'RPL-202604-0119', 'MONITOR KOMPUTER', 'LED Monitor G615HDPL 16 inch', 'BENQ', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 1, '2026-04-29 11:05:25', '2026-04-29 11:05:25'),
(122, 'RPL-202604-0120', 'MONITOR KOMPUTER', 'LED Monitor G615HDPL 16 inch', 'BENQ', NULL, NULL, NULL, 2, 'Unit', 2, 1, 11, 2, 2, '2026-04-29 11:09:07', '2026-04-29 11:09:07'),
(123, 'RPL-202604-0121', 'MONITOR KOMPUTER', 'LED Monitor E1916HV 19 inch', 'DELL', NULL, NULL, NULL, 2, 'Unit', 2, 1, 11, 2, 1, '2026-04-29 11:10:29', '2026-04-29 11:10:29'),
(124, 'RPL-202604-0122', 'MONITOR KOMPUTER', 'LCD Monitor CQ1569x 16 inch', 'HP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 1, '2026-04-29 11:11:23', '2026-04-29 11:11:23'),
(125, 'RPL-202604-0123', 'MONITOR KOMPUTER', 'LCD Monitor CQ1569x 16 inch', 'HP', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 2, '2026-04-29 11:12:07', '2026-04-29 11:12:07'),
(126, 'RPL-202604-0124', 'MONITOR KOMPUTER', 'LED Monitor 19M38A 19 inch', 'LG', NULL, NULL, NULL, 18, 'Unit', 18, 1, 11, 2, 1, '2026-04-29 11:12:59', '2026-04-29 11:12:59'),
(127, 'RPL-202604-0125', 'MONITOR KOMPUTER', 'LED Monitor 19M38A 19 baik', 'LG', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 2, '2026-04-29 11:13:48', '2026-04-29 11:13:48'),
(128, 'RPL-202604-0126', 'MONITOR KOMPUTER', 'LED Monitor 19M38A 19 inch (VIGNET merah )', 'LG', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 2, '2026-04-29 11:14:45', '2026-04-29 11:14:45'),
(129, 'RPL-202604-0127', 'MONITOR KOMPUTER', 'LCD Monitor CMV 633A-C 16 inch', 'ZYREX', NULL, NULL, NULL, 1, 'Unit', 1, 1, 11, 2, 1, '2026-04-29 11:15:43', '2026-04-29 11:15:43'),
(130, 'RPL-202604-0128', 'PAPAN TULIS DAFTAR INVENTARIS RUANGAN', NULL, '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 10, 2, 1, '2026-04-29 11:16:39', '2026-04-29 11:16:39'),
(131, 'RPL-202604-0129', 'PAPAN TULIS', 'Putih 2x1, 5', '-', NULL, NULL, NULL, 1, 'Unit', 1, 1, 10, 2, 1, '2026-04-29 11:17:25', '2026-04-29 11:17:25'),
(132, 'RPL-202604-0130', 'PROYEKTOR', 'MX532 DLP XGA (1024x768', 'BENQ', NULL, NULL, NULL, 1, 'Unit', 1, 1, 8, 2, 1, '2026-04-29 11:18:07', '2026-04-29 11:18:07'),
(133, 'RPL-202604-0131', 'Kertas Folio', NULL, '-', NULL, NULL, NULL, 3053, 'Pcs', 3053, 1, 45, 4, 1, '2026-04-29 18:14:26', '2026-04-29 19:44:43'),
(134, 'RPL-202604-0132', 'Kertas Warna', NULL, '-', NULL, NULL, NULL, 1400, 'Pcs', 1400, 1, 1, 4, 1, '2026-04-29 18:14:52', '2026-04-29 18:14:52'),
(135, 'RPL-202604-0133', 'Kertas Sertifikat', NULL, '-', NULL, NULL, NULL, 300, 'Pcs', 300, 1, 1, 4, 1, '2026-04-29 18:15:16', '2026-04-29 18:15:16'),
(136, 'RPL-202604-0134', 'Stopmap', NULL, '-', NULL, NULL, NULL, 410, 'Pcs', 410, 1, 1, 4, 1, '2026-04-29 18:15:53', '2026-04-29 18:15:53'),
(137, 'RPL-202604-0135', 'ClipFile', NULL, '-', NULL, NULL, NULL, 24, 'Pack', 24, 1, 1, 4, 1, '2026-04-29 18:16:39', '2026-04-29 18:16:39'),
(138, 'RPL-202604-0136', 'Tinta Spidol', NULL, '-', NULL, NULL, NULL, 144, 'Pcs', 144, 1, 1, 4, 1, '2026-04-29 18:17:32', '2026-04-29 18:17:32'),
(139, 'RPL-202604-0137', 'Isi Staples Kecil', '10x1000 pcs', 'Great Wall', NULL, NULL, NULL, 30, 'Pack', 30, 1, 1, 4, 1, '2026-04-29 18:19:21', '2026-04-29 18:19:21'),
(140, 'RPL-202604-0138', 'Penghapus Papan Tulis', NULL, '-', NULL, NULL, NULL, 12, 'Pcs', 12, 1, 1, 4, 1, '2026-04-29 18:20:50', '2026-04-29 18:20:50'),
(141, 'RPL-202604-0139', 'RAM', 'DDR 4 8GB', 'Kingston Longdim', '2025', NULL, NULL, 2, 'Unit', 2, 1, 45, 4, 1, '2026-04-29 18:25:30', '2026-04-29 19:36:53'),
(142, 'RPL-202604-0140', 'RJ45', NULL, 'Balden', '2025', NULL, NULL, 100, 'Pcs', 100, 1, 45, 4, 1, '2026-04-29 18:26:10', '2026-04-29 18:26:10'),
(143, 'RPL-202604-0141', 'Headphone', NULL, 'dbe', '2025', NULL, NULL, 8, 'Unit', 8, 1, 45, 4, 1, '2026-04-29 18:27:24', '2026-04-29 18:27:24'),
(144, 'RPL-202604-0142', 'Mouse', NULL, 'Logitech', '2025', NULL, NULL, 8, 'Unit', 8, 1, 45, 4, 1, '2026-04-29 18:29:17', '2026-04-29 19:44:53'),
(145, 'RPL-202604-0143', 'SSD Sata', '256 GB', 'Rx7', '2025', NULL, NULL, 2, 'Unit', 2, 1, 45, 4, 1, '2026-04-29 18:30:22', '2026-04-29 19:44:56'),
(146, 'RPL-202604-0144', 'Hardisk Eksternal', '1 TB', 'Adata HD710 Pro', '2025', NULL, NULL, 1, 'Unit', 1, 1, 47, 4, 1, '2026-04-29 18:31:50', '2026-04-29 18:31:50'),
(147, 'RPL-202604-0145', 'Stop Kontak 4 Lubang', NULL, 'Broco', '2025', NULL, NULL, 5, 'Unit', 5, 1, 45, 4, 1, '2026-04-29 18:33:00', '2026-04-29 18:33:00'),
(148, 'RPL-202604-0146', 'Kabel HDMI', '20 Meter', 'Sony', '2025', NULL, NULL, 1, 'Unit', 1, 1, 45, 4, 1, '2026-04-29 18:33:42', '2026-04-29 18:33:42'),
(149, 'RPL-202604-0147', 'Access Point', NULL, 'Ruijie RG-EW3200GX PRO 3200M', '2025', NULL, NULL, 1, 'Unit', 1, 1, 1, 4, 1, '2026-04-29 18:34:49', '2026-04-29 18:34:49'),
(150, 'RPL-202604-0148', 'Steaker', NULL, 'Broco', '2025', NULL, NULL, 10, 'Unit', 10, 1, 45, 4, 1, '2026-04-29 18:38:15', '2026-04-29 18:38:15'),
(151, 'RPL-202604-0149', 'Converter VGA to HDMI', NULL, 'Sony', '2025', NULL, NULL, 5, 'Unit', 5, 1, 13, 4, 1, '2026-04-29 18:58:48', '2026-04-29 18:58:48'),
(152, 'RPL-202604-0150', 'RAM', 'DDR3 8GB', 'Kingston Longdim', '2025', NULL, NULL, 9, 'Unit', 9, 1, 45, 4, 1, '2026-04-29 19:25:23', '2026-04-29 19:44:46'),
(153, 'RPL-202604-0151', 'Power Supplay', NULL, 'Coolermaster', NULL, NULL, NULL, 0, 'Unit', 0, 1, 45, 4, 1, '2026-04-29 19:26:11', '2026-04-29 19:44:32'),
(154, 'RPL-202604-0152', 'Power Supplay', NULL, 'Corsair', NULL, NULL, NULL, 2, 'Unit', 2, 1, 45, 4, 1, '2026-04-29 19:26:49', '2026-04-29 19:44:50'),
(155, 'RPL-202604-0153', 'DVD External Portabel', NULL, 'Asus', NULL, NULL, NULL, 1, 'Unit', 1, 1, 47, 4, 1, '2026-04-29 21:19:33', '2026-04-29 21:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjamans`
--

CREATE TABLE `detail_peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjamans`
--

INSERT INTO `detail_peminjamans` (`id`, `peminjaman_id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, 5, 10, 1, '2026-04-24 21:22:24', '2026-04-24 21:22:24'),
(5, 6, 13, 1, '2026-04-29 15:00:45', '2026-04-29 15:00:45'),
(6, 7, 10, 1, '2026-04-29 17:21:22', '2026-04-29 17:21:22'),
(7, 8, 10, 1, '2026-04-29 17:22:19', '2026-04-29 17:22:19'),
(8, 9, 10, 1, '2026-04-29 17:23:46', '2026-04-29 17:23:46'),
(9, 10, 11, 1, '2026-04-29 17:26:09', '2026-04-29 17:26:09'),
(10, 11, 10, 1, '2026-04-29 17:28:29', '2026-04-29 17:28:29'),
(11, 12, 3, 1, '2026-04-29 17:29:37', '2026-04-29 17:29:37'),
(12, 12, 12, 1, '2026-04-29 17:29:37', '2026-04-29 17:29:37'),
(13, 13, 155, 1, '2026-04-29 21:20:31', '2026-04-29 21:20:31'),
(14, 14, 3, 1, '2026-04-29 21:21:21', '2026-04-29 21:21:21'),
(15, 15, 3, 1, '2026-04-29 21:22:53', '2026-04-29 21:22:53'),
(16, 16, 10, 1, '2026-04-29 21:24:46', '2026-04-29 21:24:46'),
(17, 17, 155, 1, '2026-04-29 21:26:59', '2026-04-29 21:26:59'),
(18, 18, 12, 1, '2026-04-29 21:28:29', '2026-04-29 21:28:29'),
(19, 19, 12, 1, '2026-04-29 21:29:31', '2026-04-29 21:29:31'),
(20, 20, 3, 1, '2026-04-29 21:31:33', '2026-04-29 21:31:33'),
(21, 21, 12, 1, '2026-04-29 21:32:34', '2026-04-29 21:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaans`
--

CREATE TABLE `detail_permintaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permintaan_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_penggunaan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_permintaans`
--

INSERT INTO `detail_permintaans` (`id`, `permintaan_id`, `barang_id`, `jumlah`, `status_penggunaan`, `created_at`, `updated_at`) VALUES
(4, 6, 141, 1, 'belum_habis', '2026-04-29 19:36:10', '2026-04-29 19:36:10'),
(5, 7, 154, 1, 'belum_habis', '2026-04-29 19:38:46', '2026-04-29 19:38:46'),
(6, 8, 144, 1, 'belum_habis', '2026-04-29 19:39:58', '2026-04-29 19:39:58'),
(7, 9, 145, 2, 'belum_habis', '2026-04-29 19:41:45', '2026-04-29 19:41:45'),
(8, 10, 152, 1, 'belum_habis', '2026-04-29 19:42:45', '2026-04-29 19:42:45'),
(9, 11, 133, 36, 'belum_habis', '2026-04-29 19:43:42', '2026-04-29 19:43:42'),
(10, 12, 153, 1, 'belum_habis', '2026-04-29 19:44:25', '2026-04-29 19:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'Bahan ATK', 1, '2026-04-14 19:12:42', '2026-04-14 19:12:42'),
(2, 'Komputer', 1, '2026-04-14 19:12:44', '2026-04-14 19:12:44'),
(4, 'Printer', 1, '2026-04-23 08:24:14', '2026-04-23 08:24:14'),
(5, 'Meja', 1, '2026-04-23 08:24:19', '2026-04-23 08:24:19'),
(6, 'Lemari', 1, '2026-04-23 08:24:24', '2026-04-23 08:24:24'),
(7, 'Kursi', 1, '2026-04-23 08:24:31', '2026-04-23 08:24:31'),
(8, 'Proyektor', 1, '2026-04-23 08:24:41', '2026-04-23 08:24:41'),
(9, 'AC', 1, '2026-04-23 08:24:46', '2026-04-23 08:24:46'),
(10, 'Papan Tulis', 1, '2026-04-23 08:24:57', '2026-04-23 08:24:57'),
(11, 'Monitor', 1, '2026-04-23 08:26:31', '2026-04-23 08:26:31'),
(12, 'Speaker', 1, '2026-04-23 08:26:37', '2026-04-23 08:26:37'),
(13, 'Converter', 1, '2026-04-23 08:26:56', '2026-04-23 08:26:56'),
(14, 'Rak', 1, '2026-04-23 08:27:03', '2026-04-23 08:27:03'),
(15, 'HUB', 1, '2026-04-23 08:27:10', '2026-04-23 08:27:10'),
(16, 'Vacum', 1, '2026-04-23 08:27:15', '2026-04-23 08:27:15'),
(17, 'Micro Controller', 1, '2026-04-23 08:27:28', '2026-04-23 08:27:28'),
(18, 'Kabel', 1, '2026-04-23 08:28:50', '2026-04-23 08:28:50'),
(19, 'Elektronik', 1, '2026-04-23 08:31:01', '2026-04-23 08:31:01'),
(20, 'Figura Dinding', 1, '2026-04-23 18:38:14', '2026-04-23 18:38:14'),
(21, 'Bahan ATK', 3, '2026-04-29 09:45:40', '2026-04-29 09:45:40'),
(22, 'AC', 3, '2026-04-29 09:45:57', '2026-04-29 09:45:57'),
(23, 'Komputer', 3, '2026-04-29 09:46:25', '2026-04-29 09:46:25'),
(24, 'Monitor', 3, '2026-04-29 09:47:39', '2026-04-29 09:47:39'),
(25, 'Meja', 3, '2026-04-29 09:47:43', '2026-04-29 09:47:43'),
(26, 'Etalase', 3, '2026-04-29 09:47:56', '2026-04-29 09:47:56'),
(27, 'Lemari', 3, '2026-04-29 09:48:02', '2026-04-29 09:48:02'),
(28, 'Kursi', 3, '2026-04-29 09:48:23', '2026-04-29 09:48:23'),
(29, 'P3K', 3, '2026-04-29 09:48:36', '2026-04-29 09:48:36'),
(30, 'Proyektor', 3, '2026-04-29 09:48:46', '2026-04-29 09:48:46'),
(31, 'Papan Tulis', 3, '2026-04-29 09:48:56', '2026-04-29 09:48:56'),
(32, 'Cermin', 3, '2026-04-29 09:49:06', '2026-04-29 09:49:06'),
(33, 'Printer', 3, '2026-04-29 09:49:43', '2026-04-29 09:49:43'),
(34, 'Scanner', 3, '2026-04-29 09:49:49', '2026-04-29 09:49:49'),
(35, 'HUB', 3, '2026-04-29 09:49:59', '2026-04-29 09:49:59'),
(36, 'Rak', 3, '2026-04-29 09:50:10', '2026-04-29 09:50:10'),
(37, 'Timbangan', 3, '2026-04-29 09:50:20', '2026-04-29 09:50:20'),
(38, 'Vakum', 3, '2026-04-29 09:50:31', '2026-04-29 09:50:31'),
(39, 'Bahan Alat Bersih', 3, '2026-04-29 09:50:43', '2026-04-29 09:50:43'),
(40, 'Tempat Sampah', 3, '2026-04-29 09:50:55', '2026-04-29 09:50:55'),
(41, 'Mouse', 3, '2026-04-29 09:51:03', '2026-04-29 09:51:03'),
(42, 'Komputer', 2, '2026-04-29 12:21:48', '2026-04-29 12:21:48'),
(43, 'Monitor', 2, '2026-04-29 12:22:23', '2026-04-29 12:22:23'),
(44, 'ATK', 1, '2026-04-29 14:58:25', '2026-04-29 14:58:25'),
(45, 'Bahan Komputer', 1, '2026-04-29 17:44:53', '2026-04-29 17:44:53'),
(47, 'Penyimpanan', 1, '2026-04-29 18:31:06', '2026-04-29 18:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `kondisis`
--

CREATE TABLE `kondisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kondisi` varchar(255) NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kondisis`
--

INSERT INTO `kondisis` (`id`, `nama_kondisi`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'Baik', 1, '2026-04-14 19:12:55', '2026-04-14 19:12:55'),
(2, 'Rusak', 1, '2026-04-14 19:12:59', '2026-04-14 19:12:59'),
(3, 'Rusak Berat', 1, '2026-04-14 19:13:01', '2026-04-14 19:13:01'),
(4, 'Rusak Berat', 3, '2026-04-29 09:01:09', '2026-04-29 09:01:09'),
(5, 'Rusak', 3, '2026-04-29 09:01:19', '2026-04-29 09:01:19'),
(6, 'Baik', 3, '2026-04-29 09:44:06', '2026-04-29 09:44:06'),
(7, 'Rusak Berat', 2, '2026-04-29 12:21:13', '2026-04-29 12:21:13'),
(8, 'Rusak', 2, '2026-04-29 12:21:24', '2026-04-29 12:21:24'),
(9, 'Baik', 2, '2026-04-29 12:21:29', '2026-04-29 12:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_14_061836_create_prodis_table', 1),
(5, '2026_04_14_061848_create_kategoris_table', 1),
(6, '2026_04_14_061901_create_ruangs_table', 1),
(7, '2026_04_14_061915_create_kondisis_table', 1),
(8, '2026_04_14_062046_add_custom_fields_to_users_table', 1),
(9, '2026_04_14_062110_create_barangs_table', 1),
(10, '2026_04_14_062329_create_peminjamans_table', 1),
(11, '2026_04_14_062338_create_detail_peminjamans_table', 1),
(12, '2026_04_14_062433_create_permintaans_table', 1),
(13, '2026_04_14_062457_create_detail_permintaans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('pending','ditolak','dipinjam','selesai') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `kode_transaksi`, `nama_peminjam`, `kelas`, `no_hp`, `prodi_id`, `tanggal_pinjam`, `tanggal_kembali`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(5, 'PMJ-20260424-CBGL', 'Alisha', 'XII RPL 1', '085777393035', 1, '2026-04-24', '2026-04-24', 'Membersihkan Lab RPL', 'selesai', '2026-04-24 21:22:24', '2026-04-29 14:55:24'),
(6, 'PMJ-20260429-E7XB', 'Pak Prisma', 'Guru', '-', 1, '2026-04-24', '2026-05-04', 'Untuk membuat properti Lomba', 'dipinjam', '2026-04-24 15:00:45', '2026-04-29 15:01:01'),
(7, 'PMJ-20260430-AQ5I', 'Maya', 'XI PSPT 1', '-', 1, '2026-01-15', '2026-01-15', 'Membersihkan Lab Studio', 'selesai', '2026-01-14 17:21:22', '2026-04-29 17:21:32'),
(8, 'PMJ-20260430-5ZBB', 'Khasy', 'XI PSPT 1', '-', 1, '2026-01-26', '2026-01-27', 'Membersihkan Studio', 'selesai', '2026-04-29 17:22:19', '2026-04-29 17:22:30'),
(9, 'PMJ-20260430-WGHL', 'Yusuf', 'XI RPL 1', '-', 1, '2026-02-04', '2026-02-04', 'Membersihkan Lab RPL 1', 'selesai', '2026-02-03 17:23:46', '2026-04-29 17:24:20'),
(10, 'PMJ-20260430-8W3S', 'Mas Alif', 'Meeting Room', '-', 1, '2026-02-09', '2026-02-09', 'Rapat', 'selesai', '2026-04-29 17:26:09', '2026-04-29 17:26:21'),
(11, 'PMJ-20260430-YJJQ', 'Meisi', 'XI MP 1', '-', 1, '2026-03-30', '2026-03-30', 'Membersihkan Kelas Industri', 'selesai', '2026-03-29 17:28:29', '2026-04-29 17:29:52'),
(12, 'PMJ-20260430-J5YL', 'Zaidan', 'XI RPL', '-', 1, '2026-04-06', '2026-04-06', 'Presentasi Mapel PKN', 'selesai', '2026-04-29 17:29:37', '2026-04-29 17:29:54'),
(13, 'PMJ-20260430-4C7W', 'Tyo Repsi', 'Teknisi', '-', 1, '2026-02-13', '2026-02-18', 'Install Ulang', 'selesai', '2026-04-29 21:20:31', '2026-04-29 21:21:42'),
(14, 'PMJ-20260430-KZPU', 'Alif', 'Teknisi', '-', 1, '2026-02-18', '2026-02-19', 'Zoom Aula', 'selesai', '2026-04-29 21:21:21', '2026-04-29 21:21:45'),
(15, 'PMJ-20260430-XIU4', 'Alif', 'Teknisi', '-', 1, '2026-02-25', '2026-02-25', 'Zoom Aula', 'selesai', '2026-04-29 21:22:53', '2026-04-29 21:23:05'),
(16, 'PMJ-20260430-H1BC', 'Ridho', 'XI PSPT 1', '-', 1, '2026-03-02', '2026-03-02', 'Membersihkan Studio', 'selesai', '2026-04-29 21:24:46', '2026-04-29 21:25:31'),
(17, 'PMJ-20260430-IQOL', 'Andi', 'Teknisi', '-', 1, '2026-03-16', '2026-04-10', 'Install Ulang', 'selesai', '2026-04-29 21:26:59', '2026-04-29 21:28:45'),
(18, 'PMJ-20260430-AZT3', 'Alif', 'Teknisi', '-', 1, '2026-04-17', '2026-04-17', 'Ruang Guru RPL', 'selesai', '2026-04-29 21:28:29', '2026-04-29 21:28:39'),
(19, 'PMJ-20260430-YAHY', 'Alif', 'Teknisi', '-', 1, '2026-04-21', '2026-04-21', 'Meeting Aula', 'selesai', '2026-04-29 21:29:31', '2026-04-29 21:30:00'),
(20, 'PMJ-20260430-VOOH', 'Pak Biqih', 'Teknisi', '-', 1, '2026-04-24', '2026-04-24', 'Rapat', 'selesai', '2026-04-29 21:31:33', '2026-04-29 21:31:42'),
(21, 'PMJ-20260430-AI3Q', 'Alif', 'Teknisi', '-', 1, '2026-04-27', '2026-04-27', 'Rapat Aula', 'selesai', '2026-04-29 21:32:34', '2026-04-29 21:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `permintaans`
--

CREATE TABLE `permintaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `nama_peminta` varchar(255) NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `tanggal_permintaan` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaans`
--

INSERT INTO `permintaans` (`id`, `kode_transaksi`, `nama_peminta`, `kelas`, `tanggal_permintaan`, `keterangan`, `status`, `prodi_id`, `created_at`, `updated_at`) VALUES
(6, 'PMT-20260430-G9NY', 'Zaky', 'Teknisi', '2026-01-05', 'Upgrade kopmuter Lab RPL', 'disetujui', 1, '2026-04-29 19:36:10', '2026-04-29 19:36:53'),
(7, 'PMT-20260430-QNQE', 'Zaky', 'Teknisi', '2026-04-30', 'Upgrade komputer Lab RPL', 'disetujui', 1, '2026-04-29 19:38:46', '2026-04-29 19:44:50'),
(8, 'PMT-20260430-7BGJ', 'Zaky', 'Teknisi', '2026-01-14', 'Untuk PC server', 'disetujui', 1, '2026-04-29 19:39:58', '2026-04-29 19:44:53'),
(9, 'PMT-20260430-WGJ1', 'Zaky', 'Teknisi', '2026-02-09', 'Upgrade Komputer Lab ICT', 'disetujui', 1, '2026-04-29 19:41:45', '2026-04-29 19:44:56'),
(10, 'PMT-20260430-5QQB', 'Zaky', 'Teknisi', '2026-02-18', 'Upgrade PC Lab RPL', 'disetujui', 1, '2026-04-29 19:42:45', '2026-04-29 19:44:46'),
(11, 'PMT-20260430-QWPA', 'Salsabila', 'XI RPL 1', '2026-03-11', 'Untuk tugas agama', 'disetujui', 1, '2026-04-29 19:43:42', '2026-04-29 19:44:43'),
(12, 'PMT-20260430-ECRF', 'Zaky', 'Teknisi', '2026-03-12', 'Ganti UPS PC Lab ICT', 'disetujui', 1, '2026-04-29 19:44:25', '2026-04-29 19:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Rekayasa Perangkat Lunak', '2026-04-14 19:01:07', '2026-04-14 19:01:07'),
(2, 'Broadcasting Perfilman', '2026-04-19 20:14:31', '2026-04-19 20:14:31'),
(3, 'Manajemen Perkantoran', '2026-04-19 20:14:42', '2026-04-19 20:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `ruangs`
--

CREATE TABLE `ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangs`
--

INSERT INTO `ruangs` (`id`, `nama_ruang`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'Lab RPL', 1, '2026-04-14 19:12:27', '2026-04-14 19:12:27'),
(2, 'Lab ICT', 1, '2026-04-14 19:12:32', '2026-04-14 19:12:32'),
(3, 'Kelas Industri', 1, '2026-04-14 19:12:34', '2026-04-14 19:12:34'),
(4, 'Ruang Instruktur', 1, '2026-04-14 19:12:37', '2026-04-14 19:12:37'),
(5, 'Lab MP 1', 3, '2026-04-29 08:58:27', '2026-04-29 08:58:27'),
(6, 'Kelas Industri MP', 3, '2026-04-29 08:58:57', '2026-04-29 08:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('82FPX62T6fVNz8FGtwo4SE1SFwWMcTC93kFB1pN0', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU2NHalJIREI3VnhqYUlGVDNDNXcza0tTcnoxNzVwZUtQdDZtNVE1QSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVtaW5qYW1hbiI7czo1OiJyb3V0ZSI7czoxNjoicGVtaW5qYW1hbi5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1777525592),
('u2ysCEwV6VNEHe79MhFTPff85AEtQ2rvFHZDbVXK', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTHpGUEVZcDZwVHdCR3A5enFQeXA3MFNzeWVub05JNTg4aFUyZjFkTiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1777535122);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `role` enum('teknisi','peminjam','kaprodi') NOT NULL DEFAULT 'peminjam',
  `prodi_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `kelas`, `no_hp`, `role`, `prodi_id`) VALUES
(1, 'Zaky Rama', 'admin@gmail.com', NULL, '$2y$12$UEKZzF6NQxtoRhEuxSPb2.hICAlzSLyuSlTjIm/gphxbloX6m8xlG', NULL, '2026-04-14 19:00:36', '2026-04-14 19:00:36', NULL, NULL, 'teknisi', 1),
(2, 'Siswa RPL', 'siswa@gmail.com', NULL, '$2y$12$Iatt2Xp4OGHyXyw9Ry7dTuT6NuaP2QFNcpfeRZmsExJ7j6l5ZiYj.', NULL, '2026-04-15 18:03:50', '2026-04-19 22:19:39', NULL, NULL, 'peminjam', 1),
(3, 'Teknisi MPLB', 'mplb@gmail.com', NULL, '$2y$12$YMhFPS5YNQLVhef.p8X2neuiZEUOwuQZD/6U80pjD9R8r56yiy8Va', NULL, '2026-04-24 08:40:30', '2026-04-24 08:40:30', NULL, NULL, 'teknisi', 3),
(4, 'Siswa X MP 1', 'xmp1@gmail.com', NULL, '$2y$12$c5.F3m5ewvegHtw7Wnfy..sl7Te0Y8hxlyX02jO18kBSB9.hwTw4C', NULL, '2026-04-29 12:15:13', '2026-04-29 12:15:13', NULL, NULL, 'peminjam', 3),
(5, 'Kaprodi MP', 'kaprodimp@gmail.com', NULL, '$2y$12$8wydeRX4o1cqrR5Ru.5nk.T2GYvEbvxj/yp4/38X/dpMkaju31BhS', NULL, '2026-04-29 12:16:12', '2026-04-29 12:16:12', NULL, NULL, 'kaprodi', 3),
(6, 'Admin BP', 'adminbp@gmail.com', NULL, '$2y$12$jm9DwLQyA0cgSXPYeR8bre4OVGgZAw/ZOupzWTfsdG0qRxPEnSM2.', NULL, '2026-04-29 12:17:05', '2026-04-29 12:17:05', NULL, NULL, 'teknisi', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`),
  ADD KEY `barangs_prodi_id_foreign` (`prodi_id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`),
  ADD KEY `barangs_ruang_id_foreign` (`ruang_id`),
  ADD KEY `barangs_kondisi_id_foreign` (`kondisi_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_peminjamans_peminjaman_id_foreign` (`peminjaman_id`),
  ADD KEY `detail_peminjamans_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `detail_permintaans`
--
ALTER TABLE `detail_permintaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_permintaans_permintaan_id_foreign` (`permintaan_id`),
  ADD KEY `detail_permintaans_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoris_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `kondisis`
--
ALTER TABLE `kondisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kondisis_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjamans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `peminjamans_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `permintaans`
--
ALTER TABLE `permintaans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permintaans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `permintaans_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruangs_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_prodi_id_foreign` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_permintaans`
--
ALTER TABLE `detail_permintaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `kondisis`
--
ALTER TABLE `kondisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`),
  ADD CONSTRAINT `barangs_kondisi_id_foreign` FOREIGN KEY (`kondisi_id`) REFERENCES `kondisis` (`id`),
  ADD CONSTRAINT `barangs_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `barangs_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`);

--
-- Constraints for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD CONSTRAINT `detail_peminjamans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `detail_peminjamans_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_permintaans`
--
ALTER TABLE `detail_permintaans`
  ADD CONSTRAINT `detail_permintaans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `detail_permintaans_permintaan_id_foreign` FOREIGN KEY (`permintaan_id`) REFERENCES `permintaans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD CONSTRAINT `kategoris_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kondisis`
--
ALTER TABLE `kondisis`
  ADD CONSTRAINT `kondisis_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `permintaans`
--
ALTER TABLE `permintaans`
  ADD CONSTRAINT `permintaans_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD CONSTRAINT `ruangs_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
