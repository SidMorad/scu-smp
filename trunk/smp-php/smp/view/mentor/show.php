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
	
	print $indent . "<a onClick=\"return toggleMe('mentorInfoDiv')\">\r\n";
	print $indent . "	<div class=\"showInfoHeader\">Mentor's Information</div>\r\n"; 
	print $indent . "</a>\r\n"; 
	
	print $indent."<div id=\"mentorInfoDiv\" class=\"infoPanel\">\r\n";
	
	print $indent."<table class=\"infoTable\">\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">First year completed?:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromFixArray('yes_no', $student->getIsFirstYear())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Recomended By Staff:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getRecommendedByStaff())."</td>\r\n";
	print $indent."	</tr>\r\n";
	
	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Semesters completed:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::chN($student->getSemestersCompleted())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Prefer on campus:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getPreferOnCampus())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Prefer distance:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getPreferDistance())."</td>\r\n";
	print $indent."		<td class=\"tdLabel\">Prefer Australian:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getPreferAustralian())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."	<tr>\r\n";
	print $indent."		<td class=\"tdLabel\">Prefer International:</td>\r\n";
	print $indent."		<td class=\"tdValue\">".VH::getValueFromBoolean($student->getPreferInternational())."</td>\r\n";
	print $indent."	</tr>\r\n";

	print $indent."</table>\r\n";
	print $indent."</div>\r\n";
	
} else {
	print "Mentor Information is not available.";
}	