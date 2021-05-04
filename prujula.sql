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


-- Volcando estructura de base de datos para prujuladb
CREATE DATABASE IF NOT EXISTS `prujuladb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `prujuladb`;

-- Volcando estructura para tabla prujuladb.administradores
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.administradores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` (`id`, `nombre`, `email`, `foto`, `password`, `perfil`, `estado`, `fecha`) VALUES
	(1, 'Administrador', 'admin@admin.com', 'vistas/img/perfiles/499.png', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', 'administrador', 1, '2018-03-27 23:48:36');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.anuncios
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'debe estar incluida la API de google MAPS',
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `image_url` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `image_url_oferta` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `calificacion` float NOT NULL DEFAULT 0 COMMENT '0.5-1-1.5-2-2.5-3-3.5-4-4.5-5',
  `latitud` float NOT NULL DEFAULT 0,
  `longitud` float NOT NULL DEFAULT 0,
  `habitaciones` int(11) NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `precio_oferta` float NOT NULL DEFAULT 0,
  `descuento` float NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1 = activo 0 = inactivo ',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vistas` int(11) NOT NULL,
  `reservaciones` int(11) NOT NULL,
  `image_portada` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'foto principal ',
  `image_portada_oferta` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'foto oferta ',
  `fin_oferta` datetime DEFAULT NULL COMMENT 'fin de la promocion ',
  `fechas_desactivada` text COLLATE utf8_spanish2_ci NOT NULL,
  `oferta` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`id_categoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.anuncios: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` (`id`, `titulo`, `descripcion`, `id_categoria`, `image_url`, `image_url_oferta`, `calificacion`, `latitud`, `longitud`, `habitaciones`, `precio`, `precio_oferta`, `descuento`, `estado`, `fecha_creacion`, `vistas`, `reservaciones`, `image_portada`, `image_portada_oferta`, `fin_oferta`, `fechas_desactivada`, `oferta`) VALUES
	(1, 'casa en la colonia tovar ', 'con todo slos juguetes ', 1, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', '', 3.5, 42.2655, -83.4159, 5, 100, 0, 0, 1, '2021-04-28 17:54:41', 25, 10, 'https://openphoto.net/gallery/image/view/30823', 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fmensajeconpoder.net%2Funa-increible-oferta-espiritua%2Funa-increible-oferta%2F&psig=AOvVaw0jHAP5lSGp-AG_79xXTcgx&ust=1619100724277000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNCZ77bCj_ACFQAAAAAdAAAAABAD', NULL, '["2021-04-25","2021-04-26","2013-04-27"]', 1),
	(2, 'chuspa', 'ful equipo ', 2, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', '', 4, 18.4534, -66.0845, 3, 50, 0, 0, 1, '2021-04-28 17:54:41', 10, 2, 'https://openphoto.net/gallery/name/summer/27', 'http://openphoto.net/gallery/image/view/6268', NULL, '', 1),
	(3, 'vargas', 'solo 3 dias ', 3, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', '', 2, -33.3774, -70.5271, 2, 250, 0, 0, 1, '2021-04-28 17:54:41', 1, 0, 'http://openphoto.net/gallery/name/vieques/649', 'http://openphoto.net/gallery/image/view/6268', NULL, '', 1),
	(4, 'catia la mar', 'por dia ', 2, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', '', 3, -33.4549, -70.6016, 1, 75, 0, 0, 1, '2021-04-28 17:54:41', 16, 4, 'https://openphoto.net/gallery/name/renaissance+faire/1401', 'http://openphoto.net/gallery/image/view/7431', NULL, '', 1),
	(5, 'Nuevo Horizonte', 'full date ', 3, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', '', 2, -34.6115, -58.4201, 4, 120, 0, 0, 1, '2021-04-28 17:54:41', 30, 6, 'http://miro.openphoto.net/gallery/index.html', 'http://openphoto.net/gallery/name/flowers/10', NULL, '', 1),
	(6, 'Vargas Posada con todo los juguetes', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 50', 1, '[\r\n{"image":"https://i.picsum.photos/id/324/700/400.jpg?hmac=PbQ4RF92FJJ0nPsEpvf4wXJNEgmh3BEgIDFlisOAYDI"},\r\n{"image":"https://i.picsum.photos/id/845/700/400.jpg?hmac=gWs_gh5g-JOCxJuAp6O59mZlAJNW1JaQVUN1m1vO3P0"},\r\n{"image":"https://i.picsum.photos/id/1043/700/400.jpg?hmac=UPmheNCjMkMtqEqwGts1o2IzXQpGLU-lgOuOZp4seKo"},\r\n{"image":"https://i.picsum.photos/id/503/700/400.jpg?hmac=wJ8lBwuFr_IkjrxrYngI-EmpA-Ha4hr8ucsbISNoaNs"},\r\n{"image":"https://i.picsum.photos/id/1054/700/400.jpg?hmac=zw1kjhKrNTBLiHzp1jAlJtOuSJZe1zaNT6HFOrcQTYQ"}\r\n]', NULL, 0, -33.4549, -70.6016, 16, 120.22, 100, 20, 1, '2021-04-28 17:54:41', 40, 15, 'https://i.picsum.photos/id/870/700/400.jpg?hmac=_1utao1ITBvc_8mHEobUEjsIGluEy2YTrvGr4Dro_tA', 'https://www.shutterstock.com/es/image-photo/girl-building-sand-castle-on-beach-363276086', NULL, '', 1),
	(7, 'Vargas Posada con todo los juguetes', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 50', 1, NULL, NULL, 0, -33.4549, -70.6016, 16, 120.22, 100, 20, 1, '2021-04-28 17:54:41', 10, 1, 'https://i.picsum.photos/id/870/700/400.jpg?hmac=_1utao1ITBvc_8mHEobUEjsIGluEy2YTrvGr4Dro_tA', 'https://www.shutterstock.com/es/image-photo/fitness-sport-yoga-healthy-lifestyle-concept-551987794', NULL, '', 1),
	(8, 'Catia los magallannes san isidro', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 50', 3, NULL, NULL, 0, 10.5157, -66.9472, 16, 135.22, 125, 20, 1, '2021-04-28 17:54:41', 4, 0, 'https://www.shutterstock.com/es/search/spring', 'https://www.shutterstock.com/es/image-photo/happy-traveler-woman-bikini-relaxing-on-618044864', NULL, '', 1),
	(9, 'Chuspa', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 50', 2, NULL, NULL, 0, 10.617, -66.3173, 16, 252.11, 220, 20, 1, '2021-04-28 17:58:33', 8, 0, 'https://www.shutterstock.com/es/image-photo/traveling-woman-backpack-straw-hat-looking-400843174', 'https://www.shutterstock.com/es/image-photo/thai-dogs-enjoy-playing-on-beach-584728828', NULL, '', 1),
	(10, 'margarita', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 50', 3, NULL, NULL, 0, 11.0209, -64.2328, 10, 180, 160, 10, 1, '2021-04-28 17:54:41', 35, 5, 'https://www.shutterstock.com/es/image-photo/happy-family-holidays-joyful-father-mother-717546631', 'https://www.shutterstock.com/es/image-photo/happy-family-holidays-joyful-father-mother-717546631', NULL, '', 1);
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.banner
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.banner: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `ruta`, `tipo`, `image`, `estado`, `fecha`) VALUES
	(1, 'sin-categoria', 'sin-categoria', 'views/img/banner/default.jpg', 1, '2021-04-14 16:07:23'),
	(3, 'desarrollo-web', 'subcategorias', 'views/img/banner/web.jpg', 1, '2021-04-14 16:07:29'),
	(4, 'calzado', 'categorias', 'views/img/banner/ropaHombre.jpg', 1, '2021-04-14 16:07:34');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.calificacion
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

-- Volcando estructura para tabla prujuladb.categorias
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `estado`, `fecha_creacion`, `ruta`, `img`, `oferta`, `precioOferta`, `descuentoOferta`, `imgOferta`, `finOferta`) VALUES
	(1, 'reservaciones', 1, '2021-04-14 19:53:25', '', 'views/img/category/bolso.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(2, 'viajes', 1, '2021-04-14 19:53:41', '', 'views/img/category/calzado.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(3, 'turismo', 1, '2021-04-14 19:54:06', '', 'views/img/category/cursos.jpg', 0, 0, 0, '', '2021-04-07 14:16:04'),
	(4, 'vacaciones', 1, '2021-04-14 19:54:16', '', 'views/img/category/ropa-para-dama.jpg', 0, 0, 0, '', '2021-04-14 14:51:26');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text COLLATE utf8_spanish2_ci NOT NULL,
  `API_KEY` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.config: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `logo`, `API_KEY`) VALUES
	(1, '', '43832e1f69258ca2ef5f2f2ee640133d');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.favoritos
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.favoritos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.localidad
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

-- Volcando estructura para tabla prujuladb.notificaciones
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nuevosUsuarios` int(11) NOT NULL,
  `nuevasVentas` int(11) NOT NULL,
  `nuevasVisitas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.notificaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;

-- Volcando estructura para tabla prujuladb.reservaciones
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla prujuladb.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `nombre`, `apellido`, `password`, `foto`, `estado`, `ultimo_login`, `fecha_creacion`, `telefono`, `idioma`, `modo`, `email_encriptado`, `verificacion`) VALUES
	(1, 'admin@admin.com', 'Administrador', '', '$2a$07$asxx54ahjppf45sd87a5auHhDisdvuSxcDBsaoZYMwJrghJ3jkICW', '', 1, '2021-03-15 13:07:34', '2021-03-15 20:07:34', '04142517231', 'es', 'directo', '', 0),
	(2, 'jdelgadilloz1905@gmail.com', 'Jorge', 'Delgadillo', '$2a$07$asxx54ahjppf45sd87a5au7NYaLAf5vzh7gP2S/vN7gjSK7yXSQVS', '', 1, '2021-04-27 12:40:36', '2021-04-27 17:40:36', NULL, 'en', 'directo', '8fb14cb673a4608b7efd4e5d35e84c84', 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para disparador prujuladb.anuncios_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `anuncios_before_update` BEFORE UPDATE ON `anuncios` FOR EACH ROW BEGIN
	IF NEW.fin_oferta >= CURRENT_DATE() THEN
		SET NEW.oferta = 1;
	ELSEIF NEW.fin_oferta < CURRENT_DATE() THEN
		SET NEW.oferta = 0;
	ELSEIF NEW.fin_oferta = NULL THEN
		SET NEW.oferta = 0;	
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
