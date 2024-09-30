-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 04:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_management_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `createdAt`, `updatedAt`) VALUES
(3, 'Electronics', '66f96e9405caf.jpg', '2024-09-29 15:13:24', '2024-09-29 15:13:24'),
(4, 'Home Appliances', '66f96ef4d0e77.jpg', '2024-09-29 15:15:00', '2024-09-29 15:15:00'),
(5, 'Fashion', '66f96f4e9e190.png', '2024-09-29 15:16:30', '2024-09-29 15:16:30'),
(6, 'Books', '66f96fbcd7cf7.jpg', '2024-09-29 15:18:20', '2024-09-29 15:18:20'),
(7, 'Toys & Games', '66f970104c881.jpg', '2024-09-29 15:19:44', '2024-09-29 15:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNumber` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `addressline` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `mobileNumber`, `fullname`, `dob`, `gender`, `city`, `state`, `country`, `zip`, `addressline`, `createdAt`, `updatedAt`) VALUES
(1, 'john.doe@example.com', '9876543210', 'John Doe', '2017-03-01', 'Male', 'Mumbai', 'Maharashtra', 'India', '400001', '123, Marine Drive, Colaba', '2024-09-29 15:22:55', '2024-09-29 15:22:55'),
(2, 'anita.singh@example.com', '9123456789', 'Anita Singh', '2015-02-11', 'Female', 'New Delhi', 'Delhi', 'India', '110001', '456, Connaught Place, Central Delhi', '2024-09-29 15:26:20', '2024-09-29 15:26:20'),
(3, 'rajesh.kumar@example.com', '9823456712', 'Rajesh Kumar', '2012-07-12', 'Male', 'Bengaluru', 'Karnataka', 'India', '560001', '789, MG Road, Indiranagar', '2024-09-29 15:27:11', '2024-09-29 15:27:11'),
(4, 'fatima.shaikh@example.com', '9988776655', 'Fatima Shaikh', '2001-03-07', 'Female', 'Hyderabad', 'Telangana', 'India', '500001', '321, Banjara Hills, Jubilee Hills', '2024-09-29 15:28:08', '2024-09-29 15:28:08'),
(5, 'arjun.mehra@example.com', '9876123456', 'Arjun Mehra', '2012-03-07', 'Male', 'Chennai', 'Tamil Nadu', 'India', '600001', '654, Anna Salai, T. Nagar', '2024-09-29 15:28:54', '2024-09-29 15:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `price`, `stock`, `categoryId`, `createdAt`, `updatedAt`) VALUES
(2, 'Wireless Bluetooth Headphones', 'High-quality wireless headphones with noise cancellation and up to 20 hours of battery life.', '66f96ec7ec3a0.jpg', 8299, 50, 3, '2024-09-29 15:14:15', '2024-09-29 15:14:15'),
(3, 'Smartwatch with Heart Rate Monitor', 'A sleek smartwatch with fitness tracking, heart rate monitoring, and waterproof design.', '66f96ee52a566.jpg', 12499, 30, 3, '2024-09-29 15:14:45', '2024-09-29 15:14:45'),
(4, 'Air Fryer 5.5L', 'A large-capacity air fryer that allows you to cook healthier meals with little to no oil.', '66f96f1e304a3.jpg', 6599, 100, 4, '2024-09-29 15:15:42', '2024-09-29 15:15:42'),
(5, 'Robot Vacuum Cleaner', 'A smart vacuum cleaner with advanced navigation and scheduled cleaning capabilities.', '66f96f3d4d770.png', 20799, 20, 4, '2024-09-29 15:16:13', '2024-09-29 15:16:13'),
(6, 'Leather Jacket', 'A stylish, premium leather jacket perfect for casual and formal wear.', '66f96f7806feb.png', 16599, 40, 5, '2024-09-29 15:17:12', '2024-09-29 15:17:12'),
(7, 'Sports Sneakers', 'Lightweight, breathable sports sneakers designed for maximum comfort and performance.', '66f96f982579b.jpg', 7499, 60, 5, '2024-09-29 15:17:44', '2024-09-29 15:17:44'),
(8, '\"The Art of War\" by Sun Tzu', 'A classic text on strategy and military tactics, applicable to business and life.', '66f96fdd15973.png', 1099, 120, 6, '2024-09-29 15:18:53', '2024-09-29 15:18:53'),
(9, '\"Atomic Habits\" by James Clear', 'A bestselling book that provides practical strategies to form good habits and break bad ones.', '66f96ffa9f639.jpg', 1399, 80, 6, '2024-09-29 15:19:22', '2024-09-29 15:19:22'),
(10, 'Remote Control Car', 'A fast and durable remote control car with high-performance suspension.', '66f97030ad7e4.jpg', 3299, 150, 7, '2024-09-29 15:20:16', '2024-09-29 15:20:16'),
(11, 'Puzzle Game Set', 'A collection of 5 classic puzzle games designed to challenge and entertain both kids and adults.', '66f9704a0b5da.jpg', 2099, 70, 7, '2024-09-29 15:20:42', '2024-09-29 15:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `addressline` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mobileNumber`, `password`, `firstName`, `lastName`, `username`, `filename`, `dob`, `gender`, `city`, `state`, `country`, `zip`, `addressline`, `status`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'test@admin.com', '7777777777', '$2y$10$3kPUiSRM/ZlG/AEYFlpLaeYWrL8weldj7gSevO7xRLuPrTpVXisci', 'test', 'admin', 'test@admin', '66f643f22ba3b.jpg', '2007-08-16', 'male', 'test', 'test', 'test', 'test', 'test', 'active', 'admin', '2024-09-26 23:58:10', '2024-09-27 00:05:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNumber` (`mobileNumber`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNumber` (`mobileNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
