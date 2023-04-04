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
-- Table structure for table `fm__box`
--

DROP TABLE IF EXISTS `fm__box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__box` (
  `name` varchar(216) DEFAULT NULL,
  `rack_id` int DEFAULT NULL,
  `shelf` int DEFAULT NULL,
  `freezer` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `issues` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `box_type_id` int DEFAULT NULL,
  `sample_type_id` int DEFAULT NULL,
  `created` datetime(6) DEFAULT NULL,
  `prepared_by_id` int DEFAULT NULL,
  `complete` tinyint(1) DEFAULT NULL,
  `clinic_shipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_type_of_box` (`box_type_id`),
  KEY `FK_sample_types` (`sample_type_id`),
  KEY `FK_clinic_shipment` (`clinic_shipment_id`),
  KEY `FK_rack` (`rack_id`),
  CONSTRAINT `FK_clinic_shipment` FOREIGN KEY (`clinic_shipment_id`) REFERENCES `fm__clinic_shipment` (`id`),
  CONSTRAINT `FK_rack` FOREIGN KEY (`rack_id`) REFERENCES `fm__rack` (`id`),
  CONSTRAINT `FK_sample_types` FOREIGN KEY (`sample_type_id`) REFERENCES `fm__sample_types` (`id`),
  CONSTRAINT `FK_type_of_box` FOREIGN KEY (`box_type_id`) REFERENCES `fm__type_of_box` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__box`
--

LOCK TABLES `fm__box` WRITE;
/*!40000 ALTER TABLE `fm__box` DISABLE KEYS */;
INSERT INTO `fm__box` VALUES ('samplebox1',NULL,2,1,1,'','Placeholder box so feel free to edit the specs.',1,1,'2023-04-03 15:37:09.000000',NULL,0,NULL),('samplebox2',1,1,1,2,'This box needs to be moved to rack.','Placeholder box 2 so feel free to edit the specs. This is an example of a free floating box not stored in a rack.',1,1,'2023-04-03 15:37:48.000000',NULL,0,NULL);
/*!40000 ALTER TABLE `fm__box` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
