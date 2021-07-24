<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function medicineListOut($utype)
{
  $USER_TYPE = 4;            //模块用户权限
  $ListTitle = "药物库存信息";     //模块标题
  $psize = 10;                 //每页记录数量
  if($utype!=$USER_TYPE) return false;
  if(isset($_GET['slist']) && $_GET['slist']=='addbuy')
  {
    if(!isset($_GET['mid'])) return false;
    require_once __DIR__."/addbuy.list.php";
    addbuyListOut($utype,$_GET['mid']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='detailedmedicine')
  {
    if(!isset($_GET['mid'])) return false;
    require_once __DIR__."/detailedmedicine.list.php";
    detailedmedicineListOut($utype,$_GET['mid']);
    return true;
  }


  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
      <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="medicine" >
            <input type="hidden" name="link" value="purchase" >
            <input type="text" name="sea" class="form-control" placeholder="输入药物名称" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
      </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>药物名称</th>
                  <th>库存数量</th>
                  <th>药物价格</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/purchase.mod.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetMedicineList($utype,$page,$psize,$sea);
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
                    <td align="right">
                      <a href="system.php?list=medicine&slist=addbuy&mid='.$msg[3].'">添加购买记录</a>
                      <a href="system.php?list=medicine&slist=detailedmedicine&mid='.$msg[3].'">药物详细信息</a>
                    </td>
              </tr>
        '
        ;
      }
  }
  $num = GetMedicineListNum($utype,$sea);
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
