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
	
	print $indent . "<a onClick=\"return toggleMe('studentInfoDiv')\">\r\n";
	print $indent . "	<div class=\"showInfoHeader\">Student's Information</div>\r\n"; 
	print $indent . "</a>\r\n"; 
	
	print $indent."<div id=\"studentInfoDiv\" class=\"infoPanel\">\r\n";
	
	print $indent."<table class=\"infoTable\">\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">First name:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getFirstname())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Last name:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getLastname())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Student Number:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getStudentNumber())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Study mode:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('study_mode',$student->getStudyMode())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Course:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".substr(VH::getValueFromDynamicArray('course', $student->getCourseId()), 0, 18)."..</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Major:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getMajor())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Gender:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('gender',$student->getGender())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Age Range:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('age_range',$student->getAgeRange())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Prefer same gender:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('gender_prefer',$student->getPreferGender())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Work Status:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('work_status',$student->getWorkStatus())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Interests:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getInterests())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Comments:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getComments())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Family responsibility?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('yes_no',$student->getFamilyStatus())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Tertiary Study?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('yes_no',$student->getTertiaryStudyStatus())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">International?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsInternational())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Regional?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsRegional())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Disability?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsDisability())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Low Socioeconomic?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsSocioeconomic())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Non-English?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsNonEnglish())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Indigenous?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getIsIndigenous())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."</table>\r\n";
	print $indent."</div>\r\n";

} else {
	print "Student Information is not available.";
}