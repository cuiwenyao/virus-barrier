<?php
function InitLink($utype,$linkname,$listname)
{
	$filename = './mod/'.$linkname.'/'.$linkname.'.link.php';
	if(!file_exists($filename)) return false;
	require $filename;
	$funcname = $linkname.'LinkOut';
	if(!function_exists($funcname)) return false;
	return $funcname($utype,$listname);
}
function InitList($utype,$linkname,$listname)
{
	$filename = './mod/'.$linkname.'/'.$listname.'.list.php';
	if(!file_exists($filename)) return false;
	require $filename;
	$funcname = $listname.'ListOut';
	if(!function_exists($funcname)) return false;
	return $funcname($utype,$listname);
}


