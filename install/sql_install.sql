#table:用户组
create table isolation_duang_group
(
 `id` int primary key auto_increment,
 uname varchar(20) not null,
 pword varchar(50) not null,
 logintime datetime not null,
 loginip varchar(20) not null,
 utype int not null,
 tid int not null 
) engine=InnoDB charset=utf8;

#table:病患列表
create table isolation_duang_patient
(
 `id` int primary key auto_increment,
 `name` varchar(30) not null,
 sex varchar(5) not null,
 age int not null,
 homeaddress varchar(200) not null,
 phonenumber varchar(30) not null,
 photo varchar(200) not null,
 definedate date not null,
 nowstate int not null    # 0:出院 1:身体正常 2:身体虚弱 3:情况严重 4:已死亡
) engine=InnoDB charset=utf8; 
create index patient_index on isolation_duang_patient (`id`);

#table:医生列表
create table isolation_duang_doctor
(
 `id` int primary key auto_increment,
 `name` varchar(30) not null,
 sex varchar(5) not null,
 age int not null,
 homeaddress varchar(200) not null,
 phonenumber varchar(30) not null,
 photo varchar(200) not null,
 joindate date not null,
 workcomment varchar(1000) not null,
 special varchar(1000) not null,
 `profile` text not null,
 `position` varchar(100) not null # 职位
) engine=InnoDB charset=utf8; 

#table:护士列表
create table isolation_duang_nurse
(
 `id` int primary key auto_increment,
 `name` varchar(30) not null,
 sex varchar(5) not null,
 age int not null,
 homeaddress varchar(200) not null,
 phonenumber varchar(30) not null,
 photo varchar(200) not null,
 joindate date not null,
 workcomment varchar(1000) not null
) engine=InnoDB charset=utf8; 


#table:清洁人员列表
create table isolation_duang_cleaner
(
 `id` int primary key auto_increment,
 `name` varchar(30) not null,
 sex varchar(5) not null,
 age int not null,
 homeaddress varchar(200) not null,
 phonenumber varchar(30) not null,
 photo varchar(200) not null,
 joindate date not null
) engine=InnoDB charset=utf8; 

