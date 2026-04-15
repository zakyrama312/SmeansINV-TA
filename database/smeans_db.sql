-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2026 at 10:17 AM
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
-- Database: `smeans_db`
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
  `foto` varchar(255) DEFAULT NULL,
  `foto_thumbnail` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `deskripsi`, `merk`, `foto`, `foto_thumbnail`, `stok`, `jumlah_tersedia`, `prodi_id`, `kategori_id`, `ruang_id`, `kondisi_id`, `created_at`, `updated_at`) VALUES
(1, '-', 'Penggaris Panjgan', NULL, '-', NULL, NULL, 0, 0, 1, 1, 4, 3, '2026-04-14 19:13:38', '2026-04-14 22:02:17');

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
(1, 2, 1, 1, '2026-04-14 19:26:24', '2026-04-14 19:26:24'),
(2, 3, 1, 1, '2026-04-14 19:51:02', '2026-04-14 19:51:02'),
(3, 4, 1, 1, '2026-04-14 21:56:53', '2026-04-14 21:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaans`
--

CREATE TABLE `detail_permintaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permintaan_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_permintaans`
--

INSERT INTO `detail_permintaans` (`id`, `permintaan_id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-04-14 21:56:22', '2026-04-14 21:56:22');

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
(1, 'Alat Tulis Kantor', 1, '2026-04-14 19:12:42', '2026-04-14 19:12:42'),
(2, 'Komputer', 1, '2026-04-14 19:12:44', '2026-04-14 19:12:44'),
(3, 'AC', 1, '2026-04-14 19:12:47', '2026-04-14 19:12:47');

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
(1, 'Rusak Berat', 1, '2026-04-14 19:12:55', '2026-04-14 19:12:55'),
(2, 'Rusak', 1, '2026-04-14 19:12:59', '2026-04-14 19:12:59'),
(3, 'Baik', 1, '2026-04-14 19:13:01', '2026-04-14 19:13:01');

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
(2, 'PINJAM-20260415-E7YQ', 'Zaky', 'XI RPL 1', '085802908730', 1, '2026-04-15', '2026-04-16', NULL, 'selesai', '2026-04-14 19:26:24', '2026-04-14 19:50:46'),
(3, 'PINJAM-20260415-MYTM', 'Zaky', 'XI RPL 1', '085802908730', 1, '2026-04-15', '2026-04-16', 'Alasan Ditolak: sedang dipinjam kelas lain', 'ditolak', '2026-04-14 19:51:02', '2026-04-14 20:00:16'),
(4, 'PINJAM-20260415-EQAN', 'Rama Dhan', 'XI RPL 1', '085802908730', 1, '2026-04-15', '2026-04-16', 'Alasan Ditolak: sudah diminta', 'ditolak', '2026-04-14 21:56:53', '2026-04-14 22:02:41');

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
(1, 'MINTA-20260415-BL0F', 'Ramadhan', 'X RPL 1', '2026-04-15', NULL, 'disetujui', 1, '2026-04-14 21:56:22', '2026-04-14 22:02:17');

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
(1, 'RPL', '2026-04-14 19:01:07', '2026-04-14 19:01:07');

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
(4, 'Ruang Instruktur', 1, '2026-04-14 19:12:37', '2026-04-14 19:12:37');

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
('05TmjXKg01JD7vGo4OIBJaKW90fO8qXaKQaxxnvN', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidnFtaXBaM3VYRUJkSGI1Y2w5bmVwWUlDdzhRa1p5QnBzR3dmNUJVZSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvcGVtaW5qYW1hbi9jcmVhdGUiO3M6NToicm91dGUiO3M6MTc6InBlbWluamFtYW4uY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1776241054);

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
(1, 'Zaky Rama', 'admin@gmail.com', NULL, '$2y$12$UEKZzF6NQxtoRhEuxSPb2.hICAlzSLyuSlTjIm/gphxbloX6m8xlG', NULL, '2026-04-14 19:00:36', '2026-04-14 19:00:36', NULL, NULL, 'peminjam', 1);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_permintaans`
--
ALTER TABLE `detail_permintaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kondisis`
--
ALTER TABLE `kondisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
