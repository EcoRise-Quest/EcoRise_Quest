-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 04:19 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) NOT NULL,
  `postid` int(10) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `postid`, `img_file`, `time`) VALUES
(1, 1, 'fries.PNG', '14:27:52'),
(2, 2, 'Girl.PNG', '14:29:56'),
(3, 3, 'man.jpg', '03:30:31'),
(4, 4, 'Boy.PNG', '03:33:37'),
(5, 5, 'classic bridal.jpg', '05:02:52'),
(6, 6, 'woman running.jpg', '12:31:35'),
(7, 7, 'food people.PNG', '13:35:16'),
(8, 8, 'solarsystem.jpg', '23:05:28'),
(9, 9, 'bonfire.PNG', '23:26:05'),
(10, 10, 'creativity.jpg', '00:33:08'),
(11, 11, 'florist.jpg', '00:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` varchar(600) NOT NULL,
  `image` varchar(500) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image`, `timestamp`) VALUES
(1, '0', 'Sustainable life', 'Hey! This is my first post here on this lovely platform!', '', '2024-04-23 09:48:31'),
(2, '0', 'Implement a Healthy Lifestyle', 'Yo! This is my first post here :) Be nice!!', '', '2024-04-23 09:48:31'),
(3, '0', 'EcoRiseQuest is life-changing!', 'Hiii! This is my first post here. I\'m excited to make new friends and share novel information', '', '2024-04-23 09:48:31'),
(4, '0', 'Eco-friendly environment', 'Sup\' how are y\'all!! This website is amazing!', '', '2024-04-23 09:48:31'),
(5, '1', 'Sustainability is the future', 'Started doing the challenges and it\'s life changing. Become a part of the EcoRise Quest community. Let\'s rise together for a healthier environment!', 'post_2024.05.03_03.33.16pm.png', '2024-05-03 06:33:16'),
(8, '5', 'Implementing a sustainable lifestyle', 'Hello everyone! 🚴‍♀️🌍 I’ve recently taken up bicycling as part of my personal commitment to sustainable development. It’s a small step, but it’s amazing how much of a difference it can make. Not only does bicycling reduce carbon emissions and air pollution, it also promotes physical health and well-being. Plus, it’s a great way to enjoy the beauty of our environment!', 'post_2024.05.03_08.35.26pm.png', '2024-05-03 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `bio` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `image`, `password`, `bio`) VALUES
(1, 'sarah', 'saralay@gmail.com', 'sarah - 2024.05.04 - 01.52.30pm.jpg', 'ec26202651ed221cf8f993668c459d46', ''),
(2, 'aminaa', 'amii@gmail.com', '', 'e4aa437501ea8fb3d3465f6b86272cb6', ''),
(3, 'nandu', 'banana@gmail.com', '', '5d78b43e17382a2620158af1fb1c3dc9', ''),
(4, 'yumi', 'yummyum@gmail.com', '', '2be9cb5103f23d0fb9fb6eb71b4dcdf0', ''),
(5, 'alice', 'Alice@gmail.com', 'alice - 2024.05.03 - 03.37.18pm.jpg', '44abfd845597c03ff519ab75cc039bfa', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
