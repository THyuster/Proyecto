
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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

ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`MovimientoID`),
  ADD KEY `ProductoID` (`ProductoID`);

ALTER TABLE `movimientos`
  MODIFY `MovimientoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ProductoID`);
COMMIT;
