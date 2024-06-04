-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 22:20:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fiestavaquilla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_usuarios`
--

CREATE TABLE `carrito_usuarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedidos`
--

CREATE TABLE `detalles_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(9,2) NOT NULL,
  `fecha_entrega_estimada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedidos`
--

INSERT INTO `detalles_pedidos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `fecha_entrega_estimada`) VALUES
(29, 30, 5, 1, 4.99, '0000-00-00'),
(30, 30, 4, 1, 4.99, '2024-06-06'),
(31, 31, 4, 1, 4.99, '2024-06-06'),
(32, 31, 5, 1, 4.99, '0000-00-00'),
(33, 32, 5, 1, 4.99, '2024-06-07'),
(34, 33, 5, 1, 4.99, '0000-00-00'),
(35, 34, 5, 1, 4.99, '0000-00-00'),
(36, 35, 5, 1, 4.99, '2024-06-09'),
(40, 40, 4, 1, 4.99, '2024-06-10'),
(41, 41, 3, 1, 7.99, '2024-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` enum('Pagado','Pendiente','Enviado','Entregado') NOT NULL DEFAULT 'Pagado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `fecha`, `estado`) VALUES
(30, 49, '2024-05-30 19:37:00', 'Pagado'),
(31, 49, '2024-05-30 19:39:03', 'Pagado'),
(32, 49, '2024-05-31 09:32:33', 'Pagado'),
(33, 49, '2024-05-31 10:16:44', 'Pagado'),
(34, 49, '2024-06-02 19:18:00', 'Pagado'),
(35, 49, '2024-06-02 19:21:54', 'Pagado'),
(36, 49, '2024-06-02 20:03:41', 'Pagado'),
(37, 49, '2024-06-03 11:57:02', 'Pagado'),
(39, 49, '2024-06-03 12:13:08', 'Pagado'),
(40, 49, '2024-06-03 14:18:37', 'Pagado'),
(41, 49, '2024-06-03 22:06:18', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `precio` decimal(9,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`) VALUES
(1, 'Imán San Sebastián 2024', 'Una pieza de magnetismo peculiar y cargada de simbolismo. Con dimensiones de 8cm x 6cm, este imán de nevera es más que un simple accesorio de cocina. En él, se representa una escena única: judíos arrodillados ante San Sebastián durante la festividad de la vaquilla en Fresnedillas de la Oliva.', 9.99, 92),
(2, 'Taza Fiesta de la Vaquilla 2023', '¡Celebra la emoción y la tradición de la Fiesta de la Vaquilla de 2023 con nuestra taza conmemorativa exclusiva!. Esta taza captura la esencia vibrante y festiva de la famosa celebración de Fresnedillas de la Oliva, Madrid.', 14.99, 39),
(3, 'ㅤAbrebotellas Fiesta de la Vaquillaㅤ\r\n2016', 'Revive la emoción y la alegría de la Fiesta de la Vaquilla del 2016 con nuestro abrebotellas conmemorativo. Este práctico y elegante abrebotellas es más que una simple herramienta; es un recuerdo atemporal de una de las celebraciones más icónicas de Fresnedillas de la Oliva, Madrid.', 7.99, 96),
(4, 'Llavero sombrero alcalde y alguacil Fiesta de la Vaquilla', 'Lleva contigo un pedacito de la colorida y alegre Fiesta de la Vaquilla de Fresnedillas de la Oliva con nuestro encantador llavero en forma de sombrero adornado con flores. Este llavero es más que un simple accesorio; es un símbolo de la tradición y la comunidad que define esta festividad tan especial.', 4.99, 43),
(5, 'Llavero judio Fiesta de la Vaquilla', 'Con su diseño meticulosamente elaborado y sus detalles auténticos, nuestro llavero captura la esencia de los judíos o motilones, que desempeñan un papel importante en la celebración de la Vaquilla. Cada vez que lo veas, te recordará la diversidad y la riqueza cultural de esta festividad arraigada en la historia local.', 4.99, 27),
(6, 'Gorro militar judio Fiesta de la Vaquilla', '¡Luce un estilo único y lleno de historia con nuestro gorro militar inspirado en la vibrante Fiesta de la Vaquilla de Fresnedillas de la Oliva!. Este gorro no solo es una declaración de moda audaz, sino también un homenaje a la tradición y el espíritu festivo que caracteriza a esta celebración local.', 19.99, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_reserva` time NOT NULL DEFAULT '12:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `fecha_reserva`, `hora_reserva`) VALUES
(49, 49, '2024-06-04', '12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contrasena`) VALUES
(49, 'alex', 'florin', 'alex@iesvalmayor.es', 'cb91a8fcf60aa31a99d22c8b7845e37e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_producto` (`id_producto`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_pedido` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_fecha_hora` (`usuario_id`,`fecha_reserva`,`hora_reserva`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD CONSTRAINT `carrito_usuarios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD CONSTRAINT `detalles_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_pedidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_usuario_reserva` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
