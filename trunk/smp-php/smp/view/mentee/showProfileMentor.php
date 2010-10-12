<?php
/**
 * Created at 20/09/2010 10:20:27 AM
 * smp/view/mentee/showProfileMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");

$mentee = $request->getEntity();

$indent = "				";
print $indent."<div class=\"form_container\">\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>My Mentor's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
 
$mentor=$mentee->getMentor();
 if (!is_null($mentor->getId())) {
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
	print $indent."		<label class=\"label\">SCU Email :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getUser()->getScuEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Email :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentor->getContact()->getEmail())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Course :</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromDynamicArray('course', $mentor->getStudent()->getCourseId())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		&nbsp;\r\n";
	print $indent."	</div>\r\n";
 } else {
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		It seems you do not have Mentor yet!\r\n";
	print $indent."	</div>\r\n";
 }

if ($mentee->getExpired() && (!$mentee->getWantToBeMentor())) {
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<a href=\"index.php?cmd=mentee/wantToBeMentor&menteeId=".$mentee->getId()."\" onClick=\"return confirmSubmit();\">Do you want apply for being Mentor ?</a>\r\n";
	print $indent."	</div>\r\n";
}else if ($mentee->getWantToBeMentor()) {
	print $indent. "	<p style=\"color:green;\">You already applied for being Mentor,Now you need to wait for Coordinator confirm. Thank you.";
} 
 
 
print $indent."</div>\r\n";

include("smp/view/common/footer.php");