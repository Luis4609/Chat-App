-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2021 a las 17:35:50
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chatapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friends`
--

CREATE TABLE `friends` (
  `FriendsId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `UserId2` int(10) NOT NULL,
  `Timestamp` datetime NOT NULL,
  `AreFriend` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `friends`
--

INSERT INTO `friends` (`FriendsId`, `UserId`, `UserId2`, `Timestamp`, `AreFriend`) VALUES
(1, 3, 17, '2021-11-18 15:59:54', 1),
(2, 1, 17, '2021-11-18 16:07:01', 1),
(3, 17, 2, '2021-11-18 16:09:22', 1),
(4, 1, 3, '2021-11-18 16:11:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `MessageId` int(10) NOT NULL,
  `FromUserId` int(10) NOT NULL,
  `ToUserId` int(10) NOT NULL,
  `Text` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `Timestamp` datetime NOT NULL,
  `IsRead` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`MessageId`, `FromUserId`, `ToUserId`, `Text`, `Timestamp`, `IsRead`) VALUES
(1, 1, 3, 'De John a Pepe 1', '2021-11-07 10:21:21', 1),
(2, 1, 2, 'De John a Alex 1', '2021-11-07 11:21:21', 0),
(3, 2, 1, 'Alex-John 1', '2021-11-07 10:21:21', 1),
(4, 2, 1, 'Alex-John 2', '2021-11-07 12:21:21', 1),
(5, 1, 3, 'De John a Pepe 32', '2021-11-07 10:21:21', 1),
(6, 1, 2, 'Hola alex', '0000-00-00 00:00:00', 0),
(7, 1, 2, 'Hola alex', '2021-11-07 19:09:57', 1),
(8, 1, 2, 'Hola alex', '2021-11-07 19:10:01', 0),
(9, 1, 2, 'Hola Alex, como estas', '2021-11-07 19:10:06', 1),
(10, 1, 2, 'Hola Alex, como estas', '2021-11-07 19:14:49', 1),
(11, 1, 2, 'Hola Alex, este es un nuevo mensaje de John', '2021-11-07 20:14:49', 0),
(12, 1, 2, 'Alex te queria preguntar que paso ayer?', '2021-11-07 20:15:24', 0),
(13, 1, 2, 'EYYYYYYY', '2021-11-07 20:16:11', 0),
(14, 1, 2, 'Hola Alex, este es un nuevo mensaje de John 3232323', '2021-11-07 20:31:06', 0),
(15, 1, 2, 'NUEVA RESPESTA', '2021-11-07 20:31:32', 0),
(16, 1, 2, 'Hola', '2021-11-07 21:11:41', 0),
(17, 1, 2, 'Hola', '2021-11-07 21:11:50', 0),
(18, 1, 3, 'Hola', '2021-11-07 21:12:57', 1),
(19, 1, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-11-07 21:26:26', 1),
(21, 1, 2, 'Hola', '2021-11-09 10:50:53', 0),
(22, 1, 2, 'Hola', '2021-11-09 10:53:02', 0),
(23, 3, 1, 'Hola', '2021-11-09 12:35:20', 0),
(24, 3, 1, 'Hola John, este es un nuevo mensaje de Pepe', '2021-11-09 16:38:56', 0),
(25, 3, 1, 'Hola', '2021-11-09 16:39:06', 0),
(26, 3, 17, 'Hawoqvneopirquvneproiqubnvberpioq', '2021-11-10 10:16:17', 1),
(27, 17, 3, 'Hola', '2021-11-10 10:20:50', 1),
(28, 17, 19, 'Hola', '2021-11-10 10:22:15', 1),
(29, 19, 17, 'Holaaaaaaaaaaaaaa', '2021-11-10 10:23:21', 0),
(30, 3, 7, 'Hola diana, como vas?', '2021-11-17 16:33:38', 0),
(31, 3, 17, 'Hola de nuevo', '2021-11-17 16:34:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `UserId` int(10) NOT NULL,
  `UserName` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `UserPassword` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT 0,
  `UserFirstName` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `UserLastName` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `UserAvatar` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '/Chat-App/assets/icon-usuario.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `UserPassword`, `IsActive`, `UserFirstName`, `UserLastName`, `UserAvatar`) VALUES
(1, 'john@gmail.com', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm', 1, 'John', 'Jackson', '/Chat-App/assets/icon-usuario.png'),
(2, 'alex@gmail.com', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm', 1, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(3, 'pepe@gmail.com', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm', 1, 'Pepe', 'Perez', 'uploads/usuario2.jpg'),
(4, 'Luis', '$2y$10$yXsrp3xalDRhcdKwRDhhuehgytkVkQd0YQJ4Ch4SiQJSyp8LFtmEm', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(5, 'Jose', '$2y$10$FSH5BoOw34ZEf7O2DzrLcO38bSfOBbHnRU4CPBqShWsfiECAiU9Ji', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(6, 'Maria', '$2y$10$X5UmPTGeQVD1VNS.TSnU4u88w8tzQbsqv5QyLSmDZWBsQ2VcFrCiq', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(7, 'Diana', '$2y$10$XDHx05MW9cBqLSsf3Lr.9O3a8Lzp.T/2JM7C07yeyua4eLnHJe7j2', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(10, 'Antonio', '$2y$10$NEPzXs9FXIjaenGTOYroBuXDbpMbCDGcTDhXSNUfiI1jdW2wwuVom', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(13, 'Miguel', '$2y$10$8ji6d0TFtcRHz7GWqyUQHeTJxqB7yuFD710WcBAcgQFou2lZEdHYG', 0, NULL, NULL, '/Chat-App/assets/icon-usuario.png'),
(17, 'shapedlm2020@gmail.com', '$2y$10$qvo1yEMNF7i.qBoEUfRQkebmWm5bnpzasaWqLfehRxzwQQB7yQVKO', 1, 'Luis', 'Pepe', 'uploads/user_defualt_avatar.jpg'),
(19, 'pepeperez4609@gmail.com', '$2y$10$XWatr6wym6Tb0Oq4SWBMseATcBmviLzP0Gthx0oaNDHDp9x44RynS', 1, 'Pepe2', 'Perez', '/Chat-App/assets/icon-usuario.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertokens`
--

CREATE TABLE `usertokens` (
  `UserId` int(10) NOT NULL,
  `Token` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Valid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usertokens`
--

INSERT INTO `usertokens` (`UserId`, `Token`, `Valid`) VALUES
(1, 'CIUBQEOVFIUQBEVIOERQBVOIREUBVIEOPRB', '2021-11-10 10:21:21'),
(17, 'qnhwvopunvpouewnverq', '2021-11-10 10:21:21'),
(19, '$2y$10$xrYuyqVBksha472YIktsm.XVcoxGK8ZamRX7CI5isxMfgW6JXylx2', '2021-11-10 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`FriendsId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `UserId2` (`UserId2`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageId`),
  ADD KEY `FromUserId` (`FromUserId`),
  ADD KEY `ToUserId` (`ToUserId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserName_UNIQUE` (`UserName`);

--
-- Indices de la tabla `usertokens`
--
ALTER TABLE `usertokens`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `friends`
--
ALTER TABLE `friends`
  MODIFY `FriendsId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usertokens`
--
ALTER TABLE `usertokens`
  MODIFY `UserId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`UserId2`) REFERENCES `users` (`UserId`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`FromUserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ToUserId`) REFERENCES `users` (`UserId`);

--
-- Filtros para la tabla `usertokens`
--
ALTER TABLE `usertokens`
  ADD CONSTRAINT `usertokens_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
