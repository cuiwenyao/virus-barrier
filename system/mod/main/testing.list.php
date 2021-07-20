<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function testingListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "核酸检测记录";		 //模块标题
	$psize = 10;

	if($utype!=$USER_TYPE) return false;
	// Sub list.

  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="testing" >
            <input type="text" name="sea" class="form-control" placeholder="病人姓名" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
        </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>病人姓名</th>
                  <th>检测结果</th>
                  <th>负责医生</th>
                  <th>检测日期</th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/main.mod.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetTestingList($utype,$page,$psize,$sea);

  if($res==false) echo "Error";
  else
  {    
      for($i=0;1;++$i)
      {
        $msg = mysql_fetch_row($res);
      //  var_dump($msg);
        if($msg==NULL) break;
        echo
        '
          <tr>
                      <td>'.(($page-1)*$psize+$i+1).'</td>
                      <td>'.$msg[3].'</td>
                      <td>'.($msg[1]==1?'<span class="label label-danger">阳性</span>':'<span class="label label-success">阴性</span>').'</td>
                      <td>'.$msg[4].'</td>
                      <td>'.$msg[2].'</td>
                </tr>
        '
        ;
      }
      
  }
  $num = GetTestingNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=testing&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=testing&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=testing&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
