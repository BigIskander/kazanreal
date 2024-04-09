<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
session_start();
//
$err=0;
$col=0;
$gal=$_GET['gal'];
if($_SESSION['autorized']!="ok") $err=99;
if(!preg_match("/[0-9]/i", $gal) && $gal==NULL) $err=2;
if($err==0 || $err==99)
{
	$sql="SELECT * FROM galery WHERE ID=".$gal.";";
	if($get=mysql_query($sql)); else $err=1;
	if($err==0 || $err==99)
	{
		if(@mysql_num_rows($get)>0)
		{ 
			$sql="SELECT * FROM images WHERE ID_gal=".$gal." ORDER BY sort ASC;";
			if($get=mysql_query($sql)) $cols=@mysql_num_rows($get); else $err=1;
		} else $err=3;
	}
}
//
$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<images cols="'.$cols.'" err="'.$err.'">'."\n";
if($err==0 || $err==99)
{
	$col=@mysql_num_rows($get);
	//
	if($col!=0)
	{
		while($info=mysql_fetch_assoc($get))
		{
			$text.='<image image="'.$info['ID'].'" create="'.$info['cdate'].'" title="'.$info['title'].'" rsize="'.$info['rsize'].'" width="'.$info['width'].'" height="'.$info['height'].'" />'."\n";
		}
	}
}
$text.="</images>";
//
header('Content-type: text/xml');
echo($text);
?>