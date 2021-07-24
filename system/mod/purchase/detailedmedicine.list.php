<?php
/*
  List模块规范：
  函数名：(模块名)ListOut($utype);
  1、在开头声明模块参数（用户权限、模块标题等）
  2、进行用户权限检查，非法返回false，函数末尾返回true
*/
function detailedmedicineListOut($utype,$mid)
{
  $USER_TYPE = 4;            //模块用户权限
  $ListTitle = "药物详细信息";     //模块标题

  if($utype!=$USER_TYPE) return false;
  require_once __DIR__."/../../../func/purchase.mod.func.php";
  $res = GetMedicineMsg($utype,$mid);
  if($res==false) return false;
  $res = mysql_fetch_assoc($res);
  echo
  '
    <h1 class="page-header">'.$ListTitle.'</h1>
    <div class="well well-lg" >
      <div class="row">
        <div class="col-xs-8 col-md-10" >
          <dl class="dl-vertical" style="font-size:15px;letter-spacing:2px;">
              <dt>药物名称:'.$res['name'].'</dt> <dd></dd>
              <dt>药物库存:'.$res['count'].'</dt> <dd></dd>
              <dt>药物价格:'.$res['price'].'</dt> <dd></dd>
              <dt>药物介绍:</dt> 
              <dd>
                <blockquote>
                  <p>'.$res['profile'].'</p>
                </blockquote>
              </dd>
          </dl>
        </div>

      </div> 
      
    </div>
    <a href="system.php?list=medicine" class="btn btn-primary" > 返回 </a>
    
  ';
  return true;
}
