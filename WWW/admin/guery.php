<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
<!--
function ld()
{
	if(parent==window) { alert("Отдельный запуск не предусмотрен!"); window.close(); return; }
}
function loaded(file, id)
{
	document.getElementById("info").innerHTML='<div style="overflow: hidden; width: 230px; height: 154px; border:solid; border-color:#000000; border-width:1px;"><table border="0"><tr><td height="152" width="152" style="padding:0"><img src="145.php?id='+id+'&size=1" /></td><td height="152" width="98" style="padding:0">'+file+'</td></tr></table></div>'+document.getElementById("info").innerHTML;
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Загрузка изображений!</title>
</head>
<body topmargin="0" onunload="opener.upWinClose();" onload="ld()">
<table border="0">
<tr>
	<td width="250" height="15" valign="top">
	 Загрузка изображений!
	</td>
</tr>
<tr>
	<td width="250" height="54" valign="top"><div id="mainframe" style="height:52; width:252; border:solid; border-color:#66FFFF; border-width:1px;">
	<iframe width="250" height="50" src="upload.php?gal=<?php echo($_GET['gal']); ?>" id="frame" name="frame" marginheight="0" marginwidth="0" frameborder="0" scrolling="no"></iframe>	  
	  </div>
	</td>
</tr>
<tr>
    <td width="250" height="346" valign="top" bgcolor="#CCCCCC">
	<div style="overflow: hidden; width: 250px; height: 346px; border:solid; border-color:#000000; border-width:1px; background-color:#FFFFFF; overflow-y: scroll" id="info">
	</div>
	</td>
</tr>
</table>
</body>
</html>