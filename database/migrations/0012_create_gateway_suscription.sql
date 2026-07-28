CREATE TABLE IF NOT EXISTS `gateway_suscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `plan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_doc` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `num_doc` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `request_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
