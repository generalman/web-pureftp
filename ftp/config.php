<?php
  /* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005
   *  For more info look at http://machiel.generaal.net 333333
   *  Version 2.1
   */
  $version  = "v1.0.1 Final";      //Webpureftpd's version
  $LANG = "English";                  // See the directory language for the available languages.

  $LocationImages =  "images";        // Location of images
  
  $Logo = "sii.png";                    // file name of your logo. This file must be in the LocationImages.

  $DBHost = "127.0.0.1";              // Ip-address of MySQL server
                                      // (Don�t change this if you are using the default database)

  $DBLogin = "root";                   // Username of MySQL user

  $DBPassword = "P@ssw0rd";          // Password of MySQL user

  $DBDatabase = "ftpusers";           // Name of database

  $FTPAddress = "172.17.6.18:21";   // Domain name or ip-address of your ftp server

  $DEFUserID = "2001"; // nobody     // Default user id of virtual ftp user.

  $DEFGroupID = "2002";   // guest      // Default group is of virtual ftp user.

  $UsersFile = "/etc/passwd";        // The unix user file

  $GroupFile = "/etc/group";         // The unix group file
  
  $groupRO = "ftpro";         // group for read only
  
  $userRW = "ftpuser";         // group for read only
  

  $StyleSheet = "style/default.css.php"; // The location of the style sheet

  $EnableQuota = 1;                  // Enable virtual quota's (0=Off 1=On)

  $EnableRatio = 1;                  // Enable ratio (0=Off 1=On)
                                     // The pureftpd server has to be compiled with ratio support.

  /* This list of users will NOT appear in the dropdown menu. */
  $BlacklistUsers = array ('adm','bin','bind','daemon','gopher','halt','kmem','lp',
                           'mailnull','man','named','nfsnobody','nscd','operator',
                           'pop','root','rpc','rpcuser','rpm','shutdown','smmsp',
                           'sshd','sync','toor','tty','uucp','vcsa','xfs');

  /* This list of groups will NOT appear in the dropdown menu. */
  $BlacklistGroups = array ('adm','bin','bind','daemon','dialer','dip','disk','floppy','gopher','kmem',
                           'lock','lp','mailnull','man','named','mem','network','news',
                           'nscd','ntp','operator','pcap','root','rpc','rpcuser','rpm','slocate','smmsp',
                           'sshd','staff','sys','tty','utmp','uucp','vcsa','wheel','xfs');

?>
