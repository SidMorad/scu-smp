<?php
/**
 * Created at 24/09/2010 12:27:43 PM
 * smp/view/contact/edit.php
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/Header.php');
require_once('smp/util/FormBuilder.php');

$objForm=new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator=VH::getValidator();

print $objForm->strIndent."<h1>Edit Student Form</h1>\r\n";

if($objForm->isPost()){
	$objForm->setValues($validator->getValues());
	if($validator->isInvalid()){
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->stIndent);
	}
	$id=$validator->getProperty('id');
}else{
	$contact = $request->getEntity();
	$objForm->setValue('address', $contact->getAddress());
	$objForm->setValue('city',$contact->getCity());
	$objForm->setValue('postcode',$contact->getPostcode());
	$objForm->setValue('phoneHome',$contact->getPhoneHome());
	$objForm->setValue('mobile',$contact->getMobile());
	$objForm->setValue('phoneWork',$contact->getPhoneWork());
	$objForm->setValue('email',$contact->getEmail());
	$id = $contact->getId();
}
print $objForm->open("contactEditForm");
print $objForm->hidden("cmd"		, "contact/edit");
print $objForm->hidden("id"		, "$id");


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