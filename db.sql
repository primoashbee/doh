/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19 : Database - doh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`doh` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `doh`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`isAdmin`,`firstname`,`birthday`,`lastname`,`gender`,`img_url`,`created_at`,`updated_at`,`isDeleted`) values (6,'admin','1234',1,'ADMINISTRATOR','2000-01-01','ADMINISTRATOR',NULL,NULL,'2018-01-03 13:54:47','2018-01-03 13:54:47',0),(16,'primoashbee','password',0,'Ashbee','1994-11-26','Morgado','Male',NULL,'2018-01-04 09:45:10','2018-01-04 09:45:10',0),(17,'naruto','password',0,'Uzumaki','2000-01-01','Naruto','Male',NULL,'2018-01-04 09:45:27','2018-01-04 09:45:27',0),(18,'edsheeran','password',0,'Ed','2000-01-01','Sheeran','Male',NULL,'2018-01-04 09:45:43','2018-01-04 09:45:43',0),(19,'motherdrogo','password',0,'Daenarys','2000-01-01','Targaryen','Female',NULL,'2018-01-04 09:46:08','2018-01-04 09:46:08',0),(20,'bender','password',0,'Bender','2000-01-01','Rodriguez','Male',NULL,'2018-01-04 09:49:09','2018-01-04 09:49:09',0);

/*Table structure for table `baranggays` */

DROP TABLE IF EXISTS `baranggays`;

CREATE TABLE `baranggays` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `baranggays` */

insert  into `baranggays`(`id`,`name`,`created_at`,`updated_at`,`isDeleted`) values (1,'Poblacion','2018-01-04 12:21:28','2018-01-04 12:21:28',0),(2,'Cataning','2018-01-04 12:21:32','2018-01-04 12:21:32',0),(3,'Bagumbayan','2018-01-04 12:21:38','2018-01-04 12:21:38',0),(4,'Talisay','2018-01-04 12:21:41','2018-01-04 12:21:41',0),(5,'Malabia','2018-01-04 12:21:46','2018-01-04 12:21:46',0),(6,'San Jose\r\n','2018-01-04 12:21:46','2018-01-04 12:21:46',0),(7,'Ibayo','2018-01-04 12:21:52','2018-01-04 12:21:52',0),(8,'Dona Francisca','2018-01-04 12:21:56','2018-01-04 12:21:56',0),(9,'Cupang Proper','2018-01-04 12:21:59','2018-01-04 12:21:59',0),(10,'Cupang North','2018-01-04 12:22:03','2018-01-04 12:22:03',0),(11,'Cupang West','2018-01-04 12:22:04','2018-01-04 12:22:04',0),(12,'Sibacan','2018-01-04 12:22:07','2018-01-04 12:22:07',0),(13,'Tuyo','2018-01-04 12:22:10','2018-01-04 12:22:10',0),(14,'Puerto Rivas Ibaba','2018-01-04 12:22:18','2018-01-04 12:22:18',0),(15,'Puerto Rivas Itaas','2018-01-04 12:22:21','2018-01-04 12:22:21',0),(16,'Tortugas','2018-01-04 12:22:24','2018-01-04 12:22:24',0),(17,'Central','2018-01-04 12:22:27','2018-01-04 12:22:27',0),(18,'Tenejero','2018-01-04 12:22:30','2018-01-04 12:22:30',0),(19,'Camacho','2018-01-04 12:22:33','2018-01-04 12:22:33',0),(20,'Bagong Silang','2018-01-04 12:22:37','2018-01-04 12:22:37',0),(21,'Puerto Rivas Lote','2018-01-04 12:22:39','2018-01-04 12:22:39',0),(22,'Dangcol','2018-01-04 12:22:44','2018-01-04 12:22:44',0),(23,'Cabog-Cabog','2018-01-04 12:22:47','2018-01-04 12:22:47',0),(24,'Tanato','2018-01-04 12:22:52','2018-01-04 12:22:52',0),(25,'Munting Batangas','2018-01-04 12:22:53','2018-01-04 12:22:53',0);

/*Table structure for table `diseases` */

DROP TABLE IF EXISTS `diseases`;

