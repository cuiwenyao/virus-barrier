<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function supplierListOut($utype)
{
  $USER_TYPE = 4;            //模块用户权限
  $ListTitle = "供货商列表";     //模块标题
  $psize = 10;                 //每页记录数量
  if($utype!=$USER_TYPE) return false;

  if(isset($_GET['slist']) && $_GET['slist']=='addsupplier')
  {
    require_once __DIR__."/addsupplier.list.php";
    addsupplierListOut($utype);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='delsupplier')
  {
    if(!isset($_GET['sid'])) return false;
    require_once __DIR__."/delsupplier.list.php";
    delsupplierListOut($utype,$_GET['sid']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='updsupplier')
  {
    if(!isset($_GET['sid'])) return false;
    require_once __DIR__."/updsupplier.list.php";
    updsupplierListOut($utype,$_GET['sid']);
    return true;
  }


  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
      <a href = "./system.php?list=supplier&slist=addsupplier" class="btn btn-success" > 添加供货商 </a>
      <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="supplier" >
            <input type="hidden" name="link" value="purchase" >
            <input type="text" name="sea" class="form-control" placeholder="输入供货商名称" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
      </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>地址</th>
                  <th>联系方式</th>
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
  $res = GetSupplierList($utype,$page,$psize,$sea);
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
                        <a href="./system.php?list=supplier&slist=updsupplier&sid='.$msg[3].'"> 修改 </a>
                        <a href="./system.php?list=supplier&slist=delsupplier&sid='.$msg[3].'"> 删除 </a>
                    </td>
              </tr>
        '
        ;
      }
  }
  $num = GetSupplierListNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=supplier&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=supplier&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=supplier&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
