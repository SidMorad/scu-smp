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

print "				<br/>\r\n";
$user=$mentee->getUser();
include('smp/view/user/show.php');

print "				<br/>\r\n";
$student=$mentee->getStudent();
include('smp/view/student/show.php');

print "				<br/>\r\n";
$contact=$mentee->getContact();
include('smp/view/contact/show.php');

include('smp/view/common/footer.php');