<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";

//用户验证
function CheckUser($utype)
{
	return $utype == 5;
}
//添加病人
function AddPatient($utype,$name,$sex,$age,$homeaddress,$phonenumber,$nowstate,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = " insert into ".SQL_TABPRE."_patient values ( null , '".$name."' , '".$sex."' , '".$age."' , '".$homeaddress."' , '".$phonenumber."' , '".$photo."' , now() , '".$nowstate."' ); ";
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
//释放房间
function CancleLiving($utype,$patient_id)
{
	if(!CheckUser($utype)) return false;
	$sql1 = "update ".SQL_TABPRE."_room set nowstate=0 where id in ( select room_id from ".SQL_TABPRE."_living where patient_id = ".$patient_id." and isusing = 1  )";
	$sql2 = "update ".SQL_TABPRE."_living set isusing = 0 where patient_id = ".$patient_id;
	return SqlQuery($sql1) && SqlQuery($sql2);
}
//办理出院
function SetPatientLeave($utype,$pid)
{
	if(!CheckUser($utype)) return false;
	CancleLiving($utype,$pid);
	$sql = "update ".SQL_TABPRE."_patient set nowstate='0' where id=".$pid;
	return SqlQuery($sql);
}
//删除病人
function DelPatient($utype,$pid)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_patient where id=".$pid;
	return SqlQuery($sql);
}
//修改病人信息
function UpdPatient($utype,$did,$name,$sex,$age,$homeaddress,$phonenumber,$nowstate,$photo)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_patient set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', photo='".$photo."', nowstate='".$nowstate."' where id=".$did."";
	if(!$photo) $sql = "update ".SQL_TABPRE."_patient set name= '".$name."', sex = '".$sex."', age = '".$age."', homeaddress = '".$homeaddress."', phonenumber = '".$phonenumber."', nowstate='".$nowstate."' where id=".$did."";
	return SqlQuery($sql);
}
//获取可用房间
function GetAvailableRoom($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_room where nowstate=0";
	return SqlQuery($sql);
}
//获取可用护士
function GetAvailableNurse($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_nurse where 1";
	return SqlQuery($sql);
}
//获取住宿信息
function GetLiving($utype,$patient_id)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_living,".SQL_TABPRE."_room,".SQL_TABPRE."_nurse where room_id=".SQL_TABPRE."_room.id and nurse_id=".SQL_TABPRE."_nurse.id and patient_id=".$patient_id." order by ".SQL_TABPRE."_living.id";
	return SqlQuery($sql);
}
//办理住宿
function AddLiving($utype,$patient_id,$room_id,$nurse_id)
{
	if(!CheckUser($utype)) return false;
	$sql = "call addliving('".$room_id."','".$nurse_id."','".$patient_id."')";
	return SqlQuery($sql) ;
}
//家属信息
function GetFamily($utype,$patient_id)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_family where patient_id=".$patient_id;
	return SqlQuery($sql);
}
//添加家属信息
function AddFamily($utype,$patient_id,$name,$relation,$phonenumber)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_family values('".$patient_id."','".$name."','".$relation."','".$phonenumber."')";
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