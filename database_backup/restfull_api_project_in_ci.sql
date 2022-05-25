-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 08:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restfull_api_project_in_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(8) NOT NULL,
  `survivor_id` int(8) NOT NULL,
  `water` int(2) NOT NULL,
  `food` int(2) NOT NULL,
  `medication` int(2) NOT NULL,
  `ammunition` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `survivor_id`, `water`, `food`, `medication`, `ammunition`) VALUES
(1, 2, 10, 10, 10, 10),
(2, 3, 10, 10, 10, 10),
(3, 4, 10, 10, 10, 10),
(4, 5, 10, 10, 10, 10),
(5, 6, 10, 10, 10, 10),
(6, 7, 10, 10, 10, 10),
(7, 8, 10, 10, 10, 10),
(8, 9, 10, 10, 10, 10),
(9, 10, 10, 10, 10, 10),
(10, 11, 10, 10, 10, 10),
(11, 12, 10, 10, 10, 10),
(13, 14, 10, 10, 10, 10),
(14, 15, 10, 10, 10, 10),
(15, 16, 10, 10, 10, 10),
(16, 17, 10, 10, 10, 10),
(17, 18, 10, 10, 10, 10),
(19, 20, 100, 100, 10, 60),
(20, 21, 100, 40, 100, 100),
(21, 22, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `survivor`
--

CREATE TABLE `survivor` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT 0 COMMENT '0: Not infected\r\n1: Infected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survivor`
--

INSERT INTO `survivor` (`id`, `name`, `age`, `gender`, `latitude`, `longitude`, `flag`) VALUES
(14, 'heysushil', 22, 'm', '88.998890', '88.998890', 0),
(15, 'New Demo User', 22, 'm', '88.998890', '88.998890', 0),
(16, 'DemoDemo', 33, 'm', '88.0000', '88.0000', 1),
(17, 'heysushilheysushil', 11, 'm', '88.0000', '88.0000', 1),
(18, 'Demo', 22, 'm', '88.998890', '88.998890', 0),
(20, 'Demo', 11, 'm', '88.998889', '88.0000', 0),
(21, 'theworldplate', 33, 'm', '88.998889', '88.0000', 0),
(22, 'theworldplate', 44, 'm', '88.998889', '88.998898', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survivor_old_location`
--

CREATE TABLE `survivor_old_location` (
  `id` int(8) NOT NULL,
  `survivor_id` int(8) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survivor`
--
ALTER TABLE `survivor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survivor_old_location`
--
ALTER TABLE `survivor_old_location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `survivor`
--
ALTER TABLE `survivor`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `survivor_old_location`
--
ALTER TABLE `survivor_old_location`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
