<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function updsupplierListOut($utype,$sid)
{
        $USER_TYPE = 4;            //模块用户权限
        $ListTitle = "修改供货商信息";             //模块标题

        if($utype!=$USER_TYPE) return false;
        require_once __DIR__."/../../../func/purchase.mod.func.php";
        $res = GetSupplierMsg($utype,$sid);
        $msg = mysql_fetch_assoc($res);
        echo 
        '
            <h1 class="page-header">'.$ListTitle.'</h1>
            <form action="../../../pro/purchase/updsupplier.pro.php" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="sid" value="'.$sid.'" />
              <div class="form-group">
                <label>供货商名称</label>
                <input name="name" type="text" class="form-control" placeholder="名称" value="'.$msg['name'].'">
              </div>
              <div class="form-group">
                <label>供货商地址</label>
                <input name="address" type="text" class="form-control" placeholder="地址" value="'.$msg['address'].'">
              </div>
              <div class="form-group">
                <label>供货商联系方式</label>
                <input name="phonenumber" type="text" class="form-control" placeholder="手机号码" value="'.$msg['phonenumber'].'">
              </div>
            
            <button type="submit"  class="btn btn-primary">修改</button>
            <a href="system.php?list=supplier" class="btn btn-primary">返回</a>
            </form>
        ';
        return true;
}
