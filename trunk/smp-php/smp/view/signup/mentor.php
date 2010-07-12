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
print $objForm->hidden("cmd"		,"signup/mentor");
print "\r\n".$objForm->strIndent."	<h3>Contact Information</h3>\r\n";
print $objForm->strIndent."	<hr/>\r\n";
print $objForm->label("username"	,"Username:"	,"grid_2", true);
print $objForm->textBox("username"	,"","",1		,"grid_2","input",50);
print $objForm->label("scuEmail"	,"SCU-Email:"	,"grid_2", true);
print $objForm->textBox("scuEmail"	,"","",2		,"grid_6","input",50);
print $objForm->label("firstName"	,"First Name:"	,"grid_2");
print $objForm->textBox("firstName"	,"","",3		,"grid_2","input",50);
print $objForm->label("lastName"	,"Last Name:"	,"grid_2");
print $objForm->textBox("lastName"	,"","",4		,"grid_6","input",50);
print $objForm->label("address"		,"Address:"		,"grid_2");
print $objForm->textBox("address"	,"","",5		,"grid_10","biginput",150);
print $objForm->label("city"		,"City/Town:"	,"grid_2");
print $objForm->textBox("city"		,"","",6		,"grid_2");
print $objForm->label("postcode"	,"Postcode:"	,"grid_2");
print $objForm->textBox("postcode"	,"","",7		,"grid_6","smallinput",10);
print $objForm->label("phoneHome"	,"Phone (home):","grid_2");
print $objForm->textBox("phoneHome"	,"","",8		,"grid_2","input",15);
print $objForm->label("mobile"		,"Mobile:"		,"grid_2");
print $objForm->textBox("mobile"	,"","",9		,"grid_6","input",15);
print $objForm->label("phoneWork"	,"Phone (work):","grid_2");
print $objForm->textBox("phoneWork"	,"","",10		,"grid_2","input",15);
print $objForm->label("email"		,"Email:"		,"grid_2");
print $objForm->textBox("email"		,"","",11		,"grid_6","input",15);
print $objForm->label(""			,"&nbsp;"		,"grid_12");
print $objForm->strIndent."	<p>Note: This contact information is used to contact you about the program. Your name, and email address will also be given to the new student(s) you will mentor.</p>\r\n";

print "\r\n".$objForm->strIndent."	<h3>Study Information</h3>\r\n";
print $objForm->strIndent."	<hr/>\r\n";
print $objForm->label("studyMode"	,"Your study mode:"	,"grid_2",true);
print $objForm->comboBox("studyMode","","",12			,"grid_2","combo",VH::getStaticOptionArray('study_mode'));
print $objForm->label("studentNumber", "Student number:","grid_2");
print $objForm->textBox("studentNumber","","",13		,"grid_6","input",10);
print $objForm->label("course"		, "Course:"			,"grid_2");
print $objForm->textBox("course"	,"","",14			,"grid_2");
print $objForm->label("major"		, "Major (if you have):","grid_2");
print $objForm->textBox("major"		,"","",15			,"grid_6");
print $objForm->label("firstYearComplete", "did you successfully complete your first year of study?:", "grid_6");
print $objForm->redioBox("firstYearComplete", VH::getStaticOptionArray('yes_no'),16,"grid_6");
print $objForm->label("recommendedByStaff", "name of an academic staff (lecturer or tutor) who would recommend you :","grid_6");
print $objForm->textBox("recommendedByStaff","","", 17,"grid_6");
print $objForm->label("semestersCompleted", "number of semesters completed at SCU?:", "grid_6");
print $objForm->textBox("semestersCompleted","","", 18,"grid_6","smallinput");
print $objForm->label("internationl" , "Are you an International student?:","grid_6");
//print $objForm->checkBox();

print $objForm->label("", "&nbsp;","grid_2");
print $objForm->submitAndResetButton("button", "Register", "Reset",20,"grid_10","button");
print $objForm->close();

include("smp/view/common/footer.php");