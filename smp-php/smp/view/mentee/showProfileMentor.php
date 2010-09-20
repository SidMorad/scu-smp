<?php
/**
 * Created at 20/09/2010 10:20:27 AM
 * smp/view/mentee/showProfileMentor.php
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
	print $indent."		<h2>My Mentor's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
 
$mentor=$student->getMentor();
 if (!is_null($mentor)) {
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Name :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getStudent()->getFirstname())."	".VH::chN($mentor->getStudent()->getLastname())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Mobile :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getContact()->getMobile())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Email :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getUser()->getScuEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Course :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getStudent()->getCourseId())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		&nbsp;\r\n";
	print $indent."	</div>\r\n";
 } else {
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		It seems you do not have Mentor yet!\r\n";
	print $indent."	</div>\r\n";
 }

print $indent."</div>\r\n";

include("smp/view/common/footer.php");