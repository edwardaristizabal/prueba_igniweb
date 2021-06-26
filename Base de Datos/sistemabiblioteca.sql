-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3310
-- Tiempo de generación: 19-06-2021 a las 07:46:50
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemabiblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `idautor` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idautor`, `nombre`, `descripcion`, `imagen`, `estado`) VALUES
(1, 'Paúl Kennedy', '', '', 1),
(2, 'Luis Joyanes Aguilar', '', '', 1),
(3, 'Montejo Raez Arturo', '', '', 1),
(4, 'María Pilar García', '', '', 1),
(5, 'Marialcira Quintero', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `ideditorial` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`ideditorial`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Anaya Multimedia', '', 1),
(2, 'IT', '', 1),
(3, 'La casa del programador', '', 1),
(4, 'Organización Panombrericana de la Salud', '', 1),
(5, 'Organización Panombrericana de la Salud Mundial', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idlibro` int(11) NOT NULL,
  `titulo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `idautor` int(11) NOT NULL,
  `ideditorial` int(11) NOT NULL,
  `year_edicion` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `idmateria` int(11) NOT NULL,
  `numero_paginas` int(11) NOT NULL,
  `descripcion` varchar(800) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idlibro`, `titulo`, `cantidad_disponible`, `idautor`, `ideditorial`, `year_edicion`, `idmateria`, `numero_paginas`, `descripcion`, `imagen`, `estado`) VALUES
(1, 'Ingenieros de la victoria', 0, 1, 1, '2014', 1, 66, '', '1577216903.PNG', 1),
(2, 'Curso de Programación Phyton', 10, 3, 2, '2019', 3, 430, '', '1577325959.jpeg', 1),
(3, 'Iniciación a la matemática universitaria', 10, 4, 3, '2019', 4, 250, '', '1577326347.jpeg', 1),
(4, 'La Salud de los adultos mayores', 1, 5, 1, '2010', 6, 200, '', '1577325941.jpeg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `idmateria` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`idmateria`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Introducción a la Ingeniería de Sistemas', '', 1),
(2, 'Fundamentos de la programación', '', 1),
(3, 'Lenguaje de la programación', '', 1),
(4, 'Matemática', '', 1),
(5, 'Programación', '', 1),
(6, 'Salud', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int(11) NOT NULL,
  `idlibro` int(11) NOT NULL,
  `idusuario` int(11) NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observacion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idprestamo`, `idlibro`, `idusuario`, `fecha_prestamo`, `fecha_devolucion`, `cantidad`, `observacion`, `estado`) VALUES
(1, 2, 1, '2021-01-23', '2021-07-25', 1, NULL, 'Prestado'),
(2, 4, 2, '2019-12-31', '2020-01-06', 2, NULL, 'Devuelto');

--
-- Disparadores `prestamo`
--
DELIMITER $$
CREATE TRIGGER `tr_pr_devuelto` AFTER UPDATE ON `prestamo` FOR EACH ROW BEGIN
UPDATE libro SET cantidad_disponible = cantidad_disponible + NEW.cantidad
WHERE libro.idlibro = NEW.idlibro;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_pr_prestado` AFTER INSERT ON `prestamo` FOR EACH ROW BEGIN
UPDATE libro SET cantidad_disponible = cantidad_disponible - NEW.cantidad
WHERE libro.idlibro = NEW.idlibro;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `codigo_trabajador` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `num_documento` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `profesion` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cargo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `login` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `codigo_trabajador`, `num_documento`, `nombre`, `profesion`, `cargo`, `direccion`, `telefono`, `email`, `login`, `clave`) VALUES
(1, '123456', '11128801', 'Edward Andres Aristizabal Montalvo', 'Tecnólogo en Sistemas', 'Administrador', 'Santiago de Cali', '3173954359', 'edwardaristi@yahoo.es', 'edwardaristi', 'ed120690'),
(2, '789012', '11438371', 'David Fernando Rendon Castro', 'Estudiante', 'Usuario', 'Guadalajara de Buga', '3178880055', 'deivirendo@gmail.com', 'deivirendon', 'Tita2020'),
(3, '345678', '12345678', 'Usuario Pruebas', 'Pruebas', 'Administrador', 'Calima El Darién', '555555555', NULL, 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idautor`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`ideditorial`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idlibro`),
  ADD KEY `idautor` (`idautor`),
  ADD KEY `ideditorial` (`ideditorial`),
  ADD KEY `idmateria` (`idmateria`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `idlibro` (`idlibro`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `idautor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `ideditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idlibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_libro_autor` FOREIGN KEY (`idautor`) REFERENCES `autor` (`idautor`),
  ADD CONSTRAINT `fk_libro_editorial` FOREIGN KEY (`ideditorial`) REFERENCES `editorial` (`ideditorial`),
  ADD CONSTRAINT `fk_libro_materia` FOREIGN KEY (`idmateria`) REFERENCES `materia` (`idmateria`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_libro` FOREIGN KEY (`idlibro`) REFERENCES `libro` (`idlibro`),
  ADD CONSTRAINT `fk_prestamo_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
