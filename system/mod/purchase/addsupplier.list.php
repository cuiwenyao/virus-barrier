<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addsupplierListOut($utype)
{
        $USER_TYPE = 4;            //模块用户权限
        $ListTitle = "添加供货商";             //模块标题

        if($utype!=$USER_TYPE) return false;
        echo 
        '
            <h1 class="page-header">'.$ListTitle.'</h1>
            <form action="../../../pro/purchase/addsupplier.pro.php" enctype="multipart/form-data" method="POST">
              <div class="form-group">
                <label>供货商名称</label>
                <input name="name" type="text" class="form-control" placeholder="名称">
              </div>
              <div class="form-group">
                <label>供货商地址</label>
                <input name="address" type="text" class="form-control" placeholder="地址">
              </div>
              <div class="form-group">
                <label>供货商联系方式</label>
                <input name="phonenumber" type="text" class="form-control" placeholder="手机号码">
              </div>
            
            <button type="submit"  class="btn btn-primary">添加</button>
            <a href="system.php?list=supplier" class="btn btn-primary">返回</a>
            </form>
        ';
        return true;
}