CREATE TABLE `diseases` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `disease_name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `diseases` */

insert  into `diseases`(`id`,`disease_name`,`description`,`created_at`,`updated_at`,`isDeleted`) values (1,'askjd','asdklj12313','2018-01-04 10:42:07','2018-01-04 10:42:07',0),(2,'Acanthamoeba Infection','O\'RElly? ***','2018-01-04 10:55:05','2018-01-04 10:55:05',0),(3,'Adenoviruses ','Adenoviruses are common causes of respiratory illness, but most infections are not severe. They can cause cold-like symptoms, sore throat, bronchitis, pneumonia, diarrhea, and pink eye (conjunctivitis). You can get an adenovirus infection at any age, but infants and people with weakened immune systems are more likely than others to develop severe illness from adenovirusesâ€¦','2018-01-04 10:55:52','2018-01-04 10:55:52',0),(4,'UTI','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2018-01-04 20:03:31','2018-01-04 20:03:31',0);

/*Table structure for table `outbreak` */

DROP TABLE IF EXISTS `outbreak`;

CREATE TABLE `outbreak` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(15) unsigned NOT NULL,
  `disease_id` int(15) unsigned NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(15) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `outbreak` */

insert  into `outbreak`(`id`,`patient_id`,`disease_id`,`status`,`created_at`,`updated_at`,`created_by`) values (1,9,2,'Mortality','2018-01-05 14:58:35','2018-01-05 14:58:35',16),(2,9,1,'Mortality','2018-01-05 14:58:47','2018-01-05 14:58:47',16),(3,9,4,'Mortality','2018-01-05 14:59:58','2018-01-05 14:59:58',16),(4,14,4,NULL,'2018-01-05 15:12:04','2018-01-05 15:12:04',16),(5,14,1,NULL,'2018-01-05 15:12:18','2018-01-05 15:12:18',16);

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `baranggay_id` int(15) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  `created_by` int(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `patients` */

insert  into `patients`(`id`,`firstname`,`lastname`,`birthday`,`address`,`contact`,`gender`,`baranggay_id`,`created_at`,`updated_at`,`isDeleted`,`created_by`) values (4,'Ashbee','Morgado1','1994-11-26','#1647 Balic-BAlic Sta. Rita Olongapo\'s City','09171101126','Male',15,'2018-01-04 13:37:45','2018-01-04 13:37:45',1,16),(5,'Bruno','Mars','1989-05-23','DOON SA MALAYO HINDI KO ALAM KUNG TAGA SAAN EH','09276131095','Male',1,'2018-01-04 13:40:59','2018-01-04 13:40:59',1,16),(6,'Ed','Sheeran','1990-08-04','asdjalkdaslkasjdalksdjaskldjalksd','09094012258','Male',14,'2018-01-05 09:05:06','2018-01-05 09:05:06',0,16),(7,'aasd','adadasd','2018-01-10','1321','09191234566','Female',14,'2018-01-05 09:15:53','2018-01-05 09:15:53',0,16),(8,'asdada','dasdadsada','2018-01-16','123321312','09191234565','Male',17,'2018-01-05 09:16:04','2018-01-05 09:16:04',0,16),(9,'123123123','asdasdasd','2018-01-14','21312312','09191234564','Male',17,'2018-01-05 09:16:15','2018-01-05 09:16:15',0,16),(10,'dae123123x123x','1x3123x123x12','2017-12-31','1231231','09191234569','Male',17,'2018-01-05 09:16:27','2018-01-05 09:16:27',0,16),(11,'123x123x1','sadasdasdad','2017-12-07','21312213123','09191232567','Female',16,'2018-01-05 09:16:40','2018-01-05 09:16:40',0,16),(12,'12312x3123x21','3x123x1231x23','2017-12-05','13x1312x312','09191534567','Female',17,'2018-01-05 09:16:55','2018-01-05 09:16:55',0,16),(13,'32312x123x','123x123123123','2017-12-31','213123123','09191254567','Male',16,'2018-01-05 09:17:06','2018-01-05 09:17:06',0,16),(14,'13x1231x23','123123x123x12','2018-01-16','sdadsadasdasd','09191234597','Female',16,'2018-01-05 09:17:17','2018-01-05 09:17:17',0,16),(15,'12x3123x','123x123x123','2018-01-15','123x123x23x12','09191236567','Female',17,'2018-01-05 09:17:27','2018-01-05 09:17:27',0,16),(16,'12c3123c','123c123c12','2018-01-18','123123213','09194234567','Female',14,'2018-01-05 09:17:41','2018-01-05 09:17:41',0,16);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
