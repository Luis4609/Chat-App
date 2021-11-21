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
-- Table structure for table `group_messages`
--

DROP TABLE IF EXISTS `group_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `group_messages` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `FromUserId` int(10) NOT NULL,
  `ToGroupId` int(10) NOT NULL,
  `Text` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `Timestamp` datetime NOT NULL,
  `IsRead` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MessageId`),
  KEY `FromUserId` (`FromUserId`),
  KEY `ToGroupId` (`ToGroupId`),
  CONSTRAINT `group_messages_ibfk_1` FOREIGN KEY (`FromUserId`) REFERENCES `users` (`UserId`),
  CONSTRAINT `group_messages_ibfk_2` FOREIGN KEY (`ToGroupId`) REFERENCES `user_groups` (`GroupId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_messages`
--

LOCK TABLES `group_messages` WRITE;
/*!40000 ALTER TABLE `group_messages` DISABLE KEYS */;
INSERT INTO `group_messages` VALUES (1,3,1,'hola','2021-11-10 10:23:21',0),(2,1,1,'hola pepe','2021-11-10 10:23:21',0),(3,2,1,'eyyyy pepe','2021-11-10 10:23:21',1),(4,1,1,'hola buena a todos, queria comentaros un par de cosas para la siguiente entrega','2021-11-10 11:23:21',0),(5,3,1,'ahh me parece bien tu propuesta','2021-11-10 10:23:21',0),(6,1,1,'eyyy','2021-11-10 10:23:21',0),(7,3,1,'jooo','2021-11-20 19:08:44',0),(8,3,1,'holi','2021-11-20 19:09:01',0),(9,3,1,'holiii','2021-11-20 19:13:04',0),(10,3,1,'holiii','2021-11-20 19:21:52',0),(11,3,1,'holii','2021-11-20 19:22:07',0),(12,1,1,'que pasooo','2021-11-20 19:24:32',0),(13,1,1,'','2021-11-20 19:24:59',1),(14,3,7,'Hola','2021-11-20 19:38:50',0),(15,3,7,'ey','2021-11-20 19:39:21',0),(16,3,8,'Hola Alex, este es un nuevo','2021-11-20 19:39:31',0),(17,3,8,'','2021-11-20 19:39:32',0),(18,3,8,'Hola Alex, este es un nuevo mensaje de John','2021-11-20 19:39:39',0),(19,3,1,'holiii','2021-11-20 20:31:50',0),(20,3,1,'EYYYYYYY','2021-11-20 20:31:54',0),(21,3,1,'holiii','2021-11-20 22:40:44',0),(22,3,1,'Hola Alex, este es un nuevo mensaje de John','2021-11-20 23:31:43',1),(23,1,12,'Hola','2021-11-21 12:06:19',0),(24,1,12,'Hola Alex, este es un nuevo mensaje de John','2021-11-21 12:06:23',0),(25,1,12,'Hola','2021-11-21 12:06:27',0);
/*!40000 ALTER TABLE `group_messages` ENABLE KEYS */;
UNLOCK TABLES;

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
  `AttachFile` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`MessageId`),
  KEY `FromUserId` (`FromUserId`),
  KEY `ToUserId` (`ToUserId`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`FromUserId`) REFERENCES `users` (`UserId`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ToUserId`) REFERENCES `users` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,3,'De John a Pepe 1','2021-11-07 10:21:21',1,NULL),(2,1,2,'De John a Alex 1','2021-11-07 11:21:21',1,NULL),(3,2,1,'Alex-John 1','2021-11-07 10:21:21',1,NULL),(4,2,1,'Alex-John 2','2021-11-07 12:21:21',1,NULL),(5,1,3,'De John a Pepe 32','2021-11-07 10:21:21',1,NULL),(6,1,2,'Hola alex',NULL,0,NULL),(7,1,2,'Hola alex','2021-11-07 19:09:57',1,NULL),(8,1,2,'Hola alex','2021-11-07 19:10:01',0,NULL),(9,1,2,'Hola Alex, como estas','2021-11-07 19:10:06',1,NULL),(10,1,2,'Hola Alex, como estas','2021-11-07 19:14:49',1,NULL),(11,1,2,'Hola Alex, este es un nuevo mensaje de John','2021-11-07 20:14:49',0,NULL),(12,1,2,'Alex te queria preguntar que paso ayer?','2021-11-07 20:15:24',0,NULL),(13,1,2,'EYYYYYYY','2021-11-07 20:16:11',1,NULL),(14,1,2,'Hola Alex, este es un nuevo mensaje de John 3232323','2021-11-07 20:31:06',0,NULL),(15,1,2,'NUEVA RESPESTA','2021-11-07 20:31:32',0,NULL),(16,1,2,'Hola','2021-11-07 21:11:41',0,NULL),(17,1,2,'Hola','2021-11-07 21:11:50',0,NULL),(18,1,3,'Hola','2021-11-07 21:12:57',1,NULL),(19,1,3,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2021-11-07 21:26:26',1,NULL),(21,1,2,'Hola','2021-11-09 10:50:53',1,NULL),(22,1,2,'Hola','2021-11-09 10:53:02',0,NULL),(23,3,1,'Hola','2021-11-09 12:35:20',1,NULL),(24,3,1,'Hola John, este es un nuevo mensaje de Pepe','2021-11-09 16:38:56',0,NULL),(25,3,1,'Hola','2021-11-09 16:39:06',1,NULL),(26,3,17,'Hawoqvneopirquvneproiq ubnvberpioq','2021-11-10 10:16:17',1,NULL),(27,17,3,'Hola','2021-11-10 10:20:50',1,NULL),(28,17,19,'Hola','2021-11-10 10:22:15',1,NULL),(29,19,17,'Holaaaaaaaaaaaaaa','2021-11-10 10:23:21',1,NULL),(30,17,3,'oqjvncqepiojbvqelirhvb lekrhwqv elrw','2021-11-17 00:49:06',1,NULL),(31,3,17,'Hola de nuevo, como estas?','2021-11-18 12:44:55',0,NULL),(32,3,17,'EYYYYYYY','2021-11-18 12:45:58',1,NULL),(33,3,1,'Hola n1fcopwn','2021-11-18 23:02:18',0,NULL),(34,3,1,'Hola otra vez','2021-11-18 23:06:32',1,NULL),(35,1,2,'Hola, mañana hablamos\r\n','2021-11-19 00:17:11',1,NULL),(36,3,1,'Hola te mando el archivo','2021-11-20 08:01:22',1,NULL),(37,3,1,'eyyy','2021-11-20 08:10:31',1,'uploads/Instrucciones_GMI-2020.pdf'),(38,3,1,'foto','2021-11-20 08:10:53',1,'uploads/Dva x Lucio.jpg'),(39,1,19,'respuesta a pepe','2021-11-20 08:33:56',1,'uploads/volleyball_silhouettes_sun_146729_1920x1080.jpg'),(40,1,3,'pepeeee','2021-11-20 08:35:34',1,'uploads/graffiti_3d-wallpaper-1920x1080.jpg'),(41,3,1,'grgerg','2021-11-20 11:37:48',1,'uploads/yanguang-lan-nPtKc0jqNus-unsplash.jpg'),(42,3,1,'ey','2021-11-20 12:17:03',1,'uploads/'),(43,3,2,'hola','2021-11-20 12:22:59',1,'uploads/'),(44,1,19,'holi','2021-11-20 12:28:24',1,'uploads/'),(45,4,1,'Hola te dejo la img','2021-11-20 13:44:52',1,'uploads/everything_happens_for_a_reason_2-wallpaper-1920x1080.jpg'),(46,4,3,'ey','2021-11-20 13:51:12',1,'uploads/Calendario Escolar 2020-21 (Nuevo).pdf'),(47,4,2,'hola','2021-11-20 13:54:56',1,'uploads/(3) Grid CSS.pdf'),(48,3,1,'eyyyy','2021-11-20 14:57:29',1,''),(49,3,1,'holi','2021-11-20 19:14:08',1,''),(50,3,4,'eyy que paso','2021-11-20 19:15:37',1,''),(51,3,4,'yes','2021-11-20 21:55:47',1,''),(52,3,1,'ey','2021-11-20 23:29:48',1,'uploads/(2) Flexbox CSS.pdf'),(53,1,17,'Hola','2021-11-21 11:26:24',1,''),(54,1,2,'buenos dias','2021-11-21 11:27:05',0,''),(55,1,7,'fefeeeee','2021-11-21 11:27:17',1,''),(56,1,2,'hola de nuevo','2021-11-21 11:34:42',0,''),(57,1,2,'holi','2021-11-21 11:38:22',1,'uploads/(1) UD1_USO_DE_ESTILOS.pdf'),(58,1,2,'holi','2021-11-21 11:40:12',0,''),(59,1,3,'gracias por el archivo pepe','2021-11-21 11:49:34',1,'');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-21 16:54:18
