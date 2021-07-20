<?php
if( 
  !isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['age']) ||
  !isset($_POST['homeaddress']) || !isset($_POST['phonenumber']) ||
  !isset($_POST['sex']) || !isset($_POST['nowstate']) 
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/reception.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$homeaddress = $_POST['homeaddress'];
$phonenumber = $_POST['phonenumber'];
$nowstate = $_POST['nowstate'];

$photo = UploadFile($_FILES['photo']);
$res = UpdPatient($utype,$_GET['patient_id'],$name,$sex,$age,$homeaddress,$phonenumber,$nowstate,$photo);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?list=patient");
