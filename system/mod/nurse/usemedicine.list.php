<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function usemedicineListOut($utype,$pid = 0)
{
	$USER_TYPE = 2;            //模块用户权限
	$ListTitle = "添加药物使用记录";		 //模块标题

	if($utype!=$USER_TYPE) return false;
	require_once __DIR__."/../../../func/nurse.mod.func.php";
	  echo 
  '
    <h1 class="page-header"> '.$ListTitle.' </h1>
    <form action="../../../pro/nurse/usemedicine.pro.php" enctype="multipart/form-data" method="POST">
  ';


	if($pid > 0) echo '<input type="hidden" name="pid" value="'.$pid.'">';
	else 
	{		  
		  echo '
		      <div class="form-group">
		        <label>选择病人</label>
		        <select name="pid" class="form-control"> ';
		 	$res = GetPatientList($utype);
		    for($i=1;1;++$i)
		    {
		      $msg = mysql_fetch_assoc($res);
		      var_dump($msg);
		      if($msg==NULL) break;
		      echo '<option value="'.$msg['id'].'">'.$msg['id'].'-'.$msg['name'].'</option>';
		    }
		  echo ' </select> </div>';
	}


  
  echo '
      <div class="form-group">
        <label>选择药物</label>
        <select name="mid" class="form-control"> ';

  $res = GetMedicine($utype);
    for($i=1;1;++$i)
    {
      $msg = mysql_fetch_assoc($res);
      if($msg==NULL) break;
      echo '<option value="'.$msg['id'].'">'.$msg['id'].'-'.$msg['name'].'-剩余数量：'.$msg['count'].'</option>';
    }
  echo '
      </select>
      </div>';


  echo ' 
      <div class="form-group">
        <label>使用量</label>
        <input type="text" name="count"  class="form-control" placeholder="数字" />
      </div>
      <button type="submit" class="btn btn-primary">添加</button>
    </form>
  ';
	return true;
}
