-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2023 at 09:31 AM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrdnwghm_barberos`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `barber_id` int(11) NOT NULL,
  `deposit_slip` varchar(256) NOT NULL,
  `bookingstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `date`, `time`, `name`, `phone`, `barber_id`, `deposit_slip`, `bookingstatus`) VALUES
(5, 4, '2023-12-08', '16:04:00', 'Arnold D Nigga', '09958679826', 1, '', 1),
(6, 5, '2023-12-08', '14:04:00', 'Arnold D Nigga', '09958679826', 2, '', 1),
(7, 5, '2023-12-06', '16:49:00', 'lander the goat', '09958679826', 3, '', 1),
(8, 6, '2023-12-04', '10:00:00', 'Jorge MC Clane Lapid', '09959239624', 1, '', 0),
(9, 4, '2023-12-06', '10:25:00', 'Matcha Latte', '123567890890', 2, '', 0),
(10, 11, '2023-12-15', '16:13:00', 'Charles Ryan D. Robianes', '123213123', 3, '', 0),
(13, 11, '2023-12-08', '17:17:00', 'Charles Ryan D. Robianes', '09958679826', 1, '', 0),
(14, 11, '2023-12-08', '17:17:00', 'Charles Ryan D. Robianes', '09958679826', 1, '', 0),
(15, 11, '2023-12-08', '17:17:00', 'Charles Ryan D. Robianes', '09958679826', 1, '', 0),
(16, 11, '2023-12-08', '17:17:00', 'Charles Ryan D. Robianes', '09958679826', 1, '', 0),
(17, 11, '2023-12-07', '17:36:00', 'now', '123231', 2, '', 0),
(19, 11, '2023-12-20', '14:10:00', 'Charles Ryan D. Robianes', '12313', 1, 'deposit/respi.PNG', 1),
(20, 11, '2023-12-20', '14:20:00', '3+3+3', '123123', 1, 'deposit/Screenshot_2023-12-06-17-14-43-087_com.android.chrome.jpg', 0),
(21, 15, '2023-12-25', '10:00:00', 'runnel', '0991239193131', 1, 'deposit/7b82922f-1762-40b0-b51a-630893666951.jpg', 0),
(22, 16, '2023-12-25', '12:03:00', 'Runnel', '09165235526', 1, 'deposit/Screenshot_20231209_180219.jpg', 0),
(23, 4, '2023-12-28', '13:04:00', 'nyeeeerk', '123123123', 1, 'deposit/ab6761610000e5eb3ffb795bdff1da2fbc787aa2.jfif', 0),
(24, 7, '2023-12-07', '10:43:00', 'admin', '9914833795', 1, 'deposit/seiko.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image1`
--

CREATE TABLE `image1` (
  `id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `barbername` varchar(256) NOT NULL,
  `workdesc` varchar(256) NOT NULL,
  `awards` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image1`
--

INSERT INTO `image1` (`id`, `image`, `title`, `status`, `barbername`, `workdesc`, `awards`) VALUES
(1, 'team-1.jpg', 'Soy', 'Active', 'Chris Rock Pangilinan', 'Classic and Beard Cuts', 'Gentle Man\'s Club Best Beard Stylist'),
(2, 'team-2.jpg', 'Gmark', 'Active', 'Mark Williams Canlas', 'Low to High Fades', 'Fading Festival 2021 Champion'),
(3, 'team-3.jpg', 'Mr Suave', 'Active', 'George Miller', 'Burst Fades and Tapers', '2023 BBA Rookie of The Year');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `created_at`) VALUES
(4, 'newacc', '$2y$10$0sTBjSrJxZbTgbhwI3ojLutZMh3kNMwv3.3Fh/NL1NrxZ3iynxtPi', '', '2023-12-03 12:49:32'),
(5, 'nyeeeerk', '$2y$10$hSfwYTISvp33vBCS5qVH7u/kaEqSZsN9wH3Qsf5OP1mL2aSM/Cxly', 'admin', '2023-12-03 13:18:22'),
(6, 'jorge108', '$2y$10$4nPE8Qo7ymPQ1RqmSzC17epjV9mCGJshfytbcgxArVIJRDJXW8Wiq', '', '2023-12-04 00:59:58'),
(7, 'admin', '$2y$10$97nUM/lM/6yvRL/mWi0yAeStahRrYv2h2bzxDm0CQKo0h.TyTjjCa', '', '2023-12-04 01:01:14'),
(8, 'francio', '$2y$10$ET2cT8ZaoUaYhRCdgeNg6OIxCiLPpprPfpZB.IhvOE2lbkl9jVdXW', '', '2023-12-04 01:24:29'),
(9, 'noldar25', '$2y$10$2IPBBVTdd1woql4xqxWIs.Efr/NRrFkClZojfEzp9iuRs8UuEAJc6', '', '2023-12-04 01:30:21'),
(10, 'runel', '$2y$10$38vAywX9DI2mxTmGfl9ffeShgL33YRnQcHJ/TYefJayMCCidUsELe', 'regular', '2023-12-04 09:39:46'),
(11, 'boatshit', '$2y$10$icpbXJS1XahUchaTAVBxWukP.LtTOPpi8Kh.Ro8Cmv68Sqft0vrjq', 'regular', '2023-12-06 01:06:00'),
(12, 'charles85', '$2y$10$WWz9ds10o123yTnFOboEH.Gn3rJAKD7xo6a7iQvAxpw5bHM7QdNN2', 'regular', '2023-12-06 02:21:45'),
(13, 'newdes', '$2y$10$lkVVfEX23/bzbjNYqR9F3.xWnjMVi0ws//Ct6yM0bemMoTfSxzC7W', 'regular', '2023-12-06 12:35:02'),
(14, 'naitsirkbalisi', '$2y$10$qrLJpYB.bgCIm1lqHRnqjuha42z5uWNveZQ1UvADoM9BbjKJUy2TC', 'regular', '2023-12-09 02:04:29'),
(15, 'unholy', '$2y$10$NXw4GlLOKldVYXMOFeMGqORFBggKHIpl2qf8EoiB2vGoGr4MhP4x6', 'regular', '2023-12-09 02:04:38'),
(16, 'Runnel', '$2y$10$SFbN.lsdstknneg4p.Au4eNXfMCbORTGRjlFATYOWCoI/bXQ.nwOa', 'regular', '2023-12-09 05:00:44'),
(17, 'Marty', '$2y$10$eINRgOWC0Wf7inIwNg/Qru2J.N2Uu6IH82BrJRGN/Fgc6Czqd/hW6', 'regular', '2023-12-11 02:23:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `barber_id` (`barber_id`);

--
-- Indexes for table `image1`
--
ALTER TABLE `image1`
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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `image1`
--
ALTER TABLE `image1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`barber_id`) REFERENCES `image1` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
