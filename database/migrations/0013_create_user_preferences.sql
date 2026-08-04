CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'oscuro',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_correo` (`usuario_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
