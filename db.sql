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
  `img_url` varchar(255) DEFAULT '../images/avatar/default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`isAdmin`,`firstname`,`birthday`,`lastname`,`gender`,`img_url`,`created_at`,`updated_at`,`isDeleted`) values (28,'admin','1234',1,NULL,NULL,NULL,NULL,'../images/avatar/default.png','2018-01-16 09:08:04','2018-01-16 09:08:04',0),(29,'ashbee','1234',0,'Ashbee','1994-11-26','Morgado','Male','../images/avatar/default.png','2018-01-18 09:08:36','2018-01-18 09:08:36',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `diseases` */

insert  into `diseases`(`id`,`disease_name`,`description`,`created_at`,`updated_at`,`isDeleted`) values (7,'Test','akldjaskdjaskdasj','2018-01-16 09:18:20','2018-01-16 09:18:20',1),(8,'UTI','Urinary Track Infection','2018-01-18 09:11:41','2018-01-18 09:11:41',0),(9,'Headache','Sakit sa ulo','2018-01-18 09:15:57','2018-01-18 09:15:57',0),(10,'AIDS/HIV','TULO HAHAHAHA','2018-01-18 09:16:32','2018-01-18 09:16:32',0),(11,'Asthma','Ubo ng ubo','2018-01-18 09:16:46','2018-01-18 09:16:46',0);

/*Table structure for table `outbreak` */

DROP TABLE IF EXISTS `outbreak`;

CREATE TABLE `outbreak` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(15) unsigned NOT NULL,
  `disease_id` int(15) unsigned NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(15) unsigned NOT NULL,
  `month` varchar(255) DEFAULT 'MONTH(CURRENT_TIMESTAMP)',
  `year` varchar(255) DEFAULT 'YEAR(CURRENT_TIMESTAMP)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `outbreak` */

insert  into `outbreak`(`id`,`patient_id`,`disease_id`,`status`,`lattitude`,`longitude`,`created_at`,`updated_at`,`created_by`,`month`,`year`) values (1,1,8,'mortality','14.667338889449432','120.54555416107178','2018-01-18 09:17:06','2018-01-18 09:17:06',29,'1','2018'),(2,2,10,'morbidity','14.667338889449432','120.54044723510742','2018-01-18 09:17:16','2018-01-18 09:17:16',29,'1','2018'),(3,5,11,'mortality','14.666633102207173','120.55250644683838','2018-01-18 09:17:26','2018-01-18 09:17:26',29,'1','2018'),(4,4,11,'mortality','14.65525715871266','120.54413795471191','2018-01-18 09:17:37','2018-01-18 09:17:37',29,'1','2018');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `patients` */

insert  into `patients`(`id`,`firstname`,`lastname`,`birthday`,`address`,`contact`,`gender`,`baranggay_id`,`created_at`,`updated_at`,`isDeleted`,`created_by`) values (1,'Ashbee','Morgado','1994-11-26','#1647 Balic - Balic Sta. Rita','0917110112694','Male',1,'2018-01-18 09:09:05','2018-01-18 09:09:05',0,29),(2,'Enmar','Andal','1990-01-01','Doon','09094012294','Male',5,'2018-01-18 09:09:23','2018-01-18 09:09:23',0,29),(3,'Jah','Mackay','1994-11-13','don sa gapo','09171101129','Female',20,'2018-01-18 09:09:45','2018-01-18 09:09:45',0,29),(4,'Suzette','Madayag','1990-01-01','don sa st reet','09194412294','Female',2,'2018-01-18 09:10:09','2018-01-18 09:10:09',0,29),(5,'Mary Jane','Lingat','1989-01-01','sindalan','09215569987','Female',6,'2018-01-18 09:10:41','2018-01-18 09:10:41',0,29);

/*Table structure for table `morbidity_scores` */

DROP TABLE IF EXISTS `morbidity_scores`;

/*!50001 DROP VIEW IF EXISTS `morbidity_scores` */;
/*!50001 DROP TABLE IF EXISTS `morbidity_scores` */;

/*!50001 CREATE TABLE  `morbidity_scores`(
 `disease_id` int(15) unsigned ,
 `disease_name` varchar(255) ,
 `total_count` bigint(21) 
)*/;

/*Table structure for table `mortality_scores` */

DROP TABLE IF EXISTS `mortality_scores`;

/*!50001 DROP VIEW IF EXISTS `mortality_scores` */;
/*!50001 DROP TABLE IF EXISTS `mortality_scores` */;

/*!50001 CREATE TABLE  `mortality_scores`(
 `disease_id` int(15) unsigned ,
 `disease_name` varchar(255) ,
 `total_count` bigint(21) 
)*/;

/*Table structure for table `scores` */

DROP TABLE IF EXISTS `scores`;

/*!50001 DROP VIEW IF EXISTS `scores` */;
/*!50001 DROP TABLE IF EXISTS `scores` */;

/*!50001 CREATE TABLE  `scores`(
 `disease_id` int(15) unsigned ,
 `disease_name` varchar(255) ,
 `total_count` bigint(21) 
)*/;

/*View structure for view morbidity_scores */

/*!50001 DROP TABLE IF EXISTS `morbidity_scores` */;
/*!50001 DROP VIEW IF EXISTS `morbidity_scores` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `morbidity_scores` AS select `o`.`disease_id` AS `disease_id`,`d`.`disease_name` AS `disease_name`,if((count(`o`.`disease_id`) > 0),count(`o`.`disease_id`),0) AS `total_count` from (`outbreak` `o` left join `diseases` `d` on((`d`.`id` = `o`.`disease_id`))) where (`o`.`status` = 'morbidity') group by `o`.`disease_id` */;

/*View structure for view mortality_scores */

/*!50001 DROP TABLE IF EXISTS `mortality_scores` */;
/*!50001 DROP VIEW IF EXISTS `mortality_scores` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mortality_scores` AS select `o`.`disease_id` AS `disease_id`,`d`.`disease_name` AS `disease_name`,if((count(`o`.`disease_id`) > 0),count(`o`.`disease_id`),0) AS `total_count` from (`outbreak` `o` left join `diseases` `d` on((`d`.`id` = `o`.`disease_id`))) where (`o`.`status` = 'mortality') group by `o`.`disease_id` */;

/*View structure for view scores */

/*!50001 DROP TABLE IF EXISTS `scores` */;
/*!50001 DROP VIEW IF EXISTS `scores` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scores` AS (select `o`.`disease_id` AS `disease_id`,`d`.`disease_name` AS `disease_name`,if((count(`o`.`disease_id`) > 0),count(`o`.`disease_id`),0) AS `total_count` from (`outbreak` `o` left join `diseases` `d` on((`d`.`id` = `o`.`disease_id`))) group by `o`.`disease_id`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
