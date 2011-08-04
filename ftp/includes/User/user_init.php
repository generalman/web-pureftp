<?php

$password = "empty";
$confirm_password = "empty";

$QuotaGlobal = mysql_result($query_admin, 0, "QuotaClient");

if (!empty($_GET['id'])) {
    $iCounter = 0;
    while ($iCounter < $length_users) {

        $userid = mysql_result($query_users, $iCounter, "User");
        if ($userid == $_GET['id']) {
            $user = $userid;
            // $password     = mysql_result($query_users,$iCounter,"Password");
            $uid = mysql_result($query_users, $iCounter, "Uid");
            $gid = mysql_result($query_users, $iCounter, "Gid");
            $dir2 = mysql_result($query_users, $iCounter, "Dir");
            $dir = mysql_result($query_users, $iCounter, "Dir");
            $status = mysql_result($query_users, $iCounter, "Status");
            $quotafiles = mysql_result($query_users, $iCounter, "QuotaFiles");
            $quotasize = mysql_result($query_users, $iCounter, "QuotaSize");
            $ulbandwidth = mysql_result($query_users, $iCounter, "ULBandwidth");
            $dlbandwidth = mysql_result($query_users, $iCounter, "DLBandwidth");
            $dlratio = mysql_result($query_users, $iCounter, "DLRatio");
            $ulratio = mysql_result($query_users, $iCounter, "ULRatio");
            $ipaddress = mysql_result($query_users, $iCounter, "Ipaddress");
            $comment = mysql_result($query_users, $iCounter, "Comment");
            $client_box = mysql_result($query_users, $iCounter, "Client");
            break;
        }
        $iCounter++;
    }
} else if (empty($new)) { // $new != 1

    $user = $_POST['username_box'];
    //$password         = "empty";
    $password = $_POST['password_box'];
    $confirm_password = $_POST['confirm_password_box'];
    //$dir              = $_POST['dir_box']."/".$user;

    $status = $_POST['status_box'];
    $quotafiles = $_POST['quotafiles_box'];
    $quotasize = $_POST['quotasize_box'];
    $comment = $_POST['comment_box'];
    $client_box = $Client;
    $uid = $_POST['uid_box'];
    $gid = $_POST['gid_box'];
    if ($Client == "Administrator") {
        $client_box = $_POST['client_box'];
        $ulbandwidth = $_POST['ulbandwidth_box'];
        $dlbandwidth = $_POST['dlbandwidth_box'];
        $dlratio = $_POST['dlratio_box'];
        $ulratio = $_POST['ulratio_box'];
        $ipaddress = $_POST['ipaddress_box'];
        $dir = $_POST['dir_box2'];
    } else {
        $ulbandwidth = "0";
        $dlbandwidth = "0";
        $dlratio = "0";
        $ulratio = "0";
        $ipaddress = "*";
        $client_box = $Client;
        $dir = $DefaultDir . "/" . $user;
    }
} else {

    $user = $Translate[10];
    $password = "";
    $confirm_password = "";
    $uid = "";
    $gid = "";
    $dir = $DefaultDir . "/" . $user;
    $status = "1";
    $quotafiles = "1000";
    $quotasize = $QuotaGlobal / 100;
    $ulbandwidth = "0";
    $dlbandwidth = "0";
    $dlratio = "0";
    $ulratio = "0";
    $ipaddress = "*";
    $client_box = $Client;
    $comment = "";
}



$small_erea = 150;
$large_erea = 275;
$middle_erea = 570;
?>
