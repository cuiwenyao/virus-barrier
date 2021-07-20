<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addmedicineListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "添加药物";		 //模块标题

	if($utype!=$USER_TYPE) return false;
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <form action="../../../pro/main/addmedicine.pro.php" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <label> 药物名称 </label>
        <input name="name" type="text" class="form-control" placeholder="药物名称">
      </div>
      <div class="form-group">
        <label>药物库存</label>
        <input name="count" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>药物价格</label>
        <input name="price" type="text" class="form-control" placeholder="">
      </div>
      <div class="form-group">
        <label>药物介绍</label>
        <textarea name="profile"  class="form-control" rows=5></textarea>
      </div>
      <button type="submit" class="btn btn-primary">添加</button>
      <a href = "./system.php?list=medicine" class="btn btn-primary" />返回</a>
    </form>

  ';
	
	return true;
}
