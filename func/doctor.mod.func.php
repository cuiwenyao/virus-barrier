<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";
require_once __DIR__."/user.func.php";
function CheckUser($utype)
{
	return $utype == 1;
}


function GetPatient($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_patient where nowstate>0";
	return SqlQuery($sql);
}

//身体检查
function GetCheckList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_patient.name,".SQL_TABPRE."_check.result,".SQL_TABPRE."_check.dotime from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_patient,".SQL_TABPRE."_check where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".SQL_TABPRE."_patient.id and doctor_id = ".$tid." and ".SQL_TABPRE."_patient.name like '".$key."' order by ".SQL_TABPRE."_check.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetCheckNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select count(*) from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_patient,".SQL_TABPRE."_check where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".SQL_TABPRE."_patient.id and doctor_id = ".$tid." and ".SQL_TABPRE."_patient.name like '".$key."'";
	return SqlQuery($sql);
}
function AddCheck($utype,$patient_id,$result)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "insert into ".SQL_TABPRE."_check values(null,now(),'".$result."','".$patient_id."','".$tid."')";
	$res = SqlQuery($sql);
	if($res == false) return false;
	//更新病人身体状态
	$updsql = "update ".SQL_TABPRE."_patient set nowstate='".$result."' where id=".$patient_id;
	return SqlQuery($updsql);
}



//核酸检测
function GetTestList($utype,$page = 1,$psize = 20,$key ="%")
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_patient.name,".SQL_TABPRE."_test.result,".SQL_TABPRE."_test.dotime from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_patient,".SQL_TABPRE."_test where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".SQL_TABPRE."_patient.id and doctor_id = ".$tid." and ".SQL_TABPRE."_patient.name like '".$key."' order by ".SQL_TABPRE."_test.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetTestNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select count(*) from ".SQL_TABPRE."_doctor,".SQL_TABPRE."_patient,".SQL_TABPRE."_test where doctor_id=".SQL_TABPRE."_doctor.id and patient_id=".SQL_TABPRE."_patient.id and doctor_id = ".$tid." and ".SQL_TABPRE."_patient.name like '".$key."'";
	return SqlQuery($sql);
}
function AddTest($utype,$patient_id,$result)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "insert into ".SQL_TABPRE."_test values(null,now(),'".$result."','".$patient_id."','".$tid."')";
	return SqlQuery($sql);
}
