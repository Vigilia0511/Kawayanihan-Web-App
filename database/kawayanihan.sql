-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 07:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kawayanihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `timestamp`) VALUES
(1, 'josh', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-19 22:55:39'),
(2, 'mina', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-19 23:04:44'),
(3, 'sana', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-19 23:05:04'),
(4, 'josh1', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-20 03:42:49'),
(5, 'coleen', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-20 03:46:37'),
(6, 'coleen1', 'a9c71ad9a291209f8b77d851c4b46f92f734389e', 'user', '2025-04-20 03:50:59'),
(7, 'leen', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'user', '2025-04-20 03:51:47'),
(8, 'cc', 'ea42d19ad8d196fbbf861969dd92d5b3a02639ec', 'user', '2025-04-20 03:58:43'),
(9, 'sana1', '0e88e91a455c7515655d787b86365bbf5d2be80c', 'user', '2025-04-20 04:03:38'),
(11, 'vigilia', '0e88e91a455c7515655d787b86365bbf5d2be80c', 'Admin', '2025-04-21 05:21:05'),
(12, '11', '2c135f8c1ec93c5d626d6fb062c0ebf28973a31e', 'user', '2025-08-05 10:15:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
