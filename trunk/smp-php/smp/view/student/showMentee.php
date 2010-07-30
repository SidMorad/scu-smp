<?php
/**
 * Created at 2010-7-30 ÏÂÎç07:45:04
 * smp/view/student/showMentee.php
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
$indent = "				";
if(isset($student)){

	print $indent."<div class=\"form_container\">\r\n";
	
	print $indent."<div class=\"grid_12\">\r\n";
	print $indent."<label>&nbsp;</label>\r\n";
	print $indent."</div>\r\n";
	print $indent."<div class=\"grid_12\">\r\n";
	print $indent."<h2>Mentee's Information</h2>\r\n";
	print $indent."<hr/>\r\n";
	print $indent."</div>\r\n";
	

	print $indent."</div>\r\n";
	
}else {
	print "Mentee Information is not available.";
}	
