<?php

echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");

echo ("<table class=\"banniere\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"850\">\n");
echo ("<tr >\n");
echo ("<td >\n");
echo ("<img hspace=\"1\" src=\"$LocationImages/$Logo\" align=\"middle\" border=\"0\"><span class=\"titre\"><font size=\"+1\">&nbsp;" . $Translate[105] . "</font></span>\n");
echo ("</td>\n");
echo ("<td align=\"right\">");
echo ("<a href=\"$_SERVER[PHP_SELF]\">");
echo ("<img hspace=\"1\" src=\"$LocationImages/refresh.png\" title=\"" . $Translate[121] . "\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
echo ("</a>");

echo ("<a href=\"$_SERVER[PHP_SELF]?new=1\">");
echo ("<img hspace=\"1\" src=\"$LocationImages/admin_50.png\" title=\"" . $Translate[109] . "\" width=\"60\" height=\"60\" align=\"middle\" border=\"0\">");
echo ("</a>");
if ($Client == "Administrator") {
    echo ("<a href=\"disconnect.php\">");
    echo ("<img hspace=\"1\" src=\"$LocationImages/disconnect.png\" title=\"" . $Translate[103] . "\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
    echo ("</a>");
}
echo ("</tr>\n");
echo ("</table>\n");
echo ("</td>\n");


echo ("</tr>\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");

//////////////////////////////////////////////////////////////////////
include("Admin/show-admin.php");

/////////////////// FORM ADMIN /////////////////////////////

//Initialisation de la form Admin
include("Admin/admin-init.php");
//Affichage du formulaire
include("Admin/show-form-admin.php");
/////////////////////FIN FORM ADMIN ///////////////////////////////
?>