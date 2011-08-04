<?php

// Read the userfile for example '/etc/passwd'
// todo check security settings of php
$filename = $UsersFile;
$fh = fopen($filename, "r");

$iNrofunixusers = 0;

while (!feof($fh)) {
    $line = fgets($fh, 4096);
    $data = explode(":", $line);

    $user = trim($data[0]);
    $user_id = trim($data[2]);


    if ($user[0] != '#' &&
            strlen($user) != 0 &&
            strlen($user_id) != 0) {
        if (compare_array($user, $BlacklistUsers) == -1) { // no hit
            $unix_users[$iNrofunixusers] [0] = $user;
            $unix_users[$iNrofunixusers] [1] = $user_id;
            $iNrofunixusers++;
        }
    }
}
fclose($fh);

// Read the groupfle for example '/etc/groups'
$filename = $GroupFile;
$fh = fopen($filename, "r");
$iNrofunixgroups = 0;

while (!feof($fh)) {

    $line = fgets($fh, 4096);
    $data = explode(":", $line);

    $group = trim($data[0]);
    $group_id = trim($data[2]);

    if ($group[0] != '#' &&
            strlen($group) != 0 &&
            strlen($group_id) != 0) {
        if (compare_array($group, $BlacklistGroups) == -1) { // no hit
            $unix_groups[$iNrofunixgroups] [0] = $group;
            $unix_groups[$iNrofunixgroups] [1] = $group_id;
            $iNrofunixgroups++;
        }
    }
}
fclose($fh);

?>