#table:家属列表
create table isolation_duang_family
(
 patient_id int not null,
 `name` varchar(30) not null,
 relation varchar(30) not null,
 phonenumber varchar(30) not null,
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;

#table:药物列表
create table isolation_duang_medicine
(
 `id` int primary key auto_increment,
 `name` varchar(100) not null,
 `count` int not null,
 price double not null,
 `profile` text not null
) engine=InnoDB charset=utf8;

#table:房间列表
create table isolation_duang_room
(
 `id` int primary key auto_increment,
 `floor` int not null,
 `number` int not null,
 nowstate int not null # 0:正常 1:损坏不可用 2:已入住
) engine=InnoDB charset=utf8;


#table:药物供货商列表
create table isolation_duang_supplier
(
 `id` int primary key auto_increment,
 `name` varchar(100) not null,
 address varchar(200) not null,
 phonenumber varchar(30) not null
) engine=InnoDB charset=utf8;
 
#table:清洁消毒列表
create table isolation_duang_cleaning
(
 `id` int primary key auto_increment,
 dotime datetime not null,
 cleaner_id int not null,
 room_id int not null,
 foreign key (room_id) references isolation_duang_room(id) on delete cascade on update cascade,
 foreign key (cleaner_id) references isolation_duang_cleaner(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;


#table:入住记录列表
create table isolation_duang_living
(
 `id` int primary key auto_increment,
 indate date not null,
 patient_id int not null,
 nurse_id int not null,
 room_id int not null,
 isusing int not null, #当前记录效果 0:无效 1:有效
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade,
 foreign key (nurse_id) references isolation_duang_nurse(id) on delete cascade on update cascade,
 foreign key (room_id) references isolation_duang_room(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;

#table:核酸检测列表
create table isolation_duang_test
(
 `id` int primary key auto_increment,
 dotime datetime not null,
 result int not null, # 0:阴性 1:阳性
 patient_id int not null,
 doctor_id int not null,
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade,
 foreign key (doctor_id) references isolation_duang_doctor(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;

#table:地区
create table isolation_duang_region
(
 `id` int primary key auto_increment,
 `name` varchar(50) not null
) engine=InnoDB charset=utf8;

#table:行程记录列表
create table isolation_duang_tour
(
 `id` int primary key auto_increment,
 dodate date not null,
 patient_id int not null,
 startreg_id int not null,
 endreg_id int not null,
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade,
 foreign key (startreg_id) references isolation_duang_region(id) on delete cascade on update cascade,
 foreign key (endreg_id) references isolation_duang_region(id) on delete cascade on update cascade
 
) engine=InnoDB charset=utf8;

#table:药物使用记录列表
create table isolation_duang_medusing
(
 `id` int primary key auto_increment,
 dotime datetime not null,
 `count` int not null,
 patient_id int not null,
 medicine_id int not null,
 nurse_id int not null,
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade,
 foreign key (medicine_id) references isolation_duang_medicine(id) on delete cascade on update cascade,
 foreign key (nurse_id) references isolation_duang_nurse(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;

#table:药物购买记录列表
create table isolation_duang_purchase
(
 `id` int primary key auto_increment,
 dodate date not null,
 `count` int not null,
 medicine_id int not null,
 supplier_id int not null,
 foreign key (supplier_id) references isolation_duang_supplier(id) on delete cascade on update cascade,
 foreign key (medicine_id) references isolation_duang_medicine(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;


#table:身体状态检查列表  
create table isolation_duang_check
(
 `id` int primary key auto_increment,
 dotime datetime not null,
 result int not null, # 0:出院 1:身体正常 2:身体虚弱 3:情况严重 4:已死亡
 patient_id int not null,
 doctor_id int not null,
 foreign key (patient_id) references isolation_duang_patient(id) on delete cascade on update cascade,
 foreign key (doctor_id) references isolation_duang_doctor(id) on delete cascade on update cascade
) engine=InnoDB charset=utf8;


#基本用户组数据
insert into isolation_duang_group values ( null , 'admin' , md5('admin') , now() , '127.0.0.1' , 100 , 0 );
insert into isolation_duang_group values ( null , 'purchase' , md5('purchase') , now() , '127.0.0.1' , 4 , 0 );
insert into isolation_duang_group values ( null , 'reception' , md5('reception') , now() , '127.0.0.1' , 5 , 0 );





#触发器：药物数量修改前后应该大于等于0
create trigger upd_medicine before update on isolation_duang_medicine for each row
begin
	if ( new.count < 0 )  then
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error;
	end if; 
end ;


#触发器：若living中存在房间的isusing=1，则isolation_duang不可删除、不可修改nowstate
create trigger del_room before delete on isolation_duang_room for each row
begin
	if ( select isolation_duang_living.id from isolation_duang_living where isolation_duang_living.isusing = 1 and isolation_duang_living.room_id = old.id  ) then
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error;
	end if;
end ;


#存储过程：addliving
create procedure addliving(in rid int,in nid int,in pid int) 
begin
	update isolation_duang_room set nowstate=0 where `id` in ( select room_id from isolation_duang_living where patient_id = pid and isusing = 1 ) ;
	update isolation_duang_living set isolation_duang_living.isusing = 0 where isolation_duang_living.patient_id = pid;
	update isolation_duang_room set nowstate=2 where id=rid;
	insert into isolation_duang_living values(null,now(),pid,nid,rid,1);
end ;

#创建索引
create index patient_index on isolation_duang_patient (`id`);
create index doctor_index on isolation_duang_doctor (`id`);
create index nurse_index on isolation_duang_nurse (`id`);
create index cleaner_index on isolation_duang_cleaner (`id`);

