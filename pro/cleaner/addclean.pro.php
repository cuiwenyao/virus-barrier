<?php
if( 
  !isset($_POST['rid'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/cleaner.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$rid = $_POST['rid'];

$res = AddClean($utype,$rid);
if($res == true) header("location:../../system/system.php?link=cleaner&list=clean");
else header("location:../../system/system.php");
