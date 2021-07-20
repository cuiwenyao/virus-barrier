<?php
if( 
  !isset($_POST['pid']) || !isset($_POST['res'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/doctor.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$pid = $_POST['pid'];
$result = $_POST['res'];

$res = AddTest($utype,$pid,$result);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?link=doctor&list=test");
