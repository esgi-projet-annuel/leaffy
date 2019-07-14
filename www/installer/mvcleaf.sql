-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jul 14, 2019 at 03:55 PM
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
(12, 'REJECTED', 'teub', '2019-07-11 20:45:41', '2019-07-11 20:45:41', 1, 1),
(13, 'PENDING', 'teub', '2019-07-11 20:49:50', '2019-07-11 20:49:50', 1, 1),
(14, 'REJECTED', 'teub', '2019-07-11 20:51:20', '2019-07-11 20:51:20', 1, 1),
(15, 'PENDING', 'sz', '2019-07-11 20:53:18', '2019-07-11 20:53:18', 1, 1),
(16, 'APPROVED', 'ytufutyfvuty', '2019-07-11 21:46:03', '2019-07-11 21:46:03', 1, 1),
(17, 'PENDING', 'ytufutyfvuty', '2019-07-11 21:46:34', '2019-07-11 21:46:34', 1, 1),
(18, 'PENDING', 'ytufutyfvuty', '2019-07-11 21:48:24', '2019-07-11 21:48:24', 1, 1),
(19, 'PENDING', 'test envoi mail', '2019-07-12 21:39:40', '2019-07-12 21:39:40', 1, 1),
(20, 'PENDING', 'test mail', '2019-07-12 21:43:29', '2019-07-12 21:43:29', 1, 1);

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
  `default_page` tinyint(1) NOT NULL DEFAULT '0',
  `menu_position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`id`, `title`, `meta_description`, `content`, `type`, `status`, `default_page`, `menu_position`, `created_at`, `updated_at`) VALUES
(2, 'A propos !', 'page a propos', '<h1 style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>\r\n<h2 style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet</h2>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff; text-align: left;\">consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff; text-align: right;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff; text-align: left;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus. Integer quis elit vel ipsum tempus faucibus. <strong>Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque</strong>.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff; text-align: left;\">Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia. Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>\r\n<p>&nbsp;</p>', 'STATIC', 'PUBLISHED', 0, 0, '2019-04-03 19:18:43', '2019-05-26 20:08:19'),
(3, 'blog', 'page blog', NULL, 'BLOG', 'PUBLISHED', 1, 1, '2019-04-03 19:20:52', '2019-07-14 15:31:56'),
(4, 'Me contacter', 'page contact', '<p style=\"text-align: center;\"><strong>Niecbour Massage</strong></p>\r\n<p style=\"text-align: center;\"><strong>11 rue des pommes de terres</strong></p>\r\n<p style=\"text-align: center;\"><strong>75012 Paris</strong></p>\r\n<p style=\"text-align: center;\"><strong>niecbour.massage@gmail.com</strong></p>\r\n<p style=\"text-align: center;\"><strong>01.01.01.01.01</strong></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">Facebook: <span style=\"text-decoration: underline;\"><em>niec</em></span></p>\r\n<p style=\"text-align: left;\">Twitter: <span style=\"text-decoration: underline;\"><span><em>niec</em></span></span></p>\r\n<p style=\"text-align: left;\">Instagram: <span style=\"text-decoration: underline;\"><span><span><em>niec</em></span></span></span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>', 'STATIC', 'PUBLISHED', 0, 2, '2019-04-03 19:20:52', '2019-07-14 13:58:55'),
(12, 'Tarifs', 'mes tarifs', '<p style=\"text-align: center;\">Grille de starifs:&nbsp;</p>\r\n<p style=\"text-align: center;\">- kbfFNFQ</p>\r\n<p style=\"text-align: center;\">-QFQSGG</p>\r\n<p style=\"text-align: center;\">-QFGQF</p>\r\n<p style=\"text-align: center;\">-QGDFGD</p>\r\n<p style=\"text-align: center;\">-qfgqvd</p>', 'STATIC', 'PUBLISHED', 0, 3, '2019-05-26 20:04:55', '2019-07-14 13:58:58');

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
(1, 'titre de mon article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis magna quis justo lobortis euismod eget ut diam. In eget lacus quis ipsum aliquet semper et et ex. Suspendisse dictum, justo sit amet euismod venenatis, felis nisi sollicitudin enim, et interdum ipsum tellus quis libero. Nam nisl felis, feugiat nec tellus eget, interdum auctor ligula. Sed a volutpat massa. Vivamus ut lorem ut turpis cursus porttitor sed non orci. Donec mattis laoreet neque nec tincidunt. Praesent eget enim mollis, euismo</p>', 'PUBLISHED', 2, '2019-05-19 10:35:35', '2019-07-02 10:42:51'),
(2, 'Nouvel articles', 'ceci est un article de blog', '<p style=\"text-align: justify;\"><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\"><strong>Lorem ipsum dolor sit amet,</strong> consectetur adipiscing elit. Integer auctor porttitor finibus. Nam ultricies egestas turpis, vitae malesuada purus finibus id. Suspendisse leo ex, dapibus in diam sed, laoreet viverra urna. Nullam ultrices sem a posuere tempus. Aenean ultrices odio a auctor hendrerit. Donec a enim accumsan, tempus odio ac, bibendum dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin tincidunt in arcu ac faucibus. Aenean sit amet tortor convallis, feugiat enim quis, accumsan odio. Nunc ac laoreet nisl, id tempor justo. Sed id nisi ac magna cursus vestibulum id quis sapien. Duis sit amet malesuada ligula. Curabitur tincidunt neque odio, sit amet condimentum velit vulputate quis. Pellentesque faucibus maximus quam, facilisis fermentum sapien efficitur sed.</span></p>', 'PUBLISHED', 3, '2019-05-22 20:32:50', '2019-07-02 10:42:51'),
(3, 'Nouvel article 222', 'Super article 2 ', '<h2>Contenu</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis sem vitae mi laoreet, in dapibus libero ultrices. Pellentesque dignissim lectus a porttitor luctus.</p><p>Integer quis elit vel ipsum tempus faucibus. Quisque a venenatis purus. Maecenas aliquam eget ligula in facilisis. Pellentesque bibendum mattis urna ac pellentesque. Ut ut mi et purus bibendum posuere eget vitae ligula. Donec ultricies orci vitae ligula sagittis, vel sollicitudin nulla tempus. Proin diam odio, ornare quis finibus sit amet, porttitor non ante. Aenean volutpat a diam condimentum condimentum. Morbi pretium magna vel condimentum laoreet. Sed malesuada pulvinar sapien ac lacinia.</p><p>Maecenas in porta mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>&nbsp;</p>', 'DRAFT', 3, '2019-05-26 21:59:38', '2019-07-02 10:42:51'),
(4, 'Nouvel article 3', 'fk:sdbfJ:ksdfb:ksjhF:SDJK:ds', '<br />\r\n<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>\r\n<tr><th align=\'left\' bgcolor=\'#f57900\' colspan=\"5\"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined index: value in /var/www/html/views/modals/formPost.mod.php on line <i>42</i></th></tr>\r\n<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>\r\n<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0023</td><td bgcolor=\'#eeeeec\' align=\'right\'>408704</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'/var/www/html/index.php\' bgcolor=\'#eeeeec\'>.../index.php<b>:</b>0</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0193</td><td bgcolor=\'#eeeeec\' align=\'right\'>441496</td><td bgcolor=\'#eeeeec\'>LeaffyMvc\\Controllers\\PostController->createPost(  )</td><td title=\'/var/www/html/index.php\' bgcolor=\'#eeeeec\'>.../index.php<b>:</b>60</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0355</td><td bgcolor=\'#eeeeec\' align=\'right\'>511048</td><td bgcolor=\'#eeeeec\'>LeaffyMvc\\Core\\View->__destruct(  )</td><td title=\'/var/www/html/controllers/PostController.class.php\' bgcolor=\'#eeeeec\'>.../PostController.class.php<b>:</b>20</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0379</td><td bgcolor=\'#eeeeec\' align=\'right\'>520368</td><td bgcolor=\'#eeeeec\'>include( <font color=\'#00bb00\'>\'/var/www/html/views/templates/back.tpl.php\'</font> )</td><td title=\'/var/www/html/Core/View.class.php\' bgcolor=\'#eeeeec\'>.../View.class.php<b>:</b>68</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0787</td><td bgcolor=\'#eeeeec\' align=\'right\'>569672</td><td bgcolor=\'#eeeeec\'>include( <font color=\'#00bb00\'>\'/var/www/html/views/back/setPost.view.php\'</font> )</td><td title=\'/var/www/html/views/templates/back.tpl.php\' bgcolor=\'#eeeeec\'>.../back.tpl.php<b>:</b>80</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>6</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0788</td><td bgcolor=\'#eeeeec\' align=\'right\'>569672</td><td bgcolor=\'#eeeeec\'>LeaffyMvc\\Core\\View->addModal(  )</td><td title=\'/var/www/html/views/back/setPost.view.php\' bgcolor=\'#eeeeec\'>.../setPost.view.php<b>:</b>12</td></tr>\r\n<tr><td bgcolor=\'#eeeeec\' align=\'center\'>7</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0820</td><td bgcolor=\'#eeeeec\' align=\'right\'>581992</td><td bgcolor=\'#eeeeec\'>include( <font color=\'#00bb00\'>\'/var/www/html/views/modals/formPost.mod.php\'</font> )</td><td title=\'/var/www/html/Core/View.class.php\' bgcolor=\'#eeeeec\'>.../View.class.php<b>:</b>38</td></tr>\r\n</table></font>\r\n', 'WITHDRAWN', 3, '2019-05-27 12:59:23', '2019-07-02 10:42:51'),
(5, 'article test test', 'eZGFRG', '<p>fegRQLjhfmuhSFLUHEZGFluezhglher</p>', 'WITHDRAWN', 3, '2019-05-27 13:06:28', '2019-07-02 10:42:51'),
(6, 'Hello word', 'jfmqjgqdknvqgkdnv', '<p>blabla</p>', 'DRAFT', 3, '2019-07-03 14:24:14', '2019-07-03 14:24:14'),
(7, 'Article 1', 'Description article 1', '<p>Contenu article 1</p><ol><li>jgvg</li><li>jhjh</li><li>hkgvghv</li></ol><figure class=\"table\"><table><tbody><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 'PUBLISHED', 3, '2019-07-07 13:20:32', '2019-07-07 13:20:32');

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
(4, 'Votre tÃ©moignagegv;jgjlhgkjfxdwszerdtfygjhbn,v bcdolor sit amet, consectetur adipiscing elit. Suspendisse quis quam quis neque semper elementum. Suspendisse potenti. Donec at turpis et mauris vehicula tincidunt. Curabitur dapibus consectetur tortor, nec mollis sem facilisis in. Praesent congue semper orci ac suscipit. Integer faucibus orci quis enim feugiat fermentum. Phasellus a mi ac eros tincidunt tincidunt. Praesent posuere justo in magna iaculis, eget sodales lorem eleifend. Nam viverra risus a mi commodo, et fermentum massa auctor. Nam laoreet, tortor ut sodales rutrum, ante libero cursus elit, quis iaculis neque ex non enim. Nam sit amet mi malesuada dui consectetur rhoncus. Pellentesque malesuada tincidunt augue non ullamcorper. Integer congue sem ac ligula sollicitudin, nec laoreet ante placerat.fwsedrtyf', 'APPROVED', 'niec2', '2019-05-24 17:43:46', '2019-05-24 17:43:46'),
(5, 'Votre tÃ©moignage', 'APPROVED', 'niec3', '2019-05-24 17:44:21', '2019-05-24 17:44:21'),
(6, 'Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage Votre tÃ©moignage', 'PENDING', 'niecvroum', '2019-05-25 19:15:07', '2019-05-25 19:15:07'),
(7, 'Votre tÃ©moignageqgrgdgbqbbq<bbb', 'APPROVED', 'qrgg', '2019-05-26 10:03:22', '2019-05-26 10:03:22'),
(8, 'test avis ', 'REJECTED', 'test avis', '2019-05-27 12:58:13', '2019-05-27 12:58:13'),
(9, 'test avis ', 'PENDING', 'test avis', '2019-05-27 12:58:39', '2019-05-27 12:58:39'),
(10, 'Votre tÃ©moignage', 'REJECTED', 'alix', '2019-05-27 13:15:16', '2019-05-27 13:15:16'),
(11, 'Ceci est un commentaire avec moderation par mail', 'PENDING', 'alix', '2019-07-12 21:38:19', '2019-07-12 21:38:19'),
(12, 'test mail ', 'PENDING', 'alix', '2019-07-12 21:44:38', '2019-07-12 21:44:38');

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
(1, 'ADMIN', '1', 'Alix', 'DE HAUT', 'dehaut.alix@test.com', '$2y$10$NIziRELJg0W.KIBvdU.Lk.mvdBc22d8//bXlCBC1ur18qDdXpdyum', NULL, '2019-01-26 11:35:27', '2019-07-11 20:41:00'),
(4, 'CLIENT', '1', 'Test', 'TEST', 'cuta@atech5.com', '$2y$10$YGBx9Wc1nd3HIyflmjlWUu4ah3DXbE8fTj2MVofmrYUUYbYH2vNOu', '543c270f7fae15e6b056c6b3d8f9b5b6', '2019-05-26 19:34:35', '2019-05-26 19:34:35'),
(5, 'CLIENT', '1', 'Raymond', 'PREMIER', 'nefote@theeasymail.com', '$2y$10$2MTdMcduM6iKPMiBwaPANulcn0e1qhJJHpjB4k7jWxR52N3Cm/vsG', '18005f15341f620b11115574070c1619', '2019-07-07 16:59:53', '2019-07-07 16:59:53'),
(6, 'CLIENT', '1', 'Hello', 'SUNSHINE', 'test@test.com', '$2y$10$OsuQSjezHA9aCazAGWzKw.5O7mSNWgFWm0t9qfXMoeUpym4ive8Cu', '53e8af7b0c8d9d9e7ca0f54d2a81f317', '2019-07-07 17:08:27', '2019-07-10 19:40:45'),
(7, 'EDITOR', '1', 'Prenom1', 'NOM1', 'dehaut.alix@gmail.com', '$2y$10$VzQ.fVWKMqWcV4HU09AiXej9V.GNxQgSUr4Fk2OcUMWO7FOTSLMKa', '5582386220a919181d0d24c1e806b484', '2019-07-10 19:49:00', '2019-07-14 13:06:33'),
(12, 'CLIENT', '1', 'Prenom3', 'NOM 3', 'hamom@mail-click.net', '$2y$10$FdYuBdFEY48zQnLVb3ikoeNn2pcaN7F8NLtAsZpehzsXh1s4rGHle', NULL, '2019-07-13 12:35:27', '2019-07-14 11:18:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Media`
--
ALTER TABLE `Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Testimonial`
--
ALTER TABLE `Testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
