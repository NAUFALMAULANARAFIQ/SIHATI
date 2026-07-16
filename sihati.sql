-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2026 at 06:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.23

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
(1, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Komputer/Laptop', 'categories', 1, '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala\", \"is_active\": true, \"created_at\": \"2026-07-05T03:31:07.000000Z\", \"updated_at\": \"2026-07-05T03:31:07.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": true, \"created_at\": \"2026-07-05T03:31:07.000000Z\", \"updated_at\": \"2026-07-05T06:04:53.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-04 23:04:53'),
(2, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0000 dengan status diterima.', 'aduans', 1, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0000\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-05 17:53:17'),
(3, 1, 'add_note', 'aduan', 'Admin menambahkan catatan penanganan pada aduan SIHATI-2026-0000.', 'aduan_notes', 1, NULL, '{\"catatan\": \"Akan segera ditangani\", \"aduan_id\": 1}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:00:01'),
(4, 1, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0000.', 'aduan_comments', 1, NULL, '{\"aduan_id\": 1, \"komentar\": \"Kemungkinan karena terlalu lama sendiri\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:00:33'),
(5, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0001 dengan status diterima.', 'aduans', 2, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0001\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:02:36'),
(6, 1, 'upload_attachment', 'aduan', 'User mengupload lampiran Laporan Aduan - SIHATI BPPKAD.pdf pada aduan SIHATI-2026-0001.', 'aduan_attachments', 1, NULL, '{\"aduan_id\": 2, \"file_name\": \"Laporan Aduan - SIHATI BPPKAD.pdf\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:02:37'),
(7, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0000 dari Diterima menjadi Diproses.', 'aduans', 1, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:12:30'),
(8, 1, 'upload_attachment', 'aduan', 'User mengupload lampiran ChatGPT Image Jul 5, 2026, 10_50_28 PM.png pada aduan SIHATI-2026-0000.', 'aduan_attachments', 2, NULL, '{\"aduan_id\": 1, \"file_name\": \"ChatGPT Image Jul 5, 2026, 10_50_28 PM.png\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:12:44'),
(9, 1, 'export_laporan', 'laporan', 'Admin mengekspor laporan aduan ke Excel.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 01:26:30'),
(10, 2, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0002 dengan status diterima.', 'aduans', 3, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0002\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:48:25'),
(11, 2, 'upload_attachment', 'aduan', 'User mengupload lampiran WhatsApp Image 2026-07-05 at 22.35.28 (2).jpeg pada aduan SIHATI-2026-0002.', 'aduan_attachments', 3, NULL, '{\"aduan_id\": 3, \"file_name\": \"WhatsApp Image 2026-07-05 at 22.35.28 (2).jpeg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:48:25'),
(12, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0002 dari Diterima menjadi Diproses.', 'aduans', 3, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:50:08'),
(13, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0002 dari Diproses menjadi Selesai.', 'aduans', 3, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:50:32'),
(14, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:51:24'),
(15, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:51:27'),
(16, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:52:19'),
(17, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 02:52:37'),
(18, 1, 'update', 'bidang', 'Admin mengubah bidang: Sekretariat', 'bidangs', 1, '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 03:56:44'),
(19, 1, 'update', 'bidang', 'Admin mengubah bidang: Sekretariat', 'bidangs', 1, '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', '2026-07-06 03:57:20'),
(20, 1, 'update', 'bidang', 'Admin mengubah bidang: Bidang Anggaran', 'bidangs', 2, '{\"id\": 2, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Bidang Anggaran\"}', '{\"id\": 2, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": \"Bidang Anggaran\", \"updated_at\": \"2026-07-06T04:11:21.000000Z\", \"nama_bidang\": \"Bidang Anggaran\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 04:11:21'),
(21, 1, 'delete', 'bidang', 'Admin menghapus bidang: Bidang Pajak/Retribusi', 'bidangs', 6, '{\"id\": 6, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Bidang Pajak/Retribusi\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 04:11:49'),
(22, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Printer/Scanner', 'categories', 2, '{\"id\": 2, \"deskripsi\": \"Masalah printer, scanner, tinta, kertas macet, atau gagal cetak\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_kategori\": \"Printer/Scanner\"}', '{\"id\": 2, \"deskripsi\": \"Masalah printer, scanner, tinta, kertas macet, atau gagal cetak.\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-06T04:12:19.000000Z\", \"nama_kategori\": \"Printer/Scanner\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 04:12:19'),
(23, 1, 'delete', 'kategori', 'Admin menghapus kategori aduan: Lainnya', 'categories', 8, '{\"id\": 8, \"deskripsi\": \"Masalah lain yang belum masuk kategori utama\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_kategori\": \"Lainnya\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 04:12:32'),
(24, 1, 'update', 'bidang', 'Admin mengubah bidang: Sekretariat', 'bidangs', 1, '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": \"Bidang Sekretariat Lantai 1\", \"updated_at\": \"2026-07-06T05:43:54.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 05:43:54'),
(25, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Jaringan Internet', 'categories', 3, '{\"id\": 3, \"deskripsi\": \"Masalah WiFi, LAN, koneksi internet lambat atau terputus\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_kategori\": \"Jaringan Internet\"}', '{\"id\": 3, \"deskripsi\": \"Masalah WiFi, LAN, koneksi internet lambat atau terputus.\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-06T05:48:19.000000Z\", \"nama_kategori\": \"Jaringan Internet\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 05:48:19'),
(26, 1, 'create', 'bidang', 'Admin menambahkan bidang: Bidang Pendataan', 'bidangs', 7, NULL, '{\"id\": 7, \"is_active\": true, \"created_at\": \"2026-07-06T06:28:10.000000Z\", \"keterangan\": \"Bidang Pendataan Lantai 2\", \"updated_at\": \"2026-07-06T06:28:10.000000Z\", \"nama_bidang\": \"Bidang Pendataan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 06:28:10'),
(27, 1, 'create', 'kategori', 'Admin menambahkan kategori aduan: Lainnya', 'categories', 9, NULL, '{\"id\": 9, \"deskripsi\": \"Masalah diluar kategori yang ada\", \"is_active\": true, \"created_at\": \"2026-07-06T06:33:22.000000Z\", \"updated_at\": \"2026-07-06T06:33:22.000000Z\", \"nama_kategori\": \"Lainnya\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-06 06:33:22'),
(28, 2, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0002 dengan status diterima.', 'aduans', 4, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0002\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:27:32'),
(29, 2, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0002.', 'aduan_comments', 2, NULL, '{\"aduan_id\": 4, \"komentar\": \"Tolong segera diperbaiki yh, saya mau main GTA 5\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:28:06'),
(30, 1, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0002.', 'aduan_comments', 3, NULL, '{\"aduan_id\": 4, \"komentar\": \"Baik akan segera diperbaiki\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:29:10'),
(31, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0002 dari Diterima menjadi Diproses.', 'aduans', 4, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:29:37'),
(32, 1, 'add_note', 'aduan', 'Admin menambahkan catatan penanganan pada aduan SIHATI-2026-0002.', 'aduan_notes', 2, NULL, '{\"catatan\": \"Wifi lemot disebabkan karena Anda sendiri ngapain download GTA 5\", \"aduan_id\": 4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:30:33'),
(33, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0002 dari Diproses menjadi Selesai.', 'aduans', 4, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:31:33'),
(34, 1, 'add_note', 'aduan', 'Admin menambahkan catatan penanganan pada aduan SIHATI-2026-0002.', 'aduan_notes', 3, NULL, '{\"catatan\": \"Router sudah direset, lain kali klo mau download GTA V jangan pake jaringan kantor\", \"aduan_id\": 4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:32:24'),
(35, 2, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0002.', 'aduan_comments', 4, NULL, '{\"aduan_id\": 4, \"komentar\": \"Oke terimakasih\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:51:39'),
(36, 2, 'add_rating', 'aduan', 'Pegawai memberikan rating 4/5 pada aduan SIHATI-2026-0002.', 'ratings', 1, NULL, '{\"rating\": 4, \"aduan_id\": 4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 00:56:14'),
(37, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', '2026-07-07 03:48:06'),
(38, 1, 'delete', 'kategori', 'Admin menghapus kategori aduan: Lainnya', 'categories', 9, '{\"id\": 9, \"deskripsi\": \"Masalah diluar kategori yang ada\", \"is_active\": true, \"created_at\": \"2026-07-06T06:33:22.000000Z\", \"updated_at\": \"2026-07-06T06:33:22.000000Z\", \"nama_kategori\": \"Lainnya\"}', NULL, '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 04:01:59'),
(39, 1, 'update', 'bidang', 'Admin mengubah bidang: Bidang Pendataan', 'bidangs', 7, '{\"id\": 7, \"is_active\": 1, \"created_at\": \"2026-07-06T06:28:10.000000Z\", \"keterangan\": \"Bidang Pendataan Lantai 2\", \"updated_at\": \"2026-07-06T06:28:10.000000Z\", \"nama_bidang\": \"Bidang Pendataan\"}', '{\"id\": 7, \"is_active\": 0, \"created_at\": \"2026-07-06T06:28:10.000000Z\", \"keterangan\": \"Bidang Pendataan Lantai 2\", \"updated_at\": \"2026-07-07T04:06:04.000000Z\", \"nama_bidang\": \"Bidang Pendataan\"}', '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 04:06:04'),
(40, 1, 'update', 'bidang', 'Admin mengubah bidang: Bidang Pendataan', 'bidangs', 7, '{\"id\": 7, \"is_active\": 0, \"created_at\": \"2026-07-06T06:28:10.000000Z\", \"keterangan\": \"Bidang Pendataan Lantai 2\", \"updated_at\": \"2026-07-07T04:06:04.000000Z\", \"nama_bidang\": \"Bidang Pendataan\"}', '{\"id\": 7, \"is_active\": 1, \"created_at\": \"2026-07-06T06:28:10.000000Z\", \"keterangan\": \"Bidang Pendataan Lantai 2\", \"updated_at\": \"2026-07-07T04:06:10.000000Z\", \"nama_bidang\": \"Bidang Pendataan\"}', '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 04:06:10'),
(41, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Komputer/Laptop', 'categories', 1, '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-04T23:04:53.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": false, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-07T04:09:42.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 04:09:42'),
(42, 1, 'update', 'kategori', 'Admin mengubah kategori aduan: Komputer/Laptop', 'categories', 1, '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": false, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-07T04:09:42.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '{\"id\": 1, \"deskripsi\": \"Masalah komputer, laptop, lambat, error, atau tidak menyala.\", \"is_active\": true, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"updated_at\": \"2026-07-07T04:09:48.000000Z\", \"nama_kategori\": \"Komputer/Laptop\"}', '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 04:09:48'),
(43, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '10.15.12.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-07-07 05:29:42'),
(44, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0003 dengan status diterima.', 'aduans', 5, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0003\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 07:51:05'),
(45, 1, 'upload_attachment', 'aduan', 'User mengupload lampiran ChatGPT Image Jul 5, 2026, 10_50_28 PM.png pada aduan SIHATI-2026-0003.', 'aduan_attachments', 4, NULL, '{\"aduan_id\": 5, \"file_name\": \"ChatGPT Image Jul 5, 2026, 10_50_28 PM.png\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 07:51:06'),
(46, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0003 dari Diterima menjadi Diproses.', 'aduans', 5, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:07:07'),
(47, 1, 'update', 'bidang', 'Admin mengubah bidang: Bidang Sekretariat', 'bidangs', 1, '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": \"Bidang Sekretariat Lantai 1\", \"updated_at\": \"2026-07-06T05:43:54.000000Z\", \"nama_bidang\": \"Sekretariat\"}', '{\"id\": 1, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": \"Bidang Sekretariat Lantai 1\", \"updated_at\": \"2026-07-07T08:09:14.000000Z\", \"nama_bidang\": \"Bidang Sekretariat\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:09:14'),
(48, 1, 'update', 'bidang', 'Admin mengubah bidang: Bidang Penagihan', 'bidangs', 4, '{\"id\": 4, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-04T20:31:07.000000Z\", \"nama_bidang\": \"Bidang Akuntansi\"}', '{\"id\": 4, \"is_active\": 1, \"created_at\": \"2026-07-04T20:31:07.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-07T08:09:47.000000Z\", \"nama_bidang\": \"Bidang Penagihan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:09:47'),
(49, 1, 'create', 'bidang', 'Admin menambahkan bidang: Bidang Penetapan', 'bidangs', 8, NULL, '{\"id\": 8, \"is_active\": true, \"created_at\": \"2026-07-07T08:10:06.000000Z\", \"keterangan\": null, \"updated_at\": \"2026-07-07T08:10:06.000000Z\", \"nama_bidang\": \"Bidang Penetapan\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:10:06'),
(50, 2, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0004 dengan status diterima.', 'aduans', 6, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0004\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:14:13'),
(51, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:16:09'),
(52, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:16:41'),
(53, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0005 dengan status diterima.', 'aduans', 7, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0005\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:32:02'),
(54, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0006 dengan status diterima.', 'aduans', 8, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0006\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-07 08:41:27'),
(55, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0007 dengan status diterima.', 'aduans', 9, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0007\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 14:41:56'),
(56, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0007 dari Diterima menjadi Diproses.', 'aduans', 9, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 14:42:42'),
(57, 2, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0008 dengan status diterima.', 'aduans', 10, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0008\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 14:45:17'),
(58, 2, 'upload_attachment', 'aduan', 'User mengupload lampiran ChatGPT Image Jul 8, 2026, 10_13_29 PM.png pada aduan SIHATI-2026-0008.', 'aduan_attachments', 5, NULL, '{\"aduan_id\": 10, \"file_name\": \"ChatGPT Image Jul 8, 2026, 10_13_29 PM.png\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 14:45:18'),
(59, 1, 'create', 'user', 'Admin menambahkan pengguna: Dew', 'users', 3, NULL, '{\"id\": 3, \"name\": \"Dew\", \"role\": \"pegawai\", \"email\": \"dewe@sihati.local\", \"no_hp\": \"0987654567\", \"username\": \"dewe\", \"bidang_id\": \"2\", \"is_active\": true, \"created_at\": \"2026-07-10T02:21:48.000000Z\", \"updated_at\": \"2026-07-10T02:21:48.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:21:48'),
(60, 1, 'update', 'user', 'Admin mengubah pengguna: Dew', 'users', 3, '{\"id\": 3, \"name\": \"Dew\", \"role\": \"pegawai\", \"email\": \"dewe@sihati.local\", \"no_hp\": \"0987654567\", \"username\": \"dewe\", \"bidang_id\": 2, \"is_active\": true, \"created_at\": \"2026-07-10T02:21:48.000000Z\", \"updated_at\": \"2026-07-10T02:21:48.000000Z\"}', '{\"id\": 3, \"name\": \"Dew\", \"role\": \"pegawai\", \"email\": \"dewe@sihati.local\", \"no_hp\": \"0987654567\", \"username\": \"dieweputri\", \"bidang_id\": 2, \"is_active\": true, \"created_at\": \"2026-07-10T02:21:48.000000Z\", \"updated_at\": \"2026-07-10T02:37:26.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:37:26'),
(61, 1, 'delete', 'user', 'Admin menghapus pengguna: Dew', 'users', 3, '{\"id\": 3, \"name\": \"Dew\", \"role\": \"pegawai\", \"email\": \"dewe@sihati.local\", \"no_hp\": \"0987654567\", \"username\": \"dieweputri\", \"bidang_id\": 2, \"is_active\": true, \"created_at\": \"2026-07-10T02:21:48.000000Z\", \"updated_at\": \"2026-07-10T02:37:26.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:37:56'),
(62, 1, 'create', 'user', 'Admin menambahkan pengguna: Taufiq', 'users', 4, NULL, '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": \"7\", \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-10T02:58:08.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:58:08'),
(63, 1, 'update', 'user', 'Admin dinonaktifkan pengguna: Taufiq', 'users', 4, '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-10T02:58:08.000000Z\"}', '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": false, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-10T02:58:24.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:58:24'),
(64, 1, 'update', 'user', 'Admin diaktifkan pengguna: Taufiq', 'users', 4, '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": false, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-10T02:58:24.000000Z\"}', '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-10T02:58:29.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 02:58:29'),
(65, 1, 'update', 'user', 'Admin mengubah pengguna: Admin SIHATI', 'users', 1, '{\"id\": 1, \"name\": \"Admin SIHATI\", \"role\": \"admin\", \"email\": \"admin@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"admin\", \"bidang_id\": 1, \"is_active\": true, \"created_at\": \"2026-07-04T20:31:08.000000Z\", \"updated_at\": \"2026-07-04T20:31:08.000000Z\"}', '{\"id\": 1, \"name\": \"Admin SIHATI\", \"role\": \"admin\", \"email\": \"admin@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"admin\", \"bidang_id\": null, \"is_active\": true, \"created_at\": \"2026-07-04T20:31:08.000000Z\", \"updated_at\": \"2026-07-10T03:01:40.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 03:01:40'),
(66, 1, 'create', 'user', 'Admin menambahkan pengguna: asd', 'users', 5, NULL, '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": \"5\", \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:25.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 03:07:25'),
(67, 1, 'update', 'user', 'Admin dinonaktifkan pengguna: asd', 'users', 5, '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:25.000000Z\"}', '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": false, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:35.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 03:07:35'),
(68, 1, 'update', 'user', 'Admin diaktifkan pengguna: asd', 'users', 5, '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": false, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:35.000000Z\"}', '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:54.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 03:07:54'),
(69, 5, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0009 dengan status diterima.', 'aduans', 11, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0009\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:25:04'),
(70, 5, 'upload_attachment', 'aduan', 'User mengupload lampiran Group 91.png pada aduan SIHATI-2026-0009.', 'aduan_attachments', 6, NULL, '{\"aduan_id\": 11, \"file_name\": \"Group 91.png\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:25:05'),
(71, 1, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0009.', 'aduan_comments', 5, NULL, '{\"aduan_id\": 11, \"komentar\": \"Baik akan segera ditangani\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:26:13'),
(72, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0009 dari Diterima menjadi Diproses.', 'aduans', 11, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:27:17'),
(73, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0009 dari Diproses menjadi Selesai.', 'aduans', 11, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:27:58'),
(74, 1, 'add_note', 'aduan', 'Admin menambahkan catatan penanganan pada aduan SIHATI-2026-0009.', 'aduan_notes', 4, NULL, '{\"catatan\": \"Saran saya perbanyak bercerita. Kalau ada masalah jangan selalu dipendam sendiri agar tidak MELETUPP\", \"aduan_id\": 11}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:28:44'),
(75, 5, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0009.', 'aduan_comments', 6, NULL, '{\"aduan_id\": 11, \"komentar\": \"Oke\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:29:13'),
(76, 5, 'add_rating', 'aduan', 'Pegawai memberikan rating 5/5 pada aduan SIHATI-2026-0009.', 'ratings', 2, NULL, '{\"rating\": 5, \"aduan_id\": 11}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 07:30:25'),
(77, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:41:29'),
(78, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0010 dengan status diterima.', 'aduans', 12, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0010\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:46:13'),
(79, 4, 'upload_attachment', 'aduan', 'User mengupload lampiran WhatsApp Image 2026-07-05 at 22.35.28 (2).jpeg pada aduan SIHATI-2026-0010.', 'aduan_attachments', 7, NULL, '{\"aduan_id\": 12, \"file_name\": \"WhatsApp Image 2026-07-05 at 22.35.28 (2).jpeg\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:46:15'),
(80, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0010 dari Diterima menjadi Diproses.', 'aduans', 12, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:49:57'),
(81, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0010 dari Diproses menjadi Selesai.', 'aduans', 12, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:53:53'),
(82, 1, 'add_note', 'aduan', 'Admin menambahkan catatan penanganan pada aduan SIHATI-2026-0010.', 'aduan_notes', 5, NULL, '{\"catatan\": \"Kerusakan disebabkan karena blablablbala. Saran apabila menggunakan harus ngenengene\", \"aduan_id\": 12}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:54:20'),
(83, 1, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0010.', 'aduan_comments', 7, NULL, '{\"aduan_id\": 12, \"komentar\": \"Done\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:54:32'),
(84, 4, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0010.', 'aduan_comments', 8, NULL, '{\"aduan_id\": 12, \"komentar\": \"oke\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:55:00'),
(85, 4, 'add_rating', 'aduan', 'Pegawai memberikan rating 5/5 pada aduan SIHATI-2026-0010.', 'ratings', 3, NULL, '{\"rating\": 5, \"aduan_id\": 12}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 07:55:18'),
(86, 1, 'create', 'user', 'Admin menambahkan pengguna: Tes', 'users', 6, NULL, '{\"id\": 6, \"name\": \"Tes\", \"role\": \"pegawai\", \"email\": \"tes@sihati.local\", \"no_hp\": \"123123123123\", \"username\": \"testes\", \"bidang_id\": \"8\", \"is_active\": true, \"created_at\": \"2026-07-11T15:06:22.000000Z\", \"updated_at\": \"2026-07-11T15:06:22.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:06:22'),
(87, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:07:34'),
(88, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:07:58'),
(89, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:08:11'),
(90, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:08:42'),
(91, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:18:04'),
(92, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:18:11'),
(93, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:18:32'),
(94, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:18:55'),
(95, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:19:17'),
(96, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:21:47'),
(97, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:22:02'),
(98, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:24:22'),
(99, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:30:29'),
(100, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:30:35'),
(101, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:30:51'),
(102, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:31:14'),
(103, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0008 dari Diterima menjadi Diproses.', 'aduans', 10, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:46:34'),
(104, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0011 dengan status diterima.', 'aduans', 13, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0011\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:47:34'),
(105, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0011 dari Diterima menjadi Diproses.', 'aduans', 13, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:48:11'),
(106, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0012 dengan status diterima.', 'aduans', 14, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0012\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:56:20'),
(107, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0012 dari Diterima menjadi Diproses.', 'aduans', 14, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 15:57:02'),
(108, 1, 'update', 'user', 'Admin diaktifkan pengguna: Taufiq', 'users', 4, '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": false, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-13T01:06:10.000000Z\"}', '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-13T01:13:45.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:13:45'),
(109, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0013 dengan status diterima.', 'aduans', 15, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0013\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:14:56'),
(110, 1, 'update', 'user', 'Admin mengubah pengguna: Taufiq', 'users', 4, '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-13T01:13:45.000000Z\"}', '{\"id\": 4, \"name\": \"Taufiq\", \"role\": \"pegawai\", \"email\": \"tpq@sihati.local\", \"no_hp\": \"1234321234321\", \"username\": \"topeq\", \"bidang_id\": 7, \"is_active\": true, \"created_at\": \"2026-07-10T02:58:08.000000Z\", \"updated_at\": \"2026-07-13T01:24:28.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:24:28'),
(111, 1, 'update', 'user', 'Admin mengubah pengguna: asd', 'users', 5, '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-10T03:07:54.000000Z\"}', '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-13T01:24:43.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:24:43'),
(112, 1, 'update', 'user', 'Admin mengubah pengguna: Tes', 'users', 6, '{\"id\": 6, \"name\": \"Tes\", \"role\": \"pegawai\", \"email\": \"tes@sihati.local\", \"no_hp\": \"123123123123\", \"username\": \"testes\", \"bidang_id\": 8, \"is_active\": true, \"created_at\": \"2026-07-11T15:06:22.000000Z\", \"updated_at\": \"2026-07-11T15:06:22.000000Z\"}', '{\"id\": 6, \"name\": \"Tes\", \"role\": \"pegawai\", \"email\": \"tes@sihati.local\", \"no_hp\": \"123123123123\", \"username\": \"testes\", \"bidang_id\": 8, \"is_active\": true, \"created_at\": \"2026-07-11T15:06:22.000000Z\", \"updated_at\": \"2026-07-13T01:26:03.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:26:03'),
(113, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0013 dari Diterima menjadi Diproses.', 'aduans', 15, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:28:13'),
(114, 1, 'update', 'user', 'Admin mengubah pengguna: Zaki', 'users', 5, '{\"id\": 5, \"name\": \"asd\", \"role\": \"pegawai\", \"email\": \"asd@asd.asd\", \"no_hp\": \"123455432112345\", \"username\": \"asd\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-13T01:24:43.000000Z\"}', '{\"id\": 5, \"name\": \"Zaki\", \"role\": \"pegawai\", \"email\": \"zaki@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"zaki\", \"bidang_id\": 5, \"is_active\": true, \"created_at\": \"2026-07-10T03:07:25.000000Z\", \"updated_at\": \"2026-07-13T01:48:41.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:48:41'),
(115, 1, 'update', 'user', 'Admin mengubah pengguna: Dewa', 'users', 6, '{\"id\": 6, \"name\": \"Tes\", \"role\": \"pegawai\", \"email\": \"tes@sihati.local\", \"no_hp\": \"123123123123\", \"username\": \"testes\", \"bidang_id\": 8, \"is_active\": true, \"created_at\": \"2026-07-11T15:06:22.000000Z\", \"updated_at\": \"2026-07-13T01:26:03.000000Z\"}', '{\"id\": 6, \"name\": \"Dewa\", \"role\": \"pegawai\", \"email\": \"dewa@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"dewa\", \"bidang_id\": 8, \"is_active\": true, \"created_at\": \"2026-07-11T15:06:22.000000Z\", \"updated_at\": \"2026-07-13T01:49:22.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:49:22'),
(116, 1, 'create', 'user', 'Admin menambahkan pengguna: Nopal', 'users', 7, NULL, '{\"id\": 7, \"name\": \"Nopal\", \"role\": \"pegawai\", \"email\": \"nopal@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"nopal\", \"bidang_id\": \"2\", \"is_active\": true, \"created_at\": \"2026-07-13T01:50:16.000000Z\", \"updated_at\": \"2026-07-13T01:50:16.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:50:16');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(117, 1, 'create', 'user', 'Admin menambahkan pengguna: Pegawai', 'users', 8, NULL, '{\"id\": 8, \"name\": \"Pegawai\", \"role\": \"pegawai\", \"email\": \"pegawai@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"pegawai\", \"bidang_id\": \"4\", \"is_active\": true, \"created_at\": \"2026-07-13T01:51:27.000000Z\", \"updated_at\": \"2026-07-13T01:51:27.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:51:27'),
(118, 1, 'create', 'user', 'Admin menambahkan pengguna: Pegawai2', 'users', 9, NULL, '{\"id\": 9, \"name\": \"Pegawai2\", \"role\": \"pegawai\", \"email\": \"pegawai2@sihati.local\", \"no_hp\": \"081234567890\", \"username\": \"pegawai2\", \"bidang_id\": \"3\", \"is_active\": true, \"created_at\": \"2026-07-13T01:52:21.000000Z\", \"updated_at\": \"2026-07-13T01:52:21.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 01:52:21'),
(119, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0013 dari Diproses menjadi Selesai.', 'aduans', 15, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 04:18:41'),
(120, 4, 'add_rating', 'aduan', 'Pegawai memberikan rating 5/5 pada aduan SIHATI-2026-0013.', 'ratings', 4, NULL, '{\"rating\": 5, \"aduan_id\": 15}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 04:19:18'),
(121, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0014 dengan status diterima.', 'aduans', 16, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0014\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 05:41:22'),
(122, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0014 dari Diterima menjadi Diproses.', 'aduans', 16, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 05:49:08'),
(123, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0014 dari Diproses menjadi Selesai.', 'aduans', 16, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 05:50:27'),
(124, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0015 dengan status diterima.', 'aduans', 17, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0015\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:01:31'),
(125, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0015 dari Diterima menjadi Diproses.', 'aduans', 17, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:02:20'),
(126, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0015 dari Diproses menjadi Selesai.', 'aduans', 17, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:03:13'),
(127, 4, 'add_rating', 'aduan', 'Pegawai memberikan rating 3/5 pada aduan SIHATI-2026-0015.', 'ratings', 5, NULL, '{\"rating\": 3, \"aduan_id\": 17}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:04:07'),
(128, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0016 dengan status diterima.', 'aduans', 18, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0016\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:05:01'),
(129, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0016 dari Diterima menjadi Diproses.', 'aduans', 18, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:07:20'),
(130, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0016 dari Diproses menjadi Selesai.', 'aduans', 18, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:07:28'),
(131, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0017 dengan status diterima.', 'aduans', 19, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0017\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:25:23'),
(132, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0017 dari Diterima menjadi Diproses.', 'aduans', 19, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:25:58'),
(133, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0017 dari Diproses menjadi Selesai.', 'aduans', 19, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 08:26:08'),
(134, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0018 dengan status diterima.', 'aduans', 20, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0018\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:03:34'),
(135, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0018 dari Diterima menjadi Diproses.', 'aduans', 20, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:05:35'),
(136, 1, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0018.', 'aduan_comments', 9, NULL, '{\"aduan_id\": 20, \"komentar\": \"Halo\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:06:31'),
(137, 4, 'add_comment', 'aduan', 'User menambahkan komentar pada aduan SIHATI-2026-0018.', 'aduan_comments', 10, NULL, '{\"aduan_id\": 20, \"komentar\": \"Halo kink\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:06:54'),
(138, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0018 dari Diproses menjadi Selesai.', 'aduans', 20, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:07:27'),
(139, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0019 dengan status diterima.', 'aduans', 21, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0019\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:08:26'),
(140, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0019 dari Diterima menjadi Diproses.', 'aduans', 21, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:09:05'),
(141, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0019 dari Diproses menjadi Selesai.', 'aduans', 21, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:09:23'),
(142, 4, 'add_rating', 'aduan', 'Pegawai memberikan rating 3/5 pada aduan SIHATI-2026-0019.', 'ratings', 6, NULL, '{\"rating\": 3, \"aduan_id\": 21}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:10:14'),
(143, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0011 dari Diproses menjadi Selesai.', 'aduans', 13, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:29:29'),
(144, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0012 dari Diproses menjadi Selesai.', 'aduans', 14, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:47:33'),
(145, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0020 dengan status diterima.', 'aduans', 22, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0020\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 01:49:02'),
(146, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0020 dari Diterima menjadi Diproses.', 'aduans', 22, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:01:07'),
(147, 4, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0021 dengan status diterima.', 'aduans', 23, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0021\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:01:36'),
(148, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0021 dari Diterima menjadi Diproses.', 'aduans', 23, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:10:40'),
(149, 1, 'create_aduan', 'aduan', 'Pegawai membuat aduan SIHATI-2026-0022 dengan status diterima.', 'aduans', 24, NULL, '{\"status\": \"diterima\", \"nomor_tiket\": \"SIHATI-2026-0022\"}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:45:57'),
(150, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0022 dari Diterima menjadi Diproses.', 'aduans', 24, '{\"status\": \"diterima\", \"status_id\": 1}', '{\"status\": \"diproses\", \"status_id\": 2}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:46:13'),
(151, 1, 'update_status', 'aduan', 'Admin mengubah status aduan SIHATI-2026-0022 dari Diproses menjadi Selesai.', 'aduans', 24, '{\"status\": \"diproses\", \"status_id\": 2}', '{\"status\": \"selesai\", \"status_id\": 3}', '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 02:47:14'),
(152, 1, 'print_laporan', 'laporan', 'Admin mencetak laporan aduan.', 'aduans', NULL, NULL, NULL, '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 06:38:43');

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

--
-- Dumping data for table `aduans`
--

INSERT INTO `aduans` (`id`, `nomor_tiket`, `pelapor_id`, `petugas_id`, `bidang_id`, `category_id`, `priority_id`, `status_id`, `judul`, `deskripsi`, `lokasi`, `no_kontak`, `tanggal_aduan`, `tanggal_diterima`, `tanggal_diproses`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 'SIHATI-2026-0000', 1, NULL, 5, 4, 4, 2, 'Naufal Bermasalah', 'Naufal perlu cewek', 'Ruang Pendataan', '081234567890', '2026-07-05 17:53:17', '2026-07-05 17:53:17', '2026-07-06 01:12:30', NULL, '2026-07-05 17:53:17', '2026-07-06 01:12:30'),
(2, 'SIHATI-2026-0001', 1, NULL, 1, 5, 2, 1, 'Coba', 'Coba', 'R. Sekretariat', '087654321098', '2026-07-06 01:02:36', '2026-07-06 01:02:36', NULL, NULL, '2026-07-06 01:02:36', '2026-07-06 01:02:36'),
(4, 'SIHATI-2026-0002', 2, NULL, 2, 3, 2, 3, 'Jaringan Lemot', 'Jaringan di Ruang Penagihan Lemot banget, saya mau download GTA 5 ga selesai-selesai', 'Ruang Penagihan', '089999999999', '2026-07-07 00:27:31', '2026-07-07 00:27:32', '2026-07-07 00:29:37', '2026-07-07 00:31:33', '2026-07-07 00:27:31', '2026-07-07 00:31:33'),
(5, 'SIHATI-2026-0003', 1, NULL, 2, 3, 2, 2, 'Yamaha: Lebih dari Sekadar Mesin, Sebuah Filosofi Gerakan', 'teset', 'Ruang Pendataan', '12345678765', '2026-07-07 07:51:05', '2026-07-07 07:51:05', '2026-07-07 08:07:07', NULL, '2026-07-07 07:51:05', '2026-07-07 08:07:07'),
(6, 'SIHATI-2026-0004', 2, NULL, 1, 1, 1, 1, 'Ducati: Perpaduan Gairah Italia, Desain Ikonik, dan Performa Memukau', 'f', 'R. Sekretariat', '123456765432', '2026-07-07 08:14:13', '2026-07-07 08:14:13', NULL, NULL, '2026-07-07 08:14:13', '2026-07-07 08:14:13'),
(7, 'SIHATI-2026-0005', 1, NULL, 2, 3, 1, 1, 'Ducati: Perpaduan Gairah Italia, Desain Ikonik, dan Performa Memukau', 'zdbz', 'Ruang Pendataan', '081234567890', '2026-07-07 08:32:02', '2026-07-07 08:32:02', NULL, NULL, '2026-07-07 08:32:02', '2026-07-07 08:32:02'),
(8, 'SIHATI-2026-0006', 1, NULL, 1, 1, 3, 1, 'wrvin', 'asdfghjkl;lkjhgfdesaASDFGHJKLLKJHGFDSASDFGHJFDSDGHDSERTYHBCSSEPAOSRJZMVKDWuibjkdoe', 'asc', '123456789098765', '2026-07-07 08:41:27', '2026-07-07 08:41:27', NULL, NULL, '2026-07-07 08:41:27', '2026-07-07 08:41:27'),
(9, 'SIHATI-2026-0007', 1, NULL, 1, 3, 3, 2, 'Honda NSX Type S: Ode Terakhir untuk Legenda Hybrid Performa Tinggi', 'asdf', 'asdf', '23456776543235', '2026-07-09 14:41:56', '2026-07-09 14:41:56', '2026-07-09 14:42:42', NULL, '2026-07-09 14:41:56', '2026-07-09 14:42:42'),
(10, 'SIHATI-2026-0008', 2, NULL, 1, 6, 3, 2, 'coba coba', 'asdf', 'asdf', '1231234123', '2026-07-09 14:45:17', '2026-07-09 14:45:17', '2026-07-11 15:46:34', NULL, '2026-07-09 14:45:17', '2026-07-11 15:46:34'),
(11, 'SIHATI-2026-0009', 5, NULL, 5, 5, 3, 3, 'Bismillah', 'Mental bermasalah', 'Ruang Aset Lt. 999', '09876543212345', '2026-07-10 07:25:04', '2026-07-10 07:25:04', '2026-07-10 07:27:17', '2026-07-10 07:27:58', '2026-07-10 07:25:04', '2026-07-10 07:27:58'),
(12, 'SIHATI-2026-0010', 4, NULL, 7, 3, 3, 3, 'Jaringan Lemot', 'ejbviwebfwr', 'Ruang Pendataan', '23456543223', '2026-07-11 07:46:13', '2026-07-11 07:46:13', '2026-07-11 07:49:57', '2026-07-11 07:53:53', '2026-07-11 07:46:13', '2026-07-11 07:53:53'),
(13, 'SIHATI-2026-0011', 4, NULL, 7, 1, 2, 3, 'lkm', 'lkm', 'lkm', '098098098098', '2026-07-11 15:47:34', '2026-07-11 15:47:34', '2026-07-11 15:48:11', '2026-07-16 01:29:29', '2026-07-11 15:47:34', '2026-07-16 01:29:29'),
(14, 'SIHATI-2026-0012', 4, NULL, 7, 4, 4, 3, 'kkk', 'kkk', 'jjj', '0987890987', '2026-07-11 15:56:20', '2026-07-11 15:56:20', '2026-07-11 15:57:02', '2026-07-16 01:47:33', '2026-07-11 15:56:20', '2026-07-16 01:47:33'),
(15, 'SIHATI-2026-0013', 4, NULL, 7, 5, 2, 3, 'halo', 'TESTESTESTES', 'Ruang Pendataan', '089503596746', '2026-07-13 01:14:56', '2026-07-13 01:14:56', '2026-07-13 01:28:13', '2026-07-13 04:18:41', '2026-07-13 01:14:56', '2026-07-13 04:18:41'),
(16, 'SIHATI-2026-0014', 1, NULL, 7, 6, 2, 3, 'Rusak', 'Ada yang rusak', 'Ruang Pendataan', '081234567890', '2026-07-13 05:41:22', '2026-07-13 05:41:22', '2026-07-13 05:49:08', '2026-07-13 05:50:27', '2026-07-13 05:41:22', '2026-07-13 05:50:27'),
(17, 'SIHATI-2026-0015', 4, NULL, 7, 7, 1, 3, 'TES', 'TES', 'RUANG PENDATAAN', '081234567890', '2026-07-13 08:01:31', '2026-07-13 08:01:31', '2026-07-13 08:02:20', '2026-07-13 08:03:13', '2026-07-13 08:01:31', '2026-07-13 08:03:13'),
(18, 'SIHATI-2026-0016', 1, NULL, 7, 4, 4, 3, 'ODNICONQQJIN', 'KSVJ SDIJNAOC', 'OINVOWDN', '081234567890', '2026-07-13 08:05:01', '2026-07-13 08:05:01', '2026-07-13 08:07:20', '2026-07-13 08:07:28', '2026-07-13 08:05:01', '2026-07-13 08:07:28'),
(19, 'SIHATI-2026-0017', 1, NULL, 7, 6, 3, 3, 'NYOBA', 'SODJCNO', 'PDPEOJD', '081234567890', '2026-07-13 08:25:23', '2026-07-13 08:25:23', '2026-07-13 08:25:58', '2026-07-13 08:26:08', '2026-07-13 08:25:23', '2026-07-13 08:26:08'),
(20, 'SIHATI-2026-0018', 4, NULL, 7, 7, 1, 3, 'sdasda', 'Testes', 'Disini', '081234567890', '2026-07-16 01:03:34', '2026-07-16 01:03:34', '2026-07-16 01:05:35', '2026-07-16 01:07:27', '2026-07-16 01:03:34', '2026-07-16 01:07:27'),
(21, 'SIHATI-2026-0019', 4, NULL, 7, 3, 3, 3, 'odinc', 'josdis', 'oidamo', '081234567890', '2026-07-16 01:08:26', '2026-07-16 01:08:26', '2026-07-16 01:09:05', '2026-07-16 01:09:23', '2026-07-16 01:08:26', '2026-07-16 01:09:23'),
(22, 'SIHATI-2026-0020', 4, NULL, 7, 1, 2, 2, 'tes', 'odo', 'odo', '092010920910', '2026-07-16 01:49:02', '2026-07-16 01:49:02', '2026-07-16 02:01:07', NULL, '2026-07-16 01:49:02', '2026-07-16 02:01:07'),
(23, 'SIHATI-2026-0021', 4, NULL, 7, 1, 4, 2, 'neh', 'neh', 'neh', '0987t89876789', '2026-07-16 02:01:36', '2026-07-16 02:01:36', '2026-07-16 02:10:40', NULL, '2026-07-16 02:01:36', '2026-07-16 02:10:40'),
(24, 'SIHATI-2026-0022', 1, NULL, 7, 5, 2, 3, 'tests', '1234567901', 'Ruang Pendataan', '0814567890', '2026-07-16 02:45:57', '2026-07-16 02:45:57', '2026-07-16 02:46:13', '2026-07-16 02:47:14', '2026-07-16 02:45:57', '2026-07-16 02:47:14');

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

--
-- Dumping data for table `aduan_attachments`
--

INSERT INTO `aduan_attachments` (`id`, `aduan_id`, `uploaded_by`, `file_name`, `file_path`, `file_type`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Laporan Aduan - SIHATI BPPKAD.pdf', 'aduan/1783299756_6a4afeac4bc24.pdf', 'application/pdf', 65003, '2026-07-06 01:02:37', '2026-07-06 01:02:37'),
(2, 1, 1, 'ChatGPT Image Jul 5, 2026, 10_50_28 PM.png', 'aduan/1783300364_6a4b010c0dfa0.png', 'image/png', 1708969, '2026-07-06 01:12:44', '2026-07-06 01:12:44'),
(4, 5, 1, 'ChatGPT Image Jul 5, 2026, 10_50_28 PM.png', 'aduan/1783410665_6a4cafe948062.png', 'image/png', 1708969, '2026-07-07 07:51:06', '2026-07-07 07:51:06'),
(5, 10, 2, 'ChatGPT Image Jul 8, 2026, 10_13_29 PM.png', 'aduan/1783608317_6a4fb3fd749a2.png', 'image/png', 1264077, '2026-07-09 14:45:18', '2026-07-09 14:45:18'),
(6, 11, 5, 'Group 91.png', 'aduan/1783668304_6a509e50ab2d7.png', 'image/png', 45259, '2026-07-10 07:25:05', '2026-07-10 07:25:05'),
(7, 12, 4, 'WhatsApp Image 2026-07-05 at 22.35.28 (2).jpeg', 'aduan/1783755973_6a51f4c5e9363.jpeg', 'image/jpeg', 93908, '2026-07-11 07:46:15', '2026-07-11 07:46:15');

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

--
-- Dumping data for table `aduan_comments`
--

INSERT INTO `aduan_comments` (`id`, `aduan_id`, `user_id`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Kemungkinan karena terlalu lama sendiri', '2026-07-06 01:00:33', '2026-07-06 01:00:33'),
(2, 4, 2, 'Tolong segera diperbaiki yh, saya mau main GTA 5', '2026-07-07 00:28:06', '2026-07-07 00:28:06'),
(3, 4, 1, 'Baik akan segera diperbaiki', '2026-07-07 00:29:10', '2026-07-07 00:29:10'),
(4, 4, 2, 'Oke terimakasih', '2026-07-07 00:51:39', '2026-07-07 00:51:39'),
(5, 11, 1, 'Baik akan segera ditangani', '2026-07-10 07:26:13', '2026-07-10 07:26:13'),
(6, 11, 5, 'Oke', '2026-07-10 07:29:13', '2026-07-10 07:29:13'),
(7, 12, 1, 'Done', '2026-07-11 07:54:32', '2026-07-11 07:54:32'),
(8, 12, 4, 'oke', '2026-07-11 07:55:00', '2026-07-11 07:55:00'),
(9, 20, 1, 'Halo', '2026-07-16 01:06:31', '2026-07-16 01:06:31'),
(10, 20, 4, 'Halo kink', '2026-07-16 01:06:54', '2026-07-16 01:06:54');

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

--
-- Dumping data for table `aduan_notes`
--

INSERT INTO `aduan_notes` (`id`, `aduan_id`, `petugas_id`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Akan segera ditangani', '2026-07-06 01:00:01', '2026-07-06 01:00:01'),
(2, 4, 1, 'Wifi lemot disebabkan karena Anda sendiri ngapain download GTA 5', '2026-07-07 00:30:33', '2026-07-07 00:30:33'),
(3, 4, 1, 'Router sudah direset, lain kali klo mau download GTA V jangan pake jaringan kantor', '2026-07-07 00:32:24', '2026-07-07 00:32:24'),
(4, 11, 1, 'Saran saya perbanyak bercerita. Kalau ada masalah jangan selalu dipendam sendiri agar tidak MELETUPP!', '2026-07-10 07:28:44', '2026-07-10 07:28:44'),
(5, 12, 1, 'Kerusakan disebabkan karena blablablbala. Saran apabila menggunakan harus ngenengene', '2026-07-11 07:54:20', '2026-07-11 07:54:20');

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

--
-- Dumping data for table `aduan_status_histories`
--

INSERT INTO `aduan_status_histories` (`id`, `aduan_id`, `status_sebelumnya_id`, `status_baru_id`, `changed_by`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-05 17:53:17', '2026-07-05 17:53:17'),
(2, 2, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-06 01:02:36', '2026-07-06 01:02:36'),
(3, 1, 1, 2, 1, NULL, '2026-07-06 01:12:30', '2026-07-06 01:12:30'),
(7, 4, NULL, 1, 2, 'Aduan dibuat dengan status diterima', '2026-07-07 00:27:32', '2026-07-07 00:27:32'),
(8, 4, 1, 2, 1, NULL, '2026-07-07 00:29:37', '2026-07-07 00:29:37'),
(9, 4, 2, 3, 1, 'Selesai diperbaiki', '2026-07-07 00:31:33', '2026-07-07 00:31:33'),
(10, 5, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-07 07:51:05', '2026-07-07 07:51:05'),
(11, 5, 1, 2, 1, 'sabar', '2026-07-07 08:07:07', '2026-07-07 08:07:07'),
(12, 6, NULL, 1, 2, 'Aduan dibuat dengan status diterima', '2026-07-07 08:14:13', '2026-07-07 08:14:13'),
(13, 7, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-07 08:32:02', '2026-07-07 08:32:02'),
(14, 8, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-07 08:41:27', '2026-07-07 08:41:27'),
(15, 9, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-09 14:41:56', '2026-07-09 14:41:56'),
(16, 9, 1, 2, 1, NULL, '2026-07-09 14:42:42', '2026-07-09 14:42:42'),
(17, 10, NULL, 1, 2, 'Aduan dibuat dengan status diterima', '2026-07-09 14:45:17', '2026-07-09 14:45:17'),
(18, 11, NULL, 1, 5, 'Aduan dibuat dengan status diterima', '2026-07-10 07:25:04', '2026-07-10 07:25:04'),
(19, 11, 1, 2, 1, 'Aduan sedang diproses', '2026-07-10 07:27:17', '2026-07-10 07:27:17'),
(20, 11, 2, 3, 1, 'Aduan telah selesai ditangani', '2026-07-10 07:27:58', '2026-07-10 07:27:58'),
(21, 12, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-11 07:46:13', '2026-07-11 07:46:13'),
(22, 12, 1, 2, 1, 'Petugas akan segera memeriksa ke lokasi', '2026-07-11 07:49:57', '2026-07-11 07:49:57'),
(23, 12, 2, 3, 1, 'Printer sudah selesai ditangani', '2026-07-11 07:53:53', '2026-07-11 07:53:53'),
(24, 10, 1, 2, 1, NULL, '2026-07-11 15:46:34', '2026-07-11 15:46:34'),
(25, 13, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-11 15:47:34', '2026-07-11 15:47:34'),
(26, 13, 1, 2, 1, NULL, '2026-07-11 15:48:11', '2026-07-11 15:48:11'),
(27, 14, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-11 15:56:20', '2026-07-11 15:56:20'),
(28, 14, 1, 2, 1, NULL, '2026-07-11 15:57:02', '2026-07-11 15:57:02'),
(29, 15, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-13 01:14:56', '2026-07-13 01:14:56'),
(30, 15, 1, 2, 1, NULL, '2026-07-13 01:28:13', '2026-07-13 01:28:13'),
(31, 15, 2, 3, 1, NULL, '2026-07-13 04:18:41', '2026-07-13 04:18:41'),
(32, 16, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-13 05:41:22', '2026-07-13 05:41:22'),
(33, 16, 1, 2, 1, NULL, '2026-07-13 05:49:08', '2026-07-13 05:49:08'),
(34, 16, 2, 3, 1, NULL, '2026-07-13 05:50:27', '2026-07-13 05:50:27'),
(35, 17, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-13 08:01:31', '2026-07-13 08:01:31'),
(36, 17, 1, 2, 1, NULL, '2026-07-13 08:02:20', '2026-07-13 08:02:20'),
(37, 17, 2, 3, 1, NULL, '2026-07-13 08:03:13', '2026-07-13 08:03:13'),
(38, 18, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-13 08:05:01', '2026-07-13 08:05:01'),
(39, 18, 1, 2, 1, NULL, '2026-07-13 08:07:20', '2026-07-13 08:07:20'),
(40, 18, 2, 3, 1, NULL, '2026-07-13 08:07:28', '2026-07-13 08:07:28'),
(41, 19, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-13 08:25:23', '2026-07-13 08:25:23'),
(42, 19, 1, 2, 1, NULL, '2026-07-13 08:25:58', '2026-07-13 08:25:58'),
(43, 19, 2, 3, 1, NULL, '2026-07-13 08:26:08', '2026-07-13 08:26:08'),
(44, 20, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-16 01:03:34', '2026-07-16 01:03:34'),
(45, 20, 1, 2, 1, 'Aduan diproses', '2026-07-16 01:05:35', '2026-07-16 01:05:35'),
(46, 20, 2, 3, 1, NULL, '2026-07-16 01:07:27', '2026-07-16 01:07:27'),
(47, 21, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-16 01:08:26', '2026-07-16 01:08:26'),
(48, 21, 1, 2, 1, NULL, '2026-07-16 01:09:05', '2026-07-16 01:09:05'),
(49, 21, 2, 3, 1, NULL, '2026-07-16 01:09:23', '2026-07-16 01:09:23'),
(50, 13, 2, 3, 1, NULL, '2026-07-16 01:29:29', '2026-07-16 01:29:29'),
(51, 14, 2, 3, 1, 'Selesai done!', '2026-07-16 01:47:33', '2026-07-16 01:47:33'),
(52, 22, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-16 01:49:02', '2026-07-16 01:49:02'),
(53, 22, 1, 2, 1, NULL, '2026-07-16 02:01:07', '2026-07-16 02:01:07'),
(54, 23, NULL, 1, 4, 'Aduan dibuat dengan status diterima', '2026-07-16 02:01:36', '2026-07-16 02:01:36'),
(55, 23, 1, 2, 1, NULL, '2026-07-16 02:10:40', '2026-07-16 02:10:40'),
(56, 24, NULL, 1, 1, 'Aduan dibuat dengan status diterima', '2026-07-16 02:45:57', '2026-07-16 02:45:57'),
(57, 24, 1, 2, 1, NULL, '2026-07-16 02:46:13', '2026-07-16 02:46:13'),
(58, 24, 2, 3, 1, NULL, '2026-07-16 02:47:14', '2026-07-16 02:47:14');

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
(1, 'Bidang Sekretariat', 'Bidang Sekretariat Lantai 1', 1, '2026-07-04 20:31:07', '2026-07-07 08:09:14'),
(2, 'Bidang Anggaran', 'Bidang Anggaran', 1, '2026-07-04 20:31:07', '2026-07-06 04:11:21'),
(3, 'Bidang Perbendaharaan', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(4, 'Bidang Penagihan', NULL, 1, '2026-07-04 20:31:07', '2026-07-07 08:09:47'),
(5, 'Bidang Aset', NULL, 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(7, 'Bidang Pendataan', 'Bidang Pendataan Lantai 2', 1, '2026-07-06 06:28:10', '2026-07-07 04:06:10'),
(8, 'Bidang Penetapan', NULL, 1, '2026-07-07 08:10:06', '2026-07-07 08:10:06');

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
('laravel-cache-pegawaiit|127.0.0.1', 'i:1;', 1783305540),
('laravel-cache-pegawaiit|127.0.0.1:timer', 'i:1783305540;', 1783305540),
('laravel-cache-topeq@sihati.local|127.0.0.1', 'i:2;', 1783907650),
('laravel-cache-topeq@sihati.local|127.0.0.1:timer', 'i:1783907650;', 1783907650),
('laravel-cache-topeq|10.15.12.9', 'i:2;', 1784100996),
('laravel-cache-topeq|10.15.12.9:timer', 'i:1784100996;', 1784100996);

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
(1, 'Komputer/Laptop', 'Masalah komputer, laptop, lambat, error, atau tidak menyala.', 1, '2026-07-04 20:31:07', '2026-07-07 04:09:48'),
(2, 'Printer/Scanner', 'Masalah printer, scanner, tinta, kertas macet, atau gagal cetak.', 1, '2026-07-04 20:31:07', '2026-07-06 04:12:19'),
(3, 'Jaringan Internet', 'Masalah WiFi, LAN, koneksi internet lambat atau terputus.', 1, '2026-07-04 20:31:07', '2026-07-06 05:48:19'),
(4, 'Aplikasi/Sistem', 'Masalah aplikasi internal atau sistem kerja', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(5, 'Akun/Login', 'Masalah lupa password, akun terkunci, atau gagal login', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(6, 'Email', 'Masalah email masuk, email keluar, atau konfigurasi email', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07'),
(7, 'Perangkat Pendukung', 'Masalah monitor, proyektor, kabel, UPS, dan perangkat lain', 1, '2026-07-04 20:31:07', '2026-07-04 20:31:07');

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
(17, '2026_07_03_100000_add_user_columns_to_users_table', 1),
(18, '2026_07_09_103435_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `description`, `url`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(5, 5, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0009 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/11', 1, '2026-07-10 07:27:34', '2026-07-10 07:27:17', '2026-07-10 07:27:34'),
(6, 5, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0009 berubah menjadi Selesai.', 'http://127.0.0.1:8000/pegawai/aduan/11', 1, '2026-07-10 07:28:56', '2026-07-10 07:27:58', '2026-07-10 07:28:56'),
(8, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0010 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/12', 1, '2026-07-11 15:57:35', '2026-07-11 07:49:57', '2026-07-11 15:57:35'),
(9, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0010 berubah menjadi Selesai.', 'http://127.0.0.1:8000/pegawai/aduan/12', 1, '2026-07-11 07:54:49', '2026-07-11 07:53:53', '2026-07-11 07:54:49'),
(10, 2, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0008 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/10', 1, '2026-07-15 14:23:46', '2026-07-11 15:46:34', '2026-07-15 14:23:46'),
(12, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0011 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/13', 1, '2026-07-11 15:57:35', '2026-07-11 15:48:11', '2026-07-11 15:57:35'),
(14, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0012 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/14', 1, '2026-07-11 15:57:35', '2026-07-11 15:57:02', '2026-07-11 15:57:35'),
(16, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0013 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/15', 1, '2026-07-13 02:13:21', '2026-07-13 01:28:13', '2026-07-13 02:13:21'),
(17, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0013 berubah menjadi Selesai.', 'http://127.0.0.1:8000/pegawai/aduan/15', 1, '2026-07-13 04:19:09', '2026-07-13 04:18:41', '2026-07-13 04:19:09'),
(22, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0015 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/17', 1, '2026-07-13 08:02:44', '2026-07-13 08:02:20', '2026-07-13 08:02:44'),
(23, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0015 berubah menjadi Selesai.', 'http://127.0.0.1:8000/pegawai/aduan/17', 1, '2026-07-13 08:03:30', '2026-07-13 08:03:13', '2026-07-13 08:03:30'),
(25, 4, 'new', 'Aduan Baru: SIHATI-2026-0016', 'Admin membuat aduan untuk bidang Bidang Pendataan.', 'http://127.0.0.1:8000/pegawai/aduan/18', 1, '2026-07-13 08:05:41', '2026-07-13 08:05:01', '2026-07-13 08:05:41'),
(26, 1, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0016 berubah menjadi Diproses.', 'http://127.0.0.1:8000/pegawai/aduan/18', 1, '2026-07-13 08:07:40', '2026-07-13 08:07:20', '2026-07-13 08:07:40'),
(27, 1, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0016 berubah menjadi Selesai.', 'http://127.0.0.1:8000/pegawai/aduan/18', 1, '2026-07-13 08:07:40', '2026-07-13 08:07:28', '2026-07-13 08:07:40'),
(29, 4, 'new', 'Aduan Baru: SIHATI-2026-0017', 'Admin membuat aduan untuk Bidang Pendataan.', 'http://127.0.0.1:8000/pegawai/aduan/19', 1, '2026-07-13 08:25:34', '2026-07-13 08:25:23', '2026-07-13 08:25:34'),
(34, 1, 'new', 'Aduan Baru Masuk', 'Aduan SIHATI-2026-0018 baru saja dibuat.', 'http://10.15.12.9:8000/admin/aduan/20', 1, '2026-07-16 01:04:54', '2026-07-16 01:03:34', '2026-07-16 01:04:54'),
(35, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0018 berubah menjadi Diproses.', 'http://10.15.12.9:8000/pegawai/aduan/20', 1, '2026-07-16 01:06:07', '2026-07-16 01:05:35', '2026-07-16 01:06:07'),
(36, 4, 'comment', 'Komentar Baru pada Aduan', 'Ada komentar baru pada aduan SIHATI-2026-0018 Anda.', 'http://10.15.12.9:8000/pegawai/aduan/20', 1, '2026-07-16 01:07:06', '2026-07-16 01:06:31', '2026-07-16 01:07:06'),
(37, 1, 'comment', 'Komentar Baru pada Aduan', 'Ada komentar baru pada aduan SIHATI-2026-0018.', 'http://10.15.12.9:8000/admin/aduan/20', 1, '2026-07-16 01:07:10', '2026-07-16 01:06:54', '2026-07-16 01:07:10'),
(38, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0018 berubah menjadi Selesai.', 'http://10.15.12.9:8000/pegawai/aduan/20', 1, '2026-07-16 02:12:13', '2026-07-16 01:07:27', '2026-07-16 02:12:13'),
(39, 1, 'new', 'Aduan Baru Masuk', 'Aduan SIHATI-2026-0019 baru saja dibuat.', 'http://10.15.12.9:8000/admin/aduan/21', 1, '2026-07-16 02:22:10', '2026-07-16 01:08:26', '2026-07-16 02:22:10'),
(40, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0019 berubah menjadi Diproses.', 'http://10.15.12.9:8000/pegawai/aduan/21', 1, '2026-07-16 02:12:13', '2026-07-16 01:09:05', '2026-07-16 02:12:13'),
(41, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0019 berubah menjadi Selesai.', 'http://10.15.12.9:8000/pegawai/aduan/21', 1, '2026-07-16 02:12:13', '2026-07-16 01:09:23', '2026-07-16 02:12:13'),
(42, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0011 berubah menjadi Selesai.', 'http://10.15.12.9:8000/pegawai/aduan/13', 1, '2026-07-16 02:12:13', '2026-07-16 01:29:29', '2026-07-16 02:12:13'),
(43, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0012 berubah menjadi Selesai.', 'http://10.15.12.9:8000/pegawai/aduan/14', 1, '2026-07-16 02:12:13', '2026-07-16 01:47:33', '2026-07-16 02:12:13'),
(44, 1, 'new', 'Aduan Baru Masuk', 'Aduan SIHATI-2026-0020 baru saja dibuat.', 'http://10.15.12.9:8000/admin/aduan/22', 1, '2026-07-16 02:12:09', '2026-07-16 01:49:02', '2026-07-16 02:12:09'),
(45, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0020 berubah menjadi Diproses.', 'http://10.15.12.9:8000/pegawai/aduan/22', 1, '2026-07-16 02:12:13', '2026-07-16 02:01:07', '2026-07-16 02:12:13'),
(46, 1, 'new', 'Aduan Baru Masuk', 'Aduan SIHATI-2026-0021 baru saja dibuat.', 'http://10.15.12.9:8000/admin/aduan/23', 1, '2026-07-16 02:17:50', '2026-07-16 02:01:36', '2026-07-16 02:17:50'),
(47, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0021 berubah menjadi Diproses.', 'http://10.15.12.9:8000/pegawai/aduan/23', 1, '2026-07-16 02:12:13', '2026-07-16 02:10:40', '2026-07-16 02:12:13'),
(48, 1, 'new', 'Aduan Baru Masuk', 'Aduan SIHATI-2026-0022 baru saja dibuat.', 'http://10.15.12.9:8000/admin/aduan/24', 1, '2026-07-16 02:46:02', '2026-07-16 02:45:57', '2026-07-16 02:46:02'),
(49, 4, 'new', 'Aduan Baru: SIHATI-2026-0022', 'Admin membuat aduan untuk Bidang Pendataan.', 'http://10.15.12.9:8000/pegawai/aduan/24', 1, '2026-07-16 02:47:03', '2026-07-16 02:45:57', '2026-07-16 02:47:03'),
(50, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0022 berubah menjadi Diproses.', 'http://10.15.12.9:8000/pegawai/aduan/24', 1, '2026-07-16 02:46:59', '2026-07-16 02:46:13', '2026-07-16 02:46:59'),
(51, 4, 'status', 'Status Aduan Diperbarui', 'Status aduan SIHATI-2026-0022 berubah menjadi Selesai.', 'http://10.15.12.9:8000/pegawai/aduan/24', 1, '2026-07-16 02:47:27', '2026-07-16 02:47:14', '2026-07-16 02:47:27');

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

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `aduan_id`, `user_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 4, 'Pelayanan cepat', '2026-07-07 00:56:14', '2026-07-07 00:56:14'),
(2, 11, 5, 5, 'Mental sudah ditangani dengan baik\r\nAKU NAK MELETUPPP!!!!', '2026-07-10 07:30:25', '2026-07-10 07:30:25'),
(3, 12, 4, 5, 'Gercep', '2026-07-11 07:55:18', '2026-07-11 07:55:18'),
(4, 15, 4, 5, NULL, '2026-07-13 04:19:18', '2026-07-13 04:19:18'),
(5, 17, 4, 3, NULL, '2026-07-13 08:04:07', '2026-07-13 08:04:07'),
(6, 21, 4, 3, 'kurang', '2026-07-16 01:10:14', '2026-07-16 01:10:14');

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
('iJWWinFQJ0c6BxjpG0uF3ylc1bkDpOoLOPsgqcUq', 4, '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ5SUR3V3N1SThvYkFUc2ZhczZDMlp0a2Fub1FNVnc3N0lUZE5YbE5tIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjE1LjEyLjk6ODAwMFwvbm90aWZpY2F0aW9ucyIsInJvdXRlIjoibm90aWZpY2F0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo0fQ==', 1784184446),
('zSTdTy5zqYlYXQka2nGCbyf9mV3LBJHcWM5sGFYD', 1, '10.15.12.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkMVNRSU56WWt2VENpdEdWbVF1Rm94UWYyMEsxTEM5NDZsWkxDZzRtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjE1LjEyLjk6ODAwMFwvbm90aWZpY2F0aW9ucyIsInJvdXRlIjoibm90aWZpY2F0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1784184446);

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
(1, NULL, 'Admin SIHATI', 'admin', 'admin@sihati.local', NULL, '$2y$12$e6nQ83zyZveb8a..hugc4u8zNFn3DKFMyAsjHn9Vw7D1.E/xlFzKe', '081234567890', 'admin', 1, '9fap8sq14OqFdISnG9r6JpHuhIV1b9jR68Il2es2WVZTDE8r9oOwGeLKv3OC', '2026-07-04 20:31:08', '2026-07-14 06:21:58'),
(2, 1, 'Petugas IT', 'petugasit', 'petugas@sihati.local', NULL, '$2y$12$8Eflwknfice4YuzVz27uIu80ZpaaPJYYomKChuEpapWbVagAT4m/G', '081234567891', 'pegawai', 1, NULL, '2026-07-04 20:31:08', '2026-07-04 20:31:08'),
(4, 7, 'Taufiq Luthfi', 'topeqL', 'tpq@sihati.local', NULL, '$2y$12$eSjfQh9gwlMLFMaHNREEkue6hGXlwGccvKyyDd.US33uiankRoDMq', '1234321234321', 'pegawai', 1, NULL, '2026-07-10 02:58:08', '2026-07-14 06:23:17'),
(5, 5, 'Zaki', 'zaki', 'zaki@sihati.local', NULL, '$2y$12$RN8u0YbB6i8LAFIfIx24WeiBd/K1YCIzgFOoVgaETlf6SKrz6hmfK', '081234567890', 'pegawai', 1, NULL, '2026-07-10 03:07:25', '2026-07-13 01:48:41'),
(6, 8, 'Dewa', 'dewa', 'dewa@sihati.local', NULL, '$2y$12$DyQDzyqMC404DxM/q6eymOaOWLorhU1eVsk/S/RhJKkC.6ekSp2/W', '081234567890', 'pegawai', 1, NULL, '2026-07-11 15:06:22', '2026-07-13 01:49:22'),
(7, 2, 'Nopal', 'nopal', 'nopal@sihati.local', NULL, '$2y$12$NXdxunCyWHmMe/XEXvP/suzHddxrzjwy0TrhkgV8IVp90OsliSwiy', '081234567890', 'pegawai', 1, NULL, '2026-07-13 01:50:16', '2026-07-13 01:50:16'),
(8, 4, 'Pegawai', 'pegawai', 'pegawai@sihati.local', NULL, '$2y$12$.Uqa/qW7mFffj3XmAAGwGO9QOGNm///aLlHHHmO8LeDr0tom4B3Fa', '081234567890', 'pegawai', 1, NULL, '2026-07-13 01:51:27', '2026-07-13 01:51:27'),
(9, 3, 'Pegawai2', 'pegawai2', 'pegawai2@sihati.local', NULL, '$2y$12$RksHH147pvM5RYVr4NQVtu46CUGseEraD4DChl9hnqgJAewpM73wK', '081234567890', 'pegawai', 1, NULL, '2026-07-13 01:52:21', '2026-07-13 01:52:21');

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `aduans`
--
ALTER TABLE `aduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `aduan_attachments`
--
ALTER TABLE `aduan_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aduan_comments`
--
ALTER TABLE `aduan_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aduan_notes`
--
ALTER TABLE `aduan_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aduan_status_histories`
--
ALTER TABLE `aduan_status_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
