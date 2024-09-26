-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: sql313.infinityfree.com
-- Χρόνος δημιουργίας: 26 Σεπ 2024 στις 11:13:21
-- Έκδοση διακομιστή: 10.6.19-MariaDB
-- Έκδοση PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `if0_36806121_eshop`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `cart`
--

INSERT INTO `cart` (`id`, `productId`, `userId`, `brand`, `model`, `price`, `quantity`) VALUES
(177, 10, 2, 'Lenovo', 'IdeaCentre Gaming 5 17ACN7 Gaming Desktop PC (Ryzen 7-5700G/16GB DDR4/1TB SSD/GeForce RTX 3060 Ti', '1349.00', 1),
(178, 9, 2, 'Dell', 'Desktop PC (i5-13400/16GB DDR4/512GB SSD + 1TB HDD)', '906.50', 1),
(180, 8, 2, 'HP', 'EliteBook 630 G9 i7-1255U/16GB/512GB SSD/Iris Xe G', '4340.44', 4),
(254, 3, 4, 'Apple', 'iPhone 15 Pro Max 5G (8GB/256GB) Black Titanium', '1399.00', 1),
(255, 1, 4, 'Xiaomi', 'Poco X5 Pro 5G Dual SIM (8GB/256GB) Black', '660.00', 2),
(256, 4, 4, 'Samsung', 'Galaxy A54 5G Dual SIM (8GB/128GB) Awesome Graphite', '338.76', 1),
(261, 4, 6, 'Samsung', 'Galaxy A54 5G Dual SIM (8GB/128GB) Awesome Graphite', '338.76', 1),
(262, 3, 6, 'Apple', 'iPhone 15 Pro Max 5G (8GB/256GB) Black Titanium', '1399.00', 1),
(277, 7, 8, 'Apple', 'MacBook Air (2022) M2-8?core/8GB/256GB SSD', '1298.89', 1),
(278, 8, 8, 'HP', 'EliteBook 630 G9 i7-1255U/16GB/512GB SSD/Iris Xe G', '1085.11', 1),
(279, 5, 8, 'Apple', 'iPad Air 2022 (8GB/64GB)', '750.00', 1),
(280, 2, 3, 'Samsung', 'Galaxy S23 Ultra 5G Dual SIM (8GB/256GB) Phantom Black', '1031.80', 1),
(281, 6, 3, 'Teclast', 'P40HD (8GB/128GB)', '152.52', 1),
(282, 3, 3, 'Apple', 'iPhone 15 Pro Max 5G (8GB/256GB) Black Titanium', '1399.00', 1),
(290, 4, 9, 'Samsung', 'Galaxy A54 5G Dual SIM (8GB/128GB) Awesome Graphite', '338.76', 1),
(291, 10, 9, 'Lenovo', 'IdeaCentre Gaming 5 17ACN7 Gaming Desktop PC (Ryzen 7-5700G/16GB DDR4/1TB SSD/GeForce RTX 3060 Ti', '1349.00', 1),
(292, 8, 7, 'HP', 'EliteBook 630 G9 i7-1255U/16GB/512GB SSD/Iris Xe G', '1085.11', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Phones'),
(2, 'Laptops'),
(3, 'Tablets'),
(4, 'Desktops');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `productCode` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(110) NOT NULL,
  `os` varchar(50) NOT NULL,
  `sim` varchar(50) NOT NULL,
  `release_year` year(4) NOT NULL,
  `color` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `ProductType` int(11) DEFAULT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `image3` text NOT NULL,
  `image4` text NOT NULL,
  `thumbnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`productCode`, `brand`, `model`, `os`, `sim`, `release_year`, `color`, `weight`, `description`, `price`, `ProductType`, `image1`, `image2`, `image3`, `image4`, `thumbnail`) VALUES
(1, 'Xiaomi', 'Poco X5 Pro 5G Dual SIM (8GB/256GB) Black', 'Android', 'Dual', 2023, 'Black', '187 gr', 'Release Date 2023<br>\r\nScreen 6.67\"/2400 x 1080/120 Hz<br>\r\nFHD+ Flow AMOLED<br>\r\nSnapdragon 778 5G Processor<br>\r\nTriple Rear Camera 108MP<br>\r\nBattery 5000mAh/67W (100% - 46min)<br>', '330.00', 1, '20230208152512_86a06a7c.jpeg', '20230208152528_47e35a95.jpeg', '577936.jpg', '', '20230208152512_86a06a7c.jpeg'),
(2, 'Samsung', 'Galaxy S23 Ultra 5G Dual SIM (8GB/256GB) Phantom Black', 'Android', 'Dual', 2023, 'Black', '234 gr', 'Dynamic AMOLED 2X 6.8\'\' Display<br>\r\nOcta-core Snapdragon 8 Gen 2<br>\r\n200MP Quad Camera<br>\r\n10W Wireless Charging<br>\r\nCamera Nightography. Built-in S Pen. Long lasting battery. Does not include charging adapter.', '1031.80', 1, '20230202093734_2b8f6b2f.jpeg', '20230202093734_88c408d7.jpeg', '20230202093735_samsung_galaxy_s23_ultra_5g_dual_sim_8gb_256gb_phantom_black.jpeg', '20230202093735_b7013ffd.jpeg', '20230202093735_93af30f3.jpeg'),
(3, 'Apple', 'iPhone 15 Pro Max 5G (8GB/256GB) Black Titanium', 'iOS', 'SIM + eSIM', 2023, 'Black', '221 gr', 'Model 2023<br>\r\nSuper Retina XDR OLED 6.7\" 120Hz<br>\r\nNFC Support<br>\r\nNew A17 Pro Bionic processor<br>\r\nTriple rear camera 48MP/4K 60 FPS<br>\r\n4852 mAh battery (50% in 30min)', '1399.00', 1, '20230915160436_apple_iphone_15_pro_max_5g_8gb_256gb_black_titanium_proparagelia.jpeg', '20230915160438_99355eea.jpeg', '20230915160439_245a5185.jpeg', '20230915160441_447ba82e.jpeg', '20230915160436_apple_iphone_15_pro_max_5g_8gb_256gb_black_titanium_proparagelia.jpeg'),
(4, 'Samsung', 'Galaxy A54 5G Dual SIM (8GB/128GB) Awesome Graphite', 'Android', 'Dual', 2023, 'Black', '202 gr', 'Model 2023<br>\r\nScreen 6.4\"/2340 x 1080/120 Hz<br>\r\nNFC support<br>\r\nProcessor Exynos 1380<br>\r\nTriple Rear Camera 50MP/1080p 30fps<br>\r\nBattery 5000 mAh', '338.76', 1, '20230316092519_samsung_galaxy_a54_5g_dual_sim_kinito.jpeg', '20230328090540_796a1ff0.jpeg', '20230330135852_1aeaa59d.jpeg', '20230330135852_c157764f.jpeg', '20230330135852_1200dbdd.jpeg'),
(5, 'Apple', 'iPad Air 2022 (8GB/64GB)', 'iPadOS', '', 2022, 'Black', '461 gr', 'Model 2022<br>\r\nScree Liquid Retina 10.9\" 2360x1640<br>\r\nApple M1 chip<br>\r\nBattery 7600 mAh<br>\r\nMaximum Battery Life 10 hrs<br>\r\nWeight 461 gr', '750.00', 3, '20220311133336_a179953a.jpeg', '20220311133337_4285a69d.jpeg', '20220311133337_d3a248ed.jpeg', 'xlarge_20220311133336_apple_ipad_air_2022_10_9_me_wifi_kai_mnimi_64gb_space_gray.jpeg', 'xlarge_20220311133336_apple_ipad_air_2022_10_9_me_wifi_kai_mnimi_64gb_space_gray.jpeg'),
(6, 'Teclast', 'P40HD (8GB/128GB)', 'Android', '', 2022, 'Gray', '', 'Lightweight and slim tablet from Teclast, with an elegant, metallic body and a large 10.1\" IPS Full HD display. It features a powerful processor that, combined with the Android 13 operating system, enhances the tablet\'s performance.', '152.52', 3, '20230906123310_teclast_p40hd_10_4_tablet_me_wifi_4g_8gb_128gb_grey.jpeg', '20230906123331_fcd3b313.jpeg', '20230906123337_b9265bd8.jpeg', '20230906123349_f4df16c4.jpeg', '20230906123310_teclast_p40hd_10_4_tablet_me_wifi_4g_8gb_128gb_grey.jpeg'),
(7, 'Apple', 'MacBook Air (2022) M2-8‑core/8GB/256GB SSD', 'macOS', '', 2022, 'Space Grey', '1.22kg', 'Model 2022<br>\r\nScreen 13.6\" 2560x1600 Retina<br>\r\n8‑core 3.5Ghz<br>\r\n8GB LPDDR5-6400MHz RAM<br>\r\nThundebolt 4/Wi-Fi 6<br>\r\nWeight 1.22kg', '1298.89', 2, '20220711121829_apple_macbook_air_13_6_2022_retina_display_m2_8_core_8gb_256gb_ssd_8_core_gpu_space_grey.jpeg', '20220711121831_2a283887.jpeg', '20220711121831_7a1b37dc.jpeg', '20220711121831_706e5838.jpeg', '20220711121829_apple_macbook_air_13_6_2022_retina_display_m2_8_core_8gb_256gb_ssd_8_core_gpu_space_grey.jpeg'),
(8, 'HP', 'EliteBook 630 G9 i7-1255U/16GB/512GB SSD/Iris Xe G', 'Windows 11 Pro', '', 2022, 'Silver', '1.28kg', 'The HP EliteBook 630 G9 is a Notebook with a 13.3\". This size is recommended for greater portability.<br>\r\n\r\n• Model 2022<br>\r\n• Screen 13.3\" 1920x1080<br>\r\n• Core i7 1255U-3.5GHz/Alder Lake (12th Gen)<br>\r\n• Ethernet, HDMI, Thunderbolt 4, USB 3.2<br>\r\n• Weight 1.28Kg<br>', '1085.11', 2, '20230126134027_e71eb0fd.jpeg', '20230126134027_hp_elitebook_630_g9_13_3_ips_fhd_i7_1255u_16gb_512gb_ssd_iris_xe_graphics_w11_pro_us_keyboard.jpeg', '20230126134028_d831a49d.jpeg', '20230126134028_625128c1.jpeg', '20230126134027_e71eb0fd.jpeg'),
(9, 'Dell', 'Desktop PC (i5-13400/16GB DDR4/512GB SSD + 1TB HDD)', 'Windows 11 Pro', '', 2022, 'Black', '', 'Intel Core i5-13400 2.5GHz<br>\r\nRAM 16GB DDR4-3200MHZ<br>\r\nUHD Graphics 730<br>\r\nSSD 512GB M.2 PCIe NVMe<br>\r\nHDD 1TB 7200 rpm<br>', '906.50', 4, '20230324162816_2b721d10.jpeg', '20230324162816_dell_inspiron_3020_mt_desktop_pc_i5_13400_16gb_ddr4_512gb_ssd_1tb_hdd_w11_pro.jpeg', '20230411144517_1b1a913e.jpeg', '', '20230324162816_2b721d10.jpeg'),
(10, 'Lenovo', 'IdeaCentre Gaming 5 17ACN7 Gaming Desktop PC (Ryzen 7-5700G/16GB DDR4/1TB SSD/GeForce RTX 3060 Ti', 'Windows 11 Home', '', 2022, 'black', '', 'AMD Ryzen 7 5700G 3.8 GHz<br>\r\nGeForce RTX 3060 Ti 8GB GDDR6<br>\r\n16GB UDIMM DDR4-3200 RAM<br>\r\n1TB SSD M.2 2280 PCIe® 4.0x4 NVMe', '1349.00', 4, '20221019140122_3492138e.jpeg', '20230117165808_c29df9aa.jpeg', '20230117165809_lenovo_ideacentre_gaming_5_17acn7_gaming_desktop_pc_ryzen_7_5700g_16gb_ddr4_1tb_ssd_geforce_rtx_3060_ti_w11_home.jpeg', '20230117165808_700db9b2.jpeg', '20221019140122_3492138e.jpeg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`) VALUES
(1, 'test_1234', '81dc9bdb52d04dc20036dbd8313ed055', 'test'),
(2, 'simos1234', '58b4e38f66bcdb546380845d6af27187', 'simos'),
(3, 'user1234', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(4, 'user_2', 'd93591bdf7860e1e4ee2fca799911215', 'user2'),
(5, 'user_3', 'd93591bdf7860e1e4ee2fca799911215', 'user3'),
(6, 'tsiakas_1', '81dc9bdb52d04dc20036dbd8313ed055', 'tsiakas'),
(7, 'simos', '81dc9bdb52d04dc20036dbd8313ed055', 'simos'),
(8, 'MPLEKON', '81dc9bdb52d04dc20036dbd8313ed055', 'MPLEKON'),
(9, 'NotFromFBI', '4b9170b38c73100e743f852232c5cfc7', 'Skase mwrh de tha pareis ta lefta moy'),
(10, 'lolsexkaibmx', 'd2f14db0f38b07893af37707d087bfac', 'bigdick');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`userId`),
  ADD KEY `productCode` (`productId`);

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productCode`),
  ADD KEY `fk_products` (`ProductType`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT για πίνακα `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `productCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `productId` FOREIGN KEY (`productId`) REFERENCES `products` (`productCode`),
  ADD CONSTRAINT `user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`ProductType`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
