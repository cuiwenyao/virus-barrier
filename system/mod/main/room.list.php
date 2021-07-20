<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function roomListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "房间信息";		 //模块标题
	$psize = 10;

	if($utype!=$USER_TYPE) return false;
	// Sub list.
  	if(isset($_GET['slist']) && $_GET['slist']=='addroom')
  {
    require __DIR__."/addroom.list.php";
    addroomListOut($utype);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='updroom')
  {
    if(!isset($_GET['room_id'])) return false;
    require __DIR__."/updroom.list.php";
    updroomListOut($utype,$_GET['room_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='delroom')
  {
    if(!isset($_GET['room_id'])) return false;
    require __DIR__."/delroom.list.php";
    if( delroomListOut($utype,$_GET['room_id']) ) 
    {
      header("location:system.php?list=room");
      return true;
    } else return false;
  }

  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <a href = "./system.php?list=room&slist=addroom" class="btn btn-success" > 添加房间 </a>
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="room" >
            <input type="text" name="sea" class="form-control" placeholder="输入房间号" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
        </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>房间号</th>
                  <th>楼层</th>
                  <th>当前状态</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/main.mod.func.php";
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
        $msg = mysql_fetch_assoc($res);
        if($msg==NULL) break;
        echo
        '
          <tr>
                      <td>'.(($page-1)*$psize+$i+1).'</td>
                      <td>'.$msg['number'].'</td>
                      <td>'.$msg['floor'].'</td>
                      <td>'.  ( $msg['nowstate'] == 0 ? '<span class="label label-success">正常</span>' : ( $msg['nowstate'] == 1 ? '<span class="label label-default">已损坏不可正常使用</span>' : '<span class="label label-primary">已入住</span>' )  )  .'</td>
                      <td  align=right>
                        <a href="./system.php?list=room&slist=updroom&room_id='.$msg['id'].'"> 修改 </a>
                        <a href="./system.php?list=room&slist=delroom&room_id='.$msg['id'].'"> 删除 </a>
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
