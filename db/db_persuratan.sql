-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2023 at 01:19 PM
-- Server version: 8.0.33-0ubuntu0.22.10.2
-- PHP Version: 8.1.7-1ubuntu3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admdikti', 'Admin LLDIKTI'),
(2, 'admpts', 'Admin Perguruan Tinggi Swasta'),
(3, 'pegl', 'Pegawai LLDIKTI'),
(4, 'leadl', 'Kepala Lembaga Layanan Pendidikan Tinggi Wilayah XVI'),
(5, 'leadp', 'Pimpinan Sebuah Perguruan Tinggi'),
(6, 'sumin', 'Controlling'),
(7, 'guest', 'Tamu');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 8),
(1, 11),
(2, 5),
(2, 6),
(3, 11),
(4, 4),
(4, 7),
(4, 11),
(5, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 14),
(2, 15),
(2, 15),
(2, 20),
(3, 14),
(3, 19),
(4, 16),
(5, 17),
(5, 18),
(7, 34);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(90, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-03 02:02:47', 1),
(91, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 02:03:02', 1),
(92, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 22:22:58', 1),
(93, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-03 23:02:30', 1),
(94, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-03 23:05:42', 1),
(95, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 23:05:56', 1),
(96, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 23:06:19', 1),
(97, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-03 23:27:22', 1),
(98, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 23:29:39', 1),
(99, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-03 23:30:56', 1),
(100, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-03 23:31:06', 1),
(101, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-04 08:12:04', 1),
(102, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-04 08:12:24', 1),
(103, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-05 00:14:38', 1),
(104, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 00:22:10', 1),
(105, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 00:23:53', 1),
(106, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 02:19:49', 1),
(107, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-05 03:37:31', 1),
(108, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 03:38:35', 1),
(109, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 03:40:40', 1),
(110, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-05 06:01:49', 1),
(111, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 06:10:49', 1),
(112, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 07:02:55', 1),
(113, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-05 07:32:47', 1),
(114, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 07:33:00', 1),
(115, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 07:33:11', 1),
(116, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 07:33:35', 1),
(117, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-05 08:11:39', 1),
(118, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-05 08:43:59', 1),
(119, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-05 08:44:21', 1),
(120, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 00:02:59', 1),
(121, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 07:40:48', 1),
(122, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 14:35:06', 1),
(123, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 14:36:05', 1),
(124, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 14:37:52', 1),
(125, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 14:38:37', 1),
(126, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 15:30:21', 1),
(127, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 15:33:30', 1),
(128, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 15:52:08', 1),
(129, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 15:52:25', 1),
(130, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 15:52:36', 1),
(131, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 15:58:59', 1),
(132, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:05:47', 1),
(133, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:10:34', 1),
(134, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:13:57', 1),
(135, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:14:36', 1),
(136, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:15:20', 1),
(137, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:22:28', 1),
(138, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 16:23:49', 1),
(139, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:24:02', 1),
(140, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:24:15', 1),
(141, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:30:37', 1),
(142, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:40:42', 1),
(143, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:41:15', 1),
(144, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 16:41:26', 1),
(145, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:46:49', 1),
(146, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:54:39', 1),
(147, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 16:54:50', 1),
(148, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 16:55:01', 1),
(149, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 16:57:33', 1),
(150, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 17:01:50', 1),
(151, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 17:02:01', 1),
(152, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 17:02:20', 1),
(153, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 17:02:52', 1),
(154, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 17:03:02', 1),
(155, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 17:04:44', 1),
(156, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 17:07:45', 1),
(157, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 17:13:03', 1),
(158, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 17:19:30', 1),
(159, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 17:19:40', 1),
(160, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-06 17:19:52', 1),
(161, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 18:21:52', 1),
(162, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-06 23:05:08', 1),
(163, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-06 23:06:16', 1),
(164, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-07 00:59:41', 1),
(165, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-07 01:01:00', 1),
(166, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-07 05:55:22', 1),
(167, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-07 05:57:46', 1),
(168, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-07 06:11:37', 1),
(169, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-07 06:12:14', 1),
(170, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-07 07:28:28', 1),
(171, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-07 08:18:06', 1),
(172, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-07 08:19:51', 1),
(173, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-08 13:41:38', 1),
(174, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-08 13:42:54', 1),
(175, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-08 16:04:30', 1),
(176, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-08 21:26:49', 1),
(177, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-09 00:27:42', 1),
(178, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-09 00:31:21', 1),
(179, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-09 03:50:08', 1),
(180, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-09 03:53:15', 1),
(181, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-09 03:53:40', 1),
(182, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-09 04:51:19', 1),
(183, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-09 09:33:58', 1),
(184, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-09 10:03:25', 1),
(185, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 10:52:17', 1),
(186, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 10:53:26', 1),
(187, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 11:46:50', 1),
(188, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 11:47:30', 1),
(189, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-10 11:47:56', 1),
(190, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 11:48:09', 1),
(191, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 12:03:23', 1),
(192, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 12:08:05', 1),
(193, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-10 12:08:20', 1),
(194, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 12:10:01', 1),
(195, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 12:10:32', 1),
(196, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 12:41:45', 1),
(197, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 13:09:16', 1),
(198, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 13:12:02', 1),
(199, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 13:16:38', 1),
(200, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 13:33:05', 1),
(201, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 13:34:16', 1),
(202, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 13:36:59', 1),
(203, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 13:37:28', 1),
(204, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 14:59:04', 1),
(205, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-10 15:37:52', 1),
(206, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 15:40:00', 1),
(207, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-10 15:43:54', 1),
(208, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 15:44:15', 1),
(209, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-10 15:45:27', 1),
(210, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 15:48:46', 1),
(211, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 16:28:29', 1),
(212, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-10 16:28:45', 1),
(213, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-10 16:29:13', 1),
(214, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-10 16:38:44', 1),
(215, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-10 17:07:16', 1),
(216, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 17:07:35', 1),
(217, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-10 22:19:57', 1),
(218, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 02:23:58', 1),
(219, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 02:24:52', 1),
(220, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-11 02:25:29', 1),
(221, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-11 02:26:20', 1),
(222, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 02:26:34', 1),
(223, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 02:26:47', 1),
(224, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-11 02:27:21', 1),
(225, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 02:27:33', 1),
(226, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-11 02:28:29', 1),
(227, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 02:28:42', 1),
(228, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-11 02:32:17', 1),
(229, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-11 02:32:33', 1),
(230, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 02:49:27', 1),
(231, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 03:01:28', 1),
(232, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 03:10:18', 1),
(233, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 03:16:35', 1),
(234, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 03:17:36', 1),
(235, '127.0.0.1', 'apts', NULL, '2023-07-11 06:24:07', 0),
(236, '127.0.0.1', 'apts', NULL, '2023-07-11 06:25:09', 0),
(237, '127.0.0.1', 'apts', NULL, '2023-07-11 06:25:47', 0),
(238, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 06:26:20', 1),
(239, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 06:28:20', 1),
(240, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-11 06:30:03', 1),
(241, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 06:38:54', 1),
(242, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 08:17:54', 1),
(243, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 08:19:14', 1),
(244, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-11 15:29:32', 1),
(245, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 15:30:04', 1),
(246, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 16:08:20', 1),
(247, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-11 16:08:35', 1),
(248, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-11 16:38:53', 1),
(249, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-12 01:25:56', 1),
(250, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-12 01:30:11', 1),
(251, '127.0.0.1', 'apts@gmail.com', 15, '2023-07-12 01:31:56', 1),
(252, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-12 01:47:01', 1),
(253, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-12 02:02:40', 1),
(254, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-12 02:02:58', 1),
(255, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-12 02:11:17', 1),
(256, '127.0.0.1', 'poligon@gmail.com', 15, '2023-07-12 02:43:10', 1),
(257, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-12 02:43:28', 1),
(258, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-12 02:43:58', 1),
(259, '127.0.0.1', 'apts@gmail.com', NULL, '2023-07-12 02:44:56', 0),
(260, '127.0.0.1', 'poligon@gmail.com', 15, '2023-07-12 02:46:12', 1),
(261, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-12 02:49:27', 1),
(262, '127.0.0.1', 'poligon@gmail.com', 15, '2023-07-12 02:52:03', 1),
(263, '127.0.0.1', 'kalem', NULL, '2023-07-12 02:53:09', 0),
(264, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-12 02:53:28', 1),
(265, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 06:20:04', 1),
(266, '127.0.0.1', 'adminumgo', NULL, '2023-07-13 06:23:36', 0),
(267, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-13 06:59:26', 1),
(268, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:01:06', 1),
(269, '127.0.0.1', 'poligon', NULL, '2023-07-13 07:02:20', 0),
(270, '127.0.0.1', 'dirpoligon@gmail.com', 15, '2023-07-13 07:03:35', 1),
(271, '127.0.0.1', 'dirpoligon@gmail.com', 15, '2023-07-13 07:06:49', 1),
(272, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:08:33', 1),
(273, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:10:07', 1),
(274, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-13 07:10:53', 1),
(275, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:11:05', 1),
(276, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:11:20', 1),
(277, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-13 07:13:01', 1),
(278, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-13 07:27:35', 1),
(279, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-13 07:31:47', 1),
(280, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:32:07', 1),
(281, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:36:02', 1),
(282, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:37:31', 1),
(283, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-13 07:39:53', 1),
(284, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:40:16', 1),
(285, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:41:59', 1),
(286, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:44:57', 1),
(287, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-13 07:47:25', 1),
(288, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:48:00', 1),
(289, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:48:54', 1),
(290, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-13 07:49:11', 1),
(291, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-13 07:49:37', 1),
(292, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-13 07:50:39', 1),
(293, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 07:51:03', 1),
(294, '127.0.0.1', 'umgo@gmail.com', 17, '2023-07-13 07:51:17', 1),
(295, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-13 07:53:29', 1),
(296, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-13 07:55:43', 1),
(297, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-13 08:01:25', 1),
(298, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-13 08:03:38', 1),
(299, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-13 14:44:46', 1),
(300, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-14 01:15:13', 1),
(301, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-14 06:13:12', 1),
(302, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-14 15:32:52', 1),
(303, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-15 01:07:42', 1),
(304, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-15 08:00:20', 1),
(305, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-15 22:49:58', 1),
(306, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-16 02:13:41', 1),
(307, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-16 05:13:19', 1),
(308, '127.0.0.1', 'munawir', NULL, '2023-07-16 08:11:52', 0),
(309, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-16 08:11:59', 1),
(310, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-16 11:18:28', 1),
(311, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-16 11:21:06', 1),
(312, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-16 12:07:36', 1),
(313, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-16 15:29:18', 1),
(314, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-16 15:30:50', 1),
(315, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 01:45:28', 1),
(316, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-18 01:48:20', 1),
(317, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 02:00:26', 1),
(318, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-18 02:02:55', 1),
(319, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 02:12:50', 1),
(320, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-18 09:19:52', 1),
(321, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 09:21:04', 1),
(322, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-18 09:21:57', 1),
(323, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-18 09:24:40', 1),
(324, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-18 09:25:38', 1),
(325, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-18 09:31:44', 1),
(326, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 09:38:30', 1),
(327, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-18 19:56:29', 1),
(328, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-18 19:58:07', 1),
(329, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 21:57:26', 1),
(330, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-18 23:06:05', 1),
(331, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-18 23:11:37', 1),
(332, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-19 08:04:12', 1),
(333, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-19 08:04:22', 1),
(334, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-19 08:10:12', 1),
(335, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-20 03:02:44', 1),
(336, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-20 03:08:04', 1),
(337, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-20 03:15:56', 1),
(338, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-20 08:03:06', 1),
(339, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-20 09:11:13', 1),
(340, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-20 16:04:02', 1),
(341, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-20 16:53:35', 1),
(342, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-20 23:43:23', 1),
(343, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-21 02:52:17', 1),
(344, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-21 02:58:24', 1),
(345, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-21 03:01:16', 1),
(346, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-21 03:57:17', 1),
(347, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-21 05:50:27', 1),
(348, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-21 05:50:40', 1),
(349, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-21 05:50:58', 1),
(350, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-21 05:51:12', 1),
(351, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-21 05:51:38', 1),
(352, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-21 06:06:26', 1),
(353, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-21 06:09:43', 1),
(354, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-21 06:19:30', 1),
(355, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-21 07:30:45', 1),
(356, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-21 08:00:56', 1),
(357, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-22 14:16:53', 1),
(358, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-22 16:43:23', 1),
(359, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-22 16:43:46', 1),
(360, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 00:47:57', 1),
(361, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-23 01:12:13', 1),
(362, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 01:18:42', 1),
(363, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-23 01:21:31', 1),
(364, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-23 01:21:46', 1),
(365, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-23 01:22:04', 1),
(366, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-23 01:28:48', 1),
(367, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-23 01:29:37', 1),
(368, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 04:05:30', 1),
(369, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-23 05:09:59', 1),
(370, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-23 05:45:42', 1),
(371, '127.0.0.1', 'ung@gmail.com', 21, '2023-07-23 13:57:20', 1),
(372, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 14:44:34', 1),
(373, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 14:55:53', 1),
(374, '127.0.0.1', 'lamin', NULL, '2023-07-23 15:28:11', 0),
(375, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 15:28:37', 1),
(376, '127.0.0.1', 'lamin', NULL, '2023-07-23 15:31:53', 0),
(377, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 15:34:37', 1),
(378, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 23:43:32', 1),
(379, '127.0.0.1', 'minjeey', 25, '2023-07-23 23:45:16', 1),
(380, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 23:50:35', 1),
(381, '127.0.0.1', 'minjeey', NULL, '2023-07-23 23:50:54', 0),
(382, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-23 23:51:17', 1),
(383, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-25 13:11:14', 1),
(384, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-25 13:32:49', 1),
(385, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-25 16:41:06', 1),
(386, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-25 16:50:57', 1),
(387, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-25 17:46:21', 1),
(388, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-25 18:00:39', 1),
(389, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-25 18:01:15', 1),
(390, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-26 00:36:42', 1),
(391, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-26 00:36:58', 1),
(392, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-26 00:45:53', 1),
(393, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-26 01:03:07', 1),
(394, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-26 01:03:33', 1),
(395, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-26 01:30:12', 1),
(396, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-26 01:30:24', 1),
(397, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-26 01:30:45', 1),
(398, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-26 01:30:58', 1),
(399, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-26 01:34:32', 1),
(400, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-26 01:35:00', 1),
(401, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-26 01:35:13', 1),
(402, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-26 01:35:28', 1),
(403, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-26 03:27:41', 1),
(404, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-26 03:28:36', 1),
(405, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-26 03:44:31', 1),
(406, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-26 04:08:30', 1),
(407, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-26 04:09:01', 1),
(408, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-26 06:15:43', 1),
(409, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 07:07:13', 1),
(410, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 07:26:38', 1),
(411, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-27 07:41:32', 1),
(412, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 07:44:08', 1),
(413, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 08:50:25', 1),
(414, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 08:51:09', 1),
(415, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 08:51:50', 1),
(416, '127.0.0.1', 'minjeey@minjeey.com', 27, '2023-07-27 08:53:31', 1),
(417, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:03:54', 1),
(418, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:29:10', 1),
(419, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:30:12', 1),
(420, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:32:19', 1),
(421, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:32:40', 1),
(422, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:33:24', 1),
(423, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:34:39', 1),
(424, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:34:59', 1),
(425, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:35:14', 1),
(426, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:35:33', 1),
(427, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 09:35:58', 1),
(428, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-27 09:36:13', 1),
(429, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 09:36:30', 1),
(430, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 09:36:56', 1),
(431, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 10:01:00', 1),
(432, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-27 10:21:10', 1),
(433, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 10:24:52', 1),
(434, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 10:25:02', 1),
(435, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 14:07:02', 1),
(436, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 18:33:11', 1),
(437, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 18:33:23', 1),
(438, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 18:33:50', 1),
(439, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 18:34:01', 1),
(440, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-27 18:38:44', 1),
(441, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 18:38:54', 1),
(442, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 19:13:04', 1),
(443, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 19:16:40', 1),
(444, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-27 19:20:34', 1),
(445, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 19:26:22', 1),
(446, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 19:26:34', 1),
(447, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 19:28:54', 1),
(448, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 19:41:26', 1),
(449, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 19:48:23', 1),
(450, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 19:50:52', 1),
(451, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 19:51:51', 1),
(452, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 19:52:08', 1),
(453, '127.0.0.1', 'Minjeey@gmail.com', 33, '2023-07-27 20:06:27', 1),
(454, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-27 20:11:27', 1),
(455, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 20:14:00', 1),
(456, '127.0.0.1', 'Minjeey@gmail.com', 33, '2023-07-27 20:31:05', 1),
(457, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 20:32:13', 1),
(458, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-27 20:44:34', 1),
(459, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-27 20:45:18', 1),
(460, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 20:45:46', 1),
(461, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-27 21:11:06', 1),
(462, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 21:13:11', 1),
(463, '127.0.0.1', 'dirumgo@gmail.com', 17, '2023-07-27 21:19:39', 1),
(464, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-27 21:19:53', 1),
(465, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 03:42:16', 1),
(466, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-28 03:42:45', 1),
(467, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 03:44:41', 1),
(468, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 03:48:32', 1),
(469, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 04:06:18', 1),
(470, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-28 04:09:28', 1),
(471, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 04:17:43', 1),
(472, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-28 04:17:56', 1),
(473, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 04:18:50', 1),
(474, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 06:31:37', 1),
(475, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 06:40:30', 1),
(476, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 06:45:29', 1),
(477, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 06:45:55', 1),
(478, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 06:46:06', 1),
(479, '127.0.0.1', 'lowry@gmail.com', 19, '2023-07-28 06:46:33', 1),
(480, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 06:46:51', 1),
(481, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 06:47:07', 1),
(482, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 06:52:45', 1),
(483, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 07:02:15', 1),
(484, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 07:02:55', 1),
(485, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 07:05:00', 1),
(486, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 07:05:33', 1),
(487, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 07:10:46', 1),
(488, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 07:24:04', 1),
(489, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 07:24:45', 1),
(490, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 07:25:46', 1),
(491, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 07:28:32', 1),
(492, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 07:32:07', 1),
(493, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 08:16:03', 1),
(494, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 08:18:57', 1),
(495, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 09:19:06', 1),
(496, '127.0.0.1', 'adumgo@gmail.com', 20, '2023-07-28 10:34:46', 1),
(497, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 10:38:23', 1),
(498, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 12:45:13', 1),
(499, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 12:59:32', 1),
(500, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 13:02:24', 1),
(501, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 13:02:50', 1),
(502, '127.0.0.1', 'admnpoligon', NULL, '2023-07-28 13:04:13', 0),
(503, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 13:04:41', 1),
(504, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 13:05:18', 1),
(505, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 13:06:19', 1),
(506, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 13:18:00', 1),
(507, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-28 13:19:09', 1),
(508, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 13:19:39', 1),
(509, '127.0.0.1', 'laminhdataulamin2@gmail.com', 34, '2023-07-28 13:22:04', 1),
(510, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-28 15:08:38', 1),
(511, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 15:12:32', 1),
(512, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-28 15:16:00', 1),
(513, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 02:18:31', 1),
(514, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 02:51:40', 1),
(515, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 02:53:21', 1),
(516, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 02:59:21', 1),
(517, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 03:05:20', 1),
(518, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 04:22:40', 1),
(519, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 04:24:05', 1),
(520, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 04:30:42', 1),
(521, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 04:41:56', 1),
(522, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 04:44:13', 1),
(523, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 15:51:14', 1),
(524, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 16:17:57', 1),
(525, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 17:17:02', 1),
(526, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 17:21:06', 1),
(527, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 17:21:22', 1),
(528, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 18:05:17', 1),
(529, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 18:11:06', 1),
(530, '127.0.0.1', 'munawir@gmail.com', 16, '2023-07-29 18:30:08', 1),
(531, '127.0.0.1', 'adikti@gmail.com', 14, '2023-07-29 18:34:23', 1),
(532, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-29 18:36:47', 1),
(533, '127.0.0.1', 'dirpoligon@gmail.com', 18, '2023-07-30 02:13:02', 1),
(534, '127.0.0.1', 'admpoligon@gmail.com', 15, '2023-07-30 05:15:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(3, 'm-user', 'Mengontrol User'),
(4, 'm-profile', 'Menontrol Profile'),
(5, 'm-smpts', 'Mengelola Surat Masuk Pts'),
(6, 'm-skpts', 'Mengelola Surat Keluar Pts'),
(7, 'm-smd', 'Mengelola Surat Masuk LLdikti'),
(8, 'm-skd', 'Mengelola Surat Keluar LLdikti'),
(9, 'm-menu', 'Mengelola Menu'),
(10, 'm-kop', 'management kop surat'),
(11, 'm-st', 'Mengelola Surat Tugas');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_users_permissions`
--

INSERT INTO `auth_users_permissions` (`user_id`, `permission_id`) VALUES
(14, 8),
(14, 11),
(15, 6),
(16, 7),
(16, 11),
(17, 5),
(18, 5),
(19, 8),
(19, 11),
(20, 6),
(20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1686904740, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_akses_menu`
--

CREATE TABLE `t_akses_menu` (
  `id_user` int UNSIGNED NOT NULL,
  `id_pegawai` varchar(255) NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_akses_menu`
--

INSERT INTO `t_akses_menu` (`id_user`, `id_pegawai`, `id_menu`) VALUES
(16, '761c7ed7-2966-11ee-b728-503eaa456e2a', 1),
(16, '761c7ed7-2966-11ee-b728-503eaa456e2a', 3),
(19, '761caa82-2966-11ee-b728-503eaa456e2a', 3),
(19, '761caa82-2966-11ee-b728-503eaa456e2a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_disposisi`
--

CREATE TABLE `t_disposisi` (
  `id_surat_dispos` varchar(255) NOT NULL,
  `id_jenis_surat` int DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `id_pegawai_tujuan` varchar(255) NOT NULL,
  `tanggal_disposisi` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_instruksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_disposisi`
--

INSERT INTO `t_disposisi` (`id_surat_dispos`, `id_jenis_surat`, `user_id`, `id_pegawai_tujuan`, `tanggal_disposisi`, `id_instruksi`) VALUES
('ef271709-d8ce-4969-b7a0-45c2e7b300ac', 3, 16, '32', '2023-07-23 09:33:01', '14,16,45,52'),
('0fce4579-72f0-4b1d-9b37-784c8f2af1d3', 3, 16, '761c7b75-2966-11ee-b728-503eaa456e2a,761c7d44-2966-11ee-b728-503eaa456e2a,761c7ed7-2966-11ee-b728-503eaa456e2a', '2023-07-26 11:55:44', '1,11'),
('ad797bf9-6865-40e8-b35d-52d84eb484aa', 3, 16, '761caa82-2966-11ee-b728-503eaa456e2a', '2023-07-26 13:06:48', '4,8'),
('b4e5ba5d-b52f-45db-b091-026b52d4a3ff', 3, 16, '761c7b75-2966-11ee-b728-503eaa456e2a,761c843a-2966-11ee-b728-503eaa456e2a', '2023-07-28 14:37:58', '5'),
('ded396bc-5dbc-4089-8235-cac165edfac8', 3, 16, '761ca565-2966-11ee-b728-503eaa456e2a', '2023-07-28 14:40:16', '2'),
('da3de7a7-17f7-4c7e-9ad5-a610e2416458', 3, 16, '761ca565-2966-11ee-b728-503eaa456e2a', '2023-07-28 14:54:04', '1,4'),
('d263bcc9-19d3-4763-858d-4109c75d9dc9', 3, 16, '761ca565-2966-11ee-b728-503eaa456e2a', '2023-07-28 15:03:46', '22'),
('b458c53b-67f4-46d7-b86b-a7e4d40f03a6', 3, 16, '761ca565-2966-11ee-b728-503eaa456e2a', '2023-07-28 15:05:56', '22'),
('a2d37283-be64-453b-bbea-44652d53a1c1', 3, 16, '761ca565-2966-11ee-b728-503eaa456e2a', '2023-07-28 15:25:05', '4');

-- --------------------------------------------------------

--
-- Table structure for table `t_instansi`
--

CREATE TABLE `t_instansi` (
  `id_instansi` varchar(255) NOT NULL,
  `nm_instansi` varchar(255) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_wilayah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_instansi`
--

INSERT INTO `t_instansi` (`id_instansi`, `nm_instansi`, `alamat`, `telepon`, `email`, `id_wilayah`) VALUES
('782909e8-09b4-11ee-8c85-503eaa456e2a', 'LLDIKTI WILAYAH XVI', 'Dungingi', '082', 'lldikti@gmail.com', 1),
('7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'Politeknik Gorontalo', 'Botupingge', '082u9', 'poligon@gmail.com', 1),
('efd7abb5-1bfa-11ee-a355-503eaa456e2a', 'UMGO', 'A', '0812', 'umgo@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_instruksi`
--

CREATE TABLE `t_instruksi` (
  `id_instruksi` int NOT NULL,
  `instruksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_instruksi`
--

INSERT INTO `t_instruksi` (`id_instruksi`, `instruksi`) VALUES
(1, 'Abaikan/ Surat Tidak Relevan\r'),
(2, 'Agar menunjuk staf yang tidak kompeten\r'),
(3, 'Agendakan\r'),
(4, 'Arsipkan\r'),
(5, 'Beri Ijin\r'),
(6, 'Catat dan Arsipkan\r'),
(7, 'Cek Status/Perkembangan dan Laporkan\r'),
(8, 'Dibantu/Dipenuhi\r'),
(9, 'Diberi Penjelasan\r'),
(10, 'Diedarkan\r'),
(11, 'Diketahui\r'),
(12, 'Dipelajari\r'),
(13, 'Diperintahkan\r'),
(14, 'Ditindaklanjuti\r'),
(15, 'Hadiri sesuai undangan\r'),
(16, 'Harap Mewakili\r'),
(17, 'Jadwalkan\r'),
(18, 'Koordinasi antar bidang terkait\r'),
(19, 'Mohon dikoordinasikan\r'),
(20, 'Mohon diproses sesuai aturan\r'),
(21, 'Mohon mewakili\r'),
(22, 'Setuju/ACC\r'),
(23, 'Siapkan tangapan/Saran tertulis\r'),
(24, 'Tugaskan staf\r'),
(25, 'Untuk diketahui/diperhatikan\r'),
(26, 'Untuk dipedomani\r'),
(27, 'Adakan Rapat\r'),
(28, 'Agar Mewakili\r'),
(29, 'Arsip Elektronik\r'),
(30, 'Bahas Bersama\r'),
(31, 'Buatkan Surtug\r'),
(32, 'Catatkan/Jadwalkan/Ingatkan\r'),
(33, 'Diagendakan\r'),
(34, 'Diberi Masukan\r'),
(35, 'Dibicarakan dengan saya\r'),
(36, 'Dijawab dengan Surat\r'),
(37, 'Dilaksanakan\r'),
(38, 'Dipelajari dan Laporkan\r'),
(39, 'Diproses sesuai ketentuan yang berlaku\r'),
(40, 'Disiapkan sambutan tertulis\r'),
(41, 'Diwakili/Mewakilkan\r'),
(42, 'Hadiri/Wakili\r'),
(43, 'Ikut Hadir\r'),
(44, 'Jadwalkan/Ingatkan\r'),
(45, 'Mohon dapat mendamping\r'),
(46, 'Mohon dipedomani\r'),
(47, 'Mohon menyiapkan bahan/Konsep jawaban\r'),
(48, 'Mohon saran/Pertimbangan\r'),
(49, 'Siapkan konsep surat jawaban\r'),
(50, 'Tugaskan Petugas Yang Relevan\r'),
(51, 'Tugaskan yang bersangkutan\r'),
(52, 'Untuk dilaksanakan\r'),
(53, 'Untuk diselesaikan\r');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_surat`
--

CREATE TABLE `t_jenis_surat` (
  `id_jenis_surat` int NOT NULL,
  `jenis_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_jenis_surat`
--

INSERT INTO `t_jenis_surat` (`id_jenis_surat`, `jenis_surat`) VALUES
(0, 'NULL'),
(1, 'Surat Masuk PTS'),
(2, 'Surat Keluar PTS'),
(3, 'Surat Masuk LLDIKTI'),
(4, 'Surat Keluar LLDIKTI'),
(5, 'Nota Dinas LLDIKTI'),
(6, 'Surat Tugas');

-- --------------------------------------------------------

--
-- Table structure for table `t_kop_surat`
--

CREATE TABLE `t_kop_surat` (
  `id_kop` int NOT NULL,
  `head` text NOT NULL,
  `sub_head` text NOT NULL,
  `lokasi` text NOT NULL,
  `alamat_jl` text NOT NULL,
  `laman` text NOT NULL,
  `email` text NOT NULL,
  `helpdesk_wa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_kop_surat`
--

INSERT INTO `t_kop_surat` (`id_kop`, `head`, `sub_head`, `lokasi`, `alamat_jl`, `laman`, `email`, `helpdesk_wa`) VALUES
(1, 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,\r\nRISET, DAN TEKNOLOGI', 'LEMBAGA LAYANAN PENDIDIKAN TINGGI\r\nWILAYAH XVI', 'Eks. Kantor Balai Pelestarian Cagar Budaya (BPCB)', 'Jl. Anggur, Huangobotu, Dungingi Kota Gorontalo, Provinsi Gorontalo, 96138', 'https://lldikti16.kemdikbud.go.id/', 'lldikti16_gtlo@kemdikbud.go.id', '0877-60-161616');

-- --------------------------------------------------------

--
-- Table structure for table `t_menu`
--

CREATE TABLE `t_menu` (
  `id_menu` int NOT NULL,
  `menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_menu`
--

INSERT INTO `t_menu` (`id_menu`, `menu`) VALUES
(1, 'Surat Masuk LLDIKTI'),
(2, 'Surat Keluar LLDIKTI'),
(3, 'Surat Tugas'),
(5, 'Menu'),
(6, 'Sub Menu'),
(7, 'Users'),
(8, 'Reff Surat'),
(9, 'Akses Menu'),
(14, 'Surat Masuk PTS'),
(15, 'Surat Keluar PTS'),
(16, 'Nota Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `t_pegawai_pts`
--

CREATE TABLE `t_pegawai_pts` (
  `id_pegawai` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nip` char(18) NOT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tmpt_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `jenis_pegawai` varchar(50) DEFAULT NULL,
  `id_instansi` varchar(50) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_pegawai_pts`
--

INSERT INTO `t_pegawai_pts` (`id_pegawai`, `nama_lengkap`, `nip`, `pangkat`, `golongan`, `jabatan`, `tmpt_lahir`, `tanggal_lahir`, `jenis_kelamin`, `jenis_pegawai`, `id_instansi`, `keterangan`) VALUES
('14884258-2cfe-11ee-bd09-503eaa456e2a', 'Zaka', '93u049434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', NULL),
('41c7d520-2c8e-11ee-bd09-503eaa456e2a', 'Ismail Mohidin', '10212791721', '1', '1', '1', '1', '2023-07-27', 'Laki-laki', '1', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_reff_surat`
--

CREATE TABLE `t_reff_surat` (
  `id_reff_surat` int NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `perihal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_reff_surat`
--

INSERT INTO `t_reff_surat` (`id_reff_surat`, `nomor_surat`, `perihal`) VALUES
(11, 'PR.01.06', 'Ketentuan/Peraturan yang menyangkut perencanaan, Pelaksanaan, Penatausahaan dan Pertanggungjawaban Anggaran yang dikeluarkan oleh Kementerian'),
(12, 'PR.02.00', 'Usulan Unit Kerja beserta Data Pendukung'),
(13, 'PR.02.01', 'Usulan dari Kemendikbudristek'),
(14, 'PR.02.02', 'Program Kerja Tahunan Unit Kerja'),
(15, 'PR.02.03', 'Program Kerja Tahunan Kementerian'),
(16, 'PR.02.04', 'Naskah Kebijakan: Bahan Rapat kerja, Rapat Dengar Pendapat, dan Sidang Kabinet'),
(17, 'PR.02.05', 'Koordinasi kebijakan pembangunan pendidikan, kebudayaan, ilmu pengetahuan dan teknologi antar Kementerian/ Lembaga'),
(18, 'PR.03.00', 'Menteri'),
(19, 'PR.03.01', 'Pimpinan Unit Kerja'),
(20, 'PR.03.02', 'Pejabat Pimpinan Tinggi Madya'),
(21, 'PR.04.00', 'Laporan Insidental'),
(22, 'PR.04.01', 'Laporan Berkala'),
(23, 'PR.04.02', 'Laporan Tahunan'),
(24, 'PR.04.03', 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP)'),
(25, 'PR.05.00', 'Rencana Strategis'),
(26, 'PR.05.01', 'Rencana kinerja tahunan'),
(27, 'PR.05.02', 'Perjanjian kinerja'),
(28, 'PR.05.03', 'Rencana Aksi'),
(29, 'PR.05.04', 'Pengukuran kinerja'),
(30, 'PR.06.00', 'Monitoring'),
(31, 'PR.06.01', 'Evaluasi Program Unit Kerja'),
(32, 'PR.06.02', 'Evaluasi Program Kementerian'),
(33, 'PR.07.00', 'Rencana Kerja Tahunan (RKT)'),
(34, 'PR.07.01', 'Penelaahan dan Penyelarasan Rencana Kerja Anggaran (RKA)'),
(35, 'PR.07.02', 'Penyusunan Rencana Program dan Anggaran serta Sasaran dan Asistensi'),
(36, 'PR.07.03', 'Koordinasi Penyusunan Rencana Kerja Anggaran - Kementerian/Lembaga Alokasi Anggaran'),
(37, 'PR.07.04', 'Perencanaan dan Penganggaran'),
(38, 'PR.07.05', 'Sinkronisasi Kebijakan dan Perencanaan'),
(39, 'PR.08.00', 'Koordinasi Pengesahan Revisi Anggaran'),
(40, 'PR.09.00', 'Dokumen Perencanaan anggaran'),
(41, 'KU.00.00', 'Penyiapan bahan pengangkatan pejabat perbendaharaan'),
(42, 'KU.00.01', 'Penilaian dan verifikasi usul calon pejabat perbendaharaan'),
(43, 'KU.00.02', 'Inventarisasi dan penyusunan informasi pejabat perbendaharaan'),
(44, 'KU.00.03', 'Pemantauan rekening pemerintah lainnya'),
(45, 'KU.00.04', 'Penyiapan pertimbangan tuntutan perbendaharaan'),
(46, 'KU.01.00', 'Ketentuan/Peraturan Menteri Keuangan yang menyangkut Pelaksanaan, Penatausahaan dan Pertanggungjawaban Anggaran'),
(47, 'KU.01.01', 'Dokumen Realisasi Pendapatan'),
(48, 'KU.01.02', 'Belanja'),
(49, 'KU.01.03', 'Badan Layanan Umum'),
(50, 'KU.02.00', 'Pengumpulan data laporan hasil pemeriksaan dan kerugian negara'),
(51, 'KU.02.01', 'Penyiapan penyelesaian masalah kerugian negara'),
(52, 'KU.02.02', 'Penyiapan tindak lanjut hasil pemeriksaan kerugian negara'),
(53, 'KU.02.03', 'Penghitungan penetapan jumlah kerugian negara'),
(54, 'KU.02.04', 'Penyiapan pembebanan penggantian kerugian sementara'),
(55, 'KU.03.00', 'Berita Acara Rekonsiliasi'),
(56, 'KU.03.01', 'Daftar Transaksi (DT)'),
(57, 'KU.03.02', 'Laporan Keuangan'),
(58, 'KU.04.00', 'Penyusunan usulan rencana penerimaan negara bukan pajak'),
(59, 'KU.04.01', 'Realisasi penerimaan negara bukan pajak'),
(60, 'KU.04.02', 'Penyusunan tarif penerimaan negara bukan pajak'),
(61, 'KU.04.03', 'Pemantauan dan evaluasi realisasi penggunaan penerimaan negara bukan pajak'),
(62, 'KU.06.00', 'Penghapusan piutang negara'),
(63, 'KU.06.01', 'Penyiapan pengurusan piutang negara'),
(64, 'KU.07.00', 'Dalam Negeri'),
(65, 'KU.07.01', 'Luar Negeri'),
(66, 'KU.09.00', 'Keputusan pengguna anggaran tentang Penetapan'),
(67, 'KS.00', 'Dalam Negeri'),
(68, 'KS.00.00', 'Luar Negeri ; Bilateral, Multilateral, dan Regional'),
(69, 'KS.01.00', 'Pengelolaan Data dan Informasi'),
(70, 'KS.01.01', 'Penyajian Data dan Informasi'),
(71, 'KS.02.00', 'Pendampingan Pelatihan Perencanaan Pendidikan dengan United Nations of Educational Scientific Cultural and Organization (UNESCO)'),
(72, 'KS.02.01', 'Pendampingan Pelatihan Perencanaan Pendidikan dengan Kedutaan Besar Republik Indonesia (KBRI) di Luar Negeri'),
(73, 'KS.03.00', 'Dalam Negeri'),
(74, 'KS.03.01', 'Luar Negeri ; Bilateral, Multilateral, dan Regional'),
(75, 'KS.04.00', 'Fasilitasi layanan kunjungan delegasi asing ke Indonesia'),
(76, 'KS.04.01', 'Fasilitasi layanan kunjungan pimpinan dan pegawai negeri sipil di lingkungan Kementerian serta non pegawai negeri sipil yang ditugaskan oleh Kementerian ke luar negeri'),
(77, 'KS.05.00', 'Dalam Negeri'),
(78, 'KS.05.01', 'Luar Negeri ; Bilateral, Multilateral, dan Regional'),
(79, 'KS.06.01', 'Layanan Duta Besar/Wakil Republik Indonesia , United Nations of Educational Scientific Cultural and Organization (UNESCO) dan Atase Pendidikan dan Kebudayaan.'),
(80, 'KS.06.02', 'Layanan Pendidikan dan Latihan Masyarakat Luar Negeri'),
(81, 'KS.07.00', 'Beasiswa Darmasiswa Republik Indonesia'),
(82, 'KS.07.01', 'Beasiswa Unggulan'),
(83, 'KS.08.00', 'Fasilitasi Layanan Atase Pendidikan dan Kebudayaan, Kepala Sekolah dan Guru Indonesia'),
(84, 'KS.08.01', 'Seleksi dan Penetapan Kepala Sekolah dan Guru Indonesia'),
(85, 'KS.08.02', 'Kerja sama Kemitraan dengan Lembaga Terkait'),
(86, 'KS.09.00', 'Fasilitas Layanan Kerja Sama'),
(87, 'KS.09.01', 'Peningkatan Jaringan Kerja Sama'),
(88, 'KS.09.02', 'Percepatan, Evaluasi, dan Pelaporan Implementasi ESD di Indonesia'),
(89, 'KP.00.00', 'Formasi (usul, penetapan, pengendalian)'),
(90, 'KP.01.00', 'Penyiapan Bahan Seleksi Penerimaan CASN (PNS DAN PPPK)'),
(91, 'KP.01.01', 'Proses Seleksi Penerimaan CASN'),
(92, 'KP.01.02', 'Berkas lamaran pegawai yang tidak diterima'),
(93, 'KP.01.03', 'Nota Usul dan kelengkapan penetapan NIP CASN'),
(94, 'KP.01.04', 'Penetapan Pengangkatan CASN'),
(95, 'KP.01.05', 'Pelatihan Dasar CASN'),
(96, 'KP.01.06', 'Penetapan CASN menjadi ASN'),
(97, 'KP.02.00', 'Ujian Penyesuaian Ijazah'),
(98, 'KP.02.01', 'Ujian Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `t_sifat`
--

CREATE TABLE `t_sifat` (
  `id_sifat` int NOT NULL,
  `sifat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_sifat`
--

INSERT INTO `t_sifat` (`id_sifat`, `sifat`) VALUES
(1, 'Penting'),
(2, 'Rahasia'),
(3, 'Biasa'),
(4, 'Segera'),
(5, 'Sangat Segera');

-- --------------------------------------------------------

--
-- Table structure for table `t_status`
--

CREATE TABLE `t_status` (
  `id_status` int NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_status`
--

INSERT INTO `t_status` (`id_status`, `status`) VALUES
(0, '0'),
(1, 'Disetujui'),
(2, 'Revisi'),
(3, 'Ditolak'),
(4, 'Tertunda'),
(5, 'Dilihat'),
(6, 'Diteruskan'),
(7, 'Dilaporkan'),
(8, 'Terkirim'),
(9, 'Dikirim'),
(10, 'Terkonfirmasi'),
(11, 'Didisposisi'),
(12, 'Diverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_menu`
--

CREATE TABLE `t_sub_menu` (
  `id_sub_menu` int NOT NULL,
  `id_menu` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_sub_menu`
--

INSERT INTO `t_sub_menu` (`id_sub_menu`, `id_menu`, `title`, `url`, `icon`, `is_active`) VALUES
(8, 5, 'Menu', 'menu', 'home', 1),
(12, 6, 'Sub Menu', 'submenu', 'home', 1),
(13, 8, 'Referensi Surat', 'reffSurat', 'envelope', 1),
(14, 1, 'Surat Masuk LLDIKTI', 'suratmasukl', 'envelope', 1),
(15, 2, 'Surat Keluar LLDIKTI', 'suratkeluarl', 'envelope', 1),
(16, 14, 'Surat Masuk PTS', 'suratmasukp', 'envelope', 1),
(17, 15, 'Surat Keluar PTS', 'suratkeluarp', 'envelope', 1),
(18, 7, 'Data Users', 'pengguna', 'users', 1),
(19, 3, 'Surat Tugas', 'surattugas', 'envelope', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_surat`
--

CREATE TABLE `t_surat` (
  `id_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `id_sifat` int DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `id_jenis_surat` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `id_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'FROM',
  `tembusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `filex` varchar(255) NOT NULL,
  `id_pegawai` int UNSIGNED NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_sendto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'SEND TO',
  `dilihat_oleh` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stts_confirm` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_surat`
--

INSERT INTO `t_surat` (`id_surat`, `nomor_surat`, `id_sifat`, `tgl_surat`, `id_jenis_surat`, `is_active`, `id_instansi`, `tembusan`, `filex`, `id_pegawai`, `perihal`, `id_sendto`, `dilihat_oleh`, `created_at`, `stts_confirm`, `created_by`) VALUES
('3b708026-2c39-452f-93c0-8d616aa41282', 'jivudu', 2, '2023-07-29', 1, 0, '782909e8-09b4-11ee-8c85-503eaa456e2a', 'ijoiducd', '1690655689_9c67ef50c8a1db17bbf5.pdf', 0, 'jnisnds', NULL, '[\"dirpoligon@gmail.com\"]', '2023-07-30 02:34:49', '1', '14');

--
-- Triggers `t_surat`
--
DELIMITER $$
CREATE TRIGGER `batal` BEFORE UPDATE ON `t_surat` FOR EACH ROW BEGIN
    IF NEW.stts_confirm = '2' AND OLD.stts_confirm <> '2' THEN
        DELETE FROM t_template_wil WHERE id_surat = NEW.id_surat;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapusverifikasisurat` AFTER DELETE ON `t_surat` FOR EACH ROW BEGIN
    DELETE FROM t_verifikasi WHERE id_surat = OLD.id_surat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_tugas`
--

CREATE TABLE `t_surat_tugas` (
  `id_surat_tugas` varchar(255) NOT NULL,
  `id_jenis_surat` int NOT NULL,
  `id_nomor_surat` varchar(255) DEFAULT NULL,
  `tanggal_terbit` datetime DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tujuan_surat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tempat_pelaksanaan` text NOT NULL,
  `tembusan` varchar(255) DEFAULT NULL,
  `qr_code_image_path` varchar(255) DEFAULT NULL,
  `id_penandatangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_active` int NOT NULL,
  `verifikator` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `seeto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `dasar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_surat_tugas`
--

INSERT INTO `t_surat_tugas` (`id_surat_tugas`, `id_jenis_surat`, `id_nomor_surat`, `tanggal_terbit`, `tgl_selesai`, `tgl_mulai`, `tujuan_surat`, `tempat_pelaksanaan`, `tembusan`, `qr_code_image_path`, `id_penandatangan`, `is_active`, `verifikator`, `seeto`, `create_at`, `created_by`, `dasar`) VALUES
('3fc3f26b-dcc5-4796-809f-945fe92dff1d', 6, '05/LL16/PR.01.06/2023', '2023-07-29 18:31:06', '2023-08-03', '2023-07-30', 'ksmdksd', 'jknkckd', '', 'assets/docsurgas/qrcode/3fc3f26b-dcc5-4796-809f-945fe92dff1d.jpg', '761c7ed7-2966-11ee-b728-503eaa456e2a', 1, '761ca565-2966-11ee-b728-503eaa456e2a', NULL, '2023-07-30 02:24:16', 14, 'JKDNIU'),
('b27a628f-9d7d-471e-adfe-ec0a553be320', 6, '03/LL16/PR.01.06/2023', '2023-07-29 18:30:59', '2023-07-31', '2023-07-30', 'jfiei', 'jirfeire', '', 'assets/docsurgas/qrcode/b27a628f-9d7d-471e-adfe-ec0a553be320.jpg', '761c7ed7-2966-11ee-b728-503eaa456e2a', 1, '761ca565-2966-11ee-b728-503eaa456e2a', NULL, '2023-07-30 01:55:40', 14, 'fnidfnjf');

--
-- Triggers `t_surat_tugas`
--
DELIMITER $$
CREATE TRIGGER `hapusverifikasi` AFTER DELETE ON `t_surat_tugas` FOR EACH ROW BEGIN
    DELETE FROM t_verifikasi WHERE id_surat = OLD.id_surat_tugas;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_tugas_pegawai`
--

CREATE TABLE `t_surat_tugas_pegawai` (
  `id_surat_tugas` varchar(255) NOT NULL,
  `id_pegawai_string` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_surat_tugas_pegawai`
--

INSERT INTO `t_surat_tugas_pegawai` (`id_surat_tugas`, `id_pegawai_string`) VALUES
('b27a628f-9d7d-471e-adfe-ec0a553be320', '761c7d44-2966-11ee-b728-503eaa456e2a,761c843a-2966-11ee-b728-503eaa456e2a'),
('3fc3f26b-dcc5-4796-809f-945fe92dff1d', '761c7b75-2966-11ee-b728-503eaa456e2a,761c7d44-2966-11ee-b728-503eaa456e2a');

-- --------------------------------------------------------

--
-- Table structure for table `t_template_wil`
--

CREATE TABLE `t_template_wil` (
  `id_surat` varchar(255) NOT NULL,
  `id_template_wil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_wilayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_template_wil`
--

INSERT INTO `t_template_wil` (`id_surat`, `id_template_wil`, `id_wilayah`) VALUES
('3b708026-2c39-452f-93c0-8d616aa41282', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_pegawai`
--

CREATE TABLE `t_user_pegawai` (
  `id_user` int NOT NULL,
  `id_pegawai` varchar(255) NOT NULL,
  `id_wilayah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_user_pegawai`
--

INSERT INTO `t_user_pegawai` (`id_user`, `id_pegawai`, `id_wilayah`) VALUES
(14, '761ca565-2966-11ee-b728-503eaa456e2a', 1),
(18, '41c7d520-2c8e-11ee-bd09-503eaa456e2a', 1),
(15, '14884258-2cfe-11ee-bd09-503eaa456e2a', 1),
(16, '761c7ed7-2966-11ee-b728-503eaa456e2a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_verifikasi`
--

CREATE TABLE `t_verifikasi` (
  `id_surat` varchar(255) NOT NULL,
  `id_status` int NOT NULL,
  `wkt_verifikasi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_verifikasi`
--

INSERT INTO `t_verifikasi` (`id_surat`, `id_status`, `wkt_verifikasi`, `id_user`) VALUES
('b27a628f-9d7d-471e-adfe-ec0a553be320', 12, '2023-07-30 02:23:15', 14),
('3fc3f26b-dcc5-4796-809f-945fe92dff1d', 12, '2023-07-30 02:29:56', 14),
('b27a628f-9d7d-471e-adfe-ec0a553be320', 1, '2023-07-30 02:30:59', 16),
('3fc3f26b-dcc5-4796-809f-945fe92dff1d', 1, '2023-07-30 02:31:06', 16),
('3b708026-2c39-452f-93c0-8d616aa41282', 8, '2023-07-30 02:36:07', 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_wilayah`
--

CREATE TABLE `t_wilayah` (
  `id_wilayah` int NOT NULL,
  `wilayah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_wilayah`
--

INSERT INTO `t_wilayah` (`id_wilayah`, `wilayah`) VALUES
(1, 'Gorontalo'),
(2, 'Sulawesi Tengah'),
(3, 'Sulawesi Utara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `user_image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'adikti@gmail.com', 'adikti', 'default.jpg', '$2y$10$5bVEFNRGcrsfBygS.wwM8uzsPFuiI0NuUqZdcCf6k7fEfVq4CEKka', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-03 01:57:56', '2023-07-03 01:57:56', NULL),
(15, 'admpoligon@gmail.com', 'admpoligon', 'default.jpg', '$2y$10$TrJNoWmX3GFNByY6Kp4gJuQVZ0jOQjp96iNEfAo5/SUiRxvPbs0si', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-03 01:58:49', '2023-07-03 01:58:49', NULL),
(16, 'munawir@gmail.com', 'kalem', 'default.jpg', '$2y$10$UWkX4HsZvuJEnqZ1Y/e40O/Zz.PTT4n3ar3kzrXp/sHj/zIoSQRYS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-03 01:59:40', '2023-07-03 01:59:40', NULL),
(17, 'dirumgo@gmail.com', 'dirumgo', 'default.jpg', '$2y$10$D3e8jivP.z5BXMgajne1AuZ73IZ0edw5Pdt3OX66SkbR0c7dsbI4i', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-10 15:37:41', '2023-07-10 15:37:41', NULL),
(18, 'dirpoligon@gmail.com', 'dirpoligon', 'default.jpg', '$2y$10$g.MJYODpZA6YXVAaIEIBkuYT5Qnd9h5.P.6xUQptLgY4ncyzbsZWG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-13 06:23:01', '2023-07-13 06:23:01', NULL),
(19, 'lowry@gmail.com', 'lowry', 'default.jpg', '$2y$10$HZWWLkrOV7D5LLmGCJzUBem.Mw/hVJUM4B/pFXNtWJf2BzaGVizTG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-13 06:26:59', '2023-07-13 06:26:59', NULL),
(20, 'adumgo@gmail.com', 'adumgo', 'default.jpg', '$2y$10$PYMy.e2NcqAKsXTSQftlPO4ip48Tk071yniP68HzOmKzp4Yh8q1gO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-13 06:27:49', '2023-07-13 06:27:49', NULL),
(21, 'ung@gmail.com', 'ung', 'default.jpg', '$2y$10$0R9EWCOvovD/sC7wRQt3P.fco.inA/byJfNSwogl15afS9NBBp3Eq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-23 13:56:50', '2023-07-23 13:56:50', NULL),
(32, 'anjay@gmail.com', 'anjay', 'default.jpg', '$2y$10$ss2vsrnEAeP/qYRfL1Qqo.qOGNRjQIk0iV2o4qdPUzCOiZY35kUKy', NULL, NULL, NULL, '25f1b8196735fdd41f3e3044e5989d12', NULL, NULL, 0, 0, '2023-07-27 20:02:39', '2023-07-27 20:02:39', NULL),
(33, 'Minjeey@gmail.com', 'Minjeey', 'default.jpg', '$2y$10$S0MiJ39oI71ZnE9yXtl8re2RQkJBE2kD7gX.D1LW5kYyZPm.umrmC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-27 20:06:14', '2023-07-27 20:06:14', NULL),
(34, 'laminhdataulamin2@gmail.com', 'Laminhdatau', 'default.jpg', '$2y$10$7Nkxi6WDbgd66Are1Kac3ekqoTpyDq6ldaxsLLmgAV1/v993zsZWu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-28 13:21:49', '2023-07-28 13:21:49', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pegawai`
-- (See below for the actual view)
--
CREATE TABLE `v_pegawai` (
`id_pegawai` varchar(255)
,`nama_lengkap` varchar(100)
,`nip` char(18)
,`pangkat` varchar(50)
,`golongan` varchar(10)
,`jabatan` varchar(255)
,`tmpt_lahir` varchar(50)
,`tanggal_lahir` date
,`jenis_kelamin` varchar(9)
,`jenis_pegawai` varchar(50)
,`id_instansi` varchar(255)
,`keterangan` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ulevel`
-- (See below for the actual view)
--
CREATE TABLE `v_ulevel` (
`id_user` int unsigned
,`email` varchar(255)
,`username` varchar(30)
,`user_image` varchar(255)
,`id_groups` int unsigned
,`level` varchar(255)
,`ket_level` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `v_pegawai`
--
DROP TABLE IF EXISTS `v_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`minjeey`@`localhost` SQL SECURITY DEFINER VIEW `v_pegawai`  AS SELECT `p`.`id_pegawai` AS `id_pegawai`, `p`.`nama_lengkap` AS `nama_lengkap`, `p`.`nip` AS `nip`, `p`.`pangkat` AS `pangkat`, `p`.`golongan` AS `golongan`, `p`.`jabatan` AS `jabatan`, `p`.`tmpt_lahir` AS `tmpt_lahir`, `p`.`tanggal_lahir` AS `tanggal_lahir`, `p`.`jenis_kelamin` AS `jenis_kelamin`, `p`.`jenis_pegawai` AS `jenis_pegawai`, `p`.`id_instansi` AS `id_instansi`, `p`.`keterangan` AS `keterangan` FROM `db_pegawai`.`t_pegawai` AS `p` ;

-- --------------------------------------------------------

--
-- Structure for view `v_ulevel`
--
DROP TABLE IF EXISTS `v_ulevel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`minjeey`@`localhost` SQL SECURITY DEFINER VIEW `v_ulevel`  AS SELECT `u`.`id` AS `id_user`, `u`.`email` AS `email`, `u`.`username` AS `username`, `u`.`user_image` AS `user_image`, `g`.`id` AS `id_groups`, `g`.`name` AS `level`, `g`.`description` AS `ket_level` FROM ((`users` `u` join `auth_groups` `g`) join `auth_groups_users` `gu`) WHERE ((`u`.`id` = `gu`.`user_id`) AND (`g`.`id` = `gu`.`group_id`)) ORDER BY `u`.`id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_akses_menu`
--
ALTER TABLE `t_akses_menu`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `t_disposisi`
--
ALTER TABLE `t_disposisi`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`),
  ADD KEY `id_surat_dispos` (`id_surat_dispos`);

--
-- Indexes for table `t_instansi`
--
ALTER TABLE `t_instansi`
  ADD PRIMARY KEY (`id_instansi`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `t_instruksi`
--
ALTER TABLE `t_instruksi`
  ADD PRIMARY KEY (`id_instruksi`);

--
-- Indexes for table `t_jenis_surat`
--
ALTER TABLE `t_jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `t_kop_surat`
--
ALTER TABLE `t_kop_surat`
  ADD PRIMARY KEY (`id_kop`);

--
-- Indexes for table `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `t_pegawai_pts`
--
ALTER TABLE `t_pegawai_pts`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `t_reff_surat`
--
ALTER TABLE `t_reff_surat`
  ADD PRIMARY KEY (`id_reff_surat`),
  ADD UNIQUE KEY `nomor_surat` (`nomor_surat`);

--
-- Indexes for table `t_sifat`
--
ALTER TABLE `t_sifat`
  ADD PRIMARY KEY (`id_sifat`);

--
-- Indexes for table `t_status`
--
ALTER TABLE `t_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `t_surat`
--
ALTER TABLE `t_surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_instansi` (`id_instansi`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`),
  ADD KEY `id_nomor_surat` (`nomor_surat`),
  ADD KEY `id_sifat` (`id_sifat`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_type` (`is_active`);

--
-- Indexes for table `t_surat_tugas`
--
ALTER TABLE `t_surat_tugas`
  ADD PRIMARY KEY (`id_surat_tugas`),
  ADD UNIQUE KEY `id_nomor_surat` (`id_nomor_surat`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`);

--
-- Indexes for table `t_surat_tugas_pegawai`
--
ALTER TABLE `t_surat_tugas_pegawai`
  ADD KEY `id_surat_tugas` (`id_surat_tugas`);

--
-- Indexes for table `t_template_wil`
--
ALTER TABLE `t_template_wil`
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `t_user_pegawai`
--
ALTER TABLE `t_user_pegawai`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_verifikasi`
--
ALTER TABLE `t_verifikasi`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `t_verifikasi_ibfk_2` (`id_status`);

--
-- Indexes for table `t_wilayah`
--
ALTER TABLE `t_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_instruksi`
--
ALTER TABLE `t_instruksi`
  MODIFY `id_instruksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `t_jenis_surat`
--
ALTER TABLE `t_jenis_surat`
  MODIFY `id_jenis_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_kop_surat`
--
ALTER TABLE `t_kop_surat`
  MODIFY `id_kop` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_reff_surat`
--
ALTER TABLE `t_reff_surat`
  MODIFY `id_reff_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `t_status`
--
ALTER TABLE `t_status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  MODIFY `id_sub_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_wilayah`
--
ALTER TABLE `t_wilayah`
  MODIFY `id_wilayah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD CONSTRAINT `auth_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_akses_menu`
--
ALTER TABLE `t_akses_menu`
  ADD CONSTRAINT `t_akses_menu_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `t_akses_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `t_menu` (`id_menu`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `t_disposisi`
--
ALTER TABLE `t_disposisi`
  ADD CONSTRAINT `t_disposisi_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `t_jenis_surat` (`id_jenis_surat`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `t_disposisi_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  ADD CONSTRAINT `t_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `t_menu` (`id_menu`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `t_surat`
--
ALTER TABLE `t_surat`
  ADD CONSTRAINT `t_surat_ibfk_2` FOREIGN KEY (`id_instansi`) REFERENCES `t_instansi` (`id_instansi`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `t_surat_ibfk_4` FOREIGN KEY (`id_jenis_surat`) REFERENCES `t_jenis_surat` (`id_jenis_surat`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `t_surat_ibfk_5` FOREIGN KEY (`id_sifat`) REFERENCES `t_sifat` (`id_sifat`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `t_surat_tugas`
--
ALTER TABLE `t_surat_tugas`
  ADD CONSTRAINT `t_surat_tugas_ibfk_5` FOREIGN KEY (`id_jenis_surat`) REFERENCES `t_jenis_surat` (`id_jenis_surat`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `t_surat_tugas_pegawai`
--
ALTER TABLE `t_surat_tugas_pegawai`
  ADD CONSTRAINT `t_surat_tugas_pegawai_ibfk_1` FOREIGN KEY (`id_surat_tugas`) REFERENCES `t_surat_tugas` (`id_surat_tugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_template_wil`
--
ALTER TABLE `t_template_wil`
  ADD CONSTRAINT `t_template_wil_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `t_surat` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_verifikasi`
--
ALTER TABLE `t_verifikasi`
  ADD CONSTRAINT `t_verifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `t_verifikasi_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `t_status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
