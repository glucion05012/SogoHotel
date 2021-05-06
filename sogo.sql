-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 10:13 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `directory`, `alt`, `created_at`, `updated_at`) VALUES
(1, 'default.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 19:40:30'),
(2, '1543463111_branchesjpg.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 19:45:11'),
(3, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(4, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(5, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(6, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(7, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(8, 'about-us.jpg', 'banner', NULL, '2018-11-28 16:00:00', '2018-11-28 16:00:00'),
(12, '1543477673_bg1jpg.jpg', 'slider', NULL, '2018-11-28 23:47:53', '2018-11-28 23:47:53'),
(13, '1543477726_bg2jpg.jpg', 'slider', NULL, '2018-11-28 23:48:46', '2018-11-28 23:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_28_020755_create_images_table', 1),
(4, '2018_11_28_021230_create_sliders_table', 1),
(5, '2018_11_28_022007_create_statuses_table', 2),
(6, '2018_11_28_050957_create_pages_table', 3),
(7, '2018_11_28_051345_create_seos_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `seo_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `seo_id`, `image_id`, `status_id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 'Home', '', '2018-11-27 16:00:00', '2018-11-28 18:21:39'),
(2, 2, 1, 1, 'About Us', 'about-us', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(3, 3, 2, 1, 'Branches', 'branches', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(4, 4, 3, 1, 'Food & Beverages', 'food-beverages', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(5, 5, 4, 1, 'Promos', 'promos', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(6, 6, 5, 1, 'Careers', 'careers', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(7, 7, 6, 1, 'Photos', 'photos', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(8, 8, 7, 1, 'Inquiry & Comments', 'inquiry-comments', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(9, 9, 8, 1, 'Events', 'events', '2018-11-28 16:00:00', '2018-11-28 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `title`, `description`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'Home | Sogo', 'Meta Description', 'Meta Keywords', '2018-11-27 16:00:00', '2018-11-28 18:15:05'),
(2, 'About Us | Sogo', 'Meta Description', 'Meta Keywords', '2018-11-27 16:00:00', '2018-11-28 19:37:27'),
(3, 'Branches | Sogo', 'Meta Description', 'Meta Keywords', '2018-11-27 16:00:00', '2018-11-28 19:41:08'),
(4, 'Food & Beverages | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(5, 'Promos | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(6, 'Careers | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(7, 'Photos | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(8, 'Inquiry & Comments | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(9, 'Events | Sogo', '', '', '2018-11-27 16:00:00', '2018-11-27 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 12, 1, '2018-11-28 23:47:53', '2018-11-28 23:47:53'),
(2, 13, 2, '2018-11-28 23:48:46', '2018-11-29 00:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'active', '2018-11-27 16:00:00', '2018-11-27 16:00:00'),
(2, 'inactive', '2018-11-27 16:00:00', '2018-11-27 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sogo Admin', 'admin@admin.com', NULL, '$2y$10$aTipEJbZd7erKbymGRLhSebd1DCTNJq6opvMQleabLLt1w7nhJC6.', 'umeZuFlSZkYL6FaVXvjxbx8aMCRhXvV3cLWjDSeT4Dggsv5QPdDVMcgP1jEz', '2018-11-27 16:00:00', '2018-11-27 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
