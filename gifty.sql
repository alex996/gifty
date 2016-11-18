-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2016 at 03:58 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gifty`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `city`, `state`, `country`, `zip`) VALUES
(1, '1550 Main Street', 'New York', 'NY', 'US', '12345'),
(2, '7280 Liberty Avenue', 'Chicago', 'IL', 'US', '24550'),
(3, '3280 St. George Blvd.', 'Phoenix', 'AZ', 'US', '98372'),
(4, '2890 Willston Street', 'Los Angeles', 'CA', 'US', '19032'),
(5, '12 Luther King Avenue', 'Seattle', 'WA', 'US', '45289'),
(6, '984 Bauer Street', 'Sacremento', 'CA', 'US', '34290'),
(7, '872 J. F. Kennedy Boulevard', 'Boston', 'MA', 'US', '13432');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(7) UNSIGNED DEFAULT NULL,
  `sess_id` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `quantity` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'electronics'),
(2, 'beauty'),
(3, 'fashion'),
(4, 'toys'),
(5, 'games'),
(6, 'drinks'),
(7, 'candies'),
(8, 'flowers'),
(9, 'home'),
(10, 'accessories');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(7) UNSIGNED NOT NULL,
  `user_id` int(7) UNSIGNED NOT NULL,
  `first` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first`, `last`, `dob`, `phone`) VALUES
(1, 4, 'Liza', 'White', '1989-05-12', '2329029302'),
(2, 3, 'Isaac', 'Davidson', '0000-00-00', '3452320923'),
(3, 5, 'Aiden', 'Carlton', '0000-00-00', '9235842359');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(7) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(7) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` decimal(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(12) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL,
  `quantity` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(7) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `cardholder` varchar(100) NOT NULL,
  `last_digits` int(4) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `customer_id`, `type`, `cardholder`, `last_digits`, `address_id`) VALUES
(1, 3, 'VISA', 'CAITLIN SMITH', 9039, 5),
(2, 2, 'MASTERCARD', 'JOHN GARTNER', 2390, 3),
(3, 1, 'INTERAC', 'LIZA WHITE', 3421, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(3) UNSIGNED NOT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL,
  `promotion_id` int(5) UNSIGNED DEFAULT NULL,
  `quantity` int(5) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `promotion_id`, `quantity`, `status`, `featured`) VALUES
(1, 'Red Wine from Paris', 'Excellent quality, superb taste, and low price! What can be better? Feel the taste of France in your glass', 6, '12.99', NULL, 100, 'IN_STOCK', 1),
(2, 'Fluffy Teddy Bear', 'Super cute and awesome Teddy Bear, just the one you dreamt of! 100% Cotton and 300% love! Make your girfriend happy again', 4, '25.99', 2, 50, 'IN_STOCK', 1),
(3, 'Greek Candies in Assortment', 'Have you ever been in Greece? Well, now is your chance! All you need to do is buy these amazingly delicious candies with a 100% Greek quality made in a candy shop in Athenes', 7, '10.99', NULL, 100, 'IN_STOCK', 1),
(4, 'Asus X988 Slim Black', 'Superior performance with a Octa-core Intel processor, 32 GB of RAM, 5 TB of SSD storage, and 4 GB of video - just about everything you will need for the rest of your life!', 1, '1999.99', NULL, 5, 'IN_STOCK', 1),
(5, 'Gucci Handbag (Italy) ', 'For those passionate about Italy, here is an excellent handbag that will fit any clothing, be a dress or a business suit. High quality and reasonable price!', 3, '99.99', 1, 20, 'IN_STOCK', 1),
(6, 'Face moisturizer, Avon', 'Proven quality and guaranteed satisfaction from one of the best known brands in the world - Avon', 2, '29.99', NULL, 40, 'IN_STOCK', 1),
(7, 'Assassin''s Creed II Empire', 'Fascinating and breath-taking action-packed video game, now available on Windows, MAC, and XBox. Hurry up, supply is limited!', 5, '32.99', NULL, 20, 'IN_STOCK', 1),
(8, 'Rose Tulips in a Bouquet ', 'Beautiful and fresh, these tulips will help you win the heart of any woman', 8, '17.46', NULL, 500, 'IN_STOCK', 0),
(9, 'Swing Set Table', 'Arguably one of the best presents to home lovers. Excellent wood quality and 100% security with money back guarantee. Shipped from Germany', 9, '189.23', NULL, 25, 'IN_STOCK', 1),
(10, 'Swiss Watch, Pure Leather', 'If you are looking for a gift for your boyfriend or husband, look no further. Here is a fantastic Swiss watch made in Zurich. Supreme quality and competitive price', 10, '299.12', NULL, 10, 'IN_STOCK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(5) UNSIGNED NOT NULL,
  `starts_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ends_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `starts_at`, `ends_at`, `discount`) VALUES
(1, '2016-11-18 04:55:17', '2016-11-30 00:00:00', '0.15'),
(2, '2016-11-22 05:00:00', '2016-11-22 22:00:00', '0.25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(7) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rating` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `product_id`, `comment`, `rating`, `created_at`) VALUES
(1, 3, 1, 'Wow, this product is just amazing, and I can''t believe the shipping was so blazingly fast!', 5, '2016-11-17 18:51:25'),
(2, 1, 4, 'Awesome! I bought this for my bf, he is so happy!!!', 5, '2016-11-17 18:52:25'),
(3, 2, 5, 'Nuh, I expected more to be honest, especially for this price. I''ll give it a 4. The shipping was good though, I got my delivery in 20 hours.', 4, '2016-11-17 18:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Alex', 'alex@gmail.com', '$2y$10$z5ieU/vjT.Qq6SCCx2jZQex5j9H1Su0eXnmdrnoiDoiF5Qs0EoDKS', 'ADMIN'),
(2, 'Josh', 'josh@gmail.com', '$2y$10$aCooVVV.dsH1Sw0dK3Zh0uNthD/XaQywPo0bvf1ylP5q2dQSvy8VK', 'ADMIN'),
(3, 'Isaac', 'isaac@gmail.com', '$2y$10$7dhoAspzXx6LAeLpFIgUMuarZMB./LynzGnB5zryk9Aak678EpFrq', 'CUSTOMER'),
(4, 'Liza', 'liza@gmail.com', '$2y$10$Oq4CI0v2FVnAnwatKsKM6ujSML1UasaQBCnidcBo3aRlXPz1LP0I2', 'CUSTOMER'),
(5, 'Aiden', 'aiden@gmail.com', '$2y$10$IsYe3Q4uGQZHhkGB/tYViO5UnqMK9nTPvM9E.GSr9d3e/sEIdnyQy', 'CUSTOMER'),
(6, 'Dwayne', 'dwayne@gmail.com', '$2y$10$V0rK3HALQnP..9woo3/RWuun85KVS47h3JgG7JbOscZG1E4t0HceW', 'CUSTOMER'),
(7, 'Emma', 'emma@gmail.com', '$2y$10$IOS6JFfuwq1L81rDKJftH.FOOmXVrjY1kEoDapWfs0Z6J5ysUQq4u', 'CUSTOMER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `method_id` (`method_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `promotion_id` (`promotion_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `payment_methods_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
