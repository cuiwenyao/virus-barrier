<?php
require_once __DIR__."/../conf/main.conf.php";
require_once __DIR__."/sql.func.php";
require_once __DIR__."/user.func.php";
function CheckUser($utype)
{
	return $utype == 3;
}

function GetRoom($utype)
{
	if(!CheckUser($utype)) return false;
	$sql = "select * from ".SQL_TABPRE."_room where 1";
	return SqlQuery($sql);
}

//清洁消毒记录
function AddClean($utype,$rid)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "insert into ".SQL_TABPRE."_cleaning values(null,now(),".$tid.",".$rid.")";
	return SqlQuery($sql);
}
function GetCleanList($utype,$page,$psize,$key)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select ".SQL_TABPRE."_room.floor,".SQL_TABPRE."_room.number,".SQL_TABPRE."_cleaning.dotime from ".SQL_TABPRE."_cleaning,".SQL_TABPRE."_room where ".SQL_TABPRE."_cleaning.room_id = ".SQL_TABPRE."_room.id and cleaner_id=".$tid." order by ".SQL_TABPRE."_cleaning.id desc limit ".($page-1)*$psize.",".$psize;
	return SqlQuery($sql);
}
function GetCleanListNum($utype,$key)
{
	if(!CheckUser($utype)) return false;
	$tid = GetNowUserTid();
	$sql = "select count(*) from ".SQL_TABPRE."_cleaning,".SQL_TABPRE."_room where ".SQL_TABPRE."_cleaning.room_id = ".SQL_TABPRE."_room.id and cleaner_id=".$tid;
	return SqlQuery($sql);
}