-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2024 a las 18:39:43
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
-- Base de datos: `tiendadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `subcategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`codigo`, `nombre`, `descripcion`, `categoria`, `precio`, `imagen`, `descuento`, `activo`, `subcategoria`) VALUES
(1, 'Zapatillas Topper Tyler II', 'yyyyyyyyyyyy', 12, 12, 'zapatillas topper tyleer II.png', 12, 1, 3),
(3, 'Zapatillas Topper Hyde II Lth', 'Zapatillas Topper Hyde II Lth lona', 12, 14, 'zapatillas topper Hyde II.png', 0, 1, 3),
(4, 'Zapatillas Topper Enforcer', 'Zapatillas Topper Enforcer cuero', 12, 23, 'zapatillas topper enforcer.png', 10, 1, 3),
(5, 'zapatillas topper efective', 'zapatillas topper efective dep', 12, 45, 'zapatillas topper efective.png', 10, 1, 4),
(6, 'zapatillas topper efective ngr', 'zapatillas topper efective negras dep', 12, 38, 'zapatillas topper efective ngr.png', 10, 1, 4),
(7, 'Zapatillas Topper Warp De Hombre', 'Zapatillas Topper Warp De Hombre', 12, 45, 'Zapatillas Topper Warp De Hombre.png', 5, 1, 2),
(8, 'Zapatillas Topper Boro', 'Zapatillas Topper Boro', 12, 21, 'Zapatillas Topper Boro.png', 0, 1, 2),
(9, 'Zapatillas Topper Core', 'Zapatillas Topper Core', 12, 25, 'Zapatillas Topper Core.png', 10, 1, 2),
(10, 'Zapatillas Topper Drive de Hombre', 'Zapatillas Topper Drive de Hombre', 12, 17, 'Zapatillas Topper Drive de Hombre.png', 0, 1, 5),
(11, 'Zapatillas Topper Vr Pro De mujer', 'Zapatillas Topper Vr Pro De mujer', 4, 34, 'Zapatillas Topper Vr Pro De mujer.png', 12, 1, 8),
(12, 'Zapatillas Topper Fast De Mujer', 'Zapatillas Topper Fast De Mujer', 4, 30, 'Zapatillas Topper Fast De Mujer.png', 10, 1, 8),
(13, 'Zapatillas topper Drill', 'Zapatillas topper Drill mjr', 4, 23, 'Zapatillas topper Drill.png', 0, 1, 8),
(14, 'Zapatillas Topper Effective De Mujer', 'Zapatillas Topper Effective De Mujer', 4, 45, 'Zapatillas Topper Effective De Mujer.png', 5, 1, 6),
(15, 'Zapatillas Topper T 350 De Mujer', 'Zapatillas Topper T 350 De Mujer', 4, 34, 'Zapatillas Topper T 350 De Mujer.png', 5, 1, 6),
(16, 'Zapatillas Topper Hyde II Lth mjr', 'Zapatillas Topper Hyde II Lth mjr', 4, 89, 'Zapatillas Topper Hyde II Lth mjr.png', 20, 1, 7),
(17, 'Zapatillas Topper Hyde II mjr', 'Zapatillas Topper Hyde II mjr', 4, 45, 'Zapatillas Topper Hyde II mjr.png', 5, 1, 7),
(18, 'Zapatillas Toppertyler II Mujer', 'Zapatillas Toppertyler II Mujer', 4, 89, 'Zapatillas Toppertyler II Mujer.png', 45, 1, 7),
(19, 'Zapatillas Topper Ever De Mujer', 'Zapatillas Topper Ever De Mujer', 4, 45, 'Zapatillas Topper Ever De Mujer.png', 10, 1, 9),
(21, 'Zapatillas Topper Hyde II niños Unisex', 'Zapatillas Topper Hyde II niños Unisex', 13, 12, 'Zapatillas Topper Hyde II niños Unisex.png', 2, 1, 11),
(22, 'Zapatillas Topper Tyler II De Niños', 'Zapatillas Topper Tyler II De Niños', 13, 56, 'Zapatillas Topper Tyler II De Niños.png', 30, 1, 11),
(23, 'Zapatillas Topper Boris De Niñas', 'Zapatillas Topper Boris De Niñas', 13, 34, 'Zapatillas Topper Boris De Niñas.png', 0, 1, 12),
(24, 'Zapatillas Topper Squat De Niñas', 'Zapatillas Topper Squat De Niñas', 13, 34, 'Zapatillas Topper Squat De Niñas.png', 0, 1, 12),
(25, 'Zapatillas Topper Chalpa II De Niñas', 'Zapatillas Topper Chalpa II De Niñas', 13, 45, 'Zapatillas Topper Chalpa II De Niñas.png', 12, 1, 10),
(26, 'Zapatillas Topper Chalpa II De Niños', 'Zapatillas Topper Chalpa II De Niños', 13, 35, 'Zapatillas Topper Chalpa II De Niños.png', 3, 1, 10),
(27, 'Zapatillas Topper Wind IV De Niños', 'Zapatillas Topper Wind IV De Niños', 13, 78, 'Zapatillas Topper Wind IV De Niños.png', 50, 1, 10),
(28, 'Zapatillas Topper Zurich III De Niñas', 'Zapatillas Topper Zurich III De Niñas', 13, 32, 'Zapatillas Topper Zurich III De Niñas.png', 12, 1, 10),
(29, 'Zapatillas Topper T-350 De Niñas', 'Zapatillas Topper T-350 De Niñas', 13, 12, 'Zapatillas Topper T-350 De Niñas.png', 0, 1, 13),
(30, 'Zapatillas Topper T-350 De Niños', 'Zapatillas Topper T-350 De Niños', 13, 13, 'Zapatillas Topper T-350 De Niños.png', 0, 1, 13),
(31, 'Zapatillas Topper Boro II Unisex', 'Zapatillas Topper Boro II Unisex', 17, 45, 'Zapatillas Topper Boro II Unisex.png', 0, 1, 18),
(32, 'Zapatillas Topper Dakota de Hombre', 'Zapatillas Topper Dakota de Hombre', 17, 45, 'Zapatillas Topper Dakota de Hombre.png', 0, 1, 18),
(33, 'Zapatillas Topper Ultralight 2 de Hombre', 'Zapatillas Topper Ultralight 2 de Hombre', 17, 67, 'Zapatillas Topper Ultralight 2 de Hombre.png', 8, 1, 18),
(34, 'Zapatillas Topper Vr Pro mjr', 'Zapatillas Topper Vr Pro mjr', 17, 56, 'Zapatillas Topper Vr Pro mjr.png', 0, 1, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `codCategoriaPadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo`, `nombre`, `activo`, `codCategoriaPadre`) VALUES
(4, 'Zapatos Mujer', 1, 2),
(12, 'Zapatos hombre', 1, 1),
(13, 'Zapatos Niños', 1, 3),
(17, 'Running', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `lineapedido` (
  `numpedido` int(11) NOT NULL,
  `numlinea` int(11) NOT NULL,
  `codArticulo` varchar(9) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `descuento` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `lineapedido`
--

INSERT INTO `lineapedido` (`numpedido`, `numlinea`, `codArticulo`, `cantidad`, `precio`, `descuento`) VALUES
(28, 10, '1', 1, 12, 12),
(28, 11, '3', 1, 14, 0),
(28, 12, '4', 1, 23, 10),
(29, 13, '5', 1, 45, 10),
(29, 14, '6', 1, 38, 10),
(30, 15, '1', 1, 12, 12),
(30, 16, '1', 1, 12, 12),
(31, 17, '1', 1, 12, 12),
(31, 18, '3', 1, 14, 0),
(32, 19, '1', 1, 12, 12),
(32, 20, '3', 1, 14, 0),
(33, 21, '1', 1, 12, 12),
(34, 22, '1', 1, 12, 12),
(35, 23, '1', 1, 12, 12),
(36, 24, '1', 1, 12, 12),
(37, 25, '1', 1, 12, 12),
(38, 26, '1', 1, 12, 12),
(38, 27, '3', 1, 14, 0),
(39, 28, '1', 1, 12, 12),
(40, 29, '1', 1, 12, 12),
(41, 30, '1', 1, 12, 12),
(42, 31, '1', 1, 12, 12),
(43, 32, '1', 1, 12, 12),
(44, 33, '1', 1, 12, 12),
(45, 34, '1', 1, 12, 12),
(45, 35, '1', 1, 12, 12),
(46, 36, '1', 1, 12, 12),
(46, 37, '1', 1, 12, 12),
(47, 38, '1', 1, 12, 12),
(47, 39, '1', 1, 12, 12),
(48, 40, '1', 1, 12, 12),
(48, 41, '1', 1, 12, 12),
(49, 42, '1', 1, 12, 12),
(49, 43, '1', 1, 12, 12),
(50, 44, '1', 1, 12, 12),
(50, 45, '1', 1, 12, 12),
(50, 46, '1', 1, 12, 12),
(51, 47, '1', 1, 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `codusuario` varchar(9) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idpedido`, `fecha`, `total`, `estado`, `codusuario`, `activo`) VALUES
(28, '2024-02-25', 45.26, 1, '78296372w', 1),
(29, '2024-02-25', 74.7, 1, '78296372w', 1),
(30, '2024-02-25', 21.12, 1, '78296372w', 1),
(31, '2024-02-25', 24.56, 1, '78296372w', 1),
(32, '2024-02-25', 24.56, 1, '78296372w', 1),
(33, '2024-02-25', 10.56, 1, '78296372w', 1),
(34, '2024-02-25', 10.56, 1, '78296372w', 1),
(35, '2024-02-25', 10.56, 1, '78296372w', 1),
(36, '2024-02-25', 10.56, 1, '78296372w', 1),
(37, '2024-02-25', 10.56, 1, '78296372w', 1),
(38, '2024-02-25', 24.56, 1, '78296372w', 1),
(39, '2024-02-25', 10.56, 1, '78296372w', 1),
(40, '2024-02-25', 10.56, 1, '78296372w', 1),
(41, '2024-02-25', 10.56, 1, '78296372w', 1),
(42, '2024-02-25', 10.56, 1, '78296372w', 1),
(43, '2024-02-25', 10.56, 1, '78296372w', 1),
(44, '2024-02-25', 10.56, 1, '78296372w', 1),
(45, '2024-02-25', 21.12, 1, '78296372w', 1),
(46, '2024-02-25', 21.12, 1, '78296372w', 1),
(47, '2024-02-25', 21.12, 1, '78296372w', 1),
(48, '2024-02-25', 21.12, 1, '78296372w', 1),
(49, '2024-02-25', 21.12, 1, '78296372w', 1),
(50, '2024-02-25', 31.68, 1, '78296372w', 1),
(51, '2024-02-25', 10.56, 1, '78296372w', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol`, `rol_id`) VALUES
('admin', 1),
('editor', 2),
('cliente', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `codCategoriaPadre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`codigo`, `nombre`, `codCategoriaPadre`) VALUES
(2, 'Novedades', 12),
(3, 'Clásico', 12),
(4, 'Deportivos', 12),
(5, 'Outlet', 12),
(6, 'Novedades', 4),
(7, 'Clásico', 4),
(8, 'Deportivos', 4),
(9, 'Outlet', 4),
(10, 'Novedades', 13),
(11, 'Clásico', 13),
(12, 'Deportivos', 13),
(13, 'Outlet', 13),
(14, 'Novedades', 17),
(15, 'Clásico', 17),
(16, 'Deportivos', 17),
(17, 'Outlet', 17),
(18, 'especiales del deporte', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `clave` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellido` varchar(75) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `localidad` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `provincia` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rol` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `clave`, `nombre`, `apellido`, `direccion`, `localidad`, `provincia`, `telefono`, `email`, `rol`, `activo`) VALUES
('29661444q', '123456', 'joaquin', 'Detlefsen', 'Balbin 435', 'RAWSON', 'Chubut', '666999888', 'joaquin@gmail.com', '2', NULL),
('78296370w', '$2y$10$e9v6H/4rrHOjdpBLsgI6yOUg450goXH0t1hzmSydJTY65aUGnuqZK', 'viviana', 'montiel', 'Balbin 435', 'elche', 'alicante', '666558888', 'vivi@gmail.com', '2', NULL),
('78296372w', '123456', 'Javier', 'Detlefsen', 'Balbin 435', 'RAWSON', 'Chubut', '644911430', 'javieldetle@hotmail.com', '1', NULL),
('78654897t', '123456', 'Candela', 'Detlefsen', 'Balbin 435', 'ELCHE', 'Florida', '555666777', 'candela@gmail.com', '3', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD PRIMARY KEY (`numlinea`),
  ADD KEY `codArticulo` (`codArticulo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `codusuario` (`codusuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codCategoriaPadre` (`codCategoriaPadre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `numlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`codusuario`) REFERENCES `usuarios` (`dni`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`codCategoriaPadre`) REFERENCES `categoria` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
