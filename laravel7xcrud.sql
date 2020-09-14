/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : laravel7xcrud

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-09-14 12:59:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Signe Ramirez', 'tija@mailinator.com', null, '$2y$10$41QG1yjwsrRnW0yrpS1a0..IvvIf0o5BJkgqZpHsA/8rPR0smD/te', '$2y$10$feOYgHisQDXart2C5w5yd./gs6/YKX4L6FlUsrQHZC8i4nextJ8gm', '2020-09-07 12:57:20', '2020-09-07 12:57:20', 'public/adminimages/m7mgq8CIypmgQLzzLCRdsCBQBO5yJAEP4VjQ51u8.png', 'Maiores dolore paria');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('2', 'Điện tử', 'dien-tu', 'public/categoryimages/zftty9QOSCxMV3ZdNMg2G51qToqpAYpU4KUWDdlM.jpeg', '<p>điện tử</p>', '0', '2020-08-29 09:15:44', '2020-09-10 11:34:54');
INSERT INTO `category` VALUES ('3', 'Sách trong nước', 'sach-trong-nuoc', 'public/categoryimages/8Yea3Ybwc1Mt0UqiZh4danmB414fXdwEK6RvUzel.jpeg', '<p>S&aacute;ch trong nước</p>', '0', '2020-09-10 11:31:46', '2020-09-10 11:31:46');
INSERT INTO `category` VALUES ('4', 'Sách nước ngoài', 'sach-nuoc-ngoai', 'public/categoryimages/X81nRC8C9o8WLZBW87cCKFGX5T2rUclVdnwWTrED.png', '<p>S&aacute;ch nước ngo&agrave;i</p>', '0', '2020-09-10 11:33:00', '2020-09-10 11:33:00');
INSERT INTO `category` VALUES ('5', 'Dụng cụ học sinh', 'dung-cu-hs', 'public/categoryimages/expkaeq12fAz9ZRxXAQ6n22bOp39sjaxyOSbVO3S.jpeg', '<p>Dụng cụ học sinh</p>', '0', '2020-09-10 11:34:01', '2020-09-10 11:34:01');
INSERT INTO `category` VALUES ('6', 'Đồ chơi', 'do-choi', 'public/categoryimages/5mV31rSUroPHqeW6YZWS7qg7NhczeY7uEGPCURR1.png', '<p>Đồ chơi</p>', '0', '2020-09-10 11:34:17', '2020-09-10 11:34:17');
INSERT INTO `category` VALUES ('7', 'Tuyển tập', 'tuyen-tap', 'public/categoryimages/5WvK0E4jbeSE2qLfWpadDEUH1nFz5BbW3CW8QRze.jpeg', '<p>Tuyển tập</p>', '0', '2020-09-10 11:35:40', '2020-09-10 11:35:40');
INSERT INTO `category` VALUES ('8', 'Sách theo nhà cung cấp', 'sach-ncc', 'public/categoryimages/NqGLSHdMLkhRFqwUVa74oI2JhD2zd5nCph6LcYvx.png', '<p>S&aacute;ch theo nh&agrave; cung cấp</p>', '0', '2020-09-10 11:36:11', '2020-09-10 11:36:11');
INSERT INTO `category` VALUES ('9', 'Quà lưu niệm', 'qua-luu-niem', 'public/categoryimages/iscUlN54yD6g5HvYXWPfeRJBDDg5MrHZvlDVIOQe.jpeg', '<p>Qu&agrave; lưu niệm</p>', '0', '2020-09-10 11:36:48', '2020-09-10 11:36:48');
INSERT INTO `category` VALUES ('10', 'Văn phòng phẩm', 'vpp', 'public/categoryimages/V8luueQrri2a9Ms0Wzn8FeyXngiW9MqSFPcDK7UK.jpeg', '<p>Văn ph&ograve;ng phẩm</p>', '0', '2020-09-10 11:37:07', '2020-09-10 11:37:07');
INSERT INTO `category` VALUES ('11', 'Sản phẩm khác', 'san-pham-khac', 'public/categoryimages/WSHLi1GVhE5dC8JB5vrDJwHf196Ot1OorBaSwAqD.jpeg', '<p>Sản phẩm kh&aacute;c</p>', '0', '2020-09-10 11:37:41', '2020-09-10 11:37:41');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2020_08_04_134208_create_products_table', '1');
INSERT INTO `migrations` VALUES ('5', '2020_08_14_135109_add_product_status_to_products_table', '2');
INSERT INTO `migrations` VALUES ('6', '2020_08_24_120050_create_admins_table', '3');
INSERT INTO `migrations` VALUES ('7', '2020_08_27_080236_create_category_table', '4');
INSERT INTO `migrations` VALUES ('8', '2020_08_28_114917_create_orders_table', '5');
INSERT INTO `migrations` VALUES ('9', '2020_08_29_052312_create_orderdetail_table', '5');
INSERT INTO `migrations` VALUES ('10', '2020_08_29_101255_add_category_id_to_products_table', '6');
INSERT INTO `migrations` VALUES ('11', '2020_09_02_032722_create_jobs_table', '7');
INSERT INTO `migrations` VALUES ('12', '2020_09_06_033105_create_settings_table', '8');
INSERT INTO `migrations` VALUES ('13', '2020_09_07_125403_add_fields_to_admins_table', '9');

