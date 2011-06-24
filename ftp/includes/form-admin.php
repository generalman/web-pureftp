<?php

 echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
    echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    		
		echo ("<table class=\"banniere\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"850\">\n");
		echo ("<tr >\n");
		echo ("<td >\n");
		echo ("<img hspace=\"1\" src=\"$LocationImages/sii.png\" align=\"middle\" border=\"0\"><font size=\"+1\">&nbsp;".$Translate[105]."</font>\n");
		echo ("</td>\n");
		echo ("<td align=\"right\">");
		echo ("<a href=\"$_SERVER[PHP_SELF]\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/refresh.png\" title=\"".$Translate[121]."\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
		echo ("</a>");
		
		echo ("<a href=\"$_SERVER[PHP_SELF]?new=1\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/admin_50.png\" title=\"".$Translate[109]."\" width=\"60\" height=\"60\" align=\"middle\" border=\"0\">");
		echo ("</a>");
		if ($Client=="Administrator"){
		echo ("<a href=\"disconnect.php\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/disconnect.png\" title=\"".$Translate[103]."\" width=\"50\" height=\"50\" align=\"middle\" border=\"0\">");
    echo ("</a>");
    }
		echo ("</tr>\n");
		echo ("</table>\n");
		echo ("</td>\n");
		
		
		echo ("</tr>\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");

		//////////////////////////////////////////////////////////////////////
		
    echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
    echo ("<table width=\"850\" border=\"0\">\n");
    
		echo ("<tr class=\"column_name_select_user\">\n");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\" ><span style=font-black>".$Translate[32]."</span></td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[108]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[106]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[107]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[39]."</td>");
		echo ("</tr>\n");
    
		$iCounter2 = 0;

		while ($iCounter2 < $length_admin)
		{

			$user         = mysql_result($query_admin_all,$iCounter2,"Username");
			//$password     = mysql_result($query_users,$iCounter,"Password");
			$defaultdir          = mysql_result($query_admin_all,$iCounter2,"DefaultDir");
			$client          = mysql_result($query_admin_all,$iCounter2,"Client");
			$quotaclient          = mysql_result($query_admin_all,$iCounter2,"QuotaClient");
			$quotaclient = $quotaclient/1000; //Giga Affichage
      	
      echo ("<tr class=\"select_user\">\n");
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$user."</td>\n");
			//echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$password."</td>\n");
     
			   //echo ("<td title=\"".$dir."\">");echo ("</td>");
			   echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$client."</td>\n");
			
			
			echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$quotaclient." GB </td>\n");
			 
			echo ("<td align=\"left\" style=\"padding-left: 2px;\" ");if (!is_dir($defaultdir)){echo "bgcolor=\"Red\"";} echo (">".$defaultdir."</td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 2px;\">");
			if ($user!="Administrator"){
			/* Edit admin account */
			echo ("<a href=\"$_SERVER[PHP_SELF]?id-admin=$user\">");
			echo ("<img src=\"$LocationImages/edit.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
			echo ("title=\"".$Translate[60]."\" ");
			echo ("alt=\"".$Translate[60]."\"></a>&nbsp;&nbsp;");

			/* Delete admin account */
			echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?delete=1&admin_box=$user');return false;\">");
			echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			
			echo ("title=\"".$Translate[61]."\" ");
			echo ("alt=\"".$Translate[61]."\"></a>&nbsp;&nbsp;");
			}
			echo ("</td>\n");
			echo ("</tr>\n");
			////////////////////////////////////////////////////////////
		 $iCounter2++;
     }
     
     echo ("</table>\n");
     echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");
     //echo ("<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
     	echo ("<br><br>");
     	
		 /////////////////// FORM ADMIN /////////////////////////////
		 
		 	 $admin3_password         = "empty";
		$admin3_password_confirm  = "empty";

		if(!empty($_GET['id-admin']))
		{
			$iCounter=0;
			while ($iCounter < $length_admin)
			{
        
				$userid = mysql_result($query_admin_all,$iCounter,"Username");
				
				if ($userid == $_GET['id-admin'])
				{
					$user         = $userid;
					//$password     = mysql_result($query_admin_all,$iCounter,"Password");
					$admin3_dir          = mysql_result($query_admin_all,$iCounter,"DefaultDir");
					$admin3_quota          = mysql_result($query_admin_all,$iCounter,"QuotaClient");
					$admin3_quota = $admin3_quota /1000; # Affichage Giga
					$admin3_client          = mysql_result($query_admin_all,$iCounter,"Client");       
					break;
				}
				$iCounter++;
			}
		}else if(empty($new)) // $new != 1
		{

			$user             = $_POST['admin3'];
			//$password       = "empty";
			$admin3_password  = $_POST['admin3_password'];
			$admin3_password_confirm = $_POST['admin3_password_confirm'];
			$admin3_dir       = $_POST['admin3_dir'];
			$admin3_client    = $_POST['admin3_client'];
			$admin3_quota    = $_POST['admin3_quota']/1000; // Giga

		}else
		{
			$user             = $Translate[10];
			$admin3_password  = "";
			$admin3_password_confirm = "";
			$admin3_dir       = "$DefaultDir";
			$admin3_client    = "1";
			$admin3_quota       = "100";
		}
		 
		  
     echo ("<table class=\"edit_user\" width=\"850\">\n");
		
     echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[32]: ");
		echo ("<input type=\"text\" name=\"admin3\" value=\"".$user."\"></td>\n");
		echo ("</td><td class=\"border_lrtb\"> $Translate[41]:");
		// echo (" Password:");
		echo ("<input type=\"password\" name=\"admin3_password\" value=\"".$admin3_password."\"> ");
		echo (" $Translate[42]:");
		// echo (" Password:");
		echo ("<input type=\"password\" name=\"admin3_password_confirm\" value=\"".$admin3_password_confirm."\"></td>\n");   
		echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[108] ");
		echo ("<input type=\"text\" name=\"admin3_client\" value=\"".$admin3_client."\"></td>\n");
		echo ("<td class=\"border_lrtb\">$Translate[106] ");
		echo ("<input type=\"text\" name=\"admin3_dir\" value=\"".$admin3_dir."\"></td>\n");
		echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[107] ");    
		echo ("<input type=\"text\" size=\"8\" name=\"admin3_quota\" value=\"".$admin3_quota."\"></td>\n");
		echo ("</td><td class=\"border_lrtb\" align=\"left\">");
		echo ("<input type=\"submit\" name=\"save_admin\" value=\"$Translate[67]\">");
		echo ("</td></tr>\n");
		
   echo ("</table>\n");   
	echo ("<br><br>");	         
    /////////////////////FIN FORM ADMIN ///////////////////////////////


?>