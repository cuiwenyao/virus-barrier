<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";
require_once __DIR__."/user.func.php";
function CheckUser($utype)
{
	return $utype == 2;
}


function GetMedicine($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_medicine where count>0";
	return SqlQuery($sql);
}
function GetPatientList($utype)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_patient.name,".SQL_TABPRE."_patient.id from ".SQL_TABPRE."_room,".SQL_TABPRE."_living,".SQL_TABPRE."_patient where room_id=".SQL_TABPRE."_room.id and patient_id=".SQL_TABPRE."_patient.id and nurse_id=".$tid." and ".SQL_TABPRE."_living.isusing=1 order by ".SQL_TABPRE."_living.id desc";
	echo $sql;
	return SqlQuery($sql);
}

//房间列表
function GetRoomList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_room.floor,".SQL_TABPRE."_room.number,".SQL_TABPRE."_patient.name,".SQL_TABPRE."_patient.nowstate,".SQL_TABPRE."_patient.id from ".SQL_TABPRE."_room,".SQL_TABPRE."_living,".SQL_TABPRE."_patient where room_id=".SQL_TABPRE."_room.id and patient_id=".SQL_TABPRE."_patient.id and nurse_id=".$tid." and ".SQL_TABPRE."_living.isusing=1 and ".SQL_TABPRE."_patient.name like '".$key."' order by ".SQL_TABPRE."_living.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetRoomNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select count(*) from ".SQL_TABPRE."_room,".SQL_TABPRE."_living,".SQL_TABPRE."_patient where room_id=".SQL_TABPRE."_room.id and patient_id=".SQL_TABPRE."_patient.id and nurse_id=".$tid." and ".SQL_TABPRE."_living.isusing=1 and ".SQL_TABPRE."_patient.name like '".$key."'";
	return SqlQuery($sql);
}

//药物使用
function UseMedicine($utype,$pid,$mid,$count)

{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "update ".SQL_TABPRE."_medicine set count = count - ".$count." where id=".$mid;
	$res = SqlQuery($sql);
	if($res == false) return false;
	$sql = "insert into ".SQL_TABPRE."_medusing values(null,now(),".$count.",".$pid.",".$mid.",".$tid.")";
	return SqlQuery($sql);
}
//获取药物使用记录
function GetMedicineUseList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_patient.name,".SQL_TABPRE."_medicine.name,".SQL_TABPRE."_medusing.count,".SQL_TABPRE."_medusing.dotime from ".SQL_TABPRE."_medusing,".SQL_TABPRE."_patient,".SQL_TABPRE."_medicine where patient_id=".SQL_TABPRE."_patient.id and medicine_id=".SQL_TABPRE."_medicine.id and nurse_id=".$tid." and ".SQL_TABPRE."_patient.name like '".$key."' order by ".SQL_TABPRE."_medusing.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetMedicineUseListNum($utype,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select count(*) from ".SQL_TABPRE."_medusing,".SQL_TABPRE."_patient,".SQL_TABPRE."_medicine where patient_id=".SQL_TABPRE."_patient.id and medicine_id=".SQL_TABPRE."_medicine.id and nurse_id=".$tid." and ".SQL_TABPRE."_patient.name like '".$key."'";
	return SqlQuery($sql);
}