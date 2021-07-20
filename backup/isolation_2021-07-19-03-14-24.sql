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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_medicine`;
CREATE TABLE `isolation_test_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `price` double NOT NULL,
  `profile` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_supplier`;
CREATE TABLE `isolation_test_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
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
INSERT INTO `isolation_test_check` VALUES ('1','2021-07-19 11:07:55','2','1','2');
INSERT INTO `isolation_test_check` VALUES ('2','2021-07-19 11:08:00','1','1','2');
INSERT INTO `isolation_test_check` VALUES ('3','2021-07-19 11:08:08','4','1','2');
INSERT INTO `isolation_test_check` VALUES ('4','2021-07-19 11:13:21','3','1','2');
INSERT INTO `isolation_test_cleaner` VALUES ('1','李敏','女','20','河南省','67359867598','1626662084','2021-07-19');
INSERT INTO `isolation_test_doctor` VALUES ('2','岳希航','男','20','辽宁省','67359867598','1626663889','2021-07-19','很不错！','计算机科学与技术','郑州大学医学院毕业。','主治医生');
INSERT INTO `isolation_test_family` VALUES ('1','李敏妈','母亲','67359867598');
INSERT INTO `isolation_test_group` VALUES ('1','admin','21232f297a57a5a743894a0e4a801fc3','2021-07-19 11:13:43','::1','100','0');
INSERT INTO `isolation_test_group` VALUES ('2','purchase','85dbdb21fe502c4d7a1e81bca0aa396d','2021-07-19 11:11:20','::1','4','0');
INSERT INTO `isolation_test_group` VALUES ('3','reception','1da95b279fc0d21024cece2c68a4c200','2021-07-19 11:05:25','::1','5','0');
INSERT INTO `isolation_test_group` VALUES ('4','ljx','f0b5acd24bf41fe5d0ce9ff222ccbb53','2021-07-19 01:22:28','::1','1','1');
INSERT INTO `isolation_test_group` VALUES ('5','yxh','8afbb09011235c09106e7cbce920072e','2021-07-19 11:13:14','::1','1','2');
INSERT INTO `isolation_test_group` VALUES ('6','yuexihang','584d0df97c2398c4c1c1ba43324bcaad','2021-07-19 11:12:16','::1','2','1');
INSERT INTO `isolation_test_living` VALUES ('1','2021-07-19','1','1','1','1');
INSERT INTO `isolation_test_medicine` VALUES ('1','感冒灵颗粒','1','99','很好呢！');
INSERT INTO `isolation_test_medusing` VALUES ('1','2021-07-19 11:12:30','99','1','1','1');
INSERT INTO `isolation_test_nurse` VALUES ('1','岳希航','男','20','辽宁省','67359867598','1626662051','2021-07-19','eeee');
INSERT INTO `isolation_test_patient` VALUES ('1','李敏','女','20','河南省','67359867598','1626663945','2021-07-19','3');
INSERT INTO `isolation_test_purchase` VALUES ('1','2021-07-19','100','1','1');
INSERT INTO `isolation_test_room` VALUES ('1','1','101','2');
INSERT INTO `isolation_test_room` VALUES ('2','1','102','0');
INSERT INTO `isolation_test_supplier` VALUES ('1','中原大药房','河南省郑州市','67359867598');
INSERT INTO `isolation_test_test` VALUES ('1','2021-07-19 11:13:28','1','1','2');
INSERT INTO `isolation_test_test` VALUES ('2','2021-07-19 11:13:35','1','1','2');
INSERT INTO `isolation_test_test` VALUES ('3','2021-07-19 11:13:39','0','1','2');
SET FOREIGN_KEY_CHECKS = 1;
