<?php



		$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");

		if(!$link)
			die("<br>Error: MySql server not found.<br><br>MySql error : ".mysql_error());


		if (!@mysql_select_db("$DBDatabase"))
			die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$LoginName=$_SESSION['LoginName'];
		
		//Init Mysql Request
		$table_admin  = "SELECT * FROM admin WHERE Username='$LoginName'";
		$query_admin  = mysql_query($table_admin);
		$table_admin_all  = "SELECT * FROM admin ORDER BY Username ASC";
		$query_admin_all  = mysql_query($table_admin_all);
		$DefaultDir=mysql_result($query_admin,0,"DefaultDir");
		$Client=mysql_result($query_admin,0,"Client");
		$QuotaClient=mysql_result($query_admin,0,"QuotaClient");
		
		//Select Specific User
		if (isset($_POST['username_box'])){
       $table_users_uniq  = "SELECT * FROM users WHERE User='".$_POST['username_box']."'";
    }
    if (isset($_GET['username_box'])){
       $table_users_uniq  = "SELECT * FROM users WHERE User='".$_GET['username_box']."'";
    }
    
		$query_users_uniq  = mysql_query($table_users_uniq); 
		
	
		
		//initialisation users
		if ($Client=="Administrator"){
		  $table_users  = "SELECT * FROM users ORDER BY User ASC";
		  $query_users_restore  = mysql_query($table_users);
		  $table_users_restore  = "SELECT * FROM corbeille WHERE User='".$_GET['username_box']."'";
      $query_users_restore  = mysql_query($table_users_restore);
      
      
      
      
      
      if ($_GET['sort']=='corbeillequotafull'){
        $table_restore  = "SELECT * FROM corbeille ORDER BY QuotaSize DESC";
      }
      elseif ($_GET['sort']=='corbeilledir'){
        $table_restore  = "SELECT * FROM corbeille ORDER BY Dir ASC";
      }
      elseif ($_GET['sort']=='corbeillerights'){
        $table_restore  = "SELECT * FROM corbeille ORDER BY Uid ASC";
      }
      elseif ($_GET['sort']=='corbeillequotause'){
        $table_restore  = "SELECT * FROM corbeille ORDER BY QuotaClientPercentUse DESC";
      }
      else{
      $table_restore  = "SELECT * FROM corbeille ORDER BY User ASC";
      }
      $query_restore  = mysql_query($table_restore);		
		}
		else{
		
      if ($_GET['sort']=='quotafull'){
        $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY QuotaSize DESC";
      }
      elseif ($_GET['sort']=='dir'){
        $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY Dir ASC";
      }
      elseif ($_GET['sort']=='rights'){
        $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY Uid ASC";
      }
      elseif ($_GET['sort']=='quotause'){
        $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY QuotaClientPercentUse DESC";
      }
      else{
       $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
      }
    }
    $query_users  = mysql_query($table_users);
    
		if (!$query_users)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_users = mysql_numrows($query_users);
		$length_admin = mysql_numrows($query_admin_all);
		$length_restore = mysql_numrows($query_restore);
		$length_users_restore = mysql_numrows($query_restore);
		$length_users_uniq = mysql_numrows($query_users_uniq);
		
		// Function: compare_array ();
		// Returns the position of '$word' in the array '$array'
		// if '$word' does not exist the function returns '-1'

		function compare_array($word,$array)
		{
			$iCounter = 0;
			while ($iCounter < count($array))
			{
				if($word == $array[$iCounter])
				{
					return $iCounter;
					break;
				}
				$iCounter++;
			}
			return -1;
		}

		// Read the userfile for example '/etc/passwd'
		// todo check security settings of php
		$filename = $UsersFile;
		$fh = fopen($filename,"r");

		$iNrofunixusers = 0;

		while (!feof ($fh))
		{
			$line = fgets($fh,4096);
			$data = explode(":",$line);

			$user = trim($data[0]);
			$user_id = trim($data[2]);


			if ($user[0] != '#' &&
					strlen($user) != 0 &&
					strlen($user_id) != 0)
			{
				if(compare_array($user,$BlacklistUsers) == -1) // no hit
				{
					$unix_users[$iNrofunixusers] [0] = $user;
					$unix_users[$iNrofunixusers] [1] = $user_id;
					$iNrofunixusers++;
				}
			}
		}
		fclose($fh);

		// Read the groupfle for example '/etc/groups'
		$filename = $GroupFile;
		$fh = fopen($filename,"r");
		$iNrofunixgroups = 0;

		while (!feof ($fh))
		{

			$line = fgets($fh,4096);
			$data = explode(":",$line);

			$group = trim($data[0]);
			$group_id = trim($data[2]);

			if ($group[0] != '#' &&
					strlen($group) != 0 &&
					strlen($group_id) != 0)
			{
				if(compare_array($group,$BlacklistGroups) == -1) // no hit
				{
					$unix_groups[$iNrofunixgroups] [0] = $group;
					$unix_groups[$iNrofunixgroups] [1] = $group_id;
					$iNrofunixgroups++;
				}
			}
		}
		fclose($fh);

		// New user
		if($_GET['new'] == 1 || empty($_POST['username_box'])){
			$new = 1;}
		if (isset($_GET['id'])){
			$new=0;
		}
		$data_saved=1;

    


    //////////////////////BEGIN- EDIT CREATE USER//////////////////////////////

		// Save button is pressed
		if(isset($_POST['save']))
		{
      
			$empty_password = 0;
			$vallid_password = 1;

			// check if password if filled
			if (strlen($_POST['password_box']) == 0 || ($_POST['password_box'] == "empty"))
				$empty_password = 1;

			// check for vallid password
			if ($_POST['confirm_password_box'] != $_POST['password_box']){
				$vallid_password = 0;
				echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[21]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					
			}
			
				$result=testpassword($_POST['password_box']);
				
				if (($result<40)&&($_POST['password_box']!='empty')){
					 echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[124]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					$vallid_password = 0;
					
					
				}
				
				
			
				

			$iExistUser=0;
			$QuotaFull=0;
      $iCounter=0;
      $block_user=0;
			

			// Find out of user exist
			while ($iCounter < $length_users_uniq)
			{
				
				$message_nr = mysql_result($query_users_uniq,$iCounter,"User");
				$message_client = mysql_result($query_users_uniq,$iCounter,"Client");
				if ($message_nr == $_POST['username_box'])
				{
					
					if ($message_client!=$_POST['client_box']){
						
						$iExistUser=2;
						
					}
					else{
						$iExistUser=1;
					}
					break;
				}
				$iCounter++;
			}
      $iCounter=0;
      
      /////////////////////////// LIMITATION QUOTA //////////////////////////////
      $QuotaAddition=0;
      $modificationquota=0;
      
      //Quota Client
      //Recuperer le quota du client
      while ($iCounter < $length_users)
		{
 			$quotasize       = mysql_result($query_users,$iCounter,"QuotaSize");
 			$useractu= mysql_result($query_users,$iCounter,"User");

 			if  ($_POST['username_box']==$useractu){
 			
          if  ($quotasize!=$_POST['quotasize_box']){
            //On additionne la nouvelle valeur et non l'ancienne
            
           $QuotaAddition =   $QuotaAddition +  $_POST['quotasize_box'];
            
            $modificationquota=1;
          }
       }
       else{
           $QuotaAddition= $QuotaAddition +  $quotasize;
       }
 			
      	$iCounter++;
        
     }
     //cas ou l'utilisateur n'existe pas
      if ($iExistUser == 0)
			{
        $QuotaAddition =   $QuotaAddition +  $_POST['quotasize_box'];
      }
      //on ajoute le quota du nouvel utilisateur
       
      
       
      $QuotaGlobal  = mysql_result($query_admin,0,"QuotaClient");
       
      if ($QuotaGlobal<$QuotaAddition){
         
         $QuotaFull=1;
      }
      //Additionner les quotas des utilisateurs du client
      // Si La somme est superieur strict au quota client
      // Message d'erreur. Vous avez �puis� votre quota
      
     /////////////////////////////FIN LIMITATION QUOTA ///////////////// 

     
			// Utilisateur existant et appartient au client donc c'est une modification
			if ($iExistUser != 0)
			{
				
        // Attention Quota explosé
        if (($QuotaFull==1)&&($Client!="Administrator")){
          echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[111]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					
        
        }
        else{
        //Attention l'utilisateur existe deja chez un autre client ou chez ce client mais c'est une création qui est demandé.
        if (($_POST['new_box']==1)|| ($iExistUser == 2)){
          echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[123]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					
        
        }
        else{
        
        
				//  update current ftp account
				
  				if (($empty_password == 1)&&($vallid_password!=0)) // update without password
  				{
  
  						echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  						echo ("<!--\n\n");
  						echo ("  alert(\"".$Translate[22]."\");\n\n");
  						echo ("-->\n");
  						echo ("</script>\n");
  
               $block_user  = mysql_result($query_users_uniq,0,"block");
     
               if    ($block_user=="1") {
                   $_POST['status_box']=0;
                   	echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  					       	echo ("<!--\n\n");
  					       	echo ("  alert(\"".$Translate[118]."\");\n\n");
  					       	echo ("-->\n");
  						      echo ("</script>\n");
                }

  						
  
  						if(!mysql_query("UPDATE users SET Uid='".$_POST['uid_box']."',
  																							Gid='".$_POST['gid_box']."',
  																							Dir='".$_POST['dir_box']."',
  																							QuotaFiles='".$_POST['quotafiles_box']."',
  																							QuotaSize='".$_POST['quotasize_box']."',
  																							ULBandwidth='".$_POST['ulbandwidth_box']."',
  																							DLBandwidth='".$_POST['dlbandwidth_box']."',
  																							ULRatio='".$_POST['ulratio_box']."',
  																							DLRatio='".$_POST['dlratio_box']."',
  																							Status='".$_POST['status_box']."',
  																							Ipaddress='".$_POST['ipaddress_box']."',
  																							Client='".$_POST['client_box']."',
  																							Comment='".$_POST['comment_box']."'
  																							WHERE User='".$_POST['username_box']."'",$link))
  						{
  							echo ("<br>Error: Not a valid UPDATE query.<br>");
  							echo ("<br>MySql errorss : ".mysql_error());
  							  
  						}
  					}else
  					{ 
  					
  						if(!mysql_query("UPDATE users SET Password='".md5($_POST['password_box'])."',
  																					Uid='".$_POST['uid_box']."',
  																					Gid='".$_POST['gid_box']."',
  																					Dir='".$_POST['dir_box']."',
  																					QuotaFiles='".$_POST['quotafiles_box']."',
  																					QuotaSize='".$_POST['quotasize_box']."',
  																					ULBandwidth='".$_POST['ulbandwidth_box']."',
  																					DLBandwidth='".$_POST['dlbandwidth_box']."',
  																					ULRatio='".$_POST['ulratio_box']."',
  																					DLRatio='".$_POST['dlratio_box']."',
  																					Status='".$_POST['status_box']."',
  																					Ipaddress='".$_POST['ipaddress_box']."',
  																					Comment='".$_POST['comment_box']."'
  																					WHERE User='".$_POST['username_box']."'",$link))
  						{
  							echo ("<br>Error: Not a valid UPDATE query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
  							
  						}else
  						{
  							echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  							echo ("<!--\n\n");
  							echo ("  alert(\"".$Translate[23]."\");\n\n");
  							echo ("-->\n");
  							echo ("</script>\n");
  							
  						}
  					}
  				}
				}
			}else // New user
			{
        if (($QuotaFull==1)&&($Client!="Administrator")){
            echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  					echo ("<!--\n\n");
  					echo ("  alert(\"".$Translate[110]."\");\n\n");
  					echo ("-->\n");
  					echo ("</script>\n");
  					
          
          }
          else{
          
  				// Create new User
  				if ($vallid_password != 0 || $empty_password != 1 )
  				{
  				 if  ($_POST['uid_box']!="2001"){
               if (!is_dir($_POST['dir_box']))
                  $_POST['status_box']=0;
                  $block_user=1;
                 echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  					     echo ("<!--\n\n");
  					     echo ("  alert(\"".$Translate[114]."\");\n\n");
  					     echo ("-->\n");
  					     echo ("</script>\n");
           }
  				
  					if(!mysql_query("INSERT INTO users (User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Client,block,Comment)
  																							VALUES ('".$_POST['username_box']."',
  																							'".md5($_POST['password_box'])."',
  																							'".$_POST['uid_box']."',
  																							'".$_POST['gid_box']."',
  																							'".$_POST['dir_box']."',
  																							'".$_POST['quotafiles_box']."',
  																							'".$_POST['quotasize_box']."',
  																							'".$_POST['ulbandwidth_box']."',
  																							'".$_POST['dlbandwidth_box']."',
  																							'".$_POST['ulratio_box']."',
  																							'".$_POST['dlratio_box']."',
  																							'".$_POST['status_box']."',
  																							'".$_POST['ipaddress_box']."',
  																							'".$_POST['client_box']."',
  																							'".$block_user."',
  																							'".$_POST['comment_box']."')",$link))
  					{
  							echo ("<br>Error: Not a valid INSERT query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
  					}
  				}
				}
			}
			// reload the database users
			if ($Client=="Administrator"){
		  $table_users  = "SELECT * FROM users ORDER BY User ASC";
		  		
		}
		else{
      
         $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
      
    }
    
    $query_users  = mysql_query($table_users);
    
		if (!$query_users)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_users = mysql_numrows($query_users);
		}

    //////////////////////END - EDIT CREATE USER//////////////////////////////

    //////////////////////BEGIN - EDIT CREATE ADMIN///////////////////////////
     
     
      /*$user             = $_POST['admin3'];
			$admin3_password  = $_POST['admin3_password'];
			$admin3_password_confirm = $_POST['admin3_password_confirm'];
			$admin3_dir       = $_POST['admin3_dir'];
			$admin3_client    = $_POST['admin3_client'];
			$admin3_quota    = $_POST['admin3_quota'];  */
			
			
     
     
    // Save button is pressed
			if(isset($_POST['save_admin']))
		{
      
			$emptyadmin_password = 0;
			$vallidadmin_password = 1;
			
			

			// check if password if filled
			if (strlen($_POST['admin3_password']) == 0 || ($_POST['admin3_password'] == "empty")){
				$emptyadmin_password = 1;
				
         }
			// check for vallid password
			if ($_POST['admin3_password_confirm'] != $_POST['admin3_password']){
				$vallidadmin_password = 0;
				
        } 
        
			$iExistAdmin=0;
      $iCounter=0;
    // Find out of user exist
			while ($iCounter < $length_admin)
			{
				$message_nr = mysql_result($query_admin_all,$iCounter,"Username");
				    
				if ($message_nr == $_POST['admin3'])
				{
					$iExistAdmin=1;
					break;
				}
				$iCounter++;
			}
            
			if ($iExistAdmin == 1)
			{
            
				//  update current admin account
				if ($vallidadmin_password == 0)
				{    
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[21]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
				}else
				{
					if ($emptyadmin_password == 1) // update without password
					{
             
						echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
						echo ("<!--\n\n");
						echo ("  alert(\"".$Translate[22]."\");\n\n");
						echo ("-->\n");
						echo ("</script>\n");


            if(!mysql_query("UPDATE admin SET DefaultDir='".$_POST['admin3_dir']."',
																							QuotaClient='".$_POST['admin3_quota']."',
																							Client='".$_POST['admin3_client']."' WHERE Username='".$_POST['admin3']."'",$link))
						{
							echo ("<br>Error: Not a valid UPDATE query.<br>");
							echo ("<br>MySql error : ".mysql_error());


						}
						else{
              //reload
              $table_admin_all  = "SELECT * FROM admin ORDER BY Username ASC";
				$query_admin_all  = mysql_query($table_admin_all);
				$length_admin = mysql_numrows($query_admin_all);
            
            }
					}else
					{  
						if(!mysql_query("UPDATE admin SET Password='".md5($_POST['admin3_password'])."',
																					DefaultDir='".$_POST['admin3_dir']."',
																							QuotaClient='".$_POST['admin3_quota']."',
																							Client='".$_POST['admin3_client']."' WHERE Username='".$_POST['admin3']."'",$link))
						{
							echo ("<br>Error: Not a valid UPDATE query.<br>");
							echo ("<br>MySql error : ".mysql_error());

						}else
						{
							echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
							echo ("<!--\n\n");
							echo ("  alert(\"".$Translate[23]."\");\n\n");
							echo ("-->\n");
							echo ("</script>\n");
							
							//reload
							$table_admin_all  = "SELECT * FROM admin ORDER BY Username ASC";
				      $query_admin_all  = mysql_query($table_admin_all);
				      $length_admin = mysql_numrows($query_admin_all);
						}
					}
				}
			}else // New user
			{
          
				// Create new User
				if ($vallidadmin_password == 0 || $emptyadmin_password == 1)
				{   
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[21]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					$data_saved = 0;
				}else
				{   
					if(!mysql_query("INSERT INTO admin (Username,Password,DefaultDir,Client, QuotaClient) VALUES ('".$_POST['admin3']."','".md5($_POST['admin3_password'])."','".$_POST['admin3_dir']."','".$_POST['admin3_client']."','".$_POST['admin3_quota']."')",$link))
					{
							echo ("<br>Error: Not a valid INSERT query.<br>");
							echo ("<br>MySql error : ".mysql_error());
					}
				}
			   // reload the database users
  			$table_admin_all  = "SELECT * FROM admin ORDER BY Username ASC";
  			$query_admin_all  = mysql_query($table_admin_all);
  			$length_admin = mysql_numrows($query_admin_all); 
      }
			
		}
    
    
   
    
    /////////////////////////END - EDIT CREATE ADMIN //////////////////////////

			// If the restore button is pressed
			
		if(isset($_GET['restore']) && isset($_GET['username_box']))
		{
		
		  $user_delete  = mysql_result($query_users_restore,0,"User");
		  $password_delete  = mysql_result($query_users_restore,0,"Password");
		  $uid_delete  = mysql_result($query_users_restore,0,"Uid");
		  $gid_delete  = mysql_result($query_users_restore,0,"Gid");
		  $dir_delete  = mysql_result($query_users_restore,0,"Dir");
		  $quotafiles_delete  = mysql_result($query_users_restore,0,"QuotaFiles");
		  $quotasize_delete  = mysql_result($query_users_restore,0,"QuotaSize");
		  $ulbandwidth_delete  = mysql_result($query_users_restore,0,"ULBandwidth");
		  $dlbandwidth_delete  = mysql_result($query_users_restore,0,"DLBandwidth");
		  $ipaddress_delete  = mysql_result($query_users_restore,0,"Ipaddress");
		  $comment_delete  = mysql_result($query_users_restore,0,"Comment");
		  $status_delete  = mysql_result($query_users_restore,0,"Status");
		  $ulratio_delete  = mysql_result($query_users_restore,0,"ULRatio");
		  $dlratio_delete  = mysql_result($query_users_restore,0,"DLRatio");
		  $quotadiskusage_delete  = mysql_result($query_users_restore,0,"QuotaDiskUsage");
		  $quotafilesUsage_delete  = mysql_result($query_users_restore,0,"QuotaFilesUsage");
		  $Client_delete  = mysql_result($query_users_restore,0,"Client");
		  $QuotaClientPercentUser_delete  = mysql_result($query_users_restore,0,"QuotaClientPercentUse");
		  $block_delete  = mysql_result($query_users_restore,0,"block");
		  
		  
		  		  
		  	if(!mysql_query("INSERT INTO users (User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Client,block,Comment)
  																							VALUES ('".$user_delete."',
  																							'".$password_delete."',
  																							'".$uid_delete."',
  																							'".$gid_delete."',
  																							'".$dir_delete."',
  																							'".$quotafiles_delete."',
  																							'".$quotasize_delete."',
  																							'".$ulbandwidth_delete."',
  																							'".$dlbandwidth_delete."',
  																							'".$ulratio_delete."',
  																							'".$dlratio_delete."',
  																							'".$status_delete."',
  																							'".$ipaddress_delete."',
  																							'".$Client_delete."',
  																							'".$block_delete."',
  																							'".$comment_delete."')",$link))
  					{
  							echo ("<br>Error: Not a valid INSERT query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
  					}
		  
		  
			if(!mysql_query("DELETE FROM corbeille WHERE User='".$_GET['username_box']."'",$link))
			{
				echo ("<br>Error: Not a valid DELETE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				if ($Client=="Administrator"){
		  $table_users  = "SELECT * FROM users ORDER BY User ASC";
		  $table_restore  = "SELECT * FROM corbeille ORDER BY User ASC";
		  $query_restore  = mysql_query($table_restore);
		  		
		}
		else{
      $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
    }
    
    $query_users  = mysql_query($table_users);
    
		if (!$query_restore)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_restore = mysql_numrows($query_restore);
		$length_users = mysql_numrows($query_users);
			}
			// same effect when the 'new user' button is pressed
			$new=1;
		
    
      header("location: $_SERVER[PHP_SELF]");
		}
    
    // If the delete button is pressed
		if(isset($_GET['delete']) && isset($_GET['username_box']))
		{
		  
		  $user_delete  = mysql_result($query_users_uniq,0,"User");
		  $password_delete  = mysql_result($query_users_uniq,0,"Password");
		  $uid_delete  = mysql_result($query_users_uniq,0,"Uid");
		  $gid_delete  = mysql_result($query_users_uniq,0,"Gid");
		  $dir_delete  = mysql_result($query_users_uniq,0,"Dir");
		  $quotafiles_delete  = mysql_result($query_users_uniq,0,"QuotaFiles");
		  $quotasize_delete  = mysql_result($query_users_uniq,0,"QuotaSize");
		  $ulbandwidth_delete  = mysql_result($query_users_uniq,0,"ULBandwidth");
		  $dlbandwidth_delete  = mysql_result($query_users_uniq,0,"DLBandwidth");
		  $ipaddress_delete  = mysql_result($query_users_uniq,0,"Ipaddress");
		  $comment_delete  = mysql_result($query_users_uniq,0,"Comment");
		  $status_delete  = mysql_result($query_users_uniq,0,"Status");
		  $ulratio_delete  = mysql_result($query_users_uniq,0,"ULRatio");
		  $dlratio_delete  = mysql_result($query_users_uniq,0,"DLRatio");
		  $quotadiskusage_delete  = mysql_result($query_users_uniq,0,"QuotaDiskUsage");
		  $quotafilesUsage_delete  = mysql_result($query_users_uniq,0,"QuotaFilesUsage");
		  $Client_delete  = mysql_result($query_users_uniq,0,"Client");
		  $QuotaClientPercentUser_delete  = mysql_result($query_users_uniq,0,"QuotaClientPercentUse");
		  $block_delete  = mysql_result($query_users_uniq,0,"block");
		  
		  
		 
  																							
		  	if(!mysql_query("INSERT INTO corbeille (id,User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Client,block,Comment)
  																							VALUES ('','".$user_delete."',
  																							'".$password_delete."',
  																							'".$uid_delete."',
  																							'".$gid_delete."',
  																							'".$dir_delete."',
  																							'".$quotafiles_delete."',
  																							'".$quotasize_delete."',
  																							'".$ulbandwidth_delete."',
  																							'".$dlbandwidth_delete."',
  																							'".$ulratio_delete."',
  																							'".$dlratio_delete."',
  																							'".$status_delete."',
  																							'".$ipaddress_delete."',
  																							'".$Client_delete."',
  																							'".$block_delete."',
  																							'".$comment_delete."')",$link))
  					{
  							echo ("<br>Error: Not a valid INSERT query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
  					}
		  
		  
			if(!mysql_query("DELETE FROM users WHERE User='".$_GET['username_box']."'",$link))
			{
				echo ("<br>Error: Not a valid DELETE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				if ($Client=="Administrator"){
		  $table_users  = "SELECT * FROM users ORDER BY User ASC";
		  $table_restore  = "SELECT * FROM corbeille ORDER BY User ASC";
		  $query_restore  = mysql_query($table_restore);
		  		
		}
		else{
      $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
    }
    
    $query_users  = mysql_query($table_users);
    
		if (!$query_users)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_restore = mysql_numrows($query_restore);
		$length_users = mysql_numrows($query_users);
			}
			// same effect when the 'new user' button is pressed
			$new=1;
			header("location: $_SERVER[PHP_SELF]");
		}
		
		// If the delete admin button is pressed
		if(isset($_GET['delete']) && isset($_GET['admin_box']) && $Client=="Administrator")
		{
			if(!mysql_query("DELETE FROM admin WHERE Username='".$_GET['admin_box']."'",$link))
			{
				echo ("<br>Error: Not a valid DELETE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				$table_admin_all  = "SELECT * FROM admin ORDER BY Username ASC";
				$query_admin_all  = mysql_query($table_admin_all);
				$length_admin = mysql_numrows($query_admin_all);
			}
			// same effect when the 'new user' button is pressed
			$new=1;
		}


              

		// Lock or unlock button is pressed
		if(isset($_GET['lock']) && isset($_GET['username_box']))
		{
		  
		  $block_user  = mysql_result($query_users_uniq,0,"block");
      
      if    ($block_user=="1") {
         $_GET['lock']=0;
        	echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  		   	echo ("<!--\n\n");
  		   	echo ("  alert(\"".$Translate[118]."\");\n\n");
  		   	echo ("-->\n");
  		    echo ("</script>\n");
      }
		  
			if(!mysql_query("UPDATE users SET Status='".$_GET['lock']."' WHERE User='".$_GET['username_box']."'",$link))
			{
				echo ("<br>Error: Not a valid UPDATE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				if ($Client=="Administrator"){
		  $table_users  = "SELECT * FROM users ORDER BY User ASC";
		  		
		}
		else{
      $table_users  = "SELECT * FROM users WHERE Client='$Client' ORDER BY User ASC";
    }
    $query_users  = mysql_query($table_users);
    
		if (!$query_users)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_users = mysql_numrows($query_users);
			}
			// $new=1;
			$_GET['id'] = $_GET['username_box'];
		}
?>