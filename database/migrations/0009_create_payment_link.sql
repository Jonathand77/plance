CREATE TABLE IF NOT EXISTS `payment_link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `link_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_url` text COLLATE utf8mb4_general_ci,
  `referencia` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'activo',
  `pagos_usados` int DEFAULT '0',
  `expiracion` datetime NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
