<?php
if( 
  !isset($_POST['room_id']) || !isset($_POST['nurse_id']) || !isset($_GET['patient_id'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/reception.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$room_id = $_POST['room_id'];
$nurse_id = $_POST['nurse_id'];
$patient_id = $_GET['patient_id'];

$res = AddLiving($utype,$patient_id,$room_id,$nurse_id);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?link=reception&list=patient");
