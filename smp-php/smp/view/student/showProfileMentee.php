<?php
/**
 * Created at 30/07/2010 4:22:35 PM
 * smp/view/student/showProfileMentee.php
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include("smp/view/common/header.php");


$student=$request->getEntity();

$user=$student->getUser();
//User Information
include("smp/view/user/show.php");

//Student Information
include("smp/view/student/show.php");

$contact = $student->getContact();
// Contact Information
include("smp/view/contact/show.php");
include("smp/view/common/footer.php");
