-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 04:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `food_veno`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `addressId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `addressType` enum('Home','Other') NOT NULL,
  `address` varchar(64) NOT NULL,
  `landmark` varchar(64) NOT NULL,
  `pinCode` int(8) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `entryDate` datetime NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cartId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `itemId` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `entryDate` datetime NOT NULL,
  `cartFlag` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cartId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `userId`, `itemId`, `quantity`, `amount`, `entryDate`, `cartFlag`) VALUES
(2, 1, 3, 1, 150, '2020-06-23 04:13:14', 1),
(1, 1, 1, 2, 200, '2020-06-23 06:18:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `description`, `image`, `entryDate`) VALUES
(1, 'Lunch', 'Lunch Category', 'images/bigImages/burger.png', '2020-06-10 04:12:15'),
(2, 'rolls and Sandwiches', 'roles and Sandwiches', 'images/bigImages/roles_and_sandwiches.png', '2020-06-10 04:12:15'),
(3, 'North Indian Specials', 'roles and sandwiches', 'images/bigImages/north_indian.png', '2020-06-10 04:12:15'),
(4, 'Beverages', 'Beverages', 'images/bigImages/beverages.png', '2020-06-10 04:12:15'),
(5, 'South Indian', 'South Indian', 'images/bigImages/south_indian.png', '2020-06-10 04:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `itemId` bigint(20) NOT NULL,
  `entryDate` datetime NOT NULL,
  `favouriteFlag` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `userId`, `itemId`, `entryDate`, `favouriteFlag`) VALUES
(1, 1, 1, '2020-08-12 22:08:54', 1),
(2, 1, 3, '2020-08-12 22:08:58', 1),
(4, 1, 4, '2020-08-22 14:43:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemId` bigint(20) NOT NULL AUTO_INCREMENT,
  `shopId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `name` varchar(32) NOT NULL,
  `itemType` enum('Veg','Non Veg') NOT NULL DEFAULT 'Veg',
  `description` varchar(256) DEFAULT NULL,
  `categoryId` bigint(20) NOT NULL,
  `subCategoryId` bigint(20) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `availabilityStatus` int(11) NOT NULL COMMENT '1 for available 0 for not available',
  `price` double NOT NULL,
  `offerPrice` double NOT NULL,
  `recommendedItemFlag` int(11) NOT NULL,
  `popularItemFlag` int(11) NOT NULL,
  `bestItemFlag` int(11) NOT NULL DEFAULT '0',
  `bestItemImage` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `shopId`, `userId`, `name`, `itemType`, `description`, `categoryId`, `subCategoryId`, `image`, `availabilityStatus`, `price`, `offerPrice`, `recommendedItemFlag`, `popularItemFlag`, `bestItemFlag`, `bestItemImage`, `entryDate`) VALUES
(1, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(2, 1, 1, 'Meals', 'Veg', 'Good Meal', 1, NULL, 'images/items/grilled.jpg', 1, 70, 65, 0, 1, 0, 'images/bestfood/image2.jpeg', '2020-06-10 02:09:12'),
(3, 1, 2, 'Biriyani', 'Non Veg', 'Good Food', 3, NULL, 'images/items/images22.jpg', 1, 350, 120, 1, 0, 1, 'images/bestfood/image3.jpeg', '2020-06-10 03:07:07'),
(4, 4, 2, 'Biriyani', 'Non Veg', 'Good Food', 4, NULL, 'images/items/images4.jpg', 1, 450, 120, 1, 0, 1, 'images/bestfood/image4.jpeg', '2020-06-10 03:07:07'),
(5, 5, 2, 'Biriyani', 'Non Veg', 'Good Food', 5, NULL, 'images/items/images5.jpg', 1, 550, 120, 1, 0, 1, 'images/bestfood/image5.jpeg', '2020-06-10 03:07:07'),
(6, 6, 3, 'Meals', 'Veg', 'Good Meal', 6, NULL, 'images/items/images6.jpg', 1, 70, 65, 0, 1, 1, 'images/bestfood/image6.jpeg', '2020-06-10 02:09:12'),
(7, 2, 4, 'Biriyani', 'Veg', 'Good Food', 1, NULL, 'images/items/images1.jpg', 1, 150, 120, 1, 0, 1, 'images/bestfood/image7.jpeg', '2020-06-10 03:07:07'),
(8, 2, 5, 'Biriyani', 'Veg', 'Good Food', 2, NULL, 'images/items/images2.jpg', 1, 250, 120, 1, 0, 1, 'images/bestfood/image8.jpeg', '2020-06-10 03:07:07'),
(9, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(10, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(11, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(12, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(13, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(14, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(15, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(16, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(17, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(18, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(19, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(20, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(21, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07'),
(22, 1, 1, 'Biriyani', 'Non Veg', 'Good Food', 1, NULL, 'images/items/biriyani.jpg', 1, 150, 120, 1, 1, 1, 'images/bestfood/image1.jpeg', '2020-06-10 03:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderId` bigint(20) NOT NULL,
  `itemId` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `itemId`, `quantity`, `amount`) VALUES
