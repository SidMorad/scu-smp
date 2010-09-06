<?php
/**
 * Created at 06/09/2010 11:55:09 AM
 * view/mentor/showMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

$mentor = $request->getEntity();

print "				<br/>\r\n";
$user = $mentor->getUser();
include('smp/view/user/show.php');


print "				<br/>\r\n";
$student = $mentor->getStudent();
include('smp/view/student/show.php');

print "				<br/>\r\n";
$contact = $mentor->getContact();
include('smp/view/contact/show.php');

include('smp/view/common/footer.php');