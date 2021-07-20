<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function updroomListOut($utype,$did)
{
  $USER_TYPE = 100;            //模块用户权限
  $ListTitle = "修改房间信息";     //模块标题

  if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/main.mod.func.php";
  $res = GetRoomMsg($utype,$did);
  if($res==false) return false;
  $res = mysql_fetch_assoc($res);
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/updroom.pro.php?room_id='.$did.'" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 楼层 </label>
        <input name="floor" value="'.$res['floor'].'" type="text" class="form-control" placeholder="楼层序号">
      </div>
      <div class="form-group">
        <label>房间号</label>
        <input value="'.$res['number'].'" name="number" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>当前状态</label>
        <div class="radio">
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="0" '.( ($res['nowstate']=='0') ? "checked=true" : " " ).' > 正常
          </label>
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="1" '.( ($res['nowstate']=='1') ? "checked=true" : " " ).'> 损坏不可正常使用
          </label>
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="2" '.( ($res['nowstate']=='2') ? "checked=true" : " " ).'> 已入住
          </label>
        </div>
        
      </div>
      <button type="submit" class="btn btn-primary">修改</button>
      <a href = "./system.php?list=room" class="btn btn-primary" />返回</a>
    </form>

  ';
  
  return true;
}
