<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
session_start();
$gal=$_SESSION['gal'];
$err=0;
if(!is_numeric($gal) && $gal!=NULL) $err=1;
if(!empty($file))
{
	if(is_uploaded_file($file))
	{
		if($err==0)
		{
			$name=$file_name;
			$af=strrpos($name, ".");
	   		$pr=substr($name, $af);
	   		$ok=strtolower($pr);
			if($ok==".jpg" || $ok==".jpeg")
			{
				$name=rand(000000, 999999).".jpg"; 
				while(is_file($_SERVER['DOCUMENT_ROOT']."/images/".$name))
				$name=rand(000000, 999999).".jpg";
				move_uploaded_file($file, $_SERVER['DOCUMENT_ROOT']."/images/".$name);
				if($gal!=0)
				{
					$sql="SELECT * FROM galery WHERE ID=".$gal.";";
					if($inf=mysql_query($sql)); else { $err=9; break; }
					if(mysql_num_rows($inf)==0) $gal=0;
				}
				if($err!=0) break;
				$ug=0;
				if($gal==0)
				{
					$ug=1;
					$sql="INSERT galery(ID, sort, name, cdate, udate, mimage, icols) VALUES(NULL, 0, NULL, NULL, NULL, 0, 0)";
					if(mysql_query($sql)); else { $err=9; break; }
					$sql="SELECT MAX(ID) AS ID FROM galery";
					if($inf=mysql_query($sql)); else { $err=11; break; }
					$get=mysql_fetch_assoc($inf);
					$gal=$get['ID'];
					$_SESSION['gal']=$gal;
				}
				if($err!=0) break;
				list($width, $height)=getimagesize($_SERVER['DOCUMENT_ROOT']."/images/".$name);
				$sql="INSERT images(ID, ID_gal, sort, image, cdate, title, rsize, width, height) VALUES(NULL, ".$gal.", 0, '".addslashes($name)."', NULL, NULL, (SELECT content FROM config WHERE pname='rsize'), ".$width.", ".$height.");";
				if(mysql_query($sql)); else { $err=11; break; }
				$sql="SELECT ID FROM images WHERE image='".addslashes($name)."'";
				if($inf=mysql_query($sql)); else { $err=9; break; }
				$get=mysql_fetch_assoc($inf);
				$sql="UPDATE images SET sort=ID WHERE ID=".$get['ID'].";";
				if($inf=mysql_query($sql)); else { $err=9; break; }
				$sql="UPDATE galery SET icols=(icols+1) WHERE ID=".$gal.";";
				if($inf=mysql_query($sql)); else { $err=9; break; }
				if($ug==1)
				{
					$sql="UPDATE galery SET mimage=".$get['ID'].", sort=ID WHERE ID=".$gal.";";
					if($inf=mysql_query($sql)); else { $err=11; break; }
				}
			} else $err=3;
		} else $err=2;
	} else $err=4;
if($err==2 || $err==3) unlink($_SERVER['DOCUMENT_ROOT']."/images/".$name);
switch($err)
{
	case 1:
		$text="  ";
		break;
	case 3:
		$text="  ";
		break;
	case 2:
		$text="  ";
		break;
	case 4:
		$text="   ";
		break;
	case 9:
		$text=" ";
		break;
	case 11:
		$text=" ,    ";
		break;
}
if($err!=0)
{
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<script>
function ld()
{
	alert("<?php echo($text); ?>");
<?php if($err==1 || $err==2) { ?>
	window.close();	
<?php } else {?>
	document.location.href=document.location;	
<?php } ?>
}
</script>
<body onLoad="ld()">
<?php
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<script>
function loaded()
{
	var file="<?php echo($file_name); ?>";
	var id="<?php echo($get['ID']); ?>";
	parent.loaded(file, id);
}
function upload() 
{
	if(parent==window) { alert("   !"); window.close(); return; }
	document.getElementById("form").submit();
	document.body.innerHTML='<font color="red" size="-3"> ... '+document.getElementById("file").value+'</font>'; 
} 
</script>
<body onLoad="loaded()">
<form action="upload.php"  enctype="multipart/form-data" method="post" id="form">
<input type="file" name="file" id="file" onChange="upload()"/>
</form>
</body>
<?php
} else {
$_SESSION['gal']=$_GET['gal'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<script> 
function upload() 
{
	if(parent==window) { alert("   !"); window.close(); return; }  
	document.getElementById("form").submit();
	document.body.innerHTML='<font color="red" size="-3"> ... '+document.getElementById("file").value+'</font>'; 
	document.body.bgcolor="red";
} 
</script>
<form action="upload.php"  enctype="multipart/form-data" method="post" id="form">
<input type="file" name="file" id="file" onChange="upload()"/>
</form>
<?php } ?>