-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jul 15, 2019 at 02:29 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcleaf`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'SantÃ©', '2019-07-15 01:23:53', '2019-07-15 01:23:53'),
(10, 'Evenements', '2019-07-15 01:24:07', '2019-07-15 01:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id`, `status`, `content`, `created_at`, `updated_at`, `user_id`, `post_id`) VALUES
(21, 'APPROVED', 'Bon article !', '2019-07-15 01:35:00', '2019-07-15 01:35:00', 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Media`
--

CREATE TABLE `Media` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE `Menu` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Page`
--

CREATE TABLE `Page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `content` text,
  `type` enum('STATIC','BLOG') NOT NULL,
  `status` enum('DRAFT','PUBLISHED','WITHDRAWN') NOT NULL,
  `default_page` tinyint(1) NOT NULL DEFAULT '0',
  `menu_position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`id`, `title`, `meta_description`, `content`, `type`, `status`, `default_page`, `menu_position`, `created_at`, `updated_at`) VALUES
(2, 'A propos !', 'page a propos', '<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2><p>Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><h2>Lorem ipsum dolor sit amet</h2><p>consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. <strong>Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque</strong>.</p><p>Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>&nbsp;</p>', 'STATIC', 'PUBLISHED', 0, 5, '2019-04-03 19:18:43', '2019-05-26 20:08:19'),
(3, 'Blog', 'page blog', NULL, 'BLOG', 'PUBLISHED', 1, 1, '2019-04-03 19:20:52', '2019-07-15 02:05:52'),
(4, 'Me contacter', 'page contact', '<p><strong>52 boulevard des Batignolles</strong></p><p><strong>75017 Paris</strong></p><p><strong>mon-adresse-mail@gmail.com</strong></p><p><strong>01.01.01.01.01</strong></p><p>&nbsp;</p><p>Facebook: <a href=\"https://www.facebook.com/\">https://www.facebook.com/</a></p><p>Twitter: <a href=\"https://twitter.com/\">https://twitter.com/</a></p><p>Instagram: <i>Mon_insta</i></p><p>&nbsp;</p>', 'STATIC', 'PUBLISHED', 0, 4, '2019-04-03 19:20:52', '2019-07-14 13:58:55'),
(12, 'Tarifs', 'mes tarifs', '<p>Grille de tarifs:&nbsp;</p><ul><li>- 1 seance : XX euros</li><li>- Seance de groupe : XX euros</li><li>- 10 seance : XX euros</li><li>- Coaching : XX euros</li><li>&nbsp;</li></ul>', 'STATIC', 'PUBLISHED', 0, 3, '2019-05-26 20:04:55', '2019-07-14 13:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `status` enum('DRAFT','PUBLISHED','WITHDRAWN') NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `title`, `description`, `content`, `status`, `category_id`, `page_id`, `created_at`, `updated_at`) VALUES
(8, 'Mon premier article', 'ceci est un premier article de blog', '<h2>Lorem ipsum dolor&nbsp;</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <i>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</i></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></blockquote><p>&nbsp;</p>', 'PUBLISHED', 9, 3, '2019-07-15 01:33:23', '2019-07-15 01:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `Post_media`
--

CREATE TABLE `Post_media` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Post_page`
--

CREATE TABLE `Post_page` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Testimonial`
--

CREATE TABLE `Testimonial` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Testimonial`
--

INSERT INTO `Testimonial` (`id`, `content`, `status`, `user_name`, `created_at`, `updated_at`) VALUES
(14, 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'APPROVED', 'Utilisateur de passage', '2019-07-15 01:44:18', '2019-07-15 01:44:18'),
(15, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'APPROVED', 'Alix de Haut', '2019-07-15 01:46:07', '2019-07-15 01:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `profile` enum('ADMIN','CLIENT','EDITOR') NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `profile`, `active`, `firstname`, `lastname`, `email`, `password`, `token`, `created_at`, `updated_at`) VALUES
(14, 'CLIENT', '1', 'Utilisateur 1', 'NOM 1', 'hamom@mail-click.net', '$2y$10$QNWHQWmG6DMmRjqOxTfKq.qFNt6s5urO80bAOxOs6koZSul81kn.6', 'f90e6cccb7d4c23ab458ce291370d2a1', '2019-07-14 23:10:16', '2019-07-15 02:28:43'),
(15, 'EDITOR', '1', 'Utilisateur 2', 'NOM 2', 'cufuxisomi@simplemail.in', '$2y$10$d1IIfZzuYxk5zteAn54XQ.61LoL3jh0hkgA5Z76wrrwN2iUl7/ZFm', NULL, '2019-07-14 23:37:18', '2019-07-14 23:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `User_post`
--

CREATE TABLE `User_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Media`
--
ALTER TABLE `Media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Menu`
--
ALTER TABLE `Menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Page`
--
ALTER TABLE `Page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Post_media`
--
ALTER TABLE `Post_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Post_page`
--
ALTER TABLE `Post_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Testimonial`
--
ALTER TABLE `Testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User_post`
--
ALTER TABLE `User_post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Media`
--
ALTER TABLE `Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Testimonial`
--
ALTER TABLE `Testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
