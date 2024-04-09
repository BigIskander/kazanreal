<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
require_once("../W2U.php");
//
session_start();
$err=0;
if($_SESSION['autorized']!="ok")
{
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	if(!preg_match('//u', $user)) {	$user=cp1251_to_utf8($user); }
	if(!preg_match('//u', $pass)) {	$pass=cp1251_to_utf8($pass); }
	$user=addslashes($user);
	$pass=addslashes($pass);
	$sql="SELECT * FROM config WHERE pname='user' AND content='".$user."';";
	if($inf=mysql_query($sql)); else $err=1;
	$sql="SELECT * FROM config WHERE pname='pass' AND content='".md5($pass)."';";
	if($inf2=mysql_query($sql)); else $err=1;
	if($err==0)
		if(mysql_num_rows($inf)>0 && mysql_num_rows($inf2)>0)
		{
			$_SESSION['autorized']="ok";
			$user="ehf";
		} else $err=2;
	$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<info err="'.$err.'" />';
	header('Content-type: text/xml');
	echo($text);
	die();
}
//
$type=$_GET['type'];

$val=$_GET['val'];
$val2=$_GET['val2'];
$val=substr($_GET['val'], 0, 50);
$val2=substr($_GET['val2'], 0, 50);
if(!preg_match('//u', $val)) {	$val=cp1251_to_utf8($val); }
if(!preg_match('//u', $val2)) {	$val2=cp1251_to_utf8($val2); }
$val=addslashes($val);
$val2=addslashes($val2);
//
$err=0;
if($type!=NULL)
{
	switch($type)
	{
		case "user":
			if($val==NULL) $err=6;
			break;
		case "mail":
			if(!preg_match("/^[0-9A-z.]+@[0-9A-z]+\.[A-z]{2,4}$/i", $val)) $err=2;
			break;
		case "pass":
			if($val!=$val || strlen($val)<6) $err=3;
			else $val=md5($val);
			break;
		case "rsize":
			if($val!=0 && $val!=1) $err=4;
			break;
		default:
			$err=5;
	}
	if($err==0)
	{
		$sql="UPDATE config SET content='".$val."' WHERE pname='".addslashes($type)."';";
		if($inf=mysql_query($sql)); else $err=1;
	}
}
$sql="SELECT * FROM config";
if($err==0)
	if($inf=mysql_query($sql)); else $err=1;
$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<info err="'.$err.'"';
if($err==0)
{
	while($get=mysql_fetch_assoc($inf))
	{
		if($get['pname']!="pass")
			$text=$text." ".$get['pname']."='".addslashes($get['content'])."'";
	}
}
$text=$text.' />';
header('Content-type: text/xml');
echo($text);
?>