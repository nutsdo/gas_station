-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: gas_station
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gas_station_id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,2,'服务态度好','2018-01-13 05:12:31','2018-01-13 05:12:31',NULL),(2,3,2,'服务态度好','2018-01-13 05:18:36','2018-01-13 05:18:36',NULL),(3,3,3,'jjjj','2018-01-14 15:58:04','2018-01-14 15:58:04',NULL),(4,3,4,'服务态度不好','2018-01-15 13:41:24','2018-01-15 13:41:24',NULL),(5,3,1,'服务态度不好','2018-01-15 13:41:50','2018-01-15 13:41:50',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gas_station_series`
--

DROP TABLE IF EXISTS `gas_station_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gas_station_series` (
  `gas_station_id` int(11) NOT NULL COMMENT '油站id',
  `series_id` int(11) NOT NULL COMMENT '油号id',
  `price` decimal(8,2) NOT NULL COMMENT '油价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gas_station_series`
--

LOCK TABLES `gas_station_series` WRITE;
/*!40000 ALTER TABLE `gas_station_series` DISABLE KEYS */;
INSERT INTO `gas_station_series` VALUES (1,2,6.90),(3,1,6.90),(3,2,4.80);
/*!40000 ALTER TABLE `gas_station_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gas_stations`
--

DROP TABLE IF EXISTS `gas_stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gas_stations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '油站名称',
  `cover` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '封面图片',
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
  UNIQUE KEY `gas_stations_name_unique` (`name`),
  KEY `gas_stations_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gas_stations`
--

LOCK TABLES `gas_stations` WRITE;
/*!40000 ALTER TABLE `gas_stations` DISABLE KEYS */;
INSERT INTO `gas_stations` VALUES (1,'谈固加油站',NULL,'114.574148','38.047426',1,'13088888888',NULL,'河北省','石家庄市','长安区','谈固加油站',0,'2018-01-05 16:41:36','2018-01-06 16:07:04','2018-01-06 16:07:04'),(2,'谈固加气站',NULL,'114.574148','38.047426',2,'13088888899',NULL,'河北省','石家庄市','长安区','谈固加气站',0,'2018-01-05 16:48:24','2018-01-06 16:19:18','2018-01-06 16:19:18'),(3,'裕东 加油加气站','uploads/gasStation/20180114/5a5af549a83d0_gasStation.png','114.583528','38.027002',1,'13088888888','0311-88888888','河北省','石家庄市','裕华区','中国石化加油站(裕华东路)',0,'2018-01-09 15:06:52','2018-01-17 12:32:38',NULL),(4,'东风 加油加气站',NULL,'114.639344','38.051294',1,'13088847474',NULL,'河北省','石家庄市','裕华区','东风 加油加气站',0,'2018-01-09 15:11:33','2018-01-17 11:50:25','2018-01-17 11:50:25'),(5,'二神庙加油站','uploads/gasStation/20180115/5a5cad59d9025_gasStation.png','114.569203','38.046481',1,'13088888888','0311-88888888','河北省','石家庄市','长安区','二神庙加油站',0,'2018-01-16 16:39:07','2018-01-16 16:39:07',NULL),(6,'赵县308国道加油站','uploads/gasStation/20180114/5a5af549a83d0_gasStation.png','114.777714','37.739488',1,'13088888888','0311-88888888','河北省','石家庄市','赵县','赵县308国道加油站',0,'2018-01-17 11:53:41','2018-01-17 11:53:41',NULL),(7,'跃进 加油加气站','uploads/gasStation/20180115/5a5cad59d9025_gasStation.png','114.576095','38.056182',1,'13088888899','0311-88888888','河北省','石家庄市','长安区','跃进 加油加气站',0,'2018-01-17 12:29:00','2018-01-17 12:29:00',NULL);
/*!40000 ALTER TABLE `gas_stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_05_145447_create_gas_stations_table',1),(4,'2018_01_05_152233_create_comments_table',1),(5,'2018_01_05_153004_create_series_table',1),(6,'2018_01_05_155514_create_gas_station_series_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serial_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'#94号汽油','#94','2018-01-05 18:17:25','2018-01-05 18:17:25'),(2,'93#','93#',NULL,NULL);
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱地址',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用:0否,1禁用',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','$2y$10$5vHi84adIlv.nYwNCVIRueTrE7AKZSfdAroC7pp4qsIDQIi0mqtcK',0,'huqQQrhS8Wvfu6EwqoISXepVr09vHxcjC8iWLjF0GTgpCI0ccIynJgxBYEB2',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-21 14:49:26
