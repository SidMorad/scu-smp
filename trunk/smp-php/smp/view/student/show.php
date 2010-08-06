<?php
/**
 * Created at 30/07/2010 9:53:36 AM
 * smp/view/user/show.php
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
	print $indent."		<h2>Student's Information</h2>\r\n";
	print $indent."		<hr/>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">First name:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getFirstname())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Last name:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getLastname())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Student Number:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getStudentNumber())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Study mode:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('study_mode',$student->getStudyMode())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Course:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getCourse())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Major:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getMajor())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Gender:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('gender',$student->getGender())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Age Range:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('age_range',$student->getAgeRange())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Prefer same gender:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('gender_prefer',$student->getPreferGender())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Work Status:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('work_status',$student->getWorkStatus())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Interests:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getInterests())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Comments:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::chN($student->getComments())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Family responsibility?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('yes_no',$student->getFamilyStatus())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Tertiary Study?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromFixArray('yes_no',$student->getTertiaryStudyStatus())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">International?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsInternational())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Regional?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsRegional())."</label>\r\n";
	print $indent."	</div>\r\n";

	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Disability?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsDisability())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Low Socioeconomic?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsSocioeconomic())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Non-English?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsNonEnglish())."</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_2\">\r\n";
	print $indent."		<label class=\"label\">Indigenous?:</label>\r\n";
	print $indent."	</div>\r\n";
	print $indent."	<div class=\"grid_6\">\r\n";
	print $indent."		<label class=\"labelValue\">".VH::getValueFromBoolean($student->getIsIndigenous())."</label>\r\n";
	print $indent."	</div>\r\n";
	
	
	print $indent."</div>\r\n";

} else {
	print "Student Information is not available.";
}