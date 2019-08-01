-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 05:06 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `bId` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bId`, `brand_name`, `status`) VALUES
(1, 'Samsung', '1'),
(2, 'MegaMart', '1'),
(3, 'Aarong', '1'),
(4, 'Xioami', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `category_name`, `status`) VALUES
(1, 'Electronics', '1'),
(2, 'Cloths', '1'),
(3, 'Mobiles', '1'),
(12, 'Laptops', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `ck_key` varchar(100) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `ck_key`, `cust_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES
(1, '6a33', 'rahul das', '2019-07-31', 51200, 9216, 800, 59616, 7890, 51726, 'Cash'),
(3, '39ae', 'mikel', '2019-07-31', 4500, 810, 580, 4730, 3000, 1730, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(1, 1, 'Printed Punjabi', 3200, 16),
(2, 3, 'Full Sleve T-Shirt', 900, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `bId` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL COMMENT 'Available=1 & Non_available=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pId`, `cId`, `bId`, `product_name`, `product_price`, `product_stock`, `date`, `status`) VALUES
(1, 3, 1, 'Samsung Galaxy S8', 70000.00, 29, '2019-07-25', '1'),
(2, 2, 2, 'Full Sleve T-Shirt', 900.00, 37, '2019-07-25', '1'),
(6, 2, 3, 'Printed Punjabi', 3200.00, 0, '2019-07-25', '0'),
(7, 3, 4, 'Redmi K20 Pro', 37000.00, 10, '2019-07-25', '1'),
(22, 1, 1, 'Camera', 56000.00, 5, '2019-08-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `uName` varchar(100) NOT NULL,
  `uEmail` varchar(255) NOT NULL,
  `uPassword` varchar(255) NOT NULL,
  `uType` enum('Admin','Other') NOT NULL,
  `register_date` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uName`, `uEmail`, `uPassword`, `uType`, `register_date`, `last_login`, `status`) VALUES
(1, 'Emon Chowdhury', 'emonchy35@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '19-07-09', '19-07-09 08:38:39pm', '1'),
(2, 'Anik Nolan', 'bdbd@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin', '19-07-10', '19-07-10 12:11:22am', '1'),
(17, 'Anik roy', 'bd@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Admin', '19-07-12', '19-08-01 06:04:18pm', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`bId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`),
  ADD UNIQUE KEY `uEmail` (`uEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `bId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
