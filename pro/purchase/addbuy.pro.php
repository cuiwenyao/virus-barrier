<?php
if( 
  !isset($_POST['mid']) || !isset($_POST['count']) || !isset($_POST['sid'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/purchase.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$mid = $_POST['mid'];
$count = $_POST['count'];
$sid = $_POST['sid'];

$res = AddBuy($utype,$mid,$count,$sid);
if($res == true) header("location:../../system/system.php?link=purchase&list=buylist");
else header("location:../../system/system.php");
