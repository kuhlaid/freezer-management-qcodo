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
-- Table structure for table `fm__type_of_rack`
--

DROP TABLE IF EXISTS `fm__type_of_rack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__type_of_rack` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(145) NOT NULL,
  `width` float(24,0) DEFAULT NULL,
  `height` float(24,0) DEFAULT NULL,
  `depth` float(24,0) DEFAULT NULL,
  `rows` smallint DEFAULT NULL,
  `columns` smallint DEFAULT NULL,
  `box_count` smallint DEFAULT NULL,
  `box_type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__type_of_rack`
--

LOCK TABLES `fm__type_of_rack` WRITE;
/*!40000 ALTER TABLE `fm__type_of_rack` DISABLE KEYS */;
INSERT INTO `fm__type_of_rack` VALUES (1,'Vertically oriented rack for chest freezer',NULL,NULL,5,11,1,11,1),(2,'Deep rack for larger cabinet freezers',26,9,5,4,5,20,1),(3,'Smaller rack for regular size cabinet freezers',22,9,5,4,4,16,1),(4,'Taller rack for larger cabinet freezers ',22,10,5,4,4,16,1),(5,'Vertically oriented rack for chest freezer',NULL,NULL,5,7,1,7,1),(6,'Vertical rack for LN freezer',22,NULL,5,13,1,13,1),(7,'Monovette rack for large cabinet freezer',NULL,NULL,5,2,5,10,3),(8,'Monovette rack for small cabinet freezer',NULL,NULL,NULL,2,4,8,3),(9,'Odd size for larger cabinet freezer',22,9,5,3,4,12,NULL);
/*!40000 ALTER TABLE `fm__type_of_rack` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
