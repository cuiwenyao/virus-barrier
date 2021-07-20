<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function backupsystemListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "系统数据库备份与恢复";		 //模块标题
	if($utype!=$USER_TYPE) return false;
	$dirname = __DIR__."/../../../backup/";
	$dircons = scandir($dirname);
	echo 
	'
		<h1 class="page-header">'.$ListTitle.'</h1>
    	
		<form target="system.php" method="get">
			<input type="hidden" name = "list" value="backupsystem" />
			<div class="form-group">
		        <label>选择备份文件</label>
		        <select name="restore" class="form-control"> 
					';
	foreach ($dircons as $fname) 
	{
		if($fname=="index.php" || $fname=="." || $fname=="..") continue;
		echo '<option value="'.$fname.'">'.$fname.'</option>';
	}
	echo '
		        </select>
		    </div>
		    <button type="submit" class="btn btn-primary">数据恢复</button>
		    <a href="system.php?list=backupsystem&backup=true" class="btn btn-success"> 一键备份当前数据库 </a>
		</form>
	';
	if(isset($_GET['backup']) && $_GET['backup']=="true")
	{
		require_once __DIR__."/../../../func/backup.func.php";
		backupData();
	}
	else if(isset($_GET['restore']))
	{
		require_once __DIR__."/../../../func/backup.func.php";
		restoreData(__DIR__."/../../../backup/".$_GET['restore']);
	}
	return true;
}
