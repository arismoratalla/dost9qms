/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.30-MariaDB : Database - fais-procurement
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_department` */

insert  into `tbl_department`(`department_id`,`department_name`,`department_desc`) values (1,'asdad','asdasd'),(2,'asdasda','asdassd');

/*Table structure for table `tbl_division` */

DROP TABLE IF EXISTS `tbl_division`;

CREATE TABLE `tbl_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_division` */

insert  into `tbl_division`(`division_id`,`code`,`name`) values (1,'FASTS','Finance, Administrative Support and Technical Services'),(2,'TS','Technical Services'),(3,'FOS','Field Operation Services'),(4,'ORD','Office of the Regional Director');

/*Table structure for table `tbl_expenditure_class` */

DROP TABLE IF EXISTS `tbl_expenditure_class`;

CREATE TABLE `tbl_expenditure_class` (
  `expenditure_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`expenditure_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expenditure_class` */

insert  into `tbl_expenditure_class`(`expenditure_class_id`,`name`,`code`) values (1,'Personal Services','PS'),(2,'Maintenance and Other Operating Expenses','MOOE'),(3,'Special Purposes','SP'),(4,'Capital Outlay','CO');

/*Table structure for table `tbl_expenditure_object` */

DROP TABLE IF EXISTS `tbl_expenditure_object`;

