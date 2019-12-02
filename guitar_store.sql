-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2019 at 04:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitar_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative`
--

CREATE TABLE `alternative` (
  `id` bigint(10) NOT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `jenis_guitar` varchar(15) DEFAULT NULL,
  `harga` double NOT NULL DEFAULT 0,
  `stock` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternative`
--

INSERT INTO `alternative` (`id`, `merk`, `jenis_guitar`, `harga`, `stock`) VALUES
(20191202135025, 'Fender', 'Stratocaster', 20000000, 45),
(20191202145108, 'Gibson', 'Less Paul', 30000000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint(10) NOT NULL,
  `criteria` varchar(30) NOT NULL,
  `bobot` float NOT NULL,
  `jenis` enum('Cost','Benefit') NOT NULL DEFAULT 'Benefit',
  `keterangan` text DEFAULT NULL,
  `isian` bigint(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `criteria`, `bobot`, `jenis`, `keterangan`, `isian`) VALUES
(23, 'Jenis Kayu', 5, 'Benefit', 'Jenis kayu yang digunakan ', 11),
(24, 'Harga', 4, 'Benefit', 'Harga gitar', 1),
(25, 'Merk Guitar', 3, 'Benefit', 'Merk dari gitar', 13);

-- --------------------------------------------------------

--
-- Table structure for table `dt_pencocokan`
--

CREATE TABLE `dt_pencocokan` (
  `id_pencocokan` bigint(10) DEFAULT NULL,
  `id_kriteria` bigint(10) DEFAULT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_pencocokan`
--

INSERT INTO `dt_pencocokan` (`id_pencocokan`, `id_kriteria`, `nilai`) VALUES
(2122019145108, 23, 2),
(2122019145108, 25, 5),
(2122019145108, 24, 30000000),
(2122019153203, 23, 5),
(2122019153203, 25, 4),
(2122019153203, 24, 20000000);

-- --------------------------------------------------------

--
-- Table structure for table `dt_perhitungan`
--

CREATE TABLE `dt_perhitungan` (
  `id_alternative` bigint(10) NOT NULL,
  `id_perhitungan` bigint(10) NOT NULL,
  `hasil_perhitungan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `isian`
--

CREATE TABLE `isian` (
  `id` bigint(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `isian`
--

INSERT INTO `isian` (`id`, `nama`, `jenis`) VALUES
(1, 'numeric', ' quantity'),
(11, 'Jenis Kayu', 'quality'),
(13, 'Merk Gitar', 'quantity');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_isian`
--

CREATE TABLE `nilai_isian` (
  `id` bigint(10) NOT NULL,
  `parameter` varchar(50) NOT NULL,
  `nilai` int(4) NOT NULL,
  `id_isian` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_isian`
--

INSERT INTO `nilai_isian` (`id`, `parameter`, `nilai`, `id_isian`) VALUES
(34, 'Kayu Mahogani', 5, 11),
(35, 'Kayu Rosewood', 4, 11),
(36, 'Kayu Maple', 3, 11),
(37, 'Kayu Koa', 2, 11),
(38, 'Selain itu', 1, 11),
(39, 'Gibson', 5, 13),
(40, 'Fender', 4, 13),
(41, 'ibanez', 3, 13),
(42, 'Taylor', 2, 13),
(43, 'Selain itu', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `pencocokan`
--

CREATE TABLE `pencocokan` (
  `id` bigint(10) NOT NULL,
  `id_alternative` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pencocokan`
--

INSERT INTO `pencocokan` (`id`, `id_alternative`) VALUES
(2122019153203, 20191202135025),
(2122019145108, 20191202145108);

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id` bigint(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `foto`) VALUES
(1, 'Arie Saputra', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'user.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative`
--
ALTER TABLE `alternative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isian` (`isian`);

--
-- Indexes for table `dt_pencocokan`
--
ALTER TABLE `dt_pencocokan`
  ADD KEY `id_pencocokan` (`id_pencocokan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `dt_perhitungan`
--
ALTER TABLE `dt_perhitungan`
  ADD KEY `id_alternative` (`id_alternative`),
  ADD KEY `id_perhitungan` (`id_perhitungan`);

--
-- Indexes for table `isian`
--
ALTER TABLE `isian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_isian`
--
ALTER TABLE `nilai_isian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_isian` (`id_isian`);

--
-- Indexes for table `pencocokan`
--
ALTER TABLE `pencocokan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alternative` (`id_alternative`);

--
-- Indexes for table `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative`
--
ALTER TABLE `alternative`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20191202151721;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `isian`
--
ALTER TABLE `isian`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai_isian`
--
ALTER TABLE `nilai_isian`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pencocokan`
--
ALTER TABLE `pencocokan`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16112019142241;

--
-- AUTO_INCREMENT for table `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11161914225739;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`isian`) REFERENCES `isian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dt_pencocokan`
--
ALTER TABLE `dt_pencocokan`
  ADD CONSTRAINT `dt_pencocokan_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `criteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_pencocokan_ibfk_2` FOREIGN KEY (`id_pencocokan`) REFERENCES `pencocokan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dt_perhitungan`
--
ALTER TABLE `dt_perhitungan`
  ADD CONSTRAINT `dt_perhitungan_ibfk_1` FOREIGN KEY (`id_alternative`) REFERENCES `alternative` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dt_perhitungan_ibfk_2` FOREIGN KEY (`id_perhitungan`) REFERENCES `perhitungan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_isian`
--
ALTER TABLE `nilai_isian`
  ADD CONSTRAINT `nilai_isian_ibfk_1` FOREIGN KEY (`id_isian`) REFERENCES `isian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pencocokan`
--
ALTER TABLE `pencocokan`
  ADD CONSTRAINT `pencocokan_ibfk_1` FOREIGN KEY (`id_alternative`) REFERENCES `alternative` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
