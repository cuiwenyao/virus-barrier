<?php
if( 
	!isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['age']) ||
	!isset($_POST['homeaddress']) || !isset($_POST['phonenumber']) || !isset($_POST['special']) ||
	!isset($_POST['sex']) || !isset($_POST['workcomment']) || !isset($_POST['profile']) 
 )  header("location:../../system/system.php");

require_once __DIR__."/../../func/main.mod.func.php";
require_once __DIR__."/../../func/user.func.php";
require_once __DIR__."/../../func/upload.func.php";

$utype = GetNowUserType();
$name = $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$homeaddress = $_POST['homeaddress'];
$phonenumber = $_POST['phonenumber'];
$special = $_POST['special'];
$position = $_POST['position'];
$workcomment = $_POST['workcomment'];
$profile = $_POST['profile'];
$photo = UploadFile($_FILES['photo']);
if(!$photo) header("location:../../system/system.php");
$res = AddDoctor($utype,$name,$sex,$age,$homeaddress,$phonenumber,$special,$position,$workcomment,$profile,$photo);
if($res == false) header("location:../../system/system.php");
else header("location:../../system/system.php?list=doctor");
