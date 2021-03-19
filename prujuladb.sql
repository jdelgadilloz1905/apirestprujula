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

-- Volcando estructura para tabla prujuladb.anuncios
DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `image_url` text COLLATE utf8_spanish2_ci NOT NULL,
  `calificacion` float NOT NULL DEFAULT 0 COMMENT '0.5-1-1.5-2-2.5-3-3.5-4-4.5-5',
  `latitud` float NOT NULL DEFAULT 0,
  `longitud` float NOT NULL DEFAULT 0,
  `habitaciones` int(11) NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `oferta` float NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1 = activo 0 = inactivo ',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`id_categoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.anuncios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
REPLACE INTO `anuncios` (`id`, `nombre`, `descripcion`, `id_categoria`, `image_url`, `calificacion`, `latitud`, `longitud`, `habitaciones`, `precio`, `oferta`, `estado`, `fecha_creacion`) VALUES
	(1, 'casa en la colonia tovar ', 'con todo slos juguetes ', 1, 'https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI', 3.5, 42.2655, -83.4159, 5, 100, 0, 1, '2021-03-18 22:24:24'),
	(2, 'chuspa', 'ful equipo ', 2, 'https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0', 4, 18.4534, -66.0845, 3, 50, 0, 1, '2021-03-18 22:24:40'),
	(3, 'vargas', 'solo 3 dias ', 3, 'https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo', 2, -33.3774, -70.5271, 2, 250, 0, 1, '2021-03-18 22:24:29'),
	(4, 'catia la mar', 'por dia ', 2, 'https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs', 3, -33.4549, -70.6016, 1, 75, 0, 1, '2021-03-18 22:24:33'),
	(5, 'Nuevo Horizonte', 'full date ', 3, 'https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ', 2, -34.6115, -58.4201, 4, 120, 0, 1, '2021-03-18 22:26:04');
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.calificacion
DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='son los comentarios de los usuarios al reservar u ofertar un anuncio. ';

-- Volcando datos para la tabla prujuladb.calificacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.categoria: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
REPLACE INTO `categoria` (`id`, `nombre`, `estado`, `fecha_creacion`) VALUES
	(1, 'reservaciones', 1, '2021-03-18 22:12:51'),
	(2, 'viajes', 1, '2021-03-18 22:12:56'),
	(3, 'turismo', 1, '2021-03-18 22:13:02');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text COLLATE utf8_spanish2_ci NOT NULL,
  `API_KEY` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.config: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`id`, `logo`, `API_KEY`) VALUES
	(1, '', '43832e1f69258ca2ef5f2f2ee640133d');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.localidad
DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.localidad: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `localidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `localidad` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.reservaciones
DROP TABLE IF EXISTS `reservaciones`;
CREATE TABLE IF NOT EXISTS `reservaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `aprobado` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.reservaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reservaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservaciones` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish2_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0 COMMENT 'activo = 1 o inactivo = 0 ',
  `ultimo_login` datetime DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `idioma` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'en',
  `modo` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'directa, google, facebook',
  `email_encriptado` text COLLATE utf8_spanish2_ci NOT NULL,
  `verificacion` int(11) NOT NULL DEFAULT 1 COMMENT 'desde el email que recibio la primera vez',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`id`, `email`, `nombre`, `apellido`, `password`, `foto`, `estado`, `ultimo_login`, `fecha_creacion`, `telefono`, `idioma`, `modo`, `email_encriptado`, `verificacion`) VALUES
	(1, 'admin@admin.com', 'Administrador', '', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, '2021-03-15 13:07:34', '2021-03-15 15:07:34', '04142517231', 'es', 'directo', '', 0),
	(2, 'jdelgadilloz1905@gmail.com', 'Jorge', 'Delgadillo', '$2a$07$asxx54ahjppf45sd87a5auuklDRcFTAh0cefIL69V.yBnbZZ0MbGm', '', 1, '2021-03-18 20:37:38', '2021-03-18 21:37:38', NULL, 'en', 'directo', '8fb14cb673a4608b7efd4e5d35e84c84', 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
