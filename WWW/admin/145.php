<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
//
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
session_start();
//��������� ������
$id=$_GET['id'];
$size=$_GET['size'];
if($size==NULL) $size=1;
if(!preg_match("/[0-9]/i", $id)) die();
if($size!=1 && $size!=2 && $size!=3) die();
if($_SESSION['autorized']!="ok" && $size==3) $size=2;

//������� ������ �� ����
$sql="SELECT image FROM images WHERE ID=".$id.";";
$inf=mysql_query($sql) or die(mysql_error());
$get=mysql_fetch_assoc($inf);
if(empty($get['image'])) die();
$filename="../images/".$get['image'];

//������� ��������
list($width, $height) = getimagesize($filename);
$wd=150;
$wd2=600;
switch($size)
{
case 1:
if($width>$height) $h=$width/$wd; else $h=$height/$wd;
$newwidth=$width/$h;
$newheight=$height/$h;
break;
case 2:
/*if($width>$height) $h=$width/$wd2; else $h=$height/$wd2;
$newwidth=$width/$h;
$newheight=$height/$h;*/
$newwidth=$width;
$newheight=$height;
break;
case 3:
$newwidth=$width;
$newheight=$height;
break;
}
//��������
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

//�������� �������
//$xp=$width-$x;
//$yp=$height-$y;
//$col=imagecolorexact($thumb, 255, 255, 255);
//imagefttext($source, 10, 0, $xp, $yp, $col, "arial.ttf", $text);

//��������� ��������
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

//����� �����������
if(!headers_sent()){
header("Content-type: image/jpg");
header("Content-Disposition: filename=".$id.".jpg");
}
imagejpeg($thumb) or die("145");
?>
