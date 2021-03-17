-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prujuladb
CREATE DATABASE IF NOT EXISTS `prujuladb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `prujuladb`;

-- Volcando estructura para tabla prujuladb.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text COLLATE utf8_spanish2_ci NOT NULL,
  `API_KEY` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.config: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`id`, `logo`, `API_KEY`) VALUES
	(1, '', '43832e1f69258ca2ef5f2f2ee640133d');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish2_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` text COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'inactivo' COMMENT 'activo o inactivo ',
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `idioma` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'en',
  `modo` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'directa, google, facebook',
  `email_encriptado` text COLLATE utf8_spanish2_ci NOT NULL,
  `verificacion` int(11) NOT NULL DEFAULT 0 COMMENT 'desde el email que recibio la primera vez',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `email`, `nombre`, `apellido`, `password`, `foto`, `estado`, `ultimo_login`, `fecha`, `telefono`, `idioma`, `modo`, `email_encriptado`, `verificacion`) VALUES
	(1, 'admin@admin.com', 'Administrador', '', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', '1', '2021-03-16 19:36:11', '2021-03-16 20:36:11', '04142517231', 'es', 'directo', '', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
