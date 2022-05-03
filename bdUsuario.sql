-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla pjem.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.migrations: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2022_05_03_151634_create_tblgrupos_sistema_table', 1),
	(3, '2022_05_03_151811_create_tblusuarios_table', 1),
	(4, '2022_05_03_152010_create_tblcontrolcarga_table', 1),
	(5, '2022_05_03_152129_create_tblsolicitudes_table', 1),
	(6, '2022_05_03_152320_create_tblacciones_table', 1),
	(7, '2022_05_03_152404_create_tblbitacoras_table', 1),
	(8, '2022_05_03_152631_create_tblconfiguracioncarga_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblacciones
CREATE TABLE IF NOT EXISTS `tblacciones` (
  `cve_accion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cve_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblacciones: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tblacciones` DISABLE KEYS */;
REPLACE INTO `tblacciones` (`cve_accion`, `descripcion`, `activo`, `created_at`, `updated_at`) VALUES
	(1, 'Prueba 1', 1, '2022-05-03 15:50:53', '2022-05-03 15:50:53'),
	(2, 'Crear', 1, '2022-05-03 17:38:45', '2022-05-03 17:38:45'),
	(3, 'Cancelar', 1, '2022-05-03 19:07:41', '2022-05-03 19:07:41');
/*!40000 ALTER TABLE `tblacciones` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblbitacoras
CREATE TABLE IF NOT EXISTS `tblbitacoras` (
  `id-Bitacora` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_Usuario` bigint(20) unsigned NOT NULL,
  `cve_Accion` bigint(20) unsigned NOT NULL,
  `fecha` datetime NOT NULL,
  `movimiento` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id-Bitacora`),
  KEY `tblbitacoras_id_usuario_foreign` (`id_Usuario`),
  KEY `tblbitacoras_cve_accion_foreign` (`cve_Accion`),
  CONSTRAINT `tblbitacoras_cve_accion_foreign` FOREIGN KEY (`cve_Accion`) REFERENCES `tblacciones` (`cve_accion`),
  CONSTRAINT `tblbitacoras_id_usuario_foreign` FOREIGN KEY (`id_Usuario`) REFERENCES `tblusuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblbitacoras: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tblbitacoras` DISABLE KEYS */;
REPLACE INTO `tblbitacoras` (`id-Bitacora`, `id_Usuario`, `cve_Accion`, `fecha`, `movimiento`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, '2022-05-03 17:45:38', 'Se creó la configuración de carga con id', '2022-05-03 17:45:38', '2022-05-03 17:45:38'),
	(2, 2, 2, '2022-05-03 17:57:05', 'Se creó la configuración de carga con id', '2022-05-03 17:57:05', '2022-05-03 17:57:05'),
	(3, 2, 2, '2022-05-03 18:51:15', 'Se creó la solicitud con id', '2022-05-03 18:51:15', '2022-05-03 18:51:15'),
	(4, 2, 3, '2022-05-03 19:10:53', 'Se canceló la solicitud con id', '2022-05-03 19:10:53', '2022-05-03 19:10:53');
/*!40000 ALTER TABLE `tblbitacoras` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblconfiguracioncarga
CREATE TABLE IF NOT EXISTS `tblconfiguracioncarga` (
  `id_Configuracion_Carga` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proporcion` int(11) NOT NULL,
  `diferencia` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_Configuracion_Carga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblconfiguracioncarga: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tblconfiguracioncarga` DISABLE KEYS */;
REPLACE INTO `tblconfiguracioncarga` (`id_Configuracion_Carga`, `proporcion`, `diferencia`, `anio`, `activo`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 2021, 1, '2022-05-03 17:45:01', '2022-05-03 17:45:01'),
	(2, 1, 4, 2021, 1, '2022-05-03 17:45:38', '2022-05-03 17:45:38'),
	(3, 4, 3, 2017, 1, '2022-05-03 17:57:05', '2022-05-03 17:57:05');
/*!40000 ALTER TABLE `tblconfiguracioncarga` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblcontrolcarga
CREATE TABLE IF NOT EXISTS `tblcontrolcarga` (
  `id_Control_Carga` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_Usuario` bigint(20) unsigned NOT NULL,
  `anio` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_Control_Carga`),
  KEY `tblcontrolcarga_id_usuario_foreign` (`id_Usuario`),
  CONSTRAINT `tblcontrolcarga_id_usuario_foreign` FOREIGN KEY (`id_Usuario`) REFERENCES `tblusuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblcontrolcarga: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tblcontrolcarga` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontrolcarga` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblgrupos_sistema
CREATE TABLE IF NOT EXISTS `tblgrupos_sistema` (
  `cve_grupo_sistema` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion_grupo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cve_grupo_sistema`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblgrupos_sistema: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tblgrupos_sistema` DISABLE KEYS */;
REPLACE INTO `tblgrupos_sistema` (`cve_grupo_sistema`, `descripcion_grupo`, `activo`, `created_at`, `updated_at`) VALUES
	(1, 'Grupo 1', 1, '2022-05-03 15:58:04', '2022-05-03 15:58:04'),
	(2, 'Asesor de ventas', 1, '2022-05-03 18:31:17', '2022-05-03 18:31:17');
/*!40000 ALTER TABLE `tblgrupos_sistema` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblsolicitudes
CREATE TABLE IF NOT EXISTS `tblsolicitudes` (
  `id_solicitud` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_Usuario_Asignado` bigint(20) unsigned NOT NULL,
  `nombre_Solicitante` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno_Solicitante` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno_Solicitante` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `fecha_Solicitud` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `tblsolicitudes_id_usuario_asignado_foreign` (`id_Usuario_Asignado`),
  CONSTRAINT `tblsolicitudes_id_usuario_asignado_foreign` FOREIGN KEY (`id_Usuario_Asignado`) REFERENCES `tblusuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblsolicitudes: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `tblsolicitudes` DISABLE KEYS */;
REPLACE INTO `tblsolicitudes` (`id_solicitud`, `id_Usuario_Asignado`, `nombre_Solicitante`, `paterno_Solicitante`, `materno_Solicitante`, `activo`, `fecha_Solicitud`, `created_at`, `updated_at`) VALUES
	(1, 3, 'PruebaSolicitud', 'Hernandez', 'Marquez', 1, '2022-05-03 18:51:15', '2022-05-03 18:51:15', '2022-05-03 19:10:53');
/*!40000 ALTER TABLE `tblsolicitudes` ENABLE KEYS */;

-- Volcando estructura para tabla pjem.tblusuarios
CREATE TABLE IF NOT EXISTS `tblusuarios` (
  `id_usuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `cve_grupo` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `tblusuarios_cve_grupo_foreign` (`cve_grupo`),
  CONSTRAINT `tblusuarios_cve_grupo_foreign` FOREIGN KEY (`cve_grupo`) REFERENCES `tblgrupos_sistema` (`cve_grupo_sistema`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pjem.tblusuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tblusuarios` DISABLE KEYS */;
REPLACE INTO `tblusuarios` (`id_usuario`, `nombre`, `paterno`, `materno`, `login`, `password`, `activo`, `cve_grupo`, `created_at`, `updated_at`) VALUES
	(1, 'Usuario 1', 'Ap Pat Usu1', 'Ap Mat Usu1', 'Usuario 1 Usu', '$2y$10$R/dsetpwCCkQHqyOHF869eKylP5I6Tj4Y8JQHmBNWuasyc.1Ivzz.', 0, 1, '2022-05-03 15:58:20', '2022-05-03 16:00:18'),
	(2, 'Usuario 2', 'Ap Pat Usu2', 'Ap Mat Usu2', 'Usuario 2 Usu', '$2y$10$23tqHtpF87LTCS/OyDLRROTN9db2JpAqFL2WgJCDn1DA6y1qzfNpK', 1, 1, '2022-05-03 17:34:24', '2022-05-03 17:34:24'),
	(3, 'Usuario 1 Asesor', 'Ap Pat Usu2', 'Ap Mat Usu2', 'Usuario 2 Usu', '$2y$10$YIeTD3di3nhDt/F6V38CeuUA5WV2zBlL8YDKBDEX3iUpPKxi8EMdW', 1, 2, '2022-05-03 18:33:37', '2022-05-03 18:33:37'),
	(4, 'Usuario 2 Asesor', 'Ap Pat Usu2', 'Ap Mat Usu2', 'Usuario 2 Usu', '$2y$10$/.lKFBb9ViPMQoUSiSPw.eiYUZEDzEkS4lAk9Jlx4evDuzvRAR3qm', 1, 2, '2022-05-03 18:33:41', '2022-05-03 18:33:41');
/*!40000 ALTER TABLE `tblusuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
