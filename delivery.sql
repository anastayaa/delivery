-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2020 at 12:52 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

DROP TABLE IF EXISTS `commands`;
CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id`, `date`, `status`, `customer_id`) VALUES
(137, '2020-03-31 02:49:54', 'En cours', 19),
(138, '2020-03-31 02:50:45', 'En cours', 19);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `phone`, `email`, `street`, `city`) VALUES
(19, 'TAYAA', 'Anas', '0673163363', 'anas.tayaagi@gmail.com', '15, rue 19', 'Rabat');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(250) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `designation`, `type`) VALUES
(11, 'SOUPE DE POTIRON', 'E'),
(12, 'SOUPE DE LEGUMES', 'E'),
(13, 'LENTILLES À LA MAROCAINE', 'E'),
(14, 'HARICOTS BLANCS', 'E'),
(15, 'GRATIN AUX LEGUMES', 'E'),
(16, 'TORTILLA DE POMMES DE TERRES', 'E'),
(17, 'SOUPE AUX POIREAUX', 'E'),
(18, 'SOUPE VITAMINEE', 'E'),
(19, 'CAROTTE FACON MAROCAINE', 'E'),
(20, 'RATATOUILLE FACON MAROCAINE', 'E'),
(21, 'TAGINE DE VIANDE, AUX PETITS POIS ET CAROTTE', 'P'),
(22, 'TAGINE DE POULET AU CITRON, POMMES DE TERRE ET OLIVES', 'P'),
(23, 'HACHIS PARMENTIER', 'P'),
(24, 'FRICASSE DE POULET AU RIZ PILAF', 'P'),
(25, 'LASAGNES A LA BOLOGNAISE', 'P'),
(26, 'PÂTES AUX POULET ET SAUCE CHAMPIGNONS', 'P'),
(27, 'EMINCE DE POULET AU RISOTTO', 'P'),
(28, 'TAGINE DE VIANDE AUX PRUNEAUX', 'P'),
(29, 'TAGINE DE POULET AUX PETITS POIS ET POMMES DE TERRE', 'P'),
(30, 'BOULETTES DE VIANDE HACHEE A LA SAUCE TOMATE', 'P'),
(31, 'PAIN & VIENNOISERIE', 'PV');

-- --------------------------------------------------------

--
-- Table structure for table `products_commands`
--

DROP TABLE IF EXISTS `products_commands`;
CREATE TABLE IF NOT EXISTS `products_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `command_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `command_id` (`command_id`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_commands`
--

INSERT INTO `products_commands` (`id`, `product_id`, `command_id`, `quantity`) VALUES
(273, 11, 137, 9),
(274, 12, 137, 1),
(275, 15, 137, 1),
(276, 20, 137, 1),
(277, 18, 137, 1),
(278, 25, 137, 1),
(279, 21, 137, 26),
(280, 27, 137, 2),
(281, 29, 137, 1),
(282, 11, 138, 5),
(283, 12, 138, 1),
(284, 17, 138, 1),
(285, 15, 138, 1),
(286, 14, 138, 1),
(287, 21, 138, 13),
(288, 22, 138, 1),
(289, 23, 138, 1),
(290, 24, 138, 1),
(291, 27, 138, 2),
(292, 31, 138, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `commands_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_commands`
--
ALTER TABLE `products_commands`
  ADD CONSTRAINT `products_commands_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_commands_ibfk_2` FOREIGN KEY (`command_id`) REFERENCES `commands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
