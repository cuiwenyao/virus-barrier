<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function medicineListOut($utype)
{
  $USER_TYPE = 2;            //模块用户权限
  $ListTitle = "药物使用记录";     //模块标题
  $psize = 10;                 //每页记录数量
  if($utype!=$USER_TYPE) return false;


  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="medicine" >
            <input type="hidden" name="link" value="nurse" >
            <input type="text" name="sea" class="form-control" placeholder="输入病患姓名" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
        </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>病人姓名</th>
                  <th>药物名称</th>
                  <th>使用量</th>
                  <th>使用时间</th>
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
  $res = GetMedicineUseList($utype,$page,$psize,$sea);
  if($res==false) echo "Error";
  else
  {    
      for($i=0;1;++$i)
      {
        $msg = mysql_fetch_row($res);
        if($msg==NULL) break;
        echo
        '
          <tr>
                    <td>'.(($page-1)*$psize+$i+1).'</td>
                    <td>'.$msg[0].'</td>
                    <td>'.$msg[1].'</td>
                    <td>'.$msg[2].'</td>
                    <td>'.$msg[3].'</td>
              </tr>
        '
        ;
      }
      
  }
  $num = GetMedicineUseListNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=medicine&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=medicine&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=medicine&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
