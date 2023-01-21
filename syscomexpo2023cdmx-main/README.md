# SYSCOM EXPO 2023 CDMX
<h3>Base de datos</h3>
CREATE DATABASE `expo` /*!40100 DEFAULT CHARACTER SET utf8 */;
<br><br>
CREATE TABLE `asistentes2023mx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) DEFAULT NULL,
  `apellido` varchar(35) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
<br><br>
CREATE TABLE `notas2023mx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `capturado_por` varchar(55) DEFAULT NULL,
  `nota` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
<br><br>
CREATE TABLE `registros2023mx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) DEFAULT NULL,
  `apellido` varchar(35) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `cuenta` int(11) DEFAULT NULL,
  `ciudad` varchar(25) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  `pais` varchar(2) DEFAULT 'MX',
  `telefono` varchar(15) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

