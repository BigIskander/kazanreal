<?php
$text=$_GET['text'];
for($i=0; $i<strlen($text); $i++)
{
	echo("&#".ord($text[$i]).";");
}
?>