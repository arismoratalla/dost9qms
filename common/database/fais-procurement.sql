/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.16-MariaDB : Database - fais-procurement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fais-procurement` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fais-procurement`;

/*Table structure for table `tbl_department` */

DROP TABLE IF EXISTS `tbl_department`;

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) DEFAULT NULL,
  `department_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_department` */

/*Table structure for table `tbl_division` */

DROP TABLE IF EXISTS `tbl_division`;

CREATE TABLE `tbl_division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_division` */

insert  into `tbl_division`(`id`,`code`,`name`) values (1,'FASTS','Finance, Administrative Support and Technical Services'),(2,'TS','Technical Services'),(3,'FOS','Field Operation Services'),(4,'ORD','Office of the Regional Director');

/*Table structure for table `tbl_line_item_budget` */

DROP TABLE IF EXISTS `tbl_line_item_budget`;

CREATE TABLE `tbl_line_item_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `period` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `division_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_line_item_budget` */

/*Table structure for table `tbl_project` */

DROP TABLE IF EXISTS `tbl_project`;

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

/*Table structure for table `tbl_purchase_request` */

DROP TABLE IF EXISTS `tbl_purchase_request`;

CREATE TABLE `tbl_purchase_request` (
  `purchase_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_request_number` varchar(100) DEFAULT NULL,
  `purchase_request_sai_number` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `purchase_request_date` date DEFAULT NULL,
  `purchase_request_saidate` date DEFAULT NULL,
  `purchase_request_purpose` varchar(255) DEFAULT NULL,
  `purchase_request_referrence_no` varchar(100) DEFAULT NULL,
  `purchase_request_project_name` varchar(100) DEFAULT NULL,
  `purchase_request_location_project` varchar(100) DEFAULT NULL,
  `purchase_request_requestedby_id` int(11) DEFAULT NULL,
  `purchase_request_approvedby_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchase_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_request` */

/*Table structure for table `tbl_purchase_request_details` */

DROP TABLE IF EXISTS `tbl_purchase_request_details`;

CREATE TABLE `tbl_purchase_request_details` (
  `purchase_request_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_request_id` int(11) DEFAULT NULL,
  `purchase_request_details_unit` int(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `purchase_request_details_item_description` varchar(255) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `purchase_request_details_quantity` int(11) DEFAULT NULL,
  `purchase_request_details_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`purchase_request_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_request_details` */

/*Table structure for table `tbl_section` */

DROP TABLE IF EXISTS `tbl_section`;

CREATE TABLE `tbl_section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) DEFAULT NULL,
  `section_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_section` */

/*Table structure for table `tbl_unit` */

DROP TABLE IF EXISTS `tbl_unit`;

CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `division_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_unit` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
