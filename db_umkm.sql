-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 06:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(11) NOT NULL,
  `newsid` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dateinsert` datetime NOT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `newsid`, `judul`, `tanggal`, `waktu`, `status`, `dateinsert`, `lastupdate`) VALUES
(2, 0, '', '0000-00-00', '', '', '2019-05-24 14:45:45', '2020-06-23 13:13:38'),
(4, 0, '', '0000-00-00', '', '', '2019-05-24 14:55:44', '2020-06-23 12:42:13'),
(6, 0, '', '0000-00-00', '', '', '2020-06-23 12:47:06', '0000-00-00 00:00:00'),
(7, 0, '', '0000-00-00', '', '', '2023-06-25 17:12:08', '2023-06-25 17:18:23'),
(8, 1, 'TEST JUDUL PELATIHAN', '2023-09-30', '12:12', 'active', '2023-09-15 01:57:44', NULL),
(9, 4, 'Pelatihan Digital Marketing', '2023-09-19', '13:00', 'active', '2023-09-19 03:14:19', NULL),
(10, 5, 'Pelasan', '2023-09-26', '16:00', 'active', '2023-09-19 07:37:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `laporanid` int(11) NOT NULL,
  `umkmid` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` varchar(200) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `dateinsert` datetime NOT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`laporanid`, `umkmid`, `judul`, `tanggal`, `isi`, `kategori`, `status`, `keterangan`, `dateinsert`, `lastupdate`) VALUES
