<?php
if( 
  !isset($_POST['name']) || !isset($_POST['relation']) || !isset($_POST['phonenumber']) || !isset($_GET['patient_id'])
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/reception.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$relation = $_POST['relation'];
$phonenumber = $_POST['phonenumber'];
$patient_id = $_GET['patient_id'];

$res = AddFamily($utype,$patient_id,$name,$relation,$phonenumber);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?link=reception&list=patient");
