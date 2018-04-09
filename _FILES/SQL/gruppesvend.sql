-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 09. 04 2018 kl. 08:45:18
-- Serverversion: 10.1.26-MariaDB
-- PHP-version: 7.1.9

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

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `category`
--

INSERT INTO `category` (`id`, `name`, `thumbnail`) VALUES
(1, 'shoes', ''),
(2, 'pants', ''),
(3, 't-shirts', ''),
(4, 'tops', ''),
(5, 'accessories', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `collection`
--

INSERT INTO `collection` (`id`, `name`, `thumbnail`) VALUES
(1, 'winter collection', 'cray-cray.jpg'),
(2, 'summer collection', 'fire.jpg'),
(3, 'exclusive discount on womens wear', 'leopard-snake.jpg'),
(4, 'exclusive discount on ladies wear', 'something.jpg'),
(5, 'Hamsters With people in them', 'water.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Gender fluid fgdsjknfgsjnfgdsl';

--
-- Data dump for tabellen `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Female'),
(2, 'Male'),
(3, 'Helicopter');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `information`
--

CREATE TABLE `information` (
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `newsletter`
--

INSERT INTO `newsletter` (`id`, `name`, `email`) VALUES
(1, 'mathias', 'mathias@glks.dk'),
(4, 'asdasd', 'sadad@sldj.k'),
(6, 'sadasd', 'sdasd@xn--skald-rra.dk'),
(7, 'lakdjasd', 'ldksajd@ldskd.dk');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `collection_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `collection_id`, `category_id`, `gender`, `thumbnail`, `created_at`, `deleted`) VALUES
(1, 'test product 1', 'dælskdælaksdæalkdæsalkdakjsdhksajh', 2, 2, 0, '', '2018-04-04 08:59:44', 0),
(2, 'test product 2', 'dasljhdaskjdhaskhjddkasjd', 3, 1, 0, '', '2018-04-04 09:08:01', 0),
(3, 'Jak', 'ljkklfjklndklklklæ', 3, 2, 1, 'jak.jpg', '2018-04-04 10:47:06', 0),
(4, 'Task', 'dfgbhnm,fvdjk fzvd jmn,fbm,. ', 4, 4, 2, 'task.jpg', '2018-04-04 10:47:55', 0),
(5, 'Herre Sko', 'dælskdælaksdæalkdæsalkdakjsdhksajh\r\n', 2, 2, 2, 'sk.jpg', '2018-04-09 06:44:58', 0),
(6, 'Bagudvendt Hat', 'dasljhdaskjdhaskhjddkasjd', 3, 1, 1, 'hat.jpg', '2018-04-09 06:44:58', 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'retailer');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `salt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `address`, `role_id`, `deleted`, `salt`) VALUES
(2, 'admin', '$2y$10$0ee5M0LFrNPaCk30r2WVee28Wka0m/BgZwZEaTDdomPRpl25ZDw.u', '', 1, 0, ''),
(3, 'retailer', 'retailer', '', 2, 0, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user_session`
--

CREATE TABLE `user_session` (
  `session_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `logged_in` tinyint(1) NOT NULL,
  `last_action` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `user_session`
--

INSERT INTO `user_session` (`session_id`, `user_id`, `logged_in`, `last_action`) VALUES
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925016),
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925023),
('dn0rvqlnr1pensae2g6950i0ko', 2, 1, 1522925056);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indeks for tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tilføj AUTO_INCREMENT i tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`);

--
-- Begrænsninger for tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
