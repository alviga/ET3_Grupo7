-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-12-2016 a las 20:21:45
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ET3Grupo7`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `nombre_eq` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('diaria','mensual','anual','') NOT NULL,
  `cuenta_per_gan` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `nombre_eq` varchar(20) NOT NULL,
  `nombre_val` varchar(20) NOT NULL,
  `dia` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `cantidad` int(6) NOT NULL,
  `maximo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `nombre_val` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `variacion_dia` double NOT NULL,
  `variacion_anual` double NOT NULL,
  `maximo` double NOT NULL,
  `minimo` double NOT NULL,
  `hora` varchar(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `login` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `nombre_eq` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`login`, `pwd`, `tipo`, `nombre_eq`) VALUES
('admin', 'admin', 1, 'admin'),
('lamarta', 'lamarta', 0, 'Equipo Marta'),
('lanoe', 'lanoe', 0, 'Equipo Noe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `nombre` varchar(20) NOT NULL,
  `capital` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`nombre`, `capital`) VALUES
('admin', 0),
('Equipo Marta', 80000),
('Equipo Noe', 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `nombre_eq` varchar(20) NOT NULL,
  `nombre_val` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `asignacion` tinyint(1) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `nombre_eq` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participante`
--

INSERT INTO `participante` (`dni`, `nombre`, `apellidos`, `email`, `telefono`, `asignacion`, `tipo`, `nombre_eq`) VALUES
('37463515F', 'Marta', 'Ferreiro Gonzalez', 'emaildemarta@gmail.com', 674859456, 1, 0, 'Equipo Marta'),
('48572659C', 'Noe', 'Garrido Marchena', 'emaildenoe@gmail.com', 647584365, 1, 0, 'Equipo Noe'),
('77384763R', 'Fernando', 'Gutierrez Estevez', 'correoadmin@gmail.com', 645385476, 1, 1, 'admin'),
('84756456T', 'Rodolfo', 'Cañizo Martinez', 'emailderodolfo@gmail.com', 674856988, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE IF NOT EXISTS `valor` (
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`nombre`) VALUES
('ABERTIS'),
('ACCIONA'),
('ACERINOX'),
('ACS'),
('AENA'),
('AMADEUS IT GROUP'),
('ARCELORMITTAL'),
('BANCO POPULAR'),
('BANCO SABADELL'),
('BANKIA'),
('BANKINTER'),
('BBVA'),
('CAIXABANK'),
('CELLNEX TELECOM'),
('DIA'),
('ENAGAS'),
('ENDESA'),
('FERROVIAL'),
('GAMESA'),
('GAS NATURAL'),
('GRIFOLS'),
('IAG'),
('IBERDROLA'),
('INDITEX'),
('INDRA'),
('MAPFRE'),
('MEDIASET'),
('MELIA HOTELS'),
('MERLIN PROP.'),
('RED ELECTRICA'),
('REPSOL'),
('SANTANDER'),
('TECNICAS REUNIDAS'),
('TELEFONICA'),
('VISCOFAN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `nombre_eq` varchar(20) NOT NULL,
  `nombre_val` varchar(20) NOT NULL,
  `dia` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `cantidad` int(6) NOT NULL,
  `precio` float DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `minimo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`nombre_eq`, `nombre_val`, `dia`, `hora`, `cantidad`, `precio`, `estado`, `minimo`) VALUES
