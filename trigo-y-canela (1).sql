-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 06:35:34
-- Versión del servidor: 8.0.36
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trigo-y-canela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `usuario` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `token_password` varchar(40) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `password_request` tinyint NOT NULL DEFAULT '0',
  `activo` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`, `nombre`, `email`, `token_password`, `password_request`, `activo`, `fecha_alta`) VALUES
(1, 'admin', '$2y$10$29N2Qee25RMxNGL28GF3YuPZacvk/kLI45Fx8Sd/wkNd18A1jv0Pi', 'Administrador', 'trigoycanelacontacto@gmail.com', NULL, 0, 1, '2024-10-04 16:53:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL,
  `activo` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
(1, 'Pastelería de sal ', 1),
(2, 'Pastelería dulce', 0),
(3, 'ROPA 3 CATE', 0),
(4, 'ROPA', 0),
(5, 'ELECTRODOMESTICOS', 0),
(6, 'Pastelería de sal editado', 0),
(7, 'ELECTRODOMESTICOS editado', 0),
(8, 'Pastelería de sal categoria ', 0),
(9, 'Pastelería de sal categoria 1', 0),
(10, 'ROPA 2', 0),
(11, 'adasdad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombres` varchar(80) COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8mb3_spanish_ci NOT NULL,
  `estatus` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `telefono`, `cedula`, `estatus`, `fecha_alta`, `fecha_modifica`, `fecha_baja`) VALUES
