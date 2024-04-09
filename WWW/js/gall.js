// JavaScript Document
// get XML
function getXmlHttp(){
  var xmlhttp;
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
	if(type=="image") return {"image":0,"create":1,"title":2,"rsize":3,"cols":0,"id":0,"err":1};
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
			text="Ajax не поддерживается";
			break;
		case 6:
			text="не удается удалить файл изображения";
			break;
		case 7:
			text="данные не соответсвуют возможно потребуется вручную отредактировать БД";
			break;
		case 99:
			text="пройдите авторизацию";
			document.getElementById("galeryes").innerHTML='Вы находитесь в фотогалерее, пожалуйста пройдите <a href="JavaScript:configWin()">авторизацию</a>... <br/> Это Бета версия программы, приятного пользования!';
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
var atr=AtributesCode();
var elements;
var cols=0;
var err=0;
var incs=0;
var one=0;
var eid;
var suport=true;
//var isMozilla=isDOM && navigator.appName=="Netscape";
//получение дерева
function read()
{
	if(suport==false) { err=5; error(err); return; }
	atr=AtributesCode();
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	var text='../xml/'+type+'s.php';
	if(type=="image") text=text+'?gal='+gal+'&rand='+sec;
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
				err=elements.getElementsByTagName(type+"s").item(0).attributes[atr.err].value;
				cols=elements.getElementsByTagName(type+"s").item(0).attributes[atr.cols].value;
				if(err!=0) { error(err); return; }
				info();
				if(type=="galery") { galeryPoint(); return; }
				if(type=="image") { imagePoint(); return; }
         	} else {
				err=4; error(err);
				return;
			}
  		}
}
//запросы
function query(text)
{
	var nw=new Date();
	var sec=nw.getMinutes()+":"+nw.getSeconds();
	xmlhttp.open('GET', "query.php"+text+"&rand="+sec, true);
	xmlhttp.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp.onreadystatechange=ok;
	xmlhttp.send(null);
}
function ok()
{
	if (xmlhttp.readyState == 4) {
     		if(xmlhttp.status == 200) {
				var gts=xmlhttp.responseXML;
				err=gts.getElementsByTagName("info").item(0).attributes[0].value;
				var stat=gts.getElementsByTagName("info").item(0).attributes[1].value;
				if(parseInt(stat)==1) { type="galery"; gal=0; read(); }
				if(parseInt(err)!=0) error(err);
			} else {
				err=4; error(err);
				return;
			}
  	}
}
//рисование сетки
function tableset()
{
	var trs=(parseInt(cols)+1)/6;
	if(parseInt(trs)!=trs) trs=parseInt(trs)+1;
	var ttr=parseInt(incs)/6;
	if(parseInt(ttr)!=ttr) ttr=parseInt(ttr)+1;
	//
	if(incs<cols || trs!=ttr)
	{
		var text='<table border="0">';
		incs=trs*6-1;
		for(i=0; i<trs; i++)
		{
			text=text+'<tr id="tabtr_'+i+'"><td width="154" height="217" id="tab_'+(i*6)+'">&nbsp;</td><td width="154" height="217" id="tab_'+(i*6+1)+'">&nbsp;</td><td width="154" height="217" id="tab_'+(i*6+2)+'">&nbsp;</td><td width="154" height="217" id="tab_'+(i*6+3)+'">&nbsp;</td><td width="154" height="217" id="tab_'+(i*6+4)+'">&nbsp;</td><td width="154" height="217" id="tab_'+(i*6+5)+'">&nbsp;</td></tr>';
		}
		text=text+'</table>';
		document.getElementById("galeryes").innerHTML=text;
	}
}
//рисование галерей
function galeryDiv(i)
{
	var image=elements.getElementsByTagName(type).item(i).attributes[atr.mimage].value;
	var id=elements.getElementsByTagName(type).item(i).attributes[atr.id].value;
	var name=elements.getElementsByTagName(type).item(i).attributes[atr.name].value;
	var paste='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px;" id="div_'+i+'"><table style="padding:0"><tr height="15" valign="top"><td width="75" align="left" style="padding:0"><a href="JavaScript:delWin('+i+')" title="удалить галерею"><font size="-5" color="#FF0000">удалить</font></a></td><td width="75" align="right" style="padding:0"><a href="JavaScript:goimage('+id+','+i+')" title="перейдти в галерею"><font size="-5" color="#0000FF">открыть</font></a></td></tr></table><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" title="кликни чтобы переместить" onClick="move('+i+',event)" align="center"><img src="145.php?id='+image+'" border="0" /></div><div style="width: 150px; height: 15px;" align="right"><a href="JavaScript:getWin('+id+','+i+')" title="изменить главную картинку"><font size="-5" color="#0000FF">изображение</font></a></div><div style="width: 150px; height: 25px;" align="left" title="нажать поменять название" id="name_'+i+'" onClick="onedit('+i+')">'+name+'</div></div>';
	return paste;
}
function galeryPoint()
{
	var i;
	tableset();
	var paste;
	for(i=0; i<cols; i++)
	{ 
		paste=galeryDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	document.getElementById("tab_"+i).innerHTML='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px; background-color:#66FFFF"><table style="padding:0"><tr height="15" valign="top"><td width="75" align="left" style="padding:0"><font size="-5" color="#FF0000">&nbsp;</font></td><td width="75" align="right" style="padding:0"><font size="-5" color="#0000FF">&nbsp;</font></td></tr></table><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center" title="кликните чтобы создать новую галерею" onclick="uploadWin()"><img src="../img/new.jpg" border="0" /></div><div style="width: 150px; height: 15px;" align="right"><font size="-5" color="#0000FF">&nbsp;</font></div><div style="width: 150px; height: 25px;" align="left" id="name_'+i+'" onClick="">новая галерея</div></div>';
	for(i=i+1; i<=incs; i++) document.getElementById("tab_"+i).innerHTML="";
}
//рисование набора изображений
function imageDiv(i)
{
	var image=elements.getElementsByTagName(type).item(i).attributes[atr.image].value;
	var name=elements.getElementsByTagName(type).item(i).attributes[atr.title].value;
	var rsize=elements.getElementsByTagName(type).item(i).attributes[atr.rsize].value;
	var onsl;
	if(rsize==0) onsl='';
	else onsl='checked="checked"';
	var paste='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px;" id="div_'+i+'"><table border="0" style="padding:0"><tr height="15" valign="top"><td width="75" align="left" style="padding:0"><a href="JavaScript:delWin('+i+')" title="удалить изображение"><font size="-5" color="#FF0000">удалить</font></a></td><td width="75" align="right" style="padding:0"><a href="JavaScript:zoomWin('+i+')" title="увеличить"><font size="-5" color="#0000FF">увеличить</font></a></td></tr></table><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center" title="кликните чтобы переместить" onClick="move('+i+',event)"><img src="145.php?id='+image+'" border="0" /></div><table border="0" style="padding:0"><tr height="10" valign="top" style="padding:0"><td width="135" style="padding:0"></td><td style="padding:0"><a href="JavaScript:getWin('+image+','+i+')" title="отправить в другую галерею"><font size="-5" color="#0000FF">галерея</font></a></td></tr><tr height="25" valign="middle" style="padding:0"><td width="135" align="left" title="подпись, нажмите чтобы поменять" id="name_'+i+'" onClick="onedit('+i+')" style="padding:0">'+name+'</td><td width="25" align="right" style="padding:0"><input name="rsize" type="checkbox" '+onsl+' onclick="setreal('+i+')" title="показывать реальный размер"></td></tr></table></div>';
	return paste;
	
}
function imagePoint()
{
	var i;
	tableset();
	var paste;
	for(i=0; i<cols; i++)
	{ 
		paste=imageDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	document.getElementById("tab_"+i).innerHTML='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px; background-color:#66FFFF"><table border="0" style="padding:0"><tr height="15" valign="top"><td width="75" align="left" style="padding:0"><font size="-5" color="#FF0000">&nbsp;</font></td><td width="75" align="right" style="padding:0"><font size="-5" color="#0000FF">&nbsp;</font></td></tr></table><div style="width: 150px; height: 150px; border:solid; border-color:#CCCCCC; border-width:1px;" align="center" title="кликните чтобы добавить картинку" onclick="uploadWin()"><img src="../img/new.jpg" border="0" /></div><table border="0" style="padding:0"><tr height="10" valign="top" style="padding:0"><td width="135" style="padding:0"></td><td style="padding:0"><font size="-5" color="#0000FF">&nbsp;</font></td></tr><tr height="25" valign="middle" style="padding:0"><td width="135" align="left" style="padding:0">новые картинки</td><td width="25" align="right" style="padding:0">&nbsp;</td></tr></table></div>';
	for(i=i+1; i<=incs; i++) document.getElementById("tab_"+i).innerHTML="";
}
//информационное поле
function info()
{
	if(type=="galery") document.getElementById("info").innerHTML='галереи';
	else               document.getElementById("info").innerHTML='<a href="JavaScript:gogalery()">галереи</a> > '+galeryname;
}
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
	galeryname=elements.getElementsByTagName(type).item(i).attributes[atr.name].value;
	type="image";
	gal=id;
	atr=AtributesCode();
	read();
}
//функция удалить
function del(num)
{
	var w;
	if(type=="image") w=atr.image;
	else              w=atr.id;
	var idElem=elements.getElementsByTagName(type).item(num);
	var id=idElem.attributes[w].value;
	idElem.parentNode.removeChild(idElem);
	cols=cols-1;
	WinClose();
	if(type=="galery") { galeryPoint(); query("?type=galeryDel&id="+id+"&before=0"); }
	else               { imagePoint(); query("?type=imageDel&id="+id+"&before=0"); }
}
//изменение названия картинок
function onedit(id)
{
	if(one==0)
	{
		var val=document.getElementById("name_"+id).innerHTML;
		document.getElementById("name_"+id).innerHTML='<input type="text" name="nm" value="'+val+'" size="10" title="кликните чтобы сохранить">';
		document.getElementById("name_"+id).firstChild.focus();
		setTimeout("document.body.onclick=savename", 20);
		one=1;
		eid=id;
	} else {
		if(eid!=id) return;
		var val=document.getElementById("name_"+id).firstChild.value;
		document.getElementById("name_"+id).innerHTML=val;
		var w, gi, is;
		if(type=="galery") { w=atr.name; gi=atr.id; }
		else { w=2; gi=0; }
		elements.getElementsByTagName(type).item(id).attributes[w].value=val;
		is=elements.getElementsByTagName(type).item(id).attributes[gi].value;
		document.body.onclick="underfined";
		one=0;
		if(type=="galery")	query("?type=updateName&id="+is+"&name="+val);
		else query("?type=updateTitle&id="+is+"&name="+encodeURIComponent(val));
	}
}
function savename() { onedit(eid); }
//доступ к реальному размеру изображения
function setreal(id)
{
	var idf=elements.getElementsByTagName(type).item(id).attributes[atr.image].value;
	var rsize=elements.getElementsByTagName(type).item(id).attributes[atr.rsize].value;
	if(rsize==0) val=1; else val=0;
	elements.getElementsByTagName(type).item(id).attributes[atr.rsize].value=val;
	query("?type=rSize&id="+idf+"&before="+val);
}