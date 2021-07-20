<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";
function CheckUser($utype)
{
	return $utype == 100;
}


//医生
function GetDoctorNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_doctor where name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetDoctorList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,name,sex,age,phonenumber from ".SQL_TABPRE."_doctor where name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetDoctorMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_doctor where id=".$did;
	return SqlQuery($sql);
}
function AddDoctor($utype,$name,$sex,$age,$homeaddress,$phonenumber,$special,$position,$workcomment,$profile,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_doctor values(null,'".$name."','".$sex."','".$age."','".$homeaddress."','".$phonenumber."','".$photo."',now(),'".$workcomment."','".$special."','".$profile."','".$position."')";
	echo $sql;
	return SqlQuery($sql);
}
function UpdDoctor($utype,$did,$name,$sex,$age,$homeaddress,$phonenumber,$special,$position,$workcomment,$profile,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_doctor set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', photo='".$photo."', special='".$special."', workcomment = '".$workcomment."', profile = '".$profile."', position='".$position."' where id=".$did."";
	if(!$photo) $sql = "update ".SQL_TABPRE."_doctor set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', special='".$special."', workcomment = '".$workcomment."', profile = '".$profile."', position='".$position."' where id=".$did."";
	return SqlQuery($sql);
}
function DelDoctorMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_doctor where id=".$did;
	return SqlQuery($sql);
}


//护士
function GetNurseNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_nurse where name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetNurseList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,name,sex,age,phonenumber from ".SQL_TABPRE."_nurse where name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetNurseMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_nurse where id=".$did;
	return SqlQuery($sql);
}
function AddNurse($utype,$name,$sex,$age,$homeaddress,$phonenumber,$workcomment,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_nurse values(null,'".$name."','".$sex."','".$age."','".$homeaddress."','".$phonenumber."','".$photo."',now(),'".$workcomment."')";
	return SqlQuery($sql);
}
function UpdNurse($utype,$did,$name,$sex,$age,$homeaddress,$phonenumber,$workcomment,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_nurse set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', photo='".$photo."', workcomment = '".$workcomment."' where id=".$did."";
	if(!$photo) $sql = "update ".SQL_TABPRE."_nurse set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', workcomment = '".$workcomment."' where id=".$did."";
	return SqlQuery($sql);
}
function DelNurseMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_nurse where id=".$did;
	return SqlQuery($sql);
}

//清洁人员
function GetCleanerNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_cleaner where name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetCleanerList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,name,sex,age,phonenumber from ".SQL_TABPRE."_cleaner where name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetCleanerMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_cleaner where id=".$did;
	return SqlQuery($sql);
}
function AddCleaner($utype,$name,$sex,$age,$homeaddress,$phonenumber,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_cleaner values(null,'".$name."','".$sex."','".$age."','".$homeaddress."','".$phonenumber."','".$photo."',now())";
	return SqlQuery($sql);
}
function UpdCleaner($utype,$did,$name,$sex,$age,$homeaddress,$phonenumber,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_cleaner set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', photo='".$photo."' where id=".$did."";
	if(!$photo) $sql = "update ".SQL_TABPRE."_cleaner set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."' where id=".$did."";
	return SqlQuery($sql);
}
function DelCleanerMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_cleaner where id=".$did;
	return SqlQuery($sql);
}


//病房信息
function GetRoomNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_room where number like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetRoomList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,floor,number,nowstate from ".SQL_TABPRE."_room where number like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetRoomMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_room where id=".$did;
	return SqlQuery($sql);
}
function AddRoom($utype,$floor,$number,$nowstate)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_room values(null,'".$floor."','".$number."','".$nowstate."')";
	return SqlQuery($sql);
}
function UpdRoom($utype,$did,$floor,$number,$nowstate)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_room set floor= '".$floor."', number = '".$number."', nowstate = '".$nowstate."' where id=".$did."";
	return SqlQuery($sql);
}
function DelRoomMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_room where id=".$did;
	return SqlQuery($sql);
}


//药物信息
function GetMedicineNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_medicine where name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetMedicineList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,name,count,price,profile from ".SQL_TABPRE."_medicine where name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetMedicineMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_medicine where id=".$did;
	return SqlQuery($sql);
}
function AddMedicine($utype,$name,$count,$price,$profile)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_medicine values(null,'".$name."','".$count."','".$price."','".$profile."')";
	return SqlQuery($sql);
}
function UpdMedicine($utype,$did,$name,$count,$price,$profile)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_medicine set name= '".$name."', count = '".$count."', price = '".$price."' , profile = '".$profile."' where id=".$did."";
	return SqlQuery($sql);
}
function DelMedicineMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_medicine where id=".$did;
	return SqlQuery($sql);
}


//核算检测记录
function GetTestingNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_test,".SQL_TABPRE."_patient,".SQL_TABPRE."_doctor where patient_id=".SQL_TABPRE."_patient.id and doctor_id=".SQL_TABPRE."_doctor.id and  ".SQL_TABPRE."_patient.name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetTestingList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_test.id,result,dotime,".SQL_TABPRE."_patient.name,".SQL_TABPRE."_doctor.name from ".SQL_TABPRE."_test,".SQL_TABPRE."_patient,".SQL_TABPRE."_doctor where patient_id=".SQL_TABPRE."_patient.id and doctor_id=".SQL_TABPRE."_doctor.id and  ".SQL_TABPRE."_patient.name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
// function GetTestingMsg($utype,$did)
// {
// 	if(!CheckUser($utype)) return false;
// 	$sql = "select * from ".SQL_TABPRE."_testing where id=".$did;
// 	return SqlQuery($sql);
// }
// function AddTesting($utype,$name,$count,$price,$profile)
// {
// 	if(!CheckUser($utype)) return false;
// 	$sql = "insert into ".SQL_TABPRE."_testing values(null,'".$name."','".$count."','".$price."','".$profile."')";
// 	echo $sql;
// 	return SqlQuery($sql);
// }
// function UpdTesting($utype,$did,$name,$count,$price,$profile)
// {
// 	if(!CheckUser($utype)) return false;
// 	$sql = "update ".SQL_TABPRE."_testing set name= '".$name."', count = '".$count."', price = '".$price."' , profile = '".$profile."' where id=".$did."";
// 	echo $sql;
// 	return SqlQuery($sql);
// }
// function DelTestingMsg($utype,$did)
// {
// 	if(!CheckUser($utype)) return false;
// 	$sql = "delete from ".SQL_TABPRE."_testing where id=".$did;
// 	return SqlQuery($sql);
// }


