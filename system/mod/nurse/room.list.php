<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function roomListOut($utype)
{
  $USER_TYPE = 2;            //模块用户权限
  $ListTitle = "我负责的房间";     //模块标题
  $psize = 10;                 //每页记录数量
  if($utype!=$USER_TYPE) return false;
  
  //Sub List
  if(isset($_GET['slist']) && $_GET['slist']=="usemedicine")
  {
  	if(!isset($_GET['pid'])) return false;
  	require_once __DIR__."/usemedicine.list.php";
  	usemedicineListOut($utype,$_GET['pid']);
  	return true;
  }


  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>楼层</th>
                  <th>房间号</th>
                  <th>病人姓名</th>
                  <th>病人状态</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/nurse.mod.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetRoomList($utype,$page,$psize,$sea);
  if($res==false) echo "Error";
  else
  {    
      for($i=0;1;++$i)
      {
        $msg = mysql_fetch_row($res);
        $state = "";
        switch ($msg[3]) {
          case 0: $state = '<span class="label label-success">出院</span>'; break;
          case 1: $state = '<span class="label label-info">身体正常</span>'; break;
          case 2: $state = '<span class="label label-warning">身体虚弱</span>'; break;
          case 3: $state = '<span class="label label-danger">情况严重</span>'; break;
          case 4: $state = '<span class="label label-default">已死亡</span>'; break;
        }
        if($msg==NULL) break;
        echo
        '
          <tr>
                    <td>'.(($page-1)*$psize+$i+1).'</td>
                    <td>'.$msg[0].'</td>
                    <td>'.$msg[1].'</td>
                    <td>'.$msg[2].'</td>
                    <td>'.$state.'</td>
                    <td>
						<a href="system.php?link=nurse&list=room&slist=usemedicine&pid='.$msg[4].'">添加药物使用记录</a>
                    </td>
              </tr>
        '
        ;
      }
      
  }
  $num = GetRoomNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=room&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=room&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=room&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </'.( ($page>=$pnum) ? 'span' : 'a' ).'>
                </li>
              </ul>
            </nav>
          </div>
    '
  ;
  return true;
}
