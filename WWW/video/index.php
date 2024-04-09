<?php Error_Reporting(E_ALL & ~E_NOTICE);
require_once("../config.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KazanReal.ru - сайт фото и видео казани</title>
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
<script type='text/javascript' src='flashobject.js'></script>    

   <script type='text/javascript'>

      <!-- To load a movie other then the first one listed in the xml file you can specify a movie=# arguement. -->

      <!-- For example, to load the third movie you would do the following: MyProjectName.html?movie=3 -->      

      // <![CDATA[

      var args = new Object();

      var query = location.search.substring(1);

      // Get query string

      var pairs = query.split( ',' );

      // Break at comma

      for ( var i = 0; i < pairs.length; i++ )

      {

         var pos = pairs[i].indexOf('=');

         if( pos == -1 )

         {

            continue; // Look for 'name=value'

         }

         var argname = pairs[i].substring( 0, pos ); // If not found, skip

         var value = pairs[i].substring( pos + 1 ); // Extract the name

         args[argname] = unescape( value ); // Extract the value

      }

      // ]]>

   </script>        



	<style type='text/css'>	   

 

	   #noexpressUpdate

	   {

	      margin: 0 auto;

			font-family:Arial, Helvetica, sans-serif;

			font-size: x-small;

			color: #003300;

			text-align: left;

			background-image: url(fin_nofp_bg.gif);

			background-repeat: no-repeat;

			width: 210px; 

			height: 200px;	

			padding: 40px;

	   }

     </style>
<body onLoad="ask()" leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginheight="0" marginwidth="0" bgcolor="#CCFFFF">
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
	  <div id="flashcontent">	   		

			<div id="noexpressUpdate">

			  <p>The Camtasia Studio video content presented here requires JavaScript to be enabled and the  latest version of the Macromedia Flash Player. If you are you using a browser with JavaScript disabled please enable it now. Otherwise, please update your version of the free Flash Player by <a href="http://www.macromedia.com/go/getflashplayer">downloading here</a>. </p>

		    </div>

    </div>            <script type="text/javascript"> 

		  // <![CDATA[          

         var fo = new FlashObject( "fin_controller.swf", "fin_controller.swf", "704", "631", "8", "#FFFFFF", false, "best" );

         fo.addVariable( "csConfigFile", "fin_config.xml"  ); 

         fo.addVariable( "csColor"     , "FFFFFF"           );

         //fo.addVariable( "csPreloader" , "video/kremlin/fin_preload.swf" );

         if( args.movie )

         {

            fo.addVariable( "csFilesetBookmark", args.movie );

         }

         fo.write("flashcontent"); 		  	  

         // ]]> 



	        </script>
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