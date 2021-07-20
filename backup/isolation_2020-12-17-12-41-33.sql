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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_medicine`;
CREATE TABLE `isolation_test_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `price` double NOT NULL,
  `profile` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `isolation_test_supplier`;
CREATE TABLE `isolation_test_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
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
INSERT INTO `isolation_test_check` VALUES ('1','2020-12-17 20:05:12','3','1','1');
INSERT INTO `isolation_test_check` VALUES ('2','2020-12-17 20:05:16','2','1','1');
INSERT INTO `isolation_test_check` VALUES ('3','2020-12-17 20:24:45','2','2','1');
INSERT INTO `isolation_test_check` VALUES ('4','2020-12-17 20:37:26','1','1','1');
INSERT INTO `isolation_test_check` VALUES ('5','2020-12-17 20:37:30','1','2','1');
INSERT INTO `isolation_test_check` VALUES ('6','2020-12-17 20:37:32','1','3','1');
INSERT INTO `isolation_test_check` VALUES ('7','2020-12-17 20:37:35','1','4','1');
INSERT INTO `isolation_test_check` VALUES ('8','2020-12-17 20:41:02','2','4','2');
INSERT INTO `isolation_test_check` VALUES ('9','2020-12-17 20:41:08','1','2','2');
INSERT INTO `isolation_test_check` VALUES ('10','2020-12-17 20:41:12','2','1','2');
INSERT INTO `isolation_test_cleaner` VALUES ('1','张三','男','20','河南省','11111122990','1608206387','2020-12-17');
INSERT INTO `isolation_test_cleaning` VALUES ('1','2020-12-17 20:18:58','1','1');
INSERT INTO `isolation_test_cleaning` VALUES ('2','2020-12-17 20:19:00','1','2');
INSERT INTO `isolation_test_cleaning` VALUES ('3','2020-12-17 20:19:03','1','3');
INSERT INTO `isolation_test_cleaning` VALUES ('4','2020-12-17 20:19:05','1','4');
INSERT INTO `isolation_test_cleaning` VALUES ('5','2020-12-17 20:19:08','1','5');
INSERT INTO `isolation_test_cleaning` VALUES ('6','2020-12-17 20:19:11','1','6');
INSERT INTO `isolation_test_cleaning` VALUES ('7','2020-12-17 20:19:16','1','7');
INSERT INTO `isolation_test_cleaning` VALUES ('8','2020-12-17 20:19:18','1','8');
INSERT INTO `isolation_test_cleaning` VALUES ('9','2020-12-17 20:19:21','1','9');
INSERT INTO `isolation_test_cleaning` VALUES ('10','2020-12-17 20:19:24','1','10');
INSERT INTO `isolation_test_cleaning` VALUES ('11','2020-12-17 20:19:26','1','11');
INSERT INTO `isolation_test_cleaning` VALUES ('12','2020-12-17 20:19:29','1','12');
INSERT INTO `isolation_test_cleaning` VALUES ('13','2020-12-17 20:19:32','1','13');
INSERT INTO `isolation_test_cleaning` VALUES ('14','2020-12-17 20:19:34','1','14');
INSERT INTO `isolation_test_cleaning` VALUES ('15','2020-12-17 20:19:37','1','15');
INSERT INTO `isolation_test_doctor` VALUES ('1','周德蔚','男','20','广西北海','17898755667','1608205912','2020-12-17','擅长女性不孕不育的治疗、妇科微外科技术和腹腔镜技术，对排卵障碍导致的不孕症，如多囊卵巢综合征、性发育不良、月经失调、闭经、子宫内膜异位症、高泌乳素血征等生殖内分泌疾病有独到的见解和治疗方法。','临床','从事妇产科临床工作32年，是浙江省“新世纪151人才工程”第二层次人才。现任APEA理事，中国性学会常务委员；华东地区腔镜学会理事；浙江省医学会妇产科分会副主任委员，浙江省妇产科医师分会副会长，浙江省计划生育/生殖医学协会委员；温州市医学会理事，温州市医学会妇产科分会主任委员、围产医学分会副主任委员，浙江省县级医学龙头学科专家指导小组成员，鹿城区干部保健委员会专家组成员；同时担任《国际妇产科学杂志》副主编、《国际计划生育－生殖医学》副主编,《生殖与避孕》编委，《温州医学院学报》常务编委；浙江省医学重点支撑学科《围产医学》学科带头人；温州医学院围产医学中心主任，温州医学院妇产科学系副主任；温州医学院附属第二医院妇产科主任、生殖医学中心主任、卫生部妇产科住院医师培训点负责人、国家药监局临床药物试验基地负责人；卫生部温州医学院妇科腔镜技术培训基地主任。1992年-1997年赴英联邦斐济群岛和美国托管之密克罗尼西亚联邦进行援助医疗活动，任职妇产科专家医师（Specialist of Obs&Gyn）；2000年赴澳大利亚昆士兰大学免疫与癌症中心进修半年；掌握本学科在国内外的发展动态，为制定创新性的学术规划奠定了扎实的基础。','主治医师');
INSERT INTO `isolation_test_doctor` VALUES ('2','张四维','男','20','河南郑州','11111122990','1608206053','2020-12-17','该同志在我院工作期间，完成了我院各项工作。期间并无任何差错医|学教育网整理。工作期间，对待病人亲切热情。对待工作态度严谨认真，能够很好的胜任日常工作。

','临床','中国杰出妇科内镜青年医师；为浙江省“151第二层次人才”；温州市优秀共产党员；瓯越名医；温州市计划生育工作先进工作者；温州医科大学教学名师；温州医科大学优秀共产党员；附属二院优秀科主任；附属二院优秀科研工作者；3次荣获附属二院优秀工作者；14次荣获温州医科大学优秀教师称号；','主治医师');
INSERT INTO `isolation_test_family` VALUES ('1','刘世纪','朋友','12345678901');
INSERT INTO `isolation_test_family` VALUES ('2','苏同','好友','12345678901');
INSERT INTO `isolation_test_group` VALUES ('1','admin','21232f297a57a5a743894a0e4a801fc3','2020-12-17 20:41:29','::1','100','0');
INSERT INTO `isolation_test_group` VALUES ('2','purchase','85dbdb21fe502c4d7a1e81bca0aa396d','2020-12-17 20:02:52','::1','4','0');
INSERT INTO `isolation_test_group` VALUES ('3','reception','1da95b279fc0d21024cece2c68a4c200','2020-12-17 20:37:44','::1','5','0');
INSERT INTO `isolation_test_group` VALUES ('4','zs','f6706d5db3ad094cfabd8fb5326f1eec','2020-12-17 20:18:54','::1','3','1');
INSERT INTO `isolation_test_group` VALUES ('5','cry','5054d049935d6f95316f68d1bef528af','2020-12-17 20:04:18','::1','2','1');
INSERT INTO `isolation_test_group` VALUES ('6','zdw','6f43f6b19cf54b5ce90c4e9b2ac42f67','2020-12-17 20:37:23','::1','1','1');
INSERT INTO `isolation_test_group` VALUES ('7','zsw','bed372cc00b0cf686847016882ca53b1','2020-12-17 20:40:57','::1','1','2');
INSERT INTO `isolation_test_living` VALUES ('1','2020-12-17','1','1','1','1');
INSERT INTO `isolation_test_living` VALUES ('2','2020-12-17','2','2','2','1');
INSERT INTO `isolation_test_living` VALUES ('3','2020-12-17','3','1','3','0');
INSERT INTO `isolation_test_medicine` VALUES ('1','α-干扰素','49','30','a干扰素是机体免疫细胞产生的一种细胞因子，是机体受到病毒感染时，免疫细胞通过抗病毒应答反应而产生的一组结构类似、功能接近的低分子糖蛋白。干扰素在机体的免疫系统中起着非常重要的作用。干扰素有很多亚型，其中最大的一类亚型是α-干扰素。');
INSERT INTO `isolation_test_medicine` VALUES ('2','洛匹那韦/利托那韦','29','50','洛匹那韦利托那韦片，本品适用于与其它抗反转录病毒药物联合用药，治疗成人和2岁以上儿童的人类免疫缺陷病毒-1(HIV-1)感染。有关洛匹那韦利托那韦的用药经验主要来自于未接受过抗反转录病毒药物治疗的患者。已接受过蛋白酶抑制剂治疗的患者数据非常有限。在洛匹那韦利托那韦治疗失败的情况下对患者进行补救治疗的数据也非常有限。已接受过蛋白酶抑制剂治疗的HIV-1感染者是否选择本品治疗主要取决于两个因素，即患者个体的病毒耐药检测结果及其治疗史。');
INSERT INTO `isolation_test_medicine` VALUES ('3','利巴韦林','20','20','利巴韦林（Ribavirin），化学名为1-β-D-呋喃核糖基-1H-1,2,4-三氮唑-3-羧酰胺，分子式为C8H12N4O，为抗非逆转录病毒药。');
INSERT INTO `isolation_test_medicine` VALUES ('4','磷酸氯喹','20','99','磷酸氯喹，又名N′，N′-二乙基-N4-(7-氯-4-喹啉基)-1，4-戊二胺二磷酸盐，用于治疗对氯喹敏感的恶性疟、间日疟等疟疾。也可用于治疗肠外阿米巴病的治疗，还有抗风湿作用等。');
INSERT INTO `isolation_test_medusing` VALUES ('1','2020-12-17 20:04:24','1','1','1','1');
INSERT INTO `isolation_test_medusing` VALUES ('2','2020-12-17 20:04:37','1','1','2','1');
INSERT INTO `isolation_test_nurse` VALUES ('1','陈锐颖','女','20','河南省','11111122990','1608205959','2020-12-17','该同志思想稳定，工作踏实肯干，专业理论扎实，技术熟练，服务态度好，受到医护患的一致好评。非凡是在代理护士长期间，能够严格要求自己，狠抓规章制度落实，严格三查七对，杜绝了医疗事故及纠纷的发生，较好的完成了护理部交给的任务。在治理工作中本着人性化的治理模式，关心、爱护、体贴每一位护理人员，做到了作风民-主，宽宏待人，提高了护理队伍的向心力、凝聚力，激发了人员的服务热情，使小作科护理工作蒸蒸日上。

');
INSERT INTO `isolation_test_nurse` VALUES ('2','王红','女','20','陕西西安','12345678901','1608205988','2020-12-17','该同志在我院工作期间能严格遵守本院各项规章制度，工作积极主动，努力好学，对病人热情，耐心，深受病人的好评，能熟练掌握本科常见疾病的治疗与护理，望以后工作中更上一层楼。

');
INSERT INTO `isolation_test_patient` VALUES ('1','黄笑凡','男','20','河南郑州','17898755667','1608206516','2020-12-17','2');
INSERT INTO `isolation_test_patient` VALUES ('2','刘世纪','男','19','河南省','17898755667','1608207677','2020-12-17','1');
INSERT INTO `isolation_test_patient` VALUES ('3','宋逸轩','女','20','河南省','17898755667','1608208509','2020-12-17','0');
INSERT INTO `isolation_test_patient` VALUES ('4','王一雯','女','20','河南省','17898755667','1608208547','2020-12-17','2');
INSERT INTO `isolation_test_purchase` VALUES ('1','2020-12-17','20','4','1');
INSERT INTO `isolation_test_purchase` VALUES ('2','2020-12-17','20','3','2');
INSERT INTO `isolation_test_purchase` VALUES ('3','2020-12-17','30','2','1');
INSERT INTO `isolation_test_purchase` VALUES ('4','2020-12-17','50','1','1');
INSERT INTO `isolation_test_room` VALUES ('1','1','101','2');
INSERT INTO `isolation_test_room` VALUES ('2','1','102','2');
INSERT INTO `isolation_test_room` VALUES ('3','1','103','0');
INSERT INTO `isolation_test_room` VALUES ('4','1','104','0');
INSERT INTO `isolation_test_room` VALUES ('5','1','105','0');
INSERT INTO `isolation_test_room` VALUES ('6','2','201','0');
INSERT INTO `isolation_test_room` VALUES ('7','2','202','1');
INSERT INTO `isolation_test_room` VALUES ('8','2','203','0');
INSERT INTO `isolation_test_room` VALUES ('9','2','204','0');
INSERT INTO `isolation_test_room` VALUES ('10','2','205','0');
INSERT INTO `isolation_test_room` VALUES ('11','3','301','0');
INSERT INTO `isolation_test_room` VALUES ('12','3','302','0');
INSERT INTO `isolation_test_room` VALUES ('13','3','303','0');
INSERT INTO `isolation_test_room` VALUES ('14','3','304','0');
INSERT INTO `isolation_test_room` VALUES ('15','3','305','0');
INSERT INTO `isolation_test_supplier` VALUES ('1','中原大药房','河南郑州高新区','17489609879');
INSERT INTO `isolation_test_supplier` VALUES ('2','益康制药有限公司','北京中关村','17898755667');
INSERT INTO `isolation_test_test` VALUES ('1','2020-12-17 20:05:18','1','1','1');
INSERT INTO `isolation_test_test` VALUES ('2','2020-12-17 20:05:22','0','1','1');
INSERT INTO `isolation_test_test` VALUES ('3','2020-12-17 20:24:50','1','1','1');
INSERT INTO `isolation_test_test` VALUES ('4','2020-12-17 20:24:54','1','2','1');
INSERT INTO `isolation_test_test` VALUES ('5','2020-12-17 20:37:39','0','3','1');
INSERT INTO `isolation_test_test` VALUES ('6','2020-12-17 20:41:17','1','4','2');
INSERT INTO `isolation_test_test` VALUES ('7','2020-12-17 20:41:21','1','2','2');
INSERT INTO `isolation_test_test` VALUES ('8','2020-12-17 20:41:25','1','1','2');
SET FOREIGN_KEY_CHECKS = 1;
