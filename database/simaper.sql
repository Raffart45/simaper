-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2024 at 11:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventoris`
--

CREATE TABLE `inventoris` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tipe` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventoris`
--

INSERT INTO `inventoris` (`id`, `product_id`, `jumlah`, `tipe`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 3, 10000, 'masuk', '2024-07-31', '2024-07-30 23:47:08', '2024-07-30 23:47:08'),
(3, 4, 9600, 'masuk', '2024-07-31', '2024-07-30 23:48:24', '2024-07-30 23:48:24'),
(4, 5, 28000, 'masuk', '2024-07-31', '2024-07-30 23:50:03', '2024-07-30 23:50:03'),
(5, 6, 32000, 'masuk', '2024-07-31', '2024-07-30 23:51:53', '2024-07-30 23:51:53'),
(6, 7, 32000, 'masuk', '2024-07-31', '2024-07-30 23:53:13', '2024-07-30 23:53:13'),
(7, 8, 48000, 'masuk', '2024-07-31', '2024-07-30 23:55:07', '2024-07-30 23:55:07'),
(8, 9, 49975, 'masuk', '2024-07-31', '2024-07-30 23:56:17', '2024-07-30 23:56:17'),
(9, 10, 50000, 'masuk', '2024-07-31', '2024-07-31 00:01:03', '2024-07-31 00:01:03'),
(18, 2, 17000, 'masuk', '2024-08-01', '2024-07-31 22:53:40', '2024-07-31 22:53:40'),
(22, 2, 1200, 'keluar', '2023-09-09', '2024-08-01 07:28:40', '2024-08-01 07:28:40'),
(25, 3, 1800, 'keluar', '2023-09-18', '2024-08-01 07:45:11', '2024-08-01 07:45:11'),
(27, 4, 1700, 'keluar', '2023-09-18', '2024-08-01 07:53:57', '2024-08-01 07:53:57'),
(28, 7, 1800, 'keluar', '2023-10-04', '2024-08-01 07:59:08', '2024-08-01 07:59:08'),
(31, 4, 2200, 'keluar', '2023-10-09', '2024-08-01 08:12:48', '2024-08-01 08:12:48'),
(34, 9, 1700, 'keluar', '2023-11-08', '2024-08-01 08:36:02', '2024-08-01 08:36:02'),
(35, 9, 2000, 'keluar', '2023-11-13', '2024-08-01 08:38:52', '2024-08-01 08:38:52'),
(36, 5, 1400, 'keluar', '2023-09-04', '2024-08-01 13:30:51', '2024-08-01 13:30:51'),
(40, 7, 1600, 'keluar', '2023-11-04', '2024-08-06 14:59:44', '2024-08-06 14:59:44'),
(41, 6, 2000, 'keluar', '2024-05-06', '2024-08-07 04:07:34', '2024-08-07 04:07:34'),
(42, 8, 1700, 'keluar', '2024-05-14', '2024-08-07 04:33:31', '2024-08-07 04:33:31'),
(43, 3, 1400, 'keluar', '2024-05-20', '2024-08-07 04:51:38', '2024-08-07 04:51:38'),
(44, 5, 1700, 'keluar', '2024-05-29', '2024-08-07 05:05:32', '2024-08-07 05:05:32'),
(45, 4, 1800, 'keluar', '2024-06-04', '2024-08-07 19:53:35', '2024-08-07 19:53:35'),
(46, 4, 300, 'keluar', '2024-08-13', '2024-08-07 21:20:28', '2024-08-07 21:20:28'),
(47, 10, 1900, 'keluar', '2024-06-12', '2024-08-07 23:27:45', '2024-08-07 23:27:45'),
(48, 10, 300, 'keluar', '2024-06-19', '2024-08-07 23:58:15', '2024-08-07 23:58:15'),
(49, 8, 2100, 'keluar', '2023-11-08', '2024-08-08 00:10:56', '2024-08-08 00:10:56'),
(50, 4, 980, 'keluar', '2024-08-14', '2024-08-08 05:10:49', '2024-08-08 05:10:49'),
(51, 3, 1000, 'keluar', '2024-08-21', '2024-08-13 13:32:32', '2024-08-13 13:32:32'),
(52, 10, 400, 'keluar', '2024-08-26', '2024-08-13 15:29:08', '2024-08-13 15:29:08');

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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2024_07_20_202852_create_products_table', 1),
(36, '2024_07_31_045751_create_inventoris_table', 1),
(37, '2024_07_31_045815_create_ongkirs_table', 1),
(38, '2024_07_31_045848_create_pesanans_table', 1),
(39, '2024_07_31_045930_create_transaksis_table', 1),
(40, '2024_07_31_050020_create_return_produks_table', 1),
(41, '2024_08_08_023938_add_status_to_return_produks_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ongkirs`
--

