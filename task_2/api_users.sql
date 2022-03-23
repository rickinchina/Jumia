-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 04:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `seen` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `author_id`, `description`, `seen`) VALUES
(1, 'Maid Service', 1, 'Clean houses', 0),
(2, 'Drum teacher', 2, 'BUM BUM BUM!', 1),
(3, 'FCP player asdasd', 3, 'be the best in the league', 1),
(4, 'Doctor\'s assistant', 1, 'Basically a nurse', 1),
(5, 'Soccer Player', 1, 'Good with your feet', 1),
(6, 'Garbage cleaner', 2, 'clean trash and more', 0),
(7, 'NBA', 3, 'Looking for a really short guy to go under the really tall guys legs', 1),
(9, 'Vendedor de fruta', 2, 'vender fruta no mercado', 1),
(10, 'teacher', 3, 'tdrtghujgrffvbiuhyuhfyuguyhg', 1),
(11, 'Garbage cleaner', 2, 'play for the NBA and pay us to play', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `admin` int(1) NOT NULL,
  `password` text NOT NULL,
  `auth` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `admin`, `password`, `auth`) VALUES
(1, 'Ricardo', 0, 'eusouoricardo', 'agfhtrfgjhneawaerfqr345fv214'),
(2, 'admin', 1, 'eusoufixe', 'vdasfsarfwrwe2tg43543tdsfv234n675'),
(3, 'Sofia', 0, 'ploploplo', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
