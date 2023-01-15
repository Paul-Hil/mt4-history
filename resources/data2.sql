-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL,
  `average` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `accounts` (`id`, `name`, `file_updated_at`, `balance`, `profit`, `average`) VALUES
(25,	'Account: 5787393',	'Samedi 31 décembre | 01:17',	579.48,	74.48,	2.07);

DROP TABLE IF EXISTS `days`;
CREATE TABLE `days` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit` double(8,2) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `profit_total` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `days` (`id`, `date`, `label`, `profit`, `commission`, `profit_total`) VALUES
(1,	'2022-11-08 00:00:00',	'Mardi 08 novembre | 2022',	2.45,	-0.20,	2.25),
(2,	'2022-11-09 00:00:00',	'Mercredi 09 novembre | 2022',	12.73,	-0.60,	12.13),
(3,	'2022-11-10 00:00:00',	'Jeudi 10 novembre | 2022',	10.93,	-0.50,	10.43),
(4,	'2022-11-11 00:00:00',	'Vendredi 11 novembre | 2022',	22.22,	-1.50,	20.72),
(5,	'2022-11-14 00:00:00',	'Lundi 14 novembre | 2022',	6.99,	-0.70,	6.29),
(6,	'2022-11-15 00:00:00',	'Mardi 15 novembre | 2022',	6.73,	-0.40,	6.33),
(7,	'2022-11-16 00:00:00',	'Mercredi 16 novembre | 2022',	6.32,	-0.40,	5.92),
(8,	'2022-11-17 00:00:00',	'Jeudi 17 novembre | 2022',	7.62,	-0.50,	7.12),
(9,	'2022-11-18 00:00:00',	'Vendredi 18 novembre | 2022',	6.56,	-0.30,	6.26),
(10,	'2022-11-21 00:00:00',	'Lundi 21 novembre | 2022',	10.08,	-0.60,	9.48),
(11,	'2022-11-22 00:00:00',	'Mardi 22 novembre | 2022',	6.73,	-0.30,	6.43),
(12,	'2022-11-23 00:00:00',	'Mercredi 23 novembre | 2022',	10.95,	-0.60,	10.35),
(13,	'2022-11-24 00:00:00',	'Jeudi 24 novembre | 2022',	2.16,	-0.10,	2.06),
(14,	'2022-11-25 00:00:00',	'Vendredi 25 novembre | 2022',	10.83,	-0.70,	10.13),
(15,	'2022-11-28 00:00:00',	'Lundi 28 novembre | 2022',	9.08,	-0.50,	8.58),
(16,	'2022-11-29 00:00:00',	'Mardi 29 novembre | 2022',	3.73,	-0.30,	3.43),
(17,	'2022-11-30 00:00:00',	'Mercredi 30 novembre | 2022',	8.68,	-0.40,	8.28),
(391,	'2022-12-01 00:00:00',	'Jeudi 01 décembre | 2022',	14.86,	-1.10,	13.76),
(392,	'2022-12-02 00:00:00',	'Vendredi 02 décembre | 2022',	2.18,	-0.10,	2.08),
(393,	'2022-12-05 00:00:00',	'Lundi 05 décembre | 2022',	13.22,	-0.70,	12.52),
(394,	'2022-12-06 00:00:00',	'Mardi 06 décembre | 2022',	2.14,	-0.10,	2.04),
(395,	'2022-12-07 00:00:00',	'Mercredi 07 décembre | 2022',	4.18,	-0.20,	3.98),
(396,	'2022-12-08 00:00:00',	'Jeudi 08 décembre | 2022',	2.13,	-0.10,	2.03),
(397,	'2022-12-09 00:00:00',	'Vendredi 09 décembre | 2022',	8.46,	-0.20,	8.26),
(398,	'2022-12-12 00:00:00',	'Lundi 12 décembre | 2022',	4.44,	-0.30,	4.14),
(399,	'2022-12-13 00:00:00',	'Mardi 13 décembre | 2022',	9.68,	-0.50,	9.18),
(400,	'2022-12-15 00:00:00',	'Jeudi 15 décembre | 2022',	-186.71,	-0.70,	-187.41),
(401,	'2022-12-16 00:00:00',	'Vendredi 16 décembre | 2022',	2.17,	-0.10,	2.07),
(402,	'2022-12-19 00:00:00',	'Lundi 19 décembre | 2022',	-4.42,	-0.20,	-4.62),
(403,	'2022-12-20 00:00:00',	'Mardi 20 décembre | 2022',	8.81,	-0.60,	8.21),
(404,	'2022-12-21 00:00:00',	'Mercredi 21 décembre | 2022',	2.43,	-0.10,	2.33),
(405,	'2022-12-22 00:00:00',	'Jeudi 22 décembre | 2022',	2.17,	-0.10,	2.07),
(406,	'2022-12-23 00:00:00',	'Vendredi 23 décembre | 2022',	2.29,	-0.40,	1.89),
(407,	'2022-12-27 00:00:00',	'Mardi 27 décembre | 2022',	6.63,	-0.50,	6.13),
(408,	'2022-12-28 00:00:00',	'Mercredi 28 décembre | 2022',	6.45,	-0.40,	6.05),
(409,	'2022-12-29 00:00:00',	'Jeudi 29 décembre | 2022',	2.08,	-0.10,	1.98);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2022_11_20_132957_create_days_table',	1),
(6,	'2022_11_21_152957_create_trades_close_table',	1),
(7,	'2022_11_22_125823_create_accounts_table',	1),
(8,	'2022_11_25_112059_create_trade_opens_table',	1),
(9,	'2022_11_25_112059_create_trade_opens_table',	1),
(10,	'2022_12_13_151233_update_price_for_trade_o_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `trades_close`;
CREATE TABLE `trades_close` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `day_id` bigint unsigned NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL,
  `profit` double(8,2) NOT NULL,
  `type` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `levier` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trades_close` (`id`, `day_id`, `openTime`, `closeTime`, `profit`, `type`, `levier`) VALUES
