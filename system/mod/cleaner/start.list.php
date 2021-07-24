<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function startListOut($utype)
{
        $USER_TYPE = 3;            //模块用户权限
        $ListTitle = "欢迎~";             //模块标题

        if($utype!=$USER_TYPE) return false;
        echo 
        '
                <h1 class="page-header">'.$ListTitle.'</h1>
                <img align="center" src="../../../upload/bg'.rand(1,BG_NUM).'.jpg" alt="..." class="img-rounded img-responsive">
        ';
        return true;
}
