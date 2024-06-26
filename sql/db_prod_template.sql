-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: db_prod_phuochoang
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `download_management` (
  `download_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `screen` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `descript` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download_management`
--

LOCK TABLES `download_management` WRITE;
/*!40000 ALTER TABLE `download_management` DISABLE KEYS */;
/*!40000 ALTER TABLE `download_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2016_01_01_000000_create_users_table',1),('2016_01_01_000001_create_roles_table',2),('2016_01_01_000002_create_role_user_table',3),('2016_01_01_000003_create_permissions_table',4),('2016_01_01_000004_create_permission_user_table',5),('2016_01_01_000005_create_permission_role_table',6),('2016_01_01_000006_create_password_resets_table',7),('2016_11_01_000000_create_mst_area',8),('2016_11_01_000000_create_mst_cd',9),('2016_11_01_000000_create_mst_dealer',10),('2016_11_01_000000_create_mst_packaging',11),('2016_11_01_000000_create_mst_product',12),('2016_11_01_000000_create_mst_product_cat',13),('2016_11_01_000000_create_mst_store',14),('2016_11_01_000000_create_mst_supplier',15),('2016_11_01_000000_create_mst_warehouse',16),('2016_11_01_000000_create_mst_warehouse_block',17),('2016_11_01_000000_create_mst_warehouse_block_lot',18),('2016_11_01_000000_create_mst_warehouse_lot',19),('2016_11_01_000000_create_mst_warehouse_product',20),('2016_11_01_000000_create_trn_audit_log',21),('2016_11_01_000000_create_trn_store',22),('2016_11_01_000000_create_trn_store_delivery',23),('2016_11_01_000000_create_trn_store_delivery_detail',24),('2016_11_01_000000_create_trn_store_order',25),('2016_11_01_000000_create_trn_store_order_detail',26),('2016_11_01_000000_create_trn_supplier_delivery',27),('2016_11_01_000000_create_trn_supplier_delivery_detail',28),('2016_11_01_000000_create_trn_supplier_order',29),('2016_11_01_000000_create_trn_supplier_order_detail',30),('2016_11_01_000000_create_trn_warehouse_change',31),('2016_12_10_173200_create_trn_payment',32),('2016_12_10_173221_create_trn_salesman_store',33),('2016_12_11_083840_create_trn_display_price_table',34),('2016_12_24_174315_create_mst_func_conf',35),('2017_01_29_211407_create_trn_absent',36),('2017_01_29_212738_create_trn_absent_setting',37),('2017_01_30_144135_create_trn_etest',38),('2017_01_30_144145_create_trn_etest_sentence',39),('2017_01_30_144153_create_trn_etest_assign',40),('2017_01_30_144211_create_trn_etest_result',41),('2017_02_26_154006_create_mst_delivery_vendor',42),('2017_02_26_174019_create_trn_delivery',43),('2017_02_26_174026_create_trn_delivery_detail',44),('2017_02_27_000505_create_trn_check_warehouse',45),('2017_02_27_000514_create_trn_check_warehouse_detail',46),('2017_03_03_222610_create_mst_news',47),('2017_03_25_135101_create_mst_gift',48),('2017_03_25_135212_create_trn_gift_use',49),('2017_04_09_222057_create_trn_store_rank',50),('2017_04_21_153718_trn_product_price_his',51),('2017_04_22_171828_mst_area_group',52),('2017_06_04_154159_create_trn_wh_product_time',53),('2017_06_17_020841_create_mst_bank_account',54),('2017_06_21_004358_create_trn_store_working',55),('2017_06_22_215703_create_trn_working_img',56),('2017_07_02_222753_create_mst_product_series',57),('2017_08_12_145026_create_trn_import_wh_factory',58),('2017_08_12_145037_create_trn_import_wh_store',59),('2017_08_12_150339_create_trn_import_wh_store_detail',60),('2017_08_12_163346_create_trn_store_delivery_payment',61),('2017_08_19_224944_create_trn_order_edit_request',62),('2017_10_08_014305_create_mst_promotion',63),('2017_11_08_045100_create_trn_cost',64),('2017_11_08_045112_create_mst_cost_cat',65),('2017_11_16_035704_create_mst_department',66),('2017_12_03_233233_create_trn_store_payment_status',67),('2018_01_15_164043_create_users_web',68),('2018_01_15_164420_create_trn_web_order',69),('2018_01_15_164428_create_trn_web_order_detail',70),('2018_08_25_101749_create_mst_branch',71),('2018_09_22_145825_create_mst_chanh',72),('2018_09_23_141204_create_trn_branch_export',73),('2018_09_23_144759_create_trn_branch_import',74),('2018_09_23_144809_create_trn_branch_import_detail',75),('2018_09_23_144840_create_trn_branch_export_detail',76),('2018_09_24_214449_create_download_management',77),('2018_10_07_165024_create_trn_store_check_in',78),('2018_10_07_165059_create_trn_store_check_in_images',79),('2018_10_07_165156_create_trn_user_last_pos',80),('2018_10_07_165208_create_trn_user_pos_his',81),('2018_10_07_165504_create_trn_store_working_images',82),('2018_10_28_141201_create_trn_working_hours',83),('2018_12_08_081216_create_mst_product_market',84),('2018_12_08_161821_create_trn_product_market_his',85),('2018_12_31_171222_create_trn_store_signatures',86),('2018_12_31_212313_create_trn_store_delivery_sign',87),('2019_04_08_044403_create_trn_task_user',88),('2019_04_08_045525_create_mst_task_group',89),('2019_07_10_130048_create_trn_warehouse_exim',90),('2019_07_10_130059_create_trn_warehouse_exim_detail',91),('2019_10_19_085540_create_mst_product_handle',92),('2019_12_05_101255_create_trn_cs_notes',93),('2020_04_05_160810_create_trn_guarantee',94),('2020_06_27_144943_trn_client_info',95),('2020_06_27_150235_mst_employee_info',96),('2020_08_26_233303_trn_employee_contract',97),('2020_08_29_161237_trn_attendance',98),('2020_09_21_233310_create_trn_batch_log',99),('2020_10_01_231559_create_trn_leave_allocation',100),('2020_10_01_232007_create_mst_holiday',101),('2020_10_14_233216_create_view_warehouse',102),('2020_10_18_091440_create_trn_internal_news',103),('2020_10_18_091831_create_trn_internal_news_viewed',104),('2020_06_27_152439_trn_leave_alloc',105),('2020_10_20_221705_create_trn_salary',106),('2020_10_20_222141_create_trn_salary_detail',107),('2020_12_22_185954_create_trn_store_kpi',108),('2020_12_22_190039_create_trn_store_kpi_detail',109),('2021_03_20_083710_create_trn_payment_advance',110),('2021_03_27_153501_add_store_zalo_id',111),('2021_08_05_160617_add_review_sts_to_store',112),('2021_08_05_164725_create_trn_comment',113),('2021_09_23_174635_add_store_review_expired',114),('2021_11_21_215025_update_trn_cost',115),('2021_11_29_132011_mst_oa_follower',116),('2021_11_30_122726_trn_oa_follower_message',117),('2021_12_06_033117_trn_esms_record',118),('2022_03_21_111149_update_trn_payment_advance',119);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_area`
--

DROP TABLE IF EXISTS `mst_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_area` (
  `area_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `parent_area_id` int DEFAULT NULL,
  `area_group_id` int DEFAULT NULL,
  `salesman_id` int DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_area`
--

LOCK TABLES `mst_area` WRITE;
/*!40000 ALTER TABLE `mst_area` DISABLE KEYS */;
INSERT INTO `mst_area` VALUES (1,'TP HCM',NULL,1,NULL,1,'2017-04-28 04:13:54',1,'2016-11-01 04:00:00',1,1),(2,'Hà Nội',NULL,8,33,1,'2017-04-28 04:20:40',1,'2021-01-12 08:31:19',5,3),(3,'Đà Nẵng',NULL,6,32,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:33',5,7),(4,'Hải Phòng',NULL,7,30,1,'2017-04-28 04:19:41',1,'2021-01-12 08:31:53',5,3),(5,'Cần Thơ',NULL,4,32,1,'2017-04-28 04:16:49',1,'2021-01-12 08:32:52',5,8),(6,'An Giang',NULL,4,30,1,'2017-04-28 04:16:49',1,'2021-01-12 08:32:54',5,8),(7,'Bà Rịa - Vũng Tàu',NULL,3,33,1,'2017-04-28 04:15:02',1,'2021-01-12 08:32:41',5,9),(8,'Bắc Giang',NULL,7,32,1,'2017-04-28 04:19:41',1,'2021-01-12 08:31:55',5,3),(9,'Bắc Kạn',NULL,7,30,1,'2017-04-28 04:19:41',1,'2021-01-12 08:31:57',5,3),(10,'Bạc Liêu',NULL,4,33,1,'2017-04-28 04:16:49',1,'2021-01-12 08:32:57',5,8),(11,'Bắc Ninh',NULL,7,32,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:01',5,3),(12,'Bến Tre',NULL,4,30,1,'2017-04-28 04:16:49',1,'2021-01-12 08:32:58',5,8),(13,'Bình Định',NULL,6,32,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:34',5,8),(14,'Bình Dương',NULL,3,41,1,'2017-04-28 04:15:02',1,'2021-01-12 08:32:42',5,7),(15,'Bình Phước',NULL,3,30,1,'2017-04-28 04:15:02',1,'2021-01-12 08:32:44',5,7),(16,'Bình Thuận',NULL,6,32,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:35',5,5),(17,'Cà Mau',NULL,4,41,1,'2017-04-28 04:16:49',1,'2021-01-12 08:32:59',5,7),(18,'Cao Bằng',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:03',5,3),(19,'Đắk Lắk',NULL,2,30,1,'2017-04-28 04:15:34',1,'2021-01-12 08:33:45',5,11),(20,'Đắk Nông',NULL,2,32,1,'2017-04-28 04:15:34',1,'2021-01-12 08:33:47',5,9),(21,'Điện Biên',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:05',5,3),(22,'Đồng Nai',NULL,3,32,1,'2017-04-28 04:15:02',1,'2021-01-12 08:32:48',5,8),(23,'Đồng Tháp',NULL,4,33,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:00',5,9),(24,'Gia Lai',NULL,2,41,1,'2017-04-28 04:15:34',1,'2021-01-12 08:33:48',5,9),(25,'Hà Giang',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:07',5,3),(26,'Hà Nam',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:09',5,3),(27,'Hà Tĩnh',NULL,5,32,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:02',5,4),(28,'Hải Dương',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:11',5,3),(29,'Hậu Giang',NULL,4,41,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:01',5,9),(30,'Hòa Bình',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:14',5,3),(31,'Hưng Yên',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:16',5,3),(32,'Khánh Hòa',NULL,6,33,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:38',5,5),(33,'Kiên Giang',NULL,4,32,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:02',5,5),(34,'Kon Tum',NULL,2,33,1,'2017-04-28 04:15:34',1,'2021-01-12 08:33:49',5,8),(35,'Lai Châu',NULL,7,30,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:18',5,3),(36,'Lâm Đồng',NULL,2,41,1,'2017-04-28 04:15:34',1,'2021-01-12 08:33:50',5,5),(37,'Lạng Sơn',NULL,7,30,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:19',5,3),(38,'Lào Cai',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:20',5,3),(39,'Long An',NULL,4,33,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:06',5,8),(40,'Nam Định',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:21',5,3),(41,'Nghệ An',NULL,5,32,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:05',5,3),(42,'Ninh Bình',NULL,7,32,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:24',5,3),(43,'Ninh Thuận',NULL,6,41,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:39',5,5),(44,'Phú Thọ',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:26',5,3),(45,'Phú Yên',NULL,6,41,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:41',5,7),(46,'Quảng Bình',NULL,5,32,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:08',5,3),(47,'Quảng Nam',NULL,6,41,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:42',5,7),(48,'Quảng Ngãi',NULL,6,30,1,'2017-04-28 04:18:50',1,'2021-01-12 08:33:43',5,7),(49,'Quảng Ninh',NULL,7,30,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:28',5,3),(50,'Quảng Trị',NULL,5,33,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:12',5,4),(51,'Sóc Trăng',NULL,4,30,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:07',5,9),(52,'Sơn La',NULL,7,32,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:30',5,3),(53,'Tây Ninh',NULL,3,30,1,'2017-04-28 04:15:02',1,'2021-01-12 08:32:49',5,7),(54,'Thái Bình',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:31',5,3),(55,'Thái Nguyên',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:34',5,3),(56,'Thanh Hóa',NULL,5,41,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:14',5,3),(57,'Thừa Thiên Huế',NULL,5,33,1,'2017-04-28 04:17:24',1,'2021-01-12 08:31:16',5,4),(58,'Tiền Giang',NULL,4,33,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:08',5,8),(59,'Trà Vinh',NULL,4,41,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:09',5,7),(60,'Tuyên Quang',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:36',5,3),(61,'Vĩnh Long',NULL,4,41,1,'2017-04-28 04:16:49',1,'2021-01-12 08:33:12',5,7),(62,'Vĩnh Phúc',NULL,7,33,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:37',5,3),(63,'Yên Bái',NULL,7,41,1,'2017-04-28 04:19:41',1,'2021-01-12 08:32:39',5,3),(64,'Quận 1',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:51',5,7),(65,'Quận 2',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:53',5,8),(66,'Quận 3',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:54',5,4),(67,'Quận 4',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:56',5,8),(68,'Quận 5',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:57',5,6),(69,'Quận 6',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:58',5,6),(70,'Quận 7',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:33:59',5,8),(71,'Quận 8',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:01',5,8),(72,'Quận 9',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:02',5,7),(73,'Quận 10',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:04',5,6),(74,'Quận 11',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:05',5,5),(75,'Quận 12',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:06',5,7),(76,'Thủ Đức',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:07',5,5),(77,'Tân Phú',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:08',5,5),(78,'Tân Bình',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:10',5,5),(79,'Phú Nhuận',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:12',5,7),(80,'Gò Vấp',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:14',5,6),(81,'Bình Thạnh',1,1,41,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:15',5,7),(82,'Bình Tân',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:16',5,5),(83,'Bình Chánh',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:18',5,6),(84,'Cần Giờ',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:19',5,9),(85,'Củ Chi',1,1,30,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:20',5,7),(86,'Hóc Môn',1,1,32,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:23',5,6),(87,'Nhà Bè',1,1,33,1,'2017-04-28 04:13:54',1,'2021-01-12 08:34:24',5,9),(88,'Quận Ba Đình',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:22',5,3),(89,'Quận Hoàn Kiếm',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:25',5,3),(90,'Quận Tây Hồ',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:28',5,3),(91,'Quận Long Biên',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:31',5,3),(92,'Quận Cầu Giấy',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:34',5,3),(93,'Quận Đống Đa',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:36',5,3),(94,'Quận Hai Bà Trưng',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:38',5,3),(95,'Quận Hoàng Mai',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:41',5,3),(96,'Quận Thanh Xuân',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:43',5,3),(97,'Quận Hà Đông',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:45',5,3),(98,'Quận Bắc Từ Liêm',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:47',5,3),(99,'Quận Nam Từ Liêm',2,8,33,1,'2017-04-28 04:20:28',1,'2021-01-12 08:31:50',5,3),(100,'Quận Ninh Kiều',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:14',5,7),(101,'Huyện Châu Thành',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:16',5,7),(102,'Huyện Long Mỹ',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:17',5,7),(103,'Quận Cái Răng',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:19',5,7),(104,'Huyện Cờ Đỏ',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:22',5,7),(105,'Huyện Phong Điền',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:23',5,7),(106,'Huyện Thới Lai',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:24',5,7),(107,'Huyện Vĩnh Thạnh',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:25',5,7),(108,'Quận Bình Thủy',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:27',5,7),(109,'Quận Ô Môn',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:29',5,7),(110,'Quận Thốt Nốt',5,4,32,1,'2017-08-06 07:00:00',1,'2021-01-12 08:33:31',5,7),(111,'Huyện Đông Anh`',NULL,8,32,1,'2022-04-21 22:54:11',55,'2022-04-21 23:03:16',55,3);
/*!40000 ALTER TABLE `mst_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_area_group`
--

DROP TABLE IF EXISTS `mst_area_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_area_group` (
  `area_group_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `payment_day` int NOT NULL DEFAULT '3',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_area_group`
--

LOCK TABLES `mst_area_group` WRITE;
/*!40000 ALTER TABLE `mst_area_group` DISABLE KEYS */;
INSERT INTO `mst_area_group` VALUES (1,'TP.HCM',3,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(2,'Tây Nguyên',5,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(3,'Miền Đông',5,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(4,'Miền Tây',4,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(5,'Bắc Trung Bộ',5,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(6,'Nam Trung Bộ',5,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(7,'Miền Bắc',7,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0),(8,'Hà Nội',7,1,'2017-04-28 04:09:21',0,'2017-04-28 04:09:21',0,0);
/*!40000 ALTER TABLE `mst_area_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_bank_account`
--

DROP TABLE IF EXISTS `mst_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_bank_account` (
  `bank_account_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint NOT NULL,
  `bank_name` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `bank_account_no` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_bank_account`
--

LOCK TABLES `mst_bank_account` WRITE;
/*!40000 ALTER TABLE `mst_bank_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_branch`
--

DROP TABLE IF EXISTS `mst_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_branch` (
  `branch_id` int unsigned NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `branch_address` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_contact` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_branch`
--

LOCK TABLES `mst_branch` WRITE;
/*!40000 ALTER TABLE `mst_branch` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_cd`
--

DROP TABLE IF EXISTS `mst_cd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_cd` (
  `group_id` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `code_cd` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `code_name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `code_value` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`code_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_cd`
--

LOCK TABLES `mst_cd` WRITE;
/*!40000 ALTER TABLE `mst_cd` DISABLE KEYS */;
INSERT INTO `mst_cd` VALUES ('delivery_sts','0','Mới',NULL,1,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('delivery_sts','1','Đã giao',NULL,2,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('delivery_sts','4','Hoàn tất',NULL,3,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('delivery_sts','5','Hủy',NULL,4,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('order_sts','0','Mới',NULL,1,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('order_sts','1','Đang soạn',NULL,2,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('order_sts','2','Đã giao',NULL,3,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('order_sts','4','Hoàn tất',NULL,4,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('order_sts','5','Hủy',NULL,5,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('store_sts','1','Lead',NULL,1,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('store_sts','2','Contact',NULL,2,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('store_sts','3','Pending',NULL,3,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('store_sts','4','Closed',NULL,4,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0),('store_sts','5','Black list',NULL,5,1,'2017-04-02 20:39:32',0,'2017-04-02 20:39:32',0,0);
/*!40000 ALTER TABLE `mst_cd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_chanh`
--

DROP TABLE IF EXISTS `mst_chanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_chanh` (
  `chanh_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `area1` int DEFAULT NULL,
  `area2` int DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `chanh_sts` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`chanh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_chanh`
--

LOCK TABLES `mst_chanh` WRITE;
/*!40000 ALTER TABLE `mst_chanh` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_chanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_cost_cat`
--

DROP TABLE IF EXISTS `mst_cost_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_cost_cat` (
  `cost_cat_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`cost_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_cost_cat`
--

LOCK TABLES `mst_cost_cat` WRITE;
/*!40000 ALTER TABLE `mst_cost_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_cost_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_dealer`
--

DROP TABLE IF EXISTS `mst_dealer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_dealer` (
  `dealer_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `area1` int NOT NULL,
  `area2` int NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_dealer`
--

LOCK TABLES `mst_dealer` WRITE;
/*!40000 ALTER TABLE `mst_dealer` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_dealer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_delivery_vendor`
--

DROP TABLE IF EXISTS `mst_delivery_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_delivery_vendor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `delivery_vendor_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_delivery_vendor`
--

LOCK TABLES `mst_delivery_vendor` WRITE;
/*!40000 ALTER TABLE `mst_delivery_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_delivery_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_department`
--

DROP TABLE IF EXISTS `mst_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_department` (
  `department_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_department`
--

LOCK TABLES `mst_department` WRITE;
/*!40000 ALTER TABLE `mst_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_employee_info`
--

DROP TABLE IF EXISTS `mst_employee_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_employee_info` (
  `employee_id` int NOT NULL,
  `employee_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `devision` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `address_permernance` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_contact` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id_issue_on` date DEFAULT NULL,
  `card_id_issue_at` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_number` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_number` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_phone` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel1` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel2` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_sts` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `probation_start_date` date DEFAULT NULL,
  `probation_end_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `count_dependent_person` int DEFAULT '0',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `passcode` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_employee_info`
--

LOCK TABLES `mst_employee_info` WRITE;
/*!40000 ALTER TABLE `mst_employee_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_employee_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_func_conf`
--

DROP TABLE IF EXISTS `mst_func_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_func_conf` (
  `func_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `chr_val` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_val` date DEFAULT NULL,
  `dtm_val` datetime DEFAULT NULL,
  `tim_val` time DEFAULT NULL,
  `int_val` int DEFAULT NULL,
  `txt_val` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_func_conf`
--

LOCK TABLES `mst_func_conf` WRITE;
/*!40000 ALTER TABLE `mst_func_conf` DISABLE KEYS */;
INSERT INTO `mst_func_conf` VALUES ('CMS_HOME_MARQUEE',NULL,NULL,NULL,NULL,NULL,'Nhằm tri ân đến Quý khách hàng trong năm 2021, Công ty TNHH Phan Khang Home trân trọng thông báo đến quý khách chương trình\" TRI ÂN khách hàng ngày 10.10\" với nhiều ưu đãi \" khủng\"',1,'2017-05-31 15:58:32',0,'2021-10-09 07:54:49',0,0),('CMS_HOME_MARQUEE_2',NULL,NULL,NULL,NULL,NULL,'PHAN KHANG HOME\nNHÀ PHÂN PHỐI ĐỘC QUYỀN WATERTEC TẠI VIỆT NAM\nWatertec là công ty Malaysia đầu tiên dẫn đầu trong các phát minh và sản xuất van, vòi & phụ kiện nhựa ở Châu Á',1,'2017-05-31 15:58:32',0,'2021-10-09 07:54:49',0,0),('CMS_HOME_MARQUEE_3',NULL,'2017-05-22',NULL,NULL,NULL,NULL,1,'2017-08-07 03:46:20',0,'2017-08-07 03:46:20',0,0),('print_delivery_page_1','1',NULL,NULL,NULL,NULL,NULL,1,'2019-02-18 14:57:26',0,'2019-12-24 10:27:24',0,1),('print_delivery_page_2','1',NULL,NULL,NULL,NULL,NULL,1,'2019-02-18 14:57:26',0,'2019-12-24 10:27:24',0,1),('print_delivery_page_3','1',NULL,NULL,NULL,NULL,NULL,1,'2019-02-18 14:57:26',0,'2019-12-24 10:27:24',0,1),('print_delivery_page_4','1',NULL,NULL,NULL,NULL,NULL,1,'2019-02-18 14:57:26',0,'2019-12-24 10:27:24',0,1),('print_delivery_page_5','0',NULL,NULL,NULL,NULL,NULL,1,'2019-02-18 14:57:26',0,'2019-12-24 10:27:24',0,1),('print_delivery_page_size','A4',NULL,NULL,NULL,NULL,NULL,1,'2019-04-12 05:55:41',0,'2019-12-24 10:27:24',0,1),('CMS_HOME_TOP_PRODUCT',NULL,NULL,NULL,NULL,NULL,'18,26,27,31,32,43,44,56,22',1,'2020-09-13 18:15:44',0,'2020-10-15 15:55:29',0,1),('CMS_HOME_NEW_PRODUCT',NULL,NULL,NULL,NULL,NULL,'146,147,148,149,150,152,153,155,151',1,'2020-10-15 15:51:11',0,'2020-10-15 15:53:15',0,1),('delivery_allow_empty','0',NULL,NULL,NULL,NULL,NULL,1,'2020-10-17 20:58:12',0,'2022-06-24 08:41:40',0,1),('esms_api_key',NULL,NULL,NULL,NULL,NULL,'E264C43C8157026D7F98385F549598',1,'2022-01-04 07:16:14',0,'2022-01-04 07:16:17',0,1),('esms_secret_key',NULL,NULL,NULL,NULL,NULL,'42E9C9F0F7A11242D88D524FFF7986',1,'2022-01-04 07:16:14',0,'2022-01-04 07:16:17',0,1),('oa_id',NULL,NULL,NULL,NULL,NULL,'1307991396108552028',1,'2022-01-04 07:16:14',0,'2022-01-04 07:16:17',0,1);
/*!40000 ALTER TABLE `mst_func_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_gift`
--

DROP TABLE IF EXISTS `mst_gift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_gift` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_gift`
--

LOCK TABLES `mst_gift` WRITE;
/*!40000 ALTER TABLE `mst_gift` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_gift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_holiday`
--

DROP TABLE IF EXISTS `mst_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_holiday` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `reason` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(5,2) NOT NULL DEFAULT '1.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mst_holiday_holiday_date_index` (`holiday_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_holiday`
--

LOCK TABLES `mst_holiday` WRITE;
/*!40000 ALTER TABLE `mst_holiday` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_holiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_news`
--

DROP TABLE IF EXISTS `mst_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `publish_date` date DEFAULT NULL,
  `slug` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `image_path` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `feature_image_path` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_flg` tinyint(1) NOT NULL DEFAULT '1',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_news`
--

LOCK TABLES `mst_news` WRITE;
/*!40000 ALTER TABLE `mst_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_oa_follower`
--

DROP TABLE IF EXISTS `mst_oa_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_oa_follower` (
  `oa_follower_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `user_id_by_app` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`oa_follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_oa_follower`
--

LOCK TABLES `mst_oa_follower` WRITE;
/*!40000 ALTER TABLE `mst_oa_follower` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_oa_follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_packaging`
--

DROP TABLE IF EXISTS `mst_packaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_packaging` (
  `packaging_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `length` int NOT NULL DEFAULT '0',
  `width` int NOT NULL DEFAULT '0',
  `height` int NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`packaging_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_packaging`
--

LOCK TABLES `mst_packaging` WRITE;
/*!40000 ALTER TABLE `mst_packaging` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_packaging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product`
--

DROP TABLE IF EXISTS `mst_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_product` (
  `product_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type` int NOT NULL DEFAULT '0',
  `supplier_id` int NOT NULL,
  `product_cat_id` int NOT NULL,
  `product_code` varchar(17) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `stock_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `name_origin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `color` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `packing` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `moq` int DEFAULT NULL,
  `handle_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `packing_id` int DEFAULT NULL,
  `packaging_id` int DEFAULT NULL,
  `standard_packing` int DEFAULT NULL,
  `warning_qty` int NOT NULL DEFAULT '0',
  `purchase_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `accountant_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_sample` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `product_code_old` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_order_flg` tinyint(1) NOT NULL DEFAULT '0',
  `warranty_year` int NOT NULL DEFAULT '0',
  `chr_feature` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `priority_degree` int NOT NULL DEFAULT '0',
  `selling_price_retail` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_standard` decimal(19,2) NOT NULL DEFAULT '0.00',
  `import_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `shopee_url` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `mst_product_product_code_unique` (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product`
--

LOCK TABLES `mst_product` WRITE;
/*!40000 ALTER TABLE `mst_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product_cat`
--

DROP TABLE IF EXISTS `mst_product_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_product_cat` (
  `product_cat_id` int unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `product_cat_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `name_origin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text,
  `allow_order_flg` tinyint(1) NOT NULL DEFAULT '1',
  `priority` int NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_cat_id`),
  UNIQUE KEY `mst_product_cat_product_cat_code_unique` (`product_cat_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product_cat`
--

LOCK TABLES `mst_product_cat` WRITE;
/*!40000 ALTER TABLE `mst_product_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product_handle`
--

DROP TABLE IF EXISTS `mst_product_handle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_product_handle` (
  `product_handle_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_handle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product_handle`
--

LOCK TABLES `mst_product_handle` WRITE;
/*!40000 ALTER TABLE `mst_product_handle` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product_handle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product_market`
--

DROP TABLE IF EXISTS `mst_product_market`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_product_market` (
  `product_market_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL DEFAULT '1',
  `code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_market_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product_market`
--

LOCK TABLES `mst_product_market` WRITE;
/*!40000 ALTER TABLE `mst_product_market` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product_market` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product_series`
--

DROP TABLE IF EXISTS `mst_product_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_product_series` (
  `product_id` bigint NOT NULL,
  `product_detail_id` bigint NOT NULL,
  `selling_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `selling_price_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`product_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product_series`
--

LOCK TABLES `mst_product_series` WRITE;
/*!40000 ALTER TABLE `mst_product_series` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_promotion`
--

DROP TABLE IF EXISTS `mst_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_promotion` (
  `promotion_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `promotion_name` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `promotion_type` int NOT NULL DEFAULT '0',
  `promotion_sts` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `meta_data` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_promotion`
--

LOCK TABLES `mst_promotion` WRITE;
/*!40000 ALTER TABLE `mst_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_store`
--

DROP TABLE IF EXISTS `mst_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_store` (
  `store_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `level` int DEFAULT NULL,
  `area1` int DEFAULT NULL,
  `area2` int DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `new_store_id` bigint NOT NULL,
  `dealer_id` bigint NOT NULL,
  `store_sts` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `tax_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `chanh_id` bigint DEFAULT NULL,
  `address_chanh` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `gps_lat_chanh` double NOT NULL DEFAULT '0',
  `gps_long_chanh` double NOT NULL DEFAULT '0',
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `salesman_id` int DEFAULT NULL,
  `inner_flg` tinyint(1) NOT NULL DEFAULT '0',
  `first_order` date DEFAULT NULL,
  `accountant_store_id` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `zalo_user_id` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_sts` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `review_user_id` int NOT NULL,
  `review_date` date NOT NULL,
  `review_expired_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_store`
--

LOCK TABLES `mst_store` WRITE;
/*!40000 ALTER TABLE `mst_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_supplier`
--

DROP TABLE IF EXISTS `mst_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_supplier` (
  `supplier_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `supplier_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_supplier`
--

LOCK TABLES `mst_supplier` WRITE;
/*!40000 ALTER TABLE `mst_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_task_group`
--

DROP TABLE IF EXISTS `mst_task_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_task_group` (
  `task_group_id` int unsigned NOT NULL AUTO_INCREMENT,
  `task_group_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `task_group_weight` int NOT NULL DEFAULT '0',
  `task_group_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_task_group`
--

LOCK TABLES `mst_task_group` WRITE;
/*!40000 ALTER TABLE `mst_task_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_task_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_warehouse`
--

DROP TABLE IF EXISTS `mst_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_warehouse` (
  `warehouse_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_warehouse`
--

LOCK TABLES `mst_warehouse` WRITE;
/*!40000 ALTER TABLE `mst_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_warehouse_block`
--

DROP TABLE IF EXISTS `mst_warehouse_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_warehouse_block` (
  `warehouse_block_id` int unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` int NOT NULL,
  `parent_block_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_block_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_warehouse_block`
--

LOCK TABLES `mst_warehouse_block` WRITE;
/*!40000 ALTER TABLE `mst_warehouse_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_warehouse_block_lot`
--

DROP TABLE IF EXISTS `mst_warehouse_block_lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_warehouse_block_lot` (
  `warehouse_block_id` int NOT NULL,
  `warehouse_lot_id` int NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_block_id`,`warehouse_lot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_warehouse_block_lot`
--

LOCK TABLES `mst_warehouse_block_lot` WRITE;
/*!40000 ALTER TABLE `mst_warehouse_block_lot` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse_block_lot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_warehouse_lot`
--

DROP TABLE IF EXISTS `mst_warehouse_lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_warehouse_lot` (
  `warehouse_lot_id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `length` int NOT NULL,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `max_item` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_lot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_warehouse_lot`
--

LOCK TABLES `mst_warehouse_lot` WRITE;
/*!40000 ALTER TABLE `mst_warehouse_lot` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse_lot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_warehouse_product`
--

DROP TABLE IF EXISTS `mst_warehouse_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_warehouse_product` (
  `warehouse_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_warehouse_product`
--

LOCK TABLES `mst_warehouse_product` WRITE;
/*!40000 ALTER TABLE `mst_warehouse_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23449 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(2,1,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(3,1,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(4,1,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(5,1,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(6,1,14,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(7,1,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(8,1,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(9,1,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(10,1,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(11,1,18,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(12,1,15,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(13,1,16,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(14,1,17,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(15,2,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(16,2,8,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(17,3,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(18,3,9,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(19,4,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(20,4,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(21,4,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(22,4,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(23,5,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(24,5,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(25,5,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(26,5,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(27,5,14,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(28,6,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(29,6,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(30,6,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(31,6,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(32,6,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(33,7,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(34,7,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(35,7,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(36,7,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(37,7,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(38,8,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(39,8,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(40,8,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(41,8,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(42,8,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(43,8,14,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(44,8,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(45,8,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(46,8,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(47,8,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(48,8,18,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(49,9,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(50,9,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(51,9,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(52,9,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(53,9,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(54,9,14,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(55,9,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(56,9,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(57,9,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(58,9,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(59,9,18,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(60,10,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(61,10,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(62,10,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(63,10,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(64,10,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(65,10,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(66,10,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(67,10,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(68,11,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(69,11,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(70,11,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(71,11,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(72,11,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(73,11,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(74,11,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(75,11,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(76,11,18,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(77,12,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(78,12,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(79,13,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(80,13,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(81,14,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(82,14,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(83,15,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(84,15,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(85,16,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(86,16,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(87,17,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(88,17,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(89,17,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(90,18,1,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(91,18,2,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(92,18,3,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(93,18,10,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(94,18,13,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(95,18,14,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(96,18,12,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(97,18,5,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(98,18,6,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(99,18,7,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(100,18,18,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(101,18,15,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(102,18,16,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(103,18,17,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(104,19,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(105,19,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(106,19,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(107,19,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(108,19,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(109,19,14,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(110,19,12,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(111,19,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(112,19,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(113,19,7,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(114,19,18,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(115,19,15,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(116,19,16,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(117,19,17,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(118,20,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(119,20,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(120,20,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(121,21,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(122,21,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(123,22,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(124,22,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(125,22,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(126,22,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(127,22,14,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(128,22,12,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(129,22,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(130,22,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(131,22,7,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(132,22,18,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(133,23,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(134,23,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(135,24,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(136,24,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(137,24,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(138,24,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(139,24,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(140,24,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(141,24,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(142,24,18,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(143,24,15,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(144,25,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(145,25,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(146,25,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(147,26,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(148,26,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(149,26,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(150,27,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(151,27,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(152,27,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(153,28,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(154,28,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(155,28,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(156,28,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(157,28,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(158,28,14,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(159,28,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(160,29,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(161,29,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(162,29,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(163,29,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(164,29,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(165,29,14,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(166,29,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(167,29,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(168,29,7,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(169,29,18,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(170,29,15,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(171,29,16,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(172,29,17,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(173,30,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(174,30,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(175,30,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(176,30,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(177,30,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(178,30,14,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(179,30,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(180,30,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(181,30,7,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(182,30,18,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(183,30,15,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(184,30,16,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(185,30,17,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(186,31,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(187,31,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(188,31,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(189,31,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(190,31,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(191,31,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(192,31,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(193,31,7,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(194,31,15,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(195,31,16,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(196,31,17,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(197,32,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(198,32,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(199,32,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(200,32,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(201,32,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(202,32,5,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(203,32,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(204,33,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(205,33,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(206,33,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(207,33,10,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(208,33,13,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(209,33,6,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(210,34,1,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(211,34,2,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(212,34,3,'2022-07-05 17:13:08','2022-07-05 17:13:08'),(213,34,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(214,34,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(215,34,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(216,34,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(217,35,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(218,35,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(219,35,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(220,36,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(221,36,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(222,36,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(223,37,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(224,37,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(225,37,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(226,37,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(227,37,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(228,38,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(229,38,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(230,38,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(231,38,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(232,38,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(233,39,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(234,39,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(235,39,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(236,39,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(237,39,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(238,39,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(239,40,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(240,40,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(241,40,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(242,40,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(243,40,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(244,41,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(245,41,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(246,41,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(247,41,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(248,41,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(249,41,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(250,41,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(251,42,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(252,42,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(253,42,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(254,42,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(255,42,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(256,42,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(257,42,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(258,43,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(259,43,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(260,43,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(261,43,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(262,43,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(263,43,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(264,43,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(265,44,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(266,44,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(267,44,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(268,44,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(269,44,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(270,44,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(271,44,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(272,44,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(273,45,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(274,45,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(275,45,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(276,45,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(277,45,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(278,45,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(279,46,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(280,46,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(281,46,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(282,46,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(283,46,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(284,46,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(285,47,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(286,47,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(287,47,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(288,47,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(289,47,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(290,47,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(291,47,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(292,47,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(293,47,7,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(294,47,18,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(295,47,15,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(296,47,16,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(297,47,17,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(298,48,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(299,48,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(300,48,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(301,49,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(302,49,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(303,49,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(304,49,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(305,50,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(306,50,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(307,50,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(308,50,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(309,50,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(310,51,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(311,51,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(312,51,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(313,51,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(314,51,13,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(315,51,14,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(316,51,5,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(317,51,6,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(318,51,7,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(319,51,18,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(320,51,15,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(321,51,16,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(322,51,17,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(323,52,1,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(324,52,2,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(325,52,3,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(326,52,10,'2022-07-05 17:13:09','2022-07-05 17:13:09'),(327,53,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(328,53,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(329,53,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(330,53,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(331,53,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(332,54,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(333,54,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(334,54,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(335,54,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(336,54,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(337,54,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(338,55,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(339,55,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(340,55,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(341,55,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(342,55,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(343,55,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(344,55,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(345,55,18,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(346,55,15,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(347,55,16,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(348,55,17,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(349,56,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(350,56,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(351,56,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(352,57,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(353,57,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(354,57,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(355,57,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(356,57,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(357,57,14,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(358,57,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(359,57,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(360,57,7,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(361,58,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(362,58,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(363,58,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(364,58,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(365,58,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(366,58,14,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(367,58,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(368,58,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(369,58,7,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(370,58,18,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(371,58,15,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(372,58,16,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(373,58,17,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(374,59,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(375,59,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(376,59,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(377,59,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(378,59,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(379,59,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(380,60,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(381,60,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(382,60,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(383,60,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(384,60,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(385,60,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(386,60,7,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(387,61,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(388,61,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(389,61,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(390,62,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(391,62,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(392,62,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(393,63,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(394,63,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(395,63,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(396,64,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(397,64,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(398,64,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(399,64,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(400,64,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(401,64,5,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(402,64,6,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(403,64,18,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(404,64,15,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(405,64,16,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(406,64,17,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(407,65,1,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(408,65,2,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(409,65,3,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(410,65,10,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(411,65,13,'2022-07-05 17:13:10','2022-07-05 17:13:10'),(412,65,5,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(413,65,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(414,65,18,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(415,65,15,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(416,65,16,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(417,65,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(418,66,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(419,66,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(420,66,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(421,66,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(422,66,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(423,67,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(424,67,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(425,67,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(426,67,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(427,67,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(428,67,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(429,68,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(430,68,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(431,68,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(432,68,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(433,68,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(434,68,14,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(435,68,5,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(436,68,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(437,69,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(438,69,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(439,69,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(440,69,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(441,70,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(442,70,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(443,70,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(444,70,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(445,70,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(446,70,14,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(447,70,5,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(448,70,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(449,71,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(450,71,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(451,71,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(452,71,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(453,71,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(454,71,14,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(455,71,5,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(456,71,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(457,72,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(458,72,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(459,72,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(460,72,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(461,72,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(462,72,14,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(463,72,5,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(464,72,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(465,73,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(466,73,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(467,73,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(468,73,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(469,73,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(470,73,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(471,74,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(472,74,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(473,74,3,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(474,74,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(475,74,13,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(476,74,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(477,75,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(478,75,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(479,75,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(480,75,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(481,75,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(482,75,16,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(483,75,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(484,76,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(485,76,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(486,76,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(487,76,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(488,76,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(489,76,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(490,77,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(491,77,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(492,77,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(493,77,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(494,77,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(495,77,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(496,78,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(497,78,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(498,78,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(499,78,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(500,78,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(501,78,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(502,79,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(503,79,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(504,79,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(505,79,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(506,79,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(507,80,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(508,80,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(509,80,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(510,80,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(511,80,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(512,80,17,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(513,81,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(514,81,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(515,81,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(516,81,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(517,81,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(518,82,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(519,82,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(520,82,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(521,83,1,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(522,83,2,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(523,83,10,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(524,83,6,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(525,83,7,'2022-07-05 17:13:11','2022-07-05 17:13:11'),(526,83,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(527,84,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(528,84,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(529,84,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(530,84,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(531,84,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(532,84,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(533,85,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(534,85,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(535,85,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(536,85,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(537,85,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(538,85,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(539,86,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(540,86,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(541,86,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(542,86,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(543,86,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(544,86,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(545,87,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(546,87,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(547,87,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(548,87,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(549,87,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(550,87,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(551,88,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(552,88,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(553,88,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(554,88,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(555,88,14,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(556,88,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(557,88,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(558,88,18,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(559,88,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(560,89,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(561,89,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(562,89,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(563,89,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(564,89,14,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(565,89,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(566,89,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(567,90,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(568,90,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(569,90,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(570,90,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(571,90,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(572,90,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(573,90,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(574,91,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(575,91,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(576,91,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(577,91,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(578,91,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(579,91,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(580,91,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(581,92,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(582,92,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(583,92,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(584,92,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(585,92,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(586,92,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(587,93,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(588,93,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(589,93,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(590,93,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(591,94,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(592,94,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(593,94,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(594,94,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(595,95,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(596,95,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(597,95,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(598,95,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(599,95,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(600,95,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(601,96,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(602,96,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(603,96,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(604,96,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(605,96,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(606,96,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(607,97,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(608,97,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(609,97,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(610,97,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(611,97,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(612,97,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(613,98,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(614,98,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(615,98,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(616,98,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(617,98,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(618,98,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(619,99,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(620,99,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(621,99,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(622,99,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(623,99,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(624,99,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(625,100,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(626,100,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(627,100,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(628,100,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(629,100,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(630,100,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(631,101,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(632,101,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(633,101,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(634,101,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(635,101,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(636,101,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(637,101,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(638,102,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(639,102,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(640,102,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(641,102,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(642,102,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(643,102,7,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(644,102,17,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(645,103,1,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(646,103,2,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(647,103,10,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(648,103,13,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(649,103,6,'2022-07-05 17:13:12','2022-07-05 17:13:12'),(650,103,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(651,103,17,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(652,104,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(653,104,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(654,104,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(655,104,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(656,104,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(657,105,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(658,105,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(659,105,3,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(660,105,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(661,105,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(662,105,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(663,105,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(664,105,17,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(665,106,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(666,106,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(667,106,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(668,106,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(669,106,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(670,106,17,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(671,107,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(672,107,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(673,107,3,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(674,107,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(675,107,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(676,107,5,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(677,107,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(678,107,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(679,108,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(680,108,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(681,108,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(682,108,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(683,108,8,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(684,109,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(685,109,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(686,109,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(687,109,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(688,109,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(689,109,8,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(690,110,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(691,110,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(692,110,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(693,110,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(694,110,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(695,111,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(696,111,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(697,111,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(698,111,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(699,111,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(700,112,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(701,112,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(702,112,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(703,112,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(704,112,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(705,113,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(706,113,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(707,113,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(708,113,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(709,113,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(710,114,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(711,114,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(712,114,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(713,114,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(714,114,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(715,115,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(716,115,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(717,115,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(718,115,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(719,115,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(720,116,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(721,116,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(722,116,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(723,116,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(724,116,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(725,117,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(726,117,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(727,117,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(728,118,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(729,118,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(730,118,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(731,118,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(732,119,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(733,119,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(734,119,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(735,120,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(736,120,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(737,120,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(738,120,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(739,120,14,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(740,120,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(741,120,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(742,121,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(743,121,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(744,121,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(745,121,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(746,122,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(747,122,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(748,122,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(749,122,14,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(750,122,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(751,122,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(752,123,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(753,123,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(754,123,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(755,123,14,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(756,123,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(757,123,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(758,124,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(759,124,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(760,124,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(761,124,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(762,125,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(763,125,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(764,125,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(765,125,13,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(766,125,14,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(767,125,6,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(768,125,7,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(769,125,15,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(770,126,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(771,126,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(772,126,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(773,127,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(774,127,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(775,127,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(776,128,1,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(777,128,2,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(778,128,10,'2022-07-05 17:13:13','2022-07-05 17:13:13'),(779,128,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(780,128,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(781,128,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(782,128,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(783,128,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(784,129,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(785,129,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(786,129,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(787,129,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(788,129,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(789,129,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(790,129,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(791,129,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(792,130,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(793,130,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(794,130,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(795,131,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(796,131,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(797,131,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(798,131,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(799,131,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(800,131,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(801,131,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(802,131,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(803,131,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(804,132,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(805,132,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(806,132,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(807,132,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(808,132,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(809,132,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(810,132,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(811,132,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(812,132,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(813,133,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(814,133,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(815,133,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(816,133,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(817,133,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(818,134,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(819,134,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(820,134,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(821,134,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(822,134,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(823,134,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(824,134,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(825,134,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(826,134,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(827,134,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(828,135,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(829,135,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(830,135,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(831,135,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(832,135,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(833,135,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(834,135,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(835,135,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(836,135,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(837,135,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(838,136,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(839,136,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(840,136,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(841,136,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(842,136,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(843,136,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(844,136,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(845,136,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(846,136,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(847,137,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(848,137,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(849,137,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(850,137,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(851,137,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(852,137,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(853,137,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(854,138,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(855,138,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(856,138,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(857,138,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(858,138,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(859,138,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(860,138,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(861,139,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(862,139,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(863,139,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(864,139,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(865,139,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(866,139,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(867,139,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(868,140,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(869,140,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(870,142,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(871,142,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(872,142,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(873,142,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(874,142,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(875,142,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(876,142,16,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(877,143,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(878,143,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(879,143,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(880,143,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(881,143,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(882,143,18,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(883,143,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(884,144,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(885,144,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(886,144,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(887,144,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(888,144,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(889,144,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(890,145,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(891,145,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(892,145,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(893,145,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(894,145,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(895,146,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(896,146,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(897,146,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(898,146,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(899,146,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(900,146,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(901,146,12,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(902,146,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(903,146,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(904,146,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(905,146,18,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(906,146,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(907,146,16,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(908,146,17,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(909,147,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(910,147,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(911,147,3,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(912,147,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(913,147,13,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(914,147,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(915,147,12,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(916,147,5,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(917,147,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(918,147,7,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(919,147,18,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(920,147,15,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(921,147,16,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(922,147,17,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(923,148,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(924,148,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(925,149,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(926,149,2,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(927,149,10,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(928,149,14,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(929,149,6,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(930,149,16,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(931,150,1,'2022-07-05 17:13:14','2022-07-05 17:13:14'),(932,150,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(933,150,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(934,150,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(935,150,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(936,150,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(937,151,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(938,151,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(939,151,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(940,151,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(941,151,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(942,151,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(943,152,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(944,152,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(945,152,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(946,152,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(947,153,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(948,153,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(949,153,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(950,153,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(951,153,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(952,153,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(953,154,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(954,154,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(955,154,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(956,154,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(957,154,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(958,154,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(959,154,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(960,154,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(961,155,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(962,155,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(963,155,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(964,155,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(965,155,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(966,155,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(967,155,12,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(968,155,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(969,155,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(970,155,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(971,155,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(972,156,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(973,156,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(974,156,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(975,156,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(976,156,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(977,156,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(978,156,12,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(979,156,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(980,156,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(981,156,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(982,156,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(983,157,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(984,157,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(985,157,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(986,158,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(987,158,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(988,158,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(989,158,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(990,158,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(991,158,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(992,158,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(993,159,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(994,159,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(995,159,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(996,159,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(997,159,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(998,159,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(999,159,12,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1000,159,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1001,159,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1002,159,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1003,159,15,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1004,159,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1005,159,17,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1006,160,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1007,160,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1008,160,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1009,160,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1010,160,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1011,160,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1012,160,12,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1013,160,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1014,160,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1015,160,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1016,160,15,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1017,160,16,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1018,160,17,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1019,161,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1020,161,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1021,161,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1022,161,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1023,161,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1024,161,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1025,161,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1026,161,7,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1027,162,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1028,162,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1029,162,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1030,162,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1031,163,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1032,163,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1033,163,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1034,163,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1035,163,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1036,163,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1037,164,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1038,164,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1039,164,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1040,164,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1041,165,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1042,165,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1043,165,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1044,166,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1045,166,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1046,166,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1047,167,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1048,167,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1049,167,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1050,167,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1051,168,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1052,168,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1053,168,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1054,169,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1055,169,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1056,169,3,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1057,169,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1058,169,5,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1059,170,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1060,170,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1061,170,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1062,170,13,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1063,170,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1064,171,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1065,171,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1066,171,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1067,171,14,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1068,171,6,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1069,172,1,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1070,172,2,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1071,172,10,'2022-07-05 17:13:15','2022-07-05 17:13:15'),(1072,173,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1073,173,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1074,173,3,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1075,173,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1076,173,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1077,174,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1078,174,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1079,174,3,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1080,174,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1081,174,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1082,175,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1083,175,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1084,175,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1085,176,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1086,176,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1087,176,3,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1088,176,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1089,176,13,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1090,176,14,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1091,176,12,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1092,176,5,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1093,176,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1094,176,7,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1095,177,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1096,177,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1097,177,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1098,177,13,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1099,177,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1100,178,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1101,178,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1102,178,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1103,178,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1104,179,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1105,179,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1106,179,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1107,179,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1108,180,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1109,180,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1110,180,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1111,180,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1112,181,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1113,181,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1114,181,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1115,182,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1116,182,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1117,182,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1118,183,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1119,183,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1120,183,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1121,184,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1122,184,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1123,184,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1124,185,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1125,185,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1126,185,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1127,186,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1128,186,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1129,186,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1130,186,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1131,187,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1132,187,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1133,187,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1134,187,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1135,188,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1136,188,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1137,188,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1138,188,5,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1139,188,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1140,188,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1141,189,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1142,189,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1143,189,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1144,189,5,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1145,189,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1146,189,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1147,190,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1148,190,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1149,190,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1150,190,5,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1151,190,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1152,190,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1153,191,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1154,191,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1155,191,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1156,191,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1157,191,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1158,192,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1159,192,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1160,192,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1161,192,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1162,192,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1163,193,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1164,193,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1165,193,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1166,193,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1167,193,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1168,194,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1169,194,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1170,194,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1171,194,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1172,194,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1173,195,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1174,195,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1175,195,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1176,195,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1177,195,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1178,196,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1179,196,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1180,196,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1181,196,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1182,196,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1183,197,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1184,197,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1185,197,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1186,197,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1187,197,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1188,198,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1189,198,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1190,198,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1191,198,6,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1192,198,16,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1193,199,1,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1194,199,2,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1195,199,10,'2022-07-05 17:13:16','2022-07-05 17:13:16'),(1196,199,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1197,199,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1198,200,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1199,200,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1200,200,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1201,200,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1202,200,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1203,201,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1204,201,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1205,201,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1206,201,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1207,201,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1208,202,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1209,202,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1210,202,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1211,202,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1212,202,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1213,203,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1214,203,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1215,203,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1216,203,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1217,203,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1218,204,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1219,204,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1220,204,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1221,204,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1222,204,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1223,205,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1224,205,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1225,205,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1226,206,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1227,206,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1228,206,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1229,206,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1230,206,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1231,207,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1232,207,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1233,207,3,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1234,207,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1235,207,13,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1236,207,14,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1237,207,12,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1238,207,5,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1239,207,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1240,207,7,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1241,207,15,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1242,207,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1243,207,17,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1244,208,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1245,208,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1246,208,3,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1247,208,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1248,208,13,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1249,208,14,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1250,208,12,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1251,208,5,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1252,208,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1253,208,7,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1254,208,15,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1255,208,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1256,208,17,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1257,209,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1258,209,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1259,209,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1260,209,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1261,210,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1262,210,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1263,210,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1264,210,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1265,211,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1266,211,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1267,211,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1268,211,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1269,212,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1270,212,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1271,212,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1272,212,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1273,213,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1274,213,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1275,213,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1276,214,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1277,214,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1278,214,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1279,214,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1280,215,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1281,215,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1282,215,3,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1283,215,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1284,215,13,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1285,215,14,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1286,215,12,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1287,215,5,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1288,215,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1289,215,7,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1290,215,15,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1291,215,16,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1292,215,17,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1293,216,1,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1294,216,2,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1295,216,3,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1296,216,10,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1297,216,13,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1298,216,14,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1299,216,12,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1300,216,5,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1301,216,6,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1302,216,7,'2022-07-05 17:13:17','2022-07-05 17:13:17'),(1303,216,15,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1304,216,16,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1305,216,17,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1306,217,1,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1307,218,1,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1308,219,1,'2022-07-05 17:13:18','2022-07-05 17:13:18'),(1309,220,1,'2022-07-05 17:13:18','2022-07-05 17:13:18');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'DOMAIN PORTAL ','domain.portal','Quản lý nội bộ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(2,'DOMAIN CUSTOMER ','domain.customer','Đại lý',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(3,'DOMAIN SUPPLIER ','domain.supplier','Nhà cung cấp',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(4,'MENU CMS ','menu.cms','Quản trị nội dung',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(5,'MENU CMS0100 ','menu.cms0100','Thiết lập trang chủ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(6,'SCREEN CMS0300 ','screen.cms0300','zalo oa list ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(7,'SCREEN CMS0400 ','screen.cms0400','esms record',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(8,'MENU CRM ','menu.crm','Quản lý bán hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(9,'MENU CRM0130 ','menu.crm0130','Danh sách sản phẩm cho sales',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(10,'MENU CRM0200 ','menu.crm0200','Danh sách đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(11,'MENU CRM0400 ','menu.crm0400','Danh sách xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(12,'MENU ADMIN ','menu.admin','Hiện menu',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(13,'ADMIN ADM0100 ','admin.adm0100','Quản lý user',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(14,'ADMIN ADM0200 ','admin.adm0200','Quản lý quyền',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(15,'ADMIN ADM0300 ','admin.adm0300','Quản lý phép',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(16,'ADMIN ADM0400 ','admin.adm0400','Điều khiển batch',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(17,'ADMIN ADM0500 ','admin.adm0500','Thiết lập thông số',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(18,'HRM HRM0100 ','hrm.hrm0100','Lịch công ty',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(19,'HRM HRM0110 ','hrm.hrm0110','Đơn xin nghỉ phép',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(20,'HRM HRM0120 ','hrm.hrm0120','Duyệt đơn',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(21,'HRM HRM0200 ','hrm.hrm0200','Danh sách bài kiểm tra',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(22,'HRM HRM0210 ','hrm.hrm0210','Kiểm tra',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(23,'COM MANAGER ','com.manager','',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(24,'SCREEN CRM0100 ','screen.crm0100','Danh sách sản phẩm',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(25,'SCREEN CRM0100 UPDATE_PRICE','screen.crm0100.update_price','Danh sách sản phẩm',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(26,'SCREEN CRM0110 ','screen.crm0110','Tạo sản phẩm',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(27,'SCREEN CRM0120 ','screen.crm0120','Chi tiết sản phẩm',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(28,'SCREEN CRM0130 ','screen.crm0130','Danh sách sản phẩm cho sales',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(29,'SCREEN CRM0140 ','screen.crm0140','Bảng báo giá',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(30,'SCREEN CRM0140 SAVE','screen.crm0140.save','Bảng báo giá',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(31,'SCREEN CRM0200 ','screen.crm0200','Danh sách đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(32,'SCREEN CRM0200 PRINT_CHECK','screen.crm0200.print_check','Danh sách đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(33,'SCREEN CRM0200 DOWNLOAD','screen.crm0200.download','Danh sách đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(34,'SCREEN CRM0210 ','screen.crm0210','Tạo đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(35,'SCREEN CRM0210 APPROVE','screen.crm0210.approve','Tạo đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(36,'SCREEN CRM0210 DENY','screen.crm0210.deny','Tạo đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(37,'SCREEN CRM0210 CANCEL_ORDER','screen.crm0210.cancel_order','Tạo đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(38,'SCREEN CRM0210 CANCEL_REMAIN','screen.crm0210.cancel_remain','Tạo đơn đặt hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(39,'SCREEN CRM0220 ','screen.crm0220','Đơn hàng giao thiếu',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(40,'SCREEN CRM0220 DOWNLOAD','screen.crm0220.download','Đơn hàng giao thiếu',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(41,'SCREEN CRM0230 ','screen.crm0230','Sản phẩm đã giao',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(42,'SCREEN CRM0231 ','screen.crm0231','Sản phẩm chưa đặt',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(43,'SCREEN CRM0240 ','screen.crm0240','Danh sách yêu cầu xử lý đơn hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(44,'SCREEN CRM0250 ','screen.crm0250','Số ngày công nợ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(45,'SCREEN CRM0250 DOWNLOAD','screen.crm0250.download','Số ngày công nợ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(46,'SCREEN CRM0250 EXEC','screen.crm0250.exec','Số ngày công nợ',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(47,'SCREEN CRM0300 ','screen.crm0300','Danh sách cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(48,'SCREEN CRM0300 ASSIGN','screen.crm0300.assign','Danh sách cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(49,'SCREEN CRM0300 UPDATE_ZALO','screen.crm0300.update_zalo','Cập nhật zalo user',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(50,'SCREEN CRM0300 DOWNLOAD','screen.crm0300.download','Cập nhật zalo user',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(51,'SCREEN CRM0301 ','screen.crm0301','Bản đồ cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(52,'SCREEN CRM0310 ','screen.crm0310','Chỉnh sửa cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(53,'SCREEN CRM0320 ','screen.crm0320','Phân cấp cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(54,'SCREEN CRM0321 ','screen.crm0321','Theo dõi cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(55,'SCREEN CRM0330 ','screen.crm0330','Danh sách ghi chú cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(56,'SCREEN CRM0340 ','screen.crm0340','Phân công cửa hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(57,'SCREEN CRM0350 ','screen.crm0350','Chành xe',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(58,'SCREEN CRM0400 ','screen.crm0400','Danh sách xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(59,'SCREEN CRM0400 DOWNLOAD','screen.crm0400.download','Danh sách xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(60,'SCREEN CRM0410 ','screen.crm0410','Tạo đơn xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(61,'SCREEN CRM0410 CANCEL','screen.crm0410.cancel','Tạo đơn xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(62,'SCREEN CRM0410 APPROVE','screen.crm0410.approve','Tạo đơn xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(63,'SCREEN CRM0410 DENY','screen.crm0410.deny','Tạo đơn xuất hàng',NULL,'2022-07-05 17:13:05','2022-07-05 17:13:05'),(64,'SCREEN CRM0500 ','screen.crm0500','Danh sách chăm sóc khách hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(65,'SCREEN CRM0510 ','screen.crm0510','Tạo chăm sóc khách hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(66,'SCREEN CRM0600 ','screen.crm0600','Danh sách giao hàng nhà máy',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(67,'SCREEN CRM0630 ','screen.crm0630','',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(68,'SCREEN CRM0700 ','screen.crm0700','Danh sách thu hồi công nợ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(69,'SCREEN CRM0710 ','screen.crm0710','Thêm thu hồi công nợ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(70,'SCREEN CRM0720 ','screen.crm0720','Theo dõi công nợ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(71,'SCREEN CRM0750 ','screen.crm0750','Thanh toán trước',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(72,'SCREEN CRM0751 ','screen.crm0751','Nhập thanh toán trước ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(73,'SCREEN CRM0751 CONFIRM','screen.crm0751.confirm','Kế toán duyệt chi thanh toán trước ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(74,'SCREEN CRM0751 ACCEPT','screen.crm0751.accept','IA check thanh toán trước',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(75,'SCREEN CRM0800 ','screen.crm0800','Danh sách đợt kiểm kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(76,'SCREEN CRM0810 ','screen.crm0810','Chi tiết kiểm kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(77,'SCREEN CRM0900 ','screen.crm0900','Tồn kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(78,'SCREEN CRM0910 ','screen.crm0910','Tồn kho (tháng)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(79,'SCREEN CRM0910 DOWNLOAD','screen.crm0910.download','Tồn kho (tháng)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(80,'SCREEN CRM0912 ','screen.crm0912','Thời gian tồn kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(81,'SCREEN CRM0912 DOWNLOAD','screen.crm0912.download','Thời gian tồn kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(82,'SCREEN CRM0912 EXEC','screen.crm0912.exec','Thời gian tồn kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(83,'SCREEN CRM0913 ','screen.crm0913','Tồn kho (ngày)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(84,'SCREEN CRM0913 DOWNLOAD','screen.crm0913.download','Tồn kho (ngày)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(85,'SCREEN CRM0913 SAVE','screen.crm0913.save','Tồn kho (ngày)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(86,'SCREEN CRM0914 ','screen.crm0914','Tiêu thục (công)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(87,'SCREEN CRM0915 ','screen.crm0915','Tiêu thụ (sản phẩm)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(88,'SCREEN CRM0920 ','screen.crm0920','Chi tiết xuất nhập',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(89,'SCREEN CRM0920 DOWNLOAD','screen.crm0920.download','Chi tiết xuất nhập',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(90,'SCREEN CRM1000 ','screen.crm1000','Danh sách chi phí giao hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(91,'SCREEN CRM1100 ','screen.crm1100','Danh sách người giao hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(92,'SCREEN CRM1110 ','screen.crm1110','Thêm người giao hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(93,'SCREEN CRM1200 ','screen.crm1200','Danh sách tài khoản ngân hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(94,'SCREEN CRM1210 ','screen.crm1210','Thêm tài khoản ngân hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(95,'SCREEN CRM1300 ','screen.crm1300','Danh sách đặt hàng nhà máy',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(96,'SCREEN CRM1310 ','screen.crm1310','Chi tiết đặt hàng nhà máy',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(97,'SCREEN CRM1400 ','screen.crm1400','Danh sách giao hàng nhà máy',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(98,'SCREEN CRM1410 ','screen.crm1410','Chi tiết giao hàng nhà máy',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(99,'SCREEN CRM1500 ','screen.crm1500','Danh sách qui cách',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(100,'SCREEN CRM1510 ','screen.crm1510','Cập nhật qui cách',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(101,'SCREEN CRM1600 ','screen.crm1600','Danh sách nhập hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(102,'SCREEN CRM1610 ','screen.crm1610','Cập nhật nhập hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(103,'SCREEN CRM1620 ','screen.crm1620','Lịch nhập hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(104,'SCREEN CRM1620 DETAIL','screen.crm1620.detail','Lịch nhập hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(105,'SCREEN CRM1630 ','screen.crm1630','Trả hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(106,'SCREEN CRM1630 UPDATE','screen.crm1630.update','Trả hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(107,'SCREEN CRM1640 ','screen.crm1640','Danh sách trả hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(108,'SCREEN CRM1650 ','screen.crm1650','',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(109,'SCREEN CRM1700 ','screen.crm1700','Danh sách chương trình',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(110,'SCREEN CRM1800 ','screen.crm1800','',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(111,'SCREEN CRM1810 ','screen.crm1810','Danh sách loại chi phí công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(112,'SCREEN CRM1811 ','screen.crm1811','Thêm loại chi phí công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(113,'SCREEN CRM1820 ','screen.crm1820','Danh sách phòng ban công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(114,'SCREEN CRM1821 ','screen.crm1821','Thêm loại phòng ban công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(115,'SCREEN CRM1830 ','screen.crm1830','Danh sách chi phí công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(116,'SCREEN CRM1831 ','screen.crm1831','Thêm loại chi phí công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(117,'SCREEN CRM1831 ACCEPT','screen.crm1831.accept','Duyệt không duyệt chi phí ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(118,'SCREEN CRM1831 CONFIRM','screen.crm1831.confirm','Kế toán xác nhận chi ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(119,'SCREEN CRM1831 CANCEL','screen.crm1831.cancel','Huỷ chi phí ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(120,'SCREEN CRM2500 ','screen.crm2500','Danh sách vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(121,'SCREEN CRM2500 DELETE','screen.crm2500.delete','Danh sách vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(122,'SCREEN CRM2510 ','screen.crm2510','Tạo vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(123,'SCREEN CRM2510 CREATE','screen.crm2510.create','Tạo vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(124,'SCREEN CRM2510 EDIT','screen.crm2510.edit','Tạo vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(125,'SCREEN CRM2530 ','screen.crm2530','Danh sách Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(126,'SCREEN CRM2530 APPROVE','screen.crm2530.approve','Danh sách Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(127,'SCREEN CRM2530 DENY','screen.crm2530.deny','Danh sách Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(128,'SCREEN CRM2540 ','screen.crm2540','Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(129,'SCREEN CRM2540 UPDATE','screen.crm2540.update','Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(130,'SCREEN CRM2540 APPROVE','screen.crm2540.approve','Nhập/Xuất vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(131,'SCREEN CRM2550 ','screen.crm2550','Tồn kho vật phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(132,'SCREEN CRM2600 ','screen.crm2600','Chi tiết cửa hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(133,'SCREEN CRM2600 REVIEW','screen.crm2600.review','Review cửa hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(134,'SCREEN CRM2700 ','screen.crm2700','Đăng ký bảo hành',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(135,'SCREEN CRM2700 DOWNLOAD','screen.crm2700.download','Đăng ký bảo hành',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(136,'SCREEN CRM2710 ','screen.crm2710','In QR bảo hành',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(137,'SCREEN CRM2800 ','screen.crm2800','Danh sách KPI của hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(138,'SCREEN CRM2810 ','screen.crm2810','Danh sách KPI 1 của hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(139,'SCREEN CRM2820 ','screen.crm2820','Chi tiết KPI của hàng 1 tháng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(140,'SCREEN CUS0100 ','screen.cus0100','Danh sách đặt hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(141,'SCREEN CUS0110 ','screen.cus0110','Tạo đặt hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(142,'SCREEN CMS0100 ','screen.cms0100','Thiết lập trang chủ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(143,'SCREEN CMS0200 ','screen.cms0200','Danh sách tin tức',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(144,'SCREEN CMS0210 ','screen.cms0210','Thêm tin tức',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(145,'SCREEN CMS0220 ','screen.cms0220','',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(146,'SCREEN HRM0100 ','screen.hrm0100','Lịch công ty',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(147,'SCREEN HRM0110 ','screen.hrm0110','Đơn xin nghỉ phép',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(148,'SCREEN HRM0120 ','screen.hrm0120','Duyệt đơn',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(149,'SCREEN HRM0130 ','screen.hrm0130','Thống kê phép năm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(150,'SCREEN HRM0140 ','screen.hrm0140','Truy cập hệ thống',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(151,'SCREEN HRM0141 ','screen.hrm0141','Thời gian làm việc theo tháng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(152,'SCREEN HRM0150 ','screen.hrm0150','Vị trí mới nhất',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(153,'SCREEN HRM0151 ','screen.hrm0151','Lịch sử vị trí',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(154,'SCREEN HRM0152 ','screen.hrm0152','Checkin',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(155,'SCREEN HRM0153 ','screen.hrm0153','Checkin/Checkout',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(156,'SCREEN HRM0154 ','screen.hrm0154','Danh sách checkin/checkout',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(157,'SCREEN HRM0200 ','screen.hrm0200','Danh sách bài kiểm tra',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(158,'SCREEN HRM0210 ','screen.hrm0210','Kiểm tra',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(159,'SCREEN HRM0300 ','screen.hrm0300','Danh sách task',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(160,'SCREEN HRM0310 ','screen.hrm0310','Thêm task',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(161,'SCREEN DAS0100 ','screen.das0100','Bảng điều khiển',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(162,'SCREEN DAS0100 DOWNLOAD-WAREHOUSE','screen.das0100.download-warehouse','Bảng điều khiển',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(163,'SCREEN RPT0100 ','screen.rpt0100','Báo cáo doanh số NVBH',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(164,'SCREEN RPT0200 ','screen.rpt0200','Báo cáo doanh số',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(165,'SCREEN RPT0510 ','screen.rpt0510','Doanh số từng cấp (Daily Report)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(166,'SCREEN RPT0511 ','screen.rpt0511','Doanh số sale (Daily Report)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(167,'SCREEN RPT0512 ','screen.rpt0512','Doanh số khu vực (Daily Report)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(168,'SCREEN RPT0513 ','screen.rpt0513','Quản lý sản phẩm (Daily Report)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(169,'SCREEN RPT0514 ','screen.rpt0514','Số lượng sản phẩm cửa hàng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(170,'SCREEN RPT0515 ','screen.rpt0515','Báo cáo chương trình',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(171,'SCREEN RPT0516 ','screen.rpt0516','Báo cáo chi phí',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(172,'SCREEN RPT0517 ','screen.rpt0517','Download Management',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(173,'SCREEN RPT0518 ','screen.rpt0518','bao cao cua hang',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(174,'SCREEN RPT0519 ','screen.rpt0519','bao cao nhan vien',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(175,'SCREEN RPT0518.DOWNLOAD ','screen.rpt0518.download','Download bao cao cua hang',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(176,'MOBILE LOGIN ','mobile.login','',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(177,'SCREEN CRM0700 ZALO','screen.crm0700.zalo','Thông báo zalo cho Follower',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(178,'SCREEN CRM0700 UPDATE','screen.crm0700.update','Cập nhât mã kế toán cho store',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(179,'SCREEN CRM0700 DOWNLOAD','screen.crm0700.download','Download danh sách thanh toán',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(180,'SCREEN CRM0250 STAT','screen.crm0250.stat','Xem thống kê công nợ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(181,'SCREEN CRM0913 CONFIRM','screen.crm0913.confirm','Xác nhận điều chỉnh tồn kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(182,'SCREEN CRM0810 CANCEL','screen.crm0810.cancel','Huỷ đợt kiểm kho',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(183,'SCREEN CRM1630 APPROVE','screen.crm1630.approve','Đồng ý nhâp kho nhà máy ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(184,'SCREEN CRM1630 DENY','screen.crm1630.deny','Không đồng ý nhập kho nhà máy ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(185,'SCREEN CRM0100 DOWNLOAD','screen.crm0100.download','Tải danh sách sản phẩm',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(186,'SCREEN HRM0400 ','screen.hrm0400','Bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(187,'SCREEN HRM0410 ','screen.hrm0410','Chi tiết bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(188,'SCREEN HRM0500 ','screen.hrm0500','KPI',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(189,'SCREEN HRM0510 ','screen.hrm0510','Chi tiết KPI',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(190,'SCREEN HRM0600 ','screen.hrm0600','Bảng chấm công',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(191,'SCREEN HRM0700 ','screen.hrm0700','Danh sách nhân viên',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(192,'SCREEN HRM0710 ','screen.hrm0710','Chi tiết nhân viên',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(193,'SCREEN HRM0711 ','screen.hrm0711','Chi tiết nhân viên (info)',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(194,'SCREEN HRM0714 ','screen.hrm0714','Cập nhật thông tin nhân viên',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(195,'SCREEN HRM0715 ','screen.hrm0715','Danh sách hợp đồng nhân viên',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(196,'SCREEN HRM0716 ','screen.hrm0716','Thêm/Cập nhật hợp đồng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(197,'SCREEN HRM0716 SAVE','screen.hrm0716.save','Thêm/Cập nhật hợp đồng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(198,'SCREEN HRM0716 DELETE','screen.hrm0716.delete','Xóa hợp đồng',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(199,'SCREEN HRM0800 ','screen.hrm0800','Leave Allocation',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(200,'SCREEN HRM0810 ','screen.hrm0810','Add/Edit Allocation',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(201,'SCREEN HRM0900 ','screen.hrm0900','Ngày lễ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(202,'SCREEN HRM0910 ','screen.hrm0910','Add/Edit holiday',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(203,'SCREEN HRM1000 ','screen.hrm1000','Tin tức nội bộ ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(204,'SCREEN HRM1010 ','screen.hrm1010','Add/Edit tin tức nội bộ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(205,'SCREEN HRM1010 DELETE','screen.hrm1010.delete','Delete tin tức nội bộ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(206,'SCREEN HRM1010 PUBLISH','screen.hrm1010.publish','Publish tin tức nội bộ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(207,'SCREEN HRM1020 ','screen.hrm1020','List tin tức nội bộ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(208,'SCREEN HRM1021 ','screen.hrm1021','View tin tức nội bộ',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(209,'SCREEN HRM1100 ','screen.hrm1100','Danh sách bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(210,'SCREEN HRM1110 ','screen.hrm1110','Tạo mới bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(211,'SCREEN HRM1111 ','screen.hrm1111','Chi tiết bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(212,'SCREEN HRM1111 CONFIRM','screen.hrm1111.confirm','Xin approve bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(213,'SCREEN HRM1111 APPROVE','screen.hrm1111.approve','Approve bảng lương',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(214,'SCREEN HRM1112 ','screen.hrm1112','Chi tiết bảng lương nhân viên',NULL,'2022-07-05 17:13:06','2022-07-05 17:13:06'),(215,'SCREEN HRM1120 ','screen.hrm1120','Danh sách bảng lương cho nhân viên',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(216,'SCREEN HRM1130 ','screen.hrm1130','Chi tiết bản lương cho nhân viên',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(217,'SCREEN TMP9999 ','screen.tmp9999','test',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(218,'SCREEN TMP9999 SAVE','screen.tmp9999.save','test',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(219,'SCREEN TMP9999 DOWNLOAD','screen.tmp9999.download','test',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07'),(220,'SCREEN TMP9999 DELETE','screen.tmp9999.delete','test',NULL,'2022-07-05 17:13:07','2022-07-05 17:13:07');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (38,5,19,'2018-04-17 08:52:19','2018-04-17 08:52:19'),(99,5,21,'2019-05-28 21:07:21','2019-05-28 21:07:21'),(111,5,7,'2019-06-07 10:50:34','2019-06-07 10:50:34'),(129,5,6,'2019-06-18 09:07:20','2019-06-18 09:07:20'),(145,2,2,'2019-06-18 09:40:27','2019-06-18 09:40:27'),(147,6,8,'2019-06-18 09:40:58','2019-06-18 09:40:58'),(163,4,20,'2019-09-09 11:23:37','2019-09-09 11:23:37'),(176,4,18,'2019-10-18 11:00:05','2019-10-18 11:00:05'),(179,5,14,'2019-10-19 22:29:29','2019-10-19 22:29:29'),(185,1,1,'2020-02-18 14:54:55','2020-02-18 14:54:55'),(186,1,5,'2020-02-18 14:55:02','2020-02-18 14:55:02'),(187,8,10,'2020-02-19 14:34:00','2020-02-19 14:34:00'),(188,8,12,'2020-02-19 14:34:17','2020-02-19 14:34:17'),(189,8,11,'2020-02-19 14:34:37','2020-02-19 14:34:37'),(191,5,16,'2020-02-19 14:35:04','2020-02-19 14:35:04'),(194,8,13,'2020-02-19 14:36:03','2020-02-19 14:36:03'),(195,5,15,'2020-02-19 14:36:34','2020-02-19 14:36:34'),(208,5,17,'2020-06-10 01:37:01','2020-06-10 01:37:01'),(262,7,29,'2020-10-20 01:35:41','2020-10-20 01:35:41'),(269,7,9,'2020-11-09 01:31:58','2020-11-09 01:31:58'),(278,14,35,'2020-12-22 01:32:00','2020-12-22 01:32:00'),(282,5,41,'2021-01-11 02:20:05','2021-01-11 02:20:05'),(290,18,50,'2021-03-26 05:53:07','2021-03-26 05:53:07'),(291,13,4,'2021-04-05 01:34:29','2021-04-05 01:34:29'),(296,13,49,'2021-04-05 01:40:18','2021-04-05 01:40:18'),(301,7,48,'2021-04-05 01:41:24','2021-04-05 01:41:24'),(302,16,36,'2021-04-05 01:42:08','2021-04-05 01:42:08'),(304,17,26,'2021-04-06 02:51:48','2021-04-06 02:51:48'),(305,13,28,'2021-04-06 02:52:03','2021-04-06 02:52:03'),(308,14,44,'2021-04-06 02:52:55','2021-04-06 02:52:55'),(309,14,46,'2021-04-06 02:53:12','2021-04-06 02:53:12'),(310,6,52,'2021-04-16 08:34:47','2021-04-16 08:34:47'),(312,6,45,'2021-04-29 02:40:23','2021-04-29 02:40:23'),(313,18,47,'2021-04-29 02:40:44','2021-04-29 02:40:44'),(316,7,42,'2021-04-29 02:41:45','2021-04-29 02:41:45'),(317,15,39,'2021-04-29 02:42:09','2021-04-29 02:42:09'),(319,18,43,'2021-04-29 02:45:40','2021-04-29 02:45:40'),(320,16,27,'2021-05-06 04:01:04','2021-05-06 04:01:04'),(321,7,53,'2021-05-18 04:17:30','2021-05-18 04:17:30'),(323,16,54,'2021-08-18 13:03:37','2021-08-18 13:03:37'),(329,5,33,'2021-12-02 08:18:49','2021-12-02 08:18:49'),(335,13,58,'2022-03-17 05:03:17','2022-03-17 05:03:17'),(337,10,55,'2022-03-25 02:36:32','2022-03-25 02:36:32'),(338,13,60,'2022-04-12 14:39:12','2022-04-12 14:39:12'),(339,3,30,'2022-04-26 09:36:58','2022-04-26 09:36:58'),(340,13,40,'2022-04-29 04:15:12','2022-04-29 04:15:12'),(341,12,40,'2022-04-29 04:15:12','2022-04-29 04:15:12'),(342,5,32,'2022-05-04 07:41:07','2022-05-04 07:41:07'),(348,5,31,'2022-05-06 03:01:30','2022-05-06 03:01:30'),(356,6,61,'2022-06-03 03:22:39','2022-06-03 03:22:39'),(357,6,34,'2022-06-03 03:23:47','2022-06-03 03:23:47'),(358,6,51,'2022-06-04 09:57:52','2022-06-04 09:57:52'),(359,16,51,'2022-06-04 09:57:52','2022-06-04 09:57:52');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','administrator','Quản trị hệ thống',490,'2017-04-02 13:39:29','2020-10-15 04:24:00'),(2,'Manager','manager','Giám đốc',490,'2017-04-02 13:39:29','2020-10-11 08:17:40'),(3,'Sales Manager','sale-manager','Quản lý',480,'2017-04-02 13:39:29','2021-12-18 00:29:15'),(4,'Sales Admin','sales-admin','Cordinator',470,'2017-04-02 13:39:29','2020-10-12 03:12:05'),(5,'Sales','sales','Nhân viên bán hàng',450,'2017-04-02 13:39:29','2022-05-18 04:52:07'),(6,'Accountant','accountant','Kế toán',460,'2017-04-02 13:39:29','2022-05-25 03:01:58'),(7,'Warehouse','warehouse','Thủ kho',440,'2017-04-02 13:39:29','2022-01-06 02:52:37'),(8,'Customer','customer','Khách hàng',100,'2017-04-02 13:39:29','2020-10-11 08:17:40'),(9,'Supplier','supplier','Nhà cung cấp',200,'2017-04-02 13:39:29','2020-10-11 08:17:40'),(10,'IT','it','IT',490,'2017-04-02 13:39:29','2018-09-23 21:57:05'),(11,'Admin 2','admin-2','Admin 2',470,'2017-10-14 20:26:35','2020-10-11 08:17:40'),(12,'Internal Audit','internal-audit','Internal Audit',430,'2018-12-23 10:11:05','2022-04-29 04:16:27'),(13,'Sales admin 1','sales-admin-1','Sales admin 1',420,'2019-10-08 08:52:54','2022-04-01 08:47:54'),(14,'Sales admin 2','sales-admin-2','Sales admin 2',420,'2019-10-08 08:55:02','2021-01-14 07:58:30'),(15,'Marketing','marketing','Marketing',410,'2020-10-05 15:45:36','2021-01-15 02:22:55'),(16,'HR','hr','HR',460,'2020-10-05 15:45:36','2022-01-28 08:47:06'),(17,'Purchasing','purchasing','Purchasing',450,'2020-10-05 15:45:36','2020-10-15 01:24:15'),(18,'Internship','internship','internship',300,'2020-12-19 02:29:00','2020-12-19 02:29:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_absent`
--

DROP TABLE IF EXISTS `trn_absent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_absent` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `absent_date` date NOT NULL,
  `amount` double(4,2) NOT NULL,
  `absent_type` int NOT NULL,
  `leave_type` int NOT NULL DEFAULT '1',
  `reason` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `status` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `approve_user_id` int NOT NULL,
  `cmt` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `approve_ts` timestamp NULL DEFAULT NULL,
  `leave_allocation_id` int DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_absent`
--

LOCK TABLES `trn_absent` WRITE;
/*!40000 ALTER TABLE `trn_absent` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_absent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_absent_setting`
--

DROP TABLE IF EXISTS `trn_absent_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_absent_setting` (
  `user_id` int NOT NULL,
  `setting_year` int NOT NULL,
  `amount` double(4,2) NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`setting_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_absent_setting`
--

LOCK TABLES `trn_absent_setting` WRITE;
/*!40000 ALTER TABLE `trn_absent_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_absent_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_attendance`
--

DROP TABLE IF EXISTS `trn_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_attendance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `user_id` int NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `ip_as` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(10,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_attendance`
--

LOCK TABLES `trn_attendance` WRITE;
/*!40000 ALTER TABLE `trn_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_audit_log`
--

DROP TABLE IF EXISTS `trn_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_audit_log` (
  `user_id` int NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `ip_as` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(11,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_audit_log`
--

LOCK TABLES `trn_audit_log` WRITE;
/*!40000 ALTER TABLE `trn_audit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_batch_log`
--

DROP TABLE IF EXISTS `trn_batch_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_batch_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_time` datetime NOT NULL,
  `name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `params` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_batch_log`
--

LOCK TABLES `trn_batch_log` WRITE;
/*!40000 ALTER TABLE `trn_batch_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_batch_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_branch_export`
--

DROP TABLE IF EXISTS `trn_branch_export`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_branch_export` (
  `branch_export_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id_from` bigint NOT NULL,
  `branch_id_to` bigint NOT NULL,
  `branch_export_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `seq_no` int NOT NULL,
  `export_sts` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `warehouseman_id` bigint DEFAULT NULL,
  `shipping_id` bigint DEFAULT NULL,
  `packing_time` datetime DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `shipping_time` datetime DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `packing_by` bigint DEFAULT NULL,
  `confirm_by` bigint DEFAULT NULL,
  `delivery_by` bigint DEFAULT NULL,
  `shipping_by` bigint DEFAULT NULL,
  `receive_by` bigint DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_export_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_branch_export`
--

LOCK TABLES `trn_branch_export` WRITE;
/*!40000 ALTER TABLE `trn_branch_export` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_branch_export` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_branch_export_detail`
--

DROP TABLE IF EXISTS `trn_branch_export_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_branch_export_detail` (
  `branch_export_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL,
  `amount` int NOT NULL,
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_export_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_branch_export_detail`
--

LOCK TABLES `trn_branch_export_detail` WRITE;
/*!40000 ALTER TABLE `trn_branch_export_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_branch_export_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_branch_import`
--

DROP TABLE IF EXISTS `trn_branch_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_branch_import` (
  `branch_import_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id_from` bigint NOT NULL,
  `branch_id_to` bigint NOT NULL,
  `branch_import_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `seq_no` int NOT NULL,
  `import_sts` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `warehouseman_id` bigint DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `import_time` datetime DEFAULT NULL,
  `confirm_by` bigint DEFAULT NULL,
  `import_by` bigint DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_import_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_branch_import`
--

LOCK TABLES `trn_branch_import` WRITE;
/*!40000 ALTER TABLE `trn_branch_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_branch_import` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_branch_import_detail`
--

DROP TABLE IF EXISTS `trn_branch_import_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_branch_import_detail` (
  `branch_import_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL,
  `amount` int NOT NULL,
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_import_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_branch_import_detail`
--

LOCK TABLES `trn_branch_import_detail` WRITE;
/*!40000 ALTER TABLE `trn_branch_import_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_branch_import_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_check_warehouse`
--

DROP TABLE IF EXISTS `trn_check_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_check_warehouse` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `check_user_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `check_date` date NOT NULL,
  `branch_id` bigint DEFAULT NULL,
  `checking_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_check_warehouse`
--

LOCK TABLES `trn_check_warehouse` WRITE;
/*!40000 ALTER TABLE `trn_check_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_check_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_check_warehouse_detail`
--

DROP TABLE IF EXISTS `trn_check_warehouse_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_check_warehouse_detail` (
  `check_warehouse_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_2` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_check_warehouse_detail`
--

LOCK TABLES `trn_check_warehouse_detail` WRITE;
/*!40000 ALTER TABLE `trn_check_warehouse_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_check_warehouse_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_comment`
--

DROP TABLE IF EXISTS `trn_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_comment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `group` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `id1` bigint DEFAULT NULL,
  `id2` bigint DEFAULT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `trn_comment_group_index` (`group`),
  KEY `trn_comment_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_comment`
--

LOCK TABLES `trn_comment` WRITE;
/*!40000 ALTER TABLE `trn_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_cost`
--

DROP TABLE IF EXISTS `trn_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_cost` (
  `cost_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cost_cat_id` bigint NOT NULL,
  `department_id` bigint NOT NULL,
  `cost_date` date NOT NULL,
  `amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `contra_account` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `voucher` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  `confirm_time` datetime DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `request_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `confirm_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `confirm_by` int DEFAULT NULL,
  `cost_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`cost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_cost`
--

LOCK TABLES `trn_cost` WRITE;
/*!40000 ALTER TABLE `trn_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_cs_notes`
--

DROP TABLE IF EXISTS `trn_cs_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_cs_notes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint NOT NULL,
  `pic_id` bigint DEFAULT NULL,
  `cus_review` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `com_resolve` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cus_rating` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `com_rating` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes_1` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_2` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_3` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `deadline` datetime DEFAULT NULL,
  `completed_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL DEFAULT '5',
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_cs_notes`
--

LOCK TABLES `trn_cs_notes` WRITE;
/*!40000 ALTER TABLE `trn_cs_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_cs_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_delivery`
--

DROP TABLE IF EXISTS `trn_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_delivery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `delivery_date` date NOT NULL,
  `delivery_vendor_id` bigint NOT NULL,
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_flg` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_delivery`
--

LOCK TABLES `trn_delivery` WRITE;
/*!40000 ALTER TABLE `trn_delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_delivery_detail`
--

DROP TABLE IF EXISTS `trn_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_delivery_detail` (
  `delivery_id` bigint NOT NULL,
  `store_delivery_id` bigint NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_delivery_detail`
--

LOCK TABLES `trn_delivery_detail` WRITE;
/*!40000 ALTER TABLE `trn_delivery_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_delivery_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_display_price_table`
--

DROP TABLE IF EXISTS `trn_display_price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_display_price_table` (
  `product_id` bigint NOT NULL,
  `int_order_no` int NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_display_price_table`
--

LOCK TABLES `trn_display_price_table` WRITE;
/*!40000 ALTER TABLE `trn_display_price_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_display_price_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_employee_contract`
--

DROP TABLE IF EXISTS `trn_employee_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_employee_contract` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `contract_no` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `basic_salary` decimal(19,2) NOT NULL DEFAULT '0.00',
  `contract_type` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_employee_contract`
--

LOCK TABLES `trn_employee_contract` WRITE;
/*!40000 ALTER TABLE `trn_employee_contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_employee_contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_esms_record`
--

DROP TABLE IF EXISTS `trn_esms_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_esms_record` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` bigint DEFAULT NULL,
  `param` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `type` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_result` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SMSID` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_esms_record`
--

LOCK TABLES `trn_esms_record` WRITE;
/*!40000 ALTER TABLE `trn_esms_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_esms_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_etest`
--

DROP TABLE IF EXISTS `trn_etest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_etest` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `test_min` int NOT NULL DEFAULT '30',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_etest`
--

LOCK TABLES `trn_etest` WRITE;
/*!40000 ALTER TABLE `trn_etest` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_etest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_etest_assign`
--

DROP TABLE IF EXISTS `trn_etest_assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_etest_assign` (
  `etest_id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `mark` int NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_etest_assign`
--

LOCK TABLES `trn_etest_assign` WRITE;
/*!40000 ALTER TABLE `trn_etest_assign` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_etest_assign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_etest_result`
--

DROP TABLE IF EXISTS `trn_etest_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_etest_result` (
  `etest_id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `seq_no` int NOT NULL,
  `answer` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `mark` int NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`user_id`,`seq_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_etest_result`
--

LOCK TABLES `trn_etest_result` WRITE;
/*!40000 ALTER TABLE `trn_etest_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_etest_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_etest_sentence`
--

DROP TABLE IF EXISTS `trn_etest_sentence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_etest_sentence` (
  `etest_id` bigint NOT NULL,
  `seq_no` int NOT NULL,
  `seq_type` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `question` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `answer` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`etest_id`,`seq_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_etest_sentence`
--

LOCK TABLES `trn_etest_sentence` WRITE;
/*!40000 ALTER TABLE `trn_etest_sentence` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_etest_sentence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_gift_use`
--

DROP TABLE IF EXISTS `trn_gift_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_gift_use` (
  `gift_id` bigint NOT NULL,
  `use_type` int NOT NULL,
  `use_date` date NOT NULL,
  `use_sts` int NOT NULL DEFAULT '0',
  `order_id` bigint DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_gift_use`
--

LOCK TABLES `trn_gift_use` WRITE;
/*!40000 ALTER TABLE `trn_gift_use` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_gift_use` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_guarantee`
--

DROP TABLE IF EXISTS `trn_guarantee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_guarantee` (
  `id` bigint unsigned NOT NULL,
  `product_id` bigint NOT NULL,
  `area1` int NOT NULL,
  `area2` int DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `store` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_as` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_country_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_isp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_lat` decimal(10,8) DEFAULT NULL,
  `ip_lon` decimal(11,8) DEFAULT NULL,
  `ip_org` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_region_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_timezone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_zip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_guarantee`
--

LOCK TABLES `trn_guarantee` WRITE;
/*!40000 ALTER TABLE `trn_guarantee` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_guarantee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_import_wh_factory`
--

DROP TABLE IF EXISTS `trn_import_wh_factory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_import_wh_factory` (
  `import_wh_factory_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint NOT NULL,
  `supplier_id` bigint NOT NULL,
  `import_date` date NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_factory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_import_wh_factory`
--

LOCK TABLES `trn_import_wh_factory` WRITE;
/*!40000 ALTER TABLE `trn_import_wh_factory` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_import_wh_factory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_import_wh_store`
--

DROP TABLE IF EXISTS `trn_import_wh_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_import_wh_store` (
  `import_wh_store_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `import_type` int NOT NULL DEFAULT '1',
  `store_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `import_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `import_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `salesman_id` int DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_import_wh_store`
--

LOCK TABLES `trn_import_wh_store` WRITE;
/*!40000 ALTER TABLE `trn_import_wh_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_import_wh_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_import_wh_store_detail`
--

DROP TABLE IF EXISTS `trn_import_wh_store_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_import_wh_store_detail` (
  `import_wh_store_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `amount` int NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`import_wh_store_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_import_wh_store_detail`
--

LOCK TABLES `trn_import_wh_store_detail` WRITE;
/*!40000 ALTER TABLE `trn_import_wh_store_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_import_wh_store_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_internal_news`
--

DROP TABLE IF EXISTS `trn_internal_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_internal_news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `news_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_internal_news`
--

LOCK TABLES `trn_internal_news` WRITE;
/*!40000 ALTER TABLE `trn_internal_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_internal_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_internal_news_viewed`
--

DROP TABLE IF EXISTS `trn_internal_news_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_internal_news_viewed` (
  `user_id` int NOT NULL,
  `news_id` bigint NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_internal_news_viewed`
--

LOCK TABLES `trn_internal_news_viewed` WRITE;
/*!40000 ALTER TABLE `trn_internal_news_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_internal_news_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_leave_alloc`
--

DROP TABLE IF EXISTS `trn_leave_alloc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_leave_alloc` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `year` int NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expired_date` date NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_leave_alloc`
--

LOCK TABLES `trn_leave_alloc` WRITE;
/*!40000 ALTER TABLE `trn_leave_alloc` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_leave_alloc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_leave_allocation`
--

DROP TABLE IF EXISTS `trn_leave_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_leave_allocation` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `num_days` decimal(5,2) NOT NULL,
  `reason` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_leave_allocation`
--

LOCK TABLES `trn_leave_allocation` WRITE;
/*!40000 ALTER TABLE `trn_leave_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_leave_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_oa_follower_message`
--

DROP TABLE IF EXISTS `trn_oa_follower_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_oa_follower_message` (
  `oa_follower_message_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total` bigint DEFAULT NULL,
  `total_sent` bigint DEFAULT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`oa_follower_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_oa_follower_message`
--

LOCK TABLES `trn_oa_follower_message` WRITE;
/*!40000 ALTER TABLE `trn_oa_follower_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_oa_follower_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_order_edit_request`
--

DROP TABLE IF EXISTS `trn_order_edit_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_order_edit_request` (
  `request_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `request_date` date NOT NULL,
  `request_type` int NOT NULL DEFAULT '1',
  `request_sts` int NOT NULL DEFAULT '0',
  `ref_id` bigint DEFAULT NULL,
  `request_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `response_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_order_edit_request`
--

LOCK TABLES `trn_order_edit_request` WRITE;
/*!40000 ALTER TABLE `trn_order_edit_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_order_edit_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_payment`
--

DROP TABLE IF EXISTS `trn_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_payment` (
  `payment_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int NOT NULL,
  `store_id` bigint NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` int NOT NULL DEFAULT '1',
  `payment_sts` int NOT NULL DEFAULT '0',
  `payment_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `bank_account_id` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_payment`
--

LOCK TABLES `trn_payment` WRITE;
/*!40000 ALTER TABLE `trn_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_payment_advance`
--

DROP TABLE IF EXISTS `trn_payment_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_payment_advance` (
  `payment_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int NOT NULL,
  `store_id` bigint NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` int NOT NULL DEFAULT '1',
  `payment_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `payment_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `bank_account_id` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `confirm_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `confirm_by` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `confirm_time` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_time` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_payment_advance`
--

LOCK TABLES `trn_payment_advance` WRITE;
/*!40000 ALTER TABLE `trn_payment_advance` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_payment_advance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_product_market_his`
--

DROP TABLE IF EXISTS `trn_product_market_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_product_market_his` (
  `product_market_his_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_change_type` int NOT NULL,
  `product_market_id` bigint NOT NULL,
  `changed_date` date NOT NULL,
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `amount` int NOT NULL,
  `store_id` bigint DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `description_approve` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_market_his_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_product_market_his`
--

LOCK TABLES `trn_product_market_his` WRITE;
/*!40000 ALTER TABLE `trn_product_market_his` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_product_market_his` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_product_price_his`
--

DROP TABLE IF EXISTS `trn_product_price_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_product_price_his` (
  `product_id` bigint NOT NULL,
  `selling_price` decimal(19,2) NOT NULL,
  `selling_price_sample` decimal(19,2) NOT NULL,
  `selling_price_tax` decimal(19,2) NOT NULL,
  `change_user_id` int NOT NULL,
  `change_time` datetime NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_product_price_his`
--

LOCK TABLES `trn_product_price_his` WRITE;
/*!40000 ALTER TABLE `trn_product_price_his` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_product_price_his` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_salary`
--

DROP TABLE IF EXISTS `trn_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_salary` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `salary_month` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int NOT NULL DEFAULT '0',
  `total_hours` int NOT NULL DEFAULT '0',
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
  `salary_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_salary_salary_month_unique` (`salary_month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_salary`
--

LOCK TABLES `trn_salary` WRITE;
/*!40000 ALTER TABLE `trn_salary` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_salary_detail`
--

DROP TABLE IF EXISTS `trn_salary_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_salary_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `salary_id` int NOT NULL,
  `total_days` float NOT NULL DEFAULT '0',
  `total_hours` int NOT NULL DEFAULT '0',
  `count_dependent_person` int NOT NULL DEFAULT '0',
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
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_salary_detail_employee_id_salary_id_unique` (`employee_id`,`salary_id`),
  KEY `trn_salary_detail_employee_id_salary_id_index` (`employee_id`,`salary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_salary_detail`
--

LOCK TABLES `trn_salary_detail` WRITE;
/*!40000 ALTER TABLE `trn_salary_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_salary_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_salesman_store`
--

DROP TABLE IF EXISTS `trn_salesman_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_salesman_store` (
  `salesman_store_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `salesman_id` int NOT NULL,
  `store_id` bigint NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`salesman_store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_salesman_store`
--

LOCK TABLES `trn_salesman_store` WRITE;
/*!40000 ALTER TABLE `trn_salesman_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_salesman_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store`
--

DROP TABLE IF EXISTS `trn_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store` (
  `new_store_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `area1` int NOT NULL,
  `area2` int NOT NULL,
  `gps_lat` double NOT NULL,
  `gps_long` double NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile1` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`new_store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store`
--

LOCK TABLES `trn_store` WRITE;
/*!40000 ALTER TABLE `trn_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_check_in`
--

DROP TABLE IF EXISTS `trn_store_check_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_check_in` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `store_id` bigint NOT NULL,
  `salesman_id` int NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_check_in`
--

LOCK TABLES `trn_store_check_in` WRITE;
/*!40000 ALTER TABLE `trn_store_check_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_check_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_check_in_images`
--

DROP TABLE IF EXISTS `trn_store_check_in_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_check_in_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `check_in_id` bigint NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_check_in_images`
--

LOCK TABLES `trn_store_check_in_images` WRITE;
/*!40000 ALTER TABLE `trn_store_check_in_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_check_in_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_delivery`
--

DROP TABLE IF EXISTS `trn_store_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_delivery` (
  `store_delivery_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_order_id` bigint NOT NULL,
  `store_id` bigint NOT NULL,
  `supplier_id` int NOT NULL DEFAULT '0',
  `warehouse_id` bigint NOT NULL,
  `delivery_date` date NOT NULL,
  `discount_1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `total` decimal(19,2) NOT NULL,
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `seq_no` int NOT NULL DEFAULT '0',
  `delivery_seq_no` int NOT NULL DEFAULT '0',
  `delivery_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `salesman_id` int DEFAULT NULL,
  `promotion_id` bigint DEFAULT NULL,
  `branch_id` bigint NOT NULL DEFAULT '1',
  `shipping_id` bigint DEFAULT NULL,
  `order_type` int NOT NULL DEFAULT '0',
  `packing_time` datetime DEFAULT NULL,
  `confirm_time` datetime DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `shipping_time` datetime DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `packing_by` int DEFAULT NULL,
  `confirm_by` int DEFAULT NULL,
  `delivery_by` int DEFAULT NULL,
  `shipping_by` int DEFAULT NULL,
  `receive_by` int DEFAULT NULL,
  `finish_by` int DEFAULT NULL,
  `store_delivery_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_delivery`
--

LOCK TABLES `trn_store_delivery` WRITE;
/*!40000 ALTER TABLE `trn_store_delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_delivery_detail`
--

DROP TABLE IF EXISTS `trn_store_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_delivery_detail` (
  `store_delivery_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_delivery_detail`
--

LOCK TABLES `trn_store_delivery_detail` WRITE;
/*!40000 ALTER TABLE `trn_store_delivery_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_delivery_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_delivery_payment`
--

DROP TABLE IF EXISTS `trn_store_delivery_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_delivery_payment` (
  `trn_store_delivery` bigint unsigned NOT NULL,
  `delivery_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_sts` int NOT NULL DEFAULT '1',
  `payment_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_finish_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`trn_store_delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_delivery_payment`
--

LOCK TABLES `trn_store_delivery_payment` WRITE;
/*!40000 ALTER TABLE `trn_store_delivery_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_delivery_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_delivery_sign`
--

DROP TABLE IF EXISTS `trn_store_delivery_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_delivery_sign` (
  `store_delivery_sign_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_delivery_id` bigint NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_delivery_sign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_delivery_sign`
--

LOCK TABLES `trn_store_delivery_sign` WRITE;
/*!40000 ALTER TABLE `trn_store_delivery_sign` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_delivery_sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_kpi`
--

DROP TABLE IF EXISTS `trn_store_kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_kpi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint NOT NULL,
  `year` int NOT NULL DEFAULT '0',
  `target_year` decimal(19,2) NOT NULL DEFAULT '0.00',
  `result_year` decimal(19,2) NOT NULL DEFAULT '0.00',
  `discount` int NOT NULL DEFAULT '0',
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
  `kpi_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_kpi`
--

LOCK TABLES `trn_store_kpi` WRITE;
/*!40000 ALTER TABLE `trn_store_kpi` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_kpi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_kpi_detail`
--

DROP TABLE IF EXISTS `trn_store_kpi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_kpi_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint NOT NULL,
  `month_index` int NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `result_amount` int NOT NULL DEFAULT '0',
  `result_money` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_kpi_detail`
--

LOCK TABLES `trn_store_kpi_detail` WRITE;
/*!40000 ALTER TABLE `trn_store_kpi_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_kpi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_order`
--

DROP TABLE IF EXISTS `trn_store_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_order` (
  `store_order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_order_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `prev_store_order_id` bigint DEFAULT NULL,
  `prev_store_order_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` bigint NOT NULL,
  `supplier_id` int NOT NULL DEFAULT '0',
  `discount_1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `order_date` date NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `total_with_discount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `order_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `salesman_id` int DEFAULT NULL,
  `count_print` int NOT NULL DEFAULT '0',
  `last_print_check_time` datetime DEFAULT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `cancel_time` datetime DEFAULT NULL,
  `split_time` datetime DEFAULT NULL,
  `promotion_id` bigint DEFAULT NULL,
  `admin_time` decimal(5,2) NOT NULL DEFAULT '0.00',
  `warehouse_time` decimal(5,2) NOT NULL DEFAULT '0.00',
  `order_type` tinyint NOT NULL DEFAULT '0',
  `branch_id` bigint DEFAULT NULL,
  `completion_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `confirm_time` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_order`
--

LOCK TABLES `trn_store_order` WRITE;
/*!40000 ALTER TABLE `trn_store_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_order_detail`
--

DROP TABLE IF EXISTS `trn_store_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_order_detail` (
  `store_order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_order_detail`
--

LOCK TABLES `trn_store_order_detail` WRITE;
/*!40000 ALTER TABLE `trn_store_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_payment_status`
--

DROP TABLE IF EXISTS `trn_store_payment_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_payment_status` (
  `store_id` bigint NOT NULL,
  `store_delivery_id` bigint NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `remain_amount` decimal(19,2) NOT NULL DEFAULT '0.00',
  `payment_start` date DEFAULT NULL,
  `payment_end` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_payment_status`
--

LOCK TABLES `trn_store_payment_status` WRITE;
/*!40000 ALTER TABLE `trn_store_payment_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_payment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_rank`
--

DROP TABLE IF EXISTS `trn_store_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_rank` (
  `store_id` bigint NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `store_rank` int NOT NULL,
  `order_total` decimal(19,2) NOT NULL,
  `order_total_with_discount` decimal(19,2) NOT NULL,
  `delivery_total` decimal(19,2) NOT NULL,
  `delivery_total_with_discount` decimal(19,2) NOT NULL,
  `payment` decimal(19,2) NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_rank`
--

LOCK TABLES `trn_store_rank` WRITE;
/*!40000 ALTER TABLE `trn_store_rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_signatures`
--

DROP TABLE IF EXISTS `trn_store_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_signatures` (
  `store_signature_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_signature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_signatures`
--

LOCK TABLES `trn_store_signatures` WRITE;
/*!40000 ALTER TABLE `trn_store_signatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_working`
--

DROP TABLE IF EXISTS `trn_store_working`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_working` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `working_time` datetime NOT NULL,
  `store_id` bigint NOT NULL,
  `salesman_id` int NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_working`
--

LOCK TABLES `trn_store_working` WRITE;
/*!40000 ALTER TABLE `trn_store_working` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_working` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_store_working_images`
--

DROP TABLE IF EXISTS `trn_store_working_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_store_working_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `note_id` bigint NOT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_store_working_images`
--

LOCK TABLES `trn_store_working_images` WRITE;
/*!40000 ALTER TABLE `trn_store_working_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_store_working_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_supplier_delivery`
--

DROP TABLE IF EXISTS `trn_supplier_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_supplier_delivery` (
  `supplier_delivery_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_order_id` bigint NOT NULL,
  `supplier_id` int NOT NULL,
  `pi_no` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `contract_no` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `payment_1_percent` int NOT NULL DEFAULT '40',
  `payment_2_duration` int NOT NULL DEFAULT '45',
  `insurance_cost` decimal(8,2) NOT NULL,
  `delivery_sts` int NOT NULL DEFAULT '0',
  `volume` decimal(19,2) DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
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
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_supplier_delivery`
--

LOCK TABLES `trn_supplier_delivery` WRITE;
/*!40000 ALTER TABLE `trn_supplier_delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_supplier_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_supplier_delivery_detail`
--

DROP TABLE IF EXISTS `trn_supplier_delivery_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_supplier_delivery_detail` (
  `supplier_delivery_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `price_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `duty_tax` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_delivery_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_supplier_delivery_detail`
--

LOCK TABLES `trn_supplier_delivery_detail` WRITE;
/*!40000 ALTER TABLE `trn_supplier_delivery_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_supplier_delivery_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_supplier_order`
--

DROP TABLE IF EXISTS `trn_supplier_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_supplier_order` (
  `supplier_order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `order_date` date DEFAULT NULL,
  `send_po_date` date DEFAULT NULL,
  `total` decimal(19,2) NOT NULL,
  `total_vi` decimal(19,2) NOT NULL,
  `volume` decimal(19,2) NOT NULL,
  `rate` double NOT NULL DEFAULT '1',
  `order_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `pi_no` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_supplier_order`
--

LOCK TABLES `trn_supplier_order` WRITE;
/*!40000 ALTER TABLE `trn_supplier_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_supplier_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_supplier_order_detail`
--

DROP TABLE IF EXISTS `trn_supplier_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_supplier_order_detail` (
  `supplier_order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `price_vi` decimal(19,2) NOT NULL DEFAULT '0.00',
  `rate` double NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`supplier_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_supplier_order_detail`
--

LOCK TABLES `trn_supplier_order_detail` WRITE;
/*!40000 ALTER TABLE `trn_supplier_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_supplier_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_task_user`
--

DROP TABLE IF EXISTS `trn_task_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_task_user` (
  `task_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_group_id` int NOT NULL,
  `user_id` int NOT NULL,
  `task_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `task_content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `task_sts` int NOT NULL DEFAULT '0',
  `task_score` int NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `submit_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `response_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `task_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_task_user`
--

LOCK TABLES `trn_task_user` WRITE;
/*!40000 ALTER TABLE `trn_task_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_task_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_user_last_pos`
--

DROP TABLE IF EXISTS `trn_user_last_pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_user_last_pos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `track_time` datetime NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_user_last_pos`
--

LOCK TABLES `trn_user_last_pos` WRITE;
/*!40000 ALTER TABLE `trn_user_last_pos` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_user_last_pos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_user_pos_his`
--

DROP TABLE IF EXISTS `trn_user_pos_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_user_pos_his` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `track_time` datetime NOT NULL,
  `gps_lat` double NOT NULL DEFAULT '0',
  `gps_long` double NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trn_user_pos_his_user_id_track_time_unique` (`user_id`,`track_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_user_pos_his`
--

LOCK TABLES `trn_user_pos_his` WRITE;
/*!40000 ALTER TABLE `trn_user_pos_his` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_user_pos_his` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_warehouse_change`
--

DROP TABLE IF EXISTS `trn_warehouse_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_warehouse_change` (
  `warehouse_change_type` int NOT NULL,
  `product_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `changed_date` date NOT NULL,
  `amount` int NOT NULL,
  `supplier_delivery_id` bigint DEFAULT NULL,
  `import_wh_factory_id` bigint DEFAULT NULL,
  `store_delivery_id` bigint DEFAULT NULL,
  `warehouse_exim_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_warehouse_change`
--

LOCK TABLES `trn_warehouse_change` WRITE;
/*!40000 ALTER TABLE `trn_warehouse_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_warehouse_change` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_warehouse_exim`
--

DROP TABLE IF EXISTS `trn_warehouse_exim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_warehouse_exim` (
  `warehouse_exim_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_warehouse_id` bigint NOT NULL,
  `to_warehouse_id` bigint NOT NULL,
  `warehouse_exim_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(19,2) NOT NULL,
  `volume` decimal(8,2) NOT NULL DEFAULT '0.00',
  `carton` decimal(8,2) NOT NULL DEFAULT '0.00',
  `seq_no` int NOT NULL DEFAULT '0',
  `exim_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `cancel_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_exim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_warehouse_exim`
--

LOCK TABLES `trn_warehouse_exim` WRITE;
/*!40000 ALTER TABLE `trn_warehouse_exim` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_warehouse_exim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_warehouse_exim_detail`
--

DROP TABLE IF EXISTS `trn_warehouse_exim_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_warehouse_exim_detail` (
  `warehouse_exim_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_exim_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_warehouse_exim_detail`
--

LOCK TABLES `trn_warehouse_exim_detail` WRITE;
/*!40000 ALTER TABLE `trn_warehouse_exim_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_warehouse_exim_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_web_order`
--

DROP TABLE IF EXISTS `trn_web_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_web_order` (
  `web_order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_web_id` bigint NOT NULL,
  `total` decimal(19,2) NOT NULL DEFAULT '0.00',
  `order_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `notes_cancel` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `salesman_id` int DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`web_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_web_order`
--

LOCK TABLES `trn_web_order` WRITE;
/*!40000 ALTER TABLE `trn_web_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_web_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_web_order_detail`
--

DROP TABLE IF EXISTS `trn_web_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_web_order_detail` (
  `web_order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `seq_no` int NOT NULL DEFAULT '0',
  `amount` int NOT NULL DEFAULT '0',
  `unit_price` decimal(19,2) NOT NULL DEFAULT '0.00',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`web_order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_web_order_detail`
--

LOCK TABLES `trn_web_order_detail` WRITE;
/*!40000 ALTER TABLE `trn_web_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_web_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_wh_product_time`
--

DROP TABLE IF EXISTS `trn_wh_product_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_wh_product_time` (
  `in_date` date NOT NULL,
  `product_id` bigint NOT NULL,
  `amount` int NOT NULL,
  `remain` int NOT NULL,
  `supplier_delivery_id` bigint DEFAULT NULL,
  `soldout_date` date DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  KEY `trn_wh_product_time_in_date_product_id_index` (`in_date`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_wh_product_time`
--

LOCK TABLES `trn_wh_product_time` WRITE;
/*!40000 ALTER TABLE `trn_wh_product_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_wh_product_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_working_hours`
--

DROP TABLE IF EXISTS `trn_working_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_working_hours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `working_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `first_time` time NOT NULL,
  `last_time` time NOT NULL,
  `working_hours` int NOT NULL DEFAULT '0',
  `absent_type` int NOT NULL DEFAULT '0',
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0',
  `holiday_hours` int NOT NULL DEFAULT '0',
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_working_hours`
--

LOCK TABLES `trn_working_hours` WRITE;
/*!40000 ALTER TABLE `trn_working_hours` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_working_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_working_img`
--

DROP TABLE IF EXISTS `trn_working_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_working_img` (
  `working_id` bigint NOT NULL,
  `img_path` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_working_img`
--

LOCK TABLES `trn_working_img` WRITE;
/*!40000 ALTER TABLE `trn_working_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_working_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_zalo_payment_notify`
--

DROP TABLE IF EXISTS `trn_zalo_payment_notify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trn_zalo_payment_notify` (
  `notify_id` bigint NOT NULL AUTO_INCREMENT,
  `payment_id` bigint NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `zalo_sts` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `zalo_notes` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `phone_number` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`notify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_zalo_payment_notify`
--

LOCK TABLES `trn_zalo_payment_notify` WRITE;
/*!40000 ALTER TABLE `trn_zalo_payment_notify` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_zalo_payment_notify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_provider_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email_verification_code` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `count_login_fail` int NOT NULL DEFAULT '0',
  `store_id` bigint DEFAULT NULL,
  `supplier_id` bigint DEFAULT NULL,
  `relation_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'IT - Cuong Nguyen','it@phankhangco.com','$2y$10$IbuYkppG9mOOb1zadhe85uChSndU.MuCM4NWVLqWFnW77xYqGLJLW',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-11-04 15:14:46',0,0),(2,NULL,NULL,'MD - Chien Phan','md@phankhangco.com','$2y$10$WWVn5xLoblyeRqnBBtbvGeyy/cxmkdeJBXBO7JYFFOzdrg6gVGTtG',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2019-06-18 09:40:27',0,0),(3,NULL,NULL,'SH - Anh Phan','sh1@phankhangco.com','$2y$10$bTtS.OWb40dmfU4KqeoBwePRTAI/wcWLo6Ndys2QpwRRbKGVpqdDq',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:35:23',0,0),(4,NULL,NULL,'Admin - Phú Trần','cs_01042021@phankhangco.com','$2y$10$v3Z7d8v28iaZahzfnrEp..1Jbgwwnj/0yH35wPYeGsFvK70GiwieG',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2021-04-05 01:34:29',0,0),(5,NULL,NULL,'Duy Le','it1@phankhangco.com','$2y$10$Dag3p9.fk65AVpXmOuaPBesS5FnqToc7OC6JqfCfi6NnODgSLRpi.',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2021-04-14 14:58:48',0,0),(6,NULL,NULL,'Sale 0','sm_0@phankhangco.com','$2y$10$wLF3pL400PxpeQHe8Csq3.GGzr77LZ/o1aeJA49v3Pn7Id0GSyzC.',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2019-06-18 09:07:20',0,0),(7,NULL,NULL,'Lê Quý Hưng','sales2_delete20170608@phankhangco.com','$2y$10$pd3w0h6nqLBP0nmKd3MsMOD5csw8fo7fTpXYp7YCWrer3OOt22xHi',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2019-06-07 10:50:34',0,0),(8,NULL,NULL,'AC1 - Huyen Nguyen','acct1@phankhangco.com','$2y$10$toso.gSoYOhWd5jr87BLYuRJLJ2IGN6jE0wF676OOXZDhtcmh94Ky',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2019-06-18 09:40:58',0,0),(9,NULL,NULL,'WH - Toàn Võ','whm_leave_07112020@phankhangco.com','$2y$10$xXHjLl7VyrKq5wD8ztNBWuq4yvS9G/2Yy3Hp0JtyCIuuCtGSb7fPK',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-11-09 01:31:58',0,0),(10,NULL,NULL,'Bac A','xuanluongba@yahoo.com.vn','$2y$10$Ond9lWonBgxX9XcrxZuXD.9dhgK/OvDF3xtV6JxYvSRWJfvqrjwWi',NULL,'0',NULL,NULL,NULL,0,1237,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:34:00',0,0),(11,NULL,NULL,'Thai Thinh','trungnguyenngoc88@gmail.com','$2y$10$gm9S8D7vtY3T6ZXDKvC5x.cBSqc8dAWurKKvog0xW.ERKjsuqFIcW',NULL,'0',NULL,NULL,NULL,0,1124,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:34:37',0,0),(12,NULL,NULL,'An Thanh Binh','mactonghi@gmail.com','$2y$10$hZzFg6jjpIYj86SY0Fu7..GCr10NjKC1PnZuPpcI8JsHwMxE1vrga',NULL,'0',NULL,NULL,NULL,0,1231,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:34:17',0,0),(13,NULL,NULL,'Phuong Doan','quocphuongdoan126@gmail.com','$2y$10$plWMHAxWhlwTZKtOBCG8j.KS3TLdG8QjK6pkAh/R/C2cdOAWRlc0G',NULL,'0',NULL,NULL,NULL,0,1232,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:36:03',0,0),(14,NULL,NULL,'Lê Đức Huy','sales3_blocked09032019@phankhangco.com','$2y$10$RZbfNKGJ2.klshRVB4WAyeZto6wljT15p/IJHNwDtT3GCOZQMjXVC',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2019-10-19 22:29:29',0,0),(15,NULL,NULL,'Nguyễn Văn Duy','sales4_block28102018@phankhangco.com','$2y$10$64BFiqbvOqUbiCk76mHDJ.tZhXJRb5ffls3K9ibntNcJG33UFToi.',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:36:34',0,0),(16,NULL,NULL,'Lê Quang Thắng','thang.le_delete20170802@phankhangco.com','$2y$10$hmxk6eVSUeliF5XtU6Zhs.o4V4PQdpEbjn3mK/tQEdcgxxRkBvTea',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-04-02 13:39:32',0,'2020-02-19 14:35:04',0,0),(17,NULL,NULL,'Sale 2','sm@phankhangco.com','$2y$10$q/QadeoJUoDXDUQrhTAm2O8VzMb/dG8wxKm98Rd7LTWpKnHxCvb3u',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-11-04 16:02:49',5,'2020-06-10 01:37:01',5,1),(18,NULL,NULL,'CS2 - Thao (deleted account)','cs2_2@phankhangco.com','$2y$10$msx4UniwZMDZDzBowTDUlO8WcRsSL//Q9QcDvFWBfpv567w9VRpkC',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2017-11-11 12:06:56',5,'2019-10-18 11:00:05',5,1),(19,NULL,NULL,'Quảng Văn Luân (CT)','luanquangct@gmail.com','$2y$10$UVR.uUQP8lSRvIq43KjU3ufUknpwxyO7BqfyQtPrOmi368lApoVMC',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-04-17 08:52:01',5,'2018-08-28 15:43:19',5,1),(20,NULL,NULL,'CS1 - Nguyen Huynh','cs1@phankhangco.com','$2y$10$7gLJfrXo3MWBz8avlX4G9emqaxYSqfhzzIZxDZg7jOElRaXWJPj1a',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-04-24 08:38:37',5,'2019-09-09 11:25:16',5,1),(21,NULL,NULL,'Nguyễn Minh Hiếu','sale2_block28052019@phankhangco.com','$2y$10$41CM5Q9IOr58qjbd07KzA.wMVJA2Lv4vtDylmGHgiw292aEZMIdcy',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-08-21 09:35:27',5,'2019-05-28 21:07:21',5,1),(24,NULL,NULL,'Test','dannyleeeel-delete20210104@gmail.com','$2y$10$0bzYOhKZjHzJEcri/qDOBeyVCb1U1kGqaMpeEvN1se/YZhskyB3je',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-08-21 09:39:47',5,'2021-01-04 05:53:17',5,1),(25,NULL,NULL,'PHR - Giang Lê','huonggiang.3898_01032021@gmail.com','$2y$10$Fy8b9gJRmG.avjhB/0QlP.UIYiyZKQjIkEZdoqHKUdtG66XFftGYm',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-09-23 10:49:29',5,'2022-01-06 02:54:09',5,1),(26,NULL,NULL,'PPUR - Diễm Trương','diem.truongpipu_01042021@hcmut.edu.vn','$2y$10$iv1AplzFg18ePHgkC3i29.2s6FsJOyGh3EOh/BUQPmEH0LhtmJAua',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-10-22 16:26:44',5,'2021-04-06 02:51:48',5,1),(27,NULL,NULL,'PSM - Thảo Lê','customer-service@phankhangco.com','$2y$10$Pk1fOon0zv3COnXdbFy9SeEnV4Xzwd2fRpEgV4Ya3afJ/o8AWwIkW',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-10-28 23:29:13',5,'2021-05-06 04:01:04',5,1),(28,NULL,NULL,'PMKT - Trinh Trần','trinh.trananhtrinh33_01042021@hcmut.edu.vn','$2y$10$o9qHJz0TLDEFPLuHMNOqYul/P1WAlaspK6wHtXFWwHFho7czQHVRu',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2018-12-23 10:14:50',1,'2021-04-06 02:52:03',1,1),(29,NULL,NULL,'PSM - Vĩnh Trần','vinh.tranhoang_19102020@hcmut.edu.vn','$2y$10$/qHDiGFzQsD/ui6XwHfZYeZTR5vNTahlRip/sYOVK94.o/yikveNy',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-03-20 10:12:02',5,'2020-10-20 01:35:41',5,1),(30,NULL,NULL,'SM2 - Vinh Vo','sm2@phankhangco.com','$2y$10$m4FWZLxlODNcP4ZPgP4eC.JNJMFQhhxkm/aw.gDOr9M6pG10UFfba',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-05-06 10:28:37',5,'2022-04-26 09:36:58',5,1),(31,NULL,NULL,'Ecommerce - Linh Trần','sm1_cancel@phankhangco.com','$2y$10$lxKkW5sY4TQ6q5178r3Ngu6NV0oku/pH6XxJpnu.0masfzPcfPCt6',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-05-06 10:29:11',5,'2022-05-06 03:01:30',5,1),(32,NULL,NULL,'SM4 - Nghia Nguyen','sm4@phankhangco.com','$2y$10$ZzRHME1soBjalMdg5klNzO/WWCSHHuZUueBI3HpFsqiSbqHWqqfbq',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-05-06 10:29:42',5,'2022-05-04 07:41:07',5,1),(33,NULL,NULL,'SM3 - Nguyen Huynh','sm3@phankhangco.com','$2y$10$KZJ.d1VU/lbhRHQX59p4y.MZuEy.NGO3fN941zG3wUB1vUuQm19VC',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-06-07 10:34:22',1,'2021-12-02 08:18:49',1,1),(34,NULL,NULL,'ACT -  Đan Phạm','acct_delete20220505@phankhangco.com','$2y$10$cYTfIiAZwLSpXic1XZ6BHeENHFbxZYZeDhpcdV0qj4NnGoxJ5DU8q',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-06-07 10:59:22',1,'2022-06-03 03:23:47',1,1),(35,NULL,NULL,'PMKT - Đạt Nguyễn','mkt@phankhangco.com','$2y$10$S9TBfixwJXgE/JdzLNz6zetMoqOvpnC30lMfxR6Q9OWLQWgf/B1ii',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2019-09-09 11:32:59',5,'2020-12-22 01:32:00',5,1),(36,NULL,NULL,'PHR- Hiển Nguyễn','hr_01032021@phankhangco.com','$2y$10$I5qne2URDjTX7gbyPjibteQ6cCBgJlw3BtrirSeBj9G9ltILn5taG',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-04-03 10:48:07',5,'2021-04-05 01:42:08',5,1),(39,NULL,NULL,'MKT - Thắng Đặng','mkt0_050421@phankhangco.com','$2y$10$8nfmzLrgmK0NH6YrRjnx3uMEdbbrAxbLiFjX6IL3v3/HCwJsXrMva',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-06-12 03:25:53',5,'2021-04-29 02:42:09',5,1),(40,NULL,NULL,'IA - Tín Lê','ia1@phankhangco.com','$2y$10$DsvbrT5Pjcn0Ia88ZEsqQuEWrif/1LykKbK9XSDr1NjSMa0CM6iVq',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-06-22 03:05:20',5,'2022-04-29 04:15:12',5,1),(41,NULL,NULL,'SM1- Hậu Lê','sm1@phankhangco.com','$2y$10$FGn5EOKVYo3HLOdAaqpwO.oCU6hVUKqa1fsdjFbSmvWY05NZBYh2y',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-09 06:39:32',5,'2021-01-11 02:20:05',5,1),(42,NULL,NULL,'Desinger - Nhat Hoang','hoangnhat110897_010421@gmail.com','$2y$10$az8B9QZgXAfBWhn67PKS0ewTqNlNlTt9p65zoeYnQJ0BRBOMz3XN6',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-09 06:42:24',5,'2021-04-29 02:41:45',5,1),(43,NULL,NULL,'Thong Tran','thongtv96_010121@gmail.com','$2y$10$qE.r.2pI1enjQBkwsdC/lOFXXwZ5srrYbbaXKOOzcVNXS7/9V4IYK',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-19 02:37:27',1,'2021-04-29 02:45:40',1,1),(44,NULL,NULL,'Hoang Thao','hoangthao2942000_01042021@gmail.com','$2y$10$rdfV1pYNQWqWQpBLlEDYpe3SNDCqKw7IG/jFUH6CZJNQ9l/896ubu',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-21 02:47:56',5,'2021-04-06 02:52:55',5,1),(45,NULL,NULL,'Quyen Pham','quyenpp99_280421@gmail.com','$2y$10$J9imYbdAkKyp4LmCHTVqtuKIg66oIItFgcXLUqBpIIUDwWFFTtLBe',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-23 06:36:36',5,'2021-04-29 02:40:23',5,1),(46,NULL,NULL,'Thanh Le','thanhlct81_01042021@gmail.com','$2y$10$70OLbAo2OoFdMZLVK7Djk.yGXsj7Je/jyoLh5UgIRwNuIadqFT1f.',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2020-12-25 07:08:21',5,'2021-04-06 02:53:12',5,1),(47,NULL,NULL,'Trang Nguyen','trangnp99_200421@gmail.com','$2y$10$tzZ6biC7q.NfzCfKiLpfMeGnB1b0hrTjoLFpexO9iBBUar1xk7SBe',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-02-22 02:27:03',5,'2021-04-29 02:40:44',5,1),(48,NULL,NULL,'Miên Trần','whm@phankhangco.com','$2y$10$kLWElgXFNJcBUjIrJZFE4.7EUPBoHQvqZNDNEsOkBAYsDQsOTRPLe',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-03-26 05:50:43',5,'2021-04-06 01:08:29',5,1),(49,NULL,NULL,'Long Thái','cs@phankhangco.com','$2y$10$2VqYR3RIYDQGHg7Q2tHIRe9a99kBJCWTMr.4PmGJbkhIpYKO8AmRu',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-03-26 05:52:02',5,'2021-04-05 04:04:53',5,1),(50,NULL,NULL,'Quân Phan','phantrungquan0101@gmail.com','$2y$10$mfhtqAkDrTgWNX/SZpw3EO.Ssct.I/vWcj50AXW4GGkB1eD1v.292',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-03-26 05:52:44',5,'2021-03-26 07:34:39',5,1),(51,NULL,NULL,'Linh Trần','hr@phankhangco.com','$2y$10$wluxbKkyPiO5uA7T8UKZKuuGIFuVLZJLpHADad9FUVm6KZjtk5RKi',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-04-05 01:43:56',5,'2022-06-04 09:57:52',5,1),(52,NULL,NULL,'Trăm Nguyễn','acct2@phankhangco.com','$2y$10$SsKLw3XaQcsh35nFWj1BtOS3zeOdKsgVcT0Upns7s/66KWGEMK3.C',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-04-16 08:34:32',5,'2021-04-16 08:34:47',5,1),(53,NULL,NULL,'Vy Lâm','sm5@phankhangco.com','$2y$10$mx8p/1/LKlEqkv5PwtCtmetpulcLtuTaoru6iFZ/Jw8YoYeaoshGC',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-05-18 04:16:52',5,'2021-05-18 04:42:16',5,1),(54,NULL,NULL,'Uyên Lê','da@phankhangco.com','$2y$10$RYGmoa1HE..T8N8Pbe7DrOoRV7roUBTgKUDmYpZMwiCfIYmDSjNt2',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-06-09 09:11:41',5,'2021-08-18 13:03:37',5,1),(55,NULL,NULL,'IT - Phu','it2@phankhangco.com','$2y$10$ZcRsSjmJK/oJA2pwV4XtVuAtJa4egif69rBFwqkPmH6xx.0KpZ.mq',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2021-12-28 01:56:54',5,'2022-03-30 06:00:45',5,1),(56,NULL,NULL,'Sunny Chau','ca_08032022@phankhangco.com','$2y$10$d8az2sg5Ssv9zLwx/Q5zeOvaV/aKN.1OLI1JIrhMFe74FWkhDtkLW',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2022-01-19 01:49:03',5,'2022-03-08 07:51:56',5,1),(57,NULL,NULL,'Anh Phan','pm@laviedecorco.com','$2y$10$b/cTHGauN6HiW83/U9z1qOgbtmy/k3iTmpaK9p/KNIc8Tv3FpxA/i',NULL,'0',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2022-03-08 07:53:06',5,'2022-03-08 07:53:06',5,1),(58,NULL,NULL,'Sally Thảo','adm@phankhangco.com','$2y$10$jWR84tKvQRdtpHla3bamEuFQK1im90M4Ydf1tShMaHoS9YAbUQUuC',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2022-03-17 05:01:32',5,'2022-03-17 05:03:17',5,1),(60,NULL,NULL,'Sang Phạm','phamsang.eteam@gmail.com','$2y$10$uyRj/erU0/dxW01GpwrxZukdjoP8M2embqgf3Q.ipfXN7JXIr39ka',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,'2022-04-12 14:38:53',5,'2022-04-12 14:39:12',5,1),(61,NULL,NULL,'ACT - Vena','acct@phankhangco.com','$2y$10$CZwezOVvN7eEigqf24hx8.xvSl44JxC4i4iMNu6eDDtX5pOO9Vwku',NULL,'1',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2022-06-03 03:08:44',55,'2022-06-03 03:22:39',55,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_web`
--

DROP TABLE IF EXISTS `users_web`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_web` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `area1` int DEFAULT NULL,
  `area2` int DEFAULT NULL,
  `active_flg` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `version_no` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_web`
--

LOCK TABLES `users_web` WRITE;
/*!40000 ALTER TABLE `users_web` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_web` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_warehouse`
--

DROP TABLE IF EXISTS `v_warehouse`;
/*!50001 DROP VIEW IF EXISTS `v_warehouse`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`user_phuochoang`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_warehouse` AS select `a`.`product_id` AS `product_id`,`a`.`product_code` AS `product_code`,`a`.`product_cat_id` AS `product_cat_id`,`a`.`stock_code` AS `stock_code`,`a`.`name` AS `name`,`a`.`name_origin` AS `name_origin`,`a`.`color` AS `color`,`a`.`standard_packing` AS `standard_packing`,`a`.`selling_price` AS `selling_price`,`b`.`product_cat_code` AS `product_cat_code`,`b`.`name` AS `product_cat_name`,`c`.`supplier_code` AS `supplier_code`,`c`.`name` AS `supplier_name`,(((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) AS `amount`,(((`e`.`length` * `e`.`width`) * `e`.`height`) / 1000000000) AS `volume` from ((((`mst_product` `a` left join `mst_product_cat` `b` on((`a`.`product_cat_id` = `b`.`product_cat_id`))) left join `mst_supplier` `c` on((`a`.`supplier_id` = `c`.`supplier_id`))) join (select `a`.`product_id` AS `product_id`,sum((case when (`a`.`warehouse_change_type` in (1,5,6)) then `a`.`amount` else 0 end)) AS `in_num`,sum((case when (`a`.`warehouse_change_type` = 2) then `a`.`amount` else 0 end)) AS `out_num`,sum((case when (`a`.`warehouse_change_type` = 3) then `a`.`amount` else 0 end)) AS `in_num_edit`,sum((case when (`a`.`warehouse_change_type` = 4) then `a`.`amount` else 0 end)) AS `out_num_edit`,sum((case when (`a`.`warehouse_change_type` = 7) then `a`.`amount` else 0 end)) AS `in_num_warehouse`,sum((case when (`a`.`warehouse_change_type` = 8) then `a`.`amount` else 0 end)) AS `out_num_warehouse` from `trn_warehouse_change` `a` where (`a`.`active_flg` = '1') group by `a`.`product_id`) `d` on((`a`.`product_id` = `d`.`product_id`))) left join `mst_packaging` `e` on((`e`.`packaging_id` = `a`.`packaging_id`))) where ((`a`.`active_flg` = '1') and ((((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) <> 0)) order by (((((`d`.`in_num` + `d`.`in_num_edit`) + `d`.`in_num_warehouse`) - `d`.`out_num`) - `d`.`out_num_edit`) - `d`.`out_num_warehouse`) desc */;
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

-- Dump completed on 2022-07-05 12:51:34