(1, 'Ronald', 'Trujillo', 'lacrowxd@gmail.com', '291992912', '1000129129192', 1, '2024-10-03 16:51:15', NULL, NULL),
(2, 'Maria', 'Jose', 'Mariajose@gmail.com', '31992121218', '1838191992111', 1, '2024-10-22 23:28:30', NULL, NULL),
(4, 'Jose', 'Lito', 'Jose201021@gmail.com', '3102929111', '100381828112', 1, '2024-10-22 23:30:50', NULL, NULL),
(5, 'Jose', 'Lito', 'ronald.lacrow@gmail.com', '3102929111', '100381828112', 1, '2024-10-22 23:31:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int NOT NULL,
  `id_transaccion` varchar(20) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_cliente` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '29M07144T3052293H', '2024-10-04 18:58:45', 'COMPLETED', 'lacrowxd@gmail.com', 1, 63),
(2, '4BY7505611011624U', '2024-10-22 17:39:11', 'COMPLETED', 'lacrowxd@gmail.com', 1, 144990),
(3, '9LL81067UR9744111', '2024-10-22 17:40:11', 'COMPLETED', 'lacrowxd@gmail.com', 1, 25150),
(4, '1ML40073CR140140H', '2024-10-22 17:42:23', 'COMPLETED', 'lacrowxd@gmail.com', 1, 124250),
(5, '5XE237872B6384323', '2024-10-23 06:20:23', 'COMPLETED', 'lacrowxd@gmail.com', 1, 144300),
(6, '4HH48319R3528501M', '2024-10-23 06:23:47', 'COMPLETED', 'lacrowxd@gmail.com', 1, 58880),
(7, '85U4838198453482M', '2024-10-23 06:24:37', 'COMPLETED', 'lacrowxd@gmail.com', 1, 8500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `valor` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
(1, 'tienda_nombre', 'trigo y canela'),
(2, 'tienda_telefono', '3105656659'),
(3, 'tienda_moneda', '$'),
(4, 'correo_smtp', 'smtp.gmail.com'),
(5, 'correo_puerto', '587'),
(6, 'correo_email', 'trigoycanelacontacto@gmail.com'),
(7, 'correo_password', 'Q7Xy0Qa1SycREyg3MRoy770heNN3iqUiZZ2hdP5t08NGFWdJ3ZLhqfIPma58cg4H'),
(8, 'paypal_cliente', 'Abgb3Df95H4DiacyeLBEQ7imLvdnPWkxVEKUIcgO4fSnFpn8vycBsZJlE1b9OvO-QZqEsCLWybj90zxi'),
(9, 'paypal_moneda', 'USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` decimal(10,3) NOT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 3, 'Empanada chilena', 8.640, 1),
(2, 1, 4, 'Empanada de carne', 8.500, 2),
(3, 1, 5, 'Palo de queso parmesano', 7.400, 5),
(4, 2, 3, 'Palo de queso parmesano', 7030.000, 8),
(5, 2, 1, 'Empanada chilena', 8640.000, 1),
(6, 2, 8, 'Pastel de champiñiones', 8500.000, 2),
(7, 2, 7, 'Pastel de pernil', 8010.000, 1),
(8, 2, 2, 'Empanada de carne', 8500.000, 3),
(9, 2, 4, 'Palo Hojaldre Ranchero', 7400.000, 4),
(10, 3, 2, 'Empanada de carne', 8500.000, 1),
(11, 3, 1, 'Empanada chilena', 8640.000, 1),
(12, 3, 7, 'Pastel de pernil', 8010.000, 1),
(13, 4, 4, 'Palo Hojaldre Ranchero', 7400.000, 4),
(14, 4, 3, 'Palo de queso parmesano', 7030.000, 4),
(15, 4, 8, 'Pastel de champiñiones', 8500.000, 5),
(16, 4, 7, 'Pastel de pernil', 8010.000, 3),
(17, 5, 3, 'Palo de queso parmesano', 7030.000, 10),
(18, 5, 4, 'Palo Hojaldre Ranchero', 7400.000, 10),
(19, 6, 3, 'Palo de queso parmesano', 7030.000, 1),
(20, 6, 2, 'Empanada de carne', 8500.000, 1),
(21, 6, 1, 'Empanada chilena', 8640.000, 1),
(22, 6, 8, 'Pastel de champiñiones', 8500.000, 1),
(23, 6, 7, 'Pastel de pernil', 8010.000, 1),
(24, 6, 5, 'Pastel de jamon y queso ', 10800.000, 1),
(25, 6, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(26, 7, 2, 'Empanada de carne', 8500.000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` int NOT NULL,
  `descuento` tinyint NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `id_categoria` int NOT NULL,
  `activo` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `descuento`, `stock`, `id_categoria`, `activo`) VALUES
(1, 'Empanada chilena', '\r\n\r\nEmpanada chilena de pino horneada, rellena con carne de res sazonada, cebolla caramelizada, huevo duro, pasas y aceitunas negras, envuelta en una masa crujiente dorada al horno', '67143e066dc31_67143612d2bd7_Empanada-Chilena.jpg', 9600, 10, 49, 1, 1),
(2, 'Empanada de carne', 'Empanada tradicional rellena con carne de res jugosa y especiada, mezclada con cebolla, pimientos y un toque de ajo, envuelta en una masa dorada y crujiente.', '67143e7366c2d_Empanada-de-carne-Pequena-768x576.jpg.jpg', 8500, 0, 18, 1, 1),
(3, 'Palo de queso parmesano', 'Palo de queso parmesano, un queso duro y añejo, elaborado con leche de vaca, sal y cultivos lácteos', '67143ef3ae58c_Palo-de-queso-parmesano-768x576.jpg', 7400, 5, 100, 1, 1),
(4, 'Palo Hojaldre Ranchero', 'Indulgente palo de hojaldre ranchero, elaborado con una masa hojaldrada casera, rellena de una generosa porción de carne deshebrada, cocida a fuego lento en una salsa ranchera especiada', '67143f9eaea9f_Palo-de-Hojaldre-Ranchero-768x576.jpg.jpg', 7400, 0, 59, 1, 1),
(5, 'Pastel de jamon y queso ', 'Delicioso pastel de jamón y queso, perfecto para cualquier ocasión. Capas de jamón cocido y queso derretido, intercaladas con una suave bechamel, todo ello envuelto en una masa hojaldrada crujiente', '671440529b785_Pastel-de-jamon-y-queso-768x576.jpg.jpg', 10800, 0, 39, 1, 1),
(7, 'Pastel de pernil', 'Un pastel de pernil con un toque picante, relleno de carne desmechada adobada, puré de yuca y una salsa de ají amarillo', '6714417a7b640_Pastel-de-Pernil-768x576.jpg.jpg', 8900, 10, 58, 1, 1),
(8, 'Pastel de champiñiones', 'Pastel de Pollo con Champiñones, hecho con pechuga de pollo desmenuzada, champiñones frescos y cebolla, todo sazonado con especias', '671442aa092ff_Pastel-de-Pollo-con-Champinones-768x576.jpg.jpg', 8500, 0, 44, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8mb3_spanish_ci NOT NULL,
  `activacion` int NOT NULL DEFAULT '0',
  `token` varchar(40) COLLATE utf8mb3_spanish_ci NOT NULL,
  `token_password` varchar(40) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `password_request` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
(1, 'Lacrow', '$2y$10$8dJyLJTsZVqJwZ6FJ3gkCucUyx42QYdlOA3WJk7wiF6eo/UvtHbYO', 1, 'b1e2eea82bf3e4a7700db71f34633c3b', '1b36456dda3c6fe871d852f00e795047', 1, 1),
(2, 'Majose21', '$2y$10$FgCe5lSwSCHvIVNd863l9ejwM24Ra2d4Mrq94KMKNSLWM1u0bfnJK', 0, '03f53be43dd63c17dd5b1e8b158055c6', NULL, 0, 2),
(3, 'joselit0x', '$2y$10$3WQlXMoNDwY8WUz3W4DxDOzbkjWXamorauYXmc04.3igeuznSEVHq', 0, '767b6ff00353b24bac34e321de37bbbc', NULL, 0, 3),
(4, 'joselit0xs', '$2y$10$fIXdpSRqFhv1xZT2ivNiU.6Udo2LqyVcNTUQ7zXACMG7H8aGQWZdK', 0, '3be421754557f6675367518046dbe34d', NULL, 0, 4),
(5, 'joseqqq', '$2y$10$fgx9nEgsZ7wW1x3oEDh3cur3d7XPpnu.l7tjUZ3RO19Bcjhcb/kKq', 1, 'd8fe342f42e7d497c18a8fd6bca06318', '', 0, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra_cliente` (`id_cliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_compra` (`id_compra`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_productos` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`token_password`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria_productos` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
