<?php
/**
 * Created at 19/07/2010 9:59:02 AM
 * smp/view/student/listMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

$indent = "				";
print $indent."<br/><h1>List of Mentors</h1><br/>\r\n";

print $indent."<table class=\"table\">\r\n";
print $indent."	<th>Firstname</th>\r\n";	
print $indent."	<th>Lastname</th>\r\n";	
print $indent."	<th>Gender</th>\r\n";	
print $indent."	<th>Student Number</th>\r\n";	
print $indent."	<th>Account Status</th>\r\n";	
print $indent."	<th>&nbsp;</th>\r\n";	
foreach ($request->getList() as $student) {
print $indent."	<tr>\r\n";
	print $indent."		<td>".$student->getFirstname()."</td>\r\n";
	print $indent."		<td>".$student->getLastname()."</td>\r\n";
	print $indent."		<td>".$student->getGender()."</td>\r\n";
	print $indent."		<td>".$student->getStudentNumber()."</td>\r\n";
	print $indent."		<td>".VH::getValueFromFixArray('account_status',$student->getAccountStatus())."</td>\r\n";
	print $indent."		<td><a href=\"index.php?cmd=student/showStudentMentor&mentorId=".$student->getId()."\">See details</td>\r\n";
print $indent."	</tr>\r\n";
}
print $indent."</table>\r\n";

include('smp/view/common/footer.php');