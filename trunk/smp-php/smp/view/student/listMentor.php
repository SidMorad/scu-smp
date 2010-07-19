<?php
/**
 * Created at 19/07/2010 9:59:02 AM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

print "<table class=\"table\">\r\n";
print "	<th>Firstname</th>\r\n";	
print "	<th>Lastname</th>\r\n";	
print "	<th>Gender</th>\r\n";	
print "	<th>Student Number</th>\r\n";	
foreach ($request->getList() as $student) {
print "	<tr>\r\n";
	print "		<td>".$student->getFirstname()."</td>\r\n";
	print "		<td>".$student->getLastname()."</td>\r\n";
	print "		<td>".$student->getGender()."</td>\r\n";
	print "		<td>".$student->getStudentNumber()."</td>\r\n";
print "	</tr>\r\n";
}
print "</table>\r\n";

include('smp/view/common/footer.php');