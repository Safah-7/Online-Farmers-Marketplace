-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fvsmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `biilingCity` varchar(150) DEFAULT NULL,
  `billingState` varchar(100) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `billingCountry` varchar(100) DEFAULT NULL,
  `shippingAddress` varchar(300) DEFAULT NULL,
  `shippingCity` varchar(150) DEFAULT NULL,
  `shippingState` varchar(100) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `shippingCountry` varchar(100) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `userId`, `billingAddress`, `biilingCity`, `billingState`, `billingPincode`, `billingCountry`, `shippingAddress`, `shippingCity`, `shippingState`, `shippingPincode`, `shippingCountry`, `postingDate`) VALUES
(1, 1, 'karan', 'karan', 'banadir', 201301, 'somalia', 'wadajir', 'wadajir', 'banadir', 201301, 'somalia', '2025-03-08 11:57:11'),
(2, 1, 'ceel qalow', 'wadajir', 'banadir', 202001, 'somalia', 'wadajir', 'wadajir', 'banadir', 202001, 'somalia', '2025-03-09 12:01:03'),
(11, 12, 'madina', 'wadajir', 'banaadir', 252, 'Somalia', 'madina', 'wadajir', 'banaadir', 252, 'Somalia', '2025-06-16 08:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productQty` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `productId`, `productQty`, `postingDate`) VALUES
(5, 8, 10, 1, '2025-04-16 05:47:02'),
(6, 7, 10, 1, '2025-04-17 04:31:37'),
(7, 7, 9, 5, '2025-04-18 04:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`, `createdBy`) VALUES
(1, 'Vegetabes', 'Vegetables are parts of plants that are consumed by humans or other animals as food. The original meaning is still commonly used and is applied to plants collectively to refer to all edible plant matter, including the flowers, fruits, stems, leaves, roots, and seeds', '2025-02-12 06:38:04', NULL, 1),
(2, 'Fruits', 'Fruits are the mature ovary or ovaries of one or more flowers. They are found in three main anatomical categories: aggregate fruits, multiple fruits, and simple fruits.', '2025-02-12 06:40:11', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderNumber` bigint(12) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `addressId` int(11) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `txnType` varchar(200) DEFAULT NULL,
  `txnNumber` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(120) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderNumber`, `userId`, `addressId`, `totalAmount`, `txnType`, `txnNumber`, `orderStatus`, `orderDate`) VALUES
(4, 253350102, 12, 10, 190.00, 'Internet Banking', '265478991002', 'Delivered', '2025-05-15 12:58:45'),
(5, 339030057, 12, 10, 10.00, 'Debit/Credit Card', '335577822', 'Cancelled', '2025-05-26 13:42:54'),
(6, 988027989, 12, 11, 24.00, 'e-Wallet', '265478991002', 'Delivered', '2025-06-16 08:35:55'),
(7, 402730141, 12, 11, 7.00, 'Debit/Credit Card', '265478991002', 'Delivered', '2025-06-16 12:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `ordersdetails`
--

CREATE TABLE `ordersdetails` (
  `id` int(11) NOT NULL,
  `orderNumber` bigint(12) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordersdetails`
--

INSERT INTO `ordersdetails` (`id`, `orderNumber`, `userId`, `productId`, `quantity`, `orderDate`, `orderStatus`) VALUES
(1, 768821081, 9, 9, 2, '2024-11-25 16:37:25', NULL),
(2, 423539739, 10, 9, 1, '2024-11-26 03:59:20', NULL),
(3, 850911570, 11, 9, 1, '2024-11-26 16:11:48', NULL),
(4, 850911570, 11, 2, 1, '2024-11-26 16:11:48', NULL),
(6, 253350102, 12, 9, 1, '2025-05-15 12:58:45', NULL),
(7, 339030057, 12, 6, 1, '2025-05-26 13:42:54', NULL),
(8, 988027989, 12, 11, 1, '2025-06-16 08:35:55', NULL),
(9, 988027989, 12, 8, 3, '2025-06-16 08:35:55', NULL),
(10, 402730141, 12, 11, 1, '2025-06-16 12:33:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `actionBy` int(3) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `canceledBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `actionBy`, `postingDate`, `canceledBy`) VALUES
(15, 4, 'Out For Delivery', 'done', 1, '2025-05-15 13:00:48', NULL),
(16, 4, 'Delivered', '.', 1, '2025-05-15 13:02:25', NULL),
(17, 5, 'Cancelled', 'ok', NULL, '2025-05-26 13:43:31', 'User'),
(18, 5, 'Cancelled', 'b', 1, '2025-06-16 08:37:57', ' Admin'),
(19, 6, 'Dispatched', 'g', 1, '2025-06-16 08:38:40', NULL),
(20, 6, 'Delivered', 'r', 1, '2025-06-16 08:40:04', NULL),
(21, 7, 'Delivered', 'delevered', 1, '2025-06-16 12:34:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `variety` varchar(255) DEFAULT NULL,
  `Availablein` varchar(250) DEFAULT NULL,
  `Quantity` varchar(250) DEFAULT NULL,
  `productPrice` decimal(10,2) DEFAULT NULL,
  `productPriceBeforeDiscount` decimal(10,2) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` decimal(10,2) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `addedBy` int(11) DEFAULT NULL,
  `lastUpdatedBy` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `variety`, `Availablein`, `Quantity`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `addedBy`, `lastUpdatedBy`) VALUES
(6, 2, 12, 'Banana', 'Banana', 'Count', '6 pcs', 8.00, 10.00, 'While the Robusta bananas are quite long and cylindrical in shape, our next variety is quite different in shape as well as size. \r\n\r\nThe Poovan banana is an extremely popular choice among Indians due to its delicious combination of sweet and slightly sour flavours. However, this variety is available in very small sizes with a round-like appearance. ', 'd95c01482e339f382c38af072cc3066f.jpg', 'd95c01482e339f382c38af072cc3066f.jpg', 'd95c01482e339f382c38af072cc3066f.jpg', 2.00, 'In Stock', '2025-02-06 05:59:27', '2025-06-14 09:08:28', 1, 1),
(8, 2, 16, 'Blueberries', 'Blueberries', 'KG', '100 gm', 5.00, 9.00, 'Experience the vibrant essence of blueberries, bursting with natural sweetness and a delightful hint of tartness. These plump, juicy berries are meticulously cultivated to ensure peak flavour and freshness. Whether enjoyed fresh on their own, blended into smoothies, or baked into pies and muffins, each blueberry offers a taste of summer in every bite.', '9f099824b937d057795772e453ca2426.jpg', '9f099824b937d057795772e453ca2426.jpg', '9f099824b937d057795772e453ca2426.jpg', 2.00, 'In Stock', '2025-03-06 06:04:57', '2025-06-14 09:08:04', 1, 1),
(9, 2, 16, 'Strawberries', 'Strawberries', 'KG', '250 gm', 12.00, 20.00, 'Extremely juicy and syrupy, these conical heart shaped fruits have seeds on the skin that give them a unique texture. With a blend of sweet-tart flavour, these are everyones favourite berries.', '9624a11e5d3dc09ca4137a4a13d04592.jpg', '9624a11e5d3dc09ca4137a4a13d04592.jpg', '9624a11e5d3dc09ca4137a4a13d04592.jpg', 2.00, 'In Stock', '2025-03-06 06:07:04', '2025-06-14 09:08:47', 1, 1),
(10, 2, 14, 'Mango', 'Alphonso', 'KG', '1 KG', 5.00, 10.00, 'Badami is called Karnatakas Alphonso due to its sweet taste. It has a pale-yellow skin with yellowish-orange flesh. In India, the Alphonso mango, known as the \"King of Mangoes,\" reigns supreme for its unparalleled sweetness and creamy texture. Badami mango, from Karnataka, renowned for its delicate sweetness and smooth flesh. Both varieties thrive in India tropical climate, embodying the essence of summer with their juicy perfection. Badami mangoes are enjoyed fresh, in desserts like mango lassi, and as a prized ingredient in chutneys and preserves. Never miss the mangoes during the season.', '46f682877291aaae9b38f76c5f055762.jpg', '46f682877291aaae9b38f76c5f055762.jpg', '46f682877291aaae9b38f76c5f055762.jpg', 2.00, 'In Stock', '2025-03-06 06:09:39', '2025-06-14 09:09:16', 1, 1),
(11, 1, 6, 'Tometo', 'cherry tomatoes', 'KG', '500 gm', 5.00, 9.00, 'Fresh tomatoes ', '568acfbb01695785c89f7316ac89f181.png', '568acfbb01695785c89f7316ac89f181.png', '568acfbb01695785c89f7316ac89f181.png', 2.00, 'In Stock', '2025-06-16 08:13:55', NULL, 1, NULL),
(12, 1, 9, 'beans', 'kidney bean', 'KG', '500 gm', 3.00, 6.00, 'Kidney bean ', '5b60bfe3da8c3c9d04b672ec63b2bcdc.png', '5b60bfe3da8c3c9d04b672ec63b2bcdc.png', '5b60bfe3da8c3c9d04b672ec63b2bcdc.png', 2.00, 'Out of Stock', '2025-06-16 08:31:31', '2025-06-16 10:10:43', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategoryName` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategoryName`, `creationDate`, `updationDate`, `createdBy`) VALUES
(1, 1, 'Leafy green', '2024-11-05 06:53:37', '2024-11-05 07:00:41', 1),
(2, 1, 'Root vegetables', '2024-11-05 06:53:52', NULL, 1),
(3, 1, 'Bulb vegetables', '2024-11-05 06:54:06', NULL, 1),
(4, 1, 'Stem vegetables', '2024-11-05 06:54:21', NULL, 1),
(5, 1, 'Flower vegetables', '2024-11-05 06:54:34', NULL, 1),
(6, 1, 'Fruit vegetables', '2024-11-05 06:54:49', NULL, 1),
(7, 1, 'Pod vegetables', '2024-11-05 06:55:07', NULL, 1),
(8, 1, 'Tuber vegetables', '2024-11-05 06:55:26', NULL, 1),
(9, 1, 'Seed vegetables', '2024-11-05 06:55:38', NULL, 1),
(10, 1, 'Fungi', '2024-11-05 06:55:52', NULL, 1),
(11, 2, 'Apple', '2024-11-05 06:57:06', NULL, 1),
(12, 2, 'Banana', '2024-11-05 06:57:16', NULL, 1),
(13, 2, 'Grapes', '2024-11-05 06:57:34', NULL, 1),
(14, 2, 'Mango', '2024-11-05 06:57:44', NULL, 1),
(15, 2, 'Apricot', '2024-11-05 06:58:00', NULL, 1),
(16, 2, 'Berries', '2024-11-05 06:58:19', NULL, 1),
(17, 2, 'Guava', '2024-11-05 06:58:33', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactNumber` bigint(12) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `username`, `password`, `contactNumber`, `creationDate`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 45231025890, '2025-01-23 16:21:18', '2025-06-14 08:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `regDate`, `updationDate`) VALUES
(10, 'Test', 'test@gmail.com', 7894561239, '81dc9bdb52d04dc20036dbd8313ed055', '2025-01-24 03:34:24', '2025-05-26 03:47:53'),
(12, 'boss', 'boss@gmail.com', 1234567812, '202cb962ac59075b964b07152d234b70', '2025-05-13 14:16:19', '2025-06-14 15:01:59'),
(13, 'Axmed', 'ahhmed@gmail.com', 1234567890, '202cb962ac59075b964b07152d234b70', '2025-05-15 13:12:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(1, 8, 0, '2024-11-11 05:45:51'),
(3, 8, 7, '2024-11-14 04:56:10'),
(4, 7, 2, '2024-11-18 04:37:40'),
(5, 7, 10, '2024-11-18 04:47:02'),
(6, 9, 9, '2024-11-26 03:31:11'),
(7, 10, 2, '2024-11-26 11:24:39'),
(9, 12, 9, '2025-05-13 14:17:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userrrid` (`userId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uiid` (`userID`),
  ADD KEY `piddd` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uidddd` (`userId`),
  ADD KEY `addressid` (`addressId`),
  ADD KEY `orderNumber` (`orderNumber`);

--
-- Indexes for table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderidd` (`orderNumber`),
  ADD KEY `useridd` (`userId`),
  ADD KEY `productiddd` (`productId`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderidddddd` (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catidddd` (`category`),
  ADD KEY `subCategory` (`subCategory`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`categoryid`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usseridddd` (`userId`),
  ADD KEY `ppiidd` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
