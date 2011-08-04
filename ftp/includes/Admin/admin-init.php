<?php

$admin3_password = "empty";
$admin3_password_confirm = "empty";

if (!empty($_GET['id-admin'])) {
    $iCounter = 0;
    while ($iCounter < $length_admin) {

        $userid = mysql_result($query_admin_all, $iCounter, "Username");

        if ($userid == $_GET['id-admin']) {
            $user = $userid;
            //$password     = mysql_result($query_admin_all,$iCounter,"Password");
            $admin3_dir = mysql_result($query_admin_all, $iCounter, "DefaultDir");
            $admin3_quota = mysql_result($query_admin_all, $iCounter, "QuotaClient");
            $admin3_quota = $admin3_quota / 1000; # Affichage Giga
            $admin3_client = mysql_result($query_admin_all, $iCounter, "Client");
            break;
        }
        $iCounter++;
    }
} else if (empty($new)) { // $new != 1

    $user = $_POST['admin3'];
    //$password       = "empty";
    $admin3_password = $_POST['admin3_password'];
    $admin3_password_confirm = $_POST['admin3_password_confirm'];
    $admin3_dir = $_POST['admin3_dir'];
    $admin3_client = $_POST['admin3_client'];
    $admin3_quota = $_POST['admin3_quota'] / 1000; // Giga
} else {
    $user = $Translate[10];
    $admin3_password = "";
    $admin3_password_confirm = "";
    $admin3_dir = "$DefaultDir";
    $admin3_client = "1";
    $admin3_quota = "100";
}
?>
