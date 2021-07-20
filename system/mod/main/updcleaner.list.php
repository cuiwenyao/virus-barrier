<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function updcleanerListOut($utype,$did)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "修改清洁人员信息";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/main.mod.func.php";
  $res = GetCleanerMsg($utype,$did);
  if($res==false) return false;
  $res = mysql_fetch_assoc($res);
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/updcleaner.pro.php?cleaner_id='.$did.'" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 姓名 </label>
        <input name="name" value="'.$res['name'].'" type="text" class="form-control" placeholder="名字">
      </div>
      <div class="form-group">
        <label>性别</label>
        <div class="radio">
          <label class="radio-inline">
            <input type="radio" name="sex" value="男" '.( ($res['sex']=='男') ? "checked=true" : " " ).' > 男
          </label>
          <label class="radio-inline">
            <input type="radio" name="sex" value="女" '.( ($res['sex']=='女') ? "checked=true" : " " ).'> 女
          </label>
        </div>
      </div>
      <div class="form-group">
        <label>年龄</label>
        <input value="'.$res['age'].'" name="age" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>家庭住址</label>
        <input value="'.$res['homeaddress'].'" name="homeaddress" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>手机号码</label>
        <input value="'.$res['phonenumber'].'" name="phonenumber" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>上传照片</label>
        <input name="photo" type="file" id = "photo" />
        <p class="help-block">200KB以下</p>
      </div>
      
      <button type="submit" class="btn btn-primary">修改</button>
      <a href = "./system.php?list=cleaner" class="btn btn-primary" />返回</a>
    </form>

  ';
	
	return true;
}
