<?php

$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");

if (!$link)
    die("<br>Error: MySql server not found.<br><br>MySql error : " . mysql_error());


if (!@mysql_select_db("$DBDatabase"))
    die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : " . mysql_error());

$LoginName = $_SESSION['LoginName'];
?>
