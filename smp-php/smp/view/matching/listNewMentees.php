<?php
/**
 * Created at 23/07/2010 1:56:24 PM
 * smp/view/matching/listNewMentees.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

$indent = "				";
print $indent."<br /><h1>List of new Mentees</h1><br />\r\n";

$list = $request->getList();
if (! empty($list)) {
	print $indent."<table class=\"table\">\r\n";
	print $indent."	<th>Firstname</th>\r\n";	
	print $indent."	<th>Lastname</th>\r\n";	
	print $indent."	<th>Gender</th>\r\n";	
	print $indent."	<th>Student Number</th>\r\n";	
	print $indent."	<th>Course</th>\r\n";	
	print $indent."	<th>Study Mode</th>\r\n";	
	print $indent."	<th>Age Range</th>\r\n";	
	print $indent."	<th>&nbsp;</th>\r\n";	
	foreach ($list as $mentee) {
	print $indent."	<tr>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getFirstname()."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getLastname()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('gender', $mentee->getStudent()->getGender())."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getStudentNumber()."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getCourse()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('study_mode', $mentee->getStudent()->getStudyMode())."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('age_range', $mentee->getStudent()->getAgeRange())."</td>\r\n";
		print $indent."		<td><a href=\"index.php?cmd=matching/matchingForm&amp;menteeId=". $mentee->getId() ."\">select for matching</a></td>\r\n";
	print $indent."	</tr>\r\n";
	}
	print $indent."</table>\r\n";
} else {
	print $indent. "<p>No new Mentee found.</p>";
}

include('smp/view/common/footer.php');