(1, 0, 'Judul', '2023-09-04', 'Isi', 'kerajinan', 'REQUEST', '', '0000-00-00 00:00:00', '2023-09-04 08:27:49'),
(2, 9, 'Permohonan Bantuan Bahan Baku', '2023-09-19', 'kami kesulitan untuk menemukan bahan baku batok kelapa di labanasem.\r\nMohon bantuan info supplier batok kelapa dari daerah lain. Terimakasih', 'pengajuan', 'REQUEST', '&lt;p&gt;oke, kami bantu.&lt;br /&gt;berikut info supplier daerah rogojampi&lt;/p&gt;', '2023-09-19 02:46:22', '2023-09-19 02:48:19'),
(3, 10, 'Permohonan kegiatan', '2023-09-19', 'Mohon bisa diadakan kegiatan agar dagangan laku', 'pengajuan', 'REQUEST', NULL, '2023-09-19 07:23:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loginhistory`
--

CREATE TABLE `loginhistory` (
  `historyid` int(11) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `useragent` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginhistory`
--

INSERT INTO `loginhistory` (`historyid`, `ipaddress`, `useragent`, `username`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '::1', '', '12345'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345'),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '12345@gmail.com'),
(42, '61.5.35.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(43, '61.5.35.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(44, '180.246.226.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(45, '125.166.116.200', 'Mozilla/5.0 (Linux; Android 12; SM-A325F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36', 'admin1'),
(46, '125.166.116.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(47, '125.166.116.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(48, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(49, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(50, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'sonip@gmail.com'),
(51, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(52, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(53, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(54, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(55, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'bibing@gmail.com'),
(56, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(57, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm4@gmail.com'),
(58, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm4@gmail.com'),
(59, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'bibing@gmail.com'),
(60, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(61, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(62, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(63, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'bibing@gmail.com'),
(64, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(65, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(66, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(67, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(68, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'umkm1@gmail.com'),
(69, '36.74.172.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(70, '114.4.222.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(71, '114.4.222.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(72, '114.5.110.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'admin1'),
(73, '103.172.197.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(74, '125.166.117.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(75, '125.166.117.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(76, '125.166.117.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(77, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(78, '103.164.60.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'admin1'),
(79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(80, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(81, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(82, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(83, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(84, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(85, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'admin1'),
(86, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'emaf@gmail.com'),
(87, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(88, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(89, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(91, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(92, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(93, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(94, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(95, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(96, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(97, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(98, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(99, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'martiohusein27@gmail.com'),
(100, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'tiooluciferr666@gmail.com'),
(101, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'admin1'),
(102, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'tiooluciferr666@gmail.com'),
(103, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'admin1'),
(104, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'tiooluciferr666@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `kodeuser` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `hakakses` varchar(20) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`kodeuser`, `nama`, `alamat`, `email`, `username`, `password`, `status`, `hakakses`, `lastlogin`) VALUES
(1, 'admin1', 'jl. raya jember banyuwangi ', 'admin1@labanasem.id', 'admin1', '5e8667a439c68f5145dd2fcbecf02209', 'aktif', 'administrator', '2023-09-12 15:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsid` int(11) NOT NULL,
  `newssubject` varchar(100) NOT NULL,
  `newsdate` date NOT NULL,
  `newsshortdesc` varchar(200) NOT NULL,
  `newsdesc` text NOT NULL,
  `newspicture` varchar(100) NOT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsid`, `newssubject`, `newsdate`, `newsshortdesc`, `newsdesc`, `newspicture`, `lastupdate`) VALUES
(1, 'JUDUL 1', '2023-09-05', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'uploads/news/1.jpg', '2023-09-04 20:25:10'),
(2, 'JUDUL 2', '2023-09-05', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'uploads/news/2.jpg', '2023-09-04 20:25:10'),
(4, 'Pelatihan Digital Marketing', '2023-09-19', 'Pelatihan Digital Marketing', '&lt;p&gt;Mohon kehadiran Bapak dan Ibu dalam pelatihan digital Marketing yang akan dilaksanakan pada:&lt;br /&gt;Hari, tanggal: Selasa, 19 September 2023&lt;/p&gt;\r\n&lt;p&gt;Pukul&amp;nbsp; : 13.00 WIB - selesai&lt;/p&gt;\r\n&lt;p&gt;Tempat: Balai Desa Labanasem&lt;/p&gt;', 'uploads/news/pelatihan digital marketing.JPG', NULL),
(5, 'Bazar Pelasan', '2023-09-19', 'Bazar Pelasan', '&lt;p&gt;Akan diadakan bazar pelasan di lapangan desa labanasem&lt;/p&gt;', 'uploads/news/Hijau Putih Modern Sampul Modul Pelatihan Dokumen A4.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `pesananid` int(11) NOT NULL,
  `umkmid` int(11) DEFAULT NULL,
  `produkid` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `notelepon` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`pesananid`, `umkmid`, `produkid`, `tanggal`, `nama`, `alamat`, `notelepon`, `keterangan`) VALUES
(6, 2, 5, '2023-10-21', 'Martio King', 'Sukorejo ', '081334929102', 'Halo saya ingin memesan barang ini');

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `categoryid` int(11) NOT NULL,
  `category` varchar(5) NOT NULL,
  `description` varchar(300) NOT NULL,
  `lastupdate` datetime NOT NULL,
  `dateinsert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produkid` int(11) NOT NULL,
  `produkkode` varchar(20) NOT NULL,
  `produknama` varchar(50) NOT NULL,
  `tanggalupload` datetime NOT NULL,
  `produkdeskripsi` text NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `sale` varchar(10) NOT NULL,
  `saleamount` decimal(10,0) NOT NULL,
  `preorder` varchar(10) NOT NULL,
  `grosir` decimal(10,0) NOT NULL,
  `photo1` varchar(100) NOT NULL,
  `photo2` varchar(100) NOT NULL,
  `photo3` varchar(100) NOT NULL,
  `photo4` varchar(100) NOT NULL,
  `video` varchar(500) NOT NULL,
  `umkmid` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produkid`, `produkkode`, `produknama`, `tanggalupload`, `produkdeskripsi`, `kategori`, `harga`, `sale`, `saleamount`, `preorder`, `grosir`, `photo1`, `photo2`, `photo3`, `photo4`, `video`, `umkmid`, `status`) VALUES
(4, 'P1-001', 'PRODUK 1', '2023-09-07 00:00:00', 'Tas ini dibuat dengan bahan dasar plastik hasil daur ulang', 'kerajinan', 75000, 'Yes', 10, 'No', 80000, 'uploads/umkm/produk/PROD-004-1.jpg', 'uploads/umkm/produk/PROD-004-2.jpg', 'uploads/umkm/produk/P1-004-3.jpg', 'uploads/umkm/produk/P1-004-4.jpg', '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/y_CXsHlXcYE?si=v6XO0rpQzqC_pRhY&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen&gt;&lt;/iframe&gt; 1', 1, 'enable'),
(5, 'P1-002', 'PRODUK 2', '2023-09-07 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'fashion', 200000, 'No', 0, 'Yes', 180000, 'uploads/umkm/produk/PROD-005-1.png', 'uploads/umkm/produk/PROD-005-2.png', 'uploads/umkm/produk/PROD-005-3.png', 'uploads/umkm/produk/PROD-005-4.png', '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/y_CXsHlXcYE?si=v6XO0rpQzqC_pRhY&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen&gt;&lt;/iframe&gt; 1', 2, 'enable'),
(6, 'P1-003', 'PRODUK 3', '2023-09-07 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'kuliner', 300000, 'No', 0, 'No', 280000, 'uploads/umkm/produk/PROD-006-1.jpg', 'uploads/umkm/produk/PROD-006-2.jpg', 'uploads/umkm/produk/PROD-006-3.jpg', 'uploads/umkm/produk/PROD-006-4.jpg', '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/y_CXsHlXcYE?si=v6XO0rpQzqC_pRhY&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen&gt;&lt;/iframe&gt; 1', 3, 'enable'),
(7, 'P1-004', 'PRODUK 4', '2023-09-07 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'kuliner', 300000, 'Yes', 20, 'Yes', 280000, 'uploads/umkm/produk/PROD-007-1.jpg', 'uploads/umkm/produk/PROD-007-2.jpg', 'uploads/umkm/produk/PROD-007-3.jpg', 'uploads/umkm/produk/PROD-007-4.jpg', '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/y_CXsHlXcYE?si=v6XO0rpQzqC_pRhY&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen&gt;&lt;/iframe&gt; 1', 4, 'enable'),
(8, 'P9-008', 'Set Cangkir Batok Kelapa', '2023-09-19 00:00:00', 'Terbuat dari batok kelapa yang diukir', 'kerajinan', 25000, 'No', 0, 'Yes', 20000, 'uploads/umkm/produk/PROD-008-1.jpg', 'uploads/umkm/produk/PROD-008-2.jpg', '', '', '', 9, 'enable'),
(9, 'P10-009', 'Gajah Oling', '2023-09-19 00:00:00', 'Batik Khas Banyuwangi', 'fashion', 100000, 'Yes', 0, 'Yes', 95000, 'uploads/umkm/produk/PROD-009-1.jpg', '', '', '', '', 10, 'enable'),
(11, 'P28-011', 'Jasa Cukur', '2023-10-24 00:00:00', 'adadadadad', 'jasa', 120000, 'No', 0, 'Yes', 500000, 'uploads/umkm/produk/PROD-011-1.jpg', '', '', '', '', 28, 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `produkfoto`
--

CREATE TABLE `produkfoto` (
  `produkfotoid` int(11) NOT NULL,
  `produkkode` varchar(20) NOT NULL,
  `fotofile` varchar(100) NOT NULL,
  `tanggalinput` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkfoto`
--

INSERT INTO `produkfoto` (`produkfotoid`, `produkkode`, `fotofile`, `tanggalinput`) VALUES
(1, 'P000', 'uploads/_prod/P000.', '2023-09-07 00:00:00'),
(2, 'P000', '', '2023-09-07 00:00:00'),
(3, 'P1000', 'uploads/umkm/produk/372010991_337440481969949_7045447331008643809_n.jpg', '2023-09-07 00:00:00'),
(4, 'P1002', 'uploads/umkm/produk/002-1.jpg', '2023-09-07 00:00:00'),
(5, 'P1003', 'uploads/umkm/produk/PROD-003-1.png', '2023-09-07 00:00:00'),
(6, 'P1-004', 'uploads/umkm/produk/PROD-004-1.png', '2023-09-07 00:00:00'),
(7, 'P1-005', 'uploads/umkm/produk/PROD-005-1.jpg', '2023-09-07 00:00:00'),
(8, 'P1-006', 'uploads/umkm/produk/PROD-006-1.jpg', '2023-09-07 00:00:00'),
(9, 'P9-008', 'uploads/umkm/produk/PROD-008-1.jpg', '2023-09-19 00:00:00'),
(10, 'P10-009', 'uploads/umkm/produk/PROD-009-1.jpg', '2023-09-19 00:00:00'),
(11, 'P27-010', 'uploads/umkm/produk/PROD-010-1.', '2023-10-20 00:00:00'),
(12, 'P28-011', 'uploads/umkm/produk/PROD-011-1.jpg', '2023-10-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `umkmid` int(11) NOT NULL,
  `umkmkode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ig` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namausaha` varchar(100) NOT NULL,
  `jenisusaha` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'inactive, onreview,active',
  `usercreated` varchar(20) NOT NULL,
  `dateinsert` datetime NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`umkmid`, `umkmkode`, `nama`, `alamat`, `nik`, `nohp`, `email`, `ig`, `password`, `namausaha`, `jenisusaha`, `status`, `usercreated`, `dateinsert`, `ipaddress`, `lastupdate`) VALUES
(1, 'UMKM-001', 'Usaha Pertama', 'Jl. Jember Banyuwangi 15 Banyuwangi Jawa Timur', '123456789', '0318956011', 'umkm1@gmail.com', '@umkm1', '12345678', 'NAMA USAHA 1', 'Jasa', 'onreview', '', '2023-09-03 00:00:00', '<br />\r\n<b>Notice</b', '2023-10-19 03:39:21'),
(2, 'UMKM-002', 'UMKM2', 'Jl. Jember Banyuwangi 15 Banyuwangi Jawa Timur', '35150608821002', '031678667', 'umkm2@gmail.com', '@umkm2', '12345678', 'NAMA USAHA 2', 'JENIS USAHA 2', '', '', '2023-09-03 00:00:00', '<br />\r\n<b>Notice</b', '0000-00-00 00:00:00'),
(3, 'UMKM-003', 'UMKM3', 'Jl. Jember Banyuwangi 15 Banyuwangi Jawa Timur', '35150608821002', '031678667', 'umkm3@gmail.com', '@umkm3', '12345678', 'NAMA USAHA 3', 'JENIS USAHA 3', '', '', '2023-09-03 00:00:00', '<br />\r\n<b>Notice</b', '0000-00-00 00:00:00'),
(4, 'UMKM-004', 'UMKM4', 'Jl. Jember Banyuwangi 15 Banyuwangi Jawa Timur', '35150608821002', '0318956011', 'umkm4@gmail.com', '@umkm4', '87654321', 'NAMA USAHA 4', 'JENIS USAHA 4', '', '', '2023-09-03 00:00:00', '<br />\r\n<b>Notice</b', '0000-00-00 00:00:00'),
(7, 'UMKM-007', 'Soni Prasetyo', 'Jl. X Labanasem', '365109772936760001', '085278576391', 'sonip@gmail.com', '', 'JDCcLzSa', 'Jajankoe', 'Kuliner', 'onreview', 'owner', '2023-09-19 00:00:00', '103.164.60.2', NULL),
(9, 'UMKM-008', 'Bibing', 'Ds.Labanasem', '365109772936760001', '085278576391', 'bibing@gmail.com', '@kerajinan_kelapa_labanasem', '12345678', 'Kerajinan Kelapa', 'kerajinan', 'onreview', 'owner', '2023-09-19 00:00:00', '103.164.60.2', '2023-09-19 00:00:00'),
(10, 'UMKM-010', 'Ema', 'Krajan Barat', '3510765365480001', '086426789537', 'emaf@gmail.com', '', '1237673344', 'Batikku', 'fashion', 'onreview', 'owner', '2023-09-19 00:00:00', '114.4.222.56', NULL),
(27, 'UMKM-011', 'Daris', 'Sukorejo', '23131313', '081334929102', 'martiohusein27@gmail.com', '', '$2y$10$S4AiOE/H4riYxS2or06o1.hyfPoGVJfF3ixMSXrupNiz7ht5Ezhw6', 'Usaha test', 'kerajinan', 'inactive', 'owner', '2023-10-19 00:00:00', '::1', NULL),
(28, 'UMKM-028', 'Amur', 'Sukorejo', '23131313', '081232232233', 'tiooluciferr666@gmail.com', '', '$2y$10$2F25h2SfMBiujfyJLs6Hi.XOrPbTykl851M9zwLZTx.Wl9hLRl3oi', 'Usaha Babi', 'kuliner', 'onreview', 'owner', '2023-10-21 00:00:00', '::1', NULL),
(29, 'UMKM-029', 'Amur', 'Sukorejo', '23131313', '081334929102', 'martiohusein27@gmail.com', '', '$2y$10$S4AiOE/H4riYxS2or06o1.hyfPoGVJfF3ixMSXrupNiz7ht5Ezhw6', 'Usaha Babi', 'jasa', 'onreview', 'owner', '2023-10-24 00:00:00', '::1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_requests`
--

CREATE TABLE `reset_password_requests` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_password_requests`
--

INSERT INTO `reset_password_requests` (`id`, `email`, `request_time`) VALUES
(12, 'tiooluciferr666@gmail.com', '2023-10-24 06:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `umkmid` int(11) NOT NULL,
  `umkmkode` varchar(20) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namausaha` varchar(100) NOT NULL,
  `jenisusaha` varchar(50) NOT NULL,
  `lokasiusaha` varchar(100) NOT NULL,
  `periodeusaha` datetime NOT NULL,
  `profile` text NOT NULL,
  `categoryid` int(11) NOT NULL,
  `dateinsert` datetime NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`laporanid`);

--
-- Indexes for table `loginhistory`
--
ALTER TABLE `loginhistory`
  ADD PRIMARY KEY (`historyid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`kodeuser`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesananid`),
  ADD KEY `produkid` (`produkid`),
  ADD KEY `pesanan_ibfk_1` (`umkmid`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkid`),
  ADD KEY `umkmid` (`umkmid`);

--
-- Indexes for table `produkfoto`
--
ALTER TABLE `produkfoto`
  ADD PRIMARY KEY (`produkfotoid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`umkmid`);

--
-- Indexes for table `reset_password_requests`
--
ALTER TABLE `reset_password_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`umkmid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `laporanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loginhistory`
--
ALTER TABLE `loginhistory`
  MODIFY `historyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `kodeuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesananid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produkfoto`
--
ALTER TABLE `produkfoto`
  MODIFY `produkfotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `umkmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reset_password_requests`
--
ALTER TABLE `reset_password_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `umkmid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`umkmid`) REFERENCES `register` (`umkmid`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`produkid`) REFERENCES `produk` (`produkid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
