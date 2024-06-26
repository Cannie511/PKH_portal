-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: pkh_db_prod
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.16.04.1

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
-- Table structure for table `download_management`
--

DROP TABLE IF EXISTS `download_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `download_management` (
  `download_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `screen` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `descript` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13792 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_area`
--

DROP TABLE IF EXISTS `mst_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_area` (
  `area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_area_id` int(11) DEFAULT NULL,
  `area_group_id` int(11) DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_area_group`
--

DROP TABLE IF EXISTS `mst_area_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_area_group` (
  `area_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_day` int(11) NOT NULL DEFAULT '3',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_bank_account`
--

DROP TABLE IF EXISTS `mst_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_bank_account` (
  `bank_account_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) NOT NULL,
  `bank_name` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch` text COLLATE utf8_unicode_ci,
  `bank_account_no` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_branch`
--

DROP TABLE IF EXISTS `mst_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_branch` (
  `branch_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_contact` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_cd`
--

DROP TABLE IF EXISTS `mst_cd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_cd` (
  `group_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code_cd` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `code_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code_value` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`code_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_chanh`
--

DROP TABLE IF EXISTS `mst_chanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_chanh` (
  `chanh_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area1` int(11) DEFAULT NULL,
  `area2` int(11) DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chanh_sts` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chanh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_cost_cat`
--

DROP TABLE IF EXISTS `mst_cost_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_cost_cat` (
  `cost_cat_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cost_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_dealer`
--

DROP TABLE IF EXISTS `mst_dealer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_dealer` (
  `dealer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area1` int(11) NOT NULL,
  `area2` int(11) NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_delivery_vendor`
--

DROP TABLE IF EXISTS `mst_delivery_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_delivery_vendor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_vendor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_department`
--

DROP TABLE IF EXISTS `mst_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_department` (
  `department_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_employee_info`
--

DROP TABLE IF EXISTS `mst_employee_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_employee_info` (
  `employee_id` int(11) NOT NULL,
  `employee_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `devision` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `address_permernance` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_contact` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id_issue_on` date DEFAULT NULL,
  `card_id_issue_at` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel1` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel2` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_sts` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `probation_start_date` date DEFAULT NULL,
  `probation_end_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `count_dependent_person` int(11) DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  `passcode` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_func_conf`
--

DROP TABLE IF EXISTS `mst_func_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_func_conf` (
  `func_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chr_val` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_val` date DEFAULT NULL,
  `dtm_val` datetime DEFAULT NULL,
  `tim_val` time DEFAULT NULL,
  `int_val` int(11) DEFAULT NULL,
  `txt_val` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_gift`
--

DROP TABLE IF EXISTS `mst_gift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_gift` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_holiday`
--

DROP TABLE IF EXISTS `mst_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `reason` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(5,2) NOT NULL DEFAULT '1.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mst_holiday_holiday_date_index` (`holiday_date`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_news`
--

DROP TABLE IF EXISTS `mst_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `publish_date` date DEFAULT NULL,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `image_path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feature_image_path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_flg` tinyint(1) NOT NULL DEFAULT '1',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_oa_follower`
--

DROP TABLE IF EXISTS `mst_oa_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_oa_follower` (
  `oa_follower_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id_by_app` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oa_follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_packaging`
--

DROP TABLE IF EXISTS `mst_packaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_packaging` (
  `packaging_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`packaging_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_product`
--

DROP TABLE IF EXISTS `mst_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product` (
  `product_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_type` int(11) NOT NULL DEFAULT '0',
  `supplier_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `product_code` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `stock_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_origin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text COLLATE utf8_unicode_ci,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `packing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `moq` int(11) DEFAULT NULL,
  `handle_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `packing_id` int(11) DEFAULT NULL,
  `packaging_id` int(11) DEFAULT NULL,
  `standard_packing` int(11) DEFAULT NULL,
  `warning_qty` int(11) NOT NULL DEFAULT '0',
  `purchase_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `accountant_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_sample` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `product_code_old` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_order_flg` tinyint(1) NOT NULL DEFAULT '0',
  `warranty_year` int(11) NOT NULL DEFAULT '0',
  `chr_feature` text COLLATE utf8_unicode_ci,
  `priority_degree` int(11) NOT NULL DEFAULT '0',
  `selling_price_retail` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_standard` decimal(19,2) NOT NULL DEFAULT '0.00',
  `import_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `shopee_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `mst_product_product_code_unique` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_product_cat`
--

DROP TABLE IF EXISTS `mst_product_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product_cat` (
  `product_cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `product_cat_code` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_origin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text,
  `allow_order_flg` tinyint(1) NOT NULL DEFAULT '1',
  `priority` int(11) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_cat_id`),
  UNIQUE KEY `mst_product_cat_product_cat_code_unique` (`product_cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_product_handle`
--

DROP TABLE IF EXISTS `mst_product_handle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product_handle` (
  `product_handle_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_handle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_product_market`
--

DROP TABLE IF EXISTS `mst_product_market`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product_market` (
  `product_market_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '1',
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_market_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_product_series`
--

DROP TABLE IF EXISTS `mst_product_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product_series` (
  `product_id` bigint(20) NOT NULL,
  `product_detail_id` bigint(20) NOT NULL,
  `selling_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`product_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_promotion`
--

DROP TABLE IF EXISTS `mst_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_promotion` (
  `promotion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `promotion_name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `promotion_type` int(11) NOT NULL DEFAULT '0',
  `promotion_sts` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `meta_data` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_store`
--

DROP TABLE IF EXISTS `mst_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_store` (
  `store_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `level` int(11) DEFAULT NULL,
  `area1` int(11) DEFAULT NULL,
  `area2` int(11) DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_store_id` bigint(20) NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `store_sts` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `tax_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `chanh_id` bigint(20) DEFAULT NULL,
  `address_chanh` text COLLATE utf8_unicode_ci,
  `gps_lat_chanh` double NOT NULL DEFAULT '0',
  `gps_long_chanh` double NOT NULL DEFAULT '0',
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL,
  `inner_flg` tinyint(1) NOT NULL DEFAULT '0',
  `first_order` date DEFAULT NULL,
  `accountant_store_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zalo_user_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_sts` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `review_user_id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `review_expired_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2269 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_supplier`
--

DROP TABLE IF EXISTS `mst_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_supplier` (
  `supplier_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_task_group`
--

DROP TABLE IF EXISTS `mst_task_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_task_group` (
  `task_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `task_group_weight` int(11) NOT NULL DEFAULT '0',
  `task_group_notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_warehouse`
--

DROP TABLE IF EXISTS `mst_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_warehouse` (
  `warehouse_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_warehouse_block`
--

DROP TABLE IF EXISTS `mst_warehouse_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_warehouse_block` (
  `warehouse_block_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) NOT NULL,
  `parent_block_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_block_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_warehouse_block_lot`
--

DROP TABLE IF EXISTS `mst_warehouse_block_lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_warehouse_block_lot` (
  `warehouse_block_id` int(11) NOT NULL,
  `warehouse_lot_id` int(11) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_block_id`,`warehouse_lot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_warehouse_lot`
--

DROP TABLE IF EXISTS `mst_warehouse_lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_warehouse_lot` (
  `warehouse_lot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `max_item` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_lot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mst_warehouse_product`
--

DROP TABLE IF EXISTS `mst_warehouse_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_warehouse_product` (
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23519 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=385 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_absent`
--

DROP TABLE IF EXISTS `trn_absent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_absent` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `absent_date` date NOT NULL,
  `amount` double(4,2) NOT NULL,
  `absent_type` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL DEFAULT '1',
  `reason` text COLLATE utf8_unicode_ci,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `approve_user_id` int(11) NOT NULL,
  `cmt` text COLLATE utf8_unicode_ci,
  `approve_ts` timestamp NULL DEFAULT NULL,
  `leave_allocation_id` int(11) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_absent_setting`
--

DROP TABLE IF EXISTS `trn_absent_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_absent_setting` (
  `user_id` int(11) NOT NULL,
  `setting_year` int(11) NOT NULL,
  `amount` double(4,2) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`setting_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_attendance`
--

DROP TABLE IF EXISTS `trn_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_attendance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `ip_as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(10,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7542 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_audit_log`
--

DROP TABLE IF EXISTS `trn_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_audit_log` (
  `user_id` int(11) NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `ip_as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(11,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_batch_log`
--

DROP TABLE IF EXISTS `trn_batch_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_batch_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_time` datetime NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5098 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_branch_export`
--

DROP TABLE IF EXISTS `trn_branch_export`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_branch_export` (
  `branch_export_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id_from` bigint(20) NOT NULL,
  `branch_id_to` bigint(20) NOT NULL,
  `branch_export_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `seq_no` int(11) NOT NULL,
  `export_sts` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `warehouseman_id` bigint(20) DEFAULT NULL,
  `shipping_id` bigint(20) DEFAULT NULL,
  `packing_time` datetime DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `shipping_time` datetime DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `packing_by` bigint(20) DEFAULT NULL,
  `confirm_by` bigint(20) DEFAULT NULL,
  `delivery_by` bigint(20) DEFAULT NULL,
  `shipping_by` bigint(20) DEFAULT NULL,
  `receive_by` bigint(20) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_export_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_branch_export_detail`
--

DROP TABLE IF EXISTS `trn_branch_export_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_branch_export_detail` (
  `branch_export_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_export_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_branch_import`
--

DROP TABLE IF EXISTS `trn_branch_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_branch_import` (
  `branch_import_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id_from` bigint(20) NOT NULL,
  `branch_id_to` bigint(20) NOT NULL,
  `branch_import_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `seq_no` int(11) NOT NULL,
  `import_sts` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `warehouseman_id` bigint(20) DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `import_time` datetime DEFAULT NULL,
  `confirm_by` bigint(20) DEFAULT NULL,
  `import_by` bigint(20) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_import_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_branch_import_detail`
--

DROP TABLE IF EXISTS `trn_branch_import_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_branch_import_detail` (
  `branch_import_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_import_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_check_warehouse`
--

DROP TABLE IF EXISTS `trn_check_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_check_warehouse` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `check_user_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `check_date` date NOT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `checking_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_check_warehouse_detail`
--

DROP TABLE IF EXISTS `trn_check_warehouse_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_check_warehouse_detail` (
  `check_warehouse_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8_unicode_ci,
  `notes_2` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_comment`
--

DROP TABLE IF EXISTS `trn_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id1` bigint(20) DEFAULT NULL,
  `id2` bigint(20) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `trn_comment_group_index` (`group`),
  KEY `trn_comment_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_cost`
--

DROP TABLE IF EXISTS `trn_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_cost` (
  `cost_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cost_cat_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `cost_date` date NOT NULL,
  `amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `contra_account` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `voucher` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  `confirm_time` datetime DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `request_notes` text COLLATE utf8_unicode_ci,
  `confirm_notes` text COLLATE utf8_unicode_ci,
  `cancel_notes` text COLLATE utf8_unicode_ci,
  `confirm_by` int(11) DEFAULT NULL,
  `cost_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`cost_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2204 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_cs_notes`
--

DROP TABLE IF EXISTS `trn_cs_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_cs_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) NOT NULL,
  `pic_id` bigint(20) DEFAULT NULL,
  `cus_review` text COLLATE utf8_unicode_ci NOT NULL,
  `com_resolve` text COLLATE utf8_unicode_ci,
  `cus_rating` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `com_rating` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `notes_1` text COLLATE utf8_unicode_ci,
  `notes_2` text COLLATE utf8_unicode_ci,
  `notes_3` text COLLATE utf8_unicode_ci,
  `deadline` datetime DEFAULT NULL,
  `completed_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '5',
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3846 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_delivery`
--

DROP TABLE IF EXISTS `trn_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_delivery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_date` date NOT NULL,
  `delivery_vendor_id` bigint(20) NOT NULL,
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_flg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1574 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_delivery_detail`
--

DROP TABLE IF EXISTS `trn_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_delivery_detail` (
  `delivery_id` bigint(20) NOT NULL,
  `store_delivery_id` bigint(20) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_display_price_table`
--

DROP TABLE IF EXISTS `trn_display_price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_display_price_table` (
  `product_id` bigint(20) NOT NULL,
  `int_order_no` int(11) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_employee_contract`
--

DROP TABLE IF EXISTS `trn_employee_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_employee_contract` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `contract_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `basic_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `contract_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_esms_record`
--

DROP TABLE IF EXISTS `trn_esms_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_esms_record` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` bigint(20) DEFAULT NULL,
  `param` text COLLATE utf8_unicode_ci,
  `type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_result` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SMSID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1686 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_etest`
--

DROP TABLE IF EXISTS `trn_etest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_etest` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_min` int(11) NOT NULL DEFAULT '30',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_etest_assign`
--

DROP TABLE IF EXISTS `trn_etest_assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_etest_assign` (
  `etest_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `mark` int(11) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_etest_result`
--

DROP TABLE IF EXISTS `trn_etest_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_etest_result` (
  `etest_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `mark` int(11) NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`user_id`,`seq_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_etest_sentence`
--

DROP TABLE IF EXISTS `trn_etest_sentence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_etest_sentence` (
  `etest_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `seq_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `question` text COLLATE utf8_unicode_ci,
  `answer` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`seq_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_gift_use`
--

DROP TABLE IF EXISTS `trn_gift_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_gift_use` (
  `gift_id` bigint(20) NOT NULL,
  `use_type` int(11) NOT NULL,
  `use_date` date NOT NULL,
  `use_sts` int(11) NOT NULL DEFAULT '0',
  `order_id` bigint(20) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_guarantee`
--

DROP TABLE IF EXISTS `trn_guarantee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_guarantee` (
  `id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `area1` int(11) NOT NULL,
  `area2` int(11) DEFAULT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(10,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_import_wh_factory`
--

DROP TABLE IF EXISTS `trn_import_wh_factory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_import_wh_factory` (
  `import_wh_factory_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint(20) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `import_date` date NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_factory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_import_wh_store`
--

DROP TABLE IF EXISTS `trn_import_wh_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_import_wh_store` (
  `import_wh_store_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `import_type` int(11) NOT NULL DEFAULT '1',
  `store_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `import_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `import_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `salesman_id` int(11) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_import_wh_store_detail`
--

DROP TABLE IF EXISTS `trn_import_wh_store_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_import_wh_store_detail` (
  `import_wh_store_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_store_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_internal_news`
--

DROP TABLE IF EXISTS `trn_internal_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_internal_news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `news_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_internal_news_viewed`
--

DROP TABLE IF EXISTS `trn_internal_news_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_internal_news_viewed` (
  `user_id` int(11) NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_leave_alloc`
--

DROP TABLE IF EXISTS `trn_leave_alloc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_leave_alloc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expired_date` date NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_leave_allocation`
--

DROP TABLE IF EXISTS `trn_leave_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_leave_allocation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `num_days` decimal(5,2) NOT NULL,
  `reason` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_oa_follower_message`
--

DROP TABLE IF EXISTS `trn_oa_follower_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_oa_follower_message` (
  `oa_follower_message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `total` bigint(20) DEFAULT NULL,
  `total_sent` bigint(20) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oa_follower_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_order_edit_request`
--

DROP TABLE IF EXISTS `trn_order_edit_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_order_edit_request` (
  `request_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_date` date NOT NULL,
  `request_type` int(11) NOT NULL DEFAULT '1',
  `request_sts` int(11) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) DEFAULT NULL,
  `request_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `response_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1631 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_payment`
--

DROP TABLE IF EXISTS `trn_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_payment` (
  `payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int(11) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT '1',
  `payment_sts` int(11) NOT NULL DEFAULT '0',
  `payment_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `bank_account_id` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6009 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_payment_advance`
--

DROP TABLE IF EXISTS `trn_payment_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_payment_advance` (
  `payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int(11) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT '1',
  `payment_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `payment_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `bank_account_id` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `confirm_notes` text COLLATE utf8_unicode_ci,
  `confirm_by` text COLLATE utf8_unicode_ci,
  `confirm_time` text COLLATE utf8_unicode_ci,
  `cancel_time` text COLLATE utf8_unicode_ci,
  `cancel_notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_product_market_his`
--

DROP TABLE IF EXISTS `trn_product_market_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_product_market_his` (
  `product_market_his_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_change_type` int(11) NOT NULL,
  `product_market_id` bigint(20) NOT NULL,
  `changed_date` date NOT NULL,
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `amount` int(11) NOT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci,
  `description_approve` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_market_his_id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_product_price_his`
--

DROP TABLE IF EXISTS `trn_product_price_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_product_price_his` (
  `product_id` bigint(20) NOT NULL,
  `selling_price` decimal(19,2) NOT NULL,
  `selling_price_sample` decimal(19,2) NOT NULL,
  `selling_price_tax` decimal(19,2) NOT NULL,
  `change_user_id` int(11) NOT NULL,
  `change_time` datetime NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_salary`
--

DROP TABLE IF EXISTS `trn_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_salary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `salary_month` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int(11) NOT NULL DEFAULT '0',
  `total_hours` int(11) NOT NULL DEFAULT '0',
  `total_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_com_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_bhxh` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_bhyt` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_bhtn` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_com_bhxh` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_com_bhyt` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_com_bhtn` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_bhxh_percent` decimal(5,2) NOT NULL DEFAULT '8.00',
  `tax_bhyt_percent` decimal(5,2) NOT NULL DEFAULT '1.50',
  `tax_bhtn_percent` decimal(5,2) NOT NULL DEFAULT '1.00',
  `com_tax_bhxh_percent` decimal(5,2) NOT NULL DEFAULT '8.00',
  `com_tax_bhyt_percent` decimal(5,2) NOT NULL DEFAULT '1.50',
  `com_tax_bhtn_percent` decimal(5,2) NOT NULL DEFAULT '1.00',
  `min_salary_area` decimal(19,2) NOT NULL DEFAULT '0.00',
  `salary_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_salary_salary_month_unique` (`salary_month`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_salary_detail`
--

DROP TABLE IF EXISTS `trn_salary_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_salary_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `total_days` float NOT NULL DEFAULT '0',
  `total_hours` int(11) NOT NULL DEFAULT '0',
  `count_dependent_person` int(11) NOT NULL DEFAULT '0',
  `overtime_hour` decimal(19,2) NOT NULL DEFAULT '0.00',
  `gross_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `basic_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `real_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `overtime_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `bonus` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_bhxh` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_bhyt` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_bhtn` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_pit` decimal(19,2) NOT NULL DEFAULT '0.00',
  `tax_pit_edit` decimal(19,2) NOT NULL DEFAULT '0.00',
  `minus_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `advance` decimal(19,2) NOT NULL DEFAULT '0.00',
  `net_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `com_tax_bhxh` decimal(19,2) NOT NULL DEFAULT '0.00',
  `com_tax_bhyt` decimal(19,2) NOT NULL DEFAULT '0.00',
  `com_tax_bhtn` decimal(19,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_salary_detail_employee_id_salary_id_unique` (`employee_id`,`salary_id`),
  KEY `trn_salary_detail_employee_id_salary_id_index` (`employee_id`,`salary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_salesman_store`
--

DROP TABLE IF EXISTS `trn_salesman_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_salesman_store` (
  `salesman_store_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int(11) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`salesman_store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1475 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store`
--

DROP TABLE IF EXISTS `trn_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store` (
  `new_store_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `area1` int(11) NOT NULL,
  `area2` int(11) NOT NULL,
  `gps_lat` double NOT NULL,
  `gps_long` double NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`new_store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_check_in`
--

DROP TABLE IF EXISTS `trn_store_check_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_check_in` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4625 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_check_in_images`
--

DROP TABLE IF EXISTS `trn_store_check_in_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_check_in_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `check_in_id` bigint(20) NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4794 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_delivery`
--

DROP TABLE IF EXISTS `trn_store_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_delivery` (
  `store_delivery_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_order_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` bigint(20) NOT NULL,
  `delivery_date` date NOT NULL,
  `discount_1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `total` decimal(19,2) NOT NULL,
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `delivery_seq_no` int(11) NOT NULL DEFAULT '0',
  `delivery_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `notes_cancel` text COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL,
  `promotion_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) NOT NULL DEFAULT '1',
  `shipping_id` bigint(20) DEFAULT NULL,
  `order_type` int(11) NOT NULL DEFAULT '0',
  `packing_time` datetime DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `shipping_time` datetime DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `packing_by` int(11) DEFAULT NULL,
  `confirm_by` int(11) DEFAULT NULL,
  `delivery_by` int(11) DEFAULT NULL,
  `shipping_by` int(11) DEFAULT NULL,
  `receive_by` int(11) DEFAULT NULL,
  `finish_by` int(11) DEFAULT NULL,
  `store_delivery_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8633 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_delivery_detail`
--

DROP TABLE IF EXISTS `trn_store_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_delivery_detail` (
  `store_delivery_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_delivery_payment`
--

DROP TABLE IF EXISTS `trn_store_delivery_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_delivery_payment` (
  `trn_store_delivery` bigint(20) unsigned NOT NULL,
  `delivery_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_sts` int(11) NOT NULL DEFAULT '1',
  `payment_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_finish_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trn_store_delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_delivery_sign`
--

DROP TABLE IF EXISTS `trn_store_delivery_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_delivery_sign` (
  `store_delivery_sign_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_delivery_id` bigint(20) NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_sign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_kpi`
--

DROP TABLE IF EXISTS `trn_store_kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_kpi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL DEFAULT '0',
  `target_year` decimal(19,2) NOT NULL DEFAULT '0.00',
  `result_year` decimal(19,2) NOT NULL DEFAULT '0.00',
  `discount` int(11) NOT NULL DEFAULT '0',
  `month_1_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_2_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_3_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_4_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_5_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_6_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_7_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_8_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_9_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_10_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_11_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_12_target` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_1_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_2_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_3_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_4_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_5_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_6_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_7_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_8_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_9_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_10_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_11_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `month_12_result` decimal(19,2) NOT NULL DEFAULT '0.00',
  `kpi_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_kpi_detail`
--

DROP TABLE IF EXISTS `trn_store_kpi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_kpi_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL,
  `month_index` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `result_amount` int(11) NOT NULL DEFAULT '0',
  `result_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1629 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_order`
--

DROP TABLE IF EXISTS `trn_store_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_order` (
  `store_order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_order_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `prev_store_order_id` bigint(20) DEFAULT NULL,
  `prev_store_order_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` bigint(20) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `discount_1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `order_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `order_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `notes_cancel` text COLLATE utf8_unicode_ci,
  `salesman_id` int(11) DEFAULT NULL,
  `count_print` int(11) NOT NULL DEFAULT '0',
  `last_print_check_time` datetime DEFAULT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `cancel_time` datetime DEFAULT NULL,
  `split_time` datetime DEFAULT NULL,
  `promotion_id` bigint(20) DEFAULT NULL,
  `admin_time` decimal(5,2) NOT NULL DEFAULT '0.00',
  `warehouse_time` decimal(5,2) NOT NULL DEFAULT '0.00',
  `order_type` tinyint(4) NOT NULL DEFAULT '0',
  `branch_id` bigint(20) DEFAULT NULL,
  `completion_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `confirm_time` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8950 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_order_detail`
--

DROP TABLE IF EXISTS `trn_store_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_order_detail` (
  `store_order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_payment_status`
--

DROP TABLE IF EXISTS `trn_store_payment_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_payment_status` (
  `store_id` bigint(20) NOT NULL,
  `store_delivery_id` bigint(20) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `remain_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_start` date DEFAULT NULL,
  `payment_end` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_rank`
--

DROP TABLE IF EXISTS `trn_store_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_rank` (
  `store_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `store_rank` int(11) NOT NULL,
  `order_total` decimal(19,2) NOT NULL,
  `order_total_with_discount` decimal(19,2) NOT NULL,
  `delivery_total` decimal(19,2) NOT NULL,
  `delivery_total_with_discount` decimal(19,2) NOT NULL,
  `payment` decimal(19,2) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_signatures`
--

DROP TABLE IF EXISTS `trn_store_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_signatures` (
  `store_signature_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_signature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_working`
--

DROP TABLE IF EXISTS `trn_store_working`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_working` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_store_working_images`
--

DROP TABLE IF EXISTS `trn_store_working_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_store_working_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_id` bigint(20) NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_supplier_delivery`
--

DROP TABLE IF EXISTS `trn_supplier_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_supplier_delivery` (
  `supplier_delivery_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_order_id` bigint(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pi_no` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `contract_no` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_1_date` date DEFAULT NULL,
  `finish_cont_date` date DEFAULT NULL,
  `deliver_cont_date` date DEFAULT NULL,
  `arrive_port_date` date DEFAULT NULL,
  `comming_pkh_date` date DEFAULT NULL,
  `payment_2_date` date DEFAULT NULL,
  `finish_cont_expected_date` date DEFAULT NULL,
  `deliver_cont_expected_date` date DEFAULT NULL,
  `arrive_port_expected_date` date DEFAULT NULL,
  `comming_pkh_expected_date` date DEFAULT NULL,
  `payment_2_expected_date` date DEFAULT NULL,
  `payment_1_percent` int(11) NOT NULL DEFAULT '40',
  `payment_2_duration` int(11) NOT NULL DEFAULT '45',
  `insurance_cost` decimal(8,2) NOT NULL,
  `delivery_sts` int(11) NOT NULL DEFAULT '0',
  `volume` decimal(19,2) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `rate` double NOT NULL DEFAULT '1',
  `total_duty_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `duty_tax` decimal(8,2) NOT NULL,
  `vat_tax` decimal(8,2) NOT NULL,
  `frieght_cost` decimal(8,2) NOT NULL,
  `landed_cost` decimal(8,2) NOT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_supplier_delivery_detail`
--

DROP TABLE IF EXISTS `trn_supplier_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_supplier_delivery_detail` (
  `supplier_delivery_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `price_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `duty_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_delivery_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_supplier_order`
--

DROP TABLE IF EXISTS `trn_supplier_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_supplier_order` (
  `supplier_order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `send_po_date` date DEFAULT NULL,
  `total` decimal(19,2) NOT NULL,
  `total_vi` decimal(19,2) NOT NULL,
  `volume` decimal(19,2) NOT NULL,
  `rate` double NOT NULL DEFAULT '1',
  `order_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `pi_no` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_supplier_order_detail`
--

DROP TABLE IF EXISTS `trn_supplier_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_supplier_order_detail` (
  `supplier_order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `price_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `rate` double NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_task_user`
--

DROP TABLE IF EXISTS `trn_task_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_task_user` (
  `task_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `task_content` text COLLATE utf8_unicode_ci,
  `task_sts` int(11) NOT NULL DEFAULT '0',
  `task_score` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `submit_notes` text COLLATE utf8_unicode_ci,
  `response_notes` text COLLATE utf8_unicode_ci,
  `task_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2834 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_user_last_pos`
--

DROP TABLE IF EXISTS `trn_user_last_pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_user_last_pos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_user_pos_his`
--

DROP TABLE IF EXISTS `trn_user_pos_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_user_pos_his` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_user_pos_his_user_id_track_time_unique` (`user_id`,`track_time`)
) ENGINE=InnoDB AUTO_INCREMENT=362398 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_warehouse_change`
--

DROP TABLE IF EXISTS `trn_warehouse_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_warehouse_change` (
  `warehouse_change_type` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `changed_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `supplier_delivery_id` bigint(20) DEFAULT NULL,
  `import_wh_factory_id` bigint(20) DEFAULT NULL,
  `store_delivery_id` bigint(20) DEFAULT NULL,
  `warehouse_exim_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_warehouse_exim`
--

DROP TABLE IF EXISTS `trn_warehouse_exim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_warehouse_exim` (
  `warehouse_exim_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_warehouse_id` bigint(20) NOT NULL,
  `to_warehouse_id` bigint(20) NOT NULL,
  `warehouse_exim_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL,
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `exim_sts` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_exim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_warehouse_exim_detail`
--

DROP TABLE IF EXISTS `trn_warehouse_exim_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_warehouse_exim_detail` (
  `warehouse_exim_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_exim_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_web_order`
--

DROP TABLE IF EXISTS `trn_web_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_web_order` (
  `web_order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_web_id` bigint(20) NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `order_sts` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `salesman_id` int(11) DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`web_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_web_order_detail`
--

DROP TABLE IF EXISTS `trn_web_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_web_order_detail` (
  `web_order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seq_no` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`web_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_wh_product_time`
--

DROP TABLE IF EXISTS `trn_wh_product_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_wh_product_time` (
  `in_date` date NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  `supplier_delivery_id` bigint(20) DEFAULT NULL,
  `soldout_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  KEY `trn_wh_product_time_in_date_product_id_index` (`in_date`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_working_hours`
--

DROP TABLE IF EXISTS `trn_working_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_working_hours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `working_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `first_time` time NOT NULL,
  `last_time` time NOT NULL,
  `working_hours` int(11) NOT NULL DEFAULT '0',
  `absent_type` int(11) NOT NULL DEFAULT '0',
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0',
  `holiday_hours` int(11) NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230641 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_working_img`
--

DROP TABLE IF EXISTS `trn_working_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_working_img` (
  `working_id` bigint(20) NOT NULL,
  `img_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trn_zalo_payment_notify`
--

DROP TABLE IF EXISTS `trn_zalo_payment_notify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_zalo_payment_notify` (
  `notify_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `payment_id` bigint(20) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `zalo_sts` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `zalo_notes` text COLLATE utf8_unicode_ci,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=708 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email_verification_code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `count_login_fail` int(11) NOT NULL DEFAULT '0',
  `store_id` bigint(20) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `relation_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_web`
--

DROP TABLE IF EXISTS `users_web`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_web` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `area1` int(11) DEFAULT NULL,
  `area2` int(11) DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `version_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `v_warehouse`
--

DROP TABLE IF EXISTS `v_warehouse`;
/*!50001 DROP VIEW IF EXISTS `v_warehouse`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_warehouse` AS SELECT 
 1 AS `product_id`,
 1 AS `product_code`,
 1 AS `product_cat_id`,
 1 AS `stock_code`,
 1 AS `name`,
 1 AS `name_origin`,
 1 AS `color`,
 1 AS `standard_packing`,
 1 AS `selling_price`,
 1 AS `product_cat_code`,
 1 AS `product_cat_name`,
 1 AS `supplier_code`,
 1 AS `supplier_name`,
 1 AS `amount`,
 1 AS `volume`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_warehouse`
--

/*!50001 DROP VIEW IF EXISTS `v_warehouse`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 */
/*!50001 VIEW `v_warehouse` AS (select `a`.`product_id` AS `product_id`,`a`.`product_code` AS `product_code`,`a`.`product_cat_id` AS `product_cat_id`,`a`.`stock_code` AS `stock_code`,`a`.`name` AS `name`,`a`.`name_origin` AS `name_origin`,`a`.`color` AS `color`,`a`.`standard_packing` AS `standard_packing`,`a`.`selling_price` AS `selling_price`,`b`.`product_cat_code` AS `product_cat_code`,`b`.`name` AS `product_cat_name`,`c`.`supplier_code` AS `supplier_code`,`c`.`name` AS `supplier_name`,(((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) AS `amount`,(((`e`.`length` * `e`.`width`) * `e`.`height`) / 1000000000) AS `volume` from ((((`pkh_db_prod`.`mst_product` `a` left join `pkh_db_prod`.`mst_product_cat` `b` on((`a`.`product_cat_id` = `b`.`product_cat_id`))) left join `pkh_db_prod`.`mst_supplier` `c` on((`a`.`supplier_id` = `c`.`supplier_id`))) join (select `a`.`product_id` AS `product_id`,sum((case when (`a`.`warehouse_change_type` in (1,5,6)) then `a`.`amount` else 0 end)) AS `in_num`,sum((case when (`a`.`warehouse_change_type` = 2) then `a`.`amount` else 0 end)) AS `out_num`,sum((case when (`a`.`warehouse_change_type` = 3) then `a`.`amount` else 0 end)) AS `in_num_edit`,sum((case when (`a`.`warehouse_change_type` = 4) then `a`.`amount` else 0 end)) AS `out_num_edit`,sum((case when (`a`.`warehouse_change_type` = 7) then `a`.`amount` else 0 end)) AS `in_num_warehouse`,sum((case when (`a`.`warehouse_change_type` = 8) then `a`.`amount` else 0 end)) AS `out_num_warehouse` from `pkh_db_prod`.`trn_warehouse_change` `a` where (`a`.`active_flg` = '1') group by `a`.`product_id`) `d` on((`a`.`product_id` = `d`.`product_id`))) left join `pkh_db_prod`.`mst_packaging` `e` on((`e`.`packaging_id` = `a`.`packaging_id`))) where ((`a`.`active_flg` = '1') and ((((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) <> 0)) order by (((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) desc) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-16 16:42:00
