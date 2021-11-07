-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 10:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pencatatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_bar` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `detail_barang` varchar(255) DEFAULT NULL,
  `kategori` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_bar`, `nama`, `detail_barang`, `kategori`, `jenis`, `quantity`, `created_at`, `updated_at`) VALUES
(13, 'Kabel VGA', '', 1, 2, 7, '2021-11-07 08:59:54', '2021-11-07 08:59:54'),
(32, 'Komputer A', '2020', 4, 1, 2, '2021-11-07 15:07:49', '2021-11-07 15:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id_bk` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `namaUS` int(11) NOT NULL,
  `quantityBK` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_bm` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `namaUS` varchar(255) NOT NULL,
  `quantityBM` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tglMas` datetime DEFAULT NULL,
  `tglKel` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id_bm`, `barang`, `namaUS`, `quantityBM`, `status`, `tglMas`, `tglKel`, `created_at`, `updated_at`) VALUES
(20, 13, 'Saya', 5, 0, '2021-11-07 02:15:03', NULL, '2021-11-07 14:15:03', '2021-11-07 14:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `barangsn`
--

CREATE TABLE `barangsn` (
  `id_sn` int(11) NOT NULL,
  `id_bars` int(11) NOT NULL,
  `sn` int(11) NOT NULL,
  `id_bar_spes` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kat`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Kabel', '2021-10-26 09:45:42', '2021-10-26 09:45:42'),
(2, 'Komputer part', '2021-10-26 09:46:13', '2021-10-26 09:46:13'),
(3, 'Laptop', '2021-10-26 06:57:06', '2021-10-26 06:57:06'),
(4, 'Komputer', '2021-11-07 07:30:43', '2021-11-07 07:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `peminjamansn`
--

CREATE TABLE `peminjamansn` (
  `id_pemiSN` int(11) NOT NULL,
  `id_pemiBar` int(11) NOT NULL,
  `id_snBar` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_us` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `namaUSR` varchar(255) NOT NULL,
  `noHP` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_us`, `role`, `namaUSR`, `noHP`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '021734893724', 'admin@admin', '2021-10-27 03:02:49', '2021-10-27 03:02:49'),
(2, 'user', 'Bufd', '028748932784', 'bufd@email', '2021-10-26 20:21:11', '2021-10-26 20:21:11'),
(3, 'user', 'sand', '021737864234', 'sandy23@ps.com', '2021-10-26 20:26:11', '2021-10-26 20:26:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_bar`),
  ADD KEY `categori` (`kategori`);

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `barang` (`barang`),
  ADD KEY `namaUS` (`namaUS`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id_bm`),
  ADD KEY `barang` (`barang`);

--
-- Indexes for table `barangsn`
--
ALTER TABLE `barangsn`
  ADD PRIMARY KEY (`id_sn`),
  ADD KEY `id_bars` (`id_bars`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `peminjamansn`
--
ALTER TABLE `peminjamansn`
  ADD PRIMARY KEY (`id_pemiSN`),
  ADD KEY `id_pemiBar` (`id_pemiBar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_us`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_bar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id_bm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `barangsn`
--
ALTER TABLE `barangsn`
  MODIFY `id_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjamansn`
--
ALTER TABLE `peminjamansn`
  MODIFY `id_pemiSN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id_kat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD CONSTRAINT `barangkeluar_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `barang` (`id_bar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangkeluar_ibfk_2` FOREIGN KEY (`namaUS`) REFERENCES `user` (`id_us`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `barang` (`id_bar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangsn`
--
ALTER TABLE `barangsn`
  ADD CONSTRAINT `barangsn_ibfk_1` FOREIGN KEY (`id_bars`) REFERENCES `barang` (`id_bar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjamansn`
--
ALTER TABLE `peminjamansn`
  ADD CONSTRAINT `peminjamansn_ibfk_1` FOREIGN KEY (`id_pemiBar`) REFERENCES `barangmasuk` (`id_bm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjamansn_ibfk_2` FOREIGN KEY (`id_pemiSN`) REFERENCES `barangsn` (`id_sn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
