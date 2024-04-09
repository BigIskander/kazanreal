<?php
Error_Reporting(E_ALL & ~E_NOTICE);
$type=$_GET['type'];
require_once("../config.php");
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$text='';
$title='';
switch($type)
{
	case "zoom":
		
		$gal=$_GET['gal'];
		$page=$_GET['page'];
		$s=$_GET['s'];
		if(!preg_match("/[0-9]/i", $gal) || $gal==NULL) die("ошибка");
		if(!preg_match("/[0-9]/i", $page) || $page==NULL) die("ошибка");
		if($s>4 || $s<1) die("ошибка");
		if($page<=0) $page=1;
		$sql="SELECT COUNT(*) AS col FROM images WHERE ID_gal=".addslashes($gal)." ORDER BY sort ASC;";
		$inf=mysql_query($sql) or die("ошибка БД");
		$get=mysql_fetch_assoc($inf);
		$col=$get['col']/4;
		if(((int)$col)!=$col) $col=((int)$col)+1;
		if($page>=$col) $page=$col;
		//
		$sql="SELECT * FROM galery WHERE ID=".addslashes($gal).";";
		$inf=mysql_query($sql) or die("ошибка БД");
		if(mysql_num_rows($inf)<1) die("нет таких данных");
		$get=mysql_fetch_assoc($inf);
		if($get['name']=="") $name="______"; else $name=$get['name'];
		$title=$name;
		$text=$text.'<div style="overflow: hidden; width: 975px; height: 25px; border:solid; border-color:#000000; border-width:1px; border-bottom-width:0; background-color:#CCFFFF;" align="left"><a href="'.$where.'html/">галереи</a> > <a href="'.$where.'html/?type=gal&gal='.$gal.'">'.$name.'</a></div>
<div style="overflow: hidden; width: 975px; height: 600px; border:solid; border-color:#000000; border-width:1px; background-color:#FFFFFF; overflow-y: scroll" align="center">';
		$sql="SELECT * FROM images WHERE ID_gal=".$gal." ORDER BY sort ASC LIMIT ".(($page-1)*4).", 4;";
		$inf=mysql_query($sql) or die("ошибка БД");
		if(mysql_num_rows($inf)<1) die("нет таких данных");
		$num=mysql_num_rows($inf);
		if($s>$num) echo("ошибка");
		$c=1;
		$image=""; $tx="<table><tr>";
		while($get=mysql_fetch_assoc($inf))
		{
			if($s==$c) 
			{ $image=$get['ID']; $tit=$get['title']; $width=$get['width']; $height=$get['height']; }
			$tx=$tx.'<td width="154" align="center"><div style="width: 150px; height: 150px;"><a href="'.$where.'html/?type=zoom&gal='.$gal.'&page='.$page.'&s='.$c.'"><img src="'.$where.'admin/145.php?id='.$get['ID'].'" border="0" alt="'.$get['title'].'" title="'.$get['title'].'" /></a></div></td>';
			$c=$c+1;
		}
		$tx=$tx."</tr></table>";
		$title=$title." -> ".$tit;
		//
		if($height>$width) 
		{
			$height=$height*(220/$width);	
			$width=220;
		} else {
			$width=$width*(400/$height);	
			$height=400;
		}
		$text=$text.'<table border="0"><tr bgcolor="#CCCCCC"><td colspan="3" height="405" width="405" valign="middle" align="center"><img id="image" src="'.$where.'admin/145.php?id='.$image.'&size=2" width="'.$width.'" height="'.$height.'" title="'.$title.'"></td></tr><tr bgcolor="#CCCCCC"><td colspan="3" height="20" align="left">'.$tit.'</td></tr><tr><td width="50" height="150" valign="top"><br>&nbsp;<br><a href="'.$where.'html/?type=zoom&gal='.$gal.'&page='.($page-1).'&s=1"><img src="../img/1.png" width="50" height="90" border="0"></a></td><td valign="top"><div style="overflow: hidden; width: 618px; height: 155px; border:solid; border-color:#CCCCCC; border-width:1px; background-color:#FFFFFF;" >'.$tx.'</div></td><td width="50" valign="top"><br>&nbsp;<br><a href="'.$where.'html/?type=zoom&gal='.$gal.'&page='.($page+1).'&s=1"><img src="../img/2.png" width="50" height="90" border="0"></a></td></tr></table></div>';
		break;
	case "gal":
		$gal=$_GET['gal'];
		if(!preg_match("/[0-9]/i", $gal) || $gal==NULL) die("ошибка");
		$sql="SELECT * FROM galery WHERE ID=".addslashes($gal).";";
		$inf=mysql_query($sql) or die("ошибка БД");
		if(mysql_num_rows($inf)<1) die("нет таких данных");
		$get=mysql_fetch_assoc($inf);
		if($get['name']=="") $name="______"; else $name=$get['name'];
		$text=$text.'<div style="overflow: hidden; width: 975px; height: 25px; border:solid; border-color:#000000; border-width:1px; border-bottom-width:0; background-color:#CCFFFF;" align="left"><a href="'.$where.'html/">галереи</a> > '.$name.'</div>
<div style="overflow: hidden; width: 975px; height: 600px; border:solid; border-color:#000000; border-width:1px; background-color:#FFFFFF; overflow-y: scroll" align="center">';
		$sql="SELECT * FROM images WHERE ID_gal=".$gal." ORDER BY sort ASC;";
		$inf=mysql_query($sql) or die("ошибка БД");
		if(mysql_num_rows($inf)<1) die("нет таких данных");
		$text=$text.'<table border="0">';
		$num=mysql_num_rows($inf);
		$trs=$num/6;
		if(((int)$trs)!=$trs) $trs=((int)$trs)+1;
		$i=0; $cn=0; $pg=1; $sh=1;
		while($get=mysql_fetch_assoc($inf))
		{
			if($i==6) $i=0;
			if($i==0) $text=$text."<tr>";
			if($sh==5) { $sh=1; $pg=$pg+1; }
			$text=$text.'<td width="154" height="182" >'."\n".'<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center"><a href="'.$where.'html/?type=zoom&gal='.$gal.'&page='.$pg.'&s='.$sh.'"><img src="'.$where.'admin/145.php?id='.$get['ID'].'" alt="'.$get['title'].'" title="'.$get['title'].'" border="0" /></a></div><div style="width: 150px; height: 20px;" align="left">'.$get['title'].'</div></div>'."\n".'</td>';
			if($i==5) $text=$text."</tr>";
			$i=$i+1; $cn=$cn+1; $sh=$sh+1;
		}
		for($j=$cn; $j<$trs*6; $j++) $text=$text.'<td width="154" height="182" >&nbsp;</td>';
		$text=$text.'</table></div>';
		break;
	default:
		$text=$text.'<div style="overflow: hidden; width: 975px; height: 25px; border:solid; border-color:#000000; border-width:1px; border-bottom-width:0; background-color:#CCFFFF;" align="left">галереи</div>
<div style="overflow: hidden; width: 975px; height: 600px; border:solid; border-color:#000000; border-width:1px; background-color:#FFFFFF; overflow-y: scroll" align="center">';
		$sql="SELECT * FROM galery ORDER BY sort ASC";
		$inf=mysql_query($sql) or die("ошибка БД");
		$text=$text.'<table border="0">';
		$num=mysql_num_rows($inf);
		$trs=$num/6;
		if(((int)$trs)!=$trs) $trs=((int)$trs)+1;
		$i=0; $cn=0;
		while($get=mysql_fetch_assoc($inf))
		{
			if($i==6) $i=0;
			if($i==0) $text=$text.'<tr>';
			$text=$text.'<td width="154" height="182" >'."\n".'<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center"><a href="'.$where.'html/?type=gal&gal='.$get['ID'].'" title="перейдти в галерею"><img src="'.$where.'/admin/145.php?id='.$get['mimage'].'" alt="'.$get['name'].'" title="'.$get['name'].'" border="0" /></a></div><div style="width: 150px; height: 20px;" align="left">'.$get['name'].'</div></div>'."\n".'</td>';
			if($i==5) $text=$text."</tr>";
			$i=$i+1; $cn=$cn+1;
		}
		for($j=$cn; $j<$trs*6; $j++) $text=$text.'<td width="154" height="182" >&nbsp;</td>';
		$text=$text.'</table></div>';
		break;
}
$text=$text.'<div style="overflow: hidden; width: 975px; height: 15px; border:solid; border-color:#000000; border-width:1px; border-top-width:0; background-color:#FFFFFF;" align="right"><font size="-5">Скрипт Фотогалереи © Султанов Искандер Рамилевич, декабрь 2010, 
&#66;&#105;&#103;&#73;&#115;&#107;&#97;&#110;&#100;&#101;&#114;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</font></div></div>'."\n".'</body>'."\n".'</html>'; 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
<!--
function color(id)
{
	document.getElementById("el_"+id).style.backgroundColor="#0066FF";
}
function decolor(id)
{
	document.getElementById("el_"+id).style.backgroundColor="";
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Казань -> <?php echo($title); ?></title>
</head>
<body onLoad="ld()" leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginheight="0" marginwidth="0" bgcolor="#CCFFFF">
<center>
<table width="1000" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr>
    <td height="150" colspan="3" valign="top"><img src="../img/60.jpg"></td>
    <td colspan="2" valign="top" background="../img/1234.jpg"><font size="+6" color="#FFFFFF"><b><i>KazanReal.ru</i></b></font><br>
	 <font size="+2" color="#FFFFFF">Сайт Фото и Видео Казани.</font></td>
    </tr>
  <tr>
    <td height="30" colspan="5" valign="top" bgcolor="#66CCFF">
	<table width="332" border="0">
      <tr>
        <td width="96" height="23" id="el_1" onMouseOver="color(1)" onMouseOut="decolor(1)"><a href="<?php echo($where); ?>"><font size="+1" color="#993300"><b><i>Главная</i></b></font></a></td>
        <td width="81" id="el_2" onMouseOver="color(2)" onMouseOut="decolor(2)"><a href="<?php echo($where); ?>video/"><font size="+1" color="#993300"><b><i>Видео</i></b></font></a></td>
        <td width="141" id="el_3" onMouseOver="color(3)" onMouseOut="decolor(3)"><a href="<?php echo($where); ?>about.php"><font size="+1" color="#993300"><b><i>О сайте</i></b></font></a></td>
      </tr>
    </table>	</td>
    </tr>
  <tr>
    <td height="664" colspan="5" valign="top" bgcolor="#CCFFFF">
      <center>
        <?php echo($text); ?>
      </center></td>
  </tr>
  <tr>
    <td width="3" height="13"></td>
    <td width="163"></td>
    <td width="101"></td>
    <td width="627"></td>
    <td width="106"></td>
  </tr>
  <tr>
    <td height="90"></td>
    <td></td>
    <td colspan="2" valign="top">
	<!-- здесь была реклама -->
	</td>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="17"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="81"></td>
    <td colspan="4" valign="top"><hr /><div align="center">
      <p>&copy; Султанов Искандер Рамилевич 2008-2011 </p>
      </div></td>
  </tr>
</table>
</center>
</body>