<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function updgroupListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "修改用户组";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  if(!isset($_GET['uty'])) return false; $uty = $_GET['uty'];
  if(!isset($_GET['tid'])) return false; $tid = $_GET['tid'];
  require_once __DIR__."/../../../func/main.mod.func.php";
  $uname = GetUname($uty,$tid);
  if($uname == false) return false;
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/updgroup.pro.php" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="uty" value="'.$uty.'" />
      <input type="hidden" name="tid" value="'.$tid.'" />
      <div class="form-group">
        <label>用户名</label>
        <input name="uname" type="text" class="form-control" placeholder="用户名" value="'.$uname.'">
      </div>
      <div class="form-group">
        <label>密码</label>
        <input name="pword" type="password" class="form-control" placeholder="密码">
      </div>
      <button type="submit" class="btn btn-primary">修改</button>
    </form>

  ';
	
	return true;
}
