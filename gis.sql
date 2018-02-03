-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2018 at 05:13 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `jalan`
--

CREATE TABLE `jalan` (
  `id_data` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kelurahan` varchar(200) NOT NULL,
  `kecamatan` varchar(200) NOT NULL,
  `tipe` enum('Tanah','Semen','Aspal') NOT NULL,
  `kondisi` enum('Baik','Sedang','Buruk') NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jalan`
--

INSERT INTO `jalan` (`id_data`, `nama`, `kelurahan`, `kecamatan`, `tipe`, `kondisi`, `latitude`, `longitude`) VALUES
(1, 'Jakarta', 'Jakarta', 'Jakarta', 'Aspal', 'Baik', -6.599130675207247, 106.82281494140625),
(2, 'hhaha', 'huhu', 'kakak', 'Tanah', 'Baik', 99.9, 221.22);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama`) VALUES
(1, 'Bengkulu Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `kl_dat_das` varchar(225) NOT NULL,
  `namobj` text NOT NULL,
  `thn_data` int(4) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `vol` varchar(100) NOT NULL,
  `biaya` bigint(20) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `metadata` varchar(100) NOT NULL,
  `lcode` varchar(100) NOT NULL,
  `fcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `kl_dat_das`, `namobj`, `thn_data`, `id_provinsi`, `id_kabupaten`, `vol`, `biaya`, `longitude`, `latitude`, `remarks`, `metadata`, `lcode`, `fcode`) VALUES
(6, 'ekjkewlrj', 'rklterklj', 2018, 1, 1, 'werewj', 342, 107.633056640625, -6.871892962887516, 'krkjekl', 'erkwljwekl', 'elkwrjkl', 'elkrjlewk');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(45) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(70) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `access_token` text NOT NULL,
  `role` enum('admin','kepala dinas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `jabatan`, `email`, `nomor_hp`, `password`, `access_token`, `role`) VALUES
('09021181419007', 'Azhary Arliansyah', 'Adm00n', 'arliansyah_azhary@yahoo.com', '0988', '985fabf8f96dc1c4c306341031569937', '', 'admin'),
('09021181520021', 'aaaaaaaa', 'Bukan Adm00n', 'asdasd@gmail.com', '09090', '985fabf8f96dc1c4c306341031569937', '', 'kepala dinas');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama`) VALUES
(1, 'Bengkulu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jalan`
--
ALTER TABLE `jalan`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provinsi` (`id_provinsi`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jalan`
--
ALTER TABLE `jalan`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kota_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
