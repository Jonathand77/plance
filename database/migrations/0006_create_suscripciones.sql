CREATE TABLE IF NOT EXISTS `suscripciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `plataforma` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `plan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
