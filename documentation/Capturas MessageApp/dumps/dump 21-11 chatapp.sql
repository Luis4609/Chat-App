-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: chatapp
-- ------------------------------------------------------
-- Server version	8.0.15
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
SET NAMES utf8;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `friends`
--
DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
CREATE TABLE `friends` (
  `UserId` int(10) NOT NULL,
  `UserId2` int(10) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `AreFriend` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`, `UserId2`),
  KEY `UserId2` (`UserId2`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`UserId2`) REFERENCES `users` (`UserId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `friends`
--
LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */
;
INSERT INTO `friends`
VALUES (1, 2, '2021-11-21 11:12:08', 1),
(3, 1, '2021-11-18 23:53:48', 1),
(3, 2, '2021-11-21 12:34:04', 1),
(3, 4, '2021-11-20 21:05:04', 0);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `group_messages`
--
DROP TABLE IF EXISTS `group_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
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
) ENGINE = InnoDB AUTO_INCREMENT = 26 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `group_messages`
--
LOCK TABLES `group_messages` WRITE;
/*!40000 ALTER TABLE `group_messages` DISABLE KEYS */
;
INSERT INTO `group_messages`
VALUES (1, 3, 1, 'hola', '2021-11-10 10:23:21', 0),
(2, 1, 1, 'hola pepe', '2021-11-10 10:23:21', 0),
(3, 2, 1, 'eyyyy pepe', '2021-11-10 10:23:21', 1),
(
    4,
    1,
    1,
    'hola buena a todos, queria comentaros un par de cosas para la siguiente entrega',
    '2021-11-10 11:23:21',
    0
  ),
(
    5,
    3,
    1,
    'ahh me parece bien tu propuesta',
    '2021-11-10 10:23:21',
    0
  ),
(6, 1, 1, 'eyyy', '2021-11-10 10:23:21', 0),
(7, 3, 1, 'jooo', '2021-11-20 19:08:44', 0),
(8, 3, 1, 'holi', '2021-11-20 19:09:01', 0),
(9, 3, 1, 'holiii', '2021-11-20 19:13:04', 0),
(10, 3, 1, 'holiii', '2021-11-20 19:21:52', 0),
(11, 3, 1, 'holii', '2021-11-20 19:22:07', 0),
(12, 1, 1, 'que pasooo', '2021-11-20 19:24:32', 0),
(13, 1, 1, '', '2021-11-20 19:24:59', 1),
(14, 3, 7, 'Hola', '2021-11-20 19:38:50', 0),
(15, 3, 7, 'ey', '2021-11-20 19:39:21', 0),
(
    16,
    3,
    8,
    'Hola Alex, este es un nuevo',
    '2021-11-20 19:39:31',
    0
  ),
(17, 3, 8, '', '2021-11-20 19:39:32', 0),
(
    18,
    3,
    8,
    'Hola Alex, este es un nuevo mensaje de John',
    '2021-11-20 19:39:39',
    0
  ),
(19, 3, 1, 'holiii', '2021-11-20 20:31:50', 0),
(20, 3, 1, 'EYYYYYYY', '2021-11-20 20:31:54', 0),
(21, 3, 1, 'holiii', '2021-11-20 22:40:44', 0),
(
    22,
    3,
    1,
    'Hola Alex, este es un nuevo mensaje de John',
    '2021-11-20 23:31:43',
    1
  ),
(23, 1, 12, 'Hola', '2021-11-21 12:06:19', 0),
(
    24,
    1,
    12,
    'Hola Alex, este es un nuevo mensaje de John',
    '2021-11-21 12:06:23',
    0
  ),
(25, 1, 12, 'Hola', '2021-11-21 12:06:27', 0);
/*!40000 ALTER TABLE `group_messages` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `group_participants`
--
DROP TABLE IF EXISTS `group_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
CREATE TABLE `group_participants` (
  `GroupId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  PRIMARY KEY (`GroupId`, `UserId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `group_participants_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `user_groups` (`GroupId`),
  CONSTRAINT `group_participants_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `group_participants`
--
LOCK TABLES `group_participants` WRITE;
/*!40000 ALTER TABLE `group_participants` DISABLE KEYS */
;
INSERT INTO `group_participants`
VALUES (1, 1),
(10, 1),
(11, 1),
(12, 1),
(1, 2),
(10, 2),
(11, 2),
(12, 2),
(1, 3),
(7, 3),
(8, 3),
(9, 3),
(11, 3),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(6, 17),
(7, 17),
(10, 17),
(11, 17),
(11, 19);
/*!40000 ALTER TABLE `group_participants` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `messages`
--
DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
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
) ENGINE = InnoDB AUTO_INCREMENT = 60 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `messages`
--
LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */
;
INSERT INTO `messages`
VALUES (
    1,
    1,
    3,
    'De John a Pepe 1',
    '2021-11-07 10:21:21',
    1,
    NULL
  ),
(
    2,
    1,
    2,
    'De John a Alex 1',
    '2021-11-07 11:21:21',
    1,
    NULL
  ),
(3, 2, 1, 'Alex-John 1', '2021-11-07 10:21:21', 1, NULL),
(4, 2, 1, 'Alex-John 2', '2021-11-07 12:21:21', 1, NULL),
(
    5,
    1,
    3,
    'De John a Pepe 32',
    '2021-11-07 10:21:21',
    1,
    NULL
  ),
(6, 1, 2, 'Hola alex', NULL, 0, NULL),
(7, 1, 2, 'Hola alex', '2021-11-07 19:09:57', 1, NULL),
(8, 1, 2, 'Hola alex', '2021-11-07 19:10:01', 0, NULL),
(
    9,
    1,
    2,
    'Hola Alex, como estas',
    '2021-11-07 19:10:06',
    1,
    NULL
  ),
(
    10,
    1,
    2,
    'Hola Alex, como estas',
    '2021-11-07 19:14:49',
    1,
    NULL
  ),
(
    11,
    1,
    2,
    'Hola Alex, este es un nuevo mensaje de John',
    '2021-11-07 20:14:49',
    0,
    NULL
  ),
(
    12,
    1,
    2,
    'Alex te queria preguntar que paso ayer?',
    '2021-11-07 20:15:24',
    0,
    NULL
  ),
(13, 1, 2, 'EYYYYYYY', '2021-11-07 20:16:11', 1, NULL),
(
    14,
    1,
    2,
    'Hola Alex, este es un nuevo mensaje de John 3232323',
    '2021-11-07 20:31:06',
    0,
    NULL
  ),
(
    15,
    1,
    2,
    'NUEVA RESPESTA',
    '2021-11-07 20:31:32',
    0,
    NULL
  ),
(16, 1, 2, 'Hola', '2021-11-07 21:11:41', 0, NULL),
(17, 1, 2, 'Hola', '2021-11-07 21:11:50', 0, NULL),
(18, 1, 3, 'Hola', '2021-11-07 21:12:57', 1, NULL),
(
    19,
    1,
    3,
    'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
    '2021-11-07 21:26:26',
    1,
    NULL
  ),
(21, 1, 2, 'Hola', '2021-11-09 10:50:53', 1, NULL),
(22, 1, 2, 'Hola', '2021-11-09 10:53:02', 0, NULL),
(23, 3, 1, 'Hola', '2021-11-09 12:35:20', 1, NULL),
(
    24,
    3,
    1,
    'Hola John, este es un nuevo mensaje de Pepe',
    '2021-11-09 16:38:56',
    0,
    NULL
  ),
(25, 3, 1, 'Hola', '2021-11-09 16:39:06', 1, NULL),
(
    26,
    3,
    17,
    'Hawoqvneopirquvneproiq ubnvberpioq',
    '2021-11-10 10:16:17',
    1,
    NULL
  ),
(27, 17, 3, 'Hola', '2021-11-10 10:20:50', 1, NULL),
(28, 17, 19, 'Hola', '2021-11-10 10:22:15', 1, NULL),
(
    29,
    19,
    17,
    'Holaaaaaaaaaaaaaa',
    '2021-11-10 10:23:21',
    1,
    NULL
  ),
(
    30,
    17,
    3,
    'oqjvncqepiojbvqelirhvb lekrhwqv elrw',
    '2021-11-17 00:49:06',
    1,
    NULL
  ),
(
    31,
    3,
    17,
    'Hola de nuevo, como estas?',
    '2021-11-18 12:44:55',
    0,
    NULL
  ),
(32, 3, 17, 'EYYYYYYY', '2021-11-18 12:45:58', 1, NULL),
(
    33,
    3,
    1,
    'Hola n1fcopwn',
    '2021-11-18 23:02:18',
    0,
    NULL
  ),
(
    34,
    3,
    1,
    'Hola otra vez',
    '2021-11-18 23:06:32',
    1,
    NULL
  ),
(
    35,
    1,
    2,
    'Hola, mañana hablamos\r\n',
    '2021-11-19 00:17:11',
    1,
    NULL
  ),
(
    36,
    3,
    1,
    'Hola te mando el archivo',
    '2021-11-20 08:01:22',
    1,
    NULL
  ),
(
    37,
    3,
    1,
    'eyyy',
    '2021-11-20 08:10:31',
    1,
    'uploads/Instrucciones_GMI-2020.pdf'
  ),
(
    38,
    3,
    1,
    'foto',
    '2021-11-20 08:10:53',
    1,
    'uploads/Dva x Lucio.jpg'
  ),
(
    39,
    1,
    19,
    'respuesta a pepe',
    '2021-11-20 08:33:56',
    1,
    'uploads/volleyball_silhouettes_sun_146729_1920x1080.jpg'
  ),
(
    40,
    1,
    3,
    'pepeeee',
    '2021-11-20 08:35:34',
    1,
    'uploads/graffiti_3d-wallpaper-1920x1080.jpg'
  ),
(
    41,
    3,
    1,
    'grgerg',
    '2021-11-20 11:37:48',
    1,
    'uploads/yanguang-lan-nPtKc0jqNus-unsplash.jpg'
  ),
(42, 3, 1, 'ey', '2021-11-20 12:17:03', 1, 'uploads/'),
(43, 3, 2, 'hola', '2021-11-20 12:22:59', 1, 'uploads/'),
(
    44,
    1,
    19,
    'holi',
    '2021-11-20 12:28:24',
    1,
    'uploads/'
  ),
(
    45,
    4,
    1,
    'Hola te dejo la img',
    '2021-11-20 13:44:52',
    1,
    'uploads/everything_happens_for_a_reason_2-wallpaper-1920x1080.jpg'
  ),
(
    46,
    4,
    3,
    'ey',
    '2021-11-20 13:51:12',
    1,
    'uploads/Calendario Escolar 2020-21 (Nuevo).pdf'
  ),
(
    47,
    4,
    2,
    'hola',
    '2021-11-20 13:54:56',
    1,
    'uploads/(3) Grid CSS.pdf'
  ),
(48, 3, 1, 'eyyyy', '2021-11-20 14:57:29', 1, ''),
(49, 3, 1, 'holi', '2021-11-20 19:14:08', 1, ''),
(50, 3, 4, 'eyy que paso', '2021-11-20 19:15:37', 1, ''),
(51, 3, 4, 'yes', '2021-11-20 21:55:47', 1, ''),
(
    52,
    3,
    1,
    'ey',
    '2021-11-20 23:29:48',
    1,
    'uploads/(2) Flexbox CSS.pdf'
  ),
(53, 1, 17, 'Hola', '2021-11-21 11:26:24', 1, ''),
(54, 1, 2, 'buenos dias', '2021-11-21 11:27:05', 0, ''),
(55, 1, 7, 'fefeeeee', '2021-11-21 11:27:17', 1, ''),
(
    56,
    1,
    2,
    'hola de nuevo',
    '2021-11-21 11:34:42',
    0,
    ''
  ),
(
    57,
    1,
    2,
    'holi',
    '2021-11-21 11:38:22',
    1,
    'uploads/(1) UD1_USO_DE_ESTILOS.pdf'
  ),
(58, 1, 2, 'holi', '2021-11-21 11:40:12', 0, ''),
(
    59,
    1,
    3,
    'gracias por el archivo pepe',
    '2021-11-21 11:49:34',
    1,
    ''
  );
/*!40000 ALTER TABLE `messages` ENABLE KEYS */
;
UNLOCK TABLES;
DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
CREATE TABLE `user_groups` (
  `GroupId` int(10) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`GroupId`),
  UNIQUE KEY `GroupName_UNIQUE` (`GroupName`)
) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `user_groups`
--
LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */
;
INSERT INTO `user_groups`
VALUES (1, 'Amigos de Pepe'),
(6, 'Amigos de toda la vida'),
(11, 'compañia de pepe'),
(8, 'Fiesta mañana'),
(7, 'Friends'),
(9, 'Hasta mañana'),
(12, 'nuevo grupo'),
(10, 'Pepe and company');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
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
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `users`
--
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */
;
INSERT INTO `users`
VALUES (
    1,
    'jhon@gmail.com',
    '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',
    1,
    'John',
    'Jackson',
    'uploads/yiran-ding-726226-unsplash.jpg',
    0,
    NULL
  ),
(
    2,
    'alex@gmail.com',
    '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',
    1,
    'Alex',
    'Fernandez',
    'uploads/yiran-ding-726226-unsplash.jpg',
    0,
    42
  ),
(
    3,
    'pepe@gmail.com',
    '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',
    1,
    'Pepe',
    'Perez',
    'uploads/abstract_blue_3-wallpaper-1920x1080.jpg',
    0,
    NULL
  ),
(
    4,
    'luis@gmail.com',
    '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',
    1,
    'Luis',
    'Gonzales',
    'uploads/jonatan-pie-589763-unsplash.jpg',
    1,
    35
  ),
(
    5,
    'Jose',
    '$2y$10$FSH5BoOw34ZEf7O2DzrLcO38bSfOBbHnRU4CPBqShWsfiECAiU9Ji',
    1,
    NULL,
    NULL,
    '/Chat-App/assets/icon-usuario.png',
    1,
    NULL
  ),
(
    6,
    'Maria',
    '$2y$10$X5UmPTGeQVD1VNS.TSnU4u88w8tzQbsqv5QyLSmDZWBsQ2VcFrCiq',
    0,
    NULL,
    NULL,
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  ),
(
    7,
    'Diana',
    '$2y$10$XDHx05MW9cBqLSsf3Lr.9O3a8Lzp.T/2JM7C07yeyua4eLnHJe7j2',
    0,
    NULL,
    NULL,
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  ),
(
    10,
    'Antonio',
    '$2y$10$NEPzXs9FXIjaenGTOYroBuXDbpMbCDGcTDhXSNUfiI1jdW2wwuVom',
    0,
    NULL,
    NULL,
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  ),
(
    13,
    'Miguel',
    '$2y$10$8ji6d0TFtcRHz7GWqyUQHeTJxqB7yuFD710WcBAcgQFou2lZEdHYG',
    0,
    NULL,
    NULL,
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  ),
(
    17,
    'shapedlm2020@gmail.com',
    '$2y$10$qvo1yEMNF7i.qBoEUfRQkebmWm5bnpzasaWqLfehRxzwQQB7yQVKO',
    1,
    'Luis',
    'Monzon',
    '/Chat-App/uploads/user_defualt_avatar.jpg',
    0,
    NULL
  ),
(
    19,
    'pepeperez4609@gmail.com',
    '$2y$10$XWatr6wym6Tb0Oq4SWBMseATcBmviLzP0Gthx0oaNDHDp9x44RynS',
    1,
    'Pepe2',
    'Perez',
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  ),
(
    28,
    'shapedheart4609@gmail.com',
    '$2y$10$4AJJsH0gRmAmt7KcRNgJ3uyxo74JQ5xkLEmUEm93rTAsKsTt0D.iu',
    1,
    'Shaped',
    'the best',
    '/Chat-App/assets/icon-usuario.png',
    0,
    NULL
  );
/*!40000 ALTER TABLE `users` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `usertokens`
--
DROP TABLE IF EXISTS `usertokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
SET character_set_client = utf8mb4;
CREATE TABLE `usertokens` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Valid` datetime NOT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `usertokens_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `usertokens`
--
LOCK TABLES `usertokens` WRITE;
/*!40000 ALTER TABLE `usertokens` DISABLE KEYS */
;
INSERT INTO `usertokens`
VALUES (
    1,
    'CIUBQEOVFIUQBEVIOERQBVOIREUBVIEOPRB',
    '2021-11-10 10:21:21'
  ),
(17, 'qnhwvopunvpouewnverq', '2021-11-10 10:21:21'),
(
    19,
    '$2y$10$xrYuyqVBksha472YIktsm.XVcoxGK8ZamRX7CI5isxMfgW6JXylx2',
    '2021-11-10 00:00:00'
  ),
(
    28,
    '$2y$10$jscR2CzW6A4X4NUXJj5.MuixdSuxzyDt.i71eTthz7kh/MGOMiXhq',
    '2021-11-22 13:59:28'
  );
/*!40000 ALTER TABLE `usertokens` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2021-11-21 16:52:03