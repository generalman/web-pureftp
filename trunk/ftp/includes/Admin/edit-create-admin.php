<?php

// On regarde si on souhaiter creer un nouvel utilisateur
if ($_GET['new'] == 1 || empty($_POST['username_box'])) {
    $new = 1;
}
if (isset($_GET['id'])) {
    $new = 0;
}

//Initialisation de la variable de sauvegarde
$data_saved = 1;

// Save button is pressed
if (isset($_POST['save_admin'])) {

    $emptyadmin_password = 0;
    $vallidadmin_password = 1;

    if (isset($_POST['admin3_quota'])) {
        $_POST['admin3_quota'] = $_POST['admin3_quota'] * 1000;
    }


    // check if password if filled
    if (strlen($_POST['admin3_password']) == 0 || ($_POST['admin3_password'] == "empty")) {
        $emptyadmin_password = 1;
    }
    // check for vallid password
    if ($_POST['admin3_password_confirm'] != $_POST['admin3_password']) {
        $vallidadmin_password = 0;
    }

    $iExistAdmin = 0;
    $iCounter = 0;
    // Find out of user exist
    while ($iCounter < $length_admin) {
        $message_nr = mysql_result($query_admin_all, $iCounter, "Username");

        if ($message_nr == $_POST['admin3']) {
            $iExistAdmin = 1;
            break;
        }
        $iCounter++;
    }

    if ($iExistAdmin == 1) {

        //  update current admin account
        if ($vallidadmin_password == 0) {
            echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
            echo ("<!--\n\n");
            echo ("  alert(\"" . $Translate[21] . "\");\n\n");
            echo ("-->\n");
            echo ("</script>\n");
        } else {
            if ($emptyadmin_password == 1) { // update without password

                echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                echo ("<!--\n\n");
                echo ("  alert(\"" . $Translate[22] . "\");\n\n");
                echo ("-->\n");
                echo ("</script>\n");


                if (!mysql_query("UPDATE admin SET DefaultDir='" . $_POST['admin3_dir'] . "',
																							QuotaClient='" . $_POST['admin3_quota'] . "',
																							Client='" . $_POST['admin3_client'] . "' WHERE Username='" . $_POST['admin3'] . "'", $link)) {
                    echo ("<br>Error: Not a valid UPDATE query.<br>");
                    echo ("<br>MySql error : " . mysql_error());
                } else {
                    //reload
                    $table_admin_all = "SELECT * FROM admin ORDER BY Username ASC";
                    $query_admin_all = mysql_query($table_admin_all);
                    $length_admin = mysql_numrows($query_admin_all);
                }
            } else {
                if (!mysql_query("UPDATE admin SET Password='" . md5($_POST['admin3_password']) . "',
																					DefaultDir='" . $_POST['admin3_dir'] . "',
																							QuotaClient='" . $_POST['admin3_quota'] . "',
																							Client='" . $_POST['admin3_client'] . "' WHERE Username='" . $_POST['admin3'] . "'", $link)) {
                    echo ("<br>Error: Not a valid UPDATE query.<br>");
                    echo ("<br>MySql error : " . mysql_error());
                } else {
                    echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
                    echo ("<!--\n\n");
                    echo ("  alert(\"" . $Translate[23] . "\");\n\n");
                    echo ("-->\n");
                    echo ("</script>\n");

                    //reload
                    $table_admin_all = "SELECT * FROM admin ORDER BY Username ASC";
                    $query_admin_all = mysql_query($table_admin_all);
                    $length_admin = mysql_numrows($query_admin_all);
                }
            }
        }
    } else { // New user

        // Create new User
        if ($vallidadmin_password == 0 || $emptyadmin_password == 1) {
            echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
            echo ("<!--\n\n");
            echo ("  alert(\"" . $Translate[21] . "\");\n\n");
            echo ("-->\n");
            echo ("</script>\n");
            $data_saved = 0;
        } else {
            if (!mysql_query("INSERT INTO admin (Username,Password,DefaultDir,Client, QuotaClient) VALUES ('" . $_POST['admin3'] . "','" . md5($_POST['admin3_password']) . "','" . $_POST['admin3_dir'] . "','" . $_POST['admin3_client'] . "','" . $_POST['admin3_quota'] . "')", $link)) {
                echo ("<br>Error: Not a valid INSERT query.<br>");
                echo ("<br>MySql error : " . mysql_error());
            }
        }
        // reload the database users
        $table_admin_all = "SELECT * FROM admin ORDER BY Username ASC";
        $query_admin_all = mysql_query($table_admin_all);
        $length_admin = mysql_numrows($query_admin_all);
    }
}


?>
