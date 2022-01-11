-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 12:23 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_year_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adam Thorn', 'admin@gmail.com', NULL, '$2y$10$Up2RV/bDXhxOGhY11.CDIO7u.dPXBx8fI5gY10hpV0bjAZRNaFvTe', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `brandID`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Faber-Castell', 'B001', 'Available', '2021-12-26 04:43:57', '2021-12-26 04:43:57'),
(2, 'Pilot', 'B002', 'Available', '2021-12-26 04:44:10', '2021-12-26 04:44:10'),
(5, 'Inactive Status Example', 'B003', 'Unavailable', '2022-01-10 16:24:04', '2022-01-10 16:24:04'),
(6, 'Active Example', 'B004', 'Available', '2022-01-10 16:24:31', '2022-01-10 20:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCartID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `categoryID`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pen', 'C001', 'Available', '2021-12-26 04:44:30', '2021-12-26 04:44:30'),
(2, 'Pencil', 'C002', 'Available', '2021-12-26 04:44:46', '2021-12-26 04:44:46'),
(3, 'Color Pencils', 'C003', 'Available', '2021-12-26 04:45:04', '2021-12-26 04:45:04'),
(4, 'Eraser', 'C004', 'Available', '2021-12-31 21:21:41', '2021-12-31 21:21:41'),
(5, 'Ruler', 'C005', 'Available', '2021-12-31 21:51:22', '2021-12-31 21:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order` int(10) UNSIGNED NOT NULL,
  `delivery_order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_quantity` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `purchase_order`, `delivery_order_no`, `productID`, `sent_quantity`, `created_at`, `updated_at`) VALUES
