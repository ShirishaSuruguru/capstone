-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 09:39 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` int(11) NOT NULL,
  `catName` varchar(20) NOT NULL,
  `catImg` varchar(50) NOT NULL,
  `catDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `catName`, `catImg`, `catDesc`) VALUES
(1, 'Womenn', 'images/categories/Women.png', '        	        	        	        	Women Category Clothes                                '),
(2, 'Men', 'images/categories/Men.jpg', '        	\r\n      Men clothing and accessories  '),
(3, 'Kids', 'images/categories/kvjg.jpg', 'Kids Clothing Accessories'),
(7, 'Shoes', 'images/categories/delete.jpg', 'Shoes for kids and women'),
(8, 'delete', 'images/categories/delete.jpg', 'kndfk        	        ');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerName` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` text NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `email`, `password`, `gender`, `status`, `date`) VALUES
(1, 'Navneet', 'navneet@gmail.com', '123', 'Female', 'Inactive', '2020-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invenID` int(11) NOT NULL,
  `varID` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `vendor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `proID` int(11) NOT NULL,
  `total` float NOT NULL,
  `cardNo` bigint(20) NOT NULL,
  `method` text NOT NULL,
  `odate` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `proID`, `total`, `cardNo`, `method`, `odate`, `status`) VALUES
(1, 1, 2, 20, 4444555566668888, 'Credit', '2020-04-16', 'Completed'),
(2, 1, 0, 0, 0, 'Credit', '2020-04-24', 'Recieved'),
(3, 1, 0, 0, 0, 'Credit', '2020-04-24', 'Recieved'),
(4, 1, 1, 45, 0, '', '2020-04-24', 'Recieved'),
(5, 1, 1, 45, 0, '', '2020-04-24', 'Recieved'),
(6, 1, 0, 0, 0, 'Credit', '2020-04-24', 'Recieved'),
(7, 1, 0, 0, 0, 'Credit', '2020-04-24', 'Recieved');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `proID` int(11) NOT NULL,
  `subCatID` int(11) NOT NULL,
  `proName` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`proID`, `subCatID`, `proName`, `price`, `description`) VALUES
(1, 2, 'T Shirt', 45, '        	        	        	        	        	        	        	        	        	This cool, soft and slim crew neck looks just as good layered under a blazer as it does flying solo.                   '),
(2, 2, 'Trousers', 39, '        	        	        	        	        	        	Look for this basic straight-leg style in our Denver Hayes jeans that we offer in various blue denims and other color choices.                    '),
(3, 3, 'rtrt', 44, '        	gregregergergerf        '),
(4, 3, 'fg', 44, '        	sgggggggggggg        '),
(5, 4, 'White Shoes', 33, 'These are nearly indestructible shoes, as they are impact proof, nail proof, and puncture proof. '),
(7, 4, 'test test', 88, 'fgadsfffffffff	        '),
(13, 0, 'Tee', 50, '        	        test desc'),
(14, 3, 'Tee', 50, '        	test desc        ');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subCatID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `subCatName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subCatID`, `catID`, `subCatName`) VALUES
(1, 1, 'Traditional'),
(2, 1, 'Casual Wear'),
(3, 2, 'Formal'),
(4, 2, 'Shoes'),
(8, 7, '6cat1'),
(9, 7, '6cat2'),
(10, 8, '7cat1'),
(11, 8, '7cat2'),
(12, 7, '6cat3');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `varID` int(11) NOT NULL,
  `proID` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `inventory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`varID`, `proID`, `size`, `color`, `image`, `inventory`) VALUES
(1, 1, 'S', 'White', 'images/products/white.jpg', 100),
(2, 1, 'S', 'Red', 'images/products/red.jpg', 100),
(3, 1, 'S', 'Black', 'images/products/black.jpg', 100),
(4, 2, 'M', 'Brown', 'images/products/brown.jpg', 100),
(5, 2, 'S', 'Green ', 'images/products/green.jpg', 100),
(6, 2, 'S', 'Yellow', 'images/products/yellow.jpg', 100),
(7, 5, 'M', 'White', 'images/products/shoes1.jpg', 10),
(9, 7, 'L', 'prioiwofd', 'images/products/hndset.png', 122),
(15, 13, 'S', 'black', 'images/products/girl.jpg', 1),
(16, 14, 'S', 'black', 'images/products/2.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invenID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proID`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subCatID`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`varID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invenID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `proID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `subCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `varID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
