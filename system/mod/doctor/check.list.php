<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function checkListOut($utype)
{
  $USER_TYPE = 1;            //模块用户权限
  $ListTitle = "身体检查记录";     //模块标题
  $psize = 10;                 //每页记录数量

  if($utype!=$USER_TYPE) return false;
  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="check" >
            <input type="hidden" name="link" value="doctor" >
            <input type="text" name="sea" class="form-control" placeholder="输入病患姓名" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
        </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>病患姓名</th>
                  <th>检查结果</th>
                  <th>检查时间</th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/doctor.mod.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetCheckList($utype,$page,$psize,$sea);
  if($res==false) echo "Error";
  else
  {    
      for($i=0;1;++$i)
      {
        $msg = mysql_fetch_row($res);
        $state = "";
        switch ($msg[1]) {
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
                      <td>'.$state.'</td>
                      <td>'.$msg[2].'</td>
                </tr>
        '
        ;
      }
      
  }
  $num = GetCheckNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=check&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=check&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=check&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
