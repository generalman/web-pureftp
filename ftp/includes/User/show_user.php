<?php

////////////AFFICHAGE LISTE UTILISATEUR///////////////////////////

echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");

echo ("<table class=\"banniere\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"850\">\n");
echo ("<tr >\n");
echo ("<td>\n");
echo ("<img hspace=\"1\" src=\"$LocationImages/sii.png\" align=\"middle\" border=\"0\"><span class=\"titre\"<font size=\"+1\">&nbsp;" . $Translate[0] . "</font></span>\n");
echo ("</td>\n");
echo ("<td align=\"right\">");
if ($Client != "Administrator") {
    echo ("<a href=\"$_SERVER[PHP_SELF]\">");
    echo ("<img hspace=\"1\" src=\"$LocationImages/refresh.png\" title=\"" . $Translate[121] . "\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
    echo ("</a>");
}
echo ("<a href=\"$_SERVER[PHP_SELF]?new=1\">");
echo ("<img hspace=\"1\" src=\"$LocationImages/add_user.png\" title=\"" . $Translate[31] . "\" width=\"60\" height=\"60\" align=\"middle\" border=\"0\">");
echo ("</a>");
if ($Client != "Administrator") {
    echo ("<a href=\"disconnect.php\">");
    echo ("<img hspace=\"1\" src=\"$LocationImages/disconnect.png\" title=\"" . $Translate[103] . "\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
    echo ("</a>");
}

echo ("</td>\n");
echo ("</tr>\n");
echo ("</table>\n");
echo ("</td>\n");
echo ("</tr>\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");
if ($Client != "Administrator") {
    echo ("<table width=\"850\" border=\"0\">\n");

    $iCounter = 0;
    $QuotaClientUse = 0;
    while ($iCounter < $length_users) {

        $int = mysql_result($query_users, $iCounter, "QuotaSize");
        $QuotaClientUse = $QuotaClientUse + $int;
        $iCounter++;
    }
    $QuotaClientRestant = $QuotaClient - $QuotaClientUse;
    $QuotaClientPercentUse = $QuotaClientUse * 100 / $QuotaClient;

    echo ("<tr class=\"column_name_select_user_up\">\n");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[100] . " " . $Client . "</td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[104] . " " . $QuotaClient . "M </td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[101] . " " . $QuotaClientRestant . "M " . "</td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">" . $Translate[102] . " " . $QuotaClientPercentUse . "% " . "</td>");
    echo ("</tr>\n");
    echo ("</table>\n");
}
echo ("</td>\n");
echo ("</tr>\n");
echo ("<tr bgcolor=\"#FFFFFF\">\n");
echo ("<td>\n");
echo ("<table width=\"850\" border=\"0\">\n");

echo ("<tr class=\"column_name_select_user\">\n");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">" . $Translate[32] . "</a></td>");
if ($Client == "Administrator") {
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">" . $Translate[108] . "</a></td>");

    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">" . $Translate[33] . "</a></td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">" . $Translate[34] . "</a></td>");

    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">" . $Translate[35] . "</a></td>");
}

//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[36]."</td>");
//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[37]."</td>");
//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[38]."</td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=quotafull\">" . $Translate[44] . "</a></td>");
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=quotause\">" . $Translate[99] . "</a></td>");

if ($Client != "Administrator") {
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=dir\">" . $Translate[35] . "</a></td>");

    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=rights\">" . $Translate[117] . "</a></td>");
}
echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]\">" . $Translate[39] . "</a></td>");

echo ("</tr>\n");

$iCounter = 0;

