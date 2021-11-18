
CREATE TABLE `users` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `UserPassword` varchar(100)  NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `UserFirstName` varchar(100)  DEFAULT NULL,
  `UserLastName` varchar(100)  DEFAULT NULL,
   `UserAvatar` varchar(100) DEFAULT '/Chat-App/assets/icon-usuario.png',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
);
CREATE TABLE `Messages` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `FromUserId` int(10) NOT NULL,
  `ToUserId` int(10) NOT NULL,
  `Text` varchar(1000) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `IsRead` boolean NOT NULL default 0,
    PRIMARY KEY (MessageId),
    FOREIGN KEY (FromUserId) REFERENCES Users(UserId),
	FOREIGN KEY (ToUserId) REFERENCES Users(UserId)
);

DROP TABLE IF EXISTS `usertokens`;
CREATE TABLE `usertokens` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) NOT NULL,
  `Valid` datetime NOT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `usertokens_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
);

CREATE TABLE `friends` (
`FriendsId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `UserId2` int(10) NOT NULL,
    `Timestamp` datetime NOT NULL,
  `AreFriend` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FriendsId`),
   
 FOREIGN KEY (UserId) REFERENCES Users(UserId),
	FOREIGN KEY (Userid2) REFERENCES Users(UserId)
);
 PRIMARY KEY (`UserId`, `UserId2`),

INSERT INTO `users` VALUES (1,'John','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,NULL,NULL),(2,'Alex','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,NULL,NULL),(3,'pepe@gmail.com','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',1,'Pepe','Perez'),(4,'Luis','$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm',0,NULL,NULL),(5,'Jose','$2y$10$FSH5BoOw34ZEf7O2DzrLcO38bSfOBbHnRU4CPBqShWsfiECAiU9Ji',0,NULL,NULL),(6,'Maria','$2y$10$X5UmPTGeQVD1VNS.TSnU4u88w8tzQbsqv5QyLSmDZWBsQ2VcFrCiq',0,NULL,NULL),(7,'Diana','$2y$10$XDHx05MW9cBqLSsf3Lr.9O3a8Lzp.T/2JM7C07yeyua4eLnHJe7j2',0,NULL,NULL),(10,'Antonio','$2y$10$NEPzXs9FXIjaenGTOYroBuXDbpMbCDGcTDhXSNUfiI1jdW2wwuVom',0,NULL,NULL),(13,'Miguel','$2y$10$8ji6d0TFtcRHz7GWqyUQHeTJxqB7yuFD710WcBAcgQFou2lZEdHYG',0,NULL,NULL),(17,'shapedlm2020@gmail.com','$2y$10$qvo1yEMNF7i.qBoEUfRQkebmWm5bnpzasaWqLfehRxzwQQB7yQVKO',1,'Luis','Pepe'),(19,'pepeperez4609@gmail.com','$2y$10$XWatr6wym6Tb0Oq4SWBMseATcBmviLzP0Gthx0oaNDHDp9x44RynS',1,'Pepe2','Perez');
INSERT INTO `messages` VALUES (1,1,3,'De John a Pepe 1','2021-11-07 10:21:21',1),(2,1,2,'De John a Alex 1','2021-11-07 11:21:21',0),(3,2,1,'Alex-John 1','2021-11-07 10:21:21',1),(4,2,1,'Alex-John 2','2021-11-07 12:21:21',1),(5,1,3,'De John a Pepe 32','2021-11-07 10:21:21',1),(6,1,2,'Hola alex',NULL,0),(7,1,2,'Hola alex','2021-11-07 19:09:57',1),(8,1,2,'Hola alex','2021-11-07 19:10:01',0),(9,1,2,'Hola Alex, como estas','2021-11-07 19:10:06',1),(10,1,2,'Hola Alex, como estas','2021-11-07 19:14:49',1),(11,1,2,'Hola Alex, este es un nuevo mensaje de John','2021-11-07 20:14:49',0),(12,1,2,'Alex te queria preguntar que paso ayer?','2021-11-07 20:15:24',0),(13,1,2,'EYYYYYYY','2021-11-07 20:16:11',0),(14,1,2,'Hola Alex, este es un nuevo mensaje de John 3232323','2021-11-07 20:31:06',0),(15,1,2,'NUEVA RESPESTA','2021-11-07 20:31:32',0),(16,1,2,'Hola','2021-11-07 21:11:41',0),(17,1,2,'Hola','2021-11-07 21:11:50',0),(18,1,3,'Hola','2021-11-07 21:12:57',1),(19,1,3,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2021-11-07 21:26:26',1),(21,1,2,'Hola','2021-11-09 10:50:53',0),(22,1,2,'Hola','2021-11-09 10:53:02',0),(23,3,1,'Hola','2021-11-09 12:35:20',0),(24,3,1,'Hola John, este es un nuevo mensaje de Pepe','2021-11-09 16:38:56',0),(25,3,1,'Hola','2021-11-09 16:39:06',0),(26,3,17,'Hawoqvneopirquvneproiqubnvberpioq','2021-11-10 10:16:17',1),(27,17,3,'Hola','2021-11-10 10:20:50',1),(28,17,19,'Hola','2021-11-10 10:22:15',1),(29,19,17,'Holaaaaaaaaaaaaaa','2021-11-10 10:23:21',0);
INSERT INTO `usertokens` VALUES (1,'CIUBQEOVFIUQBEVIOERQBVOIREUBVIEOPRB','2021-11-10 10:21:21'),(17,'qnhwvopunvpouewnverq','2021-11-10 10:21:21'),(19,'$2y$10$xrYuyqVBksha472YIktsm.XVcoxGK8ZamRX7CI5isxMfgW6JXylx2','2021-11-10 00:00:00');