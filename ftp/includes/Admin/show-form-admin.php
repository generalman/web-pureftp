<?php


echo ("<table class=\"edit_user\" width=\"850\">\n");

echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[32]: ");
echo ("<input type=\"text\" name=\"admin3\" value=\"" . $user . "\"></td>\n");
echo ("</td><td class=\"border_lrtb\"> $Translate[41]:");
// echo (" Password:");
echo ("<input type=\"password\" name=\"admin3_password\" value=\"" . $admin3_password . "\"> ");
echo (" $Translate[42]:");
// echo (" Password:");
echo ("<input type=\"password\" name=\"admin3_password_confirm\" value=\"" . $admin3_password_confirm . "\"></td>\n");
echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[108] ");
echo ("<input type=\"text\" name=\"admin3_client\" value=\"" . $admin3_client . "\"></td>\n");
echo ("<td class=\"border_lrtb\">$Translate[106] ");
echo ("<input type=\"text\" name=\"admin3_dir\" value=\"" . $admin3_dir . "\"></td>\n");
echo ("<tr class=\"edit_user\"><td class=\"border_ltb\">$Translate[107] ");
echo ("<input type=\"text\" size=\"8\" name=\"admin3_quota\" value=\"" . $admin3_quota . "\"></td>\n");
echo ("</td><td class=\"border_lrtb\" align=\"left\">");
echo ("<input type=\"submit\" name=\"save_admin\" value=\"$Translate[67]\">");
echo ("</td></tr>\n");

echo ("</table>\n");
echo ("<br><br>");
?>
