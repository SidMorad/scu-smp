<?php
/**
 * Created at 30/07/2010 11:30:02 AM
 * smp/view/student/showMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
$indent = "				";
if (isset($student)) {
	
	print $indent."<div class=\"form_container\">\r\n";	

	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>Menotr's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">First year completed?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('yes_no', $student->getIsFirstYear())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Recomended By Staff:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".$student->getRecommendedByStaff()."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Semesters completed:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".$student->getSemestersCompleted()."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Prefer on campus:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".($student->getPreferOnCampus() ? "Yes" : "No")."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Prefer distance:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".($student->getPreferDistance() ? "Yes" : "No")."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Prefer Australian:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".($student->getPreferAustralian() ? "Yes" : "No")."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Prefer International:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<span class=\"labelValue\">".($student->getPreferInternational() ? "Yes" : "No")."</span>\r\n";
	print $indent."	</div>\r\n";

	print $indent."</div>\r\n";
	
} else {
	print "Mentor Information is not available.";
}	