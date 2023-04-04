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
-- Table structure for table `fm__freezer`
--

DROP TABLE IF EXISTS `fm__freezer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__freezer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `in_use_since` varchar(150) DEFAULT NULL,
  `location` varchar(145) NOT NULL,
  `n_shelves` tinyint unsigned DEFAULT NULL,
  `shelf_cu_in` double DEFAULT NULL,
  `shelf_depth_in` double DEFAULT NULL,
  `shelf_width_in` double DEFAULT NULL,
  `shelf_height_in` double DEFAULT NULL,
  `freezer_type` varchar(50) DEFAULT NULL,
  `ModelNumber` varchar(50) DEFAULT NULL,
  `AssetNumber` varchar(20) DEFAULT NULL,
  `AlarmAccount` varchar(20) DEFAULT NULL,
  `SerialNumber` varchar(50) DEFAULT NULL,
  `InUse` smallint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Stores descriptions and meta data related to the specs on the physical freezers.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__freezer`
--

LOCK TABLES `fm__freezer` WRITE;
/*!40000 ALTER TABLE `fm__freezer` DISABLE KEYS */;
INSERT INTO `fm__freezer` VALUES (1,'Freezer 1','This is our main freezer. Upright freezer with rack size: 22.1 x 9.375 x 5.4 in. (56.1 x 23.9 x 13.7cm).','2023','Main floor',5,1121.8,22.1,32.4,9.375,'cabinet','Frozen250','','','',1);
/*!40000 ALTER TABLE `fm__freezer` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
