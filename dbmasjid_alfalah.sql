-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 12:41 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmasjid_alfalah`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `NAMA_BARANG` varchar(200) NOT NULL,
  `JUMLAH` varchar(100) NOT NULL,
  `KONDISI` varchar(10) NOT NULL,
  `TANGGAL_PEMBELIAN` date NOT NULL,
  `TANGGAL_BELI_GANTI_BARU` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`NAMA_BARANG`, `JUMLAH`, `KONDISI`, `TANGGAL_PEMBELIAN`, `TANGGAL_BELI_GANTI_BARU`) VALUES
('Lampu', '3', 'Rusak', '2020-12-01', '2020-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `khatib`
--

CREATE TABLE `khatib` (
  `NAMA_KHATIB` varchar(100) NOT NULL,
  `NO_TELP` varchar(15) NOT NULL,
  `ALAMAT` text NOT NULL,
  `TANGGAL_KHOTBAH` date NOT NULL,
  `MATERI_KHOTBAH` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khatib`
--

INSERT INTO `khatib` (`NAMA_KHATIB`, `NO_TELP`, `ALAMAT`, `TANGGAL_KHOTBAH`, `MATERI_KHOTBAH`) VALUES
('Dharori', '089192827263', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '2020-11-19', 'Peradaban Jaman Nabi'),
('Mualim', '088228846174', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '2020-11-17', 'Peradaban Duniawi');

-- --------------------------------------------------------

--
-- Table structure for table `kuliah subuh`
--

CREATE TABLE `kuliah subuh` (
  `NAMA_PENGISI` varchar(100) NOT NULL,
  `NO_TELP` varchar(15) NOT NULL,
  `ALAMAT` text NOT NULL,
  `TANGGAL` date NOT NULL,
  `MATERI_KULIAH_SUBUH` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuliah subuh`
--

INSERT INTO `kuliah subuh` (`NAMA_PENGISI`, `NO_TELP`, `ALAMAT`, `TANGGAL`, `MATERI_KULIAH_SUBUH`) VALUES
('Dharori', '088228846174', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '2020-11-15', 'Siksa kubur'),
('Suwarno', '08123456789', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '2020-11-15', 'Godaan Nabi di Jaman Dahulu');

-- --------------------------------------------------------

--
-- Table structure for table `muadzin`
--

CREATE TABLE `muadzin` (
  `NAMA_MUADZIN` varchar(100) NOT NULL,
  `NO_TELP` varchar(15) NOT NULL,
  `ALAMAT` text NOT NULL,
  `WAKTU_ADZAN` varchar(100) NOT NULL,
  `TANGGAL_ADZAN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `muadzin`
--

INSERT INTO `muadzin` (`NAMA_MUADZIN`, `NO_TELP`, `ALAMAT`, `WAKTU_ADZAN`, `TANGGAL_ADZAN`) VALUES
('Junaidi', '0876543212', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', 'Asar', '2020-11-17'),
('Junarto', '085678901234', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', 'Dzuhur', '2020-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus masjid`
--

CREATE TABLE `pengurus masjid` (
  `ID_PENGURUS` int(10) NOT NULL,
  `NAMA` varchar(100) NOT NULL,
  `NO_TELP` varchar(15) NOT NULL,
  `ALAMAT` text NOT NULL,
  `TGL_LAHIR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus masjid`
--

INSERT INTO `pengurus masjid` (`ID_PENGURUS`, `NAMA`, `NO_TELP`, `ALAMAT`, `TGL_LAHIR`) VALUES
(2, 'Ricky', '088228846174', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '1989-08-23'),
(3, 'Anto', '0823456789', 'Kaligetas RT.04 / RW.04, Kelurahan Jatibarang, Kecamatan Mijen, Kota Semarang', '2000-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan ibadah`
--

CREATE TABLE `perlengkapan ibadah` (
  `NAMA_PERLENGKAPAN_IBADAH` varchar(100) NOT NULL,
  `JUMLAH` int(100) NOT NULL,
  `KONDISI` varchar(10) NOT NULL,
  `TANGGAL_PEMBELIAN` date NOT NULL,
  `TANGGAL_BELI_GANTI_BARU` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perlengkapan ibadah`
--

INSERT INTO `perlengkapan ibadah` (`NAMA_PERLENGKAPAN_IBADAH`, `JUMLAH`, `KONDISI`, `TANGGAL_PEMBELIAN`, `TANGGAL_BELI_GANTI_BARU`) VALUES
('Sajadah', 3, 'Rusak', '2020-11-11', '2020-11-27'),
('Sarung', 2, 'Rusak', '2020-11-02', '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(80) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(-2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 511),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(1, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 495),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 495),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(2, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 495),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 495),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 495),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(3, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 495),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 495),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 495),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 495),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 0),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(4, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 495),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 495),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 495),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 495),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 495),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 0),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(5, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}barang', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}khatib', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}kuliah subuh', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}muadzin', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}pengurus masjid', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}perlengkapan ibadah', 495),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevelpermissions', 0),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}userlevels', 0),
(6, '{657821BC-B4A0-4F81-8842-DB5A6D7A3950}users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default'),
(1, 'user1'),
(2, 'user2'),
(3, 'user3'),
(4, 'user4'),
(5, 'user5'),
(6, 'user6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userlevelid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `userlevelid`) VALUES
(1, 'supervisor', 'supervisor', 'supervisor', -1),
(2, 'user1', 'user1', 'user1', 1),
(3, 'user2', 'user2', 'user2', 2),
(4, 'user3', 'user3', 'user3', 3),
(5, 'user4', 'user4', 'user4', 4),
(6, 'user5', 'user5', 'user5', 5),
(7, 'user6', 'user6', 'user6', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`NAMA_BARANG`);

--
-- Indexes for table `khatib`
--
ALTER TABLE `khatib`
  ADD PRIMARY KEY (`NAMA_KHATIB`);

--
-- Indexes for table `kuliah subuh`
--
ALTER TABLE `kuliah subuh`
  ADD PRIMARY KEY (`NAMA_PENGISI`);

--
-- Indexes for table `muadzin`
--
ALTER TABLE `muadzin`
  ADD PRIMARY KEY (`NAMA_MUADZIN`);

--
-- Indexes for table `pengurus masjid`
--
ALTER TABLE `pengurus masjid`
  ADD PRIMARY KEY (`ID_PENGURUS`);

--
-- Indexes for table `perlengkapan ibadah`
--
ALTER TABLE `perlengkapan ibadah`
  ADD PRIMARY KEY (`NAMA_PERLENGKAPAN_IBADAH`);

--
-- Indexes for table `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengurus masjid`
--
ALTER TABLE `pengurus masjid`
  MODIFY `ID_PENGURUS` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
