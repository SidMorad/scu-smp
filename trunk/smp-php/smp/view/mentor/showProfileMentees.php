<?php
/**
 * Created at 30/07/2010 2:54:43 PM
 * smp/view/mentor/showProfileMentees.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");

$mentor = $request->getEntity();

$indent = "				";
print $indent."<div class=\"form_container\">\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<label>&nbsp;</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		<h2>my Mentee(s) Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";

foreach($mentor->getMentees() as $mentee) {
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Name :</label>\r\n";
	print $indent."	</div>\r\n";
	$fullName = VH::chN($mentee->getStudent()->getFirstname())." ".VH::chN($mentee->getStudent()->getLastname());	
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".$fullName."</label>\r\n";
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
	print $indent."		<label class=\"labelValue\">".VH::getValueFromDynamicArray('course', $mentee->getStudent()->getCourseId())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Matched Time:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_10\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getRelation()->getCreateTime())."</label>\r\n";
	print $indent."	</div>\r\n";
	if ($mentee->getRelation()->getMentorContactConfirm()) {
		print $indent."	<div class=\"grid_2\">\r\n";
		print $indent."		<label class=\"label\">Contact Confirm?</label>\r\n";
		print $indent."	</div>\r\n";
		print $indent."	<div class=\"grid_10\">\r\n";
		print $indent."		<img src=\"static/images/yes.png\" >&nbsp;\r\n";
		print $indent."	</div>\r\n";
		print $indent."	<div class=\"grid_2\">\r\n";
		print $indent."		<label class=\"label\">Confirm Time:</label>\r\n";
		print $indent."	</div>\r\n";
		print $indent."	<div class=\"grid_10\">\r\n";
		print $indent."		<label class=\"labelValue\">".VH::chN($mentee->getRelation()->getMentorContactConfirmTime())."</label>\r\n";
		print $indent."	</div>\r\n";
	} else {
		$relationId = $mentee->getRelation()->getId();
		print $indent."	<div class=\"grid_2\">\r\n";
		print $indent."		<label class=\"label\">Contact Confirm?</label>\r\n";
		print $indent."	</div>\r\n";
		print $indent."	<div class=\"grid_10\">\r\n";
		print $indent."		<img src=\"static/images/no.png\" >\r\n";
		print $indent."		<a href=\"index.php?cmd=mentor/confirmContactMentee&relation_id=$relationId\" onClick=\"return confirmSubmit()\">Click here for confirm that you had contact with $fullName ?</a>";
		print $indent."	</div>\r\n";
		if (!is_null($mentee->getRelation()->getCreateTime())) {
			print $indent."	<div class=\"grid_2\">\r\n";
			print $indent."		<label class=\"label\">Number of days passed after matching:</label>\r\n";
			print $indent."	</div>\r\n";
			print $indent."	<div class=\"grid_10\">\r\n";
			print $indent."		<label class=\"labelValue\">".smp_util_DateUtil::DayDiffUntilToday($mentee->getRelation()->getCreateTime());
			print $indent."		</label>\r\n";
			print $indent."	</div>\r\n";
		}
	}
	
	
	print $indent."	<div class=\"grid_12\">\r\n";
	print $indent."		&nbsp;\r\n";
	print $indent."	</div>\r\n";
}
print $indent."</div>\r\n";

include("smp/view/common/footer.php");