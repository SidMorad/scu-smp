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
	
	print $indent."<div class=\"form_container\">\r\n";
	
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>User's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Username:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".$user->getUsername()."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Scu Email:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".$user->getScuEmail()."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."</div>\r\n";

} else {
	print "User Information is not available.";
}