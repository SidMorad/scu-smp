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
	
	print $indent."<div class=\"form_container\">\r\n";
	
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>Contact's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Address:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getAddress())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">City/Town:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getCity())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Postcode:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getPostcode())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Phone(home):</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getPhoneHome())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Mobile:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getMobile())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Phone(work):</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getPhoneWork())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Email:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($contact->getEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."</div>\r\n";

} else {
	print "Contact Information is not available.";
}