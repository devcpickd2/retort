-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2025 at 02:57 AM
-- Server version: 5.7.24
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paperless-retort`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_hygienes`
--

CREATE TABLE `area_hygienes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian` longtext COLLATE utf8mb4_unicode_ci,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `berita_acaras`
--

CREATE TABLE `berita_acaras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor Berita Acara',
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_masalah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat_jalan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dd_po` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kedatangan` date NOT NULL,
  `keputusan_pengembalian` tinyint(1) NOT NULL DEFAULT '0',
  `keputusan_potongan_harga` tinyint(1) NOT NULL DEFAULT '0',
  `keputusan_sortir` tinyint(1) NOT NULL DEFAULT '0',
  `keputusan_penukaran_barang` tinyint(1) NOT NULL DEFAULT '0',
  `keputusan_penggantian_biaya` tinyint(1) NOT NULL DEFAULT '0',
  `keputusan_lain_lain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_keputusan` date DEFAULT NULL,
  `analisa_penyebab` text COLLATE utf8mb4_unicode_ci,
  `tindak_lanjut_perbaikan` text COLLATE utf8mb4_unicode_ci,
  `lampiran` text COLLATE utf8mb4_unicode_ci,
  `status_ppic` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_ppic` text COLLATE utf8mb4_unicode_ci,
  `ppic_verified_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppic_verified_at` timestamp NULL DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `spv_verified_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spv_verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifikasi` longtext COLLATE utf8mb4_unicode_ci,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chambers`
--

INSERT INTO `chambers` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `verifikasi`, `catatan`, `nama_operator`, `status_operator`, `tgl_update_operator`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9bb-f2d9-728a-a477-bc8c10c2df5a', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '\"[{\\\"plc_menit_5\\\":\\\"94\\\",\\\"plc_detik_5\\\":\\\"91\\\",\\\"stopwatch_menit_5\\\":\\\"49\\\",\\\"stopwatch_detik_5\\\":\\\"88\\\",\\\"faktor_koreksi_5\\\":\\\"Provident labore pl\\\",\\\"plc_menit_10\\\":\\\"85\\\",\\\"plc_detik_10\\\":\\\"16\\\",\\\"stopwatch_menit_10\\\":\\\"65\\\",\\\"stopwatch_detik_10\\\":\\\"49\\\",\\\"faktor_koreksi_10\\\":\\\"Et magni dolor aliqu\\\",\\\"plc_menit_20\\\":\\\"84\\\",\\\"plc_detik_20\\\":\\\"49\\\",\\\"stopwatch_menit_20\\\":\\\"54\\\",\\\"stopwatch_detik_20\\\":\\\"59\\\",\\\"faktor_koreksi_20\\\":\\\"Ab illo aliquam nemo\\\",\\\"plc_menit_30\\\":\\\"34\\\",\\\"plc_detik_30\\\":\\\"56\\\",\\\"stopwatch_menit_30\\\":\\\"5\\\",\\\"stopwatch_detik_30\\\":\\\"43\\\",\\\"faktor_koreksi_30\\\":\\\"Consequat Velit deb\\\",\\\"plc_menit_60\\\":\\\"48\\\",\\\"plc_detik_60\\\":\\\"65\\\",\\\"stopwatch_menit_60\\\":\\\"24\\\",\\\"stopwatch_detik_60\\\":\\\"84\\\",\\\"faktor_koreksi_60\\\":\\\"Ex omnis sit ipsum r\\\"},{\\\"plc_menit_5\\\":\\\"68\\\",\\\"plc_detik_5\\\":\\\"34\\\",\\\"stopwatch_menit_5\\\":\\\"100\\\",\\\"stopwatch_detik_5\\\":\\\"95\\\",\\\"faktor_koreksi_5\\\":\\\"Impedit numquam com\\\",\\\"plc_menit_10\\\":\\\"88\\\",\\\"plc_detik_10\\\":\\\"69\\\",\\\"stopwatch_menit_10\\\":\\\"18\\\",\\\"stopwatch_detik_10\\\":\\\"77\\\",\\\"faktor_koreksi_10\\\":\\\"Autem impedit earum\\\",\\\"plc_menit_20\\\":\\\"83\\\",\\\"plc_detik_20\\\":\\\"69\\\",\\\"stopwatch_menit_20\\\":\\\"44\\\",\\\"stopwatch_detik_20\\\":\\\"59\\\",\\\"faktor_koreksi_20\\\":\\\"Itaque nesciunt sin\\\",\\\"plc_menit_30\\\":\\\"95\\\",\\\"plc_detik_30\\\":\\\"22\\\",\\\"stopwatch_menit_30\\\":\\\"36\\\",\\\"stopwatch_detik_30\\\":\\\"62\\\",\\\"faktor_koreksi_30\\\":\\\"Esse amet placeat\\\",\\\"plc_menit_60\\\":\\\"12\\\",\\\"plc_detik_60\\\":\\\"44\\\",\\\"stopwatch_menit_60\\\":\\\"40\\\",\\\"stopwatch_detik_60\\\":\\\"38\\\",\\\"faktor_koreksi_60\\\":\\\"Non nulla maiores fu\\\"},{\\\"plc_menit_5\\\":\\\"89\\\",\\\"plc_detik_5\\\":\\\"81\\\",\\\"stopwatch_menit_5\\\":\\\"88\\\",\\\"stopwatch_detik_5\\\":\\\"76\\\",\\\"faktor_koreksi_5\\\":\\\"Proident rerum cum\\\",\\\"plc_menit_10\\\":\\\"63\\\",\\\"plc_detik_10\\\":\\\"6\\\",\\\"stopwatch_menit_10\\\":\\\"96\\\",\\\"stopwatch_detik_10\\\":\\\"69\\\",\\\"faktor_koreksi_10\\\":\\\"Aliquam voluptatem\\\",\\\"plc_menit_20\\\":\\\"81\\\",\\\"plc_detik_20\\\":\\\"29\\\",\\\"stopwatch_menit_20\\\":\\\"25\\\",\\\"stopwatch_detik_20\\\":\\\"96\\\",\\\"faktor_koreksi_20\\\":\\\"Repudiandae esse bl\\\",\\\"plc_menit_30\\\":\\\"43\\\",\\\"plc_detik_30\\\":\\\"57\\\",\\\"stopwatch_menit_30\\\":\\\"36\\\",\\\"stopwatch_detik_30\\\":\\\"77\\\",\\\"faktor_koreksi_30\\\":\\\"Pariatur Nihil recu\\\",\\\"plc_menit_60\\\":\\\"19\\\",\\\"plc_detik_60\\\":\\\"37\\\",\\\"stopwatch_menit_60\\\":\\\"70\\\",\\\"stopwatch_detik_60\\\":\\\"36\\\",\\\"faktor_koreksi_60\\\":\\\"Assumenda aliqua Du\\\"}]\"', 'Numquam do velit dis', 'Jamal', '1', '2025-11-25 07:38:13', 'Foreman Produksi', '1', '2025-11-25 07:38:13', NULL, '0', NULL, NULL, '2025-11-25 06:38:13', '2025-11-25 06:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `departemens`
--

CREATE TABLE `departemens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kepada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disposisi_produk` tinyint(1) NOT NULL DEFAULT '0',
  `disposisi_material` tinyint(1) NOT NULL DEFAULT '0',
  `disposisi_prosedur` tinyint(1) NOT NULL DEFAULT '0',
  `dasar_disposisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_disposisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gmps`
--

CREATE TABLE `gmps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp_chamber` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `karantina_packing` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `filling_susun` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sampling_fg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeriksaan` longtext COLLATE utf8mb4_unicode_ci,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raw_material_inspection_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `exp` date NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `jumlah_sampel` decimal(10,2) NOT NULL DEFAULT '0.00',
  `jumlah_reject` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartons`
--

CREATE TABLE `kartons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_karton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_kedatangan` date DEFAULT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_lot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
  `nama_koordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_koordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_koordinator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartons`
--

INSERT INTO `kartons` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `nama_produk`, `kode_produksi`, `kode_karton`, `waktu_mulai`, `waktu_selesai`, `jumlah`, `tgl_kedatangan`, `nama_supplier`, `no_lot`, `keterangan`, `nama_operator`, `status_operator`, `tgl_update_operator`, `nama_koordinator`, `status_koordinator`, `tgl_update_koordinator`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab99f-98f6-7181-93f4-b12cec3ab774', 'admin', NULL, '2022-12-07', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'SRCH Ayam Original', 'NA12898HJK', 'public/karton/kode_karton_9bc3f354-45d4-41fb-ba79-a1a439d49f57.jpg', '01:16:00', '01:42:00', 97, '1982-04-15', 'PT. Intikemas', 'Consequatur magni pl', 'Quo esse occaecat e', 'Jamal', '1', '2025-11-25 06:07:15', 'Koordinator 1', '1', '2025-11-25 06:07:15', NULL, '0', NULL, NULL, '2025-11-25 06:07:15', '2025-11-25 06:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `klorins`
--

CREATE TABLE `klorins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` time NOT NULL,
  `footbasin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handbasin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klorins`
--

INSERT INTO `klorins` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `pukul`, `footbasin`, `handbasin`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab94a-0b96-70e3-a3d6-177ad3d179d4', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '08:50:00', 'public/klorin/footbasin_d3bee175-44b1-4481-831c-617871d299b5.jpg', 'public/klorin/handbasin_940780db-b4b7-42be-b73b-dc8aa1748228.jpg', 'Molestias alias quam', 'Foreman Produksi', '1', '2025-11-25 04:33:48', NULL, '0', NULL, NULL, '2025-11-25 04:33:48', '2025-11-25 04:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `koordinators`
--

CREATE TABLE `koordinators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_koordinator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labelisasi_pvdcs`
--

CREATE TABLE `labelisasi_pvdcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labelisasi` longtext COLLATE utf8mb4_unicode_ci,
  `nama_operator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_operator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_chamber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loading_checks`
--

CREATE TABLE `loading_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `shift` enum('Pagi','Malam') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_aktivitas` enum('Loading','Unloading') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `no_pol_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_segel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_mobil` json DEFAULT NULL,
  `keterangan_total` text COLLATE utf8mb4_unicode_ci,
  `keterangan_umum` text COLLATE utf8mb4_unicode_ci,
  `pic_qc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_warehouse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_qc_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loading_checks`
--

INSERT INTO `loading_checks` (`id`, `uuid`, `tanggal`, `shift`, `jenis_aktivitas`, `jam_mulai`, `jam_selesai`, `no_pol_mobil`, `nama_supir`, `ekspedisi`, `tujuan_asal`, `no_segel`, `jenis_kendaraan`, `kondisi_mobil`, `keterangan_total`, `keterangan_umum`, `pic_qc`, `pic_warehouse`, `pic_qc_spv`, `status_spv`, `catatan_spv`, `verified_by`, `verified_at`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd893d82e-b789-4776-b0a1-07a988dab4bc', '2014-04-28', 'Pagi', 'Loading', '00:58:00', '21:16:00', 'Voluptatum voluptate', 'Nesciunt expedita a', 'Incididunt sed ipsam', 'Et quo exercitation', 'Aut rerum omnis et e', 'Quo commodo sequi la', '[\"tidak_basah\", \"bebas_noda\", \"tidak_ada_non_halal\"]', 'Deserunt qui sunt al', 'Enim libero sint at', 'Magnam consequatur', 'Debitis sunt vel ess', 'Non rerum enim quam', 0, NULL, NULL, NULL, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', '2025-11-20 03:51:23', '2025-11-20 03:51:23', NULL),
(2, '6a908e88-835e-4852-9821-9f4aa9baf11e', '2025-11-20', 'Pagi', 'Loading', '16:59:00', '18:55:00', 'Molestiae rerum ipsu', 'Duis a similique in', 'Magni laboris quaera', 'Voluptatem necessita', 'Sint est ipsam error', 'Ratione reprehenderi', '[\"bersih\", \"tidak_debu\", \"tidak_basah\", \"bebas_noda\", \"tidak_ada_non_halal\"]', 'Itaque asperiores ne', 'In nostrum molestias', 'Est ut qui magna eiu', 'Suscipit voluptatem', 'Unde adipisci dolor', 0, NULL, NULL, NULL, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', '2025-11-20 04:11:50', '2025-11-20 04:11:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loading_details`
--

