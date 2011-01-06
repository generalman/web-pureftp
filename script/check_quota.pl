#!/usr/bin/perl
# Titre : Parseur de fichier log
# Auteur : Olivier Legras
# Date : 03/08
# Version : 1.1
#
# Description : Ce script permet d'alleger la base mysql rempli par le script parser_syslog.pl. 
#

use strict;
use DBI(); # Utilisation de la BD

my $temps_ecoule;my $partenaire; my $categorie; my $host2; my $timestamp2;
my $type;
my $message;
my @liste;
my $host; my $i_message;my $occurence;
my $timestamp_dernier;
my $type ;my $categorie; my $partenaire; my $occurence_total; my $user; my $sth;
my $dbh = DBI->connect("DBI:mysql:database=ftpusers;host=127.0.0.1",
                          "root", "",
                          {'RaiseError' => 1});

#HISTORIQUE


##On lit la table message en fonction du hosts
my $sth2= $dbh->prepare("SELECT Dir, User FROM users");
$sth2->execute();
my $i=0;
my $commande;my $path; my $Resultat; my $Resultat2;
while (my $ref2 = $sth2->fetchrow_hashref()) {
   $path = $ref2->{'Dir'};
    if ( -d $path )
    {
      if ( -f "$path/.ftpquota" ) {
        $commande="cat $path/.ftpquota | awk {\'print \$2\'}";
        $Resultat=`$commande`;
        $commande="cat $path/.ftpquota | awk {\'print \$1\'}";
        my $sth_quota= $dbh->prepare("UPDATE `ftpusers`.`users` SET QuotaDiskUsage='$Resultat', QuotaFilesUsage='$Resultat2' WHERE Dir='$path'");
        $sth_quota->execute();
      }
   }

}


#Activation des comptes en lecture seule si leur repertoire de base existe
$sth2= $dbh->prepare("SELECT Dir, User FROM users WHERE block=1");
$sth2->execute();

while (my $ref2 = $sth2->fetchrow_hashref()) {
 $path = $ref2->{'Dir'};  
 $user = $ref2->{'User'};
 if ( -d $path ) {
   my $sth_quota= $dbh->prepare("UPDATE `ftpusers`.`users` SET block='0', Status='1' WHERE User='$user'");
   $sth_quota->execute();
   print "Activation du compte $user car son chemin est cree";
 }

}
$sth2->finish();
