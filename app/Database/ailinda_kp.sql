-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 13 Jun 2025 pada 07.21
-- Versi server: 9.1.0
-- Versi PHP: 8.3.14

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
-- Struktur dari tabel `history_konfirmasi`
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
  `poin_pelanggaran` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-05-27-151601', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1749730774, 1),
(2, '2025-05-28-012513', 'App\\Database\\Migrations\\CreateSiswa', 'default', 'App', 1749730774, 1),
(3, '2025-05-28-021354', 'App\\Database\\Migrations\\CreateSuratIzinTable', 'default', 'App', 1749730774, 1),
(4, '2025-06-06-143330', 'App\\Database\\Migrations\\AddStatusKembaliToSuratIzin', 'default', 'App', 1749730774, 1),
(5, '2025-06-07-032937', 'App\\Database\\Migrations\\CreateHistoryKonfirmasi', 'default', 'App', 1749730774, 1),
(6, '2025-06-07-035319', 'App\\Database\\Migrations\\CreatePelanggaranTable', 'default', 'App', 1749730774, 1),
(7, '2025-06-07-054514', 'App\\Database\\Migrations\\AddWaktuKembaliSiswaToSuratIzin', 'default', 'App', 1749730774, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran`
--

DROP TABLE IF EXISTS `pelanggaran`;
CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_pelanggaran` varchar(255) NOT NULL,
  `poin` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `pelanggaran`
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
(13, 'Berpacaran', 100, '2025-06-12 12:50:10', '2025-06-12 12:50:10'),
(14, 'Merokok', 50, '2025-06-12 12:50:21', '2025-06-12 12:50:21'),
(15, 'Eek di Kelas', 25, '2025-06-13 07:02:56', '2025-06-13 07:02:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jurusan` enum('SOSHUM','SAINTEK','BAHASA') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `poin` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nisn` (`nisn`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nisn`, `nama`, `kelas`, `jurusan`, `poin`, `created_at`, `updated_at`) VALUES
(1, '0038217465', 'Ahmad Fauzi', '12 SAINTEK', 'SAINTEK', 5, NULL, NULL),
(12, '0038211112', 'Jajang Lesmana', 'SAINTEK-1', 'SAINTEK', 100, NULL, NULL),
(4, '0038217123', 'Ahmad Putra', '10 BAHASA ', 'BAHASA', 15, NULL, NULL),
(5, '0038217555', 'Ahmad Fauzi', 'XII IPS 3', 'SAINTEK', 7, NULL, NULL),
(6, '0038217999', 'Rafi Pratama', '11 BAHASA ', 'BAHASA', 12, NULL, NULL),
(7, '0038217666', 'Nisa Khairunnisa', 'XII Bahasa', 'SOSHUM', 5, NULL, NULL),
(8, '0038217777', 'M. Rizky Alfarizi', 'X IPA 3', 'SOSHUM', 2, NULL, NULL),
(13, '003821234567', 'Siti Maesaroh', '11 SOSHUM-', 'SOSHUM', 0, NULL, NULL),
(11, '0038217779', 'Jajang Kusnandar', 'SOSHUM-1', 'SOSHUM', 0, NULL, NULL),
(14, '19040305', 'Ai Linda Nurahmah Fadillah', '10 SOSHUM ', 'SOSHUM', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_izin`
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `surat_izin`
--

INSERT INTO `surat_izin` (`id`, `nama`, `nisn`, `kelas`, `alasan`, `waktu_keluar`, `waktu_kembali`, `status`, `created_at`, `updated_at`, `status_kembali`, `poin_pelanggaran`, `waktu_kembali_siswa`) VALUES
(1, 'Jajang SUbarjo', '0038211112', 'SAINTEK-1', 'Mau Bawa Ijazah', '12:00:00', '13:00:00', 'sudah kembali', '2025-06-12 12:43:56', '2025-06-12 12:50:44', 'belum kembali', 100, '12:00:00'),
(2, 'Jajang Kusnandar', '0038217779', 'SOSHUM-1', 'Ambil Ijazah', '10:00:00', '12:00:00', 'belum kembali', '2025-06-12 12:55:18', '2025-06-12 12:55:18', 'belum kembali', 0, NULL),
(3, 'Ahmad Putra', '0038217123', 'XI IPS 2', 'Membawa Ijazah', '13:00:00', '14:00:00', 'belum kembali', '2025-06-12 12:59:08', '2025-06-12 12:59:08', 'belum kembali', 0, NULL),
(4, 'Ahmad Fauzi', '0038217465', 'XII IPA 1', 'EEK', '08:00:00', '09:00:00', 'belum kembali', '2025-06-12 13:13:00', '2025-06-12 13:13:00', 'belum kembali', 0, NULL),
(5, 'Nisa Khairunnisa', '0038217666', 'XII Bahasa', 'Ambil Ijazah', '08:59:00', '10:20:00', 'sudah kembali', '2025-06-12 13:39:01', '2025-06-12 14:03:22', 'belum kembali', 5, '11:00:00'),
(6, 'Nisa Khairunnisa', '0038217666', 'XII Bahasa', 'eek', '08:09:00', '10:20:00', 'belum kembali', '2025-06-12 13:45:08', '2025-06-12 13:45:08', 'belum kembali', 0, NULL),
(7, 'Nisa Khairunnisa', '0038217666', 'XII Bahasa', 'Fugiat voluptas offi', '17:16:00', '04:36:00', 'belum kembali', '2025-06-12 13:46:32', '2025-06-12 13:46:32', 'belum kembali', 0, NULL),
(8, 'Siti Maesaroh', '0038217888', 'XI Bahasa ', 'EEK', '12:00:00', '14:00:00', 'sudah kembali', '2025-06-12 14:14:56', '2025-06-12 14:15:13', 'belum kembali', 0, '13:30:00'),
(9, 'Ai Linda Nurahmah Fadillah', '19040305', '10 SOSHUM ', 'Eek Keluar', '09:30:00', '10:00:00', 'sudah kembali', '2025-06-13 07:05:34', '2025-06-13 07:06:27', 'belum kembali', 15, '11:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('piket','bp','admin') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'piket1', '$2y$10$T1lb2K9DKo1n.j8FpOD9muuTo7rhPZ83BPW40rMIsNd/HJZtaIn.i', 'piket', NULL, NULL),
(2, 'bp1', '$2y$10$PdYOE4wnxKREAatXTQTKj.jGZgBTd9FxlTXk9.TjImGoOM3FC2JPe', 'bp', NULL, NULL),
(3, 'admin1', '$2y$10$.4eTUB2u6hluLmvwU4ng5.9DLPZ4RHOC8ce18Fr2zz.P0A28etxTG', 'admin', NULL, NULL),
(4, 'ailinda', '$2y$10$S9et3uLv/q6v72685PexjOGOOE2bRaabrOgUXfNhi/wMGC0M.I5zK', 'admin', NULL, NULL),
(5, 'piket2', '$2y$10$D21wtfcZA6OKkZNUQssIV.Z.1wNhpCcpub.Gvq8waL4gKgJcPSRsK', 'piket', NULL, NULL),
(10, 'Nonih', '$2y$10$FECjZYe/odCbfynMvgukDuirB7K2JdIfBDdFZSwdA9UwHCnK0u/sa', 'piket', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