CREATE TABLE `loading_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loading_check_id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_expired` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loading_details`
--

INSERT INTO `loading_details` (`id`, `uuid`, `loading_check_id`, `nama_produk`, `kode_produksi`, `kode_expired`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'd278e4f1-b4eb-4aba-8163-fb7013355d51', 1, 'Officia officia sapi', 'Cillum animi velit', '1972-03-21', 76, 'Fugit a distinctio', '2025-11-20 03:51:23', '2025-11-20 03:51:23'),
(2, '6eae5574-e9ee-4266-bb37-f4033603904b', 1, 'Dolorum irure invent', 'Velit mollit autem', '1998-07-24', 99, 'Excepteur assumenda', '2025-11-20 03:51:23', '2025-11-20 03:51:23'),
(3, 'd759a250-c7fc-48e2-a836-421e2cd94282', 2, 'Veniam dolore aliqu', 'Mollitia distinctio', '1996-08-11', 95, 'Ad magni dolor liber', '2025-11-20 04:11:50', '2025-11-20 04:11:50'),
(4, '4376cfd3-316f-467b-b633-27e32131cc11', 2, 'Sint eligendi atque', 'Nemo fugit aliqua', '1975-07-06', 90, 'Non recusandae Qui', '2025-11-20 04:11:50', '2025-11-20 04:11:50'),
(5, '5c1038d4-c350-4c19-ba65-1630cbe02cd2', 2, 'Tenetur qui nihil ve', 'Ipsum in rerum elig', '1986-05-25', 82, 'Pariatur Minus duis', '2025-11-20 04:11:50', '2025-11-20 04:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `magnet_traps`
--

CREATE TABLE `magnet_traps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` time NOT NULL,
  `jumlah_temuan` int(11) NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `produksi_id` bigint(20) UNSIGNED NOT NULL,
  `engineer_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_by_spv_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mesin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_mesin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` time NOT NULL,
  `fe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nfe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metals`
--

INSERT INTO `metals` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `pukul`, `fe`, `nfe`, `sus`, `catatan`, `nama_produksi`, `nama_engineer`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `status_engineer`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aba23-ecb3-723c-bb61-13bb5c36f56c', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '20:42:00', 'Tidak Terdeteksi', 'Terdeteksi', 'Terdeteksi', 'Culpa ad qui neque d', 'Foreman Produksi', 'Tison', '1', '2025-11-25 09:31:47', NULL, '0', '1', NULL, NULL, '2025-11-25 08:31:47', '2025-11-25 08:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(79, '2025_11_26_114242_create_permission_tables', 3),
(80, '2025_11_27_095339_alter_spatie_model_id_to_uuid', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mincings`
--

