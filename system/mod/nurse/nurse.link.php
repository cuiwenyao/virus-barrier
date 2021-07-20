<?php
/*
 Link模块：
 函数名：(模块名)LinkOut($utype,$listname)
 1、设置参数即可。（用户权限、用户组标签、目录内容）
*/
 function nurseLinkOut($utype,$listname)
{
        $USER_TYPE = 2;                     //模块用户权限   
        $UTYPE_TAG = 'nurse';               //所属用户组标签
        $LINK_CONTENT =                     //模块目录内容
        array(
                array(
                        array( "start" , "概览" ) ,
                        array( "room" , "我负责的房间" ) ,
                        array( "medicine" , "药物使用记录" ) ,
                        0
                ) , 
                array(
                        array( "usemedicine" , "添加药物使用" ) ,
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