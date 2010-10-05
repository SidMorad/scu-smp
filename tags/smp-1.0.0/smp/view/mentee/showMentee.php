<?php
/**
 * Created at 06/09/2010 12:57:58 PM
 * smp/view/mentee/showMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
$mentee=$request->getEntity();

$indent = "				";

print $indent."<br/>\r\n";
$user=$mentee->getUser();
$userId=$user->getId();
include('smp/view/user/show.php');
print $indent."<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=user/edit&id=$userId\">Edit</a></div>\r\r";

print "				<br/>\r\n";
$student=$mentee->getStudent();
$studentId=$student->getId();
include('smp/view/student/show.php');
print $indent."<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=student/edit&id=$studentId\">Edit</a></div>\r\n";

print $indent."<br/>\r\n";
$contact=$mentee->getContact();
$contactId=$contact->getId();
include('smp/view/contact/show.php');
print $indent."<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=contact/edit&id=$contactId\">Edit</a></div>\r\n";

include('smp/view/common/footer.php');