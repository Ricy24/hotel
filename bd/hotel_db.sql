-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2024 a las 21:30:54
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `clave`) VALUES
(1, 'hotel', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `asunto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contact`
--

INSERT INTO `contact` (`name`, `email`, `asunto`) VALUES
('deisy', 'deisylozano7788@gmail.com', 'feo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `usuario`, `password`) VALUES
(1, 'deisy', 'deisylozano7788@gmail.com', 'lucia', '2024454'),
(2, 'deisy', 'deisylozano7788@gmail.com', 'fefre', 'feafearfg'),
(3, 'deisy', 'deisylozano7788@gmail.com', 'deisy', 'njibibi'),
(5, 'Andres Duran', 'michellquintero2020@gmail.com', 'andresito', 'Riki12345'),
(8, 'Andres Duran', 'discordandres20@gmail.com', 'discordandres20@gmail.com', '$2y$10$fQPvKQ4/SJ0KZIRp5JbXYeLblHo56bnqCFWYJgYfXNt/ay3mN.Eq6'),
(9, 'cris', 'cris@gmail.com', 'cris', '$2y$10$xeHVVdD7C4bjf0wAeRzqMOTPp3mObbGm1XwSO3TkoiFBtA0allnhi'),
(11, 'cla', 'cla@gmail.com', 'cla23', '$2y$10$7DCugVIhXgvwB8dnyRShp.fSmcuxmuoW5zo818l7ej3uWaYQx10aS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` int(30) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `celular`, `room_type`, `check_in`, `check_out`) VALUES
(1, 'Andres ', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(3, 'Andres Duran', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(4, 'Andres Duran', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(5, 'Andres Duran', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(6, 'Andres Duran', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(7, 'Andres Duran', 'discordandres20@gmail.com', 2147483647, 'simple', '2024-09-03', '2024-09-04'),
(8, 'deisy', 'deisylozano7788@gmail.com', 2147483647, 'simple', '2024-09-10', '2024-09-26'),
(9, 'deisy', 'deisylozano7788@gmail.com', 2147483647, 'simple', '2024-09-18', '2024-10-05'),
(10, 'deisy', 'deisylozano7788@gmail.com', 2147483647, 'simple', '2024-09-09', '2024-10-04'),
(11, 'aadri', 'adrianaktgarcia.0308@gmail.com', 2147483647, 'simple', '2024-10-04', '2024-10-12'),
(12, 'deisy', 'deisylozano7788@gmail.com', 2147483647, 'simple', '2024-09-11', '2024-09-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


DELETE FROM `reservations` WHERE `id` = 0;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

