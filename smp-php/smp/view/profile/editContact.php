<?php
/**
 * Created at 10/09/2010 1:42:58 PM
 * smp/view/profile/editContact.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<h1>Contact Edit Form</h1>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
} else {
	$contact = $request->getEntity();
	$objForm->setValue('address', $contact->getAddress());
	$objForm->setValue('city',$contact->getCity());
	$objForm->setValue('postcode',$contact->getPostcode());
	$objForm->setValue('phoneHome',$contact->getPhoneHome());
	$objForm->setValue('mobile',$contact->getMobile());
	$objForm->setValue('phoneWork',$contact->getPhoneWork());
	$objForm->setValue('email',$contact->getEmail());
}
print $objForm->open("contactEditForm");
print $objForm->hidden("cmd"		, "profile/editContact");


print $objForm->label("address"		, "Address:"	, "grid_2");
print $objForm->textBox("address"	, "", "", 7		, "grid_10", "biginput", 150);
print $objForm->label("city"		, "City/Town:"	, "grid_2");
print $objForm->textBox("city"		, "", "", 8		, "grid_2");
print $objForm->label("postcode"	, "Postcode:"	, "grid_2");
print $objForm->textBox("postcode"	, "", "", 9		, "grid_6", "smallinput", 10);
print $objForm->label("phoneHome"	, "Phone (home):","grid_2");
print $objForm->textBox("phoneHome"	, "", "", 10	, "grid_2", "input", 15);
print $objForm->label("mobile"		, "Mobile:"		, "grid_2");
print $objForm->textBox("mobile"	, "", "", 11	, "grid_6", "input", 15);
print $objForm->label("phoneWork"	, "Phone (work):","grid_2");
print $objForm->textBox("phoneWork"	, "", "", 12	, "grid_2", "input", 15);
print $objForm->label("email"		, "Email:"		, "grid_2");
print $objForm->textBox("email"		, "", "", 13	, "grid_6", "input");

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Update", "Reset", 40, "grid_10", "button");
print $objForm->close();

include('smp/view/common/footer.php');