// JavaScript Document
// get XML
function getXmlHttp(){
  var xmlhttp;
  suport=true;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
	  suport=false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
	suport=true;
  }
  return xmlhttp;
}
//вспомогательные функции
function AtributesCode()
{
	if(type=="galery") return {"name":0,"create":1,"update":2,"mimage":3,"icols":4,"id":5,"cols":0,"err":1};
	if(type=="image" || type=="zoom") return {"image":0,"create":1,"title":2,"rsize":3,"width":4,"height":5,"cols":0,"id":0,"err":1};
}
function error(code)
{
	var text;
	switch(parseInt(code))
	{
		case 1:
			text="ошибка соединения с БД";
			break;
		case 2:
			text="ошибка типов данных";
			break;
		case 3:
			text="нет таких данных";
			break;
		case 4:
			text="ошибка загрузки";
			break;
		case 5:
			text="Ajax не поддерживается, установите более позднюю версию браузера";
			break;
	}
	if(parseInt(code)!=99) 
	{
		alert("Ошибка: "+text+", попробуйте обновить страницу!");
		document.getElementById("info").innerHTML="Ошибка: "+text+", попробуйте обновить страницу!";
	}
}
//основные переменные
var xmlhttp = getXmlHttp();
var type="galery";
var gal=0;
var galeryname="галереи";
var imagename="______";
var atr=AtributesCode();
var elements;
var cols=0;
var err=0;
var incs=0;
var suport=true;
var ro=0;
var inow;
var idnow;
var ggal;
var gid;
var gtype="galery";
var run=0;
//
function ask()
{
	if(suport==false) { err=5; error(err); return; }
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	text="xml/asc.php?link="+encodeURIComponent(document.location)+"&"+nw;
	xmlhttp.open('GET', text, true);
	xmlhttp.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp.onreadystatechange=get;
	xmlhttp.send(null);
}
function get()
{
	if (xmlhttp.readyState == 4) {
    	if(xmlhttp.status == 200) {
			var gl;
			var ii;
			elements=xmlhttp.responseXML;
			gl=parseInt(elements.getElementsByTagName("ask").item(0).attributes[1].value);
			ii=parseInt(elements.getElementsByTagName("ask").item(0).attributes[2].value);
			galeryname=elements.getElementsByTagName("ask").item(0).attributes[3].value;
			if(parseInt(gl)!=0)
			{
				run=1;
				gtype="image";
				gal=gl;
				if(parseInt(ii)!=0)
				{
					type="zoom";
					gid=ii;
					read();
					return;
				}
				goimage(gal);
				return;
			}
			read();
			return;
       	} else {
			err=4; error(err);
			return;
		}
  	}
}
//получение дерева
function read()
{
	if(suport==false) { err=5; error(err); return; }
	atr=AtributesCode();
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	var tp=type;
	if(type=="zoom") tp="image";
	var text='/xml/'+tp+'s.php';
	if(type=="image" || type=="zoom") text=text+'?gal='+gal+'&rand='+sec;
	else text=text+'?rand='+sec;
	xmlhttp.open('GET', text, true);
	xmlhttp.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp.onreadystatechange=list;
	xmlhttp.send(null);
}
function list()
{
	if (xmlhttp.readyState == 4) {
     		if(xmlhttp.status == 200) {
				elements=xmlhttp.responseXML;
				tp=type;
				if(type=="zoom") tp="image";
				err=elements.getElementsByTagName(tp+"s").item(0).attributes[atr.err].value;
				cols=elements.getElementsByTagName(tp+"s").item(0).attributes[atr.cols].value;
				if(parseInt(err)!=0 && parseInt(err)!=99) { error(err); return; }
				info();
				if(type=="galery") { galeryPoint(); return; }
				if(type=="image") { imagePoint(); return; }
				if(type=="zoom") {
					for(var i=0; i<cols; i++)
					{
						if(gid==elements.getElementsByTagName("image").item(i).attributes[atr.image].value)
						{
							zoom(gid,i);
							return;
						}
					}
					return; 
				}
         	} else {
				err=4; error(err);
				return;
			}
  		}
}
//рисование сетки
function tableset()
{
	var trs=parseInt(cols)/6;
	if(parseInt(trs)!=trs) trs=parseInt(trs)+1;
	//
	var text='<table border="0">';
	incs=trs*6;
	for(i=0; i<trs; i++)
	{
		text=text+'<tr id="tabtr_'+i+'"><td width="154" height="182" id="tab_'+(i*6)+'">&nbsp;</td><td width="154" height="182" id="tab_'+(i*6+1)+'">&nbsp;</td><td width="154" height="182" id="tab_'+(i*6+2)+'">&nbsp;</td><td width="154" height="182" id="tab_'+(i*6+3)+'">&nbsp;</td><td width="154" height="182" id="tab_'+(i*6+4)+'">&nbsp;</td><td width="154" height="182" id="tab_'+(i*6+5)+'">&nbsp;</td></tr>';
	}
	text=text+'</table>';
	document.getElementById("galeryes").innerHTML=text;
}
//
function imagePoint()
{
	tableset();
	var image, name;
	for(var i=0; i<cols; i++)
	{
		image=elements.getElementsByTagName(type).item(i).attributes[atr.image].value;
		name=elements.getElementsByTagName(type).item(i).attributes[atr.title].value;
		text='<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;" id="elem_'+i+'"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center"><a href="JavaScript:zoom('+image+', '+i+')" title="увеличить"><img src="http://'+document.location.host+document.location.pathname+'admin/145.php?id='+image+'" border="0" /></a></div><div style="width: 150px; height: 20px;" align="left">'+name+'</div></div>';
		document.getElementById("tab_"+i).innerHTML=text;
	}
	for(i=i+1; i<incs; i++) document.getElementById("tab_"+i).innerHTML="";
}
//
function galeryPoint()
{
	tableset();
	var image, name, id;
	for(var i=0; i<cols; i++)
	{
		image=elements.getElementsByTagName(type).item(i).attributes[atr.mimage].value;
		name=elements.getElementsByTagName(type).item(i).attributes[atr.name].value;
		id=elements.getElementsByTagName(type).item(i).attributes[atr.id].value;
		text='<div style="width: 152px; height: 180px; border:solid; border-color:#66FFFF; border-width:1px;" id="elem_'+i+'"><div style="width: 150px; height: 5px;" align="left"><font size="-5">&nbsp;</font></div><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center"><a href="JavaScript:goimage('+id+','+i+')" title="перейдти в галерею"><img src="http://'+document.location.host+document.location.pathname+'admin/145.php?id='+image+'" border="0" /></a></div><div style="width: 150px; height: 20px;" align="left">'+name+'</div></div>';
		document.getElementById("tab_"+i).innerHTML=text;
	}
	for(i=i+1; i<incs; i++) document.getElementById("tab_"+i).innerHTML="";
}
//
//переходы по галереям
function gogalery()
{
	galeryname="галереи";
	type="galery";
	gal=0;
	atr=AtributesCode();
	read();
}
function goimage(id,i)
{
	if(type!="zoom" && i!=null) galeryname=elements.getElementsByTagName(type).item(i).attributes[atr.name].value;
	type="image";
	if(id!=0) gal=id;
	inow=i;
	atr=AtributesCode();
	read();
}
function zoom(id,i)
{
	type="zoom";
	var scroled;
	var ia=i;
	if((i/2)==parseInt(i/2)) scroled=(i-1)*154;
	else scroled=(i-2)*154;
	document.getElementById("galeryes").innerHTML='<table border="0"><tr bgcolor="#CCCCCC"><td colspan="3" height="405" width="405" valign="middle" align="center"><img id="image" src="img/loading.gif" width="300" height="300" onclick="rsize()" title="нажмите чтобы получить реальный размер если доступ к нему открыт"></td></tr><tr bgcolor="#CCCCCC"><td colspan="3" height="20" id="title" align="left">&nbsp;</td></tr><tr><td width="50" height="150" valign="top"><br>&nbsp;<br><a href="JavaScript:scrool(0,77)"><img src="img/1.png" width="50" height="90" border="0"></a></td>		<td valign="top"><div style="overflow: hidden; width: 618px; height: 155px; border:solid; border-color:#CCCCCC; border-width:1px; background-color:#FFFFFF;" id="images">Загрузка картинок...</div></td><td width="50" valign="top"><br>&nbsp;<br><a href="JavaScript:scrool(1,77)"><img src="img/2.png" width="50" height="90" border="0"></a></td></tr></table>';
	//
	text='<table id="tdl" border="0" height="160" width="'+(cols*154)+'"><tr height=" 160" valign="middle">';
	var image;
	for(var i=0; i<cols; i++)
	{
		image=elements.getElementsByTagName("image").item(i).attributes[atr.image].value;
		text+='<td width="154" align="center"><div style="width: 150px; height: 150px;"><a href="JavaScript:img_load('+image+','+i+')"><img src="http://'+document.location.host+document.location.pathname+"admin/145.php?id="+image+'" border="0" /></a></div></td>';
	}
	text+='</tr></table>';
	document.getElementById("images").innerHTML=text;
	document.getElementById("images").scrollLeft=scroled;
	img_load(id,ia);
	info();
}
//
function preload()
{
	document.getElementById("image").width=300;
	document.getElementById("image").height=300;
	document.getElementById("image").src="img/loading.gif";
}
function img_load(id,i)
{
	preload();
	idnow=id;
	info();
	var img=new Image();
	img.src="admin/145.php?id="+id+"&size=2";
	img.onLoad=show(img,i);
	var title=elements.getElementsByTagName("image").item(i).attributes[atr.title].value;
	document.getElementById("title").innerHTML=title;
}
function show(img,i)
{
	var width=elements.getElementsByTagName("image").item(i).attributes[atr.width].value;
	var height=elements.getElementsByTagName("image").item(i).attributes[atr.height].value;
	ro=elements.getElementsByTagName("image").item(i).attributes[atr.rsize].value;
	if(height>width) 
	{
		height=height*(220/width);	
		width=220;
	} else {
		width=width*(400/height);	
		height=400;
	}
	document.getElementById("image").width=width;
	document.getElementById("image").height=height;
	document.getElementById("image").src=img.src;
}
function scrool(t, plus)
{
	if(plus<=0) return;
	var left;
	left=document.getElementById("images").scrollLeft;
	if(t==1)  left=left+4;
	if(t==0)  left=left-4;
	document.getElementById("images").scrollLeft=left;
	setTimeout("scrool("+t+", "+(plus-1)+")", 10);
}
function rsize()
{
	if(ro==1)	window.open("admin/145.php?id="+idnow+"&size=3");
}
//
function info()
{
	if(galeryname=="") galeryname="______";
	if(type=="galery") {
		document.getElementById("info").innerHTML='галереи';
		document.getElementById("link").innerHTML='&lt;a href="http://'+document.location.host+document.location.pathname+'#">ссылка&lt;/a&gt';
	}
	if(type=="image")
	{
		document.getElementById("info").innerHTML='<a href="JavaScript:gogalery()">галереи</a> > '+galeryname;
		document.getElementById("link").innerHTML='&lt;a href="http://'+document.location.host+document.location.pathname+'#'+gal+'">ссылка&lt;/a&gt';
	}
	if(type=="zoom") 
	{
		document.getElementById("info").innerHTML='<a href="JavaScript:gogalery()">галереи</a> > <a href="JavaScript:goimage(0,'+inow+')">'+galeryname+'</a>';
		document.getElementById("link").innerHTML='&lt;a href="http://'+document.location.host+document.location.pathname+'#'+gal+'|'+idnow+'"&gt;ссылка&lt;/a&gt;';
	}
}