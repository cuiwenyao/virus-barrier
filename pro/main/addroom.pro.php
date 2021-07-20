<?php
if( 
	!isset($_POST['floor']) || !isset($_POST['number']) || !isset($_POST['nowstate']) 
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/main.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$floor = $_POST['floor'];
$number = $_POST['number'];
$nowstate = $_POST['nowstate'];
$res = AddRoom($utype,$floor,$number,$nowstate);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?list=room");
