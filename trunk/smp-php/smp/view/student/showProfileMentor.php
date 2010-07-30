<?php
/**
 * Created at 30/07/2010 9:34:07 AM
 * smp/view/student/mentorProfile.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");

$student = $request->getEntity();

$user = $student->getUser();
// User Information
include("smp/view/user/show.php");

// Student Information
include("smp/view/student/show.php");

// Mentor Information
include("smp/view/student/showMentor.php");

$contact = $student->getContact();
// Contact Information
include("smp/view/contact/show.php");

include("smp/view/common/footer.php");