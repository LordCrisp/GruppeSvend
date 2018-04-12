-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2018 at 01:03 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gruppesvend`
--

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `thumbnail`) VALUES
(1, 'shoes', ''),
(2, 'pants', ''),
(3, 't-shirts', ''),
(4, 'tops', ''),
(5, 'accessories', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `session_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `logged_in` tinyint(1) NOT NULL,
  `last_action` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`session_id`, `user_id`, `logged_in`, `last_action`) VALUES
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925016),
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925023),
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925056),
('3fce4102a5f4df87783bc04853b6329f', 2, 1, 1523432480),
('28eb163a01680ea61c17fc71d21ff506', 2, 0, 1523521112),
('28eb163a01680ea61c17fc71d21ff506', 2, 0, 1523521120);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
