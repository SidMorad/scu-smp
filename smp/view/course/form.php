<?php
/**
 * Created at 13/09/2010 11:21:14 AM
 * smp/view/course/form.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$objForm = new smp_util_FormBuilder();
$objForm->setIndent("			");
$validator = VH::getValidator();

print $objForm->strIndent."<br/><h1>&nbsp;Course Form</h1><br/>\r\n";

if ($objForm->isPost()) {
	$objForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objForm->strIndent);
	}
}

print $objForm->open("courseForm");
print $objForm->hidden("cmd"		, "course/form");

print $objForm->label("name"		, "Name:"		, "grid_2");
print $objForm->textBox("name"		, "", "", 1	, "grid_10", "input");

print $objForm->label("", "&nbsp;", "grid_12");
print $objForm->label("", "&nbsp;", "grid_2");
print $objForm->submitAndResetButton("button", "Save", "Reset", 2, "grid_10", "button");
print $objForm->close();

include('smp/view/common/footer.php');