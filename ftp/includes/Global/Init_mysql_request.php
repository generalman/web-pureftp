<?php

//Init Mysql Request
$table_admin = "SELECT * FROM admin WHERE Username='$LoginName'";
$query_admin = mysql_query($table_admin);
$table_admin_all = "SELECT * FROM admin ORDER BY Username ASC";
$query_admin_all = mysql_query($table_admin_all);
$DefaultDir = mysql_result($query_admin, 0, "DefaultDir");
$Client = mysql_result($query_admin, 0, "Client");
$QuotaClient = mysql_result($query_admin, 0, "QuotaClient");

//Select Specific User
if (isset($_POST['username_box'])) {
    $table_users_uniq = "SELECT * FROM users WHERE User='" . $_POST['username_box'] . "'";
}
if (isset($_GET['username_box'])) {
    $table_users_uniq = "SELECT * FROM users WHERE User='" . $_GET['username_box'] . "'";
}

$query_users_uniq = mysql_query($table_users_uniq);

//initialisation users
if ($Client == "Administrator") {
    $table_users = "SELECT * FROM users ORDER BY User ASC";
    $query_users_restore = mysql_query($table_users);
    $table_users_restore = "SELECT * FROM corbeille WHERE User='" . $_GET['username_box'] . "'";
    $query_users_restore = mysql_query($table_users_restore);





    if ($_GET['sort'] == 'corbeillequotafull') {
        $table_restore = "SELECT * FROM corbeille ORDER BY QuotaSize DESC";
    } elseif ($_GET['sort'] == 'corbeilledir') {
        $table_restore = "SELECT * FROM corbeille ORDER BY Dir ASC";
    } elseif ($_GET['sort'] == 'corbeillerights') {
        $table_restore = "SELECT * FROM corbeille ORDER BY Uid ASC";
    } elseif ($_GET['sort'] == 'corbeillequotause') {
        $table_restore = "SELECT * FROM corbeille ORDER BY QuotaClientPercentUse DESC";
    } else {
        $table_restore = "SELECT * FROM corbeille ORDER BY User ASC";
    }
    $query_restore = mysql_query($table_restore);
} else {

    if ($_GET['sort'] == 'quotafull') {
        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY QuotaSize DESC";
    } elseif ($_GET['sort'] == 'dir') {
        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY Dir ASC";
    } elseif ($_GET['sort'] == 'rights') {
        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY Uid ASC";
    } elseif ($_GET['sort'] == 'quotause') {
        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY QuotaClientPercentUse DESC";
    } else {
        $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
    }
}
$query_users = mysql_query($table_users);

if (!$query_users)
    die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : " . mysql_error());

$length_users = mysql_numrows($query_users);
$length_admin = mysql_numrows($query_admin_all);
$length_restore = mysql_numrows($query_restore);
$length_users_restore = mysql_numrows($query_restore);
$length_users_uniq = mysql_numrows($query_users_uniq);
?>
