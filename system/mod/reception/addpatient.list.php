<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addpatientListOut($utype)
{
	$USER_TYPE = 5;            //模块用户权限
	$ListTitle = "入院隔离办理<h2>添加病人</h2>";		 //模块标题
	if($utype!=$USER_TYPE) return false;
  echo 
  '
    <h1 class="page-header"> '.$ListTitle.' </h1>
    <form action="../../../pro/reception/addpatient.pro.php" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 病患姓名 </label>
        <input name="name" type="text" class="form-control" placeholder="名字">
      </div>
      <div class="form-group">
        <label>病患性别</label>
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
        <label>病患年龄</label>
        <input name="age" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>病患家庭住址</label>
        <input name="homeaddress" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>病患手机号码</label>
        <input name="phonenumber" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>当前状态</label>
        <select name="nowstate" class="form-control">
		  <option value="1">身体正常</option>
		  <option value="2">身体虚弱</option>
		  <option value="3">情况严重</option>
		  <option value="4">已死亡</option>
		</select>
      </div>
      <div class="form-group">
        <label>上传照片</label>
        <input name="photo" type="file" id = "photo" />
        <p class="help-block">200KB以下</p>
      </div>
      
      <button type="submit" class="btn btn-primary">办理</button>
    </form>

  ';
	
	return true;
}
