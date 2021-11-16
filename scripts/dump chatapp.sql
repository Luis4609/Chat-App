-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: chatapp
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `messages` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `FromUserId` int(10) NOT NULL,
  `ToUserId` int(10) NOT NULL,
  `Text` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `IsRead` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MessageId`),
  KEY `FromUserId` (`FromUserId`),
  KEY `ToUserId` (`ToUserId`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`FromUserId`) REFERENCES `users` (`UserId`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ToUserId`) REFERENCES `users` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,3,'De John a Pepe 1','2021-11-07 10:21:21',1),(2,1,2,'De John a Alex 1','2021-11-07 11:21:21',0),(3,2,1,'Alex-John 1','2021-11-07 10:21:21',1),(4,2,1,'Alex-John 2','2021-11-07 12:21:21',1),(5,1,3,'De John a Pepe 32','2021-11-07 10:21:21',1),(6,1,2,'Hola alex',NULL,0),(7,1,2,'Hola alex','2021-11-07 19:09:57',1),(8,1,2,'Hola alex','2021-11-07 19:10:01',0),(9,1,2,'Hola Alex, como estas','2021-11-07 19:10:06',1),(10,1,2,'Hola Alex, como estas','2021-11-07 19:14:49',1),(11,1,2,'Hola Alex, este es un nuevo mensaje de John','2021-11-07 20:14:49',0),(12,1,2,'Alex te queria preguntar que paso ayer?','2021-11-07 20:15:24',0),(13,1,2,'EYYYYYYY','2021-11-07 20:16:11',0),(14,1,2,'Hola Alex, este es un nuevo mensaje de John 3232323','2021-11-07 20:31:06',0),(15,1,2,'NUEVA RESPESTA','2021-11-07 20:31:32',0),(16,1,2,'Hola','2021-11-07 21:11:41',0),(17,1,2,'Hola','2021-11-07 21:11:50',0),(18,1,3,'Hola','2021-11-07 21:12:57',1),(19,1,3,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2021-11-07 21:26:26',1),(21,1,2,'Hola','2021-11-09 10:50:53',0),(22,1,2,'Hola','2021-11-09 10:53:02',0),(23,3,1,'Hola','2021-11-09 12:35:20',0),(24,3,1,'Hola John, este es un nuevo mensaje de Pepe','2021-11-09 16:38:56',0),(25,3,1,'Hola','2021-11-09 16:39:06',0),(26,3,17,'Hawoqvneopirquvneproiqubnvberpioq','2021-11-10 10:16:17',1),(27,17,3,'Hola','2021-11-10 10:20:50',1),(28,17,19,'Hola','2021-11-10 10:22:15',1),(29,19,17,'Holaaaaaaaaaaaaaa','2021-11-10 10:23:21',0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `UserPassword` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `UserFirstName` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `UserLastName` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,NULL,NULL),(2,'Alex','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,NULL,NULL),(3,'pepe@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'Pepe','Perez'),(4,'Luis','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',0,NULL,NULL),(5,'Jose','$2y$10$FSH5BoOw34ZEf7O2DzrLcO38bSfOBbHnRU4CPBqShWsfiECAiU9Ji',0,NULL,NULL),(6,'Maria','$2y$10$X5UmPTGeQVD1VNS.TSnU4u88w8tzQbsqv5QyLSmDZWBsQ2VcFrCiq',0,NULL,NULL),(7,'Diana','$2y$10$XDHx05MW9cBqLSsf3Lr.9O3a8Lzp.T/2JM7C07yeyua4eLnHJe7j2',0,NULL,NULL),(10,'Antonio','$2y$10$NEPzXs9FXIjaenGTOYroBuXDbpMbCDGcTDhXSNUfiI1jdW2wwuVom',0,NULL,NULL),(13,'Miguel','$2y$10$8ji6d0TFtcRHz7GWqyUQHeTJxqB7yuFD710WcBAcgQFou2lZEdHYG',0,NULL,NULL),(17,'shapedlm2020@gmail.com','$2y$10$qvo1yEMNF7i.qBoEUfRQkebmWm5bnpzasaWqLfehRxzwQQB7yQVKO',1,'Luis','Pepe'),(19,'pepeperez4609@gmail.com','$2y$10$XWatr6wym6Tb0Oq4SWBMseATcBmviLzP0Gthx0oaNDHDp9x44RynS',1,'Pepe2','Perez');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertokens`
--

DROP TABLE IF EXISTS `usertokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usertokens` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Valid` datetime NOT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `usertokens_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertokens`
--

LOCK TABLES `usertokens` WRITE;
/*!40000 ALTER TABLE `usertokens` DISABLE KEYS */;
INSERT INTO `usertokens` VALUES (1,'CIUBQEOVFIUQBEVIOERQBVOIREUBVIEOPRB','2021-11-10 10:21:21'),(17,'qnhwvopunvpouewnverq','2021-11-10 10:21:21'),(19,'$2y$10$xrYuyqVBksha472YIktsm.XVcoxGK8ZamRX7CI5isxMfgW6JXylx2','2021-11-10 00:00:00');
/*!40000 ALTER TABLE `usertokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-11 23:00:59
