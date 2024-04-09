<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
session_start();
if($_GET['out']=="ok") $_SESSION['autorized']="";
if($_SESSION['autorized']=="ok")
{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
<!--
var s=0;
var enow;
var xmlhttp=parent.getXmlHttp();
function query(text)
{
	var q;
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	if(!text) q="config/info.php?"+sec;
	else q="config/info.php"+text+"&"+sec;
	xmlhttp.open('GET', q, true);
	xmlhttp.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp.onreadystatechange=params;
	xmlhttp.send(null);
}
//
function error()
{
	var text;
	switch(parseInt(err))
	{
		case 1:
			text="ошибка БД";
			break;
		case 2:
			text="Неверный формат!";
			break;
		case 3:
			text="не совпадает повтор или длина меньше 6";
			break;
		case 4:
		case 5:
			text="ошибка";
			break;
		case 9:
			text="ошибка загрузки";
			break;
		case 6:
			text="недопустимо пустое значение";
			break;
	}
	document.getElementById("info").innerHTML=text;
}
var err, user, mail, rsize, pass;
function params()
{
	if (xmlhttp.readyState == 4) {
    	if(xmlhttp.status == 200) {
			elements=xmlhttp.responseXML;
			err=elements.getElementsByTagName("info").item(0).attributes[0].value;
			if(err!=0) { error(); return; }
			document.getElementById("info").innerHTML="";
			user=elements.getElementsByTagName("info").item(0).attributes[1].value;
			mail=elements.getElementsByTagName("info").item(0).attributes[2].value;
			rsize=elements.getElementsByTagName("info").item(0).attributes[3].value;
			pass="******";
			point();
       	} else {
			err=9;
			error();
			return;
		}
  	}
}
function point()
{
	document.getElementById("user").innerHTML='<i onclick="upd('+"'user'"+')">'+user+'</i>';
	document.getElementById("mail").innerHTML='<i onclick="upd('+"'mail'"+')">'+mail+'</i>';
	document.getElementById("pass").innerHTML='<i onclick="upd('+"'pass'"+')">'+pass+'</i>';
	document.getElementById("rpass").innerHTML='';
	if(rsize==1) val='<input type="checkbox" checked="checked" onclick="upd('+"'rsize'"+')" />';
	else val='<input type="checkbox" onclick="upd('+"'rsize'"+')" />';
	document.getElementById("rsize").innerHTML=val;
	document.getElementById("cancel").innerHTML='';
	document.getElementById("save").innerHTML='';
	document.getElementById("info").innerHTML='';
}
//
function lod()
{
	if(parent==window) { alert("Отдельный запуск не предусмотрен!"); window.close(); return; }
	query();
}
function upd(what)
{
	enow=what;
	document.getElementById("user").innerHTML='<i>'+user+'</i>';
	document.getElementById("mail").innerHTML='<i>'+mail+'</i>';
	document.getElementById("pass").innerHTML='<i>'+pass+'</i>';
	document.getElementById("rpass").innerHTML='';
	if(what!="rsize") document.getElementById("rsize").innerHTML='';
	document.getElementById("cancel").innerHTML='<a href="JavaScript:point()">Отмена!</a>';
	document.getElementById("save").innerHTML='<a href="JavaScript:save()">Сохранить!</a>';
	switch(what)
	{
		case "user":
			document.getElementById(what).innerHTML='<input type="text" id="user_form" value="'+user+'" />';
			break;
		case "mail":
			document.getElementById(what).innerHTML='<input type="text" id="mail_form" value="'+mail+'" />';
			break;
		case "pass":
			document.getElementById(what).innerHTML='<input type="password" id="'+what+'_form" />';
			document.getElementById("r"+what).innerHTML='<input type="password" id="r'+what+'_form" />';
			break;
		case "rsize":
			document.getElementById("cancel").innerHTML='';
			document.getElementById("save").innerHTML='';
			if(rsize==1) query("?type=rsize&val=0");
			else query("?type=rsize&val=1");
			break;
	}
}
function save()
{
	var val=document.getElementById(enow+'_form').value;
	if(enow!="pass")
	{
		var text="?type="+enow+"&val="+encodeURIComponent(val);
		query(text);
	} else {
		var val2=document.getElementById('r'+enow+'_form').value;
		var text="?type="+enow+"&val="+encodeURIComponent(val)+"&val2="+encodeURIComponent(val);
		query(text);
	}
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onload="lod()">
<table width="337" border="0">
  <tr>
    <td height="37" colspan="2" valign="top">Настройки!<br/>
	<font color="#FF0000" size="-3" id="info"></font>
    </td>
  </tr>
  <tr>
    <td width="152" height="28">Пользователь:</td>
    <td width="175" id="user">&nbsp;</td>
  </tr>
  <tr>
    <td height="28">E-mail:</td>
    <td id="mail">&nbsp;</td>
</tr>
<tr>
    <td height="25">Реальный размер: </td>
    <td id="rsize">&nbsp;
      
	</td>
  </tr>
  <tr>
    <td height="28">Пароль:</td>
    <td id="pass">&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td id="rpass">&nbsp;</td>
  </tr>
    <tr>
    <td height="20" id="cancel">&nbsp;</td>
    <td id="save">&nbsp;</td>
  </tr>
    <tr>
    <td height="38" valign="bottom" align="left">&nbsp;</td>
	<td height="38" valign="bottom" align="right"><a href="?out=ok" onclick="JavaScript:parent.error(99)">Выход!</a></td>
  </tr>
</table>
</body>
</html>
<?php } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
var xmlhttp=parent.getXmlHttp();
var err;
function query()
{
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	var q="config/info.php?"+sec;
	xmlhttp.open('POST', q, true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	var user=document.getElementById("user").value;
	var pass=document.getElementById("pass").value;
	xmlhttp.onreadystatechange=ok;
	q="user="+encodeURIComponent(user)+"&pass="+encodeURIComponent(pass);
	xmlhttp.send(q);
}
function ok()
{
	if (xmlhttp.readyState == 4) {
    	if(xmlhttp.status == 200) {
			elements=xmlhttp.responseXML;
			err=elements.getElementsByTagName("info").item(0).attributes[0].value;
			if(err!=0) { error(); return; }
			parent.read();
			setTimeout("document.location.href=document.location", 150);
       	} else {
			err=9;
			error();
			return;
		}
	}
}
function error()
{
	var text;
	switch(parseInt(err))
	{
		case 1:
			text="ошибка БД";
			break;
		case 2:
			text="нет пользователя с таким логином и паролем";
			break;
		case 9:
			text="ошибка загрузки";
			break;
	}
	document.getElementById("info").innerHTML=text;
}
function ld()
{
	if(parent==window) { alert("Отдельный запуск не предусмотрен!"); window.close(); return; }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onload="ld()">
<table width="297" border="0">
  <tr>
    <td width="113" height="49" valign="top" colspan="2">Авторизация!<br />
	<font color="#FF0000" size="-3" id="info"></font></td>
  </tr>
  <tr>
    <td>Пользователь:</td>
    <td><input type="text" id="user" /></td>
  </tr>
  <tr>
    <td>Пароль:</td>
    <td><input type="password" id="pass" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><a href="JavaScript:query()">Войти!</a></td>
  </tr>
</table>
</body>
</html>
<?php }?>