CREATE TABLE `mincings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `non_premix` longtext COLLATE utf8mb4_unicode_ci,
  `premix` longtext COLLATE utf8mb4_unicode_ci,
  `daging` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mincings`
--

INSERT INTO `mincings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `kode_produksi`, `waktu_mulai`, `waktu_selesai`, `non_premix`, `premix`, `daging`, `suhu_sebelum_grinding`, `waktu_mixing_premix_awal`, `waktu_mixing_premix_akhir`, `waktu_bowl_cutter_awal`, `waktu_bowl_cutter_akhir`, `waktu_aging_emulsi_awal`, `waktu_aging_emulsi_akhir`, `suhu_akhir_emulsi_gel`, `waktu_mixing`, `suhu_akhir_mixing`, `suhu_akhir_emulsi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019abe36-66a8-7035-9da7-549119f48e32', 'admin', NULL, '2025-11-26', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SRCH Ayam Original', 'NA12898HJK', '17:20:00', '18:46:00', '\"[{\\\"nama_bahan\\\":\\\"Est dolore adipisici\\\",\\\"kode_bahan\\\":\\\"Qui saepe nulla ulla\\\",\\\"suhu_bahan\\\":\\\"5\\\",\\\"ph_bahan\\\":\\\"76\\\",\\\"berat_bahan\\\":\\\"78\\\"}]\"', '\"[{\\\"nama_premix\\\":\\\"Sapiente possimus s\\\",\\\"kode_premix\\\":\\\"Beatae omnis praesen\\\",\\\"berat_premix\\\":\\\"64\\\",\\\"sensori_premix\\\":\\\"Oke\\\"}]\"', 'CCM', '85.00', '01:17:00', '03:00:00', '06:29:00', '13:16:00', '19:56:00', '09:10:00', '20.00', '00:24:00', '98.00', '43.00', 'Aliquip eius veritat', 'Foreman Produksi', '1', '2025-11-26 04:30:27', NULL, '0', NULL, NULL, '2025-11-26 03:30:27', '2025-11-26 03:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', '019ac33c-794f-7147-bbc9-88e1cd4cef7d');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sensori` longtext COLLATE utf8mb4_unicode_ci,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organoleptiks`
--

