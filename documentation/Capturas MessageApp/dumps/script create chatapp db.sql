CREATE DATABASE chatapp;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `UserFirstName` varchar(100) DEFAULT NULL,
  `UserLastName` varchar(100) DEFAULT NULL,
  `UserAvatar` varchar(100) DEFAULT '/Chat-App/assets/icon-usuario.png',
  `Age` INT(4) NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
);
DROP TABLE IF EXISTS `usertokens`;
CREATE TABLE `usertokens` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) NOT NULL,
  `Valid` datetime NOT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `usertokens_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
);
DROP TABLE IF EXISTS `Messages`;
CREATE TABLE `Messages` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `FromUserId` int(10) NOT NULL,
  `ToUserId` int(10) NOT NULL,
  `Text` varchar(1000) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `IsRead` boolean NOT NULL default 0,
  `AttachFile` varchar(100),
  PRIMARY KEY (MessageId),
  FOREIGN KEY (FromUserId) REFERENCES Users(UserId),
  FOREIGN KEY (ToUserId) REFERENCES Users(UserId)
);
DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `UserId` int(10) NOT NULL,
  `UserId2` int(10) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `AreFriend` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`, `UserId2`),
  FOREIGN KEY (UserId) REFERENCES Users(UserId),
  FOREIGN KEY (Userid2) REFERENCES Users(UserId)
);
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `GroupId` int(10) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) NOT NULL,
  PRIMARY KEY (`GroupId`),
  UNIQUE KEY `GroupName_UNIQUE` (`GroupName`)
);
DROP TABLE IF EXISTS `group_participants`;
CREATE TABLE `group_participants` (
  `GroupId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  PRIMARY KEY (`GroupId`, `UserId`),
  FOREIGN KEY (GroupId) REFERENCES user_groups(GroupId),
  FOREIGN KEY (Userid) REFERENCES Users(UserId)
);
DROP TABLE IF EXISTS `group_messages`;
CREATE TABLE `group_messages` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `FromUserId` int(10) NOT NULL,
  `ToGroupId` int(10) NOT NULL,
  `Text` varchar(1000) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `IsRead` boolean NOT NULL default 0,
  PRIMARY KEY (MessageId),
  FOREIGN KEY (FromUserId) REFERENCES Users(UserId),
  FOREIGN KEY (ToGroupId) REFERENCES user_groups(GroupId)
);