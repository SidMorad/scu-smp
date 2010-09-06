<?php
/**
 * Created at 30/07/2010 9:34:07 AM
 * smp/view/mentor/showProfile.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");

$student = $request->getEntity();

$user = $student->getUser();
print "				<br/>\r\n";
// User Information
include("smp/view/user/show.php");

print "				<br/>\r\n";
// Student Information
include("smp/view/student/show.php");

print "				<br/>\r\n";
// Mentor Information
include("smp/view/mentor/show.php");

$contact = $student->getContact();
print "				<br/>\r\n";
// Contact Information
include("smp/view/contact/show.php");

include("smp/view/common/footer.php");