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
	foreach ($list as $student) {
	print $indent."	<tr>\r\n";
		print $indent."		<td>".$student->getFirstname()."</td>\r\n";
		print $indent."		<td>".$student->getLastname()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('gender', $student->getGender())."</td>\r\n";
		print $indent."		<td>".$student->getStudentNumber()."</td>\r\n";
		print $indent."		<td>".$student->getCourse()."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('study_mode', $student->getStudyMode())."</td>\r\n";
		print $indent."		<td>".VH::getValueFromFixArray('age_range', $student->getAgeRange())."</td>\r\n";
		print $indent."		<td><a href=\"index.php?cmd=student/showStudentMenteeMentor&menteeId=".$student->getId()."\">".$student->getMentor()->getFirstname()." ".$student->getMentor()->getLastname()."</a></td>\r\n";
		print $indent."	</tr>\r\n";
	}
	print $indent."</table>\r\n";
} else {
	print $indent. "<p>No matched Mentee found.</p>";
}

include('smp/view/common/footer.php');