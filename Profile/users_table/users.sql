-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2024 at 01:31 PM
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
-- Database: `ecorise`
--

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
(1, 'Drinkbot', 'relay@gmail.com', '', '1601b28af4889d7ca7af3ca61bb69a14', ''),
(2, 'madie', 'menace@gmail.com', '', '9da8218bceacdde38b0fced3ed0ad0ba', ''),
(3, 'Amina Mohammad', 'aminamohd56348@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocIfl_97KL3vNkEORha224TO4nS-9Ef_9rFEYXqwfrOQ4EPgSg=s96-c', 'fcea920f7412b5da7be0cf42b8c93759', ''),
(4, 'silver', 'silver123@gmail.com', 'silver - 2024.05.01 - 08.24.10pm.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'Hello, this is Silver Novochrono! 💖🦋'),
(5, 'xielian', 'hua@gmail.com', 'xielian - 2024.05.02 - 11.36.46am.jpg', '827ccb0eea8a706c4c34a16891f84e7b', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
