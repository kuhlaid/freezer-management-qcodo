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
-- Table structure for table `fm__sample`
--

DROP TABLE IF EXISTS `fm__sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__sample` (
  `id` int NOT NULL AUTO_INCREMENT,
  `study_type_id` int DEFAULT NULL,
  `participant_id` int DEFAULT NULL,
  `sample_type_id` int DEFAULT NULL,
  `sample_number` int DEFAULT NULL,
  `barcode` varchar(16) DEFAULT NULL,
  `study_case` varchar(25) DEFAULT NULL,
  `sampleloc` varchar(5) DEFAULT NULL,
  `box_id` int DEFAULT NULL,
  `notes` varchar(3000) DEFAULT NULL,
  `box_sample_slot` smallint DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `volumeUnit` varchar(10) DEFAULT NULL,
  `concentration` double DEFAULT NULL,
  `concentrationUnit` varchar(10) DEFAULT NULL,
  `state_date` datetime(6) DEFAULT NULL,
  `container_type_id` int DEFAULT NULL,
  `state_type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sample_state_idx` (`state_type_id`),
  KEY `FK_sample_study_type_idx` (`study_type_id`),
  KEY `FK_sample_type_idx` (`sample_type_id`),
  KEY `FK_sample_cont_type_idx` (`container_type_id`),
  KEY `FK_sample_box_idx` (`box_id`),
  CONSTRAINT `FK_sample_box` FOREIGN KEY (`box_id`) REFERENCES `fm__box` (`id`),
  CONSTRAINT `FK_sample_cont_type` FOREIGN KEY (`container_type_id`) REFERENCES `fm__sample_container_types` (`id`),
  CONSTRAINT `FK_sample_state` FOREIGN KEY (`state_type_id`) REFERENCES `fm__sample_state_types` (`id`),
  CONSTRAINT `FK_sample_study_type` FOREIGN KEY (`study_type_id`) REFERENCES `fm__study` (`id`),
  CONSTRAINT `FK_sample_type` FOREIGN KEY (`sample_type_id`) REFERENCES `fm__sample_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__sample`
--

LOCK TABLES `fm__sample` WRITE;
/*!40000 ALTER TABLE `fm__sample` DISABLE KEYS */;
INSERT INTO `fm__sample` VALUES (1,1,NULL,1,1,'3009844','3009',NULL,2,'test sample',1,NULL,NULL,'',NULL,'',NULL,NULL,1);
/*!40000 ALTER TABLE `fm__sample` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
