<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addroomListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "添加房间";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/addroom.pro.php" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 楼层 </label>
        <input name="floor" type="text" class="form-control" placeholder="楼层序号">
      </div>
      <div class="form-group">
        <label>房间号</label>
        <input name="number" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>当前状态</label>
        <div class="radio">
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="0"> 正常
          </label>
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="1"> 损坏不可使用
          </label>
          <label class="radio-inline">
            <input type="radio" name="nowstate" value="2"> 已入住
          </label>
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary">添加</button>
      <a href = "./system.php?list=room" class="btn btn-primary" />返回</a>
    </form>

  ';
	
	return true;
}
