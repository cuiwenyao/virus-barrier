<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function addcleanListOut($utype)
{
        $USER_TYPE = 3;            //模块用户权限
        $ListTitle = "添加消毒清洁信息";             //模块标题

        if($utype!=$USER_TYPE) return false;
        require_once __DIR__."/../../../func/cleaner.mod.func.php";
          echo 
        '
          <h1 class="page-header"> '.$ListTitle.' </h1>
          <form action="../../../pro/cleaner/addclean.pro.php" enctype="multipart/form-data" method="POST">
        ';
        
        echo '
            <div class="form-group">
              <label>选择房间</label>
              <select name="rid" class="form-control"> ';

        $res = GetRoom($utype);
          for($i=1;1;++$i)
          {
            $msg = mysql_fetch_assoc($res);
            if($msg==NULL) break;
            $state = "正常";
            if($msg['nowstate']==1) $state = "损坏不可用";
            if($msg['nowstate']==2) $state = "已入住";
            echo '<option value="'.$msg['id'].'">'.$msg['floor'].'-'.$msg['number'].'-'.$state.'</option>';
          }
        echo '
            </select>
            </div>';


        echo ' 
            <button type="submit" class="btn btn-primary">添加</button>
          </form>
        ';
        return true;
}
