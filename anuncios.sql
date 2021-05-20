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
-- Volcando estructura para tabla estudio5_prujula.anuncios
DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `title` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `description` text NOT NULL COMMENT 'debe estar incluida la API de google MAPS',
  `half` text DEFAULT NULL,
  `people` int(11) NOT NULL DEFAULT 0,
  `offer` int(11) NOT NULL DEFAULT 0,
  `discount_amount` float NOT NULL DEFAULT 0,
  `id_category` int(11) NOT NULL DEFAULT 0,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `country_code` text NOT NULL,
  `county` text NOT NULL,
  `municipality` text NOT NULL,
  `state` text NOT NULL,
  `lat` float NOT NULL DEFAULT 0,
  `lng` float NOT NULL DEFAULT 0,
  `address_reference` text NOT NULL,
  `phone` text NOT NULL,
  `picture_url` text DEFAULT NULL,
  `picture_url_offer` text DEFAULT NULL,
  `picture_galery` text DEFAULT NULL,
  `calificacion` float NOT NULL DEFAULT 0 COMMENT '0.5-1-1.5-2-2.5-3-3.5-4-4.5-5',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1 = activo 0 = inactivo ',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vistas` int(11) NOT NULL DEFAULT 0,
  `reservaciones` int(11) NOT NULL DEFAULT 0,
  `fin_oferta` datetime DEFAULT NULL COMMENT 'fin de la promocion ',
  `fechas_desactivada` text DEFAULT NULL,
  `camping_mochila` tinyint(4) DEFAULT 0,
  `camping_baul` tinyint(4) DEFAULT 0,
  `agua` tinyint(4) DEFAULT 0,
  `luz` tinyint(4) DEFAULT 0,
  `tocador` tinyint(4) DEFAULT 0,
  `cocinas` tinyint(4) DEFAULT 0,
  `bbq` tinyint(4) DEFAULT 0,
  `fogata` tinyint(4) DEFAULT 0,
  `historico` tinyint(4) DEFAULT 0,
  `ecologia` tinyint(4) DEFAULT 0,
  `agricola` tinyint(4) DEFAULT 0,
  `reactivo_pasivo` tinyint(4) DEFAULT 0,
  `reactivo_activo` tinyint(4) DEFAULT 0,
  `recreacion_piscinas` tinyint(4) DEFAULT 0,
  `recreacion_acuaticas` tinyint(4) DEFAULT 0,
  `recreacion_veredas` tinyint(4) DEFAULT 0,
  `recreacion_espeleologia` tinyint(4) DEFAULT 0,
  `recreacion_kayac_paddle_balsas` tinyint(4) DEFAULT 0,
  `recreacion_cocina` tinyint(4) DEFAULT 0,
  `recreacion_pajaros` tinyint(4) DEFAULT 0,
  `recreacion_alpinismo` tinyint(4) DEFAULT 0,
  `recreacion_zipline` tinyint(4) DEFAULT 0,
  `paracaidas` tinyint(4) DEFAULT 0,
  `recreacion_areas` tinyint(4) DEFAULT 0,
  `recreacion_animales` tinyint(4) DEFAULT 0,
  `equipos_mesas` tinyint(4) DEFAULT 0,
  `equipos_sillas` tinyint(4) DEFAULT 0,
  `equipos_estufas` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`,`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;


-- Volcando estructura para disparador estudio5_prujula.anuncios_before_update
DROP TRIGGER IF EXISTS `anuncios_before_update`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `anuncios_before_update` BEFORE UPDATE ON `anuncios` FOR EACH ROW BEGIN
	IF NEW.fin_oferta >= CURRENT_DATE() THEN
		SET NEW.offer = 1;
	ELSEIF NEW.fin_oferta < CURRENT_DATE() THEN
		SET NEW.offer = 0;
	ELSEIF NEW.fin_oferta = NULL THEN
		SET NEW.offer = 0;	
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
