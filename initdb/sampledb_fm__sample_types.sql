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
-- Table structure for table `fm__sample_types`
--

DROP TABLE IF EXISTS `fm__sample_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fm__sample_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `letter` char(1) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Dec. 2012  - changed the W letter to x since I will use W for White Blood Cells and transition the WPPR samples to their specific sample types';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm__sample_types`
--

LOCK TABLES `fm__sample_types` WRITE;
/*!40000 ALTER TABLE `fm__sample_types` DISABLE KEYS */;
INSERT INTO `fm__sample_types` VALUES (1,'S','Serum'),(2,'U','Urine'),(3,'x','WPPR'),(4,'P','Blood (Paxgene tube)'),(5,'D','DNA'),(6,'B','Blood Metals'),(7,'M','Blood (monovette tube)'),(8,'A','Plasma'),(9,'R','Red Blood Cell'),(10,'W','Buffy coat (White Blood Cell)'),(11,'H','Non-hazardous Human Cell Lines'),(12,'Y','Synovial Fluid'),(13,'O','Bone (in 20 ml specimen tube-5672321)'),(14,'C','Cartilage (in 20 ml specimen tube-5672321)'),(15,'E','Stool'),(16,'F','Stool in ethanol');
/*!40000 ALTER TABLE `fm__sample_types` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
