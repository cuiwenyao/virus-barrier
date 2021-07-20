<?php
require_once __DIR__."/sql.func.php";
require_once __DIR__."/../conf/group.conf.php";
session_start();

function IsLogin()
{
	return ( isset($_SESSION['uname']) && isset($_SESSION['utype']) && isset($GLOBALS[$_SESSION['utype']]) );
}

function GetNowUserType()
{
	if(!IsLogin()) return false;	
	return $_SESSION['utype'];
}
function GetNowUserTid()
{
	if(!IsLogin()) return false;	
	if(!isset($_SESSION['tid'])) return false;
	return $_SESSION['tid'];
}
function GetNowUserName()
{
	if(!IsLogin()) return false;	
	if(!isset($_SESSION['tid']) || $_SESSION['tid']==0) return "工作人员";
	$tid = $_SESSION['tid']; $sql = "select name from ".SQL_TABPRE."_".$GLOBALS[GetNowUserType()]." where id = ".$tid;
	$res = mysql_fetch_assoc( SqlQuery($sql) );
	return $res['name'];
}


function ExistedUname($uname)
{
	$sql = "select count(*) from ".SQL_TABPRE."_group where uname = '".$uname."'";
	$res = SqlQuery($sql);
	$res = mysql_fetch_row($res);
	return ($res[0]>0);
}
function ExistedTid($uty,$tid)
{
	$sql = "select count(*) from ".SQL_TABPRE."_group where utype=".$uty." and tid = ".$tid;
	$res = SqlQuery($sql);
	$res = mysql_fetch_row($res);
	return ($res[0]>0);
}
function GetUname($uty,$tid)
{
	if( !ExistedTid($uty,$tid) ) return false;
	$sql = "select uname from ".SQL_TABPRE."_group where utype=".$uty." and tid = ".$tid;
	$res = SqlQuery($sql);
	$res = mysql_fetch_row($res);
	return $res[0];
}
function AssignGid($uty,$uname,$pword,$tid)
{
	if(ExistedUname($uname) || ExistedTid($uty,$tid)) return false;
	$sql = "insert into ".SQL_TABPRE."_group values (null,'".$uname."',md5('".$pword."'),now(),'---','".$uty."','".$tid."')";
	return SqlQuery($sql);
}
function UpdateGid($uty,$uname,$pword,$tid)
{
	if(!ExistedUname($uname) || !ExistedTid($uty,$tid)) return false;
	$sql = "update ".SQL_TABPRE."_group set uname = '".$uname."', pword = md5('".$pword."') where utype=".$uty." and tid = ".$tid;
	return SqlQuery($sql);
}

function RequestLogout()
{
	if(!IsLogin) return false;
	unset($_SESSION['uname']);
	unset($_SESSION['utype']);
	unset($_SESSION['uid']);
	return true;
}

function GET_IP()
{
    $ip=FALSE;
    //客户端IP 或 NONE 
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    //客户端IP 或 (最后一个)代理服务器 IP 
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

function RequestLogin($uname,$pword)
{
	$sql = "select * from ".SQL_TABPRE."_group where uname='".$uname."' and pword=md5('".$pword."')";
	$res = SqlQuery($sql);
	if(!isset($res)) return false;
	$num = mysql_num_rows($res);
	if($num==1)
	{
		$msg = mysql_fetch_assoc($res);
		$_SESSION['tid'] = 0;
		if($GLOBALS[ $msg['utype'] ] == "doctor" || $GLOBALS[ $msg['utype'] ] == "nurse" || $GLOBALS[ $msg['utype'] ] == "cleaner"  )
		{
			$tid = $msg['tid'];
			$sql = "select * from ".SQL_TABPRE."_".$GLOBALS[ $msg['utype'] ]." where id = ".$tid;
			$res = SqlQuery($sql); if( mysql_num_rows( $res ) != 1 ) return false;
			$_SESSION['tid']  = $msg['tid'];
		}
		$_SESSION['uname'] = $msg['uname'];
		$_SESSION['utype'] = $msg['utype'];
		$_SESSION['uid']   = $msg['id'];
		$updsql = "update ".SQL_TABPRE."_group set logintime=now() , loginip='".GET_IP()."' where uname='".$uname."'";
		SqlQuery($updsql);
		return true;
	} else return false;
}

