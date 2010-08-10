<?php
/**
 * Created at 30/07/2010 2:54:43 PM
 * smp/view/student/showProfileMentorMentees.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");

$student = $request->getEntity();

$indent = "				";
print $indent."<div class=\"form_container\">\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>my Mentee(s) Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";

foreach($student->getMentees() as $mentee) {
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Name :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getStudent()->getFirstname())." ".VH::chN($mentee->getStudent()->getLastname())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Mobile :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getContact()->getMobile())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">SCU Email :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getUser()->getScuEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Email :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getContact()->getEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Course :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getStudent()->getCourse())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		&nbsp;\r\n";
	print $indent."	</div>\r\n";
}
print $indent."</div>\r\n";

include("smp/view/common/footer.php");