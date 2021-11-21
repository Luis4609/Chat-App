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
  `UserAvatar` varchar(100) COLLATE utf8_spanish_ci DEFAULT '/Chat-App/assets/icon-usuario.png',
  `Role` tinyint(4) NOT NULL DEFAULT '0',
  `Age` int(4) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jhon@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'John','Jackson','uploads/yiran-ding-726226-unsplash.jpg',0,NULL),(2,'alex@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'Alex','Fernandez','uploads/yiran-ding-726226-unsplash.jpg',0,42),(3,'pepe@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'Pepe','Perez','uploads/abstract_blue_3-wallpaper-1920x1080.jpg',0,NULL),(4,'luis@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'Luis','Gonzales','uploads/jonatan-pie-589763-unsplash.jpg',1,35),(5,'Jose','$2y$10$FSH5BoOw34ZEf7O2DzrLcO38bSfOBbHnRU4CPBqShWsfiECAiU9Ji',1,NULL,NULL,'/Chat-App/assets/icon-usuario.png',1,NULL),(6,'Maria','$2y$10$X5UmPTGeQVD1VNS.TSnU4u88w8tzQbsqv5QyLSmDZWBsQ2VcFrCiq',0,NULL,NULL,'/Chat-App/assets/icon-usuario.png',0,NULL),(7,'Diana','$2y$10$XDHx05MW9cBqLSsf3Lr.9O3a8Lzp.T/2JM7C07yeyua4eLnHJe7j2',0,NULL,NULL,'/Chat-App/assets/icon-usuario.png',0,NULL),(10,'Antonio','$2y$10$NEPzXs9FXIjaenGTOYroBuXDbpMbCDGcTDhXSNUfiI1jdW2wwuVom',0,NULL,NULL,'/Chat-App/assets/icon-usuario.png',0,NULL),(13,'Miguel','$2y$10$8ji6d0TFtcRHz7GWqyUQHeTJxqB7yuFD710WcBAcgQFou2lZEdHYG',0,NULL,NULL,'/Chat-App/assets/icon-usuario.png',0,NULL),(17,'shapedlm2020@gmail.com','$2y$10$qvo1yEMNF7i.qBoEUfRQkebmWm5bnpzasaWqLfehRxzwQQB7yQVKO',1,'Luis','Monzon','/Chat-App/uploads/user_defualt_avatar.jpg',0,NULL),(19,'pepeperez4609@gmail.com','$2y$10$XWatr6wym6Tb0Oq4SWBMseATcBmviLzP0Gthx0oaNDHDp9x44RynS',1,'Pepe2','Perez','/Chat-App/assets/icon-usuario.png',0,NULL),(28,'shapedheart4609@gmail.com','$2y$10$4AJJsH0gRmAmt7KcRNgJ3uyxo74JQ5xkLEmUEm93rTAsKsTt0D.iu',1,'Shaped','the best','/Chat-App/assets/icon-usuario.png',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-21 16:54:04
