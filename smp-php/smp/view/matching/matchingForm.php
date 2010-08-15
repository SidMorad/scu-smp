<?php
/**
 * Created at 23/07/2010 3:11:30 PM
 * smp/view/matching/matchingForm.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$indent = "				";

print $indent."<br /><h1>Mentee matching form</h1><br/>\r\n";

$mentee = $request->getEntity();

print $indent."<span style=\"padding-left:20px;\">Student Number :  <b>". $mentee->getStudent()->getStudentNumber()."</b></span><br/>\r\n";
print $indent."<span style=\"padding-left:20px;\">Mentee Name :  <b>". $mentee->getStudent()->getFirstname() ."	". $mentee->getStudent()->getLastname() ."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Gender :  <b>". VH::getValueFromFixArray('gender', $mentee->getStudent()->getGender())."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Course :  <b>". $mentee->getStudent()->getCourse()."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Age Range :  <b>". VH::getValueFromFixArray('age_range', $mentee->getStudent()->getAgeRange())."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Study Mode :  <b>". VH::getValueFromFixArray('study_mode', $mentee->getStudent()->getStudyMode())."</b></span><hr/>\r\n";

$matchingForm = new smp_util_FormBuilder();
$matchingForm->setIndent($indent);

if ($matchingForm->isPost()) {
	$validator = VH::getValidator();
	$matchingForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$matchingForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($matchingForm->strIndent);
	}
}

print $indent. $matchingForm->open("matchingForm");
print $matchingForm->hidden("cmd", "matching/matchingForm");
print $matchingForm->hidden("menteeId", $mentee->getId());
print $indent. "	<span style=\"padding-left:20px;\">\r\n" . $matchingForm->button("submit", "Submit", "submit", 0,null, "button", array('onClick'=>'return confirmSubmit()'));
print $indent ."	</span><hr style=\"border-color:white;\" />\r\n";
print $indent."<table class=\"table\">\r\n";
print $indent."	<th>Id</th>\r\n";	
print $indent."	<th>Student Number</th>\r\n";	
print $indent."	<th>Firstname</th>\r\n";	
print $indent."	<th>Lastname</th>\r\n";	
print $indent."	<th>Gender</th>\r\n";	
print $indent."	<th>Course</th>\r\n";	
print $indent."	<th>Age Range</th>\r\n";	
print $indent."	<th>Study Mode</th>\r\n";
print $indent."	<th>Mentees</th>\r\n";		
foreach ($request->getList() as $mentor) {
print $indent."	<tr>\r\n";
	print $indent."		<td>".$matchingForm->redioBox("mentorId", 1, null, array($mentor->getId()=>$mentor->getId()), "redio", null);
	print $indent."		</td>\r\n";
	print $indent."		<td>".$mentor->getStudent()->getStudentNumber()."</td>\r\n";
	print $indent."		<td>".$mentor->getStudent()->getFirstname()."</td>\r\n";
	print $indent."		<td>".$mentor->getStudent()->getLastname()."</td>\r\n";
	print $indent."		<td>".VH::getValueFromFixArray('gender', $mentor->getStudent()->getGender())."</td>\r\n";
	print $indent."		<td>".$mentor->getStudent()->getCourse()."</td>\r\n";
	print $indent."		<td>".VH::getValueFromFixArray('age_range', $mentor->getStudent()->getAgeRange())."</td>\r\n";
	print $indent."		<td>".VH::getValueFromFixArray('study_mode', $mentor->getStudent()->getStudyMode())."</td>\r\n";
	if (count($mentor->getMentees()) > 0) {
		print $indent."		<td><a href=\"index.php?cmd=student/showStudentMentorMentees&mentorId=".$mentor->getId()."\">".count($mentor->getMentees())."</a></td>\r\n";
	} else {
		print $indent."		<td>0</td>\r\n";
	}
print $indent."	</tr>\r\n";
}
print $indent."</table>\r\n";
print $matchingForm->close();

include('smp/view/common/footer.php');