<?php
require __DIR__."/../func/user.func.php";
if(!isset($_POST['uname']) || !isset($_POST['pword'])) header("location:../index.php");
$uname = $_POST['uname'];
$pword = $_POST['pword'];
$res = RequestLogin($uname,$pword);
if($res) header("location:../system/"); else header("location:../index.php");



