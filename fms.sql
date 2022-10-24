-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2022 at 05:42 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `after_proccess_products`
--

CREATE TABLE `after_proccess_products` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `packaging_quantity` decimal(14,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packaging_at` timestamp NULL DEFAULT NULL,
  `ready_to_stock` timestamp NULL DEFAULT NULL,
  `in_stocked` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `after_proccess_products`
--

INSERT INTO `after_proccess_products` (`id`, `product_id`, `packaging_quantity`, `unit_price`, `total_price`, `unit`, `unit_value`, `status`, `packaging_at`, `ready_to_stock`, `in_stocked`, `created_at`, `updated_at`) VALUES
(3, 1, '11.00', '30.00', '150.00', 'ml', '250.00', 'in_stocked', '2022-05-18 05:58:45', NULL, '2022-05-18 06:01:16', '2022-05-18 05:58:45', '2022-05-18 06:01:16'),
(4, 1, '1.00', '30.00', '30.00', 'ml', '250.00', 'packaging', '2022-05-18 06:57:49', NULL, NULL, '2022-05-18 06:57:49', '2022-05-18 06:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `after_proccess_product_materials`
--

CREATE TABLE `after_proccess_product_materials` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `after_proccess_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `unit_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `after_proccess_product_materials`
--

INSERT INTO `after_proccess_product_materials` (`id`, `product_id`, `after_proccess_product_id`, `stock_id`, `raw_id`, `quantity`, `unit_price`, `unit`, `unit_value`, `total_price`, `type`, `status`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 9, 14, 2, '4.00', 'ml', '250.00', '8.00', 'pack', NULL, NULL, NULL, '2022-05-18 05:58:45', '2022-05-18 05:58:45'),
(2, 1, 2, 9, 14, 4, '4.00', 'ml', '250.00', '16.00', 'pack', NULL, NULL, NULL, '2022-05-18 05:58:45', '2022-05-18 05:58:45'),
(3, 1, 3, 9, 14, 5, '4.00', 'ml', '250.00', '20.00', 'pack', NULL, NULL, NULL, '2022-05-18 05:58:45', '2022-05-18 05:58:45'),
(4, 1, 4, 9, 14, 1, '4.00', 'ml', '250.00', '4.00', 'pack', NULL, NULL, NULL, '2022-05-18 06:57:49', '2022-05-18 06:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `active`, `user_id`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 'Herbs', 'raw', 1, 1, 1, 1, '2022-02-28 11:38:27', '2022-04-10 10:10:58'),
(2, 'Chemical', 'raw', 1, 1, 1, NULL, '2022-02-28 11:38:37', '2022-02-28 11:38:37'),
(3, 'Label', 'pack', 1, 1, 1, 1, '2022-02-28 11:39:20', '2022-04-10 10:11:32'),
(4, 'Carton (Master Carton)', 'pack', 1, 1, 1, 1, '2022-02-28 11:39:28', '2022-04-10 10:32:38'),
(18, 'Bottle (পেট বোতল)', 'pack', 1, 1, 1, 1, '2022-04-10 10:15:53', '2022-04-10 10:20:44'),
(19, 'Bottle (Plastic Bottle)', 'pack', 1, 1, 1, 1, '2022-04-10 10:16:45', '2022-04-10 10:34:41'),
(20, 'Cap', 'pack', 1, 1, 1, NULL, '2022-04-10 10:16:55', '2022-04-10 10:16:55'),
(21, 'Insert (বিজ্ঞাপন)', 'pack', 1, 1, 1, NULL, '2022-04-10 10:17:49', '2022-04-10 10:17:49'),
(22, 'Carton (Inner Carton)', 'pack', 1, 1, 1, 1, '2022-04-10 10:22:40', '2022-04-10 10:33:09'),
(23, 'Carton (Half-Dozen Carton)', 'pack', 1, 1, 1, 1, '2022-04-10 10:23:33', '2022-04-10 10:33:39'),
(24, 'Carton (Dozen Carton)', 'pack', 1, 1, 1, 1, '2022-04-10 10:23:45', '2022-04-10 10:33:56'),
(25, 'Cup (কাপ)', 'pack', 1, 1, 1, NULL, '2022-04-10 10:24:23', '2022-04-10 10:24:23'),
(26, 'Dropper', 'pack', 1, 1, 1, NULL, '2022-04-10 10:25:07', '2022-04-10 10:25:07'),
(27, 'Bottle (কাঁচের বোতল) China', 'pack', 1, 1, 1, 1, '2022-04-10 10:26:33', '2022-04-10 10:36:22'),
(28, 'Bottle (কাঁচের বোতল) Local', 'pack', 1, 1, 1, NULL, '2022-04-10 10:36:33', '2022-04-10 10:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `daily_productions`
--

CREATE TABLE `daily_productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `pack` bigint(20) NOT NULL DEFAULT '0',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_value` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_productions`
--

INSERT INTO `daily_productions` (`id`, `product_id`, `category_id`, `product_name`, `category_name`, `quantity`, `pack`, `unit`, `unit_value`, `type`, `type_value`, `status`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 216, 19, 'Abelmoschus', 'Potency Medicine (Dialution) Germany Style Bottle', 683, 10, 'ml', 30, 'power', 6, 'rejected', 1, NULL, '2022-05-17 10:49:04', '2022-05-17 10:49:23'),
(2, 229, 19, 'Abroma Aug', 'Potency Medicine (Dialution) Germany Style Bottle', 119, 36, 'ml', 30, 'power', 200, 'approved', 1, NULL, '2022-05-17 10:49:12', '2022-05-17 10:49:26'),
(3, 225, 19, 'Abroma Aug', 'Potency Medicine (Dialution) Germany Style Bottle', 488, 13, 'ml', 30, 'power', 6, 'rejected', 1, NULL, '2022-05-17 10:49:14', '2022-05-17 10:49:35'),
(4, 115, 19, 'Abroma Rad', 'Potency Medicine (Dialution) Germany Style Bottle', 685, 67, 'ml', 30, 'power', 12, 'approved', 1, NULL, '2022-05-17 10:49:17', '2022-05-17 10:49:30'),
(5, 84, 16, 'ABROMA RAD Ø', 'Homoeopathic Mother Tincture', 929, 49, 'ml', 450, 'class', 0, 'approved', 1, NULL, '2022-05-17 10:49:20', '2022-05-17 10:49:33');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_02_17_061917_setup_countries_table', 1),
(10, '2021_02_17_061919_charify_countries_table', 1),
(11, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(12, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(13, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(14, '2016_06_01_000004_create_oauth_clients_table', 2),
(15, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(16, '2021_02_17_073503_create_my_roles_table', 3),
(17, '2021_02_17_103758_create_member_accounts_table', 4),
(18, '2021_02_18_141459_create_depos_table', 5),
(19, '2021_02_18_141513_create_dealers_table', 6),
(20, '2021_02_18_141527_create_distributors_table', 6),
(21, '2021_02_18_141547_create_agents_table', 6),
(22, '2021_02_20_130021_create_website_balances_table', 7),
(28, '2021_02_20_141051_create_role_payments_table', 8),
(34, '2021_02_20_154313_create_sales_lists_table', 9),
(36, '2021_02_21_132310_create_markets_table', 9),
(37, '2021_02_20_154114_create_ecommerce_categories_table', 10),
(38, '2021_02_20_154514_create_ecommerce_products_table', 10),
(39, '2021_02_27_110121_create_projects_table', 10),
(40, '2021_02_27_113258_create_project_subscribers_table', 10),
(41, '2021_03_02_041553_create_ecommerce_shop_categories_table', 10),
(42, '2021_03_02_042041_create_ecommerce_cat_shops_table', 10),
(43, '2021_03_02_060546_create_ecommerce_sources_table', 10),
(44, '2021_03_02_062310_create_project_domains_table', 10),
(45, '2021_03_02_111450_create_ecommerce_orders_table', 10),
(46, '2021_03_02_123058_create_ecommerce_order_items_table', 10),
(47, '2021_03_06_081317_create_ecommerce_order_payments_table', 10),
(49, '2021_03_16_102207_create_ecommerce_product_media_table', 11),
(50, '2021_03_17_054736_create_ecommerce_cat_products_table', 12),
(51, '2021_03_23_101951_create_ecommerce_product_prices_table', 13),
(52, '2021_03_29_065422_create_ecommerce_carts_table', 14),
(54, '2021_04_11_103317_create_ecommerce_sales_list_products_table', 15),
(56, '2021_04_18_050455_create_ecommerce_payment_collections_table', 16),
(60, '2022_01_29_134139_create_raws_table', 17),
(61, '2022_01_29_163633_create_suppliers_table', 17),
(66, '2022_01_29_190248_create_requisitions_table', 18),
(67, '2022_01_29_190448_create_requisition_items_table', 18),
(80, '2022_02_02_192503_create_samples_table', 19),
(81, '2022_02_05_125942_sample_item', 20),
(82, '2022_02_05_133003_raw_stock', 20),
(88, '2022_02_06_103027_create_products_table', 21),
(89, '2022_02_06_103030_create_product_materials_table', 21),
(90, '2022_02_12_165232_create_supplier_payments_table', 22),
(91, '2022_02_28_170255_create_categories_table', 23),
(92, '2022_02_28_185015_create_stationeries_table', 24),
(93, '2022_03_01_140235_create_raw_stock_modify_histories_table', 25),
(95, '2022_03_01_163100_create_sub_categories_table', 26),
(98, '2022_03_09_122334_create_daily_productions_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `my_roles`
--

CREATE TABLE `my_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_roles`
--

INSERT INTO `my_roles` (`id`, `user_id`, `role_name`, `role_value`, `nid`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Admin', NULL, 1, 1, '2021-02-17 12:52:32', '2021-02-17 12:52:32'),
(16, 44, 'admin', 'Admin', NULL, 1, 1, '2021-02-17 12:52:32', '2021-02-17 12:52:32'),
(18, 1, 'production', 'Production', NULL, 1, 1, '2021-02-17 12:52:32', '2021-02-17 12:52:32'),
(19, 1, 'accounts', 'Accounts', NULL, 1, 1, '2021-02-17 12:52:32', '2021-02-17 12:52:32'),
(22, 86, 'production', 'Production', '456464', 1, NULL, '2022-01-29 09:48:56', '2022-01-29 09:48:56'),
(23, 87, 'accounts', 'Accounts', '01788888888', 1, NULL, '2022-01-29 10:06:36', '2022-01-29 10:06:36'),
(24, 88, 'factory_manager', 'factory_manager', '01733669988', 1, NULL, '2022-03-13 09:18:43', '2022-03-13 09:18:43'),
(25, 89, 'purchase', 'Purchase', '01733669989', 1, NULL, '2022-03-13 09:19:40', '2022-03-13 09:19:40'),
(26, 1, 'purchase', 'Purchase', '9555222224', 1, NULL, '2022-03-13 09:32:42', '2022-03-13 09:32:42'),
(27, 1, 'factory_manager', 'factory_manager', '9555222224', 1, NULL, '2022-03-13 09:45:00', '2022-03-13 09:45:00'),
(28, 90, 'production', 'Production', '5085272314', 1, NULL, '2022-03-15 14:09:25', '2022-03-15 14:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `my_role_items`
--

CREATE TABLE `my_role_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `my_role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ConnectingPark Personal Access Client', 'iq5axdFlWuzGOCwTPm5qFTQPUTs3Rg9NVh3fs0B2', NULL, 'http://localhost', 1, 0, 0, '2021-02-17 00:53:41', '2021-02-17 00:53:41'),
(2, NULL, 'ConnectingPark Password Grant Client', 'i3B67oM3Xuitdfxh2DLjL9vKBzjw4onhm2I9AquX', 'users', 'http://localhost', 0, 1, 0, '2021-02-17 00:53:41', '2021-02-17 00:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-02-17 00:53:41', '2021-02-17 00:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pack_req_temps`
--

CREATE TABLE `pack_req_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pack_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dhpl_cat_id` bigint(20) DEFAULT NULL,
  `pack_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` bigint(20) NOT NULL DEFAULT '0',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `sample_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(8,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `sample_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_unit_value` decimal(8,2) NOT NULL DEFAULT '0.00',
  `sample_total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `sample_unit_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `multiply_qty` bigint(20) NOT NULL DEFAULT '0',
  `total_raw_quantity` decimal(14,3) NOT NULL DEFAULT '0.000',
  `total_raw_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `total_pack_quantity` decimal(14,2) NOT NULL DEFAULT '0.00',
  `total_pack_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `packaging_unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `packaging_at` timestamp NULL DEFAULT NULL,
  `ready_to_stock` timestamp NULL DEFAULT NULL,
  `in_stocked` timestamp NULL DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sample_id`, `name`, `unit`, `unit_value`, `unit_price`, `total_price`, `sample_name`, `sample_unit`, `sample_unit_value`, `sample_total_price`, `sample_unit_price`, `multiply_qty`, `total_raw_quantity`, `total_raw_price`, `total_pack_quantity`, `total_pack_price`, `packaging_unit_value`, `status`, `pending_at`, `confirmed_at`, `rejected_at`, `processing_at`, `packaging_at`, `ready_to_stock`, `in_stocked`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Agnus Cast-Q', 'ml', '0.00', '30.00', '150.00', 'Agnus Cast-Q', 'ml', '300.00', '0.00', '0.00', 10, '15.000', '150.00', '0.00', '0.00', '0.00', 'processing', '2022-05-18 05:56:55', '2022-05-18 05:57:20', NULL, '2022-05-18 05:57:26', NULL, NULL, NULL, 1, NULL, '2022-05-18 05:56:42', '2022-05-18 06:57:49'),
(2, 1, 'Agnus Cast-Q', 'ml', '15000.00', '30.00', '750.00', 'Agnus Cast-Q', 'ml', '300.00', '0.00', '0.00', 50, '75.000', '750.00', '0.00', '0.00', '0.00', 'confirmed', '2022-05-18 05:57:11', '2022-05-18 06:46:34', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-05-18 05:56:56', '2022-05-18 06:46:34'),
(3, 2, 'Agnus Cast-Q', 'ml', '1200.00', '0.00', '38890.50', 'Agnus Cast-Q', 'ml', '1200.00', '0.00', '0.00', 1, '2121.000', '38890.50', '0.00', '0.00', '0.00', 'pending', '2022-05-18 07:53:29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-05-18 05:57:11', '2022-05-18 07:53:29'),
(4, NULL, NULL, NULL, '0.00', '0.00', '0.00', NULL, NULL, '0.00', '0.00', '0.00', 0, '0.000', '0.00', '0.00', '0.00', '0.00', 'temp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-05-18 07:53:29', '2022-05-18 07:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` decimal(8,3) NOT NULL DEFAULT '0.000',
  `unit_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`id`, `product_id`, `stock_id`, `raw_id`, `quantity`, `unit_price`, `unit`, `total_price`, `type`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 217, '5.000', '9.00', 'kg', '45.00', 'raw', NULL, NULL, '2022-05-18 05:56:55', '2022-05-18 05:56:55'),
(2, 1, 6, 218, '5.000', '10.00', 'kg', '50.00', 'raw', NULL, NULL, '2022-05-18 05:56:55', '2022-05-18 05:56:55'),
(3, 1, 7, 219, '5.000', '11.00', 'kg', '55.00', 'raw', NULL, NULL, '2022-05-18 05:56:55', '2022-05-18 05:56:55'),
(4, 2, 5, 217, '25.000', '9.00', 'kg', '225.00', 'raw', NULL, NULL, '2022-05-18 05:57:11', '2022-05-18 05:57:11'),
(5, 2, 6, 218, '25.000', '10.00', 'kg', '250.00', 'raw', NULL, NULL, '2022-05-18 05:57:11', '2022-05-18 05:57:11'),
(6, 2, 7, 219, '25.000', '11.00', 'kg', '275.00', 'raw', NULL, NULL, '2022-05-18 05:57:11', '2022-05-18 05:57:11'),
(7, 3, 5, 217, '319.500', '9.00', 'kg', '2875.50', 'raw', NULL, NULL, '2022-05-18 07:53:29', '2022-05-18 07:53:29'),
(8, 3, 25, 217, '1800.000', '20.00', 'kg', '36000.00', 'raw', NULL, NULL, '2022-05-18 07:53:29', '2022-05-18 07:53:29'),
(9, 3, 6, 218, '1.500', '10.00', 'kg', '15.00', 'raw', NULL, NULL, '2022-05-18 07:53:29', '2022-05-18 07:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `raws`
--

CREATE TABLE `raws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dhpl_cat_id` bigint(20) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `raw_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `mandatory_qty` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raws`
--

INSERT INTO `raws` (`id`, `name`, `unit`, `unit_value`, `category_id`, `dhpl_cat_id`, `type`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`, `raw_cat_id`, `product_id`, `product_name`, `product_type`, `product_type_value`, `mandatory`, `mandatory_qty`) VALUES
(1, '(Label): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:50', '2022-04-19 07:13:50', 3, 1, 'Aconite', 'number', '0.00', 0, 1),
(2, '(Label): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:50', '2022-04-19 07:13:50', 3, 2, 'Alfalfa-Q', 'number', '0.00', 0, 1),
(3, '(Label): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:50', '2022-04-19 07:13:50', 3, 3, 'Alfalfa-Q', 'number', '0.00', 0, 1),
(4, '(Label): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 4, 'Alfalfa-Q', 'number', '0.00', 0, 1),
(5, '(Label): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 5, 'Alfalfa-Q SP.', 'number', '0.00', 0, 1),
(6, '(Label): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 6, 'Alfalfa-Q SP.', 'number', '0.00', 0, 1),
(7, '(Label): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 7, 'Amloki Baby-Q', 'number', '0.00', 0, 1),
(8, '(Label): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 8, 'Amloki-Q', 'number', '0.00', 0, 1),
(9, '(Label): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 9, 'Amloki-Q', 'number', '0.00', 0, 1),
(10, '(Label): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 10, 'Amloki-Q', 'number', '0.00', 0, 1),
(11, '(Label): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 11, 'Asoka-Q', 'number', '0.00', 0, 1),
(12, '(Label): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 12, 'Avena Sat-Q', 'number', '0.00', 0, 1),
(13, '(Label): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 13, 'Agnus Cast-Q', 'number', '0.00', 0, 1),
(14, '(Label): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 14, 'Agnus Cast-Q', 'number', '0.00', 0, 1),
(15, '(Label): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 15, 'Agnus Cast-Q', 'number', '0.00', 0, 1),
(16, '(Label): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 16, 'Arjuna-Q', 'number', '0.00', 0, 1),
(17, '(Label): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:51', '2022-04-19 07:13:51', 3, 17, 'Anacardium-Q', 'number', '0.00', 0, 1),
(18, '(Label): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 18, 'Berberis Vul. Q', 'number', '0.00', 0, 1),
(19, '(Label): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 19, 'Borax- 4x', 'number', '0.00', 0, 1),
(20, '(Label): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 20, 'Borax- 4x', 'number', '0.00', 0, 1),
(21, '(Label): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 21, 'Bryonia alb-Q', 'number', '0.00', 0, 1),
(22, '(Label): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 22, 'Bryonia alb-Q', 'number', '0.00', 0, 1),
(23, '(Label): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 23, 'Chelidonium-Q', 'number', '0.00', 0, 1),
(24, '(Label): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 24, 'Chelidonium-Q', 'number', '0.00', 0, 1),
(25, '(Label): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 25, 'China Baby-Q', 'number', '0.00', 0, 1),
(26, '(Label): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 26, 'China off-Q', 'number', '0.00', 0, 1),
(27, '(Label): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 27, 'China off-Q', 'number', '0.00', 0, 1),
(28, '(Label): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 28, 'China off-Q', 'number', '0.00', 0, 1),
(29, '(Label): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 29, 'Cantharis-Q', 'number', '0.00', 0, 1),
(30, '(Label): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 30, 'Damiana-Q', 'number', '0.00', 0, 1),
(31, '(Label): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 31, 'Damiana-Q', 'number', '0.00', 0, 1),
(32, '(Label): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 32, 'Echinacea-Q', 'number', '0.00', 0, 1),
(33, '(Label): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 33, 'Echinacea-Q', 'number', '0.00', 0, 1),
(34, '(Label): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:52', '2022-04-19 07:13:52', 3, 34, 'Echinacea-Q', 'number', '0.00', 0, 1),
(35, '(Label): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 35, 'Echinacea-Q', 'number', '0.00', 0, 1),
(36, '(Label): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 36, 'Five Phos 6x', 'number', '0.00', 0, 1),
(37, '(Label): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 37, 'Five Phos 6x', 'number', '0.00', 0, 1),
(38, '(Label): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 38, 'Five Phos 6x', 'number', '0.00', 0, 1),
(39, '(Label): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 39, 'Podophylum-Q', 'number', '0.00', 0, 1),
(40, '(Label): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 40, 'Holarrhena-Q', 'number', '0.00', 0, 1),
(41, '(Label): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 41, 'Justicia Adha-Q', 'number', '0.00', 0, 1),
(42, '(Label): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 42, 'Justicia Adha-Q', 'number', '0.00', 0, 1),
(43, '(Label): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 43, 'Justicia Adha-Q', 'number', '0.00', 0, 1),
(44, '(Label): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 44, 'Kalmegh-Q', 'number', '0.00', 0, 1),
(45, '(Label): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 45, 'Kalmegh-Q', 'number', '0.00', 0, 1),
(46, '(Label): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 46, 'Kalmegh-Q', 'number', '0.00', 0, 1),
(47, '(Label): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:53', '2022-04-19 07:13:53', 3, 47, 'Nux vom-Q', 'number', '0.00', 0, 1),
(48, '(Label): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 48, 'Nux vom-Q', 'number', '0.00', 0, 1),
(49, '(Label): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 49, 'Nux vom-Q', 'number', '0.00', 0, 1),
(50, '(Label): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 50, 'Pulsatilla-Q', 'number', '0.00', 0, 1),
(51, '(Label): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 0, 1),
(52, '(Label): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 52, 'Syzygium Jam-Q', 'number', '0.00', 0, 1),
(53, '(Label): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 196, 'Embelica-Q', 'number', '0.00', 0, 1),
(54, '(Label): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 3, 1, 'pack', 1, 1, NULL, '2022-04-19 07:13:54', '2022-04-19 07:13:54', 3, 197, 'Hydrastic Can-Q', 'number', '0.00', 0, 1),
(55, '(Carton (Master Carton)): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:07', '2022-04-19 07:14:07', 4, 1, 'Aconite', 'number', '0.00', 0, 0),
(56, '(Carton (Master Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:07', '2022-04-19 07:14:07', 4, 2, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(57, '(Carton (Master Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:07', '2022-04-19 07:14:07', 4, 3, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(58, '(Carton (Master Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:07', '2022-04-19 07:14:07', 4, 4, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(59, '(Carton (Master Carton)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 5, 'Alfalfa-Q SP.', 'number', '0.00', 0, 0),
(60, '(Carton (Master Carton)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 6, 'Alfalfa-Q SP.', 'number', '0.00', 0, 0),
(61, '(Carton (Master Carton)): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 7, 'Amloki Baby-Q', 'number', '0.00', 0, 0),
(62, '(Carton (Master Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 8, 'Amloki-Q', 'number', '0.00', 0, 0),
(63, '(Carton (Master Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 9, 'Amloki-Q', 'number', '0.00', 0, 0),
(64, '(Carton (Master Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 10, 'Amloki-Q', 'number', '0.00', 0, 0),
(65, '(Carton (Master Carton)): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 11, 'Asoka-Q', 'number', '0.00', 0, 0),
(66, '(Carton (Master Carton)): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 12, 'Avena Sat-Q', 'number', '0.00', 0, 0),
(67, '(Carton (Master Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 13, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(68, '(Carton (Master Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 14, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(69, '(Carton (Master Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 15, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(70, '(Carton (Master Carton)): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 16, 'Arjuna-Q', 'number', '0.00', 0, 0),
(71, '(Carton (Master Carton)): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 17, 'Anacardium-Q', 'number', '0.00', 0, 0),
(72, '(Carton (Master Carton)): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 18, 'Berberis Vul. Q', 'number', '0.00', 0, 0),
(73, '(Carton (Master Carton)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 19, 'Borax- 4x', 'number', '0.00', 0, 0),
(74, '(Carton (Master Carton)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 20, 'Borax- 4x', 'number', '0.00', 0, 0),
(75, '(Carton (Master Carton)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 21, 'Bryonia alb-Q', 'number', '0.00', 0, 0),
(76, '(Carton (Master Carton)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 22, 'Bryonia alb-Q', 'number', '0.00', 0, 0),
(77, '(Carton (Master Carton)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:08', '2022-04-19 07:14:08', 4, 23, 'Chelidonium-Q', 'number', '0.00', 0, 0),
(78, '(Carton (Master Carton)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 24, 'Chelidonium-Q', 'number', '0.00', 0, 0),
(79, '(Carton (Master Carton)): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 25, 'China Baby-Q', 'number', '0.00', 0, 0),
(80, '(Carton (Master Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 26, 'China off-Q', 'number', '0.00', 0, 0),
(81, '(Carton (Master Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 27, 'China off-Q', 'number', '0.00', 0, 0),
(82, '(Carton (Master Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 28, 'China off-Q', 'number', '0.00', 0, 0),
(83, '(Carton (Master Carton)): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 29, 'Cantharis-Q', 'number', '0.00', 0, 0),
(84, '(Carton (Master Carton)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 30, 'Damiana-Q', 'number', '0.00', 0, 0),
(85, '(Carton (Master Carton)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 31, 'Damiana-Q', 'number', '0.00', 0, 0),
(86, '(Carton (Master Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 32, 'Echinacea-Q', 'number', '0.00', 0, 0),
(87, '(Carton (Master Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 33, 'Echinacea-Q', 'number', '0.00', 0, 0),
(88, '(Carton (Master Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 34, 'Echinacea-Q', 'number', '0.00', 0, 0),
(89, '(Carton (Master Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 35, 'Echinacea-Q', 'number', '0.00', 0, 0),
(90, '(Carton (Master Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 36, 'Five Phos 6x', 'number', '0.00', 0, 0),
(91, '(Carton (Master Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 37, 'Five Phos 6x', 'number', '0.00', 0, 0),
(92, '(Carton (Master Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 38, 'Five Phos 6x', 'number', '0.00', 0, 0),
(93, '(Carton (Master Carton)): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 39, 'Podophylum-Q', 'number', '0.00', 0, 0),
(94, '(Carton (Master Carton)): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 40, 'Holarrhena-Q', 'number', '0.00', 0, 0),
(95, '(Carton (Master Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 41, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(96, '(Carton (Master Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:09', '2022-04-19 07:14:09', 4, 42, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(97, '(Carton (Master Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 43, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(98, '(Carton (Master Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 44, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(99, '(Carton (Master Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 45, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(100, '(Carton (Master Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 46, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(101, '(Carton (Master Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 47, 'Nux vom-Q', 'number', '0.00', 0, 0),
(102, '(Carton (Master Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 48, 'Nux vom-Q', 'number', '0.00', 0, 0),
(103, '(Carton (Master Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 49, 'Nux vom-Q', 'number', '0.00', 0, 0),
(104, '(Carton (Master Carton)): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 50, 'Pulsatilla-Q', 'number', '0.00', 0, 0),
(105, '(Carton (Master Carton)): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 0, 0),
(106, '(Carton (Master Carton)): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:10', '2022-04-19 07:14:10', 4, 52, 'Syzygium Jam-Q', 'number', '0.00', 0, 0),
(107, '(Carton (Master Carton)): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:11', '2022-04-19 07:14:11', 4, 196, 'Embelica-Q', 'number', '0.00', 0, 0),
(108, '(Carton (Master Carton)): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 4, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:11', '2022-04-19 07:14:11', 4, 197, 'Hydrastic Can-Q', 'number', '0.00', 0, 0),
(109, '(Bottle (পেট বোতল)): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 1, 'Aconite', 'number', '0.00', 1, 0),
(110, '(Bottle (পেট বোতল)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 2, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(111, '(Bottle (পেট বোতল)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 3, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(112, '(Bottle (পেট বোতল)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 4, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(113, '(Bottle (পেট বোতল)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 5, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(114, '(Bottle (পেট বোতল)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 6, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(115, '(Bottle (পেট বোতল)): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 7, 'Amloki Baby-Q', 'number', '0.00', 1, 0),
(116, '(Bottle (পেট বোতল)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 8, 'Amloki-Q', 'number', '0.00', 1, 0),
(117, '(Bottle (পেট বোতল)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 9, 'Amloki-Q', 'number', '0.00', 1, 0),
(118, '(Bottle (পেট বোতল)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 10, 'Amloki-Q', 'number', '0.00', 1, 0),
(119, '(Bottle (পেট বোতল)): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 11, 'Asoka-Q', 'number', '0.00', 1, 0),
(120, '(Bottle (পেট বোতল)): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 12, 'Avena Sat-Q', 'number', '0.00', 1, 0),
(121, '(Bottle (পেট বোতল)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 13, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(122, '(Bottle (পেট বোতল)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 14, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(123, '(Bottle (পেট বোতল)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 15, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(124, '(Bottle (পেট বোতল)): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 16, 'Arjuna-Q', 'number', '0.00', 1, 0),
(125, '(Bottle (পেট বোতল)): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 17, 'Anacardium-Q', 'number', '0.00', 1, 0),
(126, '(Bottle (পেট বোতল)): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:19', '2022-04-19 07:14:19', 18, 18, 'Berberis Vul. Q', 'number', '0.00', 1, 0),
(127, '(Bottle (পেট বোতল)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 19, 'Borax- 4x', 'number', '0.00', 1, 0),
(128, '(Bottle (পেট বোতল)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 20, 'Borax- 4x', 'number', '0.00', 1, 0),
(129, '(Bottle (পেট বোতল)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 21, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(130, '(Bottle (পেট বোতল)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 22, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(131, '(Bottle (পেট বোতল)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 23, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(132, '(Bottle (পেট বোতল)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 24, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(133, '(Bottle (পেট বোতল)): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 25, 'China Baby-Q', 'number', '0.00', 1, 0),
(134, '(Bottle (পেট বোতল)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 26, 'China off-Q', 'number', '0.00', 1, 0),
(135, '(Bottle (পেট বোতল)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 27, 'China off-Q', 'number', '0.00', 1, 0),
(136, '(Bottle (পেট বোতল)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 28, 'China off-Q', 'number', '0.00', 1, 0),
(137, '(Bottle (পেট বোতল)): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 29, 'Cantharis-Q', 'number', '0.00', 1, 0),
(138, '(Bottle (পেট বোতল)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 30, 'Damiana-Q', 'number', '0.00', 1, 0),
(139, '(Bottle (পেট বোতল)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 31, 'Damiana-Q', 'number', '0.00', 1, 0),
(140, '(Bottle (পেট বোতল)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 32, 'Echinacea-Q', 'number', '0.00', 1, 0),
(141, '(Bottle (পেট বোতল)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 33, 'Echinacea-Q', 'number', '0.00', 1, 0),
(142, '(Bottle (পেট বোতল)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 34, 'Echinacea-Q', 'number', '0.00', 1, 0),
(143, '(Bottle (পেট বোতল)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:20', '2022-04-19 07:14:20', 18, 35, 'Echinacea-Q', 'number', '0.00', 1, 0),
(144, '(Bottle (পেট বোতল)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 36, 'Five Phos 6x', 'number', '0.00', 1, 0),
(145, '(Bottle (পেট বোতল)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 37, 'Five Phos 6x', 'number', '0.00', 1, 0),
(146, '(Bottle (পেট বোতল)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 38, 'Five Phos 6x', 'number', '0.00', 1, 0),
(147, '(Bottle (পেট বোতল)): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 39, 'Podophylum-Q', 'number', '0.00', 1, 0),
(148, '(Bottle (পেট বোতল)): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 40, 'Holarrhena-Q', 'number', '0.00', 1, 0),
(149, '(Bottle (পেট বোতল)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 41, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(150, '(Bottle (পেট বোতল)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 42, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(151, '(Bottle (পেট বোতল)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 43, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(152, '(Bottle (পেট বোতল)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 44, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(153, '(Bottle (পেট বোতল)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 45, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(154, '(Bottle (পেট বোতল)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 46, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(155, '(Bottle (পেট বোতল)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 47, 'Nux vom-Q', 'number', '0.00', 1, 0),
(156, '(Bottle (পেট বোতল)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 48, 'Nux vom-Q', 'number', '0.00', 1, 0),
(157, '(Bottle (পেট বোতল)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 49, 'Nux vom-Q', 'number', '0.00', 1, 0),
(158, '(Bottle (পেট বোতল)): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 50, 'Pulsatilla-Q', 'number', '0.00', 1, 0),
(159, '(Bottle (পেট বোতল)): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 1, 0),
(160, '(Bottle (পেট বোতল)): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 52, 'Syzygium Jam-Q', 'number', '0.00', 1, 0),
(161, '(Bottle (পেট বোতল)): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 196, 'Embelica-Q', 'number', '0.00', 1, 0),
(162, '(Bottle (পেট বোতল)): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 18, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:21', '2022-04-19 07:14:21', 18, 197, 'Hydrastic Can-Q', 'number', '0.00', 1, 0),
(163, '(Bottle (Plastic Bottle)): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:32', '2022-04-19 07:14:32', 19, 1, 'Aconite', 'number', '0.00', 1, 0),
(164, '(Bottle (Plastic Bottle)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:32', '2022-04-19 07:14:32', 19, 2, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(165, '(Bottle (Plastic Bottle)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 3, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(166, '(Bottle (Plastic Bottle)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 4, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(167, '(Bottle (Plastic Bottle)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 5, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(168, '(Bottle (Plastic Bottle)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 6, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(169, '(Bottle (Plastic Bottle)): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 7, 'Amloki Baby-Q', 'number', '0.00', 1, 0),
(170, '(Bottle (Plastic Bottle)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 8, 'Amloki-Q', 'number', '0.00', 1, 0),
(171, '(Bottle (Plastic Bottle)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 9, 'Amloki-Q', 'number', '0.00', 1, 0),
(172, '(Bottle (Plastic Bottle)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 10, 'Amloki-Q', 'number', '0.00', 1, 0),
(173, '(Bottle (Plastic Bottle)): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 11, 'Asoka-Q', 'number', '0.00', 1, 0),
(174, '(Bottle (Plastic Bottle)): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 12, 'Avena Sat-Q', 'number', '0.00', 1, 0),
(175, '(Bottle (Plastic Bottle)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 13, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(176, '(Bottle (Plastic Bottle)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 14, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(177, '(Bottle (Plastic Bottle)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 15, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(178, '(Bottle (Plastic Bottle)): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:33', '2022-04-19 07:14:33', 19, 16, 'Arjuna-Q', 'number', '0.00', 1, 0),
(179, '(Bottle (Plastic Bottle)): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 17, 'Anacardium-Q', 'number', '0.00', 1, 0),
(180, '(Bottle (Plastic Bottle)): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 18, 'Berberis Vul. Q', 'number', '0.00', 1, 0),
(181, '(Bottle (Plastic Bottle)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 19, 'Borax- 4x', 'number', '0.00', 1, 0),
(182, '(Bottle (Plastic Bottle)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 20, 'Borax- 4x', 'number', '0.00', 1, 0),
(183, '(Bottle (Plastic Bottle)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 21, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(184, '(Bottle (Plastic Bottle)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 22, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(185, '(Bottle (Plastic Bottle)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 23, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(186, '(Bottle (Plastic Bottle)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 24, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(187, '(Bottle (Plastic Bottle)): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 25, 'China Baby-Q', 'number', '0.00', 1, 0),
(188, '(Bottle (Plastic Bottle)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 26, 'China off-Q', 'number', '0.00', 1, 0),
(189, '(Bottle (Plastic Bottle)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 27, 'China off-Q', 'number', '0.00', 1, 0),
(190, '(Bottle (Plastic Bottle)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 28, 'China off-Q', 'number', '0.00', 1, 0),
(191, '(Bottle (Plastic Bottle)): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 29, 'Cantharis-Q', 'number', '0.00', 1, 0),
(192, '(Bottle (Plastic Bottle)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 30, 'Damiana-Q', 'number', '0.00', 1, 0),
(193, '(Bottle (Plastic Bottle)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 31, 'Damiana-Q', 'number', '0.00', 1, 0),
(194, '(Bottle (Plastic Bottle)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:34', '2022-04-19 07:14:34', 19, 32, 'Echinacea-Q', 'number', '0.00', 1, 0),
(195, '(Bottle (Plastic Bottle)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 33, 'Echinacea-Q', 'number', '0.00', 1, 0),
(196, '(Bottle (Plastic Bottle)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 34, 'Echinacea-Q', 'number', '0.00', 1, 0),
(197, '(Bottle (Plastic Bottle)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 35, 'Echinacea-Q', 'number', '0.00', 1, 0),
(198, '(Bottle (Plastic Bottle)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 36, 'Five Phos 6x', 'number', '0.00', 1, 0),
(199, '(Bottle (Plastic Bottle)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 37, 'Five Phos 6x', 'number', '0.00', 1, 0),
(200, '(Bottle (Plastic Bottle)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 38, 'Five Phos 6x', 'number', '0.00', 1, 0),
(201, '(Bottle (Plastic Bottle)): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 39, 'Podophylum-Q', 'number', '0.00', 1, 0),
(202, '(Bottle (Plastic Bottle)): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 40, 'Holarrhena-Q', 'number', '0.00', 1, 0),
(203, '(Bottle (Plastic Bottle)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 41, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(204, '(Bottle (Plastic Bottle)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 42, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(205, '(Bottle (Plastic Bottle)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 43, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(206, '(Bottle (Plastic Bottle)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 44, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(207, '(Bottle (Plastic Bottle)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 45, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(208, '(Bottle (Plastic Bottle)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 46, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(209, '(Bottle (Plastic Bottle)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 47, 'Nux vom-Q', 'number', '0.00', 1, 0),
(210, '(Bottle (Plastic Bottle)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:35', '2022-04-19 07:14:35', 19, 48, 'Nux vom-Q', 'number', '0.00', 1, 0),
(211, '(Bottle (Plastic Bottle)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 49, 'Nux vom-Q', 'number', '0.00', 1, 0),
(212, '(Bottle (Plastic Bottle)): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 50, 'Pulsatilla-Q', 'number', '0.00', 1, 0),
(213, '(Bottle (Plastic Bottle)): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 1, 0),
(214, '(Bottle (Plastic Bottle)): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 52, 'Syzygium Jam-Q', 'number', '0.00', 1, 0),
(215, '(Bottle (Plastic Bottle)): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 196, 'Embelica-Q', 'number', '0.00', 1, 0),
(216, '(Bottle (Plastic Bottle)): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 19, 1, 'pack', 1, 1, NULL, '2022-04-19 07:14:36', '2022-04-19 07:14:36', 19, 197, 'Hydrastic Can-Q', 'number', '0.00', 1, 0),
(217, 'ABIES CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(218, 'ABIES NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(219, 'ABROMA AUG (ULAT KAMBAL)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(220, 'ABROMA RAD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(221, 'ABROTANUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(222, 'ABSINTHIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(223, 'ACALYPHA IND', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(224, 'ACID ACET', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(225, 'ACID BENZ ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(226, 'ACID CARB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(227, 'ACID CHRYSO', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(228, 'ACID LACT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(229, 'ACID NIT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(230, 'ACID OXALIC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(231, 'ACID PHOS', 'ltr', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(232, 'ACID PIC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(233, 'ACID SALIC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(234, 'ACID SULP', 'ltr', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(235, 'ACONITE NAP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(236, 'ACTAEA SPICATA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(237, 'ADONIS VER ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:57', '2022-04-19 07:17:57', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(238, 'AEGLE FOLIA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0);
INSERT INTO `raws` (`id`, `name`, `unit`, `unit_value`, `category_id`, `dhpl_cat_id`, `type`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`, `raw_cat_id`, `product_id`, `product_name`, `product_type`, `product_type_value`, `mandatory`, `mandatory_qty`) VALUES
(239, 'AEGLE MAR (BELSONTH)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(240, 'AESCULUS HIP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(241, 'AETHOSA CY', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(242, 'AGARICUS MUSC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(243, 'AGNUS CAST', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(244, 'ALETRIS FAR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(245, 'ALFALFA (MEDICAGO SAT)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(246, 'ALLIUM CEPA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(247, 'ALLIUM SAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(248, 'ALOE SOC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(249, 'ALSTONIA S.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(250, 'AMBRA GRISEA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(251, 'AMLOKI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:58', '2022-04-19 07:17:58', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(252, 'AMYL NIT', 'ltr', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(253, 'ANACARDIUM OCC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(254, 'ANACARDIUM ORI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(255, 'ANAGALLIS ARV', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(256, 'ANTIM CRUD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(257, 'ANTIM TART', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(258, 'APIS MEL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(259, 'APOCYNUM AN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(260, 'APOCYNUM CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(261, 'ARALIA RAC.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(262, 'ARCTIUM LAPPA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(263, 'CARDUUS MAR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(264, 'CARICA PAP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(265, 'CASCARA SAG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(266, 'CASSIA SOP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(267, 'CAULOPHYLLUM T.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(268, 'CAUSTICUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(269, 'CEANOTHUS AM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(270, 'CEPHALANDRA IND', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(271, 'CHAMOMILLA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(272, 'CHAPARRO AM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:17:59', '2022-04-19 07:17:59', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(273, 'CHELIDONIUM M.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(274, 'CHENOPODIUM AN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(275, 'CHIMAPHILA UM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(276, 'CHINA (CINCHONA OFF)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(277, 'CHIONANTHUS VIR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(278, 'CHIRATA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(279, 'CICUTA V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(280, 'CIMICIFUGA R. (ACTAEA RAC)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(281, 'CINA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(282, 'CIN MAR SUC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(283, 'CINNAMONUM (DARUCHINI)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(284, 'CLEMATIS E.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(285, 'COCA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(286, 'COCCULUS IND', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(287, 'COCCUS CACTI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(288, 'COFFEA CRUD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(289, 'COLCHICUM A.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(290, 'COLLINSONIA CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(291, 'COLOCYNTHIS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(292, 'CONDURANGO', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:00', '2022-04-19 07:18:00', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(293, 'CONIUM MAC ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(294, 'CONVALLARIA MAJ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(295, 'COPAIBA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(296, 'CRATAEGUS OX', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(297, 'CROCUS SAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(298, 'CROTON TIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(299, 'CUBEBA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(300, 'CYCLAMEN E. ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(301, 'DAMIANA (TURNERA D.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(302, 'DATURA ARB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(303, 'DESMODIUM G.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(304, 'DHANIYA (CORIANDRUM SAT)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(305, 'DIGITALIS P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(306, 'DIOSCOREA V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(307, 'DOLICHOS P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(308, 'DROSERA R.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(309, 'DULCAMARA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(310, 'DURBA ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(311, 'ECHINACEA AN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:01', '2022-04-19 07:18:01', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(312, 'ELACH (ELATTARIA C.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(313, 'KACHA HALUDA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(314, 'KALI BICH', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(315, 'KALI IOD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(316, 'KALMEGH', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(317, 'KALMIA LAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(318, 'KAKRA SRINGI (BRUGUIERA G.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(319, 'KATPHAL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(320, 'KREOSOTE (CREOSOTE)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(321, 'KUR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(322, 'KURCHI (HOLARRHENA AN)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(323, 'LABANGA (SYZYGIUM A.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(324, 'LACHESIS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(325, 'LACHNANTHES T', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(326, 'LAPIS ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(327, 'LAPPA MAJ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(328, 'LATHYRUS SAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(329, 'LEDUM PAL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(330, 'LEMNA MINOR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:02', '2022-04-19 07:18:02', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(331, 'LIATRIS SPI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(332, 'LILIUM TIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(333, 'LOBELIA IN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(334, 'LUFFA BINDAL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(335, 'LYCOPERSICUM E.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(336, 'LYCOPODIUM C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(337, 'MACH RASH', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(338, 'MANJISTHA (CAPPARIS SPINOSA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(339, 'MAURI (FOENICULUM VUL)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(340, 'MELILOTUS ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(341, 'MENTHA PIP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(342, 'MEZEREUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(343, 'MILLEFOLIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(344, 'MITHA BISH (ACONITUM FER)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(345, 'MULLEIN (VERBASCUM THAP )', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(346, 'MUNDI (SPHAERANTHUS INDICUS)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(347, 'MYRICA C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(348, 'MYRISTICA S.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:03', '2022-04-19 07:18:03', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(349, 'NIM PATA (AZADIRACHTA IND)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(350, 'NUPHAR LUT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(351, 'NUX JUGLANS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(352, 'NUX MOSCH', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(353, 'NUX VOM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(354, 'NYCTANTHES ARB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(355, 'OCIMUM CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(356, 'OCIMUM SAN (TULSI PATA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(357, 'OLEUM JEC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(358, 'ORIGANUM MAJ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(359, 'ORNITHOGALUM UM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(360, 'OXYDENDRON ARB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(361, 'PAEONIA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(362, 'SPIGELIA ANTH', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(363, 'SPONGIA TOSTA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(364, 'STAPHYSAGRIA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(365, 'STRAMONIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(366, 'SULPHUR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(367, 'SUMBUL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:04', '2022-04-19 07:18:04', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(368, 'SYMPHYTUM OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(369, 'SYZYGIUM JAM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(370, 'TABACUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(371, 'TEJPATA (CINNAMOMUM T.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(372, 'TELLURIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(373, 'TEREBINTHINAE OLE', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(374, 'TERMINALIA C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(375, 'TEUCRIUM M. V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(376, 'THIOSINAMINUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(377, 'THLASPI B. P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(378, 'THUJA OCC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(379, 'TRIBULUS TER', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(380, 'TRILLIUM PEND', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(381, 'URANIUM NIT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(382, 'URTICA URENS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(383, 'USTILAGO M.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(384, 'UVA URSI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(385, 'VALERIANA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(386, 'VERATRUM ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(387, 'VERATRUM VIR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(388, 'VESICARIA COM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(389, 'VIBURNUM OPU', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:05', '2022-04-19 07:18:05', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(390, 'VIBURNUM PRU', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(391, 'VINCA MINOR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(392, 'VIOLA ODO', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(393, 'VISCUM ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(394, 'YASTHIMADHU (GLYCYRRHIZA G.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(395, 'XANTHOXYLUM F.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(396, 'YERBA SANTA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(397, 'YOHIMBINUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(398, 'ZINGIBER OFF (ADA SONTH)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(399, 'ARCTIUM LAPPA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(400, 'ARGENT NIT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(401, 'ARJUNA (TERMINALIA ARJUNA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(402, 'ARNICA MONT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(403, 'ARNICA RED', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(404, 'ARS ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(405, 'ARTEMISIA VUL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(406, 'ARUM TRI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(407, 'ASAFOETIDA (HING)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:06', '2022-04-19 07:18:06', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(408, 'ASHWAGANDHA (WITHANIA SOM)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(409, 'ASPARAGUS OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(410, 'ASPIDOSPERMA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(411, 'ATISTA IND', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(412, 'ATISTA RAD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(413, 'AVENA SAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(414, 'AZADIRACHTA IND (NIM CHAL)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(415, 'BABCHI  (PSORALEA COR)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(416, 'BABLA GAM (ACACIA ARABICA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(417, 'BADIAGA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(418, 'BAHERA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(419, 'BALSAMUM PERU', 'ltr', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(420, 'BAPTISIA TINC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:07', '2022-04-19 07:18:07', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(421, 'BELLADONNA ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(422, 'BELLIS PER', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(423, 'BERBERIS AQU', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(424, 'BERBERIS VUL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(425, 'BLATTA ORI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(426, 'BLUMEA ODO', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(427, 'BOERHAAVIA DIF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(428, 'BOERHAAVIA REP', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(429, 'BORAX', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(430, 'BOVISTA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(431, 'BRAHMI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(432, 'BRIHATI (SOLANUM IND)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(433, 'BRYONIA ALB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(434, 'BRYOPHYLLUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(435, 'BUFO RANA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(436, 'CACTUS G.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(437, 'CALADIUM SEG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(438, 'CALENDULA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(439, 'CALENDULA SUC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:08', '2022-04-19 07:18:08', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(440, 'CALOTROPIS G.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(441, 'CAMPHORA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(442, 'CANTHARIS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(443, 'CAPSICUM A.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(444, 'ELATERIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(445, 'EMBELIA RIB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(446, 'EPHEDRA NEB', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(447, 'EQUISETUM HY', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(448, 'EUCALYPTUS G.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(449, 'EUPATORIUM PER', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(450, 'EUPATORIUM PUR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(451, 'EUPHORBIA HY', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(452, 'EUPHRASIA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(453, 'FILIX MAS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(454, 'FORMICA RUFA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(455, 'FRAXINUS AM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(456, 'FUCUS VESI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(457, 'GALEGA OFF', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(458, 'GAMBOGIA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:09', '2022-04-19 07:18:09', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(459, 'GAULTHERIA PRO', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(460, 'GELSEMIUM S.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(461, 'GENTIANA LUT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(462, 'GERANIUM MAC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(463, 'GINSENG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(464, 'GLONOINUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(465, 'GOL MARIC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(466, 'GOSSYPIUM H.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(467, 'GRANATUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(468, 'GRINDELIA R.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(469, 'GUAIACUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(470, 'GUGUL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(471, 'GYMNEMA SYL', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(472, 'HAMAMELIS V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(473, 'HARITAKI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(474, 'HELLEBORUS NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:10', '2022-04-19 07:18:10', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(475, 'HELONIAS D.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(476, 'HYDRASTIS CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(477, 'HYDROCOTYLE A.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(478, 'HYGROPHILLA S.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(479, 'HYOSCYAMUS NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(480, 'HYPERICUM P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(481, 'IBERIS AMARA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(482, 'IGNATIA AMARA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(483, 'IODIUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(484, 'IPECAC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(485, 'IRIS VER', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(486, 'JABORANDI', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(487, 'JALAPA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(488, 'JANOSIA ASHOKA (ASHOK)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(489, 'JATROPHA C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(490, 'JAIN (TRACYSPERMUM AMMI)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(491, 'JIRA (CUMINUM CYMINUM)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(492, 'JUSTICIA ADHA (VASAKA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(493, 'KACHA PAPA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:11', '2022-04-19 07:18:11', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(494, 'PASSIFLORA INC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(495, 'PATAL PATA (TRICHOSANTHES D.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(496, 'PATHARKUCHI (BRYOPHYLLUM C.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(497, 'PETROLEUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(498, 'PHOSPHORUS', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(499, 'PHYSOSTIGMA V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(500, 'PHYTOLACCAC DEC', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(501, 'PINUS LAM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(502, 'PIPER MET', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(503, 'PIPUL (FICUS R.)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(504, 'PLANTAGO MAJ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(505, 'PODOPHYLLUM P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(506, 'PULSATILLA NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(507, 'QUASSIA AMARA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(508, 'RANUNCULUS A.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(509, 'RAPHANUS SAT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(510, 'RATANHIA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:12', '2022-04-19 07:18:12', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(511, 'RAUWOLFIA SER', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(512, 'RHEUM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(513, 'RHODODENDRON C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(514, 'RHUS AROM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(515, 'RHUS TOX', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(516, 'RHUS VEN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(517, 'RICINUS COM', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(518, 'ROBINIA P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(519, 'ROHITAKA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(520, 'RUMEX C.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(521, 'RUTA G.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(522, 'SABADILLA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(523, 'SABAL SERRU', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(524, 'SABINA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(525, 'SALIX NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(526, 'SAMBUCUS NIG', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(527, 'SANGUINARIA CAN', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(528, 'SANGUINARINUM NIT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(529, 'SARRACENIA P.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(530, 'SARSAPARILLA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(531, 'SCROPHULARIA NOD', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(532, 'SECALE COR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(533, 'SEMUL (BOMBAX CEIBA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:13', '2022-04-19 07:18:13', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(534, 'SENECIO AUR', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(535, 'SENEGA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(536, 'SENNA (SONAPATA)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(537, 'SEPIA', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(538, 'SHAPLA PHULA (NYMPHAEA ODO)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(539, 'SHATAMULL (ASPARAGAS RAC)', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(540, 'SHILAJIT', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(541, 'SOLIDAGO V.', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(542, 'SOMRAJ', 'kg', '0.00', 1, NULL, 'raw', 1, NULL, NULL, '2022-04-19 07:18:14', '2022-04-19 07:18:14', NULL, NULL, NULL, NULL, '0.00', 0, 0),
(543, '(Bottle (কাঁচের বোতল) China): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:05', '2022-04-19 07:34:05', 27, 1, 'Aconite', 'number', '0.00', 1, 0),
(544, '(Bottle (কাঁচের বোতল) China): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:05', '2022-04-19 07:34:05', 27, 2, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(545, '(Bottle (কাঁচের বোতল) China): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 3, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(546, '(Bottle (কাঁচের বোতল) China): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 4, 'Alfalfa-Q', 'number', '0.00', 1, 0),
(547, '(Bottle (কাঁচের বোতল) China): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 5, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(548, '(Bottle (কাঁচের বোতল) China): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 6, 'Alfalfa-Q SP.', 'number', '0.00', 1, 0),
(549, '(Bottle (কাঁচের বোতল) China): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 7, 'Amloki Baby-Q', 'number', '0.00', 1, 0),
(550, '(Bottle (কাঁচের বোতল) China): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 8, 'Amloki-Q', 'number', '0.00', 1, 0),
(551, '(Bottle (কাঁচের বোতল) China): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 9, 'Amloki-Q', 'number', '0.00', 1, 0),
(552, '(Bottle (কাঁচের বোতল) China): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 10, 'Amloki-Q', 'number', '0.00', 1, 0),
(553, '(Bottle (কাঁচের বোতল) China): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 11, 'Asoka-Q', 'number', '0.00', 1, 0),
(554, '(Bottle (কাঁচের বোতল) China): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 12, 'Avena Sat-Q', 'number', '0.00', 1, 0),
(555, '(Bottle (কাঁচের বোতল) China): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 13, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(556, '(Bottle (কাঁচের বোতল) China): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 14, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(557, '(Bottle (কাঁচের বোতল) China): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 15, 'Agnus Cast-Q', 'number', '0.00', 1, 0),
(558, '(Bottle (কাঁচের বোতল) China): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 16, 'Arjuna-Q', 'number', '0.00', 1, 0),
(559, '(Bottle (কাঁচের বোতল) China): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 17, 'Anacardium-Q', 'number', '0.00', 1, 0);
INSERT INTO `raws` (`id`, `name`, `unit`, `unit_value`, `category_id`, `dhpl_cat_id`, `type`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`, `raw_cat_id`, `product_id`, `product_name`, `product_type`, `product_type_value`, `mandatory`, `mandatory_qty`) VALUES
(560, '(Bottle (কাঁচের বোতল) China): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 18, 'Berberis Vul. Q', 'number', '0.00', 1, 0),
(561, '(Bottle (কাঁচের বোতল) China): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 19, 'Borax- 4x', 'number', '0.00', 1, 0),
(562, '(Bottle (কাঁচের বোতল) China): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 20, 'Borax- 4x', 'number', '0.00', 1, 0),
(563, '(Bottle (কাঁচের বোতল) China): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:06', '2022-04-19 07:34:06', 27, 21, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(564, '(Bottle (কাঁচের বোতল) China): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 22, 'Bryonia alb-Q', 'number', '0.00', 1, 0),
(565, '(Bottle (কাঁচের বোতল) China): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 23, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(566, '(Bottle (কাঁচের বোতল) China): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 24, 'Chelidonium-Q', 'number', '0.00', 1, 0),
(567, '(Bottle (কাঁচের বোতল) China): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 25, 'China Baby-Q', 'number', '0.00', 1, 0),
(568, '(Bottle (কাঁচের বোতল) China): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 26, 'China off-Q', 'number', '0.00', 1, 0),
(569, '(Bottle (কাঁচের বোতল) China): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 27, 'China off-Q', 'number', '0.00', 1, 0),
(570, '(Bottle (কাঁচের বোতল) China): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 28, 'China off-Q', 'number', '0.00', 1, 0),
(571, '(Bottle (কাঁচের বোতল) China): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 29, 'Cantharis-Q', 'number', '0.00', 1, 0),
(572, '(Bottle (কাঁচের বোতল) China): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 30, 'Damiana-Q', 'number', '0.00', 1, 0),
(573, '(Bottle (কাঁচের বোতল) China): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 31, 'Damiana-Q', 'number', '0.00', 1, 0),
(574, '(Bottle (কাঁচের বোতল) China): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 32, 'Echinacea-Q', 'number', '0.00', 1, 0),
(575, '(Bottle (কাঁচের বোতল) China): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 33, 'Echinacea-Q', 'number', '0.00', 1, 0),
(576, '(Bottle (কাঁচের বোতল) China): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 34, 'Echinacea-Q', 'number', '0.00', 1, 0),
(577, '(Bottle (কাঁচের বোতল) China): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 35, 'Echinacea-Q', 'number', '0.00', 1, 0),
(578, '(Bottle (কাঁচের বোতল) China): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 36, 'Five Phos 6x', 'number', '0.00', 1, 0),
(579, '(Bottle (কাঁচের বোতল) China): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 37, 'Five Phos 6x', 'number', '0.00', 1, 0),
(580, '(Bottle (কাঁচের বোতল) China): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:07', '2022-04-19 07:34:07', 27, 38, 'Five Phos 6x', 'number', '0.00', 1, 0),
(581, '(Bottle (কাঁচের বোতল) China): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 39, 'Podophylum-Q', 'number', '0.00', 1, 0),
(582, '(Bottle (কাঁচের বোতল) China): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 40, 'Holarrhena-Q', 'number', '0.00', 1, 0),
(583, '(Bottle (কাঁচের বোতল) China): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 41, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(584, '(Bottle (কাঁচের বোতল) China): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 42, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(585, '(Bottle (কাঁচের বোতল) China): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 43, 'Justicia Adha-Q', 'number', '0.00', 1, 0),
(586, '(Bottle (কাঁচের বোতল) China): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 44, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(587, '(Bottle (কাঁচের বোতল) China): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 45, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(588, '(Bottle (কাঁচের বোতল) China): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 46, 'Kalmegh-Q', 'number', '0.00', 1, 0),
(589, '(Bottle (কাঁচের বোতল) China): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 47, 'Nux vom-Q', 'number', '0.00', 1, 0),
(590, '(Bottle (কাঁচের বোতল) China): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 48, 'Nux vom-Q', 'number', '0.00', 1, 0),
(591, '(Bottle (কাঁচের বোতল) China): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 49, 'Nux vom-Q', 'number', '0.00', 1, 0),
(592, '(Bottle (কাঁচের বোতল) China): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 50, 'Pulsatilla-Q', 'number', '0.00', 1, 0),
(593, '(Bottle (কাঁচের বোতল) China): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 1, 0),
(594, '(Bottle (কাঁচের বোতল) China): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 52, 'Syzygium Jam-Q', 'number', '0.00', 1, 0),
(595, '(Bottle (কাঁচের বোতল) China): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 196, 'Embelica-Q', 'number', '0.00', 1, 0),
(596, '(Bottle (কাঁচের বোতল) China): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 27, 1, 'pack', 1, 1, NULL, '2022-04-19 07:34:08', '2022-04-19 07:34:08', 27, 197, 'Hydrastic Can-Q', 'number', '0.00', 1, 0),
(597, '(Carton (Dozen Carton)): Aconite: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 1, 'Aconite', 'number', '0.00', 0, 0),
(598, '(Carton (Dozen Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 2, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(599, '(Carton (Dozen Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 3, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(600, '(Carton (Dozen Carton)): Alfalfa-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 4, 'Alfalfa-Q', 'number', '0.00', 0, 0),
(601, '(Carton (Dozen Carton)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 5, 'Alfalfa-Q SP.', 'number', '0.00', 0, 0),
(602, '(Carton (Dozen Carton)): Alfalfa-Q SP.: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 6, 'Alfalfa-Q SP.', 'number', '0.00', 0, 0),
(603, '(Carton (Dozen Carton)): Amloki Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 7, 'Amloki Baby-Q', 'number', '0.00', 0, 0),
(604, '(Carton (Dozen Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 8, 'Amloki-Q', 'number', '0.00', 0, 0),
(605, '(Carton (Dozen Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 9, 'Amloki-Q', 'number', '0.00', 0, 0),
(606, '(Carton (Dozen Carton)): Amloki-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 10, 'Amloki-Q', 'number', '0.00', 0, 0),
(607, '(Carton (Dozen Carton)): Asoka-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 11, 'Asoka-Q', 'number', '0.00', 0, 0),
(608, '(Carton (Dozen Carton)): Avena Sat-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 12, 'Avena Sat-Q', 'number', '0.00', 0, 0),
(609, '(Carton (Dozen Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 13, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(610, '(Carton (Dozen Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 14, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(611, '(Carton (Dozen Carton)): Agnus Cast-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 15, 'Agnus Cast-Q', 'number', '0.00', 0, 0),
(612, '(Carton (Dozen Carton)): Arjuna-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:46', '2022-05-11 06:25:46', 24, 16, 'Arjuna-Q', 'number', '0.00', 0, 0),
(613, '(Carton (Dozen Carton)): Anacardium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 17, 'Anacardium-Q', 'number', '0.00', 0, 0),
(614, '(Carton (Dozen Carton)): Berberis Vul. Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 18, 'Berberis Vul. Q', 'number', '0.00', 0, 0),
(615, '(Carton (Dozen Carton)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 19, 'Borax- 4x', 'number', '0.00', 0, 0),
(616, '(Carton (Dozen Carton)): Borax- 4x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 20, 'Borax- 4x', 'number', '0.00', 0, 0),
(617, '(Carton (Dozen Carton)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 21, 'Bryonia alb-Q', 'number', '0.00', 0, 0),
(618, '(Carton (Dozen Carton)): Bryonia alb-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 22, 'Bryonia alb-Q', 'number', '0.00', 0, 0),
(619, '(Carton (Dozen Carton)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 23, 'Chelidonium-Q', 'number', '0.00', 0, 0),
(620, '(Carton (Dozen Carton)): Chelidonium-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 24, 'Chelidonium-Q', 'number', '0.00', 0, 0),
(621, '(Carton (Dozen Carton)): China Baby-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 25, 'China Baby-Q', 'number', '0.00', 0, 0),
(622, '(Carton (Dozen Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 26, 'China off-Q', 'number', '0.00', 0, 0),
(623, '(Carton (Dozen Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 27, 'China off-Q', 'number', '0.00', 0, 0),
(624, '(Carton (Dozen Carton)): China off-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 28, 'China off-Q', 'number', '0.00', 0, 0),
(625, '(Carton (Dozen Carton)): Cantharis-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 29, 'Cantharis-Q', 'number', '0.00', 0, 0),
(626, '(Carton (Dozen Carton)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 30, 'Damiana-Q', 'number', '0.00', 0, 0),
(627, '(Carton (Dozen Carton)): Damiana-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 31, 'Damiana-Q', 'number', '0.00', 0, 0),
(628, '(Carton (Dozen Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 32, 'Echinacea-Q', 'number', '0.00', 0, 0),
(629, '(Carton (Dozen Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 33, 'Echinacea-Q', 'number', '0.00', 0, 0),
(630, '(Carton (Dozen Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 34, 'Echinacea-Q', 'number', '0.00', 0, 0),
(631, '(Carton (Dozen Carton)): Echinacea-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 35, 'Echinacea-Q', 'number', '0.00', 0, 0),
(632, '(Carton (Dozen Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 36, 'Five Phos 6x', 'number', '0.00', 0, 0),
(633, '(Carton (Dozen Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:47', '2022-05-11 06:25:47', 24, 37, 'Five Phos 6x', 'number', '0.00', 0, 0),
(634, '(Carton (Dozen Carton)): Five Phos 6x: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 38, 'Five Phos 6x', 'number', '0.00', 0, 0),
(635, '(Carton (Dozen Carton)): Podophylum-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 39, 'Podophylum-Q', 'number', '0.00', 0, 0),
(636, '(Carton (Dozen Carton)): Holarrhena-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '60.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 40, 'Holarrhena-Q', 'number', '0.00', 0, 0),
(637, '(Carton (Dozen Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 41, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(638, '(Carton (Dozen Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 42, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(639, '(Carton (Dozen Carton)): Justicia Adha-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 43, 'Justicia Adha-Q', 'number', '0.00', 0, 0),
(640, '(Carton (Dozen Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '15.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 44, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(641, '(Carton (Dozen Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '30.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 45, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(642, '(Carton (Dozen Carton)): Kalmegh-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 46, 'Kalmegh-Q', 'number', '0.00', 0, 0),
(643, '(Carton (Dozen Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 47, 'Nux vom-Q', 'number', '0.00', 0, 0),
(644, '(Carton (Dozen Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '250.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 48, 'Nux vom-Q', 'number', '0.00', 0, 0),
(645, '(Carton (Dozen Carton)): Nux vom-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '450.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 49, 'Nux vom-Q', 'number', '0.00', 0, 0),
(646, '(Carton (Dozen Carton)): Pulsatilla-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 50, 'Pulsatilla-Q', 'number', '0.00', 0, 0),
(647, '(Carton (Dozen Carton)): Rauwalfia Ser-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 51, 'Rauwalfia Ser-Q', 'number', '0.00', 0, 0),
(648, '(Carton (Dozen Carton)): Syzygium Jam-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 52, 'Syzygium Jam-Q', 'number', '0.00', 0, 0),
(649, '(Carton (Dozen Carton)): Embelica-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 196, 'Embelica-Q', 'number', '0.00', 0, 0),
(650, '(Carton (Dozen Carton)): Hydrastic Can-Q: Homoeopathic Medicine (In Dosege Form)', 'ml', '100.00', 24, 1, 'pack', 1, 1, NULL, '2022-05-11 06:25:48', '2022-05-11 06:25:48', 24, 197, 'Hydrastic Can-Q', 'number', '0.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `raw_stocks`
--

CREATE TABLE `raw_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_quantity` decimal(14,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dhpl_cat_id` bigint(20) DEFAULT NULL,
  `raw_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pack_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `vat` decimal(14,2) NOT NULL DEFAULT '0.00',
  `vat_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `final_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `by_requisition` tinyint(1) NOT NULL DEFAULT '1',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_stocks`
--

INSERT INTO `raw_stocks` (`id`, `requisition_id`, `requisition_item_id`, `total_quantity`, `unit_price`, `raw_id`, `category_id`, `dhpl_cat_id`, `raw_cat_id`, `pack_cat_id`, `product_id`, `product_name`, `supplier_id`, `unit`, `unit_value`, `vat`, `vat_price`, `final_price`, `type`, `by_requisition`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '767.00', '10.00', 313, 1, NULL, NULL, NULL, NULL, NULL, 1, 'kg', '0.00', '0.00', '0.00', '10.00', 'raw', 1, 1, NULL, '2022-04-19 07:28:34', '2022-04-19 07:28:34'),
(2, 3, 9, '1400.00', '5.00', 220, 1, NULL, NULL, NULL, NULL, NULL, 1, 'kg', '0.00', '0.00', '0.00', '5.00', 'raw', 1, 1, NULL, '2022-04-19 07:30:23', '2022-04-19 07:30:23'),
(3, 3, 10, '744.00', '6.00', 221, 1, NULL, NULL, NULL, NULL, NULL, 2, 'kg', '0.00', '0.00', '0.00', '6.00', 'raw', 1, 1, NULL, '2022-04-19 07:30:23', '2022-04-19 07:30:23'),
(4, 3, 11, '1300.00', '7.00', 222, 1, NULL, NULL, NULL, NULL, NULL, 2, 'kg', '0.00', '0.00', '0.00', '7.00', 'raw', 1, 1, NULL, '2022-04-19 07:30:23', '2022-04-19 07:30:23'),
(5, 2, 6, '319.50', '9.00', 217, 1, NULL, NULL, NULL, NULL, NULL, 1, 'kg', '0.00', '0.00', '0.00', '9.00', 'raw', 1, 1, NULL, '2022-04-19 07:31:02', '2022-05-18 06:46:34'),
(6, 2, 7, '1016.50', '10.00', 218, 1, NULL, NULL, NULL, NULL, NULL, 2, 'kg', '0.00', '0.00', '0.00', '10.00', 'raw', 1, 1, NULL, '2022-04-19 07:31:02', '2022-05-18 06:46:34'),
(7, 2, 8, '1519.50', '11.00', 219, 1, NULL, NULL, NULL, NULL, NULL, 3, 'kg', '0.00', '0.00', '0.00', '11.00', 'raw', 1, 1, NULL, '2022-04-19 07:31:03', '2022-05-18 06:46:34'),
(8, 5, 12, '86.00', '5.00', 13, 1, 1, 1, 3, 13, 'Agnus Cast-Q', 1, 'ml', '100.00', '0.00', '0.00', '5.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:13', '2022-05-08 13:02:56'),
(9, 5, 13, '36.00', '4.00', 14, 1, 1, 1, 3, 14, 'Agnus Cast-Q', 2, 'ml', '250.00', '0.00', '0.00', '4.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:13', '2022-05-18 06:57:49'),
(10, 5, 14, '100.00', '3.00', 15, 1, 1, 1, 3, 15, 'Agnus Cast-Q', 3, 'ml', '450.00', '0.00', '0.00', '3.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:14', '2022-04-19 07:35:14'),
(11, 6, 15, '493.00', '7.00', 121, 1, 1, 1, 18, 13, 'Agnus Cast-Q', 1, 'ml', '100.00', '0.00', '0.00', '7.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:45', '2022-05-08 13:02:56'),
(12, 6, 16, '1460.00', '6.00', 122, 1, 1, 1, 18, 14, 'Agnus Cast-Q', 1, 'ml', '250.00', '0.00', '0.00', '6.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:45', '2022-05-18 06:57:49'),
(13, 6, 17, '854.00', '2.00', 123, 1, 1, 1, 18, 15, 'Agnus Cast-Q', 2, 'ml', '450.00', '0.00', '0.00', '2.00', 'pack', 1, 1, NULL, '2022-04-19 07:35:45', '2022-04-19 07:35:45'),
(14, 7, 18, '1500.00', '7.00', 175, 1, 1, 1, 19, 13, 'Agnus Cast-Q', 1, 'ml', '100.00', '0.00', '0.00', '7.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:16', '2022-04-19 07:36:16'),
(15, 7, 19, '4576.00', '8.00', 176, 1, 1, 1, 19, 14, 'Agnus Cast-Q', 1, 'ml', '250.00', '0.00', '0.00', '8.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:17', '2022-05-18 05:58:45'),
(16, 7, 20, '1400.00', '9.00', 177, 1, 1, 1, 19, 15, 'Agnus Cast-Q', 2, 'ml', '450.00', '0.00', '0.00', '9.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:17', '2022-04-19 07:36:17'),
(17, 8, 21, '845.00', '8.00', 555, 1, 1, 1, 27, 13, 'Agnus Cast-Q', 1, 'ml', '100.00', '0.00', '0.00', '8.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:50', '2022-05-08 13:00:16'),
(18, 8, 22, '553.00', '7.00', 556, 1, 1, 1, 27, 14, 'Agnus Cast-Q', 2, 'ml', '250.00', '0.00', '0.00', '7.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:51', '2022-05-18 05:58:45'),
(19, 8, 23, '785.00', '12.00', 557, 1, 1, 1, 27, 15, 'Agnus Cast-Q', 1, 'ml', '450.00', '0.00', '0.00', '12.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:51', '2022-04-19 07:36:51'),
(20, 8, 24, '120.00', '2.00', 547, 1, 1, 1, 27, 5, 'Alfalfa-Q SP.', 2, 'ml', '100.00', '0.00', '0.00', '2.00', 'pack', 1, 1, NULL, '2022-04-19 07:36:51', '2022-04-19 07:36:51'),
(21, 9, 25, '739.00', '533.00', 67, 1, 1, 1, 4, 13, 'Agnus Cast-Q', 3, 'ml', '100.00', '7.00', '37.31', '570.31', 'pack', 1, 1, NULL, '2022-04-19 08:01:51', '2022-05-08 13:02:56'),
(22, 9, 26, '563.00', '743.00', 68, 1, 1, 1, 4, 14, 'Agnus Cast-Q', 2, 'ml', '250.00', '16.00', '118.88', '861.88', 'pack', 1, 1, NULL, '2022-04-19 08:01:51', '2022-05-11 10:47:49'),
(23, 9, 27, '323.00', '416.00', 69, 1, 1, 1, 4, 15, 'Agnus Cast-Q', 3, 'ml', '450.00', '59.00', '245.44', '661.44', 'pack', 1, 1, NULL, '2022-04-19 08:01:51', '2022-04-19 08:01:51'),
(24, 9, 28, '469.00', '792.00', 59, 1, 1, 1, 4, 5, 'Alfalfa-Q SP.', 1, 'ml', '100.00', '51.00', '403.92', '1195.92', 'pack', 1, 1, NULL, '2022-04-19 08:01:51', '2022-04-19 08:01:51'),
(25, NULL, NULL, '1800.00', '20.00', 217, 1, NULL, NULL, NULL, NULL, NULL, 3, 'kg', '0.00', '0.00', '0.00', '20.00', 'raw', 0, NULL, NULL, '2022-04-20 07:20:22', '2022-04-20 07:20:22'),
(26, NULL, NULL, '1530.00', '20.00', 217, 1, NULL, NULL, NULL, NULL, NULL, 3, 'kg', '0.00', '0.00', '0.00', '20.00', 'raw', 0, NULL, NULL, '2022-04-20 08:22:27', '2022-04-20 08:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `raw_stock_modify_histories`
--

CREATE TABLE `raw_stock_modify_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `previous_stock` decimal(20,2) NOT NULL DEFAULT '0.00',
  `addition` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wastage` decimal(20,2) NOT NULL DEFAULT '0.00',
  `new_stock` decimal(20,2) NOT NULL DEFAULT '0.00',
  `remark` text COLLATE utf8mb4_unicode_ci,
  `addeBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_quantity` decimal(14,2) NOT NULL DEFAULT '0.00',
  `collected_qty` bigint(20) NOT NULL DEFAULT '0',
  `total_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `collect_wise_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `date` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pack,row,stationary',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `pending_at` timestamp NULL DEFAULT NULL,
  `pending_purchase_at` datetime DEFAULT NULL,
  `approved_purchase_at` timestamp NULL DEFAULT NULL,
  `purchase_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `collected_at` timestamp NULL DEFAULT NULL,
  `stocked_at` timestamp NULL DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `user_id`, `total_quantity`, `collected_qty`, `total_price`, `collect_wise_price`, `date`, `type`, `status`, `pending_at`, `pending_purchase_at`, `approved_purchase_at`, `purchase_at`, `approved_at`, `collected_at`, `stocked_at`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, '767.00', 767, '7670.00', '7670.00', '1986-06-06 18:00:00', 'raw', 'stocked', '2022-04-19 07:27:45', '2022-04-19 13:28:19', '2022-04-19 07:28:25', '2022-04-19 07:28:28', '2022-04-19 07:28:04', '2022-04-19 07:28:30', '2022-04-19 07:28:34', 1, 1, '2022-04-19 07:24:05', '2022-04-19 07:28:34'),
(2, 1, '4400.00', 4400, '44200.00', '44200.00', '2022-04-19 07:29:07', 'raw', 'stocked', '2022-04-19 07:29:07', '2022-04-19 13:30:50', '2022-04-19 07:30:53', '2022-04-19 07:30:56', '2022-04-19 07:30:32', '2022-04-19 07:30:59', '2022-04-19 07:31:03', 1, 1, '2022-04-19 07:27:46', '2022-04-19 07:31:03'),
(3, 1, '3444.00', 3444, '20564.00', '20564.00', '2022-04-19 07:29:40', 'raw', 'stocked', '2022-04-19 07:29:40', '2022-04-19 13:30:04', '2022-04-19 07:30:08', '2022-04-19 07:30:11', '2022-04-19 07:29:51', '2022-04-19 07:30:17', '2022-04-19 07:30:23', 1, 1, '2022-04-19 07:29:07', '2022-04-19 07:30:23'),
(4, 1, '0.00', 0, '0.00', '0.00', NULL, 'raw', 'temp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-04-19 07:29:41', '2022-04-19 07:29:41'),
(5, 1, '300.00', 600, '1200.00', '2400.00', '2022-04-19 07:32:18', 'pack', 'stocked', '2022-04-19 07:32:18', '2022-04-19 13:35:02', '2022-04-19 07:35:05', '2022-04-19 07:35:07', '2022-04-19 07:34:49', '2022-04-19 07:35:10', '2022-04-19 07:35:14', 1, NULL, '2022-04-19 07:31:22', '2022-04-19 07:35:14'),
(6, 1, '2854.00', 5708, '14208.00', '28416.00', '2022-04-19 07:33:08', 'pack', 'stocked', '2022-04-19 07:33:08', '2022-04-19 13:35:34', '2022-04-19 07:35:37', '2022-04-19 07:35:40', '2022-04-19 07:35:20', '2022-04-19 07:35:42', '2022-04-19 07:35:46', 1, NULL, '2022-04-19 07:32:19', '2022-04-19 07:35:46'),
(7, 1, '7489.00', 14978, '59812.00', '119624.00', '2022-04-19 07:33:40', 'pack', 'stocked', '2022-04-19 07:33:40', '2022-04-19 13:36:05', '2022-04-19 07:36:08', '2022-04-19 07:36:10', '2022-04-19 07:35:52', '2022-04-19 07:36:13', '2022-04-19 07:36:17', 1, NULL, '2022-04-19 07:33:08', '2022-04-19 07:36:17'),
(8, 1, '2321.00', 4642, '20424.00', '40848.00', '2022-04-19 07:34:40', 'pack', 'stocked', '2022-04-19 07:34:40', '2022-04-19 13:36:40', '2022-04-19 07:36:43', '2022-04-19 07:36:45', '2022-04-19 07:36:25', '2022-04-19 07:36:48', '2022-04-19 07:36:51', 1, NULL, '2022-04-19 07:33:41', '2022-04-19 07:36:51'),
(9, 1, '2274.00', 4548, '1829078.28', '3658156.56', '2022-04-19 08:01:29', 'pack', 'stocked', '2022-04-19 08:01:29', '2022-04-19 14:01:40', '2022-04-19 08:01:43', '2022-04-19 08:01:46', '2022-04-19 08:01:36', '2022-04-19 08:01:48', '2022-04-19 08:01:51', 1, NULL, '2022-04-19 07:34:41', '2022-04-19 08:01:51'),
(10, 1, '14.00', 0, '140.00', '0.00', '2022-05-18 18:00:00', 'pack', 'pending_purchase', '2022-05-18 07:54:28', '2022-05-18 14:11:22', NULL, NULL, '2022-05-18 07:54:49', NULL, NULL, 1, NULL, '2022-04-19 08:01:29', '2022-05-18 08:11:23'),
(11, 1, '0.00', 0, '0.00', '0.00', NULL, 'pack', 'temp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-05-18 07:54:29', '2022-05-18 07:54:29'),
(12, 1, '0.00', 0, '0.00', '0.00', NULL, 'stationery', 'temp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-05-18 08:08:00', '2022-05-18 08:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_items`
--

CREATE TABLE `requisition_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `collected_qty` decimal(14,2) NOT NULL DEFAULT '0.00',
  `price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dhpl_cat_id` bigint(20) DEFAULT NULL,
  `raw_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pack_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` bigint(20) DEFAULT '0',
  `vat` bigint(20) NOT NULL DEFAULT '0',
  `vat_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `final_price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `raw_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_items`
--

INSERT INTO `requisition_items` (`id`, `user_id`, `requisition_id`, `quantity`, `collected_qty`, `price`, `raw_id`, `category_id`, `dhpl_cat_id`, `raw_cat_id`, `pack_cat_id`, `product_id`, `product_name`, `unit`, `unit_value`, `vat`, `vat_price`, `final_price`, `raw_type`, `supplier_id`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 767, '767.00', '10.00', 313, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '10.00', 'raw', 1, 1, 1, '2022-04-19 07:27:45', '2022-04-19 07:28:30'),
(6, 1, 2, 1500, '1500.00', '9.00', 217, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '9.00', 'raw', 1, 1, 1, '2022-04-19 07:29:07', '2022-04-19 07:30:59'),
(7, 1, 2, 1200, '1200.00', '10.00', 218, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '10.00', 'raw', 2, 1, 1, '2022-04-19 07:29:07', '2022-04-19 07:30:59'),
(8, 1, 2, 1700, '1700.00', '11.00', 219, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '11.00', 'raw', 3, 1, 1, '2022-04-19 07:29:07', '2022-04-19 07:30:59'),
(9, 1, 3, 1400, '1400.00', '5.00', 220, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '5.00', 'raw', 1, 1, 1, '2022-04-19 07:29:40', '2022-04-19 07:30:17'),
(10, 1, 3, 744, '744.00', '6.00', 221, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '6.00', 'raw', 2, 1, 1, '2022-04-19 07:29:40', '2022-04-19 07:30:17'),
(11, 1, 3, 1300, '1300.00', '7.00', 222, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', '7.00', 'raw', 2, 1, 1, '2022-04-19 07:29:40', '2022-04-19 07:30:17'),
(12, 1, 5, 100, '100.00', '5.00', 13, 1, 1, 1, 3, 13, 'Agnus Cast-Q', 'ml', 100, 0, '0.00', '5.00', 'pack', 1, 1, 1, '2022-04-19 07:32:18', '2022-04-19 07:35:10'),
(13, 1, 5, 100, '100.00', '4.00', 14, 1, 1, 1, 3, 14, 'Agnus Cast-Q', 'ml', 250, 0, '0.00', '4.00', 'pack', 2, 1, 1, '2022-04-19 07:32:18', '2022-04-19 07:35:10'),
(14, 1, 5, 100, '100.00', '3.00', 15, 1, 1, 1, 3, 15, 'Agnus Cast-Q', 'ml', 450, 0, '0.00', '3.00', 'pack', 3, 1, 1, '2022-04-19 07:32:18', '2022-04-19 07:35:10'),
(15, 1, 6, 500, '500.00', '7.00', 121, 1, 1, 1, 18, 13, 'Agnus Cast-Q', 'ml', 100, 0, '0.00', '7.00', 'pack', 1, 1, 1, '2022-04-19 07:33:07', '2022-04-19 07:35:42'),
(16, 1, 6, 1500, '1500.00', '6.00', 122, 1, 1, 1, 18, 14, 'Agnus Cast-Q', 'ml', 250, 0, '0.00', '6.00', 'pack', 1, 1, 1, '2022-04-19 07:33:07', '2022-04-19 07:35:42'),
(17, 1, 6, 854, '854.00', '2.00', 123, 1, 1, 1, 18, 15, 'Agnus Cast-Q', 'ml', 450, 0, '0.00', '2.00', 'pack', 2, 1, 1, '2022-04-19 07:33:07', '2022-04-19 07:35:42'),
(18, 1, 7, 1500, '1500.00', '7.00', 175, 1, 1, 1, 19, 13, 'Agnus Cast-Q', 'ml', 100, 0, '0.00', '7.00', 'pack', 1, 1, 1, '2022-04-19 07:33:40', '2022-04-19 07:36:13'),
(19, 1, 7, 4589, '4589.00', '8.00', 176, 1, 1, 1, 19, 14, 'Agnus Cast-Q', 'ml', 250, 0, '0.00', '8.00', 'pack', 1, 1, 1, '2022-04-19 07:33:40', '2022-04-19 07:36:13'),
(20, 1, 7, 1400, '1400.00', '9.00', 177, 1, 1, 1, 19, 15, 'Agnus Cast-Q', 'ml', 450, 0, '0.00', '9.00', 'pack', 2, 1, 1, '2022-04-19 07:33:40', '2022-04-19 07:36:13'),
(21, 1, 8, 852, '852.00', '8.00', 555, 1, 1, 1, 27, 13, 'Agnus Cast-Q', 'ml', 100, 0, '0.00', '8.00', 'pack', 1, 1, 1, '2022-04-19 07:34:40', '2022-04-19 07:36:48'),
(22, 1, 8, 564, '564.00', '7.00', 556, 1, 1, 1, 27, 14, 'Agnus Cast-Q', 'ml', 250, 0, '0.00', '7.00', 'pack', 2, 1, 1, '2022-04-19 07:34:40', '2022-04-19 07:36:48'),
(23, 1, 8, 785, '785.00', '12.00', 557, 1, 1, 1, 27, 15, 'Agnus Cast-Q', 'ml', 450, 0, '0.00', '12.00', 'pack', 1, 1, 1, '2022-04-19 07:34:40', '2022-04-19 07:36:48'),
(24, 1, 8, 120, '120.00', '2.00', 547, 1, 1, 1, 27, 5, 'Alfalfa-Q SP.', 'ml', 100, 0, '0.00', '2.00', 'pack', 2, 1, 1, '2022-04-19 07:34:40', '2022-04-19 07:36:47'),
(25, 1, 9, 764, '764.00', '533.00', 67, 1, 1, 1, 4, 13, 'Agnus Cast-Q', 'ml', 100, 7, '37.31', '570.31', 'pack', 3, 1, 1, '2022-04-19 08:01:28', '2022-04-19 08:01:48'),
(26, 1, 9, 718, '718.00', '743.00', 68, 1, 1, 1, 4, 14, 'Agnus Cast-Q', 'ml', 250, 16, '118.88', '861.88', 'pack', 2, 1, 1, '2022-04-19 08:01:29', '2022-04-19 08:01:48'),
(27, 1, 9, 323, '323.00', '416.00', 69, 1, 1, 1, 4, 15, 'Agnus Cast-Q', 'ml', 450, 59, '245.44', '661.44', 'pack', 3, 1, 1, '2022-04-19 08:01:29', '2022-04-19 08:01:48'),
(28, 1, 9, 469, '469.00', '792.00', 59, 1, 1, 1, 4, 5, 'Alfalfa-Q SP.', 'ml', 100, 51, '403.92', '1195.92', 'pack', 1, 1, 1, '2022-04-19 08:01:29', '2022-04-19 08:01:48'),
(29, 1, 10, 5, '0.00', '10.00', 543, 1, 1, 1, 27, 1, 'Aconite', 'ml', 60, 0, '0.00', '10.00', 'pack', 1, 1, NULL, '2022-05-18 07:54:28', '2022-05-18 08:11:22'),
(30, 1, 10, 5, '0.00', '10.00', 556, 1, 1, 1, 27, 14, 'Agnus Cast-Q', 'ml', 250, 0, '0.00', '10.00', 'pack', 2, 1, NULL, '2022-05-18 07:54:28', '2022-05-18 08:11:23'),
(31, 1, 10, 4, '0.00', '10.00', 547, 1, 1, 1, 27, 5, 'Alfalfa-Q SP.', 'ml', 100, 0, '0.00', '10.00', 'pack', 1, 1, NULL, '2022-05-18 07:54:28', '2022-05-18 08:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_payments`
--

CREATE TABLE `role_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roleto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `roleto_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roleby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `roleby_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `previous_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `transfer_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `current_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dhpl_product_id` bigint(20) DEFAULT NULL,
  `dhpl_cat_id` bigint(20) DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`id`, `name`, `dhpl_product_id`, `dhpl_cat_id`, `unit_value`, `unit`, `details`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 'Agnus Cast-Q', 14, 1, '300.00', 'ml', NULL, 1, 1, NULL, '2022-04-19 07:38:18', '2022-04-19 07:38:18'),
(2, 'Agnus Cast-Q', 13, 1, '1200.00', 'ml', 'aDFAS', 1, 1, 1, '2022-04-20 06:55:43', '2022-04-20 06:56:00'),
(3, 'Alfalfa-Q', 2, 1, '100.00', 'ltr', NULL, 1, 1, NULL, '2022-04-20 09:38:07', '2022-04-20 09:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `sample_items`
--

CREATE TABLE `sample_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sample_id` bigint(20) UNSIGNED DEFAULT NULL,
  `raw_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sample_items`
--

INSERT INTO `sample_items` (`id`, `sample_id`, `raw_id`, `category_id`, `unit`, `unit_value`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 217, 1, 'gm', '500.00', 1, NULL, '2022-04-19 07:38:18', '2022-04-19 07:38:18'),
(2, 1, 218, 1, 'gm', '500.00', 1, NULL, '2022-04-19 07:38:18', '2022-04-19 07:38:18'),
(3, 1, 219, 1, 'gm', '500.00', 1, NULL, '2022-04-19 07:38:18', '2022-04-19 07:38:18'),
(10, 2, 217, 1, 'kg', '500.00', 1, NULL, '2022-04-20 07:11:07', '2022-04-20 07:11:07'),
(11, 2, 218, 1, 'gm', '1500.00', 1, NULL, '2022-04-20 07:11:08', '2022-04-20 07:11:08'),
(12, 3, 227, 1, 'gm', '40.00', 1, NULL, '2022-04-20 09:38:07', '2022-04-20 09:38:07'),
(13, 3, 232, 1, 'gm', '10.00', 1, NULL, '2022-04-20 09:38:07', '2022-04-20 09:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `stationeries`
--

CREATE TABLE `stationeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` decimal(14,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_phrases_amount` decimal(14,2) NOT NULL DEFAULT '0.00',
  `total_paid_amount` decimal(14,2) NOT NULL DEFAULT '0.00',
  `due_amount` decimal(14,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `mobile`, `total_phrases_amount`, `total_paid_amount`, `due_amount`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 'First Supplier', 'supp@gmail.com', '0174452852', '6138873.75', '20.00', '0.00', 1, 1, NULL, '2022-02-28 12:06:43', '2022-04-19 08:01:51'),
(2, 'Abdul Mannaf', 'idbmannaf@gmail.com', '01744508288', '6324612.82', '20.00', '0.00', 1, 1, 1, '2022-03-08 10:38:15', '2022-04-19 08:01:51'),
(3, 'No Supplier', 'factory.dhplbd@gmail.com', '11111111111', '3242981.94', '100.00', '0.00', 1, 1, NULL, '2022-03-14 12:12:49', '2022-05-18 04:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_by` bigint(20) UNSIGNED DEFAULT NULL,
  `previous_balance` decimal(14,2) NOT NULL DEFAULT '0.00',
  `moved_balance` decimal(14,2) NOT NULL DEFAULT '0.00',
  `new_balance` decimal(14,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `addedBy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedBy_id` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`id`, `supplier_id`, `payment_by`, `previous_balance`, `moved_balance`, `new_balance`, `payment_method`, `account`, `note`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '3242981.94', '100.00', '3242881.94', 'cash', '01744508287', 's', 1, NULL, '2022-05-18 04:19:14', '2022-05-18 04:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `temp_packaging_mandotory_items`
--

CREATE TABLE `temp_packaging_mandotory_items` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` decimal(12,2) NOT NULL DEFAULT '0.00',
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'temp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_packaging_mandotory_items`
--

INSERT INTO `temp_packaging_mandotory_items` (`id`, `user_id`, `product_id`, `qty`, `stock_id`, `status`, `created_at`, `updated_at`) VALUES
(157, 1, 5, '0.00', 11, 'temp', '2022-05-08 13:03:35', '2022-05-08 13:03:35'),
(158, 1, 5, '0.00', 14, 'temp', '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(159, 1, 5, '0.00', 17, 'temp', '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(184, 1, 4, '0.00', 12, 'temp', '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(185, 1, 4, '0.00', 15, 'temp', '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(186, 1, 4, '0.00', 18, 'temp', '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(205, 1, 6, '0.00', 12, 'temp', '2022-05-09 09:13:47', '2022-05-09 09:13:47'),
(206, 1, 6, '0.00', 15, 'temp', '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(207, 1, 6, '0.00', 18, 'temp', '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(223, 1, 7, '0.00', 12, 'temp', '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(224, 1, 7, '0.00', 15, 'temp', '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(225, 1, 7, '0.00', 18, 'temp', '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(280, 1, 8, '2.00', 12, 'temp', '2022-05-18 05:22:18', '2022-05-18 05:26:36'),
(281, 1, 8, '0.00', 15, 'temp', '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(282, 1, 8, '0.00', 18, 'temp', '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(289, 1, 9, '2.00', 12, 'temp', '2022-05-18 05:28:31', '2022-05-18 05:28:42'),
(290, 1, 9, '2.00', 15, 'temp', '2022-05-18 05:28:31', '2022-05-18 05:28:57'),
(298, 1, 10, '2.00', 12, 'temp', '2022-05-18 05:30:52', '2022-05-18 05:31:01'),
(299, 1, 10, '2.00', 15, 'temp', '2022-05-18 05:30:52', '2022-05-18 05:31:03'),
(300, 1, 10, '2.00', 18, 'temp', '2022-05-18 05:30:52', '2022-05-18 05:31:04'),
(322, 1, 2, '0.00', 12, 'temp', '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(323, 1, 2, '0.00', 15, 'temp', '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(324, 1, 2, '0.00', 18, 'temp', '2022-05-18 07:01:48', '2022-05-18 07:01:48'),
(337, 1, 1, '0.00', 12, 'temp', '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(338, 1, 1, '0.00', 15, 'temp', '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(339, 1, 1, '0.00', 18, 'temp', '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(340, 1, 3, '0.00', 11, 'temp', '2022-05-18 07:53:49', '2022-05-18 07:53:49'),
(341, 1, 3, '0.00', 14, 'temp', '2022-05-18 07:53:50', '2022-05-18 07:53:50'),
(342, 1, 3, '0.00', 17, 'temp', '2022-05-18 07:53:50', '2022-05-18 07:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `temp_packaging_mandotory_item_lists`
--

CREATE TABLE `temp_packaging_mandotory_item_lists` (
  `id` bigint(20) NOT NULL,
  `temp_packaging_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `qty` decimal(14,2) NOT NULL DEFAULT '0.00',
  `mandetory_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_packaging_mandotory_item_lists`
--

INSERT INTO `temp_packaging_mandotory_item_lists` (`id`, `temp_packaging_id`, `stock_id`, `checked`, `qty`, `mandetory_type`, `created_at`, `updated_at`) VALUES
(313, 157, 8, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(314, 157, 21, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(315, 158, 8, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(316, 158, 21, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(317, 159, 8, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(318, 159, 21, 0, '0.00', NULL, '2022-05-08 13:03:36', '2022-05-08 13:03:36'),
(367, 184, 9, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(368, 184, 22, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(369, 185, 9, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(370, 185, 22, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(371, 186, 9, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(372, 186, 22, 0, '0.00', NULL, '2022-05-09 09:12:41', '2022-05-09 09:12:41'),
(409, 205, 9, 0, '0.00', NULL, '2022-05-09 09:13:47', '2022-05-09 09:13:47'),
(410, 205, 22, 0, '0.00', NULL, '2022-05-09 09:13:47', '2022-05-09 09:13:47'),
(411, 206, 9, 0, '0.00', NULL, '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(412, 206, 22, 0, '0.00', NULL, '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(413, 207, 9, 0, '0.00', NULL, '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(414, 207, 22, 0, '0.00', NULL, '2022-05-09 09:13:48', '2022-05-09 09:13:48'),
(445, 223, 9, 0, '0.00', NULL, '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(446, 223, 22, 0, '0.00', NULL, '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(447, 224, 9, 0, '0.00', NULL, '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(448, 224, 22, 0, '0.00', NULL, '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(449, 225, 9, 0, '0.00', NULL, '2022-05-11 06:30:23', '2022-05-11 06:30:23'),
(450, 225, 22, 0, '0.00', NULL, '2022-05-11 06:30:24', '2022-05-11 06:30:24'),
(559, 280, 9, 1, '2.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:26:36'),
(560, 280, 22, 0, '0.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(561, 281, 9, 0, '0.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(562, 281, 22, 0, '0.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(563, 282, 9, 0, '0.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(564, 282, 22, 0, '0.00', NULL, '2022-05-18 05:22:18', '2022-05-18 05:22:18'),
(577, 289, 9, 1, '2.00', NULL, '2022-05-18 05:28:31', '2022-05-18 05:28:44'),
(578, 289, 22, 0, '0.00', NULL, '2022-05-18 05:28:31', '2022-05-18 05:28:31'),
(579, 290, 9, 1, '2.00', NULL, '2022-05-18 05:28:31', '2022-05-18 05:28:58'),
(580, 290, 22, 0, '0.00', NULL, '2022-05-18 05:28:31', '2022-05-18 05:28:31'),
(595, 298, 9, 1, '2.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:31:15'),
(596, 298, 22, 0, '0.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:30:52'),
(597, 299, 9, 1, '2.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:31:13'),
(598, 299, 22, 0, '0.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:30:52'),
(599, 300, 9, 1, '2.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:31:06'),
(600, 300, 22, 0, '0.00', NULL, '2022-05-18 05:30:52', '2022-05-18 05:30:52'),
(643, 322, 9, 0, '0.00', NULL, '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(644, 322, 22, 0, '0.00', NULL, '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(645, 323, 9, 0, '0.00', NULL, '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(646, 323, 22, 0, '0.00', NULL, '2022-05-18 07:01:47', '2022-05-18 07:01:47'),
(647, 324, 9, 0, '0.00', NULL, '2022-05-18 07:01:48', '2022-05-18 07:01:48'),
(648, 324, 22, 0, '0.00', NULL, '2022-05-18 07:01:48', '2022-05-18 07:01:48'),
(673, 337, 9, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(674, 337, 22, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(675, 338, 9, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(676, 338, 22, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(677, 339, 9, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(678, 339, 22, 0, '0.00', NULL, '2022-05-18 07:53:45', '2022-05-18 07:53:45'),
(679, 340, 8, 0, '0.00', NULL, '2022-05-18 07:53:49', '2022-05-18 07:53:49'),
(680, 340, 21, 0, '0.00', NULL, '2022-05-18 07:53:49', '2022-05-18 07:53:49'),
(681, 341, 8, 0, '0.00', NULL, '2022-05-18 07:53:50', '2022-05-18 07:53:50'),
(682, 341, 21, 0, '0.00', NULL, '2022-05-18 07:53:50', '2022-05-18 07:53:50'),
(683, 342, 8, 0, '0.00', NULL, '2022-05-18 07:53:50', '2022-05-18 07:53:50'),
(684, 342, 21, 0, '0.00', NULL, '2022-05-18 07:53:50', '2022-05-18 07:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calling_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `loggedin_at` timestamp NULL DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_verify_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `mobile`, `mobile_country`, `calling_code`, `currency_code`, `nid`, `img_name`, `gender`, `dob`, `password`, `password_temp`, `remember_token`, `active`, `addedby_type`, `addedby_id`, `user_status`, `created_at`, `updated_at`, `loggedin_at`, `mobile_verified_at`, `mobile_verify_code`, `email_verified_at`, `deleted_at`) VALUES
(1, 'Masud Hasan 1', NULL, 'masudbdm@gmail.com', '8801926665800', NULL, NULL, NULL, '9555222224', 'https://dhplbd.com/storage/user/pp/1_fi_2021_06_19_064149_43325580.png', 'male', '2021-02-16', '$2y$10$5nJ7mz0dH59nUvkIStCtJ.a58u9LtUgr.3MCgEUINBK95aGpApj7u', '11112222', '0wsguhBsvBmEhiXyQ5YXZ57tl3tqljsNCD2r3dsbR743QMMMUzmyyS13btmc', 1, NULL, NULL, 1, '2021-02-17 05:35:41', '2021-12-25 08:47:07', NULL, NULL, NULL, NULL, NULL),
(84, 'Production', NULL, NULL, '01744555555', NULL, NULL, NULL, '1111', NULL, NULL, NULL, '$2y$10$TTwQrzQFbp/oIzZ9xDP3y.9cEijMoAjIHUBpfgW1rSm0jc19e.3OS', '719301', 'R6awJhNijdQ6oilDDBC341DhZirbUFmE81XYAOJNFW65HsPWKIDFUXsAsy4n', 1, 'App\\Models\\User', 1, 1, '2022-01-29 09:17:06', '2022-01-29 09:17:06', NULL, NULL, NULL, NULL, NULL),
(85, 'Accountant', NULL, NULL, '01744666666', NULL, NULL, NULL, '666', NULL, NULL, NULL, '$2y$10$KKyrTcNa0.4DeJB88ajGgOZnpOKA81/lFVfua7ZLiazBl3mODr5sa', '480060', 'Sy6kOBpiOWeuyFAJEQCkwpf33CvvDP5Krcc8NMRfdIaFi8A1ZpKV8lqpY8Y4', 1, 'App\\Models\\User', 1, 1, '2022-01-29 09:39:01', '2022-01-29 09:39:01', NULL, NULL, NULL, NULL, NULL),
(86, 'Production Manager', NULL, NULL, '01722333333', NULL, NULL, NULL, '456464', NULL, NULL, NULL, '$2y$10$yoz8EyMT0EnMgFu6IhgIJOBREx9jOm0irJBNe3mnyIjZDUGqCPZKS', '707808', 'Gp2MoOFwT7akzmTXVjYVFiwmOheKRepcgPcook2OkuCN3REJIbf5kkbzjfgO', 1, 'App\\Models\\User', 1, 1, '2022-01-29 09:48:56', '2022-01-29 09:48:56', NULL, NULL, NULL, NULL, NULL),
(87, 'Accountant', NULL, NULL, '01788888888', NULL, NULL, NULL, '01788888888', NULL, NULL, NULL, '$2y$10$Oprj0fCpGfNm6kHq4ye0jOvcV3vs9Cw1o1k6w6IlK9aNePqrRAtgG', '451175', 'uP1CyQGl8l99Sn3oQ3LrlLG0cKEqQqh2W9CXBCUJpRitUKEvDJ4j2phHqVaw', 1, 'App\\Models\\User', 1, 1, '2022-01-29 10:06:36', '2022-01-29 10:06:36', NULL, NULL, NULL, NULL, NULL),
(88, 'Sheila Rasmussen', NULL, NULL, '01733669988', NULL, NULL, NULL, '01733669988', NULL, NULL, NULL, '$2y$10$JhDqHiKtzuDboLY3S9PZW.yxDbs8vjFcYy7UQGZPZ1d8Ll.mUwD.e', '540633', NULL, 1, 'App\\Models\\User', 1, 1, '2022-03-13 09:18:43', '2022-03-13 09:18:43', NULL, NULL, NULL, NULL, NULL),
(89, '01733669989', NULL, NULL, '01733669989', NULL, NULL, NULL, '01733669989', NULL, NULL, NULL, '$2y$10$Ni9YLaqi4w8uwrhuQ6ui2.seTcquoVj8xTmLGH96nlxniSl7FWaV.', '432860', '2EmChAFBdQkcnKqy9MRNKMVwiv0QEbcQTTZqybajdxfun23iBE0xVfUXx7lk', 1, 'App\\Models\\User', 1, 1, '2022-03-13 09:19:40', '2022-03-13 09:19:40', NULL, NULL, NULL, NULL, NULL),
(90, 'Md. Monjur Morshed', NULL, NULL, '01974116242', NULL, NULL, NULL, '5085272314', NULL, NULL, NULL, '$2y$10$r2kb/51sN0vg11eevhLXmeTHK7lJA.N9HOsStZNKRs0.qfVN.wlui', '505331', 'bgiXJl9YNXWAeRp5LzPIiiGRbHYzHMdr8BM2136BIWlQn0xcuWgZozl4cxZR', 1, 'App\\Models\\User', 1, 1, '2022-03-15 14:09:25', '2022-03-15 14:09:25', NULL, NULL, NULL, NULL, NULL),
(91, 'Abir', NULL, NULL, '6644899', NULL, NULL, NULL, '578899', NULL, NULL, NULL, '$2y$10$ec2iKj1oEAylH1bxaeDE6O.RMVGSu2WEx6OKE1YkOBIMAN0tEraDC', '514705', NULL, 1, 'App\\Models\\User', 1, 1, '2022-04-26 19:54:12', '2022-04-26 19:54:12', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website_balances`
--

CREATE TABLE `website_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `system_balance_comm` decimal(10,2) NOT NULL DEFAULT '0.00',
  `depo_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `distributor_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `dealer_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `agent_balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_balances`
--

INSERT INTO `website_balances` (`id`, `system_balance`, `system_balance_comm`, `depo_balance`, `distributor_balance`, `dealer_balance`, `agent_balance`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, '20740.40', '0.00', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '2022-01-09 12:13:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `after_proccess_products`
--
ALTER TABLE `after_proccess_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `after_proccess_product_materials`
--
ALTER TABLE `after_proccess_product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_productions`
--
ALTER TABLE `daily_productions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_roles`
--
ALTER TABLE `my_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_role_items`
--
ALTER TABLE `my_role_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pack_req_temps`
--
ALTER TABLE `pack_req_temps`
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
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raws`
--
ALTER TABLE `raws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_stocks`
--
ALTER TABLE `raw_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_stock_modify_histories`
--
ALTER TABLE `raw_stock_modify_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_items`
--
ALTER TABLE `requisition_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_payments`
--
ALTER TABLE `role_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_items`
--
ALTER TABLE `sample_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stationeries`
--
ALTER TABLE `stationeries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_packaging_mandotory_items`
--
ALTER TABLE `temp_packaging_mandotory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_packaging_mandotory_item_lists`
--
ALTER TABLE `temp_packaging_mandotory_item_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_name_index` (`name`),
  ADD KEY `users_username_index` (`username`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_mobile_index` (`mobile`);

--
-- Indexes for table `website_balances`
--
ALTER TABLE `website_balances`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `after_proccess_products`
--
ALTER TABLE `after_proccess_products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `after_proccess_product_materials`
--
ALTER TABLE `after_proccess_product_materials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `daily_productions`
--
ALTER TABLE `daily_productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `my_roles`
--
ALTER TABLE `my_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `my_role_items`
--
ALTER TABLE `my_role_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pack_req_temps`
--
ALTER TABLE `pack_req_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `raws`
--
ALTER TABLE `raws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=651;

--
-- AUTO_INCREMENT for table `raw_stocks`
--
ALTER TABLE `raw_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `raw_stock_modify_histories`
--
ALTER TABLE `raw_stock_modify_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requisition_items`
--
ALTER TABLE `requisition_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `role_payments`
--
ALTER TABLE `role_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sample_items`
--
ALTER TABLE `sample_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stationeries`
--
ALTER TABLE `stationeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_packaging_mandotory_items`
--
ALTER TABLE `temp_packaging_mandotory_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `temp_packaging_mandotory_item_lists`
--
ALTER TABLE `temp_packaging_mandotory_item_lists`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=685;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `website_balances`
--
ALTER TABLE `website_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