CREATE TABLE `tbl_expenditure_object` (
  `expenditure_object_id` int(11) NOT NULL AUTO_INCREMENT,
  `expenditure_sub_class_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `object_code` int(11) NOT NULL,
  PRIMARY KEY (`expenditure_object_id`),
  KEY `expenditure_sub_class_id` (`expenditure_sub_class_id`),
  CONSTRAINT `tbl_expenditure_object_ibfk_1` FOREIGN KEY (`expenditure_sub_class_id`) REFERENCES `tbl_expenditure_sub_class` (`expenditure_sub_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expenditure_object` */

/*Table structure for table `tbl_expenditure_sub_class` */

DROP TABLE IF EXISTS `tbl_expenditure_sub_class`;

CREATE TABLE `tbl_expenditure_sub_class` (
  `expenditure_sub_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `expenditure_class_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class_code` varchar(20) NOT NULL,
  PRIMARY KEY (`expenditure_sub_class_id`),
  KEY `expenditure_class_id` (`expenditure_class_id`),
  CONSTRAINT `tbl_expenditure_sub_class_ibfk_1` FOREIGN KEY (`expenditure_class_id`) REFERENCES `tbl_expenditure_class` (`expenditure_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expenditure_sub_class` */

insert  into `tbl_expenditure_sub_class`(`expenditure_sub_class_id`,`expenditure_class_id`,`name`,`class_code`) values (1,1,'Salaries','501'),(2,1,'Other Compensation','501'),(3,1,'Magna Carta Benefits (RA 8439)','501'),(4,1,'Fixed Expenditure (RLIP)','501'),(5,2,'Traveling Expenses','502'),(6,2,'Training & Scholarship Expenses','502'),(7,2,'Supplies & Material Expenses','502'),(8,2,'Utility Expenses','502'),(9,2,'Communication Expenses','502'),(10,2,'Extraordinary & Misc Expenses','502'),(11,2,'Professional Services','502'),(12,2,'General Services','502'),(13,2,'Repair & Maintenance','502'),(14,2,'Financial Assistance / Subsidy','502'),(15,2,'Taxes, Insurance Premium & Other Fees','502'),(16,2,'Membership, Dues & Contribution to Organization','502'),(17,2,'Subscription Expenses','502'),(18,2,'Other MOOE','502'),(19,4,'Machinery & Equipment','');

/*Table structure for table `tbl_line_item_budget` */

DROP TABLE IF EXISTS `tbl_line_item_budget`;

CREATE TABLE `tbl_line_item_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `period` varchar(100) NOT NULL,
  `duration_start` date NOT NULL,
  `duration_end` date NOT NULL,
  `division_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_line_item_budget` */

/*Table structure for table `tbl_position` */

DROP TABLE IF EXISTS `tbl_position`;

CREATE TABLE `tbl_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_position` */

insert  into `tbl_position`(`position_id`,`code`,`name`) values (1,'Clerk I','Clerk I'),(2,'Clerk II','Clerk II'),(3,'Clerk III','Clerk III'),(4,'Clerk IV','Clerk IV'),(5,'PA I','Project Assistant I'),(6,'PA II','Project Assistant II'),(7,'PA III','Project Assistant III'),(8,'PDO I','Project Development Officer I'),(9,'PDO II','Project Development Officer II'),(10,'PDO III','Project Development Officer III'),(11,'Lab Aide I','Laboratory Aide I'),(12,'Lab Aide II','Laboratory Aide II'),(13,'SRA','Science Research Analyst'),(14,'SRA','Science Research Assistant'),(15,'SRS I','Science Research Specialist I'),(16,'SRS II','Science Research Specialist II'),(17,'SrSRS','Senior Science Research Specialist'),(18,'SuSRS','Supervising Science Research Specialist'),(19,'AA I','Administrative Assistant I'),(20,'AA II','Administrative Assistant II'),(21,'AA III','Administrative Assistant III'),(22,'AA IV','Administrative Assistant IV'),(23,'AA I','Administrative Aide I'),(24,'AA II','Administrative Aide II'),(25,'AA III','Administrative Aide III'),(26,'AA IV','Administrative Aide IV'),(27,'AO I','Administrative Officer I'),(28,'AO II','Administrative Officer II'),(29,'AO III','Administrative Officer III'),(30,'AO IV','Administrative Officer IV'),(31,'AO V','Administrative Officer V');

/*Table structure for table `tbl_program` */

DROP TABLE IF EXISTS `tbl_program`;

CREATE TABLE `tbl_program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `yearStarted` int(11) NOT NULL,
  `imageIcon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_program` */

insert  into `tbl_program`(`program_id`,`code`,`name`,`description`,`yearStarted`,`imageIcon`) values (1,'SETUP','Small Enterprise Technology Upgrading Program','is a nationwide strategy to encourage and assist small and medium enterprises (SMEs) to adopt technology innovations to improve their operations and expand the reach of their businesses.\r\n\r\nThe program focuses on the following six (6) priority sectors: 1. Food Processing; 2. Furniture; 3. Gifts, Decors & Handicrafts; 4. Marine and Aquatic Resources; 5. Horticulture (Cut flowers, fruits, high value crops); and 6. Metals and Engineering.',2000,'SETUP_logo.png'),(2,'DOST-GIA','Grants-In-Aid Program','The DOST-GIA Program, through the leadership of the Undersecretary for R&D, provides financial grants to S&T programs/projects to spur and attain economic growth and development by harnessing the country\'s scientific and technological capabilities',2000,'dost-gia.png'),(3,'SCHOLARSHIP','Undergraduate S&T Scholarships Program','Implemented by the Science Education Institute (DOST-SEI), the program is open yearly to talented and deserving students who wish to pursue 4- or 5- year courses in priority science and technology fields. The RA 7687 Scholarships and the Merit Scholarships both aim to produce and develop high quality human resources who will man the Science and Technology (S&T) and Research Development (R&D) efforts in the country.',1996,'s&t-scholarship.png');

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
  `division_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_request` */

insert  into `tbl_purchase_request`(`purchase_request_id`,`purchase_request_number`,`purchase_request_sai_number`,`division_id`,`section_id`,`purchase_request_date`,`purchase_request_saidate`,`purchase_request_purpose`,`purchase_request_referrence_no`,`purchase_request_project_name`,`purchase_request_location_project`,`purchase_request_requestedby_id`,`purchase_request_approvedby_id`) values (1,'41515151','515116161',1,1,'2018-03-13','2018-03-13','hshshsh','hshsshs','hshshs','hshshs',0,NULL),(2,'5252626','626262',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'151515151','424252525',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'5151515161','52525252',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'5131313131','5252626',1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'51515151','5252525',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'526262662','262622525',2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'52526625252','262626224',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'6262627272','62627272',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'27727277272','6363',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'515','6363',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'515','7373838',2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'151','6363637',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'51','36',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'51','3',2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'616','63',1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'16','6',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'1','73',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'171','63',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'226','36',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'36','63737373',1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'36','3737383',1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'36','36',1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'37','35',2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'353','535',2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'635','6363',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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
  `division_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_section` */

insert  into `tbl_section`(`section_id`,`division_id`,`code`,`name`) values (1,1,'','Office of the Regional Director'),(2,2,'','Supply Unit'),(3,2,'','Accounting Unit'),(4,2,'','Cashiering Unit'),(5,3,'','S&T Scholarships Unit'),(6,3,'','S&T Information Center'),(7,3,'','Information and Communication Technnology Unit'),(8,3,'','RSTL Office'),(9,3,'','Metrology and Calibration Laboratory'),(10,3,'','Chemical Testing Laboratory'),(11,3,'','Microbiological Testing Laboratory'),(12,4,'','Field Operations Services Office'),(13,4,'','PSTC-Zamboanga del Sur'),(14,4,'','PSTC-Zamboanga del Norte'),(15,4,'','PSTC-Zamboanga Sibugay'),(16,4,'','PSTC-Isabela Basilan'),(17,2,'','Human Resource and Development'),(18,0,'','Please select');

/*Table structure for table `tbl_type` */

DROP TABLE IF EXISTS `tbl_type`;

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_type` */

insert  into `tbl_type`(`type_id`,`name`) values (1,'Regular Fund'),(2,'Project Fund'),(3,'Trust Fund');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
