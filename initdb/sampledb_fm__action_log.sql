CREATE DATABASE  IF NOT EXISTS `sampledb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sampledb`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sampledb
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fm__action_log`
--

DROP TABLE IF EXISTS `fm__action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__action_log` (
  `Id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `JsonData` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Information about the action',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Logs actions taken on samples';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__action_log`
--

LOCK TABLES `fm__action_log` WRITE;
/*!40000 ALTER TABLE `fm__action_log` DISABLE KEYS */;
INSERT INTO `fm__action_log` VALUES (1,'{\"name\":\"20230401\",\"rack_type_id\":3,\"shelf\":1,\"freezer\":19,\"id\":null,\"notes\":\"This is a placeholder rack for demonstration. Feel free to edit the specs.\",\"LogDate\":\"Apr 03 2023 02:50 PM\",\"Action\":7}'),(2,'{\"name\":\"samplebox1\",\"rack_id\":298,\"shelf\":1,\"freezer\":19,\"id\":null,\"issues\":\"\",\"description\":\"Placeholder box so feel free to edit the specs.\",\"box_type_id\":1,\"sample_type_id\":1,\"created\":{\"date\":\"2023-04-03 15:37:09.392203\",\"timezone_type\":3,\"timezone\":\"America\\/New_York\"},\"prepared_by_id\":\"\",\"complete\":\"\",\"clinic_shipment_id\":\"\",\"LogDate\":\"Apr 03 2023 03:37 PM\",\"Action\":2}'),(3,'{\"name\":\"samplebox2\",\"rack_id\":null,\"shelf\":2,\"freezer\":19,\"id\":null,\"issues\":\"\",\"description\":\"Placeholder box 2 so feel free to edit the specs.\",\"box_type_id\":1,\"sample_type_id\":1,\"created\":{\"date\":\"2023-04-03 15:37:48.146419\",\"timezone_type\":3,\"timezone\":\"America\\/New_York\"},\"prepared_by_id\":\"\",\"complete\":\"\",\"clinic_shipment_id\":\"\",\"LogDate\":\"Apr 03 2023 03:37 PM\",\"Action\":2}'),(4,'{\"name\":\"samplebox2\",\"rack_id\":null,\"shelf\":2,\"freezer\":19,\"id\":3393,\"issues\":\"\",\"description\":\"Placeholder box 2 so feel free to edit the specs.\",\"box_type_id\":1,\"sample_type_id\":1,\"created\":{\"date\":\"2023-04-03 15:37:48.000000\",\"timezone_type\":1,\"timezone\":\"-04:00\"},\"prepared_by_id\":\"\",\"complete\":\"\",\"clinic_shipment_id\":\"\",\"LogDate\":\"Apr 03 2023 03:38 PM\",\"Action\":1}'),(5,'{\"name\":\"\",\"study_type_id\":1,\"sample_type_id\":1,\"sample_number\":null,\"id\":319050,\"barcode\":\"1234009\",\"study_case\":\"\",\"box_id\":3393,\"box_sample_slot\":1,\"notes\":\"\",\"LogDate\":\"Apr 04 2023 02:15 PM\",\"Action\":5}'),(6,'{\"name\":\"\",\"study_type_id\":1,\"sample_type_id\":1,\"sample_number\":null,\"id\":319050,\"barcode\":\"1234009\",\"study_case\":\"345\",\"box_id\":3393,\"box_sample_slot\":1,\"notes\":\"\",\"LogDate\":\"Apr 04 2023 02:15 PM\",\"Action\":5}'),(7,'{\"name\":\"\",\"study_type_id\":1,\"sample_type_id\":1,\"sample_number\":null,\"id\":319050,\"barcode\":\"1234009\",\"study_case\":\"345\",\"box_id\":3393,\"box_sample_slot\":1,\"notes\":\"\",\"LogDate\":\"Apr 04 2023 03:12 PM\",\"Action\":5}'),(8,'{\"name\":\"samplebox2\",\"rack_id\":null,\"shelf\":2,\"freezer\":19,\"id\":2,\"issues\":\"This box needs to be moved to rack.\",\"description\":\"Placeholder box 2 so feel free to edit the specs. This is an example of a free floating box not stored in a rack.\",\"box_type_id\":1,\"sample_type_id\":1,\"created\":{\"date\":\"2023-04-03 15:37:48.000000\",\"timezone_type\":1,\"timezone\":\"-04:00\"},\"prepared_by_id\":\"\",\"complete\":\"\",\"clinic_shipment_id\":\"\",\"LogDate\":\"Apr 04 2023 05:07 PM\",\"Action\":1}'),(9,'{\"name\":\"samplebox1\",\"rack_id\":298,\"shelf\":1,\"freezer\":19,\"id\":1,\"issues\":\"\",\"description\":\"Placeholder box so feel free to edit the specs.\",\"box_type_id\":1,\"sample_type_id\":1,\"created\":{\"date\":\"2023-04-03 15:37:09.000000\",\"timezone_type\":1,\"timezone\":\"-04:00\"},\"prepared_by_id\":\"\",\"complete\":\"\",\"clinic_shipment_id\":\"\",\"LogDate\":\"Apr 04 2023 05:08 PM\",\"Action\":1}'),(10,'{\"name\":\"\",\"study_type_id\":1,\"sample_type_id\":1,\"sample_number\":1,\"id\":1,\"barcode\":\"3009844\",\"study_case\":\"3009\",\"box_id\":2,\"box_sample_slot\":1,\"notes\":\"test sample\",\"LogDate\":\"Apr 04 2023 05:09 PM\",\"Action\":5}');
/*!40000 ALTER TABLE `fm__action_log` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
