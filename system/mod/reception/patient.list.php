<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function patientListOut($utype)
{
  $USER_TYPE = 5;            //模块用户权限
  $ListTitle = "病患信息";     //模块标题
  $psize = 10;                 //每页病患数量

  if($utype!=$USER_TYPE) return false;

  // Sub list.
  if(isset($_GET['slist']) && $_GET['slist']=='patientleave')
  {
    require __DIR__."/patientleave.list.php";
    if( patientleaveListOut($utype,$_GET['patient_id']) ) 
    {
      header("location:system.php?list=patient");
      return true;
    } else return false;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='delpatient')
  {
    if(!isset($_GET['patient_id'])) return false;
    require __DIR__."/delpatient.list.php";
    if( delpatientListOut($utype,$_GET['patient_id']) ) 
    {
      header("location:system.php?list=patient");
      return true;
    } else return false;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='updpatient')
  {
    if(!isset($_GET['patient_id'])) return false;
    require __DIR__."/updpatient.list.php";
    updpatientListOut($utype,$_GET['patient_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='detailedpatient')
  {
    if(!isset($_GET['patient_id'])) return false;
    require __DIR__."/detailedpatient.list.php";
    detailedpatientListOut($utype,$_GET['patient_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='addliving')
  {
    if(!isset($_GET['patient_id'])) return false;
    require __DIR__."/addliving.list.php";
    addlivingListOut($utype,$_GET['patient_id']);
    return true;
  }
  if(isset($_GET['slist']) && $_GET['slist']=='addfamily')
  {
    if(!isset($_GET['patient_id'])) return false;
    require __DIR__."/addfamily.list.php";
    addfamilyListOut($utype,$_GET['patient_id']);
    return true;
  }

  echo 
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
      <div id="navbar" class="navbar-collapse collapse">
        <form action="system.php" method="get" class="navbar-form navbar-right">
            <input type="hidden" name="list" value="patient" >
            <input type="hidden" name="link" value="reception" >
            <input type="text" name="sea" class="form-control" placeholder="输入病患姓名" />
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
                  <th>当前状态</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
  ';

  require_once __DIR__."/../../../func/reception.mod.func.php";
  $page = 1; 
  if(isset($_GET['page'])) $page = $_GET['page'];
  $sea = '%';
  if(isset($_GET['sea'])) $sea = '%'.$_GET['sea'].'%';
  $res = GetPatientList($utype,$page,$psize,$sea);
  if($res==false) echo "Error";
  else
  {    
      for($i=0;1;++$i)
      {
        $msg = mysql_fetch_assoc($res);
        if($msg==NULL) break;
        $state = "";
        switch ($msg['nowstate']) {
        	case 0: $state = '<span class="label label-success">出院</span>'; break;
        	case 1: $state = '<span class="label label-info">身体正常</span>'; break;
        	case 2: $state = '<span class="label label-warning">身体虚弱</span>'; break;
        	case 3: $state = '<span class="label label-danger">情况严重</span>'; break;
        	case 4: $state = '<span class="label label-default">已死亡</span>'; break;
        }
        echo
        '
          <tr>
                      <td>'.(($page-1)*$psize+$i+1).'</td>
                      <td>'.$msg['name'].'</td>
                      <td>'.$msg['sex'].'</td>
                      <td>'.$msg['age'].'</td>
                      <td>'.$msg['phonenumber'].'</td>
                      <td>'.$state.'</td>
                      <td  align=right>
                        '. ( $msg['nowstate'] == 0 ? " " : '<a href="./system.php?link=reception&list=patient&slist=addliving&patient_id='.$msg['id'].'"> 办理住宿 </a>'  ) .'
                        '. ( $msg['nowstate'] == 0 ? " " : '<a href="./system.php?link=reception&list=patient&slist=addfamily&patient_id='.$msg['id'].'"> 添加家属信息 </a>'  ) .'
                        '. ( $msg['nowstate'] == 0 ? " " : '<a href="./system.php?link=reception&list=patient&slist=addtour&patient_id='.$msg['id'].'"> 添加行程信息 </a>'  ) .'
                        <a href="./system.php?link=reception&list=patient&slist=detailedpatient&patient_id='.$msg['id'].'"> 详细信息 </a>
                        '. ( $msg['nowstate'] == 0 ? " " : '<a href="./system.php?link=reception&list=patient&slist=patientleave&patient_id='.$msg['id'].'"> 办理出院 </a>'  ) .'
                        '. ( $msg['nowstate'] == 0 ? " " : '<a href="./system.php?link=reception&list=patient&slist=updpatient&patient_id='.$msg['id'].'"> 修改 </a>'  ) .'
                        <a href="./system.php?link=reception&list=patient&slist=delpatient&patient_id='.$msg['id'].'"> 删除 </a>
                      </td>
                </tr>
        '
        ;
      }
      
  }
  $num = GetPatientNum($utype,$sea);
  $num = mysql_fetch_row($num);
  $num = $num[0];
  $pnum = (int)(($num + $psize - 1) / $psize);
  echo ' 
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li '.( ($page==1) ? 'class="disabled"' : '' ).'>
                  <'.( ($page==1) ? 'span' : 'a' ).' href="system.php?list=patient&sea='.$sea.'&page='.($page-1).'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </'.( ($page==1) ? 'span' : 'a' ).'>
                </li>
                ';
                for($i=1;$i<=$pnum;++$i) echo '<li><a href="system.php?list=patient&sea='.$sea.'&page='.$i.'">'.$i.'</a></li>';
  echo '
                <li '.( ($page>=$pnum) ? 'class="disabled"' : '' ).'>
                  <'.( ($page>=$pnum) ? 'span' : 'a' ).' href="system.php?list=patient&sea='.$sea.'&page='.($page+1).'" aria-label="Next">
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
