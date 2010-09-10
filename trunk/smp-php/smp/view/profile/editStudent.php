<?php
/**
 * Created at 10/09/2010 10:31:56 AM
 * smp/view/profile/editStudent.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/Header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<h1>Edit Student Form</h1>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
} else {
	$student = $request->getEntity();
	$objForm->setValue('firstname', $student->getFirstname());
	$objForm->setValue('lastname', $student->getLastname());

	$objForm->setValue('gender', $student->getGender()); 
	$objForm->setValue('studentNumber', $student->getStudentNumber()); 
	$objForm->setValue('ageRange', $student->getAgeRange()); 
	$objForm->setValue('courseId', $student->getCourseId()); 
	$objForm->setValue('major', $student->getMajor());
	$objForm->setValue('studyMode', $student->getStudyMode());
	$objForm->setValue('recommendedByStaff', $student->getRecommendedByStaff());
	$objForm->setValue('semestersCompleted', $student->getSemestersCompleted());
	$objForm->setValue('familyStatus', $student->getFamilyStatus());
	$objForm->setValue('workStatus', $student->getWorkStatus());
	$objForm->setValue('tertiaryStudyStatus', $student->getTertiaryStudyStatus());
	$objForm->setValue('isFirstYear', $student->getIsFirstYear());
	      
	$objForm->setValue('isInternational', $student->getIsInternational()); 
	$objForm->setValue('isDisability', $student->getIsDisability()); 
	$objForm->setValue('isIndigenous', $student->getIsIndigenous());
	$objForm->setValue('isNonEnglish', $student->getIsNonEnglish());
	$objForm->setValue('isRegional', $student->getIsRegional()); 
	$objForm->setValue('isSocioeconomic', $student->getIsSocioeconomic());
	$objForm->setValue('preferGender', $student->getPreferGender());
	$objForm->setValue('preferAustralian', $student->getPreferAustralian()); 
	$objForm->setValue('preferDistance', $student->getPreferDistance());
	$objForm->setValue('preferInternational', $student->getPreferInternational()); 
	$objForm->setValue('preferOnCampus', $student->getPreferOnCampus()); 
	$objForm->setValue('interests', $student->getInterests()); 
	$objForm->setValue('comments', $student->getComments());
	$objForm->setValue('accountStatus', $student->getAccountStatus());
	
}



print $objForm->open("editStudentForm");
print $objForm->hidden("cmd"		, "profile/editStudent");

print $objForm->hx("h3", "grid_12", "Study Information");
print $objForm->hr();
print $objForm->label("firstname"			, "First Name:", 		"grid_6", true);
print $objForm->textBox("firstname"			, "", "", 5	, 			"grid_6", "input", 50);
print $objForm->label("lastname"			, "Last Name:", 		"grid_6", true);
print $objForm->textBox("lastname"			, "", "", 6	, 			"grid_6", "input", 50);
print $objForm->label("studyMode"			, "Your study mode:",	"grid_6", true);
print $objForm->selectBox("studyMode"		, "", "", 14, 			"grid_6", VH::getFixArray('study_mode'));
print $objForm->label("studentNumber"		, "Student number:", 	"grid_6", true);
print $objForm->textBox("studentNumber"		, "", "", 15, 			"grid_6", "input", 8);
print $objForm->label("courseId"			, "Course:", 			"grid_6");
print $objForm->selectBox("courseId"		, "", "", 16, 			"grid_6", VH::getDynamicArray('course'));
print $objForm->label("major"				, "If you are studying a Major, which one?:", "grid_6");
print $objForm->textBox("major"				, "", "", 17, 			"grid_6");
print $objForm->label("isFirstYear"			, "Did you successfully complete your first year of study?:", "grid_6");
print $objForm->redioBox("isFirstYear"		, 		  18,			"grid_6", VH::getFixArray('yes_no'), "redio", "");
print $objForm->label("recommendedByStaff"	, "Name of an academic staff (lecturer or tutor) who would recommend you :", "grid_6");
print $objForm->textBox("recommendedByStaff", "", "", 19, 			"grid_6");
print $objForm->label("semestersCompleted"	, "Number of semesters completed at SCU?:", "grid_6");
print $objForm->textBox("semestersCompleted", "", "", 20, 			"grid_6", "smallinput");
print $objForm->label("isInternationl" 		, "Are you an International student?:", "grid_6");
print $objForm->checkBox("isInternational"	, "", 	  21, 			"grid_6");

print $objForm->hx("h3", "grid_12", "Anything else that may help us in matching you");
print $objForm->hr();
print $objForm->label("ageRange"			, "Your age range:",	"grid_6");
print $objForm->selectBox("ageRange"		, "", "", 22, 			"grid_6", VH::getFixArray('age_range'));
print $objForm->label("gender"				, "Your gender:",		"grid_6");
print $objForm->selectBox("gender"			, "", "", 23,			"grid_6", VH::getFixArray('gender'));
print $objForm->label("preferGender"		, "Would you like to be matched with someone of the same gender?:", "grid_6");
print $objForm->selectBox("preferGender"	, "", "", 24, 			"grid_6", VH::getFixArray('gender_prefer'));
print $objForm->label("familyStatus"		, "Do you have parental/family responsibilities?:", "grid_6");
print $objForm->redioBox("familyStatus"		,		  25, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("tertiaryStudyStatus"	, "Have you done any previous tertiary studies?:", "grid_6");
print $objForm->redioBox("tertiaryStudyStatus",		  26, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("workStatus"			, "Do you work?:",		"grid_6");
print $objForm->selectBox("workStatus"		, "", "", 27, 			"grid_6", VH::getFixArray('work_status'));
print $objForm->label("interests"			,"Your hobbies/interests:","grid_6");
print $objForm->textArea("interests"		, "", "", 28,			"grid_6");
print $objForm->label("comments"			,"Anything else that may help us in matching you:","grid_6");
print $objForm->textArea("comments"			, "", "", 29,			"grid_6");

print $objForm->hx("h3", "grid_12", "Matching Preference");
print $objForm->hr();
print $objForm->note("grid_12", "Do you have any preference about the student(s) you would like to mentor (tick all that apply):");
print $objForm->label("preferOnCampus"		, "On-campus student:",	"grid_6");
print $objForm->checkBox("preferOnCampus"	, "&nbsp;",	30, 		"grid_6");
print $objForm->label("preferDistance"		, "Distance study student:","grid_6");
print $objForm->checkBox("preferDistance"	, "&nbsp;",	31, 		"grid_6");
print $objForm->label("preferInternational"	, "International student (studying in Australia):","grid_6");
print $objForm->checkBox("preferInternational", "&nbsp;",	32, 		"grid_6");
print $objForm->label("preferAustralian" 	, "Domestic (Australian) student:","grid_6");
print $objForm->checkBox("preferAustralian"	, "&nbsp;",	33, 		"grid_6");

print $objForm->hx("h3", "grid_12", "Please tick if you identify as one of the following...");
print $objForm->hr();
print $objForm->label("isRegional"			, "Student from regional or remote area:", "grid_6");
print $objForm->checkBox("isRegional"		, "&nbsp;",	34, 		"grid_6");
print $objForm->label("isDisability"		, "Student with a disability:","grid_6");
print $objForm->checkBox("isDisability"		, "&nbsp;",	35, 		"grid_6");
print $objForm->label("isSocioeconomic"	, "Student from low socioeconomic background <br/>(eg. in receipt of Centrelink assistance):","grid_6");
print $objForm->checkBox("isSocioeconomic"	, "&nbsp;",	36, 		"grid_6");
print $objForm->label(""					, "&nbsp;", 		"grid_6");
print $objForm->label("isNonEnglish"		, "Student from non-English speaking background:","grid_6");
print $objForm->checkBox("isNonEnglish"		, "&nbsp;",	37,			"grid_6");
print $objForm->label("isIndigenous"		, "Indigenous Australian student:","grid_6");
print $objForm->checkBox("isIndigenous"		, "&nbsp;",	38,			"grid_6");

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Update", "Reset", 40, "grid_10", "button");
print $objForm->close();

include('smp/view/common/Footer.php');