<?php
/**
 * Created at 21/09/2010 8:19:03 PM
 * smp/view/user/showRoles.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */

$indent = "				";

if (count($user->getRoles()) > 0) {
	$userId = $user->getId();
	
	print $indent . "<a onClick=\"return toggleMe('userRolesInfoDiv')\">\r\n";
	print $indent . "	<div class=\"showInfoHeader\">User's Roles\r\n";
	print $indent . "	</div>\r\n";
	print $indent . "</a>\r\n"; 
	
	print $indent."<div id=\"userRolesInfoDiv\" class=\"infoPanel\">\r\n"; 
	
	print $indent."<table class=\"infoTable\">\r\n";
	print $indent."	<tr>\r\n";
foreach ($user->getRoles() as $roleName) {
	print $indent."		<td class=\"tdLabel\">$roleName</td>\r\n";
}
	print $indent."	</tr>\r\n";
		
	print $indent."</table>\r\n";
	print $indent."</div>\r\n";

} else {
	print "No Roles for this user.";
}
