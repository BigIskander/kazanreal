<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
session_start();
require_once("W2U.php");
if($_SESSION['autorized']!="ok") {
	$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<info err="99" statys="0"/>';
	header('Content-type: text/xml');
	echo($text);
	die();
}
//
$err=0;
$stat=0;
$id=$_GET['id'];
$before=$_GET['before'];
$type=$_GET['type'];
$name=$_GET['name'];
if(!preg_match("/[0-9]/i", $id) && $id==NULL) { $err=2; $type=""; }
if(!preg_match("/[0-9]/i", $before) && $before!=NULL) { $err=2; $type=""; }
if(!preg_match('//u', $name)) {	$name=cp1251_to_utf8($name); }
$name=addslashes(substr($name, 0, 255));
if($before==NULL) $before=0;
switch($type)
{
	case "galeryDel":
		$sql="SELECT * FROM images WHERE ID_gal=".$id." ORDER BY sort ASC;";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		while($get=@mysql_fetch_assoc($inf))
		{
			if(!@unlink($_SERVER['DOCUMENT_ROOT']."/images/".$get['image']))
			{ 
				$err=6;
				$sql="DELETE FROM images WHERE ID_gal=".$id." AND sort<".$get['sort'].";";
				if(!mysql_query($sql)) $err=7; 
				break; 
			}
		}
		if($err==0)
		{
			$sql="DELETE FROM images WHERE ID_gal=".$id.";";
			if(!mysql_query($sql)) { $err=7; break; }
			$sql="DELETE FROM galery WHERE ID=".$id.";";
			if(!mysql_query($sql)) { $err=7; break; }
		} 
		break;
	case "imageDel":
		$sql="SELECT ID FROM galery WHERE mimage=".$id." LIMIT 1;";
		if($gid=mysql_query($sql)); else { $err=1; break; }
		$ch=@mysql_num_rows($gid);
		$sql="SELECT * FROM images WHERE ID=".$id.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		if($get=@mysql_fetch_assoc($inf))
		{
			if(!@unlink($_SERVER['DOCUMENT_ROOT']."/images/".$get['image']))
			{ 
				$err=6; 
				break; 
			}
			$sql="SELECT ID_gal FROM images WHERE ID=".$id.";";
			if($gid=mysql_query($sql)); else { $err=1; break; }
			$get=@mysql_fetch_assoc($gid);
			$gal=$get['ID_gal'];
			$sql="DELETE FROM images WHERE ID=".$id.";";
			if(!mysql_query($sql)) $err=7;
			$get=mysql_fetch_assoc($gid);
			if($ch>0)
			{	
				$sql="SELECT ID FROM images WHERE ID_gal=".$gal." ORDER BY sort ASC LIMIT 1;";
				if($inf=mysql_query($sql)); else { $err=7; break; }
				if($get=@mysql_fetch_assoc($inf))
				{
					$lsql="UPDATE galery SET mimage=".$get['ID']." WHERE ID=".$gal.";";
					if(!mysql_query($lsql)) { $err=7; break; }
				} else {
					$sql="DELETE FROM galery WHERE ID=".$gal.";";
					if(!mysql_query($sql)) { $err=7; break; }
					$stat=1;
				}
			}
			$sql="UPDATE galery SET icols=(icols-1) WHERE ID=".$gal.";";
			if(!mysql_query($sql)) { $err=7; break; }
		}
		break;
	case "mimage":
		if($before==0) { $err=2; break; }
		$sql="SELECT * FROM images WHERE ID=".$before." AND ID_gal=".$id.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		if(mysql_num_rows($inf)>0)
		{
			$sql="UPDATE galery SET mimage=".$before." WHERE ID=".$id.";";
			if(!mysql_query($sql)) { $err=1; break; }
		}
		break;
	case "updateName":
		$sql="UPDATE galery SET name='".$name."' WHERE ID=".$id.";";
		if(mysql_query($sql)); else { $err=1; break; }
		break;
	case "updateTitle":
		$sql="UPDATE images SET title='".$name."' WHERE ID=".$id.";";
		if(mysql_query($sql)); else { $err=1; break; }
		break;
	case "rSize":
		$sql="UPDATE images SET rsize=".$before." WHERE ID=".$id.";";
		if(mysql_query($sql)); else { $err=1; break; }
		break;
	case "setGal":
		$sql="SELECT * FROM galery WHERE ID=".$before.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		if($get=@mysql_fetch_assoc($inf))
		{
			$col=$get['icols'];
			$sql="SELECT ID, icols, mimage FROM galery WHERE ID=(SELECT ID_gal FROM images WHERE ID=".$id.");";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get=mysql_fetch_assoc($inf);
			$icols=$get['icols'];
			$gal=$get['ID'];
			$mimage=$get['mimage'];
			if($gal==$before) break;
			$sql="SELECT MAX(sort) AS maxi FROM images WHERE ID_gal=".$before.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get=mysql_fetch_assoc($inf);
			$sql="UPDATE images SET sort=".($get['maxi']+1).", ID_gal=".$before." WHERE ID=".$id.";";
			if(mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE galery SET icols=".($col+1)." WHERE ID=".$before.";";
			if(mysql_query($sql)); else { $err=7; break; }
			if($icols<=1)
			{
				$sql="DELETE FROM galery WHERE ID=".$gal.";";
				if(mysql_query($sql)); else { $err=7; break; }
				$stat=1;
			} else {
				if($mimage==$id)
				{
					$sql="UPDATE galery GL SET mimage=(SELECT ID FROM images IM WHERE IM.ID_gal=GL.ID ORDER BY sort ASC LIMIT 1) WHERE ID=".$gal.";";
					if(mysql_query($sql)); else { $err=88; break; }
				}
				$sql="UPDATE galery SET icols=".($col-1)." WHERE ID=".$gal.";";
				if(mysql_query($sql)); else { $err=7; break; }
			}
		}
		break;
	case "moveGalery":
		if($id==$before) break;
		if($before==0)
		{
			$sql="SELECT max(sort) AS sort FROM galery";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get=mysql_fetch_assoc($inf);
			$sql="UPDATE galery SET sort=(sort-1)";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE galery SET sort=".$get['sort']." WHERE ID=".$id.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			break;
		}
		$s_1=$id; $s_2=$before;
		$sql="SELECT ID, sort FROM galery WHERE ID=".$s_1.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		$get_1=@mysql_fetch_assoc($inf);
		$sql="SELECT ID, sort FROM galery WHERE ID=".$s_2.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		$get_2=@mysql_fetch_assoc($inf);
		if($get_1['sort']>$get_2['sort'])
		{
			$sql="UPDATE galery SET sort=(sort+1) WHERE sort<=".$get_1['sort']." AND sort>=".$get_2['sort'].";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE galery SET sort=".$get_2['sort']." WHERE ID=".$s_1.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
		} else {
			$sql="SELECT MAX(sort) AS sort FROM galery WHERE sort<".$get_2['sort'].";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get_2=mysql_fetch_assoc($inf);
			$sql="UPDATE galery SET sort=(sort-1) WHERE sort<=".$get_2['sort']." AND sort>=".$get_1['sort'].";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE galery SET sort=".$get_2['sort']." WHERE ID=".$s_1.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }		
		}
		break;
	case "moveImage":
		if($id==$before) break;
		$sql="SELECT ID_gal FROM images WHERE ID=".$id.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		$get=mysql_fetch_assoc($inf);
		$gal=$get['ID_gal'];
		if($before==0)
		{
			$sql="SELECT max(sort) AS sort FROM images WHERE ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get=mysql_fetch_assoc($inf);
			$sql="UPDATE images SET sort=(sort-1) WHERE ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE images SET sort=".$get['sort']." WHERE ID=".$id." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			break;
		}
		$s_1=$id; $s_2=$before;
		$sql="SELECT ID, sort FROM images WHERE ID=".$s_1." AND ID_gal=".$gal.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		$get_1=@mysql_fetch_assoc($inf);
		$sql="SELECT ID, sort FROM images WHERE ID=".$s_2." AND ID_gal=".$gal.";";
		if($inf=mysql_query($sql)); else { $err=1; break; }
		$get_2=@mysql_fetch_assoc($inf);
		if($get_1['sort']>$get_2['sort'])
		{
			$sql="UPDATE images SET sort=(sort+1) WHERE sort<=".$get_1['sort']." AND sort>=".$get_2['sort']." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE images SET sort=".$get_2['sort']." WHERE ID=".$s_1." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
		} else {
			$sql="SELECT MAX(sort) AS sort FROM images WHERE sort<".$get_2['sort']." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$get_2=mysql_fetch_assoc($inf);
			$sql="UPDATE images SET sort=(sort-1) WHERE sort<=".$get_2['sort']." AND sort>=".$get_1['sort']." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }
			$sql="UPDATE images SET sort=".$get_2['sort']." WHERE ID=".$s_1." AND ID_gal=".$gal.";";
			if($inf=mysql_query($sql)); else { $err=1; break; }		
		}
		break;
}
$text='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<info err="'.$err.'" statys="'.$stat.'"/>';
header('Content-type: text/xml');
echo($text);
?>