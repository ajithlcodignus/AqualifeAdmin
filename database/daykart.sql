-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2022 at 04:53 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daykart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `addressType` enum('Home','Other') NOT NULL,
  `houseName` varchar(64) DEFAULT NULL,
  `fullAddress` varchar(128) DEFAULT NULL,
  `landmark` varchar(64) DEFAULT NULL,
  `pinCode` varchar(8) NOT NULL,
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0',
  `entryDate` datetime NOT NULL,
  `addressStatus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `userId`, `addressType`, `houseName`, `fullAddress`, `landmark`, `pinCode`, `latitude`, `longitude`, `entryDate`, `addressStatus`) VALUES
(1, 2, 'Home', 'C sai enclave', 'bangalore', 'school', '673571', 11.3222343, 75.8830635, '2021-07-22 03:23:25', 1),
(2, 3, 'Home', 'Fathima apparatment nut street vadakara', 'nut street vadakara', 'thattachri tremble', '673104', 11.6046064, 75.5967722, '2021-07-28 23:06:38', 1),
(3, 9, 'Home', 'house', 'full', 'land', '673571', 11.3222962, 75.8842384, '2021-07-30 12:10:04', 1),
(4, 16, 'Home', 'hh', 'hh', 'hh', '///', 10.9767564, 76.1991994, '2021-10-22 13:55:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_language`
--

CREATE TABLE `admin_language` (
  `english` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hindi` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `malayalam` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tamil` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `bengli` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_version`
--

CREATE TABLE `app_version` (
  `id` int NOT NULL,
  `appVersionCode` varchar(256) NOT NULL,
  `androidAppVersionCode` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_version`
--

INSERT INTO `app_version` (`id`, `appVersionCode`, `androidAppVersionCode`) VALUES
(1, '1.1.5', '1.0.3');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1-for Active 0-for InActive',
  `bannerPriority` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `description`, `banner`, `status`, `bannerPriority`) VALUES
(1, 'banner1', 'images/banner/InShot_20220113_164942757.jpg', 0, 0),
(2, 'banner2', 'images/banner/InShot_20220113_171434915.jpg', 0, 0),
(3, 'banner3', 'images/banner/InShot_20220113_165759130.jpg', 0, 0),
(4, 'banner4', 'images/banner/InShot_20220113_172101629.jpg', 0, 0),
(5, 'GROCERY BANNER', 'images/banner/banner_hotel_king2.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `shopId` bigint NOT NULL,
  `itemId` bigint NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `entryDate` datetime NOT NULL,
  `cartFlag` int NOT NULL DEFAULT '1',
  `cartGst` double NOT NULL DEFAULT '0',
  `cartActiveItem` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `userId`, `shopId`, `itemId`, `quantity`, `amount`, `entryDate`, `cartFlag`, `cartGst`, `cartActiveItem`) VALUES
