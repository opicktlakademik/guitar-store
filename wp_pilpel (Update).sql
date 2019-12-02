-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 08:55 AM
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
-- Database: `wp_pilpel`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative`
--

CREATE TABLE `alternative` (
  `id` bigint(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternative`
--

INSERT INTO `alternative` (`id`, `nama`, `nomor_telepon`, `alamat`, `email`) VALUES
(20191110090214, 'Rr. Mangga Trisakti Aji', '0809 111 1111', '                Alamate Rr. Mangga            ', 'mt@gmail.com'),
(20191110113800, 'Mbah', '0899 7626 8902', '                Alamate mbah iki yo            ', 'dj@email.com'),
(20191111045900, 'Nzack Kzocknovic', '0893 800 8000', '                House of Nzack Kzocknovic            ', 'nk@email.com'),
(20191112052226, 'Mang Ucup Kidul', '62887 7872 129', '                alamate ucup            ', 'uc@gmial.com'),
(20191112054127, 'Bapak Siapa Ini', '0988 8291 1299', '                ALamate bapakmu ya            ', 'bapakmu@mail.com'),
(20191116120917, 'Bapak Apa Ya', '0899 7626 8902', 'Jl. Jalan lah', 'bapakmu@mail.com'),
(20191116142240, 'Mang Udin', '0982 3729 2838', 'Gg. M U 34 N.Y                            ', 'udin@wow.hm');

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
(1, 'Laba', 4, 'Benefit', 'Laba / Keuntungan yang didapat dari pelanggan', 2),
(2, 'Pesanan', 4, 'Benefit', 'Pesanan dari pelanggan', 5),
(18, 'Frekuensi', 2, 'Benefit', 'Frekuensi pembelian pelanggan', 6),
(19, 'Hutang', 4, 'Cost', 'Hutang pelanggan', 7),
(20, 'Modal', 2, 'Cost', 'Modal yang dibutuhkan perusahaan', 2),
(21, 'Jarak', 2, 'Benefit', 'Jarak pengiriman', 9),
(22, 'Waktu', 3, 'Benefit', 'Waktu yang dibutuhkan untuk memproses pesanan', 10);

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
(10112019113800, 1, 5),
(10112019113800, 2, 4),
(10112019113800, 18, 3),
(12112019052656, 1, 3),
(12112019052656, 2, 3),
(12112019052656, 18, 5),
(12112019054127, 1, 4),
(12112019054127, 2, 2),
(12112019054127, 18, 3),
(12112019054127, 19, 4),
(12112019054127, 20, 3),
(12112019054127, 21, 4),
(12112019054127, 22, 5),
(12112019052656, 19, 3),
(12112019052656, 20, 4),
(12112019052656, 21, 4),
(12112019052656, 22, 5),
(10112019113800, 19, 3),
(10112019113800, 20, 2),
(10112019113800, 21, 5),
(10112019113800, 22, 3),
(16112019105345, 1, 4),
(16112019105345, 2, 3),
(16112019105345, 18, 5),
(16112019105345, 19, 2),
(16112019105345, 20, 5),
(16112019105345, 21, 4),
(16112019105345, 22, 3),
(16112019105818, 1, 5),
(16112019105818, 2, 5),
(16112019105818, 18, 5),
(16112019105818, 19, 2),
(16112019105818, 20, 3),
(16112019105818, 21, 3),
(16112019105818, 22, 3),
(16112019120917, 1, 4),
(16112019120917, 2, 5),
(16112019120917, 18, 3),
(16112019120917, 19, 4),
(16112019120917, 20, 4),
(16112019120917, 21, 5),
(16112019120917, 22, 3),
(16112019142240, 1, 5),
(16112019142240, 2, 5),
(16112019142240, 18, 5),
(16112019142240, 19, 1),
(16112019142240, 20, 3),
(16112019142240, 21, 1),
(16112019142240, 22, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dt_perhitungan`
--

CREATE TABLE `dt_perhitungan` (
  `id_alternative` bigint(10) NOT NULL,
  `id_perhitungan` bigint(10) NOT NULL,
  `hasil_perhitungan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_perhitungan`
--

INSERT INTO `dt_perhitungan` (`id_alternative`, `id_perhitungan`, `hasil_perhitungan`) VALUES
(20191110090214, 111319150241, 0.442681),
(20191112054127, 111319150241, 0.0613444),
(20191112052226, 111319150241, 0.101348),
(20191111045900, 111319150241, 0.33759),
(20191110113800, 111319150241, 0.0570367),
(20191110090214, 11141904395029, 0.234893),
(20191110113800, 11141904395029, 0.225168),
(20191111045900, 11141904395029, 0.206596),
(20191112052226, 11141904395029, 0.176588),
(20191112054127, 11141904395029, 0.156754),
(20191110090214, 11161913134455, 0.194064),
(20191110113800, 11161913134455, 0.178943),
(20191111045900, 11161913134455, 0.165196),
(20191112052226, 11161913134455, 0.159068),
(20191112054127, 11161913134455, 0.144149),
(20191116120917, 11161913134455, 0.15858),
(20191110090214, 11161914225738, 0.159782),
(20191110113800, 11161914225738, 0.147332),
(20191111045900, 11161914225738, 0.136014),
(20191112052226, 11161914225738, 0.130968),
(20191112054127, 11161914225738, 0.118685),
(20191116120917, 11161914225738, 0.130566),
(20191116142240, 11161914225738, 0.176652),
(20191110090214, 1116191427239, 0.159782),
(20191110113800, 1116191427239, 0.147332),
(20191111045900, 1116191427239, 0.136014),
(20191112052226, 1116191427239, 0.130968),
(20191112054127, 1116191427239, 0.118685),
(20191116120917, 1116191427239, 0.130566),
(20191116142240, 1116191427239, 0.176652);

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
(1, 'Numeric', ' Numeric'),
(2, 'Rentang Harga 1 - 20 Jt', 'Rentang Harga'),
(5, 'Rentang Pesanan 1 - 1000 Kg', 'Rentang Pesanan'),
(6, 'Frekuensi Pembelian', 'Frekuensi'),
(7, 'Rentang Hutang 0 - < 10 Jt', 'Rentang Hutang'),
(8, 'Rentang Modal', 'Rentang Modal'),
(9, 'Rentang Jarak', 'Rentang Jarak'),
(10, 'Rentang Waktu', 'Rentang');

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
(1, 'Lebih  dari Rp. 20.000.000', 5, 2),
(2, 'Rp. 10.000.000 - Rp. 20.000.000', 4, 2),
(3, 'Rp. 2.000.000 - Rp. 9.900.000', 3, 2),
(4, 'Rp. 1.000.000 - Rp. 1.900.000', 2, 2),
(5, 'Kurang dari Rp. 1.000.000', 1, 2),
(6, 'Lebih dari 1000 Kg', 5, 5),
(7, '500 Kg - 1000 Kg', 4, 5),
(8, '100 Kg - 499 Kg', 3, 5),
(9, '50 Kg - 99 Kg', 2, 5),
(10, 'Kurang dari 50 Kg', 1, 5),
(11, 'Sering 1 x 2 Minggu', 5, 6),
(12, 'Jarang 1 x 4 Minggu', 3, 6),
(13, 'Tidak Pernah', 1, 6),
(17, 'Lebih dari 100 Jam', 5, 10),
(18, '24 Jam - 100 Jam', 3, 10),
(19, 'Kurang dari 24 Jam', 1, 10),
(24, 'Lebih dari Rp. 10.000.000', 5, 7),
(25, 'Rp. 5.000.000 - Rp. 10.000.000', 4, 7),
(26, 'Rp. 2.000.000 - Rp. 4.900.000', 3, 7),
(27, 'Kurang dari Rp. 2.000.000', 2, 7),
(28, 'Lebih dari 50 Km', 5, 9),
(29, '20 Km - 50 Km', 4, 9),
(30, '10 Km - 19 Km', 3, 9),
(31, '2 Km - 9 Km', 2, 9),
(32, 'Kurang dari 2 Km', 1, 9),
(33, 'Tidak ada', 1, 7);

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
(16112019105818, 20191110090214),
(10112019113800, 20191110113800),
(16112019105345, 20191111045900),
(12112019052656, 20191112052226),
(12112019054127, 20191112054127),
(16112019120917, 20191116120917),
(16112019142240, 20191116142240);

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id` bigint(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perhitungan`
--

INSERT INTO `perhitungan` (`id`, `tanggal`) VALUES
(111319150241, '2019-11-13'),
(1116191427239, '2019-11-16'),
(11141904395029, '2019-11-14'),
(11161913134455, '2019-11-16'),
(11161914225738, '2019-11-16');

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
(1, ' Losi Diana Wunu', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'user.jpg');

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
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20191116142241;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `isian`
--
ALTER TABLE `isian`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_isian`
--
ALTER TABLE `nilai_isian`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
