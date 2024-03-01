-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2024 a las 14:21:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `spoty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion`
--

CREATE TABLE `cancion` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `artista` varchar(255) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `album` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`id`, `titulo`, `artista`, `archivo`, `album`, `imagen`) VALUES
(3, 'TODA LA VIDA', 'YSY A', '1 - YSY A - TODA LA VIDA (PROD. ONIRIA).mp3', 'AFTER DEL AFTER', 'After del after.jpg'),
(4, 'IN MY BONES', 'The Score', 'The Score - In My Bones (Lyric Video).mp3', NULL, 'nones.jpg'),
(5, 'IMAGINARY', 'Brennan Heart & Jonathan Mendelsohn', 'Brennan Heart & Jonathan Mendelsohn - Imaginary.mp3', NULL, 'imaginary.jpg'),
(6, 'DEMASIADAS MUJERES', 'C.Tangana', 'C. Tangana - Demasiadas Mujeres (Video Oficial).mp3', NULL, 'ctan.jpg'),
(7, 'AL BORDE DEL DESASTRE', 'Calero LDN', 'Calero LDN - Al borde del desastre (Prod. SOTAN).mp3', NULL, 'unnamed.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion_en_playlist`
--

CREATE TABLE `cancion_en_playlist` (
  `id_relacion` int(11) NOT NULL,
  `id_cancion` int(11) DEFAULT NULL,
  `id_playlist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cancion_en_playlist`
--

INSERT INTO `cancion_en_playlist` (`id_relacion`, `id_cancion`, `id_playlist`) VALUES
(1, 3, 19),
(2, 4, 19),
(3, 5, 19),
(4, 6, 20),
(5, 7, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240228151858', '2024-03-01 13:51:07', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_usuario` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`id`, `nombre`, `id_usuario`, `imagen`) VALUES
(14, 'efgegeg', '8', 'tainy-65df44ae2865e.png'),
(15, 'sdgsdgdssssssss', '8', 'unnamed-65df44b4d5af6.jpg'),
(16, 'Demonio', '8', 'nones-65df4e3a96c08.jpg'),
(19, 'thrtjnrjtj', '8', 'maxresdefault-65e1bf83b711e.jpg'),
(20, 'Focus', '8', 'playlist-65e1c2df55abd.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `roles`, `username`) VALUES
(1, 'pablodelasierra7@gmail.com', '$2y$13$B0qyhAzchO575PyDzpCcSOFIoxTngEbZ0LNGYPUCPgg27t4YWRQgG', '[]', NULL),
(8, 'admin@admin.com', '$2y$13$1cTf2V5z4VxBaMyHHrOERukuaq3wTq7CO0WKHXlz./V5fVijnYG7S', '[]', NULL),
(10, 'prueba1@prueba.com', '$2y$13$7VvxndscraRapR2FWb.bve04r5fPLl5Gyc8UCDv3nJ.I8SR/8t7TK', '[]', 'prueba1'),
(11, 'azul@azul.com', '$2y$13$FIh/wjlPGV2eb/89t/DDkumkOXEU9eghyyvvqowqKodocx32UGhFi', '[]', 'azul');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cancion_en_playlist`
--
ALTER TABLE `cancion_en_playlist`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `IDX_9D1A093C3AFFA6D0` (`id_cancion`),
  ADD KEY `IDX_9D1A093C8759FDB8` (`id_playlist`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_2265B05DF85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancion`
--
ALTER TABLE `cancion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cancion_en_playlist`
--
ALTER TABLE `cancion_en_playlist`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancion_en_playlist`
--
ALTER TABLE `cancion_en_playlist`
  ADD CONSTRAINT `FK_9D1A093C3AFFA6D0` FOREIGN KEY (`id_cancion`) REFERENCES `cancion` (`id`),
  ADD CONSTRAINT `FK_9D1A093C8759FDB8` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
