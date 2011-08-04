<?php


echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");
echo ("<table width=\"850\" border=\"0\">\n");

echo ("<tr class=\"column_name_select_user\">\n");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\" ><span style=font-black>" . $Translate[32] . "</span></td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[108] . "</td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[106] . "</td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[107] . "</td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[39] . "</td>");
echo ("</tr>\n");

$iCounter2 = 0;

while ($iCounter2 < $length_admin) {

    $user = mysql_result($query_admin_all, $iCounter2, "Username");
    //$password     = mysql_result($query_users,$iCounter,"Password");
    $defaultdir = mysql_result($query_admin_all, $iCounter2, "DefaultDir");
    $client = mysql_result($query_admin_all, $iCounter2, "Client");
    $quotaclient = mysql_result($query_admin_all, $iCounter2, "QuotaClient");
    $quotaclient = $quotaclient / 1000; //Giga Affichage

    echo ("<tr class=\"select_user\">\n");
    echo ("<td align=\"left\" style=\"padding-left: 3px;\">" . $user . "</td>\n");
    //echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$password."</td>\n");
    //echo ("<td title=\"".$dir."\">");echo ("</td>");
    echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $client . "</td>\n");


    echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $quotaclient . " GB </td>\n");

    echo ("<td align=\"left\" style=\"padding-left: 2px;\" ");
    if (!is_dir($defaultdir)) {
        echo "bgcolor=\"Red\"";
    } echo (">" . $defaultdir . "</td>\n");
    echo ("<td align=\"left\" style=\"padding-left: 2px;\">");
    if ($user != "Administrator") {
        /* Edit admin account */
        echo ("<a href=\"$_SERVER[PHP_SELF]?id-admin=$user\">");
        echo ("<img src=\"$LocationImages/edit.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
        echo ("title=\"" . $Translate[60] . "\" ");
        echo ("alt=\"" . $Translate[60] . "\"></a>&nbsp;&nbsp;");

        /* Delete admin account */
        echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?delete=1&admin_box=$user');return false;\">");
        echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");

        echo ("title=\"" . $Translate[61] . "\" ");
        echo ("alt=\"" . $Translate[61] . "\"></a>&nbsp;&nbsp;");
    }
    echo ("</td>\n");
    echo ("</tr>\n");
    ////////////////////////////////////////////////////////////
    $iCounter2++;
}

echo ("</table>\n");
echo ("</td>\n");
echo ("</tr>\n");
echo ("</table>\n");
//echo ("<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
echo ("<br><br>");
?>
