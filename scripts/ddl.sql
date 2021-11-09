CREATE TABLE `Users` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
    PRIMARY KEY (UserId)
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
) ;
