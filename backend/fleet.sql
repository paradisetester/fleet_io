-- MySQL dump 10.16  Distrib 10.1.44-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: fleet
-- ------------------------------------------------------
-- Server version	10.1.44-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `body_sub_types`
--

DROP TABLE IF EXISTS `body_sub_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `body_sub_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `body_sub_types`
--

LOCK TABLES `body_sub_types` WRITE;
/*!40000 ALTER TABLE `body_sub_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `body_sub_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `body_types`
--

DROP TABLE IF EXISTS `body_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `body_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `body_types`
--

LOCK TABLES `body_types` WRITE;
/*!40000 ALTER TABLE `body_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `body_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `careers`
--

DROP TABLE IF EXISTS `careers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `careers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_letter` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_for` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `careers`
--

LOCK TABLES `careers` WRITE;
/*!40000 ALTER TABLE `careers` DISABLE KEYS */;
/*!40000 ALTER TABLE `careers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactus`
--

LOCK TABLES `contactus` WRITE;
/*!40000 ALTER TABLE `contactus` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuels`
--

DROP TABLE IF EXISTS `fuels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuels` (
  `fuel_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `odometer` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal` int(11) NOT NULL,
  `partial_fuel_up` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fuel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuels`
--

LOCK TABLES `fuels` WRITE;
/*!40000 ALTER TABLE `fuels` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspection_template_items`
--

DROP TABLE IF EXISTS `inspection_template_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspection_template_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `inspection_template_id` bigint(20) unsigned NOT NULL,
  `fields` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inspection_template_items_user_id_foreign` (`user_id`),
  KEY `inspection_template_items_inspection_template_id_foreign` (`inspection_template_id`),
  CONSTRAINT `inspection_template_items_inspection_template_id_foreign` FOREIGN KEY (`inspection_template_id`) REFERENCES `inspection_templates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inspection_template_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspection_template_items`
--

LOCK TABLES `inspection_template_items` WRITE;
/*!40000 ALTER TABLE `inspection_template_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `inspection_template_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspection_templates`
--

DROP TABLE IF EXISTS `inspection_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspection_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected_template` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inspection_templates_user_id_foreign` (`user_id`),
  CONSTRAINT `inspection_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspection_templates`
--

LOCK TABLES `inspection_templates` WRITE;
/*!40000 ALTER TABLE `inspection_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `inspection_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `issue_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reported_date` date NOT NULL,
  `summery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `odometer` int(11) NOT NULL,
  `labels` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reported_by` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `link_order` int(11) NOT NULL DEFAULT '0',
  `link_parent` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,'about-us','About Us',1,0,0,'2020-10-22 11:44:25','2020-10-22 11:44:25'),(2,'plans','Plans',2,1,0,'2020-10-22 11:44:25','2020-10-22 11:44:25'),(3,'contact-us','Contact Us',3,2,0,'2020-10-22 11:44:25','2020-10-22 11:44:25'),(4,'career-form','Career Form',4,3,0,'2020-10-22 11:44:25','2020-10-22 11:44:25');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (33,'2014_10_12_000000_create_users_table',1),(34,'2014_10_12_100000_create_password_resets_table',1),(35,'2016_06_01_000001_create_oauth_auth_codes_table',1),(36,'2016_06_01_000002_create_oauth_access_tokens_table',1),(37,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(38,'2016_06_01_000004_create_oauth_clients_table',1),(39,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(40,'2019_08_19_000000_create_failed_jobs_table',1),(41,'2019_11_07_120805_create_links_table',1),(42,'2020_09_30_061850_create_vehicle_makes_table',1),(43,'2020_09_30_063244_create_body_types_table',1),(44,'2020_09_30_063324_create_body_sub_types_table',1),(45,'2020_09_30_063423_create_vehicle_details_table',1),(46,'2020_09_30_063457_create_vehicle_lif_cycles_table',1),(47,'2020_09_30_063515_create_vehicle_specifications_table',1),(48,'2020_09_30_063532_create_vehicle_settings_table',1),(49,'2020_09_30_063725_create_vehicle_expense_histories_table',1),(50,'2020_09_30_063915_create_vehicle_assignments_table',1),(51,'2020_09_30_065106_create_vehicle_inspections_table',1),(52,'2020_09_30_065219_create_vehicle_inspection_items_table',1),(53,'2020_09_30_065445_create_posts_table',1),(54,'2020_09_30_065654_create_issues_table',1),(55,'2020_09_30_070211_create_service_table',1),(56,'2020_09_30_070211_create_vendors_table',1),(57,'2020_09_30_070230_create_fuels_table',1),(58,'2020_10_13_074028_plans',1),(59,'2020_10_16_074255_contact_us',1),(60,'2020_10_16_075127_create_careers_table',1),(61,'2020_10_17_064712_create_vehicle_models_table',1),(62,'2020_10_17_065428_create_vehicletypes_table',1),(63,'2020_10_17_073148_create_inspection_templates_table',1),(64,'2020_10_17_073232_create_inspection_template_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('3e30ca55bc87164c4e42c695d5f6e70ef0c39bafa3ca742f964709a8ac15087f7860286a5b0d4c88',1,1,NULL,'[]',0,'2020-10-22 11:38:46','2020-10-22 11:38:46','2021-10-22 11:38:46'),('65900a720e7a8efd0b0feb04617b15e7d5b3e428b03b8a9b302887e575ec3449bf0215922316deea',1,1,NULL,'[]',0,'2020-10-22 11:39:20','2020-10-22 11:39:20','2021-10-22 11:39:20');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'fleetio','HlyvQKY93Iowkq1SlcnzbDvZ0el1irsM8MqcvFGy','users','http://localhost',0,1,0,'2020-10-22 11:34:06','2020-10-22 11:34:06');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES ('5f4a179bf9b073a067d9872785535a5370582235c29eed9d1fd0ce31987c37927e0072af407dea3c','3e30ca55bc87164c4e42c695d5f6e70ef0c39bafa3ca742f964709a8ac15087f7860286a5b0d4c88',0,'2020-11-21 11:38:46'),('df50f4c3ef44c5157558ee71587b092e5fabf6f35c9be194b1c81f51ba74a332e70a8498194910c5','65900a720e7a8efd0b0feb04617b15e7d5b3e428b03b8a9b302887e575ec3449bf0215922316deea',0,'2020-11-21 11:39:20');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `plan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `times` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,1,'Standard','10.99','publish','monthly','blue','<ul class=\"pricing-content\">\n                                <li><i class=\"fa fa-check\"></i> 60GB Disk Space</li>\n                                <li><i class=\"fa fa-check\"></i> 60 Email Accounts</li>\n                                <li><i class=\"fa fa-check\"></i> 60GB Bandwidth</li>\n                                <li><i class=\"fa fa-times\"></i> 15 Subdomains</li>\n                                <li><i class=\"fa fa-check\"></i> 20 Domains</li>\n                            </ul>','2020-10-22 11:47:19','2020-10-22 11:47:19'),(2,1,'Premium','20.99','publish','monthly','pink','<ul class=\"pricing-content\">\n                                <li><i class=\"fa fa-check\"></i> 70GB Disk Space</li>\n                                <li><i class=\"fa fa-check\"></i> 70 Email Accounts</li>\n                                <li><i class=\"fa fa-check\"></i> 70GB Bandwidth</li>\n                                <li><i class=\"fa fa-check\"></i> 20 Subdomains</li>\n                                <li><i class=\"fa fa-check\"></i> 25 Domains</li>\n                            </ul>','2020-10-22 11:49:20','2020-10-22 11:49:20'),(3,1,'Advance','30.99','publish','monthly',NULL,'<ul class=\"pricing-content\">\n                                <li><i class=\"fa fa-check\"></i> 70GB Disk Space</li>\n                                <li><i class=\"fa fa-check\"></i> 70 Email Accounts</li>\n                                <li><i class=\"fa fa-check\"></i> 70GB Bandwidth</li>\n                                <li><i class=\"fa fa-check\"></i> 20 Subdomains</li>\n                                <li><i class=\"fa fa-check\"></i> 25 Domains</li>\n                            </ul>','2020-10-22 11:49:59','2020-10-22 11:49:59');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'About Us','Lorem Ipsum is simply dummy text of the printing and typesetting industry','about-us','publish','public/images/uploads/2020/Oct/1603366839_slider3.png','<p><span style=\"color: rgb(113, 128, 150);\">Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.</span></p>','Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.','About Us','About Us Fleetio page','page','aboutUs','2020-10-22 11:40:39','2020-10-22 11:40:39'),(2,1,'Plans','Eliminate the cost of downtime.','plans','publish','public/images/uploads/2020/Oct/1603366926_slider2.png','<p>For fleets that outsource all maintenance and repairs to external shops</p>','14-day free trial. Simple, scalable pricing. No credit card required.','Plans','For fleets that outsource all maintenance and repairs to external shops','page','plans','2020-10-22 11:42:06','2020-10-22 11:42:06'),(3,1,'Contact Us','Please fill the below form to contact us','contact-us','publish','public/images/uploads/2020/Oct/1603367009_slider1.png','<p>For fleets that outsource all maintenance and repairs to external shops</p>','Vehicles and other records labeled as Sample are available to help you explore how Fleetio works during your trial.','Test','Contact us','page','contactUs','2020-10-22 11:43:29','2020-10-22 11:43:29'),(4,1,'Career Form','Lorem Ipsum is simply dummy text of the printing and typesetting industry','career-form','publish','public/images/uploads/2020/Oct/1603367049_slider1.png','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>','Lorem Ipsum is simply dummy text of the printing and typesetting industry','Career form','Career form page','page','career','2020-10-22 11:44:09','2020-10-22 11:44:09'),(5,1,'Testimonials 1','Admin','testimonials-1','publish','public/images/uploads/2020/Oct/1603367972_slider1.png','Testimonials test','test','undefined','undefined','testimonial','default','2020-10-22 11:59:32','2020-10-22 11:59:32'),(6,1,'Testimonial 2','Admin','testimonial-2','publish','public/images/uploads/2020/Oct/1603368019_slider2.png','Testimonial test','Admin ttest','undefined','undefined','testimonial','default','2020-10-22 12:00:19','2020-10-22 12:00:19'),(7,1,'Testmonials 3','admin','testmonials-3','publish','public/images/uploads/2020/Oct/1603368058_slider3.png','Testimonials 3 test','test','undefined','undefined','testimonial','default','2020-10-22 12:00:58','2020-10-22 12:00:58'),(8,1,'Testimonials 4','Admin','testimonials-4','publish','public/images/uploads/2020/Oct/1603368117_car1.jpg','Testimonials 4 testing','Admin test','undefined','undefined','testimonial','default','2020-10-22 12:01:57','2020-10-22 12:01:57');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_history`
--

DROP TABLE IF EXISTS `service_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_history` (
  `service_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `odometer` int(11) NOT NULL,
  `completion_date` date NOT NULL,
  `completion_time` time NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_history`
--

LOCK TABLES `service_history` WRITE;
/*!40000 ALTER TABLE `service_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','2020-10-22 11:28:04','$2y$10$hdYl1mL7dYebfcGEA60G9ubgcU6hrtm7zE/ki3qX3OwZr1lBfSEhu','Y0vNXa9rvT','2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,'Anju Batta','anjubatta@gmail.com','2020-10-22 11:28:04','$2y$10$/VIqV10.sGN0epCY0wDimeMuSVBMgXHA6STVqo1/a8/DdejwAbsk6','VDa1uEocR6','2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,'Arun Parashar','arunprasher@gmail.com','2020-10-22 11:28:04','$2y$10$4kSObinQy6U0b1PULfYPGe3UyZNH4iUEyabTKWmgTq6NYPincRvCq','Ye8S726aDY','2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,'Dilpreet Singh','dilpreetsingh@gmail.com','2020-10-22 11:28:04','$2y$10$qRm48zlWDDcMnKDqrm39COTb8SLm9UfVoHNtUYeXqAFyFb5ICIuEe','i1oecFKA5L','2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_assignments`
--

DROP TABLE IF EXISTS `vehicle_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_assignments` (
  `assignment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_email_notification` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `starting_odometer` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `ending_odometer` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_assignments`
--

LOCK TABLES `vehicle_assignments` WRITE;
/*!40000 ALTER TABLE `vehicle_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_details`
--

DROP TABLE IF EXISTS `vehicle_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_details` (
  `vehicle_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_plate` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `trim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `ownership` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_type_id` int(11) NOT NULL,
  `body_sub_type_id` int(11) NOT NULL,
  `msrp` decimal(10,2) NOT NULL,
  `linked_vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_details`
--

LOCK TABLES `vehicle_details` WRITE;
/*!40000 ALTER TABLE `vehicle_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_expense_histories`
--

DROP TABLE IF EXISTS `vehicle_expense_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_expense_histories` (
  `expense_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `expense_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recurring` int(11) NOT NULL,
  `date` date NOT NULL,
  `expense_entry_vendor_id` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_expense_histories`
--

LOCK TABLES `vehicle_expense_histories` WRITE;
/*!40000 ALTER TABLE `vehicle_expense_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_expense_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_inspection_items`
--

DROP TABLE IF EXISTS `vehicle_inspection_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_inspection_items` (
  `inspection_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`inspection_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_inspection_items`
--

LOCK TABLES `vehicle_inspection_items` WRITE;
/*!40000 ALTER TABLE `vehicle_inspection_items` DISABLE KEYS */;
INSERT INTO `vehicle_inspection_items` VALUES (1,6,1,'this is my first title','4','this my first comment','/image/user.jpg','2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,6,2,'this is my Second title','10','this my Second comment','/image/user2.jpg','2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,6,3,'this is my Third title','11','this my Third comment','/image/user3.jpg','2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,6,4,'this is my Fourth title','14','this my Fourth comment','/image/user4.jpg','2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `vehicle_inspection_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_inspections`
--

DROP TABLE IF EXISTS `vehicle_inspections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_inspections` (
  `inspection_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`inspection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_inspections`
--

LOCK TABLES `vehicle_inspections` WRITE;
/*!40000 ALTER TABLE `vehicle_inspections` DISABLE KEYS */;
INSERT INTO `vehicle_inspections` VALUES (1,1,'2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,2,'2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,3,'2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,4,'2020-10-22 11:28:04','2020-10-22 11:28:04'),(5,5,'2020-10-22 11:28:04','2020-10-22 11:28:04'),(6,6,'2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `vehicle_inspections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_life_cycles`
--

DROP TABLE IF EXISTS `vehicle_life_cycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_life_cycles` (
  `lifecycle_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `odometer` int(11) NOT NULL,
  `service_life_in_month` int(11) NOT NULL,
  `service_life_in_miles` int(11) NOT NULL,
  `resale_value` decimal(10,2) NOT NULL,
  `out_of_service_date` date NOT NULL,
  `out_of_service_odometer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lifecycle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_life_cycles`
--

LOCK TABLES `vehicle_life_cycles` WRITE;
/*!40000 ALTER TABLE `vehicle_life_cycles` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_life_cycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_makes`
--

DROP TABLE IF EXISTS `vehicle_makes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_makes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_makes`
--

LOCK TABLES `vehicle_makes` WRITE;
/*!40000 ALTER TABLE `vehicle_makes` DISABLE KEYS */;
INSERT INTO `vehicle_makes` VALUES (1,'Audi','this is my first car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,'BMW','this is my Secord car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,'Porshe','this is my Third car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,'Ford','this is my Fourth car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(5,'Audi','this is my first car','1','2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `vehicle_makes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_models`
--

DROP TABLE IF EXISTS `vehicle_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_models` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_id` bigint(20) unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_models_make_id_foreign` (`make_id`),
  CONSTRAINT `vehicle_models_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `vehicle_makes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_models`
--

LOCK TABLES `vehicle_models` WRITE;
/*!40000 ALTER TABLE `vehicle_models` DISABLE KEYS */;
INSERT INTO `vehicle_models` VALUES (1,'A6 Sedan',5,'this is my first car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,'RS 7 SportBack',5,'this is my Secord car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,'A8L',5,'this is my Third car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,'Q2',5,'this is my Fourth car','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(5,'A6 Sedan',5,'this is my first car Model','1','2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `vehicle_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_settings`
--

DROP TABLE IF EXISTS `vehicle_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_settings` (
  `setting_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `primary_meter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_reading` int(11) NOT NULL,
  `average_usage_per_day` int(11) NOT NULL,
  `auto_calculate` int(11) NOT NULL,
  `secondary_meter_check` int(11) NOT NULL,
  `secondary_meter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_current_reading` int(11) NOT NULL,
  `secondary_average_usage_per_day` int(11) NOT NULL,
  `secondary_auto_calculate` int(11) NOT NULL,
  `fuel_unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measurement_unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_settings`
--

LOCK TABLES `vehicle_settings` WRITE;
/*!40000 ALTER TABLE `vehicle_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_specifications`
--

DROP TABLE IF EXISTS `vehicle_specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_specifications` (
  `specification_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `interior_valume` int(11) NOT NULL,
  `passenger_valume` int(11) NOT NULL,
  `ground_clearance` int(11) NOT NULL,
  `bed_length` int(11) NOT NULL,
  `curb_weight` int(11) NOT NULL,
  `gross_weight` int(11) NOT NULL,
  `towing_capacity` int(11) NOT NULL,
  `max_payload` int(11) NOT NULL,
  `epa_city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epa_highway` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epa_combined` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_summery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_aspiration` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_type` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bore` int(11) NOT NULL,
  `cam_type` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compression` int(11) NOT NULL,
  `cylinders` int(11) NOT NULL,
  `displacement` int(11) NOT NULL,
  `fuel_injection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_hp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_torque` int(11) NOT NULL,
  `redline_rpm` int(11) NOT NULL,
  `stroke` int(11) NOT NULL,
  `valves` int(11) NOT NULL,
  `transmission_summery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission_gears` int(11) NOT NULL,
  `drive_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brake_system` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_track_width` int(11) NOT NULL,
  `rear_track_width` int(11) NOT NULL,
  `wheelbase` int(11) NOT NULL,
  `front_wheel_diameter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rear_wheel_diameter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rar_axle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_tyre_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_tyre_psi` int(11) NOT NULL,
  `rear_tyre_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rear_tyre_psi` int(11) NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_quality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_tank_1_capacity` int(11) NOT NULL,
  `fuel_tank_2_capacity` int(11) NOT NULL,
  `oil_capacity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`specification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_specifications`
--

LOCK TABLES `vehicle_specifications` WRITE;
/*!40000 ALTER TABLE `vehicle_specifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicletypes`
--

DROP TABLE IF EXISTS `vehicletypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicletypes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicletypes_model_id_foreign` (`model_id`),
  CONSTRAINT `vehicletypes_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicletypes`
--

LOCK TABLES `vehicletypes` WRITE;
/*!40000 ALTER TABLE `vehicletypes` DISABLE KEYS */;
INSERT INTO `vehicletypes` VALUES (1,'A6 2.0T Premium',5,'this is my first car Trim','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(2,'2019 A6 2.0T)',5,'this is my Secord car Trim','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(3,'2019 A6)',5,'this is my Third car Trim','1','2020-10-22 11:28:04','2020-10-22 11:28:04'),(4,'2018 A6)',5,'this is my Fourth car Trim','1','2020-10-22 11:28:04','2020-10-22 11:28:04');
/*!40000 ALTER TABLE `vehicletypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `vendor_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-22 12:56:18
