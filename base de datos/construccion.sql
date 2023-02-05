create schema id20256869_construccion;
use id20256869_construccion;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `construccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Cod_categoria` smallint(10) UNSIGNED NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Cod_categoria`, `Nombre`) VALUES
(1, 'Tejados Y Cubiertas'),
(2, 'Cementos Y Morteros'),
(3, 'Yesos Y Escayolas'),
(4, 'Arenas y Gravas'),
(5, 'Cercados y Ocultación'),
(6, 'Madera'),
(7, 'Hormigoneras, carretillas...'),
(8, 'Aislamientos e impermeabilización'),
(9, 'Elementos de construcción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Cod_producto` smallint(5) UNSIGNED NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Precio` float NOT NULL,
  `Stock` int(10) UNSIGNED NOT NULL,
  `Categoria` smallint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Cod_producto`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `Categoria`) VALUES
(1, 'Ladrillo', 'Ladrillo doble hueco 24x15x12cm.', 0.41, 500, 9),
(2, 'Bloque Hormigón', 'Bloque de Hormigón blanco hidrófugo 39x19x14cm.', 1.5, 350, 9),
(3, 'Ladrillo Refractorio', 'Ladrillo Refractorio 22x11x5cm', 1.4, 500, 9),
(4, 'Yeso Fino ', 'Yeso Fino Placo Iberfino 17kg', 1.99, 50, 3),
(5, 'Yeso Rápido', 'Yeso Rápido Iberplast 17kg', 1.4, 50, 3),
(6, 'Escayola Placo', 'Escayola Placo Iberyola 17kg', 1.9, 50, 3),
(7, 'Pegamento De Escayola', 'Pegamento De Escayola Placo Ibecol 10kg', 3.85, 50, 3),
(8, 'Cemento Gris', 'Cemento Gris Tudela Veguin A-V 42,5R 25KG', 4.35, 100, 2),
(9, 'Mortero Reparador', 'Mortero Reparador Sika Minipack 5kg', 8.7, 100, 2),
(10, 'Hormigón Seco', 'Hormigón Seco H25 CAPA 25KG', 3, 100, 2),
(11, 'Cemento Cola', 'Cemento Cola Max Weber 25kg Blanco', 5.25, 50, 2),
(12, 'Arena Entrefina', 'Arena Entrefina 20kg.', 1.33, 100, 4),
(13, 'Gravillín', 'Gravillín 6/20mm 20kg.', 1.86, 100, 4),
(14, 'Arena Fina', 'Arena Fina 20kg.', 1.8, 100, 4),
(15, 'Big Bag Gravillón', 'Big Bag Gravillón 500kg.', 15, 50, 4),
(16, 'Big Bag Arena Gruesa', 'Big Bag Arena Gruesa 500kg.', 20, 50, 4),
(17, 'Big Bag Arena Entrefina', 'Big Bag Arena Entrefina 1000kg.', 32, 25, 4),
(18, 'Poleistireno Extruido', 'Poleistireno Extruido 250KPA 260x60cm y 6cm de espesor.', 14.1, 100, 8),
(19, 'Aislamiento Reflexivo', 'Aislamiento Reflexivo Polynium 3000x120cm y 8mm de espesor.', 187, 100, 8),
(20, 'Panel Poliuretano', 'Panel Poliuretano 150kg/m3 Multiaislante 200x100cm y 2cm de espesor.', 15.8, 100, 8),
(21, 'Lámina Asfáltica Plastómero', 'Lámina Asfáltica Plastómero 4km/m2 Chovaplast Vel 40', 37, 150, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Apellidos` varchar(150) NOT NULL,
  `Correo` varchar(250) NOT NULL,
  `Contraseña` varchar(150) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Fecha_Registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Nombre`, `Apellidos`, `Correo`, `Contraseña`, `id_rol`, `Fecha_Nacimiento`, `Fecha_Registro`) VALUES
(6, 'Pepe', 'mel', 'alex@a.a', 'a', 2, '2022-12-12', '2023-02-05'),
(11, 'alejandrofm', 'a', 'alex@gmail.es', '$2y$10$QRACp3bPeCrOjVCPN0LTaezBQYxz3mpLsJ45V.2t9eeXCshof6nhW', 1, '1212-12-12', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Cod_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Cod_producto`),
  ADD KEY `index_nombre` (`Nombre`),
  ADD KEY `fk_codigo_categoria` (`Categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `Correo` (`Correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_codigo_categoria` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`Cod_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
