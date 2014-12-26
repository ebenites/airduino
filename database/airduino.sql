/*
SQLyog Ultimate v9.63 
MySQL - 5.5.24-log : Database - airdruino
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`airdruino` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `airdruino`;

/*Table structure for table `dispositivo` */

DROP TABLE IF EXISTS `dispositivo`;

CREATE TABLE `dispositivo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_UNIQUE` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `dispositivo` */

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `grupo` */

insert  into `grupo`(`id`,`nombre`) values (10,'Pabellón 1');

/*Table structure for table `pin` */

DROP TABLE IF EXISTS `pin`;

CREATE TABLE `pin` (
  `dispositivo_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `grupo_id` int(10) DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`dispositivo_id`,`id`),
  KEY `fk_pin_dispositivo_idx` (`dispositivo_id`),
  KEY `fk_pin_grupo_idx` (`grupo_id`),
  CONSTRAINT `fk_pin_dispositivo` FOREIGN KEY (`dispositivo_id`) REFERENCES `dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pin_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `pin` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
