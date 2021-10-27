-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 07:49 AM
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
  `slug` varchar(255) NOT NULL,
  `detail_barang` varchar(255) NOT NULL,
  `kategori` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_bar`, `nama`, `slug`, `detail_barang`, `kategori`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 'Keyboard putih', 'keyboard', 'Keyboard putih merek asal', 2, 3, '2021-10-26 09:49:27', '2021-10-26 09:49:27'),
(3, 'Laptop Asus', 'laptop-asus', 'Laptop Asus Keuaran 2020', 3, 2, '2021-10-26 06:57:06', '2021-10-26 06:57:06'),
(4, 'Kabel Sata', 'kabel-sata', 'kabel sata warna merah', 1, 29, '2021-10-26 06:57:30', '2021-10-26 06:57:30'),
(5, 'Kabel VGA', 'kabel-vga', 'Kabel VGA Proyektor', 1, 10, '2021-10-26 07:15:26', '2021-10-26 07:15:26');

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

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`id_bk`, `barang`, `namaUS`, `quantityBK`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 10, '2021-10-26 23:25:23', '2021-10-26 23:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_bm` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `namaUS` int(11) NOT NULL,
  `quantityBM` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id_bm`, `barang`, `namaUS`, `quantityBM`, `created_at`, `updated_at`) VALUES
(7, 4, 3, 10, '2021-10-27 00:14:55', '2021-10-27 00:14:55');

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
(3, 'Laptop', '2021-10-26 06:57:06', '2021-10-26 06:57:06');

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
(3, 'user', 'sand', '021737864234', 'sandy23@pb.com', '2021-10-26 20:26:11', '2021-10-26 20:26:11');

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
  ADD KEY `barang` (`barang`),
  ADD KEY `namaUS` (`namaUS`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

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
  MODIFY `id_bar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id_bm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `barang` (`id_bar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangmasuk_ibfk_2` FOREIGN KEY (`namaUS`) REFERENCES `user` (`id_us`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
