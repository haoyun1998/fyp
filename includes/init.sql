-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 04:40 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_year_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `username`, `password`) VALUES
(1, 'Chung Hao Yun', 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoriesId` int(11) NOT NULL,
  `categoriesName` varchar(100) NOT NULL,
  `categoriesImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoriesId`, `categoriesName`, `categoriesImage`) VALUES
(0, 'Others', 'image09.jpg\r\n'),
(1, 'Phone', 'image06.jpg'),
(2, 'Charger', 'image07.png'),
(3, 'Earphone', 'image08.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `customerId`, `firstName`, `lastName`, `email`, `remark`) VALUES
(1, 1, 'Chung', 'Hao Yun', 'hyc1998@hotmail.com', 'iPhone 11 Pro Max still got stock?'),
(2, 1, 'Chung', 'Hao Yun', 'haoyun_1998@hotmail.com', 'I have interest to iPhone 11.'),
(3, 1, 'Chung', 'Hao Yun', 'haoyun19983@gmail.com', 'Hello ~ Do you have stock for iPhone 20.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerName`, `phoneNumber`, `address`, `username`, `password`) VALUES
(1, 'Chung Hao Yun', '016-7708248', '78, Jalan Jelita 14, Taman Pelangi Indah.', 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `trackingNumber` int(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `deliveryId` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `totalAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `deliveryId`, `paymentId`, `date`, `totalAmount`) VALUES
(1, 1, 0, 0, '2020-08-14 17:54:47', 100);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderDetailsId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `categoriesId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description1` varchar(100) NOT NULL,
  `description2` varchar(100) NOT NULL,
  `description3` varchar(100) NOT NULL,
  `description4` varchar(100) NOT NULL,
  `description5` varchar(100) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `unitPrice` float NOT NULL,
  `stockQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `categoriesId`, `productName`, `brand`, `description1`, `description2`, `description3`, `description4`, `description5`, `productImage`, `unitPrice`, `stockQuantity`) VALUES
(1, 1, 'iPhone 11 pro', 'Apple', '5.8-inch Super Retina XDR OLED display', 'Triple-camera system with 12MP Ultra Wide, Wide, and Telephoto cameras; Night mode, Portrait mode, a', '12MP TrueDepth front camera with Portrait mode, 4K video, and Slo-Mo', 'A13 Bionic chip with third-generation Neural Engine', 'Fast charge with 18W adapter included', 'image10.jpg', 4899, 10),
(2, 1, 'iPhone SE', 'Apple', '4.7-inch Retina HD display', '12MP Wide camera; Portrait mode, Portrait Lighting, Depth Control, next-generation Smart HDR, and 4K', '7MP front camera with Portrait mode, Portrait Lighting, and Depth Control', 'A13 Bionic chip with third-generation Neural Engine', 'Fast-charge capable', 'image02.jpg', 1999, 10),
(3, 2, 'iPhone Original Charger', 'Apple', 'Cable Length: 3.3 feet feet', 'Cable Type: Lightning', 'Compatible Devices: Tablet , PC , Smartphone', 'Connector Type: Usb , Usb 2.0 , Usb Type C\r\n', 'Item Weight: 1.60 ounces', 'image11.jpg', 16, 10),
(4, 2, 'Samsung Original Cable', 'Samsung', 'Brand new in original Samsung retail packing, for Samsung note 4, edge, galaxy s6,galaxy edge 6', 'Important note: Only original Samsung galaxy note4 and note edge & s6 are compatible with fast charg', 'The Samsung adaptive fast charging micro-usb wall charger enables rapid recharge on your devices', 'Whether at home, the office, or on the go, the adaptive fast charging wall charger will have your de', '', 'image12.jpg', 14, 10),
(5, 3, 'Apple EarPods with Lightning Connector', 'Apple', 'Unlike traditional, circular earbuds, the design of the EarPods is defined by the geometry of the ea', 'The speakers inside the EarPods have been engineered to maximize sound output and minimize sound los', 'The EarPods with lightning connector also include a built-in remote that lets you adjust the volume,', 'Works with all devices that have a lightning connector and support iOS 10 or later, including iPod t', '', 'image13.jpg', 20, 10),
(6, 3, 'Betron DC950 Earphone', 'Betron', 'Premium Audio: The DC950 has a bass that goes deeper than deep and crisp clean trebles that hit high', 'Noise Isolation: The headphones eliminate outside noise to keep your music crystal clear. They also ', 'Tangle Resistant: Featuring an innovative antitangle design, the Y shaped cord of these headphones h', 'Highly Functional: The earphones are sweat proof and have a heavy bass reproduction, so you can enjo', 'What is Included: The DC950 includes a carry case, various size silicone earbuds, a gold plated 3.5m', 'image14.jpg', 15.4, 10),
(7, 0, 'Yoobao Portable Charger', 'Yoobao', '4 Times Faster Charging Speed ', 'Ultra Slim Design', 'Huge Capacity Dual Output', 'Superior Quality', 'What You Get -- Yoobao 12000mAh Qualcomm Quick Charge Power Bank Q12, Micro USB Cable, User Manual, ', 'image15.jpg', 25, 10),
(8, 0, 'Pineng Power Bank', 'Pineng', ' High-Quality Materials: Power pack uses high-density lithium-ion polymer battery, which has good en', 'Comes with Built-in Cable: Portable charger comes with a “Fruit” charging cable and a Micro / Type-C', ' Multiple Output Port: External battery has a standard USB output port and two self-contained chargi', 'Intelligent Recognition: When the digital product is connected, the mobile power can automatically r', ' Good Compatibility: Power bank is compatible with most mobile devices on the market, and you don\'t ', 'image16.jpg', 25, 10),
(9, 1, 'Samsung Galaxy A20', 'Samsung', 'an extensive 4, 000 mAh long lasting battery', 'Shoot scenic photos with a 13MP rear Camera or take flattering selfies with an 8MP front Camera', 'View a brilliant, edge to edge 6.4 inches Super AMOLED Infinity display', 'Keep more with 32GB of built in memory; Expand your memory up to 512GB with a microSD card (sold sep', 'An ultra wide 123 degrees field of vision lets you fit more in the picture', 'image17.jpg', 250, 10),
(16, 1, 'Nokia 3310', 'iphone', '123', '123', '123', '123', '123', 'shopping.png', 123, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoriesId`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderDetailsId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoriesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orderDetailsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
