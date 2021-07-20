<?php
require_once __DIR__."/../conf/main.conf.php";
function install()
{
	$mysqli =new MySQLi(SQL_HOST,SQL_UNAME,SQL_PWORD,SQL_DBNAME);
	if($mysqli->connect_error){
	    die ("连接失败".$mysqli->connect_error);
	}
	$sqlpre = 
	"
		drop database if exists ".SQL_DBNAME.";
		create database ".SQL_DBNAME." character set utf8;
		use ".SQL_DBNAME.";
	";
	$sql = file_get_contents(__DIR__.'/sql_install.sql');
	$sql = str_replace("isolation_duang",SQL_TABPRE,$sql);
	$sqlpre = $sqlpre . $sql;
	$sqlpre = str_replace("isolation_duang",SQL_TABPRE,$sqlpre);
	$pre = $mysqli->multi_query($sqlpre);
	if(!$pre) 
	{
		printf("错误！");
		return false;
	}else 
	{
		printf("安装成功！<a href='../index.php'>进入系统</a>");
		return true;
	}

	
	// $res = $mysqli->multi_query($sql);
	// if(!$res) 
	// {
	// 	printf("错误！");
	// 	return false;
	// }else 
	// {
	// 	printf("安装成功！<a href='index.php'>进入系统</a>");
	// 	return true;
	// }

}

install();