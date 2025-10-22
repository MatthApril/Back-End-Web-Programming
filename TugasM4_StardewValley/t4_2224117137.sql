/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - t4_224117137
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`t4_224117137` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `t4_224117137`;

/*Table structure for table `crops` */

DROP TABLE IF EXISTS `crops`;

CREATE TABLE `crops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_name` varchar(50) NOT NULL,
  `growth_time` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `crops` */

insert  into `crops`(`id`,`crop_name`,`growth_time`,`color`,`buy_price`,`sell_price`) values 
(1,'Parsnip',4,'oklch(90.1% 0.076 70.697)',20,35),
(2,'Cauliflower',10,'oklch(96.7% 0.067 \r\n122.328) ',80,175),
(3,'Potato',6,'oklch(55.4% 0.135 \r\n66.442) ',60,40),
(4,'Green Bean',2,'oklch(87.1% 0.15 \r\n154.449)',50,80);

/*Table structure for table `inventories` */

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `save_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(12) NOT NULL,
  PRIMARY KEY (`save_id`,`crop_id`,`type`),
  KEY `fk_crop_id2` (`crop_id`),
  CONSTRAINT `fk_crop_id2` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`),
  CONSTRAINT `fk_save_id2` FOREIGN KEY (`save_id`) REFERENCES `saves` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `inventories` */

insert  into `inventories`(`save_id`,`crop_id`,`amount`,`type`) values 
(4,1,11,'seed'),
(4,2,2,'seed');

/*Table structure for table `plots` */

DROP TABLE IF EXISTS `plots`;

CREATE TABLE `plots` (
  `plot_id` int(11) NOT NULL AUTO_INCREMENT,
  `save_id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `days_planted` int(11) NOT NULL,
  `is_watered` tinyint(1) NOT NULL,
  `plot_position` int(11) NOT NULL,
  PRIMARY KEY (`plot_id`),
  KEY `fk_save_id` (`save_id`),
  KEY `fk_crop_id` (`crop_id`),
  CONSTRAINT `fk_crop_id` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`),
  CONSTRAINT `fk_save_id` FOREIGN KEY (`save_id`) REFERENCES `saves` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `plots` */

insert  into `plots`(`plot_id`,`save_id`,`crop_id`,`days_planted`,`is_watered`,`plot_position`) values 
(19,4,2,2,0,1),
(20,4,1,2,0,2),
(21,4,NULL,0,0,3),
(22,4,NULL,0,0,4),
(23,4,NULL,0,0,5),
(24,4,NULL,0,0,6),
(25,4,NULL,0,0,7),
(26,4,NULL,0,0,8),
(27,4,NULL,0,0,9);

/*Table structure for table `saves` */

DROP TABLE IF EXISTS `saves`;

CREATE TABLE `saves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `day` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saves` */

insert  into `saves`(`id`,`name`,`farm_name`,`day`,`gold`) values 
(4,'adada','adada',44,1185);

/*Table structure for table `shipping_bin` */

DROP TABLE IF EXISTS `shipping_bin`;

CREATE TABLE `shipping_bin` (
  `save_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  PRIMARY KEY (`save_id`,`crop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `shipping_bin` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
