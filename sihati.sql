-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2026 at 12:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sihati`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_table` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Komputer/Laptop', 'categories', 1, '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala\", \"is_active\": true, \"created_at\": \"2026-07-05T03:31:07.000000Z\", \"updated_at\": \"2026-07-05T03:31:07.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": true, \"created_at\": \"2026-07-05T03:31:07.000000Z\", \"updated_at\": \"2026-07-05T06:04:53.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-04 23:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `aduans`
--

CREATE TABLE `aduans` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_tiket` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelapor_id` bigint UNSIGNED NOT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `bidang_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `priority_id` bigint UNSIGNED DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kontak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_aduan` timestamp NOT NULL,
  `tanggal_diterima` timestamp NULL DEFAULT NULL,
  `tanggal_diproses` timestamp NULL DEFAULT NULL,
  `tanggal_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aduan_attachments`
--

CREATE TABLE `aduan_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `aduan_id` bigint UNSIGNED NOT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aduan_comments`
--

CREATE TABLE `aduan_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `aduan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aduan_notes`
--

CREATE TABLE `aduan_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `aduan_id` bigint UNSIGNED NOT NULL,
  `petugas_id` bigint UNSIGNED NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aduan_status_histories`
--

CREATE TABLE `aduan_status_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `aduan_id` bigint UNSIGNED NOT NULL,
  `status_sebelumnya_id` bigint UNSIGNED DEFAULT NULL,
  `status_baru_id` bigint UNSIGNED NOT NULL,
  `changed_by` bigint UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bidang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidangs`
--

INSERT INTO `bidangs` (`id`, `nama_bidang`, `keterangan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sekretariat', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(2, 'Bidang Anggaran', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(3, 'Bidang Perbendaharaan', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(4, 'Bidang Akuntansi', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(5, 'Bidang Aset', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(6, 'Bidang Pajak/Retribusi', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-pegawai@sihati.local|127.0.0.1', 'i:1;', 1783297978),
('laravel-cache-pegawai@sihati.local|127.0.0.1:timer', 'i:1783297978;', 1783297978),
('laravel-cache-pegawaiit|127.0.0.1', 'i:1;', 1783223743),
('laravel-cache-pegawaiit|127.0.0.1:timer', 'i:1783223743;', 1783223743);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `deskripsi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Komputer/Laptop', 'Masalah komputer, laptop, lambat, error, atau tidak menyala.', 1, '2026-07-04 20:31:07', '2026-07-04 23:04:53'),
(2, 'Printer/Scanner', 'Masalah printer, scanner, tinta, kertas macet, atau gagal cetak', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(3, 'Jaringan Internet', 'Masalah WiFi, LAN, koneksi internet lambat atau terputus', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(4, 'Aplikasi/Sistem', 'Masalah aplikasi internal atau sistem kerja', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(5, 'Akun/Login', 'Masalah lupa password, akun terkunci, atau gagal login', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(6, 'Email', 'Masalah email masuk, email keluar, atau konfigurasi email', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(7, 'Perangkat Pendukung', 'Masalah monitor, proyektor, kabel, UPS, dan perangkat lain', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(8, 'Lainnya', 'Masalah lain yang belum masuk kategori utama', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_03_024709_create_statuses_table', 1),
(5, '2026_07_03_024710_create_activity_logs_table', 1),
(6, '2026_07_03_025436_create_bidangs_table', 1),
(7, '2026_07_03_025734_create_categories_table', 1),
(8, '2026_07_03_025737_create_priorities_table', 1),
(9, '2026_07_03_030619_add_bidang_id_to_users_table', 1),
(10, '2026_07_03_062807_add_is_active_to_bidangs_table', 1),
(11, '2026_07_03_083404_create_aduans_table', 1),
(12, '2026_07_03_083424_create_aduan_attachments_table', 1),
(13, '2026_07_03_083433_create_aduan_notes_table', 1),
(14, '2026_07_03_083446_create_aduan_comments_table', 1),
(15, '2026_07_03_083455_create_ratings_table', 1),
(16, '2026_07_03_083520_create_aduan_status_histories_table', 1),
(17, '2026_07_03_100000_add_user_columns_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_prioritas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `nama_prioritas`, `keterangan`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Rendah', 'Masalah tidak terlalu mengganggu pekerjaan utama', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(2, 'Sedang', 'Masalah menghambat sebagian pekerjaan', 2, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(3, 'Tinggi', 'Masalah menghambat pekerjaan penting', 3, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(4, 'Mendesak', 'Masalah berdampak besar dan harus segera ditangani', 4, '2026-07-04 20:31:07', '2026-07-04 20:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `aduan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f9p9SsahFcUZbmrEZwOYCuS2UKvENaU2RpUOLGtl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJMU1hybW1lOXJyc0xFYVlaTnlSb1pTVEdHSU9MYWg1RDhyREZpZktOIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9hZHVhbiIsInJvdXRlIjoiYWRtaW4uYWR1YW4uaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1783298819),
('zmOKhMZdkitVHuSNnKJ8mf9tbWByTMkR8VRRUsjZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ0R3plR2tFaFBvY2pUamM2bzdhNjlRVU5adzNycWM5MDFxTzhDQzBlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wZWdhd2FpXC9kYXNoYm9hcmQiLCJyb3V0ZSI6InBlZ2F3YWkuZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1783298814);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '1',
  `is_final` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `kode_status`, `nama_status`, `urutan`, `is_final`, `created_at`, `updated_at`) VALUES
