-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 11:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `form1`
--

CREATE TABLE `form1` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jabatan_unit` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form1`
--

INSERT INTO `form1` (`id`, `ic`, `email`, `jabatan_unit`, `created_at`) VALUES
(1, '910101010999', 'lecturer1@gmail.com', 'JKP', '2024-04-08 21:31:14'),
(2, '890109034456', 'alicejohnson@gmail.com', 'JP', '2024-04-08 22:01:09'),
(3, '890109034456', 'alicejohnson@gmail.com', 'JKA', '2024-04-10 18:29:45'),
(4, '950617080761', 'erfanbinabdullah1995@gmail.com', 'PIP', '2024-04-11 23:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `form2`
--

CREATE TABLE `form2` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perkhidmatan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form2`
--

INSERT INTO `form2` (`id`, `ic`, `email`, `perkhidmatan`, `created_at`) VALUES
(1, '910101010999', 'lecturer1@gmail.com', 'audio_visual', '2024-04-08 21:31:20'),
(2, '890109034456', 'alicejohnson@gmail.com', 'audio_visual', '2024-04-08 22:01:48'),
(3, '890109034456', 'alicejohnson@gmail.com', 'kerja_grafik_multimedia', '2024-04-11 21:04:46'),
(4, '950617080761', 'erfanbinabdullah1995@gmail.com', 'kerja_grafik_multimedia', '2024-04-11 23:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `form2a`
--

CREATE TABLE `form2a` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perkhidmatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` int(11) DEFAULT 0,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form2a`
--

INSERT INTO `form2a` (`id`, `ic`, `email`, `perkhidmatan`, `created_at`, `approval_status`, `pic`) VALUES
(1, '910101010999', 'lecturer1@gmail.com', 'rakaman_foto_digital, perkhidmatan_audio', '2024-04-08 21:38:24', 3, 'AHMAD SYAWAL BIN YEOP AZIZ'),
(2, '890109034456', 'alicejohnson@gmail.com', 'rakaman_video, perkhidmatan_audio', '2024-04-08 22:02:08', 0, 'AZMIN BIN AZLAN');

-- --------------------------------------------------------

--
-- Table structure for table `form2b`
--

CREATE TABLE `form2b` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tugasan_kerja` varchar(50) DEFAULT NULL,
  `saiz` varchar(50) DEFAULT NULL,
  `konsep` varchar(100) DEFAULT NULL,
  `perkataan` text DEFAULT NULL,
  `durasi_video` varchar(50) DEFAULT NULL,
  `gambar_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` int(11) DEFAULT 0,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form2b`
--

INSERT INTO `form2b` (`id`, `ic`, `email`, `tugasan_kerja`, `saiz`, `konsep`, `perkataan`, `durasi_video`, `gambar_logo`, `created_at`, `approval_status`, `pic`) VALUES
(1, '890109034456', 'alicejohnson@gmail.com', 'banner', '10', 'Biru', 'Kerja Grafik biru yang menarik', '2 minits', '', '2024-04-11 21:10:50', 4, 'NICHOLAS NESAMUTHU'),
(2, '950617080761', 'erfanbinabdullah1995@gmail.com', 'poster', '100', 'Merah', 'Kerja Grafik multimedia merah yang cantik', '5 minits', '', '2024-04-11 23:36:59', 2, 'MUSHAYRI B. YAHYA');

-- --------------------------------------------------------

--
-- Table structure for table `form3a`
--

CREATE TABLE `form3a` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `lokasi_acara` varchar(255) DEFAULT NULL,
  `tarikh_acara` date NOT NULL,
  `masa_acara` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form3a`
--

INSERT INTO `form3a` (`id`, `ic`, `email`, `nama_acara`, `lokasi_acara`, `tarikh_acara`, `masa_acara`, `timestamp`) VALUES
(1, '910101010999', 'lecturer1@gmail.com', 'Majlis Perbicaraan', 'Dewan Aneka', '2024-04-09', '22:43:00', '2024-04-08 21:43:24'),
(2, '890109034456', 'alicejohnson@gmail.com', 'Majlis Perakaman', 'Dewan Aneka Besar', '2024-04-16', '12:00:00', '2024-04-08 22:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `form3b`
--

CREATE TABLE `form3b` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `lokasi_acara` varchar(255) DEFAULT NULL,
  `tarikh_acara` date NOT NULL,
  `masa_acara` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form3b`
--

INSERT INTO `form3b` (`id`, `ic`, `email`, `nama_acara`, `lokasi_acara`, `tarikh_acara`, `masa_acara`, `created_at`) VALUES
(1, '890109034456', 'alicejohnson@gmail.com', 'Majlis Perakaman Video', 'Melaka', '2024-04-18', '22:15:00', '2024-04-11 21:15:31'),
(2, '950617080761', 'erfanbinabdullah1995@gmail.com', 'Majlis Perakaman Video', 'Kuala Lumpur', '2024-04-19', '11:30:00', '2024-04-11 23:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `form4a`
--

CREATE TABLE `form4a` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tarikh_raptai` date DEFAULT NULL,
  `masa_raptai` time DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form4a`
--

INSERT INTO `form4a` (`id`, `ic`, `email`, `tarikh_raptai`, `masa_raptai`, `submitted_at`) VALUES
(1, '910101010999', 'lecturer1@gmail.com', '2024-04-07', '18:30:00', '2024-04-08 21:48:04'),
(2, '890109034456', 'alicejohnson@gmail.com', '2024-04-11', '11:00:00', '2024-04-08 22:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `form4b`
--

CREATE TABLE `form4b` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tarikh_raptai` date NOT NULL,
  `masa_raptai` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form4b`
--

INSERT INTO `form4b` (`id`, `ic`, `email`, `tarikh_raptai`, `masa_raptai`, `created_at`) VALUES
(1, '890109034456', 'alicejohnson@gmail.com', '2024-04-14', '11:20:00', '2024-04-11 21:17:17'),
(2, '950617080761', 'erfanbinabdullah1995@gmail.com', '2024-04-15', '12:37:00', '2024-04-11 23:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `maro`
--

CREATE TABLE `maro` (
  `ic` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maro`
--

INSERT INTO `maro` (`ic`, `password`, `email`, `name`) VALUES
('770110065704', '$2y$10$qTU4oUDYcpHU9VidUyYX6OAW9pDr1hMH/OeSLF84D4ueV/bbJn.We', 'nathrah@puo.edu.my', 'NATHARAH BINTI NAWAWI'),
('861106386795', '$2y$10$2cjGed5XnyZt4jotBZj9Z.HuJiFLX9prhJI3rCu4lJpaMWFFxL12q', 'bakhya_raj@puo.edu.my', 'M. BAKHYARAJ KOUNDER A/L MUNIANDY');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `ic` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`ic`, `password`, `email`, `name`) VALUES
('670328086163', '$2y$10$iZHcTtNsUb0Wo8QU.zAlyOupZhI6G2iqkTtk5FPZpHKWbxd0zaaAC', 'mushayri@puo.edu.my', 'MUSHAYRI B. YAHYA'),
('780615105037', '$2y$10$BY3hg5Y27FEJnDjqXMlgnOhb8nD6vd8zL/.AjC1Yg7ghABjt3B8g2', 'ronnie@puo.edu.my', 'RONNIE BIN BAHARI'),
('790907075705', '$2y$10$8kobaLONUuGGOEk5Mho8luf25oPhkKw5ZM9f92/xvUSd.esbj6h6C', 'ahmadsyawal@puo.edu.my', 'AHMAD SYAWAL BIN YEOP AZIZ'),
('811107085083', '$2y$10$tjRnBAHe6oeFm9q50ZF0Ju9S0DZwSLWQnasVtmWALCg1qu9HJDZCG', 'azminazlan@puo.edu.my', 'AZMIN BIN AZLAN'),
('831018086373', '$2y$10$CiZGgOAHH4yAfOcQRTWxM.Ng/P6n/uX0AMJKiZ4Mi8AKzgZsdGeqS', 'anisibrahim@puo.edu.my', 'ANIS BIN IBRAHIM'),
('841125085594', '$2y$10$MMr8oC7y1FdTVpqQE.eCvOISA1VfwaGOIhAfhvLCntDNPyFFx6.s.', 'sh.zuliana@puo.edu.my', 'SHARIFAH ZULIANA BINTI SYED MOHAMED'),
('870603086499', '$2y$10$0jHkZpwUuabd9LA8A3EFyO1adT8uhsi21gTgMKwe16d8LSk43hUZ.', 'nicholas_nesamuthu@puo.edu.my', 'NICHOLAS NESAMUTHU'),
('950907025812', '$2y$10$uPHRtbcNKPkGbu05ss6Sn.KWuczLQaZarysS6P4Cwdoz1uwwn3p4O', 'yana.amirah272@gmail.com', 'NURLIYANA AMIRAH BT NADZARI');

-- --------------------------------------------------------

--
-- Table structure for table `unitsuper`
--

CREATE TABLE `unitsuper` (
  `ic` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unitsuper`
--

INSERT INTO `unitsuper` (`ic`, `password`, `email`, `name`) VALUES
('780519026048', '$2y$10$KXlAqIoa0F9rmomlLCSireQMMoqKKM3XJgU6Bux9Pv30Xk6JCdjI6', 'sitisalmah@puo.edu.my', 'SITI SALMAN BINTI MD KASSIM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ic` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ic`, `password`, `email`, `name`) VALUES
('010101010999', '$2y$10$rRL/UcIhDRppVl2qgLK2q.eDEQvHo/PmWKJCD6LBHQBbnezUuhgQ6', 'lecturer1@gmail.com', 'ALI BIN ABDULLAH'),
('890109034456', '$2y$10$zqQo7Y6bBAw8cYSpBjiM9.rBa9lPD7KvO/TqIXw43i2x.XjaAEU7m', 'alicejohnson@gmail.com', 'Alice Johnson'),
('950617080761', '$2y$10$/ktDsMzMitig605PpG43Nu0o4cRoanxKDAOTnSQFJnwFfsA.n2wnq', 'erfanbinabdullah1995@gmail.com', 'Erfan bin Abdullah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form1`
--
ALTER TABLE `form1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form2`
--
ALTER TABLE `form2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form2a`
--
ALTER TABLE `form2a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form2b`
--
ALTER TABLE `form2b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form3a`
--
ALTER TABLE `form3a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form3b`
--
ALTER TABLE `form3b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form4a`
--
ALTER TABLE `form4a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form4b`
--
ALTER TABLE `form4b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maro`
--
ALTER TABLE `maro`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `unitsuper`
--
ALTER TABLE `unitsuper`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form1`
--
ALTER TABLE `form1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form2`
--
ALTER TABLE `form2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form2a`
--
ALTER TABLE `form2a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form2b`
--
ALTER TABLE `form2b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form3a`
--
ALTER TABLE `form3a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form3b`
--
ALTER TABLE `form3b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form4a`
--
ALTER TABLE `form4a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form4b`
--
ALTER TABLE `form4b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
