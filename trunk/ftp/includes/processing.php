<?php
//Connexion à la base de données
include "Global/connect.php";

//Initialisation des requetes Mysql
include "Global/Init_mysql_request.php";

//Lister les uid et gid pour Espace SuperAdministrateur
include "Admin/uid-gid-list.php";

//////////////////////BEGIN- EDIT CREATE USER//////////////////////////////
include("User/edit-create-user.php");

//////////////////////END - EDIT CREATE USER//////////////////////////////
//////////////////////BEGIN - EDIT CREATE ADMIN///////////////////////////

include("Admin/edit-create-admin.php");


/////////////////////////END - EDIT CREATE ADMIN //////////////////////////

//////////////////////BEGIN - RESTORE USER -  ADMIN///////////////////////////
include("Admin/restore.php");

//////////////////////END - RESTORE USER -  ADMIN///////////////////////////

// If the delete button is pressed
include("Admin/delete-user.php");

// If the delete admin button is pressed
include ("Admin/delete-admin.php");

?>