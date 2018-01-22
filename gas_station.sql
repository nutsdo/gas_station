/*
 Navicat Premium Data Transfer

 Source Server         : zzz_dev
 Source Server Type    : MySQL
 Source Server Version : 50538
 Source Host           : 192.168.0.2
 Source Database       : gas_station

 Target Server Type    : MySQL
 Target Server Version : 50538
 File Encoding         : utf-8

 Date: 01/22/2018 21:32:01 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gas_station_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `stars` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `comments`
-- ----------------------------
BEGIN;
INSERT INTO `comments` VALUES ('2', '1', '0', '5', '服务态度好', '2018-01-14 16:09:02', '2018-01-14 16:09:02', null), ('3', '1', '0', '4', '服务态度不好', '2018-01-14 16:09:26', '2018-01-14 16:09:26', null), ('4', '1', '0', '5', '非常好', '2018-01-14 16:09:48', '2018-01-14 16:09:48', null), ('5', '4', '0', '5', '还行', '2018-01-17 02:29:18', '2018-01-17 02:29:18', null);
COMMIT;

-- ----------------------------
--  Table structure for `gas_station_series`
-- ----------------------------
DROP TABLE IF EXISTS `gas_station_series`;
CREATE TABLE `gas_station_series` (
  `gas_station_id` int(11) NOT NULL COMMENT '油站id',
  `series_id` int(11) NOT NULL COMMENT '油号id',
  `price` decimal(8,2) NOT NULL COMMENT '油价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `gas_station_series`
-- ----------------------------
BEGIN;
INSERT INTO `gas_station_series` VALUES ('1', '1', '6.00'), ('1', '3', '6.55'), ('1', '4', '6.99'), ('1', '5', '6.50'), ('2', '3', '6.70'), ('2', '4', '7.10'), ('3', '3', '1.00'), ('2', '6', '8.70'), ('8', '6', '9.00'), ('8', '3', '7.00'), ('8', '4', '8.00'), ('7', '4', '6.00'), ('7', '3', '6.00'), ('7', '6', '7.00'), ('6', '3', '6.00'), ('6', '4', '7.00'), ('6', '6', '8.00'), ('5', '3', '6.00'), ('5', '4', '7.00'), ('4', '3', '6.00'), ('4', '4', '7.00'), ('3', '6', '9.00'), ('3', '4', '8.00'), ('1', '7', '5.60'), ('1', '8', '5.00'), ('2', '5', '4.00'), ('9', '3', '6.54'), ('9', '4', '6.70');
COMMIT;

-- ----------------------------
--  Table structure for `gas_stations`
-- ----------------------------
DROP TABLE IF EXISTS `gas_stations`;
CREATE TABLE `gas_stations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '油站名称',
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '油站图片',
  `lng` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '经度',
  `lat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '纬度',
  `type` tinyint(1) NOT NULL COMMENT '油站类型:1加油站,2加气站',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '座机号码',
  `province` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '省份',
  `city` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `district` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地区',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详细地址',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用:0否,1禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gas_stations_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `gas_stations`
-- ----------------------------
BEGIN;
INSERT INTO `gas_stations` VALUES ('1', '大广高速东区69', 'uploads/gasStation/20180119/5a6193c6c1b6e_gasStation.png', '115.145028', '36.239272', '1', null, '0310-3860861', '河北省', '邯郸市', '大名县', '西范庄村', '0', '2018-01-14 14:59:15', '2018-01-19 06:45:43', null), ('2', '大广高速西区70', 'uploads/gasStation/20180119/5a61943d38a9b_gasStation.png', '115.145028', '36.239272', '1', '18630088218', '0310-3860861', '河北省', '邯郸市', '大名县', '西范庄村', '0', '2018-01-14 15:09:05', '2018-01-19 06:47:10', null), ('3', '邯郸环球1站', 'uploads/gasStation/20180119/5a619491aa037_gasStation.png', '114.548028', '36.640873', '1', '13363007011', '0310-3860861', '河北省', '邯郸市', '丛台区', '东环与华泽路交叉口东北角', '0', '2018-01-14 16:05:59', '2018-01-19 06:49:00', null), ('4', '邯郸铁西2站', 'uploads/gasStation/20180119/5a61950382b43_gasStation.png', '114.511068', '36.637215', '1', '13077777777', '0310-3860861', '河北省', '邯郸市', '丛台区', '酒务楼村', '0', '2018-01-16 08:13:29', '2018-01-19 06:50:29', null), ('5', '邯郸乡企8站', 'uploads/gasStation/20180119/5a6195732aa8b_gasStation.png', '114.455614', '36.636249', '1', '12345432125', '0310-3860861', '河北省', '邯郸市', '丛台区', '联纺西路', '0', '2018-01-19 06:52:38', '2018-01-19 06:52:38', null), ('6', '联纺路31站', 'uploads/gasStation/20180119/5a6195e15694d_gasStation.png', '114.510368', '36.641456', '1', '15843289765', '0310-3860861', '河北省', '邯郸市', '丛台区', '联纺路与东柳北大街交叉口东南角', '0', '2018-01-19 06:54:22', '2018-01-19 06:54:22', null), ('7', '大名沙口', 'uploads/gasStation/20180119/5a61964a6909a_gasStation.png', '115.248635', '36.309544', '1', '12476538976', '0310-3860861', '河北省', '邯郸市', '大名县', '南堡乡沙口村', '0', '2018-01-19 06:56:01', '2018-01-19 06:56:01', null), ('8', '马庄供销社7站', 'uploads/gasStation/20180119/5a6196c6c80b7_gasStation.png', '114.476669', '36.588545', '1', '15832182628', '0310-3860861', '河北省', '邯郸市', '邯山区', '邯磁路渚河桥南', '0', '2018-01-19 06:58:32', '2018-01-19 06:58:32', null), ('9', '测试加油站1', 'uploads/gasStation/20180122/5a65707ab4aae_gasStation.jpg', '114.494825', '38.048316', '1', null, '12345678978', '河北省', '石家庄市', '新华区', '解放广场', '0', '2018-01-22 05:04:02', '2018-01-22 05:04:02', null);
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2018_01_05_145447_create_gas_stations_table', '1'), ('4', '2018_01_05_152233_create_comments_table', '1'), ('5', '2018_01_05_153004_create_series_table', '1'), ('6', '2018_01_05_155514_create_gas_station_series_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `series`
-- ----------------------------
DROP TABLE IF EXISTS `series`;
CREATE TABLE `series` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serial_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `series`
-- ----------------------------
BEGIN;
INSERT INTO `series` VALUES ('3', '92#汽油', '92#', '2018-01-14 15:56:27', '2018-01-14 15:56:27'), ('4', '95#汽油', '95#', '2018-01-14 15:56:43', '2018-01-14 15:56:43'), ('5', '0#柴油', '0#', '2018-01-14 15:57:07', '2018-01-14 15:57:07'), ('6', '98#汽油', '98#', '2018-01-14 15:57:24', '2018-01-14 15:57:24'), ('7', '00#测2', '00#', '2018-01-14 16:03:42', '2018-01-14 16:03:57'), ('8', '00#测3', '00##', '2018-01-21 06:41:28', '2018-01-21 06:41:28');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱地址',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用:0否,1禁用',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', 'admin@admin.com', '$2y$10$Su0nmt6AP2STe2IXiU.CReg/p1VMfVNvWu0AGSjfa70LLsz5zFqd6', '0', 'nC7OinyK1F8HXJpDyUnSybMSpBTFv8jiq64xJP4FAwtXFFZKLCWW9bKQvrRQ', null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
