<?php
require_once __DIR__."/../conf/main.conf.php";
error_reporting(E_ALL ^ E_DEPRECATED);
function SqlConnect()
{
	$SqlLink = mysql_connect(SQL_HOST,SQL_UNAME,SQL_PWORD,SQL_DBNAME);
	if (!$SqlLink){
		die("连接失败：".$SqlLink->connect_error);
	}
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("use ".SQL_DBNAME,$SqlLink);
	return $SqlLink;
}

function SqlQuery($sql)
{
	$SqlLink = SqlConnect();
	$res =  mysql_query($sql,$SqlLink);
	mysql_close($SqlLink);
	return $res;
}

function DBSqlQuery($sql)
{
	$SqlLink = SqlConnect();
	echo $sql;
//	mysql_db_query(SQL_DBNAME,"delimiter main___",$SqlLink);
	$res =  mysql_db_query(SQL_DBNAME,$sql,$SqlLink);
//	mysql_db_query(SQL_DBNAME,"delimiter ;",$SqlLink);
	mysql_close($SqlLink);
	return $res;
}