while ($iCounter < $length_users) {

    $user = mysql_result($query_users, $iCounter, "User");
    //$password     = mysql_result($query_users,$iCounter,"Password");
    $uid = mysql_result($query_users, $iCounter, "Uid");
    $gid = mysql_result($query_users, $iCounter, "Gid");
    $dir = mysql_result($query_users, $iCounter, "Dir");
    //$ulbandwidth  = mysql_result($query_users,$iCounter,"ULBandwidth");
    //$dlbandwidth  = mysql_result($query_users,$iCounter,"DLBandwidth");
    $quotasize = mysql_result($query_users, $iCounter, "QuotaSize");
    $ipaddress = mysql_result($query_users, $iCounter, "Ipaddress");
    $status = mysql_result($query_users, $iCounter, "Status");
    $user_client = mysql_result($query_users, $iCounter, "Client");
    $quotafilesusage = mysql_result($query_users, $iCounter, "QuotaFilesUsage");
    $quotadiskusage = mysql_result($query_users, $iCounter, "QuotaDiskUsage");
    $quotapourcent = round($quotadiskusage / 1000 / 1024 / $quotasize * 100, 2);

    //On rempli la base avec le pourcentage par user afin de faire du classement
    if (!mysql_query("UPDATE users SET QuotaClientPercentUse='" . $quotapourcent . "' WHERE User='" . $user . "'", $link)) {
        echo ("<br>Error: Not a valid UPDATE query.<br>");
        echo ("<br>MySql error : " . mysql_error());
    }





    if ($status == 1) {
        //Quota Warning

        if (($quotapourcent > 80) && ($quotapourcent < 90)) {
            echo ("<tr class=\"select_warning_user\">\n");
        }
        //Quota Critical
        elseif ($quotapourcent > 90) {
            echo ("<tr class=\"select_critical_user\">\n");
        } else {
            echo ("<tr class=\"select_user\">\n");
        }
    }
    else
        echo ("<tr class=\"select_locked_user\">\n");



    echo ("<td align=\"left\" width=\"140\">");

    echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\" title=\"" . $Translate[60] . "\">");

    // Lock or unlock account
    if ($status == 1)
        echo ("<img src=\"$LocationImages/ftpuser.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");
    else
        echo ("<img src=\"$LocationImages/ftpuser_gray.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");

    echo ("<input class=\"name\" value=\"$user\" name=\"textfield\" type=\"text\">");


    echo ("</a></td>\n");
    if ($Client == "Administrator") {
        echo ("<td align=\"left\" style=\"padding-left: 3px;\">" . $user_client . "</td>\n");

        echo ("<td align=\"left\" style=\"padding-left: 3px;\">" . $uid . "</td>\n");
        echo ("<td align=\"left\" style=\"padding-left: 3px;\">" . $gid . "</td>\n");

        echo ("<td title=\"" . $dir . "\">");
        echo ("<input class=\"directory_location\" value=\"" . $dir . "\" name=\"textfield\" type=\"text\">");
        echo ("</td>");
    }
    // echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$ulbandwidth."</td>\n");
    // echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$dlbandwidth."</td>\n");
    // echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$ipaddress."</td>\n");
    echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $quotasize . " MB </td>\n");
    echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $quotapourcent . " % </td>\n");
    if ($Client != "Administrator") {
        echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $dir . "</td>\n");

        if ($uid == "2001") {
            echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $Translate[115] . " </td>\n");
        } elseif ($uid == "2002") {
            echo ("<td align=\"left\" style=\"padding-left: 2px;\">" . $Translate[116] . " </td>\n");
        } else {
            echo ("<td align=\"left\" style=\"padding-left: 2px;\"> NC </td>\n");
        }
    }
    echo ("<td align=\"center\" width=\"100\">");

    /* Edit ftp account */
    echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\">");
    if ($status == 1)
        echo ("<img src=\"$LocationImages/edit.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
    else
        echo ("<img src=\"$LocationImages/edit_gray.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
    echo ("title=\"" . $Translate[60] . "\" ");
    echo ("alt=\"" . $Translate[60] . "\"></a>&nbsp;&nbsp;");

    /* Delete ftp account */
    echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?delete=1&username_box=$user');return false;\">");
    if ($status == 1)
        echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");
    else
        echo ("<img src=\"$LocationImages/delete_gray.gif\" width=\"15\" height=\"16\" border=\"0\" ");
    echo ("title=\"" . $Translate[61] . "\" ");
    echo ("alt=\"" . $Translate[61] . "\"></a>&nbsp;&nbsp;");

    /* Lock or unlock account */
    if ($status == 1) {
        echo ("<a href=\"$_SERVER[PHP_SELF]?lock=0&username_box=$user\" >");
        echo ("<img src=\"$LocationImages/lock_open.gif\" width=\"14\" height=\"18\" border=\"0\" ");
        echo ("title=\"" . $Translate[62] . "\" ");
        echo ("alt=\"" . $Translate[62] . "\"></a>&nbsp;&nbsp;");
    } else {
        echo ("<a href=\"$_SERVER[PHP_SELF]?lock=1&username_box=$user\" >");
        echo ("<img src=\"$LocationImages/lock_closed.gif\" width=\"14\" height=\"17\" border=\"0\" ");
        echo ("title=\"" . $Translate[63] . "\" ");
        echo ("alt=\"" . $Translate[63] . "\"></a>&nbsp;&nbsp;");
    }

    /* Open ftp account */
    if ($status == 1) {
        echo ("<a href=\"ftp://$user@" . $FTPAddress . "\" target=\"_blank\">");
        echo ("<img src=\"$LocationImages/connect.gif\" width=\"16\" height=\"18\" border=\"0\" ");
        echo ("title=\"" . $Translate[64] . "\" ");
        echo ("alt=\"" . $Translate[64] . "\"></a>");
    } else {
        echo ("<img src=\"$LocationImages/connect_gray.gif\" width=\"16\" height=\"18\" border=\"0\" ");
        echo ("alt=\"" . $Translate[64] . "\" >");
    }

    echo ("</td>\n");
    echo ("</tr>\n");
    $iCounter++;
}

echo ("</table>\n");
echo ("</td>\n");
echo ("</tr>\n");
echo ("</table>\n");
///////////////////////////FIN DE LISTAGE DES UTILISATEURS/////////////////////
?>
