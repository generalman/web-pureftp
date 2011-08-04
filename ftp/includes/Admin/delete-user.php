<?php

if (isset($_GET['delete']) && isset($_GET['username_box'])) {

    $user_delete = mysql_result($query_users_uniq, 0, "User");
    $password_delete = mysql_result($query_users_uniq, 0, "Password");
    $uid_delete = mysql_result($query_users_uniq, 0, "Uid");
    $gid_delete = mysql_result($query_users_uniq, 0, "Gid");
    $dir_delete = mysql_result($query_users_uniq, 0, "Dir");
    $quotafiles_delete = mysql_result($query_users_uniq, 0, "QuotaFiles");
    $quotasize_delete = mysql_result($query_users_uniq, 0, "QuotaSize");
    $ulbandwidth_delete = mysql_result($query_users_uniq, 0, "ULBandwidth");
    $dlbandwidth_delete = mysql_result($query_users_uniq, 0, "DLBandwidth");
    $ipaddress_delete = mysql_result($query_users_uniq, 0, "Ipaddress");
    $comment_delete = mysql_result($query_users_uniq, 0, "Comment");
    $status_delete = mysql_result($query_users_uniq, 0, "Status");
    $ulratio_delete = mysql_result($query_users_uniq, 0, "ULRatio");
    $dlratio_delete = mysql_result($query_users_uniq, 0, "DLRatio");
    $quotadiskusage_delete = mysql_result($query_users_uniq, 0, "QuotaDiskUsage");
    $quotafilesUsage_delete = mysql_result($query_users_uniq, 0, "QuotaFilesUsage");
    $Client_delete = mysql_result($query_users_uniq, 0, "Client");
    $QuotaClientPercentUser_delete = mysql_result($query_users_uniq, 0, "QuotaClientPercentUse");
    $block_delete = mysql_result($query_users_uniq, 0, "block");




    if (!mysql_query("INSERT INTO corbeille (id,User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Client,block,Comment)
                                                                            VALUES ('','" . $user_delete . "',
                                                                            '" . $password_delete . "',
                                                                            '" . $uid_delete . "',
                                                                            '" . $gid_delete . "',
                                                                            '" . $dir_delete . "',
                                                                            '" . $quotafiles_delete . "',
                                                                            '" . $quotasize_delete . "',
                                                                            '" . $ulbandwidth_delete . "',
                                                                            '" . $dlbandwidth_delete . "',
                                                                            '" . $ulratio_delete . "',
                                                                            '" . $dlratio_delete . "',
                                                                            '" . $status_delete . "',
                                                                            '" . $ipaddress_delete . "',
                                                                            '" . $Client_delete . "',
                                                                            '" . $block_delete . "',
                                                                            '" . $comment_delete . "')", $link)) {
        echo ("<br>Error: Not a valid INSERT query.<br>");
        echo ("<br>MySql error : " . mysql_error());
    }


    if (!mysql_query("DELETE FROM users WHERE User='" . $_GET['username_box'] . "'", $link)) {
        echo ("<br>Error: Not a valid DELETE query.<br>");
        echo ("<br>MySql error : " . mysql_error());
    } else {
        if ($Client == "Administrator") {
            $table_users = "SELECT * FROM users ORDER BY User ASC";
            $table_restore = "SELECT * FROM corbeille ORDER BY User ASC";
            $query_restore = mysql_query($table_restore);
        } else {
            $table_users = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
        }

        $query_users = mysql_query($table_users);

        if (!$query_users)
            die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : " . mysql_error());

        $length_restore = mysql_numrows($query_restore);
        $length_users = mysql_numrows($query_users);
    }
    // same effect when the 'new user' button is pressed
    $new = 1;
    header("location: $_SERVER[PHP_SELF]");
}
?>
