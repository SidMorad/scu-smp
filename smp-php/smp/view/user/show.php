<?php
/**
 * Created at 30/07/2010 9:53:36 AM
 * smp/view/user/show.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
$indent = "				";
if (isset($user)) {
	$userId = $user->getId();
	
	print $indent . "<a onClick=\"return toggleMe('userInfoDiv')\">\r\n";
	print $indent . "	<div class=\"showInfoHeader\">User's Information\r\n";
	print $indent . "	</div>\r\n";
	print $indent . "</a>\r\n"; 
	
	print $indent."<div id=\"userInfoDiv\" class=\"infoPanel\">\r\n"; 
	
	print $indent."<table class=\"infoTable\">\r\n";
	
	$pictureName = $user->getPicture();
	if (!is_null($pictureName)) {
		print $indent."	<tr>\r\n";
		print $indent."		<td ROWSPAN=3><img src=\"static/images/profile/_thb_$pictureName\"></td>\r\n";
		print $indent."		<td class=\"tdValue\">&nbsp;</td>\r\n";
		print $indent."		<td class=\"tdValue\">&nbsp;</td>\r\n";
		print $indent."	</tr>\r\n";
	}
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Username:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($user->getUsername())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Scu Email:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($user->getScuEmail())."</td>\r\n";
	print $indent."	</tr>\r\n";
		
	print $indent."</table>\r\n";
	print $indent."</div>\r\n";

} else {
	print "User Information is not available.";
}