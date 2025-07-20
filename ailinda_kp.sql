-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2025 at 03:49 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ailinda_kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_konfirmasi`
--

DROP TABLE IF EXISTS `history_konfirmasi`;
CREATE TABLE IF NOT EXISTS `history_konfirmasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `izin_id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `waktu_keluar` time NOT NULL,
  `waktu_kembali` time NOT NULL,
  `waktu_kembali_siswa` time DEFAULT NULL,
  `poin_pelanggaran` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(43, '2025-05-27-151601', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1750464764, 1),
(44, '2025-05-28-012513', 'App\\Database\\Migrations\\CreateSiswa', 'default', 'App', 1750464764, 1),
(45, '2025-05-28-021354', 'App\\Database\\Migrations\\CreateSuratIzinTable', 'default', 'App', 1750464764, 1),
(46, '2025-06-06-143330', 'App\\Database\\Migrations\\AddStatusKembaliToSuratIzin', 'default', 'App', 1750464764, 1),
(47, '2025-06-07-032937', 'App\\Database\\Migrations\\CreateHistoryKonfirmasi', 'default', 'App', 1750464764, 1),
(48, '2025-06-07-035319', 'App\\Database\\Migrations\\CreatePelanggaranTable', 'default', 'App', 1750464764, 1),
(49, '2025-06-07-054514', 'App\\Database\\Migrations\\AddWaktuKembaliSiswaToSuratIzin', 'default', 'App', 1750464764, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

DROP TABLE IF EXISTS `pelanggaran`;
CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_pelanggaran` varchar(255) NOT NULL,
  `poin` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id`, `jenis_pelanggaran`, `poin`, `created_at`, `updated_at`) VALUES
(1, 'Terlambat datang ke madrasah.', 5, NULL, NULL),
(2, 'Berkuku panjang.', 5, NULL, NULL),
(3, 'Menggulung lengan baju', 5, NULL, NULL),
(4, 'Menggunakan pakaian atau atribut di luar ketentuan', 5, NULL, NULL),
(5, 'Menggunakan perhiasan berlebihan.', 5, NULL, NULL),
(6, 'Menggunakan asesoris', 5, NULL, NULL),
(7, 'Meninggalkan kelas tanpa seizin guru saat pembelajaran.', 10, NULL, NULL),
(8, 'Meninggalkan madrasah tanpa seizin guru piket sebelum KBM berakhir', 15, NULL, NULL),
(9, 'Menggunakan pewarna bibir, penebal alis, maskara, eyeshadow, lensa mata, cat kuku, dan henna.', 15, NULL, NULL),
(10, 'Rambut diwarnai/gondrong/model tidak normatif.', 25, NULL, NULL),
(11, 'Mengubah bentuk alis.', 25, NULL, NULL),
(12, 'Tidak menyimpan handphone/tablet ke locker madrasah.', 25, NULL, NULL),
(13, 'Jajan', 20, '2025-07-20 14:36:00', '2025-07-20 14:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` int NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `jurusan` enum('SOSHUM','SAINTEK','BAHASA') NOT NULL,
  `poin` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nisn` (`nisn`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nisn`, `nama`, `kelas`, `tahun_ajaran`, `jurusan`, `poin`, `created_at`, `updated_at`) VALUES
