<?php



    ////////////AFFICHAGE LISTE UTILISATEUR///////////////////////////
    
		echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    		
		echo ("<table class=\"banniere\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"850\">\n");
		echo ("<tr >\n");
		echo ("<td>\n");
		echo ("<img hspace=\"1\" src=\"$LocationImages/sii.png\" align=\"middle\" border=\"0\"><span class=\"titre\"<font size=\"+1\">&nbsp;".$Translate[0]."</font></span>\n");
		echo ("</td>\n");
		echo ("<td align=\"right\">");
		if ($Client!="Administrator"){
   			echo ("<a href=\"$_SERVER[PHP_SELF]\">");
			echo ("<img hspace=\"1\" src=\"$LocationImages/refresh.png\" title=\"".$Translate[121]."\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
			echo ("</a>");
    	}
		echo ("<a href=\"$_SERVER[PHP_SELF]?new=1\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/add_user.png\" title=\"".$Translate[31]."\" width=\"60\" height=\"60\" align=\"middle\" border=\"0\">");
		echo ("</a>");
		if ($Client!="Administrator"){
    echo ("<a href=\"disconnect.php\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/disconnect.png\" title=\"".$Translate[103]."\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
    echo ("</a>");
    }
		
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    if ($Client!="Administrator"){
    echo ("<table width=\"850\" border=\"0\">\n");
    
    $iCounter = 0;
    $QuotaClientUse = 0;
		while ($iCounter < $length_users)
		{
			
      $int         = mysql_result($query_users,$iCounter,"QuotaSize"); 
			$QuotaClientUse  =  $QuotaClientUse + $int;  
			$iCounter++;
    }
    $QuotaClientRestant=$QuotaClient-$QuotaClientUse;
    $QuotaClientPercentUse=$QuotaClientUse*100/$QuotaClient; 
      
		echo ("<tr class=\"column_name_select_user_up\">\n");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[100]." ".$Client."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[104]." ".$QuotaClient."M </td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[101]." ".$QuotaClientRestant."M "."</td>");
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[102]." ".$QuotaClientPercentUse."% "."</td>");
		echo ("</tr>\n");
		echo ("</table>\n");
		}
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
		echo ("<table width=\"850\" border=\"0\">\n");

		echo ("<tr class=\"column_name_select_user\">\n");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">".$Translate[32]."</a></td>");
		if ($Client=="Administrator"){
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">".$Translate[108]."</a></td>");
    
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">".$Translate[33]."</a></td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">".$Translate[34]."</a></td>");
		
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=user\">".$Translate[35]."</a></td>");
    }

		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[36]."</td>");
		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[37]."</td>");
		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[38]."</td>");
                echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=quotafull\">".$Translate[44]."</a></td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=quotause\">".$Translate[99]."</a></td>");
		
    if ($Client!="Administrator"){
      echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=dir\">".$Translate[35]."</a></td>");
      
  		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=rights\">".$Translate[117]."</a></td>");
		}
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]\">".$Translate[39]."</a></td>");
		
		echo ("</tr>\n");
    
		$iCounter = 0;

		while ($iCounter < $length_users)
		{

			$user         = mysql_result($query_users,$iCounter,"User");
			//$password     = mysql_result($query_users,$iCounter,"Password");
			$uid          = mysql_result($query_users,$iCounter,"Uid");
			$gid          = mysql_result($query_users,$iCounter,"Gid");
			$dir          = mysql_result($query_users,$iCounter,"Dir");
			//$ulbandwidth  = mysql_result($query_users,$iCounter,"ULBandwidth");
			//$dlbandwidth  = mysql_result($query_users,$iCounter,"DLBandwidth");
			$quotasize    =  mysql_result($query_users,$iCounter,"QuotaSize");
			$ipaddress    = mysql_result($query_users,$iCounter,"Ipaddress");
			$status       = mysql_result($query_users,$iCounter,"Status");
			$user_client  = mysql_result($query_users,$iCounter,"Client");
 			$quotafilesusage       = mysql_result($query_users,$iCounter,"QuotaFilesUsage");
			$quotadiskusage       = mysql_result($query_users,$iCounter,"QuotaDiskUsage");
			$quotapourcent     = round($quotadiskusage/1000/1024/$quotasize*100,2);
			
			//On rempli la base avec le pourcentage par user afin de faire du classement
			 if(!mysql_query("UPDATE users SET QuotaClientPercentUse='".$quotapourcent."' WHERE User='".$user."'",$link))
  						{
  							echo ("<br>Error: Not a valid UPDATE query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
      	      }

			
			
			
			
			if ($status == 1){
				//Quota Warning
				
				if (($quotapourcent > 80)&&($quotapourcent < 90)){
					echo ("<tr class=\"select_warning_user\">\n");
					
					
				}
				//Quota Critical
				elseif ($quotapourcent > 90){
					echo ("<tr class=\"select_critical_user\">\n");
					
				}
				else {
					echo ("<tr class=\"select_user\">\n");
				}
			}
			else
				echo ("<tr class=\"select_locked_user\">\n");
				


			echo ("<td align=\"left\" width=\"140\">");

			echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\" title=\"".$Translate[60]."\">");

			// Lock or unlock account
			if ($status == 1)
					echo ("<img src=\"$LocationImages/ftpuser.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");
			else
					echo ("<img src=\"$LocationImages/ftpuser_gray.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");

			echo ("<input class=\"name\" value=\"$user\" name=\"textfield\" type=\"text\">");


			echo ("</a></td>\n");
      if ($Client=="Administrator"){
      echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$user_client."</td>\n");
      
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$uid."</td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$gid."</td>\n");
      
			   echo ("<td title=\"".$dir."\">");
			   echo ("<input class=\"directory_location\" value=\"".$dir."\" name=\"textfield\" type=\"text\">");
			echo ("</td>");
			}
			// echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$ulbandwidth."</td>\n");
			// echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$dlbandwidth."</td>\n");
			// echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$ipaddress."</td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$quotasize." MB </td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$quotapourcent." % </td>\n");
			if ($Client!="Administrator"){
        echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$dir."</td>\n");
  			
        if ($uid=="2001"){
  			echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$Translate[115]." </td>\n");
  			}
  			elseif ($uid=="2002"){
  			echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$Translate[116]." </td>\n");
  			}
  			else{
          echo ("<td align=\"left\" style=\"padding-left: 2px;\"> NC </td>\n");
        }
      }
			echo ("<td align=\"center\" width=\"100\">");

			/* Edit ftp account */
			echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\">");
			if ($status == 1)
				echo ("<img src=\"$LocationImages/edit.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
			else
				echo ("<img src=\"$LocationImages/edit_gray.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
			echo ("title=\"".$Translate[60]."\" ");
			echo ("alt=\"".$Translate[60]."\"></a>&nbsp;&nbsp;");

			/* Delete ftp account */
			echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?delete=1&username_box=$user');return false;\">");
			if ($status == 1)
				echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			else
				echo ("<img src=\"$LocationImages/delete_gray.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			echo ("title=\"".$Translate[61]."\" ");
			echo ("alt=\"".$Translate[61]."\"></a>&nbsp;&nbsp;");

			/* Lock or unlock account */
			if ($status == 1)
			{
				echo ("<a href=\"$_SERVER[PHP_SELF]?lock=0&username_box=$user\" >");
				echo ("<img src=\"$LocationImages/lock_open.gif\" width=\"14\" height=\"18\" border=\"0\" ");
				echo ("title=\"".$Translate[62]."\" ");
				echo ("alt=\"".$Translate[62]."\"></a>&nbsp;&nbsp;");
			}else
			{
				echo ("<a href=\"$_SERVER[PHP_SELF]?lock=1&username_box=$user\" >");
				echo ("<img src=\"$LocationImages/lock_closed.gif\" width=\"14\" height=\"17\" border=\"0\" ");
				echo ("title=\"".$Translate[63]."\" ");
				echo ("alt=\"".$Translate[63]."\"></a>&nbsp;&nbsp;");
			}

			/* Open ftp account */
			if ($status == 1)
			{
				echo ("<a href=\"ftp://$user@".$FTPAddress."\" target=\"_blank\">");
				echo ("<img src=\"$LocationImages/connect.gif\" width=\"16\" height=\"18\" border=\"0\" ");
				echo ("title=\"".$Translate[64]."\" ");
				echo ("alt=\"".$Translate[64]."\"></a>");
			}else
			{
				echo ("<img src=\"$LocationImages/connect_gray.gif\" width=\"16\" height=\"18\" border=\"0\" ");
				echo ("alt=\"".$Translate[64]."\" >");
			}

			echo ("</td>\n");
			echo ("</tr>\n");
			$iCounter++;
		}

		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");
   ///////////////////////////FIN DE LISTAGE DES UTILISATEURS/////////////////////
   
   /////////////////////////////////FORM USER FTP/////////////////////////////////
		$password         = "empty";
		$confirm_password = "empty";
		
		$QuotaGlobal = mysql_result($query_admin,0,"QuotaClient");

		if(!empty($_GET['id']))
		{
			$iCounter=0;
			while ($iCounter < $length_users)
			{

				$userid = mysql_result($query_users,$iCounter,"User");
				if ($userid == $_GET['id'])
				{
					$user         = $userid;
					// $password     = mysql_result($query_users,$iCounter,"Password");
					$uid          = mysql_result($query_users,$iCounter,"Uid");
					$gid          = mysql_result($query_users,$iCounter,"Gid");
					$dir2          = mysql_result($query_users,$iCounter,"Dir");
                                        $dir          = mysql_result($query_users,$iCounter,"Dir");
					$status       = mysql_result($query_users,$iCounter,"Status");
					$quotafiles   = mysql_result($query_users,$iCounter,"QuotaFiles");
					$quotasize    = mysql_result($query_users,$iCounter,"QuotaSize");
					$ulbandwidth  = mysql_result($query_users,$iCounter,"ULBandwidth");
					$dlbandwidth  = mysql_result($query_users,$iCounter,"DLBandwidth");
					$dlratio      = mysql_result($query_users,$iCounter,"DLRatio");
					$ulratio      = mysql_result($query_users,$iCounter,"ULRatio");
					$ipaddress    = mysql_result($query_users,$iCounter,"Ipaddress");
					$comment      = mysql_result($query_users,$iCounter,"Comment");
					$client_box      = mysql_result($query_users,$iCounter,"Client");
					break;
				}
				$iCounter++;
			}
		}else if(empty($new)) // $new != 1
		{
      
			$user             = $_POST['username_box'];
			//$password         = "empty";
			$password         = $_POST['password_box'];
			$confirm_password = $_POST['confirm_password_box'];
			//$dir              = $_POST['dir_box']."/".$user;
      
			$status           = $_POST['status_box'];
			$quotafiles       = $_POST['quotafiles_box'];
			$quotasize        = $_POST['quotasize_box'];
			$comment          = $_POST['comment_box'];
			$client_box       = $Client;
			$uid              = $_POST['uid_box'];
			$gid              = $_POST['gid_box'];
			if ($Client=="Administrator"){
         $client_box       = $_POST['client_box'];
			   $ulbandwidth      = $_POST['ulbandwidth_box'];
			   $dlbandwidth      = $_POST['dlbandwidth_box'];
		     $dlratio          = $_POST['dlratio_box'];
			   $ulratio          = $_POST['ulratio_box'];
			   $ipaddress        = $_POST['ipaddress_box'];
         $dir               = $_POST['dir_box2'];		   
      }
      else{
         $ulbandwidth      = "0";
		     $dlbandwidth      = "0";
		     $dlratio          = "0";
			   $ulratio          = "0";
		     $ipaddress        = "*";
			   $client_box       = $Client;
			   $dir              = $DefaultDir."/".$user;	
      }

		}else
		{
                       
			$user             = $Translate[10];
			$password         = "";
			$confirm_password = "";
			$uid              = "";
			$gid              = "";
			$dir              = $DefaultDir."/".$user;
			$status           = "1";
			$quotafiles       = "1000";
			$quotasize        = $QuotaGlobal/100;
			$ulbandwidth      = "0";
			$dlbandwidth      = "0";
			$dlratio          = "0";
			$ulratio          = "0";
			$ipaddress        = "*";
			$client_box       = $Client;
			$comment          = "";
		}



		$small_erea = 150;
		$large_erea = 275;
		$middle_erea = 570;


		echo ("<br><br>");
		echo ("<table class=\"edit_user\" width=\"850\">\n");


		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[32]."</td>\n");
		echo ("<td class=\"border_lrtb\" width=\"$middle_erea\">\n&nbsp;");
		echo ("<input type=\"text\" name=\"username_box\" size=\"10\" maxlength=\"16\" onchange='document.newuserform.dir_box.value=\"".$DefaultDir."/\"+this.value;' value=\"$user\">\n");
		echo ("</td>\n");

		echo ("<td class=\"border_rtb\">");

		/*
		echo ("&nbsp; ".$Translate[40]."  <input type=\"checkbox\" name=\"status_box\" value=\"1\" ");
		if ($status == "1")
			echo ("checked");
		echo (">&nbsp;&nbsp;");
		
		*/

		echo ("<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
		echo ("<tr>");
		echo ("<td>");

		echo ("&nbsp;".$Translate[40]);
		echo ("</td>\n<td>\n");
		echo ("<input type=\"checkbox\" name=\"status_box\" value=\"1\" ");
		if ($status == "1")
			echo ("checked");
		echo (">&nbsp;&nbsp;");

		echo ("</td>");
		echo ("<td valign=\"bottom\">");
		information($Translate[90],$Translate[40]);

		echo ("</td>");
		echo ("</tr>");
		echo ("</table>\n");


		echo ("</td>\n");
		echo ("</tr>\n");



		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[41]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
		
		echo ("<input id=\"password_box\" type=\"password\" name=\"password_box\" size=\"20\" maxlength=\"64\" value=\"$password\">\n");
		echo ("\n<script src=\"includes/jquery.showpassword-1.0.js\" type=\"text/javascript\" charset=\"utf-8\"></script>\n");
		echo ("<input id=\"showcharacters\" name=\"showcharacters\" type=\"checkbox\" />Voir ");
		echo ("<script type=\"text/javascript\">\n");
		echo ("	// <![CDATA[	\n");
		echo ("	$(document).ready(function(){	\n");			
		echo ("		$('#password_box').showPassword('#showcharacters');\n");
		echo ("	});	\n");
		echo ("	// ]]>\n");
		echo ("</script>\n");
		
		
		information($Translate[126],$Translate[125]);
		
		//echo ("<script src=\"js/jquery-1.3.2.js\" type=\"text/javascript\" charset=\"utf-8\"></script>");

		
		
		
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[42]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
		echo ("<input type=\"password\" id=\"confirm_password_box\" name=\"confirm_password_box\" size=\"20\" maxlength=\"64\" value=\"$confirm_password\">\n");
		echo ("</td>\n");
		echo ("</tr>\n");
    if ($Client=="Administrator"){
		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[33]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");


		echo ("<select name=\"select_user\" onchange='document.newuserform.uid_box.value=this.value;' style='width: 100px;'>");
		echo ("<option value=\"\">select user</option>");
		$iCounter = 0;
		$iFound_uid = 0;
		while ($iCounter < $iNrofunixusers)
		{
			echo ("<option value=\"".$unix_users[$iCounter][1]."\"");
			if ($uid == $unix_users[$iCounter][1])
			{
				echo (" selected=\"selected\"");
			//	$select_user_old = $unix_users[$iCounter][1];
				$iFound_uid = 1;
			}
			echo (">".$unix_users[$iCounter][0]."</option>");
			$iCounter++;
		
    }
		echo ("</select>\n");
		echo ("<img src=\"$LocationImages/arrow_right.gif\" height=\"10\" width=\"10\"");
		echo (" hspace=\"1\" align=\"middle\" border=\"0\"> ");

		echo ("<input type=\"text\" name=\"uid_box\" size=\"11\" maxlength=\"11\" value=\"$uid\">\n");
		
		information($Translate[91],$Translate[33]);
		echo ("</td>\n");
		echo ("</tr>\n");
    //}
		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_lrtb\" width=\"$small_erea\">".$Translate[34]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
     
		echo ("<select name=\"select_group\" onchange='document.newuserform.gid_box.value=this.value;' style='width: 100px;'>");
		echo ("<option value=\"\">select group</option>");
		$iCounter = 0;

		$iFound_gid = 0;
		while ($iCounter < $iNrofunixgroups)
		{
			echo ("<option value=\"".$unix_groups[$iCounter][1]."\"");
			if ($gid == $unix_groups[$iCounter][1])
			{
				echo (" selected=\"selected\"");
				// $select_group_old = $unix_groups[$iCounter][1];
				$iFound_gid = 1;
			}
			echo (">".$unix_groups[$iCounter][0]."</option>");
			$iCounter++;
		}

		echo ("</select>\n");
    
		echo ("<img src=\"$LocationImages/arrow_right.gif\" height=\"10\" width=\"10\"");
		echo (" hspace=\"1\" align=\"middle\" border=\"0\"> ");

		echo ("<input type=\"text\" name=\"gid_box\" size=\"11\" maxlength=\"11\" value=\"$gid\">\n");
		
		information($Translate[92],$Translate[34]);
		echo ("</td>\n");
		echo ("</tr>\n");
    }
    else{
       
       echo ("<input type=\"hidden\" name=\"gid_box\" size=\"11\" maxlength=\"11\" value=\"$gid\">\n");
       echo ("<input type=\"hidden\" name=\"uid_box\" size=\"11\" maxlength=\"11\" value=\"$uid\">\n");
       echo ("<input type=\"hidden\" name=\"dir_box\" size=\"11\" maxlength=\"11\" value=\"$dir\">\n");
       echo ("<input type=\"hidden\" name=\"client_box\" size=\"11\" maxlength=\"11\" value=\"$client_box\">\n");
       echo ("<input type=\"hidden\" name=\"ulbandwidth_box\" size=\"11\" maxlength=\"11\" value=\"$ulbandwidth\">\n");
       echo ("<input type=\"hidden\" name=\"dlbandwidth_box\" size=\"11\" maxlength=\"11\" value=\"$dlbandwidth\">\n");
       echo ("<input type=\"hidden\" name=\"quotafiles_box\" size=\"11\" maxlength=\"11\" value=\"$quotafiles\">\n");
      echo ("</tr>\n"); 
      echo ("<tr class=\"edit_user\">\n");
      echo ("<td class=\"border_lr\" width=\"$small_erea\">".$Translate[112]."</td>\n");
      //echo ("</td>\n");
	    
    	echo ("<td class=\"border_lr\" colspan=\"2\"><table><tr><td><select id=\"select_uid\" name=\"select_uid\" onchange='change_uid_gid(this);'  style='width: 140px;'>");
		echo ("<option value=\"\"  ");if ($uid==""){echo ("selected=\"selected\"");}echo (">Droits Utilisateurs</option>");
		  
			echo ("<option value=\"2001\" ");if ($uid=="2001"){echo ("selected=\"selected\"");}echo (">Lecture et Ecriture</option>");
			
			
			
			echo ("<option value=\"2002\" ");if ($uid=="2002"){echo ("selected=\"selected\"");}echo (">Lecture seulement</option>");
			
		 
    
		  echo ("</select><br></td></tr></table>\n");

		  //echo ($Translate[120]);
		  //echo ("</td>\n");
      // Seclection du repertoire de lecture 
      
      	
		  //echo ("</tr>\n");
      //echo ("<tr class=\"edit_user\">\n");
     // echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[112]."</td>\n");
      //echo ("</td>\n");
	    
    	//echo ("<td class=\"border_lrtb\" colspan=\"2\">
     /* echo ("</td><td><select id=\"select_dir_user\" name=\"select_dir_user\" onchange='document.newuserform.dir_box.value=this.value;'  style='width: 140px;'>");
		echo ("<option value=\"".$DefaultDir."/".$user."\" selected=\"selected\">".$Translate[35]."</option>");
		   $iCounter = 0;

		while ($iCounter < $length_users)
		{

			$user_dir         = mysql_result($query_users,$iCounter,"User");
			$dir_users         = mysql_result($query_users,$iCounter,"Dir");
			echo ("<option value=\"$dir_users\"");if ($user==$user_dir){echo ("selected=\"selected\"");}echo (">$user_dir</option>");
			$iCounter++;
 		
		}	*/
			
		 
    
		  echo ("</select>");
                      
// DEBUT DIR    
// 
                  
                  
                  if (!isset($dir2)){
                  $dir2=$_POST['dir_box2'];}
                  
               

if (substr_count($dir2, $DefaultDir)==0){
                
                    $dir2=$DefaultDir;
                    
                    
                }
                   
                if ($new==1){
                   
                    $dir2_string=$DefaultDir;
                }
                else{
                    
                    $dir2_string=$dir2;
                }
                

		echo ("<input type=\"hidden\" name=\"dir_box2\"  value=\"$dir2\">\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[35]."</td>\n");
		echo ("<td class=\"border_ltb\" width=\"$middle_erea\">\n&nbsp;");

               
//		echo ("<input type=\"text\" name=\"dir_box2\" size=\"40\" maxlength=\"128\" value=\"$dir2\">\n");


		//echo ("<input type=\"hidden\" name=\"dir_box2\"  value=\"$dir2\">\n");
                    
		if (substr($dir2, -1) == "/") // last char is '/'
			$dir2_string = substr($dir2, 0, -1); // remove last char
		else
			$dir2_string = $dir2;
                
                
                   

		foreach(explode("/",$dir2_string) as $element)
		{
			if(empty($element)) // first element
			{
				$dir2_url = "/";
				echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box2.value='$dir2_url'; submit();}\">");
				echo ("/");
				echo ("</a>");
			}else
			{
				$dir2_url = "$dir2_url$element/";
				echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box2.value='$dir2_url'; submit();}\">");
				echo ($element);
				echo ("</a>");
				echo ("/");
			}
		}
               
		echo ("</td>\n");

                

		echo ("<td class=\"border_rtb\" align=\"right\">");

		if (isset($_POST['dirbrowser_box'])) // get new value
			$_SESSION['dirbrowser'] = $_POST['dirbrowser_box'];

		if(!isset($_SESSION['dirbrowser'])) //  set default value
			$_SESSION['dirbrowser'] = "0";
                
                if (isset($_POST['createfolder_box'])) // get new value
			$_SESSION['createfolder'] = $_POST['createfolder_box'];

		if(!isset($_SESSION['createfolder'])) //  set default value
			$_SESSION['createfolder'] = "0";
                
                if ($_SESSION['createfolder'] == 1)
                     {
                     if (isset($_POST['newfolder_name_box'])){

                               $nouveau_repertoire=$dir2."/".$_POST['newfolder_name_box'];
                                 // vérifie si le répertoire existe :
                                if (is_dir($nouveau_repertoire)) {
                                    unset($_SESSION['createfolder']); 
                                    echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  					       	echo ("<!--\n\n");
  					       	echo ("  alert(\"".$Translate[128]."\");\n\n");
  					       	echo ("-->\n");
  						      echo ("</script>\n");  
                                    }
                                // création du nouveau répertoire
                                 else { 
                                     if(!mkdir($nouveau_repertoire)){
                                        unset($_SESSION['createfolder']); 
                                        echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
  					       	echo ("<!--\n\n");
  					       	echo ("  alert(\"".$Translate[129]."\");\n\n");
  					       	echo ("-->\n");
  						      echo ("</script>\n"); 
                                        
                               
                                     }
                                     else{
                                         //changement d'uid et de gid
                                        
                                        $command='sudo chown '.$userRW.':'.$groupRO.' '.$nouveau_repertoire; 
                                         
                                        $ligne = system($command);
                                        if ($ligne!=0){
                                            logger ("Impossible de changer le owner du répertoire : ".$nouveau_repertoire);
                                        }
                                        $command='sudo chmod 757 '.$nouveau_repertoire;
                                        $ligne = system($command);
                                        if ($ligne!=0){
                                            logger ("Impossible de changer les droits du répertoire : ".$nouveau_repertoire);
                                        }
                                        
 
                                       
                                     }
                                     unset($_SESSION['createfolder']); 
                                }
                    }
                }


		echo ("<input type=\"hidden\" name=\"dirbrowser_box\" value=\"".$_SESSION['dirbrowser']."\">\n");
                echo ("<input type=\"hidden\" name=\"createfolder_box\" value=\"".$_SESSION['createfolder']."\">\n");
                echo ("<input type=\"text\" name=\"newfolder_name_box\" size=10 maxsize=20 value=\"\">\n");

                echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { createfolder_box.value='1'; submit();}\">");
                echo ("<img src=\"$LocationImages/new_folder.png\" class=\"icon\" alt=\"Créer un nouveau répertoire à cette emplacement\" /> \n");

		if ($_SESSION['dirbrowser'] == 0)
		{
			
                        echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dirbrowser_box.value='1'; submit();}\">");
			echo ("<img src=\"$LocationImages/arrow_up.gif\" class=\"icon\"");
			echo ("title=\"".$Translate[65]."\" ");
			echo ("alt=\"".$Translate[65]."\"></a>");
                        

		}else
		{
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dirbrowser_box.value='0'; submit();}\">");
			echo ("<img src=\"$LocationImages/arrow_down.gif\" class=\"icon\" ");
			echo ("title=\"".$Translate[66]."\" ");
			echo ("alt=\"".$Translate[66]."\"></a>");

		}

		echo ("</td>");
		echo ("</tr>\n");

                


		if($_SESSION['dirbrowser'] == 1)
		{
		echo ("<tr class=\"edit_user\">\n");

		echo ("<td class=\"border_ltb\"width=\"$small_erea\">&nbsp;</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\" bgcolor=\"#FFFFFF\">\n");




		echo ("<div id=\"dirbrowser_layer\" style=\"position:relative; width:100%; height:300; z-index:1; left: 0px; top: 0px; overflow: auto\">\n");

		if (isset($_POST['sort_box'])) // get last value
			$sort	= $_POST['sort_box'];


		if(!isset($sort)) //  set default value
			$sort = "name";


			echo ("<input type=\"hidden\" name=\"sort_box\" value=\"$sort\">\n");
			echo ("<table width=\"100%\" class=\"header\">\n");

			echo ("<tr>\n");
			echo ("<td class=\"header-left\">\n");


			// todo class head doenst exist?

			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=name\" class=\"head\">Name</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='name'; submit();}\" class=\"head\">".$Translate[80]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-right\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=size\" class=\"head\">Size</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='size'; submit();}\" class=\"head\">".$Translate[81]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=type\" class=\"head\">Type</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='type'; submit();}\" class=\"head\">".$Translate[82]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=modify\" class=\"head\">Changed</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='modify'; submit();}\" class=\"head\">".$Translate[83]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=owner\" class=\"head\">Owner</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='owner'; submit();}\" class=\"head\">".$Translate[84]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=group\" class=\"head\">Group</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='group'; submit();}\" class=\"head\">".$Translate[85]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"last-header\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=permission\" class=\"head\">Attributes</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='permission'; submit();}\" class=\"head\">".$Translate[86]."</a>\n");
			echo ("</td>\n");
			echo ("</tr>\n");

			$dir2ectoryListing = new directorylist ($dir2);




			if (strlen($dir2ectoryListing->error) != 0)
			{
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[26]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
			}

			$dir2ectoryListing->order($sort,"ASC");


			for ($iElement=0;$iElement < $dir2ectoryListing->nrof_elements();$iElement++)
			{
				$File = $dir2ectoryListing->directory_element($iElement);

				if ($File->Type() != 'DIRECTORYREFRESH')
				{

					echo ("<tr bgcolor=\"#FFFFFF\">\n");
					echo ("<td class=\"left\" style=\"vertical-align:bottom\" title=\"".$File->Name()."\">");
					if ($File->Type() == 'DIRECTORY' ||
							$File->Type() == 'DIRECTORYUP')
					{

						echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box.value='".$File->Path()."';dir_box2.value='".$File->Path()."';saveScroll(); submit();}\">");
						echo ("<img style=\"margin:0px 0px 2px ; vertical-align:middle\" src=\"$LocationImages/icons/".$File->Icon()."\" class=\"icon\" >");
						echo ("<input style=\"width:170px; margin:0px 3px\" class=\"description\" value=\"".$File->Name()."\" name=\"textfield\" type=\"text\">");
						echo ("</a>");

					}else if ($File->Type() == 'FILE'){

						echo ("<img style=\"margin:0px 0px 2px ; vertical-align:middle\" src=\"$LocationImages/icons/".$File->Icon()."\" class=\"icon\" >");
						echo ("<input style=\"width:170px; margin:0px 3px\" class=\"description\" value=\"".$File->Name()."\" name=\"textfield\" type=\"text\">");
					}

					echo ("</td>\n");

					if ($File->Type() == 'DIRECTORY' ||
					    $File->Type() == 'DIRECTORYUP')
					{
						echo ("<td class=\"left\">");
						echo ("&nbsp;");
						echo ("</td>\n");
					}else
					{
						echo ("<td class=\"left\" title=\"".$File->Size(0)."\">");
						echo ("<input  style=\"width:50px; text-align: right;\" class=\"description\" value=\"".$File->Size(1)."\" name=\"textfield\" type=\"text\">");
						echo ("</td>\n");
					}

					if($File->Description() != "") // not empty
					{

						echo ("<td class=\"left\" title=\"".$File->Description()."\">");
						echo ("<input  style=\"width:110px;\" class=\"description\" value=\"".$File->Description()."\" name=\"textfield\" type=\"text\">");
						echo ("</td>\n");
					}
					else
						echo("<td class=\"left\">&nbsp;</td>\n");

					echo ("<td class=\"left\">");
					echo ("<input  style=\"width:80px;\" class=\"description\" value=\"".$File->Modify(2)."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\" title=\"".$File->Owner()."\">");
					echo ("<input  style=\"width:55px;\" class=\"description\" value=\"".$File->Owner()."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\" title=\"".$File->Group()."\">");
					echo ("<input  style=\"width:55px;\" class=\"description\" value=\"".$File->Group()."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\">");
					echo ("<input  style=\"width:70px;\" class=\"description\" value=\"".$File->Permission(1)."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo("</tr>\n");
				}
			}
			

		}
		
                  
                  // FIN DIR


