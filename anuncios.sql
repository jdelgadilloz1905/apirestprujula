-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.18-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para estudio5_prujula
DROP DATABASE IF EXISTS `estudio5_prujula`;
CREATE DATABASE IF NOT EXISTS `estudio5_prujula` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `estudio5_prujula`;

-- Volcando estructura para tabla estudio5_prujula.banner
DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.banner: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `ruta`, `tipo`, `image`, `estado`, `fecha`) VALUES
	(1, 'sin-categoria', 'sin-categoria', 'views/img/banner/default.jpg', 0, '2021-06-14 13:58:05'),
	(3, 'desarrollo-web', 'subcategorias', 'views/img/banner/web.jpg', 0, '2021-06-14 13:58:00'),
	(4, 'calzado', 'categorias', 'views/img/banner/ropaHombre.jpg', 0, '2021-06-14 13:57:56'),
	(5, 'camping', 'camping', 'views/img/banner/banner1.jpeg', 1, '2021-06-14 13:57:52'),
	(6, 'camping', 'camping', 'views/img/banner/banner2.jpeg', 1, '2021-06-14 13:57:52'),
	(7, 'camping', 'camping', 'views/img/banner/banner3.jpeg', 1, '2021-06-14 13:57:52');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
