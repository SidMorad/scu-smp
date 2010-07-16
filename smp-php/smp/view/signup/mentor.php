<?php
/**
 * Created at 04/07/2010 11:04:25 PM
 * smp/view/signup/mentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
include("smp/view/common/header.php");
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->useLocator();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<h1>Became a Mentor Application Form</h1>\r\n";
print $objForm->strIndent."<p style=\padding-left:30px;\">Use this form if you have successfully completed at least two semesters of undergraduate study at Southern Cross University and<br/> you want <b>to become a Student Mentor.</b></p>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
}



print $objForm->open("signupMentorForm");
print $objForm->hidden("cmd"		, "signup/mentor");
//print $objForm->label("", "&nbsp;", "grid_2");
//print $objForm->submitAndResetButton("button", "Register", "Reset", 39, "grid_10", "button");
print $objForm->hx("h3", "grid_12"	, "Contact Information");
print $objForm->hr();
print $objForm->label("username"	, "Username:"	, "grid_2", true);
print $objForm->textBox("username"	, "", "", 1		, "grid_2", "input", 50);
print $objForm->label("scuEmail"	, "SCU-Email:"	, "grid_2", true);
print $objForm->textBox("scuEmail"	, "", "", 2		, "grid_6", "input", 50);
print $objForm->label("password"	, "Password:"	, "grid_2", true);
print $objForm->textBox("password"	, "", "", 3		, "grid_2", "input", 50, "password");
print $objForm->label("password2"	, "Confirm Password:", "grid_2", true);
print $objForm->textBox("password2"	, "", "", 4		, "grid_6", "input", 50, "password");
print $objForm->label("firstName"	, "First Name:"	, "grid_2");
print $objForm->textBox("firstName"	, "", "", 5		, "grid_2", "input", 50);
print $objForm->label("lastName"	, "Last Name:"	, "grid_2");
print $objForm->textBox("lastName"	, "", "", 6		, "grid_6", "input", 50);
print $objForm->label("address"		, "Address:"	, "grid_2");
print $objForm->textBox("address"	, "", "", 7		, "grid_10", "biginput", 150);
print $objForm->label("city"		, "City/Town:"	, "grid_2");
print $objForm->textBox("city"		, "", "", 8		, "grid_2");
print $objForm->label("postcode"	, "Postcode:"	, "grid_2");
print $objForm->textBox("postcode"	, "", "", 9		, "grid_6", "smallinput", 10);
print $objForm->label("phoneHome"	, "Phone (home):","grid_2");
print $objForm->textBox("phoneHome"	, "", "", 10		, "grid_2", "input", 15);
print $objForm->label("mobile"		, "Mobile:"		, "grid_2");
print $objForm->textBox("mobile"	, "", "", 11		, "grid_6", "input", 15);
print $objForm->label("phoneWork"	, "Phone (work):","grid_2");
print $objForm->textBox("phoneWork"	, "", "", 12	, "grid_2", "input", 15);
print $objForm->label("email"		, "Email:"		, "grid_2");
print $objForm->textBox("email"		, "", "", 13	, "grid_6", "input", 15);
//print $objForm->note("grid_X","Note: This contact information is used to contact you about the program. Your name, and email address will also be given to the new student(s) you will mentor");

print $objForm->hx("h3", "grid_12", "Study Information");
print $objForm->hr();
print $objForm->label("studyMode"			, "Your study mode:",	"grid_6", true);
print $objForm->selectBox("studyMode"		, "", "", 14, 			"grid_6", VH::getFixArray('study_mode'));
print $objForm->label("studentNumber"		, "Student number:", 	"grid_6", true);
print $objForm->textBox("studentNumber"		, "", "", 15, 			"grid_6", "input", 10);
print $objForm->label("course"				, "Course:", 			"grid_6");
print $objForm->textBox("course"			, "", "", 16, 			"grid_6");
print $objForm->label("major"				, "If you are studying a Major, which one?:", "grid_6");
print $objForm->textBox("major"				, "", "", 17, 			"grid_6");
print $objForm->label("firstYearComplete"	, "Did you successfully complete your first year of study?:", "grid_6");
print $objForm->redioBox("firstYearComplete", 		  18,			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("recommendedByStaff"	, "Name of an academic staff (lecturer or tutor) who would recommend you :", "grid_6");
print $objForm->textBox("recommendedByStaff", "", "", 19, 			"grid_6");
print $objForm->label("semestersCompleted"	, "Number of semesters completed at SCU?:", "grid_6");
print $objForm->textBox("semestersCompleted", "", "", 20, 			"grid_6", "smallinput");
print $objForm->label("internationl" 		, "Are you an International student?:", "grid_6");
print $objForm->checkBox("international"	, "", 	  21, 			"grid_6");
//print $objForm->note("grid_12","Note:This information is used to administer the program, assess your suitability as a mentor, and match you with a student studying the same course.");

print $objForm->hx("h3", "grid_12", "Anything else that may help us in matching you");
print $objForm->hr();
print $objForm->label("ageRange"			, "Your age range:",	"grid_6");
print $objForm->selectBox("agaRange"		, "", "", 22, 			"grid_6", VH::getFixArray('age_range'));
print $objForm->label("gender"				, "Your gender:",		"grid_6");
print $objForm->selectBox("gender"			, "", "", 23,			"grid_6", VH::getFixArray('gender'));
print $objForm->label("genderPrefer"		, "Would you like to be matched with someone of the same gender?:", "grid_6");
print $objForm->selectBox("genderPrefer"	, "", "", 24, 			"grid_6", VH::getFixArray('gender_prefer'));
print $objForm->label("familyStatus"		, "Do you have parental/family responsibilities?:", "grid_6");
print $objForm->redioBox("familyStatus"		,		  25, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("tertiaryStatus"		, "Have you done any previous tertiary studies?:", "grid_6");
print $objForm->redioBox("tertiaryStatus"	,		  26, 			"grid_6", VH::getFixArray('yes_no'));
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
print $objForm->checkBox("preferOnCampus"	, "", 	  30, 			"grid_6");
print $objForm->label(""					, "&nbsp;" , 			"grid_12");
print $objForm->label("preferDistance"		, "Distance study student:","grid_6");
print $objForm->checkBox("preferDistance"	, "",     31, 			"grid_6");
print $objForm->label(""					, "&nbsp;" , 			"grid_12");
print $objForm->label("preferInternational"	, "International student (studying in Australia):","grid_6");
print $objForm->checkBox("preferInternational", "",   32, 			"grid_6");
print $objForm->label(""					, "&nbsp;" , 			"grid_12");
print $objForm->label("preferAustralian" 	, "Domestic (Australian) student:","grid_6");
print $objForm->checkBox("preferAustralian"	, "",     33, 			"grid_6");

print $objForm->hx("h3", "grid_12", "Are you a:");
print $objForm->hr();
print $objForm->label("isRegional"			, "Student from regional or remote area:", "grid_6");
print $objForm->redioBox("isRegional"		,		  34, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("isDisability"		, "Student with a disability:","grid_6");
print $objForm->redioBox("isDisability"		,		  35, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("isLowSocioeconomic"	, "Student from low socioeconomic background <br/>(eg. in receipt of Centrelink assistance):","grid_6");
print $objForm->redioBox("isLowSocioeconomic",		  36, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label(""					, "&nbsp;", 			"grid_6");
print $objForm->label("isNonEnglish"		, "Student from non-English speaking background:","grid_6");
print $objForm->redioBox("isNonEnglish"		,		  37, 			"grid_6", VH::getFixArray('yes_no'));
print $objForm->label("isIndigenous"		, "Indigenous Australian student:","grid_6");
print $objForm->redioBox("isIndigenous"		,		  38, 			"grid_6", VH::getFixArray('yes_no'));

print $objForm->hx("h3", "grid_12", "Agreement");
print $objForm->hr();
print $objForm->label("agreement"			, "In applying to be a student mentor, I agree to allow my contact details to be given to my allocated<br/> first year student(s) and other mentors for the purposes of the Student Mentoring Program.", "grid_8", true);
print $objForm->checkBox("agreement"		, "", 	  39, "grid_4", null, false, "checkbox");

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Register", "Reset", 40, "grid_10", "button");
print $objForm->close();

include("smp/view/common/footer.php");