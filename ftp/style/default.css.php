<?php

	require ('../config.php');

?>

/* Global */

body {
	font-family: Verdana,  Arial;
	text-decoration:none;
	color: #000000;
	font-size: 12px;
}



input {
	font-family: Verdana,  Arial;
	text-decoration:none;
	color: #000000;
	font-size: 12px;
}

table {
	font-size: 12px;
}

a {
	text-decoration:none;
	color: #000000;
}

a:visited {
	text-decoration: none;
	color: default;
}

a:hover {
	color: #FF0000;
}

.help {
	cursor: help
}
.titre {
	color: #FFFFFF;
        font-weight: bold;
        font-size: 20;
}

/* Login page */

table.login_user {
	background-color: #CCCCCC;
}

table.login_user_border {
	background-color: #000000;
}

input.login_button {
}

/* Admin page */

table.select_user {
	background-color: rgb(0, 0, 0);
}

tr.select_user {
	background-color: rgb(195, 214, 230);
}

tr.select_locked_user {
	background-color: rgb(235, 234, 219);
}
tr.select_warning_user {
	background-color: rgb(255, 188, 122);
}
tr.select_critical_user {
	background-color: rgb(255, 102, 102);
}

input.name {

	border: 0px solid purple;
	height: 19px;
	width:100px;
	margin:2px 0px 0px 0px;
	background-color: transparent;
	cursor:hand;
	vertical-align: bottom;

}

input.directory_location {
	border: 0px solid purple;
	height: 19px;
	width: 300px;
	margin:3px 0px 0px 0px;
	vertical-align: bottom;
	horizontal-align: right;
	margin-left: 4px;
	background-color: transparent;
}

tr.column_name_select_user {
	background-color: rgb(235, 234, 219);
	color: rgb(0, 0, 0);
	font-weight: bold;

}
tr.column_name_select_user_up {
	background-color: rgb(89,137,225);
	color: rgb(255, 255, 255);
	font-weight: bold;

}
table.edit_user {
	border-collapse:collapse;
}

tr.edit_user {
	background-color: rgb(235, 234, 219);
}


/* l = left
   r = right
   t = top
   b = bottom */

td.border_ltb {
	padding-left: 3px;
	border-left:   1px solid black;
	border-top:    1px solid black;
	border-bottom: 1px solid black;
}

td.border_lrtb {
	padding-left: 3px;
	border-left:   1px solid black;
	border-right:  1px solid black;
	border-top:    1px solid black;
	border-bottom: 1px solid black;
}

td.border_rtb {
	border-right:  1px solid black;
	border-top:    1px solid black;
	border-bottom: 1px solid black;
}

td.border_r {
	border-right:  1px solid black;
}

td.border_rb {
	border-right:  1px solid black;
	border-bottom: 1px solid black;
}
td.border_rt {
	border-right:  1px solid black;
	border-top: 1px solid black;
}

td.border_l {
	padding-left: 3px;
	border-left:   1px solid black;
}

td.border_lr {
	padding-left: 3px;
	border-left:   1px solid black;
	border-right:  1px solid black;
}
td.border_lrb {
	padding-left: 3px;
	border-left:   1px solid black;
	border-right:  1px solid black;
	border-bottom:    1px solid black;
}
td.border_lrt {
	padding-left: 3px;
	border-left:   1px solid black;
	border-right:  1px solid black;
	border-top:    1px solid black;
}

img.icon {
	width: 16px;
	height: 16px;
	border-style: none;
	border-width: 0px;
	vertical-align: center;
	margin-left: 2px;
}

table.header {
	border-collapse:collapse;
	background-repeat: repeat-x;
	background-position: left top;
	background-image: url(<?=$LocationImages?>/header.png);
}

td.header-left, td.header-right {
	background-image: url(<?=$LocationImages?>/header_seperator.png);
	background-repeat: no-repeat;
	background-position: right top;

}

td.header-left {
	padding-left: 1px;
	text-align: left;
}

td.header-right {
	text-align: right;
	padding-right: 4px;
}

input.description {
	font-size: 11px;
	background-color: transparent;
	cursor:hand;
	border: 0px solid purple;
	height: 17px;
	vertical-align: bottom;
}

td.left, td.right {
	vertical-align: bottom;
	background-image: url(<?=$LocationImages?>/header_seperator2.png);
	background-repeat: no-repeat;
	background-position: right top;
	border-top:     #ffffff 1px solid;
	border-left:    #ffffff 1px solid;
	border-bottom:  #cccccc 1px solid;
}

td.left {
	text-align: left bottom;
	padding: 0px;
	padding-left: 1px;
	font-size: 12px;
}

td.right {
	text-align: right;
	padding-right: 4px;
	font-size: 12px;
}

td.last {
	text-align: left bottom;
	vertical-align: bottom;
	background-repeat: no-repeat;
	background-position: right top;
	border-top:     #ffffff 1px solid;
	border-left:    #ffffff 1px solid;
	border-bottom:  #cccccc 1px solid;
}

.form .input { border: 1px solid #A5C2C8; line-height: 1.2em; padding: 5px 26px 5px 5px; margin: 0 0 5px 0; width: 537px; font: bold 1.2em Helvetiva, Arial, sans-serif; }

.banniere{
	background-image:url(/images/banniere.png);
	
} 

