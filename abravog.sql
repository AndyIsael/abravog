-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2024 a las 16:32:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abravog`
--
CREATE DATABASE IF NOT EXISTS `abravog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `abravog`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `clave_empleado` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` tinyint(4) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_genero` tinyint(4) NOT NULL,
  `sueldo_base` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `clave_empleado`, `nombre`, `edad`, `fecha_nacimiento`, `id_genero`, `sueldo_base`, `activo`) VALUES
(1, 'AD', 'Andy Isael Bravo Garcia', 21, '2001-06-04', 1, 100, 1),
(2, 'PR', 'Prueba Empleado', 24, '2020-01-01', 1, 1000, 0),
(3, 'IBG', 'Isael Bravo Garcia', NULL, '2000-02-04', 2, 3999, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_detalle`
--

CREATE TABLE `empleados_detalle` (
  `id_empleado_detalle` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `experiencia_profesional` varchar(255) NOT NULL,
  `idioma` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_detalle`
--

INSERT INTO `empleados_detalle` (`id_empleado_detalle`, `id_empleado`, `puesto`, `experiencia_profesional`, `idioma`) VALUES
(1, 1, 'Administrador', 'asdsad', 1),
(2, 2, 'Empleado', 'Media-Alta', 1),
(3, 3, 'Empleado', 'Recién ingresado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` tinyint(6) NOT NULL,
  `genero` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `permiso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `permiso`) VALUES
(1, 'ADMIN_EMPLEADOS'),
(2, 'ADMIN_PERMISOS_USUARIO'),
(3, 'ADMIN_EMPLEADOS_CREAR'),
(4, 'ADMIN_EMPLEADOS_EDITAR'),
(5, 'ADMIN_EMPLEADOS_ELIMINAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `id_empleado`, `activo`) VALUES
(1, 'abravo', '12345', 1, 1),
(2, 'prueba', 'prueba', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relación de permisos entre empleado y permiso.';

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_empleado`, `id_permiso`, `activo`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 1, 1),
(4, 2, 5, 1),
(5, 1, 3, 1),
(6, 1, 4, 1),
(7, 1, 5, 1),
(8, 2, 2, 1),
(9, 2, 3, 1),
(10, 2, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `empleados_detalle`
--
ALTER TABLE `empleados_detalle`
  ADD PRIMARY KEY (`id_empleado_detalle`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `usuario_permiso_ibfk_1` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados_detalle`
--
ALTER TABLE `empleados_detalle`
  MODIFY `id_empleado_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` tinyint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

--
-- Filtros para la tabla `empleados_detalle`
--
ALTER TABLE `empleados_detalle`
  ADD CONSTRAINT `empleados_detalle_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `usuario_permiso_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `usuario` (`id_empleado`),
  ADD CONSTRAINT `usuario_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
