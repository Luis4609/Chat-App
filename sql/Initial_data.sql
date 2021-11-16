INSERT INTO `Users` ( `UserName`, `UserPassword` ) VALUES
( 'John', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm'),
( 'Alex', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm'),
( 'Pepe', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm'),
( 'Luis', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm');


INSERT INTO `Messages` ( `FromUserId`, `ToUserId`, `Text`, `Timestamp`) VALUES
(1, 3, 'De John a Pepe 1',  '2021-11-07 10:21:21'),
(1, 2, 'De John a Alex 1', '2021-11-07 11:21:21'),
(2, 1, 'Alex-John 1', '2021-11-07 10:21:21'),
(2, 1,'Alex-John 2', '2021-11-07 12:21:21');

INSERT INTO `Messages` ( `FromUserId`, `ToUserId`, `Text`, `Timestamp`) VALUES
(1, 3, 'De John a Pepe 32',  '2021-11-07 10:21:21');