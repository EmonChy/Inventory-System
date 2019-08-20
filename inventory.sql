-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 03:16 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `payment_type` varchar(100) NOT NULL,
  `total_qty` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `ck_key`, `cust_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`, `total_qty`, `total_item`) VALUES
(1, 'bab1', 'mc sher', '2019-08-16', 12300, 2214, 2000, 12514, 12514, 0, 'Cash', '6', 2),
(3, '11ed', 'mikel', '2019-08-16', 38800, 6984, 0, 45784, 45784, 0, 'Cash', '3', 2),
(4, 'd56e', 'rohit', '2019-08-16', 112000, 20160, 2800, 129360, 120000, 9360, 'Cash', '2', 1),
(5, '937a', 'joy', '2019-08-16', 3200, 576, 0, 3776, 3000, 776, 'Cash', '1', 1),
(7, '9c4d', 'sourav', '2019-08-16', 900, 162, 0, 1062, 1062, 0, 'Cash', '1', 1),
(8, 'b2b1', 'Ashish', '2019-08-16', 70000, 12600, 0, 82600, 80000, 2600, 'Cash', '1', 1),
(9, '7a00', 'Liton', '2019-08-16', 107000, 19260, 1800, 124460, 124400, 60, 'Cash', '2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `i_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `pId`, `product_name`, `price`, `qty`, `total_qty`, `i_status`) VALUES
(1, 1, 6, 'Printed Punjabi', 3200, 3, 29, 1),
(2, 1, 2, 'Full Sleve T-Shirt', 900, 3, 23, 1),
(5, 3, 7, 'Redmi K20 Pro', 37000, 1, 18, 1),
(6, 3, 2, 'Full Sleve T-Shirt', 900, 2, 23, 1),
(7, 4, 22, 'Camera', 56000, 2, 15, 1),
(8, 5, 6, 'Printed Punjabi', 3200, 1, 29, 1),
(9, 6, 6, 'Printed Punjabi', 3200, 1, 29, 1),
(10, 7, 2, 'Full Sleve T-Shirt', 900, 1, 23, 1),
(11, 8, 1, 'Samsung Galaxy S8', 70000, 1, 26, 1),
(12, 9, 7, 'Redmi K20 Pro', 37000, 1, 18, 1),
(13, 9, 1, 'Samsung Galaxy S8', 70000, 1, 26, 1);

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
(1, 3, 1, 'Samsung Galaxy S8', 70000.00, 25, '2019-07-25', '1'),
(2, 2, 2, 'Full Sleve T-Shirt', 900.00, 20, '2019-07-25', '1'),
(6, 2, 3, 'Printed Punjabi', 3200.00, 26, '2019-07-25', '1'),
(7, 3, 4, 'Redmi K20 Pro', 37000.00, 17, '2019-07-25', '1'),
(22, 1, 1, 'Camera', 56000.00, 13, '2019-08-01', '1');

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
(1, 'Emon', 'emonchy35@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '19-08-02', '19-08-15 10:29:24pm', '1');

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
  MODIFY `bId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
