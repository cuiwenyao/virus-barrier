<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function updpatientListOut($utype,$did)
{
	$USER_TYPE = 5;            //模块用户权限
	$ListTitle = "修改病人信息";		 //模块标题
	if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/reception.mod.func.php";
  $res = GetPatientMsg($utype,$did);
  if($res==false) return false;
  $res = mysql_fetch_assoc($res);
  if($res['nowstate']==0) return false; //已经出院的病人不可以修改
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/reception/updpatient.pro.php?patient_id='.$res['id'].'" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 病患姓名 </label>
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
        <label>当前状态</label>
        <select name="nowstate" class="form-control">
  		  <option value="1" '.($res['nowstate']==1?'selected="selected"':' ').'>身体正常</option>
  		  <option value="2" '.($res['nowstate']==2?'selected="selected"':' ').'>身体虚弱</option>
  		  <option value="3" '.($res['nowstate']==3?'selected="selected"':' ').'>情况严重</option>
  		  <option value="4" '.($res['nowstate']==4?'selected="selected"':' ').'>已死亡</option>
  		</select>
      </div>
      <div class="form-group">
        <label>上传照片</label>
        <input name="photo" type="file" id = "photo" />
        <p class="help-block">200KB以下</p>
      </div>
      
      <button type="submit" class="btn btn-primary">修改</button>
      <button type="submit" class="btn btn-primary">返回</button>
    </form>

  ';
	
	return true;
}
