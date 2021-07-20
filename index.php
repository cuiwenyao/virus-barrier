<?php
  require_once __DIR__."/func/user.func.php";
  if(IsLogin()) header("location:./system/");
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
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="./dist/css/cover.css" rel="stylesheet">
    <link href="./dist/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">


          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Virus Barrier</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="">登录</a></li>
                  <li><a target="_blank" href="https://voice.baidu.com/act/newpneumonia/newpneumonia/?from=osari_aladin_banner">疫情动态</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
              <form class="form-signin" action="./pro/login.php" method="POST">
                <h2 class="form-signin-heading">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </h2>
                <br>
                <label class="sr-only">用户名</label>
                <input name="uname" type="username" id="username" class="form-control" placeholder="用户名" required autofocus>
                <br>
                <label class="sr-only">密码</label>
                <input name="pword" type="password" id="password" class="form-control" placeholder="密码" required>
                <br>
                <button class="btn btn-lg btn-default"  type="submit">
                  <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                </button>
              </form>
          </div>
          

          <div class="mastfoot">
            <div class="inner">
              <p>万众齐心，共同战役</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="./dist/js/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="./dist/js/bootstrap.min.js"></script>
  </body>
</html>