<?php
if( 
	!isset($_POST['pword']) || !isset($_POST['uname']) || !isset($_POST['uty']) ||
	!isset($_POST['tid']) 
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/main.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$uty = $_POST['uty'];
$uname = $_POST['uname'];
$pword = $_POST['pword'];
$tid = $_POST['tid'];
$res = UpdateGid($uty,$uname,$pword,$tid);
if($res==true) header("location:../../system/system.php?list=".$GLOBALS[$uty]);
else header("location:../../system/system.php");
