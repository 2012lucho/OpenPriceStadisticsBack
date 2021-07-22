-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-07-2021 a las 21:27:23
-- Versión del servidor: 10.3.29-MariaDB-0+deb10u1
-- Versión de PHP: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `precios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `address_road` varchar(500) NOT NULL,
  `address_number` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `branch`
--

INSERT INTO `branch` (`id`, `name`, `latitude`, `longitude`, `address_road`, `address_number`, `enterprise_id`) VALUES
(1, 'Monarca Online', 0, 0, '0', 0, 1),
(2, 'Asia Online', 0, 0, '0', 0, 2),
(3, 'Asia - España 502 - Tandil', 0, 0, 'Av. España', 502, 2),
(4, 'Soychú Tandil', 0, 0, '-', 0, 3),
(5, 'Carnicerías Tandil', 0, 0, 'Río de janeiro', 619, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `root_category_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `root_category_id`, `name`) VALUES
(1, NULL, 'Galletita'),
(2, 1, 'Boca de dama'),
(3, 1, 'Galletitas surtidas'),
(4, 1, 'Galletitas \"estilo criollitas\"'),
(5, 1, 'Galletitas rellenas'),
(6, NULL, 'Mermelada'),
(7, 6, 'Mermelada Damasco'),
(8, NULL, 'Café'),
(9, 8, 'Café Soluble'),
(10, NULL, 'Frutas'),
(11, NULL, 'Carne'),
(12, 11, 'Cerdo'),
(13, NULL, 'Fideo'),
(14, 13, 'Mostachol'),
(15, NULL, 'Antitranspirante'),
(16, 15, 'Antitranspirante en Aerosol'),
(17, NULL, 'Yerba'),
(18, 27, 'Shampoo'),
(19, NULL, 'Suavizante'),
(20, 13, 'Fideo Moño'),
(21, NULL, 'Tomate en Lata'),
(22, NULL, 'Productos de Limpieza'),
(23, 22, 'Lavandina'),
(24, 23, 'Lavandina en Gel'),
(25, NULL, 'Atun'),
(26, 25, 'Atún Desmenuzado al Natural'),
(27, NULL, 'Aseo Personal'),
(28, 27, 'Pasta Dental'),
(29, NULL, 'Arroz'),
(30, NULL, 'Aceite'),
(31, 30, 'Aceite Girasol'),
(32, NULL, 'Caldo'),
(33, 32, 'Caldo de Gallina'),
(34, NULL, 'Jabón Líquido'),
(35, 1, 'Galletita c Chips'),
(36, NULL, 'Mayonesa'),
(37, NULL, 'Cacao'),
(38, NULL, 'Milanesa'),
(39, 38, 'Milanesa de Pollo'),
(45, 11, 'Carne de Vaca'),
(46, 45, 'Asado de Ternera'),
(47, 45, 'Tapa de asado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprice`
--

CREATE TABLE `enterprice` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enterprice`
--

INSERT INTO `enterprice` (`id`, `name`) VALUES
(4, 'Carnicerías Tandil'),
(3, 'Soychú Tandil'),
(2, 'Supermercados Asia'),
(1, 'Supermercados Monarca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `date_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `es_oferta` tinyint(1) NOT NULL,
  `porcentage_oferta` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `price`
--

INSERT INTO `price` (`id`, `product_id`, `price`, `date_time`, `user_id`, `branch_id`, `es_oferta`, `porcentage_oferta`) VALUES
(6, 1, 90, '2021-07-16 16:43:29', NULL, 1, 0, NULL),
(7, 2, 140, '2021-07-16 16:45:20', NULL, 1, 0, NULL),
(8, 3, 109.3, '2021-07-16 16:52:00', NULL, 1, 0, NULL),
(9, 5, 150, '2021-07-14 17:00:19', NULL, 2, 0, NULL),
(10, 6, 90, '2021-07-14 17:03:34', NULL, 2, 0, NULL),
(11, 7, 290, '2021-07-05 17:09:35', NULL, 2, 0, NULL),
(12, 8, 70, '2021-06-14 17:13:04', NULL, 2, 0, NULL),
(13, 9, 75, '2021-07-08 20:06:22', NULL, 1, 0, NULL),
(14, 10, 300, '2021-07-08 20:08:31', NULL, 1, 0, NULL),
(15, 11, 190, '2021-07-08 20:12:39', NULL, 1, 0, NULL),
(16, 12, 400, '2021-07-08 20:14:35', NULL, 1, 0, NULL),
(17, 13, 440, '2021-07-08 20:18:11', NULL, 2, 0, NULL),
(18, 14, 125, '2021-07-08 20:20:43', NULL, 1, 0, NULL),
(19, 15, 110, '2021-07-08 20:27:04', NULL, 1, 0, NULL),
(20, 16, 95, '2021-07-08 20:30:27', NULL, 1, 0, NULL),
(21, 17, 270, '2021-07-08 20:35:51', NULL, 1, 0, NULL),
(22, 18, 100, '2021-07-08 20:38:26', NULL, 1, 0, NULL),
(23, 19, 205, '2021-07-08 20:41:34', NULL, 1, 0, NULL),
(24, 20, 180, '2021-07-08 20:43:43', NULL, 1, 0, NULL),
(25, 21, 200, '2021-07-08 20:46:44', NULL, 1, 0, NULL),
(26, 22, 365, '2021-07-08 20:49:14', NULL, 1, 0, NULL),
(27, 23, 109, '2021-07-08 20:51:34', NULL, 1, 0, NULL),
(28, 24, 600, '2021-07-12 20:56:36', NULL, 2, 0, NULL),
(29, 25, 650, '2021-07-12 20:58:58', NULL, 2, 0, NULL),
(30, 26, 80, '2021-07-12 21:02:41', NULL, 3, 0, NULL),
(31, 27, 180, '2021-07-11 21:05:01', NULL, 3, 0, NULL),
(32, 28, 130, '2021-07-05 21:10:05', NULL, 3, 1, 13),
(33, 29, 50, '2021-07-05 21:12:23', NULL, 3, 1, 50),
(34, 30, 200, '2021-12-02 21:17:26', NULL, 4, 0, NULL),
(35, 31, 500, '2021-07-07 21:24:43', NULL, 5, 0, NULL),
(36, 32, 650, '2021-07-07 21:26:43', NULL, 5, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `vendor_id`) VALUES
(1, 'Galletita Terrabusi Boca de Dama - 160Gr', 1),
(2, 'Galletita Terrabusi Surtidas - 400 Gr', 1),
(3, 'Galletitas Express Clasicas - x3 - 324Gr', 2),
(4, 'Galletitas Oreo - 117Gr', 3),
(5, 'Mermelada de Damasco - 360Gr', 5),
(6, 'Galletitas Chocolinas - 170 Gr', 7),
(7, 'Café Soluble Dolca Suave - 170Gr', 9),
(8, 'Tomate', 10),
(9, 'Fideos Mostachol Knorr- 500Gr', 11),
(10, 'Café Arlistán - 170Gr', 12),
(11, 'Antitranspirante Dove - Hombre - Aerosol - 150Ml', 13),
(12, 'Yerba Mate - Nobleza Gaucha - Suave - 500Gr', 14),
(13, 'Shampoo - Tresemmé - Hidratación Profunda - 750 Ml', 15),
(14, 'Suavizante - Vivere - 900Ml', 16),
(15, 'Fideos Moño - Matarazzo - 500Gr', 17),
(16, 'Tomate Perita en Lata - INCA - 400Gr', 18),
(17, 'Lavandina en Gel - Ayudín - 1,5L', 19),
(18, 'Atún Desmenuzado al Natural - Caracas - 170Gr', 20),
(19, 'Pasta Dental - Colgate Sensitive Blanqueadora - 100Gr', 21),
(20, 'Arroz Gallo - Largo Fino - 1Kg', 22),
(21, 'Aceite Lira - Girasol - 900Ml', 23),
(22, 'Shampoo Sedal - Restauración Instantánea - 650 Ml', 24),
(23, 'Caldo de Gallina - Knorr - 12u', 11),
(24, 'Jabón Líquido - Ala - 3L', 25),
(25, 'Jabón Líquido - Skip - 3L', 26),
(26, 'Arroz - Yatay - 1Kg', 27),
(27, 'Galletitas Pepitos - 3 unidades - 357Gr', 28),
(28, 'Mayonesa - Hellmann\'s - 475Gr', 29),
(29, 'Cacao Arcor - 180Gr', 30),
(30, 'Milanesa de Pollo - Soychú - 1Kg', 31),
(31, 'Asado de ternera - 1Kg', 10),
(32, 'Tapa de asado - 1Kg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(5, 5, 7),
(6, 6, 1),
(7, 7, 9),
(8, 8, 10),
(9, 9, 14),
(10, 10, 9),
(11, 11, 16),
(12, 12, 17),
(13, 13, 18),
(14, 14, 19),
(15, 15, 20),
(16, 16, 21),
(17, 17, 24),
(18, 18, 26),
(19, 19, 28),
(20, 20, 29),
(21, 21, 31),
(22, 22, 18),
(23, 23, 33),
(24, 24, 34),
(25, 25, 34),
(26, 27, 35),
(27, 28, 36),
(28, 29, 37),
(29, 30, 39),
(30, 31, 46),
(31, 32, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `root_vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `root_vendor_id`) VALUES
(1, 'Terrabusi', NULL),
(2, 'Express', 1),
(3, 'Oreo', NULL),
(4, 'La Campagnola', NULL),
(5, 'BC', 4),
(6, 'Bagley', NULL),
(7, 'Chocolinas', 6),
(8, 'Nescafe', NULL),
(9, 'Dolca', 8),
(10, 'Desconocido', NULL),
(11, 'Knorr', NULL),
(12, 'Arlistán', NULL),
(13, 'Dove', NULL),
(14, 'Nobleza Gaucha', NULL),
(15, 'Tresemmé', NULL),
(16, 'Vivere', NULL),
(17, 'Matarazzo', NULL),
(18, 'INCA', NULL),
(19, 'Ayudín', NULL),
(20, 'Caracas', NULL),
(21, 'Colgate', NULL),
(22, 'Gallo', NULL),
(23, 'Lira', NULL),
(24, 'Sedal', NULL),
(25, 'Ala', NULL),
(26, 'Skip', NULL),
(27, 'Yatay', NULL),
(28, 'Pepitos', NULL),
(29, 'Hellmann\'s', NULL),
(30, 'Arcor', NULL),
(31, 'Soychú', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `root_category_id` (`root_category_id`);

--
-- Indices de la tabla `enterprice`
--
ALTER TABLE `enterprice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indices de la tabla `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `root_vendor_id` (`root_vendor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `enterprice`
--
ALTER TABLE `enterprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprice` (`id`);

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`root_category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Filtros para la tabla `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`root_vendor_id`) REFERENCES `vendor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
