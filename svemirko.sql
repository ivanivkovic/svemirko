-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2019 at 06:28 PM
-- Server version: 10.3.17-MariaDB-0ubuntu0.19.04.1
-- PHP Version: 7.2.19-0ubuntu0.19.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svemirko`
--

-- --------------------------------------------------------

--
-- Table structure for table `svemirko_ship_arrival_logs`
--

CREATE TABLE `svemirko_ship_arrival_logs` (
  `time` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `svemirko_ship_arrival_logs`
--

INSERT INTO `svemirko_ship_arrival_logs` (`time`, `id`, `name`, `type_id`) VALUES
('1565711135', 47, 'TRAD-1224', 21),
('1565711151', 48, 'SHMUP-322', 22),
('1565713307', 50, 'Taneja DT-0322', 26),
('1565713352', 52, 'TBM Agile E19', 28),
('1565713392', 53, 'Technic\'air LD71', 29),
('1565713425', 54, 'Thorp RC3', 26),
('1565713446', 55, 'Valtion US-33', 22),
('1565713471', 56, 'Watson S66', 24),
('1565713516', 57, 'Wolfsberg FN TT Line 2', 21),
('1565713547', 58, 'Wright-Martin RP45', 25),
('1565713566', 59, 'ABS RP88', 25),
('1565713614', 60, 'Acme 44', 30),
('1565713653', 62, 'Acme 44', 25);

-- --------------------------------------------------------

--
-- Table structure for table `svemirko_ship_types`
--

CREATE TABLE `svemirko_ship_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svemirko_ship_types`
--

INSERT INTO `svemirko_ship_types` (`id`, `name`) VALUES
(21, 'Economy'),
(22, 'Military'),
(23, 'Emergency'),
(24, 'Supply'),
(25, 'Repair'),
(26, 'Recycle'),
(28, 'Escape Pod'),
(29, 'Tank'),
(30, 'Cruiser');

-- --------------------------------------------------------

--
-- Table structure for table `svemirko_users`
--

CREATE TABLE `svemirko_users` (
  `id` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `svemirko_users`
--

INSERT INTO `svemirko_users` (`id`, `password`, `username`, `email`) VALUES
(1, '4ff1a33e188b7b86123d6e3be2722a23514a83b4', 'ivanivkovic', 'ivan.ivkovichh@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `svemirko_ship_arrival_logs`
--
ALTER TABLE `svemirko_ship_arrival_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `svemirko_ship_types`
--
ALTER TABLE `svemirko_ship_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `svemirko_ship_arrival_logs`
--
ALTER TABLE `svemirko_ship_arrival_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `svemirko_ship_types`
--
ALTER TABLE `svemirko_ship_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `svemirko_ship_arrival_logs`
--
ALTER TABLE `svemirko_ship_arrival_logs`
  ADD CONSTRAINT `svemirko_ship_arrival_logs_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `svemirko_ship_types` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
