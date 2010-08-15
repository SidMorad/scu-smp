<?php
/**
 * Created at 26/07/2010 9:25:44 AM
 * smp/view/student/listMatchedMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

$indent = "				";
print $indent."<br><h1>List of Matched Mentees</h1><br>\r\n";

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
	print $indent."	<th>Mentor</th>\r\n";		
	foreach ($list as $mentee) {
	print $indent."	<tr>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getFirstname()."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getLastname()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('gender', $mentee->getStudent()->getGender())."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getStudentNumber()."</td>\r\n";
		print $indent."		<td>".$mentee->getStudent()->getCourse()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('study_mode', $mentee->getStudent()->getStudyMode())."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('age_range', $mentee->getStudent()->getAgeRange())."</td>\r\n";
		print $indent."		<td><a href=\"index.php?cmd=student/showStudentMenteeMentor&menteeId=".$mentee->getId()."\">".$mentee->getMentor()->getStudent()->getFirstname()." ".$mentee->getMentor()->getStudent()->getLastname()."</a></td>\r\n";
		print $indent."	</tr>\r\n";
	}
	print $indent."</table>\r\n";
} else {
	print $indent. "<p>No matched Mentee found.</p>";
}

include('smp/view/common/footer.php');