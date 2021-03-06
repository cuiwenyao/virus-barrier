<?php
/*
 Link模块：
 函数名：(模块名)LinkOut($utype,$listname)
 1、设置参数即可。（用户权限、用户组标签、目录内容）
*/
function mainLinkOut($utype,$listname)
{
        $USER_TYPE = 100;                     //模块用户权限   
        $UTYPE_TAG = 'main';                  //所属用户组标签
        $LINK_CONTENT =                       //模块目录内容
        array(
                array(
                        array( "start" , "概览" ) ,
                        array( "patient" , "病患信息" ) ,
                        0
                ) , 
                array(
                        array( "doctor" , "医生列表" ) ,
                        array( "nurse" , "护士列表" ) ,
                        array( "cleaner" , "清洁人员列表" ) ,
                        array( "room" , "房间列表" ) ,
                        array( "medicine" , "药物列表" ) ,
                        0
                ) ,
                array(
                        array( "testing" , "核酸检测记录" ) ,
                        array( "cleaning" , "清洁消毒记录" ) ,
                        array( "purchase" , "药物购买记录" ) ,
                        0
                ) ,
                array(
                        array( "clearsystem" , "清理系统缓存" ) ,
                        array( "backupsystem" , "数据库备份与恢复" ) ,
                        0
                ) ,
                0
        ) ;
        if($utype!=$USER_TYPE) return false;  //权限控制
        for($i=0;$LINK_CONTENT[$i]!=0;++$i)
        {
                echo '<ul class="nav nav-sidebar">';
                for($j=0;$LINK_CONTENT[$i][$j]!=0;++$j) echo '<li '.(($listname==$LINK_CONTENT[$i][$j][0])?'class="active"':' ').' ><a href="system.php?link='.$UTYPE_TAG.'&list='.$LINK_CONTENT[$i][$j][0].'">'.$LINK_CONTENT[$i][$j][1].'<span class="sr-only">(current)</span></a></li>';
                echo '</ul>';
        }
        return true;
}