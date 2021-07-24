<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addfamilyListOut($utype,$pid)
{
	$USER_TYPE = 5;            //模块用户权限
	$ListTitle = "入院隔离办理<h2>添加家属信息</h2>";		 //模块标题
	if($utype!=$USER_TYPE) return false;
	require_once __DIR__."/../../../func/reception.mod.func.php";
	$res = GetPatientMsg($utype,$pid);
	if($res==false) return false;
	$res = mysql_fetch_assoc($res);
	$state = "";
        switch ($res['nowstate']) {
        	case 0: $state = '<span class="label label-success">出院</span>'; break;
        	case 1: $state = '<span class="label label-info">身体正常</span>'; break;
        	case 2: $state = '<span class="label label-warning">身体虚弱</span>'; break;
        	case 3: $state = '<span class="label label-danger">情况严重</span>'; break;
        	case 4: $state = '<span class="label label-default">已死亡</span>'; break;
        }
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/reception/addfamily.pro.php?patient_id='.$res['id'].'" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 病患姓名 </label>
        <p>'.$res['name'].'</p>
      </div>
      <div class="form-group">
        <label>病患性别</label>
        <p>'.$res['sex'].'</p>
      </div>
      <div class="form-group">
        <label>病患年龄</label>
        <p>'.$res['age'].'</p>
      </div>
      <div class="form-group">
        <label>当前状态</label>
        <p>'.$state.'</p>
      </div>
      <div class="form-group">
        <label>历史住宿信息</label>
        <ul class="list-group">
    ';
    $res = GetLiving($utype,$pid);
    while ( $msg = mysql_fetch_assoc($res) )
    {
      echo '<li class="list-group-item '.($msg['isusing']?'list-group-item-success':' ').'">'.$msg['indate'].' , '.$msg['number'].' , '.$msg['name'].'</li>';
    }
    echo ' </ul> </div> 
          <div class="form-group">
        <label>家属信息</label>
        <ul class="list-group">
    ';
    $res = GetFamily($utype,$pid);
    while ( $msg = mysql_fetch_assoc($res) )
    {
      echo '<li class="list-group-item">'.$msg['relation'].' , '.$msg['name'].' , '.$msg['phonenumber'].'</li>';
    }
    echo ' </ul> </div> ';


    echo '
      <div class="form-group">
        <label> 家属姓名 </label>
        <input name="name" type="text" class="form-control" placeholder="名字">
      </div>
      <div class="form-group">
        <label>与病患关系</label>
        <input name="relation" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>家属手机号码</label>
        <input name="phonenumber" type="text" class="form-control" placeholder="">
      </div>
     
      <button type="submit" class="btn btn-primary">办理</button>
    </form>
    ';
	return true;
}
