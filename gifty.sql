-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 03:29 AM
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
(7, '872 J. F. Kennedy Boulevard', 'Boston', 'MA', 'US', '13432'),
(9, '1990 Rue de l''Eglise', 'Montreal', 'Quebec', 'CA', 'H5G1K5'),
(12, '2323 Rue des Heros', 'Ville de Quebec', 'Quebec', 'CA', 'J8K2F5'),
(13, '2889 Rue de la Liberte', 'Montreal', 'Quebec', 'CA', 'H9K2L3'),
(14, 'ad', 'asdf', 'asdf', 'US', '12222222'),
(15, 'dsf', 'asdf', 'asdf', 'CA', 'h4x 2g2'),
(16, 'dfasd', 'asdf', 'asdf', 'CA', '12322-1321'),
(17, '891 Dupray Street', 'Vancouver', 'British Columbia', 'CA', 'V7D 9L3'),
(18, '17763 Rue du Soleil', 'Longueuil', 'Quebec', 'CA', 'H4S 9K3'),
(19, '745 Rue de la Republique', 'Montreal', 'QC', 'CA', 'H4L 2D2'),
(20, '232 Kernberg Street', 'Los Angeles', 'California', 'US', '23233'),
(21, '274 Barkley Street', 'Sacremento', 'LA', 'US', '34232'),
(22, '3242 Charles K. Street', 'Manhattan', 'NY', 'US', '23423'),
(23, 'Test', 'test', 'test', 'CA', '23423'),
(24, 'Test', 'test', 'test', 'CA', '23423'),
(25, 'test', 'test', 'test', 'CA', '23423'),
(26, 'test', 'test', 'test', 'CA', '23423');

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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `sess_id`, `created_at`) VALUES
(45, 5, '21l7tnjv23b9854geaqhsjuvi0', '2016-11-22 08:48:23'),
(46, 4, '1qd5kecpj8porvhjp6govfo5f2', '2016-11-23 01:56:05'),
(51, 5, 'd1vlmbnqj1ic8qromf4c43h096', '2016-11-25 06:53:12'),
(55, 4, 'u424h1urukg8uvpmll0u1kj6m0', '2016-11-26 03:30:25'),
(56, NULL, '1fehii05o6je254apgtmlfg1j1', '2016-11-26 04:31:36'),
(61, NULL, 'u8erqfvigkjcnhl0ljsqp104g4', '2017-01-09 02:27:42');

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

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(55, 45, 4, 1),
(56, 45, 1, 2),
(57, 45, 10, 2),
(58, 45, 9, 1),
(59, 45, 5, 1),
(77, 46, 1, 2),
(94, 51, 12, 1),
(127, 55, 7, 1),
(128, 56, 9, 1),
(145, 61, 4, 1),
(146, 61, 5, 1);

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
(1, 4, 'Liza', 'White', '1989-05-12', '514-967-8903'),
(2, 3, 'Isaac', 'Davidson', '2016-06-07', '3452320923'),
(4, 6, 'Dwayne', 'Johnson', '2016-11-16', '7567567566'),
(5, 5, 'Aiden', 'Carlton', '1986-11-27', '2342342342'),
(6, 8, 'asdfasfd', 'asdfasfd', '2016-11-24', '2342342342'),
(7, 9, 'test', 'test', '1999-01-08', '5144313771');

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

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `path`, `alt_text`, `featured`) VALUES
(12, 1, '/img/drinks/red-wine-paris-10.jpg', 'Red wine from paris', 1),
(13, 1, '/img/drinks/red-wine-bottle-and-wine-glass-psd-b-jpg-kp0909-clipart.jpg', 'wine', 0),
(14, 4, '/img/electronics/key-visual.png', 'laptop', 1),
(15, 4, '/img/electronics/asus-rog-laptop-big.jpg', 'lap', 0),
(16, 11, '/img/electronics/l_10151578_001.jpg', 'iphone', 1),
(17, 12, '/img/electronics/macbook-pro-retina-2014-mg-1117-large.jpg', 'laptop', 1),
(18, 13, '/img/electronics/google-pixel-and-pixel-xl.jpg', 'pixel', 1),
(19, 14, '/img/electronics/ipad-air-2-vs-galaxy-tab-s2-97-inch-tablet.jpg', 'galaxy', 1),
(20, 15, '/img/electronics/bose-soundlink-ii-circum-aural.jpg', 'headphones', 1),
(21, 2, '/img/toys/pinkBear.jpg', 'Pink Bear', 1),
(22, 3, '/img/candies/2900-02013B.jpg', 'Greek Candy', 0),
(23, 3, '/img/candies/greekCandy.jpg', 'Greek Candy', 1),
(24, 5, '/img/fashion/gucci hand bag.jpg', 'Gucci hand bag', 0),
(25, 5, '/img/fashion/gucci-bags-74.jpg', 'Hand bag', 1),
(26, 6, '/img/beauty/moisturizer_avon.jpg', 'Moisturizer', 1),
(28, 7, '/img/games/assassins-creed.jpg', 'Assassin creed', 1),
(30, 8, '/img/flowers/tulip.jpg', 'Rose bouquet', 1),
(32, 9, '/img/home/table-big.jpg', 'Swing table', 1),
(34, 10, '/img/accessories/2016-Swiss-Watches-gold.jpg', 'watch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(7) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` decimal(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address_id`, `payment_method_id`, `status`, `total`, `created_at`) VALUES
(15, 4, 13, 6, 'PENDING', '0.00', '2016-11-25 06:59:45'),
(16, 4, 17, 7, 'DELIVERED', '1091.97', '2016-11-25 06:14:24'),
(18, 5, 19, 8, 'APPROVED', '1967.99', '2016-11-25 11:53:04'),
(19, 4, 17, 7, 'CANCELLED', '0.00', '2016-11-25 11:55:38'),
(20, 4, 13, 7, 'DELIVERED', '418.76', '2016-11-26 07:37:50'),
(21, 4, 17, 7, 'PENDING', '9502.10', '2016-11-26 08:19:00'),
(22, 4, 21, 9, 'PENDING', '4527.96', '2016-11-26 08:23:47'),
(23, 7, 24, 10, 'CANCELLED', '0.00', '2017-01-09 03:17:31'),
(24, 7, 24, 10, 'PENDING', '599.99', '2017-01-09 05:02:12'),
(25, 7, 24, 10, 'DELIVERED', '649.49', '2017-01-09 00:33:32'),
(26, 7, 26, 10, 'APPROVED', '527.52', '2017-01-09 00:33:24');

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

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(2, 16, 14, '491.99', 1),
(3, 16, 15, '299.99', 2),
(7, 18, 12, '1967.99', 1),
(12, 20, 10, '209.38', 2),
(14, 21, 14, '491.99', 2),
(15, 21, 5, '99.99', 5),
(16, 21, 4, '3999.99', 2),
(17, 21, 2, '18.19', 1),
(19, 22, 14, '491.99', 1),
(20, 22, 12, '1967.99', 2),
(21, 22, 5, '99.99', 1),
(25, 24, 14, '599.99', 1),
(27, 25, 3, '10.99', 50),
(28, 25, 5, '99.99', 1),
(29, 26, 3, '10.99', 48);

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
(1, 4, 'VISA', 'DWAYNE JOHNSON', 9039, 5),
(2, 2, 'MASTERCARD', 'JOHN GARTNER', 2390, 3),
(3, 1, 'INTERAC', 'LIZA WHITE', 3421, 2),
(6, 4, 'MASTERCARD', 'DWAYNE JOHNSON', 2131, 12),
(7, 4, 'MASTERCARD', 'DWAYNE JOHNSON', 2342, 18),
(8, 5, 'MASTERCARD', 'AIDEN CARLTON', 2323, 20),
(9, 4, 'MASTERCARD', 'DWAYNE JOHNSON', 2342, 22),
(10, 7, 'VISA', 'test', 4234, 25);

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
(1, 'Red Wine from Paris', 'Excellent quality, superb taste, and low price! What can be better? Feel the taste of France in your glass', 6, '12.99', 1, 118, 'IN_STOCK', 1),
(2, 'Fluffy Teddy Bear', 'Super cute and awesome Teddy Bear, just the one you dreamt of! 100% Cotton and 300% love! Make your girfriend happy again', 4, '25.99', 1, 48, 'IN_STOCK', 1),
(3, 'Greek Candies in Assortment', 'Have you ever been in Greece? Well, now is your chance! All you need to do is buy these amazingly delicious candies with a 100% Greek quality made in a candy shop in Athenes', 7, '10.99', NULL, 100, 'IN_STOCK', 1),
(4, 'Asus X988 Slim Black', 'Superior performance with a Octa-core Intel processor, 32 GB of RAM, 5 TB of SSD storage, and 6 GB of video - just about everything you will need for the rest of your life!', 1, '3999.99', 3, 2, 'IN_STOCK', 1),
(5, 'Gucci Handbag (Italy) ', 'For those passionate about Italy, here is an excellent handbag that will fit any clothing, be a dress or a business suit. High quality and reasonable price!', 3, '99.99', NULL, 17, 'IN_STOCK', 1),
(6, 'Face moisturizer, Avon', 'Proven quality and guaranteed satisfaction from one of the best known brands in the world - Avon', 2, '29.99', NULL, 37, 'IN_STOCK', 1),
(7, 'Assassin''s Creed II Empire', 'Fascinating and breath-taking action-packed video game, now available on Windows, MAC, and XBox. Hurry up, supply is limited!', 5, '32.99', 2, 16, 'IN_STOCK', 1),
(8, 'Purple Tulips', 'Beautiful and fresh, these tulips will help you win the heart of any woman', 8, '17.46', NULL, 495, 'IN_STOCK', 0),
(9, 'Swing Set Table', 'Arguably one of the best presents to home lovers. Excellent wood quality and 100% security with money back guarantee. Shipped from Germany', 9, '189.23', NULL, 25, 'IN_STOCK', 1),
(10, 'Swiss Watch, Pure Leather', 'If you are looking for a gift for your boyfriend or husband, look no further. Here is a fantastic Swiss watch made in Zurich. Supreme quality and competitive price', 10, '299.12', 3, 8, 'IN_STOCK', 1),
(11, 'Apple iPhone 7 32GB Black', 'Extremely powerful and fast, this is the phone you were waiting for and now it''finally out for sale!', 1, '799.99', NULL, 80, 'IN_STOCK', 0),
(12, 'Apple MacBook Pro 15"', 'Extraordinarily beautiful and performant, the MacBook Pro is the certainly the next device on your wish list', 1, '2399.99', 2, 17, 'IN_STOCK', 1),
(13, 'Google Pixel', 'Ready to buy a new phone? We recommend Google Pixel, the latest smartphone by Google with the ultimate Android experience. Awesome camera, display, and customization features make this phone a dream!', 1, '999.99', NULL, 30, 'IN_STOCK', 0),
(14, 'Galaxy Tab S2 VE 9.7" (4G)', 'If you are tight on budget, here is an excellent table option that you might certainly be interested in. It runs on Android 6.0 and is powered by an octa-core processor with 3 GB of RAM. Oh and did we mention the battery? It''s quite outstanding compared to other tablets in the same price range!', 1, '599.99', NULL, 45, 'IN_STOCK', 1),
(15, 'Bose SoundLink® wireless headphones II - Black', 'These premium upscale headphones guarantee to deliver you the purest crystal-clear sound ever possible with the comfort of the latest wireless technology', 1, '299.99', NULL, 48, 'IN_STOCK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(5) UNSIGNED NOT NULL,
  `starts_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ends_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `discount` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `starts_at`, `ends_at`, `discount`) VALUES
(1, '2017-01-08 18:23:48', '2017-01-24 22:00:00', '0.25'),
(2, '2017-01-08 18:23:53', '2017-01-29 05:00:00', '0.22'),
(3, '2017-01-10 02:11:48', '2017-01-21 05:00:00', '0.16');

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
(1, 4, 1, 'Wow, this product is just amazing, and I can''t believe the shipping was so blazingly fast!', 3, '2016-11-17 18:51:25'),
(2, 1, 2, 'Awesome! I bought this for my bf, he is so happy!!!', 5, '2016-11-17 18:52:25'),
(3, 2, 1, 'Nuh, I expected more to be honest, especially for this price. I''ll give it a 4. The shipping was good though, I got my delivery in 20 hours.', 4, '2016-11-17 18:54:01'),
(4, 2, 1, 'Great wine!', 4, '2016-11-21 13:14:52'),
(5, 4, 1, 'Super, I love it!', 5, '2016-11-23 05:55:16'),
(6, 7, 2, 'Nuh it''s alrighjt', 3, '2017-01-09 00:23:25');

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
(4, 'Liza', 'liza@gmail.com', '$2y$10$/tL2kz1KbJgeFFuGiB69Pu1ST2aj6UnesCx6oW.gDumhVfA4TJKke', 'CUSTOMER'),
(5, 'Aiden', 'aiden@gmail.com', '$2y$10$IsYe3Q4uGQZHhkGB/tYViO5UnqMK9nTPvM9E.GSr9d3e/sEIdnyQy', 'CUSTOMER'),
(6, 'Dwayne', 'dwayne@gmail.com', '$2y$10$oDleLgPBBwKoArI48hmY1ejvWGdz8XR.gsM2SECsD8JXLoDeD36c6', 'CUSTOMER'),
(7, 'Emma', 'emma@gmail.com', '$2y$10$IOS6JFfuwq1L81rDKJftH.FOOmXVrjY1kEoDapWfs0Z6J5ysUQq4u', 'CUSTOMER'),
(8, 'Test test', 'test@gmail.com', '$2y$10$lYpzvbG/JDL9.67b2AXHHe.RLQKDAI8E/jkMoFj.jFiYor4dquJ5K', 'CUSTOMER'),
(9, 'Test', 'test2@gmail.com', '$2y$10$g01oJ0e0ZqsYp7g1kcYBLuVPxkJLFNmZ.LPjPojW50KPGfEhThl/q', 'CUSTOMER');

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
  ADD UNIQUE KEY `user_id` (`user_id`);

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
  ADD KEY `method_id` (`payment_method_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

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
