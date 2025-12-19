-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2025 at 04:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computer_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(14, 7, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(1, 2, 799.99, '2025-12-04 18:34:50'),
(2, 2, 99.98, '2025-12-04 23:38:15'),
(3, 2, 2236.07, '2025-12-05 20:00:15'),
(4, 4, 970.47, '2025-12-05 20:01:03'),
(5, 4, 66.48, '2025-12-05 20:28:24'),
(6, 9, 2156.98, '2025-12-05 21:53:52'),
(7, 2, 122.97, '2025-12-18 17:30:37'),
(8, 11, 2721.96, '2025-12-18 22:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 9, 1, 799.99),
(2, 2, 24, 2, 49.99),
(3, 3, 10, 1, 1899.99),
(4, 3, 31, 1, 69.99),
(5, 4, 9, 1, 799.99),
(6, 4, 24, 1, 49.99),
(7, 5, 24, 1, 49.99),
(8, 6, 10, 1, 1899.99),
(9, 7, 24, 2, 49.99),
(10, 8, 9, 3, 799.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `price`, `image_url`, `category`, `stock`) VALUES
(1, 'Dell XPS 13', 'Dell', '13-inch ultrabook with SSD', 1499.99, 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/xps-notebooks/xps-13-9350/media-gallery/platinum/notebook-xps-13-9350-t-oled-sl-gallery-1.psd?fmt=png-alpha&pscan=auto&scl=1&wid=3988&hei=2292&qlt=100,1&', 'laptop', 12),
(2, 'MacBook Pro 16', 'Apple', 'Apple M1 Pro laptop', 2999.99, 'https://m.media-amazon.com/images/I/61aUBxqc5PL.jpg', 'laptop', 6),
(3, 'Lenovo ThinkPad X1 Carbon', 'Lenovo', 'Business-class laptop', 1899.99, 'https://www.atlasce.ca/cdn/shop/files/x1.jpg?v=1734464428', 'laptop', 10),
(4, 'HP Spectre x360', 'HP', 'Convertible touchscreen laptop', 1599.99, 'https://media.wired.com/photos/59e94f9234ce5c0e0a752e11/master/w_1600%2Cc_limit/SphinxInline.jpg', 'laptop', 8),
(5, 'ASUS ROG Zephyrus G14', 'ASUS', 'Gaming laptop with RTX GPU', 2199.99, 'https://www.notebookcheck-cn.com/uploads/tx_nbc2/G14-White-53.jpg', 'laptop', 4),
(6, 'Acer Swift 3', 'Acer', 'Slim laptop for productivity', 899.99, 'https://cdn.cs.1worldsync.com/b0/38/b03831aa-984a-4913-af30-4575a6e8b4ff.jpg', 'laptop', 14),
(7, 'MSI Stealth 15M', 'MSI', 'High-performance gaming laptop', 1799.99, 'https://m.media-amazon.com/images/I/619ufv8EySL.jpg', 'laptop', 5),
(8, 'Razer Blade 15', 'Razer', 'Premium gaming laptop', 2599.99, 'https://www.notebookcheck.net/fileadmin/Notebooks/Razer/Blade_15_Base_Model/Blade_15_Fall_2018_Base_Model_Render_13.png', 'laptop', 3),
(9, 'Dell Inspiron 15', 'Dell', 'Budget-friendly laptop', 799.99, 'https://m.media-amazon.com/images/I/61vbeisC69L._AC_UF894,1000_QL80_.jpg', 'laptop', 17),
(10, 'Apple MacBook Air M2', 'Apple', 'Lightweight performance laptop', 1899.99, 'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/macbook-air-og-202503?wid=1200&hei=630&fmt=jpeg&qlt=90&.v=1739216814915', 'laptop', 7),
(11, 'NVIDIA RTX 4090', 'NVIDIA', 'Flagship GPU for gaming and AI', 2499.99, 'https://postperspective.com/wp-content/uploads/2022/10/GeForce-RTX4090-3QTR-Back-Left-1.jpg', 'gpu', 5),
(12, 'NVIDIA RTX 4080', 'NVIDIA', 'High-end GPU', 1599.99, 'https://m.media-amazon.com/images/I/81rCZZvkIVL.jpg', 'gpu', 8),
(13, 'NVIDIA RTX 4070 Ti', 'NVIDIA', 'High-performance GPU', 1099.99, 'https://m.media-amazon.com/images/I/71-djDvKjfL.jpg', 'gpu', 15),
(14, 'NVIDIA RTX 4060', 'NVIDIA', 'Mid-range GPU', 499.99, 'https://m.media-amazon.com/images/I/71QvZTnJm+L.jpg', 'gpu', 25),
(15, 'AMD Radeon RX 7900 XTX', 'AMD', 'Flagship AMD GPU', 1299.99, 'https://m.media-amazon.com/images/I/81il2WdPPJL.jpg', 'gpu', 6),
(16, 'AMD Radeon RX 7800 XT', 'AMD', 'High-end AMD GPU', 899.99, 'https://m.media-amazon.com/images/I/71GKfo5qtaL.jpg', 'gpu', 12),
(17, 'AMD Radeon RX 7700 XT', 'AMD', 'Mid-tier gaming GPU', 649.99, 'https://ccimg.canadacomputers.com/Products/230/419/245466/89251.jpg', 'gpu', 20),
(18, 'NVIDIA GTX 1660 Super', 'NVIDIA', 'Budget gaming GPU', 299.99, 'https://m.media-amazon.com/images/I/71tJe-BUlWL.jpg', 'gpu', 10),
(19, 'NVIDIA RTX 3050', 'NVIDIA', 'Entry-level RTX GPU', 349.99, 'https://m.media-amazon.com/images/I/51QaFKJf3+L.jpg', 'gpu', 16),
(20, 'AMD Radeon RX 6600 XT', 'AMD', 'Budget gaming GPU', 369.99, 'https://m.media-amazon.com/images/I/71Exns6BrvL.jpg', 'gpu', 13),
(21, 'Corsair Vengeance 16GB', 'Corsair', '16GB DDR4 RAM Kit', 129.99, 'https://m.media-amazon.com/images/I/61dVv9VuEPL._AC_UF894,1000_QL80_.jpg', 'memory', 30),
(22, 'Corsair Vengeance 32GB', 'Corsair', '32GB DDR4 RAM Kit', 249.99, 'https://m.media-amazon.com/images/I/71e6YWJio-L.jpg', 'memory', 18),
(23, 'G.Skill Ripjaws 16GB', 'G.Skill', 'High-speed RAM', 119.99, 'https://m.media-amazon.com/images/I/51eb3VQyt4L.jpg', 'memory', 25),
(24, 'Kingston Fury 8GB', 'Kingston', 'Entry-level RAM', 49.99, 'https://m.media-amazon.com/images/I/71z7avw-tFL.jpg', 'memory', 38),
(25, 'Samsung 16GB DDR5', 'Other', 'Latest generation RAM', 199.99, 'https://microless.com/cdn/products/8e851f2501d91a91e161e17a2fa57bdb-hi.jpg', 'memory', 22),
(26, 'TeamGroup 32GB DDR5', 'Other', 'Enthusiast DDR5 RAM', 299.99, 'https://images.teamgroupinc.com/products/memory/u-dimm/ddr5/delta-rgb/black/03.jpg', 'memory', 10),
(27, 'Samsung 980 Pro 1TB', 'Samsung', 'PCIe Gen4 NVMe SSD', 199.99, 'https://multimedia.bbycastatic.ca/multimedia/products/500x500/162/16242/16242412.png', 'storage', 20),
(28, 'WD Black SN850 1TB', 'Western Digital', 'High-performance gaming SSD', 229.99, 'https://content.etilize.com/Alternate-Image1/1067230041.jpg', 'storage', 18),
(29, 'Crucial P3 Plus 1TB', 'Crucial', 'Affordable NVMe SSD', 109.99, 'https://m.media-amazon.com/images/I/51pMg25AthL.jpg\r\n', 'storage', 22),
(30, 'Samsung 870 EVO 1TB', 'Samsung', 'SATA SSD for desktops', 129.99, 'https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/ssd/mz-77e/1tb/MZ-77E1T0BW_002_Black.jpg?$product-details-jpg$', 'storage', 16),
(31, 'Kingston A2000 500GB', 'Kingston', 'Budget NVMe SSD', 69.99, 'https://i.ebayimg.com/images/g/GjkAAOSw55NgIp8G/s-l1200.jpg', 'storage', 30),
(32, 'Corsair MP700 2TB', 'Other', 'Extreme gaming SSD', 399.99, 'https://m.media-amazon.com/images/I/61Qc8gsvTjL._AC_UF894,1000_QL80_.jpg', 'storage', 6),
(33, 'Intel Core i9-13900K', 'Intel', 'High-end gaming CPU', 749.99, 'https://m.media-amazon.com/images/I/518cK5YEfaL.jpg', 'cpu', 8),
(34, 'Intel Core i7-13700K', 'Intel', 'Performance CPU', 529.99, 'https://m.media-amazon.com/images/I/51FCqwZlRtL.jpg', 'cpu', 14),
(35, 'Intel Core i5-12400F', 'Intel', 'Budget CPU', 199.99, 'https://m.media-amazon.com/images/I/51EwtPjHkIL._AC_UF894,1000_QL80_.jpg', 'cpu', 22),
(36, 'AMD Ryzen 9 7950X', 'AMD', 'Top-tier CPU', 699.99, 'https://www.pc-canada.com/dd2/img/item/A-1500x1500/8743069.jpg', 'cpu', 9),
(37, 'AMD Ryzen 7 7700X', 'AMD', 'Gaming CPU', 399.99, 'https://m.media-amazon.com/images/I/51hfER1cZVL.jpg', 'cpu', 12),
(38, 'AMD Ryzen 5 5600X', 'AMD', 'Mid-range CPU', 289.99, 'https://cdn.mos.cms.futurecdn.net/F3LUWLZtYHGXz6Fi6kG6Ne.jpg', 'cpu', 15),
(39, 'LG UltraGear 27\"', 'LG', '27” Gaming monitor', 349.99, 'https://m.media-amazon.com/images/I/81El4887iLL.jpg', 'monitor', 10),
(40, 'Dell UltraSharp 27\"', 'Dell', 'Professional monitor', 499.99, 'https://m.media-amazon.com/images/I/71Y+IhJ1vxL.jpg', 'monitor', 8),
(41, 'Samsung Odyssey G9', 'Samsung', '49” Ultra-wide gaming', 1499.99, 'https://m.media-amazon.com/images/I/71jmBin8LnL._AC_UF894,1000_QL80_.jpg', 'monitor', 4),
(42, 'AOC 24G2', 'Other', 'Budget gaming monitor', 199.99, 'https://m.media-amazon.com/images/I/81J4utZ5bnL.jpg', 'monitor', 15),
(43, 'Asus TUF VG27AQ', 'ASUS', '1440p gaming monitor', 429.99, 'https://c1.neweggimages.com/productimage/nb640/24-236-987-03.png', 'monitor', 7),
(44, 'BenQ EX3501R', 'BenQ', 'Ultra-wide monitor', 599.99, 'https://www.bhphotovideo.com/images/fb/benq_ex3501r_premium_grey_35_va_3440x1440_1383775.jpg', 'monitor', 6),
(45, 'Logitech G Pro', 'Other', 'Mechanical gaming keyboard', 149.99, 'https://cdn.cs.1worldsync.com/08/13/0813f76d-1ae3-4a7f-bcb7-9f5cc52c1393.jpg', 'keyboard', 20),
(46, 'Razer Huntsman Mini', 'Razer', '60% gaming keyboard', 139.99, 'https://m.media-amazon.com/images/I/6121HGF8WLL.jpg', 'keyboard', 18),
(47, 'Corsair K95 RGB', 'Other', 'Full-size RGB keyboard', 199.99, 'https://assets.corsair.com/image/upload/c_pad,q_auto,h_1024,w_1024,f_auto/products/Gaming-Keyboards/CH-9000221-ND/Gallery/CGK95_RGB_NA_001.webp', 'keyboard', 12),
(48, 'Logitech G502', 'Other', 'Wired gaming mouse', 89.99, 'https://m.media-amazon.com/images/I/61mpMH5TzkL._AC_UF894,1000_QL80_.jpg', 'mouse', 25),
(49, 'Razer Viper Ultimate', 'Razer', 'Wireless gaming mouse', 159.99, 'https://www.bhphotovideo.com/images/fb/razer_rz01_03050100_r3u1_viper_ultimate_wireless_1710288.jpg', 'mouse', 15),
(50, 'Corsair RM750x', 'Other', '750W modular PSU', 169.99, 'https://m.media-amazon.com/images/I/71ceFvqCLpL._AC_UF894,1000_QL80_.jpg', 'psu', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$yAMh7IfBxp1p6uHJPtHNDOxMaOGBfZpBkSNfmOSUC1rKcJUxIgV8G', 1),
(2, 'Ingsharahang Edhingo Limbu', 'kushanglimbu@gmail.com', '$2y$10$r9jJn1iY6UCC7X0lou/THO.nxnGGBYBn/wEyxu.hdXBI/QDZcGZW.', 0),
(3, 'Kushang Limbu', 'kushanglimbu123@gmail.com', '$2y$10$1qgshlC2dfFIbKD52ioaReISOPCQ191gXgRDjPV/MtUIRCxs.dyBC', 1),
(4, 'Rajiv Kumar Limbu', 'rajivkumar@gmail.com', '$2y$10$5hwpkFFq4Wz7QSGu16pxK.qkuq76NRUrZi0IHbGwIVmbFwzVz71DK', 0),
(7, 'rajiv', 'rajivlimbu123@gmail.com', '$2y$10$cfEfqWO.UQYzbyx8oCd.ne5Vb7wAFCHI9KEAcD03KupXxys26TRxG', 0),
(9, 'rajiv', 'rajivlimbu111@gmail.com', '$2y$10$J5z9ofM70VJgAuzqD8ePee6/Pb5/qLTzsV3RxfCyy6roRVpYwxcs.', 0),
(10, 'Ing', 'iedhingolimbu@algomau.ca', '$2y$10$nvfcjTjhErGiSmCcFUhOUuI55xtcwnUqtppLXpaXyLLEadAoX4CLS', 1),
(11, 'Gordan', 'gordan123@gmail.com', '$2y$10$./qfP6VxQRz.otOrF2dZsu9M1nNvcMf58RnpN43cX6mRQELNtVin2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
