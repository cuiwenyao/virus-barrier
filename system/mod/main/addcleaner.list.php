<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addcleanerListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "添加清洁人员";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/addcleaner.pro.php" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 姓名 </label>
        <input name="name" type="text" class="form-control" placeholder="名字">
      </div>
      <div class="form-group">
        <label>性别</label>
        <div class="radio">
          <label class="radio-inline">
            <input type="radio" name="sex" value="男"> 男
          </label>
          <label class="radio-inline">
            <input type="radio" name="sex" value="女"> 女
          </label>
        </div>
      </div>
      <div class="form-group">
        <label>年龄</label>
        <input name="age" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>家庭住址</label>
        <input name="homeaddress" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>手机号码</label>
        <input name="phonenumber" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>上传照片</label>
        <input name="photo" type="file" id = "photo" />
        <p class="help-block">200KB以下</p>
      </div>
      
      <button type="submit" class="btn btn-primary">添加</button>
      <a href = "./system.php?list=cleaner" class="btn btn-primary" />返回</a>
    </form>

  ';
	
	return true;
}
