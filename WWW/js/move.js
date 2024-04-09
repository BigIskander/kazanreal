var rx;
var ry;
var s=0;
var idm;
var xy;
var x;
var y;
var fid;
var fi;
var pz;
var st;
//
function get_xy(id)
{
	if(id=="gls") var el=document.getElementById("galeryes");
	else var el=document.getElementById("div_"+id);
	var x=el.offsetLeft;
  	var y=el.offsetTop;
	while(el)
	{
		x=x+el.offsetLeft;
		y=y+el.offsetTop;
		el=el.offsetParent;
	}
	return {"x":x, "y":y};
}
function move(id,e)
{
	if(window.event) { e=event; }
	idm=id;
	if(s==0)
	{
		var gp=get_xy("gls");
		pz=id;
		st=document.getElementById("galeryes").scrollTop;
		if(type=="galery") fid=elements.getElementsByTagName(type).item(id).attributes[5].value;
		else fid=elements.getElementsByTagName(type).item(id).attributes[0].value;
		fi=fid;
		xy=get_xy(idm);
		var cop=document.getElementById("div_"+idm).cloneNode(true);
		var rem=document.getElementById("div_"+idm);
		rem.parentNode.removeChild(rem);
		cop.id="move";
		cop.style.position="absolute";
		cop.style.left=xy.x+"px";
		cop.style.top=xy.y+st+"px";
		document.getElementById("galeryes").appendChild(cop);
		rx=xy.x-e.clientX;
		ry=xy.y-e.clientY-st;
		s=1;
		if(type=="galery") galeryUpoint();
		else                imageUpoint();
		document.body.onmousemove=drag;
	} else {
		s=0;
		var rem=document.getElementById("move");
		rem.parentNode.removeChild(rem);
		//
		if(type=="galery") 
		{ 
			galeryPoint();
			var id_1=fid;
			var id_2;
			if(pz==cols-1) id_2=0; else id_2=fi;
			query("?type=moveGalery&id="+id_1+"&before="+id_2);
		}
		else
		{
			imagePoint();
			var id_1=fid;
			var id_2;
			if(pz==cols-1) id_2=0; else id_2=fi;
			query("?type=moveImage&id="+id_1+"&before="+id_2);
		}
		document.body.onmousemove="underfuned";
	}
}
function drag(e)
{
	if(window.event) { e=event; }
	x=e.clientX+rx;
	y=e.clientY+ry;
	document.getElementById("move").style.left=x+"px";
	document.getElementById("move").style.top=y+"px";
	y=y+st;
	var tr=parseInt(idm/6);
	var td=parseInt(idm-tr*6);
	var posid=idm;
	if(x-xy.x<-76 && y-xy.y<-108) posid=(tr-1)*6+(td-1); //1
	if((x-xy.x<76 && x-xy.x>-76) && y-xy.y<-108) posid=(tr-1)*6+td; //2
	if(x-xy.x>76 && y-xy.y<-108) posid=(tr-1)*6+(td+1); //3
	if(x-xy.x>76 && (y-xy.y>-108 && y-xy.y<108)) posid=tr*6+(td+1); //4
	if(x-xy.x>76 && y-xy.y>108) posid=(tr+1)*6+(td+1); //5
	if((x-xy.x<76 && x-xy.x>-76) && y-xy.y>97) posid=(tr+1)*6+td; //6
	if(x-xy.x<-76 && y-xy.y>108) posid=(tr+1)*6+(td-1); //7
	if(x-xy.x<-76 && (y-xy.y>-108 && y-xy.y<108)) posid=tr*6+(td-1); //8
	if(posid>=0 && posid<cols && parseInt(idm)!=parseInt(posid)) update(posid);
}
function update(posid)
{
	posid=parseInt(posid);
	idm=parseInt(idm);
	var set=elements.getElementsByTagName(type+"s").item(0);
	var el=elements.getElementsByTagName(type).item(idm).cloneNode(true);
	var rem=elements.getElementsByTagName(type).item(idm);
	set.removeChild(rem);
	if(idm>posid)
	{	
		var po=elements.getElementsByTagName(type).item(posid);
		if(type=="galery") fi=po.attributes[atr.id].value;
		else fi=po.attributes[atr.image].value;
		set.insertBefore(el, po);
	} else {
		if((posid+1)>=cols)
		{
			set.appendChild(el);
		} else {
			var po=elements.getElementsByTagName(type).item(posid);
			if(type=="galery") fi=po.attributes[atr.id].value;
			else fi=po.attributes[atr.image].value;
			set.insertBefore(el, po);
		}
	}
	idm=posid;
	if(type=="galery") { galeryUpoint(); return; }
	if(type=="image") { imageUpoint(); return; }
}
//подрисовка списка галерей
function galeryUpoint()
{
	var paste;
	for(i=0; i<idm; i++)
	{ 
		paste=galeryDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	pz=i;
	paste='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px;" id="div_'+i+'"></div>';
	document.getElementById("tab_"+i).innerHTML=paste;
	for(i=idm+1;  i<cols; i++)
	{
		paste=galeryDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	xy=get_xy(idm);
}
//подрисовка списка картинок
function imageUpoint()
{
	var paste;
	for(i=0; i<idm; i++)
	{ 
		paste=imageDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	pz=i;
	paste='<div style="width: 152px; height: 215px; border:solid; border-color:#66FFFF; border-width:1px;" id="div_'+i+'"></div>';
	document.getElementById("tab_"+i).innerHTML=paste;
	for(i=idm+1;  i<cols; i++)
	{
		paste=imageDiv(i);
		document.getElementById("tab_"+i).innerHTML=paste;
	}
	xy=get_xy(idm);
}