echo ("</td></tr></table></td></tr></table>\n");
		
		 /* echo ("<tr class=\"edit_user\">\n");
      echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[113]."</td>\n");
      echo ("</td>\n");
	    
    	echo ("<td class=\"border_lrtb\" colspan=\"2\"><select name=\"select_droits\" style='width: 140px;'>");
		echo ("<option value=\"0\" selected=\"selected\">24h</option>");
		
			echo ("<option value=\"1\">Une semaine</option>");
			echo ("<option value=\"2\">Un mois</option>");
		 
    
		  echo ("</select>\n");
		  echo ("</td>\n");   
		  echo ("</tr>\n");      */
    
    }
		//echo ("<tr class=\"edit_user\">\n");
		//echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[35]."</td>\n");
		

		//echo ("<input type=\"text\" name=\"dir_box2\" size=\"40\" maxlength=\"128\" value=\"$dir\">\n");
		//echo ("</td>\n");
		//echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
		
    if ($Client=="Administrator"){
      echo ("</table>\n");
      echo ("<table width=\"850\" class=\"edit_user\">\n");
      echo ("<tr class=\"edit_user\">\n");
		  echo ("<td class=\"border_lrb\" width=\"$small_erea\">".$Translate[35]."</td>\n");
      echo ("<td class=\"border_lrb\" width=\"$large_erea\">\n&nbsp;");
      echo ("<input type=\"text\" name=\"dir_box2\"  value=\"$dir\">\n");
      echo ("</td>\n");
      echo ("<td class=\"border_rb\" width=\"$small_erea\">".$Translate[108]."</td>\n");
      echo ("<td class=\"border_rb\" width=\"$large_erea\">\n&nbsp;");
      echo ("<input type=\"text\" name=\"client_box\"  value=\"$client_box\">\n");
      echo ("</td>\n");
		  echo ("</tr>\n");
    }
    else{
		  //echo ("<input type=\"text\" name=\"dir_box\"  value=\"$dir\">\n");
		  echo ("<input type=\"hidden\" name=\"client_box\"  value=\"$client_box\">\n");
		  echo ("<input type=\"hidden\" name=\"ipaddress_box\" value=\"$ipaddress\">\n");
		  
		}
		

	if ($new==1){
       	echo ("<input type=\"hidden\" name=\"new_box\" size=\"11\" maxlength=\"11\" value=\"1\">\n");
       }
    else{
    	echo ("<input type=\"hidden\" name=\"new_box\" size=\"11\" maxlength=\"11\" value=\"0\">\n");
    }  
     	
		
		
    if ($Client=="Administrator"){
		    echo ("<tr class=\"edit_user\">\n");
			echo ("<td class=\"border_lr\" width=\"$small_erea\">".$Translate[36]."</td>\n");
			echo ("<td class=\"border_lr\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"ulbandwidth_box\" size=\"10\" maxlength=\"10\" value=\"$ulbandwidth\">\n");
				
				information($Translate[93],$Translate[36]);
			
			echo ("</td>\n");
		}
		else
		{
			echo ("</table>\n");
		    echo ("<table width=\"850\" class=\"edit_user\">\n");
		    echo ("<tr class=\"edit_user\">\n");
		}

		if ($EnableQuota == 1)
		{
			echo ("<td class=\"border_lrt\" width=\"$small_erea\">".$Translate[43]."</td>\n");
			echo ("<td class=\"border_rt\" >\n&nbsp;");
			echo ("<input type=\"text\" name=\"quotafiles_box\" size=\"10\" maxlength=\"10\" value=\"$quotafiles\">\n");
				
				information($Translate[95],$Translate[43]);
			echo ("</td>\n");
		}
		else
		{
			echo ("<td>");
			echo ("<input type=\"hidden\" name=\"quotafiles_box\" value=\"$quotafiles\">\n");
			echo("</td>\n<td class=\"border_rt\">&nbsp;</td>\n");
		}
    

		echo ("</tr>\n");
		echo ("<tr class=\"edit_user\">\n");
		
    if ($Client=="Administrator"){
		
			echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[37]."</td>\n");
			echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"dlbandwidth_box\" size=\"10\" maxlength=\"10\" value=\"$dlbandwidth\">\n");
				
				information($Translate[94],$Translate[37]);
			echo ("</td>\n");
    }
    else{
        echo ("</tr>\n");

		echo ("</table>\n");
		echo ("<table width=\"850\" class=\"edit_user\">\n");
		echo ("<tr class=\"edit_user\">\n");
    //  echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[37]."</td>\n");
    }
    
		if ($EnableQuota == 1)
		{
			echo ("<td class=\"border_lrtb\" width=\"$small_erea\">".$Translate[44]."</td>\n");
			echo ("<td class=\"border_rtb\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"quotasize_box\" size=\"10\" maxlength=\"10\" value=\"$quotasize\">\n");
				
				information($Translate[96],$Translate[44]);
			echo ("</td>\n");
		}
		else
		{
		
			echo ("<td>");
			echo ("<input type=\"hidden\" name=\"quotasize_box\" value=\"$quotasize\">\n");
			echo("</td>\n<td class=\"border_r\">&nbsp;</td>\n");
		}


		echo ("</tr>\n");


    if ($Client=="Administrator"){
  		if ($EnableRatio == 1)
  		{
  				echo ("<tr class=\"edit_user\">\n");
  					echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[45]."</td>\n");
  					echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
  					
  						echo ("<input type=\"text\" name=\"ulratio_box\" size=\"2\" maxlength=\"3\" value=\"$ulratio\">");
  						echo (" : ");
  						echo ("<input type=\"text\" name=\"dlratio_box\" size=\"2\" maxlength=\"3\" value=\"$dlratio\">");
  						
  						information($Translate[97],$Translate[45]);
  					echo ("</td>\n");
  					echo ("<td class=\"border_r\" colspan=\"2\">\n&nbsp;</td>");
  				echo ("</tr>\n");
  
  
  		}else
  		{
  
  			echo ("<input type=\"hidden\" name=\"ulratio_box\" value=\"$ulratio\">");
  			echo ("<input type=\"hidden\" name=\"dlratio_box\" value=\"$dlratio\">");
  		}
		echo ("<tr class=\"edit_user\">\n");
			echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[38]."</td>\n");
			echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"ipaddress_box\" size=\"20\" maxlength=\"20\" value=\"$ipaddress\">\n");
				
				information($Translate[98],$Translate[38]);
			echo ("</td>\n");
      
			echo ("<td class=\"border_r\" colspan=\"2\">\n&nbsp;</td>");
		echo ("</tr>\n");
    }
      else{
        echo ("</tr>\n");
   
		echo ("</table>\n");
		echo ("<table width=\"850\" class=\"edit_user\">\n");
		//echo ("<tr class=\"edit_user\">\n");
    //  echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[37]."</td>\n");
    }
    
		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_lrb\" valign=\"top\" width=\"$small_erea\">".$Translate[46]."</td>\n");
		echo ("<td class=\"border_lrb\" width=\"$large_erea\">\n");
		
		
			echo ("<table width=\"100%\"><tr><td>");
			echo ("<textarea name=\"comment_box\" cols=\"30\" rows=\"3\" wrap=\"virtual\">".$comment."</textarea>");
			echo ("</td></tr></table>");
		echo ("</td>\n");
		echo ("<td class=\"border_lrb\" colspan=\"2\">\n&nbsp;</td>");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\" align=\"right\">\n");
		echo ("<td class=\"border_lrb\" height=\"30\" colspan=\"4\">\n");
		echo ("<input name=\"save\" type=\"submit\" value=\"".$Translate[67]."\">&nbsp;\n");
		echo ("</td>\n");
		echo ("</tr>\n");


		echo ("</table>\n");
		/////////////////////////////////////FIN FORM USER FTP//////////////////////////////////////

?>