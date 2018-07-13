-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2018 at 10:42 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(10) NOT NULL,
  `id_user` int(5) DEFAULT NULL,
  `total_price` float NOT NULL,
  `datetime` datetime NOT NULL,
  `status` enum('pending','sent','cancelled','delivered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id_order_details` int(20) NOT NULL,
  `id_order` int(10) DEFAULT NULL,
  `id_product` int(5) DEFAULT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(5) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `color` enum('black','white','red','blue','orange','yellow','green','brown','pink','purple','indigo') NOT NULL,
  `size` enum('xs','s','m','l','xl','xxl') NOT NULL,
  `gender` enum('m','f','u') NOT NULL,
  `picture` varchar(120) NOT NULL,
  `picture2` varchar(120) DEFAULT NULL,
  `price` float NOT NULL,
  `stock` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `reference`, `category`, `title`, `description`, `color`, `size`, `gender`, `picture`, `picture2`, `price`, `stock`) VALUES
(5, '154-EFR', 'tshirt', 'White tshirt', 'fcsdfsd fsd sdf sdf sdf sdf sdf sdf.', 'white', 'm', 'u', 'White-tshirt_154-EFR_1531383668-142_front_large_extended.jpg', NULL, 30, 50),
(6, '749-HJU', 'shoes', 'Nice sandalette', 'dfzerfn zekfn zenf zen nzejfnez.', 'red', 'xxl', 'm', 'Nice-sandalette_749-HJU_1531383707-884_Sandals_Worn_wth_White_Ankle_Socks.jpg', NULL, 50.5, 50),
(7, '899-UTR', 'tshirt', 'Chinese Man tshirt', 'fdqsfezf ze zef zef ezf ez.', 'black', 'm', 'u', 'Chinese-Man-tshirt_899-UTR_1531383758-7_CM_BLUE.png', NULL, 25.8, 60),
(9, 'GNAGNAGNA', 'poster', 'gfdg', 'gdf', 'purple', 'xs', 'm', 'gfdg_ALOHA_1531392772-293_joker.png', NULL, 40, 40),
(10, '154-EFR', 'coat', 'Brown coat', 'fcsdfsd fsd sdf sdf sdf sdf sdf sdf.', 'white', 'm', 'u', 'default.jpg', NULL, 30, 50),
(11, '154-EFR', 'tshirt', 'Red tshirt', 'fcsdfsd fsd sdf sdf sdf sdf sdf sdf.', 'white', 'm', 'u', 'Red-tshirt_154-EFR_1531402126-956_plain-t-shirt-red-1-800x800.jpg', NULL, 30, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `gender` enum('m','f','o') NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `privilege` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `pwd`, `firstname`, `lastname`, `email`, `gender`, `city`, `zip_code`, `address`, `privilege`) VALUES
(1, 'Batman', '$2y$10$Lb1H.9364cLuwekBKxxatuGiCwOyTYFLf2wxP5TX95DtjL7U/qPkm', 'Bruce', 'Wayne', 'bruce@wayne.com', 'm', 'Gotham City', '5500', '2 Palace Wayne', 1),
(2, 'Joker', '$2y$10$D.Z/phsA0f2SgUKjFMIOVukq0U4A5VdGtxdqid70TyDrNGd9pCl9K', 'Bruce', 'Joker', 'bruce@joker.com', 'o', 'Gotham City', '4747', 'Palace Wayne', 0),
(3, 'Harley', '$2y$10$dpMBIYUss.os/CFh1wanCO.ycx4GEOtgFlMJzkzSHiVwrR5FQFP9i', 'Harley', 'Quinn', 'harley@quinn.com', 'f', 'Gotham City', '5500', 'Allay', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order_details`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id_order_details` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
