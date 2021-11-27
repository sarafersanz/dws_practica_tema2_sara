CREATE DATABASE  IF NOT EXISTS `studium_dws_p2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `studium_dws_p2`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: studium_dws_p2
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `juguetes`
--

DROP TABLE IF EXISTS `juguetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `juguetes` (
  `id_juguete` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `id_reymago` int NOT NULL,
  PRIMARY KEY (`id_juguete`),
  KEY `id_rey_magoFK` (`id_reymago`),
  CONSTRAINT `juguetes_ibfk_1` FOREIGN KEY (`id_reymago`) REFERENCES `reyesmagos` (`id_reymago`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juguetes`
--

LOCK TABLES `juguetes` WRITE;
/*!40000 ALTER TABLE `juguetes` DISABLE KEYS */;
INSERT INTO `juguetes` VALUES (1,'Aula de ciencia: Robot Mini ERP',159.95,1),(2,'Carbón',0.00,2),(3,'Cochecito Classic',99.95,3),(4,'Consola PS4 1 TB',349.90,1),(5,'Lego Villa familiar modular',64.99,2),(6,'Magia Borrás Clásica 150 trucos con luz	',32.95,3),(7,'Meccano Excavadora construcción',30.99,1),(8,'Nenuco Hace pompas',29.95,2),(9,'Peluche delfín rosa',34.00,1),(10,'Pequeordenador',22.95,2),(11,'Robot Coji',69.95,3),(12,'Telescopio astronómico terrestre',72.00,1),(13,'Twister',17.95,2);
/*!40000 ALTER TABLE `juguetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninos`
--

DROP TABLE IF EXISTS `ninos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ninos` (
  `id_nino` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `bueno` tinyint NOT NULL,
  PRIMARY KEY (`id_nino`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninos`
--

LOCK TABLES `ninos` WRITE;
/*!40000 ALTER TABLE `ninos` DISABLE KEYS */;
INSERT INTO `ninos` VALUES (1,'Alberto','Alcántara','1994-10-13',0),(2,'Beatriz','Bueno','1982-04-18',1),(3,'Carlos','Crepo','1998-12-01',1),(4,'Diana','Domínguez','1987-09-01',0),(5,'Emilio','Enamorado','1996-08-12',1),(6,'Francisca','Fernández','1990-07-28',1);
/*!40000 ALTER TABLE `ninos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibidos`
--

DROP TABLE IF EXISTS `recibidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibidos` (
  `id_recibido` int NOT NULL AUTO_INCREMENT,
  `id_nino` int NOT NULL,
  `id_juguete` int NOT NULL,
  PRIMARY KEY (`id_recibido`),
  KEY `id_juguete` (`id_juguete`) USING BTREE,
  KEY `id_nino` (`id_nino`) USING BTREE,
  CONSTRAINT `recibidos_ibfk_1` FOREIGN KEY (`id_juguete`) REFERENCES `juguetes` (`id_juguete`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recibidos_ibfk_2` FOREIGN KEY (`id_nino`) REFERENCES `ninos` (`id_nino`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibidos`
--

LOCK TABLES `recibidos` WRITE;
/*!40000 ALTER TABLE `recibidos` DISABLE KEYS */;
INSERT INTO `recibidos` VALUES (1,1,1),(2,2,3),(3,1,4);
/*!40000 ALTER TABLE `recibidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reyesmagos`
--

DROP TABLE IF EXISTS `reyesmagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reyesmagos` (
  `id_reymago` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `gastototal` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id_reymago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reyesmagos`
--

LOCK TABLES `reyesmagos` WRITE;
/*!40000 ALTER TABLE `reyesmagos` DISABLE KEYS */;
INSERT INTO `reyesmagos` VALUES (1,'Melchor',NULL),(2,'Gaspar',NULL),(3,'Balstasar',NULL);
/*!40000 ALTER TABLE `reyesmagos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-27 13:58:05
