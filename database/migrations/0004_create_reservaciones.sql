CREATE TABLE IF NOT EXISTS `reservaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `habitacion` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `moneda` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'COP',
  `usuario_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