(68, 35, '12345-1', 'FCPC13232B-12', 100, '2022-01-10', NULL),
(69, 35, '12345-1', 'FCDFE-001', 0, '2022-01-10', NULL),
(70, 35, '12345-2', 'FCDFE-001', 100, '2022-01-11', NULL),
(71, 36, '12351-1', 'FCCX7-01', 0, '2022-01-11', NULL),
(72, 36, '12351-1', 'FCCX7-02', 100, '2022-01-11', NULL),
(73, 36, '12351-1', 'FCCX7-03', 0, '2022-01-11', NULL),
(74, 36, '12351-2', 'FCCX7-01', 50, '2022-01-11', NULL),
(75, 36, '12351-2', 'FCCX7-03', 0, '2022-01-11', NULL),
(76, 36, '12351-3', 'FCCX7-01', 50, '2022-01-11', NULL),
(77, 36, '12351-3', 'FCCX7-03', 100, '2022-01-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order` int(10) UNSIGNED NOT NULL,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_order` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `purchase_order`, `total_amount`, `delivery_order`, `invoice_no`, `created_at`, `updated_at`) VALUES
(10, 35, 200.00, '12345-1', 'IN-0091', '2022-01-11', '2022-01-10 20:54:13'),
(11, 35, 80.00, '12345-2', 'IN-0092', '2022-01-11', '2022-01-10 20:54:41'),
(12, 37, 200.00, 'No do', 'IN-00971', '2022-01-11', '2022-01-11 02:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_23_131506_create_brands_table', 1),
(5, '2021_08_23_131540_create_categories_table', 1),
(6, '2021_08_23_133634_create_products_table', 1),
(7, '2021_09_02_020531_create_purchase_orders_table', 1),
(8, '2021_09_02_024838_create_suppliers_table', 1),
(9, '2021_09_13_130145_create_staff_table', 1),
(10, '2021_10_18_131728_create_customers_table', 1),
(12, '2021_11_25_024123_create_purchase_oder_r_s_table', 1),
(13, '2021_11_26_020830_create_carts_table', 1),
(14, '2021_12_11_073747_create_orders_table', 1),
(15, '2021_12_11_073813_create_order_details_table', 1),
(16, '2021_12_31_024429_create_delivery_orders_table', 2),
(17, '2021_12_31_025047_create_invoices_table', 2),
(18, '2021_11_13_133314_create_admins_table', 3),
(19, '2022_01_11_060805_create_offline_orders_table', 4),
(20, '2022_01_11_060841_create_offline_order__details_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offline_orders`
--

CREATE TABLE `offline_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Payment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offline_orders`
--

INSERT INTO `offline_orders` (`id`, `order_no`, `notes`, `status`, `invoice_no`, `Payment`, `created_at`, `updated_at`) VALUES
(6, 'OR-2022389', 'Sample', 1, 'IN-2022347', 'Cash', '2022-01-11 00:16:33', '2022-01-11 00:16:33'),
(7, 'OR-202211', 'Sample', 1, 'IN-2022403', 'Cash', '2022-01-11 01:11:03', '2022-01-11 01:11:03'),
(8, 'OR-2022349', 'Sample', 1, 'IN-2022848', 'Cash', '2022-01-11 01:17:15', '2022-01-11 01:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `offline_order__details`
--

CREATE TABLE `offline_order__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderID` int(10) UNSIGNED NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `grand_total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offline_order__details`
--

INSERT INTO `offline_order__details` (`id`, `orderID`, `productID`, `Price`, `quantity`, `grand_total`, `created_at`, `updated_at`) VALUES
(5, 6, 'FCCX7-01', 1.50, 10, 15.00, '2022-01-11 00:16:33', '2022-01-11 00:16:33'),
(6, 6, 'FCCX7-02', 1.50, 10, 15.00, '2022-01-11 00:16:33', '2022-01-11 00:16:33'),
(7, 6, 'FCCX7-03', 1.50, 10, 15.00, '2022-01-11 00:16:33', '2022-01-11 00:16:33'),
(8, 7, 'FCCX7-01', 1.50, 10, 15.00, '2022-01-11 01:11:03', '2022-01-11 01:11:03'),
(9, 7, 'FCCX7-02', 1.50, 10, 15.00, '2022-01-11 01:11:03', '2022-01-11 01:11:03'),
(10, 8, 'FCCX7-01', 1.50, 2, 3.00, '2022-01-11 01:17:15', '2022-01-11 01:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `userID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderID`, `paymentStatus`, `status`, `userID`, `amount`, `address`, `contact`, `tracking_no`, `created_at`, `updated_at`) VALUES
(10, '1008855820', 'Done', 'Cancelled', '2', 39.50, '11, Jalan Tebrau, Taman Kaya', '119987652', NULL, '2022-01-03 17:23:04', '2022-01-05 22:24:57'),
(11, '1858489127', 'Done', 'Fulfilled', '2', 32.00, '11, Jalan Tebrau, Taman Kaya', '119987652', 'Pos Laju - MY340986', '2022-01-03 21:21:25', '2022-01-05 21:50:17'),
(12, '260773610', 'Done', 'Fulfilled', '2', 14.00, '11, Jalan Tebrau, Taman Kaya', '0111765243', 'Pos Laju - MY340983', '2022-01-05 03:42:26', '2022-01-05 21:44:11'),
(13, '800759737', 'Done', 'Fulfilled', '2', 42.50, '11, Jalan Tebrau, Taman Kaya', '119987652', 'Pos Laju - MY340957', '2022-01-05 22:50:36', '2022-01-05 23:01:06'),
(15, '1291909763', 'Done', 'Cancelled', '2', 54.50, '11, Jalan Tebrau, Taman Kaya', '119987652', NULL, '2022-01-05 22:59:14', '2022-01-05 23:00:22'),
(16, '1290354076', 'Done', 'Cancelled', '2', 27.00, '11, Jalan Tebrau, Taman Kaya', '0119987652', NULL, '2022-01-05 23:42:19', '2022-01-05 23:42:54'),
(17, '2040462188', 'Done', 'Fulfilled', '1', 39.50, '45, Jalan Nibung, Taman Melodies, 80250, Johor Bahru, Johor, 80250, Johor Bahru, Johor', '0167363193', 'Pos Laju - MY340985', '2022-01-06 04:23:16', '2022-01-09 20:27:48'),
(18, '1379073122', 'Done', 'Processing', '1', 17.00, '45, Jalan Nibung, Taman Melodies, 80250, Johor Bahru, Johor, 80250, Johor Bahru, Johor', '167363193', NULL, '2022-01-10 05:39:58', '2022-01-10 05:39:58'),
(19, '2093118127', 'Done', 'Processing', '1', 32.00, '45, Jalan Nibung, Taman Melodies, 80250, Johor Bahru, Johor, 80250, Johor Bahru, Johor', '167363193', NULL, '2022-01-10 05:51:42', '2022-01-10 05:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderID`, `userID`, `name`, `quantity`, `price`, `status`, `productID`, `image`, `created_at`, `updated_at`) VALUES
(12, '1008855820', '2', 'Click X7', 25, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-03 17:23:03', '2022-01-03 17:23:03'),
(13, '1858489127', '2', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-03 21:21:24', '2022-01-03 21:21:24'),
(14, '1858489127', '2', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-02', 'FABER-CASTELL-CLICK-X7-BLUE.jpg', '2022-01-03 21:21:24', '2022-01-03 21:21:24'),
(19, '260773610', '2', 'Tri-Grip-2B Pencils', 2, 6.00, 'Processing', 'FCPCTG2B-12', 'Faber-Castell-Tri-Grip-2B-Pencil -12pcs.jpg', '2022-01-05 03:42:24', '2022-01-05 03:42:24'),
(24, '800759737', '2', 'Click X7', 15, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-05 22:50:34', '2022-01-05 22:50:34'),
(25, '800759737', '2', 'Tri-Grip-2B Pencils', 3, 6.00, 'Processing', 'FCPCTG2B-12', 'Faber-Castell-Tri-Grip-2B-Pencil -12pcs.jpg', '2022-01-05 22:50:34', '2022-01-05 22:50:34'),
(26, '1291909763', '2', 'Click X7', 15, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-05 22:59:13', '2022-01-05 22:59:13'),
(27, '1291909763', '2', 'Tri-Grip-2B Pencils', 5, 6.00, 'Processing', 'FCPCTG2B-12', 'Faber-Castell-Tri-Grip-2B-Pencil -12pcs.jpg', '2022-01-05 22:59:13', '2022-01-05 22:59:13'),
(28, '1290354076', '2', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-05 23:42:17', '2022-01-05 23:42:17'),
(29, '1290354076', '2', 'PM99', 10, 1.00, 'Processing', 'FCPC-PM99', '119000_0_PM99.jpg', '2022-01-05 23:42:17', '2022-01-05 23:42:17'),
(30, '2040462188', '1', 'Click X7', 5, 1.50, 'Processing', 'FCCX7-03', 'FABER-CASTELL-CLICK-X7-RED.jpg', '2022-01-06 04:23:14', '2022-01-06 04:23:14'),
(31, '2040462188', '1', 'Tri-Grip-2B Pencils', 5, 6.00, 'Processing', 'FCPCTG2B-12', 'Faber-Castell-Tri-Grip-2B-Pencil -12pcs.jpg', '2022-01-06 04:23:14', '2022-01-06 04:23:14'),
(32, '106415392', '1', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-10 05:38:38', '2022-01-10 05:38:38'),
(33, '1379073122', '1', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-10 05:39:57', '2022-01-10 05:39:57'),
(34, '2093118127', '1', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', '2022-01-10 05:51:41', '2022-01-10 05:51:41'),
(35, '2093118127', '1', 'Click X7', 10, 1.50, 'Processing', 'FCCX7-02', 'FABER-CASTELL-CLICK-X7-BLUE.jpg', '2022-01-10 05:51:41', '2022-01-10 05:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `unitPrice` double(8,2) NOT NULL,
  `productVariety` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productSKU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplierID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productID`, `name`, `description`, `quantity`, `price`, `unitPrice`, `productVariety`, `productSKU`, `image`, `categoryID`, `brandID`, `supplierID`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FCCX7-01', 'Click X7', 'This is the Faber Castell Click series.', 938, 1.50, 1.00, 'Black', 'FCCX7-01', 'FABER-CASTELL-CLICK-X7-BLACK.jpg', 'C001', 'B001', 'SP001', 'Available', '2021-12-26 04:56:43', '2022-01-11 01:17:15'),
(2, 'FCCX7-02', 'Click X7', 'This is the Faber Castell Click series.', 1010, 1.50, 1.00, 'blue', 'FCCX7-02', 'FABER-CASTELL-CLICK-X7-BLUE.jpg', 'C001', 'B001', 'SP001', 'Available', '2021-12-26 04:57:53', '2022-01-11 01:11:03'),
(3, 'FCCX7-03', 'Click X7', 'This is the Faber Castell click series.', 1100, 1.50, 1.00, 'Red', 'FCCX7-03', 'FABER-CASTELL-CLICK-X7-RED.jpg', 'C001', 'B001', 'SP001', 'Available', '2021-12-26 04:58:54', '2022-01-11 00:16:33'),
(4, 'FCPC-PM99', 'PM99', 'This is the Faber Castell Pencil, PM99', 400, 1.00, 0.50, '2B', 'FCPC-PM99', '119000_0_PM99.jpg', 'C002', 'B001', 'SP001', 'Available', '2021-12-26 06:00:31', '2022-01-10 20:42:00'),
(5, 'FCPC13232B-12', '2B Pencils - 12pcs', 'Faber Castell Pencil, 12pcs per packet.', 604, 4.00, 2.00, '2B', 'FCPC13232B-12', 'Faber-Castell 2B Pencils-12.jpg', 'C002', 'B001', 'SP001', 'Available', '2021-12-26 06:03:51', '2022-01-11 01:10:38'),
(6, 'FCPCTG2B-12', 'Tri-Grip-2B Pencils', 'Faber Castell Tri-Grip-2B Pencils, 12pcs per packet.', 1040, 6.00, 4.00, '2B', 'FCPCTG2B-12', 'Faber-Castell-Tri-Grip-2B-Pencil -12pcs.jpg', 'C002', 'B001', 'SP001', 'Available', '2021-12-26 06:05:21', '2022-01-06 04:23:16'),
(7, 'FCDFE-001', 'Dust-Free Eraser', 'Testing', 300, 1.00, 0.80, 'White', 'FCDFE-001', 'FABER-CASTELL-DUST-FREE-ERASER-7086-30.jpg', 'C004', 'B001', 'SP001', 'Available', '2021-12-31 21:20:07', '2022-01-10 20:48:44'),
(17, 'FBCPLSF-24', 'Color Pencil', 'Sample', 1000, 5.60, 3.00, '1pack', 'FBCPLSF-24', 'FA16116253_faber_castell_colour_grip_pencils_24_pack.jpg', 'C003', 'B001', 'SP001', 'Available', '2022-01-10 06:12:55', '2022-01-10 06:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_oder_r_s`
--

CREATE TABLE `purchase_oder_r_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order` int(10) UNSIGNED NOT NULL,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitPrice` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `received_quantity` int(10) NOT NULL,
  `grand_total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_oder_r_s`
--

INSERT INTO `purchase_oder_r_s` (`id`, `purchase_order`, `productID`, `unitPrice`, `quantity`, `received_quantity`, `grand_total`) VALUES
(78, 35, 'FCPC13232B-12', 2.00, 100, 100, 200.00),
(79, 35, 'FCDFE-001', 0.80, 100, 100, 80.00),
(80, 36, 'FCCX7-01', 1.00, 100, 100, 100.00),
(81, 36, 'FCCX7-02', 1.00, 100, 100, 100.00),
(82, 36, 'FCCX7-03', 1.00, 100, 100, 100.00),
(83, 37, 'FCCX7-02', 1.00, 100, 0, 100.00),
(84, 37, 'FCCX7-01', 1.00, 100, 0, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplierID` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `delivery_order` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `document_no`, `supplierID`, `notes`, `status`, `delivery_order`, `invoice_no`, `created_at`, `updated_at`) VALUES
(35, 'PO2022-0001', 1, 'Sample', 1, '12345-2', 'IN-0092', '2022-01-10 20:47:44', '2022-01-10 20:54:41'),
(36, 'PO2022-0002', 1, 'SAMPLE', 1, '12351-3', NULL, '2022-01-10 20:51:39', '2022-01-10 20:52:57'),
(37, 'PO2022-0003', 1, 'Sample', 1, NULL, 'IN-00971', '2022-01-11 01:55:53', '2022-01-11 02:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplierID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplierName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactPerson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplierID`, `supplierName`, `address`, `state`, `city`, `zipcode`, `companyEmail`, `contactPerson`, `contactNumber`, `emailAddress`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SP001', 'Faber-Castell', '11, Jalan Tebrau, Taman Kaya', 'Johor', 'Johor Bahru', '80110', 'Faber-Castell@gmail.com', 'Lucas', '0167774465', 'Faber-Castell@gmail.com', 'Available', '2021-12-26 04:45:39', '2021-12-26 04:45:39'),
(2, 'SP002', 'Pilot Supplier', '11, Jalan Tebrau, Taman Kaya', 'Johor', 'Johor Bahru', '80110', 'Lr123@gmail.com', 'John Tan', '0167774465', 'Lr123@gmail.com', 'Available', '2021-12-26 04:46:16', '2021-12-26 04:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(10) NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `address`, `state`, `zipcode`, `city`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Customer01', 'Customer@gmail.com', 167363193, '45, Jalan Nibung, Taman Melodies, 80250, Johor Bahru, Johor, 80250, Johor Bahru, Johor', 'Johor', 80250, 'Johor Bahru', NULL, '$2y$10$uh5jLSJ6Gn7b6cp2Iqu0uO71ffp7Jset/43cPs9QwpvGPlovd9AFi', NULL, '2021-12-26 05:09:50', '2021-12-26 05:09:50'),
(2, 'User1', 'User1@gmail.com', 119987652, '11, Jalan Tebrau, Taman Kaya', 'Johor', 81100, 'Johor Bahru', NULL, '$2y$10$YU.0lakKZ/A7h31ZLEAIX.gDfvqCFkfXfTCmRI9aBXt27Ju9PV7e2', NULL, '2022-01-03 17:19:50', '2022-01-10 17:03:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_orders`
--
ALTER TABLE `offline_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_order__details`
--
ALTER TABLE `offline_order__details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_oder_r_s`
--
ALTER TABLE `purchase_oder_r_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_unique` (`contact`),
  ADD UNIQUE KEY `users_address_unique` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `offline_orders`
--
ALTER TABLE `offline_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `offline_order__details`
--
ALTER TABLE `offline_order__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase_oder_r_s`
--
ALTER TABLE `purchase_oder_r_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
