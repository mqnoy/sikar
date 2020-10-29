-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2020 at 12:20 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sikar`
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS tb_akses;
DROP TABLE IF EXISTS tb_karyawan;
DROP TABLE IF EXISTS tb_detail_karyawan;

--
-- Table structure for table `tb_akses`
--

CREATE TABLE `tb_akses` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','karyawan') NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akses`
--

INSERT INTO `tb_akses` (`id`, `username`, `password`, `level`, `date_inserted`) VALUES
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661', 'admin', '2020-10-19 15:34:53'),
(8, 'karyawansaya', 'c4ca4238a0b923820dcc509a6f75849b', 'karyawan', '2020-10-29 11:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_karyawan`
--

CREATE TABLE `tb_detail_karyawan` (
  `id` int(11) NOT NULL,
  `size_seragam` char(15) NOT NULL,
  `jrk_tempuh` int(11) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `kar_id` int(11) NOT NULL,
  `akses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_karyawan`
--

INSERT INTO `tb_detail_karyawan` (`id`, `size_seragam`, `jrk_tempuh`, `kilometer`, `kar_id`, `akses_id`) VALUES
(1, 'XL', 16000, 2, 1, 1),
(4, 'M', 16000, 2, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jkel` char(1) NOT NULL,
  `nama_karyawan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `nik`, `tgl_lahir`, `jkel`, `nama_karyawan`) VALUES
(1, '201643502057', '2020-09-27', 'L', 'azmi'),
(8, 'karyawansaya', '2020-10-01', 'L', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail_karyawan`
--
ALTER TABLE `tb_detail_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_detail_karyawan`
--
ALTER TABLE `tb_detail_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
