-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 04:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_submenu`
--

CREATE TABLE `tb_submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menus` int(11) NOT NULL,
  `submenu` varchar(50) NOT NULL,
  `linksubmenu` varchar(20) NOT NULL,
  `statusmenu` enum('aktif','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_submenu`
--

INSERT INTO `tb_submenu` (`id_submenu`, `id_menus`, `submenu`, `linksubmenu`, `statusmenu`) VALUES
(1, 1, 'Tipe User', 'tipeuser/', 'aktif'),
(2, 1, 'Tahun Akademik', 'tahunakademik/', 'aktif'),
(3, 1, 'Kelas', 'kelas/', 'aktif'),
(4, 1, 'Staf', 'staff/', 'aktif'),
(5, 1, 'Siswa', 'siswa/', 'aktif'),
(6, 1, 'Master Transaksi', 'mtransaksi/', 'aktif'),
(7, 2, 'Transaksi', 'transaksi/', 'aktif'),
(8, 3, 'Kas Masuk', 'kasmasuk/', 'aktif'),
(9, 3, 'Kas Keluar', 'kaskeluar/', 'aktif'),
(10, 3, 'Kas Umum', 'kasumum/', 'aktif'),
(11, 3, 'Buku Pembantu', 'bukupembantu/', 'aktif'),
(12, 3, 'Jurnal', 'jurnal/', 'aktif'),
(13, 3, 'neraca', 'neraca/', 'aktif'),
(14, 3, 'Perubahan Modal', 'modal/', 'aktif'),
(15, 3, 'Laba Rugi', 'labarugi', 'aktif'),
(16, 1, 'Master COA', 'mastercoa/', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_submenu`
--
ALTER TABLE `tb_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_submenu`
--
ALTER TABLE `tb_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
