<?php

//////////////////////////////////DEBUT LISTAGE CORBEILLE/////////////////////////////////////
    if ($Client=="Administrator"){
   echo ("<br><br>");
		echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    		
		echo ("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"850\">\n");
		echo ("<tr>\n");
		echo ("<td>\n");
		echo ("<font size=\"+1\">&nbsp;".$Translate[119]."</font>\n");
		echo ("</td>\n");
		echo ("<td align=\"right\">");
	
		
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    echo ("</td>\n");
		echo ("</tr>\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
		echo ("<table width=\"850\" border=\"0\">\n");

		echo ("<tr class=\"column_name_select_user\">\n");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeilleuser\">".$Translate[32]."</a></td>");
		
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeillepartenaire\">".$Translate[108]."</a></td>");
    
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeilleuid\">".$Translate[33]."</a></td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeillegid\">".$Translate[34]."</a></td>");
		
    echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeilledir\">".$Translate[35]."</a></td>");
    

		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[36]."</td>");
		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[37]."</td>");
		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[38]."</td>");
                echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeillequotafull\">".$Translate[44]."</a></td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeillequotause\">".$Translate[99]."</a></td>");
		
    if ($Client!="Administrator"){
      echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeilledir\">".$Translate[35]."</a></td>");
      
  		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]?sort=corbeillerights\">".$Translate[117]."</a></td>");
		}
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\"><a href=\"$_SERVER[PHP_SELF]\">".$Translate[39]."</a></td>");
		
		echo ("</tr>\n");
    
		$iCounter = 0;

		while ($iCounter < $length_restore)
		{

			$user         = mysql_result($query_restore,$iCounter,"User");
			//$password     = mysql_result($query_restore,$iCounter,"Password");
			$uid          = mysql_result($query_restore,$iCounter,"Uid");
			$gid          = mysql_result($query_restore,$iCounter,"Gid");
			$dir          = mysql_result($query_restore,$iCounter,"Dir");
			//$ulbandwidth  = mysql_result($query_restore,$iCounter,"ULBandwidth");
			//$dlbandwidth  = mysql_result($query_restore,$iCounter,"DLBandwidth");
			$quotasize    =  mysql_result($query_restore,$iCounter,"QuotaSize");
			$ipaddress    = mysql_result($query_restore,$iCounter,"Ipaddress");
			$status       = mysql_result($query_restore,$iCounter,"Status");
			$user_client  = mysql_result($query_restore,$iCounter,"Client");
 			$quotafilesusage       = mysql_result($query_restore,$iCounter,"QuotaFilesUsage");
			$quotadiskusage       = mysql_result($query_restore,$iCounter,"QuotaDiskUsage");
			$quotapourcent     = round($quotadiskusage/1000/1024/$quotasize*100,2);
			
			//On rempli la base avec le pourcentage par user afin de faire du classement
			 if(!mysql_query("UPDATE users SET QuotaClientPercentUse='".$quotapourcent."' WHERE User='".$user."'",$link))
  						{
  							echo ("<br>Error: Not a valid UPDATE query.<br>");
  							echo ("<br>MySql error : ".mysql_error());
      	      }

			if ($status == 1)
				echo ("<tr class=\"select_user\">\n");
			else
				echo ("<tr class=\"select_locked_user\">\n");


			echo ("<td align=\"left\" width=\"140\">");

			

			// Lock or unlock account
			if ($status == 1)
					echo ("<img src=\"$LocationImages/ftpuser.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");
			else
					echo ("<img src=\"$LocationImages/ftpuser_gray.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");

			echo (" $user");


			echo ("</td>\n");
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

			

			/* Restore ftp account */
			echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?restore=1&username_box=$user');return false;\">");
			if ($status == 1)
				echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			else
				echo ("<img src=\"$LocationImages/delete_gray.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			echo ("title=\"".$Translate[61]."\" ");
			echo ("alt=\"".$Translate[61]."\"></a>&nbsp;&nbsp;");

			echo ("</td>\n");
			echo ("</tr>\n");
			$iCounter++;
		}

		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n"); 
      }
    
    ////////////////////////////////FIN LISTAGE CORBEILLE///////////////////////////////////////
        ?>