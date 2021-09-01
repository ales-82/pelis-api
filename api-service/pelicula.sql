-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2021 a las 15:02:55
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api-service`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `genero` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `nombre`, `year`, `genero`, `precio`, `imagen`) VALUES
(1, 'Viuda Negra', 2021, 'Acción, Aventura, Ciencia Ficción', '2090.30', 'blackWidow.jpg'),
(2, 'Mortal Kombat', 2021, 'Acción, Aventura, Fantasía', '1410.90', 'mortal-kombat.jpg'),
(4, 'Alien Covenant', 2017, 'Ciencia Ficción, Terror\r\n', '1499.90', 'alien-covenant.jpg'),
(5, 'La Liga de la Justicia de Zack Snyder', 2021, 'Acción, Aventura, Fantasía', '1899.90', 'zack-snyders-justice-league.jpg'),
(6, 'Godzilla vs Kong', 2021, 'Acción, Ciencia Ficción, Thriller', '2589.99', 'godzilla-vs-kong.jpg'),
(7, 'Mujer Maravilla 1984', 2020, 'Acción Aventura Comics DC', '1149.90', 'wonderwoman.jpg'),
(9, 'Aves de Presa', 2020, 'Accion, superheroes comics DC', '899.90', 'avesdepresa.jpg'),
(10, 'Titanic', 1998, 'Drama Romance', '899.90', 'titanic.jpg'),
(11, 'Batman Inicia', 2005, 'Accion superheroes', '599.90', 'batmanInicia.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
