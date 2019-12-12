-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2019 at 02:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `o_pcfootball.store`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `descr` text,
  `release_date` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=449 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `descr`, `release_date`, `date`, `status`, `sort`) VALUES
(443, 'Freemasonry', 'It is not known. The earliest recorded &#039;making&#039; of a Freemason in England is that of Elias Ashmole in 1646.\r\n\r\nOrganized Freemasonry began with the founding of the Grand Lodge of England on 24 June 1717, the first Grand Lodge in the world. Ireland followed in 1725 and Scotland in 1736.', '2017-09-01', '2019-05-18 17:50:18', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `a_admins`
--

DROP TABLE IF EXISTS `a_admins`;
CREATE TABLE IF NOT EXISTS `a_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_type` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT 'new/active/archive',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_admins`
--

INSERT INTO `a_admins` (`id`, `perm_type`, `email`, `password`, `name`, `phone`, `address`, `date`, `status`) VALUES
(25, 1, 'galenteryan@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Gaspar Galenteryan', '098492153', 'Garegin Nzhdeh 3, 31', '2019-03-12 12:27:59', '1'),
(30, 1, 'hakob.karapetyan2372004@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Hakob Karapetyan', NULL, NULL, '2019-11-20 19:01:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `a_admins_perms`
--

DROP TABLE IF EXISTS `a_admins_perms`;
CREATE TABLE IF NOT EXISTS `a_admins_perms` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'admin, editor, etc...',
  `access` varchar(100) NOT NULL COMMENT 'page name',
  `permission_view` enum('0','1') NOT NULL DEFAULT '0',
  `permission_edit` enum('0','1') NOT NULL DEFAULT '0',
  `permission_delete` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `a_admins_types`
--

DROP TABLE IF EXISTS `a_admins_types`;
CREATE TABLE IF NOT EXISTS `a_admins_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL COMMENT 'admin, editor, etc...',
  `descr` text NOT NULL COMMENT 'Description',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_admins_types`
--

INSERT INTO `a_admins_types` (`id`, `type_name`, `descr`) VALUES
(1, 'Admin', 'Admin can do everything.'),
(2, 'Editor', 'Editor can view and edit some data, but can not delete data.'),
(3, 'Guest', 'Guest can only view some pages or data.');

-- --------------------------------------------------------

--
-- Table structure for table `a_colors`
--

DROP TABLE IF EXISTS `a_colors`;
CREATE TABLE IF NOT EXISTS `a_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(100) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_colors`
--

INSERT INTO `a_colors` (`id`, `color`, `status`, `sort`) VALUES
(1, 'green', '1', 0),
(2, 'red', '1', 6),
(3, 'blue', '1', 8),
(4, 'orange', '1', 3),
(5, 'teal', '1', 1),
(6, 'cyan', '1', 5),
(7, 'blue-grey', '1', 7),
(8, 'purple', '1', 4),
(9, 'indigo', '1', 6),
(10, 'brown', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `a_colors_theme`
--

DROP TABLE IF EXISTS `a_colors_theme`;
CREATE TABLE IF NOT EXISTS `a_colors_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_colors_theme`
--

INSERT INTO `a_colors_theme` (`id`, `admin_id`, `color_id`, `status`) VALUES
(38, 29, 1, '0'),
(39, 25, 5, '0'),
(40, 30, 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `a_docs`
--

DROP TABLE IF EXISTS `a_docs`;
CREATE TABLE IF NOT EXISTS `a_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `descr` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COMMENT='Documentation';

-- --------------------------------------------------------

--
-- Table structure for table `a_menu`
--

DROP TABLE IF EXISTS `a_menu`;
CREATE TABLE IF NOT EXISTS `a_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `collapse` enum('0','1') NOT NULL DEFAULT '0',
  `filename` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `descr` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_editor` enum('0','1','2') NOT NULL DEFAULT '0',
  `status_guest` enum('0','1','2') NOT NULL DEFAULT '0',
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_menu`
--

INSERT INTO `a_menu` (`id`, `parent_id`, `collapse`, `filename`, `title`, `icon`, `descr`, `date`, `status_editor`, `status_guest`, `status`, `sort`) VALUES
(1, 34, '0', 'admins', 'Администраторы', '', 'Admins, who can add, edit or delete content.', '2019-04-30 02:57:42', '0', '0', '1', 14),
(2, 33, '0', 'notifications', 'Уведомления', '', 'All project notifications for admins.', '2019-04-30 02:57:42', '0', '0', '1', 13),
(4, 34, '0', 'users', 'Пользователи', '', 'Default users.', '2019-04-30 02:57:42', '0', '0', '1', 12),
(77, 68, '0', 'slider', 'Слайдер', '', '', '2019-12-02 18:05:57', '0', '0', '1', 5),
(33, 0, '1', 'none', 'Другая настройки', 'settings', 'Different data in use.', '2019-04-30 02:57:42', '0', '0', '1', 11),
(34, 0, '1', 'none', 'Все пользователи', 'accounts', 'All users.', '2019-04-30 02:57:42', '0', '0', '1', 10),
(61, 33, '0', 'social_networks', 'Социальные связи', '', 'All social networks, that used in data.', '2019-04-30 02:57:42', '0', '0', '1', 9),
(78, 68, '0', 'contacts', 'Контакты', '', '', '2019-12-05 21:03:17', '0', '0', '1', 6),
(66, 0, '0', 'pages', 'Страницы', 'view-headline', 'Pages for a site like about, terms, etc...', '2019-05-18 20:46:41', '0', '0', '1', 8),
(68, 0, '1', 'pcfootball.store', 'PC Football Store', 'home', '', '2019-11-20 19:03:21', '0', '0', '1', 7),
(70, 68, '0', 'forecasts', 'Прогнозы', '', '', '2019-11-21 11:13:15', '0', '0', '1', 0),
(71, 68, '0', 'leagues', 'Лиги', '', '', '2019-11-21 16:11:15', '0', '0', '1', 4),
(72, 68, '0', 'teams', 'Команды', '', '', '2019-11-21 19:16:10', '0', '0', '1', 3),
(73, 68, '0', 'news', 'Новости', '', '', '2019-11-22 21:26:28', '0', '0', '1', 2),
(75, 68, '0', 'packages', 'Пакеты', '', '', '2019-11-22 23:52:18', '0', '0', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL COMMENT 'Also folder name',
  `row_id` int(11) DEFAULT NULL COMMENT 'Id of row in table',
  `name_original` text COMMENT 'Original uploaded file name ',
  `name_used` varchar(100) DEFAULT NULL COMMENT 'For use',
  `name` varchar(100) NOT NULL COMMENT 'Name in folder',
  `type` varchar(100) NOT NULL COMMENT 'File format',
  `size` varchar(100) NOT NULL COMMENT 'Bytes of data',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Insert / Update',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=683 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `table_name`, `row_id`, `name_original`, `name_used`, `name`, `type`, `size`, `date`, `sort`) VALUES
(401, 'a_admins', 25, '6996ba4f952f2f23823f9f116e851c71', 'profile', '1e871ccf2f15f4fb547ba384d54a5d88', 'jpg', '24727', '2019-05-17 12:13:23', 0),
(673, 'f_slider', 4, '2016-porsche-911-gt3-4k-1920x1080', 'slide', '64a79a44018ee3436d1460e49b3173e0', 'jpg', '762406', '2019-12-03 19:13:45', 0),
(588, 'albums', 443, 'masonic-freemasonry-emblem-icon-logo-vector-21859611', 'cover', '98328c457e0ccfd55a94bb4a466350d4', 'jpg', '112690', '2019-05-18 13:50:18', 0),
(597, 'gallery', 443, '92771782-scrapbook-design-background-with-mason-religious-symbols-freemasonry-and-secret-societies-emblems-oc', NULL, '1558196168247', 'jpg', '548925', '2019-05-18 16:16:10', 0),
(598, 'gallery', 443, 'Freemasonry-in-Cuba-X', NULL, '1558196170868', 'jpg', '924574', '2019-05-18 16:16:13', 0),
(593, 'gallery', 443, '72538956-freemason-square-and-compass-vector-freemasonry-signs-and-mason-symbols-vector-tattoo', NULL, '1558187878018', 'jpg', '158651', '2019-05-18 13:57:58', 0),
(596, 'gallery', 443, '1558187879143', NULL, '1558187935542', 'jpg', '305136', '2019-05-18 13:58:55', 0),
(600, 'gallery', 443, 'structure-of-freemasonry', NULL, '1558196175722', 'jpg', '823669', '2019-05-18 16:16:18', 0),
(599, 'gallery', 443, 'na_5ca5ec2d9320e', NULL, '1558196174063', 'jpg', '268148', '2019-05-18 16:16:15', 0),
(601, 'gallery', 443, 'US_dollar_bill_pyramid', NULL, '1558196178075', 'jpg', '78328', '2019-05-18 16:16:18', 0),
(674, 'f_slider', 5, '2016-porsche-911-gt3-4k-1920x1080', 'slide', 'fd65c7eaa5946a96a79a9e6a94e5e91f', 'jpg', '762406', '2019-12-03 19:13:50', 0),
(670, 'f_teams', 17, '41097-abstract-wallpaper-chart-free-frame', 'logo', '8cf4d5c6f732f8b9cbbfa80fb88d1a13', 'png', '9136', '2019-11-23 11:33:10', 0),
(672, 'f_news', 14, '2016-porsche-911-gt3-4k-1920x1080', 'image', 'e633f2ed040fded6f0d131ab2d2bf5d3', 'jpg', '762406', '2019-11-30 18:48:30', 0),
(669, 'f_teams', 14, '2016-porsche-911-gt3-4k-1920x1080', 'logo', '3cfd801ae3db147ba56cf4cf7befb5b4', 'jpg', '762406', '2019-11-23 11:25:31', 0),
(679, 'f_news', 10, 'angel_18-wallpaper-1920x1280', 'image', '3d30989a3679b8f3cf8e2adbbf1a7f11', 'jpg', '483508', '2019-12-08 12:28:45', 0),
(680, 'f_teams', 13, 'dodge-demon-challenger-srt-muscle-car-wallpaper-3840x2160', 'logo', '2af6fc79c5566f14ee454660a58451cc', 'jpg', '1869808', '2019-12-08 12:38:49', 0),
(677, 'f_slider', 9, 'laferrari-4', 'slide', '309d998fe2b34f27ed0db5f86f133c9d', 'jpg', '124178', '2019-12-03 19:16:41', 0),
(678, 'f_slider', 10, 'angel_18-wallpaper-1920x1280', 'slide', 'd123ea2d32c5451c91990547a90916e9', 'jpg', '483508', '2019-12-05 14:25:34', 0),
(681, 'f_teams', 16, 'cubes_red_black_131950_1600x900', 'logo', '00111e43a091e8b8e87b3336cd1d1601', 'jpg', '560088', '2019-12-08 12:58:13', 0),
(682, 'f_news', 12, 'lamp_outlet_idea_electricity_120422_1600x900', 'image', '44a1c5e58edb4e369cf6c4b26ee091ff', 'jpg', '533615', '2019-12-08 14:05:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_contacts`
--

DROP TABLE IF EXISTS `f_contacts`;
CREATE TABLE IF NOT EXISTS `f_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `social_links` json DEFAULT NULL COMMENT 'json',
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_contacts`
--

INSERT INTO `f_contacts` (`id`, `social_links`, `phone`, `email`, `address`) VALUES
(3, '{\"1\": \"https://www.facebook.com/artyom.belluyan.1\", \"2\": \"https://www.instagram.com/artyom_belluyan\"}', '00000001', 'belluads@gmail.com', 'asdfg');

-- --------------------------------------------------------

--
-- Table structure for table `f_forecasts`
--

DROP TABLE IF EXISTS `f_forecasts`;
CREATE TABLE IF NOT EXISTS `f_forecasts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_league_id` int(11) NOT NULL,
  `f_teams` text COMMENT 'json',
  `free` enum('0','1') NOT NULL DEFAULT '0',
  `success` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'associated with date_start',
  `probability` enum('0','1','2') NOT NULL,
  `score` varchar(100) DEFAULT NULL,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `descr_ru` text NOT NULL,
  `descr_en` text NOT NULL,
  `date_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_forecasts`
--

INSERT INTO `f_forecasts` (`id`, `f_league_id`, `f_teams`, `free`, `success`, `probability`, `score`, `title_ru`, `title_en`, `descr_ru`, `descr_en`, `date_start`, `date`, `status`, `sort`) VALUES
(15, 5, '[\"14\", \"16\"]', '0', '1', '0', '1:4', 'fgfghj', 'dfghjk', '&lt;p&gt;sfdgh&lt;/p&gt;', '&lt;p&gt;dfghjk&lt;/p&gt;', '2019-12-09 12:00:00', '2019-12-08 17:49:45', '1', 0),
(14, 6, '[\"14\", \"14\"]', '0', '1', '2', '1:3', 'fgfghj', 'dfghjk', '&lt;p&gt;sfdgh&lt;/p&gt;', '&lt;p&gt;dfghjk&lt;/p&gt;', '2019-12-09 12:00:00', '2019-12-08 17:49:45', '1', 0),
(16, 5, '[\"14\", \"16\"]', '0', '0', '0', '1:4', 'fgfghj', 'dfghjk', '&lt;p&gt;sfdgh&lt;/p&gt;', '&lt;p&gt;dfghjk&lt;/p&gt;', '2019-12-09 12:00:00', '2019-12-08 17:49:45', '1', 0),
(17, 5, '[\"14\", \"16\"]', '0', '0', '0', '1:4', 'fgfghj', 'dfghjk', '&lt;p&gt;sfdgh&lt;/p&gt;', '&lt;p&gt;dfghjk&lt;/p&gt;', '2019-12-09 12:00:00', '2019-12-08 17:49:45', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_forecasts_options`
--

DROP TABLE IF EXISTS `f_forecasts_options`;
CREATE TABLE IF NOT EXISTS `f_forecasts_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_forecast_id` int(11) NOT NULL,
  `option_1_ru` varchar(100) NOT NULL,
  `option_1_en` varchar(100) NOT NULL,
  `option_2_ru` varchar(100) NOT NULL,
  `option_2_en` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_forecasts_options`
--

INSERT INTO `f_forecasts_options` (`id`, `f_forecast_id`, `option_1_ru`, `option_1_en`, `option_2_ru`, `option_2_en`, `date`, `sort`) VALUES
(1, 15, 'fn', 'option 2 Ru', 'option 2 Ru', 'асдфг', '2019-12-03 23:06:49', 0),
(7, 15, 'asd', 'option 2 Ru', 'option 2 Ru', 'option 2 Ru', '2019-12-09 17:45:51', 0),
(5, 14, 'option 1 Ru', 'option 1 En', 'option 2 Ru', 'option 2 EN', '2019-12-05 00:09:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_leagues`
--

DROP TABLE IF EXISTS `f_leagues`;
CREATE TABLE IF NOT EXISTS `f_leagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_leagues`
--

INSERT INTO `f_leagues` (`id`, `title_ru`, `title_en`, `date`, `status`, `sort`) VALUES
(6, 'Лига 1', 'League 1', '2019-12-01 22:20:20', '1', 0),
(5, 'Лига 2', 'League 2', '2019-11-21 19:32:18', '1', 1),
(7, 'Лига 3', 'Лига 3', '2019-12-07 19:02:39', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_news`
--

DROP TABLE IF EXISTS `f_news`;
CREATE TABLE IF NOT EXISTS `f_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `descr_ru` text NOT NULL,
  `descr_en` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_news`
--

INSERT INTO `f_news` (`id`, `title_ru`, `title_en`, `descr_ru`, `descr_en`, `date`, `status`, `sort`) VALUES
(14, 'fdg', 'dsfdg', 'aaaaaaaaaaaa', 'adsfd', '2019-11-30 22:08:34', '1', 0),
(12, 'sdfgdhfjhkjkfdsghj', 'kdfghj', '&lt;p&gt;hghjkjlk;;&#039;sdfghjkl&lt;/p&gt;', 'DSFG', '2019-11-23 15:34:16', '1', 0),
(10, 'rdsfgh', 'ASDFGHJKL', 'fgkhljk', 'ASDRHFTYGH', '2019-11-22 22:50:04', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_packages`
--

DROP TABLE IF EXISTS `f_packages`;
CREATE TABLE IF NOT EXISTS `f_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `type_ru` varchar(100) NOT NULL,
  `type_en` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `days` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_packages`
--

INSERT INTO `f_packages` (`id`, `title_ru`, `title_en`, `type_ru`, `type_en`, `price`, `days`, `date`, `status`, `sort`) VALUES
(3, 'dhgfjn,', 'dvbn', 'd', 'sdfgh', '50000', '213', '2019-11-30 22:12:58', '1', 1),
(4, 'gfhjkl', 'fdsghgjh', 'fhgjh', 'dfghgj', '2000', '213', '2019-11-30 22:17:41', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_packages_options`
--

DROP TABLE IF EXISTS `f_packages_options`;
CREATE TABLE IF NOT EXISTS `f_packages_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_packages_options`
--

INSERT INTO `f_packages_options` (`id`, `title_ru`, `title_en`, `sort`) VALUES
(1, 'df', 'rdtty', 1),
(2, 'дфсдхт', 'dafsgdhfgh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_payments`
--

DROP TABLE IF EXISTS `f_payments`;
CREATE TABLE IF NOT EXISTS `f_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `days` int(11) NOT NULL COMMENT 'subscribtion time',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `f_slider`
--

DROP TABLE IF EXISTS `f_slider`;
CREATE TABLE IF NOT EXISTS `f_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `descr_ru` text NOT NULL,
  `descr_en` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_slider`
--

INSERT INTO `f_slider` (`id`, `title_ru`, `title_en`, `descr_ru`, `descr_en`, `link`, `date`, `status`, `sort`) VALUES
(1, 'aaaaaaaaaaaaa', 'asfdfhg', 'fgdhsadfghjkl;&#039;\r\nlkjhfdsxghjk,jhmfdsdasADSFGHJKL;&#039;;KJHG', 'fdghjhkl', 'https://galent.am/', '2019-12-02 18:41:26', '1', 0),
(2, 'sdfghfghmjk', 'aasfdfghj', 'asdfghnm,', 'asdfghjk', 'qwertyu', '2019-12-02 18:49:31', '0', 0),
(3, 'safdgh', 'sfdfhg', '&lt;p&gt;dgfhgj&lt;/p&gt;', '&lt;p&gt;sfdghh&lt;/p&gt;', 'adsfggh,', '2019-12-02 18:57:17', '1', 0),
(4, 'asdfg', 'dxfcgf', '&lt;p&gt;xcfbgv&lt;/p&gt;', '&lt;p&gt;xcvb&lt;/p&gt;', 'cvxbnm,', '2019-12-03 23:13:45', '0', 0),
(5, 'asdfg', 'dxfcgf', '&lt;p&gt;xcfbgv&lt;/p&gt;', '&lt;p&gt;xcvb&lt;/p&gt;', 'cvxbnm,', '2019-12-03 23:13:50', '0', 0),
(6, 'asdfg', 'dxfcgf', '&lt;p&gt;xcfbgv&lt;/p&gt;', '&lt;p&gt;xcvb&lt;/p&gt;', 'cvxbnm,', '2019-12-03 23:14:50', '0', 0),
(9, 'fdgdfgh', 'jkl', 'dfgh', 'safdgfhj', 'https://www.instagram.com/', '2019-12-03 23:16:41', '1', 0),
(10, 'dfsgdhjk', 'fdsghjk', 'dfghgjkjjhgf', 'wfdghjkl;&#039;lhgjhfdr', 'https://galent.am/', '2019-12-05 18:25:34', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_teams`
--

DROP TABLE IF EXISTS `f_teams`;
CREATE TABLE IF NOT EXISTS `f_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_leagues` text COMMENT 'json',
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_teams`
--

INSERT INTO `f_teams` (`id`, `f_leagues`, `title_ru`, `title_en`, `date`, `status`, `sort`) VALUES
(13, '[\"5\"]', 'Команда 1', 'Team 1', '2019-11-22 23:20:21', '1', 0),
(12, '[\"6\"]', 'Команда 2', 'Team 2', '2019-11-22 22:00:08', '1', 0),
(14, '[\"5\"]', 'Команда 3', 'Team 3', '2019-11-23 15:25:31', '1', 0),
(15, '[\"7\"]', 'Команда 4', 'Team 4', '2019-11-23 15:28:37', '1', 0),
(16, '[\"5\"]', 'Команда 5', 'Team 5', '2019-11-23 15:28:50', '1', 0),
(17, '[\"6\"]', 'Команда 6', 'Team 6', '2019-11-23 15:30:51', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_actions`
--

DROP TABLE IF EXISTS `log_actions`;
CREATE TABLE IF NOT EXISTS `log_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `table_name` varchar(100) NOT NULL,
  `row_id` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=401 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_actions`
--

INSERT INTO `log_actions` (`id`, `user_id`, `admin_id`, `table_name`, `row_id`, `action`, `color`, `date`) VALUES
(1, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:14'),
(2, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:18'),
(3, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:21'),
(4, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:30'),
(5, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:34'),
(6, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:39'),
(7, NULL, 25, 'a_menu', 'all', 'sort file', 'green', '2019-11-18 12:26:45'),
(8, NULL, 25, 'pages', '9', 'delete', 'red', '2019-11-18 13:24:31'),
(9, NULL, 25, 'pages', '8', 'delete', 'red', '2019-11-18 13:24:33'),
(10, NULL, 25, 'pages', '7', 'delete', 'red', '2019-11-18 13:24:35'),
(11, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:39:03'),
(12, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:42:14'),
(13, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:42:35'),
(14, NULL, 25, 'a_docs', '603', 'delete file id', 'red', '2019-11-18 13:49:33'),
(15, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:53:19'),
(16, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:53:41'),
(17, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:55:08'),
(18, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:55:13'),
(19, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:57:01'),
(20, NULL, 25, 'a_docs', '633', 'delete file id', 'red', '2019-11-18 13:58:27'),
(21, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:58:38'),
(22, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 13:59:49'),
(23, NULL, 25, 'a_docs', '634', 'delete file id', 'red', '2019-11-18 14:00:07'),
(24, NULL, 25, 'a_docs', '635', 'delete file id', 'red', '2019-11-18 14:00:22'),
(25, NULL, 25, 'a_docs', '73', 'update', 'blue', '2019-11-18 14:00:53'),
(26, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:02:35'),
(27, NULL, 25, 'a_docs', '605', 'delete file id', 'red', '2019-11-18 14:02:56'),
(28, NULL, 25, 'a_docs', '86', 'update', 'blue', '2019-11-18 14:02:56'),
(29, NULL, 25, 'a_docs', '77', 'update', 'blue', '2019-11-18 14:04:37'),
(30, NULL, 25, 'a_docs', '76', 'update', 'blue', '2019-11-18 14:05:00'),
(31, NULL, 25, 'a_docs', '75', 'update', 'blue', '2019-11-18 14:05:15'),
(32, NULL, 25, 'a_docs', '606', 'delete file id', 'red', '2019-11-18 14:12:24'),
(33, NULL, 25, 'a_docs', '604', 'delete file id', 'red', '2019-11-18 14:13:01'),
(34, NULL, 25, 'a_docs', '638', 'delete file id', 'red', '2019-11-18 14:13:06'),
(35, NULL, 25, 'a_docs', '639', 'delete file id', 'red', '2019-11-18 14:13:10'),
(36, NULL, 25, 'a_docs', '640', 'delete file id', 'red', '2019-11-18 14:13:16'),
(37, NULL, 25, 'a_docs', '636', 'delete file id', 'red', '2019-11-18 14:13:21'),
(38, NULL, 25, 'a_docs', '637', 'delete file id', 'red', '2019-11-18 14:13:46'),
(39, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:15:20'),
(40, NULL, 25, 'a_docs', '641', 'delete file id', 'red', '2019-11-18 14:15:33'),
(41, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:16:11'),
(42, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:16:23'),
(43, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:16:45'),
(44, NULL, 25, 'a_docs', '643', 'delete file id', 'red', '2019-11-18 14:17:01'),
(45, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:17:20'),
(46, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:17:30'),
(47, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:17:35'),
(48, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:17:38'),
(49, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:17:47'),
(50, NULL, 25, 'a_docs', '645', 'delete file id', 'red', '2019-11-18 14:18:00'),
(51, NULL, 25, 'a_docs', '646', 'delete file id', 'red', '2019-11-18 14:18:04'),
(52, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:18:21'),
(53, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:18:41'),
(54, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:18:55'),
(55, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:19:07'),
(56, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:19:26'),
(57, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:19:45'),
(58, NULL, 25, 'a_docs', '648', 'delete file id', 'red', '2019-11-18 14:19:52'),
(59, NULL, 25, 'a_docs', '647', 'delete file id', 'red', '2019-11-18 14:19:54'),
(60, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:07'),
(61, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:22'),
(62, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:36'),
(63, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:45'),
(64, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:53'),
(65, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:55'),
(66, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:20:59'),
(67, NULL, 25, 'a_docs', '649', 'delete file id', 'red', '2019-11-18 14:21:06'),
(68, NULL, 25, 'a_docs', '650', 'delete file id', 'red', '2019-11-18 14:21:21'),
(69, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:21:28'),
(70, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:21:41'),
(71, NULL, 25, 'a_docs', '651', 'delete file id', 'red', '2019-11-18 14:21:53'),
(72, NULL, 25, 'a_docs', '653', 'delete file id', 'red', '2019-11-18 14:21:55'),
(73, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:22:10'),
(74, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:22:23'),
(75, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:22:45'),
(76, NULL, 25, 'a_docs', '655', 'delete file id', 'red', '2019-11-18 14:22:56'),
(77, NULL, 25, 'a_docs', '87', 'update', 'blue', '2019-11-18 14:23:10'),
(78, NULL, 25, 'a_docs', '654', 'delete file id', 'red', '2019-11-18 14:23:36'),
(79, NULL, 25, 'a_docs', '657', 'delete file id', 'red', '2019-11-18 14:23:38'),
(80, NULL, 25, 'a_docs', '92', 'insert', 'green', '2019-11-18 14:46:12'),
(81, NULL, 30, 'a_menu', '68', 'insert', 'green', '2019-11-20 19:03:21'),
(82, NULL, 30, 'a_menu', '68', 'update', 'blue', '2019-11-20 19:21:34'),
(83, NULL, 30, 'a_menu', '69', 'insert', 'green', '2019-11-20 19:22:41'),
(84, NULL, 30, 'a_menu', '69', 'update', 'blue', '2019-11-21 11:08:16'),
(85, NULL, 30, 'a_menu', '69', 'delete', 'red', '2019-11-21 11:12:50'),
(86, NULL, 30, 'a_menu', '70', 'insert', 'green', '2019-11-21 11:13:15'),
(87, NULL, 30, 'f_forecasts', '1', 'archive', 'gray', '2019-11-21 12:26:19'),
(88, NULL, 30, 'f_forecasts', '1', 'remove from archive', 'gray', '2019-11-21 12:26:51'),
(89, NULL, 30, 'a_menu', '71', 'insert', 'green', '2019-11-21 16:11:15'),
(90, NULL, 30, 'f_leagues', '1', 'insert', 'green', '2019-11-21 16:32:02'),
(91, NULL, 30, 'f_leagues', '1', 'archive', 'gray', '2019-11-21 16:36:06'),
(92, NULL, 30, 'f_leagues', '1', 'remove from archive', 'gray', '2019-11-21 16:36:54'),
(93, NULL, 30, 'f_leagues', '1', 'delete', 'red', '2019-11-21 16:36:57'),
(94, NULL, 30, 'f_leagues', '2', 'insert', 'green', '2019-11-21 16:37:02'),
(95, NULL, 30, 'f_leagues', '3', 'insert', 'green', '2019-11-21 16:37:40'),
(96, NULL, 30, 'f_leagues', 'all', 'sort file', 'green', '2019-11-21 16:37:43'),
(97, NULL, 30, 'f_leagues', '3', 'delete', 'red', '2019-11-21 16:37:47'),
(98, NULL, 30, 'f_leagues', '4', 'insert', 'green', '2019-11-21 19:13:25'),
(99, NULL, 30, 'f_leagues', '4', 'archive', 'gray', '2019-11-21 19:13:29'),
(100, NULL, 30, 'f_leagues', '4', 'delete', 'red', '2019-11-21 19:13:33'),
(101, NULL, 30, 'f_leagues', '2', 'update', 'blue', '2019-11-21 19:14:07'),
(102, NULL, 30, 'a_menu', '72', 'insert', 'green', '2019-11-21 19:16:10'),
(103, NULL, 30, 'f_teams', '1', 'insert', 'green', '2019-11-21 19:30:34'),
(104, NULL, 30, 'f_teams', '1', 'delete', 'red', '2019-11-21 19:30:46'),
(105, NULL, 30, 'f_leagues', '5', 'insert', 'green', '2019-11-21 19:32:18'),
(106, NULL, 30, 'f_teams', '2', 'insert', 'green', '2019-11-21 19:36:56'),
(107, NULL, 30, 'f_teams', '3', 'insert', 'green', '2019-11-21 19:43:07'),
(108, NULL, 30, 'f_teams', '2', 'archive', 'gray', '2019-11-21 22:58:03'),
(109, NULL, 30, 'f_teams', '3', 'archive', 'gray', '2019-11-21 22:59:55'),
(110, NULL, 30, 'f_teams', '2', 'archive', 'gray', '2019-11-21 23:00:29'),
(111, NULL, 30, 'f_teams', '3', 'remove from archive', 'gray', '2019-11-21 23:00:45'),
(112, NULL, 30, 'f_leagues', '5', 'archive', 'gray', '2019-11-21 23:01:52'),
(113, NULL, 30, 'f_leagues', '5', 'remove from archive', 'gray', '2019-11-21 23:01:58'),
(114, NULL, 30, 'f_leagues', 'all', 'sort file', 'green', '2019-11-21 23:02:04'),
(115, NULL, 30, 'f_teams', '4', 'insert', 'green', '2019-11-21 23:02:18'),
(116, NULL, 30, 'f_teams', '3', 'delete', 'red', '2019-11-21 23:02:22'),
(117, NULL, 30, 'f_teams', '4', 'delete', 'red', '2019-11-21 23:02:25'),
(118, NULL, 30, 'f_teams', '5', 'insert', 'green', '2019-11-21 23:02:33'),
(119, NULL, 30, 'f_teams', '6', 'insert', 'green', '2019-11-21 23:02:41'),
(120, NULL, 30, 'f_teams', '6', 'delete', 'red', '2019-11-21 23:09:45'),
(121, NULL, 30, 'f_teams', '6', 'delete', 'red', '2019-11-21 23:09:47'),
(122, NULL, 30, 'f_teams', '5', 'delete', 'red', '2019-11-21 23:09:50'),
(123, NULL, 30, 'f_teams', '7', 'insert', 'green', '2019-11-21 23:10:01'),
(124, NULL, 30, 'f_teams', '8', 'insert', 'green', '2019-11-21 23:14:58'),
(125, NULL, 30, 'f_teams', '7', 'delete', 'red', '2019-11-21 23:15:02'),
(126, NULL, 30, 'f_teams', '8', 'delete', 'red', '2019-11-21 23:15:04'),
(127, NULL, 30, 'f_teams', '9', 'insert', 'green', '2019-11-21 23:15:24'),
(128, NULL, 30, 'f_teams', '9', 'archive', 'gray', '2019-11-21 23:15:46'),
(129, NULL, 30, 'f_teams', '9', 'remove from archive', 'gray', '2019-11-21 23:16:16'),
(130, NULL, 30, 'f_teams', '9', 'update', 'blue', '2019-11-21 23:22:28'),
(131, NULL, 30, 'f_teams', '9', 'archive', 'gray', '2019-11-21 23:22:34'),
(132, NULL, 30, 'f_teams', '9', 'delete', 'red', '2019-11-21 23:22:38'),
(133, NULL, 30, 'f_teams', '10', 'insert', 'green', '2019-11-22 20:12:33'),
(134, NULL, 30, 'f_teams', '10', 'archive', 'gray', '2019-11-22 20:12:37'),
(135, NULL, 30, 'f_teams', '10', 'delete', 'red', '2019-11-22 20:12:42'),
(136, NULL, 30, 'a_menu', '73', 'insert', 'green', '2019-11-22 21:26:28'),
(137, NULL, 30, 'f_teams', '11', 'insert', 'green', '2019-11-22 21:40:15'),
(138, NULL, 30, 'f_teams', '11', 'archive', 'gray', '2019-11-22 21:40:23'),
(139, NULL, 30, 'f_teams', '11', 'delete', 'red', '2019-11-22 21:40:26'),
(140, NULL, 30, 'f_news', '1', 'insert', 'green', '2019-11-22 21:42:59'),
(141, NULL, 30, 'f_news', '2', 'insert', 'green', '2019-11-22 21:46:14'),
(142, NULL, 30, 'a_menu', '73', 'update', 'blue', '2019-11-22 21:53:12'),
(143, NULL, 30, 'f_leagues', '2', 'delete', 'red', '2019-11-22 21:58:06'),
(144, NULL, 30, 'f_news', '3', 'insert', 'green', '2019-11-22 21:59:49'),
(145, NULL, 30, 'f_news', '3', 'delete', 'red', '2019-11-22 21:59:58'),
(146, NULL, 30, 'f_news', '2', 'delete', 'red', '2019-11-22 22:00:00'),
(147, NULL, 30, 'f_teams', '12', 'insert', 'green', '2019-11-22 22:00:08'),
(148, NULL, 30, 'f_leagues', '5', 'archive', 'gray', '2019-11-22 22:01:20'),
(149, NULL, 30, 'f_leagues', '5', 'remove from archive', 'gray', '2019-11-22 22:01:28'),
(150, NULL, 30, 'f_news', '4', 'insert', 'green', '2019-11-22 22:01:35'),
(151, NULL, 30, 'f_news', '6', 'insert', 'green', '2019-11-22 22:10:57'),
(152, NULL, 30, 'f_news', '7', 'insert', 'green', '2019-11-22 22:44:07'),
(153, NULL, 30, 'f_news', '8', 'insert', 'green', '2019-11-22 22:44:43'),
(154, NULL, 30, 'f_news', '8', 'delete', 'red', '2019-11-22 22:48:52'),
(155, NULL, 30, 'f_news', '9', 'insert', 'green', '2019-11-22 22:49:07'),
(156, NULL, 30, 'f_news', '9', 'delete', 'red', '2019-11-22 22:49:40'),
(157, NULL, 30, 'f_news', '10', 'insert', 'green', '2019-11-22 22:50:04'),
(158, NULL, 30, 'f_news', '10', 'archive', 'gray', '2019-11-22 22:54:05'),
(159, NULL, 30, 'f_news', '10', 'remove from archive', 'gray', '2019-11-22 22:54:40'),
(160, NULL, 30, 'f_news', '662', 'delete file id', 'red', '2019-11-22 23:06:25'),
(161, NULL, 30, 'f_leagues', '10', 'update', 'blue', '2019-11-22 23:06:26'),
(162, NULL, 30, 'f_leagues', '10', 'update', 'blue', '2019-11-22 23:06:29'),
(163, NULL, 30, 'f_leagues', '10', 'update', 'blue', '2019-11-22 23:06:35'),
(164, NULL, 30, 'f_leagues', '10', 'update', 'blue', '2019-11-22 23:06:42'),
(165, NULL, 30, 'f_leagues', '10', 'update', 'blue', '2019-11-22 23:06:50'),
(166, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:08:07'),
(167, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:10:29'),
(168, NULL, 30, 'f_news', '11', 'insert', 'green', '2019-11-22 23:11:05'),
(169, NULL, 30, 'f_news', 'all', 'sort file', 'green', '2019-11-22 23:11:11'),
(170, NULL, 30, 'f_news', '11', 'delete', 'red', '2019-11-22 23:11:18'),
(171, NULL, 30, 'f_teams', '13', 'insert', 'green', '2019-11-22 23:20:21'),
(172, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:25:09'),
(173, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:25:19'),
(174, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:25:33'),
(175, NULL, 30, 'f_teams', '12', 'update', 'blue', '2019-11-22 23:26:18'),
(176, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:26:58'),
(177, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:29:01'),
(178, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:29:11'),
(179, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:29:16'),
(180, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-11-22 23:30:04'),
(181, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:31:32'),
(182, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:33:26'),
(183, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:36:51'),
(184, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:37:00'),
(185, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:37:43'),
(186, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:37:48'),
(187, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:40:33'),
(188, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:41:00'),
(189, NULL, 30, 'f_teams', '665', 'delete file id', 'red', '2019-11-22 23:41:07'),
(190, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:41:08'),
(191, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:41:19'),
(192, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:42:59'),
(193, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:43:07'),
(194, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:43:50'),
(195, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:44:12'),
(196, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:46:01'),
(197, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:46:58'),
(198, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:48:26'),
(199, NULL, 30, 'f_teams', '666', 'delete file id', 'red', '2019-11-22 23:48:38'),
(200, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:48:54'),
(201, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-11-22 23:48:59'),
(202, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:49:06'),
(203, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:49:12'),
(204, NULL, 30, 'f_teams', '13', 'archive', 'gray', '2019-11-22 23:49:18'),
(205, NULL, 30, 'f_teams', '13', 'remove from archive', 'gray', '2019-11-22 23:49:24'),
(206, NULL, 30, 'a_menu', '74', 'insert', 'green', '2019-11-22 23:51:11'),
(207, NULL, 30, 'a_menu', '74', 'delete', 'red', '2019-11-22 23:52:00'),
(208, NULL, 30, 'a_menu', '75', 'insert', 'green', '2019-11-22 23:52:18'),
(209, NULL, 30, 'f_packages', '1', 'insert', 'green', '2019-11-23 00:02:06'),
(210, NULL, 30, 'f_packages', '1', 'archive', 'gray', '2019-11-23 00:04:10'),
(211, NULL, 30, 'f_packages', '1', 'remove from archive', 'gray', '2019-11-23 00:04:42'),
(212, NULL, 30, 'f_packages', '1', 'update', 'blue', '2019-11-23 00:09:06'),
(213, NULL, 30, 'f_packages', '1', 'update', 'blue', '2019-11-23 00:09:12'),
(214, NULL, 30, 'f_packages', '1', 'archive', 'gray', '2019-11-23 00:09:18'),
(215, NULL, 30, 'f_packages', '1', 'remove from archive', 'gray', '2019-11-23 00:09:22'),
(216, NULL, 30, 'f_packages', '1', 'update', 'blue', '2019-11-23 00:09:27'),
(217, NULL, 30, 'f_packages', '1', 'update', 'blue', '2019-11-23 00:09:29'),
(218, NULL, 30, 'f_packages', '1', 'update', 'blue', '2019-11-23 00:09:30'),
(219, NULL, 30, 'f_packages', '1', 'delete', 'red', '2019-11-23 00:09:36'),
(220, NULL, 30, 'u_users', '15', 'archive', 'gray', '2019-11-23 11:25:53'),
(221, NULL, 30, 'u_users', '15', 'remove from archive', 'gray', '2019-11-23 11:26:05'),
(222, NULL, 30, 'u_users', '40', 'insert', 'green', '2019-11-23 11:26:24'),
(223, NULL, 30, 'u_users', '40', 'delete', 'red', '2019-11-23 11:26:28'),
(224, NULL, 30, 'pages', '2', 'archive', 'gray', '2019-11-23 11:46:55'),
(225, NULL, 30, 'pages', '2', 'remove from archive', 'gray', '2019-11-23 11:47:25'),
(226, NULL, 30, 'pages', '10', 'insert', 'green', '2019-11-23 11:47:35'),
(227, NULL, 30, 'pages', '10', 'delete', 'red', '2019-11-23 11:47:44'),
(228, NULL, 30, 'pages', '2', 'delete', 'red', '2019-11-23 11:47:45'),
(229, NULL, 30, 'f_teams', '14', 'insert', 'green', '2019-11-23 15:25:31'),
(230, NULL, 30, 'f_teams', '17', 'insert', 'green', '2019-11-23 15:30:51'),
(231, NULL, 30, 'f_teams', '17', 'update', 'blue', '2019-11-23 15:33:10'),
(232, NULL, 30, 'f_teams', '17', 'archive', 'gray', '2019-11-23 15:33:18'),
(233, NULL, 30, 'f_teams', '17', 'remove from archive', 'gray', '2019-11-23 15:33:24'),
(234, NULL, 30, 'f_news', '13', 'insert', 'green', '2019-11-23 15:34:26'),
(235, NULL, 30, 'f_packages', '2', 'insert', 'green', '2019-11-23 15:34:57'),
(236, NULL, 30, 'f_packages', '2', 'delete', 'red', '2019-11-23 15:35:04'),
(237, NULL, 30, 'f_news', '13', 'archive', 'gray', '2019-11-23 15:35:36'),
(238, NULL, 30, 'f_news', '13', 'delete', 'red', '2019-11-23 15:35:50'),
(239, NULL, 30, 'f_news', '14', 'insert', 'green', '2019-11-30 22:08:34'),
(240, NULL, 30, 'f_packages', '3', 'insert', 'green', '2019-11-30 22:12:58'),
(241, NULL, 30, 'f_packages', '4', 'insert', 'green', '2019-11-30 22:17:41'),
(242, NULL, 30, 'f_news', '14', 'update', 'blue', '2019-11-30 22:48:28'),
(243, NULL, 30, 'f_news', '14', 'update', 'blue', '2019-11-30 22:48:30'),
(244, NULL, 30, 'f_news', '14', 'update', 'blue', '2019-12-01 19:51:13'),
(245, NULL, 30, 'f_news', '12', 'update', 'blue', '2019-12-01 19:51:40'),
(246, NULL, 30, 'f_news', '14', 'update', 'blue', '2019-12-01 19:51:57'),
(247, NULL, 30, 'f_news', '14', 'archive', 'gray', '2019-12-01 19:52:10'),
(248, NULL, 30, 'f_news', '14', 'remove from archive', 'gray', '2019-12-01 19:52:15'),
(249, NULL, 30, 'f_packages', 'all', 'sort file', 'green', '2019-12-01 20:05:49'),
(250, NULL, 30, 'a_menu', '65', 'delete', 'red', '2019-12-01 20:06:18'),
(251, NULL, 30, 'a_menu', '76', 'insert', 'green', '2019-12-01 20:07:25'),
(252, NULL, 30, 'a_menu', 'all', 'sort file', 'green', '2019-12-01 20:07:57'),
(253, NULL, 30, 'a_docs', '92', 'delete', 'red', '2019-12-01 20:08:18'),
(254, NULL, 30, 'a_docs', '87', 'delete', 'red', '2019-12-01 20:08:20'),
(255, NULL, 30, 'a_docs', '86', 'delete', 'red', '2019-12-01 20:08:21'),
(256, NULL, 30, 'a_docs', '86', 'delete', 'red', '2019-12-01 20:08:22'),
(257, NULL, 30, 'a_docs', '77', 'delete', 'red', '2019-12-01 20:08:24'),
(258, NULL, 30, 'a_docs', '76', 'delete', 'red', '2019-12-01 20:08:26'),
(259, NULL, 30, 'a_docs', '75', 'delete', 'red', '2019-12-01 20:08:42'),
(260, NULL, 30, 'a_docs', '75', 'delete', 'red', '2019-12-01 20:08:43'),
(261, NULL, 30, 'a_docs', '74', 'delete', 'red', '2019-12-01 20:08:44'),
(262, NULL, 30, 'a_docs', '74', 'delete', 'red', '2019-12-01 20:08:46'),
(263, NULL, 30, 'a_docs', '73', 'delete', 'red', '2019-12-01 20:08:49'),
(264, NULL, 30, 'a_menu', '62', 'delete', 'red', '2019-12-01 20:09:16'),
(265, NULL, 30, 'a_menu', '15', 'delete', 'red', '2019-12-01 20:09:22'),
(266, NULL, 30, 'pages', '11', 'insert', 'green', '2019-12-01 20:17:17'),
(267, NULL, 30, 'pages', '1', 'delete', 'red', '2019-12-01 20:17:22'),
(268, NULL, 30, 'pages', '11', 'archive', 'gray', '2019-12-01 20:17:28'),
(269, NULL, 30, 'pages', '11', 'remove from archive', 'gray', '2019-12-01 20:17:33'),
(270, NULL, 30, 'a_menu', 'all', 'sort file', 'green', '2019-12-01 20:21:29'),
(271, NULL, 30, 'a_menu', 'all', 'sort file', 'green', '2019-12-01 20:21:50'),
(272, NULL, 30, 'f_forecasts', '2', 'insert', 'green', '2019-12-01 22:12:49'),
(273, NULL, 30, 'f_forecasts', '3', 'insert', 'green', '2019-12-01 22:13:17'),
(274, NULL, 30, 'f_forecasts', '3', 'delete', 'red', '2019-12-01 22:13:22'),
(275, NULL, 30, 'f_forecasts', '1', 'delete', 'red', '2019-12-01 22:19:58'),
(276, NULL, 30, 'f_leagues', '6', 'insert', 'green', '2019-12-01 22:20:20'),
(277, NULL, 30, 'f_forecasts', '4', 'insert', 'green', '2019-12-01 22:20:31'),
(278, NULL, 30, 'f_forecasts', '5', 'insert', 'green', '2019-12-01 22:47:57'),
(279, NULL, 30, 'f_forecasts', '6', 'insert', 'green', '2019-12-01 22:53:56'),
(280, NULL, 30, 'f_packages_options', '1', 'update', 'blue', '2019-12-02 18:03:47'),
(281, NULL, 30, 'f_packages_options', 'all', 'sort file', 'green', '2019-12-02 18:03:56'),
(282, NULL, 30, 'a_menu', '77', 'insert', 'green', '2019-12-02 18:05:57'),
(283, NULL, 30, 'a_menu', 'all', 'sort file', 'green', '2019-12-02 18:06:41'),
(284, NULL, 30, 'f_slider', '1', 'insert', 'green', '2019-12-02 18:41:26'),
(285, NULL, 30, 'f_leagues', '1', 'archive', 'gray', '2019-12-02 18:44:38'),
(286, NULL, 30, 'f_leagues', '1', 'archive', 'gray', '2019-12-02 18:44:44'),
(287, NULL, 30, 'f_slider', '1', 'archive', 'gray', '2019-12-02 18:45:31'),
(288, NULL, 30, 'f_slider', '1', 'remove from archive', 'gray', '2019-12-02 18:49:10'),
(289, NULL, 30, 'f_slider', '2', 'insert', 'green', '2019-12-02 18:49:31'),
(290, NULL, 30, 'f_slider', '3', 'insert', 'green', '2019-12-02 18:57:17'),
(291, NULL, 30, 'f_slider', '1', 'update', 'blue', '2019-12-02 19:06:03'),
(292, NULL, 30, 'f_slider', '1', 'update', 'blue', '2019-12-02 19:06:08'),
(293, NULL, 30, 'f_slider', '1', 'update', 'blue', '2019-12-02 19:06:22'),
(294, NULL, 30, 'f_forecasts', '7', 'insert', 'green', '2019-12-02 20:31:08'),
(295, NULL, 30, 'f_forecasts', '8', 'insert', 'green', '2019-12-02 20:34:14'),
(296, NULL, 30, 'f_forecasts_options', '1', 'insert', 'green', '2019-12-03 23:06:49'),
(297, NULL, 30, 'f_slider', '4', 'insert', 'green', '2019-12-03 23:13:45'),
(298, NULL, 30, 'f_slider', '5', 'insert', 'green', '2019-12-03 23:13:50'),
(299, NULL, 30, 'f_slider', '7', 'insert', 'green', '2019-12-03 23:15:06'),
(300, NULL, 30, 'f_slider', '8', 'insert', 'green', '2019-12-03 23:15:11'),
(301, NULL, 30, 'f_slider', '9', 'insert', 'green', '2019-12-03 23:16:41'),
(302, NULL, 30, 'a_menu', '75', 'update', 'blue', '2019-12-04 18:37:50'),
(303, NULL, 30, 'a_menu', '73', 'update', 'blue', '2019-12-04 18:38:03'),
(304, NULL, 30, 'a_menu', '72', 'update', 'blue', '2019-12-04 18:38:16'),
(305, NULL, 30, 'a_menu', '71', 'update', 'blue', '2019-12-04 18:38:40'),
(306, NULL, 30, 'a_menu', '70', 'update', 'blue', '2019-12-04 18:38:53'),
(307, NULL, 30, 'a_menu', '66', 'update', 'blue', '2019-12-04 18:39:09'),
(308, NULL, 30, 'a_menu', '61', 'update', 'blue', '2019-12-04 18:39:28'),
(309, NULL, 30, 'a_menu', '4', 'update', 'blue', '2019-12-04 18:39:41'),
(310, NULL, 30, 'a_menu', '2', 'update', 'blue', '2019-12-04 18:40:01'),
(311, NULL, 30, 'a_menu', '1', 'update', 'blue', '2019-12-04 18:40:10'),
(312, NULL, 30, 'a_menu', '34', 'update', 'blue', '2019-12-04 18:41:01'),
(313, NULL, 30, 'a_menu', '33', 'update', 'blue', '2019-12-04 18:41:31'),
(314, NULL, 25, 'f_leagues', '6', 'update', 'blue', '2019-12-04 21:00:40'),
(315, NULL, 25, 'f_leagues', '5', 'update', 'blue', '2019-12-04 21:01:02'),
(316, NULL, 30, 'f_forecasts_options', '1', 'update', 'blue', '2019-12-04 23:10:56'),
(317, NULL, 30, 'f_forecasts_options', '1', 'update', 'blue', '2019-12-04 23:15:26'),
(318, NULL, 30, 'f_forecasts', '2', 'delete', 'red', '2019-12-04 23:16:36'),
(319, NULL, 30, 'f_forecasts', '4', 'delete', 'red', '2019-12-04 23:16:37'),
(320, NULL, 30, 'f_forecasts', '5', 'delete', 'red', '2019-12-04 23:16:39'),
(321, NULL, 30, 'f_forecasts_options', '2', 'insert', 'green', '2019-12-04 23:19:48'),
(322, NULL, 30, 'f_forecasts', '6', 'update', 'blue', '2019-12-04 23:20:15'),
(323, NULL, 30, 'f_forecasts_options', '3', 'insert', 'green', '2019-12-04 23:20:29'),
(324, NULL, 30, 'f_forecasts_options', '1', 'update', 'blue', '2019-12-04 23:37:54'),
(325, NULL, 30, 'f_forecasts', '8', 'update', 'blue', '2019-12-04 23:41:53'),
(326, NULL, 30, 'f_forecasts_options', '1', 'update', 'blue', '2019-12-04 23:55:43'),
(327, NULL, 30, 'f_forecasts_options', '4', 'insert', 'green', '2019-12-04 23:58:14'),
(328, NULL, 30, 'f_forecasts', '8', 'delete', 'red', '2019-12-05 00:06:09'),
(329, NULL, 30, 'f_forecasts', '6', 'update', 'blue', '2019-12-05 00:06:17'),
(330, NULL, 30, 'f_forecasts_options', '3', 'update', 'blue', '2019-12-05 00:09:19'),
(331, NULL, 30, 'f_forecasts_options', '5', 'insert', 'green', '2019-12-05 00:09:44'),
(332, NULL, 30, 'f_forecasts_options', 'all', 'sort file', 'green', '2019-12-05 00:09:48'),
(333, NULL, 30, 'f_forecasts_options', '5', 'update', 'blue', '2019-12-05 00:10:02'),
(334, NULL, 30, 'f_forecasts_options', '5', 'update', 'blue', '2019-12-05 00:10:11'),
(335, NULL, 30, 'f_forecasts_options', '5', 'update', 'blue', '2019-12-05 00:10:26'),
(336, NULL, 30, 'f_forecasts_options', 'all', 'sort file', 'green', '2019-12-05 00:10:33'),
(337, NULL, 30, 'f_forecasts_options', 'all', 'sort file', 'green', '2019-12-05 00:10:38'),
(338, NULL, 30, 'f_forecasts', '6', 'update', 'blue', '2019-12-05 00:22:43'),
(339, NULL, 30, 'f_forecasts', '9', 'insert', 'green', '2019-12-05 00:23:02'),
(340, NULL, 30, 'f_slider', '10', 'insert', 'green', '2019-12-05 18:25:34'),
(341, NULL, 30, 'f_forecasts', '10', 'insert', 'green', '2019-12-05 19:01:19'),
(342, NULL, 30, 'f_forecasts', '11', 'insert', 'green', '2019-12-05 19:07:27'),
(343, NULL, 30, 'f_forecasts', '11', 'delete', 'red', '2019-12-05 19:08:11'),
(344, NULL, 30, 'f_forecasts', '6', 'delete', 'red', '2019-12-05 19:08:12'),
(345, NULL, 30, 'f_forecasts', '10', 'delete', 'red', '2019-12-05 19:08:14'),
(346, NULL, 30, 'f_forecasts', '12', 'insert', 'green', '2019-12-05 19:08:44'),
(347, NULL, 30, 'a_menu', '76', 'delete', 'red', '2019-12-05 19:13:22'),
(348, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-05 19:17:04'),
(349, NULL, 30, 'f_forecasts', '13', 'insert', 'green', '2019-12-05 19:19:03'),
(350, NULL, 30, 'a_menu', '78', 'insert', 'green', '2019-12-05 21:03:17'),
(351, NULL, 30, 'a_menu', 'all', 'sort file', 'green', '2019-12-05 21:03:33'),
(352, NULL, 30, 'f_contacts', '3', 'update', 'blue', '2019-12-05 21:09:07'),
(353, NULL, 30, 'f_slider', '8', 'delete', 'red', '2019-12-07 18:19:18'),
(354, NULL, 30, 'f_slider', '7', 'delete', 'red', '2019-12-07 18:19:20'),
(355, NULL, 30, 'f_slider', '10', 'update', 'blue', '2019-12-07 18:19:23'),
(356, NULL, 30, 'f_slider', '10', 'update', 'blue', '2019-12-07 18:19:30'),
(357, NULL, 30, 'f_slider', '10', 'update', 'blue', '2019-12-07 18:19:37'),
(358, NULL, 30, 'f_slider', '9', 'update', 'blue', '2019-12-07 18:19:50'),
(359, NULL, 30, 'f_slider', '9', 'update', 'blue', '2019-12-07 18:23:03'),
(360, NULL, 30, 'f_slider', '1', 'update', 'blue', '2019-12-07 18:36:56'),
(361, NULL, 30, 'f_slider', '9', 'update', 'blue', '2019-12-07 18:37:14'),
(362, NULL, 30, 'f_slider', '9', 'update', 'blue', '2019-12-07 18:37:33'),
(363, NULL, 30, 'f_slider', '10', 'update', 'blue', '2019-12-07 18:38:51'),
(364, NULL, 30, 'f_forecasts', '9', 'delete', 'red', '2019-12-07 19:01:55'),
(365, NULL, 30, 'f_leagues', '7', 'insert', 'green', '2019-12-07 19:02:39'),
(366, NULL, 30, 'f_news', '10', 'update', 'blue', '2019-12-08 16:28:45'),
(367, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-12-08 16:38:49'),
(368, NULL, 30, 'f_teams', '13', 'update', 'blue', '2019-12-08 16:45:55'),
(369, NULL, 30, 'f_teams', '16', 'update', 'blue', '2019-12-08 16:58:13'),
(370, NULL, 30, 'f_teams', '16', 'update', 'blue', '2019-12-08 17:05:39'),
(371, NULL, 30, 'f_teams', '16', 'update', 'blue', '2019-12-08 17:05:43'),
(372, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:37:06'),
(373, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:39:42'),
(374, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:40:11'),
(375, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:40:21'),
(376, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-08 17:42:15'),
(377, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-08 17:42:19'),
(378, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-08 17:43:05'),
(379, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-08 17:43:13'),
(380, NULL, 30, 'f_forecasts', '12', 'update', 'blue', '2019-12-08 17:43:21'),
(381, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:44:13'),
(382, NULL, 30, 'f_forecasts', '14', 'insert', 'green', '2019-12-08 17:49:45'),
(383, NULL, 30, 'f_forecasts', '14', 'archive', 'gray', '2019-12-08 17:53:01'),
(384, NULL, 30, 'f_forecasts', '14', 'remove from archive', 'gray', '2019-12-08 17:53:28'),
(385, NULL, 30, 'f_forecasts', '13', 'update', 'blue', '2019-12-08 17:55:14'),
(386, NULL, 30, 'f_forecasts', '14', 'update', 'blue', '2019-12-08 17:59:11'),
(387, NULL, 30, 'f_news', '12', 'update', 'blue', '2019-12-08 18:05:27'),
(388, NULL, 30, 'f_forecasts', '15', 'update', 'blue', '2019-12-09 17:41:33'),
(389, NULL, 30, 'f_forecasts_options', '7', 'insert', 'green', '2019-12-09 17:45:51'),
(390, NULL, 30, 'f_forecasts', '14', 'update', 'blue', '2019-12-09 18:23:14'),
(391, NULL, 30, 'f_forecasts', '14', 'update', 'blue', '2019-12-09 18:23:31'),
(392, NULL, 30, 'f_forecasts', '15', 'update', 'blue', '2019-12-09 18:24:49'),
(393, NULL, 30, 'f_forecasts', '15', 'update', 'blue', '2019-12-09 18:24:59'),
(394, NULL, 30, 'f_forecasts', '14', 'update', 'blue', '2019-12-09 18:25:54'),
(395, NULL, 25, 'pages', '12', 'insert', 'green', '2019-12-10 05:50:31'),
(396, NULL, 25, 'pages', '12', 'update', 'blue', '2019-12-10 05:53:34'),
(397, NULL, 25, 'notifications', 'all', 'Notification cleared', 'green', '2019-12-10 06:07:07'),
(398, NULL, 25, 'a_admins', '29', 'delete', 'red', '2019-12-10 06:07:16'),
(399, NULL, 25, 'a_admins', '28', 'delete', 'red', '2019-12-10 06:07:22'),
(400, NULL, 25, 'a_admins', '23', 'delete', 'red', '2019-12-10 06:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `message` text,
  `link` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '	seen/archive	',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `subject`, `message`, `link`, `date`, `status`) VALUES
(22, 'New admin', 'Hakob Karapetyan, hakob.karapetyan2372004@gmail.com', 'view_profile?id=30', '2019-11-20 19:01:00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `title_ru` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `descr_ru` text NOT NULL,
  `descr_en` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `filename`, `icon`, `title_ru`, `title_en`, `descr_ru`, `descr_en`, `date`, `status`, `sort`) VALUES
(11, 'about', '', 'О нас', 'About us', '&lt;p&gt;fsdgdhjk&lt;/p&gt;', '&lt;p&gt;adsfgfhgjk&lt;/p&gt;', '2019-12-01 20:17:17', '1', 0),
(12, 'terms', '', 'Политика конфиденциальности', 'Terms', '&lt;p&gt;...&lt;/p&gt;', '&lt;p&gt;...&lt;/p&gt;', '2019-12-10 05:50:31', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_networks`
--

DROP TABLE IF EXISTS `social_networks`;
CREATE TABLE IF NOT EXISTS `social_networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `descr` text,
  `icon` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_networks`
--

INSERT INTO `social_networks` (`id`, `title`, `descr`, `icon`, `link`, `status`, `date`, `sort`) VALUES
(1, 'Facebook', 'Facebook, Inc. is an American online social media and social networking service company based in Menlo Park, California.\r\n\r\nIt was founded by Mark Zuckerberg, along with fellow Harvard College students and roommates Eduardo Saverin, Andrew McCollum, Dustin Moskovitz, and Chris Hughes.\r\n\r\nIt is considered one of the Big Four technology companies along with Amazon, Apple, and Google.', 'facebook', 'https://www.facebook.com/', '1', '2019-04-02 16:49:00', 0),
(2, 'Instagram', '', 'instagram', 'http://www.instagram.com', '1', '2019-04-02 17:21:43', 3),
(3, 'Github', '', 'github', 'https://github.com', '1', '2019-04-02 17:30:10', 6),
(4, 'Behance', '', 'behance', 'behance', '1', '2019-04-02 19:39:56', 5),
(5, 'Twitter', '', 'twitter', 'twitter', '1', '2019-04-02 21:22:52', 2),
(6, 'YouTube', '', 'youtube', 'https://youtube.com', '1', '2019-04-04 00:40:26', 4),
(7, 'LinkedIn', '', 'linkedin', 'https://linkedin.com', '1', '2019-04-04 00:40:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `u_users`
--

DROP TABLE IF EXISTS `u_users`;
CREATE TABLE IF NOT EXISTS `u_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `u_social_links` text,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `notes` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT 'new user/active/archive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `u_users`
--

INSERT INTO `u_users` (`id`, `name`, `u_social_links`, `email`, `phone`, `notes`, `date`, `status`) VALUES
(15, 'Garsevan', '{\"1\":\"https:\\/\\/www.facebook.com\\/artyom.belluyan.1\",\"2\":\"https:\\/\\/www.instagram.com\\/artyom_belluyan\"}', 'mysuperemail@gmail.com', '+374000000', 'This user is very important.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-04-30 18:00:51', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
