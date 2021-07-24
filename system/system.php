<?php
  require_once __DIR__."/../func/user.func.php";
  require_once __DIR__."/mod.php";
  $utype = GetNowUserType();          // 测试,当前用户组为Main
  if($utype==false) header("location:../index.php");
  $linkname = isset($_GET['link'])?$_GET['link']:$GLOBALS[$utype];     // 当前选中的link mod
  $listname = isset($_GET['list'])?$_GET['list']:"start";               // 当前选中的list mod
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Virus Barrier</title>

    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../dist/css/signin.css" rel="stylesheet">
    <link href="../dist/css/dashboard.css" rel="stylesheet">
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Virus Barrier</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"> <span class="glyphicon glyphicon-user"></span> 欢迎，<?php echo GetNowUserName();?></a></li>
            <li>
              <a href="#"> <span class="glyphicon glyphicon-calendar"></span> 
                <span id="current-time" > </span>
              </a>
            </li>
            <li><a href="./../pro/logout.php"> <span class="glyphicon glyphicon-log-out"></span> 退出登录</a></li>
            <li><a href="#"> <span class="glyphicon glyphicon-star"></span> 系统介绍</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-3 col-md-2 sidebar">
          <?php echo ((!InitLink($utype,$linkname,$listname))?"Error":""); ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo ((!InitList($utype,$linkname,$listname))?"Error":""); ?>
        </div>
      
      </div>
    </div>

    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../dist/js/jquery.min.js"></script>
    
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../dist/js/bootstrap.min.js"></script>
    
    <script src="../dist/js/current-time.js"></script>
  </body>
</html>