-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2025 a las 21:46:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basededatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios`
--

CREATE TABLE `espacios` (
  `cod_espacio` int(100) NOT NULL,
  `nom_espacio` varchar(255) NOT NULL,
  `estado_espacio` enum('Libre','Ocupado') NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `espacios`
--

INSERT INTO `espacios` (`cod_espacio`, `nom_espacio`, `estado_espacio`, `Descripcion`) VALUES
(4, 'Multiproposito 4', 'Libre', '-'),
(5, 'Polideportivo de la sede', 'Libre', '-'),
(6, 'Multiproposito 3', 'Libre', '-'),
(12, 'Salon principal', 'Libre', 'Salon amplio como para 50 personas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `cod_inventario` int(100) NOT NULL,
  `nom_inventario` varchar(255) NOT NULL DEFAULT 'No asignado',
  `Descripcion` varchar(255) NOT NULL DEFAULT '"Sin descripcion"',
  `estado` enum('Libre','Prestado','Averiado') NOT NULL,
  `marca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`cod_inventario`, `nom_inventario`, `Descripcion`, `estado`, `marca`) VALUES
(1, 'Portatil 1', '', 'Prestado', ''),
(2, 'Tablet 1', '', 'Prestado', ''),
(3, 'Portatil 2', '', 'Prestado', ''),
(4, 'Portatil 3', '', 'Prestado', ''),
(5, 'Tablet 2', '', 'Averiado', ''),
(7, 'Portatil 9', '', 'Prestado', ''),
(21, 'Portatil 13', 'Hacer algo por la vida.', 'Prestado', ''),
(23, 'Portatil 14', 'asdas', 'Prestado', ''),
(26, 'Tablet 3', 'Tablet lenovo 8 gb RAM y 128 gb de ROM', 'Libre', ''),
(29, 'Portatil 16', 'sasad', 'Libre', ''),
(30, 'Sonido 1', 'Equipo de sonido bocina max well', 'Prestado', ''),
(31, 'Sonido 2', 'Yamaha tunea', 'Libre', ''),
(32, 'a', 'lenosdasdasdd', 'Libre', 'qweqweq'),
(33, 'prueba', '015', 'Libre', 'lenovo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones_espacios`
--

CREATE TABLE `peticiones_espacios` (
  `id` int(11) NOT NULL,
  `nom_espacio` varchar(255) NOT NULL,
  `pide` varchar(255) NOT NULL,
  `estado_peticion` enum('Sin Revisar','Aprobada','Rechazada') NOT NULL DEFAULT 'Sin Revisar',
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time NOT NULL,
  `hora_regreso` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peticiones_espacios`
--

INSERT INTO `peticiones_espacios` (`id`, `nom_espacio`, `pide`, `estado_peticion`, `fecha_entrega`, `hora_entrega`, `hora_regreso`) VALUES
(5, 'Salon principal', 'Daniel Peña', 'Aprobada', '2025-04-24', '20:44:00', '23:44:00'),
(6, 'Salon de Reuniones', 'Dilan Palta', 'Sin Revisar', '2025-04-24', '21:03:00', '23:03:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones_insumos`
--

CREATE TABLE `peticiones_insumos` (
  `id` int(100) NOT NULL,
  `equipo` varchar(255) NOT NULL,
  `nom_persona` varchar(255) NOT NULL,
  `estado_peticion` enum('Sin Revisar','Aprobada','Rechazada') NOT NULL DEFAULT 'Sin Revisar',
  `dia_entrega` date DEFAULT current_timestamp(),
  `hora_entrega` time DEFAULT NULL,
  `hora_regreso` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peticiones_insumos`
--

INSERT INTO `peticiones_insumos` (`id`, `equipo`, `nom_persona`, `estado_peticion`, `dia_entrega`, `hora_entrega`, `hora_regreso`) VALUES
(16, 'Portatil', 'Daniel Alejandro Peña Estrella', 'Aprobada', '2025-04-14', '13:52:30', '17:52:30'),
(25, 'Portatil', 'Daniel Peña', 'Aprobada', '2025-04-22', '13:52:30', '17:52:30'),
(26, 'Portatil', 'Daniel Peña', 'Aprobada', '2025-04-22', '12:00:00', '13:00:00'),
(27, 'Tablet', 'Dilan Palta', 'Aprobada', '2025-04-22', '15:00:00', '18:00:00'),
(28, 'Sonido', 'Juan Castillo', 'Aprobada', '2025-04-22', '02:00:00', '17:00:00'),
(29, 'Portatil', 'Daniel Peña', 'Aprobada', '2025-04-23', '14:34:00', '18:35:00'),
(30, 'Sonido', 'Daniel Peña', 'Sin Revisar', '2025-04-23', '14:59:00', '20:59:00'),
(31, 'Tablet', 'Dilan Palta', 'Sin Revisar', '2025-04-23', '21:01:00', '12:01:00'),
(32, 'Tablet', 'Pepito PErez', 'Aprobada', '2025-04-23', '21:54:00', '02:54:00'),
(33, 'Tablet', 'Daniel Peña', 'Sin Revisar', '2025-04-24', '20:18:00', '22:18:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_espacios`
--

CREATE TABLE `prestamos_espacios` (
  `id_prestamo_espacio` int(11) NOT NULL,
  `espacio` varchar(255) NOT NULL,
  `nom_persona` varchar(255) NOT NULL,
  `estado` enum('Reservado','Terminado','Cancelado') NOT NULL,
  `dia_prestamo` date NOT NULL DEFAULT current_timestamp(),
  `hora_prestamo` time NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` date NOT NULL,
  `desde` time NOT NULL,
  `hasta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos_espacios`
--

INSERT INTO `prestamos_espacios` (`id_prestamo_espacio`, `espacio`, `nom_persona`, `estado`, `dia_prestamo`, `hora_prestamo`, `fecha_entrega`, `desde`, `hasta`) VALUES
(0, 'Salon principal', 'Daniel Peña', 'Reservado', '2025-04-23', '15:00:00', '2025-04-24', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_insumos`
--

CREATE TABLE `prestamos_insumos` (
  `id_prestamo` int(11) NOT NULL,
  `insumo` varchar(255) NOT NULL,
  `nombre_persona_prestamo` varchar(255) NOT NULL,
  `estado` enum('Devuelto','Prestado') NOT NULL,
  `dia_prestamo` date DEFAULT current_timestamp(),
  `hora_prestamo` time DEFAULT current_timestamp(),
  `desde` time NOT NULL,
  `hasta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos_insumos`
--

INSERT INTO `prestamos_insumos` (`id_prestamo`, `insumo`, `nombre_persona_prestamo`, `estado`, `dia_prestamo`, `hora_prestamo`, `desde`, `hasta`) VALUES
(4, 'Portatil 1', 'Daniel Peña', 'Devuelto', '2025-04-21', '17:06:00', '00:00:00', '00:00:00'),
(5, 'Portatil 3', 'Daniel Alejandro Peña Estrella	', 'Prestado', '2025-04-22', '11:11:04', '00:00:00', '00:00:00'),
(6, 'Portatil 13', 'Daniel Peña', 'Prestado', '2025-04-22', '11:13:21', '00:00:00', '00:00:00'),
(7, 'Portatil 1', 'Daniel Peña', 'Devuelto', '2025-04-22', '15:58:00', '00:00:00', '00:00:00'),
(8, 'Tablet 1', 'Pepito Perez', 'Prestado', '2025-04-23', '21:56:10', '00:00:00', '00:00:00'),
(9, 'Sonido 1', 'Juan Castillo', 'Prestado', '2025-04-24', '18:26:51', '00:00:00', '00:00:00'),
(10, 'Portatil 1', 'Daniel Peña', 'Prestado', '2025-04-24', '20:21:03', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` enum('Funcionario','Administrador','Supervisor') NOT NULL,
  `ciudad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `nombre`, `rol`, `ciudad`) VALUES
(1, 'admin', 'admin', 'Administrador', 'Administrador', ''),
(24, 'DanPE', '1234', 'Daniel Alejandro Peña Estrella', 'Supervisor', ''),
(26, 'DilanP', '1234', 'Dilan Ivan Palta Reyes', 'Funcionario', ''),
(55, 'holamundo', '1234', 'Prueba', 'Administrador', 'cali'),
(56, 'Tom', '1234', 'asdasda', 'Administrador', 'cali');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `espacios`
--
ALTER TABLE `espacios`
  ADD PRIMARY KEY (`cod_espacio`),
  ADD UNIQUE KEY `nom_espacio` (`nom_espacio`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`cod_inventario`),
  ADD UNIQUE KEY `nom_inventario` (`nom_inventario`);

--
-- Indices de la tabla `peticiones_espacios`
--
ALTER TABLE `peticiones_espacios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peticiones_insumos`
--
ALTER TABLE `peticiones_insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos_espacios`
--
ALTER TABLE `prestamos_espacios`
  ADD PRIMARY KEY (`id_prestamo_espacio`);

--
-- Indices de la tabla `prestamos_insumos`
--
ALTER TABLE `prestamos_insumos`
  ADD PRIMARY KEY (`id_prestamo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `espacios`
--
ALTER TABLE `espacios`
  MODIFY `cod_espacio` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `cod_inventario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `peticiones_espacios`
--
ALTER TABLE `peticiones_espacios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `peticiones_insumos`
--
ALTER TABLE `peticiones_insumos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `prestamos_insumos`
--
ALTER TABLE `prestamos_insumos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
