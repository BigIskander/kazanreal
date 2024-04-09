// JavaScript Document
var updates;
var wcols=0;
var tp;
var iatr;
var Win;
var gid;
function iatributesNameCode()
{
	if(tp=="galery") return {"name":0,"create":1,"update":2,"mimage":3,"icols":4,"id":5,"cols":0,"err":1};
	if(tp=="image") return {"image":0,"create":1,"title":2,"rsize":3,"cols":0,"err":1};
}
function getWin(id,i)
{
	gid=i;
	var text='';
	if(type=="galery") { tp="image";  text='../xml/images.php?gal='+id;  }
	else               { tp="galery"; text='../xml/galerys.php';          }
	iatr=iatributesNameCode();
	xmlhttp.open('GET', text, true);
	xmlhttp.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp.onreadystatechange=winList;
	xmlhttp.send(null);
}
function winList()
{
	if (xmlhttp.readyState == 4) {
     		if(xmlhttp.status == 200) {
				updates=xmlhttp.responseXML;
				err=updates.getElementsByTagName(tp+"s").item(0).attributes[iatr.err].value;
				icols=updates.getElementsByTagName(tp+"s").item(0).attributes[iatr.cols].value;
				if(err!=0) { error(err); return; }
				if(type=="galery") { selectImageWin(); return; }
				if(type=="image") { selectGaleryWin(); return; }
         	} else {
				err=4; error(err);
				return;
			}
  		}
}
function color(id)
{
	document.getElementById("elem_"+id).style.backgroundColor="#FAFF96";
}
function decolor(id)
{
	document.getElementById("elem_"+id).style.backgroundColor="";
}
//функции окошка с картинками
function selectedImage(id)
{
	var els=elements.getElementsByTagName(type).item(gid);
	var gl=els.attributes[atr.id].value;
	els.attributes[atr.mimage].value=id;
	galeryPoint();
	WinClose(0);
	query("?type=mimage&id="+gl+"&before="+id);
}
function selectImageWin()
{
	var trs=parseInt(icols)/3;
	if(parseInt(trs)!=trs) trs=parseInt(trs)+1;
	var text='<table border="0">';
	var i;
	for(i=0; i<trs; i++)
	{
		text=text+'<tr id="tabtr_'+i+'"><td width="154" height="182" id="wtab_'+(i*3)+'">&nbsp;</td><td width="154" height="182" id="wtab_'+(i*3+1)+'">&nbsp;</td><td width="154" height="182" id="wtab_'+(i*3+2)+'">&nbsp;</td></tr>';
	}
	text=text+'</table>';
	WinOpen(500,400,0);
	setHTML(text,1);
	var image, name;
	for(var i=0; i<icols; i++)
	{
		image=updates.getElementsByTagName(tp).item(i).attributes[iatr.image].value;
		name=updates.getElementsByTagName(tp).item(i).attributes[iatr.title].value;
		text='<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;" onmouseover="color('+i+')" onmouseout="decolor('+i+')" onclick="selectedImage('+image+')" id="elem_'+i+'"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" title="нажмите чтобы выбрать" align="center"><img src="http://'+document.location.host+document.location.pathname+'145.php?id='+image+'" border="0" /></div><div style="width: 150px; height: 20px;" align="left">'+name+'</div></div>';
		document.getElementById("wtab_"+i).innerHTML=text;
	}
}
//функции окошка с галереями
function selectedGalery(id)
{
	var els=elements.getElementsByTagName(type).item(gid);
	var gl=els.attributes[0].value;
	els.parentNode.removeChild(els);
	cols=cols-1;
	imagePoint();
	WinClose(0);
	query("?type=setGal&id="+gl+"&before="+id);
}
function selectGaleryWin()
{
	var trs=parseInt(icols)/3;
	if(parseInt(trs)!=trs) trs=parseInt(trs)+1;
	var text='<table border="0">';
	for(i=0; i<trs; i++)
	{
		text=text+'<tr id="tabtr_'+i+'"><td width="154" height="182" id="wtab_'+(i*3)+'">&nbsp;</td><td width="154" height="182" id="wtab_'+(i*3+1)+'">&nbsp;</td><td width="154" height="182" id="wtab_'+(i*3+2)+'">&nbsp;</td></tr>';
	}
	text=text+'</table>';
	WinOpen(500,400,0);
	setHTML(text,1);
	var image, gal, name;
	for(var i=0; i<icols; i++)
	{
		image=updates.getElementsByTagName(tp).item(i).attributes[iatr.mimage].value;
		gal=updates.getElementsByTagName(tp).item(i).attributes[iatr.id].value;
		name=updates.getElementsByTagName(tp).item(i).attributes[iatr.name].value;
		text='<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;" onmouseover="color('+i+')" onmouseout="decolor('+i+')" onclick="selectedGalery('+gal+')" id="elem_'+i+'"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" title="нажмите чтобы выбрать" align="center"><img src="http://'+document.location.host+document.location.pathname+'/145.php?id='+image+'" border="0" /></div><div style="width: 150px; height: 20px;" align="left">'+name+'</div></div>';
		document.getElementById("wtab_"+i).innerHTML=text;
	}
}
//увеличенная картинка
function zoomWin(id)
{
	var image=elements.getElementsByTagName(type).item(id).attributes[0].value;
	WinOpen(500,450,0);
	var text='<iframe src="http://'+document.location.host+document.location.pathname+'145.php?id='+image+'&size=3" width="500" height="450" frameborder="0"></iframe>';
	setHTML(text,0);
}
//
function uploadWin()
{
	var text;
	if(type=="image") text='guery.php?gal='+gal;
	else text='guery.php?gal=0';
	text='<iframe src="'+text+'" width="500" height="450" frameborder="0"></iframe>';
	WinOpen(285,450,1);
	setHTML(text,0)
}
//
function delWin(num)
{
	var text='<table width="200" border="0"><tr><td width="200" height="35" colspan="2" valign="middle" align="center">Потвердить удаление!</td></tr><tr><td width="100" height="20" bgcolor="#FF0000" align="left" onClick="del('+num+')">Да</td><td width="100" bgcolor="#00FF00" align="right" onClick="WinClose()">Нет</td></tr></table>';
	WinOpen(210,73,0);
	setHTML(text,0);
}
//
function configWin()
{
	var text='<iframe src="config/index.php" width="500" height="300" frameborder="0"  style="overflow:hidden"></iframe>';
	WinOpen(350,300,0);
	setHTML(text,0);
}
//
//окошки
var mv=0;
var up=0;
var mx;
var my;
function WinOpen(width, height, u)
{
	document.getElementById("Win").style.display="block";
	document.getElementById("Win").style.width=width+"px";
	document.getElementById("Win").style.height=(height+20)+"px";
	document.getElementById("WinM").style.width=width+"px";
	document.getElementById("WinHTML").style.width=width+"px";
	document.getElementById("WinHTML").style.height=height+"px";
	document.getElementById("Win").style.left=250+"px";
	document.getElementById("Win").style.top=150+"px";
	up=u;
	setTimeout("document.body.onclick=WinOClose", 100);
}
function WinClose()
{
	document.getElementById("Win").style.display="none";
	document.getElementById("WinHTML").innerHTML="";
	document.body.onclick="underfined";
	document.body.onmousemove="underfined";
	mv=0;
	if(up==1) read();
	up=0;
}
function setHTML(text,s)
{
	if(s==0) document.getElementById("WinHTML").style.overflowY="";
	else document.getElementById("WinHTML").style.overflowY="scroll";
	document.getElementById("WinHTML").innerHTML=text;
}
function WinOClose(e)
{
	if(window.event) { e=event; }
	var X=e.x;
	var Y=e.y;
	var posX=parseInt(document.getElementById("Win").style.left);
	var posY=parseInt(document.getElementById("Win").style.top)+document.scrollTop;
	var posWidth=parseInt(document.getElementById("Win").style.width);
	var posHeight=parseInt(document.getElementById("Win").style.height);
	if(X<posX || X>(posX+posWidth) || Y<posY || Y>(posY+posHeight))
		WinClose();
}
function WinMove(e)
{
	if(window.event) { e=event; }
	if(mv==0)	{
		var posX=parseInt(document.getElementById("Win").style.left);
		var posY=parseInt(document.getElementById("Win").style.top);
		mx=posX-e.clientX;
		my=posY-e.clientY;
		document.body.onmousemove=moveWin;
		mv=1;
	} else	{
		document.body.onmousemove="underfined";
		mv=0;
	}
}
function moveWin(e)
{
	if(window.event) { e=event; }
	x=e.clientX+mx;
	y=e.clientY+my;
	document.getElementById("Win").style.left=x+"px";
	document.getElementById("Win").style.top=y+"px";
}