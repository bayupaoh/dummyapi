-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2016 at 08:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `no_ktp` varchar(21) NOT NULL,
  `nama_user` varchar(51) NOT NULL,
  `email` varchar(51) NOT NULL,
  `password` varchar(255) NOT NULL,
  `merk_mobil` varchar(31) DEFAULT NULL,
  `tipe_mobil` varchar(31) DEFAULT NULL,
  `url_foto` varchar(255) DEFAULT 'default.png',
  `pulsa` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`no_ktp`, `nama_user`, `email`, `password`, `merk_mobil`, `tipe_mobil`, `url_foto`, `pulsa`) VALUES
('12345', 'bayu', 'b@mail.com', '12345', 'Honda', 'Jazz', 'default.png', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`id_transaksi` int(11) NOT NULL,
  `no_ktp` varchar(21) DEFAULT NULL,
  `kode_voucher` varchar(51) DEFAULT NULL,
  `waktu_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `waktu_keluar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `durasi` double NOT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `status` enum('bayar','belum') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_ktp`, `kode_voucher`, `waktu_masuk`, `waktu_keluar`, `durasi`, `total_biaya`, `status`) VALUES
(3, '12345', 'P1', '2016-06-26 18:15:26', '2016-06-26 23:00:00', 1, 1000, 'bayar'),
(4, '12345', 'P2', '2016-06-26 18:15:40', '2016-06-26 23:00:00', 1, 1000, 'bayar');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_parkir`
--

CREATE TABLE IF NOT EXISTS `voucher_parkir` (
  `kode_voucher` varchar(51) NOT NULL,
  `status` enum('pakai','kosong') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher_parkir`
--

INSERT INTO `voucher_parkir` (`kode_voucher`, `status`) VALUES
('P1', 'kosong'),
('P2', 'kosong');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_pulsa`
--

CREATE TABLE IF NOT EXISTS `voucher_pulsa` (
  `kode_voucher` varchar(51) NOT NULL,
  `besar_pulsa` int(11) DEFAULT NULL,
  `status` enum('pakai','kosong') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher_pulsa`
--

INSERT INTO `voucher_pulsa` (`kode_voucher`, `besar_pulsa`, `status`) VALUES
('a1', 10000, 'kosong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
 ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `fk_no_ktp` (`no_ktp`), ADD KEY `fk_vou_parkir` (`kode_voucher`);

--
-- Indexes for table `voucher_parkir`
--
ALTER TABLE `voucher_parkir`
 ADD PRIMARY KEY (`kode_voucher`);

--
-- Indexes for table `voucher_pulsa`
--
ALTER TABLE `voucher_pulsa`
 ADD PRIMARY KEY (`kode_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `fk_no_ktp` FOREIGN KEY (`no_ktp`) REFERENCES `pengguna` (`no_ktp`),
ADD CONSTRAINT `fk_vou_parkir` FOREIGN KEY (`kode_voucher`) REFERENCES `voucher_parkir` (`kode_voucher`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
