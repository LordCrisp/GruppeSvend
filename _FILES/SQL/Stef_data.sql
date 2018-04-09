-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table gruppesvend.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.category: ~5 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
REPLACE INTO `category` (`id`, `name`, `thumbnail`) VALUES
	(1, 'shoes', ''),
	(2, 'pants', ''),
	(3, 't-shirts', ''),
	(4, 'tops', ''),
	(5, 'accessories', '');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.collection
CREATE TABLE IF NOT EXISTS `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.collection: ~5 rows (approximately)
/*!40000 ALTER TABLE `collection` DISABLE KEYS */;
REPLACE INTO `collection` (`id`, `name`, `thumbnail`) VALUES
	(1, 'winter collection', 'cray-cray.jpg'),
	(2, 'summer collection', 'fire.jpg'),
	(3, 'exclusive discount on womens wear', 'leopard-snake.jpg'),
	(4, 'exclusive discount on ladies wear', 'something.jpg'),
	(5, 'Hamsters With people in them', 'water.jpg');
/*!40000 ALTER TABLE `collection` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Gender fluid fgdsjknfgsjnfgdsl';

-- Dumping data for table gruppesvend.gender: ~3 rows (approximately)
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
REPLACE INTO `gender` (`id`, `gender`) VALUES
	(1, 'Female'),
	(2, 'Male'),
	(3, 'Helicopter');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.information
CREATE TABLE IF NOT EXISTS `information` (
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.information: ~0 rows (approximately)
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
/*!40000 ALTER TABLE `information` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.news: ~0 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.newsletter: ~0 rows (approximately)
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `collection_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `collection_id` (`collection_id`),
  KEY `gender` (`gender`),
  CONSTRAINT `gender` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.product: ~4 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
REPLACE INTO `product` (`id`, `name`, `description`, `collection_id`, `category_id`, `gender`, `thumbnail`, `created_at`, `deleted`) VALUES
	(1, 'Herre Sko', 'dælskdælaksdæalkdæsalkdakjsdhksajh', 2, 2, 2, 'sk.jpg', '2018-04-04 10:59:44', 0),
	(2, 'Bagudvendt Hat', 'dasljhdaskjdhaskhjddkasjd', 3, 1, 1, 'hat.jpg', '2018-04-04 11:08:01', 0),
	(3, 'Jak', 'ljkklfjklndklklklæ', 3, 2, 1, 'jak.jpg', '2018-04-04 12:47:06', 0),
	(4, 'Task', 'dfgbhnm,fvdjk fzvd jmn,fbm,. ', 4, 4, 2, 'task.jpg', '2018-04-04 12:47:55', 0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.role: ~2 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
REPLACE INTO `role` (`id`, `name`) VALUES
	(1, 'admin'),
	(2, 'retailer');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table gruppesvend.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table gruppesvend.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `name`, `password`, `address`, `role_id`) VALUES
	(2, 'admin', 'admin', '', 1),
	(3, 'retailer', 'retailer', '', 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
