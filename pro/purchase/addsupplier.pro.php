<?php
if( 
  !isset($_POST['name']) || !isset($_POST['address']) || !isset($_POST['phonenumber'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/purchase.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$address = $_POST['address'];
$phonenumber = $_POST['phonenumber'];

$res = AddSupplier($utype,$name,$address,$phonenumber);
if($res == true) header("location:../../system/system.php?link=purchase&list=supplier");
else header("location:../../system/system.php");
