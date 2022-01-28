-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2020 at 04:41 AM
-- Server version: 8.0.20
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_veno`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` varchar(16) NOT NULL,
  `userId` varchar(16) NOT NULL,
  `itemId` varchar(16) NOT NULL,
  `quantity` int NOT NULL,
  `amount` double NOT NULL,
  `entryDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `userId`, `itemId`, `quantity`, `amount`, `entryDate`) VALUES
('Cart1', 'HEcv865412', 'Item1', 2, 200, '2020-06-23 06:18:20'),
('Cart2', 'HEcv865412', 'Item2', 1, 150, '2020-06-23 04:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `description`, `image`, `entryDate`) VALUES
('Cat1', 'Lunch', 'Lunch Category', '', '2020-06-10 04:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `userId` varchar(16) NOT NULL,
  `itemId` varchar(16) NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `userId`, `itemId`, `entry_date`) VALUES
(1, 'HEcv865412', 'Item1', '0000-00-00 00:00:00'),
(2, 'HEcv865412', 'Item2', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` bigint NOT NULL,
  `restaurantId` varchar(16) NOT NULL,
  `userId` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `itemType` enum('Veg','Non Veg') NOT NULL DEFAULT 'Veg',
  `description` varchar(256) DEFAULT NULL,
  `categoryId` varchar(16) NOT NULL,
  `subCategoryId` varchar(16) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `availabilityStatus` int NOT NULL COMMENT '1 for available 0 for not available',
  `price` double NOT NULL,
  `offerPrice` double NOT NULL,
  `recommendedItemFlag` int NOT NULL,
  `popularItemFlag` int NOT NULL,
  `bestItemFlag` int NOT NULL DEFAULT '0',
  `bestItemImage` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `restaurantId`, `userId`, `name`, `itemType`, `description`, `categoryId`, `subCategoryId`, `image`, `availabilityStatus`, `price`, `offerPrice`, `recommendedItemFlag`, `popularItemFlag`, `bestItemFlag`, `bestItemImage`, `entryDate`) VALUES
(1, 'Rest1', 'eRwm980598', 'Biriyani', 'Non Veg', 'Good Food', 'Cat1', NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(2, 'Rest1', 'eRwm980598', 'Meals', 'Veg', 'Good Meal', 'Cat1', NULL, 'images/items/meals.jpg', 1, 70, 65, 0, 1, 0, 'images/bestfood/image2.jpeg', '2020-06-10 02:09:12'),
(3, 'Rest1', 'HEcv8654123', 'Biriyani', 'Non Veg', 'Good Food', 'Cat3', NULL, 'images/items/images22.jpg', 1, 350, 120, 1, 0, 1, 'images/bestfood/image3.jpeg', '2020-06-10 03:07:07'),
(4, 'Rest4', 'HEcv8654124', 'Biriyani', 'Non Veg', 'Good Food', 'Cat4', NULL, 'images/items/images4.jpg', 1, 450, 120, 1, 0, 1, 'images/bestfood/image4.jpeg', '2020-06-10 03:07:07'),
(5, 'Rest5', 'HEcv8654125', 'Biriyani', 'Non Veg', 'Good Food', 'Cat5', NULL, 'images/items/images5.jpg', 1, 550, 120, 1, 0, 1, 'images/bestfood/image5.jpeg', '2020-06-10 03:07:07'),
(6, 'Rest6', 'HEcv8654126', 'Meals', 'Veg', 'Good Meal', 'Cat6', NULL, 'images/items/images6.jpg', 1, 70, 65, 0, 1, 1, 'images/bestfood/image6.jpeg', '2020-06-10 02:09:12'),
(7, 'Rest2', 'HEcv8654121', 'Biriyani', 'Veg', 'Good Food', 'Cat1', NULL, 'images/items/images1.jpg', 1, 150, 120, 1, 0, 1, 'images/bestfood/image7.jpeg', '2020-06-10 03:07:07'),
(8, 'Rest2', 'HEcv8654122', 'Biriyani', 'Veg', 'Good Food', 'Cat2', NULL, 'images/items/images2.jpg', 1, 250, 120, 1, 0, 1, 'images/bestfood/image8.jpeg', '2020-06-10 03:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurantId` varchar(16) NOT NULL,
  `userId` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `restaurantType` int NOT NULL COMMENT '0 for veg and 1 for non veg',
  `minimumOrder` double NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `pinCode` int NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurantId`, `userId`, `name`, `restaurantType`, `minimumOrder`, `address`, `pinCode`, `latitude`, `longitude`, `entry_date`) VALUES
('Rest1', 'HEcv865412', 'ABC Restaurant', 1, 100, 'Address', 670645, 10.9999999, 75.89797777, '2020-06-10 03:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `userId` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `emailId` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `pinCode` int NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `rewardPoint` double NOT NULL,
  `minimumOrder` double NOT NULL,
  `entryDate` datetime NOT NULL,
  `activeRestaurantId` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userId`, `name`, `emailId`, `mobile`, `password`, `address`, `pinCode`, `latitude`, `longitude`, `rewardPoint`, `minimumOrder`, `entryDate`, `activeRestaurantId`) VALUES
('eRwm980598', 'Ajith', 'ajith@gmail.com', '7736151724', '123456', '', 0, 0, 0, 0, 0, '2020-06-25 21:59:19', 'Rest2'),
('HEcv865412', 'hari', 'Prasad', '9526304496', '123456', 'Address', 670645, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-10 19:04:07', 'Rest1'),
('moNI713485', 'HaiNew', 'abcdefg@gmail.com', '8943421724', '123456', 'ADDRESSS1', 678954, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-23 17:37:06', 'Rest1'),
('zkaG912087', 'HaiNew', 'abcdef@gmail.com', '9526304496', '123', 'ADDRESSS1', 678954, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-23 17:12:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurantId`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