(1, 1, 1, 2, 200),
(2, 1, 3, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE IF NOT EXISTS `order_summary` (
  `orderId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `shopId` bigint(20) NOT NULL,
  `totalAmount` double NOT NULL DEFAULT '0',
  `paymentAmount` double NOT NULL DEFAULT '0',
  `discountAmount` double NOT NULL DEFAULT '0',
  `orderStatus` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `paymentMode` varchar(16) DEFAULT NULL,
  `paymentStatus` enum('pending','processing','paid') NOT NULL DEFAULT 'pending',
  `deliveryTime` varchar(8) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`orderId`, `userId`, `shopId`, `totalAmount`, `paymentAmount`, `discountAmount`, `orderStatus`, `paymentMode`, `paymentStatus`, `deliveryTime`, `entryDate`) VALUES
(1, 1, 0, 100, 0, 0, 'pending', NULL, 'pending', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `shopId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `restaurantType` int(11) NOT NULL COMMENT '0 for veg and 1 for non veg',
  `minimumOrder` double NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `pinCode` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `entry_date` datetime NOT NULL,
  `deliveryTime` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`shopId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopId`, `userId`, `name`, `restaurantType`, `minimumOrder`, `address`, `pinCode`, `latitude`, `longitude`, `image`, `entry_date`, `deliveryTime`) VALUES
(1, 1, 'ABC Restaurant', 1, 100, 'Address', 670645, 10.9999999, 75.89797777, NULL, '2020-06-10 03:12:13', NULL),
(2, 3, 'Shop2', 1, 100, 'Address2', 670645, 10.9999999, 75.89797777, NULL, '2020-06-10 03:12:13', NULL),
(3, 2, 'Shop1', 1, 100, 'Address1', 670645, 10.9999999, 75.89797777, NULL, '2020-06-10 03:12:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `latitude`, `longitude`) VALUES
(1, 11.8014, 76.0044),
(2, 11.7014, 76.1044),
(3, 11.8467, 76.0631),
(4, 11.8232, 76.0232);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `userId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `emailId` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `pinCode` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `rewardPoint` double NOT NULL,
  `minimumOrder` double NOT NULL,
  `entryDate` datetime NOT NULL,
  `activeRestaurantId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userId`, `name`, `emailId`, `mobile`, `password`, `address`, `pinCode`, `latitude`, `longitude`, `rewardPoint`, `minimumOrder`, `entryDate`, `activeRestaurantId`) VALUES
(1, 'hari', 'Prasad', '9526304496', '123456', 'Address', 670645, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-10 19:04:07', 1),
(2, 'Ajith', 'ajith@gmail.com', '7736151724', '123456', '', 0, 0, 0, 0, 0, '2020-06-25 21:59:19', 1),
(3, 'HaiNew', 'abcdefg@gmail.com', '8943421724', '123456', 'ADDRESSS1', 678954, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-23 17:37:06', 1),
(4, 'HaiNew', 'abcdef@gmail.com', '9526304496', '123', 'ADDRESSS1', 678954, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-23 17:12:05', NULL),
(13, 'harimvh', 'appu@gmail.com', '9526304496', '123456', '', 0, 0, 0, 0, 0, '2020-08-19 18:21:58', NULL),
(14, 'harimvh1', 'appu@gmail.com1', '9526304423', '123456', '', 0, 0, 0, 0, 0, '2020-08-19 18:22:42', NULL),
(15, 'harimvh1', 'appu@gmail.com12', '9526304423', '123456', '', 0, 0, 0, 0, 0, '2020-08-19 18:28:49', 1),
(16, 'harimvh1', 'appu@gmail.com13', '9526304423', '123456', '', 0, 0, 0, 0, 0, '2020-08-19 18:29:19', 1),
(17, 'harimvh1', 'appu@gmail.com14', '9526304423', '123456', '', 0, 0, 0, 0, 0, '2020-08-19 18:30:22', 1),
(18, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:29:28', 1),
(19, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:30:13', 1),
(20, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:30:57', 1),
(21, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:31:17', 1),
(22, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:31:35', 1),
(23, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:31:41', 1),
(24, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 14:32:20', 1),
(25, 'prasad', 'aaa@gmail.com', '2345678909', '123456', '', 0, 0, 0, 0, 0, '2020-08-22 14:34:48', 1),
(26, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 17:08:00', 1),
(27, '', '', '9526304496', '123', '', 0, 0, 0, 0, 0, '2020-08-22 17:08:34', 1),
(28, '', '', '9526304496', '123', '', 0, 0, 0, 0, 0, '2020-08-22 17:08:53', 1),
(29, '', '', '', '', '', 0, 0, 0, 0, 0, '2020-08-22 17:23:03', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
