<?php

if (isset($_GET['delete']) && isset($_GET['admin_box']) && $Client == "Administrator") {
    if (!mysql_query("DELETE FROM admin WHERE Username='" . $_GET['admin_box'] . "'", $link)) {
        echo ("<br>Error: Not a valid DELETE query.<br>");
        echo ("<br>MySql error : " . mysql_error());
    } else {
        $table_admin_all = "SELECT * FROM admin ORDER BY Username ASC";
        $query_admin_all = mysql_query($table_admin_all);
        $length_admin = mysql_numrows($query_admin_all);
    }
    // same effect when the 'new user' button is pressed
    $new = 1;
}




// Lock or unlock button is pressed
if (isset($_GET['lock']) && isset($_GET['username_box'])) {

    $block_user = mysql_result($query_users_uniq, 0, "block");
    logger("Répertoire=" . $_POST['dir_box2']);
    if ($block_user == "1") {
        $_GET['lock'] = 0;
        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
        echo ("<!--\n\n");
        echo ("  alert(\"" . $Translate[118] . "\");\n\n");
        echo ("-->\n");
        echo ("</script>\n");
    }

    if (!mysql_query("UPDATE users SET Status='" . $_GET['lock'] . "' WHERE User='" . $_GET['username_box'] . "'", $link)) {
        echo ("<br>Error: Not a valid UPDATE query.<br>");
        echo ("<br>MySql error : " . mysql_error());
    } else {
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
    // $new=1;
    $_GET['id'] = $_GET['username_box'];
}
?>
