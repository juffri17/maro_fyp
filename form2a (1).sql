-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.33

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
-- Table structure for table `form2a`
--

CREATE TABLE `form2a` (
  `id` int(11) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perkhidmatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` int(11) DEFAULT 0,
  `path_file` varchar(100) NOT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form2a`
--

INSERT INTO `form2a` (`id`, `ic`, `email`, `perkhidmatan`, `created_at`, `approval_status`, `path_file`, `pic`) VALUES
(1, '910101010999', 'lecturer1.gmail.com', 'rakaman_foto_digital, perkhidmatan_audio', '2024-04-08 21:38:24', 0, '', 'NICHOLAS NESAMUTHU'),
(2, '890109034456', 'alicejohnson@gmail.com', 'rakaman_video, perkhidmatan_audio', '2024-04-08 22:02:08', 0, '', 'AZMIN BIN AZLAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form2a`
--
ALTER TABLE `form2a`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form2a`
--
ALTER TABLE `form2a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
