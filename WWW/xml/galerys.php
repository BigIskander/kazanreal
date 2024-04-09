<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
session_start();
//
$err=0;
if($_SESSION['autorized']!="ok") $err=99;
$sql="SELECT * FROM galery ORDER BY sort ASC;";
if($get=mysql_query($sql)); else $err=1;
$col=@mysql_num_rows($get);
//
$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<galerys cols="'.$col.'" err="'.$err.'">'."\n";
if(($err==0 || $err==99) && $col!=0)
{

	while($info=mysql_fetch_assoc($get))
	{
		$text.='<galery name="'.$info['name'].'" create="'.$info['cdate'].'" update="'.$info['udate'].'" mimage="'.$info['mimage'].'" icols="'.$info['icols'].'" ID="'.$info['ID'].'" />'."\n";
	}
}
$text.="</galerys>";
//
header('Content-type: text/xml');
echo($text);
?>