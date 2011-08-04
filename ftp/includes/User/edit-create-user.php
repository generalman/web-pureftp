<?php

// Save button is pressed
if (isset($_POST['save'])) {

    $empty_password = 0;
    $vallid_password = 1;

    // check if password if filled
    if (strlen($_POST['password_box']) == 0 || ($_POST['password_box'] == "empty"))
        $empty_password = 1;

    // check for vallid password
    if ($_POST['confirm_password_box'] != $_POST['password_box']) {
        $vallid_password = 0;
        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
        echo ("<!--\n\n");
        echo ("  alert(\"" . $Translate[21] . "\");\n\n");
        echo ("-->\n");
        echo ("</script>\n");
    }

    $result = testpassword($_POST['password_box']);

    if (($result < 40) && ($_POST['password_box'] != 'empty')) {
        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
        echo ("<!--\n\n");
        echo ("  alert(\"" . $Translate[124] . "\");\n\n");
        echo ("-->\n");
        echo ("</script>\n");

        $vallid_password = 0;
    }





    $iExistUser = 0;
    $QuotaFull = 0;
    $iCounter = 0;
    $block_user = 0;


    // Find out of user exist
    while ($iCounter < $length_users_uniq) {

        $message_nr = mysql_result($query_users_uniq, $iCounter, "User");
        $message_client = mysql_result($query_users_uniq, $iCounter, "Client");
        if ($message_nr == $_POST['username_box']) {

            if ($message_client != $_POST['client_box']) {

                $iExistUser = 2;
            } else {
                $iExistUser = 1;
            }
            break;
        }
        $iCounter++;
    }
    $iCounter = 0;

    /////////////////////////// LIMITATION QUOTA //////////////////////////////
    $QuotaAddition = 0;
    $modificationquota = 0;

    //Quota Client
    //Recuperer le quota du client
    while ($iCounter < $length_users) {
        $quotasize = mysql_result($query_users, $iCounter, "QuotaSize");
        $useractu = mysql_result($query_users, $iCounter, "User");

        if ($_POST['username_box'] == $useractu) {

            if ($quotasize != $_POST['quotasize_box']) {
                //On additionne la nouvelle valeur et non l'ancienne

                $QuotaAddition = $QuotaAddition + $_POST['quotasize_box'];

                $modificationquota = 1;
            }
        } else {
            $QuotaAddition = $QuotaAddition + $quotasize;
        }

        $iCounter++;
    }
    //cas ou l'utilisateur n'existe pas
    if ($iExistUser == 0) {
        $QuotaAddition = $QuotaAddition + $_POST['quotasize_box'];
    }
    //on ajoute le quota du nouvel utilisateur



    $QuotaGlobal = mysql_result($query_admin, 0, "QuotaClient");

    if ($QuotaGlobal < $QuotaAddition) {

        $QuotaFull = 1;
    }
    //Additionner les quotas des utilisateurs du client
    // Si La somme est superieur strict au quota client
    // Message d'erreur. Vous avez �puis� votre quota
    /////////////////////////////FIN LIMITATION QUOTA ///////////////// 
    // Utilisateur existant et appartient au client donc c'est une modification
    if ($iExistUser != 0) {

        // Attention Quota explosé
        if (($QuotaFull == 1) && ($Client != "Administrator")) {
            echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
            echo ("<!--\n\n");
            echo ("  alert(\"" . $Translate[111] . "\");\n\n");
            echo ("-->\n");
            echo ("</script>\n");
        } else {
            //Attention l'utilisateur existe deja chez un autre client ou chez ce client mais c'est une création qui est demandé.
            if (($_POST['new_box'] == 1) || ($iExistUser == 2)) {
                echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                echo ("<!--\n\n");
                echo ("  alert(\"" . $Translate[123] . "\");\n\n");
                echo ("-->\n");
                echo ("</script>\n");
            } else {


                //  update current ftp account

                if (($empty_password == 1) || ($vallid_password == 0)) { // update without password

                    echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                    echo ("<!--\n\n");
                    echo ("  alert(\"" . $Translate[22] . "\");\n\n");
                    echo ("-->\n");
                    echo ("</script>\n");

                    $block_user = mysql_result($query_users_uniq, 0, "block");

                    logger("Répertoire=" . $_POST['dir_box2']);

                    if ($block_user == "1") {

                        $_POST['status_box'] = 0;
                        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                        echo ("<!--\n\n");
                        echo ("  alert(\"" . $Translate[118] . "\");\n\n");
                        echo ("-->\n");
                        echo ("</script>\n");
                    }



                    if (!mysql_query("UPDATE users SET Uid='" . $_POST['uid_box'] . "',
                                                        Gid='" . $_POST['gid_box'] . "',
                                                        Dir='" . $_POST['dir_box2'] . "',
                                                        QuotaFiles='" . $_POST['quotafiles_box'] . "',
                                                        QuotaSize='" . $_POST['quotasize_box'] . "',
                                                        ULBandwidth='" . $_POST['ulbandwidth_box'] . "',
                                                        DLBandwidth='" . $_POST['dlbandwidth_box'] . "',
                                                        ULRatio='" . $_POST['ulratio_box'] . "',
                                                        DLRatio='" . $_POST['dlratio_box'] . "',
                                                        Status='" . $_POST['status_box'] . "',
                                                        Ipaddress='" . $_POST['ipaddress_box'] . "',
                                                        Client='" . $_POST['client_box'] . "',
                                                        Comment='" . $_POST['comment_box'] . "'
                                                        WHERE User='" . $_POST['username_box'] . "'", $link)) {
                        echo ("<br>Error: Not a valid UPDATE query.<br>");
                        echo ("<br>MySql errorss : " . mysql_error());
                    }
                } else {

                    if (!mysql_query("UPDATE users SET Password='" . md5($_POST['password_box']) . "',
  																					Uid='" . $_POST['uid_box'] . "',
  																					Gid='" . $_POST['gid_box'] . "',
  																					Dir='" . $_POST['dir_box2'] . "',
  																					QuotaFiles='" . $_POST['quotafiles_box'] . "',
  																					QuotaSize='" . $_POST['quotasize_box'] . "',
  																					ULBandwidth='" . $_POST['ulbandwidth_box'] . "',
  																					DLBandwidth='" . $_POST['dlbandwidth_box'] . "',
  																					ULRatio='" . $_POST['ulratio_box'] . "',
  																					DLRatio='" . $_POST['dlratio_box'] . "',
  																					Status='" . $_POST['status_box'] . "',
  																					Ipaddress='" . $_POST['ipaddress_box'] . "',
  																					Comment='" . $_POST['comment_box'] . "'
  																					WHERE User='" . $_POST['username_box'] . "'", $link)) {
                        echo ("<br>Error: Not a valid UPDATE query.<br>");
                        echo ("<br>MySql error : " . mysql_error());
                    } else {
                        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                        echo ("<!--\n\n");
                        echo ("  alert(\"" . $Translate[23] . "\");\n\n");
                        echo ("-->\n");
                        echo ("</script>\n");
                    }
                }
            }
        }
    } else { // New user
        if (($QuotaFull == 1) && ($Client != "Administrator")) {
            echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
            echo ("<!--\n\n");
            echo ("  alert(\"" . $Translate[110] . "\");\n\n");
            echo ("-->\n");
            echo ("</script>\n");
        } else {

            // Create new User
            if ($vallid_password != 0 && $empty_password != 1) {
                if ($_POST['uid_box'] != "2001") {

                    if (!is_dir($_POST['dir_box2']))
                        $_POST['status_box'] = 0;
                    $block_user = 1;
                    echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                    echo ("<!--\n\n");
                    echo ("  alert(\"" . $Translate[114] . "\");\n\n");
                    echo ("-->\n");
                    echo ("</script>\n");
                }

                if (!mysql_query("INSERT INTO users (User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Client,block,Comment)
                                                                                                                                        VALUES ('" . $_POST['username_box'] . "',
                                                                                                                                        '" . md5($_POST['password_box']) . "',
                                                                                                                                        '" . $_POST['uid_box'] . "',
                                                                                                                                        '" . $_POST['gid_box'] . "',
                                                                                                                                        '" . $_POST['dir_box2'] . "',
                                                                                                                                        '" . $_POST['quotafiles_box'] . "',
                                                                                                                                        '" . $_POST['quotasize_box'] . "',
                                                                                                                                        '" . $_POST['ulbandwidth_box'] . "',
                                                                                                                                        '" . $_POST['dlbandwidth_box'] . "',
                                                                                                                                        '" . $_POST['ulratio_box'] . "',
                                                                                                                                        '" . $_POST['dlratio_box'] . "',
                                                                                                                                        '" . $_POST['status_box'] . "',
                                                                                                                                        '" . $_POST['ipaddress_box'] . "',
                                                                                                                                        '" . $_POST['client_box'] . "',
                                                                                                                                        '" . $block_user . "',
                                                                                                                                        '" . $_POST['comment_box'] . "')", $link)) {
                    echo ("<br>Error: Not a valid INSERT query.<br>");
                    echo ("<br>MySql error : " . mysql_error());
                }
            }
        }
    }
    // reload the database users
    if ($Client == "Administrator") {
        $table_users = "SELECT * FROM users ORDER BY User ASC";
    } else {

        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
    }

    $query_users = mysql_query($table_users);

    if (!$query_users)
        die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : " . mysql_error());

    $length_users = mysql_numrows($query_users);
}
?>