(1, 'diterima', 'Diterima', 1, 0, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(2, 'diproses', 'Diproses', 2, 0, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(3, 'selesai', 'Selesai', 3, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `bidang_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('pegawai','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pegawai',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bidang_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `no_hp`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin SIHATI', 'admin', 'admin@sihati.local', NULL, '$2y$12$e6nQ83zyZveb8a..hugc4u8zNFn3DKFMyAsjHn9Vw7D1.E/xlFzKe', '081234567890', 'admin', 1, NULL, '2026-07-04 20:31:08', '2026-07-04 20:31:08'),
(2, 1, 'Petugas IT', 'petugasit', 'petugas@sihati.local', NULL, '$2y$12$8Eflwknfice4YuzVz27uIu80ZpaaPJYYomKChuEpapWbVagAT4m/G', '081234567891', 'pegawai', 1, NULL, '2026-07-04 20:31:08', '2026-07-04 20:31:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `aduans`
--
ALTER TABLE `aduans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aduans_nomor_tiket_unique` (`nomor_tiket`),
  ADD KEY `aduans_petugas_id_foreign` (`petugas_id`),
  ADD KEY `aduans_bidang_id_foreign` (`bidang_id`),
  ADD KEY `aduans_category_id_foreign` (`category_id`),
  ADD KEY `aduans_priority_id_foreign` (`priority_id`),
  ADD KEY `aduans_status_id_priority_id_index` (`status_id`,`priority_id`),
  ADD KEY `aduans_pelapor_id_index` (`pelapor_id`),
  ADD KEY `aduans_created_at_index` (`created_at`);

--
-- Indexes for table `aduan_attachments`
--
ALTER TABLE `aduan_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aduan_attachments_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `aduan_attachments_aduan_id_index` (`aduan_id`);

--
-- Indexes for table `aduan_comments`
--
ALTER TABLE `aduan_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aduan_comments_user_id_foreign` (`user_id`),
  ADD KEY `aduan_comments_aduan_id_created_at_index` (`aduan_id`,`created_at`);

--
-- Indexes for table `aduan_notes`
--
ALTER TABLE `aduan_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aduan_notes_petugas_id_foreign` (`petugas_id`),
  ADD KEY `aduan_notes_aduan_id_index` (`aduan_id`);

--
-- Indexes for table `aduan_status_histories`
--
ALTER TABLE `aduan_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aduan_status_histories_status_sebelumnya_id_foreign` (`status_sebelumnya_id`),
  ADD KEY `aduan_status_histories_status_baru_id_foreign` (`status_baru_id`),
  ADD KEY `aduan_status_histories_changed_by_foreign` (`changed_by`),
  ADD KEY `aduan_status_histories_aduan_id_created_at_index` (`aduan_id`,`created_at`);

--
-- Indexes for table `bidangs`
--
ALTER TABLE `bidangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidangs_is_active_index` (`is_active`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ratings_aduan_id_user_id_unique` (`aduan_id`,`user_id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_kode_status_unique` (`kode_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_bidang_id_foreign` (`bidang_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aduans`
--
ALTER TABLE `aduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aduan_attachments`
--
ALTER TABLE `aduan_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aduan_comments`
--
ALTER TABLE `aduan_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aduan_notes`
--
ALTER TABLE `aduan_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aduan_status_histories`
--
ALTER TABLE `aduan_status_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `aduans`
--
ALTER TABLE `aduans`
  ADD CONSTRAINT `aduans_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduans_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduans_pelapor_id_foreign` FOREIGN KEY (`pelapor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduans_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `aduans_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `aduans_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `aduan_attachments`
--
ALTER TABLE `aduan_attachments`
  ADD CONSTRAINT `aduan_attachments_aduan_id_foreign` FOREIGN KEY (`aduan_id`) REFERENCES `aduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduan_attachments_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aduan_comments`
--
ALTER TABLE `aduan_comments`
  ADD CONSTRAINT `aduan_comments_aduan_id_foreign` FOREIGN KEY (`aduan_id`) REFERENCES `aduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduan_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aduan_notes`
--
ALTER TABLE `aduan_notes`
  ADD CONSTRAINT `aduan_notes_aduan_id_foreign` FOREIGN KEY (`aduan_id`) REFERENCES `aduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduan_notes_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aduan_status_histories`
--
ALTER TABLE `aduan_status_histories`
  ADD CONSTRAINT `aduan_status_histories_aduan_id_foreign` FOREIGN KEY (`aduan_id`) REFERENCES `aduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduan_status_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aduan_status_histories_status_baru_id_foreign` FOREIGN KEY (`status_baru_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `aduan_status_histories_status_sebelumnya_id_foreign` FOREIGN KEY (`status_sebelumnya_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_aduan_id_foreign` FOREIGN KEY (`aduan_id`) REFERENCES `aduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