CREATE TABLE `ongkirs` (
  `id` bigint UNSIGNED NOT NULL,
  `kabupaten` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_ongkir` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ongkirs`
--

INSERT INTO `ongkirs` (`id`, `kabupaten`, `provinsi`, `harga_ongkir`, `created_at`, `updated_at`) VALUES
(1, 'Bangkalan', 'Jawa Timur', 852000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(2, 'Banyuwangi', 'Jawa Timur', 1176000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(3, 'Blitar', 'Jawa Timur', 1176000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(4, 'Bondowoso', 'Jawa Timur', 660000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(5, 'Gresik', 'Jawa Timur', 726000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(6, 'Jember', 'Jawa Timur', 588000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(7, 'Kediri', 'Jawa Timur', 1224000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(8, 'Lamongan', 'Jawa Timur', 948000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(9, 'Madiun', 'Jawa Timur', 1572000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(10, 'Magetan', 'Jawa Timur', 1572000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(11, 'Malang', 'Jawa Timur', 672000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(12, 'Ngawi', 'Jawa Timur', 1572000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(13, 'Pamekasan', 'Jawa Timur', 1332000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(14, 'Ponorogo', 'Jawa Timur', 1644000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(15, 'Sidoarjo', 'Jawa Timur', 510000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(16, 'Situbondo', 'Jawa Timur', 600000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(17, 'Sumenep', 'Jawa Timur', 1656000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(18, 'Trenggalek', 'Jawa Timur', 1542000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(19, 'Tuban', 'Jawa Timur', 1230000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(20, 'Probolinggo', 'Jawa Timur', 252000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(21, 'Mojokerto', 'Jawa Timur', 798000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(22, 'Jombang', 'Jawa Timur', 1014000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(23, 'Surabaya', 'Jawa Timur', 642000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(24, 'Nganjuk', 'Jawa Timur', 1080000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(25, 'Pacitan', 'Jawa Timur', 2118000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(26, 'Sampang', 'Jawa Timur', 1140000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(27, 'Pasuruan', 'Jawa Timur', 276000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(28, 'Lumajang', 'Jawa Timur', 276000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24'),
(29, 'Bojonegoro', 'Jawa Timur', 1296000.00, '2024-07-30 23:34:24', '2024-07-30 23:34:24');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `ongkir_id` bigint UNSIGNED NOT NULL,
  `no_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemesan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pesananan` date DEFAULT NULL,
  `jumlah_pesanan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_pesanan` decimal(10,2) NOT NULL,
  `status_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `user_id`, `product_id`, `ongkir_id`, `no_pesanan`, `nama_pemesan`, `no_telp`, `alamat`, `kabupaten`, `provinsi`, `tanggal_pesananan`, `jumlah_pesanan`, `harga_pesanan`, `status_pesanan`, `created_at`, `updated_at`) VALUES
(7, 5, 2, 5, 'ORD-66AB9B983869F', 'Supardi', '081231470463', 'Kec. Wringin Arom, Kab. Gresik, Prov. Jawa Timur, Kodepos 61176', 'Gresik', 'Jawa Timur', '2023-09-09', '60', 2826000.00, 'Pesanan sampai', '2024-08-01 07:28:40', '2024-08-01 13:13:51'),
(10, 10, 3, 23, 'ORD-66AB9F7772535', 'Agus Kuncoro', '087898023617', 'Kec. Tamboksari, Kab. Surabaya, Prov. Jawa Timur, Kodepos 60131', 'Surabaya', 'Jawa Timur', '2023-09-18', '90', 3792000.00, 'Pesanan sampai', '2024-08-01 07:45:11', '2024-08-01 13:21:09'),
(12, 12, 4, 12, 'ORD-66ABA18548516', 'Budi Setyo', '0821143846635', 'Kec. Karanganyar, Kab. Ngawi, Prov. Jawa Timur, Kodepos 63257', 'Ngawi', 'Jawa Timur', '2023-09-18', '85', 4547000.00, 'Pesanan sampai', '2024-08-01 07:53:57', '2024-08-05 03:27:44'),
(13, 13, 7, 25, 'ORD-66ABA2BCC1F92', 'Adi Setyo', '087898023593', 'Kec. Tegalombo, Kab. Pacitan, Prov. Jawa Timur, Kodepos 63571', 'Pacitan', 'Jawa Timur', '2023-10-04', '90', 4818000.00, 'Pesanan sampai', '2024-08-01 07:59:08', '2024-08-05 03:33:12'),
(16, 16, 4, 14, 'ORD-66ABA5F005240', 'Muhammad Suprapto', '083820380926', 'Kec. Bungkal, Kab. Ponorogo, Jawa Timur, Kodepos 63462', 'Ponorogo', 'Jawa Timur', '2023-10-09', '110', 5494000.00, 'Pesanan sampai', '2024-08-01 08:12:48', '2024-08-05 03:56:15'),
(19, 19, 9, 7, 'ORD-66ABAB621CF79', 'Sutrisno', '083848631120', 'Kec. Kunjang, Kab. Kediri, Prov. Jawa Timur, Kodepos 64156', 'Kediri', 'Jawa Timur', '2023-11-08', '85', 3604000.00, 'Pesanan sampai', '2024-08-01 08:36:02', '2024-08-05 04:44:38'),
(20, 20, 9, 11, 'ORD-66ABAC0C9CD38', 'Restu Aji', '083141313174', 'Kec. Gedangan, Kab. Malang, Prov. Jawa Timur, Kodepos 65178', 'Malang', 'Jawa Timur', '2023-11-13', '100', 3472000.00, 'Pesanan sampai', '2024-08-01 08:38:52', '2024-08-05 04:49:31'),
(21, 21, 5, 7, 'ORD-66ABF07B447CC', 'Supriadi', '085273619040', 'Kec. Purwosari, Kab. Kediri, Prov. Jawa Timur, Kodepos 60131', 'Kediri', 'Jawa Timur', '2023-09-04', '70', 3324000.00, 'Pesanan sampai', '2024-08-01 13:30:51', '2024-08-05 02:53:45'),
(22, 14, 3, 4, 'ORD-66B0B416D1177', 'Joko Pustoko', '083827225158', 'Kec. Binakal, Kab. Bondowoso, Prov Jawa Timur, Kodepos 68521', 'Bondowoso', 'Jawa Timur', '2023-10-13', '100', 4160000.00, 'Pesanan sampai', '2024-08-05 04:14:30', '2024-08-05 04:17:42'),
(23, 15, 2, 21, 'ORD-66B0B8B584E74', 'Hendro Lesmono', '083182663406', 'Kec. Mojosari, Kab. Mojokerto, Prov. Jawa Timur, Kodepos 61382', 'Mojokerto', 'Jawa Timur', '2023-10-19', '75', 3423000.00, 'Pesanan sampai', '2024-08-05 04:34:13', '2024-08-05 04:38:08'),
(25, 22, 7, 2, 'ORD-66B29CD0DC9AB', 'Agung Sanjaya', '081864024586', 'Kec Kalibaru, Kab Bayuwangi, Prov Jawa Timur, kodepos 68467', 'Banyuwangi', 'Jawa Timur', '2023-11-04', '80', 3576000.00, 'Pesanan Sampai', '2024-08-06 14:59:44', '2024-08-06 15:02:46'),
(26, 23, 6, 26, 'ORD-66B35575F32C4', 'Acep Iskandar', '0821226975425', 'Kec. Ketapang, Kab. Sampang, Prov. Jawa Timur, Kodepos 69261', 'Sampang', 'Jawa Timur', '2024-05-06', '100', 4140000.00, 'Pesanan Sampai', '2024-08-07 04:07:34', '2024-08-07 04:24:57'),
(27, 24, 8, 8, 'ORD-66B35B8B1CEEE', 'Mulyadi', '0821083153064', 'Kec. Paciran, Kab. Lamongan, Prov. Jawa TImur, Kodepos  62264', 'Lamongan', 'Jawa Timur', '2024-05-14', '85', 3328000.00, 'Pesanan Sampai', '2024-08-07 04:33:31', '2024-08-07 04:37:31'),
(28, 25, 3, 24, 'ORD-66B35FCAE6502', 'Mujiono', '0852834266942', 'Kec. Lengkong, Kab. Nganjuk, Prov. Jawa Timur, Kodepos 64393', 'Nganjuk', 'Jawa Timur', '2024-05-20', '70', 3530000.00, 'Pesanan Sampai', '2024-08-07 04:51:38', '2024-08-07 04:53:58'),
(29, 26, 5, 15, 'ORD-66B3630C58F98', 'Heri Budiman', '085215408846', 'Kec. Buduran, Kab. Sidoarjo, Prov. Jawa Timur, Kodepos 61252', 'Sidoarjo', 'Jawa Timur', '2024-05-29', '85', 3060000.00, 'Pesanan Sampai', '2024-08-07 05:05:32', '2024-08-07 05:13:36'),
(30, 27, 4, 9, 'ORD-66B4332F7F097', 'Ibnu Salim', '083863104703', 'Kec. kartoharjo, Kab. Madiun, Prov, Jawa Timur, Kodepos 6311', 'Madiun', 'Jawa Timur', '2024-06-04', '90', 4722000.00, 'Pesanan Sampai', '2024-08-07 19:53:35', '2024-08-07 20:10:38'),
(31, 28, 10, 19, 'ORD-66B465617A8B2', 'Dadang Nur', '085933825322', 'Kec. Rengel, Kab. Tuban, Prov, Jawa Timur, Kodepos 62370', 'Tuban', 'Jawa Timur', '2024-06-12', '95', 3890000.00, 'Pesanan Sampai', '2024-08-07 23:27:45', '2024-08-07 23:54:07'),
(32, 29, 8, 27, 'ORD-66B46F8039D8D', 'Suripto', '089784768908', 'Kec. Bangil, Kab. Pasuruan, Prov. Jawa Timur, Kodepos 67153', 'Pasuruan', 'Jawa Timur', '2023-11-08', '105', 3216000.00, 'Pesanan Sampai', '2024-08-08 00:10:56', '2024-08-08 00:14:16'),
(35, 28, 3, 19, 'ORD-66BBC2E058A0C', 'Dadang Nur', '085933825322', 'Kec. Rengel, Kab. Tuban, Prov, Jawa Timur, Kodepos 62370', 'Tuban', 'Jawa Timur', '2024-08-21', '50', 2980000.00, 'Pesanan Sampai', '2024-08-13 13:32:32', '2024-08-13 14:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `category` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `box` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `thumbnails` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `stok`, `category`, `foto_produk`, `deskripsi`, `berat`, `box`, `harga`, `thumbnails`, `created_at`, `updated_at`) VALUES
(2, 'Arum Manis A1', 14300, 'Grade A', 'foto_produk/btQpgU4U8VC1mi0kXZfMFcO5JuL9TLMXicM8sF5a.jpg', 'Mangga Harumanis Grade A\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 70%\r\nKemulusan kulit = 90%', 7150.00, 715, 35000.00, '[\"thumbnails/AKc5mzKrhjE7v60ZBhSF9pWK6FvZz8sYxG5rcFfH.jpg\", \"thumbnails/ed5qb1m1YNhRkVZw6M38cDVcFFtDCO5XK2cjKeAv.jpg\", \"thumbnails/AQpLoliw29og9gRVDdXsjq8WqEw3vd649tw5kBjX.jpg\"]', '2024-07-30 23:44:36', '2024-08-05 04:35:46'),
(3, 'Arum Manis A2', 3800, 'Grade A', 'foto_produk/LUVeFJggc0sh11vO4l48EMUYIGbk5atumxIvy6tX.jpg', 'Mangga Harumanis Grade A\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 65%\r\nKemulusan kulit = 80%', 1900.00, 190, 35000.00, '[\"thumbnails/qJXgfiK04S3B0OPpWfA5ZL2tMC44e6HmLhKetlni.jpg\", \"thumbnails/dNUZJL7GgDD3RK8T8oqbNVNzn2CkMeMcxT1P8MII.jpg\"]', '2024-07-30 23:47:08', '2024-08-13 13:32:32'),
(4, 'Arum Manis A3', 2620, 'Grade A', 'foto_produk/J2DfPKsHyCSfsP9KOvWTpVwAxMVM7URiVAwJEEP9.jpg', 'Mangga Harumanis Grade A\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 60%\r\nKemulusan kulit = 80%', 1460.00, 146, 35000.00, '[\"thumbnails/CHFZKKE9ZWRDbBJ0joffWaM8gcggqDKwqLDOQNnj.jpg\", \"thumbnails/3Gw1JKPkpxRLiJt8qMTNZ27gU3TEzaG7Q3uaMmOd.jpg\", \"thumbnails/HMpcuT6aHzqqBX4b9FZUyCsMzdaRDQlLfZzv6yBg.jpg\"]', '2024-07-30 23:48:24', '2024-08-08 05:10:49'),
(5, 'Arum Manis B1', 24900, 'Grade B', 'foto_produk/qQ53AZIOyuK0bXClU6Hui2tEMpQBSGfs0xHEjlSh.jpg', 'Mangga Harumanis Grade B\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 65%\r\nKemulusan kulit = 80%', 12450.00, 1245, 30000.00, '[\"thumbnails/pyhKJUCrFzdweRc3fxcOGUCeeaWFyTBmjRtH368X.jpg\", \"thumbnails/lPUlSo6ZcgLdkWFPxWa6RkjgDVCjWCJEJyQoicEd.jpg\"]', '2024-07-30 23:50:03', '2024-08-07 05:05:32'),
(6, 'Arum Manis B2', 30000, 'Grade B', 'foto_produk/MOOySmjBoXmM9ljBCG6IzIqYGy0Si2RwgXUa0QQ5.jpg', 'Mangga Harumanis Grade B\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 60%\r\nKemulusan kulit =70%', 15000.00, 1500, 30000.00, '[\"thumbnails/xQvOs6j4So9B8aUJix7ifiOVK2MxWe1PzYl6KFmk.jpg\", \"thumbnails/gCdrZRozqlrUHFxDqWrVsLaDmV7P6jDINjrF5GSd.jpg\"]', '2024-07-30 23:51:53', '2024-08-07 04:07:34'),
(7, 'Arum Manis B3', 28600, 'Grade B', 'foto_produk/u1eDODn9AKsfiNlyZyIWYHh296DaYQTrAkLhBocv.jpg', 'Mangga Harumanis Grade B\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 70%\r\nKemulusan kulit = 70%', 14300.00, 1430, 30000.00, '[\"thumbnails/qdYHuDvW4EkQMAzpxgk3kaVg43J0RZQV2Po7xd4W.jpg\", \"thumbnails/sVbmO8XHoRQq9d6bokBUvhY5HgorXK5cEQ08NmfB.jpg\"]', '2024-07-30 23:53:13', '2024-08-06 14:59:44'),
(8, 'Arum Manis C1', 44200, 'Grade C', 'foto_produk/s6ZsLGU89aWji58omNxieQhl8C09xVjq1NX2baLU.jpg', 'Mangga Harumanis Grade C\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 70%\r\nkemulusan kulit = 60%', 22100.00, 2210, 28000.00, '[\"thumbnails/7RL8XaK8POlBlsKPVnuDzdcSfxfPU8Ul1Ctp5yOW.jpg\", \"thumbnails/c1VN0Fj1P6kVS7H6LtEF6kiCLfV3lgYnF3F8lSi9.jpg\"]', '2024-07-30 23:55:07', '2024-08-08 00:10:56'),
(9, 'Arum Manis C2', 46275, 'Grade C', 'foto_produk/Gfrn4qXQRkNgQksEPmMC8uJ7yBdPJmxiZqKOhOe9.jpg', 'Mangga Harumanis Grade C\r\nRasa manis\r\nUkuran besar-besar\r\nHarga yg tertera per kg\r\nKematangan produk = 65%\r\nKemulusan kulit = 60%', 23137.50, 2314, 28000.00, '[\"thumbnails/VWWfbgliE0vE0WqeBGGhjMGcVCMlniCSc526qEai.jpg\", \"thumbnails/78AlMVRuo4g5kPALCLsQ8BBalLiu4DuXXoXL9J5G.jpg\"]', '2024-07-30 23:56:17', '2024-08-01 08:38:52'),
(10, 'Arum Manis C3', 47400, 'Grade C', 'foto_produk/N9IvUdH8sGMNuFf997W5PCppK2tPGPRRJ9i3w1wm.jpg', 'Mangga Harumanis Grade C Rasa manis Ukuran besar-besar Harga yg tertera per kg Kematangan produk = 60% Kemulusan kulit = 60%', 24050.00, 2405, 28000.00, '[\"thumbnails/TSJbeME99fNCFgojKrlm0pbhP5NrHH1zLeTdZpbL.jpg\", \"thumbnails/4WoTaeduDUmVlKSyYeMXvi5ZDxn5jd8p1tXNOGYP.jpg\", \"thumbnails/6yWjiIGyJf6hC9OcttvRJbC50kNG97QFti3BQ1kP.jpg\"]', '2024-07-31 00:01:03', '2024-08-13 15:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `return_produks`
--

CREATE TABLE `return_produks` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_produks`
--

INSERT INTO `return_produks` (`id`, `transaction_id`, `jumlah`, `tanggal`, `alasan`, `foto_produk`, `created_at`, `updated_at`, `status`) VALUES
(8, 23, 15, '2024-08-12', 'Barang cacat dan banyak yang rusak', 'return_fotos/a4oo6ENiBFOBC3iH87KP12LUpg1mxPZmMuFpXv1r.jpg', '2024-08-07 20:18:28', '2024-08-07 23:59:01', 'Produk sampai'),
(9, 25, 15, '2024-06-14', 'Barang rusak dan buah banyak yang busuk', 'return_fotos/xQ02vmpxZkr8LGx0l6BA4qSlpES4zHM2jMDJ28kZ.jpg', '2024-08-07 23:55:39', '2024-08-07 23:58:51', 'Produk sampai'),
(10, 25, 10, '2024-08-23', NULL, 'return_fotos/U5wGFaEm7dlVgo91VP5tnHecMY9poc0MoMpypLlN.jpg', '2024-08-13 15:21:09', '2024-08-13 15:33:00', 'Produk sampai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_dp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_dp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_dp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_lunas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lunas` date DEFAULT NULL,
  `status_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `pesanan_id`, `no_transaksi`, `harga_dp`, `foto_dp`, `tanggal_dp`, `total_bayar`, `lunas`, `foto_lunas`, `tanggal_lunas`, `status_transaksi`, `created_at`, `updated_at`) VALUES
(7, 7, 'TRX-66ABEC6D8E13F', '1413000', 'foto_dp/huzIkhcId09xQOwIDGjt4HWZpT5cp8cW1cR1I5BK.jpg', '2024-08-01 20:13:33', '0', '1413000', 'foto_lunas/BGCOjMDIOhEtk4ccpkJ4RfMgIkhcSoX6k6k8RI5h.jpg', '2024-08-01', 'Lunas', '2024-08-01 13:13:33', '2024-08-01 13:13:51'),
(8, 10, 'TRX-66ABED484BC4D', '1896000', 'foto_dp/JS1dvWPSd4pZcuumfhI5PGXPGjNZrbjcZBXgIshC.jpg', '2024-08-01 20:17:12', '0', '1896000', 'foto_lunas/IqfxabqkFkE3GVm9VzN5KrxyF4FvSLWSujwaf9bn.jpg', '2024-08-01', 'Lunas', '2024-08-01 13:17:12', '2024-08-01 13:18:50'),
(9, 12, 'TRX-66ABEF2707E0D', '2273500', 'foto_dp/b2FjfUwswr0JvJOllft7hJalu0DTBuWyZI2sboX0.jpg', '2024-08-01 20:25:11', '0', '2273500', 'foto_lunas/sSSq4MQ01weM6ELcs472ZdkKZ6wFPBNMIK0qBMkF.jpg', '2024-08-01', 'Lunas', '2024-08-01 13:25:11', '2024-08-01 13:25:38'),
(10, 13, 'TRX-66ABF0FC66F7D', '2409000', 'foto_dp/EpaFwwG0hCWHxCZt1UyeiwkTlEikvj6OkR6APPDc.jpg', '2024-08-01 20:33:00', '0', '2409000', 'foto_lunas/oD5AgULoadSNvIfVJOGlPOg5KfBFKH7zgzsqT2Xf.jpg', '2024-08-01', 'Lunas', '2024-08-01 13:33:00', '2024-08-01 13:33:39'),
(11, 21, 'TRX-66B0A082AEA47', '1662000', 'foto_dp/Yo79kxIb3YkrzNhIH5w3V8VIII0fJanVtLJHxWQc.jpg', '2024-08-05 09:50:58', '0', '1662000', 'foto_lunas/iyjqrzV9WsIKeWVpl8X0AGflhSH1w4N7HDsg3nrc.jpg', '2024-08-05', 'Lunas', '2024-08-05 02:50:58', '2024-08-05 02:53:19'),
(12, 16, 'TRX-66B0AD264747D', '2747000', 'foto_dp/ISACK6FaCjrWoHytNyRdT3COmrWp7pze2lfqHDto.jpg', '2024-08-05 10:44:54', '0', '2747000', 'foto_lunas/9uhrSZd7ztFDweKoZJZkQ1hJbNuCIAuhQEpYZIZd.jpg', '2024-08-05', 'Lunas', '2024-08-05 03:44:54', '2024-08-05 03:55:50'),
(13, 22, 'TRX-66B0B47897DB2', '2080000', 'foto_dp/TnnV91pBeammvJcHIHYs8FgRzguDAK5CGClIURyk.jpg', '2024-08-05 11:16:08', '0', '2080000', 'foto_lunas/Jh8fHqnAG08PXTdhYrUutjnPGm3EOe9aWLRWuG7I.jpg', '2024-08-05', 'Lunas', '2024-08-05 04:16:08', '2024-08-05 04:17:20'),
(14, 23, 'TRX-66B0B8FCAA070', '1711500', 'foto_dp/m0lhPxEuvm1e2PSGGA641qpC3gmsbzwmpJ9huSx9.jpg', '2024-08-05 11:35:24', '0', '1711500', 'foto_lunas/lVFTmlOP7Rv4Zrdqo3LmFI107kQHx6Gz25xtH6k7.jpg', '2024-08-05', 'Lunas', '2024-08-05 04:35:24', '2024-08-05 04:37:46'),
(15, 19, 'TRX-66B0BA668C34B', '1802000', 'foto_dp/MmxKj69JkhYxNy3CXuVYsLNhxLgH7JNidYLQORfv.jpg', '2024-08-05 11:41:26', '0', '1802000', 'foto_lunas/zwGI0KRuQfY7cXNExOGQk4fsuye9NcRn3WmjlXDz.jpg', '2024-08-05', 'Lunas', '2024-08-05 04:41:26', '2024-08-05 04:43:41'),
(16, 20, 'TRX-66B0BC1F5B650', '1736000', 'foto_dp/owwUBiqW1zBbBpYYvQQuATvGqqO6Ks2CzKefrVcW.jpg', '2024-08-05 11:48:47', '0', '1736000', 'foto_lunas/SDeN53NSVl43Q2SqzDoIX9OlPvznBeYUCVxWy4oH.jpg', '2024-08-05', 'Lunas', '2024-08-05 04:48:47', '2024-08-05 04:49:17'),
(18, 25, 'TRX-66B29CF7EC734', '1788000', 'foto_dp/9ScEIuCgGPmLxlaHaozfeUGTkXjXMIVPJ6zKLqQ8.jpg', '2024-08-06 22:00:23', '0', '1788000', 'foto_lunas/G5b4S7DwitN85BLE69IeroYvukyakLiqg42apmt2.jpg', '2024-08-06', 'Lunas', '2024-08-06 15:00:23', '2024-08-06 15:02:46'),
(19, 26, 'TRX-66B35901949ED', '2070000', 'foto_dp/kSGPSGiJeQcG2wm9LuWgQdV3sELHmHlbsLLW0R7j.jpg', '2024-08-07 11:22:41', '0', '2070000', 'foto_lunas/WnGdfU2Mx2oi4jWc8caNIclrv7DTrPMHg1d9iRNU.jpg', '2024-08-07', 'Lunas', '2024-08-07 04:22:41', '2024-08-07 04:24:57'),
(20, 27, 'TRX-66B35C20A9E4E', '1664000', 'foto_dp/oPql6CNCfKKSMZ4ejcDAweOYmsBdyGNlzyqm6Brg.jpg', '2024-08-07 11:36:00', '0', '1664000', 'foto_lunas/HmXauMiOLc87KCTN7SutKR38rIjvnU3ef9hvUSvT.jpg', '2024-08-07', 'Lunas', '2024-08-07 04:36:00', '2024-08-07 04:37:31'),
(21, 28, 'TRX-66B36010B1C7C', '1765000', 'foto_dp/g8jrKDMWBZrxFWEb6fB0P8MKsmozONMpmLy8xuSL.jpg', '2024-08-07 11:52:48', '0', '1765000', 'foto_lunas/HxFOIvolt28nlXZHOxljxf7OqwdIU5A8sWAWtFJA.jpg', '2024-08-07', 'Lunas', '2024-08-07 04:52:48', '2024-08-07 04:53:58'),
(22, 29, 'TRX-66B36406B30C1', '1530000', 'foto_dp/3Y9dt7kSZX7Fc1dstLLvaeEEkV7vgMlV6z5ot6kY.jpg', '2024-08-07 12:09:42', '0', '1530000', 'foto_lunas/ae9mMO62g4Puy68Q9uXyQzNAxLbrC3HInRkTAqPw.jpg', '2024-08-07', 'Lunas', '2024-08-07 05:09:42', '2024-08-07 05:13:36'),
(23, 30, 'TRX-66B436F07A112', '2361000', 'foto_dp/Ms1BrGUW1aSov6JYs7KWjaUoGn2wH4pLgy5amDRb.jpg', '2024-08-08 03:09:36', '0', '2361000', 'foto_lunas/l0YErBJBXfNRoSnbTLFOrSHaQXfSqjpo8jyDIvnC.jpg', '2024-08-08', 'Lunas', '2024-08-07 20:09:36', '2024-08-07 20:10:38'),
(25, 31, 'TRX-66B46B51E9CD7', '1945000', 'foto_dp/lBd5Dggas5iAneEcL7n36KpUnUfg1BHJT6FrIF7K.jpg', '2024-08-08 06:53:05', '0', '1945000', 'foto_lunas/8XpuJiCGF5ZZfEmSPWGAqFhtaB98g1KvW52SUmr5.jpg', '2024-08-08', 'Lunas', '2024-08-07 23:53:05', '2024-08-07 23:54:07'),
(26, 32, 'TRX-66B46FF22FD59', '1608000', 'foto_dp/NYZl6cjdD1wu3O7MukeFGbgVxonR9TSx6ZLaVzU4.jpg', '2024-08-08 07:12:50', '0', '1608000', 'foto_lunas/3cS9429FzcMyiakvErzIodFnqKk3Awbwdmf424a9.jpg', '2024-08-08', 'Lunas', '2024-08-08 00:12:50', '2024-08-08 00:14:16'),
(27, 35, 'TRX-66BBCFF528587', '1490000', 'foto_dp/d70kw9Lmha4cceUj5pkh9dOj2hb2V7wN2COl28cK.jpg', '2024-08-13 21:28:21', '0', '1490000', 'foto_lunas/dxxc7FMiI88sXtchyhCYiA3UG52kXQcTizKC2A7l.jpg', '2024-08-13', 'Lunas', '2024-08-13 14:28:21', '2024-08-13 14:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@123.com', '$2y$10$5jVB9zWn7BLcaCJBXZx0a.AkYdkLtgHmtvJQa6hbyXlY9tjcMaXhq', '085702169158', '', 'admin', '2024-07-30 23:34:18', '2024-07-30 23:34:18'),
(5, 'Supardi', 'supardi33@gmail.com', '$2y$10$qgjGZEK6ZONbeNEZZCXW4erlXKp.q6vl3MK5X8v10Jj8T33jJ/l/2', '081231470463', NULL, 'pelanggan', '2024-08-01 07:23:50', '2024-08-01 07:23:50'),
(10, 'Agus Kuncoro', 'aguskuncoro11@gmail.com', '$2y$10$5crTK2xjvTQSyX/7V3vhOeBAX.eUQOqptiJ/2tNJIvkkU1YSaylL.', '087898023617', NULL, 'pelanggan', '2024-08-01 07:42:51', '2024-08-01 07:42:51'),
(11, 'Wahyudi', 'wahyudi22@gmail.com', '$2y$10$NBEDR2.X3g2xHxjlU3djMeaLpYdZWu/xikVMuIVXQ6kLg3jGc78pu', '085273619040', NULL, 'pelanggan', '2024-08-01 07:49:06', '2024-08-01 07:49:06'),
(12, 'Budi Setyo', 'budisetyo41@gmail.com', '$2y$10$ehV5XgGkQM4q4XwN.agaB.XFxEgZ6/5zLHUulis608Yf.ouwL05k6', '0821143846635', NULL, 'pelanggan', '2024-08-01 07:52:27', '2024-08-01 07:52:27'),
(13, 'Adi Setyo', 'adisetyo46@gmail.com', '$2y$10$zA5OXsNPYFnY2kg.u1tEhePhakQP9rCbIEvWyaxihgCOiSLurF3hK', '087898023593', NULL, 'pelanggan', '2024-08-01 07:55:25', '2024-08-01 07:55:25'),
(14, 'Joko Pustoko', 'jokopustoko65@gmail.com', '$2y$10$nSHeuDnw62MgzeguCteQO.e7usuuYqyZRoPZKqkCj41X2tJMSTQ4i', '083827225158', NULL, 'pelanggan', '2024-08-01 08:00:25', '2024-08-01 08:00:25'),
(15, 'Hendro Lesmono', 'hendrolesmono14@gmail.com', '$2y$10$yZg2ukBdwWjmwjrmFb.ZYuoEA696hNJWRUHkkx2Occ4qHRPfMZ/nq', '083182663406', NULL, 'pelanggan', '2024-08-01 08:05:05', '2024-08-01 08:05:05'),
(16, 'Muhammad Suprapto', 'muhammadsuprapto15@gmail.com', '$2y$10$hYxq3uP/ZHS5u5Y2MQmgguap9Dkl2rVFZ9/YmVMVRRX8p4arSTswi', '083820380926', NULL, 'pelanggan', '2024-08-01 08:10:35', '2024-08-01 08:10:35'),
(17, 'Joko Pustoko', 'jokopustoko66@gmail.com', '$2y$10$.h/wSJdtVxGhVu0qLriNYOoe8.MN6bEpPCigEEap1K9W.iEXggbWu', '083827225158', NULL, 'pelanggan', '2024-08-01 08:25:04', '2024-08-01 08:25:04'),
(18, 'Hendro Lesmono', 'hendrolesmono15@gmail.com', '$2y$10$wgxby7KzzzzjIzB.46BFt.q3Ba9gWFUWLWItcWJdxzf4YXC0UFLhC', '083182663406', NULL, 'pelanggan', '2024-08-01 08:28:36', '2024-08-01 08:28:36'),
(19, 'Sutrisno', 'sutrisno70@gmail.com', '$2y$10$fVIUFgQzac/xhNZjdn2Aq.E.RzyPLdUYjwxFyeDITx2w6EGDswADm', '083848631120', NULL, 'pelanggan', '2024-08-01 08:32:07', '2024-08-01 08:32:07'),
(20, 'Restu Aji', 'restuaji11@gmail.com', '$2y$10$8JecUPIzM2wkSqinY4nzFugk2UYTG5QWEv4mHpEBYZSNXIzV7mr22', '083141313174', NULL, 'pelanggan', '2024-08-01 08:37:03', '2024-08-01 08:37:03'),
(21, 'Supriadi', 'supriadi10@gmail.com', '$2y$10$2qJHb5yAHiKfvvsrfh0ci.GgEXSkSBeTbRPgaKbnH851QeO0Ad0fS', '085273619040', NULL, 'pelanggan', '2024-08-01 13:28:46', '2024-08-01 13:28:46'),
(22, 'Agung Sanjaya', 'agungSanjaya64@gmail.com', '$2y$10$0UJpYcH0jHyG//RoJ6PRiORrTOw3JWf6b48CuWcHaMxyc/lUlmm2C', '081864024586', NULL, 'pelanggan', '2024-08-06 13:20:46', '2024-08-06 13:20:46'),
(23, 'Acep Iskandar', 'acepiskandar55@gmail.com', '$2y$10$efcp2QHhz6es8LinmH9mruDzJ021ftLB2BB1khbAvfP5TXz2dmblW', '0821226975425', NULL, 'pelanggan', '2024-08-07 03:49:48', '2024-08-07 03:49:48'),
(24, 'Mulyadi', 'mulyadi24@gmail.com', '$2y$10$VSLiiV7RcHsAQpeQaZydW./a64Y34Z2bk2dEFaC3L2he43OkmEDoC', '0821083153064', NULL, 'pelanggan', '2024-08-07 04:27:22', '2024-08-07 04:27:22'),
(25, 'Mujiono', 'mujiono37@gmail.com', '$2y$10$LKgxQ5pTsjgdBClddXARbuq5l9hK5GA1aeRiF7dKh28tmC4A8A3ce', '0852834266942', NULL, 'pelanggan', '2024-08-07 04:48:25', '2024-08-07 04:48:25'),
(26, 'Heri Budiman', 'heribudiman34@gmail.com', '$2y$10$pSV8ZTBbiDvlbaFoMUsWtOQhtx7jg.JpK9QGh02/RFDZ/ZglAZ0kK', '085215408846', NULL, 'pelanggan', '2024-08-07 04:58:03', '2024-08-07 04:58:03'),
(27, 'Ibnu Salim', 'ibnusalim77@gmail.com', '$2y$10$T9DHqXaU6Hd6wvOuGLrLuuSmYM2vcXVgT8jIteDFxLXGi9jk0qjVu', '083863104703', NULL, 'pelanggan', '2024-08-07 19:30:17', '2024-08-07 19:30:17'),
(28, 'Dadang Nur', 'dadangnur62@gmail.com', '$2y$10$mQzH8msO4r7wp24jC2t/DO12fWnUAwchhwTuQSNSM9JTh2Zr.vGGO', '085933825322', NULL, 'pelanggan', '2024-08-07 23:24:36', '2024-08-07 23:24:36'),
(29, 'Suripto', 'suripto371@gmail.com', '$2y$10$9.OTg0Zzw/VH1mlKcrqXSel.aBYWxw08IHfIvmm7YMZan8OSOmDwq', '089784768908', NULL, 'pelanggan', '2024-08-08 00:06:35', '2024-08-08 00:06:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventoris`
--
ALTER TABLE `inventoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventoris_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkirs`
--
ALTER TABLE `ongkirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanans_user_id_foreign` (`user_id`),
  ADD KEY `pesanans_product_id_foreign` (`product_id`),
  ADD KEY `pesanans_ongkir_id_foreign` (`ongkir_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_produks`
--
ALTER TABLE `return_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_produks_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoris`
--
ALTER TABLE `inventoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ongkirs`
--
ALTER TABLE `ongkirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `return_produks`
--
ALTER TABLE `return_produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventoris`
--
ALTER TABLE `inventoris`
  ADD CONSTRAINT `inventoris_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_ongkir_id_foreign` FOREIGN KEY (`ongkir_id`) REFERENCES `ongkirs` (`id`),
  ADD CONSTRAINT `pesanans_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `return_produks`
--
ALTER TABLE `return_produks`
  ADD CONSTRAINT `return_produks_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transaksis` (`id`);

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
