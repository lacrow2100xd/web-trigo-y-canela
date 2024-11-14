-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 04:52:48
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
(1, 'admin', '$2y$10$29N2Qee25RMxNGL28GF3YuPZacvk/kLI45Fx8Sd/wkNd18A1jv0Pi', 'admin', 'trigoycanelacontacto@gmail.com', NULL, 0, 1, '2024-10-04 16:53:02');

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
(1, 'Pastelería de sal', 1),
(2, 'Pastelería dulce', 1),
(3, 'Postres', 1),
(4, 'Panes', 1);

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
(1, 'Ronald', 'Trujillo', 'ronald.lacrow@gmail.com', '3105656659', '1003634157', 1, '2024-10-28 15:27:43', NULL, NULL),
(2, 'Nicolas', 'Romero Garzon', 'lacrow.ronald@gmail.com', '3192120011', '1039123911', 1, '2024-11-08 20:25:20', NULL, NULL),
(3, 'Maria', 'Rodriguez', 'bipijennuca-8624@yopmail.com', '319388121211', '10031929199111', 1, '2024-11-13 20:37:13', NULL, NULL),
(4, 'Jesus david', 'Cutinitti', 'treucranneugreisou-6103@yopmail.com', '3181992121', '1938818121', 1, '2024-11-13 20:46:45', NULL, NULL),
(5, 'zaira', 'gonzales ramirez', 'brubisahira-8599@yopmail.com', '310201012', '1000129192', 1, '2024-11-13 22:06:33', NULL, NULL),
(6, 'andrea', 'oliveira', 'greupiliwobe-1731@yopmail.com', '3230011211', '599912111', 1, '2024-11-13 22:29:36', NULL, NULL);

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
(1, '9F280078YJ3801442', '2024-10-01 03:10:13', 'COMPLETED', 'ronald.lacrow@gmail.com', 1, 42780),
(2, '3J358509L6687100L', '2024-10-05 01:30:11', 'COMPLETED', 'ronald.lacrow@gmail.com', 1, 19900),
(3, '8HT020524W540891U', '2024-10-05 01:48:48', 'COMPLETED', 'ronald.lacrow@gmail.com', 1, 128030),
(4, '7ED5558238905804R', '2024-10-05 02:39:41', 'COMPLETED', 'lacrow.ronald@gmail.com', 2, 44310),
(5, '1HG13252H89701154', '2024-10-05 02:43:15', 'COMPLETED', 'lacrow.ronald@gmail.com', 2, 177080),
(6, '7D450267L6066253J', '2024-10-05 02:39:13', 'COMPLETED', 'bipijennuca-8624@yopmail.com', 3, 75500),
(7, '0YH82836TE9481140', '2024-10-05 02:47:36', 'COMPLETED', 'treucranneugreisou-6103@yopmail.com', 4, 49750),
(8, '5H960625LC887725K', '2024-10-05 04:07:44', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 420980),
(9, '98S98757H1466072B', '2024-10-22 04:16:43', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 100800),
(10, '426875164N822560S', '2024-10-26 04:17:13', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 200190),
(11, '7W254811VX945753G', '2024-10-27 04:18:23', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 47510),
(12, '34C75367PV9113043', '2024-10-28 04:18:53', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 126000),
(13, '5KJ55097AB6694632', '2024-10-29 04:19:44', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 262660),
(14, '8HU38654GS2892213', '2024-11-01 04:21:20', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 249095),
(15, '1U776586CM811502N', '2024-11-02 04:22:10', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 75700),
(16, '7JJ72360P27701050', '2024-11-11 04:23:29', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 6500),
(17, '4TH534289B665740B', '2024-11-11 04:24:42', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 35395),
(18, '9SS20959KN1178507', '2024-11-12 04:26:19', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 41820),
(19, '6KN13583LD123715Y', '2024-11-13 04:26:45', 'COMPLETED', 'brubisahira-8599@yopmail.com', 5, 88900),
(20, '1D852891S82895332', '2024-11-14 04:30:21', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 8010),
(21, '41U92892PC324845S', '2024-11-15 04:31:17', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 173800),
(22, '76B756801E264813D', '2024-11-16 04:31:44', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 97310),
(23, '8SD70387R41968343', '2024-11-17 04:33:27', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 145570),
(24, '6FH472959H2171539', '2024-10-11 04:34:12', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 364470),
(25, '75D40900H1723020V', '2024-11-12 04:38:49', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 34000),
(26, '7Y867660WS882892M', '2024-09-01 04:41:44', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 59800),
(27, '4RK03988JN922553V', '2024-09-02 04:42:58', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 8500),
(28, '2H177923TV331863G', '2024-09-02 04:44:39', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 12500),
(29, '1PT55855KA997025B', '2024-09-02 04:45:02', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 7400),
(30, '9TX77927N0496954B', '2024-09-02 04:45:25', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 22895),
(31, '3JG841993U209081U', '2024-09-02 04:45:50', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 7900),
(32, '4MS672166M224410H', '2024-09-02 04:46:10', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 7900),
(33, '81A24469938313336', '2024-09-02 04:46:32', 'COMPLETED', 'greupiliwobe-1731@yopmail.com', 6, 8500);

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
(1, 1, 1, 'Empanada chilena ', 8640.000, 2),
(2, 1, 2, 'Empanada de carne', 8500.000, 3),
(3, 2, 10, 'Milhojas', 12500.000, 1),
(4, 2, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(5, 3, 1, 'Empanada chilena ', 8640.000, 1),
(6, 3, 2, 'Empanada de carne', 8500.000, 1),
(7, 3, 3, 'Palo de queso parmesano', 7030.000, 5),
(8, 3, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(9, 3, 5, 'Pastel de jamon y queso ', 10800.000, 1),
(10, 3, 6, 'Pastel de pernil', 8010.000, 4),
(11, 3, 7, 'Pastel de champiñiones', 8500.000, 1),
(12, 3, 8, 'Pastel de Verduras', 8500.000, 2),
(13, 4, 2, 'Empanada de carne', 8500.000, 1),
(14, 4, 8, 'Pastel de Verduras', 8500.000, 1),
(15, 4, 7, 'Pastel de champiñiones', 8500.000, 1),
(16, 4, 6, 'Pastel de pernil', 8010.000, 1),
(17, 4, 5, 'Pastel de jamon y queso ', 10800.000, 1),
(18, 5, 2, 'Empanada de carne', 8500.000, 9),
(19, 5, 3, 'Palo de queso parmesano', 7030.000, 2),
(20, 5, 4, 'Palo Hojaldre Ranchero', 7400.000, 4),
(21, 5, 6, 'Pastel de pernil', 8010.000, 2),
(22, 5, 5, 'Pastel de jamon y queso ', 10800.000, 3),
(23, 5, 7, 'Pastel de champiñiones', 8500.000, 1),
(24, 6, 10, 'Milhojas', 12500.000, 4),
(25, 6, 7, 'Pastel de champiñiones', 8500.000, 3),
(26, 7, 2, 'Empanada de carne', 8500.000, 1),
(27, 7, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(28, 7, 3, 'Palo de queso parmesano', 7030.000, 1),
(29, 7, 5, 'Pastel de jamon y queso ', 10800.000, 1),
(30, 7, 6, 'Pastel de pernil', 8010.000, 2),
(31, 8, 19, 'Brazo de reina de fresa', 82100.000, 3),
(32, 8, 20, 'Éclair', 6900.000, 2),
(33, 8, 28, 'Pan Trenza', 13680.000, 2),
(34, 8, 27, 'Pan de Yuca', 6500.000, 2),
(35, 8, 26, 'Pan al Chocolate', 7900.000, 5),
(36, 8, 21, 'Almojábana', 6500.000, 4),
(37, 8, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 2),
(38, 8, 13, 'Pastel Con Mora y Queso', 7900.000, 2),
(39, 8, 10, 'Milhojas', 12500.000, 2),
(40, 9, 8, 'Pastel de Verduras', 8500.000, 1),
(41, 9, 12, 'Pastel de Coco', 59800.000, 1),
(42, 9, 15, 'Budin de frutos rojos ', 11100.000, 2),
(43, 9, 14, 'Rollito de Crema', 10300.000, 1),
(44, 10, 28, 'Pan Trenza', 13680.000, 1),
(45, 10, 27, 'Pan de Yuca', 6500.000, 2),
(46, 10, 24, 'Croissant con Queso', 9100.000, 4),
(47, 10, 18, 'Pastel Gloria', 65000.000, 2),
(48, 10, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 1),
(49, 11, 9, 'Pastel de queso fundido', 10800.000, 1),
(50, 11, 4, 'Palo Hojaldre Ranchero', 7400.000, 2),
(51, 11, 6, 'Pastel de pernil', 8010.000, 1),
(52, 11, 21, 'Almojábana', 6500.000, 1),
(53, 11, 25, 'Croissant Sencillo', 7400.000, 1),
(54, 12, 4, 'Palo Hojaldre Ranchero', 7400.000, 5),
(55, 12, 2, 'Empanada de carne', 8500.000, 2),
(56, 12, 15, 'Budin de frutos rojos ', 11100.000, 4),
(57, 12, 20, 'Éclair', 6900.000, 4),
(58, 13, 18, 'Pastel Gloria', 65000.000, 2),
(59, 13, 13, 'Pastel Con Mora y Queso', 7900.000, 3),
(60, 13, 9, 'Pastel de queso fundido', 10800.000, 1),
(61, 13, 10, 'Milhojas', 12500.000, 2),
(62, 13, 7, 'Pastel de champiñiones', 8500.000, 2),
(63, 13, 27, 'Pan de Yuca', 6500.000, 2),
(64, 13, 28, 'Pan Trenza', 13680.000, 2),
(65, 13, 16, 'Pastel de Arequipe Hojaldrado', 7900.000, 2),
(66, 14, 5, 'Pastel de jamon y queso ', 10800.000, 1),
(67, 14, 9, 'Pastel de queso fundido', 10800.000, 1),
(68, 14, 13, 'Pastel Con Mora y Queso', 7900.000, 1),
(69, 14, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 1),
(70, 14, 21, 'Almojábana', 6500.000, 10),
(71, 14, 26, 'Pan al Chocolate', 7900.000, 1),
(72, 14, 25, 'Croissant Sencillo', 7400.000, 1),
(73, 14, 2, 'Empanada de carne', 8500.000, 1),
(74, 14, 3, 'Palo de queso parmesano', 7030.000, 3),
(75, 14, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(76, 14, 10, 'Milhojas', 12500.000, 1),
(77, 14, 11, 'Tartaletas de Coco ', 22895.000, 1),
(78, 14, 12, 'Pastel de Coco', 59800.000, 1),
(79, 15, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(80, 15, 8, 'Pastel de Verduras', 8500.000, 1),
(81, 15, 12, 'Pastel de Coco', 59800.000, 1),
(82, 16, 27, 'Pan de Yuca', 6500.000, 1),
(83, 17, 10, 'Milhojas', 12500.000, 1),
(84, 17, 11, 'Tartaletas de Coco ', 22895.000, 1),
(85, 18, 20, 'Éclair', 6900.000, 4),
(86, 18, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 2),
(87, 19, 2, 'Empanada de carne', 8500.000, 7),
(88, 19, 22, 'Croissant con Almendras', 9800.000, 3),
(89, 20, 6, 'Pastel de pernil', 8010.000, 1),
(90, 21, 16, 'Pastel de Arequipe Hojaldrado', 7900.000, 5),
(91, 21, 15, 'Budin de frutos rojos ', 11100.000, 3),
(92, 21, 19, 'Brazo de reina de fresa', 82100.000, 1),
(93, 21, 24, 'Croissant con Queso', 9100.000, 1),
(94, 21, 22, 'Croissant con Almendras', 9800.000, 1),
(95, 22, 9, 'Pastel de queso fundido', 10800.000, 1),
(96, 22, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 1),
(97, 22, 18, 'Pastel Gloria', 65000.000, 1),
(98, 22, 21, 'Almojábana', 6500.000, 1),
(99, 22, 26, 'Pan al Chocolate', 7900.000, 1),
(100, 23, 4, 'Palo Hojaldre Ranchero', 7400.000, 3),
(101, 23, 20, 'Éclair', 6900.000, 1),
(102, 23, 28, 'Pan Trenza', 13680.000, 8),
(103, 23, 3, 'Palo de queso parmesano', 7030.000, 1),
(104, 24, 2, 'Empanada de carne', 8500.000, 1),
(105, 24, 3, 'Palo de queso parmesano', 7030.000, 2),
(106, 24, 19, 'Brazo de reina de fresa', 82100.000, 2),
(107, 24, 22, 'Croissant con Almendras', 9800.000, 1),
(108, 24, 21, 'Almojábana', 6500.000, 3),
(109, 24, 17, 'Pastel de Guayaba Hojaldrado', 7110.000, 1),
(110, 24, 18, 'Pastel Gloria', 65000.000, 1),
(111, 24, 14, 'Rollito de Crema', 10300.000, 1),
(112, 24, 13, 'Pastel Con Mora y Queso', 7900.000, 1),
(113, 24, 15, 'Budin de frutos rojos ', 11100.000, 1),
(114, 24, 16, 'Pastel de Arequipe Hojaldrado', 7900.000, 3),
(115, 24, 10, 'Milhojas', 12500.000, 1),
(116, 24, 9, 'Pastel de queso fundido', 10800.000, 1),
(117, 25, 2, 'Empanada de carne', 8500.000, 4),
(118, 26, 12, 'Pastel de Coco', 59800.000, 1),
(119, 27, 2, 'Empanada de carne', 8500.000, 1),
(120, 28, 10, 'Milhojas', 12500.000, 1),
(121, 29, 4, 'Palo Hojaldre Ranchero', 7400.000, 1),
(122, 30, 11, 'Tartaletas de Coco ', 22895.000, 1),
(123, 31, 13, 'Pastel Con Mora y Queso', 7900.000, 1),
(124, 32, 16, 'Pastel de Arequipe Hojaldrado', 7900.000, 1),
(125, 33, 8, 'Pastel de Verduras', 8500.000, 1);

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
(1, 'Empanada chilena ', '<p>Empanada chilena de pino horneada, rellena con carne de res sazonada, cebolla caramelizada, huevo duro, pasas y aceitunas negras, envuelta en una masa crujiente dorada al horno</p>', '67355ca0672f4_67143612d2bd7_Empanada-Chilena.jpg', 9600, 10, 0, 1, 1),
(2, 'Empanada de carne', '<p>Empanada tradicional rellena con carne de res jugosa y especiada, mezclada con cebolla, pimientos y un toque de ajo, envuelta en una masa dorada y crujiente.</p>', '671e8ba89fe15_Empanada-de-carne-Pequena-768x576.jpg.jpg', 8500, 0, 23, 1, 1),
(3, 'Palo de queso parmesano', '<p>Palo de queso parmesano, un queso duro y añejo, elaborado con leche de vaca, sal y cultivos lácteos</p>', '671e8bc645014_Palo-de-queso-parmesano-768x576.jpg', 7400, 5, 21, 1, 1),
(4, 'Palo Hojaldre Ranchero', 'Indulgente palo de hojaldre ranchero, elaborado con una masa hojaldrada casera, rellena de una generosa porción de carne deshebrada, cocida a fuego lento en una salsa ranchera especiada', '67143f9eaea9f_Palo-de-Hojaldre-Ranchero-768x576.jpg.jpg', 7400, 0, 26, 1, 1),
(5, 'Pastel de jamon y queso ', 'Delicioso pastel de jamón y queso, perfecto para cualquier ocasión. Capas de jamón cocido y queso derretido, intercaladas con una suave bechamel, todo ello envuelto en una masa hojaldrada crujiente', '671440529b785_Pastel-de-jamon-y-queso-768x576.jpg.jpg', 10800, 0, 60, 1, 1),
(6, 'Pastel de pernil', '<p>Un pastel de pernil con un toque picante, relleno de carne desmechada adobada, puré de yuca y una salsa de ají amarillo</p>', '671e8be46297c_Pastel-de-Pernil-768x576.jpg.jpg', 8900, 10, 47, 1, 1),
(7, 'Pastel de champiñiones', '<p>Pastel de Pollo con Champiñones, hecho con pechuga de pollo desmenuzada, champiñones frescos y cebolla, todo sazonado con especias</p>', '671e8bf399168_Pastel-de-Pollo-con-Champinones-768x576.jpg.jpg', 8500, 0, 36, 1, 1),
(8, 'Pastel de Verduras', '<p>Empanada horneada, rellena con trozos tiernos de pollo sazonado, acompañados de una mezcla de verduras frescas como zanahoria, arvejas y pimentón, envuelta en una masa crujiente y dorada al horno, que aporta un equilibrio perfecto entre su relleno jugoso y su exterior ligeramente crocante.</p>', '671e8c18cfbc9_Pastel-de-Pollo-768x576.jpg.jpg', 8500, 0, 18, 1, 1),
(9, 'Pastel de queso fundido', '<p>Pastel de queso fundido al horno, con una&nbsp;<span style=\"background-color:hsl(0, 0%, 100%);\"> textura suave</span> y cremosa, elaborado con una mezcla de quesos seleccionados que se derriten a la perfección.</p>', '671e8c4315d61_Pastel-de-Queso-fundido-768x576.jpg.jpg', 10800, 0, 11, 1, 1),
(10, 'Milhojas', '<p>Milhojas de hojaldre artesano, crema de vainilla y fruta fresca, una delicia que destaca por sus ingredientes selectos. Capas finas y crujientes de hojaldre dorado, elaboradas con mantequilla de alta calidad para un sabor y textura inigualable</p>', '67244fb10c80e_miloha-3-768x576.jpg.jpg', 12500, 0, 20, 3, 1),
(11, 'Tartaletas de Coco ', '<p>Tartaletas de coco suaves y deliciosas, con una base de masa dorada y crujiente, rellenas de una mezcla cremosa de coco fresco y un toque de vainilla. Su textura tierna y sabor dulce las hacen el postre ideal para compartir. Presentación de 4 unidades.</p>', '6735580784f60_santaelenafoto_0133-copia-768x512.jpg.jpg', 24100, 5, 12, 2, 1),
(12, 'Pastel de Coco', '<p>Pastel de coco esponjoso y húmedo, elaborado con coco rallado fresco que le aporta una textura suave y un sabor tropical. Cubierto con una capa de crema de coco y un toque de vainilla, que realza su dulzura natural.</p>', '67355c3e6bce0_pastel-de-coco-22-768x576.jpg', 65000, 8, 35, 2, 1),
(13, 'Pastel Con Mora y Queso', '<p>Pastel con mora y queso, una combinación irresistible de sabores frescos y cremosos. Este pastel cuenta con capas suaves y esponjosas, rellenas con una mezcla dulce de moras frescas y un toque de queso cremoso, que crea un equilibrio perfecto entre el dulzor y la acidez de la fruta.</p>', '67355d2645bfe_Pastel-de-Mora-y-queso-768x576.jpg.jpg', 7900, 0, 44, 2, 1),
(14, 'Rollito de Crema', '<p>Rollito de crema suave y esponjoso, relleno de una delicada crema de vainilla que se derrite en cada bocado. Su masa ligera y su relleno cremoso crean un equilibrio perfecto entre dulzura y textura, convirtiéndolo en el antojo ideal para acompañar con un café o disfrutar como postre en cualquier momento del día.</p>', '67355da202792_rollito-de-crema-768x545.jpg.jpg', 10300, 0, 25, 3, 1),
(15, 'Budin de frutos rojos ', '<p>Budín de frutos rojos, húmedo y suave, elaborado con una mezcla de moras, fresas y arándanos frescos que le aportan un toque de acidez y un color vibrante. Cada rebanada está llena de trozos jugosos de fruta, equilibrados con un toque de vainilla y un ligero aroma a limón.</p>', '67355e4f49cfa_ThinkstockPhotos-460257797.jpg', 11100, 0, 32, 3, 1),
(16, 'Pastel de Arequipe Hojaldrado', '<p>Pastel de arequipe hojaldrado, una delicia de capas finas y crujientes de hojaldre que se alternan con un relleno cremoso de arequipe suave y dulce. Cada bocado combina la textura ligera del hojaldre con la riqueza del arequipe, creando un equilibrio perfecto entre lo crujiente y lo cremoso.</p>', '67355f3e3cf97_Pastel-de-Arequipe-1-768x576.jpg.jpg', 7900, 0, 0, 2, 1),
(17, 'Pastel de Guayaba Hojaldrado', '<p>Pastel de guayaba hojaldrado, una combinación exquisita de hojaldre dorado y crujiente, relleno con una suave y dulce pasta de guayaba. Cada capa de hojaldre se funde con el sabor tropical y ligeramente ácido de la guayaba, creando una experiencia deliciosa en cada bocado.</p>', '67355f87d34e8_pastel-de-guayaba.jpg.jpg', 7900, 10, 36, 2, 1),
(18, 'Pastel Gloria', '<p>El Pastel Gloria es una joya de la repostería tradicional, elaborado con una masa suave y dorada que envuelve un relleno generoso de dulce de leche y trozos de fruta confitada.</p>', '673560267831e_Pastel-Gloria-1-768x576.jpg', 65000, 0, 36, 2, 1),
(19, 'Brazo de reina de fresa', '<p>El Brazo de Reina de fresa es un exquisito rollo de bizcocho esponjoso, relleno con una suave crema de fresas frescas que le aporta un toque dulce y ligeramente ácido.</p>', '6735613488e08_6422009ee756c.jpeg', 82100, 0, 13, 3, 1),
(20, 'Éclair', '<p>El Éclair es un clásico de la repostería francesa, hecho con una masa choux ligera y delicadamente horneada, rellena con una suave crema pastelera de vainilla o chocolate que se derrite en la boca.</p>', '6735622c1ab78_Eclairs175JBfull-1.jpg', 6900, 0, 12, 3, 1),
(21, 'Almojábana', '<p>Almojábana tradicional elaborada con queso fresco campesino, harina de maíz y un toque de mantequilla, que le aportan una textura esponjosa y un sabor auténtico.</p>', '673564625fa07_Almojabana-1-768x576.jpg.jpg', 6500, 0, 13, 4, 1),
(22, 'Croissant con Almendras', '<p>Croissant con almendras, un clásico francés lleno de sabor y textura. Este croissant está hecho con masa hojaldrada, enriquecida con mantequilla que le da un exterior dorado y crujiente.</p>', '6735650e4b028_Croissant-de-Almendras-1-768x576.jpg.jpg', 9800, 0, 7, 4, 1),
(23, 'Croissant con Jamón y Queso', '<p>Croissant con jamón y queso, una delicia salada que combina lo mejor de la panadería artesanal. Este croissant hojaldrado, dorado y crujiente por fuera, está relleno con jamón jugoso y una capa de queso derretido.</p>', '67356545548a3_croi-jamon-y-queso-768x599.jpg.jpg', 9300, 5, 10, 4, 1),
(24, 'Croissant con Queso', '<p>Croissant con queso, una delicia suave y crujiente que combina la masa hojaldrada y mantequillosa con un delicioso relleno de queso fundido.</p>', '6735658661c95_croi-queso-768x587.jpg', 9100, 0, 12, 4, 1),
(25, 'Croissant Sencillo', '<p>Croissant sencillo, una exquisita pieza de repostería francesa, elaborada con una masa hojaldrada, ligera y delicadamente crujiente por fuera, que se deshace suavemente al morderla.</p>', '673565b55d5e4_Croissant-Sencillo-1-768x576.jpg.jpg', 7400, 0, 30, 4, 1),
(26, 'Pan al Chocolate', '<p>Pan al chocolate, una suave y esponjosa delicia elaborada con una masa rica y ligeramente dulce, rellena con generosos trozos de chocolate que se derriten y crean un contraste perfecto en cada bocado.</p>', '673565f57adf6_Pan-al-Chocolate-2-768x576.jpg', 7900, 0, 6, 4, 1),
(27, 'Pan de Yuca', '<p>Pan de yuca, una deliciosa y suave preparación hecha con almidón de yuca, que le da una textura ligera y esponjosa.</p>', '6735661d67e53_pan-de-yuca-1-768x768.jpg.jpg', 6500, 0, 11, 4, 1),
(28, 'Pan Trenza', '<p>Pan trenza, una pieza artesanal suave y esponjosa, elaborada con masa enriquecida con un toque de mantequilla y azúcar que le da un sabor delicado y ligeramente dulce.</p>', '673566639bc1d_pan-trenza-2-768x507.jpg.jpg', 14400, 5, 14, 4, 1);

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
(6, 'Lacrow', '$2y$10$h3SlNNEzcY02h/sbxuZbKOHqGu951ZgfU/k2WbI.MoXOhc0mXMTPe', 1, '0471bab2f1da54d1cd898d9e026f325f', '', 0, 1),
(7, 'Nicolas', '$2y$10$jK/q7Ph7Hs0YQ2XO1I0lFeSQuvQReVR7Mlomen5rHKuIL4tH/Bs2K', 1, '790446349d4a68c9de9f744ad0f74fab', NULL, 0, 2),
(8, 'usuario2012', '$2y$10$.PEFHD8eWB1L7EciasjSHuvbv2VKvevNo5qAF0zaIzCjpqS6CbvdS', 1, '3b220839ac29dbae820c503d6468e2f5', NULL, 0, 3),
(9, 'treucraneu', '$2y$10$7CBTzUAbl.IYLULAMcSSJ.mkHRZDyQ8xg009fE6kkxHMXUQEmh2Re', 1, '953299396c51ba9db4567db80fefba51', NULL, 0, 4),
(10, 'zaira332', '$2y$10$bZybM1a7NqsThd6R0L5m9.Y0Ayh6j6GMpmgQ7hNNYdPv8jJUxTsma', 1, 'af3178735697cd055157c97bb5648d3c', NULL, 0, 5),
(11, 'andreaia', '$2y$10$NT5otZCQcOp9SfaHIh9MbOfGXsB8i54.alNbVSLXbS2chrMfMMT4u', 1, 'f437a102ff331db6557f128417744b5d', NULL, 0, 6);

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
  ADD KEY `fk_detalle_compra` (`id_compra`),
  ADD KEY `fk_id_producto` (`id_producto`);

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
  ADD UNIQUE KEY `id` (`id`,`token_password`),
  ADD KEY `fk_id_cliente` (`id_cliente`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `fk_detalle_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria_productos` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
