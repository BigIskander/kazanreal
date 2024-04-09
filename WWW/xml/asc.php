<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$err=0;
$gal=0;
$id=0;
$link=$_GET['link'];
$find=strpos($link, "#");
$link=substr($link, $find+1);
$array=explode("|", $link);
$count=count($array);
$gname="______";
if($count==0) $err=99;
if($count==1 || $count==2)
{
	(int) $array[0];
	(int) $array[1];
	if($array[0]<=0) $err=2;
	if($err==0)
	{
		$sql="SELECT * FROM galery WHERE ID=".addslashes($array[0]).";";
		if($inf=mysql_query($sql)) { 
			$num=@mysql_num_rows($inf);
			$get=mysql_fetch_assoc($inf);
		} else $err=1;
		if($num==0) $err=3;
		if($err==0 && $num>0)
		{
			$gal=$get['ID'];
			$gname=$get['name'];
			if($array[1]!=0)
			{
				$sql="SELECT * FROM images WHERE ID_gal=".addslashes($gal)." AND ID=".addslashes($array[1]).";";
				if($inf=mysql_query($sql)) { 
					$num=@mysql_num_rows($inf);
					$get=mysql_fetch_assoc($inf);
					if($num>0) $id=$get['ID'];
				} else $err=3;
			}
		}
	}
} else $err=2;
$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<ask err="'.$err.'" gal="'.$gal.'" id="'.$id.'" gname="'.$gname.'" />'."\n";
//
header('Content-type: text/xml');
echo($text);
?>