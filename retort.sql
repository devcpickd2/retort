-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 11:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retort`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemens`
--

CREATE TABLE `departemens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemens`
--

INSERT INTO `departemens` (`id`, `uuid`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'a5544f26-ee76-4012-afa8-eaa40c1c4656', 'Quality Control', '2025-08-25 03:00:49', '2025-09-24 04:08:01'),
(2, 'ca394a66-bd78-4f06-935f-8513ff4cfc9d', 'Produksi', '2025-08-25 03:00:59', '2025-08-25 03:00:59'),
(3, '9919bfc8-bbb5-4f91-a3e8-983630694417', 'Engineering', '2025-08-25 03:01:04', '2025-08-25 03:01:04'),
(4, '2e8f0bae-d598-48b9-b4d4-03e65be9a1c6', 'Warehouse', '2025-08-25 03:01:10', '2025-08-25 03:01:10');

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
-- Table structure for table `gmps`
--

CREATE TABLE `gmps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `mp_chamber` longtext DEFAULT NULL,
  `karantina_packing` longtext DEFAULT NULL,
  `filling_susun` longtext DEFAULT NULL,
  `sampling_fg` longtext DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gmps`
--

INSERT INTO `gmps` (`id`, `uuid`, `date`, `username`, `plant`, `username_updated`, `mp_chamber`, `karantina_packing`, `filling_susun`, `sampling_fg`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(13, '0199dce5-714a-70aa-92f3-a3f9cccfa40d', '2025-10-13', 'admin', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'admin', '[]', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"1\",\"masker\":\"1\",\"ciput\":\"1\",\"parfum\":\"0\"}]', '[]', '[]', 'Foreman Produksi', '1', '2025-10-13 10:29:59', NULL, '0', NULL, NULL, '2025-10-13 09:27:28', '2025-10-13 09:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `kebersihan_ruangs`
--

CREATE TABLE `kebersihan_ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `pukul` time DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `rice_boiling` longtext DEFAULT NULL,
  `noodle` longtext DEFAULT NULL,
  `cr_rm` longtext DEFAULT NULL,
  `cs_1` longtext DEFAULT NULL,
  `cs_2` longtext DEFAULT NULL,
  `seasoning` longtext DEFAULT NULL,
  `prep_room` longtext DEFAULT NULL,
  `cooking` longtext DEFAULT NULL,
  `filling` longtext DEFAULT NULL,
  `topping` longtext DEFAULT NULL,
  `packing` longtext DEFAULT NULL,
  `iqf` longtext DEFAULT NULL,
  `cs_fg` longtext DEFAULT NULL,
  `ds` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kebersihan_ruangs`
--

INSERT INTO `kebersihan_ruangs` (`id`, `uuid`, `date`, `username`, `username_updated`, `pukul`, `shift`, `rice_boiling`, `noodle`, `cr_rm`, `cs_1`, `cs_2`, `seasoning`, `prep_room`, `cooking`, `filling`, `topping`, `packing`, `iqf`, `cs_fg`, `ds`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(14, '01999434-52e2-730c-975c-190953b78d2f', '2025-09-29', 'tarissah.januarti', 'tarissah.januarti', NULL, '1', '{\"jam\":\"13:41\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '[{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Alco Cooking Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Tilting Kettle\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Exhaust\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Stir Fryer (Provisur)\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Steamer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Bowl Cutter\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}]', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":\"genangan air\",\"tindakan\":\"dilakukan cleaning\"},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"kondisi\":\"Bersih\",\"masalah\":\"-\",\"tindakan\":\"-\"},\"1\":{\"lokasi\":\"Dinding Dalam\",\"kondisi\":\"Bersih\",\"masalah\":\"-\",\"tindakan\":\"-\"},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"kondisi\":\"Bersih\",\"masalah\":\"-\",\"tindakan\":\"-\"},\"3\":{\"lokasi\":\"Conveyor IQF\",\"kondisi\":\"Bersih\",\"masalah\":\"-\",\"tindakan\":\"-\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', 'ok', 'Khoerunnisa', '1', '2025-09-29 07:46:41', 'admin', '1', NULL, NULL, '2025-09-29 06:41:21', '2025-10-03 10:53:24'),
(15, '01999890-14c1-7180-a180-0223e1771abe', '2025-09-30', 'tarissah.januarti', NULL, NULL, '1', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"kondisi\":\"Bersih\"},\"11\":{\"kondisi\":\"Bersih\"},\"12\":{\"kondisi\":\"Bersih\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Alco Cooking Mixer\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Tilting Kettle\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Exhaust\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Stir Fryer (Provisur)\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Steamer\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Bowl Cutter\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"9\":{\"lokasi\":\"Sealer 1\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"10\":{\"lokasi\":\"Sealer 2\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"11\":{\"lokasi\":\"Filler Manual 1\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"},\"12\":{\"lokasi\":\"Filler Manual 2\",\"masalah\":null,\"tindakan\":\"dilakukan cleaning\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Khoerunnisa', '1', '2025-09-30 04:00:03', NULL, '1', NULL, NULL, '2025-09-30 03:00:03', '2025-10-02 04:15:54'),
(16, '01999b45-ed96-73a1-88c1-2232cdfbb556', '2025-09-30', 'agung.martono', NULL, NULL, '2', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Basah\",\"masalah\":\"Basah, tumpahan nasi\",\"tindakan\":\"Di cleaninv\"},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Sisa produksi\",\"masalah\":\"Sisa nasi dan beras\",\"tindakan\":\"Di cleaning\"},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Sisa produksi\",\"masalah\":\"Sisa cucian beras\",\"tindakan\":\"Di cleaning\"},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Noda seperti tinta, karat, kerak\",\"masalah\":\"Kerak kompor\",\"tindakan\":\"Dibersihkan\"},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Noda seperti tinta, karat, kerak\",\"masalah\":\"Sisa mie dan nasi\",\"tindakan\":\"Di bersihkan\"},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Sisa produksi\",\"masalah\":\"Sisa mie\",\"tindakan\":\"Di cleaning\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"kondisi\":\"Bersih\"},\"11\":{\"kondisi\":\"Bersih\"},\"12\":{\"kondisi\":\"Bersih\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Alco Cooking Mixer\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Tilting Kettle\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Exhaust\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Stir Fryer (Provisur)\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Steamer\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Bowl Cutter\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Ardillah Jaelani', '1', '2025-09-30 16:37:55', NULL, '0', NULL, NULL, '2025-09-30 15:37:55', '2025-09-30 15:37:55'),
(17, '0199b592-5387-73e3-baff-5e473eaee016', '2025-10-06', 'tarissah.januarti', NULL, NULL, '3', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"kondisi\":\"Bersih\"},\"11\":{\"kondisi\":\"Bersih\"},\"12\":{\"kondisi\":\"Bersih\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Alco Cooking Mixer\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Tilting Kettle\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Exhaust\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Stir Fryer (Provisur)\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Steamer\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Bowl Cutter\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Khoerunnisa', '1', '2025-10-05 19:11:29', NULL, '0', NULL, NULL, '2025-10-05 18:11:29', '2025-10-05 18:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `mesins`
--

CREATE TABLE `mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesins`
--

INSERT INTO `mesins` (`id`, `uuid`, `username`, `nama_mesin`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'afa3ce9a-7946-495d-823a-0ca2e3bfdefa', 'admin', 'ZAP 6', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-10-14 08:28:38', '2025-10-14 08:28:38'),
(2, '5ec0c2d4-776a-40e9-9c23-eaa84ac0e45a', 'admin', 'ZAP 7', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-10-14 08:28:45', '2025-10-14 08:28:45'),
(3, 'adf6daa7-e80a-4dfb-877a-77d4a5654470', 'admin', 'ZAP 9', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-10-14 08:37:21', '2025-10-14 08:39:19');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_14_023149_create_produk_table', 1),
(6, '2025_07_14_023447_create_produks_table', 1),
(7, '2025_07_14_031844_create_suhus_table', 1),
(8, '2025_07_14_042251_create_departemens_table', 1),
(9, '2025_08_25_071729_ad_uuid_to_departemens_table', 1),
(10, '2025_08_25_075937_add_uuid_to_users_table', 1),
(11, '2025_08_25_081500_add_uuid_to_produks_table', 1),
(12, '2025_08_25_084114_add_extra_fields_to_users_table', 1),
(13, '2025_08_25_085022_update_users_table_add_constraints', 1),
(14, '2025_08_25_095513_create_plants_table', 2),
(15, '2025_08_28_072233_create_sanitasis_table', 3),
(16, '2025_08_29_102622_create_kebersihan_ruang_table', 4),
(17, '2025_08_29_103447_create_kebersihan_ruangs_table', 5),
(18, '2025_08_30_111605_create_produksi_table', 6),
(19, '2025_08_30_112224_create_produksis_table', 7),
(20, '2025_08_30_112807_create_produksis_table', 8),
(21, '2025_08_30_120005_create_gmps_table', 9),
(22, '2025_09_01_100630_create_premixs_table', 10),
(23, '2025_09_01_105103_create_institusis_table', 11),
(24, '2025_09_01_114259_create_timbangans_table', 12),
(25, '2025_09_01_143741_create_thermometers_table', 13),
(26, '2025_09_01_153325_create_sortasis_table', 14),
(27, '2025_09_01_161515_create_thawings_table', 15),
(28, '2025_09_02_091935_create_yoshinoyas_table', 16),
(29, '2025_09_02_140326_create_steamers_table', 17),
(30, '2025_09_03_084935_create_rices_table', 18),
(31, '2025_09_04_094224_create_thumblings_table', 19),
(32, '2025_09_04_095055_create_thumblings_table', 20),
(33, '2025_09_08_100642_create_noodles_table', 21),
(34, '2025_09_09_134524_create_cookings_table', 22),
(35, '2025_09_10_102623_create_kontaminasis_table', 23),
(36, '2025_09_10_134110_create_xrays_table', 24),
(37, '2025_09_12_150556_create_metals_table', 25),
(38, '2025_09_12_154311_create_metals_table', 26),
(39, '2025_09_13_130520_create_tahapans_table', 27),
(40, '2025_09_15_144645_create_gramasis_table', 28),
(41, '2025_09_16_132110_create_iqfs_table', 29),
(42, '2025_09_17_100357_create_pengemasans_table', 30),
(43, '2025_09_17_173641_create_mesins_table', 31),
(44, '2025_09_18_135911_create_disposisis_table', 32),
(45, '2025_09_18_150154_create_repacks_table', 33),
(46, '2025_09_18_165145_create_falses_table', 34),
(47, '2025_09_18_165630_create_rejects_table', 35),
(48, '2025_09_19_161155_create_pemusnahans_table', 36),
(49, '2025_09_22_085716_create_verifikasi_sanitasis_table', 37),
(50, '2025_09_22_094559_create_returs_table', 38),
(51, '2025_09_22_105704_create_retains_table', 39),
(52, '2025_09_22_133145_create_sample_bulanans_table', 40),
(53, '2025_09_23_092317_create_cold_storages_table', 41),
(54, '2025_09_23_143701_create_sample_retains_table', 42),
(55, '2025_09_23_155521_create_submissions_table', 43),
(56, '2025_09_24_093658_add_activation_to_users_table', 44),
(57, '2025_09_24_094000_add_updater_to_users_table', 45),
(58, '2025_10_13_165151_create_pvdcs_table', 46),
(59, '2025_10_14_152055_create_mesins_table', 47);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `uuid`, `username`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'fdaca613-7ab2-4997-8f33-686e886c867d', 'putri', 'Cikande 2', '2025-08-27 01:54:32', '2025-09-24 03:57:58'),
(3, '2debd595-89c4-4a7e-bf94-e623cc220ca6', NULL, 'Berbek', '2025-10-08 02:26:57', '2025-10-08 02:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `uuid`, `nama_produk`, `plant`, `username`, `created_at`, `updated_at`) VALUES
(50, '9e922a5f-680c-4278-8ed9-c5c25a16a7ee', 'SROA Ayam Bakar', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'admin', '2025-10-14 06:49:27', '2025-10-14 06:49:27'),
(51, '0ef5e867-ca6a-428b-b058-a3d067ec8a7a', 'SRCH Ayam Original', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'admin', '2025-10-14 06:50:22', '2025-10-14 06:50:22'),
(52, '000f08f0-f90d-4982-9237-844991737099', 'BRCH Beef BBQ', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'admin', '2025-10-14 06:54:50', '2025-10-14 06:54:50'),
(53, '8e4feafa-6719-494b-83f4-a9d2957b1553', 'SRCO Otak-Otak', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'admin', '2025-10-14 06:58:32', '2025-10-14 07:00:07'),
(54, '6792676a-c07c-445b-ba8e-330eb9865299', 'Champ Chicken Sausage Original Siap Santap', '2debd595-89c4-4a7e-bf94-e623cc220ca6', 'admin2', '2025-10-14 09:09:07', '2025-10-14 09:09:07'),
(55, '3a6d0fe8-9643-449c-87bc-7c40fd46ff79', 'Champ Beef BBQ Sausage Siap Santap', '2debd595-89c4-4a7e-bf94-e623cc220ca6', 'admin2', '2025-10-14 09:09:34', '2025-10-14 09:09:34'),
(56, '16c17f4f-da50-4513-80cc-47925fac9756', 'Champ Sosis Siap Santap Sosis Daging Ayam Kombinasi Rasa Otak-Otak', '2debd595-89c4-4a7e-bf94-e623cc220ca6', 'admin2', '2025-10-14 09:11:02', '2025-10-14 09:11:02'),
(57, '458c5b13-3215-4922-9aaf-51f30e84f2fd', 'Okey Sosis Siap Santap Sosis Ayam Kombinasi Rasa Ayam Bakar', '2debd595-89c4-4a7e-bf94-e623cc220ca6', 'admin2', '2025-10-14 09:12:52', '2025-10-14 09:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `produksis`
--

CREATE TABLE `produksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produksis`
--

INSERT INTO `produksis` (`id`, `uuid`, `plant`, `nama_karyawan`, `area`, `created_at`, `updated_at`) VALUES
(85, '837a5661-fd6f-4f5c-9d1d-8bff5b7393e2', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'Ardillah Jaelani', 'KARANTINA - PACKING', '2025-10-13 08:44:29', '2025-10-13 08:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `pvdcs`
--

CREATE TABLE `pvdcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `tgl_kedatangan` date NOT NULL,
  `tgl_expired` date NOT NULL,
  `data_pvdc` longtext NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pvdcs`
--

INSERT INTO `pvdcs` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `tgl_kedatangan`, `tgl_expired`, `data_pvdc`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '0199e1f1-a22c-70bd-91ae-60f54a569605', 'admin', 'admin', '2025-10-22', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SROA Ayam Bakar', '2025-11-02', '2025-10-25', '\"[{\\\"mesin\\\":\\\"ZAP 7\\\",\\\"detail\\\":{\\\"0\\\":{\\\"batch\\\":\\\"asf\\\",\\\"no_lot\\\":\\\"12\\\",\\\"waktu\\\":\\\"19:58\\\"},\\\"2\\\":{\\\"batch\\\":\\\"asf\\\",\\\"no_lot\\\":\\\"124\\\",\\\"waktu\\\":\\\"19:58\\\"},\\\"1\\\":{\\\"batch\\\":\\\"szaf\\\",\\\"no_lot\\\":\\\"145\\\",\\\"waktu\\\":\\\"18:58\\\"},\\\"3\\\":{\\\"batch\\\":\\\"asfa\\\",\\\"no_lot\\\":\\\"124\\\",\\\"waktu\\\":\\\"12:24\\\"}}},{\\\"mesin\\\":\\\"ZAP 6\\\",\\\"detail\\\":[{\\\"batch\\\":\\\"afs\\\",\\\"no_lot\\\":\\\"241\\\",\\\"waktu\\\":\\\"19:58\\\"},{\\\"batch\\\":\\\"asdfa\\\",\\\"no_lot\\\":\\\"142\\\",\\\"waktu\\\":\\\"21:58\\\"},{\\\"batch\\\":\\\"safd\\\",\\\"no_lot\\\":\\\"3242\\\",\\\"waktu\\\":\\\"19:18\\\"}]}]\"', 'sdgsgfs', 'admin', '1', NULL, NULL, '2025-10-14 08:58:53', '2025-10-14 09:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `sanitasis`
--

CREATE TABLE `sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `std_footbasin` varchar(255) NOT NULL,
  `std_handbasin` varchar(255) NOT NULL,
  `aktual_footbasin` varchar(255) DEFAULT NULL,
  `aktual_handbasin` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tindakan_koreksi` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanitasis`
--

INSERT INTO `sanitasis` (`id`, `uuid`, `date`, `username`, `username_updated`, `pukul`, `shift`, `std_footbasin`, `std_handbasin`, `aktual_footbasin`, `aktual_handbasin`, `keterangan`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(13, '0199b77c-5754-7340-923e-62138c1fd971', '2025-10-06', 'admin', NULL, '10:04:00', '1', '200', '50', 'uploads/footbasin/Ep1imeoOUDideaS1S6a78wE4MmLjWvKpQbFt3Obm.jpg', 'uploads/handbasin/dfYcwKMgVsiwK7bv9SsXt6F4Z2DCvaiuLwnsLf1T.jpg', NULL, NULL, NULL, 'Khoerunnisa', '1', '2025-10-06 04:06:43', NULL, '0', NULL, '2025-10-06 03:06:43', '2025-10-06 03:06:43', '2025-10-06 03:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `suhus`
--

CREATE TABLE `suhus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `chillroom` float DEFAULT NULL,
  `cs_1` float DEFAULT NULL,
  `cs_2` float DEFAULT NULL,
  `anteroom_rm` float DEFAULT NULL,
  `seasoning_suhu` float DEFAULT NULL,
  `seasoning_rh` float DEFAULT NULL,
  `prep_room` float DEFAULT NULL,
  `cooking` float DEFAULT NULL,
  `filling` float DEFAULT NULL,
  `rice` float DEFAULT NULL,
  `noodle` float DEFAULT NULL,
  `topping` float DEFAULT NULL,
  `packing` float DEFAULT NULL,
  `ds_suhu` float DEFAULT NULL,
  `ds_rh` float DEFAULT NULL,
  `cs_fg` float DEFAULT NULL,
  `anteroom_fg` float DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `catatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suhus`
--

INSERT INTO `suhus` (`id`, `uuid`, `username`, `username_updated`, `date`, `pukul`, `shift`, `chillroom`, `cs_1`, `cs_2`, `anteroom_rm`, `seasoning_suhu`, `seasoning_rh`, `prep_room`, `cooking`, `filling`, `rice`, `noodle`, `topping`, `packing`, `ds_suhu`, `ds_rh`, `cs_fg`, `anteroom_fg`, `keterangan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `catatan_spv`, `status_spv`, `tgl_update_spv`, `catatan`, `created_at`, `updated_at`) VALUES
(11, '0199942d-36d4-72e8-ac10-da4e88eaa637', 'admin', 'admin', '2025-09-29', '13:00:00', '1', 2, -20, -20, 9, 22, 75, 10, 30, 10, 20, 23, 10, NULL, 30, 75, -20, 10, 'ok', 'Khoerunnisa', '1', '2025-10-03 08:28:33', 'admin', NULL, '1', '2025-10-03 08:28:33', '-', '2025-09-29 06:33:35', '2025-10-03 08:28:33'),
(12, '0199943b-3abd-71e9-9f75-2aac7105b130', 'tarissah.januarti', 'admin', '2025-09-29', '14:00:00', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.2, NULL, NULL, 12, 9.9, NULL, NULL, NULL, NULL, NULL, 'Khoerunnisa', '1', '2025-10-03 08:28:41', 'admin', NULL, '1', '2025-10-03 08:28:41', NULL, '2025-09-29 06:48:53', '2025-10-03 08:28:41'),
(14, '019994e4-0685-7076-97ab-39553beac580', 'agung.martono', 'agung.martono', '2025-09-29', '16:00:00', '2', 4.6, -19, -20, 10.8, 24.9, 98.9, 10, 26.8, 11.5, 20.3, 20.5, 10.5, 10.1, 26, 88, -18.1, 18.9, NULL, 'Ardillah Jaelani', '1', '2025-10-03 08:29:02', 'admin', NULL, '1', '2025-10-03 08:29:02', NULL, '2025-09-29 09:53:15', '2025-10-03 08:29:02'),
(15, '019994ed-da6f-71c4-8315-27305bc84874', 'agung.martono', 'agung.martono', '2025-09-29', '17:00:00', '2', 2.6, -18.8, -19.9, 12, 25, 90.5, 8.8, 24.7, 11.4, 18.5, 24, 10.8, 9.8, 25.8, 87.5, -18.9, 19, NULL, 'Ardillah Jaelani', '1', '2025-10-03 08:29:09', 'admin', NULL, '1', '2025-10-03 08:29:09', NULL, '2025-09-29 10:03:59', '2025-10-03 08:29:09'),
(16, '0199973a-e89a-7198-aa3e-7c954befc9f7', 'fadillah.sari', 'fadillah.sari', '2025-09-30', '00:00:00', '3', 4, -20.8, -21.4, 9.7, 23.2, 90.8, 10.2, 26.1, 10, 16.2, 20.2, 10.6, 11.9, 25.2, 88.4, -17.8, 19.2, NULL, 'Suntaro', '1', '2025-09-29 23:40:46', NULL, NULL, '0', '2025-09-29 22:40:46', NULL, '2025-09-29 20:47:24', '2025-09-29 22:40:46'),
(17, '019997a0-449f-708a-b61d-cbadbcedc232', 'fadillah.sari', 'fadillah.sari', '2025-09-30', '01:00:00', '3', 4, -20.2, -21.5, 9.8, 23.7, 90.5, 10.4, 26.8, 10.4, 16.5, 19.1, 10.1, 11.5, 25.8, 88.1, -17.5, 17.2, NULL, 'Suntaro', '1', '2025-09-29 23:41:19', NULL, NULL, '0', '2025-09-29 22:41:19', NULL, '2025-09-29 22:38:07', '2025-09-29 22:41:19'),
(18, '019997a2-4bc2-70ee-97db-2f0ad3b9bccc', 'fadillah.sari', NULL, '2025-09-30', '02:00:00', '3', 3.8, -20.4, -21, 10.1, 23.9, 91.2, 9.8, 26.2, 10.4, 16.9, 19.5, 10.3, 10.4, 24.7, 88, -18.1, 17.5, NULL, 'Suntaro', '1', '2025-09-29 23:40:19', NULL, NULL, '0', '2025-09-29 22:40:19', NULL, '2025-09-29 22:40:19', '2025-09-29 22:40:19'),
(19, '019997a4-a87b-7141-bf4e-5c3a72c9f455', 'fadillah.sari', NULL, '2025-09-30', '03:00:00', '3', 3.8, -20.8, -21.2, 10.6, 24.5, 91.6, 9.5, 26.5, 11.8, 17.1, 19.8, 10.4, 10.2, 24.1, 88.3, -18.8, 17.5, NULL, 'Suntaro', '1', '2025-09-29 23:42:54', NULL, NULL, '0', '2025-09-29 22:42:54', NULL, '2025-09-29 22:42:54', '2025-09-29 22:42:54'),
(20, '019997a6-8452-73be-b535-909a3bca1a11', 'fadillah.sari', NULL, '2025-09-30', '04:00:00', '3', 3.9, -21, -21.8, 10.2, 24.1, 91.9, 9.7, 26.5, 11.2, 17, 20.4, 11, 10.6, 24.6, 88.9, -18.4, 17.1, NULL, 'Suntaro', '1', '2025-09-29 23:44:56', NULL, NULL, '0', '2025-09-29 22:44:56', NULL, '2025-09-29 22:44:56', '2025-09-29 22:44:56'),
(21, '019997a8-089a-7077-af8c-66536b3048f2', 'fadillah.sari', NULL, '2025-09-30', '05:00:00', '3', 3.7, -21.5, -21.3, 10.1, 24.4, 91.8, 10, 27.8, 11.6, 16.5, 20.1, 10.8, 10.1, 25.8, 89.7, -18.3, 18.3, NULL, 'Suntaro', '1', '2025-09-29 23:46:35', NULL, NULL, '0', '2025-09-29 22:46:35', NULL, '2025-09-29 22:46:35', '2025-09-29 22:46:35'),
(22, '019997a9-45ca-70fc-9d2d-b4a96266d817', 'fadillah.sari', NULL, '2025-09-30', '06:00:00', '3', 3.6, -21.3, -21, 10.6, 24.6, 92, 10.2, 27, 12.1, 16.7, 19.8, 10.2, 9.8, 25.9, 89.5, -17.9, 18.6, NULL, 'Suntaro', '1', '2025-09-29 23:47:57', NULL, NULL, '0', '2025-09-29 22:47:57', NULL, '2025-09-29 22:47:57', '2025-09-29 22:47:57'),
(23, '019997aa-af94-7003-bb48-3b52322659a0', 'fadillah.sari', NULL, '2025-09-30', '07:00:00', '3', 3, -21.4, -21.4, 10.1, 24.5, 92.7, 9.9, 25.1, 12, 16.6, 19.6, 10.4, 9.7, 26.4, 89.3, -17.5, 18.1, NULL, 'Suntaro', '1', '2025-09-29 23:49:29', NULL, NULL, '0', '2025-09-29 22:49:29', NULL, '2025-09-29 22:49:29', '2025-09-29 22:49:29'),
(24, '019997db-cee5-700b-9768-b6596d061bd5', 'fadillah.sari', NULL, '2025-09-30', '08:00:00', '3', 3.5, -21, -21, 9.9, 24.1, 92.5, 9.5, 25.9, 11.9, 16.3, 19.9, 10.1, 9.9, 26, 89.1, -18, 18.7, NULL, 'Suntaro', '1', '2025-09-30 00:43:09', NULL, NULL, '0', '2025-09-29 23:43:09', NULL, '2025-09-29 23:43:09', '2025-09-29 23:43:09'),
(25, '0199986a-8286-7103-adcf-c6b32ab2a6a7', 'tarissah.januarti', NULL, '2025-09-30', '09:00:00', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, 10.5, 9.8, 26.3, 89.5, -18, 18.5, NULL, 'Khoerunnisa', '1', '2025-09-30 03:19:01', NULL, NULL, '0', '2025-09-30 02:19:01', NULL, '2025-09-30 02:19:01', '2025-09-30 02:19:01'),
(26, '019998a7-fe3d-70d2-8d4f-a937948fcd60', 'tarissah.januarti', NULL, '2025-09-30', '10:00:00', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.6, 16.8, NULL, 11.8, 11, 26.3, 89.4, -18.2, 18, NULL, 'Khoerunnisa', '1', '2025-09-30 04:26:10', NULL, NULL, '0', '2025-09-30 03:26:10', NULL, '2025-09-30 03:26:10', '2025-09-30 03:26:10'),
(27, '01999a3f-5ef8-7344-a262-25665ffe7490', 'agung.martono', NULL, '2025-09-30', '16:00:00', '2', 6.4, -19.3, -20.2, 16.1, 26.1, 91.7, 8, 28.2, 12.8, 26.5, 21.5, 12, 9.1, 25.9, 83.5, -18, 20.8, NULL, 'Ardillah Jaelani', '1', '2025-09-30 11:51:08', NULL, NULL, '0', '2025-09-30 10:51:08', NULL, '2025-09-30 10:51:08', '2025-09-30 10:51:08'),
(28, '01999a41-ad9d-709b-af9a-3d02fcee1dc6', 'agung.martono', NULL, '2025-09-30', '17:00:00', '2', 4.4, -18.8, -19.7, 16.5, 26.4, 92, 8.8, 27.5, 12.3, 27.5, 20.8, 12, 10.1, 25.5, 86.2, -17.5, 20.5, NULL, 'Ardillah Jaelani', '1', '2025-09-30 11:53:39', NULL, NULL, '0', '2025-09-30 10:53:39', NULL, '2025-09-30 10:53:39', '2025-09-30 10:53:39'),
(29, '01999acd-2285-70ed-a539-b7cd5f15d2c7', 'agung.martono', 'agung.martono', '2025-09-30', '18:00:00', '2', 2.9, -20, -18.8, 16, 26.5, 92.2, 9.2, 28.2, 12.8, 26.4, 20.2, 11.7, 7.2, 25.4, 87.9, -16.8, 20.4, 'fg defroze', 'Ardillah Jaelani', '1', '2025-09-30 14:27:29', NULL, NULL, '0', '2025-09-30 13:27:29', NULL, '2025-09-30 13:25:59', '2025-09-30 13:27:29'),
(30, '01999acd-2392-715f-bc2c-5f051d90a1ea', 'agung.martono', NULL, '2025-09-30', '18:00:00', '2', 2.9, -20, -18.8, 16, 26.5, 92.2, 9.2, 28.2, NULL, 28.2, 20.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ardillah Jaelani', '1', '2025-09-30 14:25:59', NULL, NULL, '0', '2025-09-30 13:25:59', NULL, '2025-09-30 13:25:59', '2025-09-30 13:25:59'),
(31, '01999acd-25f4-727b-b66a-dc3f7b6efe90', 'agung.martono', NULL, '2025-09-30', '18:00:00', '2', 2.9, -20, -18.8, 16, 26.5, 92.2, 9.2, 28.2, NULL, 28.2, 20.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ardillah Jaelani', '1', '2025-09-30 14:25:59', NULL, NULL, '0', '2025-09-30 13:25:59', NULL, '2025-09-30 13:25:59', '2025-09-30 13:25:59'),
(32, '01999acd-2747-70fd-a4a9-01770c3deef0', 'agung.martono', NULL, '2025-09-30', '18:00:00', '2', 2.9, -20, -18.8, 16, 26.5, 92.2, 9.2, 28.2, NULL, 28.2, 20.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ardillah Jaelani', '1', '2025-09-30 14:26:00', NULL, NULL, '0', '2025-09-30 13:26:00', NULL, '2025-09-30 13:26:00', '2025-09-30 13:26:00'),
(33, '01999ad0-8ad1-7039-8537-a01a7c866161', 'agung.martono', NULL, '2025-09-30', '19:00:00', '2', 2.6, -19.8, -20.5, 15.2, 26.4, 93.7, 9, 30.8, 12, 26, 20.5, 11, 7.2, 25.2, 88.1, -18.5, 20, NULL, 'Ardillah Jaelani', '1', '2025-09-30 14:29:42', NULL, NULL, '0', '2025-09-30 13:29:42', NULL, '2025-09-30 13:29:42', '2025-09-30 13:29:42'),
(34, '01999ad2-4074-713f-8d6a-843d448f21fc', 'agung.martono', NULL, '2025-09-30', '20:00:00', '2', 2.2, -19.4, -19.8, 15, 26.2, 94.9, 9.2, 27.1, 11.5, 26.5, 20.4, 10.5, 8.6, 24.8, 88.5, -18.5, 19.8, NULL, 'Ardillah Jaelani', '1', '2025-09-30 14:31:34', NULL, NULL, '0', '2025-09-30 13:31:34', NULL, '2025-09-30 13:31:34', '2025-09-30 13:31:34'),
(35, '01999b3d-7fac-7310-872d-cce05d4de4cc', 'agung.martono', NULL, '2025-09-30', '21:00:00', '2', 3, -18.8, -18.6, 14.5, 26, 95, 10.5, 24.9, 11.4, 25.8, 20, 9.8, 8, 24.1, 87.1, -18, 19.6, NULL, 'Ardillah Jaelani', '1', '2025-09-30 16:28:42', NULL, NULL, '0', '2025-09-30 15:28:42', NULL, '2025-09-30 15:28:42', '2025-09-30 15:28:42'),
(36, '01999b43-a423-7363-af8f-e316da150240', 'agung.martono', NULL, '2025-09-30', '22:00:00', '2', 3.3, -19.9, -20, 13.8, 24.5, 93.1, 10, 27, 12.9, 24.5, 20.5, 10, 7.4, 24.2, 87, -18.3, 20, NULL, 'Ardillah Jaelani', '1', '2025-09-30 16:35:25', NULL, NULL, '0', '2025-09-30 15:35:25', NULL, '2025-09-30 15:35:25', '2025-09-30 15:35:25'),
(37, '01999c28-2664-729e-afef-7c432d865633', 'fadillah.sari', NULL, '2025-10-01', '00:00:00', '3', 3.7, -20.5, -21.4, 9.6, 24.9, 99.8, 10.2, 26.1, 11.5, 16.2, 20.8, 10, 12.2, 24.6, 88.2, -17.6, 17.9, NULL, 'Suntaro', '1', '2025-09-30 20:45:01', NULL, NULL, '0', '2025-09-30 19:45:01', NULL, '2025-09-30 19:45:01', '2025-09-30 19:45:01'),
(38, '01999c29-9629-7231-9202-964e4c1ebf24', 'fadillah.sari', NULL, '2025-10-01', '01:00:00', '3', 3.4, -20.8, -21, 10.1, 25.2, 99.9, 10.4, 26.7, 11.8, 16.6, 20.2, 9.6, 11.5, 25, 87.1, -17.5, 17.3, NULL, 'Suntaro', '1', '2025-09-30 20:46:35', NULL, NULL, '0', '2025-09-30 19:46:35', NULL, '2025-09-30 19:46:35', '2025-09-30 19:46:35'),
(39, '01999c2a-ed37-705e-acf6-844aec2a53ab', 'fadillah.sari', NULL, '2025-10-01', '02:00:00', '3', 3.5, -20.4, -21.5, 9.9, 25, 99.9, 10, 26.5, 11, 16.1, 20.1, 10, 10, 25.1, 87.5, -18.1, 17.1, NULL, 'Suntaro', '1', '2025-09-30 20:48:02', NULL, NULL, '0', '2025-09-30 19:48:03', NULL, '2025-09-30 19:48:02', '2025-09-30 19:48:03'),
(40, '01999c2d-0b41-70ff-9102-08e71b6b10be', 'fadillah.sari', NULL, '2025-10-01', '03:00:00', '3', 3.8, -20.8, -21.6, 10.2, 25.5, 99.9, 10.1, 26.4, 11.5, 16.4, 21.5, 10.5, 10.4, 25.4, 87.3, -18.3, 17.6, NULL, 'Suntaro', '1', '2025-09-30 20:50:21', NULL, NULL, '0', '2025-09-30 19:50:21', NULL, '2025-09-30 19:50:21', '2025-09-30 19:50:21'),
(41, '01999c4a-d6cd-702f-b962-c99500cdbe6e', 'fadillah.sari', NULL, '2025-10-01', '04:00:00', '3', 3.3, -20.5, -21.8, 10.4, 25.8, 99.7, 9.8, 26.1, 11.3, 16.8, 20.4, 10.1, 10.1, 25.7, 87.1, -18.5, 16.8, NULL, 'Suntaro', '1', '2025-09-30 21:22:54', NULL, NULL, '0', '2025-09-30 20:22:54', NULL, '2025-09-30 20:22:54', '2025-09-30 20:22:54'),
(42, '01999c4c-4105-71f7-86c9-66bf41a66acb', 'fadillah.sari', NULL, '2025-10-01', '05:00:00', '3', 3.9, -21, -21.4, 9.8, 25.6, 99.6, 9.6, 27.8, 12.1, 15.1, 19.1, 9.6, 9.8, 25.5, 87.6, -18.1, 16.1, NULL, 'Suntaro', '1', '2025-09-30 21:24:27', NULL, NULL, '0', '2025-09-30 20:24:27', NULL, '2025-09-30 20:24:27', '2025-09-30 20:24:27'),
(43, '01999c4d-b01d-70ae-a994-465f472b7faa', 'fadillah.sari', NULL, '2025-10-01', '06:00:00', '3', 4, -21.4, -21.2, 9.5, 25.4, 99.8, 9.9, 27.1, 12.3, 15.7, 19.6, 9.8, 9.7, 25.6, 88, -18, 16.5, NULL, 'Suntaro', '1', '2025-10-02 03:53:13', NULL, NULL, '1', '2025-10-02 03:53:13', NULL, '2025-09-30 20:26:01', '2025-10-02 03:53:13'),
(44, '01999c4f-1748-7183-a32d-338c2c33c4ed', 'fadillah.sari', NULL, '2025-10-01', '07:00:00', '3', 4.1, -21.3, -21.7, 9.7, 25.2, 99.8, 10.5, 25.8, 12, 15.5, 18.4, 9.9, 9.6, 25, 88.5, -17.8, 16.6, NULL, 'Suntaro', '1', '2025-10-02 03:08:15', NULL, NULL, '1', '2025-10-02 03:08:15', NULL, '2025-09-30 20:27:33', '2025-10-02 03:08:15'),
(45, '01999c50-4090-7397-9bf0-88c218a04a98', 'fadillah.sari', NULL, '2025-10-01', '08:00:00', '3', 3.7, -21.7, -21.6, 9.8, 25, 99.8, 10.3, 25.2, 11.8, 16, 18.7, 10.5, 9.8, 25.8, 88.6, -18.1, 16.7, NULL, 'Suntaro', '1', '2025-10-02 03:50:24', NULL, NULL, '1', '2025-10-02 03:50:24', NULL, '2025-09-30 20:28:49', '2025-10-02 03:50:24'),
(46, '0199a181-594c-7355-9437-b5872f0ad008', 'ririn.hairini', NULL, '2025-10-01', '00:00:00', '3', 8.2, -12.2, -4.2, 14.6, 26.1, 98.8, 4.5, 30.6, 11.5, 15.7, 20.5, 10.6, 9.8, 24.4, 91.4, -10.7, 21.2, 'pompa liquid ammonia rusak, tidak bisa supply IQF Dan FG', 'Suntaro', '1', '2025-10-01 21:40:32', NULL, NULL, '0', '2025-10-01 20:40:32', NULL, '2025-10-01 20:40:32', '2025-10-01 20:40:32'),
(47, '0199b594-1887-72d4-8d16-d32512f54d41', 'tarissah.januarti', NULL, '2025-10-06', '01:00:00', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, NULL, NULL, 13.2, 11.9, NULL, NULL, NULL, NULL, NULL, 'Khoerunnisa', '1', '2025-10-05 19:13:25', NULL, NULL, '0', '2025-10-05 18:13:25', NULL, '2025-10-05 18:13:25', '2025-10-05 18:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `plant` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `activation` tinyint(1) DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `username`, `password`, `plant`, `department`, `type_user`, `photo`, `email`, `email_verified_at`, `remember_token`, `activation`, `updater`, `created_at`, `updated_at`) VALUES
(1, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', 'Admin', 'admin', '$2y$10$0K7bcblr/erit.iFY97cseSEapx6NzMJM.uXo7yl/AjJW4RfDtdsm', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '0', NULL, 'admin@example.com', NULL, NULL, 1, 'Admin', '2025-09-24 03:02:18', '2025-09-24 04:12:34'),
(5, '01997ab9-ed21-7118-8843-bc2b0a049125', 'Foreman Produksi', 'foreman', '$2y$10$WSX6D1IOD8mgOTO4vXfvpekR6UI8qozuwdPcnu/a44sfyEiWvs1y2', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '3', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-09-24 07:57:09', '2025-10-08 02:02:22'),
(21, '0199dc8d-2dce-7294-859d-8ba6b6c82e3e', 'admin2', 'admin2', '$2y$10$i5C66MqG66rvs5ZcV2M80.uyiHcqUlSPfEcPx2.roPdbeRKNW.NSS', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '1', '0', NULL, 'putriharnis23@gmail.com', NULL, NULL, NULL, 'Admin', '2025-10-13 07:51:03', '2025-10-13 07:51:03'),
(22, '0199dc8d-ed0a-70f7-b5fa-a2220bb2b734', 'Foreman Produksi B', 'foreman_brbk', '$2y$10$1kHnh3VfP6Nl0ETi4fbPCe0zhBt28lJZQoxCpcqA2LLUIwE1SNF/O', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2', '3', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-10-13 07:51:52', '2025-10-13 07:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_sanitasis`
--

CREATE TABLE `verifikasi_sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `area` varchar(255) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `cleaning_agents` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemens`
--
ALTER TABLE `departemens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemens_uuid_unique` (`uuid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gmps`
--
ALTER TABLE `gmps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gmps_uuid_unique` (`uuid`);

--
-- Indexes for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kebersihan_ruangs_uuid_unique` (`uuid`);

--
-- Indexes for table `mesins`
--
ALTER TABLE `mesins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mesins_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plants_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `plants_kode_unique` (`username`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_uuid_unique` (`uuid`);

--
-- Indexes for table `produksis`
--
ALTER TABLE `produksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produksis_uuid_unique` (`uuid`);

--
-- Indexes for table `pvdcs`
--
ALTER TABLE `pvdcs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pvdcs_uuid_unique` (`uuid`);

--
-- Indexes for table `sanitasis`
--
ALTER TABLE `sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sanitasis_uuid_unique` (`uuid`);

--
-- Indexes for table `suhus`
--
ALTER TABLE `suhus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suhus_uuid_unique` (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `verifikasi_sanitasis`
--
ALTER TABLE `verifikasi_sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verifikasi_sanitasis_uuid_unique` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gmps`
--
ALTER TABLE `gmps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mesins`
--
ALTER TABLE `mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `produksis`
--
ALTER TABLE `produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `pvdcs`
--
ALTER TABLE `pvdcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanitasis`
--
ALTER TABLE `sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suhus`
--
ALTER TABLE `suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `verifikasi_sanitasis`
--
ALTER TABLE `verifikasi_sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
