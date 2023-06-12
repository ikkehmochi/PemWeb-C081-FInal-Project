-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 04:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(5) NOT NULL,
  `nama_dipesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `waktu` datetime NOT NULL,
  `kursi_dipesan` int(2) NOT NULL,
  `no_meja_fk` int(2) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `no_meja` int(2) NOT NULL,
  `jumlah_kursi` int(2) NOT NULL,
  `status_meja` varchar(25) NOT NULL,
  `lantai` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`no_meja`, `jumlah_kursi`, `status_meja`, `lantai`) VALUES
(1, 4, '0', 1),
(2, 4, '0', 1),
(3, 4, '0', 1),
(4, 4, '0', 1),
(5, 2, '0', 1),
(6, 2, '0', 1),
(7, 2, '0', 1),
(8, 2, '0', 1),
(9, 4, '0', 1),
(10, 4, '0', 1),
(11, 4, '0', 1),
(12, 4, '0', 1),
(13, 4, '0', 2),
(14, 4, '0', 2),
(15, 4, '0', 2),
(16, 4, '0', 2),
(17, 4, '0', 2),
(18, 4, '0', 2),
(19, 4, '0', 2),
(20, 6, '0', 2),
(21, 6, '0', 2),
(22, 6, '0', 2),
(23, 6, '0', 2),
(24, 6, '0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `no_meja` (`no_meja_fk`) USING BTREE;

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`no_meja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_booking_nomeja` FOREIGN KEY (`no_meja_fk`) REFERENCES `meja` (`no_meja`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