('admin', 'ABERTIS', '2017-01-01', '00:00', 1830, NULL, 0, 13.6),
('admin', 'ACCIONA', '2017-01-01', '00:00', 3400, NULL, 0, 70.1),
('admin', 'ACERINOX', '2017-01-01', '00:00', 19500, NULL, 0, 12.8),
('admin', 'ACS', '2017-01-01', '00:00', 7000, NULL, 0, 30.3),
('admin', 'AENA', '2017-01-01', '00:00', 1900, NULL, 0, 132),
('admin', 'AMADEUS IT GROUP', '2017-01-01', '00:00', 5700, NULL, 0, 43.5),
('admin', 'ARCELORMITTAL', '2017-01-01', '00:00', 36200, NULL, 0, 6.9),
('admin', 'BANCO POPULAR', '2017-01-01', '00:00', 280000, NULL, 0, 0.8),
('admin', 'BANCO SABADELL', '2017-01-01', '00:00', 192000, NULL, 0, 1.3),
('admin', 'BANKIA', '2017-01-01', '00:00', 240000, NULL, 0, 1.1),
('admin', 'BANKINTER', '2017-01-01', '00:00', 33500, NULL, 0, 7.5),
('admin', 'BBVA', '2017-01-01', '00:00', 39000, NULL, 0, 6.4),
('admin', 'CAIXABANK', '2017-01-01', '00:00', 73000, NULL, 0, 6.4),
('admin', 'CELLNEX TELECOM', '2017-01-01', '00:00', 17600, NULL, 0, 14.1),
('admin', 'DIA', '2017-01-01', '00:00', 55000, NULL, 0, 4.5),
('admin', 'ENAGAS', '2017-01-01', '00:00', 10300, NULL, 0, 24.2),
('admin', 'ENDESA', '2017-01-01', '00:00', 12000, NULL, 0, 20.6),
('admin', 'FERROVIAL', '2017-01-01', '00:00', 14500, NULL, 0, 17.2),
('admin', 'GAMESA', '2017-01-01', '00:00', 13000, NULL, 0, 18.9),
('admin', 'GAS NATURAL', '2017-01-01', '00:00', 13900, NULL, 0, 17.9),
('admin', 'GRIFOLS', '2017-01-01', '00:00', 13500, NULL, 0, 18.4),
('admin', 'IAG', '2017-01-01', '00:00', 47100, NULL, 0, 5.3),
('admin', 'IBERDROLA', '2017-01-01', '00:00', 41000, NULL, 0, 6.2),
('admin', 'INDITEX', '2017-01-01', '00:00', 7600, NULL, 0, 32.8),
('admin', 'INDRA', '2017-01-01', '00:00', 24200, NULL, 0, 10.3),
('admin', 'MAPFRE', '2017-01-01', '00:00', 82000, NULL, 0, 3),
('admin', 'MEDIASET', '2017-01-01', '00:00', 22500, NULL, 0, 11.1),
('admin', 'MELIA? HOTELS', '2017-01-01', '00:00', 23100, NULL, 0, 10.8),
('admin', 'MERLIN PROP.', '2017-01-01', '00:00', 26000, NULL, 0, 9.6),
('admin', 'RED ELECTRICA', '2017-01-01', '00:00', 14000, NULL, 0, 17.8),
('admin', 'REPSOL', '2017-01-01', '00:00', 19000, NULL, 0, 13.2),
('admin', 'SANTANDER', '2017-01-01', '00:00', 50000, NULL, 0, 5.1),
('admin', 'TECNICAS REUNIDAS', '2017-01-01', '00:00', 6300, NULL, 0, 39.4),
('admin', 'TELEFONICA', '2017-01-01', '00:00', 28000, NULL, 0, 8.9),
('admin', 'VISCOFAN', '2017-01-01', '00:00', 5100, NULL, 0, 46.6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `balance`
--
ALTER TABLE `balance`
 ADD PRIMARY KEY (`nombre_eq`,`fecha`,`tipo`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
 ADD PRIMARY KEY (`nombre_eq`,`nombre_val`,`dia`,`hora`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
 ADD PRIMARY KEY (`nombre_val`,`hora`,`fecha`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
 ADD PRIMARY KEY (`login`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
 ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
 ADD PRIMARY KEY (`nombre_eq`,`nombre_val`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
 ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
 ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
 ADD PRIMARY KEY (`nombre_eq`,`nombre_val`,`dia`,`hora`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
