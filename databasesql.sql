-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2021 at 01:52 AM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anomozco_decend`
--

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_coupons`
--

DROP TABLE IF EXISTS `glassBuy_coupons`;
CREATE TABLE `glassBuy_coupons` (
  `id` varchar(200) NOT NULL,
  `coupon` varchar(256) DEFAULT NULL,
  `discount` varchar(256) DEFAULT NULL,
  `timeAdded` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT 'active',
  `timesUsed` varchar(256) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_glasses`
--

DROP TABLE IF EXISTS `glassBuy_glasses`;
CREATE TABLE `glassBuy_glasses` (
  `glass_id` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `colour` varchar(191) NOT NULL,
  `shape` varchar(191) NOT NULL,
  `material` varchar(191) NOT NULL,
  `brand` varchar(191) NOT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `available_sizes` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `manufacturer` varchar(256) DEFAULT '',
  `originalCode` varchar(256) DEFAULT '',
  `model` varchar(256) DEFAULT '',
  `ifAddOnRev` varchar(256) DEFAULT '',
  `colorCode` varchar(256) DEFAULT '',
  `eyeA` varchar(256) DEFAULT '',
  `temple` varchar(256) DEFAULT '',
  `upc` varchar(256) DEFAULT '',
  `sku` varchar(256) DEFAULT '',
  `retailPrice` varchar(256) DEFAULT '',
  `stock` varchar(256) DEFAULT '',
  `color1` varchar(256) DEFAULT '',
  `color2` varchar(256) DEFAULT '',
  `width` varchar(256) DEFAULT '',
  `ed` varchar(256) DEFAULT '',
  `rim` varchar(256) DEFAULT '',
  `feature` varchar(256) DEFAULT '',
  `nosePad` varchar(256) DEFAULT '',
  `minimumPosPd` varchar(256) DEFAULT '',
  `lensType` varchar(256) DEFAULT '',
  `productCategory` varchar(256) DEFAULT '',
  `pdStart` varchar(256) DEFAULT '',
  `pdEnd` varchar(256) DEFAULT '',
  `relatedTo` varchar(256) DEFAULT '',
  `clicks` varchar(256) DEFAULT '0',
  `ribboon_color` varchar(256) DEFAULT '',
  `ribboon_text` varchar(256) DEFAULT '',
  `minimum_pos_pd` varchar(256) DEFAULT '',
  `minimum_neg_pd` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_glass_picture`
--

DROP TABLE IF EXISTS `glassBuy_glass_picture`;
CREATE TABLE `glassBuy_glass_picture` (
  `glass_picture_id` varchar(191) NOT NULL,
  `glass_id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_glass_reviews`
--

DROP TABLE IF EXISTS `glassBuy_glass_reviews`;
CREATE TABLE `glassBuy_glass_reviews` (
  `id` varchar(200) NOT NULL,
  `userId` varchar(256) DEFAULT NULL,
  `rating` varchar(256) DEFAULT NULL,
  `review` varchar(256) DEFAULT NULL,
  `timeAdded` varchar(256) DEFAULT NULL,
  `glassId` varchar(256) DEFAULT '',
  `profile_pic` varchar(256) DEFAULT '',
  `likes` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_glass_reviews_likes`
--

DROP TABLE IF EXISTS `glassBuy_glass_reviews_likes`;
CREATE TABLE `glassBuy_glass_reviews_likes` (
  `id` varchar(200) NOT NULL,
  `commentId` varchar(256) DEFAULT NULL,
  `userId` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_globals`
--

DROP TABLE IF EXISTS `glassBuy_globals`;
CREATE TABLE `glassBuy_globals` (
  `id` varchar(200) NOT NULL,
  `title` longtext NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_order`
--

DROP TABLE IF EXISTS `glassBuy_order`;
CREATE TABLE `glassBuy_order` (
  `id` int(9) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `product_id` varchar(150) NOT NULL,
  `status` varchar(256) DEFAULT '',
  `isPaid` varchar(256) DEFAULT '',
  `total` varchar(256) DEFAULT '',
  `vision` varchar(256) DEFAULT '',
  `lensType` varchar(256) DEFAULT '',
  `order_comments` longtext DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_order_accessories`
--

DROP TABLE IF EXISTS `glassBuy_order_accessories`;
CREATE TABLE `glassBuy_order_accessories` (
  `id` varchar(200) NOT NULL,
  `accessoryId` varchar(256) DEFAULT NULL,
  `orderId` varchar(256) DEFAULT NULL,
  `sessionId` varchar(256) DEFAULT '',
  `quantity` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_order_details`
--

DROP TABLE IF EXISTS `glassBuy_order_details`;
CREATE TABLE `glassBuy_order_details` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `shipping_country` varchar(200) NOT NULL,
  `create_password` text NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `vision` varchar(256) DEFAULT '',
  `lensType` varchar(256) DEFAULT '',
  `total` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_prescription`
--

DROP TABLE IF EXISTS `glassBuy_prescription`;
CREATE TABLE `glassBuy_prescription` (
  `id` int(9) NOT NULL,
  `product_id` varchar(150) NOT NULL,
  `order_id` int(9) NOT NULL,
  `r_sph` varchar(50) NOT NULL,
  `r_cyl` varchar(50) NOT NULL,
  `r_axis` varchar(50) NOT NULL,
  `r_add` varchar(50) NOT NULL,
  `l_sph` varchar(50) NOT NULL,
  `l_cyl` varchar(50) NOT NULL,
  `l_axis` varchar(50) NOT NULL,
  `l_add` varchar(50) NOT NULL,
  `lens_type` varchar(200) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `pd` varchar(100) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `prescription` varchar(300) NOT NULL,
  `file_name` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `userId` varchar(256) DEFAULT '',
  `timeAdded` varchar(256) DEFAULT '',
  `pdimage` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `glassBuy_users`
--

DROP TABLE IF EXISTS `glassBuy_users`;
CREATE TABLE `glassBuy_users` (
  `id` varchar(200) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `timeAdded` varchar(256) NOT NULL,
  `changePasswordToken` varchar(256) DEFAULT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'user',
  `name` varchar(256) DEFAULT '',
  `usernumber` varchar(256) DEFAULT '',
  `about` longtext DEFAULT '',
  `image` varchar(256) DEFAULT '',
  `cart` longtext DEFAULT '',
  `passwordResetId` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `glassBuy_coupons`
--
ALTER TABLE `glassBuy_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_glasses`
--
ALTER TABLE `glassBuy_glasses`
  ADD PRIMARY KEY (`glass_id`);

--
-- Indexes for table `glassBuy_glass_picture`
--
ALTER TABLE `glassBuy_glass_picture`
  ADD PRIMARY KEY (`glass_picture_id`);

--
-- Indexes for table `glassBuy_glass_reviews`
--
ALTER TABLE `glassBuy_glass_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_glass_reviews_likes`
--
ALTER TABLE `glassBuy_glass_reviews_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_globals`
--
ALTER TABLE `glassBuy_globals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_order`
--
ALTER TABLE `glassBuy_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_order_accessories`
--
ALTER TABLE `glassBuy_order_accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_order_details`
--
ALTER TABLE `glassBuy_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_prescription`
--
ALTER TABLE `glassBuy_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glassBuy_users`
--
ALTER TABLE `glassBuy_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `glassBuy_order`
--
ALTER TABLE `glassBuy_order`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `glassBuy_order_details`
--
ALTER TABLE `glassBuy_order_details`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `glassBuy_prescription`
--
ALTER TABLE `glassBuy_prescription`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
