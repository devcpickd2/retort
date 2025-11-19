-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 09:50 AM
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
-- Table structure for table `area_hygienes`
--

CREATE TABLE `area_hygienes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_hygienes`
--

INSERT INTO `area_hygienes` (`id`, `uuid`, `username`, `area`, `plant`, `created_at`, `updated_at`) VALUES
(1, '045c14a2-e233-447e-9554-c456a87f2b09', 'admin', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:42:37', '2025-11-19 08:42:37'),
(2, 'b1d44fbe-9d95-482a-9bac-8259a7779153', 'admin', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:43:05', '2025-11-19 08:43:05'),
(3, '85c58e8b-9d9a-4442-bcd7-1aabcd4c42c3', 'admin', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:43:14', '2025-11-19 08:43:14'),
(4, '02ce6618-dfce-4cc9-a537-850b2bcd253b', 'admin', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:43:24', '2025-11-19 08:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `area_sanitasis`
--

CREATE TABLE `area_sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `bagian` longtext DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_sanitasis`
--

INSERT INTO `area_sanitasis` (`id`, `uuid`, `username`, `area`, `bagian`, `plant`, `created_at`, `updated_at`) VALUES
(1, '0a6d08fd-e75a-471e-9574-1f323348aa23', 'admin', 'Seasoning', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Rak\\\",\\\"Timbangan\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:46:56', '2025-11-19 08:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `area_suhus`
--

CREATE TABLE `area_suhus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `standar` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_suhus`
--

INSERT INTO `area_suhus` (`id`, `uuid`, `username`, `area`, `standar`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'bb588ea3-aa80-4620-a432-1b14c2ed414a', 'admin', 'Chillroom (Ruang)', '0 - 4', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:26', '2025-11-19 08:44:26'),
(2, 'e020a34f-80f1-425a-a286-9fd58c7c6def', 'admin', 'Chillroom (Meat)', '<10', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:35', '2025-11-19 08:44:35'),
(3, '3cfe1bc6-5666-472b-ac10-1ad926dc495f', 'admin', 'Cold Storage Meat (Ruang)', '(-18) - (-22)', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:51', '2025-11-19 08:44:51'),
(4, '2af4527d-2b04-4e85-86dd-e5b1a29b54dd', 'admin', 'Cold Storage Meat (Meat)', '(-18) - (-22)', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:45:09', '2025-11-19 08:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `chambers`
--

CREATE TABLE `chambers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `verifikasi` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_operator` varchar(255) DEFAULT NULL,
  `status_operator` varchar(255) DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
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
(1, 'a5544f26-ee76-4012-afa8-eaa40c1c4656', 'Quality Control', '2025-08-24 20:00:49', '2025-09-23 21:08:01'),
(2, 'ca394a66-bd78-4f06-935f-8513ff4cfc9d', 'Produksi', '2025-08-24 20:00:59', '2025-08-24 20:00:59'),
(3, '9919bfc8-bbb5-4f91-a3e8-983630694417', 'Engineering', '2025-08-24 20:01:04', '2025-08-24 20:01:04'),
(4, '2e8f0bae-d598-48b9-b4d4-03e65be9a1c6', 'Warehouse', '2025-08-24 20:01:10', '2025-08-24 20:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `engineers`
--

CREATE TABLE `engineers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_engineer` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `username_updated` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `mp_chamber` longtext NOT NULL,
  `karantina_packing` longtext NOT NULL,
  `filling_susun` longtext NOT NULL,
  `sampling_fg` longtext NOT NULL,
  `pemeriksaan` longtext DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `kartons`
--

CREATE TABLE `kartons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `kode_karton` varchar(255) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_kedatangan` date DEFAULT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `no_lot` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_operator` varchar(255) DEFAULT NULL,
  `status_operator` varchar(255) DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
  `nama_koordinator` varchar(255) DEFAULT NULL,
  `status_koordinator` varchar(255) DEFAULT NULL,
  `tgl_update_koordinator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `klorins`
--

CREATE TABLE `klorins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `footbasin` varchar(255) NOT NULL,
  `handbasin` varchar(255) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koordinators`
--

CREATE TABLE `koordinators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_koordinator` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labelisasi_pvdcs`
--

CREATE TABLE `labelisasi_pvdcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `labelisasi` longtext DEFAULT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `status_operator` varchar(255) DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_chambers`
--

CREATE TABLE `list_chambers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `no_chamber` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mesins`
--

CREATE TABLE `mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `jenis_mesin` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesins`
--

INSERT INTO `mesins` (`id`, `uuid`, `username`, `nama_mesin`, `jenis_mesin`, `plant`, `created_at`, `updated_at`) VALUES
(3, '11075801-27f6-4db6-8d97-85cb87dfbafe', 'admin', 'C1', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:39:35', '2025-11-19 08:39:35'),
(4, '92cc20bf-27a5-4359-b443-708f1c0aafab', 'admin', 'C2', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:39:42', '2025-11-19 08:39:42'),
(5, '29511841-0175-452d-8c5d-ac4cdda91a59', 'admin', 'C3', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:39:56', '2025-11-19 08:39:56'),
(6, '28a50f37-dada-44de-8703-61b92d9b5fcb', 'admin', 'C4', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:40:06', '2025-11-19 08:40:06'),
(7, '2442d98f-0256-4ae5-9cb6-5f4def417650', 'admin', 'C5', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:40:11', '2025-11-19 08:40:11'),
(8, 'd4a52ef0-71d9-403a-a81f-90e7bd0ad65e', 'admin', 'C6', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:40:19', '2025-11-19 08:40:19'),
(9, '33006e62-d484-4982-b8bf-c080267e7cb9', 'admin', 'C7', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:40:24', '2025-11-19 08:40:24'),
(10, 'a101d21a-6da7-4f9a-8c0e-7909d818d1c6', 'admin', 'ZAP 2', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:40:58', '2025-11-19 08:40:58'),
(11, '84583f42-890b-444f-88fb-bc27b49cc124', 'admin', 'ZAP 4', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:05', '2025-11-19 08:41:05'),
(12, 'b7826a1d-5790-4326-858c-e7498281a7c4', 'admin', 'ZAP 6', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:12', '2025-11-19 08:41:12'),
(13, 'f5eb85f9-6598-4319-9e0f-f4936640966e', 'admin', 'ZAP 7', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:18', '2025-11-19 08:41:18'),
(14, 'd9b07be6-fd09-4644-8088-c5ebbda1e8af', 'admin', 'ZAP 9', 'Stuffing', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:23', '2025-11-19 08:41:23'),
(15, '0d61df2e-3cde-4c2b-a2ee-88d5ffce7498', 'admin', '1', 'Chamber', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:38', '2025-11-19 08:41:38'),
(16, '01ee04b4-7c4b-4794-aadd-0d2b9019a525', 'admin', '2', 'Chamber', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:42', '2025-11-19 08:41:42'),
(17, '73e5cfe0-1ce8-4093-9f33-7269f1c7b4fb', 'admin', '3', 'Chamber', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:46', '2025-11-19 08:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `metals`
--

CREATE TABLE `metals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `fe` varchar(255) NOT NULL,
  `nfe` varchar(255) NOT NULL,
  `sus` varchar(255) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, '2025_07_14_023447_create_produks_table', 1),
(6, '2025_07_14_042251_create_departemens_table', 1),
(7, '2025_08_25_071729_ad_uuid_to_departemens_table', 1),
(8, '2025_08_25_075937_add_uuid_to_users_table', 1),
(9, '2025_08_25_084114_add_extra_fields_to_users_table', 1),
(10, '2025_08_25_085022_update_users_table_add_constraints', 1),
(11, '2025_08_25_095513_create_plants_table', 1),
(12, '2025_08_30_112807_create_produksis_table', 1),
(13, '2025_08_30_120005_create_gmps_table', 1),
(14, '2025_09_24_093658_add_activation_to_users_table', 1),
(15, '2025_09_24_094000_add_updater_to_users_table', 1),
(16, '2025_10_13_165151_create_pvdcs_table', 1),
(17, '2025_10_14_152055_create_mesins_table', 1),
(18, '2025_10_15_095059_create_labelisasi_pvdcs_table', 1),
(19, '2025_10_16_162959_create_metals_table', 1),
(20, '2025_10_17_144630_create_operators_table', 1),
(21, '2025_10_17_144711_create_engineers_table', 1),
(22, '2025_10_17_154339_create_suppliers_table', 1),
(23, '2025_10_20_171840_create_sampels_table', 1),
(24, '2025_10_21_115240_create_organoleptiks_table', 1),
(25, '2025_10_22_102457_create_klorins_table', 1),
(26, '2025_10_23_162306_create_samplings_table', 1),
(27, '2025_10_24_110535_create_supplier_rms_table', 1),
(28, '2025_10_24_111829_create_koordinators_table', 1),
(29, '2025_10_24_135259_create_kartons_table', 1),
(30, '2025_10_25_095052_create_timbangans_table', 1),
(31, '2025_10_27_092717_create_thermometers_table', 1),
(32, '2025_10_27_101637_create_list_chambers_table', 1),
(33, '2025_10_27_155022_create_chambers_table', 1),
(34, '2025_10_27_161104_create_wires_table', 1),
(35, '2025_10_29_161105_create_sampling_fgs_table', 1),
(36, '2025_10_30_154331_create_pemasakans_table', 1),
(37, '2025_11_03_142141_create_prepackings_table', 1),
(38, '2025_11_04_155253_create_washings_table', 1),
(39, '2025_11_05_161942_create_pemusnahans_table', 1),
(40, '2025_11_06_091224_create_retain_rtes_table', 1),
(41, '2025_11_06_133523_create_area_hygienes_table', 1),
(42, '2025_11_07_101038_create_release_packing_rtes_table', 1),
(43, '2025_11_07_110226_create_pemasakan_rtes_table', 1),
(44, '2025_11_07_144211_create_release_packings_table', 1),
(45, '2025_11_08_090615_create_area_suhus_table', 1),
(46, '2025_11_08_092823_create_suhus_table', 1),
(47, '2025_11_10_143429_create_area_sanitasis_table', 1),
(48, '2025_11_10_153221_create_sanitasis_table', 1),
(49, '2025_11_11_091542_create_mincings_table', 1),
(50, '2025_11_15_095404_create_packings_table', 1),
(51, '2025_11_19_103555_create_stuffings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mincings`
--

CREATE TABLE `mincings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `non_premix` longtext DEFAULT NULL,
  `premix` longtext DEFAULT NULL,
  `daging` varchar(255) DEFAULT NULL,
  `suhu_sebelum_grinding` decimal(8,2) DEFAULT NULL,
  `waktu_mixing_premix_awal` time DEFAULT NULL,
  `waktu_mixing_premix_akhir` time DEFAULT NULL,
  `waktu_bowl_cutter_awal` time DEFAULT NULL,
  `waktu_bowl_cutter_akhir` time DEFAULT NULL,
  `waktu_aging_emulsi_awal` time DEFAULT NULL,
  `waktu_aging_emulsi_akhir` time DEFAULT NULL,
  `suhu_akhir_emulsi_gel` decimal(8,2) DEFAULT NULL,
  `waktu_mixing` time DEFAULT NULL,
  `suhu_akhir_mixing` decimal(8,2) DEFAULT NULL,
  `suhu_akhir_emulsi` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `uuid`, `username`, `nama_karyawan`, `bagian`, `plant`, `created_at`, `updated_at`) VALUES
(1, '54e7a7e4-5b73-43b5-b55f-0f68a1ef41c1', 'admin', 'Jamal', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:45:54', '2025-11-19 08:45:54'),
(2, '0f36f65c-2c9d-44ec-8c62-b0d99ae25d16', 'admin', 'Tison', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:46:04', '2025-11-19 08:46:04'),
(3, '16299c18-abf9-46dc-bd8a-7f4de108a49d', 'admin', 'Koordinator 1', 'Koordinator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:46:10', '2025-11-19 08:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `organoleptiks`
--

CREATE TABLE `organoleptiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `sensori` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packings`
--

CREATE TABLE `packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `kalibrasi` varchar(255) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `kode_printing` varchar(255) DEFAULT NULL,
  `kode_toples` varchar(255) DEFAULT NULL,
  `kode_karton` varchar(255) DEFAULT NULL,
  `suhu` decimal(8,2) DEFAULT NULL,
  `speed` decimal(8,2) DEFAULT NULL,
  `kondisi_segel` varchar(255) DEFAULT NULL,
  `berat_toples` decimal(8,2) DEFAULT NULL,
  `berat_pouch` decimal(8,2) DEFAULT NULL,
  `no_lot` varchar(255) DEFAULT NULL,
  `tgl_kedatangan` date DEFAULT NULL,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `pemasakans`
--

CREATE TABLE `pemasakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `no_chamber` varchar(255) NOT NULL,
  `berat_produk` decimal(8,2) NOT NULL,
  `suhu_produk` decimal(8,2) NOT NULL,
  `jumlah_tray` varchar(255) NOT NULL,
  `cooking` longtext NOT NULL,
  `total_reject` decimal(8,2) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `pemasakan_rtes`
--

CREATE TABLE `pemasakan_rtes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `no_chamber` varchar(255) NOT NULL,
  `berat_produk` decimal(8,2) NOT NULL,
  `suhu_produk` decimal(8,2) NOT NULL,
  `jumlah_tray` varchar(255) NOT NULL,
  `cooking` longtext NOT NULL,
  `total_reject` decimal(8,2) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahans`
--

CREATE TABLE `pemusnahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `analisa` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `kode` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `uuid`, `kode`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'fdaca613-7ab2-4997-8f33-686e886c867d', 'putri', 'Cikande 2', '2025-08-26 18:54:32', '2025-09-23 20:57:58'),
(3, '2debd595-89c4-4a7e-bf94-e623cc220ca6', '', 'Berbek', '2025-10-07 19:26:57', '2025-10-07 19:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `prepackings`
--

CREATE TABLE `prepackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `conveyor` varchar(255) DEFAULT NULL,
  `suhu_produk` longtext DEFAULT NULL,
  `kondisi_produk` longtext DEFAULT NULL,
  `berat_produk` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `uuid`, `username`, `nama_produk`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'c0b2d639-7aba-4738-9ba2-1ee12bb9d4b7', 'admin', 'SRCH Ayam Original', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:22', '2025-11-19 07:31:22'),
(2, 'c61b82ef-c547-4190-bc71-1e3f454e2a14', 'admin', 'SROA Ayam Bakar', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:32', '2025-11-19 07:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `produksis`
--

CREATE TABLE `produksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pvdcs`
--

CREATE TABLE `pvdcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `tgl_kedatangan` date NOT NULL,
  `tgl_expired` date NOT NULL,
  `data_pvdc` longtext NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `release_packings`
--

CREATE TABLE `release_packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `jenis_kemasan` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `no_palet` varchar(255) NOT NULL,
  `jumlah_box` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `reject` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `release_packing_rtes`
--

CREATE TABLE `release_packing_rtes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `reject` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retain_rtes`
--

CREATE TABLE `retain_rtes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `analisa` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sampels`
--

CREATE TABLE `sampels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `jenis_sampel` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samplings`
--

CREATE TABLE `samplings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `jenis_sampel` varchar(255) NOT NULL,
  `jenis_kemasan` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah` decimal(8,2) DEFAULT NULL,
  `jamur` decimal(8,2) DEFAULT NULL,
  `lendir` decimal(8,2) DEFAULT NULL,
  `klip_tajam` decimal(8,2) DEFAULT NULL,
  `pin_hole` decimal(8,2) DEFAULT NULL,
  `air_trap_pvdc` decimal(8,2) DEFAULT NULL,
  `air_trap_produk` decimal(8,2) DEFAULT NULL,
  `keriput` decimal(8,2) DEFAULT NULL,
  `bengkok` decimal(8,2) DEFAULT NULL,
  `non_kode` decimal(8,2) DEFAULT NULL,
  `over_lap` decimal(8,2) DEFAULT NULL,
  `kecil` decimal(8,2) DEFAULT NULL,
  `terjepit` decimal(8,2) DEFAULT NULL,
  `double_klip` decimal(8,2) DEFAULT NULL,
  `seal_halus` decimal(8,2) DEFAULT NULL,
  `basah` decimal(8,2) DEFAULT NULL,
  `dll` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sampling_fgs`
--

CREATE TABLE `sampling_fgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `palet` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `exp_date` date NOT NULL,
  `pukul` time NOT NULL,
  `kalibrasi` varchar(255) DEFAULT NULL,
  `berat_produk` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `isi_per_box` int(11) DEFAULT NULL,
  `kemasan` varchar(255) DEFAULT NULL,
  `jumlah_box` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `reject` int(11) DEFAULT NULL,
  `hold` int(11) DEFAULT NULL,
  `item_mutu` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_koordinator` varchar(255) DEFAULT NULL,
  `status_koordinator` varchar(255) DEFAULT NULL,
  `tgl_update_koordinator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanitasis`
--

CREATE TABLE `sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `pemeriksaan` longtext NOT NULL,
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
-- Dumping data for table `sanitasis`
--

INSERT INTO `sanitasis` (`id`, `uuid`, `username`, `username_updated`, `plant`, `date`, `shift`, `area`, `pemeriksaan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019a9b4c-0fa4-73e4-a846-389cf1660e01', 'admin', NULL, 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19', '2', 'Seasoning', '\"{\\\"Lantai\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Dinding\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Pintu dan Tirai\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Rak\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Timbangan\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null}}\"', 'Foreman Produksi', '1', '2025-11-19 09:47:24', NULL, '0', NULL, NULL, '2025-11-19 08:47:24', '2025-11-19 08:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `stuffings`
--

CREATE TABLE `stuffings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `exp_date` date NOT NULL,
  `kode_mesin` varchar(255) DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `suhu` decimal(8,2) DEFAULT NULL,
  `sensori` varchar(255) DEFAULT NULL,
  `kecepatan_stuffing` decimal(8,2) DEFAULT NULL,
  `panjang_pcs` decimal(8,2) DEFAULT NULL,
  `berat_pcs` decimal(8,2) DEFAULT NULL,
  `cek_vakum` varchar(255) DEFAULT NULL,
  `kebersihan_seal` varchar(255) DEFAULT NULL,
  `kekuatan_seal` varchar(255) DEFAULT NULL,
  `diameter_klip` decimal(8,2) DEFAULT NULL,
  `print_kode` varchar(255) DEFAULT NULL,
  `lebar_cassing` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) NOT NULL,
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
-- Dumping data for table `stuffings`
--

INSERT INTO `stuffings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `kode_produksi`, `exp_date`, `kode_mesin`, `jam_mulai`, `suhu`, `sensori`, `kecepatan_stuffing`, `panjang_pcs`, `berat_pcs`, `cek_vakum`, `kebersihan_seal`, `kekuatan_seal`, `diameter_klip`, `print_kode`, `lebar_cassing`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(3, '019a9b2e-0d6e-704c-9efc-b334614b236d', 'admin', 'admin', '2025-11-19', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', 'SRCH Ayam Original', 'PH07101AA0', '2027-03-06', 'ZAP 6', '15:14:00', '20.50', 'OK', '20.50', '10.50', '10.20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Foreman Produksi', '1', '2025-11-19 09:14:37', NULL, '1', NULL, '2025-11-19 08:19:05', '2025-11-19 08:14:37', '2025-11-19 08:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `suhus`
--

CREATE TABLE `suhus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `hasil_suhu` longtext NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `uuid`, `username`, `nama_supplier`, `jenis_barang`, `plant`, `created_at`, `updated_at`) VALUES
(1, '0cd1129e-b88c-4078-b82d-1d33a0633b9c', 'admin', 'Cikande 1', 'Raw Material', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:41', '2025-11-19 07:31:41'),
(2, '5da1b537-9762-409a-89da-e05ff8c661eb', 'admin', 'PT. Intikemas', 'Packaging', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:46', '2025-11-19 07:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_rms`
--

CREATE TABLE `supplier_rms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thermometers`
--

CREATE TABLE `thermometers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `peneraan` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timbangans`
--

CREATE TABLE `timbangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `peneraan` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `plant` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activation` tinyint(1) NOT NULL DEFAULT 0,
  `updater` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `plant`, `department`, `type_user`, `photo`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `activation`, `updater`) VALUES
(1, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', 'admin', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '0', NULL, 'Admin', 'admin@example.com', NULL, '$2y$10$0K7bcblr/erit.iFY97cseSEapx6NzMJM.uXo7yl/AjJW4RfDtdsm', NULL, '2025-09-23 20:02:18', '2025-09-23 21:12:34', 1, 'Admin'),
(5, '01997ab9-ed21-7118-8843-bc2b0a049125', 'foreman', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '3', NULL, 'Foreman Produksi', 'foreman1@example.com', NULL, '$2y$10$WSX6D1IOD8mgOTO4vXfvpekR6UI8qozuwdPcnu/a44sfyEiWvs1y2', NULL, '2025-09-24 00:57:09', '2025-10-07 19:02:22', 0, 'Admin'),
(21, '0199dc8d-2dce-7294-859d-8ba6b6c82e3e', 'admin2', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '1', '0', NULL, 'admin2', 'admin2@example.com', NULL, '$2y$10$i5C66MqG66rvs5ZcV2M80.uyiHcqUlSPfEcPx2.roPdbeRKNW.NSS', NULL, '2025-10-13 00:51:03', '2025-10-13 00:51:03', 0, 'Admin'),
(22, '0199dc8d-ed0a-70f7-b5fa-a2220bb2b734', 'foreman_brbk', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2', '3', NULL, 'Foreman Produksi B', 'foreman2@example.com', NULL, '$2y$10$1kHnh3VfP6Nl0ETi4fbPCe0zhBt28lJZQoxCpcqA2LLUIwE1SNF/O', NULL, '2025-10-13 00:51:52', '2025-10-13 00:51:52', 0, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `washings`
--

CREATE TABLE `washings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `panjang_produk` decimal(8,2) DEFAULT NULL,
  `diameter_produk` decimal(8,2) DEFAULT NULL,
  `airtrap` varchar(255) DEFAULT NULL,
  `lengket` varchar(255) DEFAULT NULL,
  `sisa_adonan` varchar(255) DEFAULT NULL,
  `kebocoran` varchar(255) DEFAULT NULL,
  `kekuatan_seal` varchar(255) DEFAULT NULL,
  `print_kode` varchar(255) DEFAULT NULL,
  `konsentrasi_pckleer` decimal(8,2) DEFAULT NULL,
  `suhu_pckleer_1` decimal(8,2) DEFAULT NULL,
  `suhu_pckleer_2` decimal(8,2) DEFAULT NULL,
  `ph_pckleer` decimal(8,2) DEFAULT NULL,
  `kondisi_air_pckleer` varchar(255) DEFAULT NULL,
  `konsentrasi_pottasium` decimal(8,2) DEFAULT NULL,
  `suhu_pottasium` decimal(8,2) DEFAULT NULL,
  `ph_pottasium` decimal(8,2) DEFAULT NULL,
  `kondisi_pottasium` varchar(255) DEFAULT NULL,
  `suhu_heater` decimal(8,2) DEFAULT NULL,
  `speed_1` decimal(8,2) DEFAULT NULL,
  `speed_2` decimal(8,2) DEFAULT NULL,
  `speed_3` decimal(8,2) DEFAULT NULL,
  `speed_4` decimal(8,2) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `wires`
--

CREATE TABLE `wires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `data_wire` longtext NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
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
-- Indexes for table `area_hygienes`
--
ALTER TABLE `area_hygienes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `area_hygienes_uuid_unique` (`uuid`);

--
-- Indexes for table `area_sanitasis`
--
ALTER TABLE `area_sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `area_sanitasis_uuid_unique` (`uuid`);

--
-- Indexes for table `area_suhus`
--
ALTER TABLE `area_suhus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `area_suhus_uuid_unique` (`uuid`);

--
-- Indexes for table `chambers`
--
ALTER TABLE `chambers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chambers_uuid_unique` (`uuid`);

--
-- Indexes for table `departemens`
--
ALTER TABLE `departemens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemens_uuid_unique` (`uuid`);

--
-- Indexes for table `engineers`
--
ALTER TABLE `engineers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `engineers_uuid_unique` (`uuid`);

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
-- Indexes for table `kartons`
--
ALTER TABLE `kartons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartons_uuid_unique` (`uuid`);

--
-- Indexes for table `klorins`
--
ALTER TABLE `klorins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `klorins_uuid_unique` (`uuid`);

--
-- Indexes for table `koordinators`
--
ALTER TABLE `koordinators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `koordinators_uuid_unique` (`uuid`);

--
-- Indexes for table `labelisasi_pvdcs`
--
ALTER TABLE `labelisasi_pvdcs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `labelisasi_pvdcs_uuid_unique` (`uuid`);

--
-- Indexes for table `list_chambers`
--
ALTER TABLE `list_chambers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_chambers_uuid_unique` (`uuid`);

--
-- Indexes for table `mesins`
--
ALTER TABLE `mesins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mesins_uuid_unique` (`uuid`);

--
-- Indexes for table `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metals_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mincings`
--
ALTER TABLE `mincings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mincings_uuid_unique` (`uuid`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operators_uuid_unique` (`uuid`);

--
-- Indexes for table `organoleptiks`
--
ALTER TABLE `organoleptiks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organoleptiks_uuid_unique` (`uuid`);

--
-- Indexes for table `packings`
--
ALTER TABLE `packings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packings_uuid_unique` (`uuid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemasakans`
--
ALTER TABLE `pemasakans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemasakans_uuid_unique` (`uuid`);

--
-- Indexes for table `pemasakan_rtes`
--
ALTER TABLE `pemasakan_rtes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemasakan_rtes_uuid_unique` (`uuid`);

--
-- Indexes for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemusnahans_uuid_unique` (`uuid`);

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
  ADD UNIQUE KEY `plants_kode_unique` (`kode`);

--
-- Indexes for table `prepackings`
--
ALTER TABLE `prepackings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prepackings_uuid_unique` (`uuid`);

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
-- Indexes for table `release_packings`
--
ALTER TABLE `release_packings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `release_packings_uuid_unique` (`uuid`);

--
-- Indexes for table `release_packing_rtes`
--
ALTER TABLE `release_packing_rtes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `release_packing_rtes_uuid_unique` (`uuid`);

--
-- Indexes for table `retain_rtes`
--
ALTER TABLE `retain_rtes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `retain_rtes_uuid_unique` (`uuid`);

--
-- Indexes for table `sampels`
--
ALTER TABLE `sampels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sampels_uuid_unique` (`uuid`);

--
-- Indexes for table `samplings`
--
ALTER TABLE `samplings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `samplings_uuid_unique` (`uuid`);

--
-- Indexes for table `sampling_fgs`
--
ALTER TABLE `sampling_fgs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sampling_fgs_uuid_unique` (`uuid`);

--
-- Indexes for table `sanitasis`
--
ALTER TABLE `sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sanitasis_uuid_unique` (`uuid`);

--
-- Indexes for table `stuffings`
--
ALTER TABLE `stuffings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stuffings_uuid_unique` (`uuid`);

--
-- Indexes for table `suhus`
--
ALTER TABLE `suhus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suhus_uuid_unique` (`uuid`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_uuid_unique` (`uuid`);

--
-- Indexes for table `supplier_rms`
--
ALTER TABLE `supplier_rms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_rms_uuid_unique` (`uuid`);

--
-- Indexes for table `thermometers`
--
ALTER TABLE `thermometers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thermometers_uuid_unique` (`uuid`);

--
-- Indexes for table `timbangans`
--
ALTER TABLE `timbangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `timbangans_uuid_unique` (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `email` (`email`);
ALTER TABLE `users` ADD FULLTEXT KEY `email_2` (`email`);

--
-- Indexes for table `washings`
--
ALTER TABLE `washings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `washings_uuid_unique` (`uuid`);

--
-- Indexes for table `wires`
--
ALTER TABLE `wires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wires_uuid_unique` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_hygienes`
--
ALTER TABLE `area_hygienes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `area_sanitasis`
--
ALTER TABLE `area_sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area_suhus`
--
ALTER TABLE `area_suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chambers`
--
ALTER TABLE `chambers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gmps`
--
ALTER TABLE `gmps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartons`
--
ALTER TABLE `kartons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klorins`
--
ALTER TABLE `klorins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koordinators`
--
ALTER TABLE `koordinators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labelisasi_pvdcs`
--
ALTER TABLE `labelisasi_pvdcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_chambers`
--
ALTER TABLE `list_chambers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesins`
--
ALTER TABLE `mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `mincings`
--
ALTER TABLE `mincings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organoleptiks`
--
ALTER TABLE `organoleptiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packings`
--
ALTER TABLE `packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemasakans`
--
ALTER TABLE `pemasakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemasakan_rtes`
--
ALTER TABLE `pemasakan_rtes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prepackings`
--
ALTER TABLE `prepackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produksis`
--
ALTER TABLE `produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pvdcs`
--
ALTER TABLE `pvdcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `release_packings`
--
ALTER TABLE `release_packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `release_packing_rtes`
--
ALTER TABLE `release_packing_rtes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retain_rtes`
--
ALTER TABLE `retain_rtes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampels`
--
ALTER TABLE `sampels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samplings`
--
ALTER TABLE `samplings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampling_fgs`
--
ALTER TABLE `sampling_fgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanitasis`
--
ALTER TABLE `sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stuffings`
--
ALTER TABLE `stuffings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suhus`
--
ALTER TABLE `suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_rms`
--
ALTER TABLE `supplier_rms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thermometers`
--
ALTER TABLE `thermometers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timbangans`
--
ALTER TABLE `timbangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `washings`
--
ALTER TABLE `washings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wires`
--
ALTER TABLE `wires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
