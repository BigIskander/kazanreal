<?php Error_Reporting(E_ALL & ~E_NOTICE);
require_once("config.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KazanReal.ru - сайт фото и видео казани</title>
<script src="js/galery.js"></script>
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
<body onLoad="ask()" leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginheight="0" marginwidth="0" bgcolor="#CCFFFF">
<center>
<table width="1000" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr>
    <td height="150" colspan="3" valign="top"><img src="img/60.jpg"></td>
    <td colspan="2" valign="top" background="img/1234.jpg"><font size="+6" color="#FFFFFF"><b><i>KazanReal.ru</i></b></font><br>
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
	  <div style="overflow: hidden; width: 800px; height: 650px; border:solid; border-color:#000000; border-width:1px; background-color:#FFFFFF; overflow-y: scroll" id="galeryes" align="left">
	  <h2>О сайте!</h2>
	  <p>Этот сайт посвящен Казани, здесь представлены виды Казани в фото и видео. При создании сайта я использовал записи из моей личной коллекции. Надеюсь вам понравился мой сайт. Связатся со мной вы можете по E-mail: <a href="mailto:
&#66;&#105;&#103;&#73;&#115;&#107;&#97;&#110;&#100;&#101;&#114;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">&#66;&#105;&#103;&#73;&#115;&#107;&#97;&#110;&#100;&#101;&#114;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</a> или написав в форму ниже. Буду рад узнать ваше мнение о сайте...</p>
	  <p align="right">Султанов Искандер</p>
	  </div>
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