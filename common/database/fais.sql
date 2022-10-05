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

/*Table structure for table `tbl_bids` */

DROP TABLE IF EXISTS `tbl_bids`;

CREATE TABLE `tbl_bids` (
  `bids_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `purchase_request_id` int(11) DEFAULT NULL,
  `bids_status` tinyint(11) DEFAULT '0',
  PRIMARY KEY (`bids_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bids` */

insert  into `tbl_bids`(`bids_id`,`supplier_id`,`purchase_request_id`,`bids_status`) values (39,6,28,0),(40,NULL,28,0),(41,5,28,0),(42,7,28,0);

/*Table structure for table `tbl_bids_details` */

DROP TABLE IF EXISTS `tbl_bids_details`;

CREATE TABLE `tbl_bids_details` (
  `bids_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `bids_id` int(11) DEFAULT NULL,
  `bids_unit` varchar(100) DEFAULT NULL,
  `bids_item_description` varchar(255) DEFAULT NULL,
  `bids_quantity` int(11) DEFAULT NULL,
  `bids_price` decimal(10,2) DEFAULT NULL,
  `bids_details_status` tinyint(11) DEFAULT '0',
  PRIMARY KEY (`bids_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bids_details` */

insert  into `tbl_bids_details`(`bids_details_id`,`bids_id`,`bids_unit`,`bids_item_description`,`bids_quantity`,`bids_price`,`bids_details_status`) values (48,39,'Units','Item description',5,125.00,0),(49,39,'Units','Item description',5,165.00,0),(50,40,'Units','Item description',5,600.00,0),(51,40,'Units','Item description',5,500.00,0),(52,41,'Units','Item description',5,1520.00,0),(53,41,'Units','Item description',5,2800.00,0),(54,41,'Units','Item description',5,4500.00,0),(55,42,'Units','Item description',5,325.00,0),(56,42,'Units','Item description',5,450.00,0),(57,42,'Units','Item description',5,225.00,0),(58,42,'Units','Item description',5,160.00,0),(59,42,'Units','Item description',5,750.00,0);

/*Table structure for table `tbl_book` */

DROP TABLE IF EXISTS `tbl_book`;

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `buy_amount` float(11,2) NOT NULL,
  `publish_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_book` */

insert  into `tbl_book`(`id`,`name`,`buy_amount`,`publish_date`) values (1,'The Great Larry',209.00,'2018-05-08'),(2,'The Larry Merchant',1995.00,'2018-05-15');

/*Table structure for table `tbl_department` */

DROP TABLE IF EXISTS `tbl_department`;

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) DEFAULT NULL,
  `department_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_department` */

insert  into `tbl_department`(`department_id`,`department_name`,`department_desc`) values (1,'asdad','asdasd'),(2,'aaaa','aaaaa'),(3,'Test Departments','Test Departments'),(4,'hhh','ff'),(5,'hbhbhrcctc','ybbb'),(6,'hhh','rr'),(7,'jjj','eee'),(8,'gggdddw','xcvcxv'),(9,'TEst','test'),(10,'zzzz','zzzz');

/*Table structure for table `tbl_division` */

DROP TABLE IF EXISTS `tbl_division`;

CREATE TABLE `tbl_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_division` */

insert  into `tbl_division`(`division_id`,`code`,`name`) values (1,'ORD','Office of the Regional Director'),(2,'FASS','Finance and Administrative Support Services'),(4,'FOS','Field Operations Services'),(11,'TS','Technical Services');

/*Table structure for table `tbl_employee` */

DROP TABLE IF EXISTS `tbl_employee`;

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee` */

insert  into `tbl_employee`(`employee_id`,`employee_code`,`lastname`,`firstname`,`middlename`,`address`,`dob`) values (1,'00336','Somocor','Larry Mark','Barcelona','Divisoria','2018-04-30'),(2,'00337','Sunico','Nolan','Francisco',NULL,'2018-04-30');

/*Table structure for table `tbl_expenditure_class` */

DROP TABLE IF EXISTS `tbl_expenditure_class`;

CREATE TABLE `tbl_expenditure_class` (
  `expenditure_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`expenditure_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expenditure_class` */

insert  into `tbl_expenditure_class`(`expenditure_class_id`,`name`,`code`) values (1,'Personal Services','PS'),(2,'Maintenance and Other Operating Expenses','MOOE'),(3,'Capital Outlay','CO'),(4,'Special Purposes','SP');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expenditure_object` */

insert  into `tbl_expenditure_object`(`expenditure_object_id`,`expenditure_sub_class_id`,`name`,`object_code`) values (1,1,'Salaries and Wages - Regular Pay',2147483647),(2,2,'Personal Eco. Relief Allow. (PERA)',2147483647),(3,2,'Representation Allowance (RA)',2147483647),(4,2,'Transporation Allowance (TA)',2147483647),(5,2,'Clothing Allowance',2147483647),(6,2,'Year-End Bonus',2147483647),(7,2,'Cash Gift',2147483647),(8,2,'Mid-Year Bonus',2147483647),(9,2,'Productivity Enhancement Incentive ',2147483647),(10,2,'Pag-ibig Contributions',2147483647),(11,2,'Philhealth Contributions',2147483647),(12,2,'Employees Comp. Ins. Premiums',2147483647),(13,3,'Subsistence Allowance',2147483647),(14,3,'Laundry Allowance',2147483647),(15,3,'Hazard Pay',2147483647),(16,3,'Longevity Pay',2147483647),(17,4,'Fixed Expenditure (RLIP)',2147483647),(18,5,'Local Travel',2147483647),(19,5,'Foreign Travel',2147483647),(20,6,'Training Expenses ',2147483647),(21,7,'Scholarship Expenses ',2147483647),(22,8,'Office Supplies Expenses',2147483647),(23,8,'Accountable Forms Expenses',2147483647),(24,8,'Medical, Dental & Laboratory ',2147483647),(25,8,'Gasoline, Oil and Lubricants Exp.',2147483647),(26,8,'Textbooks & Instructional Materials',2147483647),(27,8,'Other Supplies & Matls. Expenses',2147483647),(28,9,'Water Expenses',2147483647),(29,9,'Electricity Expenses',2147483647),(30,10,'Postage & Courier Services',2147483647),(31,10,'Telephone - Landline',2147483647),(32,10,'Telephone - Mobile',2147483647),(33,10,'Internet Subscription Expenses ',2147483647),(34,11,'Extraordinary  & Misc.Expenses',2147483647),(35,11,'Legal Services',2147483647),(36,11,'Auditing Services',2147483647),(37,11,'Consultancy Services',2147483647),(38,12,'Janitorial Services',2147483647),(39,12,'Security Services',2147483647),(40,12,'Other  General Services',2147483647),(41,13,'Land & Land Improvements',2147483647),(42,13,'Building & Other Structures',2147483647),(43,13,'Furniture & Fixtures',2147483647),(44,13,'Machineries & Equipment',2147483647),(45,13,'Transportation Equipment',2147483647),(46,14,'Subsidy - Others',0),(47,14,'Local GIA',2147483647),(48,14,'SET UP',2147483647),(49,15,'Taxes, Duties & Fees',2147483647),(50,15,'Fidelity Bond Premiums',2147483647),(51,15,'Insurance Expenses',2147483647),(52,16,'Advertising Expenses',2147483647),(53,16,'Printing and  Publication Expenses',2147483647),(54,16,'Representation Expenses',2147483647),(55,16,'Rent - Building and Structures',2147483647),(56,16,'Rent - Motor Vehicles',2147483647),(57,16,'Rent - Equipment',2147483647),(58,16,'Membership, Dues & Contribution to Org.',2147483647),(59,16,'Subscription Expenses',2147483647),(60,16,'Other MOOE',2147483647),(61,17,'ICT Equipment',0),(62,17,'Printing Equipment',0),(63,17,'ICT Software',0);

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

insert  into `tbl_expenditure_sub_class`(`expenditure_sub_class_id`,`expenditure_class_id`,`name`,`class_code`) values (1,1,'Salaries','501'),(2,1,'Other Compensation','501'),(3,1,'Magna Carta Benefits (RA 8439)','501'),(4,1,'Fixed Expenditure (RLIP)','501'),(5,2,'Traveling Expenses','502'),(6,2,'Training & Scholarship Expenses','502'),(7,2,'Supplies & Material Expenses','502'),(8,2,'Utility Expenses','502'),(9,2,'Communication Expenses','502'),(10,2,'Extraordinary & Misc Expenses','502'),(11,2,'Professional Services','502'),(12,2,'General Services','502'),(13,2,'Repair & Maintenance','502'),(14,2,'Financial Assistance / Subsidy','502'),(15,2,'Taxes, Insurance Premium & Other Fees','502'),(16,2,'Membership, Dues & Contribution to Organization','502'),(17,2,'Subscription Expenses','502'),(18,2,'Other MOOE','502'),(19,3,'Machinery & Equipment','');

/*Table structure for table `tbl_line_item_budget` */

DROP TABLE IF EXISTS `tbl_line_item_budget`;

CREATE TABLE `tbl_line_item_budget` (
  `line_item_budget_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `period` varchar(100) NOT NULL,
  `duration_start` date NOT NULL,
  `duration_end` date NOT NULL,
  `division_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`line_item_budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_line_item_budget` */

insert  into `tbl_line_item_budget`(`line_item_budget_id`,`type`,`title`,`period`,`duration_start`,`duration_end`,`division_id`,`section_id`,`project_id`,`program_id`) values (1,123,'Testing','afafaggaga','2018-04-04','2018-04-11',1,2,1,2),(2,2,'sasdasdasdadsasd','asdasdasdasdasd','0000-00-00','0000-00-00',2,3,0,0),(3,2,'GIA','2018','0000-00-00','0000-00-00',2,2,0,0),(4,3,'zzzzzzzzzzzzzzzzzz','zzzzzzzzzzzzzz','0000-00-00','0000-00-00',4,3,0,0),(5,3,'aaaaaaaaaaaaaaaaaaaaaa','aaaaaaaaaaaaaaaaaa','0000-00-00','0000-00-00',2,4,0,0),(6,3,'tttttttttttttttt','tttttttttttttttttttt','0000-00-00','0000-00-00',2,2,0,0),(7,2,'asd','asd','0000-00-00','0000-00-00',2,3,0,0),(8,2,'ooooooooooooooo','ooooo','0000-00-00','0000-00-00',2,2,0,0),(9,2,'SETUP','1','0000-00-00','0000-00-00',4,2,0,0);

/*Table structure for table `tbl_line_item_budget_object` */

DROP TABLE IF EXISTS `tbl_line_item_budget_object`;

CREATE TABLE `tbl_line_item_budget_object` (
  `line_item_budget_object_id` int(11) NOT NULL AUTO_INCREMENT,
  `line_item_budget_id` int(11) NOT NULL,
  `expenditure_object_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`line_item_budget_object_id`),
  KEY `line_item_budget_id` (`line_item_budget_id`),
  KEY `expenditure_object_id` (`expenditure_object_id`),
  CONSTRAINT `tbl_line_item_budget_object_ibfk_1` FOREIGN KEY (`line_item_budget_id`) REFERENCES `tbl_line_item_budget` (`line_item_budget_id`),
  CONSTRAINT `tbl_line_item_budget_object_ibfk_2` FOREIGN KEY (`expenditure_object_id`) REFERENCES `tbl_expenditure_object` (`expenditure_object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_line_item_budget_object` */

insert  into `tbl_line_item_budget_object`(`line_item_budget_object_id`,`line_item_budget_id`,`expenditure_object_id`,`amount`) values (1,9,3,200000),(2,9,1,100);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

insert  into `tbl_project`(`id`,`code`,`name`,`description`) values (1,'Project 1','Project 1','Project 1');

/*Table structure for table `tbl_purchase_order` */

DROP TABLE IF EXISTS `tbl_purchase_order`;

CREATE TABLE `tbl_purchase_order` (
  `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_number` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `purchase_order_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order` */

/*Table structure for table `tbl_purchase_order_details` */

DROP TABLE IF EXISTS `tbl_purchase_order_details`;

CREATE TABLE `tbl_purchase_order_details` (
  `purchase_order_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) DEFAULT NULL,
  `purchase_request_details_id` int(11) DEFAULT NULL,
  `purchase_request_details_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`purchase_order_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order_details` */

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_request` */

insert  into `tbl_purchase_request`(`purchase_request_id`,`purchase_request_number`,`purchase_request_sai_number`,`division_id`,`section_id`,`purchase_request_date`,`purchase_request_saidate`,`purchase_request_purpose`,`purchase_request_referrence_no`,`purchase_request_project_name`,`purchase_request_location_project`,`purchase_request_requestedby_id`,`purchase_request_approvedby_id`) values (28,'PR-18-05-0001','',1,2,'2018-05-10',NULL,'dsgsdgsgs','5255242','twtwwrwf','twtwrwtqtqt',1,2),(29,'PR-18-05-0002','',1,2,'2018-05-10',NULL,'fsfsg','515151','wdgwttw','twtetwrw',1,2);

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
  `purchase_request_details_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`purchase_request_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_request_details` */

insert  into `tbl_purchase_request_details`(`purchase_request_details_id`,`purchase_request_id`,`purchase_request_details_unit`,`unit_id`,`purchase_request_details_item_description`,`item_description`,`purchase_request_details_quantity`,`purchase_request_details_price`,`purchase_request_details_status`) values (34,28,NULL,NULL,'Item description',NULL,5,0.00,0),(35,28,NULL,NULL,'Item description',NULL,5,0.00,0),(36,28,NULL,NULL,'Item description',NULL,5,0.00,0),(37,28,NULL,NULL,'Item description',NULL,5,0.00,0),(38,28,NULL,NULL,'Item description',NULL,5,0.00,0),(39,28,NULL,NULL,'Item description',NULL,5,0.00,0),(40,29,NULL,NULL,'Item description',NULL,5,0.00,0),(41,29,NULL,NULL,'Item description',NULL,5,0.00,0),(42,29,NULL,NULL,'Item description',NULL,5,0.00,0);

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

/*Table structure for table `tbl_supplier` */

DROP TABLE IF EXISTS `tbl_supplier`;

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) DEFAULT NULL,
  `supplier_address` varchar(255) DEFAULT NULL,
  `supplier_contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_supplier` */

insert  into `tbl_supplier`(`supplier_id`,`supplier_name`,`supplier_address`,`supplier_contact`) values (5,'Supplier 1',NULL,NULL),(6,'Supplier 2',NULL,NULL),(7,'Supplier 3',NULL,NULL),(8,'Supplier 4',NULL,NULL),(9,'Supplier 5',NULL,NULL);

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
