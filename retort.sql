-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 09:49 AM
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
(1, '0a6d08fd-e75a-471e-9574-1f323348aa23', 'admin', 'Seasoning', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Rak\\\",\\\"Timbangan\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:46:56', '2025-11-19 08:46:56'),
(2, 'b97ba8b6-0e92-4943-9d89-94529a404562', 'admin', 'Meat Preparation', '\"[\\\"Foot Basin\\\",\\\"Hand Basin\\\",\\\"Air Shower\\\",\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Timbangan\\\",\\\"Grinder\\\",\\\"Mixer\\\",\\\"Tangga Mixer\\\",\\\"Emulsifier\\\",\\\"Hopper Pump\\\",\\\"Metal Detector\\\",\\\"AC\\\",\\\"Saluran Air\\\",\\\"Meat Car\\\",\\\"Atap\\\",\\\"Tempat Sampah\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:48:40', '2025-11-26 03:48:40'),
(3, 'd976a0a6-f93b-4f5c-88b9-7e139f6ec1b1', 'admin', 'Chill Room & Cold Storage', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu\\\",\\\"Pallet\\\",\\\"Rak\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:50:21', '2025-11-26 03:50:21'),
(4, 'b41d7f94-726f-4add-9502-08b35b7c1082', 'admin', 'Chamber', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Retort Chamber\\\",\\\"Conveyor Sortir\\\",\\\"Washing Chamber\\\",\\\"Saluran Air\\\",\\\"Tray\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:52:13', '2025-11-26 03:52:13'),
(5, 'd10e1148-69d2-4917-9e7c-f575fd417138', 'admin', 'Stuffing', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Conveyor\\\",\\\"Saluran Air\\\",\\\"Tempat Sampah\\\",\\\"AC\\\",\\\"Stuffer Tube\\\",\\\"Roller\\\",\\\"Slider\\\",\\\"Volder\\\",\\\"Table\\\",\\\"Enclosed\\\",\\\"Pisau\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:01:19', '2025-11-26 04:01:19'),
(6, '8c089f9c-622f-4d60-a300-ad25d804f159', 'admin', 'Susun', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Conveyor\\\",\\\"Tray Susun\\\",\\\"Trolley\\\",\\\"Saluran Air\\\",\\\"AC\\\",\\\"Tempat Sampah\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:02:35', '2025-11-26 04:02:35'),
(7, '0875f9bd-28b0-435c-992b-e8750086802b', 'admin', 'Hopper', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Hopper\\\",\\\"Pipa Adonan\\\",\\\"Cover Lampu\\\",\\\"Saluran Air\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:03:55', '2025-11-26 04:03:55'),
(8, 'f556d8bf-40e2-48e6-a9b6-3538015fb541', 'admin', 'Gudang PVDC', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Pallet\\\",\\\"Rak\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:04:50', '2025-11-26 04:04:50'),
(9, '8c925fb5-8562-41ca-8b4f-bf53bfa7dd4a', 'admin', 'Packing', '\"[\\\"Lantai\\\",\\\"Bak Cuci Tangan\\\",\\\"Air Shower\\\",\\\"Dinding\\\",\\\"Pintu\\\",\\\"Container\\\",\\\"Conveyor\\\",\\\"Meja Sortasi\\\",\\\"Pallet\\\",\\\"Tempat Sampah\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:06:42', '2025-11-26 04:06:42'),
(10, '681920d9-dae5-4462-a3ff-6b3eeb5ba6b6', 'admin', 'Gudang FG', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu dan Tirai\\\",\\\"Pallet\\\",\\\"Rak\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:07:27', '2025-11-26 04:07:27'),
(11, '7a9b5231-a4c2-4687-b4d9-8c7c8e344bb9', 'admin', 'Dry Store', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu\\\",\\\"Pallet\\\",\\\"Rak\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:09:03', '2025-11-26 04:09:03'),
(12, '97e72236-f338-4bb3-b685-b16e51874d6e', 'admin', 'Area Dryer', '\"[\\\"Lantai\\\",\\\"Dinding\\\",\\\"Pintu\\\",\\\"Conveyor Dryer\\\",\\\"Saluran buangan dryer\\\"]\"', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:11:03', '2025-11-26 04:11:03');

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
(1, 'bb588ea3-aa80-4620-a432-1b14c2ed414a', 'admin', 'Chill Room (Ruang)', '0 - 4', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:26', '2025-11-26 03:43:27'),
(2, 'e020a34f-80f1-425a-a286-9fd58c7c6def', 'admin', 'Chill Room (Meat)', '<10', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:35', '2025-11-26 03:43:46'),
(3, '3cfe1bc6-5666-472b-ac10-1ad926dc495f', 'admin', 'Cold Storage (Ruang)', '(-18) - (-22)', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:44:51', '2025-11-26 03:25:42'),
(4, '2af4527d-2b04-4e85-86dd-e5b1a29b54dd', 'admin', 'Cold Storage (Meat)', '(-18) - (-22)', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:45:09', '2025-11-26 03:25:37'),
(6, '7b69e19e-eef3-4214-9ede-98b180848df9', 'admin', 'Seasoning', '25 - 30', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:37:58', '2025-11-28 07:33:38'),
(7, '3a152d42-2a40-47c2-9752-1f3f752771e7', 'admin', 'Meat Preparation', '9 - 15', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:38:24', '2025-11-28 07:33:30'),
(8, '9ab6c25d-bef8-40bd-ab75-db3fc4336f23', 'admin', 'Hopper', '8 - 12', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:38:38', '2025-11-28 07:33:22'),
(9, 'b53e59d2-cee5-4455-a8be-b306e8ad56fb', 'admin', 'Stuffer', '16 - 20', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:39:02', '2025-11-28 07:33:13'),
(10, '08259145-8ae5-4cf1-8122-c0363e6ea074', 'admin', 'Susun', '12 - 18', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:39:24', '2025-11-28 07:33:06'),
(11, '3cc0e2a4-18a7-429d-b04a-a30535590386', 'admin', 'Retort Chamber', '30 - 40', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:39:43', '2025-11-28 07:33:00'),
(12, '1d7ebaf8-68c4-4be5-9bba-0aca0cfdc29c', 'admin', 'PVDC', '27 - 33', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:40:07', '2025-11-28 07:32:55'),
(13, 'a2688adc-fad0-4dbb-a4db-94b59aefdfe4', 'admin', 'Suhu Drying', '22 - 50', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:40:34', '2025-11-28 07:32:48'),
(14, '4f824046-57d6-46f6-a5b1-c40e19ad8476', 'admin', 'RH Drying', '20 - 60', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:40:47', '2025-11-28 07:32:42'),
(15, '2b009e9c-80d6-4b05-be18-93043b3a1eaa', 'admin', 'Suhu Packing', '20 - 30', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:41:07', '2025-11-28 07:32:36'),
(16, '72d6ef7f-b2db-4457-9ec1-a36a0bbb216d', 'admin', 'RH Packing', '40 - 70', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:41:23', '2025-11-28 07:32:31'),
(17, 'c59fe9b7-6e9c-4f36-a358-81f016472ac6', 'admin', 'Dry Store', '25 - 36', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:42:04', '2025-11-28 07:32:26'),
(18, '55e5f551-1aa5-4e17-9bf2-b946309eebf1', 'admin', 'Suhu Finish Good', '28 - 36', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:42:26', '2025-11-28 07:32:21'),
(19, 'e7e5199d-e7f9-4589-a257-1f4d8a8d5025', 'admin', 'RH Finish Good', '35 - 70', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 03:42:52', '2025-11-28 07:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `berita_acaras`
--

CREATE TABLE `berita_acaras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nomor` varchar(255) NOT NULL COMMENT 'Nomor Berita Acara',
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `uraian_masalah` text NOT NULL,
  `no_surat_jalan` varchar(255) DEFAULT NULL,
  `dd_po` varchar(255) DEFAULT NULL,
  `tanggal_kedatangan` date NOT NULL,
  `keputusan_pengembalian` tinyint(1) NOT NULL DEFAULT 0,
  `keputusan_potongan_harga` tinyint(1) NOT NULL DEFAULT 0,
  `keputusan_sortir` tinyint(1) NOT NULL DEFAULT 0,
  `keputusan_penukaran_barang` tinyint(1) NOT NULL DEFAULT 0,
  `keputusan_penggantian_biaya` tinyint(1) NOT NULL DEFAULT 0,
  `keputusan_lain_lain` varchar(255) DEFAULT NULL,
  `tanggal_keputusan` date DEFAULT NULL,
  `analisa_penyebab` text DEFAULT NULL,
  `tindak_lanjut_perbaikan` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status_ppic` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_ppic` text DEFAULT NULL,
  `ppic_verified_by` char(36) DEFAULT NULL,
  `ppic_verified_at` timestamp NULL DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text DEFAULT NULL,
  `spv_verified_by` char(36) DEFAULT NULL,
  `spv_verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `dispositions`
--

CREATE TABLE `dispositions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `disposisi_produk` tinyint(1) NOT NULL DEFAULT 0,
  `disposisi_material` tinyint(1) NOT NULL DEFAULT 0,
  `disposisi_prosedur` tinyint(1) NOT NULL DEFAULT 0,
  `dasar_disposisi` text NOT NULL,
  `uraian_disposisi` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `verified_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `username_updated` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `mp_chamber` longtext DEFAULT NULL,
  `karantina_packing` longtext DEFAULT NULL,
  `filling_susun` longtext DEFAULT NULL,
  `sampling_fg` longtext DEFAULT NULL,
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
-- Table structure for table `inspection_product_details`
--

CREATE TABLE `inspection_product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `raw_material_inspection_uuid` char(36) DEFAULT NULL,
  `kode_batch` varchar(255) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `exp` date NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `jumlah_sampel` decimal(10,2) NOT NULL DEFAULT 0.00,
  `jumlah_reject` decimal(10,2) NOT NULL DEFAULT 0.00,
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

--
-- Dumping data for table `kartons`
--

INSERT INTO `kartons` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `nama_produk`, `kode_produksi`, `kode_karton`, `waktu_mulai`, `waktu_selesai`, `jumlah`, `tgl_kedatangan`, `nama_supplier`, `no_lot`, `keterangan`, `nama_operator`, `status_operator`, `tgl_update_operator`, `nama_koordinator`, `status_koordinator`, `tgl_update_koordinator`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019abe35-0b7b-722d-afba-8ee1206b3bd8', 'admin', NULL, '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'SROA Ayam Bakar', 'PF23101AA0', 'public/karton/kode_karton_457e2f61-1854-4d97-9320-5995c1e50319.jpg', '10:32:00', '10:34:00', 1, '2025-11-26', 'PT. Intikemas', '1AD123', NULL, 'Jamal', '1', '2025-11-26 03:28:58', 'Koordinator 1', '1', '2025-11-26 03:28:58', NULL, '0', NULL, NULL, '2025-11-26 03:28:58', '2025-11-26 03:28:58');

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
  `username_updated` varchar(255) DEFAULT NULL,
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

--
-- Dumping data for table `labelisasi_pvdcs`
--

INSERT INTO `labelisasi_pvdcs` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `labelisasi`, `nama_operator`, `status_operator`, `tgl_update_operator`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019abe2d-d2ab-70db-b1e9-75c206f40d39', 'admin', 'admin', '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SRCH Ayam Original', '\"[{\\\"mesin\\\":\\\"C2\\\",\\\"kode_batch\\\":\\\"PJ23101AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc_temp\\\\\\/1764127263_wFQRcV9a.jpg\\\",\\\"keterangan\\\":null},{\\\"mesin\\\":\\\"ZAP 6\\\",\\\"kode_batch\\\":\\\"PJ23102AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc_temp\\\\\\/1764127683_59c0sHa8.jpg\\\",\\\"keterangan\\\":null}]\"', 'Jamal', '1', NULL, NULL, '0', NULL, NULL, '2025-11-26 03:21:05', '2025-11-26 03:28:04'),
(2, '019abf9e-026e-70ea-bc0e-3a1c2fcd79be', 'admin', 'admin', '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', 'SRCH Ayam Original', '\"[{\\\"mesin\\\":\\\"ZAP 6\\\",\\\"kode_batch\\\":\\\"PJ23101AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc\\\\\\/1764151394_ykFOLpZY.jpeg\\\",\\\"keterangan\\\":null},{\\\"mesin\\\":\\\"ZAP 6\\\",\\\"kode_batch\\\":\\\"PJ23102AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc\\\\\\/1764151394_ykFOLpZY.jpeg\\\",\\\"keterangan\\\":null}]\"', 'Ambriah', '1', NULL, NULL, '0', NULL, NULL, '2025-11-26 10:03:14', '2025-11-26 10:07:45'),
(3, '019abfa5-6919-7168-85cf-5e7b42a46746', 'admin', 'admin', '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', 'SROA Ayam Bakar', '\"[{\\\"mesin\\\":\\\"C6\\\",\\\"kode_batch\\\":\\\"PJ23101AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc\\\\\\/1764151879_zeYMAcdN.jpeg\\\",\\\"keterangan\\\":\\\"asad\\\"},{\\\"mesin\\\":\\\"ZAP 4\\\",\\\"kode_batch\\\":\\\"PJ23101AA0\\\",\\\"file\\\":\\\"\\\\\\/storage\\\\\\/uploads\\\\\\/pvdc_temp\\\\\\/1764207561_3AygclQr.jpg\\\",\\\"keterangan\\\":\\\"asda\\\"}]\"', 'Amin', '1', NULL, NULL, '0', NULL, NULL, '2025-11-26 10:11:19', '2025-11-27 03:28:14');

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
-- Table structure for table `list_forms`
--

CREATE TABLE `list_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `laporan` varchar(255) NOT NULL,
  `no_dokumen` varchar(255) NOT NULL,
  `last_revisi` varchar(255) DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_forms`
--

INSERT INTO `list_forms` (`id`, `uuid`, `username`, `plant`, `laporan`, `no_dokumen`, `last_revisi`, `last_updated`, `created_at`, `updated_at`) VALUES
(2, 'd9440861-e04b-4cba-adc6-56d143b211f0', 'admin', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'Pemeriksaan Input Bahan Baku', 'FR-QC-01', NULL, NULL, '2025-11-29 04:10:16', '2025-11-29 04:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `loading_checks`
--

CREATE TABLE `loading_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` enum('Pagi','Malam') NOT NULL,
  `jenis_aktivitas` enum('Loading','Unloading') NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `no_pol_mobil` varchar(255) NOT NULL,
  `nama_supir` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `tujuan_asal` varchar(255) NOT NULL,
  `no_segel` varchar(255) DEFAULT NULL,
  `jenis_kendaraan` varchar(255) DEFAULT NULL,
  `kondisi_mobil` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kondisi_mobil`)),
  `keterangan_total` text DEFAULT NULL,
  `keterangan_umum` text DEFAULT NULL,
  `pic_qc` varchar(255) DEFAULT NULL,
  `pic_warehouse` varchar(255) DEFAULT NULL,
  `pic_qc_spv` varchar(255) DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0,
  `catatan_spv` text DEFAULT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loading_details`
--

CREATE TABLE `loading_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `loading_check_id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `kode_expired` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magnet_traps`
--

CREATE TABLE `magnet_traps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_batch` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `jumlah_temuan` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `produksi_id` bigint(20) UNSIGNED NOT NULL,
  `engineer_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` char(36) DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0,
  `catatan_spv` text DEFAULT NULL,
  `verified_by_spv_uuid` char(36) DEFAULT NULL,
  `verified_at_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
(17, '73e5cfe0-1ce8-4093-9f33-7269f1c7b4fb', 'admin', '3', 'Chamber', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 08:41:46', '2025-11-19 08:41:46'),
(18, '7559a203-205c-48af-be8c-c0f8464ae82b', 'admin2', 'Z1', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:52:41', '2025-11-20 06:52:41'),
(19, 'a376f7b5-d2d8-4ca3-a36b-30f6bfc5cb35', 'admin2', 'Z2', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:52:47', '2025-11-20 06:52:47'),
(20, 'ee99239f-6b53-48b2-88f6-671541bcbdb1', 'admin2', 'Z3', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:52:53', '2025-11-20 06:52:53'),
(21, '75ea7efd-1518-4e60-8157-57319806ec37', 'admin2', 'Z4', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:52:59', '2025-11-20 06:52:59'),
(22, '24244558-baa0-43fc-88e5-1a4c5e9dc175', 'admin2', 'Z5', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:04', '2025-11-20 06:53:04'),
(23, '482c2131-0aec-40fd-be29-346ee3002ef0', 'admin2', 'Z6', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:12', '2025-11-20 06:53:12'),
(24, '1476b858-754c-4a58-a76e-9380cc112e71', 'admin2', 'Z7', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:19', '2025-11-20 06:53:19'),
(25, 'bbb0055c-c529-4561-8f68-97d9f324f52f', 'admin2', 'C1', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:26', '2025-11-20 06:53:26'),
(26, 'bb61faaf-036d-4b10-95ed-a2fa00a73d46', 'admin2', 'C2', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:33', '2025-11-20 06:53:33'),
(27, 'bb3400f0-c0cc-44a3-a8d4-f149041914a8', 'admin2', 'C3', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:38', '2025-11-20 06:53:38'),
(28, 'c7492c28-714a-4902-a231-74ac960afed1', 'admin2', 'C4', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:53:52', '2025-11-20 06:53:57'),
(29, 'f0f434ed-dab3-4e86-842b-0fcf7bbd35a3', 'admin2', 'C5', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:54:04', '2025-11-20 06:54:04'),
(30, 'e0849cbb-ff08-4ebe-8b23-2a054cad577b', 'admin2', 'C6', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:54:13', '2025-11-20 06:54:13'),
(31, 'ef3682fc-ce79-4c80-91bf-17962e67b964', 'admin2', 'K1', 'Stuffing', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2025-11-20 06:54:29', '2025-11-20 06:54:29');

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
(51, '2025_11_19_103555_create_stuffings_table', 1),
(52, '2025_10_15_143133_magnet_trap_table', 2),
(53, '2025_10_15_150202_add_soft_deletes_to_magnet_traps_table', 2),
(54, '2025_10_17_095325_create_raw_material_inspections_table', 2),
(55, '2025_10_17_095500_create_inspection_product_details_table', 2),
(56, '2025_10_20_093412_add_spv_verification_to_magnet_traps_table', 2),
(57, '2025_10_27_090653_change_foreign_key_to_uuid_in_inspection_product_details_table', 2),
(58, '2025_10_28_084511_add_verification_columns_to_raw_material_inspections_table', 2),
(59, '2025_11_01_120528_create_packaging_inspections_table', 2),
(60, '2025_11_01_120559_create_packaging_inspection_items_table', 2),
(61, '2025_11_03_091312_modify_packaging_tables_for_item_details', 2),
(62, '2025_11_03_153042_add_verification_to_packaging_inspections_table', 2),
(63, '2025_11_04_145910_create_pemeriksaan_retains_table', 2),
(64, '2025_11_04_145954_create_pemeriksaan_retain_items_table', 2),
(65, '2025_11_05_112849_add_exp_date_to_pemeriksaan_retain_items_table', 2),
(66, '2025_11_06_090947_add_verification_columns_to_pemeriksaan_retains_table', 2),
(67, '2025_11_08_101154_create_loading_checks_table', 2),
(68, '2025_11_08_101304_create_loading_details_table', 2),
(69, '2025_11_10_100512_modify_created_by_to_uuid_in_loading_checks_table', 2),
(70, '2025_11_11_111420_add_verification_to_loading_checks_table', 2),
(71, '2025_11_11_114550_add_uuid_to_loading_details_table', 2),
(72, '2025_11_12_083454_create_dispositions_table', 2),
(73, '2025_11_12_141217_add_created_by_to_magnet_traps_table', 2),
(74, '2025_11_13_085732_create_berita_acaras_table', 2),
(75, '2025_11_13_135908_create_pemeriksaan_kekuatan_magnet_traps_table', 2),
(76, '2025_11_14_084709_create_penyimpangan_kualitas_table', 2),
(77, '2025_11_27_090647_create_withdrawls_table', 3),
(78, '2025_11_28_150059_create_traceabilitys_table', 4),
(79, '2025_11_28_151107_create_traceabilities_table', 5),
(80, '2025_11_29_095107_create_list_forms_table', 6),
(81, '2025_12_01_103312_create_recalls_table', 7);

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
(4, 'd46ee86b-6d62-4e2b-9d56-6915251b043a', 'admin', 'Edo', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:50:10', '2025-11-26 06:50:23'),
(5, '54b610f6-eb32-45f6-876a-2db8cb17bf86', 'admin', 'Endang', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:50:40', '2025-11-26 06:50:40'),
(6, '1fa4d03d-1584-43fa-bd11-3103a27f1561', 'admin', 'Agus', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:50:48', '2025-11-26 06:50:48'),
(7, '1e9cae22-ca52-4046-ab5c-a1bcc21531c9', 'admin', 'Roni', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:50:55', '2025-11-26 06:50:55'),
(8, '3150ab88-63d4-42fb-8363-7a9a2097ce62', 'admin', 'Surya', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:01', '2025-11-26 06:51:01'),
(9, 'e4833248-bdc5-4cf4-8aa5-33a8983d2992', 'admin', 'Sarip', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:08', '2025-11-26 06:51:08'),
(10, 'ddb423fc-85e1-41f0-8a82-23bc990f07f3', 'admin', 'Subhan', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:15', '2025-11-26 06:51:15'),
(11, '5bfbc510-8808-4196-9489-3197f112f100', 'admin', 'Amin', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:24', '2025-11-26 06:51:24'),
(12, 'dd5cc35d-85a9-41f5-8cfc-d29a2f46943d', 'admin', 'Jamal', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:37', '2025-11-26 06:51:37'),
(13, 'f94f668d-d510-4711-9262-a46cd9e9bf48', 'admin', 'Arif', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:51:45', '2025-11-26 06:51:45'),
(14, 'f46e9196-9640-4c04-bba2-071b302d97fb', 'admin', 'Ambriah', 'Operator', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:52:00', '2025-11-26 06:52:00'),
(15, 'd510b50a-9812-4110-91f4-50bddad851a1', 'admin', 'Achmad', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:55:00', '2025-11-26 06:55:05'),
(16, 'a82a31c8-dd74-4fbb-92e5-bd0d891cad98', 'admin', 'Anggi', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:55:28', '2025-11-26 06:55:28'),
(17, 'ca3207f4-014a-4a91-9144-dcd549f457e2', 'admin', 'Azka Reza', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:56:08', '2025-11-26 06:56:08'),
(18, '9cb3751a-3c7f-4060-bb1b-b9ac402cdbb4', 'admin', 'Dika', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:56:16', '2025-11-26 06:56:16'),
(19, 'ffac0341-ada3-4d44-af19-9d521ff11906', 'admin', 'Kiki', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:56:23', '2025-11-26 06:56:23'),
(20, '4f2f9afc-5dc3-45d0-a0ca-e90ba6c46eb6', 'admin', 'Tison', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:56:31', '2025-11-26 06:56:31'),
(21, '1ad613ad-0001-423c-9954-354107afedb4', 'admin', 'Yogie', 'Engineer', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:56:43', '2025-11-26 06:56:43');

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
-- Table structure for table `packaging_inspections`
--

CREATE TABLE `packaging_inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `inspection_date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0,
  `catatan_spv` text DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packaging_inspection_items`
--

CREATE TABLE `packaging_inspection_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `packaging_inspection_id` bigint(20) UNSIGNED NOT NULL,
  `packaging_type` varchar(255) NOT NULL COMMENT 'Jenis Packaging',
  `supplier` varchar(255) NOT NULL,
  `lot_batch` varchar(255) NOT NULL,
  `condition_design` varchar(10) NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_sealing` varchar(10) NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_color` varchar(10) NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_dimension` varchar(255) DEFAULT NULL COMMENT 'Panjang, Lebar, Tinggi, Tebal',
  `condition_weight_pcs` varchar(255) DEFAULT NULL COMMENT 'Range berat',
  `quantity_goods` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah Barang',
  `quantity_sample` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah Sampel',
  `quantity_reject` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah Reject',
  `acceptance_status` enum('OK','Tolak') NOT NULL,
  `notes` text DEFAULT NULL COMMENT 'Keterangan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_pol` varchar(255) NOT NULL COMMENT 'Nomor Polisi Kendaraan',
  `vehicle_condition` varchar(255) NOT NULL COMMENT 'Kondisi Kendaraan',
  `pbb_op` varchar(255) DEFAULT NULL
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
-- Table structure for table `pemeriksaan_kekuatan_magnet_traps`
--

CREATE TABLE `pemeriksaan_kekuatan_magnet_traps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `kekuatan_median_1` decimal(8,2) DEFAULT NULL,
  `kekuatan_median_2` decimal(8,2) DEFAULT NULL,
  `kekuatan_median_3` decimal(8,2) DEFAULT NULL,
  `parameter_sesuai` tinyint(1) NOT NULL DEFAULT 1,
  `kondisi_magnet_trap` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `petugas_qc` varchar(255) DEFAULT NULL,
  `petugas_eng` varchar(255) DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text DEFAULT NULL,
  `verified_by` char(36) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_retains`
--

CREATE TABLE `pemeriksaan_retains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0,
  `catatan_spv` text DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `verified_by` char(36) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_retain_items`
--

CREATE TABLE `pemeriksaan_retain_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `pemeriksaan_retain_id` bigint(20) UNSIGNED NOT NULL,
  `kode_produksi` varchar(255) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `varian` varchar(255) DEFAULT NULL,
  `panjang` decimal(8,2) DEFAULT NULL,
  `diameter` decimal(8,2) DEFAULT NULL,
  `sensori_rasa` varchar(255) DEFAULT NULL,
  `sensori_warna` varchar(255) DEFAULT NULL,
  `sensori_aroma` varchar(255) DEFAULT NULL,
  `sensori_texture` varchar(255) DEFAULT NULL,
  `temuan_jamur` tinyint(1) NOT NULL DEFAULT 0,
  `temuan_lendir` tinyint(1) NOT NULL DEFAULT 0,
  `temuan_pinehole` tinyint(1) NOT NULL DEFAULT 0,
  `temuan_kejepit` tinyint(1) NOT NULL DEFAULT 0,
  `temuan_seal` tinyint(1) NOT NULL DEFAULT 0,
  `lab_garam` varchar(255) DEFAULT NULL,
  `lab_air` varchar(255) DEFAULT NULL,
  `lab_mikro` varchar(255) DEFAULT NULL,
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
-- Table structure for table `penyimpangan_kualitas`
--

CREATE TABLE `penyimpangan_kualitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `ditujukan_untuk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `lot_kode` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `penyelesaian` text DEFAULT NULL,
  `status_diketahui` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_diketahui` text DEFAULT NULL,
  `diketahui_by` char(36) DEFAULT NULL,
  `diketahui_at` timestamp NULL DEFAULT NULL,
  `status_disetujui` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_disetujui` text DEFAULT NULL,
  `disetujui_by` char(36) DEFAULT NULL,
  `disetujui_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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

--
-- Dumping data for table `produksis`
--

INSERT INTO `produksis` (`id`, `uuid`, `nama_karyawan`, `area`, `plant`, `created_at`, `updated_at`) VALUES
(6, 'bcf24ca5-fdec-4076-84d9-19a17d9e92dd', 'Opsal', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:15:50', '2025-11-26 04:16:04'),
(7, '51683eb4-31f5-4830-b0c9-2c5ad7b5681a', 'Kusmadi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:18:32', '2025-11-26 04:18:32'),
(8, 'ff450048-2a22-4abe-b99b-0a107974acd4', 'Zakipul', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:18:59', '2025-11-26 04:18:59'),
(9, '84e6bac9-1e99-4c0c-84c1-07fff7f1f802', 'Irfan', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:19:08', '2025-11-26 04:19:08'),
(10, '833d1d73-8c58-47e1-a86f-61f6653ff377', 'Sartani', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:19:22', '2025-11-26 04:19:22'),
(11, '11f81cd4-23cb-45dd-8903-eea2cb26a979', 'Syahrul', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:19:44', '2025-11-26 04:19:44'),
(12, '1333c0ba-be59-4520-af5c-730fd91731c2', 'Sukijan', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:19:58', '2025-11-26 04:19:58'),
(13, '28c5ddff-7c20-46ff-87c2-f1501e84f0c1', 'Hendrik', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:20:05', '2025-11-26 04:20:05'),
(14, 'd3d9c329-9f85-47fa-bd02-028f8b0193ad', 'Astawi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:20:12', '2025-11-26 04:21:11'),
(15, '6d233ab5-5e19-434e-a852-89cf74316d4e', 'Yuda', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:21:50', '2025-11-26 04:21:50'),
(16, '98cd86ee-2e39-4645-af67-52904a62c0d2', 'Abdurrahman', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:22:06', '2025-11-26 04:22:06'),
(17, '9eac3e5a-7ef2-4cc3-8844-d0a6ed9ede52', 'Saeful', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:22:13', '2025-11-26 04:22:13'),
(18, '6787c4fa-5e31-45b8-8fd1-ddc9a0a85202', 'Milda', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:22:20', '2025-11-26 04:22:20'),
(19, 'f79b8c71-7bd1-4838-a950-c6dbba4cdf12', 'Jaka', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:22:26', '2025-11-26 04:22:26'),
(20, 'afa29b43-8d36-4e7f-b3a3-e09df7bae179', 'Ghozali', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:23:17', '2025-11-26 04:23:17'),
(21, 'd1c3e86f-71ad-4481-8985-f1d9a80c44eb', 'Iin Janah', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:23:30', '2025-11-26 04:23:30'),
(22, 'bc10667d-dedd-4f49-b3a5-938beaf584fb', 'Dwi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:23:36', '2025-11-26 04:23:36'),
(23, '78395cec-a85c-4d2c-b21b-942f5fc42030', 'Muhimin', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:23:44', '2025-11-26 04:23:44'),
(24, 'da247f56-f2d5-43b1-b385-5790008e65a4', 'Arif', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:07', '2025-11-26 04:25:07'),
(25, 'f0938c9f-23e0-4fc1-9346-00999aa43754', 'Omar', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:13', '2025-11-26 04:25:13'),
(26, 'a570a868-d45d-4f30-a413-7532f9646162', 'Sumanto', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:19', '2025-11-26 04:25:19'),
(27, '9ef80b71-23d5-45b9-916a-e179205b47c3', 'Andi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:26', '2025-11-26 04:25:26'),
(28, '4dbeb186-d151-4e74-9f47-3e9f25ebd4ba', 'Khoirudin', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:36', '2025-11-26 04:25:36'),
(29, '458db84f-ab15-44d5-98e4-787ca8d41a34', 'Ahmad (sanitasi)', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:48', '2025-11-26 04:25:48'),
(30, 'c8ad40f1-760e-4358-969e-6f24b01ddd0f', 'Norin', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:25:55', '2025-11-26 04:25:55'),
(31, '31822e44-06f6-466a-a49c-f869008888c0', 'Achmad (eng)', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:26:18', '2025-11-26 04:26:18'),
(32, '39a6e090-70c6-4be1-97a6-db08c1cec599', 'Anggi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:26:31', '2025-11-26 04:26:31'),
(33, 'f7a4c6da-0256-4958-ae7e-61fe053c5e88', 'Azka Reza', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:26:47', '2025-11-26 04:26:47'),
(34, '57651df9-f0e0-41a0-831e-795f827b83d2', 'Dika', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:26:55', '2025-11-26 04:26:55'),
(35, '929194a4-ebee-4608-ace2-c8802658ad1a', 'Kiki', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:01', '2025-11-26 04:27:01'),
(36, '3d5b3361-bb39-42b9-8622-06753db82571', 'Tison', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:16', '2025-11-26 04:27:16'),
(37, 'c1fc0a8b-d297-4340-8cb2-c8ff9340d6b4', 'Yogie', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:22', '2025-11-26 04:27:22'),
(38, '7d40aedc-a10e-4599-bcd5-f54afcad0706', 'Nursetyo', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:30', '2025-11-26 04:27:30'),
(39, 'a8ad7095-7fd7-4fd6-9918-242625004d83', 'Dendi', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:39', '2025-11-26 04:27:39'),
(40, '04ca03a7-dc1d-417b-ab69-707af1c1d7ae', 'Yoga (sanitasi)', 'MP - CHAMBER - SANITASI', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:27:57', '2025-11-26 06:49:06'),
(41, '0b92b486-9f0b-4200-af81-f3278db147ce', 'Edo', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:09', '2025-11-26 04:29:09'),
(42, '15a6716a-66f1-4ff1-b0a6-641b9061e160', 'Endang', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:22', '2025-11-26 04:30:05'),
(43, 'b6018baa-c8b8-4c73-8331-0524318e792d', 'Agus', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:27', '2025-11-26 04:29:27'),
(44, '25351de1-290e-494d-abc9-320eed9dec58', 'Roni', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:34', '2025-11-26 04:29:34'),
(45, '9d8db3ae-9001-45c2-aaed-e9749cb4a697', 'Surya', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:39', '2025-11-26 04:29:39'),
(46, '08626d78-f3d7-42c0-ab09-68a007f0f40a', 'Sarip', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:48', '2025-11-26 04:30:00'),
(47, 'c5ed8b8d-6c8e-44f4-9b94-682a54684d4b', 'Subhan', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:29:55', '2025-11-26 04:29:55'),
(48, 'a70d09fc-3616-4d3d-85e6-83e95751252f', 'Amin', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:30:25', '2025-11-26 04:30:25'),
(49, 'da1296b0-c40a-4560-ac69-a11d506d6bb5', 'Jamal', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:30:30', '2025-11-26 04:30:30'),
(50, 'a3edee37-bfc9-4a10-a0eb-8d908c134043', 'Arif', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:30:40', '2025-11-26 04:30:40'),
(51, '4eb4703a-ad6c-4517-8078-2f1b21e857a9', 'Ambriah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:30:48', '2025-11-26 04:31:10'),
(52, '6a2c1a48-881f-441d-b436-b99bbfbcbc0f', 'Siti Fatimah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:30:58', '2025-11-26 04:31:05'),
(53, 'ae7e4349-b320-4d7c-a527-aa9dd1c62927', 'Fitri', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:31:28', '2025-11-26 04:31:28'),
(54, '1f071254-9798-4702-a870-1a6dc749c791', 'Lafifah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:31:38', '2025-11-26 04:31:38'),
(55, '7fd59178-3966-49e6-808a-8b18fdb31374', 'Sanilah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:31:44', '2025-11-26 04:31:44'),
(56, '12b54d0c-c0f1-4570-9f31-fbbc28e65809', 'Nurfadilah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:31:55', '2025-11-26 04:31:55'),
(57, '723ba830-29dc-468a-95a2-a0991e96d657', 'Lisna', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:32:07', '2025-11-26 04:32:07'),
(58, '3c093cbf-2a5d-47be-91a7-a124a297374e', 'Eka', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:32:18', '2025-11-26 04:32:18'),
(59, 'e8edf84e-273f-4470-821f-f9c2afd9bea8', 'Sri', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:33:01', '2025-11-26 04:33:01'),
(60, 'd1ec7d63-f511-46a1-9255-662a0294a8e0', 'Widya', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:33:09', '2025-11-26 04:33:09'),
(61, '7713e91a-0247-4bf8-acd6-7adb5b12e3c4', 'Omar', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 04:33:16', '2025-11-26 04:33:16'),
(62, 'd8db42ef-3fcf-4dda-907b-3cc5d8afa502', 'Sumanto', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:11:09', '2025-11-26 06:11:09'),
(63, 'ba20e804-998d-4b3f-a73e-4e7b39254c26', 'Khoirudin', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:11:22', '2025-11-26 06:11:22'),
(64, '6a677497-71ad-446c-bf34-034d656a83a2', 'Ahmad (sanitasi)', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:11:39', '2025-11-26 06:11:39'),
(65, '2c4d6eab-0d90-4625-b08c-427b18fedf1d', 'Norin', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:11:47', '2025-11-26 06:11:47'),
(66, '6f07bac5-5b3a-4250-8001-a521902db8b4', 'Achmad (Eng)', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:11:58', '2025-11-26 06:11:58'),
(67, '89700074-5868-4a96-8ce4-cfaca83c9c61', 'Anggi', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:05', '2025-11-26 06:12:09'),
(68, '6e67994d-515b-4406-8708-1c9fef6579f9', 'Azka Reza', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:17', '2025-11-26 06:12:17'),
(69, '60364875-143e-4136-aa21-c854bf4d7917', 'Dika', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:35', '2025-11-26 06:12:35'),
(70, '53249485-800c-45ef-980f-8a8222cbcaef', 'Kiki', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:40', '2025-11-26 06:12:40'),
(71, '7075356f-04f9-4a18-ae27-2cadc08136c9', 'Tison', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:48', '2025-11-26 06:12:48'),
(72, 'e23e4da2-363e-48f6-8edd-79099f950a0f', 'Yogie', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:12:54', '2025-11-26 06:12:59'),
(73, '139e0cab-4e0d-450f-bdaa-aeb92d4bb810', 'Nursetyo', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:11', '2025-11-26 06:13:11'),
(74, '8bd0f147-ed4d-4e9f-9d97-60ae9671d12a', 'Aulia', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:18', '2025-11-26 06:13:18'),
(75, 'fcc08d41-bfd5-4ae7-adb8-ed3ea5764bb2', 'Desi', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:24', '2025-11-26 06:13:24'),
(76, '4ba56234-b5f7-470d-8758-b18f4a4c322a', 'Dendi', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:32', '2025-11-26 06:13:32'),
(77, '6b3947f3-5eef-49de-91d6-9876b6dedabf', 'Salamah', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:39', '2025-11-26 06:13:39'),
(78, 'd7626eab-62d2-44d4-a696-abb9a1444012', 'Sandi', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:47', '2025-11-26 06:13:47'),
(79, 'a15c0783-c5e8-4859-b7c3-4563f4e9db6f', 'Rahmat', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:13:55', '2025-11-26 06:13:55'),
(80, '2fbb5ada-8c7a-497c-9265-612eff0061e9', 'Yoga (sanitasi)', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:14:11', '2025-11-26 06:14:11'),
(81, 'ca268dd1-aa93-46dd-af38-4b64e95ce368', 'Jasti', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:14:19', '2025-11-26 06:14:19'),
(82, 'd569d465-b4c7-4bde-8eba-36f468b0c9d8', 'Romli', 'FILLING - SUSUN', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:14:31', '2025-11-26 06:14:31'),
(83, '6640a9b1-cf9c-4c23-92a4-3923d4dfd91e', 'Dayat', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:15:15', '2025-11-26 06:15:15'),
(84, 'c30eeb28-83ee-4167-be74-51db74897f65', 'Hafid', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:15:24', '2025-11-26 06:15:24'),
(85, '57855681-7038-47dd-aa9e-dbd24519c8fb', 'Wantini', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:15:30', '2025-11-26 06:15:38'),
(86, '3e69bbbd-259c-411e-96a4-d50249ac686d', 'Dadan', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:15:53', '2025-11-26 06:15:53'),
(87, 'b17da749-29ad-49e5-9b84-c96200e868f3', 'Elis', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:15:59', '2025-11-26 06:15:59'),
(88, 'd9f71f28-6b75-44b2-9d43-e621b81ae487', 'Kiki', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:07', '2025-11-26 06:16:07'),
(89, '376ef3b8-6cae-4fc3-bad2-269b0f76b49a', 'Neneng', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:15', '2025-11-26 06:16:15'),
(90, 'f41a56d9-d423-4fa4-a319-9b25241aaf35', 'Jelsika', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:22', '2025-11-26 06:16:22'),
(91, '0a33f6f0-7e1f-4f12-9b99-531f6fb9bb83', 'Sri', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:32', '2025-11-26 06:16:48'),
(92, 'f6161546-2c33-490e-9a60-9979167d1688', 'Erna', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:43', '2025-11-26 06:16:43'),
(93, '8119dfe3-20dc-46a0-9ed8-8c53c5175ebb', 'Devita', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:16:59', '2025-11-26 06:16:59'),
(94, '48432ca4-b4fb-497b-8a1a-4431d51089b2', 'Mayang Anjelly', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:17:33', '2025-11-26 06:17:33'),
(95, 'da7176de-41b4-4717-b18c-9cb260b1be6a', 'Nur Azizah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:17:43', '2025-11-26 06:17:43'),
(96, '1edc0c9e-7db7-4b09-9e57-8c57aaaa8e6b', 'Sulkah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:17:49', '2025-11-26 06:17:49'),
(97, 'b3ddb653-7862-4401-9f76-f8f14941bd0b', 'Cici', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:17:59', '2025-11-26 06:17:59'),
(98, '8a6b14c7-aa9c-4c4b-8307-49dc69d73fe9', 'Nurhaeti', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:18:08', '2025-11-26 06:18:08'),
(99, 'bf97025f-060e-4079-98c5-f3c9a059bc70', 'Kasmi', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:18:21', '2025-11-26 06:18:21'),
(100, '76ab1581-d102-4726-b7ae-9ba6d077551c', 'Yuliyana', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:18:29', '2025-11-26 06:18:38'),
(101, 'e46e6a53-dba8-4cfa-9ba3-ed501bfe23fd', 'Diah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:18:48', '2025-11-26 06:18:48'),
(102, '25682016-b506-4c8a-a537-d06bcb897163', 'Tinah Agustina', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:00', '2025-11-26 06:19:00'),
(103, '384ec2e5-23bf-4dc7-94e0-f9c8baa58be3', 'Nabila J', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:10', '2025-11-26 06:19:10'),
(104, 'bd42541c-637d-46f0-8c8e-dd7689a3a740', 'Ika Nurlela', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:22', '2025-11-26 06:19:22'),
(105, 'f47c8955-57e5-4c15-9ebf-b2bae695d980', 'Fitri M', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:34', '2025-11-26 06:19:34'),
(106, '3d2f66e0-8c90-4b21-87b8-44c827113c39', 'Dedi', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:40', '2025-11-26 06:19:40'),
(107, '0e3d94f4-360d-448a-94c7-276c89ebe211', 'Sarmilah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:19:48', '2025-11-26 06:19:48'),
(108, '13a36e54-1323-4635-8a14-845381d7c894', 'Nurlaela', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:20:11', '2025-11-26 06:20:11'),
(109, '01b31ec0-debd-41f2-ba09-f20a884c528b', 'Eri', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:20:25', '2025-11-26 06:20:25'),
(110, 'ea8b0dbf-6dcb-4957-a90f-ede37fdadbfc', 'Nurul', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:20:32', '2025-11-26 06:20:32'),
(111, '46c814f9-17d9-4c62-a811-5c29adbf8e5a', 'Nurrohmah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:20:43', '2025-11-26 06:20:43'),
(112, '0d74cbd0-3dd1-4afa-8fbd-773b9f1611b0', 'Isma Husna', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:20:59', '2025-11-26 06:20:59'),
(113, 'd925a211-0bd8-44e4-9f43-726dd3b2630c', 'Iis', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:21:17', '2025-11-26 06:21:17'),
(114, '44eb1465-f2d1-446e-ac21-134a54110b8b', 'Sumiyati', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:21:30', '2025-11-26 06:21:30'),
(115, 'd0547493-a215-4c46-a134-d8328adedc9b', 'Siska Aprianti', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:21:51', '2025-11-26 06:21:51'),
(116, '3e691168-baaa-4c02-ac1d-f5fae252bc4c', 'Omar', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:21:58', '2025-11-26 06:21:58'),
(117, '40dbc5b5-c8b2-4ea1-b9c6-00287188acc3', 'Sumanto', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:22:12', '2025-11-26 06:22:12'),
(118, '02b5163e-5bff-444b-b9e6-a2d71cec4ac7', 'Khoirudin', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:22:21', '2025-11-26 06:22:21'),
(119, '1146e90b-6311-4445-af86-03f3b1652ad9', 'Ahmad (sanitasi)', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:22:56', '2025-11-26 06:22:56'),
(120, '94825036-ed6b-4d09-8432-67497e469205', 'Norin', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:23:04', '2025-11-26 06:23:04'),
(121, '600428f9-965f-4696-8ca7-85ae864f65f0', 'Achmad (Eng)', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:23:28', '2025-11-26 06:23:28'),
(122, '720845fd-1ba0-4f58-8107-da747a987a01', 'Anggi', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:23:42', '2025-11-26 06:23:42'),
(123, '787adffb-0912-4510-b402-26cb5335d5a7', 'Azka Reza', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:23:53', '2025-11-26 06:23:53'),
(124, 'a1a28644-9e87-42df-9548-39bc92dcfde3', 'Dika', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:24:00', '2025-11-26 06:24:00'),
(125, '11b1feb4-e535-49e1-a05e-589fc5571e48', 'Kiki', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:37:18', '2025-11-26 06:37:18'),
(126, 'ef9536df-ec49-4468-9de6-1fc67320cd1d', 'Tison', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:37:26', '2025-11-26 06:37:26'),
(127, '646f778f-2973-4918-ac13-a5742697691a', 'Yogie', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:37:33', '2025-11-26 06:37:33'),
(128, 'a0009cad-7c22-45cc-a031-84f37669a469', 'Nursetyo', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:37:47', '2025-11-26 06:37:47'),
(129, '67c57a1f-a6b7-4bd4-81fd-c9ce29700b91', 'Dahlia', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:37:54', '2025-11-26 06:37:54'),
(130, 'e36c2f65-b43d-4a4c-ac76-ed2006d4575b', 'Kusnadi', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:38:07', '2025-11-26 06:38:07'),
(131, '9b8725dd-5ee4-4701-87d7-c52d94eeb751', 'Dendi', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:38:16', '2025-11-26 06:38:16'),
(132, '28b67158-fe75-4a2b-943f-df73f8e644af', 'Junenah', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:38:25', '2025-11-26 06:38:25'),
(133, '886a5f4b-1e89-4042-ad58-270129485ba3', 'Eri Kiswanto', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:39:26', '2025-11-26 06:39:26'),
(134, '474d244b-76c2-4c22-9385-ae7d038e2135', 'Yoga (sanitasi)', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:39:48', '2025-11-26 06:39:48'),
(135, '0c59737a-a32f-43ae-94bc-deb19798e31c', 'Subat', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:39:56', '2025-11-26 06:39:56'),
(136, 'ee82e91d-41fb-4d5a-a9a5-53787438e37d', 'Agung', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:40:06', '2025-11-26 06:40:06'),
(137, 'f6545fb5-6e60-4f4b-9f9e-797d1cde6c12', 'Salam', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:40:16', '2025-11-26 06:40:16'),
(138, '7799b4df-1641-4652-b8a8-4387dc2c94e5', 'Iin', 'KARANTINA - PACKING', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:40:26', '2025-11-26 06:40:26'),
(139, 'c427e4c2-2871-429f-8efe-a7341ce0872b', 'Rosita', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:42:51', '2025-11-26 06:42:51'),
(140, 'ed8651ad-a6f6-456f-880a-150491531443', 'Simah', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:43:09', '2025-11-26 06:43:09'),
(141, 'fff1293f-02c2-44a1-acca-45595b8615d7', 'Riska', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:43:31', '2025-11-26 06:43:31'),
(142, '6181c187-8058-4351-8540-253f48db608d', 'Yuli', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:43:46', '2025-11-26 06:43:46'),
(143, '3425b22b-6935-43fb-b414-57567147a551', 'Madsuki', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:44:07', '2025-11-26 06:44:07'),
(144, '6f7999e3-dbaa-41c7-9d18-c90a13691c6f', 'Fery', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:44:15', '2025-11-26 06:44:15'),
(145, '2cb2f189-42cd-4eb3-ba61-41cf9b479b9b', 'Saadah', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:44:23', '2025-11-26 06:44:23'),
(146, '797aaba5-45fe-4a1c-a056-e14d5d516897', 'Regita', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:44:31', '2025-11-26 06:44:31'),
(148, '1a2c4827-2ef9-48ba-b49e-5014d03c818e', 'Rita', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:01', '2025-11-26 06:45:01'),
(149, '65f2bb6b-10b7-4fa8-aa05-e8bc0dc95b46', 'Syariful', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:20', '2025-11-26 06:45:20'),
(150, '1879ed15-d37f-4624-99af-5edaac7d53b8', 'Arnis', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:30', '2025-11-26 06:45:30'),
(151, '3538501e-864d-48d0-b079-56b428bf77de', 'Omar', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:36', '2025-11-26 06:45:36'),
(152, 'aeb83734-fb1f-48b8-8996-ad943a5e4720', 'Sumanto', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:46', '2025-11-26 06:45:46'),
(153, '1664a7ad-2593-41a2-b63d-3c8f8a387d68', 'Khoirudin', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:45:57', '2025-11-26 06:45:57'),
(154, 'a8885a00-0c41-4991-ac86-7cff67c53e8b', 'Ahmad (sanitasi)', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:46:08', '2025-11-26 06:46:08'),
(155, '712c82fb-e57a-435c-b63a-25c53d6a2b16', 'Norin', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:46:19', '2025-11-26 06:46:19'),
(156, '0d0c2bed-aaa8-4c22-9ca3-46ecaaa6c82c', 'Achmad (Eng)', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:46:33', '2025-11-26 06:46:33'),
(157, 'f8097eef-fc96-4b73-b8c4-9a5f1b434669', 'Anggi', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:46:41', '2025-11-26 06:46:41'),
(158, '7e98a3c7-5658-497f-a342-545a323d025c', 'Azka Reza', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:46:53', '2025-11-26 06:46:53'),
(159, '2c921ab6-39e9-43ae-8ec2-6e5580ba0b1b', 'Dika', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:47:06', '2025-11-26 06:47:06'),
(160, '8a0a9ef7-fa74-4b4e-b3b8-f0d8332ace4a', 'Kiki', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:47:13', '2025-11-26 06:47:13'),
(161, '7ed4e88f-5a20-4a2e-8264-340700d5f45d', 'Tison', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:47:21', '2025-11-26 06:47:21'),
(162, '6e29b13e-9fb5-4f5a-ada0-6aeb2cf2ea65', 'Yogie', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:47:30', '2025-11-26 06:47:30'),
(163, '32f6d084-6bff-4553-a9b1-c2aded741ee1', 'Nursetyo', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:47:45', '2025-11-26 06:47:45'),
(164, '5f436580-ccfb-4444-8f60-18e343769e10', 'Dendi', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:48:02', '2025-11-26 06:48:02'),
(165, 'b802f90e-e499-4b72-9ee5-787b5f1cc8b0', 'Adelia', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:48:12', '2025-11-26 06:48:12'),
(166, '626b23d1-e92b-4f82-94fe-31c9983a174a', 'Yoga (sanitasi)', 'SAMPLING FG', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26 06:48:27', '2025-11-26 06:48:27');

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

--
-- Dumping data for table `pvdcs`
--

INSERT INTO `pvdcs` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `nama_supplier`, `tgl_kedatangan`, `tgl_expired`, `data_pvdc`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019abe2d-656c-710c-9bee-4e3c0b6470b0', 'admin', 'admin', '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SROA Ayam Bakar', 'PT. Intikemas', '2025-11-26', '2025-11-26', '\"[{\\\"mesin\\\":\\\"ZAP 4\\\",\\\"detail\\\":[{\\\"batch\\\":\\\"WASD21\\\",\\\"no_lot\\\":\\\"12\\\",\\\"waktu\\\":\\\"01:16\\\"}]},{\\\"mesin\\\":\\\"C2\\\",\\\"detail\\\":[{\\\"batch\\\":\\\"AS41\\\",\\\"no_lot\\\":\\\"123\\\",\\\"waktu\\\":\\\"17:53\\\"},{\\\"batch\\\":\\\"ADSA\\\",\\\"no_lot\\\":\\\"1\\\",\\\"waktu\\\":\\\"18:53\\\"},{\\\"batch\\\":\\\"asda\\\",\\\"no_lot\\\":\\\"3\\\",\\\"waktu\\\":\\\"18:53\\\"}]}]\"', NULL, 'admin', '1', NULL, '2025-12-01 08:04:29', '2025-11-26 03:20:37', '2025-12-01 08:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_inspections`
--

CREATE TABLE `raw_material_inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `setup_kedatangan` datetime NOT NULL,
  `bahan_baku` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `mobil_check_warna` tinyint(1) NOT NULL DEFAULT 0,
  `mobil_check_kotoran` tinyint(1) NOT NULL DEFAULT 0,
  `mobil_check_aroma` tinyint(1) NOT NULL DEFAULT 0,
  `mobil_check_kemasan` tinyint(1) NOT NULL DEFAULT 0,
  `nopol_mobil` varchar(255) NOT NULL,
  `suhu_mobil` varchar(255) NOT NULL,
  `kondisi_mobil` enum('Bersih','Kotor','Bau','Bocor','Basah','Kering','Bebas Hama') NOT NULL,
  `do_po` varchar(255) NOT NULL,
  `no_segel` varchar(255) NOT NULL,
  `suhu_daging` decimal(5,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `analisa_ka_ffa` tinyint(1) NOT NULL DEFAULT 0,
  `analisa_logo_halal` tinyint(1) NOT NULL DEFAULT 0,
  `analisa_negara_asal` varchar(255) NOT NULL,
  `analisa_produsen` varchar(255) NOT NULL,
  `dokumen_halal_berlaku` tinyint(1) NOT NULL DEFAULT 0,
  `dokumen_halal_file` varchar(255) DEFAULT NULL,
  `dokumen_coa_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Pending, 1: Verified, 2: Revision',
  `catatan_spv` text DEFAULT NULL,
  `verified_by_spv_uuid` char(36) DEFAULT NULL,
  `verified_at_spv` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recalls`
--

CREATE TABLE `recalls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `asal_informasi` varchar(255) NOT NULL,
  `jenis_pangan` varchar(255) DEFAULT NULL,
  `nama_dagang` varchar(255) DEFAULT NULL,
  `berat_bersih` decimal(8,2) DEFAULT NULL,
  `jenis_kemasan` varchar(255) DEFAULT NULL,
  `kode_produksi` varchar(255) DEFAULT NULL,
  `tanggal_produksi` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `no_pendaftaran` varchar(255) DEFAULT NULL,
  `diproduksi_oleh` varchar(255) DEFAULT NULL,
  `jumlah_produksi` decimal(8,2) DEFAULT NULL,
  `jumlah_terkirim` decimal(8,2) DEFAULT NULL,
  `jumlah_tersisa` decimal(8,2) DEFAULT NULL,
  `tindak_lanjut` varchar(255) DEFAULT NULL,
  `distribusi` longtext DEFAULT NULL,
  `neraca_penarikan` longtext DEFAULT NULL,
  `simulasi` longtext DEFAULT NULL,
  `total_waktu` decimal(8,2) DEFAULT NULL,
  `evaluasi` longtext DEFAULT NULL,
  `nama_manager` varchar(255) DEFAULT NULL,
  `status_manager` varchar(255) DEFAULT NULL,
  `catatan_manager` varchar(255) DEFAULT NULL,
  `tgl_update_manager` timestamp NULL DEFAULT NULL,
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
(1, '019a9b4c-0fa4-73e4-a846-389cf1660e01', 'admin', NULL, 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19', '2', 'Seasoning', '\"{\\\"Lantai\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Dinding\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Pintu dan Tirai\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Rak\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null},\\\"Timbangan\\\":{\\\"waktu\\\":\\\"15:47\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null}}\"', 'Foreman Produksi', '1', '2025-11-19 09:47:24', NULL, '0', NULL, NULL, '2025-11-19 08:47:24', '2025-11-19 08:47:24'),
(2, '019ac974-096f-73d6-9782-8fdf2dfd98a4', 'admin', 'admin', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-28', '1', 'Seasoning', '\"{\\\"Lantai\\\":{\\\"waktu\\\":\\\"14:53\\\",\\\"kondisi\\\":\\\"1\\\",\\\"keterangan\\\":\\\"bekas cleaning\\\",\\\"tindakan\\\":\\\"keringin\\\",\\\"waktu_koreksi\\\":\\\"19:53\\\",\\\"dikerjakan_oleh\\\":\\\"sanitasi\\\",\\\"waktu_verifikasi\\\":\\\"17:54\\\"},\\\"Dinding\\\":{\\\"waktu\\\":\\\"14:53\\\",\\\"kondisi\\\":\\\"5\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":\\\"17:55\\\",\\\"dikerjakan_oleh\\\":\\\"sanitasi\\\",\\\"waktu_verifikasi\\\":null},\\\"Pintu dan Tirai\\\":{\\\"waktu\\\":\\\"14:53\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null,\\\"dikerjakan_oleh\\\":null,\\\"waktu_verifikasi\\\":null},\\\"Rak\\\":{\\\"waktu\\\":\\\"14:53\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null,\\\"dikerjakan_oleh\\\":null,\\\"waktu_verifikasi\\\":null},\\\"Timbangan\\\":{\\\"waktu\\\":\\\"14:53\\\",\\\"kondisi\\\":\\\"\\u2714\\\",\\\"keterangan\\\":null,\\\"tindakan\\\":null,\\\"waktu_koreksi\\\":null,\\\"dikerjakan_oleh\\\":null,\\\"waktu_verifikasi\\\":null}}\"', 'Produksi RTT', '1', '2025-11-28 08:53:36', 'admin', '1', NULL, '2025-11-29 05:06:20', '2025-11-28 07:53:36', '2025-11-29 05:06:20');

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

--
-- Dumping data for table `suhus`
--

INSERT INTO `suhus` (`id`, `uuid`, `username`, `username_updated`, `plant`, `date`, `shift`, `pukul`, `hasil_suhu`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ac962-887a-71b0-8c42-81ad8b7e2a1c', 'admin', NULL, 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-28', '1', '19:00:00', '\"[{\\\"area\\\":\\\"Chill Room (Meat)\\\",\\\"nilai\\\":\\\"11\\\"},{\\\"area\\\":\\\"Chill Room (Ruang)\\\",\\\"nilai\\\":\\\"3\\\"},{\\\"area\\\":\\\"Cold Storage (Meat)\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Cold Storage (Ruang)\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Dry Store\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Hopper\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Meat Preparation\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"PVDC\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Retort Chamber\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"RH Drying\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"RH Finish Good\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"RH Packing\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Seasoning\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Stuffer\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Suhu Drying\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Suhu Finish Good\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Suhu Packing\\\",\\\"nilai\\\":null},{\\\"area\\\":\\\"Susun\\\",\\\"nilai\\\":null}]\"', NULL, NULL, 'Produksi RTT', '1', '2025-11-28 08:34:29', 'admin', '1', NULL, '2025-11-29 05:06:03', '2025-11-28 07:34:29', '2025-11-29 05:06:03');

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
  `alamat` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `uuid`, `username`, `nama_supplier`, `jenis_barang`, `alamat`, `plant`, `created_at`, `updated_at`) VALUES
(1, '0cd1129e-b88c-4078-b82d-1d33a0633b9c', 'admin', 'Cikande 1', 'Raw Material', 'Cikande Banten', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:41', '2025-11-27 08:58:12'),
(2, '5da1b537-9762-409a-89da-e05ff8c661eb', 'admin', 'PT. Intikemas', 'Packaging', 'Bekasi', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-19 07:31:46', '2025-11-27 09:47:50'),
(3, 'ea34f7d1-4f68-4a8d-8c75-393903a0e1cc', 'admin', 'DC Manis', 'Distributor', 'Karawang', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-27 09:47:44', '2025-11-27 09:47:44');

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
-- Table structure for table `traceabilities`
--

CREATE TABLE `traceabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `asal_informasi` varchar(255) NOT NULL,
  `jenis_pangan` varchar(255) DEFAULT NULL,
  `nama_dagang` varchar(255) DEFAULT NULL,
  `berat_bersih` decimal(8,2) DEFAULT NULL,
  `jenis_kemasan` varchar(255) DEFAULT NULL,
  `kode_produksi` varchar(255) DEFAULT NULL,
  `tanggal_produksi` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `no_pendaftaran` varchar(255) DEFAULT NULL,
  `jumlah_produksi` decimal(8,2) DEFAULT NULL,
  `tindak_lanjut` varchar(255) DEFAULT NULL,
  `persetujuan_trace` varchar(255) DEFAULT NULL,
  `kelengkapan_form` longtext DEFAULT NULL,
  `total_waktu` varchar(255) DEFAULT NULL,
  `kesimpulan` longtext DEFAULT NULL,
  `nama_manager` varchar(255) DEFAULT NULL,
  `status_manager` varchar(255) DEFAULT NULL,
  `catatan_manager` varchar(255) DEFAULT NULL,
  `tgl_update_manager` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traceabilities`
--

INSERT INTO `traceabilities` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `penyebab`, `asal_informasi`, `jenis_pangan`, `nama_dagang`, `berat_bersih`, `jenis_kemasan`, `kode_produksi`, `tanggal_produksi`, `tanggal_kadaluarsa`, `no_pendaftaran`, `jumlah_produksi`, `tindak_lanjut`, `persetujuan_trace`, `kelengkapan_form`, `total_waktu`, `kesimpulan`, `nama_manager`, `status_manager`, `catatan_manager`, `tgl_update_manager`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(3, '019ace22-276f-70bb-bfb6-5358988d613e', 'admin', 'admin', '2025-11-29', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'asdad', 'asdada', 'asdad', 'asd', '13.00', 'asda', 'asda', '2025-07-17', '2026-02-17', 'qweq', '31.00', 'adsa', 'Setuju', '\"[{\\\"laporan\\\":\\\"Pemeriksaan Input Bahan Baku\\\",\\\"no_dokumen\\\":\\\"FR-QC-01\\\",\\\"kelengkapan\\\":\\\"Lengkap\\\",\\\"waktu_telusur\\\":\\\"01:42\\\"},{\\\"laporan\\\":\\\"Pemeriksaan Input Bahan Baku\\\",\\\"no_dokumen\\\":\\\"FR-QC-01\\\",\\\"kelengkapan\\\":\\\"Tidak Lengkap\\\",\\\"waktu_telusur\\\":\\\"04:42\\\"},{\\\"laporan\\\":\\\"Pemeriksaan Input Bahan Baku\\\",\\\"no_dokumen\\\":\\\"FR-QC-01\\\",\\\"kelengkapan\\\":\\\"Lengkap\\\",\\\"waktu_telusur\\\":\\\"06:03\\\"}]\"', '12 jam 27 menit', 'bvsndfnsd fsdfSNAf;lonSDLFN j ndfasj', 'admin', '1', NULL, '2025-12-01 03:24:10', 'admin', '1', NULL, '2025-11-29 06:04:15', '2025-11-29 05:42:16', '2025-12-01 03:24:10');

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
(21, '0199dc8d-2dce-7294-859d-8ba6b6c82e3e', 'admin2', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '1', '0', NULL, 'admin2', 'admin2@example.com', NULL, '$2y$10$0K7bcblr/erit.iFY97cseSEapx6NzMJM.uXo7yl/AjJW4RfDtdsm', NULL, '2025-10-13 00:51:03', '2025-10-13 00:51:03', 0, 'Admin'),
(22, '0199dc8d-ed0a-70f7-b5fa-a2220bb2b734', 'foreman_brbk', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2', '3', NULL, 'Foreman Produksi B', 'foreman2@example.com', NULL, '$2y$10$1kHnh3VfP6Nl0ETi4fbPCe0zhBt28lJZQoxCpcqA2LLUIwE1SNF/O', NULL, '2025-10-13 00:51:52', '2025-10-13 00:51:52', 0, 'Admin'),
(23, '019ab9f1-3699-72ec-9d31-b764a0b30ede', 'harnisuh', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '4', NULL, 'Harnis', 'putriharnis23@gmail.com', NULL, '$2y$10$2pelzQUkrzD8rGVsh7QoK.5Uf/z3Nm4T/LX4w7G.kTUu8xrNu8gGq', NULL, '2025-11-25 07:36:24', '2025-11-25 07:36:24', 0, 'Admin');

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

-- --------------------------------------------------------

--
-- Table structure for table `withdrawls`
--

CREATE TABLE `withdrawls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `no_withdrawl` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `exp_date` date NOT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `jumlah_edar` int(11) DEFAULT NULL,
  `tanggal_edar` date DEFAULT NULL,
  `jumlah_tarik` int(11) DEFAULT NULL,
  `tanggal_tarik` date DEFAULT NULL,
  `rincian` longtext DEFAULT NULL,
  `nama_manager` varchar(255) DEFAULT NULL,
  `catatan_manager` varchar(255) DEFAULT NULL,
  `status_manager` varchar(255) DEFAULT NULL,
  `tgl_update_manager` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawls`
--

INSERT INTO `withdrawls` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `no_withdrawl`, `nama_produk`, `kode_produksi`, `exp_date`, `jumlah_produksi`, `jumlah_edar`, `tanggal_edar`, `jumlah_tarik`, `tanggal_tarik`, `rincian`, `nama_manager`, `catatan_manager`, `status_manager`, `tgl_update_manager`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ac48a-31ff-7119-a4d5-98700a64cc9b', 'admin', NULL, '2025-11-27', 'fdaca613-7ab2-4997-8f33-686e886c867d', '01', 'SRCH Ayam Original', 'OL19101AA0', '2026-07-18', 1200, 20, '2025-11-17', 200, '2025-02-24', '\"[{\\\"nama_supplier\\\":\\\"DC Manis\\\",\\\"alamat\\\":\\\"Karawang\\\",\\\"jumlah\\\":\\\"11\\\"},{\\\"nama_supplier\\\":\\\"DC Manis\\\",\\\"alamat\\\":\\\"Karawang\\\",\\\"jumlah\\\":\\\"12\\\"},{\\\"nama_supplier\\\":\\\"DC Manis\\\",\\\"alamat\\\":\\\"Karawang\\\",\\\"jumlah\\\":\\\"20\\\"}]\"', 'admin', 'asda', '2', '2025-11-27 09:18:09', 'admin', '1', NULL, '2025-11-27 09:34:12', '2025-11-27 08:59:42', '2025-11-27 10:01:57');

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
-- Indexes for table `berita_acaras`
--
ALTER TABLE `berita_acaras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_acaras_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `berita_acaras_nomor_unique` (`nomor`),
  ADD KEY `berita_acaras_created_by_foreign` (`created_by`),
  ADD KEY `berita_acaras_ppic_verified_by_foreign` (`ppic_verified_by`),
  ADD KEY `berita_acaras_spv_verified_by_foreign` (`spv_verified_by`);

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
-- Indexes for table `dispositions`
--
ALTER TABLE `dispositions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dispositions_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `dispositions_nomor_unique` (`nomor`),
  ADD KEY `dispositions_created_by_foreign` (`created_by`),
  ADD KEY `dispositions_verified_by_foreign` (`verified_by`);

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
-- Indexes for table `inspection_product_details`
--
ALTER TABLE `inspection_product_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inspection_product_details_uuid_unique` (`uuid`),
  ADD KEY `inspection_product_details_raw_material_inspection_uuid_foreign` (`raw_material_inspection_uuid`);

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
-- Indexes for table `list_forms`
--
ALTER TABLE `list_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_forms_uuid_unique` (`uuid`);

--
-- Indexes for table `loading_checks`
--
ALTER TABLE `loading_checks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loading_checks_uuid_unique` (`uuid`),
  ADD KEY `loading_checks_created_by_foreign` (`created_by`);

--
-- Indexes for table `loading_details`
--
ALTER TABLE `loading_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loading_details_uuid_unique` (`uuid`),
  ADD KEY `loading_details_loading_check_id_foreign` (`loading_check_id`);

--
-- Indexes for table `magnet_traps`
--
ALTER TABLE `magnet_traps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `magnet_traps_uuid_unique` (`uuid`);

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
-- Indexes for table `packaging_inspections`
--
ALTER TABLE `packaging_inspections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packaging_inspections_uuid_unique` (`uuid`),
  ADD KEY `packaging_inspections_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `packaging_inspection_items`
--
ALTER TABLE `packaging_inspection_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packaging_inspection_items_uuid_unique` (`uuid`),
  ADD KEY `packaging_inspection_items_packaging_inspection_id_foreign` (`packaging_inspection_id`);

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
-- Indexes for table `pemeriksaan_kekuatan_magnet_traps`
--
ALTER TABLE `pemeriksaan_kekuatan_magnet_traps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemeriksaan_kekuatan_magnet_traps_uuid_unique` (`uuid`),
  ADD KEY `pemeriksaan_kekuatan_magnet_traps_created_by_foreign` (`created_by`),
  ADD KEY `pemeriksaan_kekuatan_magnet_traps_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `pemeriksaan_retains`
--
ALTER TABLE `pemeriksaan_retains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemeriksaan_retains_uuid_unique` (`uuid`),
  ADD KEY `pemeriksaan_retains_created_by_foreign` (`created_by`),
  ADD KEY `pemeriksaan_retains_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `pemeriksaan_retain_items`
--
ALTER TABLE `pemeriksaan_retain_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemeriksaan_retain_items_uuid_unique` (`uuid`),
  ADD KEY `pemeriksaan_retain_items_pemeriksaan_retain_id_foreign` (`pemeriksaan_retain_id`);

--
-- Indexes for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemusnahans_uuid_unique` (`uuid`);

--
-- Indexes for table `penyimpangan_kualitas`
--
ALTER TABLE `penyimpangan_kualitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penyimpangan_kualitas_uuid_unique` (`uuid`),
  ADD KEY `penyimpangan_kualitas_created_by_foreign` (`created_by`),
  ADD KEY `penyimpangan_kualitas_diketahui_by_foreign` (`diketahui_by`),
  ADD KEY `penyimpangan_kualitas_disetujui_by_foreign` (`disetujui_by`);

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
-- Indexes for table `raw_material_inspections`
--
ALTER TABLE `raw_material_inspections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `raw_material_inspections_uuid_unique` (`uuid`);

--
-- Indexes for table `recalls`
--
ALTER TABLE `recalls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recalls_uuid_unique` (`uuid`);

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
-- Indexes for table `traceabilities`
--
ALTER TABLE `traceabilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `traceabilities_uuid_unique` (`uuid`);

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
-- Indexes for table `withdrawls`
--
ALTER TABLE `withdrawls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdrawls_uuid_unique` (`uuid`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `area_suhus`
--
ALTER TABLE `area_suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `berita_acaras`
--
ALTER TABLE `berita_acaras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chambers`
--
ALTER TABLE `chambers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dispositions`
--
ALTER TABLE `dispositions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inspection_product_details`
--
ALTER TABLE `inspection_product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartons`
--
ALTER TABLE `kartons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_chambers`
--
ALTER TABLE `list_chambers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_forms`
--
ALTER TABLE `list_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loading_checks`
--
ALTER TABLE `loading_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_details`
--
ALTER TABLE `loading_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `magnet_traps`
--
ALTER TABLE `magnet_traps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesins`
--
ALTER TABLE `mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `mincings`
--
ALTER TABLE `mincings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `organoleptiks`
--
ALTER TABLE `organoleptiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packaging_inspections`
--
ALTER TABLE `packaging_inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packaging_inspection_items`
--
ALTER TABLE `packaging_inspection_items`
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
-- AUTO_INCREMENT for table `pemeriksaan_kekuatan_magnet_traps`
--
ALTER TABLE `pemeriksaan_kekuatan_magnet_traps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaan_retains`
--
ALTER TABLE `pemeriksaan_retains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaan_retain_items`
--
ALTER TABLE `pemeriksaan_retain_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyimpangan_kualitas`
--
ALTER TABLE `penyimpangan_kualitas`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `pvdcs`
--
ALTER TABLE `pvdcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raw_material_inspections`
--
ALTER TABLE `raw_material_inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recalls`
--
ALTER TABLE `recalls`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stuffings`
--
ALTER TABLE `stuffings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suhus`
--
ALTER TABLE `suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `traceabilities`
--
ALTER TABLE `traceabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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

--
-- AUTO_INCREMENT for table `withdrawls`
--
ALTER TABLE `withdrawls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita_acaras`
--
ALTER TABLE `berita_acaras`
  ADD CONSTRAINT `berita_acaras_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `berita_acaras_ppic_verified_by_foreign` FOREIGN KEY (`ppic_verified_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `berita_acaras_spv_verified_by_foreign` FOREIGN KEY (`spv_verified_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL;

--
-- Constraints for table `dispositions`
--
ALTER TABLE `dispositions`
  ADD CONSTRAINT `dispositions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `dispositions_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL;

--
-- Constraints for table `inspection_product_details`
--
ALTER TABLE `inspection_product_details`
  ADD CONSTRAINT `inspection_product_details_raw_material_inspection_uuid_foreign` FOREIGN KEY (`raw_material_inspection_uuid`) REFERENCES `raw_material_inspections` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `loading_details`
--
ALTER TABLE `loading_details`
  ADD CONSTRAINT `loading_details_loading_check_id_foreign` FOREIGN KEY (`loading_check_id`) REFERENCES `loading_checks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packaging_inspections`
--
ALTER TABLE `packaging_inspections`
  ADD CONSTRAINT `packaging_inspections_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `packaging_inspection_items`
--
ALTER TABLE `packaging_inspection_items`
  ADD CONSTRAINT `packaging_inspection_items_packaging_inspection_id_foreign` FOREIGN KEY (`packaging_inspection_id`) REFERENCES `packaging_inspections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemeriksaan_kekuatan_magnet_traps`
--
ALTER TABLE `pemeriksaan_kekuatan_magnet_traps`
  ADD CONSTRAINT `pemeriksaan_kekuatan_magnet_traps_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `pemeriksaan_kekuatan_magnet_traps_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL;

--
-- Constraints for table `pemeriksaan_retains`
--
ALTER TABLE `pemeriksaan_retains`
  ADD CONSTRAINT `pemeriksaan_retains_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`uuid`),
  ADD CONSTRAINT `pemeriksaan_retains_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`uuid`);

--
-- Constraints for table `pemeriksaan_retain_items`
--
ALTER TABLE `pemeriksaan_retain_items`
  ADD CONSTRAINT `pemeriksaan_retain_items_pemeriksaan_retain_id_foreign` FOREIGN KEY (`pemeriksaan_retain_id`) REFERENCES `pemeriksaan_retains` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penyimpangan_kualitas`
--
ALTER TABLE `penyimpangan_kualitas`
  ADD CONSTRAINT `penyimpangan_kualitas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `penyimpangan_kualitas_diketahui_by_foreign` FOREIGN KEY (`diketahui_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL,
  ADD CONSTRAINT `penyimpangan_kualitas_disetujui_by_foreign` FOREIGN KEY (`disetujui_by`) REFERENCES `users` (`uuid`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
