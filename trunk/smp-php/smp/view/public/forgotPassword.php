<?php
/**
 * Created at 12/10/2010 9:32:14 AM
 * smp/view/public/forgotPassword.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$indent = "				";
$objLoginForm = new smp_util_FormBuilder();
$objLoginForm->setIndent($indent);
$validator = VH::getValidator();
print $objLoginForm->strIndent."<h1>Forget your password ?</h1>\r\n";

if ($objLoginForm->isPost()) {
	$objLoginForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objLoginForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objLoginForm->strIndent);
	}
}

print $objLoginForm->open("passwordRecoveryForm");
print $objLoginForm->hidden("cmd", "public/forgotPassword");
print $objLoginForm->note("grid_12", "Please type your SCU email address.");
print $objLoginForm->label("scuEmail", "SCU email:","grid_2",true);
print $objLoginForm->textBox("scuEmail", "","",1,"grid_10","input",20,"text");
print $objLoginForm->label("", "&nbsp;", "grid_2");
print $objLoginForm->button("submit", "Send ","submit", 3, "grid_10");
print $objLoginForm->close();

include('smp/view/common/footer.php');