-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2024 at 07:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mca_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`, `created_at`, `updated_at`) VALUES
(1, '<p>We believe that RKU is a place where “Change” happens. Our students are challenged and motivated to change their perspectives by our faculties. Our faculties constantly change their pedagogies and instructional approaches to match industry requirements and student needs. Our students go on to change the society with the knowledge they have acquired at RKU.</p><p>It is virtuous cycle of “change” that happens only in the beautiful and serene campus of RKU.</p><p>Join us if you want to change your thinking and your perspectives.</p><p>Join us if you want to change the world.</p><h3>Vision</h3><p>To be a leading educational organization imparting holistic education to help students become responsible world citizens who are sensitive to the needs of the society.</p><h3>Mission</h3><p>To develop a community of students and academicians who are a part of world class education system which is developed in a manner which supports the intellectual, professional and moral growth of the students leading to advancement of human knowledge through enterprising research.</p>', '2024-10-11 09:49:42', '2024-10-14 18:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `best_practices`
--

CREATE TABLE `best_practices` (
  `id` int NOT NULL,
  `img_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `best_practices`
--

INSERT INTO `best_practices` (`id`, `img_name`) VALUES
(1, '6708d1fb07178AAC_RK University.png'),
(2, '6708d209297a1ACOPAS_RK University.png'),
(3, '6708d2109d800ARL_RK University.png'),
(4, '6708d2184bbc3CDRC RK University.png'),
(5, '6708d228341b4CESL_RK University.png'),
(6, '6708d22fa5da4CPD_RK University.png'),
(7, '6708d2355c053IIIC_RK University.png'),
(8, '6708d23ea098aIQAC_RK University.png'),
(9, '6708d24bdf044KSPCFE_RK University.png'),
(10, '6708d2521e378SOAC_RK University.png'),
(11, '6708d259eadaeTPO_RK University.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `product_id`, `quantity`, `total_price`) VALUES
(8, 'jankikansagra12@gmail.com', 6, 1, 2000),
(9, 'jankikansagra12@gmail.com', 6, 1, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', 'Active', '2024-11-12 21:49:23', '2024-11-13 10:22:11'),
(2, 'Mobiles', 'Active', '2024-11-12 21:56:38', '2024-11-12 21:56:38'),
(3, 'Headphones', 'Active', '2024-11-12 21:56:50', '2024-11-12 21:56:50'),
(4, 'Watches', 'Active', '2024-11-12 21:57:08', '2024-11-12 21:57:08'),
(5, 'Television', 'Active', '2024-11-12 21:57:15', '2024-11-12 21:57:15'),
(6, 'Coolers', 'Active', '2024-11-12 21:57:24', '2024-11-12 21:57:24'),
(7, 'Speakers', 'Active', '2024-11-12 21:57:59', '2024-11-12 21:57:59'),
(8, 'Washing Machine', 'Active', '2024-11-12 21:58:16', '2024-11-12 22:55:53'),
(9, 'Air Conditioners', 'Active', '2024-11-12 21:59:33', '2024-11-12 21:59:33'),
(10, 'Dish Washers', 'Active', '2024-11-12 22:56:15', '2024-11-12 22:56:15'),
(11, 'Microwave Ovens', 'Inactive', '2024-11-12 22:56:24', '2024-11-13 08:21:34'),
(12, 'Bluetooth', 'Active', '2024-11-13 08:21:21', '2024-11-13 08:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `content`, `created_at`, `updated_at`) VALUES
(1, '<h1>Address</h1><h4>Main Campus</h4><p>RK University,&nbsp;<br>Bhavnagar Highway, Kasturbadham,&nbsp;<br>Rajkot, Gujarat, India 360020&nbsp;<br><br>&nbsp;</p><h4>City Campus</h4><p>New 150ft Ring Road,<br>Mota Mawa,Kalawad Road,<br>Rajkot, Gujarat, India 360004.&nbsp;<br><br>&nbsp;</p><h4>Contact Details</h4><p>+91-9712489122&nbsp;<br>+91-9925714450</p>', '2024-10-14 18:41:14', '2024-10-22 09:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int NOT NULL,
  `fullname` char(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` bigint DEFAULT NULL,
  `message` text,
  `reply` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `fullname`, `email`, `mobile`, `message`, `reply`, `created_at`, `updated_at`) VALUES
(1, 'Janki Kansagra', 'janki.kansagra@rku.ac.in', 8155825235, 'Some issue with login', NULL, '2024-10-22 09:30:16', '2024-10-22 09:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int NOT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `other_images` text,
  `category_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `quantity` int NOT NULL DEFAULT '0',
  `status` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active',
  `discount` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `main_image`, `other_images`, `category_id`, `price`, `description`, `quantity`, `status`, `discount`, `created_at`, `updated_at`) VALUES
(6, 'Oppo F21 Pro', '673440fb640ecdownload (4).jpg', '673440fb640f4download (8).jpg,673440fb640f6download (9).jpg,673440fb640f8download (10).jpg', 2, '2000.00', 'fgffffffffffffffffffffffffffff', 5, 'Active', 5, '2024-11-13 11:32:35', '2024-11-13 14:50:36'),
(7, 'Samsung TV 54\"', '673441d023901download (15).jpg', '673441d023910download (11).jpg,673441d023915download (12).jpg,673441d023917download (13).jpg,673441d023919download (14).jpg,673441d02391adownload (16).jpg,673441d02391bdownload (17).jpg', 5, '2000.00', 'reeeeeeeeeeeeeeeeeeeeeeeee', 5, 'Active', 2, '2024-11-13 11:36:08', '2024-11-13 14:50:39'),
(8, 'Vivo', '67344856f0a81download (6).jpg', '67344856f0a8edownload (3).jpg,67344856f0a94download (4).jpg,67344856f0a96download (5).jpg', 2, '5000.00', '', 5, 'Active', 10, '2024-11-13 12:03:58', '2024-11-13 12:03:58'),
(9, 'Headphones', '67345eb2d1ae8download (23).jpg', '67345eb2d1af7download (24).jpg,67345eb2d1afedownload (25).jpg,67345eb2d1b00download (26).jpg,67345eb2d1b01images (2).jpg,67345eb2d1b03images (3).jpg,67345eb2d1b04images (4).jpg', 3, '300.00', '<ul><li>good</li></ul>', 5, 'Active', 0, '2024-11-13 13:39:22', '2024-11-13 13:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` char(10) NOT NULL,
  `mobile_number` bigint NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` char(10) DEFAULT 'Normal',
  `status` char(10) DEFAULT 'Inactive',
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fullname`, `email`, `password`, `address`, `gender`, `mobile_number`, `profile_picture`, `role`, `status`, `token`) VALUES
(1, 'Janki Kansagra', 'janki.kansagra@rku.ac.in', 'Pratyush@1234', 'RKU Rajkot', 'Female', 8155825235, '6734628fb8575134_Abstract_Background_1920x1080px.jpg', 'Admin', 'Active', ''),
(2, 'Janki Kansagra', 'jankikansagra12@gmail.com', 'Janki@12345', 'MAvdi, Rajkot', 'Female', 1478523690, '6734d94a342c9360_F_590453560_ugMuPncnGYB6XnJqmC8xiPQx4eg3jmMD.jpg', 'Normal', 'Active', '66e14d05b9969'),
(3, 'Mahendra Kagathara', 'mahendra.kagathara@rku.ac.in', 'Mahendra@12345', 'Rajkot -360004', 'Male', 1478523690, '66e15211934c8HD-wallpaper-landscape-river-sun-windows-11-windows-11.jpg', 'Normal', 'Deleted', '66e15211934cd'),
(4, 'janki', 'kansagrajanki1@gmail.com', 'Janki@12345', 'RK University', 'Female', 8155825235, '66e154b53fd62nature-windows-hd-download-wallpaper-preview.jpg', 'Normal', 'Active', '66e154b53fd6b'),
(5, 'Pratyush', 'pratyushf31@northstar.edu.in', 'Pratyush@123', 'Rajkot 360004', 'Male', 9347987804, '66e1562f4746fHD-wallpaper-landscape-river-sun-windows-11-windows-11.jpg', 'Normal', 'Inactive', '66e1562f47472'),
(6, 'Denish', 'denishfaldu25@gmail.com', 'Denish@1234', 'Silver Punps Rajkot', 'Male', 7383654448, '66e14d05b99661000_F_830286609_xOoyyXA9PzZ6PHWHllGqClBFY8QB6AcB.jpg', 'Normal', 'Inactive', '66e2570e02201'),
(7, 'Janki Kansagra', 'nisha.kukadiya@rku.ac.in', 'Nisha@12345', 'rajkot rku', 'Female', 1478523690, '66f374350b5327-8-2024.png', 'Normal', 'Inactive', '66f374350b535'),
(8, 'Parth', 'pkhokhar162@rku.ac1.in', 'Parth@1234', 'fhuisdyfsuifbuvsg', 'Male', 1478523690, '66f3827614310maxresdefault.jpg', 'Normal', 'Deleted', '66f3827614313'),
(9, 'Ghelani Forma', 'fghelani533@rku.ac.in', 'Foram@12345', 'RKU SDS Rajkot', 'Female', 8745874580, '66f65bb002accnature-windows-hd-download-wallpaper-preview.jpg', 'Normal', 'Inactive', '66f65bb002ace'),
(10, 'Hathila Laxmi', 'lhathila223@rku.ac.in', 'Laxmi@1234', 'SDSCE,RKU Rajkot', 'Female', 8956895623, '66f65c6e99ab71000_F_830286647_ac6I8ZSFxEWXqaLE8RFyy6drrGpoNWuz.jpg', 'Normal', 'Inactive', '66f65c6e99ab9'),
(11, 'Janki Kansagra', 'kansagrajanki2@gmail.com', 'Janki@1234', 'Eklavya school, Junagadh', 'Female', 9347987804, '66f65ec11efb21000_F_830982393_QWKEvasAlMYvKyiM1qIKnEiyjqG59rv9.jpg', 'Normal', 'Inactive', '66f65ec11efb5'),
(12, 'Janki', 'kansagrajanki@gmail.com', 'Janki@12345', 'Morbi, Ravapar Road', 'Female', 8115528523, '66f65bb002accnature-windows-hd-download-wallpaper-preview.jpg', 'Normal', 'Inactive', '66f65f5673531');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `img_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `img_name`) VALUES
(1, '6708d298915d0aria-slider.webp'),
(2, '6708d2a15032eart-of-living-rku-mou.webp'),
(3, '6708d2a853537NAAC_1.webp'),
(4, '6708d2b0063bdnirf-ranking-slider.webp'),
(5, '6708d2b9b0f82swacch award.webp');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `email`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'jankikansagra12@gmail.com', 6, '2024-11-14 00:44:23', '2024-11-14 00:44:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_practices`
--
ALTER TABLE `best_practices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`email`),
  ADD KEY `product` (`product_id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `best_practices`
--
ALTER TABLE `best_practices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_master` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