(1, '1000000001', 'Ahmad Fauzi', 11, '2024/2025', 'SAINTEK', 10, NULL, '2025-07-20 13:21:04'),
(2, '1000000002', 'Dina Safitri', 11, '2022/2023', 'SAINTEK', 15, NULL, '2025-07-20 14:57:56'),
(3, '1000000003', 'Rafi Pratama', 11, '2024/2025', 'SAINTEK', 0, NULL, '2025-06-21 00:52:52'),
(4, '1000000004', 'Nisa Khairunnisa', 11, '2024/2025', 'SOSHUM', 0, NULL, '2025-06-21 00:37:50'),
(5, '1000000005', 'M. Rizky Alfarizi', 11, '2024/2025', 'SOSHUM', 4, NULL, '2025-06-21 00:37:50'),
(6, '1000000006', 'Siti Maesaroh', 11, '2024/2025', 'SOSHUM', 17, NULL, '2025-07-20 13:30:03'),
(7, '1000000007', 'Ahmad Putra', 11, '2024/2025', 'SOSHUM', 8, NULL, '2025-06-21 00:37:50'),
(11, '2203010535', 'Muhammad Randika Saputra', 10, '2019/2020', 'SAINTEK', 190, '2025-06-21 00:45:18', '2025-06-21 01:06:56'),
(9, '1000000009', 'Bagas Prakoso', 11, '2024/2025', 'SAINTEK', 1, NULL, '2025-06-21 00:37:50'),
(10, '1000000010', 'Lestari Dewi', 11, '2024/2025', 'SAINTEK', 3, NULL, '2025-06-21 00:37:50'),
(12, '2203010046', 'Ai Linda NF', 10, '2019/2020', 'SOSHUM', 25, '2025-06-21 00:50:13', '2025-07-20 15:21:45'),
(13, '2203010123', 'Randika', 10, '2022', 'SAINTEK', 0, '2025-07-20 14:36:30', '2025-07-20 14:36:30'),
(19, '1234567111', 'Budi Santoso', 11, '2024/2025', 'SOSHUM', 0, '2025-07-20 14:55:05', '2025-07-20 14:55:05'),
(20, '9876543210', 'Siti Aminah', 12, '2024/2025', 'SAINTEK', 0, '2025-07-20 14:55:05', '2025-07-20 14:55:05'),
(21, '1122334455', 'Joko Widodo', 10, '2024/2025', 'BAHASA', 0, '2025-07-20 14:55:05', '2025-07-20 14:55:05'),
(22, '5566778899', 'Rina Marlina', 11, '2024/2025', 'SOSHUM', 0, '2025-07-20 14:55:05', '2025-07-20 14:55:05'),
(23, '9988776655', 'Fajar Nugroho', 12, '2024/2025', 'SAINTEK', 0, '2025-07-20 14:55:05', '2025-07-20 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin`
--

DROP TABLE IF EXISTS `surat_izin`;
CREATE TABLE IF NOT EXISTS `surat_izin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alasan` text NOT NULL,
  `waktu_keluar` time NOT NULL,
  `waktu_kembali` time NOT NULL,
  `status` enum('belum kembali','sudah kembali') NOT NULL DEFAULT 'belum kembali',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status_kembali` varchar(20) DEFAULT 'belum kembali',
  `poin_pelanggaran` int DEFAULT '0',
  `waktu_kembali_siswa` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `surat_izin`
--

INSERT INTO `surat_izin` (`id`, `nama`, `nisn`, `kelas`, `alasan`, `waktu_keluar`, `waktu_kembali`, `status`, `created_at`, `updated_at`, `status_kembali`, `poin_pelanggaran`, `waktu_kembali_siswa`) VALUES
(1, 'Muhammad Randika Saputra', '2203010535', '10', 'jajan', '13:00:00', '14:00:00', 'sudah kembali', '2025-06-21 01:06:45', '2025-06-21 01:06:56', 'belum kembali', 40, '12:00:00'),
(2, 'Ai Linda NF', '2203010046', '10', 'jhdsjhs', '12:21:00', '13:34:00', 'belum kembali', '2025-06-21 01:08:15', '2025-06-21 01:08:15', 'belum kembali', 0, NULL),
(3, 'Ahmad Fauzi', '1000000001', '11', 'eek', '10:12:00', '12:00:00', 'sudah kembali', '2025-06-22 06:34:31', '2025-06-22 06:34:40', 'belum kembali', 0, '12:00:00'),
(4, 'Ahmad Fauzi', '1000000001', '11', 'desdrdfdr', '12:00:00', '13:00:00', 'belum kembali', '2025-07-07 08:26:53', '2025-07-07 08:26:53', 'belum kembali', 0, NULL),
(5, 'Ahmad Fauzi', '1000000001', '11', 'asasaa', '12:00:00', '14:00:00', 'belum kembali', '2025-07-07 08:47:23', '2025-07-07 08:47:23', 'belum kembali', 0, NULL),
(6, 'Ahmad Fauzi', '1000000001', '11', 'Jajan', '12:00:00', '13:00:00', 'sudah kembali', '2025-07-20 13:08:43', '2025-07-20 13:08:53', 'belum kembali', 0, '11:30:00'),
(7, 'Ahmad Fauzi', '1000000001', '11', 'Jajan', '13:00:00', '14:00:00', 'sudah kembali', '2025-07-20 13:14:34', '2025-07-20 13:21:04', 'belum kembali', 10, '15:00:00'),
(8, 'Siti Maesaroh', '1000000006', '11', 'Jujur', '10:00:00', '12:00:00', 'sudah kembali', '2025-07-20 13:16:17', '2025-07-20 13:30:03', 'belum kembali', 10, '11:00:00'),
(9, 'Dina Safitri', '1000000002', '11', 'hahah', '12:00:00', '14:00:00', 'sudah kembali', '2025-07-20 13:18:26', '2025-07-20 14:57:56', 'belum kembali', 15, '13:00:00'),
(10, 'Ahmad Putra', '1000000007', '11', 'Jajan', '14:00:00', '20:00:00', 'belum kembali', '2025-07-20 13:45:24', '2025-07-20 13:45:24', 'belum kembali', 0, NULL),
(11, 'Siti Aminah', '9876543210', '12', 'Belajar', '10:00:00', '11:30:00', 'belum kembali', '2025-07-20 15:08:44', '2025-07-20 15:08:44', 'belum kembali', 0, NULL),
(12, 'Ai Linda NF', '2203010046', '10', 'Jajan', '09:30:00', '12:00:00', 'sudah kembali', '2025-07-20 15:21:09', '2025-07-20 15:21:45', 'belum kembali', 25, '10:00:00'),
(13, 'Ai Linda NF', '2203010046', '10', 'asasa', '12:00:00', '13:00:00', 'belum kembali', '2025-07-20 15:25:22', '2025-07-20 15:25:22', 'belum kembali', 0, NULL),
(14, 'Ai Linda NF', '2203010046', '10', 'asasa', '12:00:00', '13:00:00', 'belum kembali', '2025-07-20 15:25:46', '2025-07-20 15:25:46', 'belum kembali', 0, NULL),
(15, 'Muhammad Randika Saputra', '2203010535', '10', 'Eek', '12:00:00', '14:00:00', 'belum kembali', '2025-07-20 15:33:03', '2025-07-20 15:33:03', 'belum kembali', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('piket','bp','admin') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Piket', 'piket@gmail.com', '$2y$10$FrUAQNlmfDiQ/4IOuR8X8.0B.E.Qh0FmNPrWJocOiuP9KNGAlkeXC', 'piket', '2025-06-21 00:13:05', NULL),
(2, 'Bagian Siswa', 'bp@gmail.com', '$2y$10$E0xwMltD1TGntv9s6G5nNupwVghvJsh8pW.5iqNkI.y2TVFUJSmMe', 'bp', '2025-06-21 00:13:05', NULL),
(3, 'admin', 'admin@gmail.com', '$2y$10$HUbE9wNNDCW4oOBoI6P7OOrD25pilJvDhTh.TGCtpDfs8uS01n/Eu', 'admin', '2025-06-21 00:13:05', NULL),
(4, 'ailinda', 'ailinda@gmail.com', '$2y$10$Fn0SkKXgAumR0uA5tk8xsubBcDOISAuPIj0xqGHqZE84VOd4zJ7ky', 'admin', '2025-06-21 00:13:05', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
