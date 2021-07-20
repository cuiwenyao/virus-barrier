<?php
if( 
  !isset($_POST['name']) || !isset($_POST['address']) || !isset($_POST['phonenumber']) || !isset($_POST['sid'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/purchase.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$address = $_POST['address'];
$phonenumber = $_POST['phonenumber'];
$sid = $_POST['sid'];

$res = UpdSupplier($utype,$sid,$name,$address,$phonenumber);
if($res == true) header("location:../../system/system.php?link=purchase&list=supplier");
else header("location:../../system/system.php");
