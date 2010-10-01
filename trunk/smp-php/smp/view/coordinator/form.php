<?php
/**
 * Created at 01/10/2010 12:20:05 PM
 * smp/view/coordinator/form.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<br /><h1>&nbsp;Coordinator Form</h1><br />\r\n";

if($objForm->isPost()){
	$objForm->setValues($validator->getValues());
	if($validator->isInvalid()){
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
}

print $objForm->open("coordinatorForm");
print $objForm->hidden("cmd","coordinator/form");

print $objForm->label("firstname"	, "First Name:"	, "grid_2", true);
print $objForm->textBox("firstname"	, "", "", 1		, "grid_10", "input", 50);
print $objForm->label("lastname"	, "Last Name:"	, "grid_2", true);
print $objForm->textBox("lastname"	, "", "", 1		, "grid_10", "input", 50);
print $objForm->label("username"	,"Username:"	, "grid_2", true);
print $objForm->textBox("username"	,"","",1		, "grid_10","input", 50);
print $objForm->label("scuEmail"	,"SCU-Email:"	, "grid_2",true);
print $objForm->textBox("scuEmail"	,"","",1		, "grid_10","input",50);
print $objForm->label("password"	, "Password:"	, "grid_2", true);
print $objForm->textBox("password"	, "", "", 1		, "grid_10", "input", 50, "password");
print $objForm->label("password2"	, "Confirm Password:", "grid_2", true);
print $objForm->textBox("password2"	, "", "", 1		, "grid_10", "input", 50, "password");
print $objForm->label("picture"		, "Profile Picture:", "grid_2");
print $objForm->file("picture"		, "", 1			, "grid_10", "biginput", 50);
print $objForm->label("campuses[]"		, "Campus:"	, "grid_2");
print $objForm->selectBox('campuses[]' , "", array(),1, "grid_10", VH::getDynamicArray(Constants::TABLE_CAMPUS), "input", 5, true);

print $objForm->label("","&nbsp;","grid_12");
print $objForm->label("","&nbsp;","grid_2");
print $objForm->submitAndResetButton("button","Save","Reset",1, "grid_10","button");
print $objForm->close();

include('smp/view/common/footer.php');