(22, 9, 7, 24, 1, 0, '2021-08-29 16:51:43', 1, 0, 1),
(30, 12, 3, 7, 1, 0, '2022-01-13 17:45:40', 1, 0, 0),
(35, 2, 11, 29, 1, 0, '2022-09-18 08:04:35', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` bigint NOT NULL,
  `name` varchar(32) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `categoryIcon` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `shopId` bigint NOT NULL DEFAULT '0',
  `activeFlag` int NOT NULL COMMENT '1-for Active 0-for InActive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `image`, `categoryIcon`, `description`, `entryDate`, `shopId`, `activeFlag`) VALUES
(1, 'OTHERS', 'images/items/grocery/category/honey.jpeg', '', 'OTHERS', '2021-07-21 22:41:08', 1, 0),
(2, 'KUZHIMANDHI', 'images/items/grocery/category/biriyani.png', '', '', '2021-07-22 21:02:56', 2, 0),
(3, 'BIRIYANI', 'images/items/grocery/category/BIRI.jpeg', '', '', '2021-07-22 21:03:27', 2, 0),
(4, 'SCOOTERS', 'images/items/grocery/category/BravoColours.jpg', '', 'SCOOTERS', '2021-07-23 12:53:17', 3, 0),
(5, 'EV CHARGER', 'images/items/grocery/category/download.jfif', '', 'ELECTRIC VEHICLE CHARGER', '2021-07-28 22:46:54', 3, 0),
(7, 'Bags', 'images/items/grocery/category/20210701_162848.jpg', '', '', '2021-07-29 20:53:40', 4, 0),
(8, 'ladies bag', 'images/items/grocery/category/IMG-20200911-WA0109.jpg', '', 'leather', '2021-07-30 19:22:59', 4, 0),
(9, 'BIRIYANI', 'images/items/grocery/category/biriyani1.png', '', '', '2021-07-30 23:01:31', 5, 0),
(10, 'Cups', 'images/items/grocery/category/IMG-20210801-WA0397.jpg', '', 'Cupping therapy cups', '2021-08-01 14:35:48', 6, 0),
(11, 'Kids top', 'images/items/grocery/category/16281762980975787671840539244515.jpg', '', '', '2021-08-05 20:41:55', 7, 0),
(12, 'ELECTRICAL', 'images/items/grocery/category/Electrician2.jpeg', '', '', '2021-08-29 17:12:38', 8, 0),
(13, 'PLUMBER', 'images/items/grocery/category/plumber.jpeg', '', '', '2021-08-29 17:18:39', 8, 0),
(14, 'PLUMBER', 'images/items/grocery/category/plumber3.jpeg', '', '', '2021-08-29 17:33:25', 9, 0),
(15, 'BIKE', 'images/items/grocery/category/IMG-20211108-WA0014.jpg', '', 'ELECTRIC BIKE', '2022-01-13 13:05:32', 3, 0),
(16, 'RICE', 'images/items/grocery/category/rice.png', '', '', '2022-04-25 23:02:02', 10, 0),
(17, 'RICE', 'images/items/grocery/category/rice1.png', '', 'RICE', '2022-04-25 23:04:10', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `couponId` int NOT NULL,
  `shopId` int NOT NULL,
  `couponName` varchar(250) NOT NULL,
  `couponNumber` varchar(250) NOT NULL,
  `couponCode` varchar(15) NOT NULL,
  `status` int NOT NULL COMMENT '1=active, 0=inactive',
  `couponType` int NOT NULL,
  `numberOfOrders` int NOT NULL,
  `couponPercentage` double DEFAULT NULL,
  `couponFixedAmount` double DEFAULT NULL,
  `orderCountType` int NOT NULL,
  `minPurchaseAmount` double NOT NULL,
  `maxDiscountAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_version`
--

CREATE TABLE `db_version` (
  `id` bigint NOT NULL,
  `versionCode` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_version`
--

INSERT INTO `db_version` (`id`, `versionCode`) VALUES
(1, 103.4999999999984);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `deliveryBoyId` bigint NOT NULL,
  `deliveryBoyName` varchar(64) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `token` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `firebaseToken` varchar(1024) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `otp` varchar(24) NOT NULL,
  `shopId` bigint DEFAULT NULL,
  `emailId` varchar(64) DEFAULT NULL,
  `available` enum('AVAILABLE','NOTAVAILABLE') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'notAvailable- not free now , available - he is free now',
  `active` int NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `currentOrderId` bigint NOT NULL DEFAULT '0' COMMENT 'Current Active Order Id',
  `address` varchar(64) DEFAULT NULL,
  `place` varchar(64) DEFAULT NULL,
  `pinCode` varchar(16) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `assignFlag` int NOT NULL DEFAULT '0' COMMENT '1- Assigned to any of the shop, 0- not assigned to any shop',
  `commissionAmount` double NOT NULL,
  `commissionType` enum('PERCENTAGE','FIXED') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `availabilityQueue` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo_users`
--

CREATE TABLE `demo_users` (
  `demoId` bigint NOT NULL,
  `userName` varchar(64) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `demoTime` varchar(6) NOT NULL,
  `isActive` enum('Active','Inactive') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo_users`
--

INSERT INTO `demo_users` (`demoId`, `userName`, `mobile`, `demoTime`, `isActive`) VALUES
(1, 'Anju', '9895123021', '', 'Inactive'),
(2, 'Arun', '9896365478', '', 'Active'),
(3, 'New User', '8943421111', '2:15', 'Active'),
(4, 'New User 2', '894342112', '4:00', 'Active'),
(5, 'Theresa', '9744922625', '7:00', 'Active'),
(6, 'tkr', '6238975936', '2:00', 'Active'),
(7, 'ANOOP', '9947898851', '8:00', 'Active'),
(8, 'ajith', '8943421724', '10:00', 'Active'),
(10, 'tester17', '1234123412', '5:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `d_boy_payment`
--

CREATE TABLE `d_boy_payment` (
  `dbPaymentId` bigint NOT NULL,
  `deliveryBoyId` bigint NOT NULL,
  `orderId` bigint NOT NULL,
  `shopId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `paymentAmount` double NOT NULL,
  `paidStatus` enum('PAID','NOT_PAID') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NOT_PAID' COMMENT 'Customer boy paid -1 not paid - 0',
  `customerPaidStatus` enum('CUST_PAID','CUST_NOT_PAID') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'CUST_NOT_PAID',
  `entryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `itemId` bigint NOT NULL,
  `entryDate` datetime NOT NULL,
  `favouriteFlag` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` bigint NOT NULL,
  `shopId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `thermalPrintItems` varchar(32) NOT NULL,
  `itemType` enum('Veg','Non Veg','Egg','Else') NOT NULL DEFAULT 'Veg',
  `description` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `categoryId` bigint NOT NULL COMMENT 'This is for ItemCategory',
  `subCategoryId` bigint DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `availabilityStatus` int NOT NULL COMMENT '1 for available 0 for not available',
  `price` double NOT NULL COMMENT 'MRP Price',
  `offerPrice` double NOT NULL COMMENT 'Selling Price',
  `recommendedItemFlag` int NOT NULL,
  `popularItemFlag` int NOT NULL,
  `bestItemFlag` int NOT NULL DEFAULT '0',
  `bestItemImage` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `itemGst` double NOT NULL DEFAULT '0',
  `itemPriority` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `shopId`, `userId`, `name`, `thermalPrintItems`, `itemType`, `description`, `categoryId`, `subCategoryId`, `image`, `availabilityStatus`, `price`, `offerPrice`, `recommendedItemFlag`, `popularItemFlag`, `bestItemFlag`, `bestItemImage`, `entryDate`, `itemGst`, `itemPriority`) VALUES
(7, 3, 1, 'ELTHOR BRAVO MATTE GREY', '', 'Veg', '72V 1500W HUB MOTOR, DIGITAL DISPLAY, HYDRAULIC DISC BRAKE, WEIGHTCURB 82KG, CHARGING TIME 3-4 HR, MAX.SPEED 70KM/HR, TIRES(F/R)TUBELESS, LOADING CAPACITY 235KG, BATTERY 72V 20AH, 60-65 KM RANGE', 4, NULL, 'images/items/grocery/IMG-20220108-WA0018.jpg', 1, 120096, 120000, 0, 0, 0, NULL, '2021-07-23 13:00:43', 0, 1),
(8, 3, 1, 'ELTHOR BRAVO NAVY BLUE', '', 'Veg', '72V 1500W HUB MOTOR, DIGITAL DISPLAY, HYDRAULIC DISC BRAKE, WEIGHTCURB 82KG, CHARGING TIME 3-4 HR, MAX.SPEED 70KM/HR, TIRES(F/R)TUBELESS, LOADING CAPACITY 235KG, BATTERY 72V 20AH, 60-65 KM RANGE', 4, NULL, 'images/items/grocery/slide41.png', 1, 120096, 120000, 0, 0, 0, NULL, '2021-07-23 13:04:45', 0, 2),
(9, 3, 1, 'NEXEBIZ EV  WALL BOX ', '', 'Veg', 'AC TYPE EV CHARGER, WALL BOX TYPE, ALL e- VEHICLE  SUPPORT', 5, NULL, 'images/items/grocery/IMG-20211213-WA0009.jpg', 1, 18000, 18000, 0, 0, 0, NULL, '2021-07-23 13:08:15', 0, 8),
(14, 3, 8, 'NEXEBIZ EV  WALL BOX ', '', 'Veg', 'AC TYPE EV CHARGER, WALL BOX TYPE, ALL e- VEHICLE  SUPPORT', 5, NULL, 'images/items/grocery/InShot_20220111_183234813.jpg', 1, 18000, 18000, 0, 0, 0, NULL, '2021-07-31 15:58:14', 0, 10),
(15, 3, 8, 'NEXEBIZ EV WALL BOX ', '', 'Veg', 'AC TYPE EV CHARGER, WALL BOX TYPE, ALL e- VEHICLE  SUPPORT\r\n', 5, NULL, 'images/items/grocery/IMG-20211213-WA0011.jpg', 1, 18000, 18000, 0, 0, 0, NULL, '2021-07-31 17:11:36', 0, 9),
(16, 3, 8, 'ELTHOR BRAVO RED', '', 'Veg', '72V 1500W HUB MOTOR, DIGITAL DISPLAY, HYDRAULIC DISC BRAKE, WEIGHTCURB 82KG, CHARGING TIME 3-4 HR, MAX.SPEED 70KM/HR, TIRES(F/R)TUBELESS, LOADING CAPACITY 235KG, BATTERY 72V 20AH, 60-65 KM RANGE', 4, NULL, 'images/items/grocery/slide31.png', 1, 120096, 120000, 0, 0, 0, NULL, '2021-07-31 17:20:34', 0, 2),
(17, 3, 8, 'ELTHOR BRAVO SKY BLUE', '', 'Veg', '72V 1500W HUB MOTOR, DIGITAL DISPLAY, HYDRAULIC DISC BRAKE, WEIGHTCURB 82KG, CHARGING TIME 3-4 HR, MAX.SPEED 70KM/HR, TIRES(F/R)TUBELESS, LOADING CAPACITY 235KG, BATTERY 72V 20AH, 60-65 KM RANGE', 4, NULL, 'images/items/grocery/elthor-scooty3.png', 1, 120096, 120000, 0, 0, 0, NULL, '2021-07-31 17:21:55', 0, 3),
(18, 3, 8, 'ELTHOR BRAVO SILVER', '', 'Veg', '72V 1500W HUB MOTOR, DIGITAL DISPLAY, HYDRAULIC DISC BRAKE, WEIGHTCURB 82KG, CHARGING TIME 3-4 HR, MAX.SPEED 70KM/HR, TIRES(F/R)TUBELESS, LOADING CAPACITY 235KG, BATTERY 72V 20AH, 60-65 KM RANGE', 4, NULL, 'images/items/grocery/slide1.png', 1, 120096, 120000, 0, 0, 0, NULL, '2021-07-31 17:22:54', 0, 4),
(19, 3, 8, 'SVM PRANA BLACK', '', 'Veg', 'BLDC MOTORS, 72V AIR - COOLER LITHIUM-ION CAPACITY 4.32KW, CHARGE TIME 4 HR, TOP SPEED 123KMPH, WEIGHT 165KG, 3 CHANNEL HYDRAULIC BRAKE SYSTEM WITH POWER CUT-OFF, CARRYING CAPACITY 180KG, RANGE 126KM', 15, NULL, 'images/items/grocery/IMG-20211108-WA0011.jpg', 1, 250255, 250255, 0, 0, 0, NULL, '2021-07-31 17:31:06', 0, 5),
(20, 3, 8, 'SVM PRANA WHITE', '', 'Veg', 'BLDC MOTORS, 72V AIR - COOLER LITHIUM-ION CAPACITY 4.32KW, CHARGE TIME 4 HR, TOP SPEED 123KMPH, WEIGHT 165KG, 3 CHANNEL HYDRAULIC BRAKE SYSTEM WITH POWER CUT-OFF, CARRYING CAPACITY 180KG, RANGE 126KM', 15, NULL, 'images/items/grocery/IMG-20211108-WA0014.jpg', 1, 250255, 250255, 0, 0, 0, NULL, '2021-07-31 17:35:53', 0, 6),
(21, 3, 8, 'SVM PRANA RED', '', 'Veg', 'BLDC MOTORS, 72V AIR - COOLER LITHIUM-ION CAPACITY 4.32KW, CHARGE TIME 4 HR, TOP SPEED 123KMPH, WEIGHT 165KG, 3 CHANNEL HYDRAULIC BRAKE SYSTEM WITH POWER CUT-OFF, CARRYING CAPACITY 180KG, RANGE 126KM', 15, NULL, 'images/items/grocery/IMG-20211108-WA0008.jpg', 1, 250255, 250255, 0, 0, 0, NULL, '2021-07-31 17:36:50', 0, 7),
(28, 10, 1, 'Daawat Biryani Basmati Rice  ', '', 'Veg', 'Daawat Biryani Basmati Rice  (1 kg)', 16, NULL, 'images/items/grocery/rice.png', 1, 200, 200, 0, 0, 0, NULL, '2022-04-25 23:03:24', 5, 1),
(29, 11, 1, 'Daawat Biryani Basmati Rice ', '', 'Veg', '', 17, NULL, 'images/items/grocery/rice1.png', 1, 200, 200, 0, 0, 0, NULL, '2022-04-25 23:04:33', 0, 1),
(30, 11, 1, 'Organic &Natural Brown Matta', '', 'Veg', '', 17, NULL, 'images/items/grocery/rice_2.jpg', 1, 390, 390, 0, 0, 0, NULL, '2022-04-25 23:11:40', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `english` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hindi` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `malayalam` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tamil` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `bengali` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`english`, `hindi`, `malayalam`, `tamil`, `bengali`) VALUES
('Popular Shops', 'लोकप्रिय दुकानें', 'ജനപ്രിയ ഷോപ്പുകൾ', 'பிரபலமான கடைகள்', 'জনপ্রিয় দোকান'),
('POPULAR SHOPS', 'पॉपुलर शॉप्स ', 'പോപ്പുലർ ഷോപ്പുകൾ', 'பாப்புலர் ஷொப்ஸ் ', 'জনপ্রিয় দোকান'),
('LOGIN', 'लॉग इन करें', 'ലോഗിൻ', 'உள்நுழைய', 'লগইন'),
('SEARCH FOR SHOPS', 'शॉप्स के लिए खोज', 'ഷോപ്പുകൾക്കായി തിരയുക', 'கடைகளுக்குத் தேடுங்கள்', 'দোকান জন্য অনুসন্ধান করুন'),
('SEARCH FOR ITEMS', 'वस्तुओं के लिए खोज', 'ഇനങ്ങൾക്കായി തിരയുക', 'உருப்படிகளைத் தேடுங்கள்', 'আইটেম অনুসন্ধান করুন'),
('SEARCH', 'खोज', 'തിരയുക', 'தேடல்', 'অনুসন্ধান'),
('CONTACT NUMBER', 'संपर्क संख्या', 'ബന്ധപ്പെടാനുള്ള നമ്പർ', 'தொடர்பு எண்', 'যোগাযোগের নম্বর'),
('PLEASE ENTER OTP', 'कृपया OTP दर्ज करें', 'OTP നൽകുക', 'OTP உள்ளிடவும்', 'ওটিপি প্রবেশ করুন'),
('SUBMIT OTP', 'ओटीपी सबमिट करें', 'OTP സമർപ്പിക്കുക', 'சப்மிட்  OTP ', 'সাবমিট ওটিপি'),
('ORDERS', 'आदेश', 'ഓർഡർ', 'ஆர்டர்கள்', 'অর্ডার'),
('HOME', 'होम ', 'ഹോം', 'ஹோம்', 'হোম'),
('DAILY NEEDS', 'दैनिक आवश्यकताएं', 'പ്രതിദിന ആവശ്യങ്ങൾ', 'தினசரி தேவைகள்', 'দৈনন্দিন চাহিদা'),
('SHOPS ARE CLOSED', 'SHOPS बंद हैं', 'கடைகள் மூடப்பட்டுள்ளன', 'ഷോപ്പുകൾ അടച്ചിരിക്കുന്നു', 'দোকান বন্ধ আছে'),
('PROFILE', 'प्रोफ़ाइल', 'പ്രൊഫൈൽ', 'சுயவிவரம்', 'প্রোফাইলে'),
('HELP CENTER', 'உதவி மையம்', 'സഹായകേന്ദ്രം', 'உதவி மையம்', 'সাহায্য কেন্দ্র'),
('HISTORY', 'हिस्ट्री ', 'ഹിസ്റ്ററി ', 'ஹிச்டோரி ', 'হিস্ট্রি '),
('CART', 'कार्ट', 'കാർട്ട്', 'கார்ட்', 'কার্ট'),
('CART IS EMPTY PLEASE SELECT SOME ITEMS', 'कार्ट खाली है कृपया आइटम चुनें', 'കാർട്ട് ശൂന്യമാണ് ദയവായി ഇനങ്ങൾ തിരഞ്ഞെടുക്കുക', 'கார்ட் காலியாக உள்ளது தயவுசெய்து உருப்படிகளை தேர்ந்தெடுக்கவும்', 'কার্ট খালি থাকলে আইটেম নির্বাচন করুন'),
('ITEM CART', 'आइटम कार्ट ', 'കാർട്ട് ഐറ്റം ', 'கார்ட் உருப்படி', 'কার্ট আইটেম '),
('BILL DETAILS', 'बिल विवरण', 'ബിൽ വിശദാംശങ്ങൾ', 'பில் விவரங்கள்', 'বিল বিবরণ'),
('ITEM TOTAL', 'आइटम टोटल ', 'ഐറ്റം ആകെ', 'உருப்படி மொத்தம்', 'আইটেম মোট'),
('PACKING CHARGE', 'पैकिंग चार्ज', 'പാക്കിംഗ് ചാർജ്', 'பேக்கிங் கட்டணம்', 'প্যাকিং চার্জ'),
('AN ERROR OCCURRED', 'एक त्रुटि पाई गई', 'ഒരു പിശക് സംഭവിച്ചു', 'பிழை ஏற்பட்டது', 'একটি ত্রুটি ঘটেছে'),
('SOMETHING WENT WRONG', 'कुछ गलत हो गया', 'എന്തോ കുഴപ്പം സംഭവിച്ചു', 'ஏதோ தவறு நடந்துவிட்டது', 'কিছু ভুল হয়েছে'),
('OKAY', 'अच्छा जी', 'ശരി', 'சரி', 'আচ্ছা'),
('TOTAL DISCOUNT', 'कुल छूट', 'ആകെ കിഴിവ്', 'மொத்த தள்ளுபடி', 'মোট ছাড়'),
('TO PAY', 'भुगतान कर', 'നല്കുക', 'செலுத்த', 'পে'),
('CURRENT ADDRESS', 'वर्तमान पता', 'നിലവിലെ വിലാസം', 'தற்போதைய முகவரி', 'বর্তমান ঠিকানা'),
('CHANGE ADDRESS', 'पता बदल जाना', 'വിലാസം മാറ്റുക', 'முகவரியை மாற்றுக', 'পরিবর্তন ঠিকানা'),
('PROCEED TO PAY', 'भुगतान करने के लिए आगे बढ़ें', 'പേയ്‌മെന്റിലേക്ക് തുടരുക', 'செலுத்த தொடரவும்', 'পরিশোধ করতে অগ্রসর হও'),
('ADD ADDRESS', 'पता जोड़ें', 'വിലാസം ചേർക്കുക', 'முகவரியைச் சேர்க்கவும்', 'ঠিকানা যোগ করুন'),
('SORRY! MINIMUM CART SHOULD BE 300.0', 'माफ़ करना! न्यूनतम कार्ट300.0 होनी चाहिए', 'ക്ഷമിക്കണം! മിനിമം കാർട്ട് 300.0 ആയിരിക്കണം', 'மன்னிக்கவும்! குறைந்தபட்ச வண்டி 300.0 ஆக இருக்க வேண்டும்', 'মাফ করবেন! সর্বনিম্ন কার্ট 300.0 হওয়া উচিত'),
('ARE YOU SURE YOU WANT TO EXIT?', 'क्या आप निसंदेह बाहर निकलना चाहते हैं?', 'തങ്കള് ഉറപ്പായും പുറത്തു പോവാന് ആഗ്രഹിക്കുന്നോ?', 'நிச்சயமாக நீங்கள் வெளியேற வேண்டுமா?', 'আপনি প্রস্থান করতে চান?'),
('PLEASE ADD A ADDRESS TO PROCEED', 'कृपया आगे बढ़ने के लिए एक पता जोड़ें', 'പ്രോസസ്സ് ചെയ്യുന്നതിന് ദയവായി ഒരു വിലാസം ചേർക്കുക', 'தொடர ஒரு முகவரியைச் சேர்க்கவும்', 'প্রক্রিয়া করার জন্য একটি ঠিকানা যুক্ত করুন দয়া করে'),
('SUBMIT ORDER', 'आदेश प्रस्तुत', 'ഓർഡർ സമർപ്പിക്കുക', 'ஆர்டர் சப்மிட்', 'অর্ডার জমা'),
('YOUR ORDER PLACED SUCCESSFULLY!', 'आपका आदेश सफलतापूर्वक सेट कर दिया गया है!', 'നിങ്ങളുടെ ഓർഡർ വിജയകരമായി സമർപ്പിച്ചു !', 'உங்கள் ஆணை வெற்றிகரமாக அமைக்கப்பட்டுள்ளது!', 'আপনার অর্ডার সফলভাবে সেট করা হয়েছে!'),
('CHECKOUT NOW', 'अब इसे जांचें', 'ഇപ്പോൾ പരിശോധിക്കുക', 'இப்போது சரிபார்க்கவும்', 'এখনই এটা দেখে নাও'),
('ORDER CANCELLED SUCCESSFULLY', 'आदेश सफलतापूर्वक रद्द कर दिया गया', 'ഓർഡർ വിജയകരമായി റദ്ദാക്കി', 'ஆர்டர் வெற்றிகரமாகச் ரத்து செய்யப்பட்டது', 'অর্ডার সফলভাবে বাতিল'),
('USE CURRENT LOCATION', 'वर्तमान स्थान का उपयोग करें', 'നിലവിലെ ലൊക്കേഷൻ ഉപയോഗിക്കുക', 'தற்போதைய இருப்பிடத்தைப் பயன்படுத்தவும்', 'বর্তমান অবস্থান ব্যবহার করুন'),
('BACK TO CART', 'कार्ट में वापस जाएँ', 'കാർട്ടിലേക്ക് മടങ്ങുക', 'கார்ட் திரும்பு', 'কার্ট ফিরুন'),
('DELIVER TO OTHER LOCATION', 'किसी अन्य स्थान पर वितरित करें', 'മറ്റൊരു ലൊക്കേഷനിലേയ്ക്  ഡെലിവർ ചെയ്യുക', 'பிற இருப்பிடத்தை வழங்கவும்', 'অন্য কোথাও সরবরাহ করুন'),
('LANGUAGE', 'भाषा', 'ഭാഷ', 'மொழிகள்', 'ভাষা'),
('PRIVACY POLICY ', 'गोपनीयता नीति', 'സ്വകാര്യതാനയം', 'தனியுரிமைக் கொள்கை', 'গোপনীয়তা নীতি'),
('TERMS & CONDITIONS', 'नियम और शर्तें', 'ഉപാധികളും നിബന്ധനകളും', 'விதிமுறைகள்  நிபந்தனைகள்', 'টার্মস ও কন্ডিশন'),
('REFUND & CANCELLATION', 'रिफंड & कैंसिलेशन', 'റീഫണ്ട് & റദ്ദാക്കൽ', 'திரும்பப் பெறுதல் & ரத்து செய்தல்', 'ফেরত এবং বাতিলকরণ'),
('Popular Products', 'लोकप्रिय उत्पाद', 'ജനപ്രിയ ഉൽപ്പന്നങ്ങൾ', 'பிரபலமான தயாரிப்புகள்', 'জনপ্রিয় পণ্য'),
('20-20(200g)', '20-20(200g)', '20-20(200g)', '20-20(200g)', '20-20(200g)'),
('50-50(150g)', '50-50(150g)', '50-50(150g)', '50-50(150g)', '50-50(150g)'),
('UNIBIC(120g)', 'UNIBIC(120g)', 'യൂനിബിക്(120g)', 'UNIBIC(120g)', 'UNIBIC(120g)'),
('RUSK BRITANNIA', 'RUSK BRITANNIA', 'റസ്ക് ബ്രിട്ടാണിയ', 'RUSK BRITANNIA', 'RUSK BRITANNIA'),
('SUNFEAST DREAM(120g)	', 'SUNFEAST DREAM(120g)	', 'സൺഫീറ്റ് ഡ്രീം(120g)	', 'SUNFEAST DREAM(120g)	', 'SUNFEAST DREAM(120g)	'),
('SUNFEAST CREAM(120g)', 'SUNFEAST CREAM(120g)', 'സൺഫീറ്റ് ക്രീം(120g)', 'SUNFEAST CREAM(120g)', 'SUNFEAST CREAM(120g)'),
('TIGER(124g)', 'TIGER(124g)', 'ടൈഗർ(124g)', 'TIGER(124g)', 'TIGER(124g)'),
('BEAN POWDER ANUS(35g)', 'बीन पाउडर ANUS(35g)', 'ചെറുപയർ പൊടി ANUS(35g)\r\n', 'பீன் பவுடர் ANUS(35g)', 'শিম গুঁড়া ANUS(35g)'),
('UJALA WASHING POWDER(115g)', 'उजाला साबुन पाउडर(115g)', 'ഉജാല സോപ്പ് പൊടി(115g)', 'உஜாலா சோப்பு தூள்(115g)', 'উজালা সাবান গুঁড়া(115g)'),
('EXO SCRUBBER(18g)', 'EXO SCRUBBER(18g)', 'എക്സോ സ്ക്രബ്ബർ(18g)', 'EXO SCRUBBER(18g)', 'এক্সো স্ক্র্যাবার(18g)'),
('DRY GINGER COFFEE (TASTY)', 'चक कॉफी(TASTY)', 'ചുക്ക് കാപ്പി (ടേസ്റ്റി)', 'சக் காபி(TASTY)', 'চক কফি(TASTY)'),
('LG ASAFOETIDA(50g)', 'LG हींग(50g)', 'LG കായം(50)', 'LG அசாஃபோடிடா(50g)', 'LG হিং(50g)'),
('LG ASAFOETIDA', 'LG हींग', 'LG കായം', 'LG அசாஃபோடிடா', 'LG হিং'),
('LOLIPOP REAL & TARWIN', 'लॉलीपॉप REAL & TARWIN', 'ലോലിപോപ്പ് റിയൽ & ടാർവിൻ', 'லாலிபாப் ரியல் & டார்வின்', 'ললিপপ REAL & TARWIN'),
('THIRST QUENCHER SHREE(25g)', 'THIRST QUENCHER SHREE(25g)', 'ദാഹശമനി ശ്രീ(25g) ', 'THIRST QUENCHER SHREE(25g)', 'THIRST QUENCHER SHREE(25g)'),
('PAMPERS (L)', 'PAMPERS (L)', 'പാമ്പേസ് (L)', 'PAMPERS (L)', 'PAMPERS (L)'),
('PAMPERS (M)', 'PAMPERS (M)', 'പാമ്പേസ് (M)', 'PAMPERS (M)', 'PAMPERS (M)'),
('PAMPERS (S)', 'PAMPERS (S)', 'പാമ്പേസ് (S)', 'PAMPERS (S)', 'PAMPERS (S)'),
('EASTERN RASAM(100g)', 'EASTERN रसम (100g)', 'ഈസ്റ്റേൺ രസം(100g) ', 'EASTERN ரசம்(100g) ', 'EASTERN রসম(100g) '),
('EASTERN GARAM MASALA(50g)', 'EASTERN गरम मसाला(50g)', 'ഈസ്റ്റേൺ ഗരം മസാല(50g)', 'EASTERN கரம் மசாலா(50g)', 'EASTERN গরম মশলা(50g)'),
('EASTERN SAMBAR(100g)', 'EASTERN सांभर(100g)', 'ഈസ്റ്റേൺ സാമ്പാർ(100g)', 'EASTERN சாம்பார்(100g)', 'EASTERN সাম্বার(100g)'),
('EASTERN MEAT(100g)', 'EASTERN मांस मसाला(100g)', 'ഈസ്റ്റേൺ ഇറച്ചി മസാല(100g) ', 'EASTERN இறைச்சி மசாலா(100g) ', 'EASTERN মাংস মশলা(100g) '),
('EASTERN CHICKEN(100g)', 'EASTERN चिकन मसाला(100g) ', 'ഈസ്റ്റേൺ ചിക്കൻ മസാല(100g) ', 'EASTERN சிக்கன் மசாலா(100g) ', 'EASTERN মুরগী মশলা(100g) '),
('EASTERN FISH MASALA(100g)', 'EASTERN मछली मसाला(100g)', 'ഈസ്റ്റേൺ മീൻ മസാല(100g)', 'EASTERN ஃபிஷ் மசாலா(100g)', 'EASTERN ফিশ মাসালা(100g)'),
('EASTERN PICKLE(100g)', 'EASTERN अचार(100g)', 'ഈസ്റ്റേൺ അച്ചാർ(100g)', 'EASTERN ஊறுகாய்(100g)', 'EASTERN আচার(100g)'),
('KISMIS PACKET(15gm)', 'किसमिस PACKET(15gm)', 'ഉണക്കമുന്തിരി പേക്കറ്റ്(15gm)', 'கிஸ்மிஸ் PACKET(15gm)', 'PACKET(15gm)'),
('CARDAMOM NATURAL', 'इलायची NATURAL', 'ഏലയ്ക്ക നാച്ചുറൽ ', 'ஏலக்காய் NATURAL', 'কার্ডডম NATURAL'),
('BIRIYANI MASALA TASTY BIG', 'बिरयानी मसाला TASTY BIG', 'ബിരിയാണി മസാല ടേസ്റ്റി ബിഗ് ', 'பிரியாணி மசாலா TASTY BIG', 'বিরিয়ানি মাসআলা TASTY BIG'),
('HAND WASH MULLA(300ml)', 'हैंड वॉश MULLA(300ml)', 'ഹാൻഡ് വാഷ് MULLA(300ml)', 'வாஷ் ரீஃபில் MULLA(300ml)', 'হাত ধোবার জন্য তরল সাবান MULLA(300ml)'),
('COMFORT(220ml)', 'कम्फर्ट(220ml)', 'കംഫോർട്ട്(220ml)', 'COMFORT(220ml)', 'COMFORT(220ml)'),
('HARPIK(500ml)', 'HARPIC टॉयलेट क्लीनर(500ml)', 'ഹാർപിക് (500ml)', 'ஹார்பிக் தினம்(500ml)', 'হারপিক(500ml)'),
('LIZOL(200ml)', 'लाईज़ोल(200ml)', 'ലൈസോൾ(200ml)', 'லைசோல்(200ml)', 'লাইজল(200ml)'),
('HARPIK(200ml)', 'HARPIC टॉयलेट क्लीनर(200ml)', 'ഹാർപിക്(200ml)', 'ஹார்பிக் தினம்(200ml)', 'হারপিক(200ml)'),
('RKG GHEE(100ml)', 'RKG घी(100ml)', 'RKG നെയ്യ്(100ml)', 'RKG நெய்(100ml)', 'RKG ঘি(100ml)'),
('RKG GHEE(50ml)', 'RKG घी(50ml)', 'RKG നെയ്യ്(50ml)', 'RKG நெய்(50ml)', 'RKG ঘি(50ml)'),
('SANITIZER LIFEBUOY(50ml)', 'सैनिटाइज़र LIFEBUOY(50ml)', 'സാനിറ്റൈസർ LIFEBUOY(50ml)', 'சானிடைஸர் LIFEBUOY(50ml)', 'স্যানিটাইজার LIFEBUOY(50ml)'),
('SANITIZER HYGIENIX(100ml)\r\n', 'सैनिटाइज़र HYGIENIX(100ml)\r\n', 'സാനിറ്റൈസർ HYGIENIX(100ml)\r\n', 'சானிடைஸர் HYGIENIX(100ml)\r\n', 'স্যানিটাইজার HYGIENIX(100ml)\r\n'),
('HANDWASH DETTOL(250ml)', 'हैंड वॉश DETTOL(250ml)\r\n', 'ഹാൻഡ് വാഷ് DETTOL(250ml)\r\n', 'வாஷ் ரீஃபில் DETTOL(250ml)\r\n', 'হাত ধোবার জন্য তরল সাবান DETTOL(250ml)\r\n'),
('EASTERN BIRIYANI(100g)', 'EASTERN बिरयानी मसाला(100g)', 'ഈസ്റ്റേൺ ബിരിയാണി മസാല(100g)', 'EASTERN பிரியாணி மசாலா(100g)', 'EASTERN বিরিয়ানি মাসআলা(100g)'),
('VIM LIQUID(155ml)', 'Vim डिश वॉश जेल(155ml)', 'വിം ലിക്വിഡ്(155ml)', 'VIM டிஷ்வாஷ் ஜெல்(155ml)', 'VIM ডিশ ওয়াশ জেল(155ml)'),
('MILMA GHEE(100ml)', 'मिलम घी(100ml)', 'മിൽമ നെയ്യ്(100ml)', 'மில்மா நெய்(100ml)', 'মিল্মা ঘি(100ml)'),
('MILMA GHEE(50ml)', 'मिलम घी(50ml)', 'മിൽമ നെയ്യ്(50ml)', 'மில்மா நெய்(50ml)', 'মিল্মা ঘি(50ml)'),
('RKG GHEE(200ml)', 'RKG घी(200ml)', 'RKG നെയ്യ്(200ml)', 'RKG நெய்(200ml)', 'RKG ঘি(200ml)'),
('LADIES COMB RAJA', 'लेडीज़ कॉम्ब राजा ', 'ലേഡീസ് ചീപ്പ് രാജ', 'LADIES சீப்பு RAJA', 'LADIES চিরুনি RAJA'),
('SUNLIGHT WASHING POWDER(125G)', 'सनलाइट साबुन पाउडर(125G)', 'സൺലൈറ്റ് സോപ്പ് പൊടി(125G)', 'SUNLIGHT சோப்பு தூள்(125G)', 'SUNLIGHT সাবান গুঁড়া(125G)'),
('SUNLIGHT WASHING POWDER(500g)', 'सनलाइट साबुन पाउडर(500g)', 'സൺലൈറ്റ് സോപ്പ് പൊടി(500g)', 'SUNLIGHT சோப்பு தூள்(500g)', 'SUNLIGHT সাবান গুঁড়া(500g)'),
('UJALA WASHING POWDER(500g)', 'उजाला साबुन पाउडर(500g)', 'ഉജാല സോപ്പ് പൊടി(500g)', 'உஜாலா சோப்பு தூள்(500g)', 'উজালা সাবান গুঁড়া(500g)'),
('MULLA WASING POWDER(300g)', 'मुल्ला साबुन पाउडर(300g)', 'മുല്ല സോപ്പ് പൊടി(300g)', 'முல்லா சோப்பு தூள்(300g)', 'মোল্লা সাবান গুঁড়া(300g)'),
('SURFEXCEL WASHING POWDER(500g)', 'सरफेक्सल साबुन पाउडर(500g)', 'സർഫ് എക്സൽ സോപ്പ് പൊടി(500g)', 'SURFEXCEL சோப்பு தூள்((500g)', 'SURFEXCEL সাবান গুঁড়া(500g)'),
('VANILA WASHING POWDER', 'वनीला साबुन पाउडर', 'വാനില സോപ്പ് പൊടി', 'VANILA சோப்பு தூள்', 'VANILA সাবান গুঁড়া'),
('VANILA WASHING POWDER(300g)', 'वनीला साबुन पाउडर(300g)', 'വാനില സോപ്പ് പൊടി(300g)', 'VANILA சோப்பு தூள்(300g)', 'VANILA সাবান গুঁড়া(300g)'),
('VANILA WASHING POWDER(500)', 'वनीला साबुन पाउडर(500)', 'വാനില സോപ്പ് പൊടി(500)', 'VANILA சோப்பு தூள்(500)', 'VANILA সাবান গুঁড়া(500)'),
('ARIEL (500)', 'एरियल(500)', 'ഏരിയൽ(500)', 'ஏரியல்(500)', 'এরিয়েল(500)'),
('ARIEL PACKET(12g)', 'एरियल पैकेट(12g)', 'ഏരിയൽ പാക്കറ്റ്(12g)', 'ஏரியல் PACKET(12g)', 'এরিয়েল PACKET(12g)'),
('EASTERN PEPPER(50g)', 'EASTERN काली मिर्च  पाउडर(50g)', 'ഈസ്റ്റേൺ കുരുമുളക് പൊടി(50g)', 'EASTERN மிளகு தூள்(50g)', 'EASTERN গোলমরিচ গুঁড়া(50g)'),
('PRIL (110ml)', 'प्रिल (110ml)', 'പ്രിൽ (110ml)', 'ப்ரில் (110ml)', 'PRIL (110ml)'),
('EASTERN FENUGREEK (100g)', 'EASTERN मेंथी(100g)', 'ഈസ്റ്റേൺ ഉലുവ (100g)', 'EASTERN வெந்தயம்(100g)', 'EASTERN মেথি(100g)'),
('FREEK WASHING BAR(600g)', 'फ्रीक बार साबुन(600g)', 'ഫ്രീക് വാഷിംഗ് സോപ്പ് (600g)', 'FREEK சலவை சோப்(600g)', 'FREEK বার সাবান(600g)'),
('EASTERN CUMIN SMALL(50g)', 'EASTERN जीरा छोटा(50g)', 'ഈസ്റ്റേൺ ജീരകം ചെറുത്(50g)', 'EASTERN சீரகம்சிறிய(50g)', 'EASTERN জিরা ছোট(50g)'),
('KABANI WASHING BAR(550g)', 'KABANI बार साबुन(550g)', 'കബനി വാഷിംഗ് സോപ്പ്(550g)', 'KABANI  சலவை சோப்(550g)', 'KABANI বার সাবান(550g)'),
('COLOUR WHITE WASHING BAR(550g)', 'COLOUR WHITE बार साबुन(550g)', 'കളർ വൈറ്റ് വാഷിംഗ് സോപ്പ്(550g)', 'COLOUR WHITE சலவை சோப்(550g)', 'COLOUR WHITE বার সাবান(550g)'),
('MULLA WASHING BAR(550g)', 'MULLA बार साबुन(550g)', 'മുല്ല വാഷിംഗ് സോപ്പ്(550g)', 'MULLA  சலவை சோப்(550g)', 'MULLA বার সাবান(550g)'),
('AJAY QUEST TOOTHBRUSH', 'अजय QUEST टूथब्रश', 'അജയ് QUEST ടൂത്ത്ബ്രഷ്', 'அஜய் QUEST டூத் பிரஷ்', 'আজ QUEST টুথব্রাশ'),
('EASTERN MUSTARD (100g)', 'EASTERN सरसों(100g)', 'ഈസ്റ്റേൺ കടുക്(100g)', 'EASTERN கடுகு(100g)', 'EASTERN সরিষা(100g)'),
('DARK CHOCO HEARTS', 'डार्क चोको हार्ट', 'ഡാർക് ചോക്കോ ഹാർട്ട് ', 'DARK CHOCO HEARTS', 'DARK CHOCO HEARTS'),
('DAIRY MILK', 'डेयरी मिल्क', 'ഡയറി മിൽക്ക്', 'DAIRY MILK', 'DAIRY MILK'),
('AMULYA MILK POWDER(200)', 'अमूल्या मिल्क पाउडर(200)', 'അമുല്യ പാൽപ്പൊടി(200)', 'அமுல்யா பால் பொடி(200)', 'অমূল্য গুঁড়া দুধ(200)'),
('EVEREADY AA', 'एवरीडे AA', 'എവെരിഡേ AA', 'EVEREADY AA', 'EVEREADY AA'),
('EVEREADY AAA YELLOW', 'एवरीडे AA YELLOW', 'എവെരിഡേ AA YELLOW', 'EVEREADY AA YELLOW', 'EVEREADY AA YELLOW'),
('HAPPY JAM (100g)', 'हैप्पी जाम(100g)', 'ഹാപ്പി ജാം (100g)', 'ஹாப்பி ஜாம்(100g)', 'হ্যাপি  জাম(100g)'),
('AMULYA MILK POWDER (50g)', 'अमूल्या मिल्क पाउडर(50g)', 'അമുല്യ പാൽപ്പൊടി(50g)', 'அமுல்யா பால் பொடி(50g)', 'অমূল্য গুঁড়া দুধ(50g)'),
('AMULYA MILK POWDER (100g)', 'अमूल्या मिल्क पाउडर(100g)', 'അമുല്യ പാൽപ്പൊടി(100g)', 'அமுல்யா பால் பொடி(100g)', 'অমূল্য গুঁড়া দুধ(100g)'),
('OREO(120g)', 'ओरियो(120g)', 'ഓറിയോ(120g)', 'ஓரியோ(120g)', 'ওরিও(120g)'),
('FINGER CAP', 'FINGER CAP', 'ഫിംഗർ ക്യാപ്പ്', 'FINGER CAP', 'FINGER CAP'),
('RUBBER BAND PACK', 'रबर बैंड पैक', 'റബ്ബർ ബാൻഡ് പായ്ക്ക്', 'ரப்பர் பேண்ட் பேக்', 'রাবার ব্যান্ড প্যাক'),
('WHISPER(6 Nos)', 'विस्पर (6 Nos)', 'വിസ്‌പർ(6 Nos)', 'விஸ்பர்(6 Nos)', 'WHISPER(6 Nos)'),
('BOOST (200g)', 'बूस्ट(200g)', 'ബൂസ്റ്റ്(200g)', 'பூஸ்ட்(200g)', 'বুস্ট(200g)'),
('HORLICKS (200g)', 'हॉर्लिक्स(200g)', 'ഹോർലിക്സ്(200g)', 'ஹார்லிக்ஸ்(200g)', 'হরলিক্স(200g)'),
('KADAK', 'KADAK', 'കഥക്', 'KADAK', 'KADAK'),
('KRAK JACK', 'क्रैक जैक ', 'ക്രാക്ക് ജാക്ക്', 'கிராக் ஜாக்', 'ক্র্যাক জ্যাক'),
('BOURBON PARLE(150g)', 'बोरबन पारले(150g)', 'ബർബൻ പാർലെ(150g)', 'போர்பன் பார்லே(150g)', 'বোর্বন পারলে(150g)'),
('SUNFEAST MARIE', 'सनफीस्ट मैरी', 'സൺഫീസ്റ്റ് മാരി', 'சன்ஃபீஸ்ட் மேரி', 'সানফিস্ট মেরি'),
('GOLD 555 SOAP(150g)', 'गोल्ड 555 साबून(150g)', 'ഗോൾഡ് 555 സോപ്പ്(150g)', 'கோல்டு 555 சோப்(150g)', 'গোল্ড  555 সাবান(150g)'),
('SUNFEAST MOMS MAGIC(120g)', 'सनफीस्ट मॉम्स मैजिक(120g)', 'സൺഫീസ്റ്റ് മോംമസ് മാജിക്(120g)', 'SUNFEAST MOMS MAGIC(120g)', 'SUNFEAST MOMS MAGIC(120g)'),
('JOY RUSK(140g)', 'जॉय रस्क (140g)', 'ജോയ് റസ്ക്(140g)', 'ஜாய் ரஸ்க்(140g)', 'JOY রাস্ক(140g)'),
('SUNFEAST DARK FANTASY(75g)', 'सनफीस्ट डार्क फैंटसी(75g)', 'സൺഫീസ്റ്റ് ഡാർക്ക് ഫാന്റസി75g)', 'SUNFEAST டார்க் பாண்டஸி(75g)', 'SUNFEAST  DARK FANTASY(75g)'),
('RUSK ELITE', 'रस्क इलीट ', 'റസ്ക് എലൈറ്റ്', 'ரஸ்க் எலைட்', 'রাস্ক এলিট '),
('HIDE & SEEK(120g)', 'हाईड & सीक(120g)', 'ഹൈഡ് & സീക്(120g)', 'ஹைட் & சீக்(120g)', 'হাইড & সিক(120g)'),
('NABATI(35g)', 'NABATI(35g)', 'നബാട്ടി(35g)', 'NABATI(35g)', 'নাবাতি(35g)'),
('YIPEE NOODELES(70g)', 'यिप्पी नूडल्स(70g)', 'യിപ്പീ നൂഡിൽസ്(70g)', 'யிப்பி நூடுல்ஸ்(70g)', 'ইপ্পি নুডলস(70g)'),
('PEANUT CHIKKI ALLWIN', 'पीनट चिक्की एल्विन', 'പീനട്ട് ചിക്കി ആൽവിൻ  ', 'peanut சிக்கி ஆல்வின்', 'পিনাট চিকি আলভিন'),
('MILKYBAR', 'मिल्कीबार ', 'മിൽക്കിബാർ', 'MILKYBAR', 'মিলকিবার'),
('VICKS CANDY', 'विक्स कैंडी', 'വിക്സ് മിട്ടായി', 'விக்ஸ் மிட்டாய்', 'VICKS CANDY'),
('MOTHER TOMATO SAUCE', 'मदर टमाटर सॉस', 'മദർ ടൊമാറ്റോ സോസ്  ', 'மதர் தக்காளி சாஸ்', 'MOTHER টমেটো সস'),
('BOOST(500)', 'बूस्ट(500)', 'ബൂസ്റ്റ്(500)', 'பூஸ்ட்(500)', 'বুস্ট(500)'),
('HORLICKS (500g)', 'हॉर्लिक्स(500g)', 'ഹോർലിക്സ്(500g)', 'ஹார்லிக்ஸ்(500g)', 'হরলিক্স(500g)'),
('OREO(45g)', 'ओरियो(45g)', 'ഓറിയോ(45g)', 'ஓரியோ(45g)', 'ওরিও(45g)'),
('ROSE WATER(59ml)', 'रोस  वाटर(59ml) ', 'റോസ് വാട്ടർ(59ml) ', 'ரோஸ் வாட்டர்(59ml) ', 'গোলাপ জল(59ml)'),
('CLINIC PLUS(5ml)', 'क्लिनिक प्लस(5ml) ', 'ക്ലിനിക് പ്ലസ്(5ml) ', 'கிளினிக் பிளஸ்(5ml) ', 'ক্লিনিক প্লাস(5ml) '),
('SUNSILK(6ml)', 'सनसिल्क(6ml)', 'സൺസിൽക്ക്(6ml)', 'சன்சில்க்(6ml)', 'সানসিল্ক(6ml)'),
('CHIK(6ml)', 'चिक(6ml) ', 'ചിക്ക്(6ml)', 'CHIK(6ml)', 'CHIK(6ml)'),
('COLGATE(20g)', 'कोलगेट(20g)', 'കോൾഗേറ്റ്(20g)', 'கோல்கேட்(20g) ', 'কলগেট(20g)'),
('SUNLIGHT WASHING POWDER(150G)', 'सनलाइट साबुन पाउडर(150G)', 'സൺലൈറ്റ് സോപ്പ് പൊടി(150G)', 'SUNLIGHT சோப்பு தூள்(150G)', 'SUNLIGHT সাবান গুঁড়া(150G)'),
('PONDS(100 gm)', 'पॉन्ड्स(100 gm)', 'പോൻഡ്സ് (100 gm)', 'பொண்ட்ஸ்(100 gm)', 'পন্ডস (100 gm)'),
('CUTICURA TALC ORIGINAL (100 g)', 'कुट्टीक्कूरा  टैल्कम पाउडर ओरिजिनल (100 g)', 'കുട്ടിക്കൂറ ടാൽകം പൗഡർ ഒറിജിനൽ(100 g) ', 'CUTICURA TALC ORIGINAL (100 g)', 'CUTICURA TALC ORIGINAL (100 g)'),
('CUTICURA SMALL(25g)', 'कुट्टीक्कूरा SMALL(25g)', 'കുട്ടിക്കൂറ സ്മാൾ(25g)', 'CUTICURA SMALL(25g)', 'CUTICURA SMALL(25g)'),
('RIN WASHING POWDER(150g)', 'रिन साबुन पाउडर(150g)', 'റിൻ സോപ്പ് പൊടി(150g)', 'ரின் சோப்பு தூள்(150g)', 'রিন সাবান গুঁড়া(150g)'),
('POWER WASHING SOAP(300g)', 'पवर साबुन पाउडर(300g)', 'പവർ സോപ്പ് പൊടി(300g)', 'பவர் சோப்பு தூள்(300g)', 'POWER সাবান গুঁড়া(300g)'),
('DR WASH(200g)', 'DR वाश(200g)', 'DR വാഷ് (200g)', 'DR வாஷ்(200g)', 'DR WASH(200g)'),
('SUNLIGHT WASHING SOAP(150g)', 'सनलाइट लांड्री साबुन(150g)', 'സൺലൈറ്റ് ലോൺ‌ഡ്രി സോപ്പ്(150g)', 'SUNLIGHT சலவை சோப்(150g)', 'SUNLIGHT লন্ড্রি সাবান(150g)'),
('OLIVIA SOAP(100g)', 'ओलीविया साबुन(100g)', 'ഒലീവിയ സോപ്പ്(100g)', 'ஒலிவியா சோப்(100g)', 'অলিভিয়া সাবান(100g)'),
('KAIRALI SOAP(100g)', 'कैराली साबुन(100g)', 'കൈരളി സോപ്പ്(100g)', ' கைரலி சோப்(100g)', 'কৈরালি সাবান(100g)'),
('DOVE SOAP (100g)', 'डव साबुन(100g)', 'ഡോവ് സോപ്പ്(100g)', 'டோவ் சோப்(100g)', 'ডাভ সাবান(100g)'),
('LIFEBUOY (56g)', 'लाइफबॉय(56g)', 'ലൈഫ്ബോയ്(56g)', 'லைஃப்பாய்(56g)', 'লাইফবয়(56g)'),
('MEDIMIX(75g)', 'मेडिमिक्स(75g)', 'മെഡിമിക്സ്(75g)', 'மெடிமிக்ஸ்(75g)', 'মেডিমিক্স(75g)'),
('CHANDRIKA(75g)', 'चंद्रिका(75g)', 'ചന്ദ്രിക(75g)', 'சந்திரிகா(75g)', 'চন্দ্রিকা(75g)'),
('AMRUT', 'अमृत', 'അമൃത് ', 'அம்ரித்', 'অমৃত'),
('LUX(100G)', 'लक्स(100G) ', 'ലക്സ്(100G) ', 'லக்ஸ்(100G)', 'লাক্স(100G)'),
('LIFEBUOY(125g)', 'लाइफबॉय(125g)', 'ലൈഫ്ബോയ്(125g)', 'லைஃப்பாய்(125g)', 'লাইফবয়(125g)'),
('SANTHOOR(100G)', 'संतूर(100G) ', 'സന്തൂർ(100G)', 'சந்தூர்(100G) ', 'সন্তুর(100G)'),
('PEARS(100G)', 'पेअर्स (100G)', 'പിയേഴ്സ് (100G) ', 'பெயர்ஸ்(100G)', 'পিয়ার্স (100G)'),
('DOVE SOAP(50g)', 'डव साबुन(50g)', 'ഡോവ് സോപ്പ്(50g)', 'டோவ் சோப்(50g)', 'ডাভ সাবান(50g)'),
('VIM (85g)', 'विम(85g)', 'വിം(85g)', 'விம்(85g)', 'VIM (85g)'),
('VIM(150g)', 'विम(150g)', 'വിം(150g)', 'விம்(150g)', 'VIM(150g)'),
('EXO (120g+20g)', 'एक्सो(120g+20g)', 'എക്സോ(120g+20g)', 'EXO (120g+20g)', 'এক্সো(120g+20g)'),
('EXO(70g+20g)', 'एक्सो(70g+20g)', 'എക്സോ(70g+20g)', 'EXO(70g+20g)', 'এক্সো(70g+20g)'),
('UJALA SUPREME(75ml)', 'उजाला सुप्रीम', 'ഉജാല സുപ്രീം ', 'உஜாலா சுப்ரீம்', 'উজালা সুপ্রিম'),
('CHIK(35ml)', 'चिक(35ml)', 'ചിക്ക്(35ml)', 'CHIK(35ml)', 'CHIK(35ml)'),
('CLINIC PLUS (40ml)', 'क्लिनिक प्लस(40ml)', 'ക്ലിനിക് പ്ലസ്(40ml)', 'கிளினிக் பிளஸ்(40ml)', 'ক্লিনিক প্লাস(40ml)'),
('COLGATE (45g)', 'कोलगेट(45g)', 'കോൾഗേറ്റ്(45g)', 'கோல்கேட்(45g)', 'কলগেট(45g)'),
('COLGATE (100)', 'कोलगेट(100)', 'കോൾഗേറ്റ്(100)', 'கோல்கேட்(100)', 'কলগেট(100)'),
('DABUR(50g)', 'डाबर(50g)', 'ഡാബർ(50g)', 'டாபர்(50g)', 'দাবুর(50g)'),
('KP NAMBOOTHIRI PASTE (50g)', 'K P नम्बूतिरी पेस्ट (50g)', 'കെ പി നമ്പൂതിരി പേസ്റ്റ്(50g)', 'KP நம்பூதிரி பேஸ்ட்(50g)', 'KP নাম্বুটিরি পেস্ট(50g)'),
('KP NAMBOOTHIRI PASTE (100g)', 'K P नम्बूतिरी पेस्ट(100g)', 'കെ പി നമ്പൂതിരി പേസ്റ്റ്(100g)', 'KP நம்பூதிரி பேஸ்ட்(100g)', 'KP নাম্বুটিরি পেস্ট(100g)'),
('CLOSE UP(40g)', 'CLOSE UP(40g)', 'ക്ലോസപ്പ്(40g)', 'CLOSE UP(40g)', 'CLOSE UP(40g)'),
('CLOSE UP (96g)', 'CLOSE UP (96g)', 'ക്ലോസപ്പ് (96g)', 'CLOSE UP (96g)', 'CLOSE UP (96g)'),
('CIBACA (80g)', 'सिबाका (80g)', 'സിബാക്ക (80g)', 'CIBACA (80g)', 'CIBACA (80g)'),
('SCRUBBER EXO GREEN(1 pck)', 'स्क्रबर एक्सो ग्रीन(1 pck)', 'സ്ക്രബ്ബർ എക്സോ ഗ്രീൻ(1 pck)', 'ஸ்க்ரப்பர் எக்ஸோ கிரீன்(1 pck)', 'SCRUBBER EXO GREEN(1 pck)'),
('SLEEP WELL(1 pck)', 'स्लीप वेल अगरबत्ती (1 pck)', 'സ്ലീപ് വെൽ(1 pck)', 'SLEEP WELL(1 pck)', 'SLEEP WELL(1 pck)'),
('TRIVENI(1 pck)', 'त्रिवेणी अगरबत्ती (1 pck)', 'ത്രിവേണി (1 pck)', 'திரிவேணி(1 pck)', 'ত্রিবেণী(1 pck)'),
('3 IN ONE(1 pck)', '3 IN ONE(1 pck)', '3 ഇൻ വൺ(1 pck)', '3 IN ONE(1 pck)', '3 IN ONE(1 pck)'),
('DOVE SHAMPHOO(8ml)', 'डव शैम्पू(8ml)', 'ഡോവ് ഷാമ്പൂ(8ml)', 'டோவ் ஷாம்பு(8ml)', 'ডাভ শ্যাম্পু(8ml)'),
('HORLICKS (SMALL PACK) 15g', 'हॉर्लिक्स (छोटा पैक)15g', 'ഹോർലിക്സ് (ചെറിയ പായ്ക്ക്)15g', 'ஹார்லிக்ஸ் (சிறிய பேக்)15g', 'হরলিক্স (ছোট প্যাক)15g'),
('BOOST (SMALL PACK) 15g', 'बूस्ट (छोटा पैक)15g', 'ബൂസ്റ്റ് (ചെറിയ പായ്ക്ക്)15g', 'பூஸ்ட் (சிறிய பேக்)15g', 'বুস্ট (ছোট প্যাক)15g'),
('YARN (ANNA)', 'धागा(ANNA)', 'നൂൽ (അന്ന)', 'நூல்(ANNA)', 'সুতা (আন্না)'),
('STAPLER PIN (100 Nos)', 'स्टेपलर पिन (100 Nos)', 'സ്റ്റാപ്ലർ പിൻ(100 Nos)', 'ஸ்டேப்லர் பின் (100 Nos)', 'স্ট্যাপলার পিন(100 Nos)'),
('STAPLER MACHINE KANGARO', 'स्टेपलर मशीन कंगारू', 'സ്റ്റാപ്ലർ മെഷീൻ കങ്കാരു ', 'ஸ்டேப்ளர் மெஷின் கங்காரு', 'স্ট্যাপলার  মেশিন ক্যাঙ্গারু'),
('BELL PIN SMALL', 'बेल पिन छोटा', 'ബെൽ പിൻ സ്മാൾ', 'பெல் பின் ஸ்மால்', 'বেল পিন স্মল '),
('EXO ROUND(250g)', 'एक्सो राउंड (250g)', 'എക്സോ റൗണ്ട് (250g)', 'EXO ROUND(250g)', 'এক্সো ROUND(250g)'),
('CINTHOL', 'सिंथोल ', 'സിന്തോൾ', 'சிந்தோள்', 'সিনথল'),
('CUTEE SOAP(100g)', 'CUTEE सोप(100g)', 'ക്യൂടീ സോപ്പ് (100g)', 'CUTEE சோப்(100g)', 'CUTEE সাবান(100g)'),
('VIVEL(51g)', 'विवेल (51g)', 'വിവേൽ(51g)', 'விவேல்(51g)', 'ভিভেল(51g)'),
('JO SOAP(57g)', 'जो साबुन(57g)', 'ജോ സോപ്പ് (57g)', 'ஜோ சோப்(57g)', 'JO সাবান(57g)'),
('BELL PIN BIG (1 pck)', 'बेल पिन बड़ा(1 pck)', 'ബെൽ പിൻ വലുത്(1 pck)', 'பெல் பின் பெரியது(1 pck)', 'বেল পিন বিশাল(1 pck)'),
('OATS BAGGRYS (500g)', 'ओट्स BAGGRYS (500g)', 'ഓട്ട്‌സ്‌ BAGGRYS (500g)', 'ஓட்ஸ் BAGGRYS (500g)', 'ওটস BAGGRYS (500g)'),
('505 CAMPHOR(15g)', '505 कपूर(15g)', '505 കർപ്പൂരം (15g)', '505 கற்பூரம்(15g)', '505 কর্পূর(15g)'),
('FEVIGUM', 'फेविगम ', 'ഫെവിഗം', 'FEVIGUM', 'FEVIGUM'),
('SAMIO BAMBINO (325g)', 'सेमियो बैम्बिनो(325g)', 'സേമിയ  ബാംബിനോ(325g)', 'Bambino வெர்மிசெல்லி(325g)', 'বাম্বিনো সিঁদুর(325g)'),
('SAMIO BAMBINO (150g)', 'सेमियो बैम्बिनो(150g)', 'സേമിയ  ബാംബിനോ(150g)', 'Bambino வெர்மிசெல்லி(150g)', 'বাম্বিনো সিঁদুর(150g)'),
('SAFETY PIN STYLE', 'सेफ्टी पिन स्टाइल', 'സേഫ്റ്റി പിൻ സ്റ്റൈൽ', 'ஊக்கு ', 'সেফটি পিন শৈলী'),
('LIGHTER', 'लाइटर', 'ലൈറ്റർ ', 'லைட்டர் ', 'লাইটার'),
('CHARAD KETT BIG', 'CHARAD KETT BIG', 'ചരട് കെട്ട് ബിഗ് ', 'CHARAD KETT BIG', 'CHARAD KETT BIG'),
('INSULATION TAP', 'इन्सुलेशन टेप', 'ഇൻസുലേഷൻ ടാപ്പ്', 'இன்சுலேஷன் டேப்', 'অন্তরণ টেপ'),
('NATARAJ PENCIL', 'नटराज पेंसिल', 'നടരാജ് പെൻസിൽ', 'நடராஜ் பென்சில்', 'নটরাজ পেন্সিল'),
('NATARAJ RUBBER', 'नटराज रबर', 'നടരാജ് റബ്ബർ', 'நடராஜ் ரப்பர்', 'নটরাজ রাবার'),
('NATARAJ CUTTER', 'नटराज कटर', 'നടരാജ് കട്ടർ', 'நடராஜ் கட்டர்', 'নটরাজ কাটার'),
('NATARAJ SCALE SMALL', 'नटराज स्केल छोटा', 'നടരാജ് സ്കെയിൽ സ്മാൾ ', 'நடராஜ் ஸ்கேல் ஸ்மால்', 'নটরাজ স্কেল স্মল'),
('P COMB', 'पी कंघी', 'പി ചീപ്പ്', 'பி சீப்பு ', 'পি চিরুনি '),
('P COMB ROUND MAGIC', 'पी कंघी राउंड मैजिक', 'പി ചീപ്പ് റൗണ്ട് മാജിക്', 'பி சீப்பு ROUND மேஜிக்', 'পি চিরুনি ROUND ম্যাজিক '),
('TOILET CLEANER ROUND MATIZ', 'टॉयलेट क्लीनर राउंड माटीज़ ', 'ടോയ്‌ലറ്റ് ക്ലീനർ റൗണ്ട് മാറ്റിസ്‌ ', 'டாய்லெட் கிளீனர் ROUND மாட்டிஸ்', 'টয়লেট ক্লিয়ার ROUND ম্যাটিস'),
('LIBERTY PALM OIL (200 ml)', 'लिबर्टी पाम ऑयल(200 ml)', 'ലിബർട്ടി പാം ഓയിൽ(200 ml)', 'லிபர்ட்டி பாம் ஆயில்(200 ml)', 'লিবার্টি পাম অয়েল(200 ml)'),
('LIBERTY PALM OIL (500 ml)', 'लिबर्टी पाम ऑयल(500 ml)', 'ലിബർട്ടി പാം ഓയിൽ(500 ml)', 'லிபர்ட்டி பாம் ஆயில்(500 ml)', 'লিবার্টি পাম অয়েল(500 ml)'),
('LIBERTY PALM OIL (1 L)', 'लिबर्टी पाम ऑयल(1 L)', 'ലിബർട്ടി പാം ഓയിൽ(1 L)', 'லிபர்ட்டி பாம் ஆயில்(1 L)', 'লিবার্টি পাম অয়েল(1 L)'),
('DALDA MUSTARD OIL(500 ml)', 'डालडा मस्टर्ड ऑयल(500 ml)', 'ഡാല്‍ഡ കടുകെണ്ണ(500 ml)', 'டால்டா கடுகு எண்ணெய்(500 ml)', 'ডালডা মুষ্টার্ড অয়েল(500 ml)'),
('ESSENCE (100 ml)', 'एसेन्स(100 ml)', 'എസെൻസ്(100 ml)', 'எசன்ஸ்(100 ml)', 'এসেন্স(100 ml)'),
('AVT PRM (100g)', 'AVT PRM (100g)', 'AVT PRM (100g)', 'AVT PRM (100g)', 'AVT PRM (100g)'),
('KANNAN DEVAN(100 gm)', 'कन्नन देवन(100 gm)', 'കണ്ണൻ ദേവൻ(100 gm)', 'கண்ணன் தேவன்(100 gm)', 'কান্নান ডিভান(100 gm)'),
('AVT PRM(35g)', 'AVT PRM(35g)', 'AVT PRM(35g)', 'AVT PRM(35g)', 'AVT PRM(35g)'),
('KANNAN DEVAN(35g)', 'कन्नन देवन(35g)', 'കണ്ണൻ ദേവൻ(35g)', 'கண்ணன் தேவன்(35g)', 'কান্নান ডিভান(35g)'),
('RAVA SAICO(500g)', 'रवा SAICO(500g)', 'റവ SAICO(500g)', 'ரவா SAICO(500g)', 'RAVA SAICO(500g)'),
('RAVA HINDUSTHAN(500g)', 'रवा हिंदुस्तान(500g)', 'റവ ഹിന്ദുസ്ഥാൻ(500g)', 'ரவா இந்துஸ்தான்(500g)', 'RAVA হিন্দুস্তান(500g)'),
('BUDS GUND WOOD', 'BUDS GUND WOOD', 'BUDS GUND WOOD', 'BUDS GUND WOOD', 'BUDS GUND WOOD'),
('SAICO VINAGIRI (500 ml)', 'SAICO सिरका(500 ml)', 'SAICO വിനാഗിരി(500 ml)', 'SAICO வினிகர்(500 ml)', 'SAICO  ভিনেগার(500 ml)'),
('PENOIL DOCTORS(450ml)', 'फिनोल DOCTORS(450ml)', 'പെനോയിൽ DOCTORS(450ml)', 'பெனாயில் DOCTORS(450ml)', 'ফেনল DOCTORS(450ml)'),
('UJALA SUPREME(200ml)', 'उजाला सुप्रीम(200ml)', 'ഉജാല സുപ്രീം(200ml)', 'உஜலா உச்ச(200ml)', 'উজালা সুপ্রিম(200ml)'),
('UJALA KING(250ml)', 'उजाला किंग (250ml)', 'ഉജാല കിംഗ്(250ml)', 'உஜலா கிங்(250ml)', 'উজালা কিং(250ml)'),
('AASHIRVAAD ATTA(1 kg)', 'आशीर्वाद आटा(1 kg)', 'ആശിർവാദ് ആട്ട(1 kg)', 'ஆசீர்வாதம் அட்டா(1 kg)', 'ஆஷிர்வாட் ATTA(1 kg)'),
('LIBERTY ATTA(1 kg)', 'लिबर्टी आटा(1 kg)', 'ലിബർട്ടി ആട്ട(1 kg)', 'லிபர்ட்டி அட்டா(1 kg)', 'লিবার্টি ATTA(1 kg)'),
('PICKLE MAHARANI(200G)', 'महारानी अचार(200G)', 'പിക്കിൾ മഹാറാണി(200G)', 'மஹாராணி ஊறுகாய்(200G)', 'মহারাণী আচার(200G)'),
('KP NAMBOOTHIRI POWDER(15g)', 'K P नम्बूतिरी पाउडर(15g)', 'കെ പി നമ്പൂതിരി പൗഡർ(15g) ', 'KP நம்பூதிரி பவுடர்(15g) ', 'KP নাম্বুটিরি গুঁড়া(15g) '),
('KP NAMBOOTHIRI POWDER YELLOW(40g)', 'K P नम्बूतिरी पाउडर YELLOW(40g)', 'കെ പി നമ്പൂതിരി പൗഡർ YELLOW(40g)', 'KP நம்பூதிரி பவுடர் YELLOW(40g)', 'KP নাম্বুটিরি গুঁড়া YELLOW(40g)'),
('KP NAMBOOTHIRI POWDER GREEN(40g)', 'K P नम्बूतिरी पाउडर GREEN(40g)', 'കെ പി നമ്പൂതിരി പൗഡർ GREEN(40g)', 'KP நம்பூதிரி பவுடர் GREEN(40g)', 'KP নাম্বুটিরি গুঁড়া GREEN(40g)'),
('VELAKKENNA NIRADEEPAM(500ml)\r\n', 'निरदीपम विलक्केन्नई (500ml)', 'വിളക്കെണ്ണ നിറദീപം (500ml)', 'VELAKKENNA NIRADEEPAM(500ml)', 'VELAKKENNA NIRADEEPAM(500ml)'),
('AJMI PUTTPODI(1 kg)', 'अजमी PUTTPODI(1 kg)', 'അജ്മി പുട്ടുപൊടി(1 kg) ', 'அஜ்மி PUTTPODI(1 kg)', 'আজমি PUTTPODI(1 kg)'),
('SAICO VINAGIRI (1L)', 'SAICO सिरका(1L)', 'SAICO വിനാഗിരി(1L)', 'SAICO வினிகர்(1L)', 'SAICO  ভিনেগার(1L)'),
('DALDA (500)', 'डालडा (500)', 'ഡാല്‍ഡ (500)', 'டால்டா (500)', 'ডালডা (500)'),
('DALDA (100)', 'डालडा (100)', 'ഡാല്‍ഡ (100)', 'டால்டா (100)', 'ডালডা (100)'),
('DALDA (200)', 'डालडा (200)', 'ഡാല്‍ഡ (200)', 'டால்டா (200)', 'ডালডা (200)'),
('EASTERN TURMERIC(100g)', 'EASTERN हल्दी(100g)', 'ഈസ്റ്റേൺ മഞ്ഞൾ(100g)', 'EASTERN மஞ்சள்(100g)', 'EASTERN হলুদ(100g)'),
('EASTERN CHILLY(100g)', 'EASTERN मिर्ची(100g)', 'ഈസ്റ്റേൺ മുളക്(100g)', 'EASTERN சில்லி(100g)', 'EASTERN মরিচ(100g)'),
('EASTERN CORIANDER(100g)', 'EASTERN धनिया(100g)', 'ഈസ്റ്റേൺ മല്ലി (100g)', 'EASTERN கொத்தமல்லி(100g)', 'EASTERN ধনে (100g)'),
('LIBERTY SUNFLOWER OIL(500 ml)', 'लिबर्टी सनफ्लावर ऑयल(500 ml)', 'ലിബർട്ടി സൺഫ്ലവർ ഓയിൽ(500 ml)', 'லிபர்ட்டி சுண்ப்பிளார் ஆயில்(500 ml)', 'লিবার্টি সাফল্যের অয়েল(500 ml)'),
('LIBERTY SUNFLOWER OIL (1L)', 'लिबर्टी सनफ्लावर ऑयल (1L)', 'ലിബർട്ടി സൺഫ്ലവർ ഓയിൽ (1L)', 'லிபர்ட்டி சுண்ப்பிளார் ஆயில் (1L)', 'লিবার্টি সাফল্যের অয়েল (1L)'),
('SWARNAM (100 ml)', 'स्वर्णम(100 ml)', 'സ്വർണം(100 ml)', 'ஸ்வர்ணம்(100 ml)', 'স্বর্ণাম (100 ml)'),
('SWARNAM (200 ml)', 'स्वर्णम(200 ml)', 'സ്വർണം(200 ml)', 'ஸ்வர்ணம்(200 ml)', 'স্বর্ণাম (200 ml)'),
('SWARNAM (500  ml)', 'स्वर्णम(500  ml)', 'സ്വർണം(500  ml)', 'ஸ்வர்ணம்(500  ml)', 'স্বর্ণাম (500  ml)'),
('RG NALLENNA(100 ml)', 'RG तेल(100 ml)', 'RG നല്ലെണ്ണ (100 ml)', 'RG நல்லெண்ணெய்(100 ml)', 'RG நல்லெண்ணெய்(100 ml)'),
('RG NALLENNA(200 ml)', 'RG तेल(200 ml)', 'RG നല്ലെണ്ണ (200 ml)', 'RG நல்லெண்ணெய்(200 ml)', 'RG நல்லெண்ணெய்(200 ml)'),
('RG NALLENNA(500  ml)', 'RG तेल(500  ml)', 'RG നല്ലെണ്ണ (500  ml)', 'RG நல்லெண்ணெய்(500  ml)', 'RG நல்லெண்ணெய்(500  ml)'),
('VICKS (10ml)', 'विक्स (10ml)', 'വിക്സ് (10ml)', 'விக்ஸ் (10ml)', 'VICKS (10ml)'),
('TIGER BALM (9ml)', 'टाइगर बाम(9ml)', 'ടൈഗർ ബാം(9ml)', 'டைகர் பாம்(9ml)', 'টাইগার বাম(9ml)'),
('VICKS (5ml)', 'विक्स (5ml)', 'വിക്സ് (5ml)', 'விக்ஸ் (5ml)', 'VICKS (5ml)'),
('NEEDLES', 'सुई', 'സൂചി', 'NEEDLES', 'সুই'),
('M NEEDLES', 'M सुई', 'M സൂചി', 'M NEEDLES', 'M সুই'),
('MUNG BEAN(1kg)', 'मूंग(1kg)', 'ചെറുപയർ(1kg)', 'பாசிப் பயறு(1kg)', 'মুগ(1kg)'),
('BLACK GRAM(1kg)', 'साबुत उरद(1kg)', 'ഉഴുന്ന് പരിപ്പ്(1kg)', 'உளுந்துு(1kg)', 'মাসকলাই ডাল(1kg)'),
('BROWN COW PEAS(1kg)', ' BROWN काउपी (1kg)', 'വൻപയർ(1kg)', 'பழுப்பு தட்டை பயறு(1kg)', 'কাউপি(1kg)'),
('PIGEON DAL(1kg)', 'तूर दाल(1kg)', 'തുവരപരിപ്പ്(1kg)', 'பருப்பு(1kg)', 'ডাল(1kg)'),
('CHICKPEAS(1kg)', 'सफेद मटर(1kg)', 'വെള്ളക്കടല(1kg)', 'சுண்டல்(1kg)', 'সাদা মটর(1kg)'),
('GREEN PEAS(1kg)', 'हरी मटर(1kg)', 'പട്ടാണി(1kg)', 'பச்சை பட்டாணி(1kg)', 'সবুজ মটর(1kg)'),
('HORSE GRAM(1kg)', 'मुथिरा(1kg)', 'മുതിര(1kg)', 'கொள்ளு(1kg)', 'কুলতি কলাই(1kg)'),
('BROKEN RICE(1kg)', 'किनकी चावल(1kg)', 'നുറുക്കരി(1kg)', 'உடைந்த அரிசி(1kg)', 'ভাঙা চাল(1kg)'),
('GRAM FLOUR(1kg)', 'बेसन(1kg)', 'കടലപ്പൊടി(1kg)', 'கடலை மாவு(1kg)', 'ছোলা আটা(1kg)'),
('CUMIN(1kg)', 'जीरा(1kg)', 'സാധാ ജീരകം(1kg)', 'சீரகம்(1kg)', 'জিরা(1kg)'),
('BROWN CHICKPEAS (1kg)', 'चने(1kg)', 'കടല(1kg)', 'கொண்டைக்கடலை(1kg)', 'ছোলা(1kg)'),
('CHILLY(1kg)', 'मिर्ची(1kg)', 'മുളക്(1kg) ', 'மிளகாய்(1kg)', 'মরিচ(1kg)'),
('CASHEW NUTS (1kg)', 'काजू(1kg)', 'അണ്ടി പരിപ്പ്(1kg)', 'முந்திரி பருப்பு(1kg)', 'কাজুবাদাম(1kg)'),
('KISMIS(1kg)', 'किशमिश(1kg)', 'മുന്തിരി(1kg)', 'கிஸ்மிஸ்(1kg)', 'কিসমিস(1kg)'),
('ONION (1kg)', 'प्याज(1kg)', 'വലിയ ഉള്ളി (1kg)', 'வெங்காயம்(1kg)', 'পেঁয়াজ(1kg)'),
('SHALLOT (1kg)', 'छोटे प्याज़(1kg)', 'ചെറിയ ഉള്ളി (1kg)', 'சிறிய வெங்காயம்(1kg)', 'ছোট পেঁয়াজ(1kg)'),
('SOYBEAN(SMALL)(1kg)', 'सोयाबीन(छोटा)(1kg)', 'സോയാബീൻ (SMALL)(1kg)', 'சோயாபீன் (SMALL)(1kg)', 'সয়াবিন (ছোট)(1kg)'),
('JAGGERY(1kg)', 'गुड़(1kg)', 'ശർക്കര(1kg)', 'வெல்லம்(1kg)', 'গুড়(1kg)'),
('SUGAR(1kg)', 'चीनी(1kg)', 'പഞ്ചസാര (1kg)', 'சீனி(1kg)', 'চিনি(1kg)'),
('SALT(1kg)', 'नमक(1kg) ', 'ഉപ്പ്പൊടി(1kg) ', 'உப்பு(1kg) ', 'লবণ(1kg) '),
('ROCK SALT(1kg)', 'ROCK SALT(1kg)', 'കല്ലുപ്പ്(1kg)', 'ROCK SALT(1kg)', 'ROCK SALT(1kg)'),
('RICE (KURUVA JAMANTHI )', 'चावल (कुरुवा जमानती )', 'അരി (കുറുവ ജമന്തി)', 'அரிசி (KURUVA JAMANTHI )', 'ভাত(KURUVA JAMANTHI )'),
('RICE(PONNI)', 'चावल (पोन्नी)', 'അരി (പൊന്നി)', 'அரிசி (பொன்னி)', 'ভাত (পনি )'),
('RICE (KAYAMA)', 'चावल (कयमा)', 'അരി (കയമ)', 'அரிசி (கயாமா)', 'ভাত (কায়মা)'),
('EXO ROUND (500g)', 'एक्सो राउंड (500g)', 'എക്സോ റൗണ്ട് (500g)', 'EXO ROUND(500g)', 'এক্সো ROUND(500g)'),
('QUICKER SHOPPY', 'क्विकर शोप्पी ', 'ക്വിക്കർ ഷോപ്പി ', 'குய்க்கர் ஷாப்பி', 'কুইকার সোপি'),
('LOGIN', 'लॉग इन करें', 'ലോഗിൻ', 'உள்நுழைய', 'লগইন'),
('SEARCH FOR SHOPS', 'शॉप्स के लिए खोज', 'ഷോപ്പുകൾക്കായി തിരയുക', 'கடைகளுக்குத் தேடுங்கள்', 'দোকান জন্য অনুসন্ধান করুন'),
('SEARCH FOR ITEMS', 'वस्तुओं के लिए खोज', 'ഇനങ്ങൾക്കായി തിരയുക', 'உருப்படிகளைத் தேடுங்கள்', 'আইটেম অনুসন্ধান করুন'),
('SEARCH', 'खोज', 'തിരയുക', 'தேடல்', 'অনুসন্ধান'),
('CURRY MASALAS', 'करी मसाले', 'കറി മസാലകൾ ', 'கறி மசாலா', 'কারি মাসআলা'),
('OILS', 'तेलों', 'എണ്ണകൾ', 'எண்ணெய்கள்', 'তেল'),
('WASHING SOAPS & POWDERS', 'धुलाई साबुन & पाउडर', 'വാഷിംഗ് സോപ്പ് & പൗഡർ ', 'வாஷிங் சோப்பு & தூள்', 'ধৌতকরণ সাবান & গুঁড়া'),
('CLEANERS', 'स्वच्छक', 'ക്ലീനേഴ്‌സ് ', 'கிளீனர்கள்', 'ক্লীনার্স'),
('SANITARY PRODUCTS', 'सैनिटरी उत्पाद', 'സാനിറ്ററി ഉൽപ്പന്നങ്ങൾ', 'சானிடரி ப்ராடக்ட்ஸ்', 'স্যানিটারি পণ্য'),
('BISCUITS', 'बिस्कुट', 'ബിസ്കറ്റുകൾ', 'பிஸ்கட்', 'বিস্কুট'),
('CHOCOLATES', 'चॉकलेट', 'ചോക്ലേറ്റ്സ്', 'சாக்கலேட்', 'চকোলেট'),
('PICKLES', 'अचार', 'അച്ചാറുകൾ', 'ஊறுகாய்', 'আচার'),
('HEALTH DRINKS', 'हेल्थ ड्रिंक्स', 'ഹെൽത്ത് ഡ്രിങ്ക്സ്', 'ஹெஅழ்த் ட்ரிங்க்ஸ் ', 'হেলথ ড্রিংকস'),
('GROCERY', 'किराना', 'പലചരക്ക്', 'மளிகை', 'মুদিখানা'),
('GHEE', 'घी', 'നെയ്യ്', 'நெய்', 'ঘি'),
('BODY CARE', 'बॉडी केयर ', 'ശരീര സംരക്ഷണം', 'சரீர கேர் ', 'বডি কেয়ার '),
('KITCHEN SOAPS & LIQUIDS', 'रसोई साबुन & लिक्विड', 'കിച്ചൻ സോപ്സ് & ലിക്വിഡ്സ് ', 'கிச்சன் சோப்பு & லிக்விட்', 'রান্নাঘর সাবান & লিকুইড'),
('SNACKS', 'स्नैक्स', 'ലഘുഭക്ഷണങ്ങൾ', 'சிற்றுண்டி', 'খাবার'),
('ORAL CARE', 'ओरल  केयर', 'ഓറൽ കെയർ', 'ஓரல் கேர் ', 'ওরাল কেয়ার '),
('OTHERS', 'अन्य', 'മറ്റുള്ളവ', 'மற்றவை', 'অন্য'),
('FOODVENO', 'फुडवेनो', 'ഫുഡ്‌വെനോ', 'ஃபுட்வெனோ', 'ফুডভেন্ও ');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationId` bigint NOT NULL,
  `title` varchar(1024) NOT NULL,
  `body` varchar(2048) NOT NULL,
  `sendDate` timestamp NOT NULL,
  `remarks` varchar(1024) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint NOT NULL,
  `orderId` bigint NOT NULL,
  `itemId` bigint NOT NULL,
  `quantity` int NOT NULL,
  `amount` double NOT NULL,
  `itemName` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `itemId`, `quantity`, `amount`, `itemName`) VALUES
(1, 1, 4, 1, 0, 'MUTTON KUZHIMANDHI FULL'),
(2, 2, 1, 2, 0, 'BLESSED HONEY 500g'),
(3, 3, 20, 1, 0, 'Hero Electric Atria Lx'),
(4, 4, 2, 2, 0, 'BLESSED BLACK SEED OIL 100ml'),
(5, 5, 22, 1, 0, 'Needle'),
(6, 6, 23, 1, 0, 'Cup'),
(7, 6, 22, 2, 0, 'Needle');

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping`
--

CREATE TABLE `order_shipping` (
  `orderShippingId` bigint NOT NULL,
  `orderId` bigint NOT NULL,
  `entryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(256) NOT NULL,
  `sellerName` varchar(128) NOT NULL,
  `location` varchar(128) NOT NULL,
  `pinCode` int NOT NULL,
  `shippingType` enum('LongShipping','ShortShipping') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `shippingStatus` enum('Ordered','Waiting for Confirmation from Seller','Processing','Packed','Shipped','Assigned to Deliveryboy','Item Collected From Seller','Delivered') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Ordered',
  `progressBarStatus` enum('Received','Assigned','Delivered','Cancelled') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Received',
  `remarks` varchar(128) NOT NULL,
  `priority` enum('1','2','3') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_shipping`
--

INSERT INTO `order_shipping` (`orderShippingId`, `orderId`, `entryDate`, `address`, `sellerName`, `location`, `pinCode`, `shippingType`, `shippingStatus`, `progressBarStatus`, `remarks`, `priority`) VALUES
(1, 1, '2021-07-28 23:06:47', 'vadakara town', 'KING HOTEL', '', 673561, NULL, 'Ordered', 'Cancelled', 'Your Order has been placed.', '1'),
(2, 1, '2021-07-29 23:29:46', '', '', '', 0, 'ShortShipping', 'Assigned to Deliveryboy', 'Cancelled', 'Order Has been Assigned to Siraj C A', '1'),
(3, 1, '2021-07-29 23:29:46', '', '', '', 0, 'ShortShipping', 'Item Collected From Seller', 'Cancelled', 'Order Has been Collected From Shop For more details Contact Deliver Boy on 7012314542', '1'),
(4, 2, '2021-07-30 12:10:08', 'NUT STREET VADAKARA', 'ACULIFE WELLNESS CENTER', '', 673104, NULL, 'Ordered', '', 'Your Order has been placed.', '1'),
(5, 3, '2021-07-31 18:25:26', 'Near Co-Operative Hospital Vadakara', 'NEXEBIZ ELECTRIC SCOOTERS', '', 673101, NULL, 'Ordered', '', 'Your Order has been placed.', '1'),
(6, 4, '2021-07-31 20:28:34', 'NUT STREET VADAKARA', 'ACULIFE WELLNESS CENTER', '', 673104, NULL, 'Ordered', 'Cancelled', 'Your Order has been placed.', '1'),
(7, 5, '2021-08-29 12:02:33', 'Nutstreet', 'Aculife acupuncture equipments', '', 673104, NULL, 'Ordered', '', 'Your Order has been placed.', '1'),
(8, 6, '2021-10-22 13:55:21', 'Nutstreet', 'Aculife acupuncture equipments', '', 673104, NULL, 'Ordered', '', 'Your Order has been placed.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `orderId` bigint NOT NULL,
  `orderHashId` varchar(256) NOT NULL,
  `userId` bigint NOT NULL,
  `shopId` bigint NOT NULL,
  `totalAmount` double NOT NULL DEFAULT '0',
  `paymentAmount` double NOT NULL DEFAULT '0',
  `discountAmount` double NOT NULL DEFAULT '0',
  `orderStatus` enum('Received','Assigned','Delivered','Cancelled') DEFAULT 'Received',
  `paymentMode` varchar(16) DEFAULT NULL,
  `deliveryFee` double NOT NULL DEFAULT '0',
  `packingCharge` double NOT NULL DEFAULT '0',
  `gst` double NOT NULL DEFAULT '0',
  `paymentStatus` enum('pending','processing','paid') NOT NULL DEFAULT 'pending',
  `transactionId` varchar(32) DEFAULT NULL,
  `deliveryTime` varchar(8) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `addressId` bigint NOT NULL,
  `deliveryBoyId` double NOT NULL DEFAULT '0',
  `shippingType` enum('LongShipping','ShortShipping') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `remark` varchar(128) DEFAULT NULL COMMENT 'Remark for Delivery Boy',
  `shopName` varchar(32) DEFAULT NULL,
  `userRemark` varchar(256) DEFAULT NULL COMMENT 'Customer Remark',
  `deliveryBoyCommission` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`orderId`, `orderHashId`, `userId`, `shopId`, `totalAmount`, `paymentAmount`, `discountAmount`, `orderStatus`, `paymentMode`, `deliveryFee`, `packingCharge`, `gst`, `paymentStatus`, `transactionId`, `deliveryTime`, `orderDate`, `entryDate`, `addressId`, `deliveryBoyId`, `shippingType`, `remark`, `shopName`, `userRemark`, `deliveryBoyCommission`) VALUES
(1, 'CWUSS799YCW1', 3, 2, 600, 728, 0, 'Cancelled', 'COD', 10, 10, 108, 'pending', 'COD_TRANSACTION', '23:30', '2021-07-28', '2021-07-28 23:06:47', 2, 0, 'ShortShipping', NULL, 'KING HOTEL', NULL, 0),
(2, 'D1EISYUE5QU2', 9, 1, 450, 450, 0, 'Cancelled', 'COD', 0, 0, 0, 'pending', 'COD_TRANSACTION', NULL, '2021-07-30', '2021-07-30 12:10:08', 3, 0, NULL, NULL, 'ACULIFE WELLNESS CENTER', NULL, 0),
(3, '6J6EMK8FRT13', 3, 3, 68000, 68000, 0, 'Cancelled', 'COD', 0, 0, 0, 'pending', 'COD_TRANSACTION', NULL, '2021-07-31', '2021-07-31 18:25:26', 2, 0, NULL, NULL, 'NEXEBIZ ELECTRIC SCOOTERS', NULL, 0),
(4, '8Q75LBMJU6W4', 3, 1, 585, 585, 0, 'Cancelled', 'COD', 0, 0, 0, 'pending', 'COD_TRANSACTION', '22:15', '2021-07-31', '2021-07-31 20:28:34', 2, 0, 'ShortShipping', NULL, 'ACULIFE WELLNESS CENTER', NULL, 0),
(5, 'ZY28D9NS57T5', 3, 6, 130, 171.5, 0, 'Received', 'COD', 25, 10, 6.5, 'pending', 'COD_TRANSACTION', NULL, '2021-08-29', '2021-08-29 12:02:33', 2, 0, NULL, NULL, 'Aculife acupuncture equipments', NULL, 0),
(6, 'RZPOM0FAVCQ6', 16, 6, 275, 323.75, 0, 'Received', 'COD', 25, 10, 13.75, 'pending', 'COD_TRANSACTION', NULL, '2021-10-22', '2021-10-22 13:55:21', 4, 0, NULL, NULL, 'Aculife acupuncture equipments', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_tag_delivery_boy`
--

CREATE TABLE `order_tag_delivery_boy` (
  `id` bigint NOT NULL,
  `deliveryBoyId` bigint NOT NULL DEFAULT '0',
  `orderId` bigint NOT NULL DEFAULT '0',
  `orderStatus` enum('Received','Assigned','Delivered','Cancelled') DEFAULT NULL,
  `entryDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tag_delivery_boy`
--

INSERT INTO `order_tag_delivery_boy` (`id`, `deliveryBoyId`, `orderId`, `orderStatus`, `entryDate`) VALUES
(1, 2, 1, 'Assigned', '2021-07-29 21:36:39'),
(2, 2, 1, 'Assigned', '2021-07-29 21:38:06'),
(3, 0, 1, 'Assigned', '2021-07-29 22:28:11'),
(4, 0, 1, 'Assigned', '2021-07-29 22:30:32'),
(5, 0, 1, 'Assigned', '2021-07-29 22:31:54'),
(6, 0, 1, 'Assigned', '2021-07-29 22:35:21'),
(7, 0, 1, 'Assigned', '2021-07-29 23:29:46'),
(8, 0, 4, 'Assigned', '2021-07-31 22:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `quick_cart`
--

CREATE TABLE `quick_cart` (
  `quickCartId` bigint NOT NULL,
  `quickItemId` bigint NOT NULL,
  `quickItemName` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `quickQuantity` int NOT NULL DEFAULT '0',
  `quickAmount` double NOT NULL,
  `quickEntryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cartFlag` int NOT NULL DEFAULT '1',
  `quickGst` double NOT NULL,
  `cartActiveItem` enum('OrderCancelled','OrderCompleted','ActiveOrder') NOT NULL DEFAULT 'ActiveOrder',
  `orderId` bigint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quick_items`
--

CREATE TABLE `quick_items` (
  `quickItemId` bigint NOT NULL,
  `quickShopId` bigint NOT NULL,
  `quickUserId` bigint NOT NULL,
  `quickName` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `thermalPrinterItems` varchar(32) NOT NULL,
  `quickItemType` enum('Veg','Non Veg','Egg','Else') NOT NULL DEFAULT 'Veg',
  `quickDescription` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `quickCategoryId` bigint NOT NULL COMMENT 'This is for ItemCategory',
  `quickSubCategoryId` bigint DEFAULT NULL,
  `quickImage` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `quickAvailabilityStatus` int NOT NULL COMMENT '1 for available 0 for not available',
  `quickPrice` double NOT NULL COMMENT 'MRP Price',
  `quickPurchasePrice` double NOT NULL COMMENT 'Purchase Price',
  `quickOfferPrice` double NOT NULL COMMENT 'Selling Price',
  `quickRecommendedItemFlag` int NOT NULL,
  `quickPopularItemFlag` int NOT NULL,
  `quickBestItemFlag` int NOT NULL DEFAULT '0',
  `quickBestItemImage` varchar(128) DEFAULT NULL,
  `quickEntryDate` datetime NOT NULL,
  `quickItemGst` double NOT NULL DEFAULT '0',
  `quickItemPriority` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quick_items`
--

INSERT INTO `quick_items` (`quickItemId`, `quickShopId`, `quickUserId`, `quickName`, `thermalPrinterItems`, `quickItemType`, `quickDescription`, `quickCategoryId`, `quickSubCategoryId`, `quickImage`, `quickAvailabilityStatus`, `quickPrice`, `quickPurchasePrice`, `quickOfferPrice`, `quickRecommendedItemFlag`, `quickPopularItemFlag`, `quickBestItemFlag`, `quickBestItemImage`, `quickEntryDate`, `quickItemGst`, `quickItemPriority`) VALUES
(1, 1, 1, '20-20(200g)', '20-20(200g)', 'Veg', '', 6, NULL, 'images/items/grocery/20_20.jpeg', 1, 20, 0, 20, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 1),
(2, 1, 1, '50-50(150g)', '50-50(150g)', 'Veg', '', 6, NULL, 'images/items/grocery/50-50.jpeg', 1, 20, 0, 20, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 2),
(3, 1, 1, 'UNIBIC(120g)', 'UNIBIC(120g)', 'Veg', '', 6, NULL, 'images/items/grocery/unibic.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 3),
(4, 1, 1, 'RUSK BRITANNIA', 'RUSK BRITANIA', 'Veg', '', 6, NULL, 'images/items/grocery/Britania_rusk.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 4),
(5, 1, 1, 'SUNFEAST DREAM(120g)', 'S F DREAM(120g)', 'Veg', '', 6, NULL, 'images/items/grocery/Sunfeast_dc.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 5),
(6, 1, 1, 'SUNFEAST CREAM(120g)', 'S F CREAM(120g)', 'Veg', '', 6, NULL, 'images/items/grocery/sf_dream_cream.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 6),
(7, 1, 1, 'TIGER(124g)', 'TIGER(124g)', 'Veg', '', 6, NULL, 'images/items/grocery/Tiger_biscuit.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 7),
(8, 1, 1, 'CHERUPAYAR PODI ANUS(35g)', 'CHERUPAYAR PODI', 'Veg', '', 10, NULL, 'images/items/grocery/Cherupayar.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 8),
(9, 1, 1, 'UJALA WASHING POWDER(115g)', 'UJALA W P(115g)', 'Veg', '', 3, NULL, 'images/items/grocery/ujala_soap_powder.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 9),
(10, 1, 1, 'EXO SCRUBBER(18g)', 'EXO SCRUBER', 'Veg', '', 13, NULL, 'images/items/grocery/Exo_scrubber.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 10),
(11, 1, 1, 'CHUK KAAPEE TASTY', 'CHUK KAPI', 'Veg', '', 10, NULL, 'images/items/grocery/Chukkukaappi.jpeg', 1, 8, 0, 8, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 11),
(12, 1, 1, 'LG KAYAM (50g)', 'LG KAYAM(50g)', 'Veg', '', 10, NULL, 'images/items/grocery/lg_kayam_pkt.jpeg', 1, 60, 0, 60, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 12),
(13, 1, 1, 'LG KAYAM ', 'LG KAYAM', 'Veg', '', 10, NULL, 'images/items/grocery/lg_kayam_pkt.jpeg', 0, 33, 0, 33, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 13),
(14, 1, 1, 'LOLIPOP REAL & TARWIN ', 'LOLIPOP', 'Veg', '', 7, NULL, 'images/items/grocery/lolipop.jpeg', 1, 2, 0, 2, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 14),
(15, 1, 1, 'DAHASHAMANI SHREE(25g)', 'DAHASHAMANI ', 'Veg', '', 10, NULL, 'images/items/grocery/dahashamani.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 15),
(16, 1, 1, 'PAMPERS (L)', 'PAMPERS(L)', 'Veg', '', 5, NULL, 'images/items/grocery/pampers.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 16),
(17, 1, 1, 'PAMPERS (M)', 'PAMPERS(M)', 'Veg', '', 5, NULL, 'images/items/grocery/pampers.jpeg', 1, 20, 0, 20, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 17),
(18, 1, 1, 'PAMPERS (S)', 'PAMPERS(S)', 'Veg', '', 5, NULL, 'images/items/grocery/pampers.jpeg', 1, 17, 0, 17, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 18),
(19, 1, 1, 'EASTERN  RASAM(100g)', 'ESTRN  RASAM', 'Veg', '', 1, NULL, 'images/items/grocery/e_rasam.jpeg', 1, 33, 0, 33, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 19),
(20, 1, 1, 'EASTERN GARAM MASALA(50g)', 'ESTRN GRM MASALA', 'Veg', '', 1, NULL, 'images/items/grocery/e_garam_masala.jpeg', 1, 33, 0, 33, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 20),
(21, 1, 1, 'EASTERN SAMBAR(100g)', 'ESTRN SAMBAR', 'Veg', '', 1, NULL, 'images/items/grocery/Saambarpodi.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 21),
(22, 1, 1, 'EASTERN MEAT(100g)', 'ESTRN MEAT', 'Veg', '', 1, NULL, 'images/items/grocery/meat_masala.jpeg', 1, 29, 0, 29, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 22),
(23, 1, 1, 'EASTERN CHICKEN(100g)', 'ESTRN CHICKEN', 'Veg', '', 1, NULL, 'images/items/grocery/Eastern_chicken_masala.jpeg', 1, 31, 0, 31, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 23),
(24, 1, 1, 'EASTERN FISH MASALA(100g)', 'ESTRN FISH MASALA', 'Veg', '', 1, NULL, 'images/items/grocery/e_fish_masla.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 24),
(25, 1, 1, 'EASTERN PICKLE(100g)', 'ESTRN PICKLE', 'Veg', '', 8, NULL, 'images/items/grocery/e_pickle.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 25),
(26, 1, 1, 'KISMIS PACKET(15gm)', 'KISMIS', 'Veg', '', 10, NULL, 'images/items/grocery/kismis.jpeg', 1, 13, 0, 13, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 26),
(27, 1, 1, 'CARDAMOM NATURAL', 'CARDAMOM ', 'Veg', '', 10, NULL, 'images/items/grocery/cardmon.jpeg', 1, 7, 0, 7, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 27),
(28, 1, 1, 'BIRIYANI MASALA TASTY BIG', 'BIRIYANI MASALA', 'Veg', '', 1, NULL, 'images/items/grocery/biriyani_masala_tasty.jpeg', 1, 15, 0, 15, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 28),
(29, 1, 1, 'HAND WASH MULLA(300ml)', 'HAND WASH MULLA', 'Veg', '', 12, NULL, 'images/items/grocery/hand_wash_mulla.jpeg', 1, 86, 0, 86, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 29),
(30, 1, 1, 'COMFORT(220ml)', 'COMFORT', 'Veg', '', 3, NULL, 'images/items/grocery/comfort_fabric_conditionor.jpeg', 1, 53, 0, 53, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 30),
(31, 1, 1, 'HARPIK (500ml)', 'HARPIK(500ml)', 'Veg', '', 4, NULL, 'images/items/grocery/harpic.jpeg', 1, 81, 0, 81, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 31),
(32, 1, 1, 'LIZOL(200ml)', 'LIZOL', 'Veg', '', 4, NULL, 'images/items/grocery/lizol.jpeg', 1, 35, 0, 35, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 32),
(33, 1, 1, 'HARPIK (200ml)', 'HARPIK(200ml)', 'Veg', '', 4, NULL, 'images/items/grocery/harpic.jpeg', 1, 35, 0, 35, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 33),
(34, 1, 1, 'RKG GHEE(100ml)', 'RKG GHEE(100ml)', 'Veg', '', 11, NULL, 'images/items/grocery/RKG.jpeg', 1, 72, 0, 72, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 34),
(35, 1, 1, 'RKG GHEE(50ml)', 'RKG GHEE(50ml)', 'Veg', '', 11, NULL, 'images/items/grocery/RKG.jpeg', 1, 36, 0, 36, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 35),
(36, 1, 1, 'SANITIZER LIFEBUOY(50ml)', 'SNTZR LIFEBUOY', 'Veg', '', 12, NULL, 'images/items/grocery/sanitizer_lifeboy.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 36),
(37, 1, 1, 'SANITIZER HYGIENIX(100ml)', 'SNTZR HYGIENIX', 'Veg', '', 12, NULL, 'images/items/grocery/sanitizer_hygenic.jpeg', 1, 46, 0, 46, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 37),
(38, 1, 1, 'HAND WASH DETTOL(250ml)', 'HAND WASH DETTOL', 'Veg', '', 12, NULL, 'images/items/grocery/dettol_hand_wash.jpeg', 1, 93, 0, 93, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 38),
(39, 1, 1, 'EASTERN BIRIYANI(100g) ', 'ESTRN BIRIYANI', 'Veg', '', 1, NULL, 'images/items/grocery/Eastern_biriyani_masala.jpeg', 1, 36, 0, 36, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 39),
(40, 1, 1, 'VIM LIQUID(155ml)', 'VIM LIQUID', 'Veg', '', 13, NULL, 'images/items/grocery/Vim_gel.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 40),
(41, 1, 1, 'MILMA GHEE(100ml)', 'MILMA GHEE(100ml)', 'Veg', '', 11, NULL, 'images/items/grocery/milma_ghee.jpeg', 1, 61, 0, 61, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 41),
(42, 1, 1, 'MILMA GHEE(50ml)', 'MILMA GHEE(50ml)', 'Veg', '', 11, NULL, 'images/items/grocery/milma_ghee.jpeg', 1, 34, 0, 34, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 42),
(43, 1, 1, 'RKG GHEE(200ml)', 'RKG GHEE(200ml)', 'Veg', '', 11, NULL, 'images/items/grocery/RKG.jpeg', 1, 116, 0, 116, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 43),
(44, 1, 1, 'LADIES COMB RAJA', 'LADIES COMB', 'Veg', '', 42, NULL, 'images/items/grocery/ladies_comb.jpeg', 1, 6, 0, 6, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 44),
(45, 1, 1, 'SUNLIGHT WASHING POWDER(125G)', 'SL WP(125G)', 'Veg', '', 3, NULL, 'images/items/grocery/Sunlight_washing_powder.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 45),
(46, 1, 1, 'SUNLIGHT WASHING POWDER(500g)', 'SUN L WP(500g)', 'Veg', '', 3, NULL, 'images/items/grocery/Sunlight_washing_powder.jpeg', 1, 39, 0, 39, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 46),
(47, 1, 1, 'UJALA WASHING POWDER(500g)', 'UJALA WP(500g)', 'Veg', '', 3, NULL, 'images/items/grocery/ujala_soap_powder.jpeg', 1, 37, 0, 37, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 47),
(48, 1, 1, 'MULLA WASING POWDER(300g)', 'MULLA WP(300g)', 'Veg', '', 3, NULL, 'images/items/grocery/Mulla.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 48),
(49, 1, 1, 'SURFEXCEL WASHING POWDER(500g)', 'SRFXL WP(500g)', 'Veg', '', 3, NULL, 'images/items/grocery/Surfexcel_washing_powder.jpeg', 1, 58, 0, 58, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 49),
(50, 1, 1, 'VANILA WASHING POWDER', 'VANILA WP', 'Veg', '', 3, NULL, 'images/items/grocery/vanila.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 50),
(51, 1, 1, 'VANILA WASHING POWDER(300g)', 'VANILA WP(300g)', 'Veg', '', 3, NULL, 'images/items/grocery/vanila.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 51),
(52, 1, 1, 'VANILA WASHING POWDER(500)', 'VANILA WP(500)', 'Veg', '', 3, NULL, 'images/items/grocery/vanila.jpeg', 1, 29, 0, 29, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 52),
(53, 1, 1, 'ARIEL (500)', 'ARIEL(500)', 'Veg', '', 3, NULL, 'images/items/grocery/Ariel_perfect_wash.jpeg', 1, 59, 0, 59, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 53),
(54, 1, 1, 'ARIEL PACKET(12g)', 'ARIEL PACKET', 'Veg', '', 3, NULL, 'images/items/grocery/ariel_packet.jpeg', 1, 22, 0, 22, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 54),
(55, 1, 1, 'EASTERN PEPPER(50g)', 'ESTRN PEPPER(50g)', 'Veg', '', 1, NULL, 'images/items/grocery/e_pepper.jpeg', 1, 27, 0, 27, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 55),
(56, 1, 1, 'PRIL (110ml)', 'PRIL(110ml)', 'Veg', '', 13, NULL, 'images/items/grocery/pril.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 56),
(57, 1, 1, 'EASTERN ULUVA (100g)', 'ESTRN ULUVA(100g)', 'Veg', '', 10, NULL, 'images/items/grocery/eastern_uluva.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 57),
(58, 1, 1, 'FREEK WASHING BAR(600g)', 'FREEK(600g)', 'Veg', '', 3, NULL, 'images/items/grocery/freek_soap.jpeg', 1, 27, 0, 27, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 58),
(59, 1, 1, 'EASTERN JEERA SMALL (50g)', 'ESTRN JEERA(50g)', 'Veg', '', 10, NULL, 'images/items/grocery/eastern_cumin.jpeg', 1, 14, 0, 14, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 59),
(60, 1, 1, 'KABANI WASHING BAR(550g)', 'KABANI(550g)', 'Veg', '', 3, NULL, 'images/items/grocery/kabani_bar.jpeg', 1, 32, 0, 32, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 60),
(61, 1, 1, 'COLOUR WHITE WASHING BAR(550g)', 'COLOR WHITE(550g)', 'Veg', '', 3, NULL, 'images/items/grocery/Colour_white.jpeg', 1, 31, 0, 31, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 61),
(62, 1, 1, 'MULLA WASHING BAR(550g)', 'MULLA(550g)', 'Veg', '', 3, NULL, 'images/items/grocery/mulla_xl_bar.jpeg', 1, 32, 0, 32, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 62),
(63, 1, 1, 'AJAY QUEST', 'AJAY QUEST', 'Veg', '', 15, NULL, 'images/items/grocery/ajay_quest.jpeg', 1, 16, 0, 16, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 63),
(64, 1, 1, 'EASTERN MUSTARD (100g)', 'ESTRN MUSTRD(100g)', 'Veg', '', 10, NULL, 'images/items/grocery/eastern_mustard.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 64),
(65, 1, 1, 'DARK CHOCO HEARTS', 'DARK CHOCOHRTS', 'Veg', '', 7, NULL, 'images/items/grocery/dark_choco_hearts.jpeg', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 65),
(66, 1, 1, 'DAIRY MILK', 'DAIRY MILK', 'Veg', '', 7, NULL, 'images/items/grocery/diary_milk.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 66),
(67, 1, 1, 'AMULYA MILK POWDER (200)', 'AMLYA MLKPWDR(200)', 'Veg', '', 10, NULL, 'images/items/grocery/amulya_milkpowder.jpeg', 1, 78, 0, 78, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 67),
(68, 1, 1, 'EVEREADY AA', 'EVEREADY AA', 'Veg', '', 42, NULL, 'images/items/grocery/eveready_battery_cells.jpeg', 1, 7, 0, 7, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 68),
(69, 1, 1, 'EVEREADY AAA YELLOW', 'EVEREADY YELLOW', 'Veg', '', 42, NULL, 'images/items/grocery/eveready_battery.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 69),
(70, 1, 1, 'HAPPY JAM (100g)', 'HAPPY JAM(100g)', 'Veg', '', 10, NULL, 'images/items/grocery/happy_mixed_fruit_jam.jpeg', 1, 22, 0, 22, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 70),
(71, 1, 1, 'AMULYA MILK POWDER (50g)', 'AMLYA MLKPWDR(50g)', 'Veg', '', 10, NULL, 'images/items/grocery/amulya_milkpowder.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 71),
(72, 1, 1, 'AMULYA MILK POWDER (100g)', 'AMLYA MLKPWDR(100)', 'Veg', '', 10, NULL, 'images/items/grocery/amulya_milkpowder.jpeg', 1, 39, 0, 39, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 72),
(73, 1, 1, 'OREO (120g)', 'OREO(120g)', 'Veg', '', 6, NULL, 'images/items/grocery/Oreo.jpeg', 1, 29, 0, 29, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 73),
(74, 1, 1, 'FINGER CAP ', 'FINGER CAP', 'Veg', '', 42, NULL, 'images/items/grocery/finger_cap.jpeg', 1, 8, 0, 8, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 74),
(75, 1, 1, 'RUBBERBAND PACK', 'RUBERBAND', 'Veg', '', 42, NULL, 'images/items/grocery/rubberband.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 75),
(76, 1, 1, 'WHISPER(6 Nos)', 'WHISPER(6Nos)', 'Veg', '', 5, NULL, 'images/items/grocery/whisper.jpeg', 1, 34, 0, 34, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 76),
(77, 1, 1, 'BOOST (200g)', 'BOOST(200g)', 'Veg', '', 9, NULL, 'images/items/grocery/BOOST.jpeg', 1, 107, 0, 107, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 77),
(78, 1, 1, 'HORLICKS (200g)', 'HORLICKS(200g)', 'Veg', '', 9, NULL, 'images/items/grocery/horlicks.jpeg', 1, 108, 0, 108, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 78),
(79, 1, 1, 'KADAK', 'KADAK', 'Veg', '', 42, NULL, 'images/items/grocery/kadak_ matches.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 79),
(80, 1, 1, 'KRAK JACK', 'KRAK JACK', 'Veg', '', 6, NULL, 'images/items/grocery/krack_jack.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 80),
(81, 1, 1, 'BOURBON PARLE(150g)', 'BOURBON', 'Veg', '', 6, NULL, 'images/items/grocery/Bourbon_biscuit.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 81),
(82, 1, 1, 'SUNFEAST MARIE', 'SUNFEAST MARIE', 'Veg', '', 6, NULL, 'images/items/grocery/marie_gold.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 82),
(83, 1, 1, 'GOLD 555 CAKE(150g)', 'GOLD 555 CAKE', 'Veg', '', 3, NULL, 'images/items/grocery/gold555.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 83),
(84, 1, 1, 'SUNFEAST MOMS MAGIC(120g)', 'MOMS MAGIC', 'Veg', '', 6, NULL, 'images/items/grocery/moms_magic.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 84),
(85, 1, 1, 'JOY RUSK(140g)', 'JOY RUSK(140g)', 'Veg', '', 6, NULL, 'images/items/grocery/joy_rusk.jpeg', 1, 17, 0, 17, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 85),
(86, 1, 1, 'SUNFEAST DARK FANTASY(75g)', 'DARK FANTASY(75g)', 'Veg', '', 6, NULL, 'images/items/grocery/Dark_fantasy.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 86),
(87, 1, 1, 'RUSK ELITE', 'RUSK ELITE', 'Veg', '', 6, NULL, 'images/items/grocery/elite_rusk.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 87),
(88, 1, 1, 'HIDE & SEEK(120g)', 'HIDE&SEEK(120g)', 'Veg', '', 6, NULL, 'images/items/grocery/Hide_and_seek.jpeg', 1, 28, 0, 28, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 88),
(89, 1, 1, 'NABATI(35g)', 'NABATI(35g)', 'Veg', '', 7, NULL, 'images/items/grocery/nabati.jpeg', 1, 8, 0, 8, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 89),
(90, 1, 1, 'YIPEE NOODELES(70g)', 'YIPEE NDLS(70g)', 'Veg', '', 14, NULL, 'images/items/grocery/Yippee_noodles.jpeg', 1, 12, 0, 12, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 90),
(91, 1, 1, 'PEANUT CHIKKI ALLWIN', 'PEANUT CHIKKI', 'Veg', '', 7, NULL, 'images/items/grocery/allwin_peanut.jpeg', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 91),
(92, 1, 1, 'MILKYBAR', 'MILKYBAR', 'Veg', '', 7, NULL, 'images/items/grocery/milkybar.jpeg', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 92),
(93, 1, 1, 'VICKS MITAAI', 'VICKS MITAI', 'Veg', '', 7, NULL, 'images/items/grocery/vicks_candy.jpeg', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 93),
(94, 1, 1, 'MOTHER TOMATO SAUCE', 'TOMATO SAUCE', 'Veg', '', 10, NULL, 'images/items/grocery/mother_birds_tomato_sauce.jpeg', 1, 25, 0, 25, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 94),
(95, 1, 1, 'BOOST (500)', 'BOOST(500)', 'Veg', '', 9, NULL, 'images/items/grocery/BOOST.jpeg', 1, 247, 0, 240, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 95),
(96, 1, 1, 'HORLICKS (500g)', 'HORLICKS(500g)', 'Veg', '', 9, NULL, 'images/items/grocery/horlicks.jpeg', 1, 233, 0, 233, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 96),
(97, 1, 1, 'OREO(45g)', 'OREO(45g)', 'Veg', '', 6, NULL, 'images/items/grocery/Oreo.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 97),
(98, 1, 1, 'ROSE WATER(59ml)', 'ROSE WATER', 'Veg', '', 12, NULL, 'images/items/grocery/rose_water.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 98),
(99, 1, 1, 'CLINIC PLUS(5ml)', 'CLINIC PLUS(5ml)', 'Veg', '', 12, NULL, 'images/items/grocery/c_plus.jpeg', 1, 14, 0, 14, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 99),
(100, 1, 1, 'SUN SILK(6ml)', 'SUN SILK', 'Veg', '', 12, NULL, 'images/items/grocery/sun_silk_shampoo.jpeg', 1, 14, 0, 14, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 100),
(101, 1, 1, 'CHIKS(6ml)', 'CHIK(6ml)', 'Veg', '', 12, NULL, 'images/items/grocery/chik_shampoo.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 101),
(102, 1, 1, 'COLGATE(20g)', 'COLGATE(20g)', 'Veg', '', 15, NULL, 'images/items/grocery/colgate.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 102),
(103, 1, 1, 'SUNLIGHT WASHING POWDER(150G)', 'SL WP(150G)', 'Veg', '', 3, NULL, 'images/items/grocery/Sunlight_washing_powder.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 103),
(104, 1, 1, 'PONDS (100 gm)', 'PONDS(100gm)', 'Veg', '', 12, NULL, 'images/items/grocery/ponds_powder.jpeg', 1, 103, 0, 103, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 104),
(105, 1, 1, 'CUTICURA TALC ORIGINAL (100 g)', 'CUTICURA(100g)', 'Veg', '', 12, NULL, 'images/items/grocery/cuticura_powder.jpeg', 1, 78, 0, 78, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 105),
(106, 1, 1, 'CUTICURA SMALL(25g)', 'CUTICURA(25g)', 'Veg', '', 12, NULL, 'images/items/grocery/cuticura_powder.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 106),
(107, 1, 1, 'RIN WASHING POWDER(150g)', 'RIN WP(150g)', 'Veg', '', 3, NULL, 'images/items/grocery/Rin.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:11', 0, 107),
(108, 1, 1, 'POWER WASHING SOAP(300g)', 'POWER W SOAP(300g)', 'Veg', '', 3, NULL, 'images/items/grocery/power_soap.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 108),
(109, 1, 1, 'DR WASH(200g)', 'DR WASH(200g)', 'Veg', '', 3, NULL, 'images/items/grocery/dr.wash_bar.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 109),
(110, 1, 1, 'SUNLIGHT WASHING SOAP(150g)', 'SL WASH SOP(150g)', 'Veg', '', 3, NULL, 'images/items/grocery/Sunlight_bar.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 110),
(111, 1, 1, 'OLIVIA SOAP(100g)', 'OLIVIA', 'Veg', '', 12, NULL, 'images/items/grocery/oliva_soap.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 111),
(112, 1, 1, 'KAIRALI SOAP(100g)', 'KAIRALI', 'Veg', '', 12, NULL, 'images/items/grocery/kairali_soap.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 112),
(113, 1, 1, 'DOVE SOAP (100g)', 'DOVE(100g)', 'Veg', '', 12, NULL, 'images/items/grocery/dove_soap.jpeg', 1, 43, 0, 43, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 113),
(114, 1, 1, 'LIFEBUOY(56g) ', 'LIFEBUOY(56g)', 'Veg', '', 12, NULL, 'images/items/grocery/Lifebuoy.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 114),
(115, 1, 1, 'MEDIMIX(75g)', 'MEDIMIX', 'Veg', '', 12, NULL, 'images/items/grocery/Medimix.jpeg', 1, 25, 0, 25, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 115),
(116, 1, 1, 'CHANDRIKA(75g)', 'CHANDRIKA(75g)', 'Veg', '', 12, NULL, 'images/items/grocery/chandrika.jpeg', 1, 25, 0, 25, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 116),
(117, 1, 1, 'AMRUT', 'AMRUT', 'Veg', '', 12, NULL, 'images/items/grocery/amrut_soap.jpeg', 1, 38, 0, 38, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 117),
(118, 1, 1, 'LUX(100G)', 'LUX(100G)', 'Veg', '', 12, NULL, 'images/items/grocery/lux_soap.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 118),
(119, 1, 1, 'LIFEBUOY (125g)', 'LIFEBUOY(125g)', 'Veg', '', 12, NULL, 'images/items/grocery/Lifebuoy.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 119),
(120, 1, 1, 'SANTHOOR(100G)', 'SANTHOOR', 'Veg', '', 12, NULL, 'images/items/grocery/santoor_soap.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 120),
(121, 1, 1, 'PEARS(100G)', 'PEARS', 'Veg', '', 12, NULL, 'images/items/grocery/Pears.jpeg', 1, 36, 0, 36, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 121),
(122, 1, 1, 'DOVE SOAP (50g)', 'DOVE SOAP(50g)', 'Veg', '', 12, NULL, 'images/items/grocery/dove_soap.jpeg', 1, 21, 0, 21, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 122),
(123, 1, 1, 'VIM (85g)', 'VIM(85g)', 'Veg', '', 13, NULL, 'images/items/grocery/vim.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 123),
(124, 1, 1, 'VIM (150g)', 'VIM(150g)', 'Veg', '', 13, NULL, 'images/items/grocery/vim.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 124),
(125, 1, 1, 'EXO (120g+20g)', 'EXO(120g+20g)', 'Veg', '', 13, NULL, 'images/items/grocery/Exo_bar.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 125),
(126, 1, 1, 'EXO (70g+20g)', 'EXO(70g+20g)', 'Veg', '', 13, NULL, 'images/items/grocery/Exo_bar.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 126),
(127, 1, 1, 'UJALA SUPREME(75ml)', 'UJALA SUPREME', 'Veg', '', 3, NULL, 'images/items/grocery/Ujala_suprem.jpeg', 1, 24, 0, 24, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 127),
(128, 1, 1, 'CHIK(35ml)', 'CHIK(35ml)', 'Veg', '', 12, NULL, 'images/items/grocery/chik_shampoo.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 128),
(129, 1, 1, 'CLINIC PLUS (40ml)', 'CLINIC PLUS(40ml)', 'Veg', '', 12, NULL, 'images/items/grocery/clinic_plus.jpeg', 1, 10, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 129),
(130, 1, 1, 'COLGATE (45g)', 'COLGATE(45g)', 'Veg', '', 15, NULL, 'images/items/grocery/colgate.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 130),
(131, 1, 1, 'COLGATE (100)', 'COLGATE(100)', 'Veg', '', 15, NULL, 'images/items/grocery/colgate.jpeg', 1, 49, 0, 49, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 131),
(132, 1, 1, 'DABUR (50g)', 'DABUR(50g)', 'Veg', '', 15, NULL, 'images/items/grocery/dabur_toothpaste.jpeg', 1, 45, 0, 45, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 132),
(133, 1, 1, 'KP NAMBOODIRI PASTE (50g)', 'KPN PASTE(50g)', 'Veg', '', 15, NULL, 'images/items/grocery/kpn_paste.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 133),
(134, 1, 1, 'KP NAMBOODIRI PASTE (100g)', 'KPN PASTE(100g)', 'Veg', '', 15, NULL, 'images/items/grocery/kpn_paste.jpeg', 1, 44, 0, 44, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 134),
(135, 1, 1, 'CLOSE UP (40g)', 'CLOSE UP(40g)', 'Veg', '', 15, NULL, 'images/items/grocery/close_up.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 135),
(136, 1, 1, 'CLOSE UP (96g)', 'CLOSE UP(96g)', 'Veg', '', 15, NULL, 'images/items/grocery/close_up.jpeg', 1, 46, 0, 46, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 136),
(137, 1, 1, 'CIBACA (80g)', 'CIBACA(80g)', 'Veg', '', 15, NULL, 'images/items/grocery/colgate_cibaca.jpeg', 1, 29, 0, 29, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 137),
(138, 1, 1, 'SCRUBBER EXO GREEN(1 pck)', 'SCRUBER EXO GRN', 'Veg', '', 13, NULL, 'images/items/grocery/Exo_scrubber.jpeg', 1, 12, 0, 12, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 138),
(139, 1, 1, 'SLEEP WELL(1 pck)', 'SLEEP WELL', 'Veg', '', 42, NULL, 'images/items/grocery/sleep_well_agarbathi.jpeg', 1, 13, 0, 13, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 139),
(140, 1, 1, 'TRIVENI(1 pck)', 'TRIVENI', 'Veg', '', 42, NULL, 'images/items/grocery/triveni_agarbathi.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 140),
(141, 1, 1, '3 IN ONE(1 pck)', '3 IN ONE', 'Veg', '', 42, NULL, 'images/items/grocery/3_in_1.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 141),
(142, 1, 1, 'DOVE SHAMPHOO(8ml)', 'DOVE SHAMPOO', 'Veg', '', 12, NULL, 'images/items/grocery/dove_shampoo.jpeg', 1, 4, 0, 4, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 142),
(143, 1, 1, 'HORLICKS (SMALL PACK) 15g', 'HORLICKS PACK', 'Veg', '', 9, NULL, 'images/items/grocery/horlicks_packet.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 143),
(144, 1, 1, 'BOOST (SMALL PACK) 15g', 'BOOST PACK', 'Veg', '', 9, NULL, 'images/items/grocery/boost_packet.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 144),
(145, 1, 1, 'NOOL (ANNA)', 'NOOL(ANNA)', 'Veg', '', 42, NULL, 'images/items/grocery/nool.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 145),
(146, 1, 1, 'STAP PLAYER PIN (100 Nos)', 'STAPLAYER PIN', 'Veg', '', 42, NULL, 'images/items/grocery/stayplayer_pin.jpeg', 1, 6, 0, 6, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 146),
(147, 1, 1, 'STAP MACHINE KANGARU', 'STAP MACHINE', 'Veg', '', 42, NULL, 'images/items/grocery/stapler_machine.jpeg', 1, 34, 0, 34, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 147),
(148, 1, 1, 'BELL PIN SMALL', 'BELL PIN SMALL', 'Veg', '', 42, NULL, 'images/items/grocery/bell_pins.jpeg', 1, 8, 0, 8, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 148),
(149, 1, 1, 'EXO ROUND(250g)', 'EXO ROUND(250g)', 'Veg', '', 13, NULL, 'images/items/grocery/Exo_round.jpeg', 1, 25, 0, 25, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 149),
(150, 1, 1, 'CINTHOL', 'CINTHOL', 'Veg', '', 12, NULL, 'images/items/grocery/cinthol_soap.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 150),
(151, 1, 1, 'CUTEE SOAP(100g)', 'CUTEE ', 'Veg', '', 12, NULL, 'images/items/grocery/cutee_soap.jpeg', 1, 17, 0, 17, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 151),
(152, 1, 1, 'VIVEL(51g)', 'VIVEL', 'Veg', '', 12, NULL, 'images/items/grocery/vivel_soap.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 152),
(153, 1, 1, 'JO SOAP(57g)', 'JO', 'Veg', '', 12, NULL, 'images/items/grocery/jo_soap.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 153),
(154, 1, 1, 'BELL PIN BIG (1 pck)', 'BELL PIN', 'Veg', '', 42, NULL, 'images/items/grocery/bell_pins.jpeg', 1, 6, 0, 6, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 154),
(155, 1, 1, 'OATS BAGGRYS (500g)', 'OATS', 'Veg', '', 9, NULL, 'images/items/grocery/oats_baggrys.jpeg', 1, 89, 0, 89, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 155),
(156, 1, 1, '505 CAMPHOR(15g)', '505 CAMPHOR', 'Veg', '', 42, NULL, 'images/items/grocery/505_camphor.jpeg', 1, 23, 0, 23, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 156),
(157, 1, 1, 'FEVIGUM', 'FEVIGUM', 'Veg', '', 42, NULL, 'images/items/grocery/fevigum.jpeg', 1, 5, 0, 5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 157),
(158, 1, 1, 'SAMIO BAMBINO (325g)', 'SAMI BAMBNO(325g)', 'Veg', '', 14, NULL, 'images/items/grocery/bambino_pack500.jpeg', 1, 29, 0, 29, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 158),
(159, 1, 1, 'SAMIO BAMBINO (150g)', 'SAMI BAMBNO(150g)', 'Veg', '', 14, NULL, 'images/items/grocery/Bambino_Vermicelli.jpeg', 1, 13, 0, 13, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 159),
(160, 1, 1, 'SAFETY PIN STYLE', 'SAFETY PIN', 'Veg', '', 42, NULL, 'images/items/grocery/safety_pin.jpeg', 1, 30, 0, 13.5, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 160),
(161, 1, 1, 'LIGHTER', 'LIGHTER', 'Veg', '', 42, NULL, 'images/items/grocery/lighter.jpeg', 1, 6, 0, 6, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 161),
(162, 1, 1, 'CHARAD KETT BIG', 'CHARAD KETT', 'Veg', '', 42, NULL, 'images/items/grocery/charad.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 162),
(163, 1, 1, 'INSULATION TAP', 'INSULATION TAP', 'Veg', '', 42, NULL, 'images/items/grocery/insulation.jpeg', 1, 7, 0, 7, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 163),
(164, 1, 1, 'NATARAJ PENCIL', 'NTRJ PENCIL', 'Veg', '', 42, NULL, 'images/items/grocery/nat_pencil.jpeg', 1, 4, 0, 4, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 164),
(165, 1, 1, 'NATARAJ RUBBER', 'NTRJ RUBBER', 'Veg', '', 42, NULL, 'images/items/grocery/nat_rubber.jpeg', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 165),
(166, 1, 1, 'NATARAJ  CUTTER', 'NTRJ  CUTTER', 'Veg', '', 42, NULL, 'images/items/grocery/nat_cutter.jpeg', 1, 3, 0, 3, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 166),
(167, 1, 1, 'NATARAJ SCALE SMALL', 'NTRJ SCALE SMALL', 'Veg', '', 42, NULL, 'images/items/grocery/nat_scale.jpeg', 1, 4, 0, 4, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 167),
(168, 1, 1, 'P COMB', 'P COMB', 'Veg', '', 42, NULL, 'images/items/grocery/ladies_comb.jpeg', 1, 2, 0, 2, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 168),
(169, 1, 1, 'P COMB ROUND MAGIC', 'P COMB ROUND', 'Veg', '', 42, NULL, 'images/items/grocery/comb_round.jpeg', 1, 6, 0, 6, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 169),
(170, 1, 1, 'TOILET CLEANER ROUND MATIZ', 'TOILET CLEANER', 'Veg', '', 4, NULL, 'images/items/grocery/grocery.jpeg', 0, 21, 0, 21, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 170),
(171, 1, 1, 'LIBERTY PALM OIL (200 ml)', 'LBRTY PALMOIL(200)', 'Veg', '', 2, NULL, 'images/items/grocery/Parisons_liberty.jpeg', 1, 23, 0, 23, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 171),
(172, 1, 1, 'LIBERTY PALM OIL (500 ml)', 'LBRTY PALMOIL(500', 'Veg', '', 2, NULL, 'images/items/grocery/Parisons_liberty.jpeg', 1, 56, 0, 56, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 172),
(173, 1, 1, 'LIBERTY PALM OIL (1 L)', 'LBRTY PALMOIL(1L)', 'Veg', '', 2, NULL, 'images/items/grocery/Parisons_liberty.jpeg', 1, 110, 0, 110, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 173),
(174, 1, 1, 'DALDA KADUKENNA (500 ml)', 'DALDA KADUKENNA', 'Veg', '', 2, NULL, 'images/items/grocery/dalda_mustardoil.jpeg', 1, 79, 0, 79, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 174),
(175, 1, 1, 'ESSENCE (100 ml)', 'ESSENCE(100ml)', 'Veg', '', 10, NULL, 'images/items/grocery/essence.jpeg', 1, 18, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 175),
(176, 1, 1, 'AVT PRM (100g)', 'AVT PRM(100g)', 'Veg', '', 10, NULL, 'images/items/grocery/AVT.jpeg', 1, 30, 0, 30, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 176),
(177, 1, 1, 'KANNAN DEVAN (100 gm)', 'KANNAN DEVN(100g)', 'Veg', '', 10, NULL, 'images/items/grocery/Kannan_devan.jpeg', 1, 31, 0, 31, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 177),
(178, 1, 1, 'AVT PRM(35g)', 'AVT PRM(35g)', 'Veg', '', 10, NULL, 'images/items/grocery/AVT.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 178),
(179, 1, 1, 'KANNAN DEVAN(35g)', 'KANNAN DEVN(35g)', 'Veg', '', 10, NULL, 'images/items/grocery/Kannan_devan.jpeg', 1, 9, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 179),
(180, 1, 1, 'RAVA SAICO(500g)', 'RAVA SAICO(500g)', 'Veg', '', 10, NULL, 'images/items/grocery/saico_rava.jpeg', 1, 26, 0, 26, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 180),
(181, 1, 1, 'RAVA HINDUSTHAN(500g)', 'RAVA HINDUSTN(500)', 'Veg', '', 10, NULL, 'images/items/grocery/rava_hindustan.jpeg', 1, 20, 0, 20, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 181),
(182, 1, 1, 'BUDS GUND WOOD', 'BUDS ', 'Veg', '', 42, NULL, 'images/items/grocery/ear_buds.jpeg', 1, 7, 0, 7, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 182),
(183, 1, 1, 'SAICO VINAGIRI (500 ml)', 'VINAGIRI(500ml)', 'Veg', '', 10, NULL, 'images/items/grocery/saico_vinegar.jpeg', 1, 13, 0, 13, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 183),
(184, 1, 1, 'PENOIL DOCTORS (450ml)', 'PENOIL(450ml)', 'Veg', '', 4, NULL, 'images/items/grocery/Phenoyle.jpeg', 1, 58, 0, 58, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 184),
(185, 1, 1, 'UJALA SUPREME(200ml)', 'UJALA SUPRM(200ml)', 'Veg', '', 3, NULL, 'images/items/grocery/Ujala_suprem.jpeg', 0, 23, 0, 23, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 185),
(186, 1, 1, 'UJALA KING(250ml)', 'UJALA KING(250ml)', 'Veg', '', 3, NULL, 'images/items/grocery/Ujala_suprem.jpeg', 1, 65, 0, 65, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 186),
(187, 1, 1, 'AASHIRVAAD ATTA (1 kg)', 'ASHRVD ATTA(1kg)', 'Veg', '', 10, NULL, 'images/items/grocery/Aashirvaad_aatta.jpeg', 1, 54, 0, 54, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 187),
(188, 1, 1, 'LIBERTY ATTA(1 kg)', 'LBRTY ATTA(1kg)', 'Veg', '', 10, NULL, 'images/items/grocery/aatta.jpeg', 1, 34, 0, 34, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 188),
(189, 1, 1, 'PICKLE MAHARANI (200G)', 'PCKL MAHARANI(200)', 'Veg', '', 8, NULL, 'images/items/grocery/maharani_pickle.jpeg', 1, 30, 0, 22, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 189),
(190, 1, 1, 'KP NAMBOOTHIRI POWDER (15g)', 'KPN PWDR(15g)', 'Veg', '', 15, NULL, 'images/items/grocery/kpnamboothiri.jpeg', 1, 10, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 190),
(191, 1, 1, 'KP NAMBOOTHIRI POWDER YELLOW(40g', 'KPN PWDR YLW(40g)', 'Veg', '', 15, NULL, 'images/items/grocery/kp_namboothiri.jpeg', 1, 22, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 191),
(192, 1, 1, 'KP NAMBOOTHIRI POWDER GREEN(40g)', 'KPN PWDR GRN(40g)', 'Veg', '', 15, NULL, 'images/items/grocery/kp_namboothiri.jpeg', 1, 28, 0, 25, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 192),
(193, 1, 1, 'VELAKKENNA NIRADEEPAM(500ml)', 'VELAKKENNA', 'Veg', '', 2, NULL, 'images/items/grocery/niradeepam.jpeg', 1, 67, 0, 67, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 193),
(194, 1, 1, 'AJMI PUTTPODI(1 kg)', 'AJMI PUTTPODI', 'Veg', '', 10, NULL, 'images/items/grocery/Ajmi_puttupodi.jpeg', 1, 50, 0, 50, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 194),
(195, 1, 1, 'SAICO VINAGIRI (1L)', 'SAICO VINAGIRI ', 'Veg', '', 10, NULL, 'images/items/grocery/saico_vinegar1.jpeg', 1, 19, 0, 19, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 195),
(196, 1, 1, 'DALDA (500)', 'DALDA(500)', 'Veg', '', 11, NULL, 'images/items/grocery/dalda.jpeg', 1, 62, 0, 62, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 196),
(197, 1, 1, 'DALDA (100)', 'DALDA(100)', 'Veg', '', 11, NULL, 'images/items/grocery/dalda.jpeg', 1, 14, 0, 14, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 197),
(198, 1, 1, 'DALDA (200)', 'DALDA(200)', 'Veg', '', 11, NULL, 'images/items/grocery/dalda.jpeg', 1, 27, 0, 27, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 198),
(199, 1, 1, 'EASTERN TURMERIC(100g)', 'ESTRN TURMERIC', 'Veg', '', 1, NULL, 'images/items/grocery/Eastern_manjalpodi.jpeg', 1, 16, 0, 16, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 199),
(200, 1, 1, 'EASTERN CHILLY(100g)', 'ESTRN CHILLY', 'Veg', '', 1, NULL, 'images/items/grocery/Eastern_mulakupodi.jpeg', 1, 22, 0, 22, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 200),
(201, 1, 1, 'EASTERN  CORIANDER(100g)', 'ESTRN  CORIANDER', 'Veg', '', 1, NULL, 'images/items/grocery/Eastern_mallipodi.jpeg', 1, 15, 0, 15, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 201),
(202, 1, 1, 'LIBERTY SUNFLOWER OIL(500 ml)', 'LBRTY SF OIL(500ml)', 'Veg', '', 2, NULL, 'images/items/grocery/parisons_libertysfoil.jpeg', 1, 67, 0, 67, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 202),
(203, 1, 1, 'LIBERTY SUNFLOWER OIL (1L)', 'LBRTY SF OIL(1L)', 'Veg', '', 2, NULL, 'images/items/grocery/parisons_libertysfoil1.jpeg', 1, 131, 0, 131, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 203),
(204, 1, 1, 'SWARNAM (100 ml)', 'SWARNAM(100ml)', 'Veg', '', 2, NULL, 'images/items/grocery/swarnam_nallenna.jpeg', 1, 21, 0, 21, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 204),
(205, 1, 1, 'SWARNAM (200 ml)', 'SWARNAM(200ml)', 'Veg', '', 2, NULL, 'images/items/grocery/swarnam_nallenna.jpeg', 1, 31, 0, 31, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 205),
(206, 1, 1, 'SWARNAM (500 ml)', 'SWARNAM (500ml)', 'Veg', '', 2, NULL, 'images/items/grocery/swarnam_nallenna.jpeg', 1, 89, 0, 89, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 206),
(207, 1, 1, 'RG NALLENNA(100 ml)', 'RG NALLENNA(100ml)', 'Veg', '', 2, NULL, 'images/items/grocery/RG.jpeg', 1, 20, 0, 20, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 207),
(208, 1, 1, 'RG NALLENNA(200 ml)', 'RG NALLENNA(200ml)', 'Veg', '', 2, NULL, 'images/items/grocery/RG.jpeg', 1, 38, 0, 38, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 208),
(209, 1, 1, 'RG NALLENNA(500 ml)', 'RG NALLENNA(500ml)', 'Veg', '', 2, NULL, 'images/items/grocery/RG.jpeg', 1, 85, 0, 85, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 209),
(210, 1, 1, 'VICKS (10ml)', 'VICKS(10ml)', 'Veg', '', 42, NULL, 'images/items/grocery/VICKS1.jpeg', 1, 38, 0, 33, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 210),
(211, 1, 1, 'TIGER BALM (9ml)', 'TIGER BALM(9ml)', 'Veg', '', 42, NULL, 'images/items/grocery/tiger_balm.jpeg', 1, 44, 0, 44, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 211),
(212, 1, 1, 'VICKS (5ml)', 'VICKS(5ml)', 'Veg', '', 42, NULL, 'images/items/grocery/VICKS.jpeg', 0, 20, 0, 18, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 212),
(213, 1, 1, 'NEEDLES', 'NEEDLES', 'Veg', '', 42, NULL, 'images/items/grocery/needles.jpeg', 1, 13, 0, 13, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 213),
(214, 1, 1, 'M NEEDLES', 'M NEEDLES', 'Veg', '', 42, NULL, 'images/items/grocery/needles.jpeg', 1, 7, 0, 7, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 214),
(215, 1, 1, 'ചെറുപഴർ (1kg)', 'CHERUPAYAR', 'Veg', '', 10, NULL, 'images/items/grocery/Cherupayar.jpeg', 1, 99, 0, 99, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 215),
(216, 1, 1, 'ഉഴുന്ന് പരിപ്പ്(1kg)', 'UZHUNN PARIP', 'Veg', '', 10, NULL, 'images/items/grocery/Uzhunn_parip.jpeg', 1, 106, 0, 106, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 216),
(217, 1, 1, 'വൻപഴർ(1kg)', 'VANPAYAR', 'Veg', '', 10, NULL, 'images/items/grocery/Vanpayar.jpeg', 1, 76, 0, 76, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 217),
(218, 1, 1, 'തുവരപരിപ്പ്(1kg)', 'THUVARA PARIP', 'Veg', '', 10, NULL, 'images/items/grocery/Thuvara_parip.jpeg', 1, 106, 0, 106, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 218),
(219, 1, 1, 'വെള്ളക്കടല(1kg)', 'VELLA KADALA', 'Veg', '', 10, NULL, 'images/items/grocery/vellakkadala.jpeg', 1, 86, 0, 86, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 219),
(220, 1, 1, 'പട്ടാണി(1kg)', 'PATTAANI', 'Veg', '', 10, NULL, 'images/items/grocery/Pattaani.jpeg', 1, 141, 0, 141, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 220),
(221, 1, 1, 'മുതിര(1kg)', 'MUDHIRA', 'Veg', '', 10, NULL, 'images/items/grocery/Mudhira.jpeg', 1, 41, 0, 41, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 221),
(222, 1, 1, 'നുറുക്കരി(1kg)', 'NURUKKARI', 'Veg', '', 10, NULL, 'images/items/grocery/Nurukk_godhamb.jpeg', 1, 41, 0, 41, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 222),
(223, 1, 1, 'കഞ്ഞി അരി(1kg)', 'KANJI ARI', 'Veg', '', 10, NULL, 'images/items/grocery/Nurukkari.jpeg', 1, 43, 0, 43, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 223),
(224, 1, 1, 'കടലപ്പൊടി(1kg)', 'KADALAPPODI', 'Veg', '', 10, NULL, 'images/items/grocery/Kadalappodi1.jpeg', 1, 86, 0, 86, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 224),
(225, 1, 1, 'സാധാ ജീരകം(1kg)', 'JEERAKAM', 'Veg', '', 10, NULL, 'images/items/grocery/jeerakam.jpeg', 1, 23, 0, 23, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 225),
(226, 1, 1, 'കടല(1kg)', 'KADALA', 'Veg', '', 10, NULL, 'images/items/grocery/Kadala.jpeg', 1, 73, 0, 73, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 226),
(227, 1, 1, 'മുളക്(1kg)', 'MULAK', 'Veg', '', 10, NULL, 'images/items/grocery/Mulak.jpeg', 1, 151, 0, 148, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 227),
(228, 1, 1, 'മല്ലി(1kg)', 'MALLY', 'Veg', '', 10, NULL, 'images/items/grocery/Malli.jpeg', 1, 91, 0, 91, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 228),
(229, 1, 1, 'അണ്ടി പരിപ്പ്(1kg)', 'ANDIPARIP', 'Veg', '', 10, NULL, 'images/items/grocery/cashew.jpeg', 1, 63, 0, 63, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 229),
(230, 1, 1, 'മുന്തിരി(1kg)', 'MUNDHIRI', 'Veg', '', 10, NULL, 'images/items/grocery/kismis.jpeg', 1, 230, 0, 230, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 230),
(231, 1, 1, 'വലിയ ഉള്ളി (1kg)', 'VALIYA ULLI', 'Veg', '', 10, NULL, 'images/items/grocery/ONION.jpeg', 1, 38, 0, 38, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 231),
(232, 1, 1, 'ചെറിയ ഉള്ളി (1kg)', 'CHERIYA ULLI', 'Veg', '', 10, NULL, 'images/items/grocery/CHERIYA_ULLI.jpeg', 1, 80, 0, 80, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 232),
(233, 1, 1, 'സോയാബീൻ (SMALL)(1kg)', 'SOYABEAN', 'Veg', '', 10, NULL, 'images/items/grocery/soyabean.jpeg', 1, 90, 0, 85, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 233),
(234, 1, 1, 'ശർക്കര(1kg)', 'SHARKKARA', 'Veg', '', 10, NULL, 'images/items/grocery/Sharkkara.jpeg', 1, 49, 0, 48, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 234),
(235, 1, 1, 'പഞ്ചസാര (1kg)', 'PANCHASARA', 'Veg', '', 10, NULL, 'images/items/grocery/panjasaara.jpeg', 1, 37, 0, 37, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 235),
(236, 1, 1, 'ഉപ്പ്പൊടി(1kg)', 'UPP PODI', 'Veg', '', 10, NULL, 'images/items/grocery/uppupodi.jpeg', 1, 18, 0, 10, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 236),
(237, 1, 1, 'കല്ലുപ്പ്(1kg)', 'KALLUPP', 'Veg', '', 10, NULL, 'images/items/grocery/Kallupp.jpeg', 1, 10, 0, 9, 0, 0, 0, NULL, '2021-01-06 16:54:12', 0, 237),
(399, 1, 1, 'അരി  (കുറുവ  ജമന്തി )', 'KURUVA JAMANDHI', 'Veg', '', 10, NULL, 'images/items/grocery/rice.jpeg', 1, 32, 0, 32, 0, 0, 0, NULL, '2021-01-14 17:34:47', 0, 10),
(400, 1, 1, 'അരി (പൊന്നി) ', 'PONNI', 'Veg', '', 10, NULL, 'images/items/grocery/rice1.jpeg', 1, 41, 0, 39, 0, 0, 0, NULL, '2021-01-14 17:37:36', 0, 11),
(401, 1, 1, 'അരി (കയമ)', 'KAYAMA', 'Veg', '', 10, NULL, 'images/items/grocery/rice2.jpeg', 1, 92, 0, 92, 0, 0, 0, NULL, '2021-01-14 17:38:26', 0, 13),
(441, 1, 1, 'EXO ROUND (500g)', 'EXO ROUND(500g)', 'Veg', '', 4, NULL, 'images/items/grocery/Exo_round1.jpeg', 1, 48, 0, 46, 0, 0, 0, NULL, '2021-02-04 13:03:46', 0, 40);

-- --------------------------------------------------------

--
-- Table structure for table `quick_order`
--

CREATE TABLE `quick_order` (
  `orderId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `shopId` bigint NOT NULL,
  `orderAmount` double NOT NULL,
  `deliveryFee` double NOT NULL,
  `paymentAmount` double NOT NULL,
  `quickGst` double NOT NULL,
  `paymentMode` varchar(16) NOT NULL,
  `orderSummary` enum('OrderCancelled','OrderCompleted','ActiveOrder') NOT NULL,
  `orderEntryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopId` bigint NOT NULL,
  `userId` bigint NOT NULL,
  `name` varchar(64) NOT NULL,
  `restaurantType` int NOT NULL COMMENT '0 for veg and 1 for non veg',
  `minimumOrder` double NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `location` varchar(512) NOT NULL,
  `pinCode` int NOT NULL,
  `latitude` varchar(32) DEFAULT NULL,
  `longitude` varchar(32) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `bannerImage` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `deliveryTime` time DEFAULT NULL,
  `deliveryFee` double NOT NULL DEFAULT '0',
  `deliveryBaseAmount` double NOT NULL DEFAULT '0' COMMENT 'Per kilometer ',
  `packingCharge` double NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '1' COMMENT '1-for active and 0- for InActive',
  `shopGst` double NOT NULL DEFAULT '0',
  `shopCategoryId` bigint NOT NULL DEFAULT '0',
  `shopType` int NOT NULL DEFAULT '0' COMMENT '0->for restaurant, 1-> for gocery',
  `publishFlag` int NOT NULL DEFAULT '0' COMMENT '0 for not published, 1 for published',
  `shopEmailId` varchar(64) DEFAULT 'order@ebaazaarweb.com',
  `shopMobile` varchar(64) NOT NULL,
  `shopLandline` varchar(64) NOT NULL,
  `shopPriority` bigint NOT NULL DEFAULT '0',
  `dailyNeedsFlag` int NOT NULL DEFAULT '0' COMMENT '0 for Normal Shop, 1 for Daily Needs Shop',
  `deliveryFeeBaseKM` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopId`, `userId`, `name`, `restaurantType`, `minimumOrder`, `address`, `location`, `pinCode`, `latitude`, `longitude`, `image`, `bannerImage`, `entryDate`, `deliveryTime`, `deliveryFee`, `deliveryBaseAmount`, `packingCharge`, `active`, `shopGst`, `shopCategoryId`, `shopType`, `publishFlag`, `shopEmailId`, `shopMobile`, `shopLandline`, `shopPriority`, `dailyNeedsFlag`, `deliveryFeeBaseKM`) VALUES
(3, 0, 'NEXEBIZ', 0, 0, 'Near Co-Operative Hospital Vadakara', 'VADAKARA', 673101, NULL, NULL, 'images/items/grocery/category/InShot_20210926_174446942.jpg', 'images/items/grocery/category/IMG-20210918-WA0031.jpg', '2021-07-23 12:52:32', '13:00:00', 0, 0, 0, 0, 0, 18, 0, 1, 'nexebiz@gmail.com', '8590062219', '8281181219', 1, 0, 0),
(10, 0, 'ACULIFE ACUPUNCTURE CARE', 0, 1, 'NUTSTREET, VADAKARA', 'vadakara', 673102, NULL, NULL, 'images/items/grocery/category/acupuncture-icon-10.jpg', 'images/items/grocery/category/rsh_1000,cg_true.jfif', '2022-01-26 15:08:27', '15:15:00', 5, 5, 5, 0, 5, 18, 0, 0, 'sirajca99@gmail.com', '7012314542', '1', 2, 0, 5),
(11, 0, 'DAYKART', 0, 200, 'VADAKARA,', 'VADAKARA', 673571, NULL, NULL, 'images/items/grocery/category/grocery.jpeg', 'images/items/grocery/category/banner_hotel_king2.png', '2022-04-25 22:52:34', '00:45:00', 0, 1, 0, 1, 0, 18, 0, 1, 'daykart@gmail.com', '7736151724', '049528121212', 1, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
  `shopCategoryId` bigint NOT NULL,
  `name` varchar(32) NOT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'images/shop_category/default.jpg	',
  `default_image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'images/shop_category/default.jpg',
  `description` varchar(256) DEFAULT NULL,
  `entryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activeFlag` enum('ACTIVE','INACTIVE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `priority` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`shopCategoryId`, `name`, `image`, `default_image`, `description`, `entryDate`, `activeFlag`, `priority`) VALUES
(4, 'NEXEBIZ EV CHARGER', 'images/shop_category/IMG_20211209_173752110_HDR.jpg', 'images/shop_category/default.jpg', NULL, '2021-07-23 12:49:47', 'INACTIVE', 0),
(15, 'E-SCOOTERS', 'images/shop_category/elthor-scooty3.png', 'images/shop_category/default.jpg', NULL, '2022-01-11 18:26:54', 'INACTIVE', 0),
(16, 'E-BIKE', 'images/shop_category/prana-grand-electric-bike.jpg', 'images/shop_category/default.jpg', NULL, '2022-01-11 18:41:50', 'INACTIVE', 0),
(17, 'HELTH', 'images/shop_category/acupuncture-icon-10.jpg', 'images/shop_category/default.jpg', NULL, '2022-01-26 15:02:05', 'INACTIVE', 0),
(18, 'GROCERY', 'images/shop_category/grocery1.png', 'images/shop_category/default.jpg', NULL, '2022-04-25 22:39:51', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_tag_delivery_boy`
--

CREATE TABLE `shop_tag_delivery_boy` (
  `id` bigint NOT NULL,
  `shopId` bigint NOT NULL DEFAULT '0',
  `deliveryBoyId` bigint NOT NULL DEFAULT '0',
  `active` bigint NOT NULL DEFAULT '1',
  `entryDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_tag_delivery_boy`
--

INSERT INTO `shop_tag_delivery_boy` (`id`, `shopId`, `deliveryBoyId`, `active`, `entryDate`) VALUES
(1, 3, 1, 1, '2021-07-28 22:41:54'),
(2, 3, 1, 1, '2021-07-28 22:42:05'),
(3, 2, 2, 1, '2021-07-29 21:34:56'),
(4, 7, 3, 1, '2021-08-07 17:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `suCategoryId` bigint NOT NULL,
  `categoryId` bigint NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `shopId` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_item_details`
--

CREATE TABLE `temp_item_details` (
  `id` int NOT NULL,
  `itemId` bigint NOT NULL,
  `tempOfferPrice` double NOT NULL DEFAULT '0',
  `tempPrice` double NOT NULL DEFAULT '0',
  `tempAvailabilityStatus` int DEFAULT NULL,
  `entryDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_shop_details`
--

CREATE TABLE `temp_shop_details` (
  `id` int NOT NULL,
  `shopId` bigint NOT NULL DEFAULT '0',
  `tempShopGst` double DEFAULT '0',
  `tempActive` int DEFAULT '0',
  `entryDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `user_info` (
  `userId` bigint NOT NULL,
  `userRole` enum('SuperAdmin','Admin','ShopAdmin','User') NOT NULL DEFAULT 'User' COMMENT 'SuperAdmin-FoodVeno, Admin-Ebaazaar,ShopAdmin-Shop Admins',
  `name` varchar(64) NOT NULL,
  `emailId` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `shopId` bigint NOT NULL,
  `profileImg` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `pinCode` int NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `rewardPoint` double NOT NULL,
  `minimumOrder` double NOT NULL,
  `entryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activeShopId` bigint DEFAULT NULL,
  `addressId` bigint NOT NULL DEFAULT '0',
  `otp` varchar(8) DEFAULT NULL,
  `otpSentCount` int DEFAULT NULL,
  `otpLimitExceededTime` datetime DEFAULT NULL,
  `currentShopGst` double NOT NULL DEFAULT '-1',
  `orderCount` int DEFAULT NULL,
  `blockedFlag` tinyint NOT NULL,
  `accountStatus` enum('NORMAL','WARNING','SUSPECT','BLOCKED') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NORMAL',
  `authString` varchar(256) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `firebaseToken` varchar(1024) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userId`, `userRole`, `name`, `emailId`, `mobile`, `password`, `address`, `shopId`, `profileImg`, `pinCode`, `latitude`, `longitude`, `rewardPoint`, `minimumOrder`, `entryDate`, `activeShopId`, `addressId`, `otp`, `otpSentCount`, `otpLimitExceededTime`, `currentShopGst`, `orderCount`, `blockedFlag`, `accountStatus`, `authString`, `token`, `firebaseToken`) VALUES
(1, 'SuperAdmin', 'Ajith  k k', 'ajith9947@gmail.com', '9526304496', 'e10adc3949ba59abbe56e057f20f883e', 'Address1', 0, '', 0, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-10 19:04:07', NULL, 0, '', NULL, NULL, 0, NULL, 0, 'NORMAL', NULL, 'pjAyz+HbMRE58nVuotmF6GWtJYZCx/hKn9M8MJ2MlwNVnbSCL+WPKMm7A2e0h7ALACfurwozs7K4TgrOhRjbYQ==', 'csl6Ci5USzyOrDdmwG2M5M:APA91bExhFzWjHcOlQQXPL2IisUps4sprS6seHpS8rvjU059nONq4FbqbxpgNY68ppKAt0SsfkFcHUQXe92NNI8HA4J3yi5sE_JftNr6xXDzowyZe6f0q9TR7y1jOk6xnnrZPAzFvalx'),
(2, 'User', 'ANOOP P', 'anoop@gmail.com', '8943421724', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0, 0, 0, '2021-07-22 03:19:41', NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 'NORMAL', 'omLv6srC6QO42QD6wzTtgTuBr5VTgvLyEkWL04qOhGtBVMvHxw', 'KLsNUNrRD7MCDbUAuQLY/fD1wWUkPza2BX5ful9PrNxlob2rURZMBHFX5X7UIRhq/GtzMkUbqQSGG4E9y9vGKQ==', ''),
(3, 'User', 'siraj ca', 'sirajca99@gmail.com', '7012314542', '25d55ad283aa400af464c76d713c07ad', '', 0, '', 0, 0, 0, 0, 0, '2021-07-23 16:13:56', NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 'NORMAL', '5YuLmNu98OBgmWH564mAEtMzArseLWOGbZRGq6PoD66iFgTGRq', 'x6vW45N4yviMsO3fER3MvRZX201viaR4BhNSyYHjiR0NPWb4ginQtVuXpSb4/oAnfCp4TEc9mMeTUHrHv0yOKw==', ''),
(4, 'SuperAdmin', 'SIRAJ', 'sirajca99@gmail.com', '7012314542', 'e10adc3949ba59abbe56e057f20f883e', 'Address1', 0, '', 0, 9.9775265391656, 76.317906305194, 0, 0, '2020-06-10 19:04:07', NULL, 0, '', NULL, NULL, 0, NULL, 0, 'NORMAL', NULL, 'lnl609I+f+9av9k2knImE3NAHVqOQ3gz7YQc6KDbXqFhrdaOb5XJ+fXp2FEe6iIBOlEbr54VGj2IOTbkSduyjw==', 'eFgFwV2tSrO2BkDEfAzSJz:APA91bFaLbFCVoEGgWe2FB4QA7tbxGV4n0SAqYQZJuEOOi8w706q8fzlNoH54IoT_u02yQktjeNkG7U9YY9Csnox55U4k8AAhL0pXt9rtEOVmMkwrNwABrEkMclJ6BRLvM-uf_s9kH7P'),
(6, 'ShopAdmin', 'SIRAJ', 'aculifeswellness@gmail.com', '9744014342', '25d55ad283aa400af464c76d713c07ad', 'Nutstreet', 1, '', 673104, 0, 0, 0, 0, '2021-07-29 20:04:38', 1, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', '07J9WBbZMqS1qtnaaRIIe5mlYIVzDGQMW2AEGcijRLj60BhMmy', 'Jl0WlQC9GkePvD5GFtLizXoDKCuGPDeR2VfB3yvzcbQwE1UWfk3h74Pw0dw8gKJLi7nS7EttohSZNrmC/QrAqQ==', 'cfmwpsBiSg2lgZBU_MmRJI:APA91bFwvP1vKA79TAYTX1CmsRgdBuJRBHr4CrFqJlb7R_-iiwHRpXppVecPTGxHiVD5tLpuzseY16e_I2vfz6pqk2uh9ylG72Twi6x9fSz9WGQ-hI3hlQW50W9VXHSKTNIjgS_0pBZ4'),
(7, 'ShopAdmin', 'MUNEER T nexebiz@gmail.com', 'nexebi@gmail.com', '7736151724', 'e10adc3949ba59abbe56e057f20f883e', 'choolamvayal', 2, '', 673571, 0, 0, 0, 0, '2021-07-29 23:28:18', 2, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', 'cusJj92XOGYEWQn0pXKePxNVEC0N1HD3sbwQ5kC2EfynwEasMw', 'LkgSYt/esKwsQGUmnMLQpyyhUFgEeF9H8j/4Eq7sAHaoFeLcg+8XSiS6AfbMXEf0aoXEHKRtgk3YFqSBX0SJlA==', 'fuYDG7FITrKeRFRdw11EsQ:APA91bHHtz1Uc2mtWxV6zPxAdAywuCef9Cw8WRECwF-Z26WOR90CXX-K7EVR5tGUbAA_pONZ1TwTGti7P4XRrkha-NdUxTEVxdIkWfIIFV2TbI32LDhHiSjh-qfm-NXkR0QWvknfzjB6'),
(8, 'ShopAdmin', 'Asbeer CA', 'nexebiz@gmail.com', '8590062219', '210441aeac6fd43f5e311d843a6660be', 'Near co-op hospital . vadakara', 3, '', 673101, 0, 0, 0, 0, '2021-07-30 09:17:02', 3, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', 'pBpqmd0AaeFATeUMVfQoWdRsPu9cTehzjQ2WbCxIPnwr6kdUEz', 'XnTdfxv1oBl2K/QseYQYPjvPc9hG+cZSLpDbIfGy6otuE85UKSe0LRDQl9bcAsYkev0y7LPGLwjp5vF8qKBmPg==', 'd5hIIKOwQ2OmvNBm1oA4-H:APA91bHX4dqm3ii9BdSO1EHalLvy4HsrNHOe7k9jqJ6P4dhxjyLfQ7YkV1z5yErIL2hrFO3MXUiwyXDh_W--UShtlMNEnw2U8xSwruKiDYEHm0T7cdVZJWmfJ-bXOceDAlVrDdfwkP0g'),
(9, 'User', 'AJITH K K', 'ajith@gmail.com', '9947898851', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0, 0, 0, '2021-07-30 12:09:27', NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 'NORMAL', 'AvWL9G8dOREjp2mceNyOVBbeyTH2chUhquP4ZG7IYiGH81i45c', 'YaPUD0YnYZU8EdnyYRikAx6LQRg1I8lvW0zEkAtoSyIBFBawRaLUuxdfdGgWGNQr74oBSsHYQq6nL0suso1fEA==', ''),
(10, 'ShopAdmin', 'Shakeer p', 'shakeerputhiyottil65@gmail.com', '9746926387', '25d55ad283aa400af464c76d713c07ad', 'Main road oldbusstant vadakara', 4, '', 673101, 0, 0, 0, 0, '2021-07-30 18:43:59', 4, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', '4Xjvqf8p9bJgcjR6PkNmDDjEeSkrfaDZAN3lypuSwmepzbqcvG', 'kxNETaU5OQ3zeUeTRukcw+jDOUfeDQO5wLKFgaR+NKFS3sunpIArdBgWnXlaUIKsB9tRcBlQ4oaeYepCuIIGyA==', 'cQauSVKpSBaglagDYGXXX2:APA91bHYmWtziBar-pRgOmQfKmi9tvN794vbtK59G9I7SahMk8P6s9b71_h7gepqiCaX2JQc8Dz-plrgrPEUrPLFEJdTs_SeLcXFjrh0Yf_uql5EJ_KKI5KG_iQwupZuTQq8-2aSFsgC'),
(11, 'ShopAdmin', 'AJITH K K', 'ajith9947@gmail.com', '8943421724', 'e10adc3949ba59abbe56e057f20f883e', 'choolamvayal', 5, '', 673571, 0, 0, 0, 0, '2021-07-30 21:15:43', 5, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', NULL, 'MTryRLCZ6lqOdqpOnjqXlvUQiFpxN2MW9Mp5r+3tv/rofucI1puXJ2nl5k2Q9x7y7EKaLyrtrxTjitVKNp6bAg==', 'dleVMqjVRCOFiJLiicte_i:APA91bGzGpXEt12cGlGu8pNvEJyfb3N0Yigc04eTb_nOajus0wJVBT6zA3JLZK042Dx2-x65iiXG16h1qjTrMg5qcoDMBRtpyfk-VKnEDZ9QrLCCH3JORCL05EOD7F62EEwQ_8xU6hTk'),
(12, 'User', 'Muhammed Asbeer C A', 'muhammedasbeerca@gmail.com', '8301977244', '210441aeac6fd43f5e311d843a6660be', '', 0, '', 0, 0, 0, 0, 0, '2021-07-31 17:54:28', NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 'NORMAL', 'dN9nckExFTWeb54rodpe1Nmil8t2iXnlF1NTQK55D07vhwtNvt', 'kt2xKCgykKr0XaoYXnS5Ee8DUs/MN0HyTzXjuZtdgGJOG0RVFdcTUTgxc471Cdm0yo3/+LvlD+FT1Fq+T8pPmw==', ''),
(13, 'ShopAdmin', 'Muhammad', 'adhambinsiraj@gmail.com', '9539131851', '25d55ad283aa400af464c76d713c07ad', 'Nutstreet', 6, '', 673104, 0, 0, 0, 0, '2021-08-01 14:26:03', 6, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', 'Olw12veXCIvaT5w1bUtmxY2bkidpcNh2DYA4Bi7uuJKBqhnSEG', 'gI6BzSmEsKeKzUaWI5TZ/OIKrGagS9DYqGvKGFgh7JbyuyYESicM+L8u/7/DR/CXqNMw1f1rK3zs3qaS+LQ/dQ==', 'fgjFkWjURwSh7R62TOHs0N:APA91bFZjAYeBdsbcDOriss1zNYXbeihh1GZDXGs-PlyEfFdJzVo1mtkN-gMKAFtgBttBeM4vqQ9B3rF2Ec-87ZSiAdmqF5rdVI6ka3nxpvwlheQhAAhtKJsQXimXnxkDr1q168WEyz_'),
(14, 'ShopAdmin', 'Rafeek uv', 'rafeekuv42425@gmail.com', '8157042425', 'e10adc3949ba59abbe56e057f20f883e', 'Near queens road vadakara', 7, '', 673101, 0, 0, 0, 0, '2021-08-05 20:15:09', 7, 0, '', NULL, NULL, -1, NULL, 0, 'NORMAL', 'UZxAX75YL8KOeO8h2cBzfiVY2O67hA4usqHErW1fgDxq9CXLbL', 'qk28SsME6iEHzd6DwJMjnvlDDnp5AOnhpu5bm8RMV0Pb7MkwLoJ5y7mwNPeVMLdGPC3COd2eB8rn09/gII+RMA==', 'fuT8LEHWTfusqF_xIJl-Vi:APA91bHtisRxkqUyjfy7xQ8uUapKaLRSWorUtM6y1IsQPN4k5i4AQA-Y1g2prM7KhOJr-AvmdFCa6ZCiI4ADd2YbsRqlrs217JYasqZIXPLrZyAkaqapOUmcX2SmdfGIj1iCUzHO3GPb'),
(15, 'User', 'AJITH K K', 'ajithyesvalue@gmail.com', '7736151724', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0, 0, 0, '2021-10-22 10:09:15', NULL, 0, NULL, NULL, NULL, -1, NULL, 0, 'NORMAL', 'cusJj92XOGYEWQn0pXKePxNVEC0N1HD3sbwQ5kC2EfynwEasMw', 'LkgSYt/esKwsQGUmnMLQpyyhUFgEeF9H8j/4Eq7sAHaoFeLcg+8XSiS6AfbMXEf0aoXEHKRtgk3YFqSBX0SJlA==', ''),
(16, 'User', 'sha', '4mail6600@gmail.com', '7034442555', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0, 0, 0, '2021-10-22 13:53:55', NULL, 0, NULL, NULL, NULL, -1, NULL, 0, 'NORMAL', 'CDgGl6ZS9xd7aZXMxsqgDwyqFp3PSE0qPFRorVe8asDohKDMIR', '0DJ++y5zS8f7ZbxIjtXJ4Gpu/wyF+TeW51vwyQZVK65BK3+SD5s5F3B6oS/xNlVHk4ARhF4qjGR85t91XBu5EQ==', ''),
(17, 'User', 'shihabs ', 'shihabs5313@gmail.com', '8075693870', 'e31e60b070d5bf211d150e14978a6e1b', '', 0, '', 0, 0, 0, 0, 0, '2022-01-13 18:22:34', NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 'NORMAL', 'nuLb6FlxJmpKxxctoJsDtKLlTRR2psqKbb2lOxwvh4XmExmgeD', '9nZ65vR0lHHFxaYLdHQGJ1ym0CxMDlVqZcKi7I80gRr9u9jQjA79vGJAmtwfOpfmDijmQziWM4YkSQoX3IPR9Q==', ''),
(18, 'ShopAdmin', 'SIRAJ C A', 'sirajca99@gmail.com', '7012314542', '', 'NUTSTREET, VADAKARA', 10, '', 673102, 0, 0, 0, 0, '2022-01-26 15:10:06', 10, 0, '458669', NULL, NULL, -1, NULL, 0, 'NORMAL', 'Dwh9EBxmh7QQZ7nfo0QymYxjapjcj1EN29DjkQ6x9xRs6endhI', NULL, ''),
(19, 'ShopAdmin', 'AJITH', 'ajithyesvalue@gmail.com', '7994164006', '', 'ambadi', 11, '', 673571, 0, 0, 0, 0, '2022-04-25 23:44:29', 11, 0, '291418', NULL, NULL, -1, NULL, 0, 'NORMAL', 'Dz9bVQGRVLApe1mVRQz7ouqYtn7LxxN27tEYsRxhoXAoKy7XI7', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `app_version`
--
ALTER TABLE `app_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`couponId`);

--
-- Indexes for table `db_version`
--
ALTER TABLE `db_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`deliveryBoyId`);

--
-- Indexes for table `demo_users`
--
ALTER TABLE `demo_users`
  ADD PRIMARY KEY (`demoId`);

--
-- Indexes for table `d_boy_payment`
--
ALTER TABLE `d_boy_payment`
  ADD PRIMARY KEY (`dbPaymentId`);

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shipping`
--
ALTER TABLE `order_shipping`
  ADD PRIMARY KEY (`orderShippingId`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_tag_delivery_boy`
--
ALTER TABLE `order_tag_delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_cart`
--
ALTER TABLE `quick_cart`
  ADD PRIMARY KEY (`quickCartId`);

--
-- Indexes for table `quick_items`
--
ALTER TABLE `quick_items`
  ADD PRIMARY KEY (`quickItemId`);

--
-- Indexes for table `quick_order`
--
ALTER TABLE `quick_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopId`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`shopCategoryId`);

--
-- Indexes for table `shop_tag_delivery_boy`
--
ALTER TABLE `shop_tag_delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`suCategoryId`);

--
-- Indexes for table `temp_item_details`
--
ALTER TABLE `temp_item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_shop_details`
--
ALTER TABLE `temp_shop_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_version`
--
ALTER TABLE `app_version`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `couponId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_version`
--
ALTER TABLE `db_version`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `deliveryBoyId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demo_users`
--
ALTER TABLE `demo_users`
  MODIFY `demoId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `d_boy_payment`
--
ALTER TABLE `d_boy_payment`
  MODIFY `dbPaymentId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_shipping`
--
ALTER TABLE `order_shipping`
  MODIFY `orderShippingId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `orderId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_tag_delivery_boy`
--
ALTER TABLE `order_tag_delivery_boy`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quick_cart`
--
ALTER TABLE `quick_cart`
  MODIFY `quickCartId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quick_items`
--
ALTER TABLE `quick_items`
  MODIFY `quickItemId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `quick_order`
--
ALTER TABLE `quick_order`
  MODIFY `orderId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `shopCategoryId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shop_tag_delivery_boy`
--
ALTER TABLE `shop_tag_delivery_boy`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `suCategoryId` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_item_details`
--
ALTER TABLE `temp_item_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `temp_shop_details`
--
ALTER TABLE `temp_shop_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
