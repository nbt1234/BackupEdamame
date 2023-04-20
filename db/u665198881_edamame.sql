-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2023 at 05:09 AM
-- Server version: 10.6.11-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u665198881_edamame`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(250) NOT NULL COMMENT 'password should be md5()'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'meetdate@gmail.com', 'c93ccd78b2076528346216b3b2f701e6');

-- --------------------------------------------------------

--
-- Table structure for table `elr_api_token`
--

CREATE TABLE `elr_api_token` (
  `ID` int(11) NOT NULL,
  `user_identity` int(11) NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` int(11) NOT NULL,
  `is_private_key` int(11) NOT NULL,
  `ip_addresses` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elr_api_token`
--

INSERT INTO `elr_api_token` (`ID`, `user_identity`, `api_token`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, '6zW5KVCEBZ7fdQRoGsU0meJL1xpgl2D8SM9tAkq4', 0, 0, 0, '', '2021-01-21 10:59:30'),
(14, 38, 'Jz2ulo7typXdnrQaA6MCHjP5iIGBmD1KsFf', 0, 0, 0, '::1', '2021-01-21 12:17:33'),
(21, 72, 'kK1I3fwGjhlSCcXY0TdtFpEzNrxuiQemUqR', 0, 0, 0, '::1', '2021-02-24 11:10:33'),
(22, 73, 'LubgiQxhWnUdkEMq1VFPRZAG80vHJomIeCr', 0, 0, 0, '::1', '2021-03-03 10:31:58'),
(23, 74, 'yHW8rERuYba6U9X5JeKBMgxZTInViAlwG1o', 0, 0, 0, '::1', '2021-03-20 11:45:09'),
(24, 75, '7IXLwA8fZ2WkvpYMDm4ljCnyVsbhoia0EcP', 0, 0, 0, '::1', '2021-03-20 11:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `elr_coupon`
--

CREATE TABLE `elr_coupon` (
  `ID` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `limit_count` int(11) NOT NULL,
  `no_of_users` int(11) NOT NULL,
  `dis_type` int(11) NOT NULL COMMENT 'Flat=0 \r\npercentage=1',
  `status` int(11) NOT NULL COMMENT '0 = Active, 1 = Inactive',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_coupon_used`
--

