<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function demoListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "DEMO";		 //模块标题

	if($utype!=$USER_TYPE) return false;
	echo 
	'
		<h1 class="page-header">'.$ListTitle.'</h1>
    	developing....

	';
	return true;
}
