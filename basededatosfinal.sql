CREATE DATABASE IF NOT EXISTS `basededatos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `basededatos`;

DROP TABLE IF EXISTS `espacios`;
CREATE TABLE IF NOT EXISTS `espacios` (
  `cod_espacio` int NOT NULL AUTO_INCREMENT,
  `id_prestamo` int NOT NULL,
  `nom_espacio` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `capacidad` int NOT NULL,
  `estado_espacio` enum('Libre','Ocupado','Reservado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cod_espacio`),
  UNIQUE KEY `nom_espacio` (`nom_espacio`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `espacios` (`cod_espacio`, `id_prestamo`, `nom_espacio`, `Descripcion`, `capacidad`, `estado_espacio`) VALUES
(4, 0, 'Multiproposito 4', 'El Salón Multipropósito está diseñado para adaptarse a diferentes tipos de actividades, como reuniones, capacitaciones, dinámicas grupales o exposiciones. Su distribución flexible permite organizar el espacio de acuerdo con las necesidades del evento.', 40, 'Libre'),
(6, 0, 'Multiproposito 3', 'El Salón Multipropósito está diseñado para adaptarse a diferentes tipos de actividades, como reuniones, capacitaciones, dinámicas grupales o exposiciones. Su distribución flexible permite organizar el espacio de acuerdo con las necesidades del evento.', 40, 'Libre'),
(12, 0, 'Salon principal', 'El Salón Principal es un espacio amplio y multifuncional, ideal para talleres, capacitaciones, reuniones institucionales y actividades grupales. Su mobiliario flexible permite adaptar la distribución del salón según las necesidades del evento.', 60, 'Libre'),
(13, 0, 'Aula segundaria', 'Aula destinada al desarrollo de clases teóricas en nivel secundario. Su diseño es funcional y cómodo, permitiendo el desarrollo de actividades académicas grupales e individuales. Cuenta con iluminación adecuada, ventilación.', 40, 'Libre'),
(14, 14, 'Auditorio principal', 'El Auditorio Principal está diseñado para la realización de eventos corporativos, conferencias, capacitaciones y presentaciones institucionales. Ofrece un ambiente cómodo y equipado con tecnología audiovisual de alta calidad.', 120, 'Reservado');

DROP TABLE IF EXISTS `fecha_insumos`;
CREATE TABLE IF NOT EXISTS `fecha_insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_equipo` int NOT NULL,
  `fecha` date NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_devolucion` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `fecha_insumos` (`id`, `id_equipo`, `fecha`, `hora_salida`, `hora_devolucion`) VALUES
(1, 6, '2025-05-14', '09:00:00', '12:00:00'),
(2, 8, '2025-05-14', '09:00:00', '12:00:00'),
(3, 40, '2025-05-14', '09:00:00', '12:00:00'),
(4, 41, '2025-05-14', '08:00:00', '13:00:00'),
(5, 43, '2025-05-14', '08:00:00', '13:00:00'),
(6, 6, '2025-05-22', '10:42:00', '13:42:00'),
(7, 8, '2025-05-22', '10:42:00', '13:42:00'),
(8, 6, '2025-05-29', '18:00:00', '21:00:00'),
(9, 8, '2025-05-29', '18:00:00', '21:00:00');

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `cod_inventario` int NOT NULL AUTO_INCREMENT,
  `nivel_acceso` int NOT NULL,
  `id_prestamo` int NOT NULL,
  `nom_inventario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'No asignado',
  `Descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '"Sin descripcion"',
  `estado` enum('Libre','Averiado','Bodega','Prestado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Libre',
  `prestado_a` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Nadie',
  PRIMARY KEY (`cod_inventario`),
  UNIQUE KEY `cod_inventario` (`cod_inventario`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `inventario` (`cod_inventario`, `nivel_acceso`, `id_prestamo`, `nom_inventario`, `Descripcion`, `estado`, `prestado_a`) VALUES
(1, 2, 0, 'tablet', 'Tablet lenovo 8 gb RAM y 128 gb de ROM', 'Libre', 'Nadie'),
(2, 1, 0, 'cabina', 'Cabina Activa 15 Beta Three N15a 400w Beta 3 N15a N-15a Profesional', 'Averiado', 'Nadie'),
(3, 3, 0, 'cable', 'Cable Audio Micrófono Xlr Macho Jack 3.5mm Auxiliar Sonido', 'Libre', 'Nadie'),
(4, 3, 0, 'mouse', 'Mouse Genius Dx 101 Optico Usb Alambrico Color Negro', 'Libre', 'Nadie'),
(5, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 19\" 50Hz 110V y resolución HD', 'Libre', 'Nadie'),
(6, 1, 47, 'portatil', 'Portátil Lenovo V14 G4amn Amd Ryzen 3 7320u Ram 16gb Ssd 256 Color Gris', 'Prestado', 'Jhon Cordoba'),
(7, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(8, 1, 47, 'portatil', 'Potátil Lenovo Ideapad Slim 3 15IAH8 15.6\" color abyss blue 16GB de Ram 512GB SSD Intel Core i5', 'Prestado', 'Jhon Cordoba'),
(9, 3, 0, 'cable', 'Cable Audio Micrófono Xlr Macho Jack 3.5mm Auxiliar Sonido', 'Libre', 'Nadie'),
(11, 1, 0, 'cabina', 'Parlante Américan Sound ASPA108X portátil con bluetooth negra 110V', 'Bodega', 'Nadie'),
(12, 1, 0, 'cabina', 'Cabina Aiwa 100W RMS Negro AWSP15TK', 'Libre', 'Nadie'),
(13, 1, 0, 'cabina', 'Cabina Activa Beta Three Vx15a Bluetooth 2 Vias', 'Libre', 'Nadie'),
(14, 1, 0, 'cabina', 'Cabina De Sonido Activa Profesional Sonivox Vs-ssac101 Negro', 'Libre', 'Nadie'),
(15, 1, 0, 'cabina', 'Qsc K10.2 Cabina Activa Qsc', 'Libre', 'Nadie'),
(16, 1, 0, 'cabina', 'Yamaki Ss-715 Cabina Activa 15 Pulgadas', 'Libre', 'Nadie'),
(17, 1, 0, 'cabina', 'Cabina Activa Beta Three Vx12a Bluetooth 2 Vias', 'Libre', 'Nadie'),
(18, 1, 0, 'cabina', 'Parlante Activo 15 Ss715+base 700w Kit Cabina Activa Yamaki', 'Libre', 'Nadie'),
(19, 1, 0, 'cabina', 'Parlante Sonivox Vs-ss2135 Portátil', 'Libre', 'Nadie'),
(20, 3, 0, 'cable', 'Cable De Audio Fibra Óptica Toslink Sonido Digital 1m Ugreen', 'Libre', 'Nadie'),
(21, 3, 0, 'cable', 'Cable De Audio Fibra Óptica Toslink Sonido Digital 1m Ugreen', 'Libre', 'Nadie'),
(22, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(23, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(24, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(25, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(26, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(27, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(28, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(29, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(30, 3, 0, 'mouse', 'Mouse Genius DX-120 USB Alambrico Negro', 'Libre', 'Nadie'),
(31, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(32, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(33, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(34, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(35, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(36, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(37, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(38, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(39, 2, 0, 'pantalla', 'Monitor ViewSonic con pantalla de 24\" 100Hz 110V y resolución Full HD', 'Libre', 'Nadie'),
(40, 1, 44, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Prestado', 'Jhon Cordoba'),
(41, 1, 45, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Prestado', 'Daniel Peña'),
(43, 1, 45, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Prestado', 'Daniel Peña'),
(44, 1, 0, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Libre', 'Nadie'),
(45, 1, 0, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Libre', 'Nadie'),
(46, 1, 0, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Libre', 'Nadie'),
(47, 1, 0, 'portatil', 'Portatil Lenovo Thinkpad E14 G4 I5-1235u 16gb 512gb w11pro Color Black', 'Libre', 'Nadie'),
(48, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(49, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(50, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(51, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(52, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(53, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(54, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(55, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(56, 2, 0, 'tablet', 'Tablet Xiaomi Redmi Pad Se 8gb 256gb Gris', 'Libre', 'Nadie'),
(57, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(58, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(59, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(60, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(61, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(62, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(63, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(64, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(65, 3, 0, 'teclado', 'Teclado Genius KB-100 USB Negro', 'Libre', 'Nadie'),
(66, 3, 0, 'cable', 'Cable Audio Micrófono Xlr Macho Jack 3.5mm Auxiliar Sonido', 'Libre', 'Nadie'),
(67, 3, 0, 'cable', 'Cable Audio Micrófono Xlr Macho Jack 3.5mm Auxiliar Sonido', 'Libre', 'Nadie'),
(68, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(69, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(70, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(71, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(72, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(73, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(74, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(75, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(76, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie'),
(77, 1, 0, 'portatil', 'Lenovo ThinkPad T14 Business Laptop (14\" FHD+ IPS, Intel 10 Core i5-1335U, 16 GB de RAM, 512 GB SSD) Cámara web de 5 MP, 2 Thunderbolt 4, PC AI 2024, Win 11 Pro', 'Libre', 'Nadie');



DROP TABLE IF EXISTS `peticiones_espacios`;
CREATE TABLE IF NOT EXISTS `peticiones_espacios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prestamo` int NOT NULL,
  `nom_espacio` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pide` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado_peticion` enum('Sin Revisar','Aprobada','Rechazada') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Sin Revisar',
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `hora_regreso` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `peticiones_espacios` (`id`, `id_prestamo`, `nom_espacio`, `pide`, `estado_peticion`, `fecha_entrega`, `hora_entrega`, `hora_regreso`) VALUES
(12, 13, 'Auditorio principal', 'Daniel Peña', 'Aprobada', '2025-05-15', '10:00:00', '13:00:00'),
(13, 0, 'Auditorio principal', 'Dilan Palta', 'Sin Revisar', '2025-05-15', '11:00:00', '14:00:00'),
(14, 0, 'Auditorio principal', 'Dilan Palta', 'Sin Revisar', '2025-05-15', '14:00:00', '16:00:00'),
(15, 14, 'Auditorio principal', 'Dilan Palta', 'Aprobada', '2025-05-30', '18:00:00', '20:30:00');


DROP TABLE IF EXISTS `peticiones_insumos`;
CREATE TABLE IF NOT EXISTS `peticiones_insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prestamo` int NOT NULL,
  `equipo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cantidad` int NOT NULL,
  `nom_persona` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado_peticion` enum('Sin Revisar','Aprobada','Rechazada') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Sin Revisar',
  `dia_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `hora_regreso` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `peticiones_insumos` (`id`, `id_prestamo`, `equipo`, `cantidad`, `nom_persona`, `estado_peticion`, `dia_entrega`, `hora_entrega`, `hora_regreso`) VALUES
(45, 45, 'portatil', 2, 'Daniel Peña', 'Aprobada', '2025-05-14', '08:00:00', '13:00:00'),
(46, 0, 'cabina', 1, 'Dilan Palata', 'Sin Revisar', '2025-05-14', '08:00:00', '10:00:00'),
(47, 44, 'portatil', 3, 'Jhon Cordoba', 'Aprobada', '2025-05-14', '09:00:00', '12:00:00'),
(48, 0, 'mouse', 1, 'Tom Peña', 'Sin Revisar', '2025-05-14', '06:00:00', '09:00:00'),
(49, 46, 'portatil', 2, 'Jhon Cordoba', 'Aprobada', '2025-05-22', '10:42:00', '13:42:00'),
(50, 47, 'portatil', 2, 'Jhon Cordoba', 'Aprobada', '2025-05-29', '18:00:00', '21:00:00');


DROP TABLE IF EXISTS `prestamos_espacios`;
CREATE TABLE IF NOT EXISTS `prestamos_espacios` (
  `id_prestamo_espacio` int NOT NULL AUTO_INCREMENT,
  `espacio` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nom_persona` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('Reservado','Terminado','Cancelado') COLLATE utf8mb4_general_ci NOT NULL,
  `dia_prestamo` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` date NOT NULL,
  `desde` time NOT NULL,
  `hasta` time NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  PRIMARY KEY (`id_prestamo_espacio`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `prestamos_espacios` (`id_prestamo_espacio`, `espacio`, `nom_persona`, `estado`, `dia_prestamo`, `fecha_entrega`, `desde`, `hasta`, `fecha_devolucion`) VALUES
(13, 'Auditorio principal', 'Daniel Peña', 'Reservado', '2025-05-14 21:51:24', '2025-05-15', '10:00:00', '13:00:00', '0000-00-00 00:00:00'),
(14, 'Auditorio principal', 'Dilan Palta', 'Reservado', '2025-05-29 16:25:59', '2025-05-30', '18:00:00', '20:30:00', '0000-00-00 00:00:00');



DROP TABLE IF EXISTS `prestamos_insumos`;
CREATE TABLE IF NOT EXISTS `prestamos_insumos` (
  `id_prestamo` int NOT NULL AUTO_INCREMENT,
  `insumo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cantidad` int NOT NULL,
  `nombre_persona_prestamo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('Devuelto','Prestado') COLLATE utf8mb4_general_ci NOT NULL,
  `dia_prestamo` datetime DEFAULT CURRENT_TIMESTAMP,
  `desde` time NOT NULL,
  `hasta` time NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `prestamos_insumos` (`id_prestamo`, `insumo`, `cantidad`, `nombre_persona_prestamo`, `estado`, `dia_prestamo`, `desde`, `hasta`, `fecha_devolucion`) VALUES
(42, 'portatil', 2, 'Daniel Peña', 'Devuelto', '2025-05-14 20:59:21', '08:00:00', '00:00:00', '2025-05-15 14:06:17'),
(43, 'portatil', 3, 'Jhon Cordoba', 'Devuelto', '2025-05-15 14:06:33', '09:00:00', '12:00:00', '2025-05-15 14:09:23'),
(44, 'portatil', 3, 'Jhon Cordoba', 'Prestado', '2025-05-22 11:21:28', '09:00:00', '12:00:00', '0000-00-00 00:00:00'),
(45, 'portatil', 2, 'Daniel Peña', 'Prestado', '2025-05-22 11:40:05', '08:00:00', '00:00:00', '0000-00-00 00:00:00'),
(46, 'portatil', 2, 'Jhon Cordoba', 'Prestado', '2025-05-22 11:44:00', '10:42:00', '13:42:00', '0000-00-00 00:00:00'),
(47, 'portatil', 2, 'Jhon Cordoba', 'Prestado', '2025-05-29 16:18:50', '18:00:00', '21:00:00', '0000-00-00 00:00:00');



DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nivel_acceso` int NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha creación` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`, `nivel_acceso`, `estado`, `fecha creación`, `fecha_actualizacion`) VALUES
(1, 'Administrador', 'El administrador tiene acceso y permiso a editar y modificar todo lo referente a la pagina y funcionalidades.', 1, 1, '2025-05-01 17:21:59', '2025-05-01 17:21:59'),
(2, 'Supervisor', 'El supervisor cumple funciones que están orientadas a controlar, validar y gestionar operaciones diarias sin tener acceso total a la configuración del sistema. ', 2, 1, '2025-05-01 17:26:10', '2025-05-01 17:26:10'),
(3, 'Funcionario', 'Un funcionario tiene permisos operativos limitados. Este rol se enfoca en prestar ciertos recursos y devolver recursos que se le entreguen, sin autoridad para modificar registros administrativos.', 3, 1, '2025-05-01 17:29:41', '2025-05-01 17:29:41');



DROP TABLE IF EXISTS `tipo_insumo`;
CREATE TABLE IF NOT EXISTS `tipo_insumo` (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `nivel_insumo` int NOT NULL,
  `nombre_insumo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_insumo`),
  UNIQUE KEY `nombre_insumo` (`nombre_insumo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tipo_insumo` (`id_insumo`, `nivel_insumo`, `nombre_insumo`) VALUES
(1, 1, 'portatil'),
(2, 2, 'tablet'),
(3, 1, 'cabina'),
(4, 3, 'mouse'),
(5, 3, 'teclado'),
(6, 2, 'pantalla'),
(7, 3, 'cable');


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('Funcionario','Administrador','Supervisor') COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `nombre`, `rol`, `estado`) VALUES
(1, 'admin', 'admin', 'Daniel Alejandro Peña Estrella', 'Administrador', 1),
(2, 'DanPE', '1234', 'Daniel Alejandro Peña Estrella', 'Supervisor', 1),
(3, 'DilanP', '1234', 'Dilan Ivan Palta Reyes', 'Funcionario', 1),
(10, 'prueba', 'prueba1234', 'Prueba', 'Funcionario', 1);

