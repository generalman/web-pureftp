<?php

function information($var,$titre){
	$reg = '|([^a-z0-9]+)|';
	$chaine=preg_replace($reg, '-', htmlentities($titre));
	$chaine.=rand();
	echo ("<a href=\"#".$chaine."\" class=\"tooltiplink\"><img class=help border=0 src=\"/ftp/images/info.png\" height=\"18\" width=\"18\"></a>");			
	echo ("<div id=\"".$chaine."\" class=\"tooltip\">");
	echo ("<img class=help align=\"right\" src=\"/ftp/images/info.png\" height=\"60\" width=\"60\">");
	echo ("<h2><u>$titre</u></h2>");
	echo ("<p>$var</p>");
	echo ("</div>");
	
}

?> 