(1,	1,	'05:35:03',	'10:31:02',	-2.83,	'buy',	0.02),
(2,	1,	'09:55:02',	'10:31:02',	5.28,	'buy',	0.02),
(3,	2,	'00:07:02',	'00:15:01',	2.01,	'buy',	0.02),
(4,	2,	'02:28:00',	'02:28:57',	2.10,	'buy',	0.02),
(5,	2,	'04:03:01',	'04:25:27',	2.10,	'sell',	0.02),
(6,	2,	'09:03:00',	'09:06:55',	2.18,	'sell',	0.02),
(7,	2,	'10:10:00',	'10:22:25',	2.21,	'buy',	0.02),
(8,	2,	'10:59:00',	'11:01:00',	2.13,	'buy',	0.02),
(9,	3,	'06:04:00',	'07:26:04',	2.13,	'sell',	0.02),
(10,	3,	'08:28:00',	'09:03:16',	2.32,	'buy',	0.02),
(11,	3,	'09:08:00',	'09:17:05',	2.18,	'sell',	0.02),
(12,	3,	'10:19:00',	'10:22:40',	2.14,	'buy',	0.02),
(13,	3,	'21:00:00',	'21:26:44',	2.16,	'sell',	0.02),
(14,	4,	'01:52:00',	'01:57:16',	2.14,	'buy',	0.02),
(15,	4,	'06:13:00',	'07:32:30',	-6.09,	'sell',	0.02),
(16,	4,	'07:32:00',	'07:32:30',	-1.10,	'buy',	0.02),
(17,	4,	'06:31:00',	'07:32:31',	8.40,	'sell',	0.02),
(18,	4,	'07:33:03',	'08:16:32',	2.56,	'buy',	0.02),
(19,	4,	'08:31:00',	'08:44:08',	2.15,	'sell',	0.02),
(20,	4,	'09:07:00',	'09:19:47',	2.18,	'buy',	0.02),
(21,	4,	'09:45:00',	'10:02:04',	-2.01,	'sell',	0.02),
(22,	4,	'09:59:00',	'10:02:05',	4.87,	'sell',	0.02),
(23,	4,	'11:50:00',	'12:38:41',	-2.43,	'buy',	0.02),
(24,	4,	'11:59:00',	'12:38:41',	4.67,	'buy',	0.02),
(25,	4,	'14:22:00',	'14:27:56',	2.23,	'sell',	0.02),
(26,	4,	'14:50:00',	'15:01:56',	2.11,	'sell',	0.02),
(27,	4,	'15:22:00',	'15:52:52',	-2.16,	'buy',	0.02),
(28,	4,	'15:42:00',	'15:52:52',	4.70,	'buy',	0.02),
(29,	5,	'09:15:00',	'09:21:28',	2.15,	'sell',	0.02),
(30,	5,	'11:05:00',	'11:21:10',	2.21,	'buy',	0.02),
(31,	5,	'14:25:00',	'17:12:56',	-14.13,	'sell',	0.02),
(32,	5,	'15:40:00',	'17:12:57',	-3.14,	'sell',	0.02),
(33,	5,	'16:10:01',	'17:12:57',	3.79,	'sell',	0.02),
(34,	5,	'16:20:01',	'17:12:57',	4.86,	'sell',	0.02),
(35,	5,	'16:15:00',	'17:12:58',	11.25,	'sell',	0.02),
(36,	6,	'08:35:01',	'09:06:30',	-2.87,	'sell',	0.02),
(37,	6,	'08:50:00',	'09:06:31',	4.97,	'sell',	0.02),
(38,	6,	'09:25:00',	'09:34:10',	2.11,	'sell',	0.02),
(39,	6,	'15:40:00',	'15:56:10',	2.52,	'buy',	0.02),
(40,	7,	'09:00:01',	'13:44:39',	-6.34,	'sell',	0.02),
(41,	7,	'11:25:01',	'13:44:39',	7.76,	'sell',	0.02),
(42,	7,	'10:10:01',	'13:48:13',	2.48,	'sell',	0.02),
(43,	7,	'15:40:00',	'15:45:40',	2.42,	'buy',	0.02),
(44,	8,	'02:55:06',	'07:50:05',	-6.12,	'buy',	0.02),
(45,	8,	'05:10:02',	'07:50:05',	7.39,	'buy',	0.02),
(46,	8,	'04:05:01',	'07:50:50',	2.17,	'buy',	0.02),
(47,	8,	'09:20:00',	'09:42:02',	1.92,	'sell',	0.02),
(48,	8,	'11:40:00',	'12:50:22',	2.26,	'buy',	0.02),
(49,	9,	'12:45:00',	'13:17:14',	2.29,	'buy',	0.02),
(50,	9,	'15:30:00',	'15:30:07',	2.05,	'buy',	0.02),
(51,	9,	'15:50:00',	'15:55:10',	2.22,	'buy',	0.02),
(52,	10,	'02:20:00',	'02:39:43',	2.27,	'buy',	0.02),
(53,	10,	'09:20:00',	'11:05:02',	-2.89,	'buy',	0.02),
(54,	10,	'10:45:01',	'11:05:03',	5.76,	'buy',	0.02),
(55,	10,	'14:25:00',	'14:39:15',	2.48,	'sell',	0.02),
(56,	10,	'16:10:00',	'18:34:27',	-2.05,	'buy',	0.02),
(57,	10,	'17:10:00',	'18:34:27',	4.51,	'buy',	0.02),
(58,	11,	'02:10:00',	'06:58:05',	2.08,	'sell',	0.02),
(59,	11,	'09:30:00',	'09:33:09',	2.48,	'sell',	0.02),
(60,	11,	'15:15:00',	'15:25:12',	2.17,	'buy',	0.02),
(61,	12,	'05:00:01',	'07:47:36',	2.13,	'buy',	0.02),
(62,	12,	'08:20:00',	'09:18:13',	-2.71,	'sell',	0.02),
(63,	12,	'08:50:00',	'09:18:15',	4.95,	'sell',	0.02),
(64,	12,	'10:15:00',	'10:16:31',	2.23,	'buy',	0.02),
(65,	12,	'15:50:00',	'15:58:05',	2.20,	'sell',	0.02),
(66,	12,	'21:15:01',	'21:20:41',	2.15,	'sell',	0.02),
(67,	13,	'08:10:00',	'08:18:59',	2.16,	'sell',	0.02),
(68,	14,	'01:35:00',	'02:15:27',	2.12,	'buy',	0.02),
(69,	14,	'03:10:03',	'05:55:37',	-2.42,	'sell',	0.02),
(70,	14,	'05:05:01',	'05:55:38',	4.49,	'sell',	0.02),
(71,	14,	'07:05:00',	'07:51:28',	2.12,	'buy',	0.02),
(72,	14,	'08:42:11',	'11:25:58',	-1.98,	'buy',	0.02),
(73,	14,	'10:45:00',	'11:25:59',	4.34,	'buy',	0.02),
(74,	14,	'14:45:00',	'14:53:35',	2.16,	'buy',	0.02),
(75,	15,	'03:00:00',	'03:12:29',	2.36,	'buy',	0.02),
(76,	15,	'09:45:00',	'12:01:20',	-2.54,	'sell',	0.02),
(77,	15,	'10:45:01',	'12:01:20',	4.69,	'sell',	0.02),
(78,	15,	'15:45:05',	'16:04:57',	2.20,	'buy',	0.02),
(79,	15,	'17:15:00',	'17:26:34',	2.37,	'buy',	0.02),
(80,	16,	'04:45:00',	'10:47:13',	-6.81,	'sell',	0.02),
(81,	16,	'06:00:00',	'10:47:25',	2.34,	'sell',	0.02),
(82,	16,	'10:00:00',	'10:47:14',	8.20,	'sell',	0.02),
(83,	17,	'10:00:00',	'12:00:08',	2.16,	'sell',	0.02),
(84,	17,	'13:15:00',	'13:16:21',	2.12,	'sell',	0.02),
(85,	17,	'16:30:00',	'17:08:29',	2.25,	'buy',	0.02),
(86,	17,	'21:00:00',	'21:00:56',	2.15,	'sell',	0.02),
(1395,	391,	'00:45:00',	'03:06:57',	-4.24,	'sell',	0.02),
(1396,	391,	'02:00:00',	'03:06:57',	6.69,	'sell',	0.02),
(1397,	391,	'04:30:00',	'08:41:51',	-7.18,	'sell',	0.02),
(1398,	391,	'08:00:00',	'08:41:51',	7.88,	'sell',	0.02),
(1399,	391,	'05:45:01',	'08:42:25',	2.07,	'sell',	0.02),
(1400,	391,	'14:30:00',	'14:30:06',	2.75,	'sell',	0.02),
(1401,	391,	'15:15:00',	'16:17:04',	-5.07,	'sell',	0.02),
(1402,	391,	'16:15:00',	'16:17:04',	0.65,	'sell',	0.02),
(1403,	391,	'16:00:00',	'16:17:05',	7.05,	'sell',	0.02),
(1404,	391,	'17:15:01',	'17:17:46',	2.16,	'sell',	0.02),
(1405,	391,	'21:00:00',	'21:05:13',	2.10,	'sell',	0.02),
(1406,	392,	'14:45:00',	'14:52:35',	2.18,	'buy',	0.02),
(1407,	393,	'02:30:00',	'07:15:00',	-2.29,	'sell',	0.02),
(1408,	393,	'04:45:00',	'07:15:00',	4.73,	'sell',	0.02),
(1409,	393,	'11:30:00',	'11:42:48',	1.98,	'buy',	0.02),
(1410,	393,	'15:30:00',	'15:34:38',	2.18,	'buy',	0.02),
(1411,	393,	'16:00:00',	'16:00:10',	2.35,	'buy',	0.02),
(1412,	393,	'16:15:00',	'16:15:33',	2.16,	'buy',	0.02),
(1413,	393,	'18:15:00',	'18:23:40',	2.11,	'buy',	0.02),
(1414,	394,	'13:15:00',	'13:22:43',	2.14,	'sell',	0.02),
(1415,	395,	'15:45:00',	'15:52:48',	2.07,	'sell',	0.02),
(1416,	395,	'21:00:00',	'21:18:35',	2.11,	'sell',	0.02),
(1417,	396,	'16:30:00',	'16:39:51',	2.13,	'sell',	0.02),
(1418,	397,	'12:45:00',	'14:30:07',	6.29,	'sell',	0.02),
(1419,	397,	'17:45:00',	'17:53:48',	2.17,	'sell',	0.02),
(1420,	398,	'03:00:01',	'08:28:42',	-2.00,	'buy',	0.02),
(1421,	398,	'04:30:00',	'08:28:43',	4.37,	'buy',	0.02),
(1422,	398,	'17:15:00',	'17:47:02',	2.07,	'buy',	0.02),
(1423,	399,	'08:45:00',	'08:50:12',	2.10,	'sell',	0.02),
(1424,	399,	'14:45:00',	'14:45:50',	2.63,	'sell',	0.02),
(1425,	399,	'15:15:00',	'16:09:40',	-3.16,	'sell',	0.02),
(1426,	399,	'16:00:00',	'16:09:40',	6.00,	'sell',	0.02),
(1427,	399,	'17:30:00',	'17:46:42',	2.11,	'sell',	0.02),
(1428,	400,	'02:45:01',	'16:31:58',	-48.35,	'buy',	0.02),
(1429,	400,	'03:15:00',	'16:31:58',	-42.00,	'buy',	0.02),
(1430,	400,	'05:00:00',	'16:31:58',	-35.46,	'buy',	0.02),
(1431,	400,	'09:00:00',	'16:31:57',	-27.92,	'buy',	0.02),
(1432,	400,	'09:15:00',	'16:31:57',	-15.17,	'buy',	0.02),
(1433,	400,	'09:45:00',	'16:31:57',	-4.93,	'buy',	0.02),
(1434,	400,	'14:45:00',	'16:31:56',	-12.88,	'buy',	0.02),
(1435,	401,	'16:00:00',	'16:11:22',	2.17,	'sell',	0.02),
(1436,	402,	'17:30:00',	'16:56:01',	2.82,	'sell',	0.02),
(1437,	402,	'10:23:40',	'12:45:40',	-7.24,	'buy',	0.02),
(1438,	403,	'08:30:00',	'08:32:51',	2.20,	'sell',	0.02),
(1439,	403,	'09:45:00',	'13:49:16',	-3.59,	'sell',	0.02),
(1440,	403,	'10:45:00',	'13:49:16',	5.67,	'sell',	0.02),
(1441,	403,	'16:00:00',	'16:43:55',	-6.50,	'sell',	0.02),
(1442,	403,	'16:15:00',	'16:43:56',	8.81,	'sell',	0.02),
(1443,	403,	'17:15:00',	'17:16:07',	2.22,	'sell',	0.02),
(1444,	404,	'16:45:00',	'16:50:47',	2.43,	'sell',	0.02),
(1445,	405,	'15:00:00',	'15:02:01',	2.17,	'buy',	0.02),
(1446,	406,	'15:30:00',	'08:04:32',	-11.16,	'buy',	0.02),
(1447,	406,	'16:15:00',	'08:04:32',	-1.87,	'buy',	0.02),
(1448,	406,	'18:15:03',	'08:04:32',	4.39,	'buy',	0.02),
(1449,	406,	'22:15:00',	'08:04:34',	10.93,	'buy',	0.02),
(1450,	407,	'03:15:00',	'14:31:32',	-3.50,	'sell',	0.02),
(1451,	407,	'10:45:00',	'14:31:32',	6.21,	'sell',	0.02),
(1452,	407,	'16:15:00',	'17:25:40',	-10.85,	'sell',	0.02),
(1453,	407,	'16:45:00',	'17:25:40',	12.63,	'sell',	0.02),
(1454,	407,	'16:30:01',	'17:25:50',	2.14,	'sell',	0.02),
(1455,	408,	'09:30:01',	'11:10:21',	-3.05,	'buy',	0.02),
(1456,	408,	'10:15:04',	'11:10:22',	5.27,	'buy',	0.02),
(1457,	408,	'11:15:00',	'13:31:05',	2.10,	'buy',	0.02),
(1458,	408,	'17:15:00',	'17:20:43',	2.13,	'buy',	0.02),
(1459,	409,	'15:45:00',	'15:49:01',	2.08,	'sell',	0.02);

DROP TABLE IF EXISTS `trades_open`;
CREATE TABLE `trades_open` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `openTime` time NOT NULL,
  `profit` double(8,2) NOT NULL,
  `levier` double(8,2) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2023-01-01 14:21:23
