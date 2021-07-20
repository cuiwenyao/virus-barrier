SET FOREIGN_KEY_CHECKS = 0;
set charset utf8;
DROP TABLE IF EXISTS `isolation_test_check`;
CREATE TABLE `isolation_test_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dotime` datetime NOT NULL,
  `result` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `isolation_test_check_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_check_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `isolation_test_doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_cleaner`;
CREATE TABLE `isolation_test_cleaner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(11) NOT NULL,
  `homeaddress` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `joindate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_cleaning`;
CREATE TABLE `isolation_test_cleaning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dotime` datetime NOT NULL,
  `cleaner_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `cleaner_id` (`cleaner_id`),
  CONSTRAINT `isolation_test_cleaning_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `isolation_test_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_cleaning_ibfk_2` FOREIGN KEY (`cleaner_id`) REFERENCES `isolation_test_cleaner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_doctor`;
CREATE TABLE `isolation_test_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(11) NOT NULL,
  `homeaddress` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `joindate` date NOT NULL,
  `workcomment` varchar(1000) NOT NULL,
  `special` varchar(1000) NOT NULL,
  `profile` text NOT NULL,
  `position` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_family`;
CREATE TABLE `isolation_test_family` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `relation` varchar(30) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `isolation_test_family_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_group`;
CREATE TABLE `isolation_test_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `logintime` datetime NOT NULL,
  `loginip` varchar(20) NOT NULL,
  `utype` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_living`;
CREATE TABLE `isolation_test_living` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indate` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `isusing` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `nurse_id` (`nurse_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `isolation_test_living_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_living_ibfk_2` FOREIGN KEY (`nurse_id`) REFERENCES `isolation_test_nurse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_living_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `isolation_test_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_medicine`;
CREATE TABLE `isolation_test_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `price` double NOT NULL,
  `profile` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_medusing`;
CREATE TABLE `isolation_test_medusing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dotime` datetime NOT NULL,
  `count` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `medicine_id` (`medicine_id`),
  KEY `nurse_id` (`nurse_id`),
  CONSTRAINT `isolation_test_medusing_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_medusing_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `isolation_test_medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_medusing_ibfk_3` FOREIGN KEY (`nurse_id`) REFERENCES `isolation_test_nurse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_nurse`;
CREATE TABLE `isolation_test_nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(11) NOT NULL,
  `homeaddress` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `joindate` date NOT NULL,
  `workcomment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_patient`;
CREATE TABLE `isolation_test_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(11) NOT NULL,
  `homeaddress` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `definedate` date NOT NULL,
  `nowstate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_purchase`;
CREATE TABLE `isolation_test_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dodate` date NOT NULL,
  `count` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `medicine_id` (`medicine_id`),
  CONSTRAINT `isolation_test_purchase_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `isolation_test_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_purchase_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `isolation_test_medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_region`;
CREATE TABLE `isolation_test_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_room`;
CREATE TABLE `isolation_test_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `nowstate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_supplier`;
CREATE TABLE `isolation_test_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_test`;
CREATE TABLE `isolation_test_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dotime` datetime NOT NULL,
  `result` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `isolation_test_test_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_test_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `isolation_test_doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_tour`;
CREATE TABLE `isolation_test_tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dodate` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `startreg_id` int(11) NOT NULL,
  `endreg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `startreg_id` (`startreg_id`),
  KEY `endreg_id` (`endreg_id`),
  CONSTRAINT `isolation_test_tour_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `isolation_test_patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_tour_ibfk_2` FOREIGN KEY (`startreg_id`) REFERENCES `isolation_test_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `isolation_test_tour_ibfk_3` FOREIGN KEY (`endreg_id`) REFERENCES `isolation_test_region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `isolation_test_group` VALUES ('1','admin','21232f297a57a5a743894a0e4a801fc3','2020-12-17 19:45:52','127.0.0.1','100','0');
INSERT INTO `isolation_test_group` VALUES ('2','purchase','85dbdb21fe502c4d7a1e81bca0aa396d','2020-12-17 19:45:52','127.0.0.1','4','0');
INSERT INTO `isolation_test_group` VALUES ('3','reception','1da95b279fc0d21024cece2c68a4c200','2020-12-17 19:45:52','127.0.0.1','5','0');
SET FOREIGN_KEY_CHECKS = 1;
