<?php
/**
 * Created at 01/10/2010 2:46:03 PM
 * smp/view/coordinator/edit.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<h1>Coordinator Edit Form</h1>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
	$id = $validator->getProperty('id');
} else {
	$coordinator = $request->getEntity();
	$user = $coordinator->getUser();
	$objForm->setValue('firstname', $coordinator->getFirstname());
	$objForm->setValue('lastname', $coordinator->getLastname());
	$objForm->setValue('username', $user->getUsername());
	$objForm->setValue('scuEmail', $user->getScuEmail());
	$objForm->setValue('campuses', $user->getCampuses());
	$id = $coordinator->getId();
}

print $objForm->open("userEditForm");
print $objForm->hidden("cmd"		, "coordinator/edit");
print $objForm->hidden("id"			, "$id");
print $objForm->label("firstname"	, "First Name:"	, "grid_2", true);
print $objForm->textBox("firstname"	, "", "", 1		, "grid_10", "input", 50);
print $objForm->label("lastname"	, "Last Name:"	, "grid_2", true);
print $objForm->textBox("lastname"	, "", "", 1		, "grid_10", "input", 50);
print $objForm->label("username"	, "Username:"	, "grid_2", true);
print $objForm->textBox("username"	, "", "", 1		, "grid_10", "input", 50, 'text', array('readonly'=>'readonly'));
print $objForm->label("scuEmail"	, "SCU-Email:"	, "grid_2", true);
print $objForm->textBox("scuEmail"	, "", "", 2		, "grid_10", "input", 50);
print $objForm->label("picture" 	, "Profile Picture:", "grid_2");
print $objForm->file("picture"		, "", 	  5	, "grid_10", "biginput");
print $objForm->label("campuses[]"		, "Camposes:", "grid_2");
print $objForm->selectBox('campuses[]' , "", array(),6, "grid_10", VH::getDynamicArray(Constants::TABLE_CAMPUS), "input", 5, true);

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Update", "Reset", 6, "grid_10", "button");
print $objForm->close();

include('smp/view/common/footer.php');