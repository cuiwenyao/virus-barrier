<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function doctorListOut($utype)
{
  $USER_TYPE = 100;            //模块用户权限
  $ListTitle = "医生信息";     //模块标题
  $psize = 10;                 //每页医生数量

  if($utype!=$USER_TYPE) return false;

  // Sub list.
  if(isset($_GET['slist']) && $_GET['slist']=='adddoctor')
  {
    require __DIR__."/adddoctor.list.php";
    adddoctorListOut($utype);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='upddoctor')
  {
    if(!isset($_GET['doctor_id'])) return false;
    require __DIR__."/upddoctor.list.php";
    upddoctorListOut($utype,$_GET['doctor_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='deldoctor')
  {
    if(!isset($_GET['doctor_id'])) return false;
    require __DIR__."/deldoctor.list.php";
    if( deldoctorListOut($utype,$_GET['doctor_id']) ) 
    {
      header("location:system.php?list=doctor");
      return true;
    } else return false;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='detaileddoctor')
  {
    if(!isset($_GET['doctor_id'])) return false;
    require __DIR__."/detaileddoctor.list.php";
    detaileddoctorListOut($utype,$_GET['doctor_id']);
    return true;
  }

  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <a href = "./system.php?list=doctor&slist=adddoctor" class="btn btn-success" > 添加医生 </a>
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="doctor" >
            <input type="text" name="sea" class="form-control" placeholder="输入姓名" />
            <input type="submit" class="btn btn-primary" value="搜索"/>
        </form>
      </div>
      <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>姓名</th>
                  <th>性别</th>
                  <th>年龄</th>
                  <th>电话号码</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/main.mod.func.php";
  require_once __DIR__."/../../../func/user.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetDoctorList($utype,$page,$psize,$sea);
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
                      <td>'.$msg['sex'].'</td>
                      <td>'.$msg['age'].'</td>
                      <td>'.$msg['phonenumber'].'</td>
                      <td  align=right>
                        <a href="./system.php?list=doctor&slist=detaileddoctor&doctor_id='.$msg['id'].'"> 详细信息 </a>
                        <a href="./system.php?list=doctor&slist=upddoctor&doctor_id='.$msg['id'].'"> 修改 </a>
                        <a href="./system.php?list='.( ExistedTid ( USER_ID_DOCTOR , $msg['id'] )?'updgroup':'addgroup').'&uty='.USER_ID_DOCTOR.'&tid='.$msg['id'].'"> '.(ExistedTid ( USER_ID_DOCTOR , $msg['id'] )?'修改':'添加').'用户组信息 </a>
                        <a href="./system.php?list=doctor&slist=deldoctor&doctor_id='.$msg['id'].'"> 删除 </a>
                      </td>
                </tr>
        ' ;
      }
      
  }
  $num = GetDoctorNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=doctor&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=doctor&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=doctor&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