INSERT INTO `organoleptiks` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `sensori`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aa93d-f4c7-7044-9790-e4bc999c37a4', 'admin', NULL, '2025-11-22', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SRCH Ayam Original', '\"[{\\\"kode_produksi\\\":\\\"PA12JUG123\\\",\\\"penampilan\\\":\\\"0\\\",\\\"aroma\\\":\\\"0\\\",\\\"kekenyalan\\\":\\\"3\\\",\\\"rasa_asin\\\":\\\"2\\\",\\\"rasa_gurih\\\":\\\"1\\\",\\\"rasa_manis\\\":\\\"1\\\",\\\"rasa_daging\\\":\\\"3\\\",\\\"rasa_keseluruhan\\\":\\\"2\\\",\\\"rata_score\\\":\\\"2.0\\\",\\\"release\\\":\\\"Release\\\"},{\\\"kode_produksi\\\":\\\"PA12JUG123\\\",\\\"penampilan\\\":\\\"1\\\",\\\"aroma\\\":\\\"2\\\",\\\"kekenyalan\\\":\\\"1\\\",\\\"rasa_asin\\\":\\\"0\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"1\\\",\\\"rasa_daging\\\":\\\"2\\\",\\\"rasa_keseluruhan\\\":\\\"1\\\",\\\"rata_score\\\":\\\"1.3\\\",\\\"release\\\":\\\"Tidak Release\\\"},{\\\"kode_produksi\\\":\\\"PA12JUG123\\\",\\\"penampilan\\\":\\\"3\\\",\\\"aroma\\\":\\\"2\\\",\\\"kekenyalan\\\":\\\"0\\\",\\\"rasa_asin\\\":\\\"0\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"0\\\",\\\"rasa_daging\\\":\\\"1\\\",\\\"rasa_keseluruhan\\\":\\\"2\\\",\\\"rata_score\\\":\\\"2.0\\\",\\\"release\\\":\\\"Release\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-22 01:46:41', '2025-11-22 01:46:41'),
(2, '019aa93e-cf57-72aa-afe5-255604f273b7', 'admin', NULL, '2025-11-22', 'fdaca613-7ab2-4997-8f33-686e886c867d', '3', 'SROA Ayam Bakar', '\"[{\\\"kode_produksi\\\":\\\"PA12JUG126\\\",\\\"penampilan\\\":\\\"3\\\",\\\"aroma\\\":\\\"1\\\",\\\"kekenyalan\\\":\\\"2\\\",\\\"rasa_asin\\\":\\\"3\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"1\\\",\\\"rasa_daging\\\":\\\"2\\\",\\\"rasa_keseluruhan\\\":\\\"2\\\",\\\"rata_score\\\":\\\"2.0\\\",\\\"release\\\":\\\"Release\\\"},{\\\"kode_produksi\\\":\\\"PA12JUG126\\\",\\\"penampilan\\\":\\\"2\\\",\\\"aroma\\\":\\\"0\\\",\\\"kekenyalan\\\":\\\"3\\\",\\\"rasa_asin\\\":\\\"0\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"3\\\",\\\"rasa_daging\\\":\\\"1\\\",\\\"rasa_keseluruhan\\\":\\\"0\\\",\\\"rata_score\\\":\\\"2.3\\\",\\\"release\\\":\\\"Release\\\"},{\\\"kode_produksi\\\":\\\"PA12JUG126\\\",\\\"penampilan\\\":\\\"1\\\",\\\"aroma\\\":\\\"0\\\",\\\"kekenyalan\\\":\\\"3\\\",\\\"rasa_asin\\\":\\\"0\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"0\\\",\\\"rasa_daging\\\":\\\"2\\\",\\\"rasa_keseluruhan\\\":\\\"2\\\",\\\"rata_score\\\":\\\"2.0\\\",\\\"release\\\":\\\"Release\\\"},{\\\"kode_produksi\\\":\\\"PA12JUG126\\\",\\\"penampilan\\\":\\\"0\\\",\\\"aroma\\\":\\\"0\\\",\\\"kekenyalan\\\":\\\"1\\\",\\\"rasa_asin\\\":\\\"1\\\",\\\"rasa_gurih\\\":\\\"0\\\",\\\"rasa_manis\\\":\\\"1\\\",\\\"rasa_daging\\\":\\\"0\\\",\\\"rasa_keseluruhan\\\":\\\"1\\\",\\\"rata_score\\\":\\\"1.0\\\",\\\"release\\\":\\\"Tidak Release\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-22 01:47:37', '2025-11-22 01:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `packaging_inspections`
--

CREATE TABLE `packaging_inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inspection_date` date NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packaging_inspections`
--

INSERT INTO `packaging_inspections` (`id`, `uuid`, `inspection_date`, `shift`, `status_spv`, `catatan_spv`, `verified_by`, `verified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '54c13738-ee71-46ae-88fa-e2d766b3048b', '2019-03-23', 'Officiis qui aut in', 0, NULL, NULL, NULL, '2025-11-20 03:48:21', '2025-11-20 03:48:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packaging_inspection_items`
--

CREATE TABLE `packaging_inspection_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packaging_inspection_id` bigint(20) UNSIGNED NOT NULL,
  `packaging_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Jenis Packaging',
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition_design` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_sealing` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OK' COMMENT 'OK / NG / v / x',
  `condition_dimension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Panjang, Lebar, Tinggi, Tebal',
  `condition_weight_pcs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Range berat',
  `quantity_goods` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah Barang',
  `quantity_sample` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah Sampel',
  `quantity_reject` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah Reject',
  `acceptance_status` enum('OK','Tolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Keterangan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_pol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor Polisi Kendaraan',
  `vehicle_condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kondisi Kendaraan',
  `pbb_op` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packaging_inspection_items`
--

INSERT INTO `packaging_inspection_items` (`id`, `uuid`, `packaging_inspection_id`, `packaging_type`, `supplier`, `lot_batch`, `condition_design`, `condition_sealing`, `condition_color`, `condition_dimension`, `condition_weight_pcs`, `quantity_goods`, `quantity_sample`, `quantity_reject`, `acceptance_status`, `notes`, `created_at`, `updated_at`, `deleted_at`, `no_pol`, `vehicle_condition`, `pbb_op`) VALUES
(1, 'f3a1a75c-2051-4b6d-97ac-ad8dd79d5a4b', 1, 'Sint aperiam sapient', 'Ea distinctio Sequi', 'Consectetur laudant', 'OK', 'OK', 'OK', 'Labore tempora enim', NULL, 366, 241, 789, 'Tolak', 'Nihil perspiciatis', '2025-11-20 03:48:21', '2025-11-20 03:48:21', NULL, 'Maxime provident no', 'Bocor', 'Tenetur culpa maxime');

-- --------------------------------------------------------

--
-- Table structure for table `packings`
--

CREATE TABLE `packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` time NOT NULL,
  `kalibrasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_printing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_toples` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_karton` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu` decimal(8,2) DEFAULT NULL,
  `speed` decimal(8,2) DEFAULT NULL,
  `kondisi_segel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_toples` decimal(8,2) DEFAULT NULL,
  `berat_pouch` decimal(8,2) DEFAULT NULL,
  `no_lot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_kedatangan` date DEFAULT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packings`
--

INSERT INTO `packings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `waktu`, `kalibrasi`, `qrcode`, `kode_printing`, `kode_toples`, `kode_karton`, `suhu`, `speed`, `kondisi_segel`, `berat_toples`, `berat_pouch`, `no_lot`, `tgl_kedatangan`, `nama_supplier`, `keterangan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab94f-24c7-7322-99c2-556d8f80dd23', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SRCH Ayam Original', '18:32:00', 'Tidak Ok', 'Tidak Ok', 'storage/uploads/packing/printing_c30fdd41-5758-4899-bd24-f083b6054d6b.jpg', 'Doloremque id sunt', 'Voluptatem et velit', '66.00', '67.00', 'Tidak OK', '53.00', '2.00', 'Qui suscipit dolorem', '2015-05-07', 'PT. Intikemas', 'Voluptatem Quia sed', 'Foreman Produksi', '1', '2025-11-25 05:39:23', 'admin', '1', NULL, '2025-11-25 04:48:51', '2025-11-25 04:39:23', '2025-11-25 04:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasakans`
--

CREATE TABLE `pemasakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_chamber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_produk` decimal(8,2) NOT NULL,
  `suhu_produk` decimal(8,2) NOT NULL,
  `jumlah_tray` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooking` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_reject` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasakans`
--

INSERT INTO `pemasakans` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `kode_produksi`, `no_chamber`, `berat_produk`, `suhu_produk`, `jumlah_tray`, `cooking`, `total_reject`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9f2-25ae-7344-8e0d-2afc01d85175', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SRCH Ayam Original', 'NA12898HJK', '1', '69.00', '19.00', '28', '\"{\\\"tekanan_angin\\\":\\\"Cillum tenetur asper\\\",\\\"tekanan_steam\\\":\\\"Nostrud veniam sunt\\\",\\\"tekanan_air\\\":\\\"Fugiat perferendis e\\\",\\\"suhu_air_awal\\\":\\\"1\\\",\\\"tekanan_awal\\\":\\\"42\\\",\\\"waktu_mulai_awal\\\":\\\"00:37\\\",\\\"waktu_selesai_awal\\\":\\\"11:55\\\",\\\"suhu_air_proses\\\":\\\"24\\\",\\\"tekanan_proses\\\":\\\"89\\\",\\\"waktu_mulai_proses\\\":\\\"17:25\\\",\\\"waktu_selesai_proses\\\":\\\"12:00\\\",\\\"suhu_air_sterilisasi\\\":[\\\"26\\\",\\\"67\\\",\\\"11\\\",\\\"95\\\"],\\\"thermometer_retort\\\":[\\\"21\\\",\\\"40\\\",\\\"13\\\",\\\"92\\\"],\\\"tekanan_sterilisasi\\\":[\\\"100\\\",\\\"91\\\",\\\"9\\\",\\\"79\\\"],\\\"waktu_mulai_sterilisasi\\\":\\\"23:11\\\",\\\"waktu_pengecekan_sterilisasi\\\":[\\\"11:34\\\",\\\"19:21\\\",\\\"05:45\\\",\\\"16:57\\\"],\\\"waktu_selesai_sterilisasi\\\":\\\"21:44\\\",\\\"suhu_air_pendinginan_awal\\\":\\\"17\\\",\\\"tekanan_pendinginan_awal\\\":\\\"77\\\",\\\"waktu_mulai_pendinginan_awal\\\":\\\"20:51\\\",\\\"waktu_selesai_pendinginan_awal\\\":\\\"04:08\\\",\\\"suhu_air_pendinginan\\\":\\\"20\\\",\\\"tekanan_pendinginan\\\":\\\"45\\\",\\\"waktu_mulai_pendinginan\\\":\\\"03:03\\\",\\\"waktu_selesai_pendinginan\\\":\\\"17:15\\\",\\\"suhu_air_akhir\\\":\\\"27\\\",\\\"tekanan_akhir\\\":\\\"26\\\",\\\"waktu_mulai_akhir\\\":\\\"00:47\\\",\\\"waktu_selesai_akhir\\\":\\\"00:16\\\",\\\"waktu_mulai_total\\\":\\\"07:57\\\",\\\"waktu_selesai_total\\\":\\\"20:15\\\",\\\"suhu_produk_akhir\\\":\\\"74\\\",\\\"panjang\\\":\\\"52\\\",\\\"diameter\\\":\\\"73\\\",\\\"rasa\\\":\\\"42\\\",\\\"warna\\\":\\\"42\\\",\\\"aroma\\\":\\\"26\\\",\\\"texture\\\":\\\"52\\\",\\\"sobek_seal\\\":\\\"41\\\"}\"', '20.00', 'Ut pariatur Quibusd', 'Foreman Produksi', '1', '2025-11-25 08:37:25', NULL, '0', NULL, NULL, '2025-11-25 07:37:25', '2025-11-25 07:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `pemasakan_rtes`
--

CREATE TABLE `pemasakan_rtes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_chamber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_produk` decimal(8,2) NOT NULL,
  `suhu_produk` decimal(8,2) NOT NULL,
  `jumlah_tray` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooking` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_reject` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kekuatan_median_1` decimal(8,2) DEFAULT NULL,
  `kekuatan_median_2` decimal(8,2) DEFAULT NULL,
  `kekuatan_median_3` decimal(8,2) DEFAULT NULL,
  `parameter_sesuai` tinyint(1) NOT NULL DEFAULT '1',
  `kondisi_magnet_trap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `petugas_qc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petugas_eng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `verified_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_retain_items`
--

CREATE TABLE `pemeriksaan_retain_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeriksaan_retain_id` bigint(20) UNSIGNED NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `varian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panjang` decimal(8,2) DEFAULT NULL,
  `diameter` decimal(8,2) DEFAULT NULL,
  `sensori_rasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_warna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_aroma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_texture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temuan_jamur` tinyint(1) NOT NULL DEFAULT '0',
  `temuan_lendir` tinyint(1) NOT NULL DEFAULT '0',
  `temuan_pinehole` tinyint(1) NOT NULL DEFAULT '0',
  `temuan_kejepit` tinyint(1) NOT NULL DEFAULT '0',
  `temuan_seal` tinyint(1) NOT NULL DEFAULT '0',
  `lab_garam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lab_air` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lab_mikro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahans`
--

CREATE TABLE `pemusnahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `analisa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemusnahans`
--

INSERT INTO `pemusnahans` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `nama_produk`, `kode_produksi`, `expired_date`, `analisa`, `keterangan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aba07-639e-70bd-8be0-1db9830cf8dd', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'SRCH Ayam Original', 'NA12898HJK', '2025-08-12', 'Quas harum quas dolo', 'Repudiandae reiciend', NULL, '0', NULL, NULL, '2025-11-25 08:00:37', '2025-11-25 08:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `penyimpangan_kualitas`
--

CREATE TABLE `penyimpangan_kualitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `ditujukan_untuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `penyelesaian` text COLLATE utf8mb4_unicode_ci,
  `status_diketahui` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_diketahui` text COLLATE utf8mb4_unicode_ci,
  `diketahui_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diketahui_at` timestamp NULL DEFAULT NULL,
  `status_disetujui` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Verified, 2:Revision',
  `catatan_disetujui` text COLLATE utf8mb4_unicode_ci,
  `disetujui_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disetujui_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'can access add button', 'web', '2025-11-26 06:43:09', '2025-11-26 06:43:09'),
(2, 'can access edit button', 'web', '2025-11-26 06:43:26', '2025-11-26 06:43:26'),
(3, 'can access update button', 'web', '2025-11-26 06:43:31', '2025-11-26 06:43:31'),
(4, 'can access delete button', 'web', '2025-11-26 06:43:36', '2025-11-26 06:43:36'),
(5, 'can access verification button', 'web', '2025-11-26 08:21:30', '2025-11-26 08:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conveyor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu_produk` longtext COLLATE utf8mb4_unicode_ci,
  `kondisi_produk` longtext COLLATE utf8mb4_unicode_ci,
  `berat_produk` longtext COLLATE utf8mb4_unicode_ci,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prepackings`
--

INSERT INTO `prepackings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `nama_produk`, `kode_produksi`, `conveyor`, `suhu_produk`, `kondisi_produk`, `berat_produk`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9fe-18a1-7073-8cc9-7c67589e3288', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'SRCH Ayam Original', 'NA12898HJK', 'Facere et et natus v', '\"{\\\"suhu_1\\\":\\\"66\\\",\\\"suhu_2\\\":\\\"50\\\",\\\"suhu_3\\\":\\\"7\\\"}\"', '\"{\\\"basah_air_ujung\\\":\\\"66\\\",\\\"kering_air_ujung\\\":\\\"38\\\",\\\"basah_air_seal\\\":\\\"80\\\",\\\"kering_air_seal\\\":\\\"41\\\",\\\"basah_air_total\\\":\\\"146\\\",\\\"kering_air_total\\\":\\\"79\\\",\\\"basah_minyak_ujung\\\":\\\"43\\\",\\\"kering_minyak_ujung\\\":\\\"22\\\",\\\"basah_minyak_seal\\\":\\\"88\\\",\\\"kering_minyak_seal\\\":\\\"38\\\",\\\"basah_minyak_total\\\":\\\"131\\\",\\\"kering_minyak_total\\\":\\\"60\\\"}\"', '\"{\\\"pcs_1\\\":\\\"21\\\",\\\"toples_1\\\":\\\"61\\\",\\\"pcs_2\\\":\\\"43\\\",\\\"toples_2\\\":\\\"25\\\",\\\"pcs_3\\\":\\\"49\\\",\\\"toples_3\\\":\\\"69\\\"}\"', 'Aut omnis suscipit l', NULL, '0', NULL, NULL, '2025-11-25 07:50:28', '2025-11-25 07:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pvdcs`
--

CREATE TABLE `pvdcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kedatangan` date NOT NULL,
  `tgl_expired` date NOT NULL,
  `data_pvdc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pvdcs`
--

INSERT INTO `pvdcs` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `nama_supplier`, `tgl_kedatangan`, `tgl_expired`, `data_pvdc`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aba15-c80c-70c9-ab52-71f58c33fa8d', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '3', 'SROA Ayam Bakar', 'PT. Intikemas', '1982-05-17', '2002-09-03', '\"[{\\\"mesin\\\":\\\"C3\\\",\\\"detail\\\":[{\\\"batch\\\":\\\"Ea exercitationem la\\\",\\\"no_lot\\\":\\\"Repellendus Perspic\\\",\\\"waktu\\\":\\\"16:28\\\"}]}]\"', 'Vel molestias ut pro', NULL, '0', NULL, NULL, '2025-11-25 08:16:21', '2025-11-25 08:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_inspections`
--

CREATE TABLE `raw_material_inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setup_kedatangan` datetime NOT NULL,
  `bahan_baku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobil_check_warna` tinyint(1) NOT NULL DEFAULT '0',
  `mobil_check_kotoran` tinyint(1) NOT NULL DEFAULT '0',
  `mobil_check_aroma` tinyint(1) NOT NULL DEFAULT '0',
  `mobil_check_kemasan` tinyint(1) NOT NULL DEFAULT '0',
  `nopol_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_mobil` enum('Bersih','Kotor','Bau','Bocor','Basah','Kering','Bebas Hama') COLLATE utf8mb4_unicode_ci NOT NULL,
  `do_po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_segel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu_daging` decimal(5,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `analisa_ka_ffa` tinyint(1) NOT NULL DEFAULT '0',
  `analisa_logo_halal` tinyint(1) NOT NULL DEFAULT '0',
  `analisa_negara_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `analisa_produsen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_halal_berlaku` tinyint(1) NOT NULL DEFAULT '0',
  `dokumen_halal_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_coa_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_spv` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Pending, 1: Verified, 2: Revision',
  `catatan_spv` text COLLATE utf8mb4_unicode_ci,
  `verified_by_spv_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at_spv` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `release_packings`
--

CREATE TABLE `release_packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kemasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `no_palet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_box` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `reject` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `release_packings`
--

INSERT INTO `release_packings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `jenis_kemasan`, `nama_produk`, `kode_produksi`, `expired_date`, `no_palet`, `jumlah_box`, `release`, `reject`, `keterangan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aba13-b6b6-703d-9a6a-d3e002ef7fcc', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'Toples', 'SRCH Ayam Original', 'NA12898HJK', '2025-08-12', 'In do qui deserunt r', 61, 12, 35, 'Ut dolorum dolorem u', NULL, '0', NULL, NULL, '2025-11-25 08:14:05', '2025-11-25 08:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `release_packing_rtes`
--

CREATE TABLE `release_packing_rtes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `reject` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `analisa` longtext COLLATE utf8mb4_unicode_ci,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(2, 'manager', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(3, 'supervisor', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(4, 'foreman_produksi', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(5, 'foreman_qc', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(6, 'inspector', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(7, 'engineer', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(8, 'warehouse', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30'),
(9, 'lab', 'web', '2025-11-26 06:04:30', '2025-11-26 06:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(1, 3),
(2, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sampels`
--

CREATE TABLE `sampels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sampel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sampels`
--

INSERT INTO `sampels` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `jenis_sampel`, `nama_produk`, `kode_produksi`, `keterangan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab944-2b24-72c5-b03b-3b20a20e33b9', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', 'Retain QC', 'Nihil sint sint et', 'NA12898HJK', 'Incididunt nulla ab', NULL, '0', NULL, NULL, '2025-11-25 04:27:23', '2025-11-25 04:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `samplings`
--

CREATE TABLE `samplings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sampel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kemasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `samplings`
--

INSERT INTO `samplings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `jenis_sampel`, `jenis_kemasan`, `nama_produk`, `kode_produksi`, `jumlah`, `jamur`, `lendir`, `klip_tajam`, `pin_hole`, `air_trap_pvdc`, `air_trap_produk`, `keriput`, `bengkok`, `non_kode`, `over_lap`, `kecil`, `terjepit`, `double_klip`, `seal_halus`, `basah`, `dll`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aa9c5-1e21-717e-94cd-17dd93a9ef2d', 'admin', NULL, '2025-11-22', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'Quisquam consequatur', 'Pouch', 'SRCH Ayam Original', 'PA12JUG123', '12.00', '50.00', '58.00', '43.00', '62.00', '97.00', '55.00', '10.00', '84.00', '3.00', '30.00', '83.00', '84.00', '90.00', '62.00', '59.00', '62.00', 'Doloremque qui est q', NULL, '0', NULL, NULL, '2025-11-22 04:14:19', '2025-11-22 04:14:19'),
(2, '019aa9c5-9086-72c7-b70e-3922e00391e9', 'admin', NULL, '2025-11-22', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', 'Aut hic ullam rerum', 'Pouch', 'SROA Ayam Bakar', 'PA12JUG123', '17.00', '53.00', '89.00', '9.00', '1.00', '74.00', '72.00', '86.00', '14.00', '85.00', '89.00', '9.00', '29.00', '64.00', '57.00', '24.00', '17.00', 'Explicabo Quia volu', NULL, '0', NULL, NULL, '2025-11-22 04:14:48', '2025-11-22 04:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_fgs`
--

CREATE TABLE `sampling_fgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `palet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_date` date NOT NULL,
  `pukul` time NOT NULL,
  `kalibrasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_produk` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_per_box` int(11) DEFAULT NULL,
  `kemasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_box` int(11) DEFAULT NULL,
  `release` int(11) DEFAULT NULL,
  `reject` int(11) DEFAULT NULL,
  `hold` int(11) DEFAULT NULL,
  `item_mutu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_koordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_koordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_koordinator` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sampling_fgs`
--

INSERT INTO `sampling_fgs` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `palet`, `nama_produk`, `kode_produksi`, `exp_date`, `pukul`, `kalibrasi`, `berat_produk`, `keterangan`, `isi_per_box`, `kemasan`, `jumlah_box`, `release`, `reject`, `hold`, `item_mutu`, `catatan`, `nama_koordinator`, `status_koordinator`, `tgl_update_koordinator`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9ec-84ca-704c-9e37-8f4dd718a6fc', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '81', 'SRCH Ayam Original', 'NA12898HJK', '2025-08-12', '12:49:00', 'Tidak Sesuai', 50, 'Tenetur do est porro', 71, 'Pouch', 0, 11, 52, 29, 'Odio non corporis ut', 'Recusandae Ratione', 'Koordinator 1', '1', '2025-11-25 07:31:16', NULL, '0', NULL, NULL, '2025-11-25 07:31:16', '2025-11-25 07:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `sanitasis`
--

CREATE TABLE `sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeriksaan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_date` date NOT NULL,
  `kode_mesin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `suhu` decimal(8,2) DEFAULT NULL,
  `sensori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecepatan_stuffing` decimal(8,2) DEFAULT NULL,
  `panjang_pcs` decimal(8,2) DEFAULT NULL,
  `berat_pcs` decimal(8,2) DEFAULT NULL,
  `cek_vakum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebersihan_seal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekuatan_seal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diameter_klip` decimal(8,2) DEFAULT NULL,
  `print_kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lebar_cassing` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` time NOT NULL,
  `hasil_suhu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suhus`
--

INSERT INTO `suhus` (`id`, `uuid`, `username`, `username_updated`, `plant`, `date`, `shift`, `pukul`, `hasil_suhu`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019abe29-a685-707a-9693-dbeb00d9e45a', 'admin', NULL, 'fdaca613-7ab2-4997-8f33-686e886c867d', '2025-11-26', '1', '09:00:00', '\"[{\\\"area\\\":\\\"Chillroom (Meat)\\\",\\\"nilai\\\":\\\"5\\\"},{\\\"area\\\":\\\"Chillroom (Ruang)\\\",\\\"nilai\\\":\\\"1\\\"},{\\\"area\\\":\\\"Cold Storage Meat (Meat)\\\",\\\"nilai\\\":\\\"-22\\\"},{\\\"area\\\":\\\"Cold Storage Meat (Ruang)\\\",\\\"nilai\\\":\\\"-18\\\"}]\"', 'Nam laboris voluptat', 'Voluptatem Autem es', 'Foreman Produksi', '1', '2025-11-26 04:16:31', NULL, '0', NULL, NULL, '2025-11-26 03:16:32', '2025-11-26 03:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thermometers`
--

CREATE TABLE `thermometers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peneraan` longtext COLLATE utf8mb4_unicode_ci,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thermometers`
--

INSERT INTO `thermometers` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `peneraan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9ae-052f-70b6-901a-9f9eab0c30a7', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '[{\"kode_thermometer\":\"Quis temporibus cupi\",\"area\":\"Culpa sed vitae con\",\"standar\":\"54\",\"pukul\":\"04:00\",\"hasil_tera\":\"21\",\"tindakan_perbaikan\":\"Tempore eu velit i\"}]', NULL, '0', NULL, NULL, '2025-11-25 06:23:00', '2025-11-25 06:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `timbangans`
--

CREATE TABLE `timbangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peneraan` longtext COLLATE utf8mb4_unicode_ci,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timbangans`
--

INSERT INTO `timbangans` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `peneraan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab3f3-19ff-712b-9c44-af3cc1948ed0', 'admin', NULL, '2025-11-24', 'fdaca613-7ab2-4997-8f33-686e886c867d', '3', '\"[{\\\"kode_timbangan\\\":\\\"Vero anim id magna\\\",\\\"standar\\\":\\\"12\\\",\\\"pukul\\\":\\\"19:21\\\",\\\"hasil_tera\\\":\\\"20\\\",\\\"tindakan_perbaikan\\\":\\\"Perspiciatis saepe\\\"},{\\\"kode_timbangan\\\":\\\"Incididunt et ipsa\\\",\\\"standar\\\":\\\"97\\\",\\\"pukul\\\":\\\"20:27\\\",\\\"hasil_tera\\\":\\\"71\\\",\\\"tindakan_perbaikan\\\":\\\"Sed earum optio des\\\"},{\\\"kode_timbangan\\\":\\\"Cupidatat aute sed s\\\",\\\"standar\\\":\\\"7\\\",\\\"pukul\\\":\\\"08:33\\\",\\\"hasil_tera\\\":\\\"84\\\",\\\"tindakan_perbaikan\\\":\\\"Accusamus fuga Vel\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-24 03:40:44', '2025-11-24 03:40:44'),
(2, '019ab3f3-577c-7141-831a-2c9ced23d989', 'admin', NULL, '2025-11-24', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '\"[{\\\"kode_timbangan\\\":\\\"Sint ratione id vol\\\",\\\"standar\\\":\\\"26\\\",\\\"pukul\\\":\\\"21:33\\\",\\\"hasil_tera\\\":\\\"14\\\",\\\"tindakan_perbaikan\\\":\\\"Nemo asperiores esse\\\"},{\\\"kode_timbangan\\\":\\\"Labore fugiat paria\\\",\\\"standar\\\":\\\"46\\\",\\\"pukul\\\":\\\"21:56\\\",\\\"hasil_tera\\\":\\\"20\\\",\\\"tindakan_perbaikan\\\":\\\"Cum voluptatem Recu\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-24 03:41:00', '2025-11-24 03:41:00'),
(3, '019ab3f3-893a-7154-adf3-d6a6a971a8f5', 'admin', NULL, '2025-11-24', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '\"[{\\\"kode_timbangan\\\":\\\"Pariatur Aut delect\\\",\\\"standar\\\":\\\"28\\\",\\\"pukul\\\":\\\"04:23\\\",\\\"hasil_tera\\\":\\\"77\\\",\\\"tindakan_perbaikan\\\":\\\"Ab esse laudantium\\\"},{\\\"kode_timbangan\\\":\\\"Dolorem amet nesciu\\\",\\\"standar\\\":\\\"72\\\",\\\"pukul\\\":\\\"05:35\\\",\\\"hasil_tera\\\":\\\"16\\\",\\\"tindakan_perbaikan\\\":\\\"Facilis molestiae ex\\\"},{\\\"kode_timbangan\\\":\\\"Voluptatem Cupidita\\\",\\\"standar\\\":\\\"17\\\",\\\"pukul\\\":\\\"17:35\\\",\\\"hasil_tera\\\":\\\"89\\\",\\\"tindakan_perbaikan\\\":\\\"Qui non non qui vero\\\"},{\\\"kode_timbangan\\\":\\\"Nobis sunt quidem cu\\\",\\\"standar\\\":\\\"71\\\",\\\"pukul\\\":\\\"02:35\\\",\\\"hasil_tera\\\":\\\"7\\\",\\\"tindakan_perbaikan\\\":\\\"Magna Nam et praesen\\\"},{\\\"kode_timbangan\\\":\\\"Voluptatem Magna om\\\",\\\"standar\\\":\\\"61\\\",\\\"pukul\\\":\\\"11:34\\\",\\\"hasil_tera\\\":\\\"14\\\",\\\"tindakan_perbaikan\\\":\\\"Optio est sunt cons\\\"},{\\\"kode_timbangan\\\":\\\"Magna dolores dolore\\\",\\\"standar\\\":\\\"31\\\",\\\"pukul\\\":\\\"07:01\\\",\\\"hasil_tera\\\":\\\"50\\\",\\\"tindakan_perbaikan\\\":\\\"Quia molestias minim\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-24 03:41:13', '2025-11-24 03:41:13'),
(4, '019ab4bc-35ca-70ab-b928-4bec78e13f80', 'admin', NULL, '2025-11-24', 'fdaca613-7ab2-4997-8f33-686e886c867d', '3', '\"[{\\\"kode_timbangan\\\":\\\"Officiis sint nihil\\\",\\\"standar\\\":\\\"56\\\",\\\"pukul\\\":\\\"06:18\\\",\\\"hasil_tera\\\":\\\"67\\\",\\\"tindakan_perbaikan\\\":\\\"Beatae laudantium s\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-24 07:20:24', '2025-11-24 07:20:24'),
(5, '019ab4bc-7d29-72fc-81b1-84be2d58192a', 'admin', NULL, '2025-11-24', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '\"[{\\\"kode_timbangan\\\":\\\"Eius id repudiandae\\\",\\\"standar\\\":\\\"41\\\",\\\"pukul\\\":\\\"06:23\\\",\\\"hasil_tera\\\":\\\"26\\\",\\\"tindakan_perbaikan\\\":\\\"Voluptatibus exercit\\\"}]\"', NULL, '0', NULL, NULL, '2025-11-24 07:20:43', '2025-11-24 07:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activation` tinyint(1) NOT NULL DEFAULT '0',
  `updater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `plant`, `department`, `type_user`, `photo`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `activation`, `updater`) VALUES
(1, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', 'admin', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '0', NULL, 'Admin', 'admin@example.com', NULL, '$2y$10$GtECYTMDv2sgmP6drtA3uu5EGgyup5Gz2iaOKlDgCBsyS8ALa6lda', NULL, '2025-09-23 20:02:18', '2025-09-23 21:12:34', 1, 'Admin'),
(5, '01997ab9-ed21-7118-8843-bc2b0a049125', 'foreman', 'fdaca613-7ab2-4997-8f33-686e886c867d', '2', '3', NULL, 'Foreman Produksi', 'foreman1@example.com', NULL, '$2y$10$WSX6D1IOD8mgOTO4vXfvpekR6UI8qozuwdPcnu/a44sfyEiWvs1y2', NULL, '2025-09-24 00:57:09', '2025-10-07 19:02:22', 0, 'Admin'),
(21, '0199dc8d-2dce-7294-859d-8ba6b6c82e3e', 'admin2', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '1', '0', NULL, 'admin2', 'admin2@example.com', NULL, '$2y$10$i5C66MqG66rvs5ZcV2M80.uyiHcqUlSPfEcPx2.roPdbeRKNW.NSS', NULL, '2025-10-13 00:51:03', '2025-10-13 00:51:03', 0, 'Admin'),
(22, '0199dc8d-ed0a-70f7-b5fa-a2220bb2b734', 'foreman_brbk', '2debd595-89c4-4a7e-bf94-e623cc220ca6', '2', '3', NULL, 'Foreman Produksi B', 'foreman2@example.com', NULL, '$2y$10$1kHnh3VfP6Nl0ETi4fbPCe0zhBt28lJZQoxCpcqA2LLUIwE1SNF/O', NULL, '2025-10-13 00:51:52', '2025-10-13 00:51:52', 0, 'Admin'),
(23, '019abe4a-8231-7387-ab85-91e53840de3f', 'rojeto', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '2', NULL, 'Eric Kramer', 'vytuguviz@mailinator.com', NULL, '$2y$10$21bFbHYZaITXQ1tx6aX0jONftovcMWUSSk.WzvvjRZM.yixchRmRa', NULL, '2025-11-26 03:52:25', '2025-11-26 03:52:25', 1, 'Admin'),
(24, '019abf55-2e93-7087-a2c3-bf01778fc0d6', 'tunegec', NULL, '1', '0', NULL, 'Stephanie Wiggins', 'cynynabo@mailinator.com', NULL, '$2y$10$qe19l3XP87bYB3avCkxZ/eKpOa.0Vc1iL4T30KpmuW5nvy2rrjJJm', NULL, '2025-11-26 08:43:42', '2025-11-26 08:43:42', 0, 'Admin'),
(25, '019ac330-7924-726e-bf3b-87a2e23d1017', 'mofufa', NULL, '1', '0', NULL, 'Denton Hoffman', 'powi@mailinator.com', NULL, '$2y$10$rU80xEEy86.PjehVbGyOT.N4abpiDgBzYsWsYj6KpES/BYWc3IRwa', NULL, '2025-11-27 02:42:05', '2025-11-27 02:42:05', 0, 'Admin'),
(26, '019ac33a-41ab-7327-9054-f11b5fa62074', 'pajomy', NULL, '3', '0', NULL, 'Shafira Castillo', 'mycavomuh@mailinator.com', NULL, '$2y$10$rZOl8rodOniwflSpKNnXt.HYKGqDuCViIDSuOIUZ8KwUuWxE8Dwty', NULL, '2025-11-27 02:52:46', '2025-11-27 02:52:46', 0, 'Admin'),
(27, '019ac33c-794f-7147-bbc9-88e1cd4cef7d', 'xalipo', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', '0', NULL, 'Kevin Jennings', 'mafo@mailinator.com', NULL, '$2y$10$BfOeGV60.DVpgjgUAx.aYuFqSWCg5xNQiZit6aofKV.26V1fPmRaG', NULL, '2025-11-27 02:55:11', '2025-11-27 02:55:11', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `washings`
--

CREATE TABLE `washings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` time NOT NULL,
  `panjang_produk` decimal(8,2) DEFAULT NULL,
  `diameter_produk` decimal(8,2) DEFAULT NULL,
  `airtrap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lengket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sisa_adonan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekuatan_seal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsentrasi_pckleer` decimal(8,2) DEFAULT NULL,
  `suhu_pckleer_1` decimal(8,2) DEFAULT NULL,
  `suhu_pckleer_2` decimal(8,2) DEFAULT NULL,
  `ph_pckleer` decimal(8,2) DEFAULT NULL,
  `kondisi_air_pckleer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsentrasi_pottasium` decimal(8,2) DEFAULT NULL,
  `suhu_pottasium` decimal(8,2) DEFAULT NULL,
  `ph_pottasium` decimal(8,2) DEFAULT NULL,
  `kondisi_pottasium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu_heater` decimal(8,2) DEFAULT NULL,
  `speed_1` decimal(8,2) DEFAULT NULL,
  `speed_2` decimal(8,2) DEFAULT NULL,
  `speed_3` decimal(8,2) DEFAULT NULL,
  `speed_4` decimal(8,2) DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `washings`
--

INSERT INTO `washings` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `kode_produksi`, `pukul`, `panjang_produk`, `diameter_produk`, `airtrap`, `lengket`, `sisa_adonan`, `kebocoran`, `kekuatan_seal`, `print_kode`, `konsentrasi_pckleer`, `suhu_pckleer_1`, `suhu_pckleer_2`, `ph_pckleer`, `kondisi_air_pckleer`, `konsentrasi_pottasium`, `suhu_pottasium`, `ph_pottasium`, `kondisi_pottasium`, `suhu_heater`, `speed_1`, `speed_2`, `speed_3`, `speed_4`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019aba00-5b41-703b-9cda-ae090dd68113', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '1', 'SROA Ayam Bakar', 'NA12898HJK', '02:04:00', '51.00', '62.00', 'Ada', 'Ada', 'Tidak Ada', 'Ok', 'Ok', 'Tidak Ok', '88.00', '63.00', '45.00', '49.00', 'Tidak OK', '54.00', '77.00', '56.00', 'Tidak OK', '47.00', '15.00', '20.00', '42.00', '77.00', 'Suscipit laborum De', 'Foreman Produksi', '1', '2025-11-25 08:52:56', NULL, '0', NULL, NULL, '2025-11-25 07:52:56', '2025-11-25 07:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `wires`
--

CREATE TABLE `wires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_wire` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_spv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wires`
--

INSERT INTO `wires` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `shift`, `nama_produk`, `nama_supplier`, `data_wire`, `catatan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019ab9c9-0faf-738d-97e8-a6692cff6c0c', 'admin', NULL, '2025-11-25', 'fdaca613-7ab2-4997-8f33-686e886c867d', '3', 'SRCH Ayam Original', 'PT. Intikemas', '\"[{\\\"mesin\\\":\\\"C6\\\",\\\"detail\\\":[{\\\"start\\\":\\\"20:16\\\",\\\"end\\\":\\\"18:47\\\",\\\"no_lot\\\":\\\"Qui consectetur eaq\\\"}]}]\"', 'In sint voluptatum a', NULL, '0', NULL, NULL, '2025-11-25 06:52:33', '2025-11-25 06:52:33');

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `berita_acaras`
--
ALTER TABLE `berita_acaras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chambers`
--
ALTER TABLE `chambers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `loading_checks`
--
ALTER TABLE `loading_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loading_details`
--
ALTER TABLE `loading_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `magnet_traps`
--
ALTER TABLE `magnet_traps`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `mincings`
--
ALTER TABLE `mincings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organoleptiks`
--
ALTER TABLE `organoleptiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packaging_inspections`
--
ALTER TABLE `packaging_inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packaging_inspection_items`
--
ALTER TABLE `packaging_inspection_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packings`
--
ALTER TABLE `packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemasakans`
--
ALTER TABLE `pemasakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyimpangan_kualitas`
--
ALTER TABLE `penyimpangan_kualitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raw_material_inspections`
--
ALTER TABLE `raw_material_inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `release_packings`
--
ALTER TABLE `release_packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sampels`
--
ALTER TABLE `sampels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `samplings`
--
ALTER TABLE `samplings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sampling_fgs`
--
ALTER TABLE `sampling_fgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timbangans`
--
ALTER TABLE `timbangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `washings`
--
ALTER TABLE `washings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wires`
--
ALTER TABLE `wires`
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
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
