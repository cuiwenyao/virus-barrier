<?php
if( 
  !isset($_POST['pid']) || !isset($_POST['mid']) || !isset($_POST['count'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/nurse.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$pid = $_POST['pid'];
$mid = $_POST['mid'];
$count = $_POST['count'];

$res = UseMedicine($utype,$pid,$mid,$count);
if($res == true) header("location:../../system/system.php?link=nurse&list=medicine");
else header("location:../../system/system.php");
