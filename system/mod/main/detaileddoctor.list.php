<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function detaileddoctorListOut($utype,$did)
{
	$USER_TYPE = 100;            //模块用户权限
	$ListTitle = "医生详细信息";		 //模块标题

	if($utype!=$USER_TYPE) return false;
	require_once __DIR__."/../../../func/main.mod.func.php";
 	$res = GetDoctorMsg($utype,$did);
 	if($res==false) return false;
	$res = mysql_fetch_assoc($res);
  echo
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <div class="well well-lg" >
      <div class="row">
        <div class="col-xs-4 col-md-2">
            <img class="img-thumbnail" style="width:100%;height:auto;" src="../../../upload/'.$res['photo'].'" alt="照片">
        </div>
        <div class="col-xs-8 col-md-10" >
          <dl class="dl-vertical" style="font-size:15px;letter-spacing:2px;">
              <dt>姓名:'.$res['name'].'</dt> <dd></dd>
              <dt>性别:'.$res['sex'].'</dt> <dd></dd>
              <dt>年龄:'.$res['age'].'</dt> <dd></dd>
              <dt>家庭住址:'.$res['homeaddress'].'</dt> <dd></dd>
              <dt>联系方式:'.$res['phonenumber'].'</dt> <dd></dd>
              <dt>专业:'.$res['special'].'</dt> <dd></dd>
              <dt>职位:'.$res['position'].'</dt> <dd></dd>
              <dt>加入日期:'.$res['joindate'].'</dt> <dd></dd>
              <dt>工作评价:</dt> 
              <dd>
                <blockquote>
                  <p>'.$res['workcomment'].'</p>
                </blockquote>
              </dd>
              <dt>简介:</dt> 
              <dd>
                <blockquote>
                  <p>'.$res['profile'].'</p>
                </blockquote> 
              </dd>
          </dl>
        </div>

      </div> 
      
    </div>
    <a href="system.php?list=doctor" class="btn btn-primary" > 返回 </a>
    
  ';
	return true;
}
