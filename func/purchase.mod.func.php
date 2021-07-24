<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";
require_once __DIR__."/user.func.php";
function CheckUser($utype)
{
	return $utype == 4;
}

function GetSupplier($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_supplier where 1";
	return SqlQuery($sql);
}



//药物
function GetMedicineList($utype,$page,$psize,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select name,count,price,id from ".SQL_TABPRE."_medicine where name like '".$key."' order by id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetMedicineListNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select count(*) from ".SQL_TABPRE."_medicine where name like '".$key."'";
	return SqlQuery($sql);
}
function AddBuy($utype,$mid,$count,$sid)
{
	if(!CheckUser($utype)) return false;
	//添加数量
	$sql = "update ".SQL_TABPRE."_medicine set count = count + ".$count." where id=".$mid;
	$res = SqlQuery($sql);
	if($res == false) return false;
	//添加记录
	$sql = "insert into ".SQL_TABPRE."_purchase values(null,now(),'".$count."','".$mid."','".$sid."')";
	return SqlQuery($sql);
}
function GetMedicineMsg($utype,$mid)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_medicine where id=".$mid;
	return SqlQuery($sql);
}

//药物购买记录
function GetBuyList($utype,$page,$psize,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select ".SQL_TABPRE."_medicine.name,".SQL_TABPRE."_purchase.count,".SQL_TABPRE."_supplier.name from ".SQL_TABPRE."_medicine,".SQL_TABPRE."_supplier,".SQL_TABPRE."_purchase where ".SQL_TABPRE."_medicine.id=".SQL_TABPRE."_purchase.medicine_id and ".SQL_TABPRE."_supplier.id=".SQL_TABPRE."_purchase.supplier_id and ".SQL_TABPRE."_medicine.name like '".$key."' order by ".SQL_TABPRE."_purchase.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetBuyListNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select count(*) from ".SQL_TABPRE."_medicine,".SQL_TABPRE."_supplier,".SQL_TABPRE."_purchase where ".SQL_TABPRE."_medicine.id=".SQL_TABPRE."_purchase.medicine_id and ".SQL_TABPRE."_supplier.id=".SQL_TABPRE."_purchase.supplier_id and ".SQL_TABPRE."_medicine.name like '".$key."'";
	return SqlQuery($sql);
}



//供货商列表
function GetSupplierList($utype,$page,$psize,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select name,address,phonenumber,id from ".SQL_TABPRE."_supplier where name like '".$key."' order by id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetSupplierListNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$sql = "select count(*) from ".SQL_TABPRE."_supplier where name like '".$key."'";
	return SqlQuery($sql);
}
function GetSupplierMsg($utype,$sid)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_supplier where id = ".$sid;
	return SqlQuery($sql);
}
function AddSupplier($utype,$name,$address,$phonenumber)
{
	if(!CheckUser($utype)) return false;
	$sql = "insert into ".SQL_TABPRE."_supplier values(null,'".$name."','".$address."','".$phonenumber."')";
	return SqlQuery($sql);
}
function UpdSupplier($utype,$sid,$name,$address,$phonenumber)
{
	if(!CheckUser($utype)) return false;
	$sql = "update ".SQL_TABPRE."_supplier set name='".$name."' , address='".$address."' , phonenumber = '".$phonenumber."' where id = ".$sid." ";
	return SqlQuery($sql);
}
function DelSupplier($utype,$sid)
{
	if(!CheckUser($utype)) return false;
	$sql = "delete from ".SQL_TABPRE."_supplier where id=".$sid;
	return SqlQuery($sql);
}