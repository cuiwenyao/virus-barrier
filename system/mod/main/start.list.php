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
	echo 
	'
		<h1 class="page-header">'.$ListTitle.'</h1>
          <div class="alert alert-danger" role="alert">正在隔离病人数量：<span class="label label-danger">'.NowPatient().'</span> </div>
          <div class="alert alert-warning" role="alert">入院隔离人次：<span class="label label-warning">'.AllPatient().'</span> 出院人次：<span class="label label-warning">'.AllLeave().'</span> 死亡人次：<span class="label label-default">'.AllDie().'</span></div>
          <div class="alert alert-success" role="alert">当前护士数量：<span class="label label-info">'.NowNurse().'</span> 当前医生数量：<span class="label label-info">'.NowDoctor().'</span> 当前清洁人员数量：<span class="label label-info">'.NowCleaner().'</span></div>
          <div class="alert alert-success" role="alert">当前空余病房数量：<span class="label label-info">'.NowRoom().'</span> 当前可用药物数量：<span class="label label-info">'.NowMedicine().'</span></div>

       <img align="center" src="../../../upload/bg'.rand(1,BG_NUM).'.jpg" alt="..." class="img-rounded">


	';
	return true;
}
