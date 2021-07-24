<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function detailedpatientListOut($utype,$pid)
{
	$USER_TYPE = 5;            //模块用户权限
	$ListTitle = "病人详细信息";		 //模块标题

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
    <div class="well well-lg" >
      <div class="row">
        <div class="col-xs-4 col-md-2">
            <img class="img-thumbnail" style="width:100%;height:auto;" src="../../../upload/'.$res['photo'].'" alt="照片">
        </div>
        <div class="col-xs-8 col-md-10" >
          <dl class="dl-vertical" style="font-size:15px;letter-spacing:2px;">
              <dt>姓名:'.$res['name'].'</dt> <dd></dd>
              <dt>性别:'.$res['sex'].'</dt> <dd></dd>
              <dt>年龄:'.$res['age'].'</dt> <dd></dd>
              <dt>家庭住址:'.$res['homeaddress'].'</dt> <dd></dd>
              <dt>联系方式:'.$res['phonenumber'].'</dt> <dd></dd>
              <dt>当前状态:'.$state.'</dt> <dd></dd>
          </dl>
        </div>

      </div> 
  ';
  echo '
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

    echo ' <div class="form-group">
        <label>药物使用记录</label>
        <ul class="list-group">
    ';
    $res = GetMedicineUseList($utype,$pid);
    while ( $msg = mysql_fetch_row($res) )
    {
      echo '<li class="list-group-item">'.$msg[0].' , '.$msg[1].' , '.$msg[2].' , '.$msg[3].'</li>';
    }
    echo ' </ul> </div> ';


    echo ' <div class="form-group">
        <label>身体状态诊断记录</label>
        <ul class="list-group">
    ';
    $res = GetCheckList($utype,$pid);
    while ( $msg = mysql_fetch_row($res) )
    {
      $state = "";
        switch ($msg[0]) {
          case 0: $state = '<span class="label label-success">出院</span>'; break;
          case 1: $state = '<span class="label label-info">身体正常</span>'; break;
          case 2: $state = '<span class="label label-warning">身体虚弱</span>'; break;
          case 3: $state = '<span class="label label-danger">情况严重</span>'; break;
          case 4: $state = '<span class="label label-default">已死亡</span>'; break;
        }
      echo '<li class="list-group-item">'.$state.' , '.$msg[1].' , '.$msg[2].'</li>';
    }
    echo ' </ul> </div> ';

    echo ' <div class="form-group">
        <label>核酸检测记录</label>
        <ul class="list-group">
    ';
    $res = GetTestList($utype,$pid);
    while ( $msg = mysql_fetch_row($res) )
    {
      $state = "";
        switch ($msg[0]) {
          case 0: $state = '<span class="label label-success">阴性</span>'; break;
          case 1: $state = '<span class="label label-danger">阳性</span>'; break;
        }
      echo '<li class="list-group-item">'.$state.' , '.$msg[1].' , '.$msg[2].'</li>';
    }
    echo ' </ul> </div> ';





  echo '
    </div>
    <a href="system.php?list=patient" class="btn btn-primary" > 返回 </a>
    
  ';
	return true;
}
