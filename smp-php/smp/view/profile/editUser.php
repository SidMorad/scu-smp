<?php
/**
 * Created at 06/09/2010 5:03:46 PM
 * smp/view/profile/editUser.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<h1>User Edit Form</h1>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
} else {
	$user = $request->getEntity();
	$objForm->setValue('username', $user->getUsername());
	$objForm->setValue('scuEmail', $user->getScuEmail());
}

print $objForm->open("userEditForm");
print $objForm->hidden("cmd"		, "profile/editUser");
print $objForm->label("username"	, "Username:"	, "grid_2", true);
print $objForm->textBox("username"	, "", "", 1		, "grid_2", "input", 50, 'text', array('readonly'=>'readonly'));
print $objForm->label("scuEmail"	, "SCU-Email:"	, "grid_2", true);
print $objForm->textBox("scuEmail"	, "", "", 2		, "grid_6", "input", 50);
print $objForm->label("password"	, "Password:"	, "grid_2", true);
print $objForm->textBox("password"	, "", "", 3		, "grid_2", "input", 50, "password");
print $objForm->label("password2"	, "Confirm Password:", "grid_2", true);
print $objForm->textBox("password2"	, "", "", 4		, "grid_6", "input", 50, "password");
print $objForm->label("picture" 	, "Profile Picture:", "grid_2");
print $objForm->file("picture"		, "", 	  13	, "grid_10", "biginput");

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Update", "Reset", 40, "grid_10", "button");
print $objForm->close();

$user = $request->getEntity();

include('smp/view/common/footer.php');