//清洁消毒记录
function GetCleaningNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_cleaning,".SQL_TABPRE."_room,".SQL_TABPRE."_cleaner where cleaner_id=".SQL_TABPRE."_cleaner.id and room_id=".SQL_TABPRE."_room.id and  ".SQL_TABPRE."_room.number like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetCleaningList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_cleaner.name,".SQL_TABPRE."_room.number,dotime from ".SQL_TABPRE."_cleaning,".SQL_TABPRE."_room,".SQL_TABPRE."_cleaner where cleaner_id=".SQL_TABPRE."_cleaner.id and room_id=".SQL_TABPRE."_room.id and  ".SQL_TABPRE."_room.number like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}

//药物购买记录
function GetPurchaseNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_purchase,".SQL_TABPRE."_supplier,".SQL_TABPRE."_medicine where supplier_id=".SQL_TABPRE."_supplier.id and medicine_id=".SQL_TABPRE."_medicine.id and  ".SQL_TABPRE."_medicine.name like '".$key."'";
	return SqlQuery($sql);
}
// 查询列表 （搜索、分页）
function GetPurchaseList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_medicine.name,".SQL_TABPRE."_supplier.name,".SQL_TABPRE."_purchase.count,dodate from ".SQL_TABPRE."_purchase,".SQL_TABPRE."_supplier,".SQL_TABPRE."_medicine where supplier_id=".SQL_TABPRE."_supplier.id and medicine_id=".SQL_TABPRE."_medicine.id and  ".SQL_TABPRE."_medicine.name like '".$key."'"." limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}

//病人数量
function GetPatientNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select  count(*) from ".SQL_TABPRE."_patient where name like '".$key."'";
	return SqlQuery($sql);
}
//病人信息列表 (搜索、分页)
function GetPatientList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$sql = "select id,name,sex,age,phonenumber,nowstate from ".SQL_TABPRE."_patient where name like '".$key."'"." order by id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetPatientMsg($utype,$did)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_patient where id=".$did;
	return SqlQuery($sql);
}
function GetLiving($utype,$patient_id)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_living,".SQL_TABPRE."_room,".SQL_TABPRE."_nurse where room_id=".SQL_TABPRE."_room.id and nurse_id=".SQL_TABPRE."_nurse.id and patient_id=".$patient_id." order by ".SQL_TABPRE."_living.id";
	return SqlQuery($sql);
}
function GetFamily($utype,$patient_id)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_family where patient_id=".$patient_id;
	return SqlQuery($sql);
}
//药物使用记录
function GetMedicineUseList($utype,$pid)
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_medicine.name,".SQL_TABPRE."_medusing.count,".SQL_TABPRE."_medusing.dotime,".SQL_TABPRE."_nurse.name from ".SQL_TABPRE."_medusing,".SQL_TABPRE."_nurse,".SQL_TABPRE."_medicine where nurse_id=".SQL_TABPRE."_nurse.id and medicine_id=".SQL_TABPRE."_medicine.id and patient_id=".$pid." order by ".SQL_TABPRE."_medusing.id";
	return SqlQuery($sql);
}
//核算检测记录
function GetCheckList($utype,$pid)
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_check.result,".SQL_TABPRE."_check.dotime,".SQL_TABPRE."_doctor.name from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_check where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".$pid." order by ".SQL_TABPRE."_check.id";
	return SqlQuery($sql);
}
//核算检测记录
function GetTestList($utype,$pid)
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_test.result,".SQL_TABPRE."_test.dotime,".SQL_TABPRE."_doctor.name from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_test where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".$pid." order by ".SQL_TABPRE."_test.id";
	return SqlQuery($sql);
}

//概览信息
function NowPatient()
{
	$sql = "select count(*) from ".SQL_TABPRE."_patient where nowstate>0";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function AllPatient()
{
	$sql = "select count(*) from ".SQL_TABPRE."_patient where 1";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function AllLeave()
{
	$sql = "select count(*) from ".SQL_TABPRE."_patient where nowstate=0";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function AllDie()
{
	$sql = "select count(*) from ".SQL_TABPRE."_patient where nowstate=4";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function NowNurse()
{
	$sql = "select count(*) from ".SQL_TABPRE."_nurse where 1";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function NowDoctor()
{
	$sql = "select count(*) from ".SQL_TABPRE."_doctor where 1";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function NowCleaner()
{
	$sql = "select count(*) from ".SQL_TABPRE."_cleaner where 1";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function NowRoom()
{
	$sql = "select count(*) from ".SQL_TABPRE."_room where nowstate=0";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}
function NowMedicine()
{
	$sql = "select sum(`count`) from ".SQL_TABPRE."_medicine where 1";
	$res = SqlQuery($sql);
	if($res == false) return 0;
	$res = mysql_fetch_row($res);
	return $res[0];
}