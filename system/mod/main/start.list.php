<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function startListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "概览";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/main.mod.func.php";
	
	return true;
}
