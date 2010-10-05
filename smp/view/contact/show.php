<?php
/**
 * Created at 30/07/2010 9:53:36 AM
 * smp/view/user/show.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
$indent = "				";
if (isset($contact)) {
	
	print $indent . "<a onClick=\"return toggleMe('contactInfoDiv')\">\r\n";
	print $indent . "	<div class=\"showInfoHeader\">Contact's Information</div>\r\n"; 
	print $indent . "</a>\r\n"; 
	
	print $indent."<div id=\"contactInfoDiv\" class=\"infoPanel\">\r\n";
	
	print $indent."<table class=\"infoTable\">\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Address:</td>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getAddress())."</td>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">City/Town:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getCity())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Postcode:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getPostcode())."</td>\r\n";
	print $indent."	<tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Phone(home):</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getPhoneHome())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Mobile:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getMobile())."</td>\r\n";
	print $indent."	<tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Phone(work):</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getPhoneWork())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Email:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($contact->getEmail())."</td>\r\n";
	print $indent."	<tr>\r\n";
	
	print $indent."</table>\r\n";
	print $indent."</div>\r\n";

} else {
	print "Contact Information is not available.";
}