CREATE TABLE `elr_coupon_used` (
  `ID` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_default_nicotine`
--

CREATE TABLE `elr_default_nicotine` (
  `ID` int(11) NOT NULL,
  `base_nic` varchar(255) NOT NULL,
  `vg_perc` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_email_settings`
--

CREATE TABLE `elr_email_settings` (
  `ID` int(11) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = active, 1 = inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elr_email_settings`
--

INSERT INTO `elr_email_settings` (`ID`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `email`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ssl://smtp.gmail.com', '465', 'testdemo199000@gmail.com', 'Nbt@1234@#', '', 'asda', 'smtp', 1, '2021-02-23 14:08:32', '2021-02-27 09:48:14'),
(2, '', '', '', '', 'cyrax@gmail.com', 'cyrax', 'server', 0, '2021-02-23 14:08:32', '2021-02-27 05:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `elr_faq`
--

CREATE TABLE `elr_faq` (
  `ID` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Active, 1 = Inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_follow`
--

CREATE TABLE `elr_follow` (
  `ID` bigint(15) NOT NULL,
  `follower_id` bigint(1) NOT NULL,
  `seller_id` bigint(15) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_banner`
--

CREATE TABLE `elr_home_banner` (
  `ID` int(11) NOT NULL,
  `img_name` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_category`
--

CREATE TABLE `elr_home_category` (
  `ID` int(11) NOT NULL,
  `data` text NOT NULL,
  `type` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_contact`
--

CREATE TABLE `elr_home_contact` (
  `ID` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_newsletter`
--

CREATE TABLE `elr_home_newsletter` (
  `ID` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_services`
--

CREATE TABLE `elr_home_services` (
  `ID` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_home_social_links`
--

CREATE TABLE `elr_home_social_links` (
  `ID` int(11) NOT NULL,
  `link` text NOT NULL,
  `type` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_likes`
--

CREATE TABLE `elr_likes` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `recipe_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_other_pages`
--

CREATE TABLE `elr_other_pages` (
  `ID` int(11) NOT NULL,
  `heading` text NOT NULL,
  `content` longtext NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_payment_mode`
--

CREATE TABLE `elr_payment_mode` (
  `ID` int(11) NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Test, 1 = Live',
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_payment_status`
--

CREATE TABLE `elr_payment_status` (
  `ID` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '	0 = Active, 1 = Inactive	',
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_questions`
--

CREATE TABLE `elr_questions` (
  `id` int(11) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `q5` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_roles`
--

CREATE TABLE `elr_roles` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elr_roles`
--

INSERT INTO `elr_roles` (`ID`, `name`, `role_status`) VALUES
(1, 'admin', 1),
(2, 'subadmin', 2),
(3, 'users', 3);

-- --------------------------------------------------------

--
-- Table structure for table `elr_subadmin_access`
--

CREATE TABLE `elr_subadmin_access` (
  `ID` int(11) NOT NULL,
  `subadmin` int(11) NOT NULL,
  `access_fields` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_users`
--

CREATE TABLE `elr_users` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dec_password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `bio` text NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `role_status` int(11) NOT NULL,
  `forget_key` varchar(11) NOT NULL,
  `expire_forget_key` datetime NOT NULL,
  `user_status` int(11) NOT NULL COMMENT '0 = Active, 1 = Inactive',
  `login_status` int(11) NOT NULL COMMENT '0 = Active, 1 = Inactive',
  `user_block_status` int(11) NOT NULL COMMENT '0 = Active, 1 = Inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elr_users`
--

INSERT INTO `elr_users` (`ID`, `email`, `password`, `dec_password`, `username`, `mobile`, `avatar`, `bio`, `google_id`, `fb_id`, `role_status`, `forget_key`, `expire_forget_key`, `user_status`, `login_status`, `user_block_status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$PJS.t/o2XQ2exyPtJ4qhUe5iz5DR8YwuXrFD9dOp2cFRtOyHs2xHe', '12345678', 'Admin', '9876543210', '', '', '', '', 1, '245873', '2021-09-29 07:34:46', 0, 0, 0, '2021-01-18 16:17:23', '2021-07-16 05:04:07'),
(70, 'sub@gmail.com', '$2y$10$w1Z6hqtRn.qZaVFJcuQiieFc1ITcCxg5fcBH2b1O.SiNCbX3OwxLO', '', 'Sub', '9876543210', '', '', '', '', 2, '', '0000-00-00 00:00:00', 0, 0, 0, '2021-01-28 12:56:57', '2021-02-02 12:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `elr_user_address`
--

CREATE TABLE `elr_user_address` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_user_setting`
--

CREATE TABLE `elr_user_setting` (
  `ID` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `default_target_nicotine_amount` varchar(20) NOT NULL,
  `nic_type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_vendor`
--

CREATE TABLE `elr_vendor` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(191) NOT NULL,
  `tag_name` varchar(191) NOT NULL,
  `tag_color` varchar(191) NOT NULL,
  `vendor_image` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Active, 1 =Inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flag_user`
--

CREATE TABLE `flag_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `flag_by` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flag_user`
--

INSERT INTO `flag_user` (`id`, `user_id`, `flag_by`) VALUES
(36, '192', '185'),
(35, '190', '185'),
(34, '189', '185'),
(33, '188', '185'),
(32, '187', '185'),
(31, '186', '185'),
(30, '184', '185'),
(29, '183', '185'),
(28, '181', '185'),
(27, '185', '185'),
(26, '151', '185'),
(38, '194', '185'),
(37, '193', '185'),
(39, '195', '185'),
(40, '196', '185'),
(41, '197', '185'),
(42, '198', '185'),
(43, '210', '210');

-- --------------------------------------------------------

--
-- Table structure for table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `id` int(11) NOT NULL,
  `action_profile` varchar(250) NOT NULL,
  `effect_profile` varchar(250) NOT NULL,
  `action_type` varchar(250) NOT NULL,
  `match_profile` varchar(200) NOT NULL DEFAULT 'false',
  `effected` varchar(200) NOT NULL DEFAULT 'true',
  `chat` varchar(50) NOT NULL DEFAULT 'false',
  `feedback` int(1) NOT NULL COMMENT '0=on start chat 1=never feedback 2=done feedback	',
  `feedback_review` text NOT NULL,
  `feedback_rating` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_msg_time_updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `like_unlike`
--

INSERT INTO `like_unlike` (`id`, `action_profile`, `effect_profile`, `action_type`, `match_profile`, `effected`, `chat`, `feedback`, `feedback_review`, `feedback_rating`, `created_at`, `updated_at`, `last_msg_time_updated`) VALUES
(567, '185', '189', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 09:02:14', '2021-11-26 09:02:14', '0000-00-00 00:00:00'),
(566, '185', '190', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 09:01:04', '2021-11-26 09:01:04', '0000-00-00 00:00:00'),
(565, '185', '192', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 08:59:02', '2021-11-26 08:59:02', '0000-00-00 00:00:00'),
(564, '192', '185', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 06:42:27', '2021-11-26 08:59:02', '0000-00-00 00:00:00'),
(563, '190', '185', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 06:42:13', '2021-11-26 09:01:04', '0000-00-00 00:00:00'),
(562, '189', '185', 'like', 'true', 'true', 'false', 0, '', '', '2021-11-26 06:41:26', '2021-11-26 09:02:14', '0000-00-00 00:00:00'),
(561, '188', '185', 'like', 'false', 'true', 'false', 0, '', '', '2021-11-26 06:41:21', '2021-11-26 06:41:21', '0000-00-00 00:00:00'),
(560, '187', '185', 'like', 'false', 'true', 'false', 0, '', '', '2021-11-26 06:41:10', '2021-11-26 06:41:10', '0000-00-00 00:00:00'),
(559, '186', '185', 'like', 'false', 'true', 'false', 0, '', '', '2021-11-26 06:41:00', '2021-11-26 06:41:00', '0000-00-00 00:00:00'),
(557, '155', '159', 'like', 'true', 'true', 'true', 2, 'vnfg hftg f ', '4', '2021-10-20 06:44:01', '2021-11-26 06:00:14', '0000-00-00 00:00:00'),
(556, '155', '158', 'like', 'true', 'true', 'true', 2, 'gfr e g    fds gsg', '3', '2021-10-20 06:41:15', '2021-10-20 06:42:36', '0000-00-00 00:00:00'),
(555, '155', '157', 'like', 'true', 'true', 'true', 2, 'fdfgdfgfdbfd sd gdffg', '4', '2021-10-20 06:41:15', '2021-10-20 06:42:36', '0000-00-00 00:00:00'),
(554, '155', '166', 'like', 'true', 'true', 'true', 2, 'dfgfdg  rfger er fgerg ', '3', '2021-10-20 06:21:56', '2021-10-20 06:21:56', '0000-00-00 00:00:00'),
(553, '166', '155', 'like', 'true', 'true', 'true', 2, 'hgn gfghgf  gnfghfgg    gfhfhhgfh    gbfg ', '2', '2021-10-20 06:21:56', '2021-10-20 06:21:56', '0000-00-00 00:00:00'),
(552, '155', '156', 'like', 'false', 'true', 'true', 0, 'jgjhgjgjgfjghjgh', '3', '2021-10-20 05:13:58', '2021-10-20 06:19:03', '0000-00-00 00:00:00'),
(551, '156', '155', 'like', 'false', 'true', 'true', 0, 'dfgg fvbgfhfghfghfgh rfthrtfgh', '5', '2021-10-20 05:13:58', '2021-10-20 06:18:57', '0000-00-00 00:00:00'),
(550, '160', '155', 'like', 'true', 'true', 'true', 0, '', '', '2021-10-19 11:53:05', '2021-10-19 13:31:35', '0000-00-00 00:00:00'),
(549, '155', '160', 'like', 'true', 'true', 'true', 0, '', '', '2021-10-19 11:52:59', '2021-10-19 13:31:39', '0000-00-00 00:00:00'),
(548, '158', '155', 'like', 'true', 'true', 'true', 2, 'bbbbbbbbbb', '4', '2021-10-19 11:52:53', '2021-10-21 10:03:14', '0000-00-00 00:00:00'),
(547, '159', '155', 'like', 'true', 'true', 'true', 2, 'aaaaaa', '5', '2021-10-19 11:52:29', '2021-10-20 06:50:41', '0000-00-00 00:00:00'),
(546, '157', '155', 'like', 'true', 'true', 'true', 2, 'fghhhhgfff', '4', '2021-10-19 11:37:06', '2021-10-20 06:46:37', '0000-00-00 00:00:00'),
(545, '156', '185', 'like', 'true', 'true', 'false', 0, '', '', '2021-10-19 08:29:04', '2021-10-20 05:28:33', '0000-00-00 00:00:00'),
(544, '155', '167', 'like', 'false', 'true', 'false', 0, '', '', '2021-10-19 08:28:58', '2021-10-19 13:32:09', '0000-00-00 00:00:00'),
(543, '171', '185', 'like', 'false', 'true', 'true', 0, '', '', '2021-10-19 06:11:27', '2021-11-26 05:15:56', '0000-00-00 00:00:00'),
(542, '185', '156', 'like', 'true', 'true', 'true', 1, '', '', '2021-10-19 06:11:09', '2021-10-20 05:28:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `social_type` varchar(255) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `first_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `industry` varchar(255) NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `birthday` varchar(150) NOT NULL DEFAULT '0',
  `age` int(11) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `interest` varchar(150) NOT NULL,
  `lat_long` varchar(50) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `positions` tinytext NOT NULL,
  `summary` text NOT NULL,
  `educations` text NOT NULL,
  `basic_info` text NOT NULL,
  `height` varchar(10) NOT NULL,
  `relationship_type` text NOT NULL,
  `mbti` text NOT NULL,
  `star_sign` text NOT NULL,
  `political_view` text NOT NULL,
  `religion` varchar(255) NOT NULL,
  `exercise` varchar(255) NOT NULL,
  `drinking` varchar(255) NOT NULL,
  `smoking` varchar(255) NOT NULL,
  `profile_url` varchar(255) NOT NULL,
  `image1` varchar(250) NOT NULL,
  `image2` varchar(250) NOT NULL,
  `image3` varchar(250) NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT 0,
  `dislike_count` int(11) NOT NULL DEFAULT 0,
  `hide_me` int(11) NOT NULL DEFAULT 0 COMMENT '0 =  show me   1 = hide me',
  `block` varchar(100) NOT NULL DEFAULT '0',
  `version` varchar(15) DEFAULT '0',
  `device` varchar(25) NOT NULL,
  `profile_type` varchar(20) NOT NULL DEFAULT 'user',
  `device_token` varchar(500) NOT NULL,
  `hide_age` int(11) NOT NULL DEFAULT 0 COMMENT '0=show my age  1=not show my age',
  `hide_location` int(11) NOT NULL DEFAULT 0 COMMENT '0=show my location 1=not show my location',
  `hide_birthday` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_position` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_education` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_height` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_industry` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_gender` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_interest` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_basic_info` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_relationship_type` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_mbti` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_star_sign` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_political_view` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_religion` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_excercise` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_drinking` int(1) DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_smoking` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `hide_profile_url` int(1) NOT NULL DEFAULT 0 COMMENT '0=show 1=not show	',
  `created` datetime NOT NULL DEFAULT current_timestamp() COMMENT '	',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '	'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `social_type`, `social_id`, `first_name`, `industry`, `last_name`, `email`, `last_seen`, `birthday`, `age`, `gender`, `interest`, `lat_long`, `lat`, `long`, `positions`, `summary`, `educations`, `basic_info`, `height`, `relationship_type`, `mbti`, `star_sign`, `political_view`, `religion`, `exercise`, `drinking`, `smoking`, `profile_url`, `image1`, `image2`, `image3`, `like_count`, `dislike_count`, `hide_me`, `block`, `version`, `device`, `profile_type`, `device_token`, `hide_age`, `hide_location`, `hide_birthday`, `hide_position`, `hide_education`, `hide_height`, `hide_industry`, `hide_gender`, `hide_interest`, `hide_basic_info`, `hide_relationship_type`, `hide_mbti`, `hide_star_sign`, `hide_political_view`, `hide_religion`, `hide_excercise`, `hide_drinking`, `hide_smoking`, `hide_profile_url`, `created`, `updated_at`) VALUES
(149, 'linkedin', '5001', 'reena', 'Creative arts adn design', 'soni', 'reena@gmail.com', '2021-12-04 11:20:53', '01/01/2001', 20, 'female', 'male', '26.7751,75.8514', '26.7751', '75.8514', 'Developer', 'I am flexible, reliable and possess excellent time keeping skills. I am an enthusiastic, self-motivated, reliable, responsible and hard working person. I am a mature team worker and adaptable to all challenging situations. I am able to work well both in a team environment as well as using own initiative.', 'Bachelor of Computer Applications', 'Since a biodata typically profiles a person, it is necessary to provide your date of birth too. In some selection processes involving the use of biodata', '54', 'relationship', 'ISTP', 'Aquarius', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', 'http://www.linkedin.com/in/christinehueber', '62153-1631962504_image1.jpg', '', '24517-1631962504_image3.jpg', 0, 0, 0, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 10:55:04', '2021-12-04 11:20:53'),
(147, 'linkedin', '5464', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-09-21 04:49:20', '01/01/2001', 20, 'male', '', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', '', '54', 'relationship_type', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '81742-1631962087_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 10:48:07', '2021-09-21 04:49:20'),
(148, 'linkedin', '5000', 'leena', '', 'soni', 'leena@gmail.com', '2021-09-21 04:49:25', '01/01/2001', 20, 'female', '', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '09625-1631962358_image1.jpg', '02697-1631962358_image2.jpg', '89406-1631962358_image3.jpg', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 10:52:38', '2021-09-21 04:49:25'),
(150, 'linkedin', '5002', 'abhi', '', 'soni', 'abhi@gmail.com', '2021-09-28 12:33:35', '01/01/2001', 20, 'female', '', '26.7751,75.8514', '26.7751', '75.8514', 'positions', 'summary', 'educations', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '36147-1631967234_image1.jpg', '85739-1631967234_image2.jpg', '45680-1631967234_image3.jpg', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 12:13:54', '2021-09-28 12:33:35'),
(151, 'linkedin', '118', 'ggh', '', 'vvb', 'nbt.tanvi@gmail.com', '2021-10-21 09:43:28', '01/01/2001', 20, 'Man', '', '26.9661385,75.7719305', '26.9661385', '75.7719305', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '', '39280-1631968330_image2.jpg', '', 0, 0, 1, '0', '9', 'android', 'user', 'eNdM6xNsQd6LXBbeu_i7Wt:APA91bFQr3QsxisKTRkCHmu5VjQ7zkczEkgKS6VL1qML-5qW_E3oz8bUI0HEFMPHYQdM3V7L9tj1P4iEYrb03v-aOYTKz76a9x42QYdPWgMsZ6e5J1DDPdZT-ioylFfa04QTV8KKg2xD', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 12:32:11', '2021-10-21 09:43:28'),
(152, 'linkedin', '119', 'asha', '', 'negi', 'nbt.tanvi@gmail.com', '2021-09-18 12:44:36', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '82647-1631969074_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 12:44:36', '2021-09-18 12:44:36'),
(153, 'linkedin', '120', 'pooja', '', 'panchal', 'nbt.tanvi@gmail.com', '2021-09-18 12:49:58', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '48039-1631969394_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 12:49:58', '2021-09-18 12:49:58'),
(154, 'linkedin', '121', 'bhawna', 'Law', '', 'nbt.tanvi@gmail.com', '2022-01-28 12:41:42', '06/01/2006', 15, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', '', 'Btech', '', '129', 'Strictly Platonic', 'ISTP', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Socially', 'Frequently', 'https://www.linkedin.com/', '', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'fROoswJEuk-Bp173QaKURw:APA91bH1DpkeUZnNh9k6n6HZHvOpZp9zQ_DRbzx443ElirvGZNu_KA6wWvyGHf0cpOM3mSz2j09qyhnzGvhOIjw2jsuB7qRI4CleMMzxn35pyPgSR63obGClH-em8WMLa7zsJlnkCFid', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 12:58:37', '2022-01-28 12:41:42'),
(155, 'linkedin', '122', 'tony', '', 'kakkar', 'nbt.tanvi@gmail.com', '2021-10-20 07:00:43', '01/01/2001', 20, 'Man', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '83014-1631970614_image1.jpg', '', '', 0, 0, 0, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 13:10:14', '2021-10-20 07:00:43'),
(156, 'linkedin', '123', 'neha', '', 'kakkar', 'nbt.tanvi@gmail.com', '2021-09-28 09:11:47', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '83051-1631970939_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', 'dTlIMHJzTcG_AntGbWW2zA:APA91bEpMttZewlkuSUr9YwZn9k4kcPtiGK04o-M4gcpTJmtMyGjEoawku4AI7phRXXB1OmgfNz82XC72pFsNLg3GqE2y9KJ4ovgnrMC9CGDGUmgyZlTKFYzh5_KB8-k7lNezPGCLBPv', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 13:15:40', '2021-09-28 09:11:47'),
(157, 'linkedin', '124', 'sonam', '', 'kapoor', 'nbt.tanvi@gmail.com', '2021-09-18 13:22:07', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Frequently', 'Never', '', '38046-1631971326_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-18 13:22:07', '2021-09-18 13:22:07'),
(158, 'linkedin', '125', 'abhi', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 05:36:51', '01/01/2001', 20, 'Man', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'fun luving', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '', '51672-1632116210_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 05:36:51', '2021-09-20 05:36:51'),
(159, 'linkedin', '126', 'geeta', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 06:10:52', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'aaaaa', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '87561-1632118251_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 06:10:52', '2021-09-20 06:10:52'),
(160, 'linkedin', '127', 'ankit', '', 'mali', 'nbt.tanvi@gmail.com', '2021-10-19 13:28:36', '01/01/2001', 20, 'Man', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'cnnn', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '62390-1632120325_image1.jpg', '', '', 0, 0, 0, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 06:45:28', '2021-10-19 13:28:36'),
(161, 'linkedin', '128', 'ttaaaa', '', '', 'nbt.tanvi@gmail.com', '2021-10-13 11:00:32', '01/01/2001', 20, 'female', '', '8.1697511,39.8994659', '8.1697511', '39.8994659', '', '', '', '', '1.5', 'looking_for', 'mbti', 'star_sign', 'politics', 'religion', 'exercise', 'drinking', 'smoking', '', '69123-1632120809_image1.jpg', '', '', 0, 0, 0, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 06:53:29', '2021-10-13 11:00:32'),
(162, 'linkedin', '129', 'akash', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 06:57:58', '01/01/2001', 20, 'Man', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '41620-1632121076_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 06:57:58', '2021-09-20 06:57:58'),
(163, 'linkedin', '130', 'sonam', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 11:36:30', '01/01/2001', 20, 'Woman', '', '26.7751,9.75.8514', '26.7751', '9.75.8514', 'engineer', 'fun luving', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Almost never', 'Never', 'Never', '', '53018-1632121436_image1.jpg', '', '', 0, 0, 0, '0', '', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 07:03:57', '2021-09-20 11:36:30'),
(164, 'linkedin', '131', 'akansha', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 07:12:29', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'self motivated', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '82167-1632121946_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 07:12:29', '2021-09-20 07:12:29'),
(165, 'linkedin', '132', 'nisha', '', 'saini', 'nbt.tanvi@gmail.com', '2021-10-20 05:57:49', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '29014-1632122295_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 07:18:18', '2021-10-20 05:57:49'),
(166, 'linkedin', '133', 'kiyara', '', 'aadwani', 'nbt.tanvi@gmail.com', '2021-09-20 07:26:27', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '60734-1632122786_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 07:26:27', '2021-09-20 07:26:27'),
(167, 'linkedin', '134', 'pooja', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-20 07:30:21', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '98632-1632123020_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 07:30:21', '2021-09-20 07:30:21'),
(168, 'linkedin', '135', 'sakshi', '', 'solanki', 'nbt.tanvi@gmail.com', '2021-09-20 08:22:36', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '140', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '16094-1632126153_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 08:22:36', '2021-09-20 08:22:36'),
(169, 'linkedin', '136', 'renu', '', 'kumawat', 'nbt.tanvi@gmail.com', '2021-09-20 08:34:10', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Apolitical', 'Agnostic', 'Almost never', 'Never', 'Never', '', '07834-1632126847_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 08:34:10', '2021-09-20 08:34:10'),
(170, 'linkedin', '137', 'malika', '', 'kumawat', 'nbt.tanvi@gmail.com', '2021-09-20 09:01:47', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '30417-1632128502_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 09:01:47', '2021-09-20 09:01:47'),
(171, 'linkedin', '138', 'ram', '', 'nehlani', 'nbt.tanvi@gmail.com', '2021-09-25 09:12:17', '01/01/2001', 20, 'Man', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Frequently', 'Socially', '', '50243-1632129042_image1.jpg', '', '', 0, 0, 1, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 09:10:44', '2021-09-25 09:12:17'),
(172, 'linkedin', '139', 'nupur', '', 'tripathi', 'nbt.tanvi@gmail.com', '2021-09-20 09:22:50', '01/01/2001', 20, 'Woman', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', 'good', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '78954-1632129769_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-20 09:22:50', '2021-09-20 09:22:50'),
(174, 'linkedin', '500', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-09-21 06:25:13', '01/01/2001', 20, 'male', '', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', '', '54', 'relationship_type', 'mbti', 'star_sign', 'political_view', 'religion', 'exercise', 'drinking', 'smoking', '', '84916-1632205513_image1.jpg', '71692-1632205513_image2.jpg', '06482-1632205513_image3.jpg', 0, 0, 0, '0', '0', '', 'user', '2222222222', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-21 06:25:13', '2021-09-21 06:25:13'),
(175, 'linkedin', '140', 'karan', '', 'kundra', 'nbt.tanvi@gmail.com', '2021-09-21 10:56:25', '01/01/2001', 20, 'Man', '', '26.9124,75.7873', '26.9124', '75.7873', 'engineer', 'fun loving', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Frequently', 'Frequently', '', '93182-1632220234_image1.jpg', '', '', 0, 0, 0, '0', '0', '', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-21 10:30:35', '2021-09-21 10:56:25'),
(176, 'linkedin', '999', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-09-21 10:43:17', '01/01/2001', 20, 'male', '', '8.1697511,39.8994659', '8.1697511', '39.8994659', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '94163-1632220959_image1.jpg', '28710-1632220959_image2.jpg', '57342-1632220959_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'g54h567777777777777777777777', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-21 10:42:39', '2021-09-21 10:43:17'),
(177, 'linkedin', '141', 'niki', '', 'tamboli', 'nbt.tanvi@gmail.com', '2021-09-23 09:31:18', '01/01/2001', 20, 'Woman', '', '8.5779788,5.7716427', '8.5779788', '5.7716427', 'engineer', 'self motivated', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '13402-1632222040_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'd6bS19da2UlPgJyN-KoON0:APA91bFwbJwu06p2GoBG2XYDvnpGcU33HIbiiJgyWVIUkvTx_2NdcDkLz2Sw91zjMIGqDBU_ySA9mDX5uZLBxtGfoVFlQ10PACRT3SDDaHDAd977T5bTzMowtDzL7TsyEQNDO-LZGDce', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-21 11:00:41', '2021-09-23 09:31:18'),
(178, 'linkedin', '142', 'rubina', '', 'dilaik', 'nbt.tanvi@gmail.com', '2021-09-23 06:39:40', '01/01/2001', 20, 'Woman', '', '8.5779788,5.7716427', '8.5779788', '5.7716427', 'engineer', 'good enough', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '76581-1632222292_image1.jpg', '', '', 0, 0, 0, '0', '5.5', 'andriod', 'user', 'cXKBG0jZKElemixy631616:APA91bGP1pqPj0Dns4CUiKAq9hnHFiyApzBXfionAChR68XMCouWhSba6WNp35iJ596BCVLophFH2Bozg15kNXiDoFHGa2B05AyFfCmMFqxg7wcATJRIJdriLI7OoagXssrNBZnWIEAo', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-21 11:04:53', '2021-09-23 06:39:40'),
(179, 'linkedin', '400', 'tani', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-28 13:16:46', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', 'engineer', 'fun loving', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Sometimes', 'Frequently', 'Frequently', '', '50427-1632832443_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'fESYCAnNQzuAb7q9PuQxsY:APA91bFfhlelJgR9Xg_XqIqPT65a6b8OO2LxuOza1m--kVJa60ut9tMt8tMuNItUIK-sCp95NcFWECa12lBr-V6Kmvw4B6lYkwEs5Dw1MaZKOxHDcqxzVg97kBFvf21yyu5ucLio1LQB', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-28 12:34:03', '2021-09-28 13:16:46'),
(180, 'linkedin', '401', 'shravan', '', 'mali', 'nbt.tanvi@gmail.com', '2021-09-29 04:32:10', '0', 0, 'Man', '', '0.0,0.0', '0.0', '0.0', 'engineer', 'self motivated', 'Btech', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '65970-1632889929_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'eO4CsSEYScG71w8XfQj54o:APA91bErNSoqKijAo-qC3VslMLo-YsR9rQHI5Vga114IIgp2IQjCpqcbALSYk1CL2kLbE9f0KERg1-SdNcVD0MfxunC4rXepdxZM1IZdNRDRB3zj0It1OyefbhdueZUc_CS4oLyxRMCQ', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 04:32:09', '2021-09-29 04:32:10'),
(181, 'linkedin', '402', 'ashi', '', 'soni', 'nbt.tanvi@gmail.com', '2021-09-29 05:06:17', '0', 0, 'Woman', '', '26.9633241,75.7689912', '26.9633241', '75.7689912', 'engineer', 'self motivated', 'Btech', '', '153', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Frequently', '', '29106-1632891725_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'e3zUbFmFTyyjH2slTy3cWk:APA91bGMKOE5Ak1xzTan-zXQsHX84WT8fDc3bmmhwTTraMjFaKlzcu-uuzHHKwC4TGF32RKGgf4OGO10iIxU0tQ_ecnnP6a6JtLTbM-VDuzPoV5NfXORnzKaX6UOtCPF5imWUacdbodb', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 05:02:05', '2021-09-29 05:06:17'),
(182, 'linkedin', '403', 'tanu', '', 'solanki', 'nbt.tanvi@gmail.com', '2021-09-29 05:15:16', '0', 0, 'Woman', '', '0.0,0.0', '0.0', '0.0', 'engineer', 'short temper', 'Btech', '', '150', 'A Relationship', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Frequently', 'Never', '', '29635-1632892515_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'cxEIzRUISLyN0A5LogPr8X:APA91bEXZ3lEsVuoJGPtoDgNSGdg9ihvuP36krXvqdeTdo5HAGMS5ZqPdTx7_ofXnhycuoOEJrAgAUcY95YJl3z97uxk06ZyzG3znNA-Mk8E_zJc-ekag4RK_r6fehJLS03HM-OFNJi5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 05:15:15', '2021-09-29 05:15:16'),
(183, 'linkedin', '404', 'bhumika', '', 'trivedi', 'nbt.tanvi@gmail.com', '2021-09-29 11:08:04', '0', 0, 'Woman', '', '26.9633104,75.769007', '26.9633104', '75.769007', 'engineer', 'self motivated', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '94236-1632893111_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'ckNACceiQ_mdic0KVePHMR:APA91bGbQIlsEjmA7EbjTWPXPnHFcNxyGuAYpGozoTPlcqWP5npysQisAqRzZjzTBruIyeOQdWQaG05zPvwrlwfE9werACtVWh-LFYdRfT1LCu3CCnuieA5-WzCtwLlZWyyWR_0Y7N-S', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 05:25:11', '2021-09-29 11:08:04'),
(184, 'linkedin', '405', 'leena', '', 'solanki', 'nbt.tanvi@gmail.com', '2021-09-29 09:47:38', '0', 0, 'Woman', '', '26.9633153,75.7690029', '26.9633153', '75.7690029', 'engineer', 'short temper', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '50318-1632908857_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'fj-QHCrYQFu1sKM0Q6wev6:APA91bE2bBcCoj53bihuXGQpnSePRPXWGM9OWoRMKrrf5n--Y3wqjUwfAueNdxsK3icYo9OB5Vk6X90axPLHLpdtaW62bxkEu020WUvUPrQiBgIM66CkDk7kuhNxsCVEpE_VDMfh4Kqi', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 09:47:37', '2021-09-29 09:47:38'),
(185, 'linkedin', 'CNCNTmR8ck', 'bhawna', '', 'sharma', 'nbt.tanvi@gmail.com', '2021-12-08 10:53:09', '06/01/2006', 15, 'female', '', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', '', 'Btech', '', '129', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '52087-1633348972_image1.jpg', '', '', 0, 0, 0, '0', '11', 'android', 'user', 'e-qgge38Qky7aivo0Fd9aQ:APA91bHMNG88B1FyAts5XQvVCLWvrhntDCHnV_EXpjq0CuhJm1BWQDCntlYUjilfJtRZJuAFAvpubBmG8miaMvd2d3BgjogXuZIUMeRLRsA8S-9meUDhP2DXd_BYVTVFkw4yKJQb84Jf', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 10:18:25', '2021-12-08 10:53:09'),
(186, 'linkedin', '406', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-29 12:24:55', '0', 0, 'Others', '', '26.9633175,75.7690018', '26.9633175', '75.7690018', 'engineer', 'fun loving', 'Btech', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'dQczYxLjQZCdELtUyxwlQ5:APA91bGgdad_NEC3yyF7MckYc27u0_8tyWTX5zpJEQ7HS5Xg0MPP2Y_KxPDr_9nRiOVKxsFyNKKC5l3TMSikHC_DYhjcreisAOc0Wp4R8TvMWtHVyx746gWMGi4D00cjHSTLwA-4JS67', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 12:24:53', '2021-09-29 12:24:55'),
(187, 'linkedin', '408', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-29 12:47:15', '0', 0, 'Woman', '', '26.9633175,75.7690018', '26.9633175', '75.7690018', 'engineer', 'ok', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'dJ8MASoOThiSoZrrSfEIXi:APA91bH_b3KqF-6VmF531KQNqLEK2wEkQqloSHP6-wgDnBAfM2xmbIciDJq7iHSBKUkTHQESeeK0PDy0iVYtk6rCMHcSn7wATKVmvMBTonsyWFKN4X6M_KJlyeAlDahiEcIkcKfuS5qF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 12:42:02', '2021-09-29 12:47:15'),
(188, 'linkedin', '409', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-29 13:05:58', '0', 0, 'Others', '', '26.9633175,75.7690018', '26.9633175', '75.7690018', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Frequently', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'eOoXmW0STPW_y1NwDcwekU:APA91bGACEBOHn1572rwhoTpzeVLlAo06g53Wc8nOGDZ94CCGF_aA3rMjaWbXAdGPpZU5mWycdGqLjwa9zfMoycXTQDecUGb_YLQ1gVRDNaTxSzMwdKjEaA3GJCYH5vgt7Kb5NaNK-Gh', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 12:49:42', '2021-09-29 13:05:58'),
(189, 'linkedin', '420', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-29 13:13:21', '0', 0, 'Man', '', '26.9633175,75.7690018', '26.9633175', '75.7690018', 'engineer', 'ok', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'fknGtgXcQk6t5JC7AfkpVr:APA91bHeq5esCMbd0Ip5huFBHzJN4Yvat3eqx7D3FWIRdvac-NoVvr9ZobFWWG9yB0o676718dXHqoUMOtAl30ZAho8ZrN0dlzcTw2w_2_k9Sm4Wvp4b88rVmSTaJv358IY6tXLlxAFO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 13:13:20', '2021-09-29 13:13:21'),
(190, 'linkedin', '421', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-29 13:18:12', '0', 0, 'Man', '', '26.9633175,75.7690018', '26.9633175', '75.7690018', 'engineer', 'ttt', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Sometimes', 'Never', 'Frequently', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'c8eTEqvEQz2HNW2-BsOKvj:APA91bFcuYyab1Em4nEt79Huuf1gV4GV_jROUV86Kj-ymPbwQgvjyniHpncNiycrCnxE3jQ3dZClSlR8mOz36fduddhx4WCQ86K8Tb1oZflADM6u6kBEHQBWzIy6e53aMtjREL51SvSz', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-29 13:18:10', '2021-09-29 13:18:12'),
(192, 'linkedin', '412', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 11:15:28', '0', 0, 'Woman', '', '26.9633194,75.7689942', '26.9633194', '75.7689942', 'engineer', 'short temper', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'eBooTAGXTv6ZkuLcDIk5Lp:APA91bFCHbmcVLaKd4m3Bty7T54pUmwNEO5G2I8T6gE3y5pfikUmvTAiz6xydELXCMSxeGmZ27qs0WP7poA96vRuk1_1zhZqPv7baxUCtbYAOdm5TmkVJs69TZ7EhnWY-QRhf05R_VkN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 09:34:52', '2021-09-30 11:15:28'),
(193, 'linkedin', '413', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 11:50:00', '0', 0, 'Woman', '', '26.9633239,75.7689977', '26.9633239', '75.7689977', 'engineer', 'self motivated', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '79246-1633002544_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'cDNULOGIRhCrkp73f7yQka:APA91bFtBV4Y2NrBvWdFo9D_FNW1Fax0gAgnjnyh0xz8TJeepHobnmfMZexsgWAujopJFzIfZOkoDWcrZOd4UWwI8NEpi4I9SbzVd75zguwf-11D85s6guswWXhIbrIFYzIM94a9DzoQ', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 11:49:04', '2021-09-30 11:50:00'),
(194, 'linkedin', '414', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 12:06:05', '0', 0, 'Woman', '', '26.9633239,75.7689977', '26.9633239', '75.7689977', 'engineer', 'short temper', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', '', '', '', '', 0, 0, 0, '0', '0', '', 'user', 'e3xRSVdGS564yzPfPIJpzG:APA91bHHXOdqVvcumli7N8KAkO53NrclFqhx8-S3M_VeC2iVG-VxF1agb2IsEZLZe1M0xKUTc2Paf3kt0NT3OwG0pOR0_NbfFvWoXHkNvMkhha8URRvPSGZTJgA6A3VZVEjpFbv9NTFP', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 12:06:05', '2021-09-30 12:06:05'),
(195, 'linkedin', '415', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 12:19:31', '0', 0, 'Woman', '', '26.9633239,75.7689977', '26.9633239', '75.7689977', 'engineer', 'good', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Frequently', 'Never', '', '', '', '', 0, 0, 0, '0', '0', '', 'user', 'fyJV3cSGSmq0uXWwEzS_dR:APA91bFT0QN3ooCublb702gqVtjMIiN3mEQ9tYGvBop5mz7_lRSmbi7JehpWT9nn3lfE6yUWZHqNKIaSduC03RGQpFeUMWuUNYHZEWhUrKMM6s3Dl2y3LDp6LO3nd1tsjqaJibh6Tr3y', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 12:19:31', '2021-09-30 12:19:31'),
(196, 'linkedin', '416', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 12:25:12', '0', 0, 'Woman', '', '26.9633239,75.7689977', '26.9633239', '75.7689977', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '', '', '', 0, 0, 0, '0', '0', '', 'user', 'cuNI8nIETRKuWOY_6rknAp:APA91bEcHnJQgKxD3fG2x2DObz-rkpVYKqr1_QdcdICrNI5yzsEq8D8dbkFrx8N0zFyGMBHj5W7H9y-n8qzXahwibP1WG6zKFbyxGCRSn_mTS9DA8qwWMbeUQ8eZ3ApQzE9sO0yD1_pW', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 12:25:12', '2021-09-30 12:25:12'),
(197, 'linkedin', '417', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 13:05:01', '0', 0, 'Woman', '', '26.9633224,75.7689978', '26.9633224', '75.7689978', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '73482-1633005052_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'ey2nqkazRz2z_xl6fK7G-G:APA91bGwbk0JRzf9lCLUBRx87Cz3Bu5zIrL4MEyc4gR7CKRPkDRDaoBGM3Qfd6yrvFQjG-K6Y2kEORUUprhh4h6oFgBcWolt5z_qZmoQxY8CBgCNKtvN9Vy-sDfa8vjF2y4gYAPuRlgi', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 12:30:52', '2021-09-30 13:05:01'),
(198, 'linkedin', '418', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-09-30 13:26:22', '0', 0, 'Woman', '', '26.9633202,75.7689924', '26.9633202', '75.7689924', 'engineer', 'ok', 'Btech', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Almost never', 'Never', 'Never', '', '', '', '', 0, 0, 0, '0', '0', '', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 13:13:00', '2021-09-30 13:26:22'),
(199, 'linkedin', '419', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-01 05:32:45', '0', 0, 'Woman', '', '26.9633202,75.7689924', '26.9633202', '75.7689924', 'engineer', 'ok', 'Btech', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '96524-1633008725_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'dJC1aMawx04bu_wvHRKxzP:APA91bEpKZUsZdSZpTTGV9vtnfQV9-TzY0cWBlBiyteXkbN35_6k230CSvbweG2-9JPcqBpDB2l2WELzjhUDbSbspRhDSb2IYVD-VAxDKAhGp5LF1gKV_4R6ZRBncpYQbj4El9yX3P-G', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-30 13:32:05', '2021-10-01 05:32:45'),
(200, 'linkedin', '1000', 'abhi', '', 'soni', 'abhi@gmail.com', '2021-10-07 12:53:50', '0', 0, 'Men', 'Women', '26.9621, 75.7816', '26.9621', ' 75.7816', '', 'summary', '', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '96813-1633436041_image1.jpg', '90167-1633436041_image2.jpg', '90748-1633436041_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-05 12:14:01', '2021-10-07 12:53:50'),
(201, 'linkedin', '1001', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-06 12:25:40', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', 'self motivated', '', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Apolitical', 'Agnostic', 'Sometimes', 'Socially', 'Never', '', '34089-1633439993_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'csS6P-fIkURWkj8ZjVGsA4:APA91bFePJDOR8b5fyP7rZKpyFJy1DAWPk28DS8KkIux6krJ6SFNeLcEX3ATkFWci51SVbz3BHmtmT80QVwgrNVD-WDmyJHhpz2saIcpKUGnl5fzvi9o6eQHUE-6_HpSZbJ6rNo1Mjv0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-05 13:19:53', '2021-10-06 12:25:40'),
(202, 'linkedin', '1003', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 06:11:35', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '150', 'Strictly Platonic', 'don\'t believe', 'don\'t believe', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '05463-1633587094_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'flLaFxSbl0RVvJPqwFLYB4:APA91bGxzBlh7TT5RHlAMQaw60mLvRqvZZWzjLZs-__yJORKmhIxZxutujm6EIfdfDMryezDyZXVqG9PetZOnZX5YGngxm05KK-weFWltzqFy1SdpAJOk62vEtgTjy6UlpOkkX1TG-je', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 06:11:34', '2021-10-07 06:11:35'),
(203, 'linkedin', '1004', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 06:20:20', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '150', 'Something Casual', 'don\'t believe', 'don\'t believe', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '39021-1633587619_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'cOV0uOM72UWGh0C1HT-IO2:APA91bGb_nbMtCOcV5JO454zIjX4yyTyNKSxwfE_pKHfkhhfjBPkXF50zmt-7r7J9wxAWISwpXd7eci103iFXj7P159fuCob3E-8jaD82FVX6tVxwikVKzB1h9F9XIVeaQ3vNrFhY8MR', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 06:20:19', '2021-10-07 06:20:20'),
(204, 'linkedin', '1005', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 06:39:56', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '150', 'Something Casual', 'don\'t believe', 'don\'t believe', 'Apolitical', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '94658-1633588795_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'fIKH3Iw5W0YZmoaV-DAali:APA91bGxMajQZaWvOFKnuFrHmj1P8NMuM6cRQCc_6ibSDORgDjRGh99sly5_igShzwxHb3wAXb2yMxzcwWxCRCbrpbcLItH08JQ27moqh6zb4kfHrme-LA6Rq-kQmvr1ON3e9YPY_Wcq', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 06:39:55', '2021-10-07 06:39:56'),
(205, 'linkedin', '1006', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 07:02:59', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '150', 'Something Casual', 'don\'t believe', 'don\'t believe', 'Apolitical', 'Other', 'Sometimes', 'Never', 'Never', '', '31675-1633590178_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'cXjqRVFHEUPVqLll4w2r3U:APA91bHV0uXx4f03eT16HgLreLN6jevMc6o-826qr13MLc4djwVqAjL5u08P9Hwe3K0wQn1Uz4hyuu0pcY-iY7EIUr405GeUjHVsdIIaB5DH9UjRLshNW91FNKFqeS5fLRwJnZuhLBOs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 07:02:58', '2021-10-07 07:02:59'),
(206, 'linkedin', '1007', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 07:12:32', '0', 0, 'Man', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '238', 'Something Casual', 'don\'t believe', 'don\'t believe', 'Apolitical', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '95216-1633590751_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'ep1P1rNltkP6jW-I4w06cn:APA91bEo_9notaXAhMtm5qmeF_Ge8EAZ9VdHKdqftkIX2drt9wf1R8ktYLu4Yjxc_Kz5GMAlFOkzYB_WMsSSmwQM5h0eegFOknQ49lAOejvlNekPrT_8y-E5k4OI2D3lGLCmVCbeaM0b', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 07:12:31', '2021-10-07 07:12:32'),
(207, 'linkedin', '1008', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 08:20:33', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', '', '', '', '150', 'A Relationship', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '98076-1633591096_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'f5_8ZAzrS0Rrqwu_NPVMkM:APA91bFxB__LykpLGuTQkHUU5mUFB7EbD3JXe7x0wrbmE4K43B-5zEhKYkEGAjAXMBvtDDG2q-O4Yrgeya2N0Fihnsm3f338tDOFFIB9FaRTpqmQidW9T879KutHZpcEUKjtbGEbIXrm', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 07:18:16', '2021-10-07 08:20:33'),
(208, 'linkedin', '1009', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 09:21:53', '0', 0, 'Woman', '', '26.9124,75.7873', '26.9124', '75.7873', '', 'https://www.linkedin.com/', '', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '23790-1633598511_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'eaj1dtxySkWAvjs7jzh-C9:APA91bGDMp-mcCNcfxHK0yhpvln0jtzc_TZSi7uTbvYuKmJ1_negeZcj-SF2uZ5ZHxVqJ5PjpSXQMnc6tk_nrvvUqBt3cMXHNYIxi4ofbo5ApgvuzJkP2o4sBNlHJ93aSK4hCOBxm2WO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 09:21:51', '2021-10-07 09:21:53'),
(209, 'linkedin', '1010', 'Tanu', '', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-07 09:31:04', '0', 0, 'Man', '', '26.9124,75.7873', '26.9124', '75.7873', '', 'https://www.linkedin.com/', '', '', '150', 'Strictly Platonic', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', '', '48635-1633599063_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'evV55Trh-0LDqhEFyDUn98:APA91bGNu60YPIfzCZpUF3mOW_ar1S3NzNSeHighkiYGf6LV9i1_DYqMm_abyLkqUeMn7-5XeVyeml_sxfmtem7D4MpbifcsBJOfHoJevj1e5ap02v2own4qHjyDcTuQdkzTQrbbPaC2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 09:31:03', '2021-10-07 09:31:04'),
(210, 'linkedin', '1011', '', 'Education', '', 'nbt.tanvi@gmail.com', '2022-10-01 12:54:20', '01/01/2001', 21, 'female', 'Man', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', 'basic_info', '1.5', 'Something Casual', 'mbti', 'star_sign', 'Moderate', 'religion', 'exercise', 'drinking', 'smoking', 'https://www.linkedin.com/', '20514-1633600320_image1.jpg', '', '', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'fROoswJEuk-Bp173QaKURw:APA91bH1DpkeUZnNh9k6n6HZHvOpZp9zQ_DRbzx443ElirvGZNu_KA6wWvyGHf0cpOM3mSz2j09qyhnzGvhOIjw2jsuB7qRI4CleMMzxn35pyPgSR63obGClH-em8WMLa7zsJlnkCFid', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 09:52:00', '2022-10-01 12:54:20'),
(211, 'linkedin', '1020', 'abhi', '', 'soni', 'abhi@gmail.com', '2021-10-07 12:54:24', '0', 0, 'Men', 'Women', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '62140-1633611264_image1.jpg', '25841-1633611264_image2.jpg', '97386-1633611264_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 12:54:24', '2021-10-07 12:54:24'),
(212, 'linkedin', '10001', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-10-07 13:07:22', '0', 0, 'male', 'woman', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', 'basic info aaaaaa', '54', 'relationship_type', 'mbti', 'star_sign', 'religion', 'exercise', 'exercise', 'drinking', 'smoking', 'aaaaaaaa', '', '', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55t', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 13:07:22', '2021-10-07 13:07:22'),
(213, 'linkedin', '1021', 'abhigya', '', 'soni', 'abhigya@gmail.com', '2021-10-07 13:12:05', '0', 0, 'Men', 'Women', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', '', '61870-1633612325_image1.jpg', '38409-1633612325_image2.jpg', '54203-1633612325_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 13:12:05', '2021-10-07 13:12:05'),
(214, 'linkedin', '1022', 'abhigya', '', 'soni', 'abhigya@gmail.com', '2021-10-07 13:17:07', '0', 0, 'Men', 'Women', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'religion', 'hindu', 'exercise', 'drinking', 'smoking', 'https://www.linkedin.com/', '13864-1633612415_image1.jpg', '03912-1633612415_image2.jpg', '24780-1633612415_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-07 13:13:35', '2021-10-07 13:17:07'),
(215, 'linkedin', '1023', 'annu', 'Law', 'solanki', 'annu@gmail.com', '2021-10-08 10:34:10', '0', 0, 'Women', 'Men', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'Apolitical', 'hindu', '', 'Never', 'Never', 'https://www.linkedin.com/', '35087-1633685889_image1.jpg', '61098-1633685889_image2.jpg', '10894-1633685889_image3.jpg', 0, 0, 0, '0', '14.5', 'iOS', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-08 09:38:09', '2021-10-08 10:34:10'),
(216, 'linkedin', '1025', 'annu', 'Law', 'solanki', 'annu@gmail.com', '2021-10-09 06:21:59', '0', 0, 'Women', 'Men', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'Apolitical', 'hindu', '', 'Never', 'Never', 'https://www.linkedin.com/', '84591-1633760519_image1.jpg', '39465-1633760519_image2.jpg', '54328-1633760519_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'edRchYQdmUkJog6K_qbo4y:APA91bHJWXYSxmL0j_MyED8bhoDQZExxTrDaGTlqR2JZVhBXsXIqEFqC6NaOnryEb9tEPJjF0gKOL49twC-pRXDp2R1HRxB8zLsLI-Sx9anjBo07xKV-H_HSBMkKyMqOZ-BJLWeLEBkn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 06:21:59', '2021-10-09 06:21:59'),
(217, 'linkedin', '1024', 'Tanu', 'Energy and utilities', '', 'nbt.tanvi@gmail.com', '2021-10-09 09:09:51', '16/01/2003', 18, 'Woman', 'Man', '26.963307,75.7690005', '26.963307', '75.7690005', '', '', '', '', '150', 'Something Casual', 'don\'t believe', 'don\'t believe', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/', '54089-1633763450_image1.jpg', '73826-1633770424_image2.jpg', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 07:10:50', '2021-10-09 09:09:51'),
(218, 'linkedin', '1026', 'Tanu', 'Business, consulting, and management', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-09 09:53:38', '0', 0, 'Woman', 'Man', '26.9633237,75.7690586', '26.9633237', '75.7690586', '', '', '', '', '220', 'A Relationship', 'I don\'t believe', 'I don\'t believe', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/in/', '45289-1633771996_image1.jpg', '02351-1633771996_image2.jpg', '52806-1633771996_image3.jpg', 0, 0, 0, '0', '9', 'andriod', 'user', 'd_XNRz8hQy6S0J3wmDv5IL:APA91bFJOBtri6dzCyryP3EprNw09pAE6OJblp59_eOnjmAZNk330jp-ocZ1i92D5W3Gx04rMYC5kSiey4FuZBlxABASMEd7LL8ryU-f_Yt0I9CPXIAVzhzqmJ6B_JnpoVDYktXuM3ZJ', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 09:33:16', '2021-10-09 09:53:38'),
(219, 'linkedin', '1028', 'annu', 'Law', 'solanki', 'annu@gmail.com', '2021-10-09 10:35:49', '0', 0, 'Women', 'Men', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'Apolitical', 'hindu', '', 'Never', 'Never', 'https://www.linkedin.com/', '04819-1633774734_image1.jpg', '05137-1633774734_image2.jpg', '98607-1633774734_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:18:54', '2021-10-09 10:35:49'),
(220, 'linkedin', '1027', 'Tanu', 'Accountancy, banking, and finance', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-09 10:21:02', '0', 0, 'Woman', 'Man', '26.9633279,75.7690019', '26.9633279', '75.7690019', '', '', '', '', '150', 'Something Casual', 'I don\'t believe', 'I don\'t believe', 'Apolitical', 'Other', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/', '', '10564-1633774771_image2.jpg', '16482-1633774771_image3.jpg', 0, 0, 0, '0', '9', 'andriod', 'user', 'fHiPCXupQ5iMxMDEjMQ_Bw:APA91bG-6o9TL-ABg-J9Htxat6ek414Tjgj9o9lib6BUVBYo6MpOW4yy385XycthopWpKFfOh_luynuA9QRkGa5vyhCkGzRlIf_YUJPq4rJQJ9wsu3nKI_SSkaJLXXLKi55FYser62Ic', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:19:31', '2021-10-09 10:21:02'),
(221, 'linkedin', '1029', 'Tanu', 'Accountancy, banking, and finance', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-09 10:37:35', '0', 0, 'Woman', 'Man', '26.9633311,75.7689697', '26.9633311', '75.7689697', '', '', '', '', '150', 'Something Casual', 'I don\'t believe', 'I don\'t believe', 'Liberal', 'Agnostic', 'Sometimes', 'Never', 'Socially', 'https://www.linkedin.com/in/', '16897-1633775598_image1.jpg', '31465-1633775598_image2.jpg', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:33:18', '2021-10-09 10:37:35'),
(222, 'linkedin', '1030', 'Tanu', 'Accountancy, banking, and finance', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-09 10:55:59', '0', 0, 'Woman', 'Man', '26.9633237,75.7689895', '26.9633237', '75.7689895', '', '', '', '', '211', 'Something Casual', 'I don\'t believe', 'I don\'t believe', 'Moderate', 'Other', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/in/', '03495-1633776241_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'fhecAJhITTiTtN3w_HnBcP:APA91bFR4PrFYf-K6zGnrgwysMIe3IS0FRFkvV_pVF6PNqc_WpDkyeRlQ-S6SVSmzPmsJAWexqH9m3tfU0Xb-MFPmVz8cr5rgcS8AAoXi_SLurm4ta5sO8x9Qe1LGjhVLsPhgOOuyYXu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:44:01', '2021-10-09 10:55:59'),
(223, 'linkedin', '10005', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-10-12 11:04:48', '0', 0, 'male', 'woman', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', 'basic info aaaaaa', '54', 'relationship_type', 'mbti', 'star_sign', 'religion', 'exercise', 'exercise', 'drinking', 'smoking', 'aaaaaaaa', '', '', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55t', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:51:12', '2021-10-12 11:04:48'),
(224, 'linkedin', '10006', 'bhawna', '', 'sharma', 'dfdfg@gmail.com', '2021-10-09 11:02:25', '06/01/2006', 15, 'Woman', 'woman', '26.7751,75.8514', '26.7751', '75.8514', 'engineer', '', 'Btech', '', '129', 'Strictly Platonic', 'ISTP', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Socially', 'Frequently', 'aaaaaaaa', '', '', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55t', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 10:59:29', '2021-10-09 11:02:25'),
(225, 'linkedin', '1032', 'annu', 'Law', 'solanki', 'annu@gmail.com', '2021-10-09 11:19:34', '06/01/2005', 16, 'Women', 'Men', '26.9621, 75.7816', '26.9621', ' 75.7816', '', '', '', '', '54', 'relationship', 'mbti', 'star_sign', 'Apolitical', 'hindu', '', 'Never', 'Never', 'https://www.linkedin.com/', '30416-1633777573_image1.jpg', '51420-1633777573_image2.jpg', '51643-1633777573_image3.jpg', 0, 0, 0, '0', '0', '', 'user', 'feYK0hXMSN2RO3zLTD76kn:APA91bEd0cUBpxQb3s6BGNj0hQAs9rViMhsJgVssnyqkEQ_CQtaETCRQWvSIEPILBjQVi_bQPxDxIA4zLn_bMeImS2SZqojKMeUyTO6uM1bA_9qLV9NHNN4kho2kRCzaa_6upAhrfFBn', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 11:06:13', '2021-10-09 11:19:34'),
(226, 'linkedin', '1031', 'Tanu', 'Business, consulting, and management', '', 'nbt.tanvi@gmail.com', '2021-10-09 12:57:46', '26/01/2006', 15, 'Woman', 'Man', '26.9633234,75.7689912', '26.9633234', '75.7689912', '', '', '', '', '150', 'Something Casual', 'I don\'t believe', 'I don\'t believe', 'Moderate', 'Pastafarian', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/in/', '85764-1633780773_image1.jpg', '32178-1633780773_image2.jpg', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'fBUTRLFxRmqgU-mYiLNa_G:APA91bFEobLi12tT637ANuZopIyf7bkQo5TvsAyg84uap2h-4tDadEg57hK1YCqtDInOD3Q7asamerceohytszGY0ygK14ipezoYSfF-t7fGZNGacEFzohup6oTJoEg516X-hhnVChZ0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 11:59:33', '2021-10-09 12:57:46'),
(227, 'linkedin', '1034', 'Tanu', 'Marketing, advertising and PR', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-09 13:01:02', '01/01/2016', 5, 'Man', 'Woman', '26.9633234,75.7689912', '26.9633234', '75.7689912', '', '', '', '', '152', 'Strictly Platonic', 'I don\'t believe', 'Aries', 'Liberal', 'Christian', 'Almost never', 'Frequently', 'Frequently', 'https://www.linkedin.com/in/', '20314-1633784461_image1.jpg', '', '', 0, 0, 0, '0', '9', 'andriod', 'user', 'dj9wS530SIGpxZyxbLPFhe:APA91bHc25d7YjBBHeWlHKsHSe84f16GsjOgdV23cDoovTWs2KtPJrTp7-uM9Rlkexf4lFUYcWhUZqkXME8KuDiI8avo3Skfmxsu2sI7WsviA82BEgpQBEE04olSz0aLfbjHXhMBLJvV', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-09 13:01:01', '2021-10-09 13:01:02'),
(228, 'linkedin', '10009', 'abcd', '', 'gfhfgh', 'dfdfg@gmail.com', '2021-10-12 11:17:03', '01/01/2001', 20, 'male', 'woman', '8.1697511,39.8994659', '8.1697511', '39.8994659', 'positions', 'summary', 'educations', 'basic info aaaaaa', '54', 'relationship_type', 'mbti', 'star_sign', 'religion', 'exercise', 'exercise', 'drinking', 'smoking', 'aaaaaaaa', '', '', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55t', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-12 11:17:03', '2021-10-12 11:17:03');
INSERT INTO `users` (`userid`, `social_type`, `social_id`, `first_name`, `industry`, `last_name`, `email`, `last_seen`, `birthday`, `age`, `gender`, `interest`, `lat_long`, `lat`, `long`, `positions`, `summary`, `educations`, `basic_info`, `height`, `relationship_type`, `mbti`, `star_sign`, `political_view`, `religion`, `exercise`, `drinking`, `smoking`, `profile_url`, `image1`, `image2`, `image3`, `like_count`, `dislike_count`, `hide_me`, `block`, `version`, `device`, `profile_type`, `device_token`, `hide_age`, `hide_location`, `hide_birthday`, `hide_position`, `hide_education`, `hide_height`, `hide_industry`, `hide_gender`, `hide_interest`, `hide_basic_info`, `hide_relationship_type`, `hide_mbti`, `hide_star_sign`, `hide_political_view`, `hide_religion`, `hide_excercise`, `hide_drinking`, `hide_smoking`, `hide_profile_url`, `created`, `updated_at`) VALUES
(229, 'linkedin', 'nJ7WNEgnS7', 'Brian', 'Accountancy, banking, and finance', 'Chen', 'brianchen1993@gmail.com', '2021-12-08 08:18:12', '14/01/1993', 28, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', '', '', '', '', '178', 'Strictly Platonic', 'ESTJ', 'Aries', 'Liberal', 'Agnostic', 'Active', 'Socially', 'Socially', 'https://www.linkedin.com/in/iambri', '93824-1634993715_image1.jpg', '', '', 0, 0, 0, '0', '11', 'android', 'user', 'c4-3q67uSeqdizCBVJLCcu:APA91bHYu2j0nCTni5jsxAV9HKJ1doCgU1voLs2mQJta6LhQWlpWGBK3mYSkxRVa_AL9NZjKrbzvfoXX54nxeFUFt_fxTA_05cnDTXDQAIEkHQ18XGJeMnU1Rvd2HQffsrzfKYb7Kpqa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-23 12:55:15', '2021-12-08 08:18:12'),
(230, 'linkedin', 'CNCNTmR8ck@@', 'Tanu', 'Charity and voluntary work', 'Solanki', 'nbt.tanvi@gmail.com', '2021-10-27 05:02:36', '01/01/2016', 5, 'Man', 'Woman', '26.9633353,75.7689469', '26.9633353', '75.7689469', '', '', '', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Apolitical', 'Muslim', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/in/skggg', '84057-1635161217_image1.jpg', '', '', 0, 0, 0, '0', '9', 'android', 'user', 'eEreXU6FTM2Bv5Fw4KnmE8:APA91bGoW2-miThCGqBA6GK90bYj7Nd2wjD3Ez2ihABywjVtJL89zz6dQh6Of_ZWcX9M9Ka4jdqFpWToPYTO4X7FJdgy3iOkx_KhY9kMG9KDLa77XWthnTLiCy0KcAEtdAXbfupQIoVZ', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-25 11:26:57', '2021-10-27 05:02:36'),
(231, 'linkedin', 'CNCNTmR8ck1', 'Tanu', 'Accountancy, banking, and finance', 'Solanki', 'nbt.tanvi@gmail.com', '2021-11-08 08:50:37', '01/01/2016', 5, 'Woman', 'Others', '26.9633261,75.7689936', '26.9633261', '75.7689936', '', '', '', '', '154', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', 'www.linkedin.com/in/sk', '92047-1635314486_image1.jpg', '', '', 0, 0, 0, '0', '9', 'android', 'user', 'cnXa9Z95TEeDSyMUyF7wTV:APA91bE_ruj4vKST4bdCpl-O8KEwBO7ypkYiaVFX_kQyuYugiZKWS4giJWtyDU0LF6aL7p9s8uqG6Y4laKqeUXf_dnZ5Ard9Rv5e7nRRbiDgd3HQ0f-NMYuQsdg9pH5KB1RyXSHAkats', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-27 06:01:26', '2021-11-08 08:50:37'),
(232, 'linkedin', 'CNCNTmR8ck#', 'Tani', 'Accountancy, banking, and finance', 'Solanki', 'nbt.tanvi@gmail.com', '2021-12-16 05:37:50', '01/01/2016', 5, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', '', '', '', '', '150', 'i\'m not sure yet', 'ISTJ', 'Aries', 'Conservative', 'Agnostic', 'Almost never', 'Frequently', 'Frequently', 'www.linkedin.com/in/123', '59670-1636366885_image1.jpg', '', '', 0, 0, 1, '0', '5.5', 'andriod', 'user', 'cu0W53lNoEFcpZG4cHLBlR:APA91bEmUlre0ls3A9cKFI5Q4-mUT6bb_9HGQRrQwaWyjysfTHTYGrab27b2hJIWAiRfhxBIS6LQl6GVUlDvzwV31QmyxY2QJ7BbWVweAKnnLRfeo-6xAw3G75nAQQ-3OGoio0WNA85O', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-08 10:21:25', '2021-12-16 05:37:50'),
(233, 'linkedin', '123451', 'An', 'Accountancy, banking, and finance', 'An', 'an@gmail.com', '2021-11-23 09:09:34', '01/01/1990', 31, 'Male', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'engineer', 'self motivated', 'b.tech', 'my self an', '170', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Frequently', 'Frequently', 'https://www.linkedin.com/in/an', '26017-1637658115_image1.jpg', '39481-1637658115_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:01:55', '2021-11-23 09:09:34'),
(234, 'linkedin', '123452', 'Angao', 'Accountancy, banking, and finance', 'Angao', 'Angao@gmail.com', '2021-12-08 09:04:39', '01/02/1990', 31, 'Male', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'developer', 'self motivated', 'b.tech', 'my self an', '171', 'Something Casual', 'ISTJ', 'Aries', 'Liberal', 'Agnostic', 'Sometimes', 'Frequently', 'Frequently', 'https://www.linkedin.com/in/angao', '39657-1637658609_image1.jpg', '94563-1637658609_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:10:09', '2021-12-08 09:04:39'),
(235, 'linkedin', '123453', 'Augio', '', 'Augio', 'augio@gmail.com', '2021-12-08 08:58:39', '01/02/1991', 30, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.A,', 'my self an', '172', 'Something Casual', 'ISTJ', 'Gemini', 'Moderate', 'Atheist', 'Sometimes', 'Never', 'Frequently', 'https://www.linkedin.com/in/angao', '06271-1637659722_image1.jpg', '62849-1637659722_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:28:42', '2021-12-08 08:58:39'),
(236, 'linkedin', '123454', 'Bai', '', 'Bai', 'bai@gmail.com', '2021-12-08 09:02:02', '01/03/1991', 30, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource executive', 'self motivated', 'B.A,', 'my self an', '173', 'Something Casual', 'ISTJ', 'Libra', 'Moderate', 'Atheist', 'Sometimes', 'Socially', 'Frequently', 'https://www.linkedin.com/in/bai', '41038-1637659892_image1.jpg', '39615-1637659892_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:31:32', '2021-12-08 09:02:02'),
(237, 'linkedin', '123455', 'Bingwen', '', 'Bingwen', 'Bingwen@gmail.com', '2021-12-08 09:00:48', '01/03/1992', 29, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'B.A,', 'my self an', '173', 'Something Casual', 'ISTJ', 'Libra', 'Moderate', 'Atheist', 'Active', 'Socially', 'Frequently', 'https://www.linkedin.com/in/bai', '85367-1637660091_image1.jpg', '86175-1637660091_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:34:51', '2021-12-08 09:00:48'),
(238, 'linkedin', '123456', 'Bo', '', 'Bo', 'Bo@gmail.com', '2021-12-08 08:58:45', '01/03/1992', 29, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.A,', 'my self an', '174', 'Something Casual', 'ISTJ', 'Libra', 'Moderate', 'Atheist', 'Active', 'Socially', 'Frequently', 'https://www.linkedin.com/in/bai', '65317-1637660449_image1.jpg', '89123-1637660449_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:40:49', '2021-12-08 08:58:45'),
(239, 'linkedin', '123457', 'Bohai', '', 'Bohai', 'Bohai@gmail.com', '2021-12-08 09:04:24', '01/03/1993', 28, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'senior developer', 'self motivated', 'PhD', 'my self an', '176', 'Something Casual', 'ISFP', 'Libra', 'Moderate', 'Atheist', 'Never', 'Never', 'Never', 'https://www.linkedin.com/in/bai', '52801-1637660691_image1.jpg', '20913-1637660691_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:44:51', '2021-12-08 09:04:24'),
(240, 'linkedin', '123458', 'Bolin', '', 'Bolin', 'Bolin@gmail.com', '2021-12-08 09:00:55', '01/03/1994', 27, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'PhD', 'my self an', '176', 'Something Casual', 'ESTJ', 'Aquarius', 'Moderate', 'Atheist', 'Never', 'Never', 'Never', 'https://www.linkedin.com/in/Bolin', '51930-1637660873_image1.jpg', '58174-1637660873_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:47:53', '2021-12-08 09:00:55'),
(241, 'linkedin', '123459', 'Boqin', '', 'Boqin', 'Boqin@gmail.com', '2021-12-08 09:02:11', '01/03/1995', 26, 'Man', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource executive', 'self motivated', 'PhD', 'my self an', '176', 'Something Casual', 'ESTJ', 'Pisces', 'Moderate', 'Atheist', 'Active', 'Never', 'Frequently', 'https://www.linkedin.com/in/Boqin', '89074-1637661002_image1.jpg', '42697-1637661002_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:50:02', '2021-12-08 09:02:11'),
(242, 'linkedin', '1234510', 'Changpu', '', 'Changpu', 'changpu@gmail.com', '2021-12-08 08:58:54', '01/03/1996', 25, 'Male', 'Woman', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'M.Com', 'my self an', '180', 'Something Casual', 'ENTJ', 'Pisces', 'Sagittarius', 'Catholic', 'Sometimes', 'Never', 'Frequently', 'https://www.linkedin.com/in/changpu', '45671-1637661211_image1.jpg', '18396-1637661211_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:53:31', '2021-12-08 08:58:54'),
(243, 'linkedin', '1234511', 'Ah', '', 'Cy', 'ahcy@gmail.com', '2021-12-08 09:03:03', '01/03/1996', 25, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'project manager\r\n', 'self motivated', 'M.TECH', 'my self an', '165', 'Something Casual', 'ENTJ', 'Pisces', 'Sagittarius', 'Catholic', 'Sometimes', 'Never', 'Frequently', 'https://www.linkedin.com/in/ahcy', '19483-1637661498_image1.jpg', '82143-1637661498_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 09:58:18', '2021-12-08 09:03:03'),
(244, 'linkedin', '1234512', 'Kum', '', 'Cy', 'ahkum@gmail.com', '2021-12-08 09:04:07', '01/03/1998', 23, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'senior developer', 'self motivated', 'PhD', 'my self an', '165', 'Something Casual', 'ISTJ', 'Cancer', 'Moderate', 'Catholic', 'Sometimes', 'Never', 'Frequently', 'https://www.linkedin.com/in/ahkum', '34915-1637661657_image1.jpg', '40785-1637661657_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:00:57', '2021-12-08 09:04:07'),
(245, 'linkedin', '1234513', 'Ah', '', 'luk', 'ahluk@gmail.com', '2021-12-08 08:59:01', '01/04/1998', 23, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.TECH', 'my self an', '166', 'Something Casual', 'ISTJ', 'Cancer', 'Moderate', 'Catholic', 'Sometimes', 'Never', 'Frequently', 'https://www.linkedin.com/in/ahluk', '45780-1637661776_image1.jpg', '48975-1637661776_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:02:56', '2021-12-08 08:59:01'),
(246, 'linkedin', '1234514', 'Ai', '', 'Ai', 'ai@gmail.com', '2021-12-08 09:00:40', '01/04/1995', 26, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'B.TECH', 'my self an', '166', 'Something Casual', 'ISTJ', 'Cancer', 'Moderate', 'Atheist', 'Active', 'Never', 'Frequently', 'https://www.linkedin.com/in/ai', '49701-1637661920_image1.jpg', '67208-1637661920_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:05:20', '2021-12-08 09:00:40'),
(247, 'linkedin', '1234516', 'An', '', 'An', 'an@gmail.com', '2021-12-08 09:03:56', '01/04/1999', 22, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'senior developer', 'self motivated', 'B.TECH', 'my self an', '166', 'Something Casual', 'ISTJ', 'Cancer', 'Moderate', 'Atheist', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/an', '73281-1637662065_image1.jpg', '37495-1637662065_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:07:45', '2021-12-08 09:03:56'),
(248, 'linkedin', '1234517', 'Bhaozhi', '', 'Bhaozhi', 'Bhaozhi@gmail.com', '2021-12-08 08:59:10', '01/04/1999', 22, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.A', 'my self an', '167', 'I\'m not sure yet', 'ISTJ', 'Cancer', 'Moderate', 'Atheist', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/bhaozhi', '82759-1637662301_image1.jpg', '98531-1637662301_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:11:41', '2021-12-08 08:59:10'),
(249, 'linkedin', '1234519', 'Bik', '', 'Bik', 'Bik@gmail.com', '2021-12-08 09:03:49', '01/04/1995', 26, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'senior developer', 'self motivated', 'B.A', 'my self an', '168', 'I\'m not sure yet', 'ISFP', 'Virgo', 'Moderate', 'Buddhist', 'Sometimes', 'Never', 'Socially', 'https://www.linkedin.com/in/bhaozhi', '15340-1637662487_image1.jpg', '48017-1637662487_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:14:47', '2021-12-08 09:03:49'),
(250, 'linkedin', '12345118', 'Biyu', '', 'Biyu', 'Biyu@gmail.com', '2021-12-08 09:01:54', '01/04/1999', 22, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource executive', 'self motivated', 'B.Com', 'my self an', '168', 'I\'m not sure yet', 'INFP', 'Taurus', 'Moderate', 'Christian', 'Active', 'Socially', 'Never', 'https://www.linkedin.com/in/Biyu', '76341-1637662664_image1.jpg', '32468-1637662664_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:17:44', '2021-12-08 09:01:54'),
(251, 'linkedin', '12345119', 'Chu', '', 'Hua', 'vhuhua@gmail.com', '2021-12-08 09:00:28', '01/04/1995', 26, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'B.Com', 'my self an', '168', 'I\'m not sure yet', 'ISTP', 'Leo', 'Moderate', 'Buddhist', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/vhuhua', '27815-1637662810_image1.jpg', '40179-1637662810_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:20:10', '2021-12-08 09:00:28'),
(252, 'linkedin', '123451110', 'Chun', '', 'Chun', 'chun@gmail.com', '2021-12-08 08:59:21', '01/04/1993', 28, 'Woman', 'Man', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'Law', 'my self an', '170', 'Something casual', 'ISTP', 'Scorpio', 'Moderate', 'Buddhist', 'Sometimes', 'Socially', 'Socially', 'https://www.linkedin.com/in/Chun', '23850-1637663023_image1.jpg', '02438-1637663023_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:23:43', '2021-12-08 08:59:21'),
(253, 'linkedin', '123451111', 'Fang', '', 'Fang', 'fang@gmail.com', '2021-12-08 09:03:40', '01/04/1999', 22, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'senior developer', 'self motivated', 'Law', 'my self an', '173', 'Something casual', 'ISTP', 'Scorpio', 'Moderate', 'Christian', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/fang', '80465-1637664483_image1.jpg', '93745-1637664483_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:48:03', '2021-12-08 09:03:40'),
(254, 'linkedin', '12345111112', 'Hu', '', 'Hu', 'hu@gmail.com', '2021-12-08 09:02:43', '01/08/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'project manager\r\n', 'self motivated', 'Law', 'my self an', '170', 'Something casual', 'ISTP', 'Scorpio', 'Moderate', 'Buddhist', 'Active', 'Socially', 'Never', 'https://www.linkedin.com/in/hu', '04578-1637665058_image1.jpg', '52471-1637665058_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 10:57:38', '2021-12-08 09:02:43'),
(255, 'linkedin', '123451112', 'Fat', '', 'Fat', 'fat@gmail.com', '2021-12-08 09:01:33', '01/04/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource executive', 'self motivated', 'B.TECH', 'my self an', '174', 'Something casual', 'ISTJ', 'Aries', 'Moderate', 'Buddhist', 'Active', 'Socially', 'Socially', 'https://www.linkedin.com/in/fat', '23987-1637665289_image1.jpg', '81204-1637665289_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:01:29', '2021-12-08 09:01:33'),
(256, 'linkedin', '123451113', 'Fung', '', 'Fung', 'fung@gmail.com', '2021-12-08 08:59:29', '01/02/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.A', 'my self an', '170', 'Something casual', 'ESTP', 'Taurus', 'Moderate', 'Christian', 'Sometimes', 'Socially', 'Never', 'https://www.linkedin.com/in/Fung', '58316-1637665655_image1.jpg', '58072-1637665655_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:07:35', '2021-12-08 08:59:29'),
(257, 'linkedin', '123451114', 'Gang', '', 'Gang', 'gang@gmail.com', '2021-12-08 09:00:16', '01/09/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'B.A', 'my self an', '179', 'Something casual', 'ISTP', 'Virgo', 'Moderate', 'Buddhist', 'Active', 'Socially', 'Never', 'https://www.linkedin.com/in/gang', '29483-1637665810_image1.jpg', '54891-1637665810_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:10:10', '2021-12-08 09:00:16'),
(258, 'linkedin', '123451115', 'Gen', '', 'Gen', 'gen@gmail.com', '2021-12-08 09:02:33', '01/09/1997', 24, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'project manager\r\n', 'self motivated', 'PhD', 'my self an', '170', 'Something casual', 'ISTP', 'Taurus', 'Moderate', 'Buddhist', 'Sometimes', 'Socially', 'Socially', 'https://www.linkedin.com/in/gen', '48029-1637665919_image1.jpg', '71435-1637665919_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:11:59', '2021-12-08 09:02:33'),
(259, 'linkedin', '123451116', 'Gui', '', 'Gui', 'gui@gmail.com', '2021-12-08 09:01:21', '01/09/1999', 22, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'The human resource executive', 'self motivated', 'B.Com', 'my self an', '171', 'Something casual', 'ISFJ', 'Capricorn', 'Moderate', 'Catholic', 'Active', 'Never', 'Never', 'https://www.linkedin.com/in/gui', '38026-1637666243_image1.jpg', '06978-1637666243_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:17:23', '2021-12-08 09:01:21'),
(260, 'linkedin', '123451117', 'Geotin', '', 'Geotin', 'geotin@gmail.com', '2021-12-08 08:59:40', '01/09/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'manager', 'self motivated', 'B.Com', 'my self an', '175', 'Something casual', 'ISFJ', 'Capricorn', 'Moderate', 'Catholic', 'Sometimes', 'Never', 'Never', 'https://www.linkedin.com/in/geotin', '70913-1637666325_image1.jpg', '79310-1637666325_image2.jpg', '', 0, 0, 0, '0', '0', '', 'user', '5g654gtg55tytr55h57hg75g57g547g7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:18:45', '2021-12-08 08:59:40'),
(261, 'linkedin', '123451118', 'Geowei', '', 'Geowei', 'geowei@gmail.com', '2021-12-08 09:00:03', '01/09/1995', 26, 'Others', 'Others', '1.4176957,103.8313882', '1.4176957', '103.8313882', 'human resource manager', 'self motivated', 'B.Com', 'my self an', '177', 'Something casual', 'ESTJ', 'Capricorn', 'Moderate', 'Catholic', 'Active', 'Frequently', 'Frequently', 'https://www.linkedin.com/in/geowei', '90218-1637666577_image1.jpg', '83951-1637666577_image2.jpg', '', 0, 0, 0, '0', '5.5', 'andriod', 'user', '65tyy65', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-23 11:22:57', '2021-12-08 09:00:03'),
(262, 'linkedin', 'dIpOS2EhJY', 'Amit', 'Accountancy, banking, and finance', 'Shukla', 'nextbigtechnology@gmail.com', '2022-04-15 10:14:39', '14/01/2012', 10, 'Woman', 'Man', '26.96328,75.7690103', '26.96328', '75.7690103', '', '', '', '', '150', 'Something Casual', 'ISTJ', 'Aries', 'Moderate', 'Agnostic', 'Sometimes', 'Never', 'Never', 'www.linkedin.com/in/', '34079-1650017672_image1.jpg', '', '', 0, 0, 0, '0', '11', 'android', 'user', 'e-qgge38Qky7aivo0Fd9aQ:APA91bHMNG88B1FyAts5XQvVCLWvrhntDCHnV_EXpjq0CuhJm1BWQDCntlYUjilfJtRZJuAFAvpubBmG8miaMvd2d3BgjogXuZIUMeRLRsA8S-9meUDhP2DXd_BYVTVFkw4yKJQb84Jf', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-04-15 10:14:32', '2022-04-15 10:14:39'),
(263, 'linkedin', 'KWt04P45L_', 'सचिन', 'Accountancy, banking, and finance', 'कुमावत', 'sachin4kmt@gmail.com', '2022-10-04 17:22:50', '01/01/2017', 5, 'Man', 'Woman', '26.9633013,75.7690267', '26.9633013', '75.7690267', '', '', '', '', '150', 'A Relationship', 'ISTJ', 'Aries', 'Apolitical', 'Agnostic', 'Active', 'Socially', 'Socially', 'www.linkedin.com/in/', '65098-1650889928_image1.jpg', '', '', 0, 0, 0, '0', '12', 'android', 'user', 'cHzvRsCYT9W_PrBu0lDnST:APA91bHTvnA3n2emCCdA2vuDAUeo_oEqn1M_5sSsF91O8rbVr4YQnrbtLHA0CmZyXC1mgOWkx1T_6nbkFjPHR0dfSLS_gJaT2DZL0qh1fZ2YzfovUboeUVv0ibY_QaBfo7p82zOkIhQT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-04-25 12:32:08', '2022-10-04 17:22:50'),
(264, 'linkedin', 'vcuLXv8kt8', 'Ajay', 'Accountancy, banking, and finance', '', 'phogat975@gmail.com', '2023-01-17 05:00:44', '07/08/1991', 31, 'Man', 'Woman', '26.963307,75.7689876', '26.963307', '75.7689876', '', '', '', '', '181', 'A Relationship', 'ISTJ', 'Aries', 'Apolitical', 'Agnostic', 'Active', 'Socially', 'Socially', 'https://www.linkedin.com/in/ajay-phogat-9457638b', '46190-1666077890_image1.jpg', '', '', 0, 0, 0, '0', '11', 'andriod', 'user', 'dK2Dmo6MQpSl8EvcrCHw3A:APA91bGMu_5XmSA5NCT6dtWp0ON1UifODOxDjQRlUPxPxT-S5_RDRD2jUBhCvOJfb_lmT_hDJ3sEfta3og0Z1CbQn3ATWNHOktFaq33x-5lpREW2TQgMPcqFaoAscHw3YMmk-JF9Ag1s', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-10-18 07:24:50', '2023-01-17 05:00:44'),
(265, 'linkedin', '3LbR4fyQws', 'Rob', 'Accountancy, banking, and finance', 'test', 'rob@advantageprocessors.com', '2023-02-28 12:33:14', '01/01/2000', 23, 'Man', 'Woman', '40.2246244,-74.4896733', '40.2246244', '-74.4896733', '', '', '', '', '150', 'A Relationship', 'ISTJ', 'Scorpio', 'Moderate', 'Agnostic', 'Active', 'Socially', 'Never', 'https://www.linkedin.com/in/rob-langfeld-70680710b', '48320-1677587593_image1.jpg', '', '', 0, 0, 0, '0', '10', 'andriod', 'user', 'dtVL_47aSAWAA7N8N2kuCk:APA91bH8cjy9f71ggcEiDrAaT7s8lIQCPhTgn25SYrR3vXN3rtt-xPOa-3daPpwplzXrnYswaRyWMdTeH6soINSH09BgL1XCK4Yur7wlp1tBw3SpuMlZs_UIgpnROgh61EFUA5mYiUin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-02-28 12:33:13', '2023-02-28 12:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(250) NOT NULL,
  `image_url` varchar(1000) NOT NULL,
  `columName` varchar(120) NOT NULL,
  `created_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `fb_id`, `image_url`, `columName`, `created_time`) VALUES
(351, '919879879879', '919879879879_1382801570.jpg', 'image2', '2021-07-01 09:20:55.501689');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elr_api_token`
--
ALTER TABLE `elr_api_token`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_coupon`
--
ALTER TABLE `elr_coupon`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_coupon_used`
--
ALTER TABLE `elr_coupon_used`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_default_nicotine`
--
ALTER TABLE `elr_default_nicotine`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_email_settings`
--
ALTER TABLE `elr_email_settings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_faq`
--
ALTER TABLE `elr_faq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_follow`
--
ALTER TABLE `elr_follow`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_banner`
--
ALTER TABLE `elr_home_banner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_category`
--
ALTER TABLE `elr_home_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_contact`
--
ALTER TABLE `elr_home_contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_newsletter`
--
ALTER TABLE `elr_home_newsletter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_services`
--
ALTER TABLE `elr_home_services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_home_social_links`
--
ALTER TABLE `elr_home_social_links`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_likes`
--
ALTER TABLE `elr_likes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_other_pages`
--
ALTER TABLE `elr_other_pages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_payment_mode`
--
ALTER TABLE `elr_payment_mode`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_payment_status`
--
ALTER TABLE `elr_payment_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_questions`
--
ALTER TABLE `elr_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elr_roles`
--
ALTER TABLE `elr_roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_subadmin_access`
--
ALTER TABLE `elr_subadmin_access`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_users`
--
ALTER TABLE `elr_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_user_address`
--
ALTER TABLE `elr_user_address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_user_setting`
--
ALTER TABLE `elr_user_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `elr_vendor`
--
ALTER TABLE `elr_vendor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flag_user`
--
ALTER TABLE `flag_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`userid`),
  ADD UNIQUE KEY `fb_id` (`social_id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `elr_api_token`
--
ALTER TABLE `elr_api_token`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `elr_coupon`
--
ALTER TABLE `elr_coupon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_coupon_used`
--
ALTER TABLE `elr_coupon_used`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_default_nicotine`
--
ALTER TABLE `elr_default_nicotine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_email_settings`
--
ALTER TABLE `elr_email_settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `elr_faq`
--
ALTER TABLE `elr_faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `elr_follow`
--
ALTER TABLE `elr_follow`
  MODIFY `ID` bigint(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_banner`
--
ALTER TABLE `elr_home_banner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_category`
--
ALTER TABLE `elr_home_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_contact`
--
ALTER TABLE `elr_home_contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_newsletter`
--
ALTER TABLE `elr_home_newsletter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_services`
--
ALTER TABLE `elr_home_services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_home_social_links`
--
ALTER TABLE `elr_home_social_links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_likes`
--
ALTER TABLE `elr_likes`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_other_pages`
--
ALTER TABLE `elr_other_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_payment_mode`
--
ALTER TABLE `elr_payment_mode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_payment_status`
--
ALTER TABLE `elr_payment_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_questions`
--
ALTER TABLE `elr_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_roles`
--
ALTER TABLE `elr_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `elr_subadmin_access`
--
ALTER TABLE `elr_subadmin_access`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_users`
--
ALTER TABLE `elr_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `elr_user_address`
--
ALTER TABLE `elr_user_address`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_user_setting`
--
ALTER TABLE `elr_user_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elr_vendor`
--
ALTER TABLE `elr_vendor`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flag_user`
--
ALTER TABLE `flag_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
