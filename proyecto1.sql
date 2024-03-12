-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 12-03-2024 a las 12:10:16
-- Versión del servidor: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Versión de PHP: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto1`
--
CREATE DATABASE IF NOT EXISTS `proyecto1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codCat` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codCat`, `nombre`, `descripcion`) VALUES
(1, 'Bebidas sin alcohol', 'Bebidas varias sin alcohol (refrescos, agua, zumos...)'),
(2, 'Bebidas con alcohol', 'Bebidas varias con alcohol (cava, vino espumoso, vino, licores...)'),
(3, 'Categoría Vacía', 'Ejemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codPed` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `enviado` int(11) NOT NULL,
  `restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codPed`, `fecha`, `enviado`, `restaurante`) VALUES
(47, '2023-12-04', 0, 1),
(48, '2023-12-13', 0, 1),
(50, '2023-12-13', 0, 1),
(51, '2024-01-25', 0, 1),
(52, '2024-01-31', 0, 1),
(53, '2024-02-29', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `codPedProd` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidosproductos`
--

INSERT INTO `pedidosproductos` (`codPedProd`, `pedido`, `producto`, `unidades`) VALUES
(63, 47, 3, 1),
(64, 47, 1, 2),
(65, 48, 1, 1),
(67, 50, 1, 2),
(68, 50, 2, 5),
(69, 50, 4, 15),
(70, 51, 1, 1),
(71, 51, 2, 1),
(72, 51, 3, 1),
(73, 51, 4, 1),
(74, 51, 5, 1),
(75, 52, 1, 5),
(76, 53, 1, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codProd` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(90) NOT NULL,
  `peso` double NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codProd`, `nombre`, `descripcion`, `peso`, `stock`, `categoria`) VALUES
(1, 'Coca-Cola', 'Refresco de cola', 330, 0, 1),
(2, 'Fanta', 'Refresco de naranja', 330, 40, 1),
(3, 'Sprite', 'Refresco de limón', 330, 56, 1),
(4, 'Agua mineral', 'Agua mineral natural', 500, 102, 1),
(5, 'Zumo de naranja', 'Zumo de naranja natural', 1000, 149, 1),
(6, 'Cerveza Mahou', 'Cerveza lager española', 330, 170, 2),
(7, 'Cerveza Alhambra', 'Cerveza rubia española', 330, 103, 2),
(8, 'Vino tinto Rioja', 'Vino tinto español de la región de La Rioja', 750, 113, 2),
(9, 'Vino blanco Rueda', 'Vino blanco español de la región de Rueda', 750, 100, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `codRes` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `correo` varchar(90) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `cp` int(11) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`codRes`, `nombre`, `correo`, `clave`, `pais`, `cp`, `ciudad`, `direccion`) VALUES
(1, 'BK Nerja', 'nerja@bk.es', '$2y$11$lpVu8ZKG56Vom2Axf8EsoO0TwTarb1jXMf0o5FCSBwSsk8lntvJCy', 'España', 29780, 'Nerja', 'C/Pescia, 1\r\n'),
(2, 'Juan Restaurant', 'jhercen600@g.educaand.es', '$2y$11$gTrSWdgSpzAq/HMtZOO0De8eE2V3m.b74BBIf6Kq0T6ZamCphLQG.', 'España', 29780, 'Nerja', 'Avda. Romero, 1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codCat`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codPed`),
  ADD KEY `restaurante` (`restaurante`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`codPedProd`),
  ADD KEY `pedido` (`pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codProd`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`codRes`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `codPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `codPedProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `codRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`restaurante`) REFERENCES `restaurantes` (`codRes`);

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`codPed`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
