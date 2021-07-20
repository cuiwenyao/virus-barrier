<?php
require_once __DIR__."/../func/user.func.php";
RequestLogout();
header("location:../index.php");
