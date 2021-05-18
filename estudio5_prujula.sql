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

-- Volcando estructura para tabla estudio5_prujula.administradores
DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ultimo_login` datetime DEFAULT NULL,
  `dispositivo` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.administradores: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` (`id`, `nombre`, `email`, `foto`, `password`, `perfil`, `estado`, `fecha`, `ultimo_login`, `dispositivo`) VALUES
	(1, 'Administrador', 'admin@admin.com', 'vistas/img/perfiles/499.png', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', 'Administrador', 1, '2021-05-18 14:30:19', '2021-05-18 13:30:19', NULL);
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.anuncios
DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `titulo` text NOT NULL,
  `precio` float NOT NULL DEFAULT 0,
  `descripcion` text NOT NULL COMMENT 'debe estar incluida la API de google MAPS',
  `media` text DEFAULT NULL,
  `personas` int(11) NOT NULL DEFAULT 0,
  `oferta` int(11) NOT NULL DEFAULT 0,
  `monto_descuento` float NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `direccion` text NOT NULL,
  `ciudad` text NOT NULL,
  `lat` float NOT NULL DEFAULT 0,
  `lng` float NOT NULL DEFAULT 0,
  `direccion_referencia` text NOT NULL,
  `telefono` text NOT NULL,
  `imagen_principal` text DEFAULT NULL,
  `imagen_oferta` text DEFAULT NULL,
  `imagen_galeria` text DEFAULT NULL,
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
  PRIMARY KEY (`id`,`id_categoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla estudio5_prujula.anuncios: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` (`id`, `id_user`, `titulo`, `precio`, `descripcion`, `media`, `personas`, `oferta`, `monto_descuento`, `id_categoria`, `direccion`, `ciudad`, `lat`, `lng`, `direccion_referencia`, `telefono`, `imagen_principal`, `imagen_oferta`, `imagen_galeria`, `calificacion`, `estado`, `fecha_creacion`, `vistas`, `reservaciones`, `fin_oferta`, `fechas_desactivada`, `camping_mochila`, `camping_baul`, `agua`, `luz`, `tocador`, `cocinas`, `bbq`, `fogata`, `historico`, `ecologia`, `agricola`, `reactivo_pasivo`, `reactivo_activo`, `recreacion_piscinas`, `recreacion_acuaticas`, `recreacion_veredas`, `recreacion_espeleologia`, `recreacion_kayac_paddle_balsas`, `recreacion_cocina`, `recreacion_pajaros`, `recreacion_alpinismo`, `recreacion_zipline`, `paracaidas`, `recreacion_areas`, `recreacion_animales`, `equipos_mesas`, `equipos_sillas`, `equipos_estufas`) VALUES
	(15, 0, 'Casa en oferta!', 12000, 'descripcion de prueba', 'Medio de pago', 2, 1, 50, 1, 'San Juan, República Dominicana', 'República Dominicana', -71.2863, 18.8797, 'direccion exacta de prueba', '02128700824', '{"date":"Tue, 11 May 2021 08:55:38 -0500","extension":"png","file":"views\\/img\\/anuncios\\/uRzNKVT8HSovrt2Um7Lp.png","name":"uRzNKVT8HSovrt2Um7Lp.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"uRzNKVT8HSovrt2Um7Lp","type":"image\\/png","uploaded":true}', '{"date":"Tue, 11 May 2021 08:55:40 -0500","extension":"png","file":"views\\/img\\/anuncios\\/LbQegUCcA9TjlNRSPdFB.png","name":"LbQegUCcA9TjlNRSPdFB.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network","replaced":false,"size":20487,"size2":"20.01 KB","title":"LbQegUCcA9TjlNRSPdFB","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1620741320988-9","image":"views\\/img\\/anuncios\\/0oekXaqbWfHrcNvnTMxp.png","name":"0oekXaqbWfHrcNvnTMxp.png","old_name":"cnt.png","old_title":"cnt"},{"uid":"rc-upload-1620741320988-8","image":"views\\/img\\/anuncios\\/6dMy3uvLtPNeRlWcBOSn.png","name":"6dMy3uvLtPNeRlWcBOSn.png","old_name":"CNBC.png","old_title":"CNBC"},{"uid":"rc-upload-1620741320988-11","image":"views\\/img\\/anuncios\\/oVduigYIb0zW3H8ylRe1.png","name":"oVduigYIb0zW3H8ylRe1.png","old_name":"cooking.png","old_title":"cooking"},{"uid":"rc-upload-1620741320988-10","image":"views\\/img\\/anuncios\\/bEgyDvXL6MzVfnou7_wC.png","name":"bEgyDvXL6MzVfnou7_wC.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-12 22:23:18', 0, 0, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
	(16, 0, 'Casa en oferta!', 12000, 'descripcion de prueba', 'Medio de pago', 2, 1, 50, 1, 'San Juan, República Dominicana', 'República Dominicana', -71.2863, 18.8797, 'direccion exacta de prueba', '02128700824', '{"date":"Tue, 11 May 2021 08:55:38 -0500","extension":"png","file":"views\\/img\\/anuncios\\/uRzNKVT8HSovrt2Um7Lp.png","name":"uRzNKVT8HSovrt2Um7Lp.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"uRzNKVT8HSovrt2Um7Lp","type":"image\\/png","uploaded":true}', '{"date":"Tue, 11 May 2021 08:55:40 -0500","extension":"png","file":"views\\/img\\/anuncios\\/LbQegUCcA9TjlNRSPdFB.png","name":"LbQegUCcA9TjlNRSPdFB.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network","replaced":false,"size":20487,"size2":"20.01 KB","title":"LbQegUCcA9TjlNRSPdFB","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1620741320988-9","image":"views\\/img\\/anuncios\\/0oekXaqbWfHrcNvnTMxp.png","name":"0oekXaqbWfHrcNvnTMxp.png","old_name":"cnt.png","old_title":"cnt"},{"uid":"rc-upload-1620741320988-8","image":"views\\/img\\/anuncios\\/6dMy3uvLtPNeRlWcBOSn.png","name":"6dMy3uvLtPNeRlWcBOSn.png","old_name":"CNBC.png","old_title":"CNBC"},{"uid":"rc-upload-1620741320988-11","image":"views\\/img\\/anuncios\\/oVduigYIb0zW3H8ylRe1.png","name":"oVduigYIb0zW3H8ylRe1.png","old_name":"cooking.png","old_title":"cooking"},{"uid":"rc-upload-1620741320988-10","image":"views\\/img\\/anuncios\\/bEgyDvXL6MzVfnou7_wC.png","name":"bEgyDvXL6MzVfnou7_wC.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-17 20:05:30', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 0, 'Casa en oferta!', 12000, 'descripcion de prueba', 'Medio de pago', 2, 1, 50, 1, 'San Juan, República Dominicana', 'República Dominicana', -71.2863, 18.8797, 'direccion exacta de prueba', '02128700824', '{"date":"Tue, 11 May 2021 08:55:38 -0500","extension":"png","file":"views\\/img\\/anuncios\\/uRzNKVT8HSovrt2Um7Lp.png","name":"uRzNKVT8HSovrt2Um7Lp.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"uRzNKVT8HSovrt2Um7Lp","type":"image\\/png","uploaded":true}', '{"date":"Tue, 11 May 2021 08:55:40 -0500","extension":"png","file":"views\\/img\\/anuncios\\/LbQegUCcA9TjlNRSPdFB.png","name":"LbQegUCcA9TjlNRSPdFB.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network","replaced":false,"size":20487,"size2":"20.01 KB","title":"LbQegUCcA9TjlNRSPdFB","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1620741320988-9","image":"views\\/img\\/anuncios\\/0oekXaqbWfHrcNvnTMxp.png","name":"0oekXaqbWfHrcNvnTMxp.png","old_name":"cnt.png","old_title":"cnt"},{"uid":"rc-upload-1620741320988-8","image":"views\\/img\\/anuncios\\/6dMy3uvLtPNeRlWcBOSn.png","name":"6dMy3uvLtPNeRlWcBOSn.png","old_name":"CNBC.png","old_title":"CNBC"},{"uid":"rc-upload-1620741320988-11","image":"views\\/img\\/anuncios\\/oVduigYIb0zW3H8ylRe1.png","name":"oVduigYIb0zW3H8ylRe1.png","old_name":"cooking.png","old_title":"cooking"},{"uid":"rc-upload-1620741320988-10","image":"views\\/img\\/anuncios\\/bEgyDvXL6MzVfnou7_wC.png","name":"bEgyDvXL6MzVfnou7_wC.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-17 20:05:37', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 0, 'Casa en oferta', 12000, 'descripcion de prueba', 'medio de pago', 3, 1, 50, 3, 'San Juan, Puerto Rico, Estados Unidos de América', 'Estados Unidos de América', -66.1167, 18.4653, 'direccion exacta de prueba aqui', '02128700824', '{"date":"Mon, 17 May 2021 18:56:59 -0500","extension":"png","file":"views\\/img\\/anuncios\\/NSvy_RPkOeXI97d4LGat.png","name":"NSvy_RPkOeXI97d4LGat.png","old_name":"bbcwored.png","old_title":"bbcwored","replaced":false,"size":3932,"size2":"3.84 KB","title":"NSvy_RPkOeXI97d4LGat","type":"image\\/png","uploaded":true}', '{"date":"Mon, 17 May 2021 18:57:02 -0500","extension":"jpg","file":"views\\/img\\/anuncios\\/mU2JbrcVzETRSQylB7Fj.jpg","name":"mU2JbrcVzETRSQylB7Fj.jpg","old_name":"cinemaxeast - copia.jpg","old_title":"cinemaxeast - copia","replaced":false,"size":12717,"size2":"12.42 KB","title":"mU2JbrcVzETRSQylB7Fj","type":"image\\/jpeg","uploaded":true}', '[{"uid":"rc-upload-1621295802391-8","image":"views\\/img\\/anuncios\\/sTw_hFR3gWtH8G5Z7kA4.png","name":"sTw_hFR3gWtH8G5Z7kA4.png","old_name":"Atreseries_logo.svg.png","old_title":"Atreseries_logo.svg","position":"8"},{"uid":"rc-upload-1621295802391-9","image":"views\\/img\\/anuncios\\/CeUlY_vGHJ0NDap15uQt.png","name":"CeUlY_vGHJ0NDap15uQt.png","old_name":"bbc-america.png","old_title":"bbc-america","position":"9"},{"uid":"rc-upload-1621295802391-10","image":"views\\/img\\/anuncios\\/5ICi13gxMmlYsSGEqUuW.png","name":"5ICi13gxMmlYsSGEqUuW.png","old_name":"bbcwored.png","old_title":"bbcwored","position":"10"},{"uid":"rc-upload-1621295802391-11","image":"views\\/img\\/anuncios\\/xgwfKEDIT8qkR5sm9z2p.png","name":"xgwfKEDIT8qkR5sm9z2p.png","old_name":"BET_logo.png","old_title":"BET_logo","position":"11"},{"uid":"rc-upload-1621295802391-12","image":"views\\/img\\/anuncios\\/9a4hObmyYIDUAHkznJdQ.jpg","name":"9a4hObmyYIDUAHkznJdQ.jpg","old_name":"cinemaxeast - copia.jpg","old_title":"cinemaxeast - copia","position":"12"}]', 0, 1, '2021-05-17 20:13:38', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 0, 'Casa en oferta', 12000, 'descripcion de prueba', 'medio de pago', 3, 1, 50, 3, 'San Juan, Puerto Rico, Estados Unidos de América', 'Estados Unidos de América', -66.1167, 18.4653, 'direccion exacta de prueba aqui', '02128700824', '{"date":"Mon, 17 May 2021 18:56:59 -0500","extension":"png","file":"views\\/img\\/anuncios\\/NSvy_RPkOeXI97d4LGat.png","name":"NSvy_RPkOeXI97d4LGat.png","old_name":"bbcwored.png","old_title":"bbcwored","replaced":false,"size":3932,"size2":"3.84 KB","title":"NSvy_RPkOeXI97d4LGat","type":"image\\/png","uploaded":true}', '{"date":"Mon, 17 May 2021 18:57:02 -0500","extension":"jpg","file":"views\\/img\\/anuncios\\/mU2JbrcVzETRSQylB7Fj.jpg","name":"mU2JbrcVzETRSQylB7Fj.jpg","old_name":"cinemaxeast - copia.jpg","old_title":"cinemaxeast - copia","replaced":false,"size":12717,"size2":"12.42 KB","title":"mU2JbrcVzETRSQylB7Fj","type":"image\\/jpeg","uploaded":true}', '[{"uid":"rc-upload-1621295802391-8","image":"views\\/img\\/anuncios\\/sTw_hFR3gWtH8G5Z7kA4.png","name":"sTw_hFR3gWtH8G5Z7kA4.png","old_name":"Atreseries_logo.svg.png","old_title":"Atreseries_logo.svg","position":"8"},{"uid":"rc-upload-1621295802391-9","image":"views\\/img\\/anuncios\\/CeUlY_vGHJ0NDap15uQt.png","name":"CeUlY_vGHJ0NDap15uQt.png","old_name":"bbc-america.png","old_title":"bbc-america","position":"9"},{"uid":"rc-upload-1621295802391-10","image":"views\\/img\\/anuncios\\/5ICi13gxMmlYsSGEqUuW.png","name":"5ICi13gxMmlYsSGEqUuW.png","old_name":"bbcwored.png","old_title":"bbcwored","position":"10"},{"uid":"rc-upload-1621295802391-11","image":"views\\/img\\/anuncios\\/xgwfKEDIT8qkR5sm9z2p.png","name":"xgwfKEDIT8qkR5sm9z2p.png","old_name":"BET_logo.png","old_title":"BET_logo","position":"11"},{"uid":"rc-upload-1621295802391-12","image":"views\\/img\\/anuncios\\/9a4hObmyYIDUAHkznJdQ.jpg","name":"9a4hObmyYIDUAHkznJdQ.jpg","old_name":"cinemaxeast - copia.jpg","old_title":"cinemaxeast - copia","position":"12"}]', 0, 1, '2021-05-17 20:27:24', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 0, 'Camping en oferta', 15000, 'casa en full oportunidad', 'medio de pago', 4, 1, 25, 2, 'San Juan, Puerto Rico, Estados Unidos de América', 'Estados Unidos de América', -66.1167, 18.4653, 'direccion exacta de referencia', '02128700824', '{"date":"Mon, 17 May 2021 20:00:10 -0500","extension":"png","file":"views\\/img\\/anuncios\\/VNFshpAI3LMRZyf7OExJ.png","name":"VNFshpAI3LMRZyf7OExJ.png","old_name":"Atrescine_logo.svg.png","old_title":"Atrescine_logo.svg","replaced":false,"size":40505,"size2":"39.56 KB","title":"VNFshpAI3LMRZyf7OExJ","type":"image\\/png","uploaded":true}', '{"date":"Mon, 17 May 2021 20:00:14 -0500","extension":"png","file":"views\\/img\\/anuncios\\/g9NFz3TqjDiUwHBQIOVK.png","name":"g9NFz3TqjDiUwHBQIOVK.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central","replaced":false,"size":74197,"size2":"72.46 KB","title":"g9NFz3TqjDiUwHBQIOVK","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1621299591877-10","image":"views\\/img\\/anuncios\\/cFmdGlsr5fjZ6nOTK87W.png","name":"cFmdGlsr5fjZ6nOTK87W.png","old_name":"bbc-america.png","old_title":"bbc-america"},{"uid":"rc-upload-1621299591877-8","image":"views\\/img\\/anuncios\\/QCB7Ltpqy_SH6W4IEchP.png","name":"QCB7Ltpqy_SH6W4IEchP.png","old_name":"Atrescine_logo.svg.png","old_title":"Atrescine_logo.svg"},{"uid":"rc-upload-1621299591877-11","image":"views\\/img\\/anuncios\\/KGzTxAHEewStC5iL7cfB.png","name":"KGzTxAHEewStC5iL7cfB.png","old_name":"bbcwored.png","old_title":"bbcwored"},{"uid":"rc-upload-1621299591877-9","image":"views\\/img\\/anuncios\\/Hpfd_7uCDi2EUn9Gb3Tw.png","name":"Hpfd_7uCDi2EUn9Gb3Tw.png","old_name":"Atreseries_logo.svg.png","old_title":"Atreseries_logo.svg"},{"uid":"rc-upload-1621299591877-12","image":"views\\/img\\/anuncios\\/M7Wz5Jd2QFbq39IYPrmU.png","name":"M7Wz5Jd2QFbq39IYPrmU.png","old_name":"BET_logo.png","old_title":"BET_logo"}]', 0, 1, '2021-05-17 21:00:42', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 0, 'Camping en oferta', 16000, 'descripcion de prueba', 'medio de pago', 7, 1, 50, 1, 'San Juan, Puerto Rico, Estados Unidos de América', 'Estados Unidos de América', -66.1167, 18.4653, 'direccion exacta', '02128700824', '{"date":"Mon, 17 May 2021 20:19:53 -0500","extension":"png","file":"views\\/img\\/anuncios\\/xyhS9ZU8_IwpjnAqNa0K.png","name":"xyhS9ZU8_IwpjnAqNa0K.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"xyhS9ZU8_IwpjnAqNa0K","type":"image\\/png","uploaded":true}', '{"date":"Mon, 17 May 2021 20:19:55 -0500","extension":"png","file":"views\\/img\\/anuncios\\/UIQRhtE1JqszcoSr2yK0.png","name":"UIQRhtE1JqszcoSr2yK0.png","old_name":"Cartoon_Network - copia.png","old_title":"Cartoon_Network - copia","replaced":false,"size":20487,"size2":"20.01 KB","title":"UIQRhtE1JqszcoSr2yK0","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1621300774867-10","image":"views\\/img\\/anuncios\\/vmSa9C0FY6OLEkM2I_W3.png","name":"vmSa9C0FY6OLEkM2I_W3.png","old_name":"Cinemax_(Yellow).svg.png","old_title":"Cinemax_(Yellow).svg"},{"uid":"rc-upload-1621300774867-8","image":"views\\/img\\/anuncios\\/k3OVHhd_joquW0D9p5K1.png","name":"k3OVHhd_joquW0D9p5K1.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network"},{"uid":"rc-upload-1621300774867-9","image":"views\\/img\\/anuncios\\/BxRwf2YDzyU9daIoH1hV.png","name":"BxRwf2YDzyU9daIoH1hV.png","old_name":"Cinemax_(Yellow).svg - copia.png","old_title":"Cinemax_(Yellow).svg - copia"},{"uid":"rc-upload-1621300774867-12","image":"views\\/img\\/anuncios\\/bnUk2JAea6vqlhmNBudx.jpg","name":"bnUk2JAea6vqlhmNBudx.jpg","old_name":"cinemaxeast.jpg","old_title":"cinemaxeast"},{"uid":"rc-upload-1621300774867-11","image":"views\\/img\\/anuncios\\/_YnkuTDCz5Fia2t0A1dP.jpg","name":"_YnkuTDCz5Fia2t0A1dP.jpg","old_name":"cinemaxeast - copia.jpg","old_title":"cinemaxeast - copia"}]', 0, 1, '2021-05-17 21:20:17', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 0, 'Camping en oferta Exclusiva!', 25000, 'descripcion para pruebas ...', 'medio de pago definitivo', 2, 1, 25, 4, 'San Juan, Puerto Rico, Estados Unidos de América', 'Estados Unidos de América', -66.1167, 18.4653, 'direccion de donde se encuentra el camping', '02128700824', '{"date":"Mon, 17 May 2021 21:10:09 -0500","extension":"jpg","file":"views\\/img\\/anuncios\\/r_ov70j4pcPwhs2IHEXi.jpg","name":"r_ov70j4pcPwhs2IHEXi.jpg","old_name":"kidstv.jpg","old_title":"kidstv","replaced":false,"size":18097,"size2":"17.67 KB","title":"r_ov70j4pcPwhs2IHEXi","type":"image\\/jpeg","uploaded":true}', '{"date":"Mon, 17 May 2021 21:10:12 -0500","extension":"png","file":"views\\/img\\/anuncios\\/DQyvi8z1rIHc40jCJSAf.png","name":"DQyvi8z1rIHc40jCJSAf.png","old_name":"CNBC.png","old_title":"CNBC","replaced":false,"size":58388,"size2":"57.02 KB","title":"DQyvi8z1rIHc40jCJSAf","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1621303786869-8","image":"views\\/img\\/anuncios\\/65Mzl1FgcDfP7NVeW8CB.png","name":"65Mzl1FgcDfP7NVeW8CB.png","old_name":"American_Heroes_Channel.png","old_title":"American_Heroes_Channel"},{"uid":"rc-upload-1621303786869-10","image":"views\\/img\\/anuncios\\/xpmjhavJ851SRkcqQiBY.png","name":"xpmjhavJ851SRkcqQiBY.png","old_name":"Atrescine_logo.svg.png","old_title":"Atrescine_logo.svg"},{"uid":"rc-upload-1621303786869-9","image":"views\\/img\\/anuncios\\/Rp7GOuA5lMw0TE3exoFh.png","name":"Rp7GOuA5lMw0TE3exoFh.png","old_name":"Animal_Planet.png","old_title":"Animal_Planet"},{"uid":"rc-upload-1621303786869-11","image":"views\\/img\\/anuncios\\/OhtxQ3q9MXgdYsocmKWk.png","name":"OhtxQ3q9MXgdYsocmKWk.png","old_name":"Atreseries_logo.svg.png","old_title":"Atreseries_logo.svg"},{"uid":"rc-upload-1621303786869-12","image":"views\\/img\\/anuncios\\/Uk9iyvXo5rCZPh1EW0q8.png","name":"Uk9iyvXo5rCZPh1EW0q8.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-17 22:10:50', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 0, 'Campis Magallanes de catia !', 35000, 'Lo mejor de catia', 'pago completo ', 15, 1, 100, 1, 'San Juan, República Dominicana', 'República Dominicana', -71.2863, 18.8797, 'direccion exacta de prueba', '02128700824', '{"date":"Tue, 11 May 2021 08:55:38 -0500","extension":"png","file":"views\\/img\\/anuncios\\/uRzNKVT8HSovrt2Um7Lp.png","name":"uRzNKVT8HSovrt2Um7Lp.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"uRzNKVT8HSovrt2Um7Lp","type":"image\\/png","uploaded":true}', '{"date":"Tue, 11 May 2021 08:55:40 -0500","extension":"png","file":"views\\/img\\/anuncios\\/LbQegUCcA9TjlNRSPdFB.png","name":"LbQegUCcA9TjlNRSPdFB.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network","replaced":false,"size":20487,"size2":"20.01 KB","title":"LbQegUCcA9TjlNRSPdFB","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1620741320988-9","image":"views\\/img\\/anuncios\\/0oekXaqbWfHrcNvnTMxp.png","name":"0oekXaqbWfHrcNvnTMxp.png","old_name":"cnt.png","old_title":"cnt"},{"uid":"rc-upload-1620741320988-8","image":"views\\/img\\/anuncios\\/6dMy3uvLtPNeRlWcBOSn.png","name":"6dMy3uvLtPNeRlWcBOSn.png","old_name":"CNBC.png","old_title":"CNBC"},{"uid":"rc-upload-1620741320988-11","image":"views\\/img\\/anuncios\\/oVduigYIb0zW3H8ylRe1.png","name":"oVduigYIb0zW3H8ylRe1.png","old_name":"cooking.png","old_title":"cooking"},{"uid":"rc-upload-1620741320988-10","image":"views\\/img\\/anuncios\\/bEgyDvXL6MzVfnou7_wC.png","name":"bEgyDvXL6MzVfnou7_wC.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-18 13:10:05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 1, 'Campis Magallanes de catia !', 35000, 'Lo mejor de catia', 'pago completo ', 15, 1, 100, 1, 'San Juan, República Dominicana', 'República Dominicana', -71.2863, 18.8797, 'direccion exacta de prueba', '02128700824', '{"date":"Tue, 11 May 2021 08:55:38 -0500","extension":"png","file":"views\\/img\\/anuncios\\/uRzNKVT8HSovrt2Um7Lp.png","name":"uRzNKVT8HSovrt2Um7Lp.png","old_name":"bbc-america.png","old_title":"bbc-america","replaced":false,"size":9772,"size2":"9.54 KB","title":"uRzNKVT8HSovrt2Um7Lp","type":"image\\/png","uploaded":true}', '{"date":"Tue, 11 May 2021 08:55:40 -0500","extension":"png","file":"views\\/img\\/anuncios\\/LbQegUCcA9TjlNRSPdFB.png","name":"LbQegUCcA9TjlNRSPdFB.png","old_name":"Cartoon_Network.png","old_title":"Cartoon_Network","replaced":false,"size":20487,"size2":"20.01 KB","title":"LbQegUCcA9TjlNRSPdFB","type":"image\\/png","uploaded":true}', '[{"uid":"rc-upload-1620741320988-9","image":"views\\/img\\/anuncios\\/0oekXaqbWfHrcNvnTMxp.png","name":"0oekXaqbWfHrcNvnTMxp.png","old_name":"cnt.png","old_title":"cnt"},{"uid":"rc-upload-1620741320988-8","image":"views\\/img\\/anuncios\\/6dMy3uvLtPNeRlWcBOSn.png","name":"6dMy3uvLtPNeRlWcBOSn.png","old_name":"CNBC.png","old_title":"CNBC"},{"uid":"rc-upload-1620741320988-11","image":"views\\/img\\/anuncios\\/oVduigYIb0zW3H8ylRe1.png","name":"oVduigYIb0zW3H8ylRe1.png","old_name":"cooking.png","old_title":"cooking"},{"uid":"rc-upload-1620741320988-10","image":"views\\/img\\/anuncios\\/bEgyDvXL6MzVfnou7_wC.png","name":"bEgyDvXL6MzVfnou7_wC.png","old_name":"Comedy_Central.png","old_title":"Comedy_Central"}]', 0, 1, '2021-05-18 13:49:29', 0, 0, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.banner: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `ruta`, `tipo`, `image`, `estado`, `fecha`) VALUES
	(1, 'sin-categoria', 'sin-categoria', 'views/img/banner/default.jpg', 1, '2021-04-14 12:07:23'),
	(3, 'desarrollo-web', 'subcategorias', 'views/img/banner/web.jpg', 1, '2021-04-14 12:07:29'),
	(4, 'calzado', 'categorias', 'views/img/banner/ropaHombre.jpg', 1, '2021-04-14 12:07:34');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.calificacion
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

-- Volcando datos para la tabla estudio5_prujula.calificacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ruta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `img` text COLLATE utf8_spanish2_ci NOT NULL,
  `oferta` int(11) NOT NULL,
  `precioOferta` float NOT NULL,
  `descuentoOferta` int(11) NOT NULL,
  `imgOferta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `finOferta` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `estado`, `fecha_creacion`, `ruta`, `img`, `oferta`, `precioOferta`, `descuentoOferta`, `imgOferta`, `finOferta`) VALUES
	(1, 'reservaciones', 1, '2021-04-14 15:53:25', '', 'views/img/category/bolso.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(2, 'viajes', 1, '2021-04-14 15:53:41', '', 'views/img/category/calzado.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(3, 'turismo', 1, '2021-04-14 15:54:06', '', 'views/img/category/cursos.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(4, 'vacaciones', 1, '2021-04-14 15:54:16', '', 'views/img/category/ropa-para-dama.jpg', 0, 0, 0, '', '2021-04-14 14:51:26'),
	(5, 'CAMPING', 1, '2021-05-18 15:02:07', '', '', 0, 0, 0, '', '2021-05-18 15:02:07'),
	(6, 'HOTELES', 1, '2021-05-18 15:04:54', '', '', 0, 0, 0, '', '2021-05-18 15:04:54');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text COLLATE utf8_spanish2_ci NOT NULL,
  `API_KEY` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.config: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `logo`, `API_KEY`) VALUES
	(1, '', '43832e1f69258ca2ef5f2f2ee640133d');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.favoritos
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.favoritos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.localidad
DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.localidad: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `localidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `localidad` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.notificaciones
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nuevosUsuarios` int(11) NOT NULL,
  `nuevasVentas` int(11) NOT NULL,
  `nuevasVisitas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.notificaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.reservaciones
DROP TABLE IF EXISTS `reservaciones`;
CREATE TABLE IF NOT EXISTS `reservaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `personas` int(11) NOT NULL,
  `cantidad_dias` int(11) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `aprobado` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.reservaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reservaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservaciones` ENABLE KEYS */;

-- Volcando estructura para tabla estudio5_prujula.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish2_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT 'activo = 1 o inactivo = 0 ',
  `ultimo_login` datetime DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `idioma` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'en',
  `modo` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'directa, google, facebook',
  `email_encriptado` text COLLATE utf8_spanish2_ci NOT NULL,
  `verificacion` int(11) NOT NULL DEFAULT 1 COMMENT 'desde el email que recibio la primera vez',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla estudio5_prujula.usuarios: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `nombre`, `apellido`, `password`, `foto`, `estado`, `ultimo_login`, `fecha_creacion`, `telefono`, `idioma`, `modo`, `email_encriptado`, `verificacion`) VALUES
	(1, 'admin@admin.com', 'Administrador', '', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, '2021-03-15 13:07:34', '2021-03-15 16:07:34', '04142517231', 'es', 'directo', '', 0),
	(42, 'omen_dj@hotmail.com', 'Jorge Delgadillo', '', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10224632943746229&height=50&width=50&ext=1622772050&hash=AeT43aGiXkF6ISapyUA', 1, NULL, '2021-05-04 22:00:51', NULL, 'en', 'facebook', '9a1b2d623d0f1c4fe1eb2ce54644fc86', 0),
	(43, 'jdelgadilloz1905@gmail.com', 'Jorge', 'Delgadillo', '', 'https://lh3.googleusercontent.com/a-/AOh14GjRhl0upYMfUMENFlHZ1ogtxWdUhxJyXc-0xoHdMw=s96-c', 1, '2021-05-11 09:02:35', '2021-05-11 10:02:35', NULL, 'en', 'google', '8fb14cb673a4608b7efd4e5d35e84c84', 0),
	(44, 'arkhalem@gmail.com', 'Amilcar', 'Barahona', '$2a$07$asxx54ahjppf45sd87a5auDuH5Q..NuBkEg7dU2q2XKzB8OBcg8Im', '', 1, '2021-05-17 17:26:33', '2021-05-17 18:26:33', NULL, 'en', 'directo', 'f00fec0f39500aeeb54feed0121503f6', 0),
	(45, 'gggg@g.com', 'pedro', 'delgadillo', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, '2021-05-05 17:48:12', '2021-05-05 18:48:12', NULL, 'en', 'directo', '8a812aef77653b3a6f25627a4c9d2af2', 1),
	(46, 'estudio57pr@gmail.com', 'Estudio57', 'PR', '', 'https://lh3.googleusercontent.com/a/AATXAJxnhT4DQJdgkqv-SxNi0HgXw_NBIAA5P01rJEEX=s96-c', 1, '2021-05-10 15:00:16', '2021-05-10 16:00:16', NULL, 'en', 'google', '1aa3f78a46321001444cbce0db2d4cdc', 0),
	(48, 'pedro@gmail.com', 'pedro', 'perez', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, NULL, '2021-05-18 12:48:46', NULL, 'en', 'directo', 'c3b7f393410fe6185ba5d966a213a38f', 1),
	(49, 'pedrddo@gmail.com', 'pedro', 'perez', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, NULL, '2021-05-18 13:16:29', NULL, 'en', 'directo', '6efc67708963d3543ffb9f8076870155', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
