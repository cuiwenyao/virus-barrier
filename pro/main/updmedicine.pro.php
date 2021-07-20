<?php
if( 
	!isset($_POST['name']) || !isset($_POST['count']) || !isset($_POST['price'])  || !isset($_POST['profile'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/main.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$count = $_POST['count'];
$price = $_POST['price'];
$profile = $_POST['profile'];

$res = UpdMedicine($utype,$_GET['medicine_id'],$name,$count,$price,$profile);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?list=medicine");
