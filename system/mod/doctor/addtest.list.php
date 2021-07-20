<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addtestListOut($utype)
{
  $USER_TYPE = 1;            //模块用户权限
  $ListTitle = "添加核酸检测记录";    //模块标题
  if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/doctor.mod.func.php";
  echo 
  '
    <h1 class="page-header"> '.$ListTitle.' </h1>
    <form action="../../../pro/doctor/addtest.pro.php" enctype="multipart/form-data" method="POST">
  ';
  
  echo '
      <div class="form-group">
        <label>选择病人</label>
        <select name="pid" class="form-control"> ';

  $res = GetPatient($utype);
    for($i=1;1;++$i)
    {
      $msg = mysql_fetch_assoc($res);
      if($msg==NULL) break;
      echo '<option value="'.$msg['id'].'">'.$msg['id'].'-'.$msg['name'].'-'.$msg['sex'].'</option>';
    }
  echo '
      </select>
      </div>';


  echo ' 
      <div class="form-group">
        <label>检测结果</label>
        <select name="res" class="form-control"> 
          <option value="0">阴性</option>
          <option value="1">阳性</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">添加</button>
    </form>
  ';
  
  return true;
}
