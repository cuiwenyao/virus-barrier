<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function medicineListOut($utype)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "药物信息";		 //模块标题
	$psize = 10;

	if($utype!=$USER_TYPE) return false;
	// Sub list.
  	if(isset($_GET['slist']) && $_GET['slist']=='addmedicine')
  {
    require __DIR__."/addmedicine.list.php";
    addmedicineListOut($utype);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='updmedicine')
  {
    if(!isset($_GET['medicine_id'])) return false;
    require __DIR__."/updmedicine.list.php";
    updmedicineListOut($utype,$_GET['medicine_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='delmedicine')
  {
    if(!isset($_GET['medicine_id'])) return false;
    require __DIR__."/delmedicine.list.php";
    if( delmedicineListOut($utype,$_GET['medicine_id']) ) 
    {
      header("location:system.php?list=medicine");
      return true;
    } else return false;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='detailedmedicine')
  {
    if(!isset($_GET['medicine_id'])) return false;
    require __DIR__."/detailedmedicine.list.php";
    detailedmedicineListOut($utype,$_GET['medicine_id']);
    return true;
  }

  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <a href = "./system.php?list=medicine&slist=addmedicine" class="btn btn-success" > 添加药物 </a>
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="medicine" >
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

  require_once __DIR__."/../../../func/main.mod.func.php";
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
        $msg = mysql_fetch_assoc($res);
        if($msg==NULL) break;
        echo
        '
          <tr>
                      <td>'.(($page-1)*$psize+$i+1).'</td>
                      <td>'.$msg['name'].'</td>
                      <td>'.$msg['count'].'</td>
                      <td>'.$msg['price'].'</td>
                      <td  align=right>
                      	<a href="./system.php?list=medicine&slist=detailedmedicine&medicine_id='.$msg['id'].'"> 详细信息 </a>
                        <a href="./system.php?list=medicine&slist=updmedicine&medicine_id='.$msg['id'].'"> 修改 </a>
                        <a href="./system.php?list=medicine&slist=delmedicine&medicine_id='.$msg['id'].'"> 删除 </a>
                      </td>
                </tr>
        '
        ;
      }
      
  }
  $num = GetMedicineNum($utype,$sea);
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
