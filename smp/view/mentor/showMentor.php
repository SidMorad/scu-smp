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

$indent = "				";

print $indent."<br/>\r\n";
$user = $mentor->getUser();
$userId = $user->getId();
include('smp/view/user/show.php');
print $indent. "<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=user/edit&id=$userId\">Edit</a></div>\r\n";

print $indent."<br/>\r\n";
$student = $mentor->getStudent();
$studentId = $student->getId();
include('smp/view/student/show.php');
print $indent. "<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=student/edit&id=$studentId\">Edit</a></div>\r\n";

print $indent."<br/>\r\n";
include('smp/view/mentor/show.php');
//print $indent. "<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=student/edit&id=$studentId\">Edit</a></div>\r\n";


print "				<br/>\r\n";
$contact = $mentor->getContact();
$contactId = $contact->getId();
include('smp/view/contact/show.php');
print $indent."<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=contact/edit&id=$contactId\">Edit</a></div>\r\n";

include('smp/view/common/footer.php');