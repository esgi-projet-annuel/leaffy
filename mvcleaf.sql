-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: May 25, 2019 at 05:49 PM
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
(1, 'PENDING', 'test maggle', '2019-05-19 13:03:44', '2019-05-19 13:06:13', 1, 2);

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

--
-- Dumping data for table `Media`
--

INSERT INTO `Media` (`id`, `type`, `path`, `created_at`, `updated_at`) VALUES
(1, 'video/mp4', '/var/www/html/medias/5ce161e372478.mp4', '2019-05-19 14:02:12', NULL);

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
  `menu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`id`, `title`, `meta_description`, `content`, `type`, `status`, `menu_id`, `created_at`, `updated_at`) VALUES
(2, 'about', 'page about', NULL, 'STATIC', 'PUBLISHED', 0, '2019-04-03 19:18:43', '2019-05-07 09:00:44'),
(3, 'blog', 'page blog', NULL, 'BLOG', 'PUBLISHED', 0, '2019-04-03 19:20:52', '2019-05-21 19:46:57'),
(4, 'contact', 'page contact', NULL, 'STATIC', 'PUBLISHED', 0, '2019-04-03 19:20:52', '2019-05-07 09:00:44'),
(5, 'validation', 'page validation email', NULL, 'STATIC', 'PUBLISHED', NULL, '2019-04-13 16:27:52', '2019-05-07 09:00:44'),
(8, 'titre page 3', 'meta description page 3', NULL, 'STATIC', 'DRAFT', 1, '2019-05-19 11:48:04', '2019-05-19 11:48:04');

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
  `page_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `title`, `description`, `content`, `status`, `page_id`, `created_at`, `updated_at`) VALUES
(1000, 'titre', 'dfiehozioezhfoi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis magna quis justo lobortis euismod eget ut diam. In eget lacus quis ipsum aliquet semper et et ex. Suspendisse dictum, justo sit amet euismod venenatis, felis nisi sollicitudin enim, et interdum ipsum tellus quis libero. Nam nisl felis, feugiat nec tellus eget, interdum auctor ligula. Sed a volutpat massa. Vivamus ut lorem ut turpis cursus porttitor sed non orci. Donec mattis laoreet neque nec tincidunt. Praesent eget enim mollis, euismo', 'DRAFT', 2, '2019-05-19 10:35:35', '2019-05-19 10:35:35'),
(1004, 'Nouvel articles', 'ceci est un article de blog', '<p style=\"text-align: justify;\"><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\"><strong>Lorem ipsum dolor sit amet,</strong> consectetur adipiscing elit. Integer auctor porttitor finibus. Nam ultricies egestas turpis, vitae malesuada purus finibus id. Suspendisse leo ex, dapibus in diam sed, laoreet viverra urna. Nullam ultrices sem a posuere tempus. Aenean ultrices odio a auctor hendrerit. Donec a enim accumsan, tempus odio ac, bibendum dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin tincidunt in arcu ac faucibus. Aenean sit amet tortor convallis, feugiat enim quis, accumsan odio. Nunc ac laoreet nisl, id tempor justo. Sed id nisi ac magna cursus vestibulum id quis sapien. Duis sit amet malesuada ligula. Curabitur tincidunt neque odio, sit amet condimentum velit vulputate quis. Pellentesque faucibus maximus quam, facilisis fermentum sapien efficitur sed.</span></p>', 'DRAFT', 3, '2019-05-22 20:32:50', '2019-05-22 20:32:50');

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
(1, 'Votre tÃ©moignagedolor sit amet, consectetur adipiscing elit. Suspendisse quis quam quis neque semper elementum. Suspendisse potenti. Donec at turpis et mauris vehicula tincidunt. Curabitur dapibus consectetur tortor, nec mollis sem facilisis in. Praesent congue semper orci ac suscipit. Integer faucibus orci quis enim feugiat fermentum. Phasellus a mi ac eros tincidunt tincidunt. Praesent posuere justo in magna iaculis, eget sodales lorem eleifend. Nam viverra risus a mi commodo, et fermentum massa auctor. Nam laoreet, tortor ut sodales rutrum, ante libero cursus elit, quis iaculis neque ex non enim. Nam sit amet mi malesuada dui consectetur rhoncus. Pellentesque malesuada tincidunt augue non ullamcorper. Integer congue sem ac ligula sollicitudin, nec laoreet ante placerat.', 'APPROVED', 'niec', '2019-05-24 17:41:58', '2019-05-24 17:41:58'),
(4, 'Votre tÃ©moignagegv;jgjlhgkjfxdwszerdtfygjhbn,v bcdolor sit amet, consectetur adipiscing elit. Suspendisse quis quam quis neque semper elementum. Suspendisse potenti. Donec at turpis et mauris vehicula tincidunt. Curabitur dapibus consectetur tortor, nec mollis sem facilisis in. Praesent congue semper orci ac suscipit. Integer faucibus orci quis enim feugiat fermentum. Phasellus a mi ac eros tincidunt tincidunt. Praesent posuere justo in magna iaculis, eget sodales lorem eleifend. Nam viverra risus a mi commodo, et fermentum massa auctor. Nam laoreet, tortor ut sodales rutrum, ante libero cursus elit, quis iaculis neque ex non enim. Nam sit amet mi malesuada dui consectetur rhoncus. Pellentesque malesuada tincidunt augue non ullamcorper. Integer congue sem ac ligula sollicitudin, nec laoreet ante placerat.fwsedrtyf', 'PENDING', 'niec2', '2019-05-24 17:43:46', '2019-05-24 17:43:46'),
(5, 'Votre tÃ©moignage', 'REJECTED', 'niec3', '2019-05-24 17:44:21', '2019-05-24 17:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `profile` enum('ADMIN','CLIENT') NOT NULL,
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
(1, 'ADMIN', '1', 'Alix', 'DE HAUT', 'dehaut.alix@test.com', '$2y$10$XZcRJ73d3TUw.wgrPz/KM.yXB06LC0RW0CGrUtn2PpFkESzqQefkW', '8a09d8f362b537f46660103ebb099cb6', '2019-01-26 11:35:27', '2019-05-19 10:23:17'),
(2, 'CLIENT', '0', 'Didier', 'PREMIER', 'did@gmail.com', '$2y$10$/e29RluuqRbpLLiNXFREpefo6YlpKslVugURpRNV4DwUKGaSqERJ.', NULL, '2019-03-31 16:47:33', '2019-04-13 16:04:56');

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
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Media`
--
ALTER TABLE `Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `Testimonial`
--
ALTER TABLE `Testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
