<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addbuyListOut($utype,$mid)
{
        $USER_TYPE = 4;            //模块用户权限
        $ListTitle = "添加药物购买记录";             //模块标题

        if($utype!=$USER_TYPE) return false;
        require_once __DIR__."/../../../func/purchase.mod.func.php";
        echo 
        '
            <h1 class="page-header">'.$ListTitle.'</h1>
            <form action="../../../pro/purchase/addbuy.pro.php" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="mid" value="'.$mid.'" />
              <div class="form-group">
                <label>购买数量</label>
                <input name="count" type="text" class="form-control" placeholder="数字">
              </div>
        ';

        echo '
            <div class="form-group">
              <label>供货商</label>
              <select name="sid" class="form-control"> ';

        $res = GetSupplier($utype);
          for($i=1;1;++$i)
          {
            $msg = mysql_fetch_assoc($res);
            if($msg==NULL) break;
            echo '<option value="'.$msg['id'].'">'.$msg['name'].'-'.$msg['phonenumber'].'-'.$msg['address'].'</option>';
          }
        echo '
            </select>
            </div>';


        echo '
            <button type="submit"  class="btn btn-primary">添加</button>
            </form>
        ';
        return true;
}
