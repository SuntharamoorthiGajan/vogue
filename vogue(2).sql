-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 09:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcart`
--

CREATE TABLE `addcart` (
  `id` int(11) NOT NULL,
  `dress_id` int(11) NOT NULL,
  `dress_name` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addcart`
--

INSERT INTO `addcart` (`id`, `dress_id`, `dress_name`, `total_price`, `image`, `quantity`, `size`, `color`, `user_email`, `created_at`) VALUES
(35, 2, 'Levi\'s Essentials Women\'s Skinny Jean', 2500.00, 'img_66880cea6d1013.80829187.jpg', 1, ' L', 'Dark Wash', 'kajan@gmail.com', '2024-11-15 14:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `admindetail`
--

CREATE TABLE `admindetail` (
  `Email` varchar(30) NOT NULL,
  `usr_Name` varchar(25) DEFAULT NULL,
  `Passwords` varchar(120) DEFAULT NULL,
  `Con_Number` int(11) DEFAULT NULL,
  `Date_Of_Birth` varchar(30) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `pro_photo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admindetail`
--

INSERT INTO `admindetail` (`Email`, `usr_Name`, `Passwords`, `Con_Number`, `Date_Of_Birth`, `Address`, `pro_photo`) VALUES
('admin@gmail.com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 773461734, '1998-10-13', 'inuvil', 'img_admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE `dresses` (
  `id` int(11) NOT NULL,
  `dress_type` varchar(255) NOT NULL,
  `dress_name` text NOT NULL,
  `image_one` varchar(255) DEFAULT NULL,
  `image_two` varchar(255) DEFAULT NULL,
  `image_three` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `dress_price` decimal(10,2) NOT NULL,
  `dress_sizes` varchar(255) NOT NULL,
  `dress_colors` varchar(255) NOT NULL,
  `gender` enum('Men','Women','Children') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`id`, `dress_type`, `dress_name`, `image_one`, `image_two`, `image_three`, `company_name`, `dress_price`, `dress_sizes`, `dress_colors`, `gender`) VALUES
(1, 'Boho', 'Yuemengxuan Women Summer Boho Dress Flowy Sundress Floral Printing Sleeveless Tie Shoulder Maxi Dress Y2k Beachwear Dress', 'img_6688033273afe1.82086594.jpg', 'img_6688033273eb78.90410932.jpg', 'img_668803327415c1.11286050.jpg', 'Yuemengxuan', 2000.00, 'S, M, L, XL', 'Black, Blue, Green', 'Women'),
(2, 'Jean', 'Levi\'s Essentials Women\'s Skinny Jean', 'img_66880cea6d1013.80829187.jpg', 'img_66880cea6d37c7.90889999.jpg', 'img_66880cea6d5293.95867040.jpg', 'Levi\'s', 2500.00, 'S, M, L, XL', 'Dark Wash, Light Blue, Light Olive', 'Women'),
(3, 'T Shirts', 'Women\'s Graphic Tees Casual Summer Funny Dragonfly Printed Short Sleeve Cute T Shirts Tops', 'img_668811fd57ab89.95206421.jpg', 'img_668811fd57c407.24614588.jpg', 'img_668811fd57d228.53173424.jpg', 'Jnifuli', 800.00, 'S, M, L, XL', 'Grey, Yellow, Purple', 'Women'),
(4, 'Shirt', 'COOFANDY Mens Hawaiian Shirts Short Sleeve Tropical Button Down Shirts Casual Summer Beach Shirts', 'img_66881f12017746.04443178.jpg', 'img_66881f120191d5.75728618.jpg', 'img_66881f12019fe3.08320774.jpg', 'Coofandy', 1200.00, 'S, M, L, XL', 'Leaves Green, Palm Leaves Black, Palm Tree Blue', 'Men'),
(5, 'Shirt', 'COOFANDY Men\'s Silk Satin Dress Shirts Jacquard Long Sleeve Floral Button Up Shirts Party Prom Wedding Shirt', 'img_6688223e72ccf0.23215416.jpg', 'img_6688223e72ffc0.80864793.jpg', 'img_6688223e7311a3.83901817.jpg', 'Coofandy', 2200.00, 'S, M, L, XL', 'Black, Red, Beige', 'Men'),
(6, 'Pant', 'Haggar Men\'s Premium Comfort Classic Fit Flat Front Hidden Comfort Waistband Pant', 'img_668823a3b63ad3.57819044.jpg', 'img_668823a3b662c1.09459643.jpg', 'img_668823a3b674e1.56208641.jpg', 'Haggar', 3000.00, '30, 32, 34, 36', 'Black,  Charcoal, Grey', 'Men'),
(8, 'Top', 'HOSIKA Girls Floral Dress Boho Ruffle Sleeve Pleated Casual Swing Dresses with Pockets', 'img_66882605777e58.98635951.jpg', 'img_66882605779648.96443852.jpg', 'img_6688260577a2e4.76013526.jpg', 'Hosika', 800.00, ' 6 Years, 8 Years, 10 Years, 12 Years', 'Red Floral, Light Blue, Pink-long Sleeve', 'Children'),
(9, 'Jean', 'Boy\'s Stylish Moto Biker Skinny Ripped Wrinkled Stretch Fit Denim Jeans', 'img_66882803b530a0.59831389.jpg', 'img_66882803b54a81.52128427.jpg', 'img_66882803b557a6.05775098.jpg', 'Levi\'s', 1800.00, ' 6 Years, 8 Years, 10 Years, 12 Years', ' Light Blue, Navy, Camo', 'Children'),
(10, 'Suit Sets', 'SANMIO Baby Boy Clothes Suits Infant Gentleman Outfit Collared Dress Shirt+Vest+Tie+Corsage+Pants 5Pcs Baby Suit Sets', 'img_668829b6c739f4.25798268.jpg', 'img_668829b6c78712.83813129.jpg', 'img_668829b6c7b570.15535790.jpg', 'Sanmio', 2000.00, ' 6 Months, 8 Months, 10 Months, 12 Months ', 'Easter Pink, Apricot+green, Summer Navy', 'Children');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `dress_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `delivery_address` text NOT NULL,
  `bank_card_number` varchar(16) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `dress_id`, `size`, `color`, `total_price`, `quantity`, `phone_number`, `delivery_address`, `bank_card_number`, `user_id`, `order_date`, `status`) VALUES
(22, 1, 'S', ' Blue', 2000.00, 1, '0763769389', 'jaffna', '635727', 'kajan@gmail.com', '2024-11-14 07:34:17', 'Delivery'),
(23, 2, ' M', 'Dark Wash', 2500.00, 1, '755738219', 'uduvil', '346776', 'kajan@gmail.com', '2024-11-14 07:38:35', 'Delivery'),
(24, 2, 'S', ' Light Blue', 2500.00, 1, '96387638', 'inuvil', '546767', 'kajan@gmail.com', '2024-11-14 07:39:25', 'New order'),
(25, 5, ' M', 'Black', 2200.00, 1, '96387638', 'inuvil', '546767', 'kajan@gmail.com', '2024-11-14 07:39:25', 'New order'),
(26, 5, ' M', 'Black', 6600.00, 3, '077427172', 'inuvil', '49874935', 'jhon@gmail.com', '2024-11-15 05:37:59', 'New order'),
(27, 3, ' M', 'Grey', 800.00, 1, '0774563723', 'jaffna', '089787', 'kajan@gmail.com', '2024-11-15 14:01:05', 'New order');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `Email` varchar(30) NOT NULL,
  `usr_Name` varchar(25) DEFAULT NULL,
  `Passwords` varchar(120) DEFAULT NULL,
  `Con_Number` int(11) DEFAULT NULL,
  `Date_Of_Birth` varchar(30) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `pro_photo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`Email`, `usr_Name`, `Passwords`, `Con_Number`, `Date_Of_Birth`, `Address`, `pro_photo`) VALUES
('jhon@gmail.com', 'jhon', '827ccb0eea8a706c4c34a16891f84e7b', 776739879, '1992-11-10', 'uduvil', 'img_jhon.jpg'),
('kajan@gmail.com', 'kajan', '827ccb0eea8a706c4c34a16891f84e7b', 770281538, '1995-11-13', 'uduvil', 'img_kajan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcart`
--
ALTER TABLE `addcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admindetail`
--
ALTER TABLE `admindetail`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `dress_id` (`dress_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addcart`
--
ALTER TABLE `addcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dresses`
--
ALTER TABLE `dresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`dress_id`) REFERENCES `dresses` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_registration` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
