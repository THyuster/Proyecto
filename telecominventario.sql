-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2024 a las 14:55:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `telecominventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `MovimientoID` int(11) NOT NULL,
  `TipoMovimiento` varchar(10) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `NombreProducto` varchar(255) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Motivo` text NOT NULL,
  `Nombre_trabajador` varchar(50) NOT NULL,
  `cc_trabajador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`MovimientoID`, `TipoMovimiento`, `ProductoID`, `NombreProducto`, `Fecha`, `Hora`, `Cantidad`, `Motivo`, `Nombre_trabajador`, `cc_trabajador`) VALUES
(1, 'entrada', 125, '', '2023-12-13', '311:00:00', 1, 'provar', '', ''),
(2, 'entrada', 123, '', '2023-12-13', '333:00:00', 1, 'prueba 2', '', ''),
(3, 'entrada', 123, '', '2023-12-13', '630:00:00', 3, 'aaaaa', '', ''),
(4, 'entrada', 123, '', '2023-12-13', '322:00:00', 2, 'noooooo', '', ''),
(5, 'entrada', 123, '', '2023-12-13', '311:00:00', 2, 'jajajjajajaja', '', ''),
(6, 'salida', 123, '', '2023-12-14', '333:00:00', 2, 'talvez', '', ''),
(7, 'entrada', 123, '', '2023-12-14', '575:00:00', 2, 'lolaaaa', '', ''),
(8, 'entrada', 123, '', '2023-12-14', '575:00:00', 2, 'lolaaaa', '', ''),
(9, 'entrada', 123, '', '2024-03-22', '03:21:00', 483, 'hgcxnbfv', 'DGasdg', '47852453');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`MovimientoID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `MovimientoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ProductoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
