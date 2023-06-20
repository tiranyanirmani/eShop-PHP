-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eshop
CREATE DATABASE IF NOT EXISTS `eshop` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `eshop`;

-- Dumping structure for table eshop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aemail` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_users` (`aemail`),
  CONSTRAINT `FK_admin_users` FOREIGN KEY (`aemail`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.admin: ~0 rows (approximately)
REPLACE INTO `admin` (`id`, `aemail`, `code`) VALUES
	(1, 'thinuka1@gmail.com', '62cd96276b0e6');

-- Dumping structure for table eshop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.brand: ~4 rows (approximately)
REPLACE INTO `brand` (`id`, `name`) VALUES
	(1, 'Apple'),
	(2, 'Samsung'),
	(3, 'Vivo'),
	(4, 'Sony'),
	(5, 'HTC');

-- Dumping structure for table eshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cart_product` (`product_id`),
  KEY `FK_cart_users` (`user_email`),
  CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_cart_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.cart: ~3 rows (approximately)
REPLACE INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES
	(4, 16, 'thinuka1@gmail.com', 1),
	(7, 5, 'thinuka1@gmail.com', 1),
	(8, 16, 'thinuka1@gmail.com', 1);

-- Dumping structure for table eshop.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.category: ~7 rows (approximately)
REPLACE INTO `category` (`id`, `name`) VALUES
	(1, 'Cell Phones & Accessories'),
	(2, 'Computer & Tablets'),
	(3, 'Cameras'),
	(4, 'Camera Drones'),
	(5, 'Video Game Console'),
	(6, 'Microphones'),
	(7, 'Batteries');

-- Dumping structure for table eshop.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.city: ~3 rows (approximately)
REPLACE INTO `city` (`id`, `name`, `district_id`) VALUES
	(1, 'piliyandala', 1),
	(2, 'Kesbew', 1),
	(3, 'Mathugama', 2);

-- Dumping structure for table eshop.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.color: ~5 rows (approximately)
REPLACE INTO `color` (`id`, `name`) VALUES
	(1, 'Gold'),
	(2, 'Rose Gold'),
	(3, 'Black'),
	(4, 'Blue'),
	(5, 'Silver');

-- Dumping structure for table eshop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.condition: ~2 rows (approximately)
REPLACE INTO `condition` (`id`, `name`) VALUES
	(1, 'Brandnew'),
	(2, 'Used');

-- Dumping structure for table eshop.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.district: ~1 rows (approximately)
REPLACE INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Colombo', 9),
	(2, 'Kaluthara', 9);

-- Dumping structure for table eshop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.gender: ~2 rows (approximately)
REPLACE INTO `gender` (`id`, `gender_name`) VALUES
	(0, 'Male'),
	(1, 'Female');

-- Dumping structure for table eshop.images
CREATE TABLE IF NOT EXISTS `images` (
  `code` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.images: ~7 rows (approximately)
REPLACE INTO `images` (`code`, `product_id`) VALUES
	('resources\\mobile images\\htc_u.jpg', 1),
	('resources\\mobile images\\huawei_p20.png', 2),
	('resources\\mobile images\\iphone12.jpg', 3),
	('resources//product_img//62cf9550e9627.png', 5),
	('resources//product_img//62cf95bb59e43.png', 15),
	('resources\\mobile images\\oppo_a95.png', 16),
	('resources\\mobile images\\samsung_s6.jpg', 16),
	('resources//product_img//62cf95db74ae8.png', 17);

-- Dumping structure for table eshop.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from` varchar(100) DEFAULT NULL,
  `to` varchar(100) DEFAULT NULL,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_message_users` (`from`),
  KEY `FK_message_users_2` (`to`),
  CONSTRAINT `FK_message_users` FOREIGN KEY (`from`) REFERENCES `users` (`email`),
  CONSTRAINT `FK_message_users_2` FOREIGN KEY (`to`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.message: ~3 rows (approximately)
REPLACE INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES
	(1, 'aaaa@gmail.com', 'thinuka1@gmail.com', 'dadadada', '2022-07-11 20:06:33', 1),
	(5, 'thinuka1@gmail.com', 'aaaa@gmail.com', 'nfgghbkghfc', '2022-07-11 21:59:06', 1),
	(6, 'aaaa@gmail.com', 'thinuka1@gmail.com', ',hhv,bjgv', '2022-07-11 21:59:33', 1);

-- Dumping structure for table eshop.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.model: ~4 rows (approximately)
REPLACE INTO `model` (`id`, `name`) VALUES
	(1, 'iPhone 12'),
	(2, 'iPhone 11'),
	(3, 'iPhone X'),
	(4, 'iPhone 8'),
	(5, 'iPhone 7');

-- Dumping structure for table eshop.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_id` int NOT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_id`),
  CONSTRAINT `FK_model_has_brand_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `FK_model_has_brand_model` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.model_has_brand: ~4 rows (approximately)
REPLACE INTO `model_has_brand` (`id`, `model_id`, `brand_id`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1),
	(5, 5, 1);

-- Dumping structure for table eshop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `color_id` int NOT NULL,
  `status_id` int NOT NULL,
  `condition_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_color1_idx` (`color_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_users1_idx` (`users_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.product: ~7 rows (approximately)
REPLACE INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_id`, `model_has_brand_id`, `color_id`, `status_id`, `condition_id`, `users_email`) VALUES
	(1, 100000, 10, 'Good', 'Apple iPhone 12', '2022-05-30 21:28:48', 800, 1000, 1, 1, 5, 1, 1, 'thinuka1@gmail.com'),
	(2, 50000, 8, 'Good', 'Apple iPhone 7', '2022-05-30 21:29:43', 800, 1000, 1, 5, 3, 1, 1, 'thinuka1@gmail.com'),
	(3, 88000, 5, 'Good', 'Apple iPhone X', '2022-05-30 21:30:57', 800, 1000, 1, 3, 4, 1, 1, 'thinuka1@gmail.com'),
	(5, 95000, 10, 'Good', 'Apple iPhone 11', '2022-05-31 19:59:57', 800, 1000, 1, 2, 1, 1, 1, 'thinuka1@gmail.com'),
	(15, 111, 1, 'dfsrsdfe', 'adadaddsdgs', '2022-06-08 21:52:45', 111, 111, 1, 5, 3, 2, 1, 'thinuka1@gmail.com'),
	(16, 120000, 2, 'good', 'Apple iPhone 7', '2022-06-10 22:28:34', 120, 200, 1, 5, 3, 1, 1, 'thinuka1@gmail.com'),
	(17, 150000, 1, 'Good', 'iPhone 12', '2022-07-14 09:07:32', 800, 1000, 1, 1, 3, 1, 1, 'thinuka1@gmail.com');

-- Dumping structure for table eshop.profile_image
CREATE TABLE IF NOT EXISTS `profile_image` (
  `path` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_users1_idx` (`users_email`),
  CONSTRAINT `fk_profile_image_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.profile_image: ~2 rows (approximately)
REPLACE INTO `profile_image` (`path`, `users_email`) VALUES
	('resources//profile_img//62a787bb19446.png', 'aaaa@gmail.com'),
	('resources//profile_img//629a2edf95f02.svg', 'thinuka1@gmail.com');

-- Dumping structure for table eshop.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.province: ~8 rows (approximately)
REPLACE INTO `province` (`id`, `name`) VALUES
	(1, 'Central'),
	(2, 'Eastern'),
	(3, 'North Central'),
	(4, ' Northern'),
	(5, 'North Western'),
	(6, ' Sabaragamuwa	'),
	(7, ' Southern	'),
	(8, 'Uva'),
	(9, ' Western');

-- Dumping structure for table eshop.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_recent_product` (`product_id`),
  KEY `FK_recent_users` (`users_email`),
  CONSTRAINT `FK_recent_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_recent_users` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.recent: ~4 rows (approximately)
REPLACE INTO `recent` (`id`, `product_id`, `users_email`) VALUES
	(1, 3, 'thinuka1@gmail.com'),
	(2, 2, 'thinuka1@gmail.com'),
	(3, 1, 'thinuka1@gmail.com'),
	(4, 5, 'thinuka1@gmail.com'),
	(8, 16, 'thinuka1@gmail.com');

-- Dumping structure for table eshop.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.status: ~2 rows (approximately)
REPLACE INTO `status` (`id`, `name`) VALUES
	(1, 'Active'),
	(2, 'Deactive');

-- Dumping structure for table eshop.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` varchar(45) DEFAULT NULL,
  `verfication_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_users_gender_idx` (`gender_id`),
  CONSTRAINT `fk_users_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.users: ~0 rows (approximately)
REPLACE INTO `users` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verfication_code`, `status`, `gender_id`) VALUES
	('AAAA', 'SSSS', 'aaaa@gmail.com', '12345678', '0760584889', '2022-07-01 19:53:14', NULL, 1, 1),
	('Thinuka', 'Ravindith', 'thinuka1@gmail.com', '123456', '0760584888', '2022-05-09 07:11:23', '62ab620befd81', 1, 0);

-- Dumping structure for table eshop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `line_1` text,
  `line_2` text,
  `users_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  `postal_code` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_address_users1_idx` (`users_email`),
  KEY `fk_user_has_address_city1_idx` (`city_id`),
  CONSTRAINT `fk_user_has_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_address_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.user_has_address: ~1 rows (approximately)
REPLACE INTO `user_has_address` (`id`, `line_1`, `line_2`, `users_email`, `city_id`, `postal_code`) VALUES
	(1, '   94', 'Kesbewa', 'thinuka1@gmail.com', 1, 10300);

-- Dumping structure for table eshop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `users_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_watchlist_product` (`product_id`),
  KEY `FK_watchlist_users` (`users_email`),
  CONSTRAINT `FK_watchlist_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_watchlist_users` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.watchlist: ~5 rows (approximately)
REPLACE INTO `watchlist` (`id`, `product_id`, `users_email`) VALUES
	(19, 15, 'thinuka1@gmail.com'),
	(20, 5, 'thinuka1@gmail.com'),
	(22, 3, 'thinuka1@gmail.com'),
	(23, 2, 'thinuka1@gmail.com'),
	(24, 16, 'thinuka1@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