-- ----------------------------
-- Table structure for orderdetail
-- ----------------------------
DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE `orderdetail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orderdetail
-- ----------------------------
INSERT INTO `orderdetail` VALUES ('1', '3', '253.00', '1', '1', '1', '2020-09-05 12:37:50', '2020-09-06 01:51:54');
INSERT INTO `orderdetail` VALUES ('2', '2', '231.00', '1', '2', '3', '2020-09-05 12:38:56', '2020-09-05 12:38:56');
INSERT INTO `orderdetail` VALUES ('3', '3', '253.00', '1', '2', '3', '2020-09-05 12:38:56', '2020-09-05 12:38:56');
INSERT INTO `orderdetail` VALUES ('4', '4', '385.00', '1', '2', '3', '2020-09-05 12:38:56', '2020-09-05 12:38:56');
INSERT INTO `orderdetail` VALUES ('6', '3', '253.00', '1', '4', '1', '2020-09-12 08:47:17', '2020-09-12 08:47:17');
INSERT INTO `orderdetail` VALUES ('7', '11', '55.00', '1', '4', '1', '2020-09-12 08:47:17', '2020-09-12 08:47:17');
INSERT INTO `orderdetail` VALUES ('8', '3', '253.00', '1', '5', '1', '2020-09-12 08:48:33', '2020-09-12 08:48:33');
INSERT INTO `orderdetail` VALUES ('9', '11', '55.00', '1', '5', '1', '2020-09-12 08:48:33', '2020-09-12 08:48:33');
INSERT INTO `orderdetail` VALUES ('10', '3', '253.00', '1', '6', '1', '2020-09-12 08:49:19', '2020-09-12 08:49:19');
INSERT INTO `orderdetail` VALUES ('11', '11', '55.00', '1', '6', '1', '2020-09-12 08:49:19', '2020-09-12 08:49:19');
INSERT INTO `orderdetail` VALUES ('12', '5', '723.00', '1', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('13', '7', '755.00', '1', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('14', '11', '55.00', '3', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('15', '8', '79.00', '3', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('16', '16', '681.00', '3', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('17', '3', '253.00', '2', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');
INSERT INTO `orderdetail` VALUES ('18', '2', '231.00', '4', '7', '1', '2020-09-12 09:51:32', '2020-09-12 09:51:32');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_product` int(11) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', 'Tanek Medina', 'purak@mailinator.com', '+1 (996) 663-7294', 'Proident eligendi v', '1', '253.00', '1', 'Quas reiciendis vel', '2020-09-05 12:37:50', '2020-09-06 01:50:53');
INSERT INTO `orders` VALUES ('2', 'Wade Ortiz', 'dypetife@mailinator.com', '+1 (212) 387-4902', 'In dicta molestias d', '3', '869.00', '3', 'Do cumque omnis est', '2020-09-05 12:38:56', '2020-09-05 12:38:56');
INSERT INTO `orders` VALUES ('4', 'Justina Castillo', 'wora@mailinator.com', '+1 (472) 334-9253', 'Rerum eum veniam ve', '2', '308.00', '1', 'Quidem itaque totam', '2020-09-12 08:47:17', '2020-09-12 08:47:17');
INSERT INTO `orders` VALUES ('5', 'Cora Martinez', 'nosyce@mailinator.com', '+1 (298) 611-1299', 'Suscipit ex aut et a', '2', '308.00', '1', 'Velit omnis aut dolo', '2020-09-12 08:48:33', '2020-09-12 08:48:33');
INSERT INTO `orders` VALUES ('6', 'Paul Park', 'bodykycofe@mailinator.com', '+1 (765) 645-4771', 'Aliquid illo blandit', '2', '308.00', '1', 'Sit commodo quidem d', '2020-09-12 08:49:19', '2020-09-12 08:49:19');
INSERT INTO `orders` VALUES ('7', 'Angelica Wade', 'fabez@mailinator.com', '+1 (995) 864-7046', 'Voluptatem nihil ci', '17', '5353.00', '1', 'Similique ex nulla r', '2020-09-12 09:51:32', '2020-09-12 09:51:32');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_publish` datetime NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('2', 'Fletcher Mayo', 'public/productimages/o7KDcX0xIPeaVpzxCoWc7seTTe0EDbai3TWJ4E7h.png', '<p>Qui quis nobis elit</p>', '2020-08-06 12:36:37', '908', '231.00', '2020-08-06 12:36:37', '2020-09-12 06:19:38', '1', '2');
INSERT INTO `products` VALUES ('3', 'Arden Calderon', 'public/productimages/lgxENx72Q7qOrgkb9bNp54GMOkndBynpBEGSKi2l.jpeg', '<p>Porro culpa iusto as</p>', '2020-08-06 13:12:08', '515', '253.00', '2020-08-06 13:12:08', '2020-09-12 06:19:10', '1', '2');
INSERT INTO `products` VALUES ('4', 'Zachery Valdez', 'public/productimages/yqlHPEeu9TeFvoNm7w9O9GCkb1I2T9T3tL0j5Z9a.jpeg', '<p>Omnis aliquip qui no</p>', '2020-08-07 12:56:08', '462', '385.00', '2020-08-07 12:56:08', '2020-09-12 06:21:45', '1', '2');
INSERT INTO `products` VALUES ('5', 'Lucian Lane', 'public/productimages/1nai8ifW7ZEuY21dsMTEmMxWVFsEOJtSGY4xje6R.png', '<p>Molestiae in molliti</p>', '2020-08-07 12:56:17', '343', '723.00', '2020-08-07 12:56:17', '2020-09-12 06:22:28', '1', '2');
INSERT INTO `products` VALUES ('6', 'Buffy Adkins', 'public/productimages/xg9TZiNNIfbe8TgsJVgPiSGxOSsolkKolWAkBysA.png', '<p>Beatae illo consequa</p>', '2020-08-07 12:56:25', '277', '507.00', '2020-08-07 12:56:25', '2020-09-12 06:22:40', '1', '2');
INSERT INTO `products` VALUES ('7', 'Ishmael Benson', 'public/productimages/cu2vYEbQyoXv35WK5owhZ4UHWBc1m1dNkd1SNl7G.jpeg', '<p>Id iste et dolor tem</p>', '2020-08-07 12:56:36', '50', '755.00', '2020-08-07 12:56:36', '2020-09-12 06:22:57', '1', '2');
INSERT INTO `products` VALUES ('8', 'Raya Gamble', 'public/productimages/s2aUyNEgNpWTXoYp6xrckYOvbGwj7qLjSS7n81in.jpeg', '<p>Eos temporibus accus</p>', '2020-08-07 12:56:46', '159', '79.00', '2020-08-07 12:56:46', '2020-09-12 06:23:37', '1', '2');
INSERT INTO `products` VALUES ('9', 'Quemby Sharpe', 'public/productimages/XlOlvsrlonnVlVTCPjsDJ9hw7m1orHPnSkE0590t.jpeg', '<p>Harum aut rerum aut</p>', '2020-08-07 12:56:56', '176', '955.00', '2020-08-07 12:56:56', '2020-09-12 06:23:54', '1', '2');
INSERT INTO `products` VALUES ('10', 'Debra Duke', 'public/productimages/VoLKHdotyNyMMeiizyXEnwB3cYI0CsvMoqW76JjA.png', '<p>In voluptas lorem co</p>', '2020-08-07 12:57:06', '29', '667.00', '2020-08-07 12:57:06', '2020-09-12 06:20:14', '1', '2');
INSERT INTO `products` VALUES ('11', 'Mona Mosley', 'public/productimages/M7szcxcLWFv8vKamrtKl5eJS3lVR2PBHbYVWXahp.png', '<p>Nisi illo quod quod</p>', '2020-08-07 12:57:16', '525', '55.00', '2020-08-07 12:57:16', '2020-09-12 06:19:50', '1', '2');
INSERT INTO `products` VALUES ('12', 'Emma Marks', 'public/productimages/wtqpeEsaFsnMJK1qKqhKyak5v1UyKiuVeaCRa6lX.jpeg', '<p>Deleniti ut laborum</p>', '2020-08-07 12:57:26', '212', '685.00', '2020-08-07 12:57:26', '2020-09-12 06:22:13', '1', '2');
INSERT INTO `products` VALUES ('13', 'Ayanna Rivers', 'public/productimages/BYz07dEhwt7wcHXgWU4GLDYGFoe8iMML5azTDD07.jpeg', '<p>1111111111111111111111111555</p>', '2020-08-14 18:15:01', '598', '857.00', '2020-08-14 11:15:03', '2020-08-14 12:16:14', '0', '0');
INSERT INTO `products` VALUES ('14', 'Kylee Calderon', 'public/productimages/Ccn3pyn4dLDmnJQXIFodqRbW6p17ZOxSglaVJFpX.png', '<p>1111111111111111</p>', '2020-08-21 18:54:44', '842', '41.00', '2020-08-21 11:54:54', '2020-08-21 11:54:54', '1', '0');
INSERT INTO `products` VALUES ('15', 'Sydnee Gilbert', 'public/productimages/idu0yqlDV7ybcN6WV8wrDFABlGq8h1BBABZSQbRJ.png', '<p style=\"text-align: right;\"><em><strong>1111111111111111111</strong></em></p>', '2020-08-21 19:40:21', '231', '202.00', '2020-08-21 12:40:48', '2020-09-12 06:42:15', '1', '2');
INSERT INTO `products` VALUES ('16', 'Wynne Wolfe', 'public/productimages/6q4beGQA54fMOcszMMZB2vRegmBspbElVj6n5MSH.png', '<p>99999999999999999999</p>', '2020-08-31 13:46:34', '940', '681.00', '2020-08-31 06:46:46', '2020-08-31 06:46:46', '1', '2');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'site_name', '', 'September Johnson', null, null);
INSERT INTO `settings` VALUES ('2', 'logo', '', 'public/settings/cHRrs4B1Aznm49ROASec7XJRyQv7oL6XNztUWRBU.png', null, null);
INSERT INTO `settings` VALUES ('3', 'meta_title', '', 'Debitis sed ipsum e', null, null);
INSERT INTO `settings` VALUES ('4', 'meta_desc', '', 'Ea et sed eaque libe', null, null);
INSERT INTO `settings` VALUES ('5', 'meta_keyword', '', 'Doloremque eveniet', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
